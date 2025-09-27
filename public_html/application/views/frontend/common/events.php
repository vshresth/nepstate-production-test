<div class="form-group">
    <label>Event Title:</label>
    <input type="text" name="title" class="form-control" required value="<?php echo $title_ad;?>">
</div>

<div class="form-group">
    <label>Organizer Name:</label>
    <input type="text" name="oranize_name" class="form-control" required value="<?php echo $json->oranize_name; ?>">
</div>
<div class="form-group">
    <label>Contact Number:</label>
    <input type="text" name="contact_number" class="form-control" required value="<?php echo $json->contact_number; ?>">
    <span id="error_message" style="color: red;"></span>
</div>
<div class="form-group">
    <label>Email:</label>
    <input type="email" name="email" class="form-control contact_email" required value="<?php echo $json->email; ?>">
    <span id="error_message_email" style="color: red;"></span>
</div>
<!-- 
<div class="hr_">
</div> -->

<div class="form-group">
    <label>Event Artist name:</label>
    <input type="text" name="event_artist_name" class="form-control" required value="<?php echo $json->event_artist_name; ?>">
</div>

<div class="form-group">
    <label>Event Style:</label>
    <select name="event_style" required class="form-control" onchange="do_show_event_style(this.value)" >
        <?php $array_event = array("Venue", "Live Streaming", "To be announced"); ?>
        <option value="">--Choose Event Style--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->event_style==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group inline_liveurl_option wd100" style="display: <?php echo $json->event_style=="Live Streaming"?"block":"none";?>;">
    <label>Event Live URL:</label>
    <input type="url" placeholder="Enter full url eg: https://www.google.com" name="event_live_url" class="form-control" value="<?php echo $json->event_live_url; ?>">
</div>

<div class="form-group inline_venue_option" style="display: <?php echo $json->event_style=="Venue"?"block":"none";?>;">
    <label>Venue Name:</label>
    <input type="text" name="venue_name" class="form-control" value="<?php echo $json->venue_name; ?>">
</div>

<div class="form-group inline_venue_option" style="display: <?php echo $json->event_style=="Venue"?"block":"none";?>;">
    <label>Venue Address:</label>
    <input type="text" name="address" id="autocomplete" class="form-control" value="<?php echo $json->address; ?>">
</div>

<input type="text" class="form-control d-none" placeholder="latitude" name="latitude" id="latitude" value="<?php echo $json->latitude; ?>">
<input type="text" class="form-control d-none" name="longitude" id="longitude" placeholder="longitude" value="<?php echo $json->longitude; ?>">

<div class="form-group inline_venue_option" style="display: <?php echo $json->event_style=="Venue"?"block":"none";?>;">
    <label>City:</label>
    <input type="text" name="city" id="city" class="form-control" value="<?php echo $json->city; ?>">
</div>

<div class="form-group inline_venue_option" style="display: <?php echo $json->event_style=="Venue"?"block":"none";?>;">
    <label>State:</label>
    <input type="text" name="state" id="state" class="form-control" value="<?php echo $json->state; ?>">
</div>

<div class="form-group inline_venue_option" style="display: <?php echo $json->event_style=="Venue"?"block":"none";?>;">
    <label>Zip/Postal:</label>
    <input type="text" name="zip_code" id="zip" class="form-control" value="<?php echo $json->zip_code; ?>">
</div>

<div class="form-group inline_venue_option" style="display: <?php echo $json->event_style=="Venue"?"block":"none";?>;">
    <label>Country:</label>
    <input type="text" name="country" id="country" class="form-control" value="<?php echo $json->country; ?>">
</div>



<div class="form-group wd100">
    <label>Event Type</label>
    <div>
        <div class="radio-button">
          <input type="radio" id="evet_1" value="1" class="new_class_radio" name="event_type" <?php echo $json->event_type==1?"CHECKED":""; ?>>
          <label for="evet_1">Single Event</label>
        </div>
        <div class="radio-button">
          <input type="radio" id="evet_2" value="2" class="new_class_radio"  name="event_type" <?php echo $json->event_type==2?"CHECKED":""; ?>>
          <label for="evet_2">Recurring Event</label>
        </div>
    </div>
</div>


