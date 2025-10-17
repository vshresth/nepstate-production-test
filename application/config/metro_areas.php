<?php
/**
 * US Metro Areas Configuration
 * Comprehensive mapping of major metropolitan areas across all 50 states
 * Organized for easy restructuring and maintenance
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Get all metro areas mapping
 * @return array Metro areas with main city and nearby cities
 */
function getMetroAreas() {
    return array(
        
        // DALLAS-FORT WORTH METRO AREA (DFW)
        'dallas' => array(
            'main_city' => 'Dallas',
            'main_state' => 'TX',
            'nearby_cities' => array(
                // Major cities first (by population/importance)
                'Fort Worth', 'Arlington', 'Plano', 'Irving', 'Garland', 'Euless',
                'Grand Prairie', 'Mesquite', 'McKinney', 'Frisco', 'Carrollton', 'Denton', 
                'Allen', 'Richardson', 'Lewisville', 'Flower Mound', 'Bedford', 
                'Grapevine', 'Colleyville', 'Southlake', 'Keller', 'Coppell', 
                'Farmers Branch', 'University Park', 'Highland Park', 'Addison',
                'Duncanville', 'Cedar Hill', 'DeSoto', 'Lancaster', 'Haltom City',
                'Watauga', 'Richland Hills', 'Hurst', 'Roanoke', 'Trophy Club',
                'Westlake', 'Double Oak', 'Bartonville', 'Argyle', 'The Colony'
            ),
            'nearby_states' => array()
        ),
        
        // NEW YORK CITY METRO AREA
        'new_york_city' => array(
            'main_city' => 'New York',
            'main_state' => 'NY',
            'nearby_cities' => array(
                'Newark', 'Jersey City', 'Paterson', 'Elizabeth', 'Edison', 'Woodbridge',
                'Lakewood', 'Toms River', 'Hamilton', 'Trenton', 'Camden', 'Gloucester',
                'Passaic', 'Union City', 'Bayonne', 'East Orange', 'West New York',
                'Hoboken', 'Perth Amboy', 'Plainfield', 'Hackensack', 'Sayreville',
                'Union', 'Old Bridge', 'North Bergen', 'Kearny', 'Linden', 'Fort Lee',
                'Englewood', 'Teaneck', 'Clifton', 'Fair Lawn', 'Garfield', 'Ridgewood',
                'Rutherford', 'Tenafly', 'Mahwah', 'Paramus', 'Bergenfield', 'New Milford',
                'Bronx', 'Brooklyn', 'Queens', 'Manhattan', 'Staten Island', 'Yonkers',
                'New Rochelle', 'Mount Vernon', 'White Plains', 'Greenburgh', 'Elmsford', 'Corona'
            ),
            'nearby_states' => array('NJ', 'CT')
        ),
        
        // DMV (DC-MARYLAND-VIRGINIA)
        'dmv' => array(
            'main_city' => 'Washington',
            'main_state' => 'DC',
            'nearby_cities' => array(
                // Maryland
                'Baltimore', 'Frederick', 'Rockville', 'Gaithersburg', 'Bowie', 'Hagerstown',
                'Annapolis', 'College Park', 'Salisbury', 'Laurel', 'Greenbelt', 'Takoma Park',
                'Hyattsville', 'Silver Spring', 'Bethesda', 'Chevy Chase', 'Potomac', 'Germantown',
                'Montgomery Village', 'Wheaton', 'Aspen Hill', 'Olney', 'Damascus', 'Poolesville',
                'Kensington', 'Garrett Park', 'Chevy Chase Village', 'Friendship Heights',
                // Virginia
                'Arlington', 'Alexandria', 'Richmond', 'Norfolk', 'Virginia Beach', 'Chesapeake',
                'Newport News', 'Hampton', 'Portsmouth', 'Suffolk', 'Roanoke', 'Lynchburg',
                'Harrisonburg', 'Leesburg', 'Charlottesville', 'Danville', 'Petersburg',
                'Fredericksburg', 'Manassas', 'Fairfax', 'Falls Church', 'Vienna', 'McLean',
                'Great Falls', 'Oakton', 'Reston', 'Herndon', 'Sterling', 'Ashburn',
                'Leesburg', 'Purcellville', 'Middleburg', 'Warrenton', 'Culpeper'
            ),
            'nearby_states' => array('MD', 'VA')
        ),
        
        // LOS ANGELES METRO AREA
        'los_angeles' => array(
            'main_city' => 'Los Angeles',
            'main_state' => 'CA',
            'nearby_cities' => array(
                'Long Beach', 'Anaheim', 'Santa Ana', 'Riverside', 'Irvine', 'San Bernardino',
                'Fontana', 'Oxnard', 'Moreno Valley', 'Huntington Beach', 'Glendale', 'Santa Clarita',
                'Garden Grove', 'Oceanside', 'Rancho Cucamonga', 'Ontario', 'Lancaster', 'Corona',
                'Palmdale', 'Pomona', 'Torrance', 'Orange', 'Fullerton', 'Pasadena', 'Thousand Oaks',
                'Simi Valley', 'Roseville', 'Victorville', 'El Monte', 'Downey', 'Costa Mesa',
                'Inglewood', 'Ventura', 'West Covina', 'Norwalk', 'Carlsbad', 'Murrieta', 'Temecula',
                'Santa Monica', 'El Cajon', 'Mission Viejo', 'Hesperia', 'Burbank', 'Santa Barbara',
                'Rialto', 'El Centro', 'San Leandro', 'Compton', 'Jurupa Valley', 'Vista', 'South Gate'
            ),
            'nearby_states' => array()
        ),
        
        // SAN FRANCISCO BAY AREA
        'san_francisco_bay_area' => array(
            'main_city' => 'San Francisco',
            'main_state' => 'CA',
            'nearby_cities' => array(
                'San Jose', 'Oakland', 'Fremont', 'Santa Rosa', 'Hayward', 'Sunnyvale',
                'Concord', 'Santa Clara', 'Vallejo', 'Berkeley', 'Fairfield', 'Richmond',
                'Antioch', 'Daly City', 'San Mateo', 'Vacaville', 'San Leandro',
                'Livermore', 'San Rafael', 'Napa', 'Redwood City', 'Mountain View', 'Alameda',
                'Union City', 'Pleasanton', 'Palo Alto', 'Milpitas', 'Foster City', 'Burlingame',
                'San Bruno', 'South San Francisco', 'San Carlos', 'Belmont', 'Menlo Park',
                'Atherton', 'Portola Valley', 'Woodside', 'Los Altos',
                'Los Altos Hills', 'Cupertino', 'Saratoga', 'Los Gatos', 'Campbell',
                'Newark', 'Piedmont', 'Emeryville', 'Albany', 'El Cerrito', 'San Pablo',
                'Hercules', 'Pinole', 'El Sobrante', 'Orinda', 'Lafayette', 'Moraga',
                'Walnut Creek', 'Clayton', 'Pleasant Hill', 'Martinez',
                'Benicia', 'American Canyon', 'Yountville', 'St. Helena',
                'Calistoga', 'Sonoma', 'Petaluma', 'Rohnert Park', 'Cotati', 'Sebastopol',
                'Healdsburg', 'Windsor'
            ),
            'nearby_states' => array()
        ),
        
        // CHICAGO METRO AREA
        'chicago' => array(
            'main_city' => 'Chicago',
            'main_state' => 'IL',
            'nearby_cities' => array(
                'Aurora', 'Rockford', 'Joliet', 'Naperville', 'Springfield', 'Peoria',
                'Elgin', 'Waukegan', 'Cicero', 'Champaign', 'Bloomington', 'Arlington Heights',
                'Evanston', 'Decatur', 'Schaumburg', 'Bolingbrook', 'Palatine', 'Skokie',
                'Des Plaines', 'Orland Park', 'Tinley Park', 'Oak Lawn', 'Berwyn',
                'Mount Prospect', 'Normal', 'Wheaton', 'Hoffman Estates', 'Oak Park',
                'Downers Grove', 'Elmhurst', 'Glenview', 'Lombard', 'Buffalo Grove',
                'Bartlett', 'Urbana', 'Quincy', 'Crystal Lake', 'Streamwood', 'Carol Stream',
                'Romeoville', 'Plainfield', 'Hanover Park', 'Carpentersville', 'Wheeling',
                'Park Ridge', 'Addison', 'Calumet City', 'Northbrook', 'St. Charles',
                'Woodridge', 'Glendale Heights', 'Bensenville', 'West Chicago', 'Oak Forest'
            ),
            'nearby_states' => array('IN', 'WI')
        ),
        
        // HOUSTON METRO AREA
        'houston' => array(
            'main_city' => 'Houston',
            'main_state' => 'TX',
            'nearby_cities' => array(
                'Pasadena', 'Pearland', 'League City', 'Sugar Land', 'Missouri City',
                'Stafford', 'Deer Park', 'Friendswood', 'La Porte', 'Galveston',
                'Katy', 'Cypress', 'Spring', 'The Woodlands', 'Conroe', 'Tomball',
                'Baytown', 'Humble', 'Kingwood', 'Atascocita', 'Channelview',
                'Crosby', 'Dayton', 'Huffman', 'Liberty', 'Mont Belvieu'
            ),
            'nearby_states' => array()
        ),
        
        // ATLANTA METRO AREA
        'atlanta' => array(
            'main_city' => 'Atlanta',
            'main_state' => 'GA',
            'nearby_cities' => array(
                'Augusta', 'Columbus', 'Savannah', 'Athens', 'Sandy Springs', 'Roswell',
                'Macon', 'Albany', 'Johns Creek', 'Warner Robins', 'Alpharetta', 'Marietta',
                'Valdosta', 'Smyrna', 'Dunwoody', 'Rome', 'East Point', 'Peachtree Corners',
                'Gainesville', 'Hinesville', 'Kennesaw', 'LaGrange', 'Dalton', 'Griffin',
                'Carrollton', 'Newnan', 'Statesboro', 'Union City', 'Forest Park', 'College Park',
                'Chamblee', 'Doraville', 'Decatur', 'Tucker', 'Stone Mountain', 'Lithonia',
                'Conyers', 'Covington', 'McDonough', 'Stockbridge', 'Fayetteville', 'Jonesboro'
            ),
            'nearby_states' => array()
        ),
        
        // MIAMI METRO AREA
        'miami' => array(
            'main_city' => 'Miami',
            'main_state' => 'FL',
            'nearby_cities' => array(
                'Hialeah', 'Fort Lauderdale', 'Port St. Lucie', 'Cape Coral', 'Pembroke Pines',
                'Hollywood', 'Miramar', 'Gainesville', 'Coral Springs', 'Miami Gardens',
                'Clearwater', 'Palm Bay', 'West Palm Beach', 'Pompano Beach', 'Lakeland',
                'Davie', 'Miami Beach', 'Sunrise', 'Plantation', 'Boca Raton', 'Deltona',
                'Largo', 'Deerfield Beach', 'Boynton Beach', 'Lauderhill', 'Fort Myers',
                'Kissimmee', 'Homestead', 'Tamarac', 'Delray Beach', 'Jupiter', 'Wellington',
                'Coral Gables', 'Aventura', 'Key Biscayne', 'Doral', 'Kendall'
            ),
            'nearby_states' => array()
        ),
        
        // PHOENIX METRO AREA
        'phoenix' => array(
            'main_city' => 'Phoenix',
            'main_state' => 'AZ',
            'nearby_cities' => array(
                'Tucson', 'Mesa', 'Chandler', 'Scottsdale', 'Glendale', 'Gilbert',
                'Tempe', 'Peoria', 'Surprise', 'Yuma', 'Avondale', 'Goodyear',
                'Flagstaff', 'Buckeye', 'Lake Havasu City', 'Casa Grande', 'Sierra Vista',
                'Maricopa', 'Oro Valley', 'Prescott', 'Bullhead City', 'Prescott Valley',
                'Apache Junction', 'Marana', 'Eloy', 'Kingman', 'Queen Creek'
            ),
            'nearby_states' => array()
        ),
        
        // SEATTLE METRO AREA
        'seattle' => array(
            'main_city' => 'Seattle',
            'main_state' => 'WA',
            'nearby_cities' => array(
                'Spokane', 'Tacoma', 'Vancouver', 'Bellevue', 'Kent', 'Everett', 'Renton',
                'Yakima', 'Federal Way', 'Spokane Valley', 'Bellingham', 'Kennewick',
                'Auburn', 'Pasco', 'Marysville', 'Lakewood', 'Redmond', 'Shoreline',
                'Richland', 'Kirkland', 'Burien', 'Olympia', 'Lacey', 'Edmonds', 'Bremerton',
                'Puyallup', 'Sammamish', 'University Place', 'Wenatchee', 'Longview',
                'Mount Vernon', 'Walla Walla', 'Centralia', 'Pullman', 'Oak Harbor'
            ),
            'nearby_states' => array()
        ),
        
        // DENVER METRO AREA
        'denver' => array(
            'main_city' => 'Denver',
            'main_state' => 'CO',
            'nearby_cities' => array(
                'Colorado Springs', 'Aurora', 'Fort Collins', 'Lakewood', 'Thornton',
                'Westminster', 'Arvada', 'Pueblo', 'Centennial', 'Boulder', 'Greeley',
                'Longmont', 'Loveland', 'Grand Junction', 'Broomfield', 'Commerce City',
                'Northglenn', 'Wheat Ridge', 'Lafayette', 'Louisville', 'Superior',
                'Erie', 'Frederick', 'Firestone', 'Dacono', 'Mead', 'Niwot'
            ),
            'nearby_states' => array()
        ),
        
        // MINNEAPOLIS METRO AREA
        'minneapolis' => array(
            'main_city' => 'Minneapolis',
            'main_state' => 'MN',
            'nearby_cities' => array(
                'Saint Paul', 'Rochester', 'Duluth', 'Bloomington', 'Brooklyn Park',
                'Plymouth', 'Saint Cloud', 'Eagan', 'Woodbury', 'Maple Grove',
                'Eden Prairie', 'Minnetonka', 'Burnsville', 'Lakeville', 'Apple Valley',
                'Blaine', 'Moorhead', 'Maplewood', 'Richfield', 'Coon Rapids',
                'Edina', 'Roseville', 'Inver Grove Heights', 'Oakdale', 'Cottage Grove'
            ),
            'nearby_states' => array('WI')
        ),
        
        // DETROIT METRO AREA
        'detroit' => array(
            'main_city' => 'Detroit',
            'main_state' => 'MI',
            'nearby_cities' => array(
                'Grand Rapids', 'Warren', 'Sterling Heights', 'Lansing', 'Ann Arbor',
                'Flint', 'Dearborn', 'Livonia', 'Westland', 'Troy', 'Farmington Hills',
                'Kalamazoo', 'Wyoming', 'Southfield', 'Rochester Hills', 'Taylor',
                'Pontiac', 'St. Clair Shores', 'Royal Oak', 'Novi', 'Dearborn Heights',
                'Battle Creek', 'Saginaw', 'Kentwood', 'East Lansing', 'Roseville'
            ),
            'nearby_states' => array()
        ),
        
        // CLEVELAND METRO AREA
        'cleveland' => array(
            'main_city' => 'Cleveland',
            'main_state' => 'OH',
            'nearby_cities' => array(
                'Columbus', 'Cincinnati', 'Toledo', 'Akron', 'Dayton', 'Parma',
                'Canton', 'Youngstown', 'Lorain', 'Hamilton', 'Springfield', 'Kettering',
                'Elyria', 'Lakewood', 'Cuyahoga Falls', 'Middletown', 'Newark', 'Mansfield',
                'Mentor', 'Beavercreek', 'Cleveland Heights', 'Strongsville', 'Fairborn',
                'Findlay', 'Warren', 'Lancaster', 'Lima', 'Huber Heights', 'Stow'
            ),
            'nearby_states' => array()
        ),
        
        // BOSTON METRO AREA
        'boston' => array(
            'main_city' => 'Boston',
            'main_state' => 'MA',
            'nearby_cities' => array(
                'Cambridge', 'Newton', 'Lowell', 'Brockton', 'New Bedford', 'Quincy',
                'Lynn', 'Framingham', 'Waltham', 'Malden', 'Brookline',
                'Medford', 'Taunton', 'Chicopee', 'Weymouth', 'Revere', 'Peabody',
                'Methuen', 'Barnstable', 'Pittsfield', 'Attleboro', 'Everett', 'Salem',
                'Westfield', 'Leominster', 'Fitchburg', 'Beverly', 'Holyoke', 'Marlborough',
                'Woburn', 'Chelsea', 'Somerville', 'Arlington', 'Watertown', 'Belmont'
            ),
            'nearby_states' => array('NH', 'RI')
        ),
        
        // PHILADELPHIA METRO AREA
        'philadelphia' => array(
            'main_city' => 'Philadelphia',
            'main_state' => 'PA',
            'nearby_cities' => array(
                'Reading', 'Allentown', 'Erie', 'Upper Darby', 'Scranton', 'Bethlehem',
                'Lancaster', 'Altoona', 'York', 'State College', 'Chester', 'Wilkes-Barre',
                'Harrisburg', 'Norristown', 'Williamsport', 'Easton', 'Lebanon',
                'Drexel Hill', 'Levittown', 'Pottstown', 'Hazleton', 'Johnstown',
                'McKeesport', 'New Castle', 'Washington', 'Butler', 'Greensburg', 'Monroeville'
            ),
            'nearby_states' => array('NJ', 'DE', 'MD')
        ),
        
        // KANSAS CITY METRO AREA
        'kansas_city' => array(
            'main_city' => 'Kansas City',
            'main_state' => 'MO',
            'nearby_cities' => array(
                'Independence', 'Columbia', 'Lee\'s Summit', 'O\'Fallon', 'Saint Joseph',
                'Saint Charles', 'Saint Peters', 'Blue Springs', 'Florissant', 'Joplin',
                'Chesterfield', 'Jefferson City', 'Cape Girardeau', 'Wildwood', 'University City',
                'Ballwin', 'Raytown', 'Liberty', 'Wentzville', 'Gladstone', 'Hazelwood',
                'Kirkwood', 'Maryland Heights', 'Grandview', 'Belton', 'Raymore', 'Peculiar',
                'Harrisonville', 'Grain Valley', 'Oak Grove', 'Buckner', 'Sibley', 'Lake Lotawana',
                'Lone Jack', 'Pleasant Hill', 'Greenwood', 'Lake Winnebago', 'Lake Tapawingo'
            ),
            'nearby_states' => array('KS')
        )
    );
}

