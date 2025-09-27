<div class="form-group wd100">
    <div class="banner_display" >
       <?php 
           
            $list = '<label class="wd100">Classified Display (Website Banners):</label>';
            $list .= '<strong>Note:</strong> Please make sure to verify the AD numbers before posting. The AD Numbers will determine where the ad will be posted.';
             $list .= '<div class="radio-button mt-4">
                  <input type="checkbox" id="ban_3" data-con="website_home_banner" data-amount="'.$planInfo->website_home_banner.'" value="website_home_banner" class="payment_banner" name="banner_type[]">
                  <label for="ban_3">Post on Website home page banner   <mark>(AD # 1)</mark> ($'.$planInfo->website_home_banner.')</label>
            </div>';

            if($type == "promote"){
            $list .=  '<div class="radio-button">
                  <input type="checkbox" id="ban_4" data-con="home_middle" data-amount="'.$planInfo->home_middle.'" value="home_middle" class="payment_banner" name="banner_type[]">
                  <label for="ban_4"> <mark>(AD # 2)</mark> ($'.$planInfo->home_middle.')</label>
            </div>
            <div class="radio-button">
                  <input type="checkbox" id="ban_5" data-con="web_footer" data-amount="'.$planInfo->web_footer.'" value="web_footer" class="payment_banner" name="banner_type[]">
                  <label for="ban_5"> <mark>(AD # 3)</mark> ($'.$planInfo->web_footer.')</label>
            </div>
           
            
            
            ';
        }

            $list .= '
            <div class="radio-button">
              <input type="checkbox" id="ban_1" data-con="category_home_page" data-amount="'.$planInfo->category_home_page.'" value="category_home_page" class="payment_banner" name="banner_type[]">
              <label for="ban_1">Post on '.$cat_final_title.' home page  <mark>(AD # 4)</mark> ($'.$planInfo->category_home_page.')</label>
            </div>';
           if($type != "promote"){

            $list .= '<div class="radio-button">
                  <input type="checkbox" id="ban_2" data-con="website_home_category_section" data-amount="'.$planInfo->website_home_category_section.'" value="website_home_category_section" class="payment_banner" name="banner_type[]">
                  <label for="ban_2">Post on Website home page  '.$cat_final_title.' section  ($'.$planInfo->website_home_category_section.')

                  <small><br>Choose this option to showcase your event post prominently at the Forefront of the Events section on our homepage.</small>
                  </label>
            </div>';
           }
          

            $list .= '<div class="radio-button">
                  <input type="checkbox" id="ban_8" data-con="cat_right" data-amount="'.$planInfo->cat_right.'" value="cat_right" class="payment_banner" name="banner_type[]">
                  <label for="ban_8">Post on Category right side <mark>(AD # 5)</mark> ($'.$planInfo->cat_right.')</label>
            </div>';

            if($type == "promote"){



            $list .=  '
            
            <div class="radio-button">
                  <input type="checkbox" id="ban_7" data-con="blog" data-amount="'.$planInfo->blog.'" value="blog" class="payment_banner" name="banner_type[]">
                  <label for="ban_7">Blog Ad <mark>(AD # 6)</mark> ($'.$planInfo->blog.') </label>
                </div>


            <div class="radio-button">
              <input type="checkbox" id="ban_11" data-con="forum" data-amount="'.$planInfo->forum.'" value="forum" class="payment_banner" name="banner_type[]">
              <label for="ban_11">Forum Ad <mark>(AD # 7)</mark> ($'.$planInfo->forum.') </label>
            </div>

            <div class="radio-button">
              <input type="checkbox" id="ban_10" data-con="confession" data-amount="'.$planInfo->confession.'" value="confession" class="payment_banner" name="banner_type[]">
              <label for="ban_10">Confession Ad <mark>(AD # 8)</mark> ($'.$planInfo->confession.') </label>
            </div>
            
            ';
        }

           echo $list;
       ?>
    </div>
</div>
<?php include 'code_js.php'; ?>
