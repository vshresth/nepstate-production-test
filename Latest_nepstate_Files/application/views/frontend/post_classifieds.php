
<?php include("common/header.php"); ?>

<?php

    $category = $this->db->query("SELECT * FROM categories WHERE slug = '".$slug."'")->result_object()[0];

    if(!empty($category)){
        $parents = $this->db->query("SELECT * FROM categories WHERE parent_id = 0")->result_object();
        $subparents = $this->db->query("SELECT * FROM categories WHERE parent_id = ".$category->id)->result_object();
    }

    $url_submit = "";
    $button_text = "Continue To Payment";
    if($edit == 1){
        $url_submit = "?edit=".$id;
        $sub_cat = $product->sub_cat;
        $title_ad = $product->title;
        $json = json_decode($product->json_content, false);

        // echo "<pre>";
        // print_r($json);
        // echo "</pre>";
        $images_products = $this->db->query("SELECT image FROM product_images WHERE gallery = 0 AND product_id = ".$product->id)->result_object();
        $images_gallery = $this->db->query("SELECT image FROM product_images WHERE gallery = 1 AND product_id = ".$product->id)->result_object();
        // unset($_SESSION["ALREADY_SESSION_IMAGE"]);
        // die;
        if(!isset($_SESSION['ALREADY_SESSION_IMAGE'])){
            foreach($images_products as $key=>$rp){
                $_SESSION['storyimages'][] = $rp->image;
            }
            foreach($images_gallery as $key=>$rp){
                $_SESSION['storyimagesOthers'][] = $rp->image;
            }
        }
        if(!empty($images_products)){
            $_SESSION['ALREADY_SESSION_IMAGE'] = 1;
        }
        $button_text = "Update Your Listing";
    }
?>

<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
        <h1 class="heading-title">POST NEW LISTING</h1>
	</div>
   </div>
</section>

<style>
    #couponApplyBtn{
        background-color: #ff7f50; /* Coral color */
        border: none;
        border-radius: 25px;
        color: white;
        padding: 15px 30px;
        font-size: 15px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
        margin-top: 10px;
    }

    #couponCancelBtn{
        background-color: red; /* Coral color */
        border: none;
        border-radius: 25px;
        color: white;
        padding: 15px 30px;
        font-size: 15px;
        font-weight: bold;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        cursor: pointer;
        transition: background-color 0.3s, box-shadow 0.3s;
        margin-top: 10px;
        display: none;
    }
