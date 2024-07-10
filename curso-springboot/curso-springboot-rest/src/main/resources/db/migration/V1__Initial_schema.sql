-- Tabla de usuarios
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    surname VARCHAR(255),
    mail VARCHAR(50) UNIQUE NOT NULL,
    enabled BOOLEAN,
    rol_id INT,
    FOREIGN KEY (rol_id) REFERENCES rols(id)
);

-- Tabla de roles
CREATE TABLE rols (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255)
);

-- Tabla de permisos
CREATE TABLE permisos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255)
);

-- Tabla de relación entre usuarios y permisos
CREATE TABLE user_permisos (
    user_id INT,
    permisos_id INT,
    PRIMARY KEY (user_id, permisos_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (permisos_id) REFERENCES permisos(id) ON DELETE CASCADE
);