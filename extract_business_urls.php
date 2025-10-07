<?php
/**
 * Extract All Business URLs for Google Search Console
 * This script generates a complete list of all business URLs
 * that you can use in Google Search Console URL Inspection tool
 */

// Database configuration
$host = 'localhost';
$username = 'u415500770_nepstate';
$password = 'P145DeDevelopers';
$database = 'u415500770_nepstate';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "🚀 Extracting all business URLs for Google Search Console...\n\n";
    
    // Get all business listings
    $query = "SELECT slug, title, category FROM products WHERE status = 1 AND slug IS NOT NULL AND slug != '' ORDER BY category, title";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get blog posts
    $blogs = [];
    try {
        $blog_query = "SELECT slug, title FROM blogs WHERE status = 1 AND slug IS NOT NULL AND slug != '' ORDER BY title";
        $stmt = $pdo->prepare($blog_query);
        $stmt->execute();
        $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "⚠️  Blogs table not found, skipping blogs\n";
    }
    
    // Generate URL list
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
    
    // Business listings
    $business_urls = [];
    foreach ($businesses as $business) {
        $url = "https://nepstate.com/classified/detail/" . $business['slug'];
        $business_urls[] = $url;
    }
    
    // Blog URLs
    $blog_urls = [];
    foreach ($blogs as $blog) {
        $url = "https://nepstate.com/blog/details/" . $blog['slug'];
        $blog_urls[] = $url;
    }
    
    // Combine all URLs
    $all_urls = array_merge($main_pages, $business_urls, $blog_urls);
    
    // Generate output files
    $output = "# Complete URL List for Google Search Console\n";
    $output .= "# Generated on: " . date('Y-m-d H:i:s') . "\n";
    $output .= "# Total URLs: " . count($all_urls) . "\n\n";
    
    $output .= "# MAIN PAGES (Priority 1 - Submit First)\n";
    foreach ($main_pages as $url) {
        $output .= $url . "\n";
    }
    
    $output .= "\n# BUSINESS LISTINGS (Priority 2 - Submit Next)\n";
    $output .= "# Total businesses: " . count($businesses) . "\n";
    foreach ($businesses as $index => $business) {
        $url = "https://nepstate.com/classified/detail/" . $business['slug'];
        $output .= $url . " # " . $business['title'] . " (" . $business['category'] . ")\n";
    }
    
    if (count($blog_urls) > 0) {
        $output .= "\n# BLOG POSTS (Priority 3)\n";
        $output .= "# Total blogs: " . count($blogs) . "\n";
        foreach ($blogs as $index => $blog) {
            $url = "https://nepstate.com/blog/details/" . $blog['slug'];
            $output .= $url . " # " . $blog['title'] . "\n";
        }
    }
    
    $output .= "\n# INSTRUCTIONS:\n";
    $output .= "# 1. Go to Google Search Console\n";
    $output .= "# 2. Click 'URL Inspection' tool\n";
    $output .= "# 3. Copy each URL above\n";
    $output .= "# 4. Paste and click 'Request Indexing'\n";
    $output .= "# 5. Start with MAIN PAGES first\n";
    $output .= "# 6. Then submit BUSINESS LISTINGS\n";
    $output .= "# 7. Finally submit BLOG POSTS\n\n";
    
    $output .= "# AUTOMATION OPTION:\n";
    $output .= "# Use Google Search Console API or browser automation\n";
    $output .= "# to submit all URLs automatically\n";
    
    // Save to file
    file_put_contents('google_search_console_urls.txt', $output);
    
    // Also create a simple list for easy copying
    $simple_list = "# Simple URL List (Copy & Paste)\n\n";
    foreach ($all_urls as $url) {
        $simple_list .= $url . "\n";
    }
    file_put_contents('simple_url_list.txt', $simple_list);
    
    // Generate JSON for automation
    $json_data = [
        'generated_at' => date('Y-m-d H:i:s'),
        'total_urls' => count($all_urls),
        'main_pages' => $main_pages,
        'business_listings' => $business_urls,
        'blog_posts' => $blog_urls,
        'all_urls' => $all_urls
    ];
    file_put_contents('urls_for_automation.json', json_encode($json_data, JSON_PRETTY_PRINT));
    
    // Display summary
    echo "✅ URL extraction completed!\n\n";
    echo "📊 Summary:\n";
    echo "   - Main pages: " . count($main_pages) . "\n";
    echo "   - Business listings: " . count($businesses) . "\n";
    echo "   - Blog posts: " . count($blogs) . "\n";
    echo "   - Total URLs: " . count($all_urls) . "\n\n";
    
    echo "📁 Files generated:\n";
    echo "   1. google_search_console_urls.txt - Detailed list with instructions\n";
    echo "   2. simple_url_list.txt - Simple list for copying\n";
    echo "   3. urls_for_automation.json - JSON format for automation\n\n";
    
    echo "🎯 Next steps:\n";
    echo "   1. Open google_search_console_urls.txt\n";
    echo "   2. Copy URLs to Google Search Console URL Inspection\n";
    echo "   3. Start with MAIN PAGES first\n";
    echo "   4. Then submit BUSINESS LISTINGS\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
?>
