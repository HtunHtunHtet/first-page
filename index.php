<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require ('src/includes/header.inc.php')?>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

        <link rel="stylesheet" type="text/css" href="src/dist/css/style.css" />
        <script src="src/dist/js/jquery.min.js"></script>
        <script type="module" src="src/dist/js/index.js"></script>
    </head>
    <body style="width: 100%; margin:0; padding: 0;">
        <?php require ('src/includes/navbar.inc.php')?>

        <section class="mapSection" style="height:100%">
            <div class="container" style="height:100%">
                <div class="row" style="height:100%">
                    <div id="map" style="height: 460px;display: block;"></div>
                </div>
            </div>
        </section>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAoS-NbQUbTON0Q47qOjyOqP_7cp0uOhI&callback=initMap&v=weekly" defer></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
    </body>
</html>
