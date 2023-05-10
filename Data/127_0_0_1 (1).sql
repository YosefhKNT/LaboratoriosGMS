-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2023 a las 20:10:51
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laboratorio`
--
CREATE DATABASE IF NOT EXISTS `laboratorio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `laboratorio`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `area` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id`, `area`) VALUES
(1, 'Hematología'),
(2, 'Microbiología'),
(3, 'Inmunología'),
(4, 'Química clínica'),
(5, 'Genética');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area_laboratorista`
--

CREATE TABLE `area_laboratorista` (
  `laboratorista_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `area_laboratorista`
--

INSERT INTO `area_laboratorista` (`laboratorista_id`, `area_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `clave` varchar(8) NOT NULL,
  `resultados_id` int(11) DEFAULT NULL,
  `estudio_id` int(11) DEFAULT NULL,
  `laboratorista_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `nombre`, `fecha`, `hora`, `telefono`, `clave`, `resultados_id`, `estudio_id`, `laboratorista_id`) VALUES
(41, 'José Ramón', '2023-04-28', '09:20:00', '3111234567', 'PmkTbhHB', NULL, 18, 4),
(42, 'Ricardo Perez', '2023-04-28', '09:40:00', '9992227744', '5SP0dEo7', NULL, 10, 2),
(43, 'Angel Jairegui', '2023-04-29', '07:40:00', '3111234567', 'xWN5zs4J', NULL, 19, 4),
(44, 'YosefhKNT', '2023-04-29', '08:00:00', '9992227744', 'a54Tt82Y', NULL, 14, 3),
(45, 'Usuario de Pueba', '2023-04-29', '08:20:00', '9992227744', 'ysZAnRE6', NULL, 18, 4),
(46, 'José Ramón', '2023-04-28', '10:00:00', '3111234567', 'pBxv0DEn', NULL, 15, 3),
(47, 'YosefhKNT', '2023-04-28', '10:20:00', '3111234567', 'qJ70xG1Y', NULL, 17, 4),
(48, 'Angel Jairegui', '2023-04-29', '08:40:00', '3111234567', 'lrPSo69F', NULL, 18, 4),
(49, 'Angel Jairegui', '2023-04-28', '10:40:00', '3113334455', '0pvuY4Xe', NULL, 14, 3),
(50, 'José Ramón', '2023-04-28', '11:00:00', '3111234567', 's69UiQ4P', NULL, 17, 4),
(51, 'YosefhKNT', '2023-04-28', '11:20:00', '3113334455', 'iwBV1N4S', NULL, 19, 4),
(52, 'Paola Alatorre', '2023-04-28', '11:40:00', '3111572896', 'yY3SaKFE', NULL, 14, 3),
(53, 'Paola Alatorre', '2023-04-28', '11:40:00', '3111572896', 'nQu74UHN', NULL, 14, 3),
(55, 'Paola Alatorre', '2023-04-29', '14:20:00', '9992227744', 'j5gMnfeP', 2, 15, 3),
(56, 'Luis Angel Pacheco Ochoa', '2023-04-28', '14:00:00', '3111265724', 'kPAe6Knc', 4, 14, 3),
(57, 'Ricardo Perez', '2023-05-01', '07:00:00', '3111265724', 'ly6pWxaF', NULL, 11, 3),
(58, 'Nicolas Tejeda', '2023-05-05', '13:00:00', '3111265724', '1bZxwkMV', NULL, 8, 2),
(59, 'Jessica Castañeda', '2023-06-06', '12:20:00', '3112564814', 'QD3naBoU', NULL, 3, 1),
(60, 'Jessica Castañeda', '2023-05-10', '07:00:00', '3112564814', 'aV4tIxDz', NULL, 16, 4),
(62, 'Paola Alatorre Quezada', '2023-05-12', '16:40:00', '3310637452', 'zxWTlYwG', NULL, 18, 4),
(63, 'Jessica Castañeda', '2023-05-11', '07:00:00', '3112564814', 'MRkYoVIa', NULL, 19, 4),
(64, 'Jose Ramon', '2023-05-11', '07:20:00', '1234567890', '2DTqbNxS', 3, 14, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE `estudio` (
  `id` int(11) NOT NULL,
  `estudio` varchar(50) DEFAULT NULL,
  `descripcion` text NOT NULL DEFAULT 'Sin Descripcion',
  `ruta_imagen` text NOT NULL DEFAULT 'estudios_img/img1.jpg',
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudio`
--

INSERT INTO `estudio` (`id`, `estudio`, `descripcion`, `ruta_imagen`, `area_id`) VALUES
(1, 'Hemoglobina', 'Sin Descripcion', 'estudios_img/img1.jpg', 1),
(2, 'Recuento de plaquetas', 'Sin Descripcion', 'estudios_img/img2.jpg', 1),
(3, 'Recuento de glóbulos blancos', 'Sin Descripcion', 'estudios_img/img3.jpg', 1),
(4, 'Recuento de glóbulos rojos', 'Sin Descripcion', 'estudios_img/img4.jpg', 1),
(5, 'Coagulación', 'Sin Descripcion', 'estudios_img/img5.jpg', 1),
(6, 'Cultivo de orina', 'Sin Descripcion', 'estudios_img/img6.jpg', 2),
(7, 'Cultivo de heces', 'Sin Descripcion', 'estudios_img/img7.jpg', 2),
(8, 'Cultivo de sangre', 'Sin Descripcion', 'estudios_img/img8.jpg', 2),
(9, 'Cultivo de secreción vaginal', 'Sin Descripcion', 'estudios_img/img9.jpg', 2),
(10, 'Cultivo de líquido cefalorraquídeo', 'Sin Descripcion', 'estudios_img/img10.jpg', 2),
(11, 'Anticuerpos antinucleares', 'Sin Descripcion', 'estudios_img/img11.jpg', 3),
(12, 'Antígeno prostático específico', 'Sin Descripcion', 'estudios_img/img12.*', 3),
(13, 'Prueba de embarazo', 'Sin Descripcion', 'estudios_img/img13.jpg', 3),
(14, 'Prueba de VIH', 'Sin Descripcion', 'estudios_img/img14.jpg', 3),
(15, 'Prueba de hepatitis B', 'Sin Descripcion', 'estudios_img/img15.jpg', 3),
(16, 'Glucosa en sangre', 'Sin Descripcion', 'estudios_img/img16.jpg', 4),
(17, 'Colesterol total', 'Sin Descripcion', 'estudios_img/img17.jpg', 4),
(18, 'Triglicéridos', 'Sin Descripcion', 'estudios_img/img18.jpg', 4),
(19, 'Ácido úrico', 'Sin Descripcion', 'estudios_img/img19.jpg', 4),
(20, 'Creatinina', 'Sin Descripcion', 'estudios_img/img20.jpg', 4),
(21, 'Secuenciación de ADN', 'Sin Descripcion', 'estudios_img/img21.jpg', 5),
(22, 'PCR', 'Sin Descripcion', 'estudios_img/img22.jpg', 5),
(23, 'Microarrays', 'Sin Descripcion', 'estudios_img/img23.jpg', 5),
(24, 'Southern blot', 'Sin Descripcion', 'estudios_img/img24.jpg', 5),
(25, 'Northern blot', 'Sin Descripcion', 'estudios_img/img25.jpg', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorista`
--

CREATE TABLE `laboratorista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `laboratorista`
--

INSERT INTO `laboratorista` (`id`, `nombre`, `password`) VALUES
(1, 'Juan Graxiola ', '12345678'),
(2, 'Alejandra Cisneros', '12345678'),
(3, 'Jose Ramon', '12345678'),
(4, 'Jesus Parra', '12345678'),
(5, 'Angel Jauregui', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recepcionista`
--

CREATE TABLE `recepcionista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `resultados` text NOT NULL DEFAULT 'Sin Resultados'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `resultados`
--

INSERT INTO `resultados` (`id`, `resultados`) VALUES
(1, 'El resultado del estudio clínico PCR para detectar la presencia del virus SARS-CoV-2 en el paciente fue positivo. Se encontró una carga viral de 1.2 x 10^5 copias/ml en la muestra de hisopado nasofaríngeo. El paciente presenta síntomas leves de COVID-19 y se encuentra en aislamiento en su hogar. Se recomienda seguir las medidas de prevención y tratamiento establecidas por las autoridades sanitarias y mantener el seguimiento médico para evaluar la evolución de la enfermedad.\"\r\n\r\nEste resultado indica que el paciente ha sido infectado con el virus SARS-CoV-2 y presenta una carga viral significativa en su sistema respiratorio. La carga viral es una medida de la cantidad de virus presente en una muestra y puede ser útil para evaluar la gravedad de la infección y la probabilidad de transmisión a otras personas. El resultado también indica que el paciente presenta síntomas leves de COVID-19 y se encuentra en aislamiento para evitar la propagación del virus. Se recomienda seguir las medidas de prevención y tratamiento establecidas por las autoridades sanitarias y mantener el seguimiento médico para evaluar la evolución de la enfermedad.'),
(2, 'Cultivo de sangre: positivo para Staphylococcus aureus\r\nEste resultado indica que se ha detectado la presencia de la bacteria Staphylococcus aureus en la muestra de sangre analizada. Staphylococcus aureus es una bacteria que puede causar una variedad de infecciones, desde infecciones leves de la piel hasta infecciones graves del torrente sanguíneo y otros órganos. El tratamiento para una infección por Staphylococcus aureus puede incluir antibióticos específicos y otros tratamientos de apoyo según sea necesario. Es importante tener en cuenta que este es solo un ejemplo de resultado y que los resultados pueden variar según el paciente y la situación clínica.'),
(3, 'Secuenciación de ADN: mutación en el gen BRCA1\r\nEste resultado indica que se ha detectado una mutación en el gen BRCA1 del paciente analizado. El gen BRCA1 es un gen que produce una proteína que ayuda a prevenir el cáncer de mama y de ovario. Las mutaciones en este gen pueden aumentar el riesgo de desarrollar cáncer de mama y de ovario. Dependiendo del tipo de mutación y otros factores, el paciente puede requerir pruebas adicionales, como una mamografía o una resonancia magnética, y puede considerarse una vigilancia más estrecha o incluso una cirugía preventiva. Es importante tener en cuenta que este es solo un ejemplo de resultado y que los resultados pueden variar según el paciente y la situación clínica. Además, es importante interpretar los resultados en el contexto clínico adecuado y con la ayuda de un profesional de la salud capacitado.'),
(4, 'Resultado no reactivo: Esto significa que no se han detectado anticuerpos contra el VIH en la muestra de sangre analizada. Un resultado no reactivo es considerado negativo para el VIH y generalmente se considera que la persona no está infectada con el VIH. Sin embargo, es importante tener en cuenta que los resultados negativos no son concluyentes hasta que hayan pasado al menos tres meses desde la posible exposición al VIH, ya que pueden tardar varias semanas o incluso meses después de la exposición para que los anticuerpos se desarrollen en cantidades detectables en la sangre.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `area_laboratorista`
--
ALTER TABLE `area_laboratorista`
  ADD KEY `laboratorista_id` (`laboratorista_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resultados_id` (`resultados_id`),
  ADD KEY `laboratorista_id` (`laboratorista_id`),
  ADD KEY `estudio_id` (`estudio_id`);

--
-- Indices de la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indices de la tabla `laboratorista`
--
ALTER TABLE `laboratorista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT de la tabla `estudio`
--
ALTER TABLE `estudio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `laboratorista`
--
ALTER TABLE `laboratorista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `recepcionista`
--
ALTER TABLE `recepcionista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area_laboratorista`
--
ALTER TABLE `area_laboratorista`
  ADD CONSTRAINT `area_laboratorista_ibfk_1` FOREIGN KEY (`laboratorista_id`) REFERENCES `laboratorista` (`id`),
  ADD CONSTRAINT `area_laboratorista_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`resultados_id`) REFERENCES `resultados` (`id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`laboratorista_id`) REFERENCES `laboratorista` (`id`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`estudio_id`) REFERENCES `estudio` (`id`);

--
-- Filtros para la tabla `estudio`
--
ALTER TABLE `estudio`
  ADD CONSTRAINT `estudio_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
