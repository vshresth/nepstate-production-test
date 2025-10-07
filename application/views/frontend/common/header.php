<!DOCTYPE html>
<html lang="en-US">
<head>
	<style>
        /* Override Bootstrap's tooltip styles for form validation */
        .form-control:valid ~ .valid-tooltip {
            display: block !important;
        }

        .form-control:invalid ~ .invalid-tooltip {
            display: block !important;
        }



    </style>
    <meta name="google-site-verification" content="HpryjVVurfz1oYsZz9qhw-vZnVwoHUHX0pvUE2Zgi78" />
   <meta property="og:image" content="<?php echo isset($og_image) ? $og_image : 'https://admin.nepstate.com/images/logo/1739511638.png'; ?>" />
   <meta property="og:title" content="<?php echo isset($page_title) ? $page_title : 'NepState - Connecting Nepalese Globally'; ?>" />
   <meta property="og:description" content="<?php echo isset($meta_description) ? $meta_description : 'Discover Nepalese businesses, jobs, events, and community connections worldwide.'; ?>" />
   <meta property="og:url" content="<?php echo isset($canonical_url) ? $canonical_url : base_url(); ?>" />
   <meta property="og:type" content="website" />
   <meta property="og:site_name" content="NepState" />
   
   <!-- Twitter Card Tags -->
   <meta name="twitter:card" content="summary_large_image" />
   <meta name="twitter:title" content="<?php echo isset($page_title) ? $page_title : 'NepState - Connecting Nepalese Globally'; ?>" />
   <meta name="twitter:description" content="<?php echo isset($meta_description) ? $meta_description : 'Discover Nepalese businesses, jobs, events, and community connections worldwide.'; ?>" />
   <meta name="twitter:image" content="<?php echo isset($og_image) ? $og_image : 'https://admin.nepstate.com/images/logo/1739511638.png'; ?>" />

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-TYFDS5X1PB"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-TYFDS5X1PB');
</script>

