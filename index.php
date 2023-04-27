<!DOCTYPE html>
<html>

<head>
  <title>LabGMS-Inicio</title>
  <link rel="stylesheet" href="styles/stylesIndex.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css" />
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
</head>

<body>
  <nav class="animate__animated animate__fadeInDown">
    <input type="checkbox" name="" id="check">
    <label for="check" class="checkbtn">
      <i class="fas fa-bars"></i>
    </label>
    <a href="index.php" class="enlace">
      <img class="img_logo_gms" src="Images/GMS-Logo.png" alt="GMS-Logo">
    </a>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="archives/estudios.php">Estudios</a></li>
      <li><a href="index.php">Sucursales</a></li>
      <li><a href="index.php">Covid 19</a></li>
      <li><a href="archives/hacerCita.php">Agenda una cita</a></li>
      <li><a href="archives/consultaCita.php">Consulta tu cita</a></li>
    </ul>
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