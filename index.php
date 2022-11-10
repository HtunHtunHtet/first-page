<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require ('src/includes/header.inc.php')?>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <link rel="stylesheet" type="text/css" href="src/dist/css/style.css" />
        <link rel="stylesheet" type="text/css" href="node_modules/datatables.net-dt/css/jquery.dataTables.min.css" />
        <link rel="stylesheet" type="text/css" href="src/dist/css/responsive.dataTables.min.css"/>
        <link rel="stylesheet" type="text/css" href="src/dist/css/rowRecorder.dataTables.min.css"/>
    </head>
    <body style="width: 100%; margin:0; padding: 0;">
        <?php require ('src/includes/navbar.inc.php')?>
        <section class="mapSection">
            <div class="container mb-5">
                <div id="map" class="map-responsive"></div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <table id="earthquakeTable" class="table table-striped" style="overflow-x: auto" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Magnitude</th>
                                    <th>URL</th>
                                    <th>Location</th>
                                </tr>
                            </thead>
                    </div>
                </div>
            </div>
        </section>
        <script src="node_modules/jquery/dist/jquery.min.js"></script>
        <script src="node_modules/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="src/dist/js/datatable.rowRecorder.min.js"></script>
        <script src="src/dist/js/datatable.responsive.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCAoS-NbQUbTON0Q47qOjyOqP_7cp0uOhI&v=weekly" defer></script>
        <script type="module" src="src/dist/js/index.js"></script>
    </body>
</html>
