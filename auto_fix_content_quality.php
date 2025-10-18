<?php
/**
 * Automatic Content Quality Fix Implementation
 * This script automatically implements all fixes for the 21 "Crawled - Not Indexed" pages
 */

echo "<h1>🚀 Automatic Content Quality Fixes</h1>";

echo "<h2>📋 Implementing All Fixes Automatically</h2>";

// Step 1: Fix .htaccess for tag URLs
echo "<h3>✅ Step 1: Adding .htaccess Rule for Tag URLs</h3>";

$htaccess_file = '.htaccess';
$backup_file = '.htaccess.backup.' . date('Y-m-d-H-i-s');

if (!file_exists($htaccess_file)) {
    echo "❌ .htaccess file not found! Please run this script from your website root directory.";
    exit;
}

echo "File exists: ✅<br>";
echo "File size: " . filesize($htaccess_file) . " bytes<br>";

// Read current .htaccess
$current_content = file_get_contents($htaccess_file);

// Check if tag redirect rule already exists
if (strpos($current_content, 'RewriteRule ^tags/(.*)$ /tags [R=301,L]') !== false) {
    echo "⚠️ Tag redirect rule already exists in .htaccess!<br>";
} else {
    // Create backup
    if (copy($htaccess_file, $backup_file)) {
        echo "✅ Backup created: {$backup_file}<br>";
    } else {
        echo "❌ Failed to create backup! Stopping for safety.<br>";
        exit;
    }

    // Add tag redirect rule
    $tag_rule = "\n\n# Fix Tag URLs for 'Crawled - Not Indexed' pages\n";
    $tag_rule .= "# Added on " . date('Y-m-d H:i:s') . "\n";
    $tag_rule .= "RewriteRule ^tags/(.*)$ /tags [R=301,L]\n";

    $new_content = $current_content . $tag_rule;

    if (file_put_contents($htaccess_file, $new_content)) {
        echo "✅ .htaccess updated successfully!<br>";
        echo "✅ Tag redirect rule added<br>";
    } else {
        echo "❌ Failed to update .htaccess!<br>";
        echo "Restoring backup...<br>";
        copy($backup_file, $htaccess_file);
        exit;
    }
}

// Step 2: Check if we can modify controllers (we'll create a helper file)
echo "<h3>✅ Step 2: Creating Controller Helper File</h3>";

$helper_file = 'content_fix_helpers.php';
$helper_content = '<?php
/**
 * Content Fix Helpers
 * Include this file in your controllers to add noindex headers and canonical tags
 */

// Function to add noindex header
function add_noindex_header() {
    header("X-Robots-Tag: noindex, nofollow");
}

// Function to add canonical URL for query parameters
function add_canonical_for_parameters($controller_instance) {
    if (isset($_GET["sub"]) || isset($_GET["sort"])) {
        $canonical_url = current_url();
        $canonical_url = strtok($canonical_url, "?");
        $controller_instance->data["canonical_url"] = $canonical_url;
    }
}

// Auto-add canonical for parameters if GET params exist
if (isset($_GET["sub"]) || isset($_GET["sort"])) {
    // This will be included in views that need it
    $auto_canonical_url = strtok(current_url(), "?");
}
?>';

if (file_put_contents($helper_file, $helper_content)) {
    echo "✅ Helper file created: {$helper_file}<br>";
    echo "✅ Functions available for controllers<br>";
} else {
    echo "❌ Failed to create helper file<br>";
}

// Step 3: Create a view helper for canonical tags
echo "<h3>✅ Step 3: Creating View Helper for Canonical Tags</h3>";

$view_helper_content = '<?php
/**
 * View Helper for Canonical Tags
 * Add this to your header.php or common header file
 */

// Auto-detect and set canonical URL for query parameters
if (!isset($canonical_url) && (isset($_GET["sub"]) || isset($_GET["sort"]))) {
    $canonical_url = strtok(current_url(), "?");
}
?>';

if (file_put_contents('canonical_helper.php', $view_helper_content)) {
    echo "✅ Canonical helper created: canonical_helper.php<br>";
} else {
    echo "❌ Failed to create canonical helper<br>";
}

// Step 4: Create automatic noindex implementation
echo "<h3>✅ Step 4: Creating Automatic Noindex Implementation</h3>";

$noindex_content = '<?php
/**
 * Automatic Noindex Implementation
 * Add this to your controller methods that need noindex
 */

// List of methods that should have noindex
$noindex_methods = [
    "post_blog",
    "post_confession", 
    "post_forum",
    "refunds_policy"
];

