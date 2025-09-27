<?php include("common/header.php"); ?>
<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
        <h1 class="heading-title">PROMOTE YOUR BUSINESS</h1>
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
                        <div class="panel-group"  style="margin-top: 50px;">
                           <div class="panel panel-default">
                                <div class="panel-body" style="padding:20px; border-radius: 10px;">
                                    <?php 
                                        $plans_listing = $this->db->query("SELECT * FROM payment_plans WHERE status = 1 ORDER BY id ASC")->result_object();
                                        $row = $this->db->query("SELECT * FROM payment_plans WHERE status = 1 ORDER BY id DESC LIMIT 1")->result_object()[0];
                                        $cat_final_title = "Category";
                                    ?>
                                    <form action="<?php echo base_url();?>submit/promote" method="post" id="form_to_submit" enctype="multipart/form-data">

                                        <!-- <div id="total_amount_to_pay" style="text-align: right;">
                                            <b>TOTAL AMOUNT TO PAY </b> : <span class="total_amont">0</span>
                                            <input type="hidden" name="plan_amount" id="plan_amount" value="0">
                                            <input type="hidden" name="sub_plan_amount" id="sub_plan_amount" value="0">
                                        </div> -->

                                        <div class="form-custom-post flex_space_between_wrap_start">
                                            <?php include 'common/payment_form.php'; ?>
                                        </div>

                                        <div id="paymentNoteBox" style="display:none;">
                                            <?php if($segment == 'promote'){ ?>
                                                    <strong>Note:</strong> The total cost includes both the ad price (<mark><span id="selectedAdsTitles"></span></mark>) and the duration fee based on your selected plan (<strong><span id="planName"></span></strong>).
                                            <?php } ?>
                                        </div>



                                        
                                        <div id="total_amount_to_pay" style="text-align: right;font-size: 17px; display:none;">
                                            
                                            <?php 
                                                if(!empty(getCountryInfo())  && getCountryInfo()->fee_status == 1) {
                                                ?>
                                                   <b>SUB TOTAL</b> : <span class="sub_total">0</span><br><br>
                                                   <b>SERVICE FEE</b> : <span class="admin_fees">0</span><br>
                                                    
                                                <?php
                                                }
                                            ?>
                                            <br>
                                            <b>TOTAL AMOUNT TO PAY </b> : <span class="total_amont">0</span>
                                            <input type="hidden" name="" id="discountedAmount">
                                            <input type="hidden" name="plan_amount" id="plan_amount" value="0">
                                            <input type="hidden" name="" id="plan_amount_without_fee" value="0">

                                            <input type="hidden" name="sub_plan_amount" id="sub_plan_amount" value="0">
                                            <input type="hidden" name="admin_fee" id="admin_fee" value="0">
                                            <input type="hidden" name="sub_total" id="sub_total" value="0">
                                        </div>

                                        
                                            <!-- POPUP ENDS -->
                                            <div class="form-group mt-30 flex_space_between_wrap wd100" id="continue_to_payment_btn" style="display:none;">
                                                <i><?php echo "Promotions of your businesses are non refundable";?></i>
                                                
                                                <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn" style="border:none" id="paymentBtn"> 
                                                    Continue to Payment
                                                </button>
                                            </div>
                                    </form>
                                </div>
                           </div>
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
<?php 
include 'common/code_js.php';
 ?>

