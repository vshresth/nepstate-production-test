<?php 
// SEO Variables for Category Pages
$category = $this->db->query("SELECT * FROM categories WHERE slug = '".$slug."'")->result_object()[0];
$page_title = ucfirst($category->title) . " - NepState | " . $category->title . " Listings";
$meta_description = "Find the best " . strtolower($category->title) . " listings on NepState. " . strip_tags($category->text_lorum);
$meta_keywords = $category->title . ", Nepalese " . strtolower($category->title) . ", " . strtolower($category->title) . " listings";
$canonical_url = base_url() . "classifieds/" . $category->slug;

include("common/header.php"); 
if(!isset($_SESSION['show_popup_login'])){
    // echo $slug;
    // die;
    if($tags==1){
         $_SESSION['RETURN'] = "new/post/events"; 
    } else {
        $_SESSION['RETURN'] = "new/post/".$slug; 
    }
}
?>
<style type="text/css">
    .rtcl-widget-categories>.rtcl-category-list>li span.dropdown {
        width: 25px;
        height: 20px;
        font-size: 13px;
    }
    .header_bottom_mmm {
        display: none;
    }
    /*.advetise_button {
        bottom: <?php echo $slug=="events"?"45px":"20px";?>;
    }*/
</style>

<?php // Category already loaded above for SEO ?>

<section class="listing-archvie-page bg--accent" style="padding-top: 20px;">
<div class="container-fluid mb-20">
    
<div class="wrapper" style="clear: both; margin-bottom: 20px;">
    <?php 
        $show_home = 0;
        include("common/header_full.php"); 
    ?>
<?php 
    //$all_products = $this->db->query("SELECT * FROM products WHERE category = '".$category->slug."' AND sub_plan_id = 'category_home_page' AND status = 1 ORDER BY id DESC")->result_object();
    //if(!empty($all_products)){
?>

<?php //} ?>
</div>
 <div class="wd100 container-fluid custom-padding">

    <?php 
        if($tags == 1){
            $url_after_login = "new/post/events";
        } else {
            $url_after_login = "new/post/".$slug;
        } 
    ?>
        <a 
        <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="<?php echo base_url();?><?php echo $url_after_login;?>"<?php } else {?>href="javascript:;" onclick="show_login_popup()"<?php } ?>
        class="listygo-btn listygo-btn--style1" style="margin-bottom: 10px; float: right; margin-right: -15px;">
            <span class="listygo-btn__icon">
                <i class="fa-solid fa-plus"></i>
            </span>
            <span class="listygo-btn__text">Add Listing</span>
        </a>
    </div>
</div>