</style>
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
                                    <?php if(!empty($category)){?>
                                        <form action="<?php echo base_url();?>submit/classified<?php echo $url_submit;?>" method="post" id="form_to_submit" enctype="multipart/form-data">
                                            <input type="hidden" name="is_free_plan" id="is_free_plan" value="0">
                                            <div class="form-custom-post flex_space_between_wrap_start">
                                                <div class="form-group">
                                                    <label>Category:</label>
                                                    <select name="category" required onchange="do_change_category(this.value)" class="form-control">
                                                        <option value="">--Choose Category--</option>
                                                        <?php foreach ($parents as $key => $parent) { ?>
                                                            <option <?php echo $parent->slug == $slug?"SELECTED":"";?> value="<?php echo $parent->slug;?>"><?php echo $parent->title;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Sub Category:</label>
                                                    <select name="subcategory" required onchange="do_change_sub_category(this.value)" class="form-control">
                                                        <option value="">--Choose Sub Categories--</option>
                                                        <?php foreach ($subparents as $key => $parent) { ?>
                                                            <option <?php echo $parent->slug == $sub_cat?"SELECTED":"";?> value="<?php echo $parent->slug;?>"><?php echo $parent->title;?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="other_cat form-group wd100" style="display:none">
                                                    <label>Other Category Name:</label>
                                                    <input type="text" name="other_cat" class="form-control" value="<?php echo $json->other_cat; ?>">
                                                </div>

                                                <?php include("common/".$category->slug.".php"); ?>

                                                <div class="form-group wd100">
                                                    <label>Gallery Images:</label>
                                                    <input type="file" name="file_gallery[]" multiple accept="image/jpeg, image/png" class="form-control" id="new_file_gallery">
                                                </div>

                                                <div id="files_list_others" style="<?php echo isset($_SESSION["storyimagesOthers"])?'display:block':'';?>">
                                                    <div class="form-group left wd100">
                                                        <?php foreach ($_SESSION["storyimagesOthers"] as $key => $value) { ?>
                                                            <div class="image_uploaded" id="remove_gallery_<?php echo $key;?>">
                                                                <div class="crossbutton" onclick="remove_file_uploaded_other('<?php echo $key;?>')">
                                                                    <i class="fa fa-trash" title="Remove Image"></i>
                                                                </div>
                                                                
                                                                <img src="<?php echo $value;?>">
                                                                <div class="upload_image_name" title="<?php echo $value;?>">
                                                                    <?php echo $value;?>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                            </div>


                                            <?php if($edit != 1){
                                                $plans_listing = $this->db->query("SELECT * FROM payment_plans WHERE FIND_IN_SET('".$category->id."', cID) > 0 AND status = 1")->result_object();
                                                $row = $this->db->query("SELECT * FROM payment_plans WHERE FIND_IN_SET('".$category->id."', cID) > 0 AND status = 1")->result_object()[0];
                                                $cat_title = $this->db->query("SELECT * FROM categories WHERE id = ".$category->id)->result_object()[0];

                                                $cat_final_title = $cat_title->title;
                                            ?>
                                                <h3>Payment Plan</h3>
                                                <?php include("common/payment_form.php"); ?>

                                                <div class="form-group" id="couponBox" style="display:none;">
                                                    <label>Coupon Code:</label>
                                                    <input type="text" name="coupon_code" class="form-control" value="" id="coupon"  placeholder="Enter Coupon Code">
                                                    <button type="button" id="couponApplyBtn" class="">Apply Coupon</button>
                                                    <button type="button" id="couponCancelBtn"  class="">Cancel Coupon</button>
                                                </div>
                                            </div>

                                            <div id="total_amount_to_pay"  style="display:none; font-size: 15px;" >
                                            <?php
                                                if(!empty(getCountryInfo())  && getCountryInfo()->fee_status == 1) {
                                                ?>
                                                   SUB TOTAL: <span class="sub_total">0</span><br><br>
                                                   SERVICE FEE: <span class="admin_fees">0</span><br>
                                                    
                                                <?php
                                                }
                                            ?>
                                            
                                            <div id="discountedAmontBox" style="display:none;"> <br>
                                                    DISCOUNT: <span class="discountedAmount"></span><br>
                                                    <input type="hidden" name="" id="discountedAmount">
                                                    <!-- <b>Payable Amount</b> : <span id="afterDiscountAmount"></span> -->
                                                </div>
                                                <br>
                                                TOTAL: <span class="total_amont"></span>
                                                <input type="hidden" name="plan_amount" id="plan_amount" value="0">
                                                <input type="hidden" name="" id="plan_amount_without_fee" value="0">

                                                <input type="hidden" name="sub_plan_amount" id="sub_plan_amount" value="0">
                                                <input type="hidden" name="is_coupon_apply" id="is_coupon_apply" value="0">
                                                <br>
                                            </div>

                                            <!-- POPUP START -->
                                            <div class="outer_wrap" id="popup_payment" style="display: none;">
                                                <div class="outer_wrap_inner">
                                                    <div class="center_white_outer bigxxl">
                                                         <div class="close_poup" onclick="close_popup()">
                                                            <i class="fa fa-close"></i>
                                                        </div>
                                                        <p style="margin-bottom: 20px; margin-top:30px">Enter your payment details to post this classified</p>
                                                        <main id="main" class="site-main">
                                                              <div id="card-element" class="form-control">

                                                              </div>
                                                              <div class="">
                                                                    <h5 style="font-size: 14px;
                                                                        margin-top: 23px;
                                                                        text-transform: uppercase;
                                                                        color: #767676;
                                                                        margin-bottom: 22px;">Billing Address
                                                                    </h5>
                                                                  <div id="address-element" class=""></div>
                                                              </div>
                                                              <div id="card-errors" role="alert" style="color: #f00;margin-top: 10px;"></div>
                                                              <button type="submit" id="upload_btn" class="ff-btn ff-btn-submit ff-btn-md item-btn"  style="border:none; margin-top: 20px;">Pay Now</button>       
                                                        </main>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- POPUP ENDS -->
                                            <?php } ?>
                                            <div class="form-group mt-30 flex_space_between_wrap wd100">
                                                <i><?php echo $edit!=1?"Disclaimer all the listing are non refundable":"";?></i>
                                                <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn" style="border:none" id="paymentBtn"><?php echo $button_text;?> </button>
                                            </div>
                                        </form>
                                    <?php } ?>
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
<script src="https://cdn.tiny.cloud/1/9d5p272q2jiloo9ewi2q8jhq0yvo3pg3738q0h11zwfpdnr7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>


document.getElementById('couponCancelBtn').addEventListener('click', (event) =>{
    $.ajax({
                    url: "<?php echo base_url('Nepstate/cancelCoupon'); ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {

                        if(response == 'false') {
                            alert('Something went wrong.');
                        } else {
                            document.getElementById('coupon').value = '';
                            document.getElementById('discountedAmount').value = 0;
                            document.getElementById('coupon').disabled = false;
                            document.getElementById('is_coupon_apply').value = 0;
                            document.getElementById('couponApplyBtn').style.display = 'block';
                            document.getElementById('couponCancelBtn').style.display = 'none';

                            $('#discountedAmontBox').css('display', 'none');
                            $('#discountedAmontBox  .discountedAmount').html("$" + 0);

                            if(response.is_select_ad_type == 0) {
                                document.getElementById('plan_amount').value = Number(response.plan_amount).toFixed(2);
                                document.getElementById('sub_plan_amount').value = 0;
                                $("#total_amount_to_pay .total_amont").html("$" + Number(response.plan_amount).toFixed(2));

                            } else if(response.is_select_ad_type == 1) {
                                document.getElementById('plan_amount').value = Number(response.plan_amount).toFixed(2);
                                document.getElementById('sub_plan_amount').value = Number(response.total_amount).toFixed(2);
                                $("#total_amount_to_pay .total_amont").html("$" + Number(response.total_amount).toFixed(2));
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Something went wrong. Please try again later.');
                    }

                });



    // $("#sub_plan_amount").val(0);
   



});
    document.getElementById('couponApplyBtn').addEventListener('click', (event) =>{

        let  coupon = document.getElementById('coupon').value;
        let  plan_amount = document.getElementById('plan_amount').value;
        let  sub_plan_amount = document.getElementById('sub_plan_amount').value;


        let checkboxes = document.getElementsByClassName('payment_banner');
            let isChecked = false;
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }
        isChecked =  isChecked;
        if(isChecked){
            var selectAdType = 1;
            var totalAmount = Number(sub_plan_amount);
        }else if(!isChecked) {
            var selectAdType = 0;
            var totalAmount = Number(plan_amount);
        }

       
        if(coupon == '') {
            alert('Please enter coupon code.');
            return;
        }


                    $.ajax({
                    url: "<?php echo base_url('Nepstate/applyCoupon'); ?>",
                    type: "POST",
                    data: {
                        coupon: coupon,
                        price: totalAmount,
                        selectAdType: selectAdType,
                        planAmount: Number(plan_amount),
                        subPlanAmount: Number(sub_plan_amount),
                        categoryID: '<?php echo isset($category) ? $category->id : 0; ?>',
                    },
                    dataType: "json",
                    success: function(response) {

                        if(response == 'discount_exceeds') {
                            alert('The applied coupon discount exceeds!');
                            return;
                        }

                        if(response == 'expired') {
                            alert('The applied coupon is expired!');
                            return;
                        }

                        if(response === false || response == 'false') {
                            alert('Coupon code is not valid Please try again.');
                        } else {
                            
                            document.getElementById('is_coupon_apply').value = 1;
                            document.getElementById('sub_plan_amount').value = Number(response).toFixed(2);
                            document.getElementById('coupon').disabled = true;
                            document.getElementById('couponApplyBtn').style.display = 'none';
                            document.getElementById('couponCancelBtn').style.display = 'block';

                            $("#total_amount_to_pay .total_amont").html("$" + Number(response).toFixed(2));
                            $('#discountedAmontBox').css('display', 'block');
                            var discountedAmount = totalAmount - Number(response);
                            $('#discountedAmontBox  .discountedAmount').html("$" + discountedAmount.toFixed(2));
                            document.getElementById('discountedAmount').value = discountedAmount.toFixed(2);
                        }
                    },
                    error: function(xhr, status, error) {

                        alert('Something went wrong. Please try again later.');
                    }

                });
    });
</script>

<script> 
    tinymce.init({
      selector: 'textarea',
      height: 350,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:12px }'
    });
</script>

<?php if($edit != 1){?>
    <?php include 'common/code_js.php'; ?>
<?php } ?>

<script>
    <?php if($this->uri->segment(3) == "events"){?>
        const availabilityFromInputevent = document.getElementById('event_start_date');
        const availabilityToInputevent = document.getElementById('event_end_date');

        availabilityFromInputevent.addEventListener('input', function () {
            const selectedDateevent = new Date(availabilityFromInputevent.value);
            selectedDateevent.setDate(selectedDateevent.getDate() );
            availabilityToInputevent.min = selectedDateevent.toISOString().split('T')[0];



        });
    <?php } else { ?>
        const availabilityFromInput = document.getElementById('availability_from');
        const availabilityToInput = document.getElementById('availability_to');

        availabilityFromInput.addEventListener('input', function () {
            const selectedDate = new Date(availabilityFromInput.value);
            selectedDate.setDate(selectedDate.getDate() + 1); // Add 1 day to the selected date
            availabilityToInput.min = selectedDate.toISOString().split('T')[0];
        });
    <?php } ?>
    
</script>


<style type="text/css">
    .url_custom_ad {
        display: none;
    }
    #tags{
      float:left;
      margin-bottom: 10px;
    }
    #tags > span{
          cursor: pointer;
    display: block;
    float: left;
    color: #fff;
    background: var(--color-primary);
    padding: 6px 15px;
    padding-right: 25px;
    margin: 4px;
    border-radius: 100px;
    position: relative;
    }
    #tags > span:hover{
      opacity:0.7;
    }
    #tags > span:after{
        position: absolute;
        content: "×";
        padding: 2px 5px;
        margin-left: 3px;
        font-size: 17px;
        top: 4px;
        right: 4px;
    }
    #tags > input{
      background:#eee;
      border:0;
      margin:4px;
      padding:7px;
      width:auto;
    }
