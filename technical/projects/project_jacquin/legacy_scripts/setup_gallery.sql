-- Script para crear la tabla de la galería y añadir datos de prueba
CREATE TABLE IF NOT EXISTS gallery_media (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL DEFAULT '',
    description TEXT,
    url VARCHAR(500) NOT NULL,
    media_type ENUM('image', 'video', 'pdf') NOT NULL DEFAULT 'image',
    sort_order INT DEFAULT 0,
    active TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Limpiar tabla por si acaso para insertar los de prueba limpios
TRUNCATE TABLE gallery_media;

-- Insertar datos de prueba usando imágenes que ya existen en el proyecto
INSERT INTO
    gallery_media (
        title,
        description,
        url,
        media_type,
        sort_order
    )
VALUES (
        'Estudiantes en presentación',
        'Nuestros mejores talentos en el escenario principal',
        '/assets/images/slider1.jpeg',
        'image',
        1
    ),
    (
        'Clases de Instrumento',
        'Aprendiendo de los maestros de la música',
        '/assets/images/about-img.jpeg',
        'image',
        2
    ),
    (
        'Auditorio principal',
        'Donde la pasión se convierte en arte',
        '/assets/images/hero/hero-banner.jpg',
        'image',
        3
    ),
    (
        'Ensayo de técnica',
        'Preparación y constancia para la excelencia',
        '/assets/images/docente2.jpeg',
        'image',
        4
    ),
    (
        'Presentación especial',
        'Vive la experiencia de ser un artista.',
        '/assets/images/slider2.jpeg',
        'image',
        5
    );