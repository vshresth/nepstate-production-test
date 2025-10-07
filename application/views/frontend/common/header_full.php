
<style type="text/css">
.bg-slider {
	 position: relative;
	 display: flex;
	 align-items: center;
	 justify-content: center;
}
.bg-slider	.swiper-container {
  width: 100%;
  height: 100%;
}

.bg-slider .swiper-slide {
  background-size: cover;
  background-position: center;
  transition: background 0.3s, border 0.3s, border-radius 0.3s, box-shadow 0.3s;
	/*  padding: 280px 0px 230px 0px;*/
	height: calc(100vh - 33vh);
	border-right: 0px solid #fff;
	border-left: 0px solid #fff;
}
/*.bg-slider .elementor-background-overlay {
	background-color: transparent;
    background-image: linear-gradient(100deg, #000000 0%, #000000 100%);
    opacity: 0.4;
    transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
    z-index: 2;
}*/

.bg-slider .swiper-slide::before{
	/*content: " ";
	background-color: transparent;
    background-image: linear-gradient(100deg, #000000 0%, #000000 100%);
    opacity: 0.4;
    transition: background 0.3s, border-radius 0.3s, opacity 0.3s;
    z-index: 2;
        height: 100%;
    position: absolute;
    width: 100%;
    top: 0;
    border-radius: 20px;*/
}

.bg-slider .abs_top_header {
	    position: absolute;
    bottom: 50%;
    z-index: 5;
    top: 35%;
}
.bg-slider .swiper-pagination {
	    bottom: 15px;
    z-index: 8;
}
.bg-slider  .swiper-pagination-bullet {
	width: 20px !important;
   height: 20px !important;
   border: 1px solid #ff9903;
}
</style>
<?php 
	if($show_home == 0){
		if($this->uri->segment(1) == "blog"){
			$show_place = 'blog';
			$qry = " AND ad_location = 'top_banner' ";
			$add_text = "(AD # 6)";
		} else if($this->uri->segment(1) == "confessions" || $this->uri->segment(1) == "confession"){
			$show_place = 'confession';
			$qry = " AND ad_location = 'top_banner' ";
			$add_text = "(AD # 8)";
		} else if($this->uri->segment(1) == "forums" || $this->uri->segment(1) == "forum"){
			$show_place = 'forum';
			$qry = " AND ad_location = 'top_banner' ";
			$add_text = "(AD # 7)";
		} else {
			$show_place = 'category_home_page';
			$qry = " AND category = '".$slug."' AND ( ad_location = 'top_banner' OR ad_location IS NULL OR ad_location = '' )";
			$add_text = "(AD # 4)";
		}
	} else {
		$show_place = 'website_home_banner';
		$qry = " ";
		$add_text = "(AD # 1)";
		// $slider_array = array('header_1.jpg', 'header_2.jpg', 'header_1.jpg', 'header_2.jpg', 'header_1.jpg', 'header_2.jpg','header_1.jpg');
	}
	$get_images_slider = $this->db->query("SELECT * FROM products_ads WHERE  ad_for = '".$show_place."' ".$country_ConditionQuery." AND status = 1 ".$qry." ORDER BY id DESC")->result_object();
	// echo $this->db->last_query();
?>
<section class="elementor-section container-fluid custom-padding elementor-top-section elementor-element elementor-element-ae15e4ass elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no bg-slider" data-id="ae15e4a" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
<a href="<?php echo base_url();?>promote">
		<button class="advetise_button"> 
			POST YOUR AD HERE <?php echo $add_text; ?>
		</button>
