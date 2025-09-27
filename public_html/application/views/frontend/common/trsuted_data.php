<div data-elementor-type="wp-page" data-elementor-id="7919" class="elementor elementor-7919">
<!-- TRUSTED CUSTOMERS -->
			<div class="container-fluid custom-padding">
			<section class="elementor-section elementor-top-section elementor-element elementor-element-ee26589 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no customer_data" data-id="ee26589" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
							<div class="elementor-background-overlay"></div>
							<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-86243cf" data-id="86243cf" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
										<section class="elementor-section elementor-inner-section elementor-element elementor-element-7e981e2 elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="7e981e2" data-element_type="section">
								<div class="elementor-container elementor-column-gap-default">
						
						<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-a1ddbf4" data-id="a1ddbf4" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
										<div class="elementor-element elementor-element-986a9bc elementor-counter-inline-style elementor-widget elementor-widget-counter" data-id="986a9bc" data-element_type="widget" data-widget_type="counter.default">
						<div class="elementor-widget-container">
							<div class="elementor-counter column_counter">
					<div class="elementor-counter-number-wrapper" style="min-width:auto;">
						<span class="elementor-counter-number-prefix"></span>
						<span class="elementor-counter-number" >
							<?php 
								if(settings()->no_of_lists == 0 ||  settings()->no_of_lists == '') {
									
									echo $this->db->where('payment_status', 'completed')->get('products')->num_rows();
								}else{
									echo settings()->no_of_lists;
								}
						  ?>
						  </span>
						<!-- <span class="elementor-counter-number-suffix">k</span> -->
					</div>
							<div class="elementor-counter-title">No of Listings</div>
					</div>
				</div>
				</div>
					</div>
				</div>
				<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-ad092d2" data-id="ad092d2" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
					  <div class="elementor-element elementor-element-39ac3a1 elementor-counter-inline-style elementor-widget elementor-widget-counter" data-id="39ac3a1" data-element_type="widget" data-widget_type="counter.default">
						<div class="elementor-widget-container">
							<div class="elementor-counter column_counter">
								<div class="elementor-counter-number-wrapper" style="min-width:auto;">
									<span class="elementor-counter-number-prefix"></span>
									<span class="elementor-counter-number" >
										<?php
											if(settings()->happy_customers == 0 || settings()->happy_customers == '') {
												echo $this->db->get('users')->num_rows();
											}else{
												echo settings()->happy_customers;
											}
										?></span>
									<!-- <span class="elementor-counter-number-suffix">k</span> -->
								</div>
								 <div class="elementor-counter-title"> Our Happy Customers </div>
							 </div>
						  </div>
					   </div>
					</div>
				</div>
				<div class="elementor-column elementor-col-33 elementor-inner-column elementor-element elementor-element-9d00021" data-id="9d00021" data-element_type="column">
					<div class="elementor-widget-wrap elementor-element-populated">
						<div class="elementor-element elementor-element-426c3dc elementor-counter-inline-style elementor-widget elementor-widget-counter" data-id="426c3dc" data-element_type="widget" data-widget_type="counter.default">
							<div class="elementor-widget-container">
								<div class="elementor-counter column_counter">
					<div class="elementor-counter-number-wrapper" style="min-width:auto;">
						<span class="elementor-counter-number-prefix"></span>
						<span class="elementor-counter-number">
							<?php  
								if(settings()->visitors == 0 ||  settings()->visitors == '') {
									echo $this->db->get('visitors')->num_rows();
								}else{
									echo settings()->visitors;
								}  
							?></span>
						<!-- <span class="elementor-counter-number-suffix">k</span> -->
					</div>
								
								<div class="elementor-counter-title">Our Visitors</div>

							</div>
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
	</div>
			<!-- TRUSTED CUSTOMER ENDS -->
</div>