</style>

<script>

    jQuery(document).ready(function(){
        jQuery(".url_custom_ad").remove();
    })
   

    function do_show_payment_popup(){

    }
    function do_change_sub_category(val){
        jQuery(".other_cat").hide();
        jQuery(".other_cat input").attr("required", false);
        <?php if($slug == "roomates-rentals"){ ?>
            jQuery(".single_shared_room").hide();
            jQuery(".single_shared_room select").attr("required", false);
            jQuery(".paying_guest").hide();
            jQuery(".paying_guest select").attr("required", false);

            if(val == "single-room" || val == "shared-room"){
                jQuery(".single_shared_room").show();
                jQuery(".single_shared_room select").attr("required", true);
            } else if(val == "paying-guest"){
                jQuery(".paying_guest").show();
                jQuery(".paying_guest select").attr("required", true);
            }
        <?php } ?>

        if(val == "other" || val == "others" || val == "Others" || val == "Other"){
            jQuery(".other_cat").show();
            jQuery(".other_cat input").attr("required", true);
        }

    }

    function do_show_other_lang(val){
        jQuery(".other_language").hide();
        jQuery(".other_language input").attr("required", false);
        if(val == "other" || val == "others" || val == "Others" || val == "Other"){
            jQuery(".other_language").show();
            jQuery(".other_language input").attr("required", true);
        } 
    }

    function do_change_group(val){
        jQuery(".age_group").hide();
        jQuery(".age_group input").attr("required", false);
        if(val == "Age Range"){
            jQuery(".age_group").show();
            jQuery(".age_group input").attr("required", true);
        }
    }
    function do_change_category(val){
        if(val == ""){
            window.location.href = '<?php echo base_url();?>new/post/<?php echo $category->slug;?>';
        } else {
            window.location.href = '<?php echo base_url();?>new/post/'+val;
        }
    }

    function do_show_event_style(val){
        jQuery(".inline_venue_option").hide();
        jQuery(".inline_venue_option input").attr("required", false);
        jQuery(".inline_liveurl_option").hide();
        jQuery(".inline_liveurl_option input").attr("required", false);
        if(val == "Venue"){
            jQuery(".inline_venue_option").show();
            jQuery(".inline_venue_option input").attr("required", true);
        }else if(val == "Live Streaming"){
            jQuery(".inline_liveurl_option").show();
            jQuery(".inline_liveurl_option input").attr("required", true);
        }
    }
    jQuery(".new_class_radio").change(function(){ // bind a function to the change event
        if( jQuery(this).is(":checked") ){ // check if the radio is checked
            var val = jQuery(this).val(); // retrieve the value
            jQuery(".event_type_single").hide();
            jQuery(".event_type_recurring").hide();
            jQuery(".event_type_recurring input").attr("required", false);
            jQuery(".event_type_single input").attr("required", false);
            if(val == 1){
                jQuery(".event_type_single").show();
                jQuery(".event_type_single input").attr("required", true);
            } else {
               jQuery(".event_type_recurring").show();
               jQuery(".event_type_recurring input").attr("required", true);
            }
        }
    });

    function show_value_cost_event(val){
        jQuery(".show_paid_cost").hide();
        jQuery(".show_paid_cost select").attr("required", false);
        if(val == "Paid"){
            jQuery(".show_paid_cost").show();
            jQuery(".show_paid_cost select").attr("required", true);
        }
    }

    function show_paid_custom(val){
        jQuery(".show_paid_custom").hide();
        jQuery(".show_paid_custom input").attr("required", false);
        if(val == "Custom"){
        jQuery(".show_paid_custom").show();
        jQuery(".show_paid_custom input").attr("required", true);
        }
    }

    var $ = jQuery;

    $(document).ready(function() {
        // $('input[name="contact_number"]').on('input', function() {
        //     var inputValue = $(this).val();
        //     var numericValue = inputValue.replace(/\D/g, '');
        //     if (numericValue.length > 1) {
        //         $(".ff-btn-submit").attr("disabled", false);
        //         var formattedValue = '(' + numericValue.substr(0, 3) + ')-' + numericValue.substr(3, 3) + '-' + numericValue.substr(6, 4);
        //         $('input[name="contact_number"]').val(formattedValue);
        //         $('#error_message').text('');
        //     } else {
        //         $(".ff-btn-submit").attr("disabled", true);
        //         $('#error_message').text('Please enter a valid phone number in the format (504)-123-5334');
        //     }
        // });

        $('input[name="contact_number"]').on('input', function(event) {
            var inputValue = $(this).val();
            var numericValue = inputValue.replace(/\D/g, '');
            $(this).val(numericValue);
            if (event.originalEvent.inputType === 'deleteContentBackward') { // Check for Backspace key
                return;
            }
            if (numericValue.length > 1) {
                
                $(".ff-btn-submit").attr("disabled", false);
                var formattedValue = '(' + numericValue.substr(0, 3) + ')-' + numericValue.substr(3, 3) + '-' + numericValue.substr(6, 4);
                $(this).val(formattedValue);
                $('#error_message').text('');
            } else {
                $(".ff-btn-submit").attr("disabled", true);
                $('#error_message').text('Please enter a valid phone number in the format (504)-123-5334');
            }
        });

      





       $('.contact_email').on('input', function() {
            var inputValue = $(this).val();
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (emailPattern.test(inputValue)) {
                $(".ff-btn-submit").attr("disabled", false);
                $('#error_message_email').text('');
            } else {
                $('#error_message_email').text('Please enter a valid email address.');
                $(".ff-btn-submit").attr("disabled", true);
            }
        });

    });


    <?php if($edit != 1){?>

        $("#form_to_submit").submit(function(event) {
            event.preventDefault();
            var form = document.getElementById('form_to_submit');

            let checkboxes = document.getElementsByClassName('payment_banner');
            let isChecked = false;
            let adType = [];
        for (let i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                adType.push(checkboxes[i].getAttribute('data-con'));
                
            }
        }

     
        isChecked =  isChecked;

            if(isChecked) {

                $.ajax({
                    url: "<?php echo base_url('Nepstate/promoteValidation'); ?>",
                    type: "POST",
                    data: {
                        adType: adType,
                        categoryType: '<?php echo $slug;?>'
                    },
                    dataType: "json",
                    success: function(response) {
                        console.log(response)
                        if(response.message == 'not_found') {
                            
                            form.submit();
                            $('#paymentBtn').attr('disabled', true);
                            $('#paymentBtn').html(`
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Processing...
                            `).css({ cursor: 'not-allowed', opacity: 0.7 });
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
                        console.error(error);
                    }

                });
            }else{
              event.preventDefault();
              form.submit();
              $('#paymentBtn').attr('disabled', true);
              $('#paymentBtn').html(`
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                Processing...
             `).css({ cursor: 'not-allowed', opacity: 0.7 });
              return;
            }
 
          });
    <?php } ?>
    function get_uploaded_imgaes() {
        $.ajax({
            url: '<?php echo base_url()."nepstate/get_image_uploaded/"; ?>',
            cache: false,
            contentType: false,
            type: 'post',
            success: function(response){
                $("#files_list").show();
                $("#files_list").html(response);
            }
        });
    }

    


    
    

    function do_sub_plan(val){
        // var selectedValue = val.value;
        // var selectedOption = val.options[val.selectedIndex];
        // var amount = selectedOption.getAttribute("data-amount");
        // var old_amount = ($("#plan_amount").val());
        // var new_amount = amount;

        // $("#sub_plan_amount").val(new_amount);

        // var final_amount = (parseFloat(old_amount) + parseFloat(new_amount));
        // var actual_amount = final_amount.toFixed(2);
        // $("#total_amount_to_pay .total_amont").html(actual_amount)
    }

    function remove_file_uploaded(id){
        $.ajax({
            url: '<?php echo base_url()."nepstate/remove_file_uploaded"; ?>/'+id,
            cache: false,
            contentType: false,
            type: 'post',
            success: function(response){
                $("#remove_"+id).remove();
            }
        });
    }
    $(document).ready(function(){
        $('#new_file').on('change', function() {
        if($('#new_file').prop('files').length>0){
            var form_data = new FormData();
            $.each($('#new_file')[0].files, function(i, file) {
                form_data.append('file_'+i, file);
            });

            $("#files_list").show();
            $("#files_list").html('<div class="loadin_image"><img src="<?php echo $assets;?>assets/images/gear.gif"> Uploading...</div>');
            $.ajax({
                url: '<?php echo base_url()."nepstate/upload_multiple"; ?>',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    data = JSON.parse(php_script_response);
                    if(data.action=="success")
                    {
                        get_uploaded_imgaes();
                        return;
                    }
                    else{
                        alert("Sorry, unable to process your file, "+data.error );
                    }
                }
            });
        }
        });
    });

    function get_uploaded_imgaes() {
        $.ajax({
            url: '<?php echo base_url()."nepstate/get_image_uploaded/"; ?>',
            cache: false,
            contentType: false,
            type: 'post',
            success: function(response){
                $("#files_list").show();
                $("#files_list").html(response);
            }
        });
    }


    // GALLErY ImAGE
     function get_uploaded_imgaes_gallery() {
        $.ajax({
            url: '<?php echo base_url()."nepstate/get_image_uploaded_gallery/"; ?>',
            cache: false,
            contentType: false,
            type: 'post',
            success: function(response){
                $("#files_list_others").show();
                $("#files_list_others").html(response);
            }
        });
    }

    function remove_file_uploaded_other(id){
        $.ajax({
            url: '<?php echo base_url()."nepstate/remove_file_uploaded_gallery"; ?>/'+id,
            cache: false,
            contentType: false,
            type: 'post',
            success: function(response){
                $("#remove_gallery_"+id).remove();
            }
        });
    }

    $(document).ready(function(){
        $('#new_file_gallery').on('change', function() {
        if($('#new_file_gallery').prop('files').length>0){
            var form_data = new FormData();
            $.each($('#new_file_gallery')[0].files, function(i, file) {
                form_data.append('file_'+i, file);
            });

            $("#files_list_others").show();
            $("#files_list_others").html('<div class="loadin_image"><img src="<?php echo $assets;?>assets/images/gear.gif"> Uploading...</div>');
            $.ajax({
                url: '<?php echo base_url()."nepstate/upload_multiple_gallery"; ?>',
                dataType: 'text',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(php_script_response){
                    data = JSON.parse(php_script_response);
                    if(data.action=="success")
                    {
                        get_uploaded_imgaes_gallery();
                        return;
                    }
                    else{
                        alert("Sorry, unable to process your file, "+data.error );
                    }
                }
            });
        }
        });
    });

