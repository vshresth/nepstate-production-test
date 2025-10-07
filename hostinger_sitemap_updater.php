<?php
/**
 * Hostinger-Optimized Sitemap Updater
 * Specifically designed for Hostinger hosting environment
 * Run via Hostinger Control Panel Cron Jobs
 */

// Hostinger-specific configuration
$config = [
    'database' => [
        'host' => 'localhost',
        'username' => 'u415500770_nepstate',
        'password' => 'P145DeDevelopers',
        'database' => 'u415500770_nepstate'
    ],
    'paths' => [
        'base_path' => '/home/u415500770/domains/nepstate.com/public_html',
        'sitemap_file' => 'sitemap.xml',
        'backup_dir' => 'sitemap_backups/',
        'log_file' => 'logs/sitemap_update.log'
    ],
    'site' => [
        'url' => 'https://nepstate.com',
        'email' => 'admin@nepstate.com' // Change to your email
    ]
];

// Ensure directories exist
$base_path = $config['paths']['base_path'];
$backup_dir = $base_path . '/' . $config['paths']['backup_dir'];
$log_dir = $base_path . '/' . 'logs';

if (!is_dir($backup_dir)) {
    mkdir($backup_dir, 0755, true);
}
if (!is_dir($log_dir)) {
    mkdir($log_dir, 0755, true);
}

// Logging function
function log_message($message, $log_file) {
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] {$message}\n";
    file_put_contents($log_file, $log_entry, FILE_APPEND | LOCK_EX);
    
    // Also output to browser if running manually
    if (isset($_SERVER['HTTP_HOST'])) {
        echo $log_entry . "<br>";
    }
}

try {
    log_message("🚀 Starting Hostinger sitemap update", $config['paths']['log_file']);
    
    // Connect to database
    $pdo = new PDO(
        "mysql:host={$config['database']['host']};dbname={$config['database']['database']}", 
        $config['database']['username'], 
        $config['database']['password']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    log_message("✅ Connected to database successfully", $config['paths']['log_file']);
    
    // Backup current sitemap
    $sitemap_path = $base_path . '/' . $config['paths']['sitemap_file'];
    if (file_exists($sitemap_path)) {
        $backup_name = $backup_dir . 'sitemap_backup_' . date('Y-m-d_H-i-s') . '.xml';
        copy($sitemap_path, $backup_name);
        log_message("📁 Backed up current sitemap", $config['paths']['log_file']);
    }
    
    // Get statistics
    $stats = [];
    
    // Count businesses
    $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM products WHERE status = 1 AND slug IS NOT NULL AND slug != ''");
    $stmt->execute();
    $stats['businesses'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    // Count blogs (if table exists)
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM blogs WHERE status = 1 AND slug IS NOT NULL AND slug != ''");
        $stmt->execute();
        $stats['blogs'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    } catch (Exception $e) {
        $stats['blogs'] = 0;
        log_message("⚠️  Blogs table not found or accessible, skipping", $config['paths']['log_file']);
    }
    
    // Count forums (if table exists)
    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM forums WHERE status = 1 AND slug IS NOT NULL AND slug != ''");
        $stmt->execute();
        $stats['forums'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    } catch (Exception $e) {
        $stats['forums'] = 0;
        log_message("⚠️  Forums table not found or accessible, skipping", $config['paths']['log_file']);
    }
    
    log_message("📊 Found: {$stats['businesses']} businesses, {$stats['blogs']} blogs, {$stats['forums']} forums", $config['paths']['log_file']);
    
    // Generate new sitemap
    $sitemap_content = generate_sitemap($pdo, $stats, $config);
    
    // Save new sitemap
    file_put_contents($sitemap_path, $sitemap_content);
    log_message("💾 Generated new sitemap successfully", $config['paths']['log_file']);
    
    // Cleanup old backups (keep last 30 days)
    cleanup_old_backups($backup_dir, 30);
    
    $total_urls = $stats['businesses'] + $stats['blogs'] + $stats['forums'] + 15;
    log_message("✅ Sitemap update completed! Total URLs: {$total_urls}", $config['paths']['log_file']);
    
    // Send email notification (optional)
    if (function_exists('mail')) {
        $subject = "NepState Sitemap Updated Successfully";
        $message = "Sitemap updated on " . date('Y-m-d H:i:s') . "\n\n";
        $message .= "Statistics:\n";
        $message .= "- Businesses: {$stats['businesses']}\n";
        $message .= "- Blogs: {$stats['blogs']}\n";
        $message .= "- Forums: {$stats['forums']}\n";
        $message .= "- Total URLs: {$total_urls}\n\n";
        $message .= "Sitemap URL: {$config['site']['url']}/sitemap.xml";
        
        mail($config['site']['email'], $subject, $message);
        log_message("📧 Email notification sent", $config['paths']['log_file']);
    }
    
} catch (Exception $e) {
    log_message("❌ Error: " . $e->getMessage(), $config['paths']['log_file']);
    
    // Send error email
    if (function_exists('mail')) {
        $subject = "NepState Sitemap Update Failed";
        $message = "Sitemap update failed on " . date('Y-m-d H:i:s') . "\n\n";
        $message .= "Error: " . $e->getMessage() . "\n\n";
        $message .= "Please check the logs for more details.";
        
        mail($config['site']['email'], $subject, $message);
    }
    
    exit(1);
}

function generate_sitemap($pdo, $stats, $config) {
    $current_time = date('Y-m-d\TH:i:s+00:00');
    
    $sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
<!-- Hostinger Auto-generated sitemap - Generated on ' . date('Y-m-d H:i:s') . ' -->
<!-- Total: ' . $stats['businesses'] . ' businesses, ' . $stats['blogs'] . ' blogs, ' . $stats['forums'] . ' forums -->

<!-- Main Pages -->
<url>
<loc>' . $config['site']['url'] . '/</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>1.00</priority>
</url>

<!-- Category Pages -->
<url>
<loc>' . $config['site']['url'] . '/classifieds/events</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/classifieds/jobs</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/classifieds/services</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/classifieds/it-trainings</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/classifieds/roomates-rentals</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>

<!-- Other Main Pages -->
<url>
<loc>' . $config['site']['url'] . '/blog</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/confessions</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/forums</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/about-us</loc>
<lastmod>' . $current_time . '</lastmod>
<priority>0.80</priority>
</url>
<url>
<loc>' . $config['site']['url'] . '/contact-us</loc>
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
<loc>' . $config['site']['url'] . '/classified/detail/' . $slug . '</loc>
<lastmod>' . $lastmod . '</lastmod>
<priority>0.90</priority>
</url>';
    }
    
    // Add blog posts (if table exists)
    try {
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
<loc>' . $config['site']['url'] . '/blog/details/' . $slug . '</loc>
<lastmod>' . $lastmod . '</lastmod>
<priority>0.70</priority>
</url>';
            }
        }
    } catch (Exception $e) {
        // Blogs table doesn't exist or accessible, skip
    }
    
    // Add forum posts (if table exists)
    try {
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
<loc>' . $config['site']['url'] . '/forums/details/' . $slug . '</loc>
<lastmod>' . $lastmod . '</lastmod>
<priority>0.70</priority>
</url>';
            }
        }
    } catch (Exception $e) {
        // Forums table doesn't exist or accessible, skip
    }
    
    $sitemap .= '

</urlset>';
    
    return $sitemap;
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
