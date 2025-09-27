<div class="form-group wd100">
    <label>Job Title:</label>
    <input type="text" name="title" class="form-control" required value="<?php echo $title_ad; ?>">
</div>
<div class="form-group">
    <label>Company Name:</label>
    <input type="text" name="company_name" class="form-control" required value="<?php echo $json->company_name;?>">
</div>

<div class="form-group inline_venue_option">
    <label>Company Address:</label>
    <input type="text" name="address" id="autocomplete" class="form-control" required value="<?php echo $json->address; ?>">
</div>

<input type="text" class="form-control d-none" placeholder="latitude" name="latitude" id="latitude" value="<?php echo $json->latitude; ?>">
<input type="text" class="form-control d-none" name="longitude" id="longitude" placeholder="longitude" value="<?php echo $json->longitude; ?>">
<input type="text" name="city" id="city" class="form-control d-none" value="<?php echo $json->city; ?>">
<input type="text" name="state" id="state" class="form-control d-none" value="<?php echo $json->state; ?>">
<input type="text" name="zip_code" id="zip" class="form-control d-none" value="<?php echo $json->zip_code; ?>">
<input type="text" name="country" id="country" class="form-control d-none" value="<?php echo $json->country; ?>">


<div class="form-group wd100">
    <label>Description:</label>
    <textarea name="description" class="form-control height_100"><?php echo $json->description;?></textarea>
</div>
<div class="form-group">
    <label>Industry Type:</label>
    <input type="text" name="Industry_type" class="form-control" required value="<?php echo $json->Industry_type; ?>">
</div>
<div class="form-group">
    <label>Category type:</label>
    <input type="text" name="category_type" class="form-control" required value="<?php echo $json->category_type; ?>">
</div>


<div class="form-group">
    <label>Expereince:</label>
    <div class="flex_space_between_wrap_start custom_year_month">
        <input type="number" min="0" step="1" name="expereince" class="form-control" placeholder="Year" value="<?php echo $json->expereince; ?>">
        <input type="number" min="0" step="1" name="expereince_month" class="form-control" placeholder="Month" value="<?php echo $json->expereince_month; ?>">
    </div>
        <?php /* ?>
        <select name="expereince" required class="form-control">
            <option value="">--Choose Experience--</option>
            <?php for($i=0;$i<=20;$i++) { ?>
                <option value="<?php echo $i?>" <?php echo isset($json)?$json->expereince==$i?"SELECTED":"":""; ?>><?php echo $i==0?"No experience":$i." Years";?></option>
            <?php } ?>
        </select>
        <?php */ ?>
    
</div>

<div class="form-group">
    <label>Qualification:</label>
    <select name="qualification" required class="form-control">
        <?php $array_event = array("Highschool", "Diploma", "Graduate", "Post Graduate", "Professional"); ?>
        <option value="">--Qualification--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->qualification==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Languages:</label>
    <select name="languages" required class="form-control" onchange="do_show_other_lang(this.value)">
        <?php $array_event = array("Nepali", "Hindi", "English", "Others"); ?>
        <option value="">--Languages--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->languages==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group other_language" style="display:none">
    <label>Other Language:</label>
    <input type="text" name="other_language" class="form-control"  value="<?php echo $json->other_language; ?>">
</div>

<div class="form-group">
    <label>Employment Type:</label>
    <select name="employment_type" required class="form-control">
        <?php $array_event = array("C2C", "W2- permanent", "W2 contract", "1099", "C-to-H", "H1B", "Parttime", "Internship", "Temporary", "Summer", "Online/Remote", "Cash", "WorkFromHome", "Full time", "Voluenteer", "Commission", "Evening", "Weekend", "NightShift", "GraveYardShift"); ?>
        <option value="">--Employment Type--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->employment_type==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Work Authorization:</label>
    <select name="work_authorization" required class="form-control">
        <?php $array_event = array("Visa", "US-Citizen", "GreenCard", "EAD", "H1B", "H4", "F1", "F2", "L2", "h2B", "STEM", "J1", "OPT", "CPT", "Other"); ?>
        <option value="">--Work Authorization--</option>
        <?php foreach ($array_event as $key => $parent) { ?>
            <option value="<?php echo $parent?>" <?php echo $json->work_authorization==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Number of Opening:</label>
    <input type="number" name="number_of_opening" class="form-control" required value="<?php echo $json->number_of_opening; ?>">
</div>

<div class="event_type_single wd100 flex_space_between_wrap three_row_flex" >
    <div class="form-group">
        <label>Min salary:</label>
        <input type="number" min="0" step="1" name="minimum_salary" class="form-control" required value="<?php echo $json->minimum_salary; ?>">
    </div>
    <div class="form-group">
        <label>Max Salary:</label>
        <input type="number" min="0" step="1" name="maximum_salary" class="form-control" required value="<?php echo $json->maximum_salary; ?>">
    </div>
    <div class="form-group">
        <label>Salary Type:</label>
        <select name="salary_type" required class="form-control">
            <?php $array_event = array("Per Hour", "Per Day", "Per Week", "Per Month", "Yearly"); ?>
            <option value="">--Salary Type--</option>
            <?php foreach ($array_event as $key => $parent) { ?>
                <option value="<?php echo $parent?>" <?php echo $json->salary_type==$parent?"SELECTED":""; ?>><?php echo $parent;?></option>
            <?php } ?>
        </select>
    </div>
</div>

<div class="form-group wd100">
    <label>Gender Preference:</label>
    <div>
        <?php 
            $gender_arr = array("Any", "Male", "Female");
            foreach($gender_arr as $bkey => $brow){
                $bkeyyy = $bkey+1;
        ?>
            <div class="radio-button">
              <input type="radio" id="gen_<?php echo $bkeyyy;?>" value="<?php echo $brow;?>" name="gender_preference" <?php echo $json->gender_preference==$brow?"CHECKED":""; ?>>
              <label for="gen_<?php echo $bkeyyy;?>"><?php echo $brow;?></label>
            </div>
        <?php } ?>
    </div>
</div>

<div class="form-group wd100">
    <label>Benefits:</label>
    <div>
        <?php 
            $benefits_arr = benefits_jobs();
            foreach($benefits_arr as $bkey => $brow){
                $bkeyyy = $bkey+1;
                if(!empty($json->benefits)){
                    $checked = in_array($brow, $json->benefits);
                }
        ?>
            <div class="radio-button">
              <input type="checkbox" id="evet_<?php echo $bkeyyy;?>" value="<?php echo $brow;?>" name="benefits[]" <?php echo $checked ? "CHECKED": ""; ?>>
              <label for="evet_<?php echo $bkeyyy;?>"><?php echo $brow;?></label>
            </div>
        <?php } ?>
    </div>
</div>


<div class="form-group">
    <label>Website link:</label>
    <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="website_link" class="form-control" value="<?php echo $json->website_link; ?>">
</div>
<div class="form-group">
    <label>LinkedId profile:</label>
    <input type="url"  placeholder="Enter full url eg: https://www.google.com" name="linkedIn_profile" class="form-control" value="<?php echo $json->linkedIn_profile; ?>">
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