<?php 

    $sort_qry = " ORDER BY id DESC";
    if(isset($_GET['sort'])){
        $sort = $_GET['sort'];
        if($sort == "title-asc"){
            $sort_qry = " ORDER BY title ASC";
        } else if($sort == "title-desc"){
            $sort_qry = " ORDER BY title DESC";
        } else if($sort == "date-asc"){
            $sort_qry = " ORDER BY created_at ASC";
        } else if($sort == "views-desc"){
            $sort_qry = " ORDER BY views DESC";
        } else if($sort == "views-asc"){
            $sort_qry = " ORDER BY views ASC";
        } 
        else {
            $sort_qry = " ORDER BY id DESC";
        }
    }
    $qry_sub = "";
    if(isset($_GET['sub'])){
        if($_GET['sub'] == "expired"){
            $qry_sub = "AND expiry_date BETWEEN DATE_ADD(CURRENT_DATE, INTERVAL -30 DAY) AND CURRENT_DATE ";
        } else {
            $qry_sub = " AND expiry_date > CURRENT_DATE AND sub_cat = '".$_GET['sub']."'";
        }
        
    }else{
        $qry_sub = " AND expiry_date > CURRENT_DATE";
    }

    $qr_text = "";
    if(isset($_POST['q']) && $_POST['q'] != ""){
        $qr_text = " AND LOWER(title) LIKE '%".strtolower($_POST['q'])."%' ";
    }
    if(isset($_POST['city']) && $_POST['city'] != ""){
        $qr_text .= " AND LOWER(city) LIKE '%".strtolower($_POST['city'])."%' ";
    }
    if(isset($_POST['state']) && $_POST['state'] != ""){
        $qr_text .= " AND LOWER(state) LIKE '%".strtolower($_POST['state'])."%' ";
    }
    if(isset($_POST['zipccc']) && $_POST['zipccc'] != ""){
        $qr_text .= " AND LOWER(zip_code) LIKE '%".strtolower($_POST['zipccc'])."%' ";
    }

    

    if($tags == 1){
        
        // $all_products = $this->db->query("SELECT *
        //     FROM products
        //     WHERE JSON_EXTRACT(json_content, '$.event_tags') LIKE '%".strtolower($slug)."%'
        //        OR JSON_EXTRACT(json_content, '$.service_tags') LIKE '%".strtolower($slug)."%'
        //        OR JSON_EXTRACT(json_content, '$.training_courses') LIKE '%".strtolower($slug)."%'
        //        OR JSON_EXTRACT(json_content, '$.title') LIKE '%".strtolower($slug)."%'
        //     ")->result_object();

        $all_products = $this->db->query("SELECT *
            FROM products
            
            WHERE JSON_UNQUOTE(JSON_EXTRACT(json_content, '$.event_tags')) LIKE '%".strtolower($slug)."%'
               OR JSON_UNQUOTE(JSON_EXTRACT(json_content, '$.service_tags')) LIKE '%".strtolower($slug)."%'
               OR JSON_UNQUOTE(JSON_EXTRACT(json_content, '$.training_courses')) LIKE '%".strtolower($slug)."%'
               OR JSON_UNQUOTE(JSON_EXTRACT(json_content, '$.title')) LIKE '%".strtolower($slug)."%'
               ".$country_city_ConditionQuery_classified."
            ")->result_object();


    } else {

        // print_r($_POST);
        // echo "<br>";echo "<br>";
        // die;

       
        $ipcheck = user_ip_check();
        // if(!empty($ipcheck)|| isset($_POST['center_lat']) && $_POST['center_lat'] != ""){
        if(isset($_POST['center_lat']) && $_POST['center_lat'] != "" || isset(($_GET['latitude'])) ){
            if(isset($_POST['center_lat']) && $_POST['center_lat'] != ""){
                $user_lat = $_POST['center_lat'];
                $user_lng = $_POST['center_lng'];
            } else {
                // $user_lat = $ipcheck->lat;
                // $user_lng = $ipcheck->lng;
                $user_lat = $_GET['latitude'];
                $user_lng = $_GET['longitude'];
            }
            $query_show = "SELECT
                           *,
                            longitude,
                            (
                                3959 * acos(
                                    cos(radians($user_lat)) * cos(radians(latitude)) *
                                    cos(radians(longitude) - radians($user_lng)) +
                                    sin(radians($user_lat)) * sin(radians(latitude))
                                )
                            ) AS distance
                        FROM
                            products
                        WHERE
                            status = 1
                            AND latitude != '' AND longitude != ''
                           
                            ".$country_city_ConditionQuery_classified."
                            AND category = '".$slug."'
                            ".$qr_text." ".$qry_sub."
                        HAVING (distance <= 50 OR (latitude = '' ) ) ".$sort_qry;
        } else {
            $query_show = "SELECT * FROM products WHERE  category = '".$slug."' ".$qr_text." ".$qry_sub." ".$country_city_ConditionQuery_classified." AND status = 1"  .$sort_qry;
        }

        $all_products = $this->db->query($query_show)->result_object();
    }


    if($advance_search == 1){
       
        
        $queryCity = "";
        if (!empty($userCityName)) {
            $userCityName = strtolower($userCityName);
            $userCityName = $this->db->escape_str($userCityName);
            $queryCity = " AND ( city_id = '".$userCityName."' 
                            OR LOWER(city) = '".$userCityName."' 
                            OR LOWER(state) = '".$userCityName."' )";
        }
        
        $countryID = !empty($country_id) ? intval($country_id) : 0;
        
        $keywords = $this->db->escape_str(strtolower($keywords));
        $advanceSearchQuery = "SELECT * FROM products
                               WHERE category = '".$this->db->escape_str($slug)."'
                               AND country_id = ".$countryID." 
                               AND status = 1
                               AND (LOWER(title) LIKE '%".$keywords."%'
                                    OR LOWER(JSON_EXTRACT(json_content, '$.description')) LIKE '%".$keywords."%') "
                               . $queryCity . $qr_text . " " . $qry_sub . " " . $sort_qry;
        
        $all_products = $this->db->query($advanceSearchQuery)->result_object();
        
    }

 
    
    
    // echo $this->db->last_query();

?>

 <div class="listing-breadcrumb listing-archive-page" style="margin-top: 0;">
                        <div class="container-fluid custom-padding">
                <div class="breadcrumb-area"><div class="entry-breadcrumb">
