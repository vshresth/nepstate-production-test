<?php
/**
 * Check Business URLs in Database
 * This script will show us what businesses exist and their correct URLs
 */

// Database configuration
$host = 'localhost';
$username = 'u415500770_nepstate';
$password = 'P145DeDevelopers';
$database = 'u415500770_nepstate';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🔍 Checking businesses in database...\n\n";
    
    // Get all businesses with their details
    $query = "SELECT id, slug, title, category, status, created_at FROM products WHERE slug IS NOT NULL AND slug != '' ORDER BY id DESC";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "📊 Found " . count($businesses) . " businesses in database:\n\n";
    
    foreach ($businesses as $business) {
        $url = "https://nepstate.com/classified/detail/" . $business['slug'];
        echo "ID: {$business['id']}\n";
        echo "Title: {$business['title']}\n";
        echo "Slug: {$business['slug']}\n";
        echo "Category: {$business['category']}\n";
        echo "Status: {$business['status']}\n";
        echo "URL: {$url}\n";
        echo "Created: {$business['created_at']}\n";
        echo "---\n\n";
    }
    
    // Check specifically for Beni Ko Bazar
    echo "🔍 Looking for 'Beni Ko Bazar' specifically...\n";
    $query = "SELECT * FROM products WHERE title LIKE '%beni%' OR slug LIKE '%beni%'";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $beni_businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($beni_businesses) > 0) {
        echo "✅ Found Beni Ko Bazar businesses:\n";
        foreach ($beni_businesses as $business) {
            echo "Title: {$business['title']}\n";
            echo "Slug: {$business['slug']}\n";
            echo "URL: https://nepstate.com/classified/detail/{$business['slug']}\n";
            echo "Status: {$business['status']}\n\n";
        }
    } else {
        echo "❌ No businesses found with 'beni' in title or slug\n";
        echo "This explains why the URL has a redirect error!\n";
    }
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
