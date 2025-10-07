<?php
/**
 * Clean Google Tag Manager Implementation
 * This replaces the duplicate/conflicting GTM scripts
 */

// Choose ONE Google Analytics ID (recommend G-TYFDS5X1PB)
$ga_id = 'G-TYFDS5X1PB';

?>
<!-- Clean Google Tag Manager Implementation -->
<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_id; ?>"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', '<?php echo $ga_id; ?>');
</script>

<!-- Remove these duplicate scripts from your HTML: -->
<!-- 
<script async src="https://www.googletagmanager.com/gtag/js?id=G-ZBH6L00TKQ"></script>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TYFDS5X1PB"></script>
-->