<!-- Enhanced DataLayer for NepState -->
<script>
window.dataLayer = window.dataLayer || [];
dataLayer.push({
  'page_category': '<?php echo isset($page_category) ? $page_category : "general"; ?>',
  'user_type': '<?php echo isset($_SESSION["LISTYLOGIN"]) ? "logged_in" : "visitor"; ?>',
  'page_type': '<?php echo isset($page_type) ? $page_type : "listing"; ?>',
  'business_category': '<?php echo isset($business_category) ? $business_category : ""; ?>',
  'listing_id': '<?php echo isset($listing_id) ? $listing_id : ""; ?>',
  'country': '<?php echo isset($user_country) ? $user_country : ""; ?>'
});
</script>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($page_title) ? $page_title : "NepState - Connecting Nepalese Globally"; ?></title>
    <meta name="description" content="<?php echo isset($meta_description) ? $meta_description : "Discover Nepalese businesses, jobs, events, and community connections worldwide. Find restaurants, services, and connect with the Nepalese diaspora."; ?>">
    <meta name="keywords" content="<?php echo isset($meta_keywords) ? $meta_keywords : "Nepalese business, Nepal community, Nepali restaurants, jobs Nepal, events Nepal, diaspora"; ?>">
	<meta name="robots" content="max-image-preview:large">
	<link rel="dns-prefetch" href="https://fonts.googleapis.com">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/css/rtcl-public.min.css" media="all">
	<!-- <link rel="stylesheet" href="<?php echo $assets;?>assets/css/dist/block-library/style.min.css?ver=6.2.2" media="all"> -->
	<!-- <link rel="stylesheet"  href="<?php echo $assets;?>assets/css/classic-themes.min.css?ver=6.2.2" media="all"> -->
	<link rel="stylesheet"  href="<?php echo $assets;?>assets/css/custom.css?time=<?php echo time();?>" media="all">
	<!-- <link rel="stylesheet" ihref="<?php echo $assets;?>assets/css/gb-frontend-block.css" media="all"> -->
	<!-- <link rel="stylesheet"  href="<?php echo $uploads;?>rtcl/rtcl-block-css-10.css" media="all"> -->
	<!-- <link rel="stylesheet"  href="<?php echo $assets;?>assets/css/public.min.css?ver=2.1.13" media="all"> -->
	<!-- <link rel="stylesheet"  href="<?php echo $assets;?>assets/css/gb-frontend-block-pro.css?ver=2.1.13" media="all"> -->
	<?php  if($this->uri->segment(2)== "detail") { ?>
		<link rel="stylesheet" href="<?php echo $assets;?>plugins/elementor/assets/lib/eicons/css/elementor-icons.min.css?ver=5.20.0" media="all">
	<?php } ?>
	<link rel="stylesheet"  href="<?php echo $assets;?>plugins/elementor/assets/css/frontend.min.css?ver=3.13.4" media="all">

	<?php /* if($this->uri->segment(1) == "about-us" || $this->uri->segment(1) == "promote" || $this->uri->segment(1) == "" || $this->uri->segment(1) == "contact-us" || $this->uri->segment(1) == "new" || $this->uri->segment(2)== "detail" || $this->uri->segment(1)=="post-blog" || $this->uri->segment(1)=="post-confession"){ ?>
		<link rel="stylesheet"  href="<?php echo $assets;?>plugins/elementor/assets/css/frontend.min.css?ver=3.13.4" media="all">
	<?php } */ ?>
	<link rel="stylesheet" href="<?php echo $assets;?>plugins/elementor/assets/lib/swiper/css/swiper.min.css?ver=5.3.6" media="all">
	<link rel="stylesheet" href="<?php echo $uploads;?>elementor/css/post-1731.css?ver=1686043492" media="all">
	<link rel="stylesheet"  href="<?php echo $uploads;?>elementor/css/post-10.css?ver=1686043493" media="all">
	<!-- <link rel="stylesheet"  href="<?php echo $assets;?>plugins/fluentform/public/css/fluent-forms-elementor-widget.css?ver=4.3.25" media="all"> -->
	<!-- <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Outfit%3A300%2C400%2C500%2C600%2C700&#038;display=fallback&#038;ver=1.2.4" media="all"> -->
	<!-- <link rel="stylesheet" href="<?php echo $assets;?>assets/vendor/bootstrap/bootstrap.min.css"> -->
	    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" href="<?php echo $assets;?>assets/css/all.min.css?ver=1.2.4" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/css/flaticon.css?ver=1.2.4" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/css/fontello.css?ver=1.2.4" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/css/minified/animate.css?ver=1.2.4" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/vendor/rangeSlider/ion.rangeSlider.min.css?ver=1.2.4" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/vendor/photoswipe/photoswipe.css?ver=2.1.13" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/vendor/photoswipe/default-skin/default-skin.css?ver=2.1.13" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/css/inc/customizer/assets/select2.min.css?ver=4.0.6" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>assets/css/minified/style.css?ver=<?php echo time();?>" media="all">
	<link rel="stylesheet" href="<?php echo $assets;?>plugins/listygo-core/assets/css/listygo-core.css?ver=6.2.2" media="all">
	<link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic%7CRoboto+Slab%3A100%2C100italic%2C200%2C200italic%2C300%2C300italic%2C400%2C400italic%2C500%2C500italic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic%2C900%2C900italic&#038;display=auto&#038;ver=6.2.2" media="all"> -->
	<script src="<?php echo $assets;?>assets/js/jquery/jquery.min.js"></script>
	<?php /* ?>
	<script src="<?php echo $assets;?>assets/js/jquery/jquery-migrate.min.js?ver=3.4.0" id="jquery-migrate-js"></script>
	<script src="<?php echo $assets;?>assets/js/dist/vendor/moment.min.js?ver=2.29.4" id="moment-js"></script>
	<script type="text/javascript" id="moment-js-after">moment.updateLocale( 'en_US', {"months":["January","February","March","April","May","June","July","August","September","October","November","December"],"monthsShort":["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],"weekdays":["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],"weekdaysShort":["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],"week":{"dow":1},"longDateFormat":{"LT":"g:i a","LTS":null,"L":null,"LL":"F j, Y","LLL":"F j, Y g:i a","LLLL":null}} );</script>
	<script src="<?php echo $assets;?>assets/vendor/daterangepicker/daterangepicker.js?ver=3.0.5" id="daterangepicker-js"></script>
	<script src="<?php echo $assets;?>assets/js/rtcl-common.min.js" ></script>
	<?php */ ?>
	
	<link rel="canonical" href="<?php echo base_url();?>">
	<link rel="shortlink" href="<?php echo base_url();?>">
	<link rel="preload" as="font" type="font/woff2" crossorigin>
	<link rel="preconnect">
	
	<link rel="icon" href="<?php echo settings()->site_logo;?>" sizes="32x32">
	<link rel="icon" href="<?php echo settings()->site_logo;?>" sizes="192x192">

	<link rel="apple-touch-icon" href="<?php echo settings()->site_logo;?>">
	<meta name="msapplication-TileImage" content="<?php echo settings()->site_logo;?>">
	<link rel="stylesheet" href="<?php echo $assets; ?>dropify/dist/css/dropify.css">
	<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=65a8d635047cc8001954d3b3&product=inline-share-buttons&source=platform" async="async"></script>
	<style type="text/css">
		.active_class {
			    color: var(--color-primary) !important;
		}
	</style>
	
