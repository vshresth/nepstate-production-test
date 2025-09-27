<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>

                                        <?php include("common/siderbar.php"); ?>
                                        <div class="rtcl-MyAccount-content">
                                            <div class="rtcl-user-info media">
                                                <?php  
                                                    $whishlist = $this->db->query("SELECT * FROM wishlist WHERE user_id = ".user_info()->id." ORDER BY id DESC")->result_object();
                                                ?>
                                                <table class="listing_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Date</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        foreach($whishlist as $key=>$row){
                                                            $product = $this->db->query("SELECT * FROM products WHERE id = ".$row->product_id)->result_object()[0];
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $product->title;?></td>
                                                                <td><?php echo date("F, d Y", strtotime($row->created_at));?></td>
                                                                <td style="width:100px; text-align: center;">
                                                                    <a href="<?php echo base_url();?>classified/detail/<?php echo $product->slug;?>" style="margin-right: 20px;">
                                                                        <i class="fa fa-tv"></i>
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
        var x = confirm("Are you sure, you want to delete this classified from favorites?");
        if(x){
            window.location.href = "<?php echo base_url();?>nepstate/remove_favorites/"+val;
        }
    }
</script>