<div class="form-group wd100">
    <label>Title:</label>
    <input type="text" name="title" class="form-control" required value="<?php echo $title_ad; ?>">
</div>

<h3>Business Info:</h3>

<div class="form-group">
    <label>Business Name:</label>
    <input type="text" name="business_name" class="form-control" required value="<?php echo $json->business_name; ?>">
</div>

<div class="form-group">
    <label>Business Location:</label>
    <input type="text" name="address" id="autocomplete" class="form-control" required value="<?php echo $json->address; ?>">
</div>

<input type="text" class="form-control d-none" placeholder="latitude" name="latitude" id="latitude" value="<?php echo $json->latitude; ?>">
<input type="text" class="form-control d-none" name="longitude" id="longitude" placeholder="longitude" value="<?php echo $json->longitude; ?>"
>
<input type="text" name="city" id="city" class="form-control d-none" value="<?php echo $json->city; ?>">
<input type="text" name="state" id="state" class="form-control d-none" value="<?php echo $json->state; ?>">
<input type="text" name="zip_code" id="zip" class="form-control d-none" value="<?php echo $json->zip_code; ?>">
<input type="text" name="country" id="country" class="form-control d-none" value="<?php echo $json->country; ?>">

<div class="form-group">
    <label>Business Contact Name:</label>
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

<div class="form-group">
    <label>Business Website:</label>
    <input type="url"   placeholder="Enter full url eg: https://www.google.com" name="business_website" class="form-control"  value="<?php echo $json->business_website; ?>">
</div>


<h3>Service Type:</h3>

<div class="form-group">
    <label>Services Name:</label>
    <input type="text" name="service_name" class="form-control" placeholder="eg: photography, wedding planner" required value="<?php echo $json->service_name; ?>">
</div>
<div class="form-group">
    <label>Service Tags: <small>(Comma Seperated)</small></label>
    <input type="text" name="tags" id="tags_submit" class="form-control" value="">
    <input type="hidden" id="tags_input" name="service_tags" value="<?php echo $json->service_tags; ?>" />
    <?php 
        $tags_to_show = array();
        if($json->service_tags != ""){
            $tags_to_show = explode(",",$json->service_tags); 
        }
    ?>
        <div  id="tags" class="wd100" style="display:<?php echo count($tags_to_show)>0?"block;":"none";?>;">
            <?php 
            if(count($tags_to_show)>0 && $json->service_tags != ""){
            foreach($tags_to_show as $k=>$tag){?>
                <span class="tag"><?php echo $tag;?></span>
            <?php }} ?>
        </div>
</div>


<div class="form-group">
    <label>Service Category:</label>
    <input type="text" name="service_category" class="form-control" required value="<?php echo $json->service_category; ?>">
</div>

<h3>Business Experience</h3>

<div class="form-group">
    <label>Years in Business:</label>
    <input type="number" name="year_in_business" class="form-control" required value="<?php echo $json->year_in_business; ?>">
</div>





<div class="form-group wd100">
    <label>Work Hours:</label>
    <div>
        <?php 
            $gender_arr = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday", "open 24/7", "By Appointment");
            foreach($gender_arr as $bkey => $brow){
                $bkeyyy = $bkey+1;
                if(!empty($json->work_hours)){
                    $checked = in_array($brow, $json->work_hours);
                }
        ?>
            <div class="radio-button">
              <input type="checkbox" id="gen_<?php echo $bkeyyy;?>" value="<?php echo $brow;?>" name="work_hours[]" <?php echo $checked ? "CHECKED": ""; ?>>
              <label for="gen_<?php echo $bkeyyy;?>"><?php echo $brow;?></label>
            </div>
        <?php } ?>
    </div>
</div>
<div class="form-group wd100">
    <label>Business Description:</label>
    <textarea name="description" class="form-control height_100"><?php echo $json->description;?></textarea>
</div>

<div class="form-group wd100">
    <label>Business picture:</label>
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
