<?php
// Only show ad container if Google Ads is configured and working
$google_ads_enabled = true; // Set to true when Google AdSense is approved and working

if($google_ads_enabled) {
    ?>
    <!-- AdSense ad will appear here -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4205208716712983"
         crossorigin="anonymous"></script>
    <!-- horizontal-ad -->
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-client="ca-pub-4205208716712983"
         data-ad-slot="8819937211"
         data-ad-format="auto"
         data-full-width-responsive="true"></ins>
    <script>
         (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
    <?php
} else {
    echo "<!-- Ads Disabled -->";
}
?>
