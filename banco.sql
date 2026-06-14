CREATE DATABASE sistema_biblioteca;
USE sistema_biblioteca;

CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    usuario VARCHAR(50)  NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    perfil VARCHAR(50)  NOT NULL DEFAULT 'aluno'
);

CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(150) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    disponivel TINYINT(1) NOT NULL DEFAULT 1
);

CREATE TABLE emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    livro_id  INT NOT NULL,
    data_emprestimo DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_devolucao DATETIME NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id),
    FOREIGN KEY (livro_id) REFERENCES livros(id)
);

INSERT INTO usuarios (nome, usuario, senha, perfil) VALUES
('Lázaro Tenório','lazaro', 'lazaro123', 'bibliotecário'),
('Lairson Alencar','lairson',  'lairson123', 'professor'),
('Elizabete Silva','elizabete', 'elizabete123', 'aluna');

INSERT INTO livros (titulo, autor) VALUES
('A hora da estrela','Clarice Lispector'),
('Perto do coração selvagem','Clarice Lispector'),
('Água Viva','Clarice Lispector'),
('A Via Crucis do Corpo','Clarice Lispector'),
('A Paixão Segundo G. H','Clarice Lispector'),
('A Maçã no Escuro','Clarice Lispector');
