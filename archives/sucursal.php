<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>GMS | Sucursal</title>
    <link rel="stylesheet" type="text/css" href="../styles/stylesNav.css">
    <link rel="stylesheet" type="text/css" href="../styles/stylesSucursal.css">
    <?php
    include("../Plantillas/head.html");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- api para el mapa -->
    <!-- AIzaSyDh7_U5Oil-vfWGvBLWufa1J0YvwTKoNlk -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDh7_U5Oil-vfWGvBLWufa1J0YvwTKoNlk"></script>
    <script>
        function initMap() {
            var location = {
                lat: 21.5188542,
                lng: -104.9169776

            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 17,
                center: location,

            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
    </script>
</head>

<body onload="initMap()">
    <?php
    include("../Plantillas/nav.html");
    ?>
    <!-- INFORMACION DE LA EMPRESA -->
    <header>
        <h1>Sucursal "Villa San Angel"</h1>
    </header>
    <main>
        <div class="container">
            <div class="section section-left" id="izq">
                <h2>Información de la sucursal</h2>
                <p><strong>Dirección:</strong><br>Av. Insurgentes 895-EPTE, Cddee, 63060 Tepic, Nay.</p>
                <p><strong>Teléfono:</strong><br>(+52) 311-171-3322</p>
                <p><strong>Horario:</strong><br>- Lunes a Sabado de 7:00 am a 3:00 pm,<br>- Sábados de 7:00 am a 1:00 pm
                </p>
                <p><strong>Correo electrónico:</strong><br>genomicamoleculartepic@gmail.com</p>
            </div>
            <div class="section section-right" id="der">
                <h2>Ubicación en el mapa</h2>
                <div id="map-container">
                    <div id="map" style="z-index: 1;"></div>
                </div>
            </div>
        </div>
    </main>
    <!-- Pie de pagina -->
    <footer class="fixed-bottom">
        <p>&copy; 2023, Sucursales GMS</p>
    </footer>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>


</html>