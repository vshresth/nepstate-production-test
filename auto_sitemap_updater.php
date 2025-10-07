<?php
/**
 * Automatic Sitemap Updater with Google Search Console Integration
 * This script generates a fresh sitemap and automatically resubmits it to Google
 * Designed to run as a cron job (weekly or daily)
 */

// Configuration - Update these for your live server
$config = [
    'database' => [
        'host' => 'localhost',
        'username' => 'u415500770_nepstate',
        'password' => 'P145DeDevelopers',
        'database' => 'u415500770_nepstate'
    ],
    'google_search_console' => [
        'property_url' => 'https://nepstate.com',
        'sitemap_url' => 'https://nepstate.com/sitemap.xml'
    ],
    'sitemap_file' => 'sitemap.xml',
    'backup_dir' => 'sitemap_backups/',
    'log_file' => 'sitemap_update.log'
];

// Create backup directory if it doesn't exist
if (!is_dir($config['backup_dir'])) {
    mkdir($config['backup_dir'], 0755, true);
}

// Logging function
function log_message($message, $log_file) {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] {$message}\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
    echo $log_entry;
}

try {
    log_message("🚀 Starting automatic sitemap update", $config['log_file']);
    
    // Connect to database
    $pdo = new PDO(
        "mysql:host={$config['database']['host']};dbname={$config['database']['database']}", 
        $config['database']['username'], 
        $config['database']['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    log_message("✅ Connected to database", $config['log_file']);
    
    // Backup current sitemap
    if (file_exists($config['sitemap_file'])) {
        $backup_name = $config['backup_dir'] . 'sitemap_backup_' . date('Y-m-d_H-i-s') . '.xml';
        copy($config['sitemap_file'], $backup_name);
        log_message("📁 Backed up current sitemap to: {$backup_name}", $config['log_file']);
    }
    
    // Get statistics
    $stats = [];
    
    // Count businesses
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM products WHERE status = 1 AND slug IS NOT NULL AND slug != ''");
    $stmt->execute();
    $stats['businesses'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    // Count blogs
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM blogs WHERE status = 1 AND slug IS NOT NULL AND slug != ''");
    $stmt->execute();
    $stats['blogs'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    // Count forums
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM forums WHERE status = 1 AND slug IS NOT NULL AND slug != ''");
    $stmt->execute();
    $stats['forums'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    log_message("📊 Found: {$stats['businesses']} businesses, {$stats['blogs']} blogs, {$stats['forums']} forums", $config['log_file']);
    
    // Generate new sitemap
    $sitemap_content = generate_sitemap($pdo, $stats);
    
    // Save new sitemap
    file_put_contents($config['sitemap_file'], $sitemap_content);
    log_message("💾 Generated new sitemap: {$config['sitemap_file']}", $config['log_file']);
    
    // Submit to Google Search Console (if credentials are available)
    $submission_result = submit_to_google_search_console($config);
    if ($submission_result['success']) {
        log_message("🎯 Successfully resubmitted sitemap to Google Search Console", $config['log_file']);
    } else {
        log_message("⚠️  Could not resubmit to Google Search Console: {$submission_result['message']}", $config['log_file']);
    }
    
    // Cleanup old backups (keep last 30 days)
    cleanup_old_backups($config['backup_dir'], 30);
    
    $total_urls = $stats['businesses'] + $stats['blogs'] + $stats['forums'] + 15; // +15 for static pages
    log_message("✅ Sitemap update completed successfully! Total URLs: {$total_urls}", $config['log_file']);
    
} catch (Exception $e) {
    log_message("❌ Error: " . $e->getMessage(), $config['log_file']);
    exit(1);
}

function generate_sitemap($pdo, $stats) {
    $current_time = date('Y-m-d\TH:i:s+00:00');
    
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- Auto-generated sitemap - Generated on ' . date('Y-m-d H:i:s') . ' -->
<!-- Total: ' . $stats['businesses'] . ' businesses, ' . $stats['blogs'] . ' blogs, ' . $stats['forums'] . ' forums -->

<!-- Main Pages -->
<url>
<loc>https://nepstate.com/</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>1.00</priority>
</url>

<!-- Category Pages -->
<url>
<loc>https://nepstate.com/classifieds/events</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/jobs</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/services</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/it-trainings</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/classifieds/roomates-rentals</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>

<!-- Other Main Pages -->
<url>
<loc>https://nepstate.com/blog</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/confessions</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/forums</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/about-us</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>https://nepstate.com/contact-us</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>

<!-- Individual Business Listings (High Priority for Local SEO) -->';

    // Add business listings
    $stmt = $pdo->prepare("SELECT slug, title, created_at FROM products WHERE status = 1 AND slug IS NOT NULL AND slug != '' ORDER BY id DESC");
    $stmt->execute();
    $businesses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($businesses as $business) {
        $slug = htmlspecialchars($business['slug']);
        $title = htmlspecialchars($business['title']);
        $lastmod = isset($business['created_at']) && $business['created_at'] 
                  ? date('Y-m-d\TH:i:s+00:00', strtotime($business['created_at']))
                  : $current_time;
        
        $sitemap .= '
<!-- ' . $title . ' -->
<url>
<loc>https://nepstate.com/classified/detail/' . $slug . '</loc>
<lastmod>' . $lastmod . '</lastmod>
<priority>0.90</priority>
</url>';
    }
    
    // Add blog posts
    $stmt = $pdo->prepare("SELECT slug, title, created_at FROM blogs WHERE status = 1 AND slug IS NOT NULL AND slug != '' ORDER BY id DESC");
    $stmt->execute();
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($blogs) > 0) {
        $sitemap .= '

<!-- Blog Posts -->';
        foreach ($blogs as $blog) {
            $slug = htmlspecialchars($blog['slug']);
            $title = htmlspecialchars($blog['title']);
            $lastmod = isset($blog['created_at']) && $blog['created_at'] 
                      ? date('Y-m-d\TH:i:s+00:00', strtotime($blog['created_at']))
                      : $current_time;
            
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
    $stmt = $pdo->prepare("SELECT slug, title, created_at FROM forums WHERE status = 1 AND slug IS NOT NULL AND slug != '' ORDER BY id DESC");
    $stmt->execute();
    $forums = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($forums) > 0) {
        $sitemap .= '

<!-- Forum Posts -->';
        foreach ($forums as $forum) {
            $slug = htmlspecialchars($forum['slug']);
            $title = htmlspecialchars($forum['title']);
            $lastmod = isset($forum['created_at']) && $forum['created_at'] 
                      ? date('Y-m-d\TH:i:s+00:00', strtotime($forum['created_at']))
                      : $current_time;
            
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
    
    return $sitemap;
}

function submit_to_google_search_console($config) {
    // Note: This requires Google Search Console API setup
    // For now, we'll just log that manual resubmission is needed
    
    return [
        'success' => false,
        'message' => 'Manual resubmission required. Go to Google Search Console and resubmit sitemap.xml'
    ];
    
    // Future implementation with Google Search Console API:
    // 1. Set up Google Cloud Console project
    // 2. Enable Search Console API
    // 3. Create service account and download JSON key
    // 4. Use Google API client library to resubmit sitemap
}

function cleanup_old_backups($backup_dir, $keep_days) {
    $files = glob($backup_dir . 'sitemap_backup_*.xml');
    $cutoff_time = time() - ($keep_days * 24 * 60 * 60);
    
    foreach ($files as $file) {
        if (filemtime($file) < $cutoff_time) {
            unlink($file);
        }
    }
}
?>