<div class="event_type_single wd100 flex_space_between_wrap" style="display:<?php echo $json->event_type==1?"block":"none"; ?>">
    <div class="form-group">
        <label>Start Date:</label>
        <input type="date" name="event_start_date"  id="event_start_date" <?php if($edit!=1){?>min="<?php echo date("Y-m-d");?>"<?php } ?> class="form-control" value="<?php echo $json->event_start_date; ?>">
    </div>
    <div class="form-group">
        <label>Start Time:</label>
        <input type="time" name="event_start_time" class="form-control" value="<?php echo $json->event_start_time; ?>">
    </div>
    <div class="form-group">
        <label>End Date:</label>
        <input type="date" name="event_end_date" id="event_end_date" <?php if($edit!=1){?>min="<?php echo date("Y-m-d");?>"<?php } ?> class="form-control" value="<?php echo $json->event_end_date; ?>">
    </div>
    <div class="form-group">
        <label>End Time:</label>
        <input type="time" name="event_end_time" class="form-control" value="<?php echo $json->event_end_time; ?>">
    </div>
</div>

<div class="event_type_recurring wd100 flex_space_between_wrap" style="display:<?php echo $json->event_type==2?"block":"none"; ?>">
    <div class="form-group">
        <label>Event Date:</label>
        <input type="date" name="event_date" class="form-control" value="<?php echo $json->event_date; ?>">
    </div>
    <div class="form-group">
        <label>Event Time:</label>
        <input type="time" name="event_time" class="form-control" value="<?php echo $json->event_time; ?>">
    </div>
</div>

<div class="form-group wd100">
    <label>Event Tags <small>(Comma Seperated)</small>:</label>
    <input type="text" name="tags" id="tags_submit" class="form-control" value="">
    <input type="hidden" id="tags_input" name="event_tags" value="<?php echo $json->event_tags; ?>" />
</div>
 <?php 
        $tags_to_show = array();
        if($json->event_tags != ""){
            $tags_to_show = explode(",",$json->event_tags); 
        }
    ?>
        <div  id="tags" class="wd100" style="display:<?php echo count($tags_to_show)>0?"block;":"none";?>;">
    <?php 
    if(count($tags_to_show)>0 && $json->event_tags != ""){
    foreach($tags_to_show as $k=>$tag){?>
        <span class="tag"><?php echo $tag;?></span>
    <?php }} ?>
</div>

<div class="form-group">
    <label>Video Link:</label>
    <small>Add a video link from youtube to show your event vibe.</small>
    <input type="url"   placeholder="Enter full url eg: https://www.google.com" name="video_link" class="form-control" value="<?php echo $json->video_link; ?>">
</div>
<div class="form-group">
    <label>Ticket Link:</label>
    <input type="url" placeholder="Enter full url eg: https://www.google.com" name="ticket_link" class="form-control" value="<?php echo $json->ticket_link; ?>">
</div>

 <!-- onchange="show_value_cost_event(this.value)" -->
<div class="form-group">
    <label>Event cost:</label>
    <select name="event_cost" required class="form-control">
        <?php $array_event = array("Free", "Paid"); ?>
        <option value="">--Event cost--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->event_cost==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>
    
    <?php /* ?>
<div class="form-group show_paid_cost" style="display:<?php echo $json->event_cost=='Paid'?"block":"none"; ?>">
    <label style="color:#fff">...</label>
    <select name="event_cost_vip" class="form-control" onchange="show_paid_custom(this.value)">
        <?php $array_event = array("General", "Vip", "Custom"); ?>
        <option value="">--Select--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->event_cost_vip==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>
<?php */ ?>

<div class="form-group show_paid_custom wd100" style="display:<?php echo $json->event_cost_vip=='Custom'?"block":"none"; ?>">
    <label>Paid Custom Event</label>
    <input type="text" name="custom_paid" class="form-control" value="<?php echo $json->custom_paid; ?>">
</div>

<div class="form-group wd100">
    <label>Refundable Policy</label>
    <div>
        <div class="radio-button">
          <input type="radio" id="evet_1_policy" value="1" required name="refundable_policy" <?php echo $json->refundable_policy==1?"CHECKED":""; ?>>
          <label for="evet_1_policy">Yes</label>
        </div>
        <div class="radio-button">
          <input type="radio" id="evet_2_policy" value="2" required  name="refundable_policy" <?php echo $json->refundable_policy==2?"CHECKED":""; ?>>
          <label for="evet_2_policy">No</label>
        </div>
    </div>

    <small>Any refunds if accepted need to be contacted directly to the events organizer’s phone or email. Nepstate is not responsible for the refunds of any Events posted on our website.</small>
</div>

<div class="form-group wd100">
    <label>Description:</label>
    <textarea name="description" class="form-control height_100" ><?php echo $json->description;?></textarea>
</div>

<div class="form-group wd100">
    <label>Images:</label>
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
