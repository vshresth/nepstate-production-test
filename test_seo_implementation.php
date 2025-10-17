<?php
/**
 * SEO Implementation Test Script
 * Tests the structured data and meta tag functions
 */

// Include CodeIgniter bootstrap
require_once 'index.php';

// Get CI instance
$CI =& get_instance();

echo "<h1>NepState SEO Implementation Test</h1>\n";

// Test 1: Organization Structured Data
echo "<h2>Test 1: Organization Structured Data</h2>\n";
$org_data = generate_structured_data('organization');
if ($org_data) {
    echo "<pre>" . json_encode($org_data, JSON_PRETTY_PRINT) . "</pre>\n";
} else {
    echo "❌ Organization structured data failed\n";
}

// Test 2: Website Structured Data
echo "<h2>Test 2: Website Structured Data</h2>\n";
$website_data = generate_structured_data('website');
if ($website_data) {
    echo "<pre>" . json_encode($website_data, JSON_PRETTY_PRINT) . "</pre>\n";
} else {
    echo "❌ Website structured data failed\n";
}

// Test 3: LocalBusiness Structured Data
echo "<h2>Test 3: LocalBusiness Structured Data</h2>\n";
$business_data = [
    'name' => 'Test Nepali Restaurant',
    'description' => 'Authentic Nepali cuisine in the heart of the city',
    'address' => '123 Main St',
    'city' => 'Dallas',
    'state' => 'TX',
    'zipcode' => '75201',
    'country' => 'USA',
    'phone' => '(555) 123-4567',
    'email' => 'info@testrestaurant.com',
    'image' => 'https://example.com/restaurant.jpg'
];

$local_business = generate_structured_data('localbusiness', $business_data);
if ($local_business) {
    echo "<pre>" . json_encode($local_business, JSON_PRETTY_PRINT) . "</pre>\n";
} else {
    echo "❌ LocalBusiness structured data failed\n";
}

// Test 4: Breadcrumb Structured Data
echo "<h2>Test 4: Breadcrumb Structured Data</h2>\n";
$breadcrumb_items = [
    ['name' => 'Home', 'url' => base_url()],
    ['name' => 'Services', 'url' => base_url() . 'classifieds/services'],
    ['name' => 'Test Business', 'url' => base_url() . 'classified/detail/test-business']
];

$breadcrumb = generate_structured_data('breadcrumb', ['items' => $breadcrumb_items]);
if ($breadcrumb) {
    echo "<pre>" . json_encode($breadcrumb, JSON_PRETTY_PRINT) . "</pre>\n";
} else {
    echo "❌ Breadcrumb structured data failed\n";
}

// Test 5: Meta Tags Generation
echo "<h2>Test 5: Meta Tags Generation</h2>\n";
$meta_tags = generate_meta_tags(
    'Test Page Title',
    'Test meta description for SEO',
    'test, keywords, seo',
    'https://example.com/image.jpg',
    'article'
);

if ($meta_tags) {
    echo "<pre>" . print_r($meta_tags, true) . "</pre>\n";
} else {
    echo "❌ Meta tags generation failed\n";
}

// Test 6: Database Connection Test
echo "<h2>Test 6: Database Connection Test</h2>\n";
try {
    $test_query = $CI->db->query("SELECT COUNT(*) as count FROM categories WHERE status = 1");
    $result = $test_query->row();
    echo "✅ Database connection successful. Found {$result->count} active categories.\n";
} catch (Exception $e) {
    echo "❌ Database connection failed: " . $e->getMessage() . "\n";
}

// Test 7: Sitemap Generator Test
echo "<h2>Test 7: Sitemap Generator Test</h2>\n";
$sitemap_file = 'sitemap_generator.php';
if (file_exists($sitemap_file)) {
    echo "✅ Sitemap generator file exists at: {$sitemap_file}\n";
} else {
    echo "❌ Sitemap generator file not found\n";
}

// Test 8: Robots.txt Test
echo "<h2>Test 8: Robots.txt Test</h2>\n";
$robots_file = 'robots.txt';
if (file_exists($robots_file)) {
    $robots_content = file_get_contents($robots_file);
    if (strpos($robots_content, 'Sitemap:') !== false) {
        echo "✅ Robots.txt contains sitemap references\n";
    } else {
        echo "❌ Robots.txt missing sitemap references\n";
    }
} else {
    echo "❌ Robots.txt file not found\n";
}

echo "<h2>SEO Implementation Test Complete</h2>\n";
echo "<p>If all tests show ✅, your SEO implementation is working correctly!</p>\n";
?>
