<!-- component -->
<?php 
include("common/header.php");   ?>
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
   <div class="flex overflow-hidden flex-col md:flex-row">
      <!-- Sidebar -->
      <div class="md:w-1/4 w-full bg-white border-r border-gray-300">
         <div style="padding:5px;  font-size: 15px; ">
         <!-- <a href="javascript:history.back()" style="color:red; text-decoration: underline;">Back</a> -->

            <a href="<?php echo $backURL; ?>" style="font-size: 36px; text-decoration: none;">&#8592;</a>

        
         </div>

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
         <div class="overflow-y-auto p-3 conversationsBoxModel" style="" id="conversationsBox">
         <?php include('common/conversations.php'); ?>
            
         </div>
      </div>

               

      <?php if($conversationId != 0){ ?>

      <!-- Main Chat Area -->
      <div class="flex-1">
         <!-- Chat Header -->
         <header class=" bg-white flex item-center items-center justify-between p-4 text-gray-700 w-full">
            <h1 class="text-2xl font-semibold"><?php echo $name ;?></h1>
            <a href="<?php echo base_url().'Nepstate/delete_all_chat/'. $conversationId ?>" 
                  onclick="return confirm('Are you sure you want to delete all chat?')" 
                  style="" 
                  class="bg-red-500 text-white px-4 py-2 rounded-md ml-2 deleteChatButton" >
                  Delete All Chat
            </a>
         </header>
         <div class=" overflow-y-auto p-4 pb-36 w-full" id="messageBox" style="height:calc( 100vh - 35vh)">
            <?php include('common/chat.php'); ?>
         </div>
         <!-- Chat Input -->
         <footer class="bg-white border-t border-gray-300 p-4  bottom-0 w-full">
         <div class="flex items-center flex-col md:flex-row">
            <input type="text" placeholder="Type a message..." class="w-full p-2 rounded-md border border-gray-400 focus:outline-none focus:border-blue-500" id="messageInput">
           <div class="flex items-center justify-between w-full mt-2 md:mt-0">
              <button class="bg-indigo-500 text-white px-4 py-2 rounded-md w-full ml-2" onclick="openModal()"> File</button>
              <button class="bg-indigo-500 text-white px-4 py-2 rounded-md w-full ml-2" onclick="sendMessage('message')">Send</button>
            </div>

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

   var messageInput = document.getElementById('messageInput').value.trim();
   var file = document.getElementById('file').files[0];
   var fileTitle = document.getElementById('fileTitle').value.trim();

   let formData = new FormData();

   if (messageInput !== '') {
      formData.append('message', messageInput);
   }

   if (file) {
      formData.append('file', file);
      if (fileTitle !== '') {
         formData.append('file_title', fileTitle);
      }
   }

   formData.append('file_type', type);
   formData.append('conversationId', '<?php echo $conversationId; ?>');

   $.ajax({
    url: '<?php echo base_url(); ?>Nepstate/send_message',
    type: 'POST',
    data: formData,
    processData: false, // Prevent jQuery from converting the data
    contentType: false, // Tell jQuery not to set content type
    success: function(data) {
        var response = JSON.parse(data);
        if (response.status == true) {
            var userId = '<?php echo user_info()->id; ?>';
            var messageHTML = '';
            var  filePath =  response.chat.file;
            var fileExtension = filePath.split('.').pop().toLowerCase();
            var imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'];
            var documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'csv'];

            if (userId == response.chat.sender_id) {

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
                  messageHTML += ` </div> </div>`;

            }

            $('#messageBox').append(messageHTML);
            $("#messageBox").animate({
            scrollTop: $("#messageBox")[0].scrollHeight
        }, 1000);
            $('#messageInput').val('');
            $('#file').val('');
            $('#fileTitle').val('');
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
               $('#messageBox').html(data);
               // $("#messageBox").animate({
               //    scrollTop: $("#messageBox")[0].scrollHeight
               // }, 1000); 
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