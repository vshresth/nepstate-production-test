<?php
/**
 * Image Optimization Script
 * This script implements lazy loading and image optimization
 */

echo "<h1>🖼️ Image Optimization Implementation</h1>";

echo "<h3>🎯 Image Optimization Strategy:</h3>";

echo "<h4>1. Lazy Loading Implementation:</h4>";
echo "<p>Add lazy loading to all images to improve initial page load time:</p>";
echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>";
echo "<!-- Replace all img tags with lazy loading -->
<img src=\"placeholder.jpg\" 
     data-src=\"<?php echo \$image_url; ?>\" 
     class=\"lazy-load\" 
     alt=\"<?php echo htmlspecialchars(\$alt_text); ?>\" 
     loading=\"lazy\">

<!-- Add JavaScript for lazy loading -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy-load');
                imageObserver.unobserve(img);
            }
        });
    });
    
    lazyImages.forEach(img => imageObserver.observe(img));
});
</script>";
echo "</pre>";

echo "<h4>2. Image Compression:</h4>";
echo "<p>Create a PHP function to automatically compress images:</p>";
echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>";
echo "<?php
function compressImage(\$source, \$destination, \$quality = 80) {
    \$info = getimagesize(\$source);
    
    if (\$info['mime'] == 'image/jpeg') {
        \$image = imagecreatefromjpeg(\$source);
        imagejpeg(\$image, \$destination, \$quality);
    } elseif (\$info['mime'] == 'image/png') {
        \$image = imagecreatefrompng(\$source);
        imagepng(\$image, \$destination, 9);
    } elseif (\$info['mime'] == 'image/gif') {
        \$image = imagecreatefromgif(\$source);
        imagegif(\$image, \$destination);
    }
    
    imagedestroy(\$image);
    return true;
}

// Usage example
compressImage('original.jpg', 'compressed.jpg', 80);
?>";
echo "</pre>";

echo "<h4>3. Responsive Images:</h4>";
echo "<p>Implement responsive images for different screen sizes:</p>";
echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>";
echo "<!-- Responsive image with multiple sizes -->
<picture>
    <source media=\"(max-width: 768px)\" srcset=\"image-small.jpg\">
    <source media=\"(max-width: 1024px)\" srcset=\"image-medium.jpg\">
    <img src=\"image-large.jpg\" alt=\"Description\" class=\"responsive-img\">
</picture>

<!-- Or use srcset for modern browsers -->
<img src=\"image-default.jpg\" 
     srcset=\"image-small.jpg 480w, 
              image-medium.jpg 768w, 
              image-large.jpg 1024w\"
     sizes=\"(max-width: 480px) 100vw, 
             (max-width: 768px) 50vw, 
             25vw\"
     alt=\"Description\">";
echo "</pre>";

echo "<h4>4. WebP Format Support:</h4>";
echo "<p>Add WebP format support for better compression:</p>";
echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>";
echo "<?php
function convertToWebP(\$source, \$destination, \$quality = 80) {
    \$info = getimagesize(\$source);
    
    if (\$info['mime'] == 'image/jpeg') {
        \$image = imagecreatefromjpeg(\$source);
    } elseif (\$info['mime'] == 'image/png') {
        \$image = imagecreatefrompng(\$source);
    } else {
        return false;
    }
    
    // Convert to WebP
    imagewebp(\$image, \$destination, \$quality);
    imagedestroy(\$image);
    return true;
}

// Check if browser supports WebP
function supportsWebP() {
    return isset(\$_SERVER['HTTP_ACCEPT']) && 
           strpos(\$_SERVER['HTTP_ACCEPT'], 'image/webp') !== false;
}
?>";
echo "</pre>";

echo "<h4>5. Image Optimization in Views:</h4>";
echo "<p>Update your view files to use optimized images:</p>";
echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>";
echo "<?php
// In your view files, replace image tags with optimized versions
function getOptimizedImage(\$image_path, \$alt_text = '', \$class = '') {
    \$webp_path = str_replace(['.jpg', '.jpeg', '.png'], '.webp', \$image_path);
    
    if (supportsWebP() && file_exists(\$webp_path)) {
        \$src = \$webp_path;
    } else {
        \$src = \$image_path;
    }
    
    return '<img src=\"' . \$src . '\" 
                 data-src=\"' . \$image_path . '\" 
                 class=\"lazy-load ' . \$class . '\" 
                 alt=\"' . htmlspecialchars(\$alt_text) . '\" 
                 loading=\"lazy\">';
}

// Usage
echo getOptimizedImage(\$product_image, \$product_title, 'product-image');
?>";
echo "</pre>";

echo "<h3>📊 Expected Performance Impact:</h3>";
echo "<ul>";
echo "<li><strong>Initial Page Load:</strong> 40-60% faster</li>";
echo "<li><strong>Image Loading:</strong> 70-90% faster</li>";
echo "<li><strong>Bandwidth Usage:</strong> 50-70% reduction</li>";
echo "<li><strong>Mobile Performance:</strong> 60-80% improvement</li>";
echo "<li><strong>User Experience:</strong> Significantly better</li>";
echo "</ul>";

echo "<h3>🔧 Implementation Steps:</h3>";
echo "<ol>";
echo "<li><strong>Add lazy loading JavaScript</strong> to your main template</li>";
echo "<li><strong>Update image tags</strong> in view files with lazy loading</li>";
echo "<li><strong>Implement image compression</strong> for new uploads</li>";
echo "<li><strong>Convert existing images</strong> to WebP format</li>";
echo "<li><strong>Add responsive image support</strong> for mobile devices</li>";
echo "</ol>";

echo "<h3>🚀 Quick Implementation:</h3>";
echo "<p>Add this JavaScript to your footer for immediate lazy loading:</p>";
echo "<pre style='background: #f5f5f5; padding: 10px; border: 1px solid #ddd;'>";
echo "<script>
// Simple lazy loading implementation
(function() {
    const lazyImages = document.querySelectorAll('img[data-src]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy-load');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        lazyImages.forEach(img => imageObserver.observe(img));
    } else {
        // Fallback for older browsers
        lazyImages.forEach(img => {
            img.src = img.dataset.src;
        });
    }
})();
</script>";
echo "</pre>";

echo "<p><strong>Ready to implement image optimization?</strong> This will significantly improve your site's performance!</p>";
?>
