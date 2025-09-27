<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>
<?php include("common/siderbar.php"); ?>
<div class="rtcl-MyAccount-content">
   <div class="rtcl-user-info media">
      <h3>Blog Comments</h3>
      <table class="listing_table">
         <thead>
            <tr>
               <th>User Name</th>
               <th>Blog</th>
               <th>Comment</th>
               <th>Posted Date</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $blogCommentQuery = $this->db->where('uID', user_info()->id)->get('blogs')->result_array();
               $listOfBlogIds = array_column($blogCommentQuery, 'id');
               
               if(count($listOfBlogIds) > 0){
                   $listOfBlogIds = $listOfBlogIds;
               }else{
                   $listOfBlogIds = array(0);
               }
               
               $listOfBlogsComments = $this->db->where_in('bID', $listOfBlogIds)->order_by('id', 'desc')->get('blog_comment')->result_object();
               
               ?>
            <?php 
               foreach($listOfBlogsComments as $comment){
                   $blogQuery = $this->db->where('id', $comment->bID)->get('blogs')->row();
                   $blogTitle = $blogQuery->title;
               ?>
            <tr>
               <td><?php echo $comment->commenter_name;?></td>
               <td style="width:45%">
                  <span style="display: block;width: 90%;">
                  <?php echo $blogTitle;?>
                  </span>
               </td>
               <td style="display: block;width: 300px;"><?php echo $comment->comment;?></td>
               <td><?php echo $comment->created_at;?></td>
               <td style="width:100px; text-align: center;" class="actions_links">
                  <a onclick="return confirm('Are you sure you want to delete this comment?')" title="Delete Comment" href="<?php echo base_url('Nepstate/do_delete_blog_comment/'.$comment->id);?>">
                  <i class="fa fa-trash"></i>
                  </a>
               </td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
   </div>
   <!-- <div class="rtcl-MyAccount-content"> -->
      <div class="rtcl-user-info media" style="margin-top: 20px;">
         <h3>Confession Comments</h3>
         <table class="listing_table">
            <thead>
               <tr>
                  <th>User Name</th>
                  <th>Confession</th>
                  <th>Comment</th>
                  <th>Posted Date</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  $confessionCommentQuery = $this->db->where('uID', user_info()->id)->where('type', 'confession')->get('confessions')->result_array();
                  $listOfConfessionIds = array_column($confessionCommentQuery, 'id');
                  
                  if(count($listOfConfessionIds) > 0){
                      $listOfConfessionIds = $listOfConfessionIds;
                  }else{
                      $listOfConfessionIds = array(0);
                  }
                  $listOfConfessionComments = $this->db->where_in('bID', $listOfConfessionIds)->order_by('id', 'desc')->get('confession_comment')->result_object();
                  
                  ?>
               <?php 
                  foreach($listOfConfessionComments as $comment){
                      $confessionQuery = $this->db->where('id', $comment->bID)->get('confessions')->row();
                      $confessionTitle = $confessionQuery->title;
                  ?>
               <tr>
                  <td><?php echo $comment->commenter_name;?></td>
                  <td>
                     <span style="display: block;width: 90%;">
                     <?php echo $confessionTitle;?>
                     </span>
                  </td>
                  <td style="display: block;width: 300px;" ><?php echo $comment->comment;?></td>
                  <td><?php echo $comment->created_at;?></td>
                  <td style="width:100px; text-align: center;" class="actions_links">
                     <a onclick="return confirm('Are you sure you want to delete this comment?')" title="Delete Comment" href="<?php echo base_url('Nepstate/do_delete_confession_comment/'.$comment->id);?>">
                     <i class="fa fa-trash"></i>
                     </a>
                  </td>
               </tr>
               <?php } ?>
            </tbody>
         </table>
      </div>
      <!-- <div class="rtcl-MyAccount-content"> -->
         <div class="rtcl-user-info media" style="margin-top: 20px;">
            <h3>Forum Comments</h3>
            <table class="listing_table">
               <thead>
                  <tr>
                     <th>User Name</th>
                     <th>Forum</th>
                     <th>Comment</th>
                     <th>Posted Date</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     $forumCommentQuery = $this->db->where('uID', user_info()->id)->where('type', 'forum')->get('confessions')->result_array();
                     $listOfForumIds = array_column($forumCommentQuery, 'id');
                     
                     if(count($listOfForumIds) > 0) {
                         $listOfForumIds = $listOfForumIds;
                     }else{
                         $listOfForumIds = array(0);
                     }
                     $listOfForumComments = $this->db->where_in('bID', $listOfForumIds)->order_by('id', 'desc')->get('confession_comment')->result_object();
                     
                     ?>
                  <?php 
                     foreach($listOfForumComments as $comment){
                         $forumQuery = $this->db->where('id', $comment->bID)->get('confessions')->row();
                         $forumTitle = $forumQuery->title;
                     ?>
                  <tr>
                     <td><?php echo $comment->commenter_name;?></td>
                     <td style="width:45%">
                        <span style="display: block;width: 90%;">
                        <?php echo $forumTitle;?>
                        </span>
                     </td>
                     <td style="display: block;width: 300px;"><?php echo $comment->comment;?></td>
                     <td><?php echo $comment->created_at;?></td>
                     <td style="width:100px; text-align: center;" class="actions_links">
                        <a onclick="return confirm('Are you sure you want to delete this comment?')" title="Delete Comment" href="<?php echo base_url('Nepstate/do_delete_confession_comment/'.$comment->id);?>">
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
<!-- </div>
</div> -->
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