</head>

<?php 

	//echo $page_url = basename($_SERVER['PHP_SELF']);
	if($page_url=="classified-details"){
		$classname = "rtcl_listing-template-default single single-rtcl_listing postid-7613 wp-embed-responsive rtcl rtcl-page rtcl-single-no-sidebar rtcl-no-js mobile-menu-wrapper sticky-header-enable header-style-1 has-sidebar top-bar-enable   htop-social-disable elementor-default elementor-kit-1731";
	} else if($page_url == "classifieds" || $page_url == "index" ){
		$classname = "archive post-type-archive post-type-archive-rtcl_listing wp-embed-responsive rtcl rtcl-page rtcl-archive-no-sidebar rtcl-no-js mobile-menu-wrapper sticky-header-enable header-style-1 has-sidebar top-bar-enable   htop-social-disable elementor-default elementor-kit-1731";
	} else if($page_url == "about-us"){
		$classname = "page-template page-template-elementor_header_footer page page-id-7919 wp-embed-responsive rtcl-no-js mobile-menu-wrapper sticky-header-enable header-style-2 no-sidebar transparent-header top-bar-disable   htop-social-disable elementor-default elementor-template-full-width elementor-kit-1731 elementor-page elementor-page-7919";
	}
	else {
		//$classname = "home page-template page-template-elementor_header_footer page page-id-10 wp-embed-responsive rtcl-no-js mobile-menu-wrapper sticky-header-enable header-style-1 no-sidebar transparent-header top-bar-disable   htop-social-disable elementor-default elementor-template-full-width elementor-kit-1731 elementor-page elementor-page-10";

		$classname = "page-template page-template-elementor_header_footer page page-id-7919 wp-embed-responsive rtcl-no-js mobile-menu-wrapper sticky-header-enable header-style-2 no-sidebar transparent-header top-bar-disable   htop-social-disable elementor-default elementor-template-full-width elementor-kit-1731 elementor-page elementor-page-7919";
	}

	if($page_url == "" || $page_url == "index"  || $page_url == "classifieds"){
		$header_style = "header-area-2";
		?>
			<style>
				#countryColor{
					color: black;
				}
				@media (max-width: 767px) {
					#countryColor{
						color: black;
					}
				}
			</style>
		<?php
		// $header_style = "header-area-2";
	} else {
		$header_style = "header-area-1";
		?>
			<style>
				#countryColor{
					color: white;
				}

				.location-button{
					color:white;
				}
				@media (max-width: 767px) {
					#countryColor{
						color: black;
					}
					.location-button{
					color:black;
				}
				}
			</style>
		<?php
	}

?>

