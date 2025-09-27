<?php
// Dynamic Sitemap Generator
// This generates a sitemap.xml that works for any domain (test or production)

// Get the current domain and protocol
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$domain = $_SERVER['HTTP_HOST'];
$base_url = $protocol . '://' . $domain . '/';

// Set content type to XML
header('Content-Type: application/xml; charset=utf-8');

// Generate sitemap
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";

// Main pages
$pages = [
    '' => '1.00',
    'classifieds/events' => '0.80',
    'classifieds/jobs' => '0.80',
    'classifieds/services' => '0.80',
    'classifieds/it-trainings' => '0.80',
    'classifieds/roomates-rentals' => '0.80',
    'blog' => '0.80',
    'confessions' => '0.80',
    'forums' => '0.80',
    'about-us' => '0.80',
    'contact-us' => '0.80',
    'faq' => '0.80',
    'pages/terms-conditions' => '0.80',
    'pages/privacy-policy' => '0.80',
    'pages/cookie-policy' => '0.80',
    'forgot/password' => '0.80',
    'post-blog' => '0.64',
    'post-confession' => '0.64',
    'post-forum' => '0.64'
];

// Generate URLs
foreach ($pages as $page => $priority) {
    echo '<url>' . "\n";
    echo '<loc>' . $base_url . $page . '</loc>' . "\n";
    echo '<lastmod>' . date('Y-m-d\TH:i:s+00:00') . '</lastmod>' . "\n";
    echo '<priority>' . $priority . '</priority>' . "\n";
    echo '</url>' . "\n";
}

echo '</urlset>';
?>
