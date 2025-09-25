<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>

                                        <?php include("common/siderbar.php"); ?>
                                        <div class="rtcl-MyAccount-content">
                                            <div class="rtcl-user-info media">

                                                <table class="listing_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Country</th>
                                                            <th>Title</th>
                                                            <th>Category</th>
                                                            <th>Status</th>
                                                            <th>Views</th>
                                                            <th>Clicks</th>
                                                            <th>Posted Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $new_qr = "";
                                                            if(isset($_GET['type'])){
                                                                if($_GET['type'] == "active"){
                                                                    $new_qr = " AND status = 1";
                                                                } else if($_GET['type'] == "expired"){
                                                                    $new_qr = " AND status = 0";
                                                                } else {
                                                                    $new_qr = "";
                                                                }
                                                            }

                                                            $listings = $this->db->query("SELECT * FROM products WHERE uID = ".user_info()->id." ".$new_qr." AND (expiry_date IS NULL OR expiry_date >= DATE_SUB(NOW(), INTERVAL 30 DAY))  ORDER BY id DESC")->result_object();

                                                            // echo $this->db->last_query();
                                                            foreach ($listings as $key => $row) {
                                                                $category = $this->db->query("SELECT * FROM categories WHERE slug = '".$row->category."'")->result_object()[0];
                                                                
                                                                if($row->expiry_date <= date("Y-m-d")){
                                                                    $expired = "<span style='color:red'>Expired</span>";
                                                                }else{
                                                                    if($row->status == 2){
                                                                        $expired = "<span style='color:red'>Expired</span>";
                                                                    } else {
                                                                        $expired = "<span style='color:green'>Live</span>";
                                                                    }
                                                                }
                                                                
                                                                
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
                                                                      <?php echo $country->title; ?><?php if($row->city_id) {echo " ('".$row->city_id."') ";}?>
                                                                    <?php
                                                                  }
                                                                ?>
                                                            
                                                            </td>
                                                                <td><?php echo $row->title; ?></td>
                                                                <td>
                                                                    <?php echo $category->title; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $expired; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $this->db->where('product_slug', $row->slug)->get('views')->num_rows(); ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $row->clicks; ?>
                                                                </td>
                                                               
                                                                <td><?php echo date("F, d Y", strtotime($row->created_at));?></td>
                                                                <td style="width:100px; text-align: center;" class="actions_links">
                                                                    <a title="View Classified Details" href="<?php echo base_url();?>classified/detail/<?php echo $row->slug;?>">
                                                                        <i class="fa fa-tv"></i>
                                                                    </a>
                                                                    <a title="Edit Classified" href="<?php echo base_url();?>edit/post/<?php echo $row->id;?>">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>
                                                                    <a href="javascript:;" onclick="do_show_alert(<?php echo $row->id;?>)">
                                                                        <i class="fa fa-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
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
<?php include("common/footer.php"); ?>
<script type="text/javascript">
    function do_show_alert(val){
        var x = confirm("Are you sure, you want to delete this classified?");
        if(x){
            window.location.href = "<?php echo base_url();?>nepstate/do_delete_products/"+val;
        }
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