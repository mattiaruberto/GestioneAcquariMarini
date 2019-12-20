drop database GestioneAcquariMarini;
create database GestioneAcquariMarini;
use GestioneAcquariMarini;

create table utente(
  email varchar(255) primary key not null,
  nome varchar(45),
  cognome varchar(45),
  tipo varchar(45),
  numeroTelefonico varchar(20),
  cambioPassword tinyint(1),
  password varchar(255) not null
  );

create table vasca (
  nome varchar(45) primary key not null,
  calcio INT(11),
  magnesio INT(11),
  kh INT(11),
  `ultimo cambio acqua` DATE,
  Litraggio INT(11)
);
  

CREATE TABLE abitante (
  specie VARCHAR(45),
  genere VARCHAR(15),
  tipo VARCHAR(45),
  nome_vasca VARCHAR(45),
  numero INT(11),
  PRIMARY KEY (specie,genere),
  FOREIGN KEY (nome_vasca) REFERENCES vasca(nome)
);
INSERT INTO utente (email, nome, cognome, tipo, numeroTelefonico, cambioPassword, password) VALUES ('gestioneacquarimarini@gmail.com', 'Administrator', 'Administrator', 'Admin', '+41 79 232 32 33', '1', '$2y$10$V/7rIxZQPzNEnN34KM5u7eIr/e9xAiMuzSw.eMUODEY8cDsxevYYy');