<!-- Breadcrumb NavXT 7.2.0 -->
<span property="itemListElement" typeof="ListItem"><a property="item" typeof="WebPage" title="" href="<?php echo base_url(); ?>" class="home"><span property="name">Home </span></a><meta property="position" content="1"></span> &gt; <span property="itemListElement" typeof="ListItem"><span property="name" class="archive post-rtcl_listing-archive current-item"> <?php echo $slug == 'index.php' ? 'Classifieds Listing' : $slug; ?></span><meta property="url" content="<?php echo base_url(); ?>">
<meta property="position" content="2"></span>
</div></div>              

</div>
                  </div>

    <div class="container-fluid custom-padding">
      <div id="primary" class="content-area rtcl-container"><main id="main" class="site-main" role="main">      <div class="row">
        <div class="col-lg-9 order-2">
                      <div class="listing-box-grid">
              <div class="rtcl-notices-wrapper"></div>
<div class="rtcl-listings-actions">
    <div class="rtcl-result-count">
        Showing <?php echo count($all_products);?> result(s)
</div>
    <select name="orderby" class="orderby" aria-label="Listing order" onchange="do_show_order_by_sort(this.value)" style="width:25%">
            <option value="" <?php if(!isset($_GET['sort'])){echo "SELECTED";}?>>Newest</option>
            <option value="title-asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "title-asc"?"SELECTED":"";?>>A to Z ( title )</option>
            <option value="title-desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "title-desc"?"SELECTED":"";?>>Z to A ( title )</option>
            <option value="date-asc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "date-asc"?"SELECTED":"";?>>Oldest</option>
            <option value="views-desc" <?php echo isset($_GET['sort']) && $_GET['sort'] == "views-desc"?"SELECTED":"";?>>Most viewed</option>
            <option value="near-me" <?php echo isset($_GET['sort']) && $_GET['sort'] == "near-me"?"SELECTED":"";?>>Near My Location</option>
           <!--  <option value="price-asc">Price ( low to high )</option>
            <option value="price-desc">Price ( high to low )</option> <?php echo base_url();?>classifieds?view=list-->
    </select>
<div class="rtcl-view-switcher" >
            <a class="rtcl-view-trigger list" data-type="list" href="javascript:;" onclick="do_change_view('list')">
            <img src="<?php echo $assets;?>assets/images/icon-list.svg" alt="" loading="lazy">
        </a>
            <a class="rtcl-view-trigger active grid" data-type="grid" href="javascript:;" onclick="do_change_view('grid')">
            <img src="<?php echo $assets;?>assets/images/icon-large.svg" alt="" loading="lazy">
        </a>
    </div>
</div>
<?php if(empty($all_products)){?>
    <div class="rtcl-listings-actions wd100 text-center" style="justify-content: center;
    color: #f00;">
        No Classifieds found!
    </div>
<?php } ?>
<div class="rtcl-listings custom_listing_view_ab rtcl-grid-view columns-3">


<?php 

    // echo $this->db->last_query();
    include("common/classified.php");
?>

</div>            
</div>
<?php /* ?>
    <nav class="rtcl-pagination">
        <ul class="page-numbers">
            <li><span aria-current="page" class="page-numbers current">1</span></li>
            <li><a class="page-numbers" href="#">2</a></li>
            <li><a class="page-numbers" href="#">3</a></li>
            <li><a class="page-numbers" href="#">4</a></li>
            <li><a class="next page-numbers" href="#"><i class="fa-solid fa-angle-right" aria-hidden="true"></i></a></li>
        </ul>
    </nav>
<?php */ ?>
</div>
        
<div class="col-lg-3 order-lg-1 listing-sidebar-left">
    <div class="listing-sidenar-widgets">
        <div id="rtcl-widget-categories-5" class="widget rtcl rtcl-widget-categories-class sidebar-widget">
            <div class="" style="width:100%;">
                <h3 class="widget-title flex_space_between" >
                    <span>
                    Top Categories
                    </span>
                    <button class="btn btn-dark btn-sm" id="toggleCategoriesBtn">+</button></h3>
                
            </div>

<div class="rtcl rtcl-widget-categories" id="categoriesBox">
    <ul class="rtcl-category-list">

