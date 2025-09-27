<div class="form-group single_shared_room wd100" style="display:none;">
    <label>List my room:</label>
    <select name="single_shared_room" class="form-control">
        <?php $array_event = array("I am the owner", "I am an existing tenant", "I am an agent"); ?>
        <option value="">--Type--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->event_cost==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group paying_guest wd100"  style="display:none;">
    <label>List my room:</label>
    <select name="paying_guest" class="form-control">
        <?php $array_event = array("Property owner", "Existing Tenant", "Agent"); ?>
        <option value="">--Type--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->event_cost==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group ">
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



<h3>Room Details</h3>

<div class="form-group wd100">
    <label>Lease typ:</label>
    <div>
        <?php 
            $gender_arr = array("Short Term", "Long Term", "Both");
            foreach($gender_arr as $bkey => $brow){
                $bkeyyy = $bkey+1;
        ?>
            <div class="radio-button">
              <input type="radio" id="gen_<?php echo $bkeyyy;?>" value="<?php echo $brow;?>" name="lease_type" <?php echo $json->lease_type==$brow ? "CHECKED": ""; ?>>
              <label for="gen_<?php echo $bkeyyy;?>"><?php echo $brow;?></label>
            </div>
        <?php } ?>
    </div>
</div>




<div class="form-group">
    <label>Availibility From:</label>
    <input type="date" min="<?php echo date("Y-m-d");?>" name="availability_from" id="availability_from" class="form-control" required value="<?php echo $json->availability_from; ?>">
</div>

<div class="form-group">
    <label>Availibility To:</label>
    <input type="date" min="<?php echo date("Y-m-d");?>" name="availability_to" id="availability_to" class="form-control" required value="<?php echo $json->availability_to; ?>">
</div>

<div class="form-group">
    <label>Accommodates (Number Of People):</label>
    <input type="number" name="number_of_people" class="form-control" required value="<?php echo $json->number_of_people; ?>">
</div>

<div class="form-group">
    <label>Attached Bath:</label>
    <select name="attached_bath" class="form-control">
        <?php $array_event = array("Yes", "No"); ?>
        <option value="">--Attached Bath--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->attached_bath==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>


<div class="form-group wd100">
    <label>Preferrred Gender:</label>
    <div>
        <?php 
            $gender_arr = array("Male", "Female", "Both");
            foreach($gender_arr as $bkey => $brow){
                $bkeyyy = $bkey+1;
        ?>
            <div class="radio-button">
              <input type="radio" id="pref_gender_<?php echo $bkeyyy;?>" value="<?php echo $brow;?>" name="preferred_gender" <?php echo $json->preferred_gender==$brow ? "CHECKED": ""; ?>>
              <label for="pref_gender_<?php echo $bkeyyy;?>"><?php echo $brow;?></label>
            </div>
        <?php } ?>
    </div>
</div>


<div class="form-group">
    <label>Expected Rent:</label>
    <input type="number" name="expected_rent" class="form-control"  value="<?php echo $json->expected_rent; ?>">
</div>

<div class="form-group">
    <label>Rent Negotiable:</label>
    <select name="rent_negotiable" class="form-control">
        <?php $array_event = array("Yes", "No"); ?>
        <option value="">--Rent Negotiable--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->rent_negotiable==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Price Mode:</label>
    <select name="price_mode" class="form-control">
        <?php $array_event = array("Per month", "Week", "Per Night", "Per Day"); ?>
        <option value="">--Price Mode--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->price_mode==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Utilities Included:</label>
    <select name="utilities_included" class="form-control">
        <?php $array_event = array("Yes", "No"); ?>
        <option value="">--Utilities Included--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->utilities_included==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Security Deposit:</label>
    <input type="text" name="security_deposit" class="form-control" placeholder="$100" required value="<?php echo $json->security_deposit; ?>">
</div>

<h3>Details about the Room:</h3>

<div class="form-group">
    <label>Furnished:</label>
    <select name="furnished" required class="form-control">
        <?php $array_event = array("Yes", "No"); ?>
        <option value="">--Furnished--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->furnished==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group wd100">
    <label>Amenities Included:</label>
    <div>
        <?php 
            $gender_arr = array("Gym/Fitness center", "Swimming Pool", "Car park", "Visitor parking", "Security system", "Laundry service", "Evevator");
            foreach($gender_arr as $bkey => $brow){
                $bkeyyy = $bkey+1;
                if(!empty($json->amenities_included)){
                    $checked = in_array($brow, $json->amenities_included);
                }
        ?>
            <div class="radio-button">
              <input type="checkbox" id="amen_inc_<?php echo $bkeyyy;?>" value="<?php echo $brow;?>" name="amenities_included:" <?php echo $checked ? "CHECKED": ""; ?>>
              <label for="amen_inc_<?php echo $bkeyyy;?>"><?php echo $brow;?></label>
            </div>
        <?php } ?>
    </div>
</div>

<div class="form-group">
    <label>Vegetarian preference:</label>
    <select name="vegitarian_preference" required class="form-control">
        <?php $array_event = array("Vegetarian only", "Both"); ?>
        <option value="">--Vegetarian preference--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->vegitarian_preference==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Smokng Policy:</label>
    <select name="smoking_policy" required class="form-control">
        <?php $array_event = array("No smoking", "Smoking", "smoking outside only"); ?>
        <option value="">--Smokng Policy--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->smoking_policy==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Pet Friendly:</label>
    <select name="pet_friendly" required class="form-control">
        <?php $array_event = array("No pets", "Only dogs", "only cats", "Any Pet"); ?>
        <option value="">--Pet Friendly--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->pet_friendly==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<h3>Open House schedule</h3>

<div class="form-group">
    <label>Start Time:</label>
    <input type="time" name="open_start_time" class="form-control" required value="<?php echo $json->open_house_start_time; ?>">
</div>

<div class="form-group">
    <label>Availibility To:</label>
    <input type="time"  name="open_house_end_time" class="form-control" required value="<?php echo $json->open_house_end_time; ?>">
</div>


<h3>Roomate preferences</h3>

<div class="form-group">
    <label>Age:</label>
    <select name="age" required class="form-control" onchange="do_change_group(this.value)">
        <?php $array_event = array("Age Range", "Doesn’t matter"); ?>
        <option value="">--Age--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->age==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Alcohol Allowed:</label>
    <select name="alcohol_allowed" required class="form-control">
        <?php $array_event = array("Yes", "No"); ?>
        <option value="">--Alcohol allowed --</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->alcohol_allowed==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group age_group" style="display: none;">
    <label>Start Age:</label>
    <input type="number" step="1" min="0" name="start_age" class="form-control" value="<?php echo $json->start_age; ?>">
</div>

<div class="form-group age_group" style="display: none;">
    <label>End Age:</label>
    <input type="number" step="1" min="0" name="end_age" class="form-control" value="<?php echo $json->end_age; ?>">
</div>

<div class="form-group">
    <label>Occupation:</label>
    <select name="occupation" required class="form-control">
        <?php $array_event = array("Students", "Professionals only", "No preference"); ?>
        <option value="">--Occupation--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->occupation==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Payment:</label>
    <select name="payment" required class="form-control">
        <?php $array_event = array("1 Monthly", "3 Monthly"); ?>
        <option value="">--Payment--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->payment==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>


<div class="form-group wd100">
    <label>Description:</label>
    <textarea name="description" class="form-control height_100"><?php echo $json->description;?></textarea>
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
    <label>Picture:</label>
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