</script>


<script src="https://maps.google.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places&callback=initAutocomplete"></script>
<script type="text/javascript">
    google.maps.event.addDomListener(window, 'load', initialize);
    function initialize() {
        var input = document.getElementById('autocomplete');
        var countryCode = '<?php echo getCountryCodeById(userCountryId()); ?>';
        var options_ = {
           componentRestrictions: { country: countryCode } 
    };

        var autocomplete = new google.maps.places.Autocomplete(input, options_);
        
        autocomplete.addListener('place_changed', function() {
            var place = autocomplete.getPlace();
            $('#latitude').val(place.geometry['location'].lat());
            $('#longitude').val(place.geometry['location'].lng());

            var city = "";
            var state = "";
            var country = "";
            var zip = "";
            var address_places = place.address_components;

            $.each(address_places, function(index_1, value_1) {
                var types = value_1.types;
                $.each(types, function(index_2, value_2) {
                    if (value_2 === "locality") {
                        city = address_places[index_1]['long_name'];
                    } else if (value_2 === "administrative_area_level_1") {
                        state = address_places[index_1]['long_name'];
                    } else if (value_2 === "country") {
                        country = address_places[index_1]['long_name'];
                    }
                    else if(value_2 === 'postal_code')
                    {
                        zip = address_places[index_1]['long_name'];
                    }
                });

            });
            $('#zip').val(zip);
            $('#city').val(city);
            $('#state').val(state);
            $("#country").val(country);
        });
    } 