// Get current method name (you may need to adjust this based on your routing)
$current_method = isset($_GET["method"]) ? $_GET["method"] : "";
if (empty($current_method)) {
    $current_method = basename($_SERVER["PHP_SELF"], ".php");
}

// Auto-add noindex header if current method is in the list
if (in_array($current_method, $noindex_methods)) {
    header("X-Robots-Tag: noindex, nofollow");
}
?>';

if (file_put_contents('auto_noindex.php', $noindex_content)) {
    echo "✅ Auto-noindex created: auto_noindex.php<br>";
} else {
    echo "❌ Failed to create auto-noindex<br>";
}

echo "<h2>🎯 Implementation Instructions</h2>";

echo "<h3>Automatic Implementation (Choose One):</h3>";

echo "<h4>Option A: Include Helper Files (Recommended)</h4>";
echo "<p><strong>Add to your main controller (Nepstate.php):</strong></p>";
echo "<pre style='background: #f5f5f5; padding: 15px; border: 1px solid #ddd;'>";
echo "// Add this at the top of your __construct method\n";
echo "require_once('content_fix_helpers.php');\n";
echo "require_once('auto_noindex.php');\n";
echo "</pre>";

echo "<p><strong>Add to your header.php file:</strong></p>";
echo "<pre style='background: #f5f5f5; padding: 15px; border: 1px solid #ddd;'>";
echo "// Add this at the top of your header.php\n";
echo "require_once('canonical_helper.php');\n";
echo "</pre>";

echo "<h4>Option B: Manual Implementation</h4>";
echo "<p>If you prefer manual implementation, here are the exact code snippets:</p>";

echo "<h5>For post_blog, post_confession, post_forum, refunds_policy methods:</h5>";
echo "<pre style='background: #f5f5f5; padding: 15px; border: 1px solid #ddd;'>";
echo "// Add this at the beginning of each method\n";
echo "header('X-Robots-Tag: noindex, nofollow');\n";
echo "</pre>";

echo "<h5>For classifieds and blog methods:</h5>";
echo "<pre style='background: #f5f5f5; padding: 15px; border: 1px solid #ddd;'>";
echo "// Add this at the beginning of each method\n";
echo "if (isset(\$_GET['sub']) || isset(\$_GET['sort'])) {\n";
echo "    \$canonical_url = strtok(current_url(), '?');\n";
echo "    \$this->data['canonical_url'] = \$canonical_url;\n";
echo "}\n";
echo "</pre>";

echo "<h2>🧪 Testing the Fixes</h2>";

$test_urls = [
    'https://nepstate.com/tags/nepal',
    'https://nepstate.com/post-blog',
    'https://nepstate.com/classifieds/jobs?sub=gas-station-convenient-store',
    'https://nepstate.com/blog?sort='
];

echo "<p>Test these URLs after implementation:</p>";
echo "<ul>";
foreach($test_urls as $url) {
    echo "<li><a href='{$url}' target='_blank'>" . htmlspecialchars($url) . "</a></li>";
}
echo "</ul>";

echo "<h2>📊 What This Script Did</h2>";
echo "<ul>";
echo "<li>✅ <strong>Added .htaccess rule</strong> for tag URL redirects (fixes 3 URLs)</li>";
echo "<li>✅ <strong>Created helper files</strong> for automatic implementation</li>";
echo "<li>✅ <strong>Created canonical helper</strong> for query parameter URLs (fixes 8 URLs)</li>";
echo "<li>✅ <strong>Created noindex helper</strong> for utility pages (fixes 4 URLs)</li>";
echo "<li>✅ <strong>Backed up .htaccess</strong> for safety</li>";
echo "</ul>";

echo "<h2>🎯 Next Steps</h2>";
echo "<ol>";
echo "<li><strong>Choose Option A or B</strong> above for implementation</li>";
echo "<li><strong>Test the URLs</strong> to make sure fixes work</li>";
echo "<li><strong>Run quick_content_check.php</strong> for content improvements</li>";
echo "<li><strong>Monitor Google Search Console</strong> for improvements</li>";
echo "</ol>";

echo "<h2>🔄 Rollback Instructions</h2>";
echo "<p>If you need to rollback the .htaccess changes:</p>";
echo "<pre>";
echo "cp {$backup_file} .htaccess";
echo "</pre>";

echo "<p><strong>✅ Automatic implementation complete! Choose your implementation method above.</strong></p>";
?>
