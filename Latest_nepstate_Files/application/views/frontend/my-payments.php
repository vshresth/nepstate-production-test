<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>


                                        <?php include("common/siderbar.php"); ?>
                                        <div class="rtcl-MyAccount-content">
                                            <div class="rtcl-user-info media">

                                                <table class="listing_table">
                                                    <thead>
                                                        <tr>
                                                            <th>Type</th>
                                                            <th>Amount paid</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                            for($i=1;$i<=5;$i++){
                                                        ?>
                                                            <tr>
                                                                <td>New ad Posted</td>
                                                                <td>
                                                                    <span style="display: block;width: 90%;">
                                                                        $10
                                                                    </span>
                                                                </td>
                                                                
                                                                <td><?php echo date("F, d Y");?></td>
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
    function do_show_alert(){
        var x = confirm("Are you sure, you want to delete this comment?");
    }
</script>