# CREATE TABLE usuarios (
#                           id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
#                           nombreUsuario VARCHAR(50) NOT NULL UNIQUE,
#                           contraseña VARCHAR(255) NOT NULL,
#                           fechaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
# );

-- 2. Crear base de datos
DROP DATABASE IF EXISTS pokedex;
CREATE DATABASE pokedex CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- 3. Crear usuario
CREATE USER 'pokedex_user'@'localhost' IDENTIFIED BY 'pokedex123';

-- 4. Otorgar permisos
GRANT ALL PRIVILEGES ON pokedex.* TO 'pokedex_user'@'localhost';
FLUSH PRIVILEGES;

-- 5. Usar base de datos
USE pokedex;

-- 6. Crear tabla de usuarios
CREATE TABLE usuarios (
                          id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                          nombreUsuario VARCHAR(50) NOT NULL UNIQUE,
                          contraseña VARCHAR(255) NOT NULL,
                          fechaCreacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 7. Insertar un usuario de prueba (con contraseña hasheada)
INSERT INTO usuarios (nombreUsuario, contraseña) VALUES (
                                                            'admin',
                                                            'admin123'
                                                        );
-- La contraseña de este usuario es: admin123