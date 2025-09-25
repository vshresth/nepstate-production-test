<!-- <script src="https://js.stripe.com/v3/"></script> -->
<!-- <script type="text/javascript">

	var stripe = Stripe('pk_test_roV9Yx0ZE2qQpCLviGdmjGEt');
	var elements = stripe.elements();
	var style = {
	    base: {
	        color: '#32325d',
	        lineHeight: '30px',
	        fontFamily: 'var(--font-family)',
	        fontSmoothing: 'antialiased',
	        fontSize: '13px',
	        '::placeholder': {
	            color: '#aab7c4'
	        }
	    },
	    invalid: {
	        color: '#fa755a',
	        iconColor: '#fa755a'
	    }
	};
	var card = elements.create('card', {style: style});
	card.mount('#card-element');
	const options = { mode: 'billing'};
	const addressElement = elements.create('address', options);
	addressElement.mount('#address-element');
	card.addEventListener('change', function(event) {
	    var displayError = document.getElementById('card-errors');
	if (event.error) {
	        displayError.textContent = event.error.message;
	    } else {
	        displayError.textContent = '';
	    }
	});
	var form = document.getElementById('form_to_submit');
	form.addEventListener('submit', function(event) {
	   $("#upload_btn").attr("disabled", true);
	   $('#upload_btn').css('background', '#AAA9A8');
	   $("#upload_btn").html("Loading...");
	    event.preventDefault();
	stripe.createToken(card).then(function(result) {
	        if (result.error) {
	            var errorElement = document.getElementById('card-errors');
	            errorElement.textContent = result.error.message;
				$("#upload_btn").attr("disabled", false);
				$('#upload_btn').css('background', '#ff9902');
            	$("#upload_btn").html("Pay Now");
				

	        } else {
	            stripeTokenHandler(result.token);
	        }
	    });
	});
	function stripeTokenHandler(token) {
	    var form = document.getElementById('form_to_submit');
	    var hiddenInput = document.createElement('input');
	    hiddenInput.setAttribute('type', 'hidden');
	    hiddenInput.setAttribute('name', 'stripeToken');
	    hiddenInput.setAttribute('value', token.id);
	    form.appendChild(hiddenInput);
	    form.submit();
	}
</script> -->


