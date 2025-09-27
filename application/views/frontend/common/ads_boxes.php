
<?php
   $countryId = userCountryId();
?>


<section class="elementor-section elementor-top-section elementor-element elementor-element-56139ed elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="56139ed" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}" style="margin:40px 0">
	<div class="elementor-container elementor-column-gap-default">
		<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-1745bc2" data-id="1745bc2" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
				<div class="elementor-element elementor-element-18287cb elementor-align-center elementor-widget elementor-widget-rt-title" data-id="18287cb" data-element_type="widget" data-widget_type="rt-title.default">
            		<div class="elementor-widget-container" >
            			<div class="section-heading">
        	               <div class="heading-subtitle">Promote Your Business </div>
                           <h2 class="heading-title">New Promotions in NepState</h2>
                           <div class="">
                                <a href="<?php echo base_url();?>promote">
                                    <button class="custom_button_popup">Click to add your Business Ad (AD # 2)</button>
                                </a>
                           </div>
                        </div>		
                    </div>

                    <div class="ads_boxes <?php if($isPromotions == 1){echo 'promotions';}?>">

                        <?php
                            $bottom_promotions = $this->db->query("SELECT * FROM products_ads WHERE  ad_for = 'home_middle' ".$country_ConditionQuery." ORDER BY id DESC LIMIT 5")->result_object();
                            $total_empty_show = (5 - count($bottom_promotions));
                        ?>
                        <?php foreach($bottom_promotions as $k=>$bads){
                            if($bads->link != ""){
                                $link_display = $bads->link;
                            } else {
                                $link_display = $bads->image;
                            }
                        ?>
                            <a href="<?php echo $link_display;?>" class="ads_inner_box" target="_blank" data-lightbox="image-<?php echo $k;?>">
                                <img src="<?php echo $bads->image;?>">
                            </a>
                        <?php } ?>
                        <?php for($i=1;$i<=$total_empty_show;$i++){?>
                            <div class="ads_inner_box">
                                <p>
                                    Promote Your Business <br>Post your Ad Here
                                </p>
                                <!-- <span>Click Me!</span> -->
                            </div>
                        <?php } ?>

                    </div>

				</div>
				
			</div>
		</div>
	</div>
</section>