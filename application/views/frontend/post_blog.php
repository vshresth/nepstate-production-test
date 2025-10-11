
<?php include("common/header.php"); ?>
<?php
    $url_submit = "";
    $button_text = "Send for Approval";
    $image_hs = "";
    if($edit == 1){
        $url_submit = "?edit=".$id;
        $button_text = "Send for Approval";
        $row = $this->db->query("SELECT * FROM blogs WHERE id = $id ".$blog_forum_confession_condition_query.""  )->result_object()[0];
        $image_hs = $row->image;
    }
?>
<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
        <h1 class="heading-title">POST NEW BLOG</h1>
	</div>
   </div>
</section>
<!--=====================================-->
<!--=         Inner Banner Start    	=-->
<!--=====================================-->		

<div data-elementor-type="wp-page" data-elementor-id="2207" class="elementor elementor-2207">
   <section class="elementor-section elementor-top-section elementor-element elementor-element-0e24f2b elementor-section-boxed elementor-section-height-default elementor-section-height-default rt-parallax-bg-no" data-id="0e24f2b" data-element_type="section">
      <div class="elementor-container elementor-column-gap-default">
         <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-d6ba0fd" data-id="d6ba0fd" data-element_type="column">
            <div class="elementor-widget-wrap elementor-element-populated">
               <div class="elementor-element elementor-element-ec8b882 elementor-widget elementor-widget-rt-accordion" data-id="ec8b882" data-element_type="widget" data-widget_type="rt-accordion.default">
                  <div class="elementor-widget-container">
                     <div class="faq-box">
                        <div class="panel-group"  style="margin-top: 50px;">
                           <div class="panel panel-default">
                                 <div class="panel-body" style="padding:20px; border-radius: 10px;">
                                        <form action="<?php echo base_url();?>submit/blog<?php echo $url_submit;?>" method="post" id="form_to_submit" enctype="multipart/form-data"  onsubmit="disableButton()">
                                            <div class="form-custom-post flex_space_between_wrap_start">
                                                <div class="form-group">
                                                    <label>Author Name:</label>
                                                   <input type="text" name="author" class="form-control" required value="<?php echo $row->author;?>">
                                                </div>
                                                <div class="form-group wd100">
                                                    <label>Post Title:</label>
                                                    <input type="text" name="title" class="form-control" required  value="<?php echo $row->title;?>"> 
                                                </div>
                                                <div class="form-group wd100">
                                                    <label>Description:</label>
                                                    <textarea name="description" class="form-control height_100" ><?php echo $row->description;?></textarea>
                                                </div>

                                                <div class="form-group wd100" style="position: relative;">
                                                    <label>Tags <small>(Comma Seperated)</small>:</label>
                                                    <input type="text" name="tags" id="tags_submit" class="form-control" value="">
                                                    <input type="hidden" id="tags_input" name="event_tags" value="<?php echo $row->tags; ?>" />

                                                    <span id="error-message"></span>
                                                </div>

                                                <?php 
                                                    $tags_to_show = array();
                                                    if($row->tags != ""){
                                                        $tags_to_show = explode(",",$row->tags); 
                                                    }
                                                ?>
                                                    <div  id="tags" class="wd100" style="display:<?php echo count($tags_to_show)>0?"block;":"none";?>;">
                                                    <?php 
                                                    if(count($tags_to_show)>0 && $row->tags != ""){
                                                    foreach($tags_to_show as $k=>$tag){?>
                                                        <span class="tag"><?php echo $tag;?></span>
                                                    <?php }} ?>
                                                </div>

                                                <div class="form-group wd100" id="">
                                                    <label>Upload your Image:</label>
                                                    <br>
                                                    <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>

                                                    <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-sho"true" data-errors-position="outside" data-show-remove="false" name="logo" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="<?php echo $image_hs;?>" data-min-width="799" data-min-height="349" 
                                                     <?php if(empty($image_hs)) {echo "required";} ?> />
                                                    <p style="color:red;"><small>Minimum Image Size: 800px x 350px</small></p>

                                                </div>

                                                <div class="form-group mt-30 flex_space_between_wrap wd100">
                                                    <button name="draft" class="ff-btn ff-btn-submit ff-btn-md item-btn submitBtn" style="border:none; background: #ffa8a8;">Draft Your Blog</button>
                                                    <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn submitBtn" style="border:none"><?php echo $button_text;?> </button>
                                                </div>

                                                <div class="form-group mt-30 flex_space_between_wrap wd100">
                                                    <label>
                                                        <input type="checkbox" name="comment_notif" <?php echo $row->notif==1?"CHECKED":""; ?>>
                                                        Send me a comment notification
                                                    </label>
                                                    <span>You will get an email notification once you blog is posted</span>
                                                </div>

                                            </form>
                                 </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>

