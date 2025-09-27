

<?php include("common/header.php"); ?>
<?php 
    $url_submit = "";
    $button_text = $this->uri->segment(1)=="post-forum"?"Post Forum":"Post Confession";
    $image_hs = "";
    if($edit == 1){
        $url_submit = "?edit=".$id;
        $button_text = $this->uri->segment(2)=="forum"?"Update Your Forum":"Update Your Confession";
        // $button_text = "Update";
        $row = $this->db->query("SELECT * FROM confessions WHERE id = $id ".$blog_forum_confession_condition_query)->result_object()[0];
        $image_hs = $row->image;
    }


    if( $this->uri->segment(1)=="post-forum"){
        $title = "FORUM";
        $s_title = 'forum';
        $title_name= "Name";
        $plac_name = "This name is only used for the Forum post.";
    } else if( $this->uri->segment(2)=="forum"){
        $title = "FORUM";
        $s_title = 'forum';
    } else {
        $title = "CONFESSION";
        $s_title = 'confession';
        $title_name= "Name of the Confessor";
        $plac_name = "This name is only used for the confession post.";
    }
?>
<section class="breadcrumbs-banner">
   <div class="container">
      <div class="breadcrumbs-area">
        <h1 class="heading-title">POST NEW <?php echo $title; ?></h1>
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
                                        <form action="<?php echo base_url();?>submit/<?php echo $s_title;?><?php echo $url_submit;?>" method="post" id="form_to_submit" enctype="multipart/form-data">
                                            <div class="form-custom-post flex_space_between_wrap_start">
                                                <div class="form-group">
                                                    <label><?php echo $title_name; ?> <small>(Leave Empty to post as anonymous)</small></label>
                                                   <input placeholder="<?php echo $plac_name; ?>" type="text" name="author" <?php if($this->uri->segment(1) == "post-forum"){ ?><?php }?> class="form-control" value="<?php echo $row->author;?>">
                                                </div>
                                                <?php if($s_title == "forum"){ ?>
                                                    <div class="form-group">
                                                        <label>Category</label>
                                                       <select name="forumcat" class="form-control" required>
                                                        <option value="">--Select Category--</option>
                                                        <?php 
                                                          $cat_forums = $this->db->query("SELECT * FROM forum_categories WHERE status = 1 ORDER BY id ASC")->result_object();
                                                          foreach($cat_forums as $kf => $rf){
                                                        ?>
                                                            <option value="<?php echo $rf->id;?>"><?php echo $rf->title;?></option>
                                                        <?php } ?>
                                                       </select>
                                                    </div>
                                                <?php } ?>
                                                <div class="form-group wd100">
                                                    <label>Title:</label>
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
                                                <?php if($this->uri->segment(1) == "post-forum" || $this->uri->segment(2) == "forum"){?>
                                                    <div class="form-group wd100" id="">
                                                        <label>Upload your Image:</label><br>
                                                        <label><small style="color: grey">Don't have same size, use this : <a href="https://imageresizer.com/" target="_blank">Click here</a></small></label>

                                                        <input type="file" id="input-file-disable-remove logo" class="dropify" data-show-errors="true" data-show-loader="true" data-errors-position="outside" data-show-remove="false" name="logo" data-allowed-file-extensions="png jpg jpeg gif" data-default-file="<?php echo $image_hs;?>" data-min-width="799" data-min-height="349"  />
                                                        <p style="color:red;"><small>Minimum Image Size: 800px x 350px</small></p>

                                                    </div>
                                                <?php } ?>

                                                 <div class="form-group mt-30  wd100">
                                                    <label>
                                                        <input type="checkbox" name="nsfw" <?php echo $row->nsfw==1?"CHECKED":""; ?>>
                                                        NSFW
                                                    </label><br />
                                                    <small>Select this tag for Mature Content 18+</small>
                                                </div>

                                                <div class="form-group mt-30 flex_space_between_wrap wd100">
                                                    <button name="draft" class="ff-btn ff-btn-submit ff-btn-md item-btn" style="border:none; background: #ffa8a8;">Save Draft</button>
                                                    <button type="submit" class="ff-btn ff-btn-submit ff-btn-md item-btn" style="border:none"><?php echo $button_text;?> </button>
                                                </div>
                                                <div class="form-group mt-30 flex_space_between_wrap wd100">
                                                    <label>
                                                        <input type="checkbox" name="comment_notif" <?php echo $row->notif==1?"CHECKED":""; ?>>
                                                        Send me a comment notification
                                                    </label>
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
      height: 350,
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
      ],
      toolbar: 'undo redo | formatselect | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
      content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:12px }'
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
</script>

<script>
    var $ = jQuery;
    let tagCount = 0;

    // $("#tags_submit").on({
    //     focusout() {
    //         var txt = this.value.replace(/[^a-z0-9+\-.#]/ig, '');
    //         if (txt) {
    //             var tags = txt.split(/[,\s]+/);
    //             tags.forEach(tag => {
    //                 if (tagCount < 3) {
    //                     $("<span/>", { text: tag.toLowerCase(), class: "tag" }).appendTo("#tags");
    //                     var currentTags = $("#tags_input").val();
    //                     if (currentTags) {
    //                         currentTags += ",";
    //                     }
    //                     $("#tags_input").val(currentTags + tag.toLowerCase());
    //                     tagCount++;
    //                 } else {
    //                     $("#error-message").text("You can only add 3 tags.");
    //                 }
    //             });
    //         }
    //         this.value = "";
    //     },
    //     keyup(ev) {
    //         if (/(,|Enter)/.test(ev.key)) $(this).focusout();
    //         $("#tags").show();
    //     }
    // });

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
    },
    keydown(ev) {
        if (ev.key === "Enter") {
            ev.preventDefault(); // Prevent form submission
            $(this).focusout();
        }
    },
    keyup(ev) {
        if (/(,|Enter)/.test(ev.key)) {
            $(this).focusout();
        }
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