<body class="  <?php echo $classname;?> "   >
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MTNNS63M"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<?php /* ?>
	    <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-dark-grayscale"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0 0.49803921568627"></fefuncr><fefuncg type="table" tablevalues="0 0.49803921568627"></fefuncg><fefuncb type="table" tablevalues="0 0.49803921568627"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-grayscale"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0 1"></fefuncr><fefuncg type="table" tablevalues="0 1"></fefuncg><fefuncb type="table" tablevalues="0 1"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-purple-yellow"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0.54901960784314 0.98823529411765"></fefuncr><fefuncg type="table" tablevalues="0 1"></fefuncg><fefuncb type="table" tablevalues="0.71764705882353 0.25490196078431"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-blue-red"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0 1"></fefuncr><fefuncg type="table" tablevalues="0 0.27843137254902"></fefuncg><fefuncb type="table" tablevalues="0.5921568627451 0.27843137254902"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-midnight"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0 0"></fefuncr><fefuncg type="table" tablevalues="0 0.64705882352941"></fefuncg><fefuncb type="table" tablevalues="0 1"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-magenta-yellow"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0.78039215686275 1"></fefuncr><fefuncg type="table" tablevalues="0 0.94901960784314"></fefuncg><fefuncb type="table" tablevalues="0.35294117647059 0.47058823529412"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-purple-green"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0.65098039215686 0.40392156862745"></fefuncr><fefuncg type="table" tablevalues="0 1"></fefuncg><fefuncb type="table" tablevalues="0.44705882352941 0.4"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 0 0" width="0" height="0" focusable="false" role="none" style="visibility: hidden; position: absolute; left: -9999px; overflow: hidden;"><defs><filter id="wp-duotone-blue-orange"><fecolormatrix color-interpolation-filters="sRGB" type="matrix" values=" .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 .299 .587 .114 0 0 "></fecolormatrix><fecomponenttransfer color-interpolation-filters="sRGB"><fefuncr type="table" tablevalues="0.098039215686275 1"></fefuncr><fefuncg type="table" tablevalues="0 0.66274509803922"></fefuncg><fefuncb type="table" tablevalues="0.84705882352941 0.41960784313725"></fefuncb><fefunca type="table" tablevalues="1 1"></fefunca></fecomponenttransfer><fecomposite in2="SourceGraphic" operator="in"></fecomposite></filter></defs></svg>
    	<?php */ ?>
    	
        <!-- <div id="pageoverlay" class="pageoverlay">
                <div class="overlayDoor"></div>
                <div class="overlayContent">
                    <div class="pageloader">
                        <div class="inner"></div>
                    </div>
                </div>
        </div> -->
    


    <div id="wrapper" class="wrapper">
        <div id="masthead" class="site-header">
        	<header id="site-header" class="header-area <?php echo $header_style;?>  toggle-mobi-disable">
        		<?php if(isset($_SESSION['LISTYLOGIN'])){?>
        			<?php if(user_info()->verify_email == 0){?>
		        		<div class="notif_wrapper">
					    	<div>
					    		Your account is not verified.
					    	</div>
					    	<div>
					    		<a href="<?php echo base_url();?>resend_verification_email">
					    			Resend Email?
					    		</a>
					    	</div>
					    </div>
					<?php } ?>
				<?php } ?>
        <div id="sticky-placeholder"></div>
    <div class="header-main header-sticky">
        <div class="container-fluid custom-padding">
            <div class="header-navbar">
                <div class="site-logo">

				<div>

                    <div class="header-logo logo-black">
					
						<div class="webLogo" style="display:flex; align-items:center; flex-direction:column; position:relative;">
							<a href="<?php echo base_url();?>" class="main-logo">
								<img  style="width: 170px;" src="<?php echo settings()->site_logo; ?>" class="attachment-full size-full siteLogo" alt="" title="">
							</a>
		
					
							<!-- <div class="langBox1">
								<div class="langData1">
									<?php
										$listOfLang = $this->db->get('admin_countries')->result_object();
										foreach($listOfLang as $lang) {
									?>
									<?php if(userCountryId() == $lang->id){}?>
									
									<div class="langItem <?php if(userCountryId() == $lang->id){echo "selectedLangItem";}?>" >
										<a href="<?php echo base_url().'update-user-country/'.$lang->id; ?>?type=insideweb" class="updateCountry">

										<img src="<?php  echo $lang->flag; ?>">
										<span class="countryHeading_  <?php if(userCountryId() == $lang->id){echo "selectedLangItemHeading";}?>"><?php echo $lang->title; ?></span>
										</a>
									</div>
								
									<?php } ?>
								</div>
							</div> -->
						</div>


					</div> 
					           
	
					<div class="header-logo logo-white sticky-logo">
					<a href="<?php echo base_url();?>" class="logo-light">
						<img width="170" src="<?php echo settings()->site_logo; ?>" class="attachment-full size-full" alt="" decoding="async" title="">	</a>
					<a href="<?php echo base_url();?>" class="logo-dark">
						<img width="170" src="<?php echo settings()->site_logo; ?>" class="attachment-full size-full" alt="" decoding="async" title="">	</a>
					</div>                
				</div>

				