/**
 * Get metro area for a given city
 * @param string $city City name
 * @param string $state State abbreviation
 * @return array|false Metro area data or false if not found
 */
function getMetroAreaForCity($city, $state) {
    $metroAreas = getMetroAreas();
    
    foreach ($metroAreas as $metroKey => $metroData) {
        // Check if it's the main city
        if (strtolower($metroData['main_city']) === strtolower($city) && 
            strtolower($metroData['main_state']) === strtolower($state)) {
            return $metroData;
        }
        
        // Check if it's a nearby city
        foreach ($metroData['nearby_cities'] as $nearbyCity) {
            if (strtolower($nearbyCity) === strtolower($city)) {
                return $metroData;
            }
        }
    }
    
    return false;
}

/**
 * Get all cities in a metro area
 * @param string $metroKey Metro area key (e.g., 'new_york_city')
 * @return array Array of all cities in the metro area
 */
function getMetroAreaCities($metroKey) {
    $metroAreas = getMetroAreas();
    
    if (!isset($metroAreas[$metroKey])) {
        return array();
    }
    
    $metro = $metroAreas[$metroKey];
    $allCities = array($metro['main_city']);
    
    return array_merge($allCities, $metro['nearby_cities']);
}

/**
 * Find metro area by city name (reverse lookup)
 * @param string $city City name
 * @param string $state State name/abbreviation (optional)
 * @return array|false Metro area data or false if not found
 */
