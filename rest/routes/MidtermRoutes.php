<?php

Flight::route('GET /midterm/connection-check', function(){
    /** TODO
    * This endpoint prints the message from constructor within MidtermDao class
    * Goal is to check whether connection is successfully established or not
    * ENDPOINT IS NOT GRADED; YOU CAN USE IT IF YOU NEED TO TEST CONNECTION, OTHERWISE YOU CAN LEAVE IT EMPTY
    * This endpoint does not have to return output in JSON format
    */
    Flight::midtermService();

});

Flight::route('POST /midterm/input_data', function(){
    /** TODO
    * This endpoint is used to insert IP2LOCATION.json file content to database table locations
    * This endpoint should return output in JSON format
    * 10 points
    */

    $filename = '../IP2LOCATION.json';
    $json = file_get_contents($filename);   

    //convert json object to php associative array
    $data = json_decode($json, true);
        Flight::json(Flight::midtermService()->input_data($data));
});


Flight::route('GET /midterm/summary/@country', function($country){
    /** TODO
    * This endpoint is used to return total number of regions and cities from locations table
    * by country given as parameter
    * This endpoint should return output in JSON format
    * 30 points
    */

    Flight::json(Flight::midtermService()->summary($country));
});

Flight::route("GET /midterm/encoded", function(){
    /** TODO
    * This endpoint is used to create report that lists first 10 countries and their hashed values
    * Sample data for one country: ['contry' => 'United States', 'encoded' => 'VW5pdGVkIFN0YXRlcw=='];
    * There is php function used to encode string
    * This endpoint should return output in JSON format
    * 30 points
    */


    Flight::json(Flight::midtermService()->encoded());

    
});

Flight::route("GET /midterm/ip/@ip_address", function($ip_address){
    /** TODO
    * This endpoint is used to return location(s) based on ip address given as parameter
    * There is a php function to convert ip address to number, therefore you can use this number to
    * match with those 'from' and 'to' in database
    * This endpoint should return output in JSON format
    * 30 points
    */

    Flight::json(Flight::midtermService()->ip($ip_address));

});

?>
