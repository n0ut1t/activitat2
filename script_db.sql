CREATE DATABASE IF NOT EXISTS rubend;

USE rubend;

create table fotos (
id_foto int not null auto_increment,
    id_usuari int not null,
    titol varchar(20) not null,
    descripcio varchar(50) not null,
    nom_fixer varchar(20) not null,
    ruta_foto text not null,
    data_pujada date not null,
    primary key (id_foto)
);

create table comentaris(
id int not null auto_increment,
    id_foto int not null,
    id_usuari int not null,
    comentari varchar(50) not null,
    data_comentari date not null,
    primary key(id)
);

create table usuaris(
id int not null auto_increment,
    username varchar(10) not null,
    password varchar(30) not null,
    nom varchar(20) not null,
    cognoms varchar(50) not null,
    primary key(id)
);

USE rubend;

-- INSERTS EN LA TABLA USUARIS
INSERT INTO usuaris (username, password, nom, cognoms) VALUES
('ruben10', 'pass1234', 'Rubén', 'Martínez López'),
('maria22', 'mariaPass!', 'María', 'Gómez Pérez'),
('alex99', 'al3x_secure', 'Álex', 'Fernández Ruiz'),
('clara', 'clara_2024', 'Clara', 'Torres Sánchez'),
('juanp', 'juanP@2025', 'Juan', 'Pérez Ortega');

-- INSERTS EN LA TABLA FOTOS
INSERT INTO fotos (id_usuari, titol, descripcio, nom_fixer, ruta_foto, data_pujada) VALUES
(1, 'Amanecer', 'Salida del sol en la montaña', 'amanecer.jpg', 'https://images.unsplash.com/photo-1501785888041-af3ef285b470', '2025-10-01'),
(2, 'Café', 'Mi desayuno favorito cada mañana', 'cafe.jpg', 'https://images.unsplash.com/photo-1511920170033-f8396924c348', '2025-10-02'),
(3, 'Playa', 'Vacaciones en la Costa Brava', 'playa.jpg', 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e', '2025-09-25'),
(1, 'Mi gato', 'Durmiendo como siempre...', 'gato.jpg', 'https://images.unsplash.com/photo-1518791841217-8f162f1e1131', '2025-09-28'),
(4, 'Noche de ciudad', 'Luces y movimiento urbano', 'ciudad.jpg', 'https://images.unsplash.com/photo-1499346030926-9a72daac6c63', '2025-10-03'),
(5, 'Bosque', 'Un paseo tranquilo al atardecer', 'bosque.jpg', 'https://images.unsplash.com/photo-1501785888041-af3ef285b470', '2025-09-20');

-- INSERTS EN LA TABLA COMENTARIS
INSERT INTO comentaris (id_foto, id_usuari, comentari, data_comentari) VALUES
(1, 2, 'Qué vista tan bonita 😍', '2025-10-02'),
(1, 3, 'Me encanta el color del cielo', '2025-10-03'),
(2, 1, 'Ese café se ve delicioso ☕', '2025-10-02'),
(3, 4, 'Quiero ir ahí este verano!', '2025-09-27'),
(4, 5, 'Los gatos son los mejores jaja', '2025-09-29'),
(5, 1, 'Gran foto, parece de película', '2025-10-04'),
(6, 2, 'Qué paz transmite el bosque 🍃', '2025-09-21'),
(3, 5, 'Hermoso lugar, buena foto!', '2025-09-28');

