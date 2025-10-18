<?php
/**
 * Quick Content Quality Check for NepState
 * Identifies content issues causing "Crawled - Not Indexed" problems
 */

echo "<h1>📝 Quick Content Quality Check</h1>";

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=u415500770_nepstate", 
        "u415500770_nepstate", 
        "P145DeDevelopers"
    );
    
    echo "<h2>🔍 Critical Content Issues</h2>";
    
    // Check products with poor content (using actual database structure)
    $stmt = $pdo->query("
        SELECT COUNT(*) as count 
        FROM products 
        WHERE status = 1 
        AND (
            title IS NULL OR title = '' OR 
            LENGTH(title) < 10 OR
            JSON_EXTRACT(json_content, '$.description') IS NULL OR 
            JSON_EXTRACT(json_content, '$.description') = '' OR
            JSON_EXTRACT(json_content, '$.description') = '\"\"' OR
            LENGTH(JSON_EXTRACT(json_content, '$.description')) < 50
        )
    ");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "❌ Products with poor content: <strong>{$result['count']}</strong><br>";
    
    // Check products without images (images are in json_content)
    $stmt = $pdo->query("
        SELECT COUNT(*) as count 
        FROM products 
        WHERE status = 1 
        AND (
            JSON_EXTRACT(json_content, '$.image') IS NULL OR 
            JSON_EXTRACT(json_content, '$.image') = '' OR
            JSON_EXTRACT(json_content, '$.image') = '\"\"' OR
            JSON_EXTRACT(json_content, '$.image') = '\"no-image.png\"'
        )
    ");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "❌ Products without images: <strong>{$result['count']}</strong><br>";
    
    // Check products with missing location (using actual database structure)
    $stmt = $pdo->query("
        SELECT COUNT(*) as count 
        FROM products 
        WHERE status = 1 
        AND (
            (city IS NULL OR city = '' OR state IS NULL OR state = '') AND
            (JSON_EXTRACT(json_content, '$.city') IS NULL OR JSON_EXTRACT(json_content, '$.city') = '' OR JSON_EXTRACT(json_content, '$.city') = '\"\"' OR
             JSON_EXTRACT(json_content, '$.state') IS NULL OR JSON_EXTRACT(json_content, '$.state') = '' OR JSON_EXTRACT(json_content, '$.state') = '\"\"')
        )
    ");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "❌ Products with missing location: <strong>{$result['count']}</strong><br>";
    
    // Check for duplicate titles
    $stmt = $pdo->query("
        SELECT title, COUNT(*) as count 
        FROM products 
        WHERE status = 1 AND title IS NOT NULL
        GROUP BY title 
        HAVING count > 1 
        ORDER BY count DESC 
        LIMIT 5
    ");
    $duplicates = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "❌ Duplicate titles found: <strong>" . count($duplicates) . "</strong><br>";
    
    if (count($duplicates) > 0) {
        echo "<details><summary>View duplicate titles</summary>";
        foreach($duplicates as $dup) {
            echo "• '{$dup['title']}' used {$dup['count']} times<br>";
        }
        echo "</details>";
    }
    
    echo "<h2>📊 Content Quality Score</h2>";
    
    // Calculate quality metrics
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE status = 1");
    $total_products = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE status = 1 AND LENGTH(title) >= 10");
    $good_titles = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE status = 1 AND LENGTH(JSON_EXTRACT(json_content, '$.description')) >= 50 AND JSON_EXTRACT(json_content, '$.description') != '\"\"'");
    $good_descriptions = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE status = 1 AND JSON_EXTRACT(json_content, '$.image') IS NOT NULL AND JSON_EXTRACT(json_content, '$.image') != '' AND JSON_EXTRACT(json_content, '$.image') != '\"\"' AND JSON_EXTRACT(json_content, '$.image') != '\"no-image.png\"'");
    $has_images = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    if ($total_products > 0) {
        $title_score = round(($good_titles / $total_products) * 100);
        $desc_score = round(($good_descriptions / $total_products) * 100);
        $image_score = round(($has_images / $total_products) * 100);
        
        echo "Good titles: <strong>{$title_score}%</strong><br>";
        echo "Good descriptions: <strong>{$desc_score}%</strong><br>";
        echo "Has images: <strong>{$image_score}%</strong><br>";
        
        $overall_score = round(($title_score + $desc_score + $image_score) / 3);
        echo "<br>Overall Content Quality Score: <strong>{$overall_score}%</strong><br>";
        
        if ($overall_score >= 80) {
            echo "✅ <strong>Excellent content quality!</strong><br>";
        } elseif ($overall_score >= 60) {
            echo "⚠️ <strong>Good content quality, room for improvement</strong><br>";
        } else {
            echo "❌ <strong>Poor content quality, needs significant improvement</strong><br>";
        }
    }
    
    echo "<h2>🎯 Quick Wins (Top 10 Products to Fix)</h2>";
    
    // Get products with the worst content (using actual database structure)
    $stmt = $pdo->query("
        SELECT id, title, 
               JSON_EXTRACT(json_content, '$.description') as description,
               JSON_EXTRACT(json_content, '$.image') as image,
               city, state
        FROM products 
        WHERE status = 1 
        ORDER BY 
            CASE WHEN LENGTH(title) < 10 THEN 1 ELSE 0 END DESC,
            CASE WHEN LENGTH(JSON_EXTRACT(json_content, '$.description')) < 50 OR JSON_EXTRACT(json_content, '$.description') = '\"\"' THEN 1 ELSE 0 END DESC,
            CASE WHEN JSON_EXTRACT(json_content, '$.image') IS NULL OR JSON_EXTRACT(json_content, '$.image') = '' OR JSON_EXTRACT(json_content, '$.image') = '\"\"' OR JSON_EXTRACT(json_content, '$.image') = '\"no-image.png\"' THEN 1 ELSE 0 END DESC
        LIMIT 10
    ");
    $worst_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($worst_products) > 0) {
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Title</th><th>Description</th><th>Image</th><th>Location</th><th>Issues</th></tr>";
        
        foreach($worst_products as $product) {
            $issues = [];
            if (strlen($product['title']) < 10) $issues[] = "Short title";
            
            $description = $product['description'] ? trim($product['description'], '"') : '';
            if (strlen($description) < 50) $issues[] = "No description";
            
            $image = $product['image'] ? trim($product['image'], '"') : '';
            if (empty($image) || $image === 'no-image.png') {
                $issues[] = "No image";
            }
            
            if (empty($product['city']) || empty($product['state'])) {
                $issues[] = "No location";
            }
            
            echo "<tr>";
            echo "<td>{$product['id']}</td>";
            echo "<td>" . htmlspecialchars(substr($product['title'], 0, 30)) . "...</td>";
            echo "<td>" . htmlspecialchars(substr($description, 0, 30)) . "...</td>";
            echo "<td>" . (empty($image) ? "❌" : "✅") . "</td>";
            echo "<td>" . htmlspecialchars($product['city'] . ', ' . $product['state']) . "</td>";
            echo "<td>" . implode(', ', $issues) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

echo "<h2>✅ Next Steps</h2>";
echo "1. Fix the top 10 products with worst content<br>";
echo "2. Add descriptions to products missing them<br>";
echo "3. Upload images for products without photos<br>";
echo "4. Add location data for better local SEO<br>";
echo "5. Fix duplicate titles<br>";

echo "<p><strong>Run this check and share the results!</strong></p>";
?>
