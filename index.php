<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require ('src/includes/header.inc.php')?>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link rel="stylesheet" type="text/css" href="src/dist/css/style.css" />
        <script src="node_modules/jquery/dist/jquery.min.js"></script>

    </head>
    <body style="width: 100%; margin:0; padding: 0;">
        <?php require ('src/includes/navbar.inc.php')?>
        <section class="mapSection">
            <div class="container">
                <div id="map" class="map-responsive"></div>
            </div>
        </section>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAoS-NbQUbTON0Q47qOjyOqP_7cp0uOhI&v=weekly" defer></script>
        <script type="module" src="src/dist/js/index.js"></script>
    </body>
</html>
