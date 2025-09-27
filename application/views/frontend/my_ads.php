<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>

                                        <?php include("common/siderbar.php"); ?>
                                        <div class="rtcl-MyAccount-content">
                                            <div class="rtcl-user-info media">

                                                <table class="listing_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Ad Place</th>
                                                            <th>Ad Expires (days)</th>
                                                            <th>Image</th>
                                                            <th>Link</th>
                                                            <th>Status</th>
                                                            <th>Posted Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        $new_qr = ""; 
                                                        if (isset($_GET['type'])) {
                                                            $type = htmlspecialchars($_GET['type']);
                                                            if ($type == "active") {
                                                                $new_qr = " AND ad_expires > '" . date('Y-m-d') . "'";
                                                            } elseif ($type == "expired") {
                                                                $new_qr = " AND ad_expires < '" . date('Y-m-d') . "'";
                                                            } else {
                                                                $new_qr = "";
                                                            }
                                                        }
                                                        
                                                            //AND ad_for IN ('home_middle', 'web_footer', 'category_home_page', 'website_home_banner') 
                                                           
                                                            $listings = $this->db->query("SELECT * FROM products_ads WHERE payment_status = 'completed' AND user_id = ".user_info()->id." ".$new_qr." ORDER BY id DESC")->result_object();
                                                          
                                                            // echo $this->db->last_query();
                                                            foreach ($listings as $key => $row) {
                                                                if($row->status == 0){
                                                                    $expired = "<span style='color:red'>Expired</span>";
                                                                } else {
                                                                    $expired = "<span style='color:green'>Live</span>";
                                                                }
                                                                if($row->image != null){
                                                        ?>
                                                            <tr id="row_<?php echo $row->id;?>">
                                                            <td style="text-align:center">
                                                                <?php 
                                                                  $country = $this->db->where('id', $row->country_id)->get('admin_countries')->row(); 
                                                                  $city = $this->db->where('id', $row->city_id)->get('admin_cities')->row(); 

                                                                  
                                                                  if($country) {
                                                                    ?>
                                                                    <img width="20px" height="20px"src="<?php echo $country->flag;?>">
                                                                   &nbsp
                                                                    <?php echo $country->title; ?>  <?php if(!empty($row->city_id)) {echo " ( " . $row->city_id.' )';}?>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                            
                                                            </td>
                                                                <td style="text-transform: capitalize;">
                                                                    <?php echo str_replace("_", " ", $row->ad_for); ?>
                                                                    <?php if($row->plan_id != 0){
                                                                        $plan_data = $this->db->query("SELECT * FROM payment_plans WHERE id = '".$row->plan_id."'")->result_object()[0];
                                                                    ?>
                                                                        <br>
                                                                        <small>Plan:  <?php echo $plan_data->title; ?> (<?php echo $plan_data->months; ?>) Months</small>
                                                                    <?php } ?>
                                                                    <?php if($row->ad_location != null){?>
                                                                        <br>
                                                                        <small>Ad Location:  <?php echo str_replace("_", " ", $row->ad_location); ?></small>
                                                                    <?php } ?>

                                                                    <?php if($row->category != null){
                                                                        $cate = $this->db->query("SELECT * FROM categories WHERE slug = '".$row->category."'")->result_object()[0];
                                                                    ?>
                                                                        <br>
                                                                        <small>Category:  <?php echo $cate->title; ?></small>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                        
                                                                        $today = new DateTime();
                                                                        $ad_expire_date = new DateTime($row->ad_expires);

                                                                        if ($ad_expire_date < $today) {
                                                                            echo "<span style='color:red;'>Ad has expired</span>";
                                                                        } else {
                                                                            $interval = $today->diff($ad_expire_date);
                                                                            $days_difference = $interval->days;

                                                                            echo ($days_difference +1) . " Days Left";
                                                                        }

                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <img src="<?php echo $row->image; ?>" style="height: 40px;">
                                                                </td>
                                                                <td>
                                                                    <?php if($row->link != ""){?>
                                                                        <a href="<?php echo $row->link;?>" target="_blank">View Link</a>
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $expired; ?>
                                                                </td>
                                                                
                                                                <td><?php echo date("F, d Y", strtotime($row->created_at));?></td>
                                                                <td style="width:100px; text-align: center;" class="actions_links">
                                                                   
                                                                <?php if($row->ad_for == 'confession')  {?>
                                                                    <a title="View Link" href="<?php echo base_url().'confessions'; ?>" target="_blank">
                                                                        <i class="fa fa-tv"></i>
                                                                    </a>
                                                                <?php }else if($row->ad_for == 'blog') {?>
                                                                    <a title="View Link" href="<?php echo base_url().'blog'; ?>" target="_blank">
                                                                        <i class="fa fa-tv"></i>
                                                                    </a>
                                                                <?php }else if($row->ad_for == 'forum') {?>
                                                                    <a title="View Link" href="<?php echo base_url().'forums'; ?>" target="_blank">
                                                                        <i class="fa fa-tv"></i>
                                                                    </a>
                                                                <?php }else if($row->ad_for == 'category_home_page') {?>
                                                                    
                                                                    <a title="View Link" href="<?php echo base_url().'classifieds/'.$row->category; ?>" target="_blank">
                                                                        <i class="fa fa-tv"></i>
                                                                    </a>
                                                                <?php  }else if($row->ad_for == 'website_home_banner' || $row->ad_for == 'home_middle' || $row->ad_for == 'web_footer') { ?>
                                                                    <a title="View Link" href="<?php echo base_url();?>" target="_blank">
                                                                        <i class="fa fa-tv"></i>
                                                                    </a>
                                                                    <?php } ?>
                                                                    <a title="Edit Ad" href="javascript:;" onclick="do_update_ad(<?php echo $row->id;?>)">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <a href="javascript:;" onclick="do_show_alert(<?php echo $row->id;?>)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>

                                                           

                                                        <?php }} ?>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>                                  
                </main>
            </div>
        </div>
    </div>
</div>

<?php foreach ($listings as $key => $row) { ?>
 <div class="outer_wrap" id="ad_<?php echo $row->id;?>">
    <div class="outer_wrap_inner">
        <div class="center_white_outer" style="width: 70%; padding:10px">
             <div class="close_poup" onclick="close_popup()">
                <i class="fa fa-close"></i>
            </div>
            
            <?php 
                if($row->ad_for == "category_home_page"){
                    $min_max_text = "Minimum";
                    $min_max_tag = "min";
                    $width = "1000";
                    $hight = "400";
                } else if($row->ad_for == "website_home_banner"){
                    $min_max_text = "Minimum";
                    $min_max_tag = "min";
                    $width = "1000";
                    $hight = "400";
                } else if($row->ad_for == "home_middle"){
                    $min_max_text = "Maximum";
                    $min_max_tag = "max";
                    $width = "550";
                    $hight = "250";
                } else if($row->ad_for == "web_footer"){
                    $min_max_text = "Maximum";
                    $min_max_tag = "max";
                    $width = "350";
                    $hight = "250";
                }
            ?>
        <form method="post" action="<?php echo base_url();?>nepstate/do_update_ads/<?php echo $row->id;?>" enctype="multipart/form-data">
            <div class="wd100" style="padding:30px">
                <div class="form-group wd100 url_custom_ad">
                    <label>Link (<small>
                        Don't chaneg your URL if this is a Classified URL!
                    </small>)</label>
                    <input type="url" placeholder="Enter full url eg: https://www.google.com" required name="link_ad" class="form-control"  style="background:#fff" value="<?php echo $row->link;?>">
                </div>
                <div class="form-group wd100">
                    <input type="file" id="input-file-disable-remove" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="image_ad" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="<?php echo $row->image;?>" data-<?php echo $min_max_tag;?>-width="<?php echo $width;?>" data-<?php echo $min_max_tag;?>-height="<?php echo $hight;?>"  />

                </div>
                <p><small><?php echo $min_max_text;?> Image Size: <?php echo $width;?>px x <?php echo $hight;?>px</small></p>
                <div class="form-group mt-30 flex_space_between_wrap wd100">
                    <i><?php echo "";?></i>
                    <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn" style="border:none">
                        Update
                    </button> 
                </div>
            </div>
        </form>

        </div>
    </div>
</div>
<?php } ?>
<?php include("common/footer.php"); ?>
<script type="text/javascript">
    function do_show_alert(val){
        var x = confirm("Are you sure, you want to delete this ad? This won't be undone!");
        if(x){
            window.location.href = "<?php echo base_url();?>nepstate/do_delete_advertisement/"+val;
        }
    }

    function do_update_ad(val){
        jQuery("#ad_"+val).show();
    }

    jQuery(document).ready(function(){
        <?php if(isset($_GET['id'])){?>
            var id_old = '<?php echo $_GET['id'];?>';
            jQuery("#row_"+id_old).addClass("blink_class");

            setTimeout(function() {
                jQuery("#row_"+id_old).removeClass('blink_class');
              }, 10000); // 10000 milliseconds = 10 seconds
        <?php } ?>
    })
</script>