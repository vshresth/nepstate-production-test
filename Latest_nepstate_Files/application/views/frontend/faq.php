<?php include("common/header.php"); ?>
<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
         <h1 class="heading-title">FAQs</h1>
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
                        <div class="panel-group" id="rtaccordion-1" style="margin-top: 80px;">

                        <?php
                            $listOfFaqs = $this->db->where('status', 1)->get('faqs')->result_object();
                        ?>
                        <?php foreach($listOfFaqs as $faq){ ?>
                           <div class="panel panel-default">
                              <div class="panel-heading" id="headingbrandingissimplyamoreefficientwaytosellthings<?php echo $faq->id; ?>">
                                 <button class="accordion-button collapsed right" type="button" data-bs-toggle="collapse" data-bs-target="#collapsebrandingissimplyamoreefficientwaytosellthings<?php echo $faq->id; ?>" aria-expanded="true" aria-controls="collapsebrandingissimplyamoreefficientwaytosellthings<?php echo $faq->id; ?>">
                                 <?php echo $faq->title;?>                                         <span class="rtin-accordion-icon">
                                 <span class="rtin-icon rt-icon-closed">
                                 <i aria-hidden="true" class=" flaticon-down-arrow"></i>                                                            </span>
                                 <span class="rtin-icon rt-icon-opened">
                                 <i aria-hidden="true" class=" flaticon-up-arrow"></i>                                                            </span>
                                 </span>
                                 </button>
                              </div>
                              <div id="collapsebrandingissimplyamoreefficientwaytosellthings<?php echo $faq->id; ?>" class="accordion-collapse collapse" aria-labelledby="headingbrandingissimplyamoreefficientwaytosellthings<?php echo $faq->id; ?>" data-bs-parent="#rtaccordion-1">
                                 <div class="panel-body">
                                    <p><?php echo $faq->description;?> </p>
                                 </div>
                              </div>
                           </div>
                      <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<?php include("common/footer.php"); ?>