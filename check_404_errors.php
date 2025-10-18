<?php
/**
 * 404 Error Diagnostic Tool
 * Identifies pages that Google is finding as 404 errors
 */

echo "<h1>🔍 404 Error Diagnostic Tool</h1>";

try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=u415500770_nepstate", 
        "u415500770_nepstate", 
        "P145DeDevelopers"
    );
    
    echo "<h2>📋 Potential 404 Error Sources</h2>";
    
    // 1. Check for inactive products
    echo "<h3>1. Inactive Products (May Cause 404s)</h3>";
    
    $stmt = $pdo->query("
        SELECT id, title, slug, status, created_at
        FROM products 
        WHERE status = 0
        ORDER BY created_at DESC
        LIMIT 20
    ");
    
    $inactive_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($inactive_products) > 0) {
        echo "⚠️ <strong>Found " . count($inactive_products) . " inactive products:</strong><br>";
        echo "<p>If these were previously indexed, they now return 404 errors</p>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Title</th><th>Slug</th><th>Created</th><th>URL</th></tr>";
        
        foreach($inactive_products as $product) {
            $url = "https://nepstate.com/classified/detail/{$product['slug']}";
            echo "<tr>";
            echo "<td>{$product['id']}</td>";
            echo "<td>" . htmlspecialchars(substr($product['title'], 0, 40)) . "</td>";
            echo "<td>" . htmlspecialchars($product['slug']) . "</td>";
            echo "<td>{$product['created_at']}</td>";
            echo "<td><a href='{$url}' target='_blank'>Test</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "✅ No inactive products found<br>";
    }
    
    // 2. Check for inactive blogs
    echo "<h3>2. Inactive Blogs (May Cause 404s)</h3>";
    
    $stmt = $pdo->query("
        SELECT id, title, slug, status, created_at
        FROM blogs 
        WHERE status = 0
        ORDER BY created_at DESC
        LIMIT 20
    ");
    
    $inactive_blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($inactive_blogs) > 0) {
        echo "⚠️ <strong>Found " . count($inactive_blogs) . " inactive blogs:</strong><br>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Title</th><th>Slug</th><th>Created</th><th>URL</th></tr>";
        
        foreach($inactive_blogs as $blog) {
            $url = "https://nepstate.com/blog/{$blog['slug']}";
            echo "<tr>";
            echo "<td>{$blog['id']}</td>";
            echo "<td>" . htmlspecialchars(substr($blog['title'], 0, 40)) . "</td>";
            echo "<td>" . htmlspecialchars($blog['slug']) . "</td>";
            echo "<td>{$blog['created_at']}</td>";
            echo "<td><a href='{$url}' target='_blank'>Test</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "✅ No inactive blogs found<br>";
    }
    
    // 3. Check for products with missing slugs
    echo "<h3>3. Products with Problematic Slugs</h3>";
    
    $stmt = $pdo->query("
        SELECT id, title, slug
        FROM products 
        WHERE status = 1 
        AND (slug IS NULL OR slug = '' OR LENGTH(slug) < 3)
        LIMIT 20
    ");
    
    $bad_slugs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($bad_slugs) > 0) {
        echo "❌ <strong>Found " . count($bad_slugs) . " products with bad slugs:</strong><br>";
        echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>ID</th><th>Title</th><th>Slug</th></tr>";
        
        foreach($bad_slugs as $product) {
            echo "<tr>";
            echo "<td>{$product['id']}</td>";
            echo "<td>" . htmlspecialchars(substr($product['title'], 0, 40)) . "</td>";
            echo "<td>" . htmlspecialchars($product['slug']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "✅ No products with bad slugs found<br>";
    }
    
    // 4. Check for duplicate slugs
    echo "<h3>4. Duplicate Slugs (Can Cause 404s)</h3>";
    
    $stmt = $pdo->query("
        SELECT slug, COUNT(*) as count 
        FROM products 
        WHERE status = 1 
        GROUP BY slug 
        HAVING count > 1
        ORDER BY count DESC
    ");
    
    $duplicate_slugs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($duplicate_slugs) > 0) {
        echo "❌ <strong>Found " . count($duplicate_slugs) . " duplicate slugs:</strong><br>";
        foreach($duplicate_slugs as $dup) {
            echo "• Slug '{$dup['slug']}' used {$dup['count']} times<br>";
        }
    } else {
        echo "✅ No duplicate slugs found<br>";
    }
    
    // 5. Summary
    echo "<h2>📊 Summary</h2>";
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM products WHERE status = 0");
    $total_inactive_products = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM blogs WHERE status = 0");
    $total_inactive_blogs = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "<p><strong>Total inactive products:</strong> {$total_inactive_products}</p>";
    echo "<p><strong>Total inactive blogs:</strong> {$total_inactive_blogs}</p>";
    echo "<p><strong>Total potential 404s:</strong> " . ($total_inactive_products + $total_inactive_blogs) . "</p>";
    
    echo "<h2>🛠️ Recommended Actions</h2>";
    
    echo "<h3>Option 1: Reactivate Content (If Mistakenly Deactivated)</h3>";
    echo "<ul>";
    echo "<li>Review the inactive content above</li>";
    echo "<li>If content should be public, reactivate it through admin panel</li>";
    echo "<li>This will make the URLs work again</li>";
    echo "</ul>";
    
    echo "<h3>Option 2: Set Up Redirects (If Content Moved)</h3>";
    echo "<ul>";
    echo "<li>Create 301 redirects from old URLs to new locations</li>";
    echo "<li>Add redirect rules to .htaccess</li>";
    echo "<li>This preserves SEO value and prevents 404s</li>";
    echo "</ul>";
    
    echo "<h3>Option 3: Return 410 Gone (If Content Permanently Deleted)</h3>";
    echo "<ul>";
    echo "<li>For content that won't return, send 410 status instead of 404</li>";
    echo "<li>This tells Google to stop trying to crawl these URLs</li>";
    echo "<li>Better for SEO than 404</li>";
    echo "</ul>";
    
    echo "<h3>Option 4: Clean Up Sitemap</h3>";
    echo "<ul>";
    echo "<li>Ensure your sitemap only includes active content (status = 1)</li>";
    echo "<li>Remove inactive products and blogs from sitemap</li>";
    echo "<li>This prevents Google from finding these URLs</li>";
    echo "</ul>";
    
    echo "<h2>🔍 How to Check Google Search Console:</h2>";
    echo "<ol>";
    echo "<li>Go to <a href='https://search.google.com/search-console' target='_blank'>Google Search Console</a></li>";
    echo "<li>Click 'Pages' in the left menu</li>";
    echo "<li>Scroll to 'Why pages aren't indexed'</li>";
    echo "<li>Click 'Not found (404)'</li>";
    echo "<li>See the exact 8 URLs Google is finding as 404s</li>";
    echo "<li>Compare with the lists above to identify which ones need fixing</li>";
    echo "</ol>";
    
} catch (Exception $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
}

echo "<p><strong>Next:</strong> Share the 8 specific URLs from Google Search Console showing 404 errors!</p>";
?>