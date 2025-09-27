<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Country Flags</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #e3856b !important; */

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        .container_ {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }

        .country-card {
            width: 100%;
            height: auto;
            background-color: #fff;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 20px;
            text-decoration: none;
            color: #202020;
        }
        
        .country-card:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            background-color: #e3866b;
            color: #fff;
        }

        .country-flag {
            width: auto;
            max-height: 200px;
            display: block;
            margin: 0 auto;
        }

        .country-name {
            padding: 10px;
            text-align: center;
            font-size: 16px;
            text-transform: uppercase;
            font-weight: bold;
            
            
        }

        .select-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .select-button:hover {
            background-color: #0056b3;
        }

        h1 {
            text-align: center;
            color: black;
            margin-top: 50px;
            text-transform: uppercase;
            margin-bottom: 10px;
        }

        p {
            text-align: center;
            color: black;
            margin-bottom: 30px;
        }
        .country-flag {
            height: 64px;
            border-radius: 100px;
            width: 64px;
            margin-bottom: 20px;
        }

        img#logo {
            display: block;
            margin: 0 auto;
            margin-top: 3%;
            height: 100px;
        }

        .select-button {
            text-align: center;
            text-decoration: none;
        }



h1 {
  text-align: center;
  font-family: Tahoma, Arial, sans-serif;
  color: #06D85F;
  margin: 80px 0;
}

.box {
  width: 40%;
  margin: 0 auto;
  background: rgba(255,255,255,0.2);
  padding: 35px;
  border: 2px solid #fff;
  border-radius: 20px/50px;
  background-clip: padding-box;
  text-align: center;
}

.button {
  font-size: 1em;
  padding: 10px;
  color: #fff;
  border: 2px solid #06D85F;
  border-radius: 20px/50px;
  text-decoration: none;
  cursor: pointer;
  transition: all 0.3s ease-out;
}
.button:hover {
  background: #06D85F;
}

.overlay {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.7);
  transition: opacity 500ms;
  visibility: hidden;
  opacity: 0;
}
.overlay:target {
  visibility: visible;
  opacity: 1;
}

.popup {
  margin: 70px auto;
  padding: 20px;
  background: #fff;
  border-radius: 5px;
  width: 30%;
  position: relative;
  transition: all 5s ease-in-out;
}



.popup h2 {
  margin-top: 0;
  color: #333;
  font-family: Tahoma, Arial, sans-serif;
}

.popup .close {
  position: absolute;
  top: 20px;
  right: 30px;
  transition: all 200ms;
  font-size: 30px;
  font-weight: bold;
  text-decoration: none;
  color: #333;
}
.popup .close:hover {
  color: #06D85F;
}
.popup .content {
  max-height: 30%;
  overflow: auto;
}

@media screen and (max-width: 700px){
  .box{
    width: 70%;
  }
  .popup{
    width: 70%;
  }

  .container_ {
    grid-template-columns: repeat(2, 1fr);
    }
}

    </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
  
    <img src="<?php echo $logo ?>" alt="Nepstate Logo" id="logo">

    <!-- <h1>Welcome to Nepstate </h1> -->
    <p style="margin-top:20px;">Which Nepstate site you want to visit.</p>
    <div class="container container_" id="countryContainer">
        <?php
          
          foreach ($listOfCountries as $country) {
             echo '<a href='.base_url().'update-user-country/'.$country->id.' class="country-card">';

            // echo '<a href="#" data-toggle="modal" data-target="#exampleModal" class="country-card" onclick="showCitiesPopup('.$country->id.')">';
            echo '<img src="' . $country->flag . '" alt="' . $country->title . '" class="country-flag">';
            echo '<div class="country-name">' . $country->title . '</div>';
            echo '</a>';
        }
        
        ?>
    </div>
    


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" >Select Your City!</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <select class="form-control" name="" id="citiesDropdown">

        </select>
      </div>
      <div class="modal-footer" style="align-item:center;">
        <button type="button" class="btn btn-primary" id="cityBtn">Save</button>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js"></script>
          <script>

            

document.getElementById('cityBtn').addEventListener('click', () => {
    let citiesDropdown = document.getElementById('citiesDropdown');

    let selectedOption = citiesDropdown.options[citiesDropdown.selectedIndex];

    if (selectedOption !== null && selectedOption.value !== '') {
        location.href="update-user-country/"+selectedOption.value;
    } else {
       alert('Please select your city!');
    }
});



function showCitiesPopup($id) {
    $.ajax({
        url: "<?php echo base_url(); ?>ApiController/getCitiesByCountry/"+$id,
        method: "GET",
        dataType: 'json',
        success: function(response) {
            var dropdown = $('#citiesDropdown');
            
            dropdown.empty();
            // Add default "Select city" option
            var defaultOption = $('<option></option>').attr('value', '').text('Select city');
            dropdown.append(defaultOption);

            // Append options from API response
            $.each(response, function(index, city) {
                var option = $('<option></option>').attr('value', city.id).text(city.title);
                dropdown.append(option);
            });

            // Set the default option as selected
            dropdown.val('').prop('selected', true);
        },

        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}





          </script></body>
</html>
