<?php
/**
 * Dynamic Sitemap Generator for NepState
 * Generates XML sitemap from database content
 */

// Include CodeIgniter bootstrap
require_once 'index.php';

// Get CI instance
$CI =& get_instance();

// Set content type
header('Content-Type: application/xml; charset=utf-8');

// Start XML output
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 
        http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<?php
$base_url = "https://nepstate.com/";
$current_date = date('c'); // ISO 8601 format

// 1. Homepage (Highest Priority)
echo "<url>\n";
echo "<loc>" . $base_url . "</loc>\n";
echo "<lastmod>" . $current_date . "</lastmod>\n";
echo "<changefreq>daily</changefreq>\n";
echo "<priority>1.00</priority>\n";
echo "</url>\n";

// 2. Category Pages (High Priority)
$categories = $CI->db->where('status', 1)->get('categories')->result();
foreach($categories as $category) {
    echo "<url>\n";
    echo "<loc>" . $base_url . "classifieds/" . $category->slug . "</loc>\n";
    echo "<lastmod>" . $current_date . "</lastmod>\n";
    echo "<changefreq>weekly</changefreq>\n";
    echo "<priority>0.80</priority>\n";
    echo "</url>\n";
    
    // Add subcategory pages if they exist
    $subcategories = $CI->db->query("SELECT DISTINCT sub_cat FROM products WHERE category = '" . $category->slug . "' AND sub_cat IS NOT NULL AND sub_cat != '' AND status = 1")->result();
    foreach($subcategories as $sub) {
        echo "<url>\n";
        echo "<loc>" . $base_url . "classifieds/" . $category->slug . "?sub=" . urlencode($sub->sub_cat) . "</loc>\n";
        echo "<lastmod>" . $current_date . "</lastmod>\n";
        echo "<changefreq>weekly</changefreq>\n";
        echo "<priority>0.64</priority>\n";
        echo "</url>\n";
    }
}

// 3. Individual Business Listings (High Priority for Local SEO)
$listings = $CI->db->where('status', 1)
                   ->where('expiry_date >', date('Y-m-d'))
                   ->order_by('updated_at', 'DESC')
                   ->limit(10000) // Limit to prevent memory issues
                   ->get('products')->result();

foreach($listings as $listing) {
    echo "<url>\n";
    echo "<loc>" . $base_url . "classified/detail/" . $listing->slug . "</loc>\n";
    echo "<lastmod>" . date('c', strtotime($listing->updated_at)) . "</lastmod>\n";
    echo "<changefreq>monthly</changefreq>\n";
    echo "<priority>0.70</priority>\n";
    echo "</url>\n";
}

// 4. Static Pages
$static_pages = [
    ['url' => 'about-us', 'priority' => '0.60'],
    ['url' => 'contact-us', 'priority' => '0.60'],
    ['url' => 'faq', 'priority' => '0.50'],
    ['url' => 'blog', 'priority' => '0.70'],
    ['url' => 'forums', 'priority' => '0.70'],
    ['url' => 'confessions', 'priority' => '0.60']
];

foreach($static_pages as $page) {
    echo "<url>\n";
    echo "<loc>" . $base_url . $page['url'] . "</loc>\n";
    echo "<lastmod>" . $current_date . "</lastmod>\n";
    echo "<changefreq>monthly</changefreq>\n";
    echo "<priority>" . $page['priority'] . "</priority>\n";
    echo "</url>\n";
}

// 5. Blog Posts (if they exist)
if($CI->db->table_exists('blogs')) {
    $blogs = $CI->db->where('status', 1)
                    ->order_by('created_at', 'DESC')
                    ->limit(1000)
                    ->get('blogs')->result();
    
    foreach($blogs as $blog) {
        echo "<url>\n";
        echo "<loc>" . $base_url . "blog-details/" . $blog->slug . "</loc>\n";
        echo "<lastmod>" . date('c', strtotime($blog->updated_at)) . "</lastmod>\n";
        echo "<changefreq>monthly</changefreq>\n";
        echo "<priority>0.60</priority>\n";
        echo "</url>\n";
    }
}

// 6. Forum Categories (if they exist)
$forum_categories = [
    'nepali-news', 'immigration', 'latest-affairs', 'us-visa', 
    'politics', 'sports', 'food', 'kurakani', 'it-guff', 
    'investment', 'stocks', 'nsfw', 'free-stuff'
];

foreach($forum_categories as $forum_cat) {
    echo "<url>\n";
    echo "<loc>" . $base_url . "forums?cat=" . $forum_cat . "</loc>\n";
    echo "<lastmod>" . $current_date . "</lastmod>\n";
    echo "<changefreq>weekly</changefreq>\n";
    echo "<priority>0.50</priority>\n";
    echo "</url>\n";
}

// 7. Popular Tags (if they exist and are used)
$popular_tags = $CI->db->query("SELECT DISTINCT tag FROM product_tags WHERE tag IS NOT NULL AND tag != '' ORDER BY COUNT(*) DESC LIMIT 50")->result();
foreach($popular_tags as $tag) {
    echo "<url>\n";
    echo "<loc>" . $base_url . "tags/" . urlencode($tag->tag) . "</loc>\n";
    echo "<lastmod>" . $current_date . "</lastmod>\n";
    echo "<changefreq>monthly</changefreq>\n";
    echo "<priority>0.40</priority>\n";
    echo "</url>\n";
}

?>

</urlset>