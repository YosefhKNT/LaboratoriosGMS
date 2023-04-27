<!DOCTYPE html>
<html lang="es">

<head>
    <title>Estudios Clínicos</title>
    <link rel="stylesheet" type="text/css" href="../styles/stylesNav.css">
    <link rel="stylesheet" type="text/css" href="../styles/stylesEstudios.css">
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

</head>

<body>
    <nav>
        <?php
        include("../Plantillas/nav.html");
        ?>
    </nav>
    <div class="container" onload="document.body.classList.add('animate__animated', 'animate__fadeInDown');">
        <div class="box">
            <img src="https://via.placeholder.com/400x200" alt="Imagen 1" />
            <h2>Estudio de diagnóstico de enfermedades infecciosas</h2>
            <p>
                Nuestro laboratorio clínico ofrece estudios de diagnóstico de enfermedades infecciosas mediante pruebas de PCR y cultivo microbiológico. Contamos con un equipo altamente capacitado y tecnología de vanguardia para garantizar resultados precisos y confiables en el menor tiempo posible.
            </p>
        </div>
        <div class="box">
            <img src="https://via.placeholder.com/400x200" alt="Imagen 2" />
            <h2>Estudio de perfil lipídico</h2>
            <p>
                El estudio de perfil lipídico es una herramienta importante para la evaluación del riesgo cardiovascular. En nuestro laboratorio clínico ofrecemos este estudio que incluye la medición de los niveles de colesterol total, colesterol HDL, colesterol LDL y triglicéridos. Los resultados son interpretados por médicos especialistas y entregados al paciente en un informe completo.
            </p>
        </div>
        <div class="box">
            <img src="https://via.placeholder.com/400x200" alt="Imagen 3" />
            <h2>Estudio de función hepática</h2>
            <p>
                El estudio de función hepática es un conjunto de pruebas que evalúan el funcionamiento del hígado. En nuestro laboratorio clínico ofrecemos este estudio que incluye la medición de enzimas hepáticas, bilirrubina y proteínas. Los resultados son interpretados por médicos especialistas y entregados al paciente en un informe completo.
            </p>
        </div>
        <div class="box">
            <img src="https://via.placeholder.com/400x200" alt="Imagen 4" />
            <h2>Estudio de detección de drogas en orina</h2>
            <p>
                Nuestro laboratorio clínico ofrece un estudio de detección de drogas en orina para empresas y particulares. Realizamos pruebas de detección de una amplia gama de drogas incluyendo cocaína, marihuana, anfetaminas y opiáceos. Los resultados son entregados de manera confidencial al solicitante.
            </p>
        </div>
    </div>
</body>

</html>