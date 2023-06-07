<!DOCTYPE html>
<html lang="es">

<head>
    <title>GMS | Inicio</title>
    <meta charset="utf-8" name="description">
    <link rel="stylesheet" href="styles/stylesIndex.css" />
    <link rel="stylesheet" href="styles/stylesNav.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="Images/GMS-Logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg nav-custom" style="background-color: #3f51b5">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="index.php">
                <img src="Images/GMS-Logo1.png" alt="LogoGMS" width="60" height="24" class="d-inline-block align-text-top" />
                Laboratorios GMS
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="archives/estudios.php">Estudios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="archives/sucursal.php">Sucursales</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="archives/coviv19.php">Covid 19</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="archives/hacerCita.php">Agenda una cita</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="archives/consultaCita.php">Consulta tu cita</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!-- Carrousel de imagenes -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/analisis.jpg" class="sliderimg d-block w-100" alt="...">
                <div class="carousel-caption rounded d-none d-md-block bg-black bg-opacity-75">
                    <h5>Analisis certeros</h5>
                    <p>Estamos al tanto de tus analisis para darte resultados precisos.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="Images/Equipo-basico.jpg" class="sliderimg d-block w-100" alt="...">
                <div class="carousel-caption rounded d-none d-md-block bg-black bg-opacity-75">
                    <h5>Equipo</h5>
                    <p>Contamos con el equipo necesario para el estudio que necesites.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="Images/resultados.jpg" class="sliderimg d-block w-100" alt="...">
                <div class="carousel-caption rounded d-none d-md-block bg-black bg-opacity-75">
                    <h5>Resultados</h5>
                    <p>Obtendras tus resultados lo mas rapido posible.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="Images/tipos-de-estidios.jpg" class="sliderimg d-block w-100" alt="...">
                <div class="carousel-caption rounded d-none d-md-block bg-black bg-opacity-75">
                    <h5>Estudios</h5>
                    <p>Contamos con una gran variedad de estudios para lo que usted necesita.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon rounded bg-black bg-opacity-75" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon rounded bg-black bg-opacity-75" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Card con la informacion general -->
    <div class="card-header text-center m-5">
        <h1>Laboratorio Clínico</h1>
        <p>Tu salud es nuestra prioridad</p>
    </div>


    <!-- Cards con la vision y mision -->
    <div class="card text-center mx-5 p-5">
        <div class="card-body mx-auto">
            <div class="mb-5">
                <h2 class="card-title">Información general</h2>
                <p class="card-text mb-5">Somos un laboratorio clínico con más de 10 años de experiencia en el sector de la salud. Nos especializamos en la realización de pruebas clínicas y diagnóstico de enfermedades.</p>
            </div>

            <div class="row mision-vision">
                <div class="col mision p-3 my-1">
                    <h2 class="card-title">Misión</h2>
                    <p class="card-text">Nuestra misión es proporcionar servicios de salud de calidad y confiables a nuestros pacientes.</p>
                </div>
                <div class="col vision p-3">
                    <h2 class="card-title">Visión</h2>
                    <p class="card-text">Nuestra visión es convertirnos en el laboratorio clínico líder en la región, reconocido por su excelencia y profesionalismo.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Pie de pagina -->
    <footer class="">
        <p class="card-text">&copy; 2023 Laboratorio Clínico. Todos los derechos reservados.</p>
    </footer>
    <script src="bootstrap/js/bootstrap.min.js">
    </script>
</body>

</html>