</div>
<div class="contrySelection">
					<?php include('country_selections.php'); ?>
</div>
	
     <nav class="site-nav justify-content-center">
    <ul id="menu-main-menu" class="main-menu">
		<li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor  menu-item-20">
			<a href="<?php echo base_url();?>"  class="<?php  if($this->uri->segment(1) === NULL){echo "active_class";} ?>"  aria-current="page">Home </a>
		</li>
		
		<?php 
			$parents = $this->db->query("SELECT * FROM categories WHERE parent_id = 0 ORDER BY id ASC")->result_object();
			foreach ($parents as $key => $parent) {
		?>
			<li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor  menu-item-20">
				<a href="<?php echo base_url();?>classifieds/<?php echo $parent->slug;?>" aria-current="page"
					class="<?php echo $parent->slug == $this->uri->segment(2)?"active_class":"";?>"
					><?php echo $parent->title;?></a>
			</li>
		<?php  }?>

		<li id="menu-item-21" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-21">
		<a href="javascript:;" class="<?php if($this->uri->segment(1) == 'blog' || $this->uri->segment(1) == 'confessions' || $this->uri->segment(1) == 'forums' || $this->uri->segment(1) == 'about-us' || $this->uri->segment(1) == 'contact-us') {echo "active_class";} ?>">More</a>
		<ul class="sub-menu">
			<li id="menu-item-2509" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2509"><a href="<?php echo base_url();?>blog" class="<?php if( $this->uri->segment(1) == 'blog' ) {echo  'active_class';} ?>">Blog</a></li>
			<li id="menu-item-2509" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2509"><a href="<?php echo base_url();?>confessions" class="<?php if( $this->uri->segment(1) == 'confessions' ) {echo  'active_class';} ?>">Confessions</a></li>
			<li id="menu-item-2509" class=" menu-item menu-item-type-post_type menu-item-object-page menu-item-2509"><a href="<?php echo base_url();?>forums" class="<?php if( $this->uri->segment(1) == 'forums' ) {echo  'active_class';} ?>">Forum</a></li>
			<li id="menu-item-2509" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2509"><a href="<?php echo base_url();?>about-us" class="<?php if( $this->uri->segment(1) == 'about-us' ) {echo  'active_class';} ?>">About Us</a></li>
			<li id="menu-item-2509" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2509"><a href="<?php echo base_url();?>contact-us" class="<?php if( $this->uri->segment(1) == 'contact-us' ) {echo  'active_class';} ?>">Contact Us</a></li>
			
		</ul>
		</li>
		<style>
			.userCountryInHeader a{
				border: 1px solid #f0f0f0;
				padding: 0px 5px !important;
				border-radius: 6px;
				font-size: 14px !important;
				margin-right: 20px;
				color:black;

			}
			.userCountryInHeader a img{
				width: 24px;
				border-radius:10px;
			}
		</style>
		
		</ul>



</nav>	    

