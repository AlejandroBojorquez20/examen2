CREATE DATABASE propiedadesVendidas;

CREATE TABLE vendedores (
    id_vendedor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50),
    apellido VARCHAR(50),
    email VARCHAR(100),
    telefono VARCHAR(15)
)

CREATE TABLE propiedades (
    id_propiedad INT PRIMARY KEY AUTO_INCREMENT,
    id_vendedor INT,
    titulo VARCHAR(100),
    direccion VARCHAR(100),
    precio FLOAT,
    tipo VARCHAR(50),
    metrosCuadrados FLOAT,
    descripcion TEXT,
    estado VARCHAR(20) DEFAULT "disponible",
    FOREIGN KEY (id_vendedor) REFERENCES vendedores(id_vendedor)
)

CREATE TABLE ventas (
    id_venta INT PRIMARY KEY AUTO_INCREMENT,
    id_vendedor INT,
    id_propiedad INT,
    fecha_venta DATE,
    FOREIGN KEY (id_vendedor) REFERENCES vendedores(id_vendedor),
    FOREIGN KEY (id_propiedad) REFERENCES propiedades(id_propiedad)
)


INSERT INTO vendedores (nombre, apellido, email, telefono) VALUES
("Angel", "Hernandez", "a.hernandez@gmail.com", "664 167 1290"),
("Javier", "Perez", "j.perez@gmail.com", "664 702 3180");

INSERT INTO propiedades (id_vendedor, titulo, direccion, precio, tipo, metrosCuadrados, descripcion) VALUES
(1, "Casa de dos pisos con vista al mar", "Blvd. Benito Juárez 347, Villa Turistica, 22703 Playas de Rosarito, B.C.", 325000, "Casa", 100, "Casa de dos pisos con vista al mar en Rosarito BC."),
(2, "Apartamento frente al mar", "Escenica Tijuana-Ensenada 300, Reforma, 22710 Playas de Rosarito, B.C.", 422000, "Apartamento", 50, "Apartamento frente al mar en Rosarito BC.")


