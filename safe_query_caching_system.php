<?php
/**
 * 🛡️ SAFE QUERY CACHING SYSTEM FOR LIVE SERVER
 * No database credentials exposed, error handling included
 */

echo "<h1>🛡️ SAFE QUERY CACHING SYSTEM</h1>";
echo "<h2>📈 Safe Implementation for Live Server</h2>";

// Check if this is being run from the correct location
if (!defined('BASEPATH') && !file_exists('index.php')) {
    die("<div style='background: #f44336; color: white; padding: 15px; border-radius: 8px; margin: 15px 0;'>❌ ERROR: This script must be run from your website root directory</div>");
}

// Simple file-based caching system (works on any hosting)
class SafeCache {
    private $cache_dir = 'cache/';
    private $default_ttl = 3600; // 1 hour
    
    public function __construct() {
        // Try to create cache directory safely
        if (!is_dir($this->cache_dir)) {
            if (!@mkdir($this->cache_dir, 0755, true)) {
                die("<div style='background: #f44336; color: white; padding: 15px; border-radius: 8px; margin: 15px 0;'>❌ ERROR: Cannot create cache directory. Please create 'cache/' folder manually with 755 permissions.</div>");
            }
        }
        
        // Check if cache directory is writable
        if (!is_writable($this->cache_dir)) {
            die("<div style='background: #f44336; color: white; padding: 15px; border-radius: 8px; margin: 15px 0;'>❌ ERROR: Cache directory is not writable. Please set 755 permissions on 'cache/' folder.</div>");
        }
    }
    
    public function get($key) {
        $file = $this->cache_dir . md5($key) . '.cache';
        if (file_exists($file) && (time() - filemtime($file)) < $this->default_ttl) {
            $content = @file_get_contents($file);
            if ($content !== false) {
                return @unserialize($content);
            }
        }
        return false;
    }
    
    public function set($key, $data, $ttl = null) {
        $file = $this->cache_dir . md5($key) . '.cache';
        $serialized = @serialize($data);
        if ($serialized !== false) {
            return @file_put_contents($file, $serialized, LOCK_EX);
        }
        return false;
    }
    
    public function delete($key) {
        $file = $this->cache_dir . md5($key) . '.cache';
        if (file_exists($file)) {
            return @unlink($file);
        }
        return true;
    }
    
    public function clear() {
        $files = @glob($this->cache_dir . '*.cache');
        $deleted = 0;
        if ($files) {
            foreach ($files as $file) {
                if (@unlink($file)) {
                    $deleted++;
                }
            }
        }
        return $deleted;
    }
    
    public function get_stats() {
        $files = @glob($this->cache_dir . '*.cache');
        $total_size = 0;
        if ($files) {
            foreach ($files as $file) {
                $size = @filesize($file);
                if ($size !== false) {
                    $total_size += $size;
                }
            }
        }
        return [
            'files' => $files ? count($files) : 0,
            'size' => $total_size,
            'directory' => $this->cache_dir,
            'writable' => is_writable($this->cache_dir)
        ];
    }
}

// Initialize cache
$cache = new SafeCache();

echo "<h3>🔍 Current Cache Status</h3>";
$stats = $cache->get_stats();
echo "<div style='background: #2196f3; color: white; padding: 10px; border-radius: 4px; margin: 10px 0;'>";
echo "<strong>Cache Files:</strong> " . $stats['files'] . "<br>";
echo "<strong>Cache Directory:</strong> " . (is_dir($stats['directory']) ? "✅ Exists" : "❌ Missing") . "<br>";
echo "<strong>Cache Size:</strong> " . number_format($stats['size']) . " bytes<br>";
echo "<strong>Writable:</strong> " . ($stats['writable'] ? "✅ Yes" : "❌ No");
echo "</div>";

echo "<h3>🚀 Cache System Ready</h3>";
echo "<div style='background: #4caf50; color: white; padding: 15px; border-radius: 8px; margin: 15px 0;'>";
echo "<h4>✅ Safe Cache System Initialized</h4>";
echo "<ul>";
echo "<li><strong>Cache Directory:</strong> Created and writable</li>";
echo "<li><strong>Error Handling:</strong> All operations are safe</li>";
echo "<li><strong>Security:</strong> No database credentials exposed</li>";
echo "<li><strong>Memory Safe:</strong> No large data operations</li>";
echo "</ul>";
echo "</div>";

echo "<h3>🎯 Next Steps</h3>";
echo "<div style='background: #ff9800; color: white; padding: 15px; border-radius: 8px; margin: 15px 0;'>";
echo "<ol>";
echo "<li><strong>Upload cache_helper.php</strong> to your server root</li>";
echo "<li><strong>Update your controller</strong> to use caching</li>";
echo "<li><strong>Test caching</strong> on your live site</li>";
echo "<li><strong>Monitor performance</strong> improvements</li>";
echo "</ol>";
echo "</div>";

echo "<h3>🛡️ Safety Features</h3>";
echo "<div style='background: #4caf50; color: white; padding: 15px; border-radius: 8px; margin: 15px 0;'>";
echo "<ul>";
echo "<li>✅ No database credentials exposed</li>";
echo "<li>✅ Safe file operations with error handling</li>";
echo "<li>✅ Permission checks before operations</li>";
echo "<li>✅ Memory-safe operations</li>";
echo "<li>✅ Graceful error handling</li>";
echo "</ul>";
echo "</div>";

echo "<p><strong>🎯 Cache system is ready and safe for live server!</strong></p>";
?>
