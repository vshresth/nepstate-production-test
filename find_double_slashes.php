<?php
/**
 * Find Double Slashes (////) in Files
 * This script will search for the source of the //// characters
 */

echo "🔍 Searching for double slashes (////) in your files...\n\n";

// Files to check (common WordPress/PHP files)
$files_to_check = [
    'index.php',
    'wp-config.php',
    'wp-content/themes/*/header.php',
    'wp-content/themes/*/functions.php',
    'wp-content/themes/*/index.php',
    'wp-content/plugins/*/',
    'application/views/frontend/common/header.php',
    'application/views/frontend/home.php',
    'application/views/frontend/common/footer.php',
    'application/config/config.php'
];

// Search patterns
$patterns = [
    'echo "////"',
    'print "////"',
    'printf("////"',
    'var_dump("////"',
    'print_r("////"',
    '////',
    '// //',
    'echo "//"',
    'print "//"'
];

// Check current directory files
echo "📁 Checking current directory files...\n";
$current_files = glob('*.php');
foreach ($current_files as $file) {
    check_file_for_patterns($file, $patterns);
}

// Check application directory
echo "\n📁 Checking application directory...\n";
if (is_dir('application')) {
    $app_files = glob('application/**/*.php');
    foreach ($app_files as $file) {
        check_file_for_patterns($file, $patterns);
    }
}

// Check for WordPress files
echo "\n📁 Checking for WordPress files...\n";
if (file_exists('wp-config.php')) {
    echo "✅ WordPress installation detected\n";
    check_file_for_patterns('wp-config.php', $patterns);
    
    // Check theme files
    $theme_files = glob('wp-content/themes/*/*.php');
    foreach ($theme_files as $file) {
        check_file_for_patterns($file, $patterns);
    }
    
    // Check active plugins
    $plugin_files = glob('wp-content/plugins/*/*.php');
    foreach ($plugin_files as $file) {
        check_file_for_patterns($file, $patterns);
    }
}

echo "\n🎯 Common locations to check manually:\n";
echo "1. wp-content/themes/[active-theme]/header.php\n";
echo "2. wp-content/themes/[active-theme]/functions.php\n";
echo "3. wp-content/plugins/[active-plugins]/main-files\n";
echo "4. application/views/frontend/common/header.php\n";
echo "5. application/views/frontend/home.php\n";

function check_file_for_patterns($file, $patterns) {
    if (!file_exists($file)) {
        return;
    }
    
    $content = file_get_contents($file);
    $found = false;
    
    foreach ($patterns as $pattern) {
        if (strpos($content, $pattern) !== false) {
            if (!$found) {
                echo "🚨 Found in: $file\n";
                $found = true;
            }
            
            // Find line numbers
            $lines = explode("\n", $content);
            foreach ($lines as $line_num => $line) {
                if (strpos($line, $pattern) !== false) {
                    echo "   Line " . ($line_num + 1) . ": " . trim($line) . "\n";
                }
            }
        }
    }
    
    if ($found) {
        echo "\n";
    }
}

echo "\n💡 If no matches found, check these manually:\n";
echo "- Browser developer tools (F12) → Console tab for JavaScript errors\n";
echo "- Server error logs for PHP errors\n";
echo "- WordPress debug.log file\n";
echo "- Check if it's coming from a plugin or theme\n";
?>