<div class="nav-action-elements">
        <ul>
		
		<li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor  menu-item-20 userCountryInHeader ">
			<a href="javascript:void(0)"  onclick="showCountryPopupToggle()" class=""  aria-current="page"><img src="<?php echo getCountryInfo()->flag ?? ''; ?>" > </a>
		</li>
            <li class="header-login" style="margin-left:0px;">
                <a <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="javascript:;" onclick="show_profile_option()"<?php } else {?>href="javascript:;" onclick="show_login_popup()"<?php } ?> class="login-btn">
                	<?php
	                	if(isset($_SESSION['LISTYLOGIN'])){
	                        if(user_info()->g_id != null){
	                            $url_image = user_info()->profile_pic;
	                            $ex = explode("=", $url_image);
	                            $url_image = $ex[0];
	                        } else {
	                            $url_image = user_info()->profile_pic;
	                        }
	                    }
                    ?>
                    <span class="user-login__icon" <?php if(isset($_SESSION['LISTYLOGIN'])){?> style="background: url('<?php echo $url_image;?>'); background-size: cover;"<?php } ?>>
					<span class="notificationCount" style="right: -5px; top: -7px;"></span>
                        	<?php if(isset($_SESSION['LISTYLOGIN'])){?>
                        	<?php } else { ?>
	                        <svg width="15" height="15" viewbox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
	                            <path d="M11.8036 4.22794C11.8036 1.89338 9.87618 0 7.49969 0C5.1232 0 3.19581 1.89338 3.19581 4.22794C3.19581 6.5625 5.1232 8.45588 7.49969 8.45588C9.87618 8.45588 11.8036 6.5625 11.8036 4.22794ZM4.31856 4.22794C4.31856 2.5 5.74072 1.10294 7.49969 1.10294C9.25867 1.10294 10.6808 2.5 10.6808 4.22794C10.6808 5.95588 9.25867 7.35294 7.49969 7.35294C5.74072 7.35294 4.31856 5.95588 4.31856 4.22794Z" fill="white"></path>
	                            <path d="M0.295372 14.9265C0.388934 14.9816 0.482497 15 0.576059 15C0.763185 15 0.969022 14.9081 1.06258 14.7243C2.37246 12.4449 4.84251 11.0294 7.49969 11.0294C10.1569 11.0294 12.6269 12.4449 13.9555 14.7243C14.1052 14.9816 14.4607 15.0735 14.7227 14.9265C14.9847 14.7794 15.0783 14.4301 14.9286 14.1728C13.4128 11.5625 10.5685 9.92647 7.49969 9.92647C4.43084 9.92647 1.58654 11.5625 0.0708215 14.1728C-0.0788786 14.4301 0.0146841 14.7794 0.295372 14.9265Z" fill="white"></path>
	                        </svg>
	                    	<?php } ?>
                    </span> 
                </a>
            </li>
        </ul>
        <?php if(isset($_SESSION['LISTYLOGIN'])){?>
	        <div class="notification_panel" id="profile_dropdown">
	        	<div class="welcome_dropd">
	        		Welcome, <span><?php echo user_info()->username;?></span>
	        	</div>
				<a href="<?php echo base_url();?>dashboard" class="profile_links_b">
					<div class="bold_head">Dashboard</div>
				</a>
				<a href="<?php echo base_url();?>my-chats?slug=dashboard" class="profile_links_b">
					<div class="bold_head "style="display:flex;justify-content: space-between;" >My Chats   <span class="chatCount" style="position:relative;"></span></div>
				</a>
				
				<a href="<?php echo base_url();?>profile" class="profile_links_b">
					<div class="bold_head">Account Details</div>
				</a>
				<a href="<?php echo base_url();?>notifications" class="profile_links_b">
					<div class="bold_head" style="display:flex;justify-content: space-between;">Notifications <span class="notificationCount" style="position:relative;"></span></div>
				</a>
				<a href="<?php echo base_url();?>new/post/events" class="profile_links_b">
					<div class="bold_head">Add a listing</div>
				</a>
				<!-- <a href="<?php echo base_url();?>payments" class="profile_links_b">
					<div class="bold_head">Payments</div>
				</a> -->
				
				<a href="<?php echo base_url();?>logout" class="profile_links_b">
					<div class="bold_head">Logout</div>
				</a>
			</div>
		<?php } ?>
    </div>
    <!-- Off Canvas Side Information -->
