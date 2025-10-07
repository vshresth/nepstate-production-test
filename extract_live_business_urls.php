<?php
/**
 * Extract Business URLs from LIVE Database
 * This script connects to your live Hostinger database to get all actual businesses
 */

// Live database configuration (Hostinger)
$host = 'localhost';
$username = 'u415500770_nepstate';
$password = 'P145DeDevelopers';
$database = 'u415500770_nepstate';

echo "🔍 Connecting to LIVE database to get all businesses...\n\n";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "✅ Connected to live database successfully!\n\n";
    
    // Get all active businesses from live database
    $query = "SELECT slug, title, category, status FROM products 
              WHERE status = 1 
              AND slug IS NOT NULL 
              AND slug != '' 
              ORDER BY category, title";
    
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "📊 Found " . count($businesses) . " businesses in LIVE database:\n\n";
    
    // Display all businesses
    foreach ($businesses as $business) {
        $url = "https://nepstate.com/classified/detail/" . $business['slug'];
        echo "Title: {$business['title']}\n";
        echo "Slug: {$business['slug']}\n";
        echo "Category: {$business['category']}\n";
        echo "URL: {$url}\n";
        echo "---\n";
    }
    
    // Generate URL list for Google Search Console
    echo "\n🎯 Generating URL list for Google Search Console...\n\n";
    
    $urls = [];
    
    // Main pages
    $main_pages = [
        'https://nepstate.com/',
        'https://nepstate.com/classifieds/events',
        'https://nepstate.com/classifieds/jobs',
        'https://nepstate.com/classifieds/services',
        'https://nepstate.com/classifieds/it-trainings',
        'https://nepstate.com/classifieds/roomates-rentals',
        'https://nepstate.com/blog',
        'https://nepstate.com/confessions',
        'https://nepstate.com/forums',
        'https://nepstate.com/about-us',
        'https://nepstate.com/contact-us'
    ];
    
    // Business listings from live database
    $business_urls = [];
    foreach ($businesses as $business) {
        $url = "https://nepstate.com/classified/detail/" . $business['slug'];
        $business_urls[] = $url;
    }
    
    // Combine all URLs
    $all_urls = array_merge($main_pages, $business_urls);
    
    // Create output file
    $output = "# Complete URL List from LIVE Database\n";
    $output .= "# Generated: " . date('Y-m-d H:i:s') . "\n";
    $output .= "# Total URLs: " . count($all_urls) . " (11 main + " . count($businesses) . " businesses)\n\n";
    
    $output .= "# MAIN PAGES\n";
    foreach ($main_pages as $url) {
        $output .= $url . "\n";
    }
    
    $output .= "\n# BUSINESS LISTINGS (From Live Database)\n";
    foreach ($businesses as $business) {
        $url = "https://nepstate.com/classified/detail/" . $business['slug'];
        $output .= $url . " # " . $business['title'] . " (" . $business['category'] . ")\n";
    }
    
    $output .= "\n# CLEAN URL LIST FOR AUTOMATION\n";
    foreach ($all_urls as $url) {
        $output .= $url . "\n";
    }
    
    // Save to file
    file_put_contents('LIVE_DATABASE_URLS.txt', $output);
    
    // Also create simple list
    $simple_list = "# Simple URL List from Live Database\n\n";
    foreach ($all_urls as $url) {
        $simple_list .= $url . "\n";
    }
    file_put_contents('LIVE_SIMPLE_URLS.txt', $simple_list);
    
    echo "✅ URL extraction completed!\n\n";
    echo "📊 Summary:\n";
    echo "   - Main pages: " . count($main_pages) . "\n";
    echo "   - Business listings: " . count($businesses) . "\n";
    echo "   - Total URLs: " . count($all_urls) . "\n\n";
    
    echo "📁 Files generated:\n";
    echo "   1. LIVE_DATABASE_URLS.txt - Detailed list with business names\n";
    echo "   2. LIVE_SIMPLE_URLS.txt - Simple list for copying\n\n";
    
    echo "🎯 Next steps:\n";
    echo "   1. Use LIVE_SIMPLE_URLS.txt with Comet Browser\n";
    echo "   2. Submit all " . count($all_urls) . " URLs to Google Search Console\n";
    echo "   3. Focus on business listings for SEO goals\n";
    
} catch (Exception $e) {
    echo "❌ Error connecting to live database: " . $e->getMessage() . "\n";
    echo "\nThis might be because:\n";
    echo "1. Database credentials are incorrect\n";
    echo "2. Database server is not accessible from your location\n";
    echo "3. Firewall blocking the connection\n\n";
    echo "Alternative: Upload this script to your Hostinger server and run it there.\n";
}
?>
