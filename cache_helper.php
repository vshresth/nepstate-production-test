<?php
/**
 * 🚀 SIMPLE CACHE HELPER FOR HIGH TRAFFIC
 * File-based caching system for database query optimization
 */

class SimpleCache {
    private $cache_dir = 'cache/';
    private $default_ttl = 3600; // 1 hour
    
    public function __construct() {
        if (!is_dir($this->cache_dir)) {
            mkdir($this->cache_dir, 0755, true);
        }
    }
    
    public function get($key) {
        $file = $this->cache_dir . md5($key) . '.cache';
        if (file_exists($file) && (time() - filemtime($file)) < $this->default_ttl) {
            return unserialize(file_get_contents($file));
        }
        return false;
    }
    
    public function set($key, $data, $ttl = null) {
        $file = $this->cache_dir . md5($key) . '.cache';
        return file_put_contents($file, serialize($data));
    }
    
    public function delete($key) {
        $file = $this->cache_dir . md5($key) . '.cache';
        if (file_exists($file)) {
            return unlink($file);
        }
        return true;
    }
    
    public function clear() {
        $files = glob($this->cache_dir . '*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
        return count($files);
    }
    
    public function get_stats() {
        $files = glob($this->cache_dir . '*.cache');
        $total_size = 0;
        foreach ($files as $file) {
            $total_size += filesize($file);
        }
        return [
            'files' => count($files),
            'size' => $total_size,
            'directory' => $this->cache_dir
        ];
    }
}
?>
