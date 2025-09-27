<?php include("common/header.php"); ?>

<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
        <h1 class="heading-title"> 
		<?php 
			if($page_url == 'terms-conditions') {
				echo 'TERMS & CONDITIONS';
			}else if($page_url  == 'privacy-policy') {
				echo 'PRIVACY POLICY';
			}else if($page_url  == 'cookie-policy') {
				echo 'COOKIE POLICY';
			}else if($page_url == 'refunds-policy') {
				echo "REFUNDS POLICY";
			}else if($page_url == 'sales-terms') {
				echo "SALES TERMS";
			}
		?>		
	</h1>
	</div>
   </div>
</section>


<!--=====================================-->
<!--=         Inner Banner Start    	=-->
<!--=====================================-->		
<div data-elementor-type="wp-page" data-elementor-id="2207" class="elementor elementor-2207">
									<section class="elementor-section elementor-top-section elementor-element elementor-element-0e24f2b elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="0e24f2b" data-element_type="section">
						<div class="elementor-container elementor-column-gap-default">
					<div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-d6ba0fd" data-id="d6ba0fd" data-element_type="column">
			<div class="elementor-widget-wrap elementor-element-populated">
								<div class="elementor-element elementor-element-ec8b882 elementor-widget elementor-widget-rt-accordion" data-id="ec8b882" data-element_type="widget" data-widget_type="rt-accordion.default">
				<div class="elementor-widget-container">
			        <div class="faq-box">

						<?php
							$pageContent = $this->db->where('slug', $page_url)->get('pages')->row();
						?>
                        <div class="panel-body" style="margin: 50px 0; padding: 30px;">
                                <p style="margin-bottom: 10px;">
									<?php
										if(!empty($pageContent)){
											echo $pageContent->descriptions;
										}
									?>
								</p>
                        </div>

				    </div>
				</div>
		</div>
							</div>
		</section>
							</div>
		

<?php include("common/footer.php"); ?>