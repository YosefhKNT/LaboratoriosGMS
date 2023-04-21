-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2023 at 07:49 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratorio`
--
CREATE DATABASE IF NOT EXISTS `laboratorio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `laboratorio`;

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id` int(11) NOT NULL,
  `area` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`id`, `area`) VALUES
(1, 'Hematología'),
(2, 'Microbiología'),
(3, 'Inmunología'),
(4, 'Química clínica'),
(5, 'Genética');

-- --------------------------------------------------------

--
-- Table structure for table `area_laboratorista`
--

CREATE TABLE `area_laboratorista` (
  `laboratorista_id` int(11) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `area_laboratorista`
--

INSERT INTO `area_laboratorista` (`laboratorista_id`, `area_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 4),
(2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `citas`
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
-- Dumping data for table `citas`
--

INSERT INTO `citas` (`id`, `nombre`, `fecha`, `hora`, `telefono`, `clave`, `resultados_id`, `estudio_id`, `laboratorista_id`) VALUES
(2, 'Jose Ramon', '2023-03-30', '12:21:48', '3112114000', '12345678', 1, 22, 2),
(3, 'Adrian Uribe', '2023-03-31', '09:30:30', '3112115000', '12345678', 1, 1, 1),
(16, 'Ricardo Perez', '2023-03-31', '07:00:00', '3111344409', 'P1NagLT6', 2, 13, 1),
(17, 'Ricardo Perez', '2023-04-01', '07:00:00', '1234567890', 'pKiWxO6Y', 2, 19, 1),
(18, 'Nancy Anahi Estrella', '2023-03-31', '07:00:00', '3111572890', 'tW1PqNyA', 3, 22, 2),
(19, 'Nancy Anahi Estrella', '2023-03-31', '07:00:00', '3111572890', '5kwTBVUg', 3, 21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `estudio`
--

CREATE TABLE `estudio` (
  `id` int(11) NOT NULL,
  `estudio` varchar(50) DEFAULT NULL,
  `area_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `estudio`
--

INSERT INTO `estudio` (`id`, `estudio`, `area_id`) VALUES
(1, 'Hemoglobina', 1),
(2, 'Recuento de plaquetas', 1),
(3, 'Recuento de glóbulos blancos', 1),
(4, 'Recuento de glóbulos rojos', 1),
(5, 'Coagulación', 1),
(6, 'Cultivo de orina', 2),
(7, 'Cultivo de heces', 2),
(8, 'Cultivo de sangre', 2),
(9, 'Cultivo de secreción vaginal', 2),
(10, 'Cultivo de líquido cefalorraquídeo', 2),
(11, 'Anticuerpos antinucleares', 3),
(12, 'Antígeno prostático específico', 3),
(13, 'Prueba de embarazo', 3),
(14, 'Prueba de VIH', 3),
(15, 'Prueba de hepatitis B', 3),
(16, 'Glucosa en sangre', 4),
(17, 'Colesterol total', 4),
(18, 'Triglicéridos', 4),
(19, 'Ácido úrico', 4),
(20, 'Creatinina', 4),
(21, 'Secuenciación de ADN', 5),
(22, 'PCR', 5),
(23, 'Microarrays', 5),
(24, 'Southern blot', 5),
(25, 'Northern blot', 5);

-- --------------------------------------------------------

--
-- Table structure for table `laboratorista`
--

CREATE TABLE `laboratorista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `password` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `laboratorista`
--

INSERT INTO `laboratorista` (`id`, `nombre`, `password`) VALUES
(1, 'Juan Graxiola ', '12345678'),
(2, 'Alejandra Cisneros', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `recepcionista`
--

CREATE TABLE `recepcionista` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `resultados`
--

CREATE TABLE `resultados` (
  `id` int(11) NOT NULL,
  `resultados` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resultados`
--

INSERT INTO `resultados` (`id`, `resultados`) VALUES
(1, 'El resultado del estudio clínico PCR para detectar la presencia del virus SARS-CoV-2 en el paciente fue positivo. Se encontró una carga viral de 1.2 x 10^5 copias/ml en la muestra de hisopado nasofaríngeo. El paciente presenta síntomas leves de COVID-19 y se encuentra en aislamiento en su hogar. Se recomienda seguir las medidas de prevención y tratamiento establecidas por las autoridades sanitarias y mantener el seguimiento médico para evaluar la evolución de la enfermedad.\"\r\n\r\nEste resultado indica que el paciente ha sido infectado con el virus SARS-CoV-2 y presenta una carga viral significativa en su sistema respiratorio. La carga viral es una medida de la cantidad de virus presente en una muestra y puede ser útil para evaluar la gravedad de la infección y la probabilidad de transmisión a otras personas. El resultado también indica que el paciente presenta síntomas leves de COVID-19 y se encuentra en aislamiento para evitar la propagación del virus. Se recomienda seguir las medidas de prevención y tratamiento establecidas por las autoridades sanitarias y mantener el seguimiento médico para evaluar la evolución de la enfermedad.'),
(2, 'Cultivo de sangre: positivo para Staphylococcus aureus\r\nEste resultado indica que se ha detectado la presencia de la bacteria Staphylococcus aureus en la muestra de sangre analizada. Staphylococcus aureus es una bacteria que puede causar una variedad de infecciones, desde infecciones leves de la piel hasta infecciones graves del torrente sanguíneo y otros órganos. El tratamiento para una infección por Staphylococcus aureus puede incluir antibióticos específicos y otros tratamientos de apoyo según sea necesario. Es importante tener en cuenta que este es solo un ejemplo de resultado y que los resultados pueden variar según el paciente y la situación clínica.'),
(3, 'Secuenciación de ADN: mutación en el gen BRCA1\r\nEste resultado indica que se ha detectado una mutación en el gen BRCA1 del paciente analizado. El gen BRCA1 es un gen que produce una proteína que ayuda a prevenir el cáncer de mama y de ovario. Las mutaciones en este gen pueden aumentar el riesgo de desarrollar cáncer de mama y de ovario. Dependiendo del tipo de mutación y otros factores, el paciente puede requerir pruebas adicionales, como una mamografía o una resonancia magnética, y puede considerarse una vigilancia más estrecha o incluso una cirugía preventiva. Es importante tener en cuenta que este es solo un ejemplo de resultado y que los resultados pueden variar según el paciente y la situación clínica. Además, es importante interpretar los resultados en el contexto clínico adecuado y con la ayuda de un profesional de la salud capacitado.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area_laboratorista`
--
ALTER TABLE `area_laboratorista`
  ADD KEY `laboratorista_id` (`laboratorista_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `resultados_id` (`resultados_id`),
  ADD KEY `laboratorista_id` (`laboratorista_id`),
  ADD KEY `estudio_id` (`estudio_id`);

--
-- Indexes for table `estudio`
--
ALTER TABLE `estudio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indexes for table `laboratorista`
--
ALTER TABLE `laboratorista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recepcionista`
--
ALTER TABLE `recepcionista`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resultados`
--
ALTER TABLE `resultados`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `estudio`
--
ALTER TABLE `estudio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `laboratorista`
--
ALTER TABLE `laboratorista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recepcionista`
--
ALTER TABLE `recepcionista`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `resultados`
--
ALTER TABLE `resultados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `area_laboratorista`
--
ALTER TABLE `area_laboratorista`
  ADD CONSTRAINT `area_laboratorista_ibfk_1` FOREIGN KEY (`laboratorista_id`) REFERENCES `laboratorista` (`id`),
  ADD CONSTRAINT `area_laboratorista_ibfk_2` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);

--
-- Constraints for table `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`resultados_id`) REFERENCES `resultados` (`id`),
  ADD CONSTRAINT `citas_ibfk_2` FOREIGN KEY (`laboratorista_id`) REFERENCES `laboratorista` (`id`),
  ADD CONSTRAINT `citas_ibfk_3` FOREIGN KEY (`estudio_id`) REFERENCES `estudio` (`id`);

--
-- Constraints for table `estudio`
--
ALTER TABLE `estudio`
  ADD CONSTRAINT `estudio_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `area` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
