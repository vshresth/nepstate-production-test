<?php
/**
 * Simple Cache Helper - Safe for Live Server
 */
class SimpleCache {
    private $cache_dir = 'cache/';
    
    public function __construct() {
        if (!is_dir($this->cache_dir)) {
            @mkdir($this->cache_dir, 0755, true);
        }
    }
    
    public function get($key) {
        $file = $this->cache_dir . md5($key) . '.cache';
        if (file_exists($file) && (time() - filemtime($file)) < 3600) {
            return unserialize(file_get_contents($file));
        }
        return false;
    }
    
    public function set($key, $data) {
        $file = $this->cache_dir . md5($key) . '.cache';
        return file_put_contents($file, serialize($data));
    }
}
?>
