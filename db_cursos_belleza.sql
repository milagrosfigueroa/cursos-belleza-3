-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-11-2024 a las 15:52:59
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_cursos_belleza`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `ID_alumno` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `dni` int(11) NOT NULL,
  `celular` bigint(20) NOT NULL,
  `domicilio` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`ID_alumno`, `nombre`, `apellido`, `dni`, `celular`, `domicilio`) VALUES
(1, 'Sofía ', 'Perez', 59123456, 2494635821, 'Las Heras 132'),
(2, 'Nancy ', 'Fernandez', 25963852, 2494785212, 'Pinto 714'),
(3, 'Stella', 'Zubiaurre', 35456985, 2494567154, 'Paz 888'),
(4, 'Pía', 'Hernandez', 40566396, 2494512087, 'Montiel 471'),
(5, 'Lucia', 'Garcia', 46444258, 2494635986, 'Av. Colon 1012'),
(8, 'Delfina ', 'Santillan', 25899741, 2494857694, 'Av. Colon 855'),
(9, 'Luciano', 'Lopez', 39555963, 2494788963, 'Las Heras 189'),
(10, 'Matias', 'Muñoz', 29223105, 2494125639, '25 de mayo 87');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `ID_curso` int(11) NOT NULL,
  `categoria` varchar(45) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(250) NOT NULL,
  `duracion` varchar(45) NOT NULL,
  `profesor` varchar(45) NOT NULL,
  `costo` int(11) NOT NULL,
  `imagen` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`ID_curso`, `categoria`, `nombre`, `descripcion`, `duracion`, `profesor`, `costo`, `imagen`) VALUES
(1, 'maquillaje', 'Maquillaje profesional', 'Curso de automaquilaje profesional: desarrollo de técnicas clave para realzar su belleza natural. Enfoque en la selección de productos, corrección de imperfecciones y creación de looks versátiles, logrando aprender habilidades para un acabado profesi', '3 meses', 'Luisa Hernandez', 90000, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSws-mllklCQJh0HMrRVVpP7U5qPFIn--8J5w&s'),
(3, 'peluqueria', 'Peluquería en general', 'Curso de peluquería general y peinados para eventos: dominación de cortes, peinados y tratamientos capilares. El curso incluye técnicas de coloración y estilizado, permitiendo a los participantes ofrecer un servicio integral y personalizado.', '8 meses', 'María Barbieri', 120000, 'https://e00-elmundo.uecdn.es/assets/multimedia/imagenes/2024/06/28/17195787567286.jpg'),
(4, 'cuidados', 'Tratamientos faciales profesionales', 'Curso de cosmetología: adquirirá conocimientos sobre el cuidado de la piel, técnicas de limpieza facial y tratamientos estéticos. Aprenderá sobre productos cosméticos, su aplicación y personalización, desarrollando habilidades para ofrecer asesoría i', '3 meses', 'Analía Etcheberry', 83000, 'https://www.esteticapalermo.com.ar/wp-content/uploads/2021/08/tratamientos-faciales.webp'),
(15, 'uñas', 'Graciela Lorea', 'Curso de esmaltado semipermanente: aprenderá técnicas de aplicación y retirada de esmalte semipermanente, así como cuidados y mantenimiento de uñas. Desarrollo de habilidades para crear acabados duraderos y profesionales, asegurando la satisfacción d', '6 meses', 'Analia Fernandez', 75000, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.elespectador.com%2Fcromos%2Fmoda%2Funas-semipermanentes-estos-5-disenos-de-unas-son-la-mejor-eleccion-para-tus-manos%2F&psig=AOvVaw0x7czInQslzawkSi8rz7gJ&ust=1729383146168000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCLjci7OUmYkDFQAAAAAdAAAAABAE'),
(16, 'Maquillaje', 'Curso de maquillaje profesional para eventos', ' Curso de automaquilaje profesional: dominación de técnicas especializadas para crear looks impactantes y duraderos, adecuados para bodas, fiestas y sesiones fotográficas. Personalización del maquillaje según la ocasión y las características del clie', '3 meses', 'Marianela Gonzalez', 90000, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fjssfreitesmakeup.com%2Fcomo-dar-un-curso-de-automaquillaje%2F&psig=AOvVaw0EYGbBQ8Bp9cttIiGKGTcO&ust=1729384213935000&source=images&cd=vfe&opi=89978449&ved=0CBQQjRxqFwoTCPjuxrSYmYkDFQAAAAAdAAAAABAE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscriptos`
--

CREATE TABLE `inscriptos` (
  `ID_inscripcion` int(11) NOT NULL,
  `ID_alumno` int(11) NOT NULL,
  `ID_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inscriptos`
--

INSERT INTO `inscriptos` (`ID_inscripcion`, `ID_alumno`, `ID_curso`) VALUES
(1, 2, 4),
(3, 4, 3),
(4, 3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` char(60) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `email`, `password`, `role`) VALUES
(1, 'luciaalcibar@gmail.com', '$2y$10$1/mq1.DjJh/KPVLNpyq7N.ziMx/0T.qGDVVRxfMbcUfjx04Ns9Bs2', 'user'),
(2, 'webadmin', '$2y$10$n9Nzmkn5miBKbGBpcX1hled/OMT3YRGrknde9JOzlt7tVe6KTYCNK', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`ID_alumno`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `numero_de_celular` (`celular`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`ID_curso`);

--
-- Indices de la tabla `inscriptos`
--
ALTER TABLE `inscriptos`
  ADD PRIMARY KEY (`ID_inscripcion`),
  ADD KEY `ID_curso` (`ID_curso`),
  ADD KEY `ID_alumno` (`ID_alumno`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `ID_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `ID_curso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `inscriptos`
--
ALTER TABLE `inscriptos`
  MODIFY `ID_inscripcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscriptos`
--
ALTER TABLE `inscriptos`
  ADD CONSTRAINT `inscriptos_ibfk_1` FOREIGN KEY (`ID_curso`) REFERENCES `cursos` (`ID_curso`),
  ADD CONSTRAINT `inscriptos_ibfk_2` FOREIGN KEY (`ID_alumno`) REFERENCES `alumnos` (`ID_alumno`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
