CREATE DATABASE IF NOT EXISTS revision_hq;
USE revision_hq;

-- Users table
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(255) UNIQUE NOT NULL,
    name VARCHAR(255) NOT NULL,
    picture TEXT,
    theme ENUM('light', 'dark') DEFAULT 'light',
    wallpaper TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Subjects table
CREATE TABLE subjects (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) UNIQUE NOT NULL,
    icon VARCHAR(50) DEFAULT 'fas fa-book',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tasks table
CREATE TABLE tasks (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    completed BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Notes table
CREATE TABLE notes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    type ENUM('quick', 'subject') DEFAULT 'quick',
    content LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert default subjects
INSERT INTO subjects (name, icon, description) VALUES
('Computing', 'fas fa-laptop-code', 'Programming and computer science'),
('History & Social Studies', 'fas fa-landmark', 'Historical events and society'),
('Chemistry & Physics', 'fas fa-atom', 'Sciences and experiments'),
('English', 'fas fa-book-open', 'Language and literature'),
('Chinese', 'fas fa-language', 'Chinese language studies'),
('Math', 'fas fa-calculator', 'Mathematics and algebra'),
('A-Math', 'fas fa-square-root-alt', 'Advanced mathematics'),
('Electronics', 'fas fa-microchip', 'Electronic circuits and components');
    type ENUM('quick', 'subject', 'general') DEFAULT 'general',
    title VARCHAR(255),
    content LONGTEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE SET NULL
);

-- Files table
CREATE TABLE files (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    subject_id INT,
    filename VARCHAR(255) NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    file_size INT,
    mime_type VARCHAR(100),
    category VARCHAR(100),
    description TEXT,
    tags TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE SET NULL
);

-- Flashcards table
CREATE TABLE flashcards (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    subject_id INT,
    deck_name VARCHAR(255) NOT NULL,
    question TEXT NOT NULL,
    answer TEXT NOT NULL,
    difficulty ENUM('easy', 'medium', 'hard') DEFAULT 'medium',
    last_reviewed TIMESTAMP NULL,
    review_count INT DEFAULT 0,
    correct_count INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE SET NULL
);

-- Wallpapers table
CREATE TABLE wallpapers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    filename VARCHAR(255) NOT NULL,
    original_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    url VARCHAR(500) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Insert default subjects
INSERT INTO subjects (name, icon, description) VALUES
('Computing', 'fas fa-laptop-code', 'Programming and computer science'),
('History & Social Studies', 'fas fa-landmark', 'Historical events and society'),
('Chemistry & Physics', 'fas fa-atom', 'Sciences and experiments'),
('English', 'fas fa-book-open', 'Language and literature'),
('Chinese', 'fas fa-language', 'Chinese language studies'),
('Math', 'fas fa-calculator', 'Mathematics and algebra'),
('A-Math', 'fas fa-square-root-alt', 'Advanced mathematics'),
('Electronics', 'fas fa-microchip', 'Electronic circuits and components');