<div class="offcanvas-menu-wrap" id="offcanvas-wrap" data-position="right">
   <div class="close-btn offcanvas-close close-hover">
        <span>Close</span>
        <span class="animation-shape-lines">
            <span class="animation-shape-line eltdf-line-1"></span>
            <span class="animation-shape-line eltdf-line-2"></span>
        </span>
   </div>
    <div class="offcanvas-content">
      <div class="offcanvas-logo">
         <a href="<?php echo base_url();?>" class="main-logo rt-anima rt-anima--one">
            <img width="130" height="55" src="<?php echo settings()->site_logo; ?>" class="attachment-full size-full" alt="" decoding="async" title="">         </a>
      </div>
      <div class="offcanvas-info">
                  <span class="title rt-anima rt-anima--two">Contract Information</span>
                  <p class="text rt-anima rt-anima--three">
            Sunday,05 November 2022            <br>
            <span>2:00 PM – 3:30 PM</span>
         </p>
        
		 <p class="text rt-anima rt-anima--four">
            Mas Montagnette,            <br>
            198 West 21th Street,NY         </p>
                  <p class="text rt-anima rt-anima--five"><a href="tel:+1-485-048-1995">+1-485-048-1995</a></p>
                  <a class="offcanvas-info__link rt-anima rt-anima--six" href="./listing-map/index.html">View Map</a>
               </div>
            <div class="offcanvas-social rt-anima rt-anima--seven social-block">
         <ul>
                           <li class="facebook-wrap">
                  <a href="#" class="facebook" target="_blank">
                     <i class="fa-brands fa-facebook-f"></i>
                  </a>
               </li>
                           <li class="twitter-wrap">
                  <a href="#" class="twitter" target="_blank">
                     <i class="fa-brands fa-twitter"></i>
                  </a>
               </li>
                           <li class="linkedin-wrap">
                  <a href="#" class="linkedin" target="_blank">
                     <i class="fa-brands fa-linkedin-in"></i>
                  </a>
               </li>
                           <li class="instagram-wrap">
                  <a href="#" class="instagram" target="_blank">
                     <i class="fa-brands fa-instagram"></i>
                  </a>
               </li>
                           <li class="pinterest-wrap">
                  <a href="#" class="pinterest" target="_blank">
                     <i class="fa-brands fa-pinterest-p"></i>
                  </a>
               </li>
                     </ul>
      </div>
         </div>
</div>
<!-- Off Canvas Side Information End -->                
<div class="rt-mobile-menu mean-container" id="meanmenu"> 
    <div class="mean-bar headerBurgerMenu">
        <button class="headerBurgerMenu__button sidebarBtn" onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))" aria-label="Main Menu" aria-expanded="true">
            <svg width="50" height="50" viewbox="0 0 100 100">
            <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058">
            </path>
            <path class="line line2" d="M 20,50 H 80"></path>
            <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942">
            </path>
            </svg>
        </button>
    </div>
    <div class="rt-slide-nav">
        <div class="offscreen-navigation">
			
            <ul id="menu-main-menu-1" class="main-menu">
			<li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor  menu-item-20">
			<a href="<?php echo base_url();?>"  class="<?php  if($this->uri->segment(1) === NULL){echo "active_class";} ?>"  aria-current="page">Home </a>
		</li>
			<?php 
			$parents = $this->db->query("SELECT * FROM categories WHERE parent_id = 0 ORDER BY id ASC")->result_object();
			foreach ($parents as $key => $parent) {
		?>
			<li id="menu-item-20" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor  menu-item-20">
				<a href="<?php echo base_url();?>classifieds/<?php echo $parent->slug;?>" aria-current="page"
					class="<?php echo $parent->slug == $this->uri->segment(2)?"active_class":"";?>"
					><?php echo $parent->title;?></a>
			</li>
		<?php  }?>
				

				<!-- <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-10 current_page_item current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-20">
				<a href="contact-us" aria-current="page" class="<?php if( $this->uri->segment(1) == 'contact-us' ) {echo  'active_class';} ?>">Contact Us</a>
				</li> -->