<script type="text/javascript">
	// localStorage.removeItem("selectedPlanTitle");

	var $ = jQuery;

	$(document).ready(function() {
	
      $(".payment_banner").on("change", function() {
		let adsBoxesArray = [];
		
		$("#sub_plan_amount").val(0);
		
		$('#coupon').val('');
		$('#coupon').prop('disabled', false);
		$('#is_coupon_apply').val(0);
		$('#couponApplyBtn').show();
		$('#couponCancelBtn').hide();
		$('#discountedAmontBox').css('display', 'none');
		$('#discountedAmontBox  .discountedAmount').html("$" + 0);
		$('#discountedAmount').val(0);

        var totalAmount = 0;
        var old_amount = ($("#plan_amount_without_fee").val());
        $(".show_div_all").hide();
        $(".show_div_all input, .show_div_all select").attr("required", false);
        totalAmount = (parseFloat(old_amount) + parseFloat(totalAmount));

        $(".payment_banner:checked").each(function() {
          var amount = parseFloat($(this).data("amount"));
          var show_div = ($(this).data("con"));
		  adsBoxesArray.push(show_div)
		  if(show_div == 'blog') {
			$('#blogLocation').attr('required', true);
		  }else if(show_div == 'forum') {
			$('#forumLocation').attr('required', true);
		  }else if(show_div == 'confession') {
			$('#confessionLocation').attr('required', true);
		  }

          $("#"+show_div).show();
		 
          $("#"+show_div+"_1 input, #"+show_div+"_1 select").attr("required", true);
          totalAmount += amount;

		if(adsBoxesArray.length > 0) {
			
			$('#paymentNoteBox').css('display', 'block');
			$('#selectedAdsTitles').text(adsDirectionsNo(adsBoxesArray).join(","));
			$('#planName').text(localStorage.getItem("selectedPlanTitle"));
		}else{
			$('#paymentNoteBox').css('display', 'none');
		}
        });
		<?php if (!empty(getCountryInfo()) && getCountryInfo()->fee_status == 1) : ?>
			
			var sub_total = totalAmount;
			var sub_total = sub_total.toFixed(2);
			
			let adminServicesFee = <?= getCountryInfo()->services_fee; ?>;
			let adminCharge = ( totalAmount * adminServicesFee ) / 100;
			totalAmount += adminCharge;

			// if($('#discountedAmount').val() != 0 && $('#discountedAmount').val() != '') {
			// 	// totalAmount = totalAmount - $('#discountedAmount').val();
			// }

        	$("#total_amount_to_pay .sub_total").html("$"+sub_total);
        	$("#total_amount_to_pay .admin_fees").html("$"+adminCharge.toFixed(2));
			$('#admin_fee').val(adminServicesFee);
			$('#sub_total').val(sub_total);
			<?php endif; ?>
			
		
			$("#sub_plan_amount").val(totalAmount.toFixed(2));
        	$("#total_amount_to_pay .total_amont").html("$" + totalAmount.toFixed(2));
      });
    });

	function do_get_banners(val, segment=''){
		var selectedValue = val.value;
        var selectedOption = val.options[val.selectedIndex];
        var amount = selectedOption.getAttribute("data-id");
		var planTitle = selectedOption.getAttribute("data-title");
		localStorage.setItem("selectedPlanTitle", planTitle);

		
		 
		if(amount <= 0 ){
			$('#is_free_plan').val(1);
			$('#paymentBtn').text('Submit Free Listing');
			$('#paymentBtn').css('background','green');
		}else{
			$('#is_free_plan').val(0);
			$('#paymentBtn').text('Continue To Payment');
			$('#paymentBtn').css('background','#ff9902');
		}
		
		if(val.value == '' || amount <= 0) {
			
			$('#total_amount_to_pay').hide();
			$('#continue_to_payment_btn').hide();
			$('.banner_display').hide();
			$('#couponBox').hide();
			$('#discountedAmount').val(0);
			$("#plan_amount").val(0);
			$('#plan_amount_without_fee').val(0);
			$("#sub_plan_amount").val(0);
			return;
		}else{
			$('#couponBox').show();
			$('#total_amount_to_pay').show();
			$('#continue_to_payment_btn').show();
		}

		$('#coupon').val('');
		$('#coupon').prop('disabled', false);
		$('#is_coupon_apply').val(0);
		$('#couponApplyBtn').show();
		$('#couponCancelBtn').hide();



		$('#discountedAmontBox').css('display', 'none');
		$('#discountedAmontBox  .discountedAmount').html("$" + 0);
		$("#total_amount_to_pay .total_amont").html("$" + 0);
		$('#discountedAmount').val(0);
		$("#plan_amount").val(0);
		$('#plan_amount_without_fee').val(0);
		$("#sub_plan_amount").val(0);


		var checkboxes = document.querySelectorAll('.payment_banner');
    
		// Uncheck all checkboxes with class 'payment_banner'
		checkboxes.forEach(function(cb) {
			cb.checked = false;
		});

		
	
        // $(".banner_display").html('');
        

        $("#total_amount_to_pay").show();
        

        var sub_val = $("#sub_plan_amount").val();
        var final_amount = (parseFloat(amount) + parseFloat(sub_val));
       $('#plan_amount_without_fee').val(final_amount);
		<?php if (!empty(getCountryInfo()) && getCountryInfo()->fee_status == 1) : ?>
			 let adminServicesFee = <?= getCountryInfo()->services_fee; ?>;
			let adminCharge = ( final_amount * adminServicesFee ) / 100;

			 final_amount += adminCharge;

           
			var sub_total = (parseFloat(amount) + parseFloat(sub_val));
			var sub_total = sub_total.toFixed(2);
        	$("#total_amount_to_pay .sub_total").html("$"+sub_total);
        	$("#total_amount_to_pay .admin_fees").html("$"+adminCharge.toFixed(2));
        <?php endif; ?>
        var actual_amount = final_amount.toFixed(2);
		$("#plan_amount").val(actual_amount);
		$("#sub_plan_amount").val(actual_amount);

        $("#total_amount_to_pay .total_amont").html("$"+actual_amount);

        $(".banner_display").show();
        
		$.ajax({
            url: '<?php echo base_url()."Nepstate/getPlanInfo/"; ?>'+val.value+'/'+segment,
            cache: false,
            contentType: false,
            type: 'post',
            success: function(response){
				$('#ads-boxes').html(response);
                // $("#ads-boxes").append(response);
            }
        });
    
	}



	function adsDirectionsNo(adsBoxesArray){
		 let finalResultArr = [];
		adsBoxesArray.forEach((box, index) => {
			if(box == 'website_home_banner') {
				finalResultArr.push('AD # 1');
			}else if(box == 'home_middle') {
				finalResultArr.push('AD # 2');
			}else if(box == 'web_footer') {
				finalResultArr.push('AD # 3');
			}else if(box == 'category_home_page') {
				finalResultArr.push('AD # 4');
			}else if(box == 'cat_right') {
				finalResultArr.push('AD # 5');
			}else if(box == 'blog') {
				finalResultArr.push('AD # 6');
			}else if(box == 'forum') {
				finalResultArr.push('AD # 7');
			}else if(box == 'confession') {
				finalResultArr.push('AD # 8');
			}
    	});

		return finalResultArr;
	}
	
</script>