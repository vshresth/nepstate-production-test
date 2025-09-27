<?php include("common/header.php"); ?>
<?php include("common/breadcrum_dashboard.php"); ?>
<?php include("common/siderbar.php"); ?>
<div class="rtcl-MyAccount-content">
   <div class="rtcl-user-info media">
      <h3>My Products Reviews</h3>
      <table class="listing_table">
         <thead>
            <tr>
               <th>Reviewer Name</th>
               <th>Reviewer Email</th>
               <th>Product Name</th>
               <th>Rating</th>
               <th>Title</th>
               <th>Review</th>
               <th>Posted Date</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $product_ids = $this->db->select('id')
               ->from('products')
               ->where('uID', user_info()->id)
               ->get()
               ->result_array();
               
               $product_ids = array_column($product_ids, 'id');
               
               if (!empty($product_ids)) {
                   $myProductRatings = $this->db->select('order_reviews.*, products.id as product_id, products.title as product_name, users.name, users.email')
                               ->from('order_reviews')
                               ->join('users', 'order_reviews.user_id = users.id', 'inner')
                               ->join('products', 'order_reviews.order_id = products.id', 'inner')
                               ->where_in('order_reviews.order_id', $product_ids)
                               ->order_by('order_reviews.id', 'desc')
                               ->get()
                               ->result_array();
               
               } else {
                   $myProductRatings = [];
               }
               
               
                   foreach($myProductRatings as $rating){
                       
               ?>
            <tr>
               <td> <?php echo $rating['name'] ?? ''; ?></td>
               <td> <?php echo $rating['email'] ?? ''; ?> </td>
               <td> <?php echo $rating['product_name'] ?? ''; ?></td>
               <td>
                  <?php
                     for ($i = 0; $i < $rating['rating']; $i++) {
                         echo '<i class="fa-sharp fa-solid fa-star"  style="color:#e3866b"></i>';
                     }
                     ?>
               </td>
               <td> <?php echo $rating['title'] ?? ''; ?></td>
               <td> <?php echo $rating['review'] ?? ''; ?></td>
               <td> <?php echo $rating['created_at'] ?? ''; ?></td>
               <td style="width:100px; text-align: center;" class="actions_links">
                  <a title="Delete Review" href="<?php echo base_url('Nepstate/delete_review/' . $rating['id']); ?>" onclick="return confirm('Are you sure you want to delete this review?');">
                  <i class="fa fa-trash"></i>
                  </a>
               </td>
            </tr>
            <?php } ?>
         </tbody>
      </table>
      <br>
      <br>
      <h3>My Posted Reviews</h3>
      <table class="listing_table">
         <thead>
            <tr>
               <th>Product Name</th>
               <th>Rating</th>
               <th>Title</th>
               <th>Review</th>
               <th>Posted Date</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php
               $myPostedRatings = $this->db->select('order_reviews.*, products.id as product_id, products.title as product_name')
                           ->from('order_reviews')
                           ->join('products', 'order_reviews.order_id = products.id', 'inner')
                           ->where('order_reviews.user_id', user_info()->id)
                           ->order_by('order_reviews.id', 'desc')
                           ->get()
                           ->result_array();
               
               
               
               foreach($myPostedRatings as $rating){
                   
               ?>
            <tr>
               <td> <?php echo $rating['product_name'] ?? ''; ?></td>
               <td>
                  <?php
                     for ($i = 0; $i < $rating['rating']; $i++) {
                         echo '<i class="fa-sharp fa-solid fa-star"  style="color:#e3866b"></i>';
                     }
                     ?>
               </td>
               <td> <?php echo $rating['title'] ?? ''; ?></td>
               <td> <?php echo $rating['review'] ?? ''; ?></td>
               <td> <?php echo $rating['created_at'] ?? ''; ?></td>
               <td style="width:100px; text-align: center;" class="actions_links">
                  <a title="Delete Review" href="<?php echo base_url('Nepstate/delete_review/' . $rating['id']); ?>" onclick="return confirm('Are you sure you want to delete this review?');">
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
   function do_show_alert(){
       var x = confirm("Are you sure, you want to delete this review?");
   }
</script>