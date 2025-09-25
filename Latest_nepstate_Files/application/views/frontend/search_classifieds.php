

<?php include("common/header.php"); ?>
<?php
if(!isset($_SESSION['show_popup_login'])){
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

<?php 
$category = $this->db->query("SELECT * FROM categories WHERE slug = '".$slug."'")->result_object()[0]; ?>

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
            $qry_sub = "AND  expiry_date <= CURRENT_DATE AND expiry_date >= DATE_ADD(CURRENT_DATE, INTERVAL -30 DAY) ";
        } else {
            $qry_sub = " AND sub_cat = '".$_GET['sub']."'";
        }
        
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

                            ".$country_city_ConditionQuery."
                            AND category = '".$slug."'
                            ".$qr_text." ".$qry_sub."
                        HAVING (distance <= 50 OR (latitude = '' ) ) ".$sort_qry;
        } else {
            $query_show = "SELECT * FROM products WHERE category = '".$slug."' ".$qr_text." ".$qry_sub." ".$country_city_ConditionQuery." AND status = 1"  .$sort_qry;
        }

        // $all_products = $this->db->query($query_show)->result_object();
    }
    
    // echo $this->db->last_query();

?>

 <div class="listing-breadcrumb listing-archive-page" style="margin-top: 0;">
                        <div class="container-fluid custom-padding">
                <div class="breadcrumb-area"><div class="entry-breadcrumb">
<!-- Breadcrumb NavXT 7.2.0 -->
<meta property="position" content="2"></span>
</div></div>              </div>
                  </div>

        <div class="container-fluid custom-padding">
      <div id="primary" class="content-area rtcl-container"><main id="main" class="site-main" role="main">      <div class="row">
        <div class="col-lg-12 order-2">
                      <div class="listing-box-grid">
              <div class="rtcl-notices-wrapper"></div>
<div class="rtcl-listings-actions">
    <div class="rtcl-result-count">
        Showing <?php echo count($all_products);?> result(s)
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
        



        

      </div>
      </main></div>    </div>
</section> 



<?php include("common/footer.php"); ?>

<script type="text/javascript">
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
</script>