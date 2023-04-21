--
CREATE DATABASE Laboratorio;

USE Laboratorio;

CREATE TABLE Citas (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50),
  fecha DATE,
  hora TIME,
  telefono VARCHAR(50),
  clave VARCHAR(8) NOT NULL,
  resultados_id INT(11),
  estudio int(11),
  laboratorista_id INT(11),
  PRIMARY KEY (id)
);

CREATE TABLE Resultados (
  id INT(11) NOT NULL AUTO_INCREMENT,
  resultados TEXT NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE Area (
  id INT(11) NOT NULL AUTO_INCREMENT,
  area VARCHAR(50),
  PRIMARY KEY (id)
);

CREATE TABLE Estudio (
  id INT(11) NOT NULL AUTO_INCREMENT,
  estudio VARCHAR(50),
  area_id INT(11),
  PRIMARY KEY (id),
  FOREIGN KEY (area_id) REFERENCES Area(id)
);

CREATE TABLE Recepcionista (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50),
  PRIMARY KEY (id)
);

CREATE TABLE Laboratorista (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50),
  PRIMARY KEY (id)
);

CREATE TABLE Area_Laboratorista (
  laboratorista_id INT(11),
  area_id INT(11),
  FOREIGN KEY (laboratorista_id) REFERENCES Laboratorista(id),
  FOREIGN KEY (area_id) REFERENCES Area(id)
);


ALTER TABLE Citas
ADD FOREIGN KEY (resultados_id) REFERENCES Resultados(id),
ADD FOREIGN KEY (laboratorista_id) REFERENCES Laboratorista(id),
ADD FOREIGN KEY (estudio_id) REFERENCES Estudio(id);

---------------------------------------------------------------------------------------------------------------
