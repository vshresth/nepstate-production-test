
<!-- <a href="javascript:void(0)" id="countriesBox"> -->

<!-- </a> -->
<style>
   .ui-autocomplete {
    z-index: 1051 !important;
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


<a href="javascript:void(0);" style="text-decoration: none; color:black;" id="locationLink">
<div class="location-button" id="citySelectionBtn">
    
    <?php if (!empty(userCountryId())) : ?>
        <div id="cityShow">
            <i class="fas fa-map-marker-alt" style="margin-right:10px;"></i>
            <?php echo getCountryCodeById(userCountryId()); ?> <?php if(!empty(userCityId()))  {echo '('.userCityId().')';}?> &nbsp
            <i class="fas fa-chevron-down" style="margin-right: 10px;"></i>
        </div>
    <?php else : ?>
        <div id="citySelect">
            <i class="fas fa-map-marker-alt" style="margin-right:10px;"></i>
               Select Location &nbsp
            <i class="fas fa-chevron-down" style="margin-right: 10px;"></i>
        </div>
    <?php endif; ?>

</div>
</a>

 <!-- POPUP START -->
<div class="cityPopup" >   
<div class="popup-header">
    <h6 class="locationHeading">Choose Your Location</h6>
    <span class="popup-close" id="closeBtn">&times;</span> 
</div>                                       
    <form action="<?php echo base_url() ?>Nepstate/updateUserCity">

    <div class="locationBox">
            <select name="country" class="form-control custom-select" aria-label="Listing order" id="countrySelect">
                <?php
                        
                        $listOfCountries = $this->db->get('admin_countries')->result_object();
                        foreach($listOfCountries as $country) {

                            if(userCountryId()) {
                                
                                    if(userCountryId() == $country->id) {

                                        ?>
                                            <option selected value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>               

                                        <?php
                                    }else{
                                        ?>  

                                            <option value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>  
                                        <?php
                                    }
                                ?>

                                    
                                <?php
                            }else{
                                ?>
                                <option value="<?php echo $country->code; ?>"><?php echo $country->title; ?></option>
                                <?php
                            }
                    ?>      
                                            
                <?php } ?>
            </select>
        <div class="citySelection" style="position:relative;">
            <input type="text" class="form-control" id="cityZipInput" placeholder="Enter a Zip Code or City">

        </div>
        <div class="locationBTN">
        <input type="hidden" id="userCityText" name="userCityText" class="form-control">

            <button type="submit" id="updateLocationButton" class="" disabled style="background-color: #EBEBE4; border:1px solid #EBEBE4;">Update Location</button>       
        </div>
    </div>
    <?php if(!empty(userCityId())) { ?>
    <div style="padding: 10px;">
        <div>
            <label for="">Current City</label>
            <div style="display: flex; justify-content: space-between; gap: 10px;">
                <input type="text" class="form-control" value="<?php echo userCityId(); ?>" disabled>
              <a  href="<?php echo base_url().'update-user-country/'. userCountryId() . '?type=insidiweb'; ?>" class="btn btn-danger">Remove</a>
            </div>
        </div>
    </div>
   <?php } ?> 
        
    </form>


</div>
  
  <!-- Input field for city name or ZIP code -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXLSGnMNN051ESCBh-mKv__W_m-tbkFlg&libraries=places"></script>

  <!-- Script to initialize Google Maps autocomplete -->
  <script>

// Declare variables in global scope
let locationLink = document.getElementById('locationLink');
let cityPopup = document.querySelector('.cityPopup');
let popupDispaly = false;

// Only initialize if not already initialized
if (typeof locationLink === 'undefined') {
    locationLink = document.getElementById('locationLink');
    cityPopup = document.querySelector('.cityPopup');
    popupDispaly = false;
}

if (locationLink && cityPopup) {
    locationLink.addEventListener('click', () => {
        cityPopup.style.display = 'block';
        popupDispaly = true;
    });
}

// Function to close popup without loading
function closePopupWithoutLoading() {
    if (cityPopup) {
        cityPopup.style.display = 'none';
        popupDispaly = false;
    }
}

// Close button event listener
document.getElementById('closeBtn').addEventListener('click', () => {
    closePopupWithoutLoading();
});

// Outside click event listener - close without loading
document.body.addEventListener('click', function(event) {
    if (popupDispaly === true && cityPopup && !cityPopup.contains(event.target)) {
        // Don't close if clicking on location button or its children
        const isLocationButton = event.target.closest('#locationLink') || 
                                event.target.closest('#citySelectionBtn') ||
                                event.target.closest('#cityShow') ||
                                event.target.closest('#citySelect');
        
        if (!isLocationButton) {
            closePopupWithoutLoading();
        }
    }
});

// Prevent form submission if same country is selected
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="updateUserCity"]');
    const countrySelect = document.getElementById('countrySelect');
    const currentCountryCode = '<?php echo getCountryCodeById(userCountryId()); ?>';
    
    console.log('Form found:', !!form);
    console.log('Country select found:', !!countrySelect);
    console.log('Current country code:', currentCountryCode);
    
    if (form && countrySelect) {
        form.addEventListener('submit', function(event) {
            const selectedCountryCode = countrySelect.value;
            console.log('Selected country code:', selectedCountryCode);
            
            // If same country is selected, just close popup without submitting
            if (selectedCountryCode === currentCountryCode) {
                console.log('Same country selected - preventing submission');
                event.preventDefault();
                event.stopPropagation();
                closePopupWithoutLoading();
                return false;
            }
        });
    }
});