<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-145" id="mobileMenuMore" >
<a href="javascript:;" id="" onclick="menuMoreToggle()" class="<?php if($this->uri->segment(1) == 'blog' || $this->uri->segment(1) == 'confessions' || $this->uri->segment(1) == 'forums' || $this->uri->segment(1) == 'about-us' || $this->uri->segment(1) == 'contact-us') {echo "active_class";} ?>">More</a>
<ul class="sub-menu" id="mobileMenuMoreOptions">
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-146"><a href="<?php echo base_url();?>blog" class="<?php if( $this->uri->segment(1) == 'blog' ) {echo  'active_class';} ?>">Blog</a></li>
	<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-8234"><a href="<?php echo base_url();?>confessions" class="<?php if( $this->uri->segment(1) == 'confessions' ) {echo  'active_class';} ?>">Confessions</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8365"><a href="<?php echo base_url();?>forums" class="<?php if( $this->uri->segment(1) == 'forums' ) {echo  'active_class';} ?>">Forum</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-rtcl_listing menu-item-423"><a href="<?php echo base_url();?>about-us" class="<?php if( $this->uri->segment(1) == 'about-us' ) {echo  'active_class';} ?>">About Us</a></li>
	<li class="menu-item menu-item-type-post_type menu-item-object-rtcl_listing menu-item-423"><a href="<?php echo base_url();?>contact-us" class="<?php if( $this->uri->segment(1) == 'contact-us' ) {echo  'active_class';} ?>">Contact Us</a></li>

</ul>
</li>

</ul>       

    </div>
</div>
            </div>
        </div>
    </div>
</header>
</div>


<!-- //Country selection popup -->
<style>
	.country-card {
            width: 100%;
            height: auto;
            background-color: #fff;
            margin-bottom: 0px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 5px;
            text-decoration: none;
            color: #202020;
        }
        
        .country-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-color: #e3866b;
            color: #fff;
        }

        .country-flag {
            width: auto;
            max-height: 35px;
            display: block;
            margin: 0 auto;
        }

        .country-name {
            padding: 10px 0px  0px;
            text-align: center;
            font-size: 12px;
            text-transform: uppercase;
            font-weight: normal;
            
            
        }
		/* #countryContainer{
			display:flex;
			justify-content: space-between;
			align-items: center;
			gap: 20px;
			margin-top: 25px;
			
		} */

		#countryContainer {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Default to 3 items per row */
    gap: 20px;
    margin-top: 25px;
}

@media (max-width: 900px) {
    #countryContainer {
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); /* Adjust to 1 item per row or more */
    }
}


		
		
</style>

<div class="outer_wrap" id="country_popup" style='display:<?php echo  userSelectOrNotCountry() != false ? 'none' : 'block';  ?>' style="height:200px;">
    <div class="outer_wrap_inner">
        <div class="center_white_outer" style="height: auto; padding-bottom: 30px;">
		<a href="<?php echo base_url().'cancel-country-selection'; ?>"> 
			<div class="close_poup">
                <i class="fa fa-close"></i>
            </div>
			</a>
        
            <main id="main" class="site-main">
				<h6 style="text-align:center; margin-top:10px;">Select Country</h6>
			<div class="container container_" id="countryContainer">

        <?php
		$isSearchPage = '';
		if($this->uri->segment(2) == "searchClassifiedsByCountry") {
			$isSearchPage = '&reset=1';
		 }
          
		 $listOfCountries = $this->db->get('admin_countries')->result_object();
          foreach ($listOfCountries as $country) {
             echo '<a href='.base_url().'update-user-country/'.$country->id.'?type=update-country'.$isSearchPage.'  class="country-card">';

            // echo '<a href="#" data-toggle="modal" data-target="#exampleModal" class="country-card" onclick="showCitiesPopup('.$country->id.')">';
            echo '<img src="' . $country->flag . '" alt="' . $country->title . '" class="country-flag">';
            echo '<div class="country-name">' . $country->title . '</div>';
            echo '</a>';
        }
        
        ?>
    </div>
            </main>
        </div>
    </div>
</div>

<script>

	
	function showCountryPopupToggle() {
    jQuery("#country_popup").fadeToggle(200); 
}


	function menuMoreToggle() {
    jQuery("#mobileMenuMoreOptions").slideToggle(function() {
        if (jQuery("#mobileMenuMoreOptions").is(":visible")) {
            jQuery('#mobileMenuMore span').addClass('open');
        } else {
            jQuery('#mobileMenuMore span').removeClass('open');
        }
    });
}





</script>


