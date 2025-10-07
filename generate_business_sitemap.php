<?php
/**
 * Generate Business Listings Sitemap
 * This script will create sitemap entries for all active business listings
 */

// Database connection (adjust these values for your local setup)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'u415500770_nepstate';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to database successfully.\n";
    
    // First, let's see what we have in the products table
    $count_query = "SELECT COUNT(*) as total FROM products";
    $stmt = $pdo->prepare($count_query);
    $stmt->execute();
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    echo "Total products in database: {$total}\n";
    
    // Check status distribution
    $status_query = "SELECT status, COUNT(*) as count FROM products GROUP BY status";
    $stmt = $pdo->prepare($status_query);
    $stmt->execute();
    $status_counts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Status distribution:\n";
    foreach ($status_counts as $status) {
        echo "  Status {$status['status']}: {$status['count']} products\n";
    }
    
    // Check slug distribution
    $slug_query = "SELECT 
        COUNT(*) as total_with_slug,
        COUNT(CASE WHEN slug IS NULL OR slug = '' THEN 1 END) as empty_slugs
        FROM products";
    $stmt = $pdo->prepare($slug_query);
    $stmt->execute();
    $slug_stats = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Slug stats: {$slug_stats['total_with_slug']} with slugs, {$slug_stats['empty_slugs']} empty\n";
    
    // Get all business listings (relaxed conditions)
    $query = "SELECT slug, title, created_at, status, expiry_date FROM products 
              WHERE slug IS NOT NULL 
              AND slug != '' 
              ORDER BY id DESC 
              LIMIT 50";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $listings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "Found " . count($listings) . " active business listings.\n\n";
    
    // Generate sitemap entries
    $sitemap_entries = '';
    $current_date = date('Y-m-d\TH:i:s+00:00');
    
    foreach ($listings as $listing) {
        $slug = htmlspecialchars($listing['slug']);
        $title = htmlspecialchars($listing['title']);
        $lastmod = isset($listing['created_at']) && $listing['created_at'] 
                  ? date('Y-m-d\TH:i:s+00:00', strtotime($listing['created_at']))
                  : $current_date;
        
        $sitemap_entries .= "<!-- {$title} -->\n";
        $sitemap_entries .= "<url>\n";
        $sitemap_entries .= "<loc>https://nepstate.com/classified/detail/{$slug}</loc>\n";
        $sitemap_entries .= "<lastmod>{$lastmod}</lastmod>\n";
        $sitemap_entries .= "<priority>0.90</priority>\n";
        $sitemap_entries .= "</url>\n\n";
        
        echo "Added: {$title} -> /classified/detail/{$slug}\n";
    }
    
    // Save to file
    $output_file = 'business_listings_sitemap.xml';
    file_put_contents($output_file, $sitemap_entries);
    
    echo "\n✅ Generated sitemap entries for " . count($listings) . " business listings.\n";
    echo "📁 Saved to: {$output_file}\n";
    echo "📋 Copy these entries and add them to your main sitemap.xml file.\n";
    
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage() . "\n";
    echo "\nPlease update the database connection details in this script:\n";
    echo "- Host: {$host}\n";
    echo "- Username: {$username}\n";
    echo "- Database: {$database}\n";
}
?>
