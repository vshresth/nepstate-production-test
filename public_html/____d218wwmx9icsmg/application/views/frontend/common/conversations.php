<?php foreach($conversations_all as $key => $conversation){ ?>
            
            <?php
               $productInfo = $this->db->where('id', $conversation->product_id)->get('products')->row();
               if(user_info()->id == $conversation->user_id){
               $userInfo = $this->db->where('id', $conversation->user_2)->get('users')->row();
               
               }else if(user_info()->id == $conversation->user_2){
               $userInfo = $this->db->where('id', $conversation->user_id)->get('users')->row();
               }
               
               $image_append = base_url()."resources/uploads/profiles/";
            
               if($userInfo->profile_pic == "dummy_image.png"){
                  $image_user = $image_append."dummy_image.png";
               }else{
                  $image_user = $userInfo->profile_pic;
               }
            ?>

            <a href="<?php echo base_url().'my-chats?conversation_id='.$conversation->id.'&&name='.$userInfo->name.'&&redirect-by='.$_GET['slug'].'&&product-id='.$productId ?>" style="text-decoration:none; display:block;">
               <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md <?php if($conversationId == $conversation->id){echo "bg-gray-100";} ?>"  style="position:relative;" >
                  <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                     <img src="<?php echo $image_user; ?>" alt="User Avatar" class="w-12 h-12 rounded-full">
                  </div>
                  <div class="flex-1">
                  <?php $unReadCount =  $this->db->where('conversation_id', $conversation->id)->where('receiver_id', user_info()->id )->where('seen', 0)->get('chats')->num_rows();?>
                     <h2 class="text-lg font-semibold "><?php echo $userInfo->name; ?> <?php if($unReadCount != 0) {?> <span class="bg-indigo-500 " style="color:#fff;padding:0px 5px; border-radius:100%;font-size: 10px;width: 14px;height: 14px;display: flex;justify-content: center;align-items: center;position: absolute;right: 10px;top: 20px;">  <?php echo $unReadCount;} ?> </span></h2>
                     <p class="text-gray-600"><?php echo ucfirst($productInfo->category); ?> > <?php echo $productInfo->title; ?> </p>
                  </div>
               </div>
            </a>
            <?php } ?>