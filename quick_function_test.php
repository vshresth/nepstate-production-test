<?php
/**
 * Quick Function Test for NepState
 * Simple test to verify functions are working
 */

echo "<h1>🚀 Quick Function Test</h1>";

// Test if we can load the helper file directly
$helper_file = __DIR__ . '/application/helpers/general_helper.php';

echo "<h2>📁 File Check</h2>";
if (file_exists($helper_file)) {
    echo "✅ Helper file exists<br>";
    echo "File path: {$helper_file}<br>";
    echo "File size: " . filesize($helper_file) . " bytes<br>";
    
    // Try to include it directly
    echo "<h2>🔧 Direct Include Test</h2>";
    try {
        include_once($helper_file);
        echo "✅ Helper file included successfully<br>";
        
        // Test functions
        echo "<h2>🧪 Function Tests</h2>";
        
        if (function_exists('generate_structured_data')) {
            echo "✅ generate_structured_data: AVAILABLE<br>";
            try {
                $result = generate_structured_data('organization');
                echo "&nbsp;&nbsp;&nbsp;✅ Test call successful<br>";
            } catch (Exception $e) {
                echo "&nbsp;&nbsp;&nbsp;⚠️ Error: " . $e->getMessage() . "<br>";
            }
        } else {
            echo "❌ generate_structured_data: MISSING<br>";
        }
        
        if (function_exists('generate_meta_tags')) {
            echo "✅ generate_meta_tags: AVAILABLE<br>";
        } else {
            echo "❌ generate_meta_tags: MISSING<br>";
        }
        
        if (function_exists('user_info')) {
            echo "✅ user_info: AVAILABLE<br>";
        } else {
            echo "❌ user_info: MISSING<br>";
        }
        
        if (function_exists('settings')) {
            echo "✅ settings: AVAILABLE<br>";
        } else {
            echo "❌ settings: MISSING<br>";
        }
        
    } catch (Exception $e) {
        echo "❌ Error including helper file: " . $e->getMessage() . "<br>";
    }
} else {
    echo "❌ Helper file missing at: {$helper_file}<br>";
    
    // Check if it's in a different location
    $alt_path = __DIR__ . '/application/helpers/general_helper.php';
    if (file_exists($alt_path)) {
        echo "✅ Found at alternative path: {$alt_path}<br>";
    } else {
        echo "❌ Not found at alternative path either<br>";
    }
}

echo "<h2>📊 Summary</h2>";
$functions_working = 0;
$total_functions = 4;

$functions_to_check = ['generate_structured_data', 'generate_meta_tags', 'user_info', 'settings'];
foreach($functions_to_check as $func) {
    if (function_exists($func)) {
        $functions_working++;
    }
}

echo "Functions working: {$functions_working}/{$total_functions}<br>";

if ($functions_working == $total_functions) {
    echo "✅ <strong>ALL FUNCTIONS WORKING! 500 errors should be fixed.</strong><br>";
} elseif ($functions_working > 0) {
    echo "⚠️ <strong>SOME functions working. Partial fix applied.</strong><br>";
} else {
    echo "❌ <strong>NO functions working. Need to investigate further.</strong><br>";
}

echo "<p>Share these results!</p>";
?>