</script>


<script>
      // $("#tags_submit").on({
      //   focusout() {
      //     var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,'');
      //     if (txt) {
      //       var tags = txt.split(/[,\s]+/);
      //       tags.forEach(tag => {
      //         $("<span/>", { text: tag.toLowerCase(), class: "tag" }).appendTo("#tags");
      //       });
      //     }
      //     this.value = "";
      //   },
      //   keyup(ev) {
      //     if(/(,|Enter)/.test(ev.key)) $(this).focusout(); 
      //     $("#tags").show();
      //   }
        
      // });
      // $("#tags").on("click", "span", function() {
      //   $(this).remove(); 
      // });
    

  $("#tags_submit").on({
        focusout() {
          var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig, '');
          if (txt) {
            var tags = txt.split(/[,\s]+/);
            tags.forEach(tag => {
              $("<span/>", { text: tag.toLowerCase(), class: "tag" }).appendTo("#tags");
            });

            // Update the hidden input field with the tags
            var currentTags = $("#tags_input").val();
            if (currentTags) {
              currentTags += ",";
            }
            $("#tags_input").val(currentTags + tags.join(","));
          }
          this.value = "";
        },
    keydown(ev) {
        if (ev.key === "Enter") {
            ev.preventDefault(); // Prevent form submission
            $(this).focusout();
        }
    },
        keyup(ev) {
          if (/(,|Enter)/.test(ev.key)) $(this).focusout();
          $("#tags").show();
        }
      });

    

      $("#tags").on("click", "span", function() {
        // Remove the tag from the hidden input field
        var currentTags = $("#tags_input").val().split(",");
        var tagToRemove = $(this).text().toLowerCase();
        var updatedTags = currentTags.filter(tag => tag !== tagToRemove);
        $("#tags_input").val(updatedTags.join(","));
        $(this).remove();
      });

    </script>