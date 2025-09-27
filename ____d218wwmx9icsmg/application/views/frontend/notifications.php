
<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>
                                    <?php include("common/siderbar.php"); ?>
                                    <div class="rtcl-MyAccount-content">
                                        <?php if(!empty($notifications)) {?>
                                            <a href="<?php echo base_url(); ?>Nepstate/delete_all_notifications"  onclick="return confirm('Are you sure you want to delete all notifications?')" style="color:red;"> Delete All Notifications</a>
                                        <?php } ?>
    <div class="rtcl-user-info media" style="height:780px; overflow-y: auto;">
        <?php foreach ($notifications as $notification) { ?>
            <div class="notify_wrapper" style="display: flex; justify-content: space-between; align-items: center; width: 100%;" onclick="navigate('<?php echo $notification->notification_indicate; ?>', '<?php echo $notification->id; ?>', '<?php echo $notification->indicate_slug; ?>', '<?php echo $notification->indicate_id; ?>')">
                <div class="left_notif" style="width: 90%;">
                    <div class="headging_notif">
                        <?php echo $notification->type; ?>
                    </div>
                    <div class="notif_content">
                        <?php echo $notification->indicate_title != '' ? $notification->indicate_title : $notification->text; ?>
                    </div>
                </div>
                <div class="right_notif" style="width: 10%; text-align: right;">
                    <?php echo $notification->created_at; ?>
                    <a href="<?php echo base_url(); ?>nepstate/delete_notification/<?php echo $notification->id; ?>" 
                        onclick="event.stopPropagation(); if (confirm('Are you sure you want to delete this notification?')) { window.location.href=this.href; } return false;" style="color:red;">
                        Delete
                    </a>
                </div>
            </div>
        <?php } ?>
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
    function navigate(indicate, id, slug, indicateId){
        let baseURL = '<?php echo base_url(); ?>';

        let url = '';
        if(indicate == 'blog') {
            url = baseURL+'blog/details/'+slug;
        }else if(indicate == 'forum') {
            url = baseURL+'forum/details/'+slug;
        }else if(indicate == 'confession') {
            url = baseURL+'confession/details/'+slug;
        }else if(indicate == 'review-on-classified') {
            url = baseURL+'classified/detail/'+slug;
        }else if(indicate == 'new-message') {
            url = baseURL+'my-chats?conversation_id='+indicateId+'&&name='+slug;
        }
        
        window.location.href = url;

    }
</script>