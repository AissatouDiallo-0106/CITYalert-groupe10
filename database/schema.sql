-- ════════════════════════════════════════════════════════════
-- CityAlert — Schéma de base de données (MySQL 8+)
-- ════════════════════════════════════════════════════════════
CREATE DATABASE IF NOT EXISTS cityalert CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE cityalert;

DROP TABLE IF EXISTS status_history;
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS reports;
DROP TABLE IF EXISTS users;

CREATE TABLE users (
    id            INT AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(120) NOT NULL,
    email         VARCHAR(160) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role          ENUM('CITOYEN','AGENT','ADMIN') NOT NULL DEFAULT 'CITOYEN',
    created_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE reports (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(160) NOT NULL,
    description TEXT NOT NULL,
    category    ENUM('VOIRIE','ECLAIRAGE','DECHETS','EAU') NOT NULL,
    address     VARCHAR(255) NOT NULL,
    photo       VARCHAR(255) NULL,
    author_id   INT NOT NULL,
    agent_id    INT NULL,
    status      ENUM('NOUVEAU','EN_COURS','RESOLU','REJETE') NOT NULL DEFAULT 'NOUVEAU',
    created_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_report_author FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_report_agent  FOREIGN KEY (agent_id)  REFERENCES users(id) ON DELETE SET NULL,
    INDEX idx_status (status), INDEX idx_category (category)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE comments (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    report_id  INT NOT NULL,
    author_id  INT NOT NULL,
    body       TEXT NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_comment_report FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE,
    CONSTRAINT fk_comment_author FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE status_history (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    report_id  INT NOT NULL,
    agent_id   INT NULL,
    status     ENUM('NOUVEAU','EN_COURS','RESOLU','REJETE') NOT NULL,
    comment    VARCHAR(255) NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_hist_report FOREIGN KEY (report_id) REFERENCES reports(id) ON DELETE CASCADE,
    CONSTRAINT fk_hist_agent  FOREIGN KEY (agent_id)  REFERENCES users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;