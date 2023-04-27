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

    <script src="https://maps.googleapis.com/maps/api/js?key=TU_API_KEY"></script>
    <script>
        function initMap() {
            var location = {
                lat: 37.7749,
                lng: -122.4194
            };
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location
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
        <section>
            <h2>Información de la sucursal</h2>
            <ul>
                <li><strong>Dirección:</strong> 123 Calle Principal, Ciudad ABC</li>
                <li><strong>Teléfono:</strong> (123) 456-7890</li>
                <li><strong>Horario:</strong> Lunes a Viernes de 9:00 am a 6:00 pm, Sábados de 9:00 am a 2:00 pm</li>
                <li><strong>Correo electrónico:</strong> info@sucursalxyz.com</li>
            </ul>
        </section>

        <section>
            <h2>Ubicación en el mapa</h2>
            <div id="map"></div>
        </section>
    </main>

    <footer>
        <p>&copy; 2023, Sucursal XYZ</p>
    </footer>
</body>

</html>