<?php include("common/footer.php"); ?>
<script src="https://cdn.tiny.cloud/1/9d5p272q2jiloo9ewi2q8jhq0yvo3pg3738q0h11zwfpdnr7/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script> 
    tinymce.init({
      selector: 'textarea',
      height: 400,
      menubar: true,
      plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount', 'emoticons',
        'textcolor', 'colorpicker', 'textpattern', 'nonbreaking', 'pagebreak',
        'save', 'directionality', 'paste', 'importcss', 'template'
      ],
      toolbar: 'undo redo | blocks | ' +
        'bold italic underline strikethrough | alignleft aligncenter ' +
        'alignright alignjustify | outdent indent |  numlist bullist | ' +
        'forecolor backcolor removeformat | pagebreak | charmap emoticons | ' +
        'fullscreen preview save print | insertfile image media template link anchor codesample | ' +
        'ltr rtl | help',
      toolbar_mode: 'sliding',
      contextmenu: 'link image imagetools table spellchecker configurepermanentpen',
      menubar: 'file edit view insert format tools table help',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px; line-height:1.6; }',
      branding: false,
      resize: true,
      statusbar: true,
      elementpath: true,
      convert_urls: false,
      relative_urls: false,
      remove_script_host: false,
      document_base_url: '<?php echo base_url(); ?>',
      paste_data_images: true,
      file_picker_types: 'image',
      file_picker_callback: function (cb, value, meta) {
        var input = document.createElement('input');
        input.setAttribute('type', 'file');
        input.setAttribute('accept', 'image/*');
        
        input.onchange = function () {
          var file = this.files[0];
          
          var reader = new FileReader();
          reader.onload = function () {
            var id = 'blobid' + (new Date()).getTime();
            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
            var base64 = reader.result.split(',')[1];
            var blobInfo = blobCache.create(id, file, base64);
            blobCache.add(blobInfo);
            
            cb(blobInfo.blobUri(), { title: file.name });
          };
          reader.readAsDataURL(file);
        };
        
        input.click();
      }
    });
</script>
<style type="text/css">
    .url_custom_ad {
        display: none;
    }
    #tags{
      float:left;
      margin-bottom: 10px;
    }
    #tags > span{
          cursor: pointer;
    display: block;
    float: left;
    color: #fff;
    background: var(--color-primary);
    padding: 6px 15px;
    padding-right: 25px;
    margin: 4px;
    border-radius: 100px;
    position: relative;
    }
    #tags > span:hover{
      opacity:0.7;
    }
    #tags > span:after{
        position: absolute;
        content: "×";
        padding: 2px 5px;
        margin-left: 3px;
        font-size: 17px;
        top: 4px;
        right: 4px;
    }
    #tags > input{
      background:#eee;
      border:0;
      margin:4px;
      padding:7px;
      width:auto;
    }
</style>

<script>
    jQuery(document).ready(function(){
        jQuery(".url_custom_ad").remove();
    })

    function disableButton() {
        
        jQuery(".submitBtn").attr("disabled", true);
        jQuery(".submitBtn").css("background", "#FFA8A8");
       

        
        return true;
}
</script>

<script>
    var $ = jQuery;
    let tagCount = 0;

    $("#tags_submit").on({
        focusout() {
            var txt = this.value.replace(/[^a-z0-9+\-.#]/ig, '');
            if (txt) {
                var tags = txt.split(/[,\s]+/);
                tags.forEach(tag => {
                    if (tagCount < 3) {
                        $("<span/>", { text: tag.toLowerCase(), class: "tag" }).appendTo("#tags");
                        var currentTags = $("#tags_input").val();
                        if (currentTags) {
                            currentTags += ",";
                        }
                        $("#tags_input").val(currentTags + tag.toLowerCase());
                        tagCount++;
                    } else {
                        $("#error-message").text("You can only add 3 tags.");
                    }
                });
            }
            this.value = "";
        },keydown(ev) {
        if (ev.key === "Enter") {
            ev.preventDefault(); // Prevent form submission
            $(this).focusout();
        }
    },
        keyup(ev) {
            if (/(,|Enter)/.test(ev.key)) $(this).focusout();
            $("#tags").show();
        }
    });

    $("#tags").on("click", "span", function() {
        var currentTags = $("#tags_input").val().split(",");
        var tagToRemove = $(this).text().toLowerCase();
        var updatedTags = currentTags.filter(tag => tag !== tagToRemove);
        $("#tags_input").val(updatedTags.join(","));
        $(this).remove();
        tagCount--;
        $("#error-message").text("");
    });

    </script>