</a>
<div class="elementor-background-overlay"></div>
	<div class="swiper-container">
	  <div class="swiper-wrapper">
	  	<?php foreach ($get_images_slider as $key => $slider) { 
	  			if($slider->link != null){
	  				$url = $slider->link;
	  				$go_link = 1;
	  			} else {
	  				$url = $slider->image;
	  				$go_link = 0;
	  			}
	  	?>
		    <a href="<?php echo $url;?>" target="_blank" class="swiper-slide" style="background-image: url('<?php echo $slider->image;?>'); border-radius: 20px;">
		    </a>
		  <?php } ?>
	  	<a href="<?php echo base_url();?>promote" class="swiper-slide add_box" style="border-radius: 20px; display: flex; align-items: center; justify-content: center; color: #fff; font-size: 70px; background: #cccccc;">
	  			<span>
	  				POST YOUR AD HERE <?php echo $add_text; ?>
	  			</span>
	    </a>
	  </div>
	  <?php if(!empty($get_images_slider)){?>
		  <div class="swiper-pagination"></div>
		<?php } ?>
	</div>
		<?php /* ?>
			<div class="elementor-container elementor-column-gap-default abs_top_header">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-296149a" data-id="296149a" data-element_type="column">
							<div class="elementor-widget-wrap elementor-element-populated">
								<section class="elementor-section elementor-inner-section elementor-element elementor-element-347db0c elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="347db0c" data-element_type="section">
										<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-1e80520" data-id="1e80520" data-element_type="column">
													<div class="elementor-widget-wrap elementor-element-populated">
																<div class="elementor-element elementor-element-d82fe1b elementor-align-center elementor-invisible elementor-widget elementor-widget-rt-title" data-id="d82fe1b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="rt-title.default">
																	<div class="elementor-widget-container">
																		<div class="section-heading">
																	      <!-- <div class="heading-subtitle">Discover & connect with great places around the world</div> -->
																    		<h2 class="heading-title">Let’s Discover</h2>        
																    		<div class="sce-head-icon">
																    			<svg width="155" height="20" viewbox="0 0 155 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																    				<path d="M1.77001 13.4143C2.28873 13.1363 2.59997 12.9509 3.01494 12.6729C3.42992 12.4876 3.74115 12.3022 4.15613 12.1169C4.88234 11.7462 5.71229 11.3754 6.4385 11.0047C7.99466 10.2633 9.55082 9.70728 11.0032 9.05855C14.1156 7.85376 17.2279 6.83433 20.4439 5.90757C26.7723 4.14672 33.3082 2.75658 39.7403 1.82983C46.38 0.903066 52.9158 0.34701 59.4517 0.161658C65.9876 -0.11637 72.5235 -0.0236942 79.0593 0.34701C80.7192 0.439686 82.2754 0.532362 83.9353 0.625038C85.5952 0.717714 87.1514 0.81039 88.8113 0.995741C92.0273 1.36645 95.2434 1.64447 98.4595 2.10785L103.335 2.75658L108.108 3.49799C111.324 3.96137 114.436 4.6101 117.652 5.25884C130.309 7.76109 142.758 11.0974 155 14.8971C142.551 11.6535 129.998 8.8732 117.237 7.01968C114.021 6.5563 110.909 6.09292 107.693 5.72222L102.92 5.16616L98.1482 4.79546C94.9322 4.51743 91.7161 4.33208 88.5001 4.14672C86.9439 4.05405 85.284 4.05405 83.7278 3.96137C82.1717 3.8687 80.5118 3.8687 78.9556 3.8687C66.1951 3.77602 53.3308 4.79546 40.9853 7.20503C34.7606 8.40982 28.7435 9.98531 22.8301 11.9315C19.9252 12.9509 17.0204 14.0631 14.2193 15.2678C12.8706 15.9166 11.4182 16.5653 10.1733 17.214C9.55082 17.5847 8.82461 17.8628 8.20215 18.2335C7.89091 18.4188 7.57968 18.6042 7.26845 18.7895C6.95722 18.9749 6.64598 19.1602 6.4385 19.2529C4.67485 20.4577 2.18499 20.1797 0.836317 18.6042C-0.512355 17.0287 -0.201123 14.8045 1.56253 13.5997C1.66627 13.507 1.66627 13.507 1.77001 13.4143Z" fill="#35C4B5"></path>
																    			</svg>
																    		</div>
															        </div>		
															     	</div>
																</div>
																<div class="elementor-element elementor-element-0b164c7 elementor-invisible elementor-widget elementor-widget-rt-search-form" data-id="0b164c7" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="rt-search-form.default">
																		<div class="elementor-widget-container">
																	
																			<!-- Search form 1 -->
																			<div class="listygo-search-form search-form-1 ">
																				   <form action="classifieds.php" class="form-vertical rtcl-widget-search-form rtcl-search-inline-form listygo-listing-search-form rtin-style-s">
																				      <div class="inner-form-wrap">
																				                     <div class="btn-wrap">
																							               <div class="form-group">
																							                  <div class="rtcl-search-input-button rtin-keyword">
																							                     <input type="text" id="keyword" data-type="listing" name="q" class="rtcl-autocomplete" placeholder="What are you looking for" value="">
																							                  </div>
																							               </div>
																				            			</div>
																				                  <div class="search-location">
																					                  <div class="form-group">
																					                     <div class="rtcl-search-input-button rtin-location">
																						                     <select name="rtcl_location" id="rtcl-location-search-30792503" class="select2 form-control rtcl-location-search">
																														<option value="" selected>Select Location</option>
																														<option class="level-0" value="alabama">Alabama</option>
																														<option class="level-0" value="california">California</option>
																														<option class="level-0" value="chicago">Chicago</option>
																														<option class="level-0" value="florida">Florida</option>
																														<option class="level-0" value="houston">Houston</option>
																														<option class="level-0" value="kansas">Kansas</option>
																														<option class="level-0" value="los-angeles">Los Angeles</option>
																														<option class="level-0" value="manhattan">Manhattan</option>
																														<option class="level-0" value="montana">Montana</option>
																														<option class="level-0" value="portland">Portland</option>
																													</select>
																					                     </div>
																					                  </div>
																				               	</div>
																				                  <div class="search-cats">
																						               <div class="form-group">
																								               <div class="rtcl-search-input-button rtin-category">
																										               <select name="rtcl_category" id="rtcl-category-search-3704295370" class="select2 form-control rtcl-category-search">
																																<option value="" selected>Select Category</option>
																																<option class="level-1" value="events">Events</option>
																																<option class="level-1" value="jobs">Jobs</option>
																																<option class="level-1" value="services">Services</option>
																																<option class="level-1" value="training">IT Trainings</option>
																																<option class="level-1" value="roommates">Roommates & Rentals</option>
																															</select>
																								               </div>
																						               </div>
																						            </div>
																				         
																							         <div class="rtin-btn-holder">
																							            <div class="form-group">
																							               <button type="submit" class="rtin-search-btn rdtheme-button-1 btn">
																							                  Search <img decoding="async" src="<?php echo $assets;?>assets/images/search.svg" alt="Search">
																							               </button>
																							            </div>
																							         </div>
																				      </div>
																				   </form>
																			</div>
																			<!-- Search form 1 End -->		
																		</div>
																</div>
												
													</div>
											</div>
										</div>
							</section>
						</div>
				</div>
			</div>
			<?php */ ?>
