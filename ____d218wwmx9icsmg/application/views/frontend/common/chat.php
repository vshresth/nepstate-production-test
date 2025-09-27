         <!-- Chat Messages -->
            <?php foreach($chat as $message) {

            // Get the file extension
            $fileExtension = pathinfo($message->file, PATHINFO_EXTENSION);
            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];
            $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv'];
               // if($message->sender_type == 'creator') {
               if(user_info()->id == $message->receiver_id) {

               ?>
            <!-- Incoming Message -->
            <div class="flex flex-col items-start mb-4 cursor-pointer">
               <!-- <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                  <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-8 h-8 rounded-full">
               </div> -->
               <div class="flex flex-col max-w-96 bg-white rounded-lg p-3 gap-3 ">

                  <?php if($message->file_type == 'message') { ?>
                     <?php echo $message->message; ?>
                  <?php }else if($message->file_type == 'file') { ?>
                     
                     <?php if(in_array(strtolower($fileExtension), $imageExtensions)) { ?>
                        <img src="<?php echo  $message->file ;?>" alt="Uploaded Image" class="w-24 h-24" height="200px">
                        <p class="mb-0"><?php echo  $message->file_title ;?></p>
                        <a href="<?php echo  $message->file ;?>" download>
                        <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                        </a>
                        <?php }else if(in_array(strtolower($fileExtension), $documentExtensions)) { ?>
                           <div class="flex flex-col items-center">
                              <i class="fas fa-file-alt text-gray-700 text-5xl"></i>
                              <p class="mb-0"><?php echo  $message->file_title ;?></p>
                              <a href="<?php echo  $message->file ;?>" download>
                              <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                              </a>
                           </div>
                         <?php }else{ ?>
                           Unsupported file type 
                           <?php } ?>  

                  <?php } ?>
               </div>
               <p style="font-size:12px;"><?php echo time_elapsed_string_header($message->created_at); ?></p>
            </div>
            <?php }else if(user_info()->id == $message->sender_id) { ?>
            <!-- Outgoing Message -->
            <div class="flex flex-col items-end mb-4 cursor-pointer">
               <div class="flex max-w-96 text-white rounded-lg p-3 gap-3"  style="background:#ff9902;text-color:white;">
               <?php if($message->file_type == 'message') { ?>
                  <?php echo $message->message; ?>
               
               <?php }else if($message->file_type == 'file') { ?>

                  <?php if(in_array(strtolower($fileExtension), $imageExtensions)) { ?>
                     <div class="flex flex-col items-center">
                        <img src="<?php echo  $message->file ;?>" alt="Uploaded Image" class="w-24 h-24" height="200px">
                        <p class="mb-0"><?php echo  $message->file_title ;?></p>
                        <a href="<?php echo  $message->file ;?>" download>
                        <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                        </a>
                        </div>
                        <?php }else if(in_array(strtolower($fileExtension), $documentExtensions)) { ?>
                           <div class="flex flex-col items-center">
                              <i class="fas fa-file-alt text-gray-700 text-5xl"></i>
                              <p class="mb-0"><?php echo  $message->file_title ;?></p>
                              <a href="<?php echo  $message->file ;?>" download>
                              <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                              </a>
                           </div>
                         <?php }else{ ?>
                           Unsupported file type
                        <?php } ?>  
               <?php } ?>
            </div>
               <p style="font-size:12px;"><?php echo time_elapsed_string_header($message->created_at); ?></p>
               </div>
            <?php } ?>
            <?php } ?>
