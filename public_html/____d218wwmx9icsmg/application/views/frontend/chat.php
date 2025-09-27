<!-- component -->
<?php include("common/header.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<section class="listing-archvie-page bg--accent" style="padding-top: 20px;">
<div class="container-fluid mb-20">
   <div class="flex overflow-hidden">
      <!-- Sidebar -->
      <div class="w-1/4 bg-white border-r border-gray-300">
         <!-- Sidebar Header -->
          <div style="padding:10px;" > 

             Chat on <?php echo ucfirst($productInfo->category);  ?>
          </div>
         <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-indigo-600 text-white" style="background:#ff9902;text-color:white;">
            <span style="text-2xl font-semibold;font-size:17px;" ><?php echo  $productInfo->title; ?></span>
            
            <div class="relative">
            </div>
         </header>

         <!-- Contact List -->
         <div class="overflow-y-auto p-3" style="height:calc( 100vh - 23vh)">
         <?php foreach($conversations_all as $key => $conversation){ ?>
         <?php
            if(user_info()->id == $conversation->product_creator_id){
              $userInfo = $this->db->where('id', $conversation->user_id)->get('users')->row();
            
            }else if(user_info()->id != $conversation->product_creator_id){
              $userInfo = $this->db->where('id', $conversation->product_creator_id)->get('users')->row();
            }
            
              $image_append = base_url()."resources/uploads/profiles/";
            
              if($userInfo->profile_pic == "dummy_image.png"){
                  $image_user = $image_append."dummy_image.png";
              }else{
                  $image_user = $userInfo->profile_pic;
              }
             
            ?>

<a href="<?php echo base_url().'/chat/'.$productId.'/?conversation_id='.$conversation->id.'&&name='.$userInfo->name ?>" style="text-decoration:none">
<div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md <?php if($conversationId == $conversation->id){echo "bg-gray-100";} ?>"  style="width:1000%;" >
                  <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                     <img src="<?php echo $image_user ?>" alt="User Avatar" class="w-12 h-12 rounded-full">
                  </div>
                  <div class="flex-1">
                  <h2 class="text-lg font-semibold"><?php echo $userInfo->name ?></h2>
                     <p class="text-gray-600"><?php echo ucfirst($productInfo->category); ?> > <?php echo $productInfo->title; ?></p>
                  </div>
               </div>
            </a>
            <?php } ?>
         </div>
      </div>

               

      <?php if($conversationId != 0){ ?>

      <!-- Main Chat Area -->
      <div class="flex-1">
         <!-- Chat Header -->
         <header class="bg-white p-4 text-gray-700">
            <h1 class="text-2xl font-semibold"><?php echo $name ;?></h1>
         </header>


         <!-- Chat Messages -->
         <div class=" overflow-y-auto p-4 pb-36" id="messageBox" style="height:calc( 100vh - 35vh)">
            <?php foreach($chat as $message) {

               // if($message->sender_type == 'creator') {
               if(user_info()->id == $message->receiver_id) {

               ?>
            <!-- Incoming Message -->
            <div class="flex mb-4 cursor-pointer">
               <!-- <div class="w-9 h-9 rounded-full flex items-center justify-center mr-2">
                  <img src="https://placehold.co/200x/ffa8e4/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="User Avatar" class="w-8 h-8 rounded-full">
               </div> -->
               <div class="flex max-w-96 bg-white rounded-lg p-3 gap-3">
                  <p class="text-gray-700"><?php echo $message->message; ?></p>
               </div>
            </div>
            <?php }else if(user_info()->id == $message->sender_id) { ?>
            <!-- Outgoing Message -->
            <div class="flex justify-end mb-4 cursor-pointer">
               <div class="flex max-w-96 text-white rounded-lg p-3 gap-3"  style="background:#ff9902;text-color:white;">
                  <p><?php echo $message->message; ?></p>
               </div>
               <!-- <div class="w-9 h-9 rounded-full flex items-center justify-center ml-2">
                  <img src="https://placehold.co/200x/b7a8ff/ffffff.svg?text=ʕ•́ᴥ•̀ʔ&font=Lato" alt="My Avatar" class="w-8 h-8 rounded-full">
               </div> -->
            </div>
            <?php } ?>
            <?php } ?>
         </div>
         <!-- Chat Input -->
         <footer class="bg-white border-t border-gray-300 p-4 absolute bottom-0 w-3/4">
      <div class="flex items-center">
         <input type="text" placeholder="Type a message..." class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500" id="messageInput">
         <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" onclick="sendMessage()">Send</button>

      </div>
      </footer>

         <?php }else{ ?>
            <div class="flex justify-center items-center h-screen" style="width:100%;">
               <p class="text-lg font-semibold text-gray-600 text-center mb-4 w-3/4  ">No Coversation Selected.</p>
            </div>
      <?php } ?>
      </div>
</div>
</div>
         </div>
<?php include("common/footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
   setInterval(() => {
      getMessage();
   }, 1000);       


   
   document.getElementById('messageInput').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
           event.preventDefault();
           if(checkInput() == true) {
              sendMessage();
           }
        }
    });
   
   function sendMessage(){

           if(checkInput() == false) {
              return;
           }
          var message = $('#messageInput').val();
          var conversationId = '<?php echo $conversationId; ?>';
          var userId = '<?php echo user_info()->id; ?>';
          $.ajax({
            url: '<?php echo base_url(); ?>Nepstate/send_message',
            type: 'POST',
            data: {
              message: message,
              conversationId: conversationId,
              
            },
            success: function(data) {
              var response = JSON.parse(data);
              console.log(response)
              if(response.status == true) {
                  
                  if ( userId == response.chat.receiver_id) {
                      $('#messageBox').append(`<div class="flex mb-4 cursor-pointer">
                       
                        <div class="flex max-w-96 bg-white rounded-lg p-3 gap-3">
                        <p class="text-gray-700">${response.chat.message}</p>
                        </div>
                    </div>`);
                  }else if(userId == response.chat.sender_id) {
                      $('#messageBox').append(`<div class="flex justify-end mb-4 cursor-pointer">
                      <div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3" style="background:#ff9902;text-color:white;">
                          <p>${response.chat.message}</p>
                      </div>
                    
                      </div>`);
                  }
              }
   
              $('#messageInput').val('');
            }
          });
   
        }
   
   
        function getMessage()
        {
          var conversationId = '<?php echo $conversationId; ?>';
          var userId = '<?php echo user_info()->id; ?>';

          $.ajax({
            url: '<?php echo base_url(); ?>Nepstate/get_message',
            type: 'POST',
            data: {
              conversationId: conversationId,
            },
            success: function(data) {
              var response = JSON.parse(data);
              if (response.status == true) {
   response.chats.forEach(function(chat) { // Corrected 'foreach' syntax to 'forEach'
      if (userId == chat.receiver_id) {
          $('#messageBox').append(`
              <div class="flex mb-4 cursor-pointer">
                  
                  <div class="flex max-w-96 bg-white rounded-lg p-3 gap-3">
                      <p class="text-gray-700">${chat.message}</p> <!-- Corrected the quote -->
                  </div>
              </div>
          `);
      } else if (userId == chat.sender_id) { // Corrected 'response.chat' to 'chat'
          $('#messageBox').append(`
              <div class="flex justify-end mb-4 cursor-pointer">
                  <div class="flex max-w-96 bg-indigo-500 text-white rounded-lg p-3 gap-3" style="background:#ff9902;text-color:white;">
                      <p>${chat.message}</p>
                  </div>
                 
              </div>
          `);
      }
   });
   }
   
   
            }
          });
        }
      
        function checkInput() {
          var messageInput = document.getElementById('messageInput');
          if (messageInput.value === '') {
               alert('Please enter a message.');
               return false;
          }else{
            return true;
          }
        }

</script>
<script>
   // JavaScript for showing/hiding the menu
   const menuButton = document.getElementById('menuButton');
   const menuDropdown = document.getElementById('menuDropdown');
   
   menuButton.addEventListener('click', () => {
     if (menuDropdown.classList.contains('hidden')) {
       menuDropdown.classList.remove('hidden');
     } else {
       menuDropdown.classList.add('hidden');
     }
   });
   
   // Close the menu if you click outside of it
   document.addEventListener('click', (e) => {
     if (!menuDropdown.contains(e.target) && !menuButton.contains(e.target)) {
       menuDropdown.classList.add('hidden');
     }
   });
</script>