</section>

<?php if($show_home == 1){ ?>
<section style="background:#fff; padding: 11px 20px 10px 20px; margin-top: 0px; margin-bottom: 10px;" class="header_bottom_mmm">
	<div class="elementor-container elementor-column-gap-default ">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-296149a" data-id="296149a" data-element_type="column">
							<div class="elementor-widget-wrap elementor-element-populated">
								<section class="elementor-section elementor-inner-section elementor-element elementor-element-347db0c elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="347db0c" data-element_type="section">
										<div class="elementor-container elementor-column-gap-default">
											<div class="elementor-column elementor-col-100 elementor-inner-column elementor-element elementor-element-1e80520" data-id="1e80520" data-element_type="column">
													<div class="elementor-widget-wrap elementor-element-populated">
														<?php /* ?>
																<div class="elementor-element elementor-element-d82fe1b elementor-align-center elementor-invisible elementor-widget elementor-widget-rt-title" data-id="d82fe1b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:100}" data-widget_type="rt-title.default">
																	<div class="elementor-widget-container">
																		<div class="section-heading">
																	      <div class="heading-subtitle">Discover & connect with great places around the world</div>
																    		<h2 class="heading-title" style="color: #e3866b;">Let’s Discover</h2>        
																    		<div class="sce-head-icon">
																    			<svg width="155" height="20" viewbox="0 0 155 20" fill="none" xmlns="http://www.w3.org/2000/svg">
																    				<path d="M1.77001 13.4143C2.28873 13.1363 2.59997 12.9509 3.01494 12.6729C3.42992 12.4876 3.74115 12.3022 4.15613 12.1169C4.88234 11.7462 5.71229 11.3754 6.4385 11.0047C7.99466 10.2633 9.55082 9.70728 11.0032 9.05855C14.1156 7.85376 17.2279 6.83433 20.4439 5.90757C26.7723 4.14672 33.3082 2.75658 39.7403 1.82983C46.38 0.903066 52.9158 0.34701 59.4517 0.161658C65.9876 -0.11637 72.5235 -0.0236942 79.0593 0.34701C80.7192 0.439686 82.2754 0.532362 83.9353 0.625038C85.5952 0.717714 87.1514 0.81039 88.8113 0.995741C92.0273 1.36645 95.2434 1.64447 98.4595 2.10785L103.335 2.75658L108.108 3.49799C111.324 3.96137 114.436 4.6101 117.652 5.25884C130.309 7.76109 142.758 11.0974 155 14.8971C142.551 11.6535 129.998 8.8732 117.237 7.01968C114.021 6.5563 110.909 6.09292 107.693 5.72222L102.92 5.16616L98.1482 4.79546C94.9322 4.51743 91.7161 4.33208 88.5001 4.14672C86.9439 4.05405 85.284 4.05405 83.7278 3.96137C82.1717 3.8687 80.5118 3.8687 78.9556 3.8687C66.1951 3.77602 53.3308 4.79546 40.9853 7.20503C34.7606 8.40982 28.7435 9.98531 22.8301 11.9315C19.9252 12.9509 17.0204 14.0631 14.2193 15.2678C12.8706 15.9166 11.4182 16.5653 10.1733 17.214C9.55082 17.5847 8.82461 17.8628 8.20215 18.2335C7.89091 18.4188 7.57968 18.6042 7.26845 18.7895C6.95722 18.9749 6.64598 19.1602 6.4385 19.2529C4.67485 20.4577 2.18499 20.1797 0.836317 18.6042C-0.512355 17.0287 -0.201123 14.8045 1.56253 13.5997C1.66627 13.507 1.66627 13.507 1.77001 13.4143Z" fill="#e3866b"></path>
																    			</svg>
																    		</div>
															        </div>		
															     	</div>
																</div>
																<?php */ ?>
																<div class="elementor-element elementor-element-0b164c7 elementor-invisible elementor-widget elementor-widget-rt-search-form" data-id="0b164c7" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;,&quot;_animation_delay&quot;:500}" data-widget_type="rt-search-form.default">
																		<div class="elementor-widget-container">
																	
																			<!-- Search form 1 -->
																			<div class="listygo-search-form search-form-1 " style="display: flex; align-items: center; gap: 15px;">
																			<style>
																			@media (max-width: 768px) {
																				.listygo-search-form.search-form-1 {
																					flex-direction: column !important;
																					gap: 10px !important;
																				}
																				.listygo-search-form.search-form-1 form {
																					width: 100% !important;
																				}
																				.listygo-search-form.search-form-1 .listygo-btn {
																					width: 100% !important;
																					justify-content: center !important;
																				}
																			}
																			</style>
																				   <form method="post" action="<?php echo base_url() ?>Nepstate/searchClassifiedsByCountry" class="form-vertical rtcl-widget-search-form rtcl-search-inline-form listygo-listing-search-form rtin-style-s" style="flex: 1;">
																				      <div class="inner-form-wrap" style="border: 1px solid #d8d8d8;">
																				                     <div class="btn-wrap">
																							               <div class="form-group">
																							                  <div class="rtcl-search-input-button rtin-keyword">
																							                     <input required type="text" id="" data-type="listing" name="keyword" class="" placeholder="What are you looking for" value="">
																							                  </div>
																							               </div>
																				            			</div>
																				                  <div class="search-location">
																					                  <div class="form-group">
																					                     <div class="rtcl-search-input-button rtin-location">
																										
																						                     <select name="countryCode" id="countrySelect2" class="select2 form-control rtcl-location-search">
																														<!-- <option value="" selected>Select Location</option> -->

																														<?php
                        
																																$listOfCountries = $this->db->get('admin_countries')->result_object();
																																foreach($listOfCountries as $country) {

																																	if(userCountryId()) {
																																		
																																			if(userCountryId() == $country->id) {

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
																																		?>
																																		<option value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>
																																		<?php
																																	}
																																}		
																														?>      
																														

																													</select>
																					                     </div>
																					                  </div>
																				               	</div>
																				                  <div class="search-cats">
																						               <div class="form-group">
																								               <div class="rtcl-search-input-button rtin-category">
																											  	 <input type="text" class="form-control" id="cityZipInput2" placeholder="Enter a Zip Code or City">

																								               </div>
																						               </div>
																						            </div>
																									<!-- Hidden Inputs -->
																									<input type="hidden" id="userCityText2" name="userCityName" class="form-control">

																							         <div class="rtin-btn-holder">
																							            <div class="form-group">
																							               <button type="submit" class="rtin-search-btn rdtheme-button-1 btn" id="updateLocationButton2">
																							                  Search <img decoding="async" src="<?php echo $assets;?>assets/images/search.svg" alt="Search">
																							               </button>
																							            </div>
																							         </div>
																				      </div>
																				   </form>
																				   <!-- Add Listing Button -->
																				   <a 
																				   <?php if(isset($_SESSION['LISTYLOGIN'])){ ?>href="<?php echo base_url();?>new/post/events"<?php } else {?>href="javascript:;" onclick="setReturnUrlAndShowLogin('new/post/events')"<?php } ?>
																				   class="listygo-btn listygo-btn--style1" style="margin-bottom: 0; white-space: nowrap;">
																				       <span class="listygo-btn__icon">
																				           <i class="fa-solid fa-plus"></i>
																				       </span>
																				       <span class="listygo-btn__text">Add Listing</span>
																				   </a>
																			</div>
																			<!-- Search form 1 End -->		
																		</div>
																</div>
												
													</div>
											</div>
										</div>
							</section>
						</div>
				</div>
			</div>
</section>

<?php } ?>
