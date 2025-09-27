<div class="form-group wd100">
    <label>Training Type:</label>
    <div>
        <?php 
            $gender_arr = array("Online", "In Person");
            foreach($gender_arr as $bkey => $brow){
                $bkeyyy = $bkey+1;
        ?>
            <div class="radio-button">
              <input type="radio" id="gen_<?php echo $bkeyyy;?>" value="<?php echo $brow;?>" name="training_type" <?php echo $json->training_type==$brow?"CHECKED":""; ?>>
              <label for="gen_<?php echo $bkeyyy;?>"><?php echo $brow;?></label>
            </div>
        <?php } ?>
    </div>
</div>

<div class="form-group">
    <label>Title:</label>
    <input type="text" name="title" class="form-control" required value="<?php echo $title_ad; ?>">
</div>

<div class="form-group">
    <label>Location:</label>
    <input type="text" name="address" id="autocomplete" class="form-control" required value="<?php echo $json->address; ?>">
</div>

<input type="text" class="form-control d-none" placeholder="latitude" name="latitude" id="latitude" value="<?php echo $json->latitude; ?>">
<input type="text" class="form-control d-none" name="longitude" id="longitude" placeholder="longitude" value="<?php echo $json->longitude; ?>">
<input type="text" name="city" id="city" class="form-control d-none" value="<?php echo $json->city; ?>">
<input type="text" name="state" id="state" class="form-control d-none" value="<?php echo $json->state; ?>">
<input type="text" name="zip_code" id="zip" class="form-control d-none" value="<?php echo $json->zip_code; ?>">
<input type="text" name="country" id="country" class="form-control d-none" value="<?php echo $json->country; ?>">


<div class="form-group wd100">
    <label>Description of the training:</label>
    <textarea name="description" class="form-control height_100"><?php echo $json->description;?></textarea>
</div>
<div class="form-group">
    <label>Training Courses <small>(Comma Seperated)</small></label>
    <input type="text" name="tags" id="tags_submit" class="form-control">
    <input type="hidden" id="tags_input" name="training_courses" value="<?php echo $json->training_courses; ?>" />
     <?php 
        $tags_to_show = array();
        if($json->service_tags != ""){
            $tags_to_show = explode(",",$json->training_courses); 
        }
    ?>
        <div  id="tags" class="wd100" style="display:<?php echo count($tags_to_show)>0?"block;":"none";?>;">
            <?php 
            if(count($tags_to_show)>0 && $json->training_courses != ""){
            foreach($tags_to_show as $k=>$tag){?>
                <span class="tag"><?php echo $tag;?></span>
            <?php }} ?>
        </div>
</div>
<div class="form-group">
    <label>Placement:</label>
    <select name="placement" required class="form-control">
        <?php $array_event = array("Yes", "No"); ?>
        <option value="">--Placement--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->placement==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>


<div class="form-group wd100">
    <label>Payment:</label>
    <input type="number" min="0" step="1" name="amount" class="form-control" required value="<?php echo $json->amount; ?>">
</div>

<div class="event_type_single wd100 flex_space_between_wrap three_row_flex" >
    <h3>Contact Details:</h3>
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="contact_name" class="form-control" required value="<?php echo $json->contact_name; ?>">
    </div>

    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="contact_email" class="form-control contact_email" required value="<?php echo $json->contact_email; ?>">
        <span id="error_message_email" style="color: red;"></span>
    </div>

    <div class="form-group">
        <label>Phone number:</label>
        <input type="text" name="contact_number" class="form-control" required value="<?php echo $json->contact_number; ?>">
    </div>
</div>


<div class="form-group wd100">
    <label>Photos:</label>
    <input type="file" name="file[]" multiple accept="image/jpeg, image/png" class="form-control" id="new_file">
</div>

<div id="files_list" style="<?php echo isset($_SESSION["storyimages"])?'display:block':'';?>">
        <div class="form-group left wd100">
            <?php foreach ($_SESSION["storyimages"] as $key => $value) { ?>
                <div class="image_uploaded" id="remove_<?php echo $key;?>">
                    <div class="crossbutton" onclick="remove_file_uploaded('<?php echo $key;?>')">
                        <i class="fa fa-trash" title="Remove Image"></i>
                    </div>
                    
                    <img src="<?php echo $value;?>">
                    <div class="upload_image_name" title="<?php echo $value;?>">
                        <?php echo $value;?>
                    </div>
                </div>
            <?php } ?>
        </div>
</div>