<?php
$categories = $this->db->query("SELECT * FROM categories WHERE parent_id = 0 AND status = 1")->result_object();
foreach ($categories as $key => $cat) {
    $total_ads = $this->db->query("SELECT * FROM products  WHERE category = '".$cat->slug."' ".$country_city_ConditionQuery_classified." AND expiry_date > CURRENT_DATE "  )->num_rows();
    $sub_cats = $this->db->query("SELECT * FROM categories WHERE parent_id = '".$cat->id."' AND status = 1")->result_object(); 
?>
<li class="<?php echo $slug == $cat->slug?'open_tpoo':'';?>">
    <a href="<?php echo base_url()."classifieds/".$cat->slug;?>"  style="font-size: 14px;  padding-bottom: 12px; border-bottom: 1px dotted #f0f0f0"><?php echo $cat->title; ?><span>(<?php echo $total_ads; ?>)</span></a>
    <?php if(!empty( $sub_cats)){?>
        <ul class="rtcl-category-list" <?php if($slug == $cat->slug){?>style="display:block;"<?php } ?>>
            <?php 
                foreach ($sub_cats as $key => $sub) {
                    $total_sub_ads = $this->db->query("SELECT * FROM products WHERE sub_cat = '".$sub->slug."' ".$country_city_ConditionQuery_classified." AND expiry_date > CURRENT_DATE" )->num_rows();
            ?>
            <li><a href="<?php echo base_url()."classifieds/".$cat->slug;?>?sub=<?php echo $sub->slug;?>" style="font-size: 13px; "><?php echo $sub->title; ?><span>(<?php echo $total_sub_ads;?>)</span></a></li>
            <?php } ?>

            <?php
                $qry_sub = "AND  expiry_date <= CURRENT_DATE AND expiry_date > DATE_ADD(CURRENT_DATE, INTERVAL -30 DAY) ";
                $total_expired = $this->db->query("SELECT * FROM products WHERE category = '".$cat->slug."' ".$country_city_ConditionQuery_classified." " .$qry_sub)->num_rows();
            ?>
            <li><a href="<?php echo base_url()."classifieds/".$cat->slug;?>?sub=expired" style="font-size: 13px; ">Expired <?php echo $cat->title; ?> (30 Days) <span>(<?php echo $total_expired;?>)</span></a></li>
        </ul>
        <span class="dropdown <?php echo $slug == $cat->slug?'open':'';?>"></span>
    <?php } ?>
</li>
<?php } ?>
</ul>
</div>
</div>

<div id="listygo_advanced_search-2" class="widget widget_listygo_advanced_search sidebar-widget"><div class="orientation-inline ">      <div class="title-btn">
<div class="" style="width:100%;">
            <h3 class="widget-title flex_space_between " > 
                <span>Advanced Search</span>
            <button class="btn btn-dark btn-sm" id="toggleAdvancedSearchBtn">+</button>           
            </h3>
</div>        
            <button class="reset-btn">
                <?php if(isset($_POST) && count($_POST)>0){?>
                    <a href="<?php echo base_url();?>nepstate/do_clear_search?slug=<?php echo $slug;?>" style="color: red;">
                        Clear All      
                    </a>
                <?php } ?>
            </button>
        </div>
        <!-- <?php echo base_url();?>nepstate/do_search_keyword -->
        
        <div class="rtcl rtcl-widget-search listing-inner" id="advancedSearchBox">
