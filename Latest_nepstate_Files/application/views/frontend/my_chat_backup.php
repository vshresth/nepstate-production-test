<!-- component -->
<?php include("common/header.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<style>
        /* Modal container */
        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 50; /* Sufficiently high to appear above other elements */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            justify-content: center;
            align-items: center;
        }

        /* Modal content */
        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 90%; /* Adjust this width as needed */
            max-width: 400px; /* Max width to prevent it from getting too wide */
        }
        .chatCountIcon {
         color:#fff;padding: 0px 5px;border-radius:100%;font-size: 10px;width: 14px;height: 14px;display: flex;justify-content: center;align-items: center;position: absolute;right: 0px;top: 0px;
        }
    </style>

<section class="listing-archvie-page bg--accent" style="padding-top: 20px;">
<div class="container-fluid mb-20">
   <div class="flex overflow-hidden">
      <!-- Sidebar -->
      <div class="w-1/4 bg-white border-r border-gray-300">
         <!-- Sidebar Header -->
          <?php if($redirectBy == 'product'){ ?>
            <div style="padding:10px;"> 
               Chat on <?php echo ucfirst($productInfo->category);  ?>  
            </div>
         <?php } ?>
         <header class="p-4 border-b border-gray-300 flex justify-between items-center bg-indigo-600 text-white" style="background:#ff9902;text-color:white;">
             <span style="text-2xl font-semibold;font-size:20px;" >My Chats</span>
              
            <div class="relative">
            </div>
         </header>

         <!-- Contact List -->
         <div class="overflow-y-auto p-3" style="height:calc( 100vh - 220px)">
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

            <a href="<?php echo base_url().'my-chats?conversation_id='.$conversation->id.'&&name='.$userInfo->name.'&&redirect-by='.$redirectBy.'&&product-id='.$productId ?>" style="text-decoration:none; display:block;">
               <div class="flex items-center mb-4 cursor-pointer hover:bg-gray-100 p-2 rounded-md <?php if($conversationId == $conversation->id){echo "bg-gray-100";} ?>"  style="" >
                  <div class="w-12 h-12 bg-gray-300 rounded-full mr-3">
                     <img src="<?php echo $image_user; ?>" alt="User Avatar" class="w-12 h-12 rounded-full">
                  </div>
                  <div class="flex-1">
                  <?php $unReadCount =  $this->db->where('conversation_id', $conversation->id)->where('receiver_id', user_info()->id )->where('seen', 0)->get('chats')->num_rows();?>
                     <h2 class="text-lg font-semibold "><?php echo $userInfo->name; ?> <?php if($unReadCount != 0) {?> <span class="bg-indigo-500 " style="color:#fff;padding:0px 5px; border-radius:100%;font-size: 10px;width: 14px;height: 14px;display: flex;justify-content: center;align-items: center;position: absolute;right: 0px;top: 0px;">  <?php echo $unReadCount;} ?> </span></h2>
                     <p class="text-gray-600"><?php echo ucfirst($productInfo->category); ?> > <?php echo $productInfo->title; ?> </p>
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
         </div>
         <!-- Chat Input -->
         <footer class="bg-white border-t border-gray-300 p-4  bottom-0 w-full">
         <div class="flex items-center">
            <input type="text" placeholder="Type a message..." class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500" id="messageInput">
            <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" onclick="openModal()"> File</button>
            <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" onclick="sendMessage('message')">Send</button>
         </div>
      
      </footer>

         <?php }else{ ?>
            <div class="flex justify-center items-center h-screen" style="width:100%;">
               <p class="text-lg font-semibold text-gray-600 text-center mb-4 w-3/4  ">No Conversation Selected.</p>
            </div>
      <?php } ?>
      </div>
</div>
</div>
</div>

        <!-- Modal content -->
      <div class="modal" id="myModal">
        <div class="modal-content">
            <h2 class="text-lg font-semibold mb-4">Upload a File</h2>
            <input type="file" class="border p-2 w-full rounded" id="file" /><br>
            <input type="text" name="file_title" id="fileTitle" class="border p-2 w-full rounded" placeholder="File Title" required>
            <button class="bg-blue-500 text-white px-4 py-2 rounded mt-4" onclick="sendMessage('file')">Submit</button>
            <button class="bg-red-500 text-white px-4 py-2 rounded mt-1" onclick="closeModal()">Close</button>
        </div>
      </div>
<?php include("common/footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        function openModal() {
        
            document.getElementById('myModal').style.display = 'flex';
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('myModal').style.display = 'none';
        }
    </script>
