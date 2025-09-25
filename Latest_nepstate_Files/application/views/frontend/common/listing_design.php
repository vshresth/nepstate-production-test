<?php 
	
	$all_products = $this->db->query("SELECT * FROM products WHERE category = '".$cat_data->slug."' ".$country_city_ConditionQuery_classified." AND sub_plan_id = 'website_home_category_section' AND expiry_date > '".date("Y-m-d")."' AND status = 1 ORDER BY id DESC")->result_object();
	
	// echo $this->db->last_query();
	// if(!empty($all_products)){
		$not_in = '-1,';
		foreach ($all_products as $key => $b) {
			$not_in .= $b->id.","; 
		}
		$not_in = substr($not_in, 0, -1);

?>
<section class="elementor-section elementor-top-section elementor-element elementor-element-80a9985 elementor-section-full_width elementor-section-height-default elementor-section-height-default rt-parallax-bg-no elementor-section-boxed" data-id="80a9985" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-aa60a03" data-id="aa60a03" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-aa6e864 elementor-align-center elementor-widget elementor-widget-rt-title" data-id="aa6e864" data-element_type="widget" data-widget_type="rt-title.default">
				<div class="elementor-widget-container">
			<div class="section-heading" style="margin-top:30px">
	        <div class="heading-subtitle">Our <?php echo $cat_data->title;?> Listing</div>
    <h2 class="heading-title">New listings in <?php echo $cat_data->title;?> </h2>
<p><?php echo $cat_data->text_lorum; ?></p>    </div>		</div>
				</div>
				<div class="elementor-element elementor-element-d318af1 elementor-invisible elementor-widget elementor-widget-rt-listings" data-id="d318af1" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="rt-listings.default">
				<div class="elementor-widget-container">
			
<div class="listing-box-wrap listing-shortcode listing-slider-shortcode">
  <div class="swiper-custom swiper">
    <div class="swiper-wrapper" data-carousel-options="{&quot;col_xl&quot;:&quot;4&quot;,&quot;autoplay&quot;:false,&quot;speed&quot;:&quot;2000&quot;,&quot;col_lg&quot;:&quot;4&quot;,&quot;col_md&quot;:&quot;3&quot;,&quot;col_sm&quot;:&quot;2&quot;,&quot;col_xs&quot;:&quot;1&quot;}">
           <?php 
           		$show_slider = 1;
	           	include("classified.php");
           ?>
           <?php 
           		$remaining_products =  (9 - count($all_products)); 
           		$all_products = $this->db->query("SELECT * FROM products WHERE category = '".$cat_data->slug."' ".$country_city_ConditionQuery_classified." AND expiry_date > '".date("Y-m-d")."' AND status = 1 AND id NOT IN (".$not_in.") ORDER BY  RAND() LIMIT 0, ".$remaining_products)->result_object();
           		// echo $this->db->last_query();
           		$show_slider = 1;
	           	include("classified.php");
           ?>
            
            
  </div>
      <div class="swiper-pagination"></div>
  </div>
		</div>
				</div>
					</div>
		</div>
							</div>
		</section>
		<?php if($cat_data->slug == "jobs"){?>
			<div class="ad-container" id="dummy-ad" style="margin-bottom: 30px; margin-top: 25px;">
			<img src="https://via.placeholder.com/1050x190" alt="Dummy Ad">
			</div>
		<?php } ?>

		<?php if($cat_data->slug == "it-trainings"){?>
			<div class="ad-container" id="dummy-ad" style="margin-bottom: 30px; margin-top: 25px;">
			<img src="https://via.placeholder.com/1050x190" alt="Dummy Ad">
			</div>
		<?php } ?>

		<?php 
			if($cat_data->slug == "services"){ 
				
				$isPromotions = 1;
				include("ads_boxes.php");
		 	} 
		?>
<?php //} ?>
					