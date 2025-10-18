<?php
/**
 * SEO Diagnostic Tool for NepState
 * Quick health check for Google Search Console issues
 */

echo "<h1>🔍 NepState SEO Diagnostic Tool</h1>";

// Check PHP errors
echo "<h2>📊 PHP Configuration</h2>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Error Reporting: " . (error_reporting() ? "ON" : "OFF") . "<br>";
echo "Display Errors: " . (ini_get('display_errors') ? "ON" : "OFF") . "<br>";

// Check database connection
echo "<h2>🗄️ Database Connection</h2>";
try {
    $pdo = new PDO(
        "mysql:host=localhost;dbname=u415500770_nepstate", 
        "u415500770_nepstate", 
        "P145DeDevelopers"
    );
    echo "✅ Database connection: SUCCESS<br>";
    
    // Check key tables
    $tables = ['products', 'categories', 'blogs', 'users'];
    foreach($tables as $table) {
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM {$table}");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "📋 Table '{$table}': {$count} records<br>";
    }
    
} catch (Exception $e) {
    echo "❌ Database connection: FAILED - " . $e->getMessage() . "<br>";
}

// Check file permissions
echo "<h2>📁 File Permissions</h2>";
$files = [
    'application/controllers/Nepstate.php',
    'application/views/frontend/home.php',
    'robots.txt',
    '.htaccess'
];

foreach($files as $file) {
    if (file_exists($file)) {
        $perms = fileperms($file);
        $readable = is_readable($file) ? "✅" : "❌";
        echo "{$readable} {$file}: " . substr(sprintf('%o', $perms), -4) . "<br>";
    } else {
        echo "❌ {$file}: FILE NOT FOUND<br>";
    }
}

// Check for common error patterns
echo "<h2>🚨 Common Error Patterns</h2>";

// Check for missing functions
$functions = ['generate_structured_data', 'generate_meta_tags'];
foreach($functions as $func) {
    echo (function_exists($func) ? "✅" : "❌") . " Function '{$func}': " . (function_exists($func) ? "EXISTS" : "MISSING") . "<br>";
}

// Check recent error log
echo "<h2>📝 Recent Errors</h2>";
$error_log = ini_get('error_log');
if ($error_log && file_exists($error_log)) {
    $lines = file($error_log);
    $recent_errors = array_slice($lines, -10); // Last 10 lines
    echo "<pre>";
    foreach($recent_errors as $line) {
        if (strpos($line, 'PHP') !== false || strpos($line, 'Fatal') !== false) {
            echo htmlspecialchars($line) . "<br>";
        }
    }
    echo "</pre>";
} else {
    echo "No error log found or accessible<br>";
}

echo "<h2>✅ Diagnostic Complete</h2>";
echo "<p>Run this tool after making changes to verify fixes.</p>";
?>
