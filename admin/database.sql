CREATE DATABASE IF NOT EXISTS workfolio_admin
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE workfolio_admin;

CREATE TABLE admins (
    id             INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name      VARCHAR(100)  NOT NULL,
    firstname      VARCHAR(50)   NULL,
    lastname       VARCHAR(50)   NULL,
    email          VARCHAR(150)  NOT NULL UNIQUE,
    password_hash  VARCHAR(255)  NOT NULL,
    gender         ENUM('male', 'female', 'other') NULL,
    phone          VARCHAR(30)   NULL,
    skills         TEXT          NULL,
    address        TEXT          NULL,
    profile_image  VARCHAR(255)  NULL,
    created_at     TIMESTAMP     DEFAULT CURRENT_TIMESTAMP,
    updated_at     TIMESTAMP     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;


CREATE TABLE password_resets (
    id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    admin_id    INT UNSIGNED NOT NULL,
    token       VARCHAR(255) NOT NULL,
    expires_at  DATETIME     NOT NULL,
    used        TINYINT(1)   NOT NULL DEFAULT 0,
    created_at  TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_password_resets_admin
        FOREIGN KEY (admin_id) REFERENCES admins(id)
        ON DELETE CASCADE
) ENGINE=InnoDB;


CREATE TABLE categories (
    id    INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(100) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE projects (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id   INT UNSIGNED NULL,
    title         VARCHAR(150) NOT NULL,
    year          VARCHAR(4)   NULL,
    description   TEXT NULL,
    image_path    VARCHAR(255) NULL,
    project_link  VARCHAR(255) NULL,
    created_by    INT UNSIGNED NULL,
    created_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP    DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_projects_category
        FOREIGN KEY (category_id) REFERENCES categories(id)
        ON DELETE SET NULL,
    CONSTRAINT fk_projects_admin
        FOREIGN KEY (created_by) REFERENCES admins(id)
        ON DELETE SET NULL
) ENGINE=InnoDB;

INSERT INTO categories (name) VALUES
    ('Web App'),
    ('Mobile App'),
    ('Branding'),
    ('Design System');