function findMetroAreaByCity($city, $state = '') {
    $metroAreas = getMetroAreas();
    
    foreach ($metroAreas as $metroKey => $metroData) {
        // Check main city
        if (strtolower($metroData['main_city']) === strtolower($city)) {
            // If state is provided, make sure it matches the metro area state
            if (!empty($state)) {
                $metroState = strtolower($metroData['main_state']);
                $searchState = strtolower($state);
                $stateMapping = array(
                    'alabama' => 'al', 'alaska' => 'ak', 'arizona' => 'az', 'arkansas' => 'ar', 'california' => 'ca',
                    'colorado' => 'co', 'connecticut' => 'ct', 'delaware' => 'de', 'florida' => 'fl', 'georgia' => 'ga',
                    'hawaii' => 'hi', 'idaho' => 'id', 'illinois' => 'il', 'indiana' => 'in', 'iowa' => 'ia',
                    'kansas' => 'ks', 'kentucky' => 'ky', 'louisiana' => 'la', 'maine' => 'me', 'maryland' => 'md',
                    'massachusetts' => 'ma', 'michigan' => 'mi', 'minnesota' => 'mn', 'mississippi' => 'ms', 'missouri' => 'mo',
                    'montana' => 'mt', 'nebraska' => 'ne', 'nevada' => 'nv', 'new hampshire' => 'nh', 'new jersey' => 'nj',
                    'new mexico' => 'nm', 'new york' => 'ny', 'north carolina' => 'nc', 'north dakota' => 'nd', 'ohio' => 'oh',
                    'oklahoma' => 'ok', 'oregon' => 'or', 'pennsylvania' => 'pa', 'rhode island' => 'ri', 'south carolina' => 'sc',
                    'south dakota' => 'sd', 'tennessee' => 'tn', 'texas' => 'tx', 'utah' => 'ut', 'vermont' => 'vt',
                    'virginia' => 'va', 'washington' => 'wa', 'west virginia' => 'wv', 'wisconsin' => 'wi', 'wyoming' => 'wy'
                );
                
                // Check if states match (full name or abbreviation)
                if ($metroState !== $searchState && 
                    (!isset($stateMapping[$searchState]) || $stateMapping[$searchState] !== $metroState) &&
                    (!isset($stateMapping[$metroState]) || $stateMapping[$metroState] !== $searchState)) {
                    // Check if state is in nearby states
                    $stateMatches = false;
                    foreach ($metroData['nearby_states'] as $nearbyState) {
                        if (strtolower($nearbyState) === $searchState || 
                            (isset($stateMapping[$searchState]) && $stateMapping[$searchState] === strtolower($nearbyState))) {
                            $stateMatches = true;
                            break;
                        }
                    }
                    if (!$stateMatches) {
                        continue; // Skip this metro area if state doesn't match
                    }
                }
            }
            return array('key' => $metroKey, 'data' => $metroData);
        }
        
        // Check nearby cities
        foreach ($metroData['nearby_cities'] as $nearbyCity) {
            if (strtolower($nearbyCity) === strtolower($city)) {
                // If state is provided, make sure it matches the metro area state or nearby states
                if (!empty($state)) {
                    $searchState = strtolower($state);
                    $stateMapping = array(
                        'alabama' => 'al', 'alaska' => 'ak', 'arizona' => 'az', 'arkansas' => 'ar', 'california' => 'ca',
                        'colorado' => 'co', 'connecticut' => 'ct', 'delaware' => 'de', 'florida' => 'fl', 'georgia' => 'ga',
                        'hawaii' => 'hi', 'idaho' => 'id', 'illinois' => 'il', 'indiana' => 'in', 'iowa' => 'ia',
                        'kansas' => 'ks', 'kentucky' => 'ky', 'louisiana' => 'la', 'maine' => 'me', 'maryland' => 'md',
                        'massachusetts' => 'ma', 'michigan' => 'mi', 'minnesota' => 'mn', 'mississippi' => 'ms', 'missouri' => 'mo',
                        'montana' => 'mt', 'nebraska' => 'ne', 'nevada' => 'nv', 'new hampshire' => 'nh', 'new jersey' => 'nj',
                        'new mexico' => 'nm', 'new york' => 'ny', 'north carolina' => 'nc', 'north dakota' => 'nd', 'ohio' => 'oh',
                        'oklahoma' => 'ok', 'oregon' => 'or', 'pennsylvania' => 'pa', 'rhode island' => 'ri', 'south carolina' => 'sc',
                        'south dakota' => 'sd', 'tennessee' => 'tn', 'texas' => 'tx', 'utah' => 'ut', 'vermont' => 'vt',
                        'virginia' => 'va', 'washington' => 'wa', 'west virginia' => 'wv', 'wisconsin' => 'wi', 'wyoming' => 'wy'
                    );
                    
                    $metroState = strtolower($metroData['main_state']);
                    $stateMatches = false;
                    
                    // Check main state
                    if ($metroState === $searchState || 
                        (isset($stateMapping[$searchState]) && $stateMapping[$searchState] === $metroState) ||
                        (isset($stateMapping[$metroState]) && $stateMapping[$metroState] === $searchState)) {
                        $stateMatches = true;
                    }
                    
                    // Check nearby states
                    if (!$stateMatches) {
                        foreach ($metroData['nearby_states'] as $nearbyState) {
                            if (strtolower($nearbyState) === $searchState || 
                                (isset($stateMapping[$searchState]) && $stateMapping[$searchState] === strtolower($nearbyState))) {
                                $stateMatches = true;
                                break;
                            }
                        }
                    }
                    
                    if (!$stateMatches) {
                        continue; // Skip this metro area if state doesn't match
                    }
                }
                return array('key' => $metroKey, 'data' => $metroData);
            }
        }
    }
    
    return false;
}
