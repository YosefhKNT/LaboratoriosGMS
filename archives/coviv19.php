<!DOCTYPE html>
<html lang="es">

<head>
    <title>GMS | COVID-19</title>
    <link rel="stylesheet" type="text/css" href="../styles/stylesCovid.css">
    <?php include("../Plantillas/head.html");    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <!-- barra de navegacion -->
    <nav>

        <?php include("../Plantillas/nav.html");
        ?>
    </nav>
    <div class="container">
        <div class="image"> <img src="https://th.bing.com/th/id/R.6b769be9ae1e64bb386cf6edc7567972?rik=Fw4IiptsyB4ahg&riu=http%3a%2f%2faustintexas.gov%2fsites%2fdefault%2ffiles%2fCOVID-19gfx_1.png&ehk=bkaKTVEmIBugjQfa08GMxmNF3juAsuZmVMGUdOd1Ymw%3d&risl=&pid=ImgRaw&r=0" alt="Imagen del COVID-19"> </div>
        <main>
            <!-- cards con informacion del covid -->
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="covid col-md-4"> <img src="covid-img\covid19.jpeg" class="covid covid rounded-start" alt="..."> </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">¿Qué es el COVID-19?</h3>
                            <p class="card-text">El COVID-19 es una enfermedad infecciosa provocada por el coronavirus SARS-CoV-2. Se detectó por primera vez en la ciudad de Wuhan, en China, en diciembre de 2019 y se ha convertido en una pandemia global.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="covid col-md-4"> <img src="covid-img\sintomasCoviv19.jpg" class="covid rounded-start" alt="..."> </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Síntomas</h3>
                            <p class="card-text">Los síntomas más comunes son fiebre, tos seca y cansancio. También pueden aparecer otros síntomas como dolor de cabeza, dolor de garganta, pérdida del sentido del olfato o del gusto, y erupciones cutáneas. En algunos casos, la enfermedad puede ser grave y provocar neumonía, fallo de múltiples órganos e incluso la muerte.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="covid col-md-4"> <img src="covid-img\prevencionCovid19.jpg" class="covid rounded-start" alt="..."> </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Prevención</h3>
                            <p class="card-text">La mejor forma de prevenir la propagación del COVID-19 es lavarse las manos con frecuencia, usar mascarilla en lugares públicos, mantener una distancia física de al menos un metro con otras personas y evitar tocarse la cara. También es importante evitar las aglomeraciones y ventilar bien los espacios cerrados.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="covid col-md-4"> <img src="covid-img\tratamientoCovid19.png" class="covid rounded-start" alt="..."> </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Tratamiento</h3>
                            <p class="card-text">No existe un tratamiento específico para el COVID-19, pero los síntomas pueden aliviarse mediante el uso de medicamentos como paracetamol o ibuprofeno. En los casos graves, se pueden necesitar cuidados intensivos.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="covid col-md-4"> <img src="covid-img\vacunasCovid19.jpeg" class="covid rounded-start" alt="..."> </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Vacunas</h3>
                            <p class="card-text">Las vacunas son una herramienta importante para prevenir la propagación del COVID-19. Se han desarrollado diversas vacunas en todo el mundo y se están administrando en muchos países. Es importante seguir las recomendaciones de las autoridades sanitarias sobre la vacunación.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="covid col-md-4"> <img src="covid-img\masInfo.jpg" class="covid rounded-start" alt="..."> </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h3 class="card-title">Información adicional</h3>
                            <p>Para obtener más información sobre el COVID-19, se pueden consultar las siguientes fuentes:</p>
                            <ul>
                                <li class="covid-li"><a href="https://www.who.int/es/emergencies/disease-outbreak-news/item/2020-DON-2019-nCoV-faq-es">Organización Mundial de la Salud</a></li>
                                <li class="covid-li"><a href="https://www.cdc.gov/coronavirus/2019-ncov/index.html">Centros para el Control y la Prevención de Enfermedades</a></li>
                                <li class="covid-li"><a href="https://www.gob.es/coronavirus/">Ministerio de Sanidad</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <footer class="sticky-bottom">
        <p>&copy; 2023, COVID-19</p>
    </footer>
    <script src=" ../bootstrap/js/bootstrap.min.js"> </script> <input type="hidden">
</body>

</html>