<script>
    let adLocation__ = '';
    $("#form_to_submit").submit(function(event) {
        event.preventDefault();
        var form = document.getElementById('form_to_submit');
        let checkboxes = document.getElementsByClassName('payment_banner');
        let categoryType = document.getElementById('categoryType');

        let isChecked = false;
        let adType = [];
        
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                adType.push(checkboxes[i].getAttribute('data-con'));
                
            }
        }
       
        isChecked =  isChecked;

        if(!isChecked) {
            alert('Please select ad type!');
            event.preventDefault();
            return;
        }
        

        $.ajax({
            url: "<?php echo base_url('Nepstate/promoteValidation'); ?>",
            type: "POST",
            data: {
                adType: adType,
                categoryType: categoryType.value,
                adLocation:adLocation__
            },
            dataType: "json",
            success: function(response) {
              
                 if(response.message == 'not_found') {
                     
                     $('#paymentBtn').attr('disabled', true);
                     $('#paymentBtn').html(`
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                     Processing...
                     `).css({ cursor: 'not-allowed', opacity: 0.7 });
                     form.submit();
                    return;
                 }
                 
                 if(response.message == 'already_added_home_middle')  {
                    alert(`Ad Promotion Unavailable\nThe current promotion space will become available again in [${response.left_days}]. Please choose a different promotion location or contact support for assistance.`);
                }
                 
                if(response.message == 'already_added_other_user') {
                    alert(`Ad Promotion Unavailable\nThis ad promotion has already been claimed by another user. The current promotion space will become available again in [${response.left_days}] days. Please choose a different promotion location or contact support for assistance.`);
                }

                if(response.message == 'already_added_this_user') {
                    alert('Space is being used by your other listing if you would like to update please go to dashboard ad and changed to the new setting.')
                }
            },
            error: function(xhr, status, error) {
                // Handle error
            }
    });

        
        
      });


    function do_change_div(val){
        if(val == 'top_banner'){
            $("."+val+"_size small").html('Image Size: 1000px x 400px');
            
        } else {
            $("."+val+"_size small").html('Image Size: 350px x 200px');
        }

       if(val == 'blog') {
        adLocation__ = $('#blogLocation').val();
        let blogLocation = $('#blogLocation').val();
        if(blogLocation == 'top_banner') {
            $('#blogTopSideImageBox').css('display', 'block');
            $('#blogRightSideImageBox').css('display', 'none');
           
            $('#blogTopSideImageBox input').attr('required', true);
            $('#blogRightSideImageBox input').attr('required', false);

        }else if(blogLocation == 'right_banner') {
            $('#blogRightSideImageBox').css('display', 'block');
            $('#blogTopSideImageBox').css('display', 'none');

            $('#blogRightSideImageBox input').attr('required', true);
            $('#blogTopSideImageBox input').attr('required', false);

        }else{
            $('#blogRightSideImageBox').css('display', 'none');
            $('#blogTopSideImageBox').css('display', 'none');

            $('#blogTopSideImageBox input, #blogRightSideImageBox input').attr('required', false);


        }
       } 


       if(val == 'confession') {
        adLocation__ = $('#confessionLocation').val();
        let confessionLocation = $('#confessionLocation').val();
        if(confessionLocation == 'top_banner') {
            $('#topConfessionImageBox').css('display', 'block');
            $('#rightConfessionImageBox').css('display', 'none');

            $('#topConfessionImageBox input').attr('required', true);
            $('#rightConfessionImageBox input').attr('required', false);

        }else if(confessionLocation == 'right_banner') {
            $('#rightConfessionImageBox').css('display', 'block');
            $('#topConfessionImageBox').css('display', 'none');

            $('#rightConfessionImageBox input').attr('required', true);
            $('#topConfessionImageBox input').attr('required', false);
        }else{
            $('#rightConfessionImageBox').css('display', 'none');
            $('#topConfessionImageBox').css('display', 'none');

            $('#topConfessionImageBox input, #rightConfessionImageBox input').attr('required', false);

        }
       } 



       if(val == 'forum') {
        adLocation__ = $('#forumLocation').val();
        let forumLocation = $('#forumLocation').val();
        if(forumLocation == 'top_banner') {
            $('#topForumImageBox').css('display', 'block');
            $('#rightForumImageBox').css('display', 'none');

            $('#topForumImageBox input').attr('required', true);
            $('#rightForumImageBox input').attr('required', false);
        }else if(forumLocation == 'right_banner') {
            $('#rightForumImageBox').css('display', 'block');
            $('#topForumImageBox').css('display', 'none');

            $('#rightForumImageBox input').attr('required', true);
            $('#topForumImageBox input').attr('required', false);
        }else{
            $('#rightForumImageBox').css('display', 'none');
            $('#topForumImageBox').css('display', 'none');

            $('#topForumImageBox input, #rightForumImageBox input').attr('required', false);

        }
       } 

    }

   
</script>
