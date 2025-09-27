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
                                                            <?php if($this->uri->segment(1)=="my-blogs" || $this->uri->segment(1)=="my-forums"){ ?>
                                                                <th>Image</th>
                                                            <?php } ?>
                                                            <th>Author</th>
                                                            <th>Status</th>
                                                            <th>Posted</th>
                                                            <?php if($this->uri->segment(1)=="my-blogs"){ ?>
                                                                <th>Approval Status</th>
                                                            <?php } ?>

                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            
                                                            if($this->uri->segment(1)=="my-confessions"){
                                                                $listings = $this->db->query("SELECT * FROM confessions WHERE uID = ".user_info()->id." AND type = 'confession' ORDER BY id DESC")->result_object();
                                                                $url_page = 'confession';
                                                            } else  if($this->uri->segment(1)=="my-forums"){
                                                                $listings = $this->db->query("SELECT * FROM confessions WHERE uID = ".user_info()->id." AND type = 'forum' ORDER BY id DESC")->result_object();
                                                                $url_page = 'forum';
                                                            } else {
                                                                $listings = $this->db->query("SELECT * FROM blogs WHERE uID = ".user_info()->id." ORDER BY id DESC")->result_object();
                                                                $url_page = 'blog';
                                                            }

                                                            // echo $this->db->last_query();
                                                            foreach ($listings as $key => $row) {
                                                                if($row->status == 2){
                                                                    $expired = "<span style='color:orange'>Draft</span>";
                                                                } else{ 

                                                                    if($this->uri->segment(1)=="my-blogs") {

                                                                        if($row->status == 1 && $row->is_approved == 1) {
                                                                            $expired = "<span style='color:green'>Live</span>";
                                                                        }else if($row->is_approved == 2) {
                                                                            $expired = "<span style='color:red'>Disapprove</span>";
                                                                        }else if($row->is_approved == 0) {
                                                                            $expired = "<span style='color:#87CEEB;'>Under Review</span>";
                                                                        }
                                                                    }else{
                                                                        if($row->status == 1) {
                                                                            $expired = "<span style='color:green'>Live</span>";
                                                                        }                                                                    }  
                                                                }
                                                        ?>
                                                            <tr id="row_<?php echo $row->id;?>">
                                                            <td style="text-align:center">
                                                                <?php
                                                                  $country = $this->db->where('id', $row->country_id)->get('admin_countries')->row();
                                                                  $city = $this->db->where('id', $row->city_id)->get('admin_cities')->row();
                                                                  
                                                                  if($country) {
                                                                    ?>
                                                                    <img width="20px" height="20px"  src="<?php echo $country->flag;?>">
                                                                    &nbsp
                                                                <?php echo $country->title; ?>
                                                                    <?php
                                                                         } 
                                                                   ?>
                                                            
                                                            </td>
                                                            
                                                                <td>
                                                                <?php echo strlen($row->title) > 30 ? substr($row->title, 0, 30) . '...' : $row->title; ?>

                                                                </td>

                                                            <?php if($this->uri->segment(1)=="my-blogs" || $this->uri->segment(1)=="my-forums"){ ?>
                                                                    <td>
                                                                        <img style="height: 40px" src="<?php echo $row->image; ?>">
                                                                    </td>
                                                                <?php } ?>
                                                                <td>
                                                                    <?php echo $row->author; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $expired; ?>
                                                                </td>
                                                                
                                                               
                                                                <td><?php echo date("F, d Y", strtotime($row->created_at));?></td>
                                                                <?php if($this->uri->segment(1)=="my-blogs"){ ?>
                                                                <td>
                                                                <?php
                                                                    echo $row->is_approved == 1 
                                                                        ? "<span style='color:green'>Approved</span>" 
                                                                        : ($row->is_approved == 2 
                                                                            ? "<span style='color:red'>Disapprove</span>" 
                                                                            : "<span style='color:red'>Pending</span>");
                                                                ?>

                                                                </td>
                                                                <?php } ?>

                                                                    
                                                                <td style="width:100px; text-align: center;" class="actions_links">
                                                                    <?php if($row->is_approved != 2){?>

                                                                    <a title="View Details" href="<?php echo base_url();?><?php echo $url_page;?>/details/<?php echo $row->slug;?>">
                                                                        <i class="fa fa-tv"></i>
                                                                    </a>
                                                                    <?php if($row->is_approved != 1){ ?>
                                                                    <a title="Edit" href="<?php echo base_url();?>edit/<?php echo $url_page;?>/<?php echo $row->id;?>">
                                                                        <i class="fa fa-pencil"></i>
                                                                    </a>

                                                                    <?php } } ?>
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
        var x = confirm("Are you sure, you want to delete this <?php echo $url_page;?>?");
        if(x){
            window.location.href = "<?php echo base_url();?>nepstate/<?php echo $this->uri->segment(1)=="my-blogs"?"do_delete_blog":"do_delete_confession";?>/"+val;
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