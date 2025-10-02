jQuery(document).ready(function(){

})

function show_login_popup(){
    jQuery(".outer_wrap").hide();
jQuery("#signup_popup").fadeIn();
}

function setReturnUrlAndShowLogin(returnUrl){
    // Set the return URL in a hidden form field
    var hiddenInput = jQuery('#return_url_hidden');
    if (hiddenInput.length === 0) {
        // Create hidden input if it doesn't exist
        jQuery('body').append('<input type="hidden" id="return_url_hidden" name="return_url" value="' + returnUrl + '">');
    } else {
        hiddenInput.val(returnUrl);
    }
    show_login_popup();
}
function show_signup_form(){
    jQuery(".outer_wrap").hide();
    jQuery("#register_popup").fadeIn();
}

var swiper3 = new Swiper('.bg-slider .swiper-container', {
  // Configure Swiper options as needed
  slidesPerView: 1,
  spaceBetween: 0,
  speed: 2000,
  loop: true,
  navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
              },
  autoplay: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
                    1400: {
                        slidesPerView: 1,
                    },
                    992: {
                        slidesPerView: 1,
                    },
                    576: {
                        slidesPerView: 1,
                    },
                    300: {
                        slidesPerView: 1,
                    },
                },
});


var swiper = new Swiper('.swiper-custom', {
  // Configure Swiper options as needed
  slidesPerView: 3,
  spaceBetween: 30,
  speed: 500,
  loop: false,
  navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
              },
  autoplay: true,
  pagination: {
    el: '.swiper-custom .swiper-pagination',
    clickable: true,
  },
  breakpoints: {
                    1400: {
                        slidesPerView: 3,
                    },
                    992: {
                        slidesPerView: 3,
                    },
                    576: {
                        slidesPerView: 2,
                    },
                    300: {
                        slidesPerView: 1,
                    },
                },
});

var swiper2 = new Swiper('.swiper-list', {
  // Configure Swiper options as needed
  slidesPerView: 1,
  spaceBetween: 0,
  speed: 2000,
  loop: true,
  navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
              },
  autoplay: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  breakpoints: {
                    1400: {
                        slidesPerView: 1,
                    },
                    992: {
                        slidesPerView: 1,
                    },
                    576: {
                        slidesPerView: 1,
                    },
                    300: {
                        slidesPerView: 1,
                    },
                },
});

function do_show_option(val){
    jQuery(".accordian_1").removeClass('active');
    jQuery("."+val).addClass('active');
}