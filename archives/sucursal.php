<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sucursal XYZ</title>
    <link rel="stylesheet" type="text/css" href="../styles/stylesNav.css">
    <link rel="stylesheet" type="text/css" href="../styles/stylesSucursal.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("a").click(function(event) {
                event.preventDefault();
                newLocation = this.href;
                $('body').fadeOut('slow', newpage);
            });

            function newpage() {
                window.location = newLocation;
            }
        });
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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

    <header>
        <h1>Sucursal XYZ</h1>
    </header>
    <main>
        <div class="container">
            <div class="section section-left" id="izq">
                <h2>Información de la sucursal</h2>
                <p><strong>Dirección:</strong><br>Av. Insurgentes 895-EPTE, Cddee, 63060 Tepic, Nay.</p>
                <p><strong>Teléfono:</strong><br>(+52) 311-171-3322</p>
                <p><strong>Horario:</strong><br>- Lunes a Sabado de 7:00 am a 3:00 pm,<br>- Sábados de 7:00 am a 1:00 pm</p>
                <p><strong>Correo electrónico:</strong><br>info@sucursalxyz.com</p>
            </div>
            <div class="section section-right" id="der">
                <h2>Ubicación en el mapa</h2>
                <div id="map-container">
                    <div id="map" style="z-index: 1;"></div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2023, Sucursal XYZ</p>
    </footer>
</body>


</html>