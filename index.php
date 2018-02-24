<?php require_once("./function.php") ?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>App</title>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="/assets/css/main.css" rel="stylesheet" />
    </head>
    <body class="text-center">
        <div class="wrapper">
            <div id="map"></div>
            <div class="right-nav">
                <button class="btn btn-primary btn-block" id="scanAllRestaurants">Scanning </button>
                <label class="found-label" style="display:none" id="founded">0 found</label>
                <button class="btn btn-success btn-block disabled" disabled id="download">Download</button>
            </div>
        </div>
        
        <div class="loading" style="display: none">Loading&#8230;</div>

        <script src="/assets/js/jquery.js"></script>
        <script src="/assets/js/main.js"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo env('API_KEY'); ?>&callback=initMap"></script>
    </body>
</html>
