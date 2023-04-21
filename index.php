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
      <img class="img_logo_gms" src="Images\GMS-Logo.png" alt="GMS-Logo">
    </a>
    <ul>
      <li><a href="index.php">Inicio</a></li>
      <li><a href="index.php">Estudios</a></li>
      <li><a href="index.php">Sucursales</a></li>
      <li><a href="index.php">Covid 19</a></li>
      <li><a href="hacerCita.php">Agenda una cita</a></li>
      <li><a href="consultaCita.php">Consulta tu cita</a></li>
    </ul>
  </nav>

  <div class="container" onload="document.body.classList.add('animate__animated', 'animate__fadeInDown');">
    <div class="box">
      <img src="https://via.placeholder.com/400x200" alt="Imagen 1" />
      <h2>Titulo 1</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam
        vulputate libero nec est lacinia consequat. Sed maximus pharetra urna,
        eget commodo nulla tincidunt vel. Fusce nec enim ex. Integer bibendum
        quis dolor eget blandit. Sed in tellus sem. Nunc molestie nisi at arcu
        euismod, a fringilla mauris finibus.
      </p>
    </div>
    <div class="box">
      <img src="https://via.placeholder.com/400x200" alt="Imagen 2" />
      <h2>Titulo 2</h2>
      <p>
        Curabitur blandit nisl euismod libero eleifend, quis laoreet risus
        suscipit. Aliquam erat volutpat. Nullam dignissim posuere ex eu
        dignissim. Etiam auctor, velit in dapibus venenatis, mi augue viverra
        leo, ut congue augue lectus in lacus.
      </p>
    </div>
    <div class="box">
      <img src="https://via.placeholder.com/400x200" alt="Imagen 3" />
      <h2>Titulo 3</h2>
      <p>
        Donec sagittis libero non erat ullamcorper, in viverra felis dictum.
        Mauris dapibus, nibh sed ullamcorper rhoncus, dui libero fringilla
        dolor, vel auctor enim velit eu enim. Pellentesque id nunc non leo
        consectetur egestas.
      </p>
    </div>
    <div class="box">
      <img src="https://via.placeholder.com/400x200" alt="Imagen 4" />
      <h2>Titulo 4</h2>
      <p>
        Proin lacinia imperdiet enim, vel lacinia elit aliquam eu. Phasellus
        id enim nisi. Nulla vel neque in enim sagittis vulputate a id elit.
        Curabitur consequat vel risus ac blandit. Aliquam ac felis quis risus
        malesuada suscipit. Nam a convallis nulla.
      </p>
    </div>
  </div>
</body>

</html>