<script>
   
   setInterval(() => {
      getMessage();
   }, 1000);       


   
   document.getElementById('messageInput').addEventListener('keydown', function(event) {
        if (event.key === 'Enter') {
           event.preventDefault();
           if(checkInput('message') == true) {
              sendMessage('message');
           }
        }
    });
   

   function sendMessage(type) {

if (checkInput(type) == false) {
    return;
}

var messageInput = document.getElementById('messageInput').value.trim(); // Get the value, not the element itself
var file = document.getElementById('file').files[0]; // Get the file object
var fileTitle = document.getElementById('fileTitle').value.trim(); // Get the value

let formData = new FormData();

if (messageInput !== '') {
    formData.append('message', messageInput);

}

if (file) { // Check if file is selected
    formData.append('file', file);
    if (fileTitle !== '') {
        formData.append('file_title', fileTitle);
    }
}
formData.append('file_type', type);
formData.append('conversationId', '<?php echo $conversationId; ?>');
console.log(formData)
$.ajax({
    url: '<?php echo base_url(); ?>Nepstate/send_message',
    type: 'POST',
    data: formData,
    processData: false, // Prevent jQuery from converting the data
    contentType: false, // Tell jQuery not to set content type
    success: function(data) {
        var response = JSON.parse(data);
        console.log(response);
        if (response.status == true) {
            var userId = '<?php echo user_info()->id; ?>';
            var messageHTML = '';
            var  filePath =  response.chat.file;
            var fileExtension = filePath.split('.').pop().toLowerCase();
            var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];
            var documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv'];

            if (userId == response.chat.receiver_id) {
                
               messageHTML = `<div class="flex mb-4 cursor-pointer"> 
                              <div class="flex flex-col max-w-96 bg-white rounded-lg p-3 gap-3">`;

                if(response.chat.file_type == 'message') {
                  messageHTML += `
                     
                              ${response.chat.message}
                       `;
                }else if(response.chat.file_type == 'file') {

                  if (imageExtensions.includes(fileExtension)) {
                     messageHTML += `
                     <div class="flex flex-col items-center">
                     <img src="${filePath}" alt="Uploaded Image" class="w-24 h-24" height="200px">
                        <p class="mb-0">${response.chat.file_title}</p>
                        <a href="${filePath}" download>
                        <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                        </a>
                     </div>`;
                  }else if(documentExtensions.includes(fileExtension)) {
                     messageHTML += `
                      <div class="flex flex-col items-center">
                              <i class="fas fa-file-alt text-gray-700 text-5xl"></i>
                              <p class="mb-0">${response.chat.file_title}</p>
                              <a href="${filePath}" download>
                              <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                              </a>
                           </div>`;
                  }else{
                     messageHTML += `Unsupported file type`;
                  }

                } 
               //  messageHTML += `<p style="font-size:12px;"> ${timeElapsedStringHeader(response.chat.created_at)}</p>`;

                messageHTML += ` </div> </div>`;

            } else if (userId == response.chat.sender_id) {

               messageHTML  = `<div class="flex flex-col items-end mb-4 cursor-pointer">
               <div class="flex max-w-96 text-white rounded-lg p-3 gap-3"  style="background:#ff9902;text-color:white;">`;
               if(response.chat.file_type == 'message') {
                messageHTML += `
                   
                            ${response.chat.message}
                       `;
                  }else if(response.chat.file_type == 'file') {

                     if (imageExtensions.includes(fileExtension)) {
                        messageHTML += `
                        <div class="flex flex-col items-center">
                        <img src="${filePath}" alt="Uploaded Image" class="w-24 h-24" height="200px">
                           <p class="mb-0">${response.chat.file_title}</p>
                           <a href="${filePath}" download>
                           <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                           </a>
                        </div>`;
                     }else if(documentExtensions.includes(fileExtension)) {
                        messageHTML += `
                        <div class="flex flex-col items-center">
                                 <i class="fas fa-file-alt text-gray-700 text-5xl"></i>
                                 <p class="mb-0">${response.chat.file_title}</p>
                                 <a href="${filePath}" download>
                                 <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                                 </a>
                              </div>`;
                     }else{
                        messageHTML += `Unsupported file type`;
                     }

                  } 
                  // messageHTML += `<p style="font-size:12px;"> ${timeElapsedStringHeader(response.chat.created_at)}</p>`;

                  messageHTML += ` </div> </div>`;

            }

            $('#messageBox').append(messageHTML);
            $("#messageBox").animate({
            scrollTop: $("#messageBox")[0].scrollHeight
        }, 1000); 
            $('#messageInput').val('');
            $('#file').val(''); // Reset file input
            $('#fileTitle').val(''); // Reset file title
            closeModal();
        }
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
              console.log(response)
              if (response.status == true) {
                 response.chats.forEach(function(chat) { 
                  var messageHTML = '';
                  
                  var  filePath =  chat.file;
                  var fileExtension = filePath.split('.').pop().toLowerCase();
                  var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];
                  var documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv'];

                  if (userId == chat.receiver_id) {

                     var audio = document.getElementById("myAudio");
                     audio.play();

                     messageHTML = `<div class="flex mb-4 cursor-pointer"> 
                     <div class="flex flex-col max-w-96 bg-white rounded-lg p-3 gap-3">`;

                if(chat.file_type == 'message') {
                  messageHTML += `
               
                           ${chat.message} `;
                }else if(chat.file_type == 'file') {

                  if (imageExtensions.includes(fileExtension)) {
                     messageHTML += `
                     <div class="flex flex-col items-center">
                     <img src="${filePath}" alt="Uploaded Image" class="w-24 h-24" height="200px">
                        <p class="mb-0">${chat.file_title}</p>
                        <a href="${filePath}" download>
                        <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                        </a>
                     </div>`;
                  }else if(documentExtensions.includes(fileExtension)) {
                     messageHTML += `
                      <div class="flex flex-col items-center">
                              <i class="fas fa-file-alt text-gray-700 text-5xl"></i>
                              <p class="mb-0">${chat.file_title}</p>
                              <a href="${filePath}" download>
                              <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                              </a>
                           </div>`;
                  }else{
                     messageHTML += `Unsupported file type`;
                  }

                } 
                messageHTML += ` </div> </div>`;

                  } else if (userId == chat.sender_id) { 
                     messageHTML = ` <div class="flex flex-col items-end mb-4 cursor-pointer">
               <div class="flex max-w-96 text-white rounded-lg p-3 gap-3"  style="background:#ff9902;text-color:white;">`;
               if(chat.file_type == 'message') {
                messageHTML += `
                    
                     ${chat.message}
                      `;
                  }else if(chat.file_type == 'file') {

                     if (imageExtensions.includes(fileExtension)) {
                        messageHTML += `
                        <div class="flex flex-col items-center">
                        <img src="${filePath}" alt="Uploaded Image" class="w-24 h-24" height="200px">
                           <p class="mb-0">${chat.file_title}</p>
                           <a href="${filePath}" download>
                           <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                           </a>
                        </div>`;
                     }else if(documentExtensions.includes(fileExtension)) {
                        messageHTML += `
                        <div class="flex flex-col items-center">
                                 <i class="fas fa-file-alt text-gray-700 text-5xl"></i>
                                 <p class="mb-0">${chat.file_title}</p>
                                 <a href="${filePath}" download>
                                 <button class="bg-indigo-500 text-white px-4 py-2 rounded-md ml-2" >Download</button>
                                 </a>
                              </div>`;
                     }else{
                        messageHTML += `Unsupported file type`;
                     }

                  } 

                  messageHTML += ` </div> </div>`;
                  }
                  $('#messageBox').append(messageHTML);
                  $("#messageBox").animate({
            scrollTop: $("#messageBox")[0].scrollHeight
        }, 1000); 
               });
               }
   
   
            }
          });
        }
      
        function checkInput(type) {
          var messageInput = document.getElementById('messageInput');
          var file = document.getElementById('file');
          var fileTitle = document.getElementById('fileTitle');

          if(type == 'file') {
               if (file.value == '') {
                  alert('Please select a file.');
                  return false;
               }else{
                  return true;
               }
         }else if(type == 'message') {
            
               if (messageInput.value == '') {
                  alert('Please enter a message.');
                  return false;
               }else{
                  return true;
               }
         }


         
        }


        function timeElapsedStringHeader(datetime, full = false) {
    const now = new Date();
    const ago = new Date(datetime);

    // Calculate the difference between now and ago
    let diff = now - ago; // difference in milliseconds

    // Calculate the difference in each unit
    const seconds = Math.floor(diff / 1000);
    const minutes = Math.floor(seconds / 60);
    const hours = Math.floor(minutes / 60);
    const days = Math.floor(hours / 24);
    const months = Math.floor(days / 30); // Approximation
    const years = Math.floor(months / 12);

    // Prepare the string for each unit
    const string = {
        y: years,
        m: months % 12,
        d: days % 30,
        h: hours % 24,
        i: minutes % 60,
        s: seconds % 60
    };

    // Format the result
    let result = [];

    for (let k in string) {
        if (string[k]) {
            result.push(string[k] + ' ' + k + (string[k] > 1 ? 's' : ''));
        }
    }

    if (!full) {
        return result.length ? result[0] + ' ago' : 'just now';
    } else {
        return result.length ? result.join(', ') + ' ago' : 'just now';
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