<form method="post" action="<?php echo base_url() ?>Nepstate/classifiedAdvancedSearch" class="form-vertical rtcl-widget-search-form rtcl-search-inline-form listygo-listing-search-form rtin-style-s">
<div class="search-box">
                <div class="search-item search-keyword">
                    <div class="input-group">
                        <input type="text" data-type="listing" name="keyword" class="rtcl-autocomplete form-control" placeholder="What are you looking for?" value="<?php echo $keywords; ?>" required>
                    </div>
                </div>
                <div class="distance-search">
                    <!-- <div class="form-group ws-item ws-location">
                        <div class="rtcl-geo-address-field">
                            <input type="text" name="geo_address" autocomplete="off" value="<?php echo $_POST['geo_address'];?>" placeholder="Search with location..." class="form-control rtcl-geo-address-input">
                            <input type="hidden" class="latitude" name="center_lat" value="<?php echo $_POST['center_lat'];?>">
                            <input type="hidden" class="longitude" name="center_lng" value="<?php echo $_POST['center_lng'];?>">
                        </div>
                       
                    </div> -->
                    <?php 
                        $cities = $this->db->query("SELECT DISTINCT(city) FROM `products` WHERE  city != '' ".$country_city_ConditionQuery_classified." ORDER BY city ASC")->result_object();
                        $states = $this->db->query("SELECT DISTINCT(state) FROM `products` WHERE  state != '' ".$country_city_ConditionQuery_classified." ORDER BY state ASC")->result_object();

                    ?>
                     <!-- <div class="form-group ws-item ws-location">
                        <div class="rtcl-geo-address-field">
                            <select class="form-control" name="city">
                                <option value="">--Select City--</option>
                                <?php foreach ($cities as $key => $c) { ?>
                                    <option value="<?php echo $c->city;?>" <?php echo $_POST['city'] == $c->city?"SELECTED":""; ?>><?php echo $c->city;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div> -->

                    <div class="form-group ws-item ws-location">
                        <div class="rtcl-geo-address-field">
                        <select name="countryCode" class="form-control custom-select" aria-label="Listing order" id="countrySelect3" required>
                        <option value="">--Select Country--</option>																			<!-- <option value="" selected>Select Location</option> -->

                            <?php

                                    $listOfCountries = $this->db->get('admin_countries')->result_object();
                                    foreach($listOfCountries as $country) {

                                        if($country_id != 0 ) {
                                            
                                                if($country_id == $country->id) {

                                                    ?>
                                                        <option selected value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>               

                                                    <?php
                                                }else{
                                                    ?>  

                                                        <option value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>  
                                                    <?php
                                                }
                                            ?>

                                                
                                            <?php
                                        }else{

                                            if(userCountryId() == $country->id) {
                                                ?>
                                                    <option selected value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>  
                                                <?php
                                            }else{
                                                ?>
                                                    <option value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>  
                                                <?php
                                            }
                                            
                                        }
                                    }		
                            ?>      
                            

                        </select>

                        </div>
                    </div>

                <!-- <div class="form-group ws-item ws-location">
                        <div class="rtcl-geo-address-field">
                            <select class="form-control" name="state">
                                <option value="">--Select State--</option>
                                <?php foreach ($states as $key => $c) { ?>
                                    <option value="<?php echo $c->state;?>" <?php echo $_POST['state'] == $c->state?"SELECTED":""; ?>><?php echo $c->state;?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    -->

                    <!-- <div class="form-group ws-item ws-location">
                        <div class="rtcl-geo-address-field">
                            <input type="text" name="zipccc" class="form-control" placeholder="Zip Code" value="<?php echo $_POST['q'];?>">
                        </div>
                    </div> -->
                    <div class="form-group ws-item ws-location">
                        <div class="rtcl-geo-address-field">
                            <input type="text" class="form-control" id="cityZipInput3" placeholder="Enter a Zip Code or City">
                        </div>
                    </div>
                </div>
            <div class="search-item search-btn mb-0">
            <input type="hidden" id="userCityText3" name="userCityName" class="form-control">
            <input type="hidden" id="" name="postLocation" value="classified" class="form-control">
            <input type="hidden" id="" name="slug" value="<?php echo $slug; ?>" class="form-control">

            <button type="submit" class="submit-btn" id="updateLocationButton3"><svg class="hero-buttons__search" width="26" height="26" viewbox="0 0 26 26" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M11.1852 21.1545C5.4588 21.1545 0.800049 16.4993 0.800049 10.7773C0.800049 5.05522 5.4588 0.400024 11.1852 0.400024C16.9116 0.400024 21.5703 5.05522 21.5703 10.7773C21.5703 16.4993 16.9116 21.1545 11.1852 21.1545ZM11.1852 2.36727C6.54436 2.36727 2.7688 6.13996 2.7688 10.7773C2.7688 15.4146 6.54436 19.1872 11.1852 19.1872C15.826 19.1872 19.6016 15.4146 19.6016 10.7773C19.6016 6.13996 15.826 2.36727 11.1852 2.36727ZM25.7118 25.312C26.0961 24.9278 26.0961 24.305 25.7118 23.9209L21.3067 19.5192C20.9222 19.135 20.2989 19.135 19.9145 19.5192C19.5301 19.9033 19.5301 20.5261 19.9145 20.9103L24.3196 25.312C24.5118 25.504 24.7637 25.6 25.0157 25.6C25.2676 25.6 25.5195 25.504 25.7118 25.312Z" fill="white"></path>
        </svg>Search</button>
            </div>
        </div>
    </form>
</div>
</div></div>    


</div>
</div>
      </div>
      </main></div>    </div>
</section> 



<?php include("common/footer.php"); ?>

<script type="text/javascript">
jQuery("#toggleCategoriesBtn").click(function() {
    jQuery("#categoriesBox").slideToggle(function() {
        if (jQuery("#categoriesBox").is(":visible")) {
            jQuery("#toggleCategoriesBtn").text("-");
        } else {
            jQuery("#toggleCategoriesBtn").text("+");
        }
    });
});

jQuery("#toggleAdvancedSearchBtn").click(function() {
    jQuery("#advancedSearchBox").slideToggle(function() {
        if (jQuery("#advancedSearchBox").is(":visible")) {
            jQuery("#toggleAdvancedSearchBtn").text("-");
        } else {
            jQuery("#toggleAdvancedSearchBtn").text("+");
        }
    });
});


    <?php if(isset($_GET['sort']) && $_GET['sort'] == "near-me" && !isset($_GET['latitude'])){ ?>
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                window.location.href="<?php echo base_url();?>classifieds/<?php echo $slug;?>?sort=near-me&latitude="+latitude+"&longitude="+longitude;
            });
        } else {
            alert("Geolocation is not available in your browser.");
        }
    <?php } ?>
   
    function do_show_order_by_sort(val){
        if(val == ""){
            <?php if(isset($_GET['sub'])){?>
                window.location.href = "<?php echo base_url();?>classifieds/<?php echo $slug; ?>?sub=<?php echo $_GET['sub'];?>";
            <?php }  else { ?>
                window.location.href = "<?php echo base_url();?>classifieds/<?php echo $slug; ?>";
            <?php } ?>
        } else {
            <?php if(isset($_GET['sub'])) { ?>
                window.location.href = "<?php echo base_url();?>classifieds/<?php echo $slug; ?>?sub=<?php echo $_GET['sub'];?>&sort="+val;
            <?php }  else { ?>
                window.location.href = "<?php echo base_url();?>classifieds/<?php echo $slug; ?>?sort="+val;
            <?php } ?>
        }
    }
    function do_change_view(val) {
        jQuery(".custom_listing_view_ab").removeClass('rtcl-list-view');
        jQuery(".custom_listing_view_ab").removeClass('rtcl-grid-view');
        jQuery(".grid").removeClass("active");
        jQuery(".list").removeClass("active");
        if(val == 'grid'){
            jQuery(".custom_listing_view_ab").addClass('rtcl-grid-view');
            jQuery("."+val).addClass("active");
        } else {
            jQuery(".custom_listing_view_ab").addClass('rtcl-list-view');
            jQuery("."+val).addClass("active");
        }
    }


    


    function initAutocomplete3() {

let countrySelect = document.getElementById('countrySelect3');
let cityZipInput = document.getElementById('cityZipInput3');
let updateButton = document.getElementById('updateLocationButton3');

let userCountry_ = '<?php echo getCountryCodeById($country_id); ?>';
sessionStorage.setItem('userCountry', userCountry_);

let userCountry = sessionStorage.getItem('userCountry');

let autocompleteOptions = {
    types: ['(regions)'],
    componentRestrictions: { country: userCountry }
};

const autocomplete = new google.maps.places.Autocomplete(cityZipInput, autocompleteOptions);
autocomplete.setFields(['address_components', 'geometry']);

countrySelect.addEventListener('change', function() {
    sessionStorage.removeItem('userCountry');
    localStorage.setItem('userCountry', countrySelect.value);
    autocompleteOptions.componentRestrictions = { country: countrySelect.value };
    autocomplete.setOptions(autocompleteOptions);

    cityZipInput.value = '';
    // updateButton.style.background = '#EBEBE4';
    // updateButton.disabled = true;
});
    autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            // console.log('Selected Place:', place.formatted_address);
            // console.log('Place Details:', place);

            // Get the long name of the selected city
            let cityName = '';
            const addressComponents = place.address_components;
            console.log(addressComponents)
            for (let i = 0; i < addressComponents.length; i++) {
            const component = addressComponents[i];
            console.log(component.types.includes('locality'))
                if (component.types.includes('locality') || component.types.includes('political') || component.types.includes('country') || component.types.includes('administrative_area_level_2') || component.types.includes('administrative_area_level_1') || component.types.includes('sublocality')) {
                    cityName = component.long_name;
                    // updateButton.style.background = '#FF9902';
                    // updateButton.disabled = false;

                    break;
                }
            }
            document.getElementById('userCityText3').value = cityName;
            console.log('Selected City (Short Name):', cityName);
        });
}
               
// Initialize the autocomplete feature when the page loads
google.maps.event.addDomListener(window, 'load', initAutocomplete3);



</script>