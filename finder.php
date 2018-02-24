<?php 
    
    require_once './vendor/autoload.php';
    require_once './function.php';

    $places = new joshtronic\GooglePlaces(env('API_KEY'));
    $places->location = [$_POST['lat'], $_POST['lng']];
    $places->radius  = $_POST['raidus'] ? $_POST['raidus'] * 100 : 0;
    $places->types = 'food';
    //['lodging', 'bar', 'food', 'restaurant', 'establishment', 'point_of_interest', 'store', 'home_goods_store'];
    $places->extensions = "review_summary";
    
    $results = $places->radarSearch()['results'];
    
    $items = [];
    foreach($results  as $place) {
        $places->reference = $place['reference'];
        $details = $places->details();
        $items[] = $details['result'];
    }

    echo json_encode($items);