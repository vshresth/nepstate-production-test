<?php
/**
 * Dynamic Sitemap Generator for NepState
 * This script generates a complete sitemap including all business listings
 * Run this on your live server to get all current listings
 */

// Database connection - Update these for your live server
$host = 'localhost';
$username = 'u415500770_nepstate';
$password = 'P145DeDevelopers';
$database = 'u415500770_nepstate';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Get all active business listings
    $business_query = "SELECT slug, title, created_at FROM products 
                      WHERE status = 1 
                      AND slug IS NOT NULL 
                      AND slug != '' 
                      ORDER BY id DESC";
    
    $stmt = $pdo->prepare($business_query);
    $stmt->execute();
    $businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get all blog posts
    $blog_query = "SELECT slug, title, created_at FROM blogs 
                   WHERE status = 1 
                   AND slug IS NOT NULL 
                   AND slug != '' 
                   ORDER BY id DESC";
    
    $stmt = $pdo->prepare($blog_query);
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Get all forum posts
    $forum_query = "SELECT slug, title, created_at FROM forums 
                    WHERE status = 1 
                    AND slug IS NOT NULL 
                    AND slug != '' 
                    ORDER BY id DESC";
    
    $stmt = $pdo->prepare($forum_query);
    $stmt->execute();
    $forums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Start building the sitemap
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- Dynamic Sitemap Generated on ' . date('Y-m-d H:i:s') . ' -->
<!-- Total: ' . count($businesses) . ' businesses, ' . count($blogs) . ' blogs, ' . count($forums) . ' forums -->

<!-- Main Pages -->
<url>
<loc>https://nepstate.com/</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>1.00</priority>
</url>

<!-- Category Pages -->
<url>
<loc>https://nepstate.com/classifieds/events</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/jobs</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/services</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/it-trainings</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/roomates-rentals</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>

<!-- Other Main Pages -->
<url>
<loc>https://nepstate.com/blog</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/confessions</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/forums</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/about-us</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/contact-us</loc>
<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>
<priority>0.80</priority>
</url>

<!-- Individual Business Listings (High Priority for Local SEO) -->';
    
    // Add business listings
    foreach ($businesses as $business) {
        $slug = htmlspecialchars($business['slug']);
        $title = htmlspecialchars($business['title']);
        $lastmod = isset($business['created_at']) && $business['created_at'] 
                  ? date('Y-m-d\TH:i:s+00:00', strtotime($business['created_at']))
                  : date('Y-m-d\TH:i:s+00:00');
        
        $sitemap .= '
<!-- ' . $title . ' -->
<url>
<loc>https://nepstate.com/classified/detail/' . $slug . '</loc>
<lastmod>' . $lastmod . '</lastmod>
<priority>0.90</priority>
</url>';
    }
    
    // Add blog posts
    if (count($blogs) > 0) {
        $sitemap .= '

<!-- Blog Posts -->';
        foreach ($blogs as $blog) {
            $slug = htmlspecialchars($blog['slug']);
            $title = htmlspecialchars($blog['title']);
            $lastmod = isset($blog['created_at']) && $blog['created_at'] 
                      ? date('Y-m-d\TH:i:s+00:00', strtotime($blog['created_at']))
                      : date('Y-m-d\TH:i:s+00:00');
            
            $sitemap .= '
<!-- ' . $title . ' -->
<url>
<loc>https://nepstate.com/blog/details/' . $slug . '</loc>
<lastmod>' . $lastmod . '</lastmod>
<priority>0.70</priority>
</url>';
        }
    }
    
    // Add forum posts
    if (count($forums) > 0) {
        $sitemap .= '

<!-- Forum Posts -->';
        foreach ($forums as $forum) {
            $slug = htmlspecialchars($forum['slug']);
            $title = htmlspecialchars($forum['title']);
            $lastmod = isset($forum['created_at']) && $forum['created_at'] 
                      ? date('Y-m-d\TH:i:s+00:00', strtotime($forum['created_at']))
                      : date('Y-m-d\TH:i:s+00:00');
            
            $sitemap .= '
<!-- ' . $title . ' -->
<url>
<loc>https://nepstate.com/forums/details/' . $slug . '</loc>
<lastmod>' . $lastmod . '</lastmod>
<priority>0.70</priority>
</url>';
        }
    }
    
    $sitemap .= '

</urlset>';
    
    // Save the sitemap
    file_put_contents('sitemap.xml', $sitemap);
    
    echo "✅ Dynamic sitemap generated successfully!\n";
    echo "📊 Statistics:\n";
    echo "   - Business listings: " . count($businesses) . "\n";
    echo "   - Blog posts: " . count($blogs) . "\n";
    echo "   - Forum posts: " . count($forums) . "\n";
    echo "   - Total URLs: " . (count($businesses) + count($blogs) + count($forums) + 10) . "\n";
    echo "📁 Saved to: sitemap.xml\n";
    echo "🔄 Next: Resubmit to Google Search Console\n";
    
} catch (PDOException $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
    echo "Please update the database connection details in this script.\n";
}
?>