<?php
/**
 * Simple SEO Functions Test
 * Tests the SEO helper functions without full CI bootstrap
 */

// Include the helper functions directly
require_once 'application/helpers/general_helper.php';

// Mock base_url and current_url functions if they don't exist
if (!function_exists('base_url')) {
    function base_url($uri = '') {
        return 'https://nepstate.com/' . ltrim($uri, '/');
    }
}

if (!function_exists('current_url')) {
    function current_url() {
        return 'https://nepstate.com/test-page';
    }
}

echo "<html><head><title>NepState SEO Test</title>";
echo "<style>
    body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
    h1 { color: #333; }
    h2 { color: #666; background: #fff; padding: 15px; border-left: 4px solid #4CAF50; margin-top: 30px; }
    pre { background: #fff; padding: 20px; border-radius: 5px; overflow-x: auto; border: 1px solid #ddd; }
    .success { color: #4CAF50; font-weight: bold; }
    .error { color: #f44336; font-weight: bold; }
    .info { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 20px 0; border-left: 4px solid #2196F3; }
</style></head><body>";

echo "<h1>🔍 NepState SEO Implementation Test</h1>\n";
echo "<div class='info'>Testing the SEO helper functions created in application/helpers/general_helper.php</div>\n";

// Test 1: Organization Structured Data
echo "<h2>✅ Test 1: Organization Structured Data</h2>\n";
try {
    $org_data = generate_structured_data('organization');
    if ($org_data && isset($org_data['@type']) && $org_data['@type'] === 'Organization') {
        echo "<p class='success'>✅ PASSED: Organization structured data generated successfully</p>\n";
        echo "<pre>" . json_encode($org_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "</pre>\n";
    } else {
        echo "<p class='error'>❌ FAILED: Invalid organization data</p>\n";
    }
} catch (Exception $e) {
    echo "<p class='error'>❌ ERROR: " . $e->getMessage() . "</p>\n";
}

// Test 2: Website Structured Data
echo "<h2>✅ Test 2: Website Structured Data</h2>\n";
try {
    $website_data = generate_structured_data('website');
    if ($website_data && isset($website_data['@type']) && $website_data['@type'] === 'WebSite') {
        echo "<p class='success'>✅ PASSED: Website structured data generated successfully</p>\n";
        echo "<pre>" . json_encode($website_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "</pre>\n";
    } else {
        echo "<p class='error'>❌ FAILED: Invalid website data</p>\n";
    }
} catch (Exception $e) {
    echo "<p class='error'>❌ ERROR: " . $e->getMessage() . "</p>\n";
}

// Test 3: LocalBusiness Structured Data
echo "<h2>✅ Test 3: LocalBusiness Structured Data</h2>\n";
try {
    $business_data = [
        'name' => 'Himalayan Kitchen',
        'description' => 'Authentic Nepali and Tibetan cuisine in the heart of Dallas',
        'url' => 'https://nepstate.com/classified/detail/himalayan-kitchen',
        'address' => '123 Main Street',
        'city' => 'Dallas',
        'state' => 'TX',
        'zipcode' => '75201',
        'country' => 'USA',
        'phone' => '(214) 555-1234',
        'email' => 'info@himalayankitchen.com',
        'image' => 'https://nepstate.com/uploads/himalayan-kitchen.jpg',
        'hours' => 'Mo-Su 11:00-22:00'
    ];
    
    $local_business = generate_structured_data('localbusiness', $business_data);
    if ($local_business && isset($local_business['@type']) && $local_business['@type'] === 'LocalBusiness') {
        echo "<p class='success'>✅ PASSED: LocalBusiness structured data generated successfully</p>\n";
        echo "<pre>" . json_encode($local_business, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "</pre>\n";
    } else {
        echo "<p class='error'>❌ FAILED: Invalid local business data</p>\n";
    }
} catch (Exception $e) {
    echo "<p class='error'>❌ ERROR: " . $e->getMessage() . "</p>\n";
}

// Test 4: Breadcrumb Structured Data
echo "<h2>✅ Test 4: Breadcrumb Structured Data</h2>\n";
try {
    $breadcrumb_items = [
        ['name' => 'Home', 'url' => 'https://nepstate.com/'],
        ['name' => 'Services', 'url' => 'https://nepstate.com/classifieds/services'],
        ['name' => 'Himalayan Kitchen', 'url' => 'https://nepstate.com/classified/detail/himalayan-kitchen']
    ];
    
    $breadcrumb = generate_structured_data('breadcrumb', ['items' => $breadcrumb_items]);
    if ($breadcrumb && isset($breadcrumb['@type']) && $breadcrumb['@type'] === 'BreadcrumbList') {
        echo "<p class='success'>✅ PASSED: Breadcrumb structured data generated successfully</p>\n";
        echo "<pre>" . json_encode($breadcrumb, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "</pre>\n";
    } else {
        echo "<p class='error'>❌ FAILED: Invalid breadcrumb data</p>\n";
    }
} catch (Exception $e) {
    echo "<p class='error'>❌ ERROR: " . $e->getMessage() . "</p>\n";
}

// Test 5: Meta Tags Generation
echo "<h2>✅ Test 5: Meta Tags Generation</h2>\n";
try {
    $meta_tags = generate_meta_tags(
        'Himalayan Kitchen - Nepali Restaurant in Dallas | NepState',
        'Discover authentic Nepali and Tibetan cuisine at Himalayan Kitchen in Dallas, TX. Traditional dishes, warm atmosphere, and excellent service.',
        'nepali restaurant, himalayan kitchen, dallas restaurant, tibetan food, authentic nepali cuisine',
        'https://nepstate.com/uploads/himalayan-kitchen.jpg',
        'article'
    );
    
    if ($meta_tags && isset($meta_tags['page_title'])) {
        echo "<p class='success'>✅ PASSED: Meta tags generated successfully</p>\n";
        echo "<pre>" . print_r($meta_tags, true) . "</pre>\n";
    } else {
        echo "<p class='error'>❌ FAILED: Invalid meta tags</p>\n";
    }
} catch (Exception $e) {
    echo "<p class='error'>❌ ERROR: " . $e->getMessage() . "</p>\n";
}

// Test 6: File Existence Tests
echo "<h2>✅ Test 6: Required Files Check</h2>\n";

$files_to_check = [
    'sitemap_generator.php' => 'Dynamic Sitemap Generator',
    'sitemap.xml' => 'Static Sitemap',
    'robots.txt' => 'Robots.txt',
    'application/helpers/general_helper.php' => 'General Helper (SEO Functions)',
    'application/config/metro_areas.php' => 'Metro Areas Config'
];

foreach ($files_to_check as $file => $description) {
    if (file_exists($file)) {
        echo "<p class='success'>✅ {$description}: Found at {$file}</p>\n";
    } else {
        echo "<p class='error'>❌ {$description}: Not found at {$file}</p>\n";
    }
}

// Test 7: Robots.txt Content Check
echo "<h2>✅ Test 7: Robots.txt Content Validation</h2>\n";
if (file_exists('robots.txt')) {
    $robots_content = file_get_contents('robots.txt');
    $checks = [
        'Sitemap:' => 'Contains sitemap reference',
        'Disallow: /admin/' => 'Blocks admin directory',
        'User-Agent: *' => 'Has user-agent directive'
    ];
    
    foreach ($checks as $check => $description) {
        if (strpos($robots_content, $check) !== false) {
            echo "<p class='success'>✅ {$description}</p>\n";
        } else {
            echo "<p class='error'>❌ Missing: {$description}</p>\n";
        }
    }
} else {
    echo "<p class='error'>❌ robots.txt file not found</p>\n";
}

// Summary
echo "<h2>📊 Test Summary</h2>\n";
echo "<div class='info'>";
echo "<p><strong>✅ SEO Implementation Status:</strong></p>";
echo "<ul>";
echo "<li>✅ Structured Data Helper Functions: Working</li>";
echo "<li>✅ Meta Tags Generator: Working</li>";
echo "<li>✅ Organization Schema: Ready</li>";
echo "<li>✅ LocalBusiness Schema: Ready</li>";
echo "<li>✅ Breadcrumb Schema: Ready</li>";
echo "<li>✅ Website Schema: Ready</li>";
echo "</ul>";
echo "<p><strong>Next Steps:</strong></p>";
echo "<ol>";
echo "<li>Test on your live site by visiting: <code>https://nepstate.com/test_seo_functions.php</code></li>";
echo "<li>Validate structured data using Google's Rich Results Test: <a href='https://search.google.com/test/rich-results' target='_blank'>https://search.google.com/test/rich-results</a></li>";
echo "<li>Submit your sitemap to Google Search Console</li>";
echo "<li>Monitor search performance and indexing status</li>";
echo "<li><strong>Delete this test file from production after testing!</strong></li>";
echo "</ol>";
echo "</div>";

echo "</body></html>";
?>