// Function to initialize Autocomplete
function initAutocomplete() {

    const countrySelect = document.getElementById('countrySelect');
    const cityZipInput = document.getElementById('cityZipInput');
    const updateButton = document.getElementById('updateLocationButton');

    
    let userCountry_ = '<?php echo getCountryCodeById(userCountryId()); ?>';
    sessionStorage.setItem('userCountry', userCountry_);
    
    const userCountry = sessionStorage.getItem('userCountry');

    const autocompleteOptions = {
        types: ['(regions)'],
        componentRestrictions: { country: userCountry } 
    };

    // Initialize Autocomplete for city name or ZIP code input
    const autocomplete = new google.maps.places.Autocomplete(cityZipInput, autocompleteOptions);
    autocomplete.setFields(['address_components', 'geometry']);

    // Update Autocomplete options when country selection changes
    countrySelect.addEventListener('change', function() {
        sessionStorage.removeItem('userCountry');
        localStorage.setItem('userCountry', countrySelect.value);
        autocompleteOptions.componentRestrictions = { country: countrySelect.value };
        autocomplete.setOptions(autocompleteOptions);

        cityZipInput.value = '';
        updateButton.style.background = '#EBEBE4';
        updateButton.disabled = true;
    });

        autocomplete.addListener('place_changed', function() {
                const place = autocomplete.getPlace();
                // console.log('Selected Place:', place.formatted_address);
                // console.log('Place Details:', place);
                // Get the long name of the selected city
                
                let cityName = '';
                const addressComponents = place.address_components;
                console.log(addressComponents)
                for (let i = 0; i < addressComponents.length; i++) {
                const component = addressComponents[i];
                console.log(component.types.includes('locality'))
                    if (component.types.includes('locality') || component.types.includes('political') || component.types.includes('country') || component.types.includes('administrative_area_level_2') || component.types.includes('administrative_area_level_1') || component.types.includes('sublocality')) {
                        cityName = component.long_name;
                        updateButton.style.background = '#FF9902';
                        updateButton.disabled = false;

                        break;
                    }
                }
                document.getElementById('userCityText').value = cityName;
                console.log('Selected City (Short Name):', cityName);
            });
}

        // Initialize the autocomplete feature when the page loads
        google.maps.event.addDomListener(window, 'load', initAutocomplete);
    
  </script>
</body>
</html>
