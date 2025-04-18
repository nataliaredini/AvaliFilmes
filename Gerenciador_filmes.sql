
CREATE TABLE IF NOT EXISTS usuarios ( idUsuario INT AUTO_INCREMENT PRIMARY KEY, nome VARCHAR(100) NOT NULL, login VARCHAR(50) NOT NULL UNIQUE, senha VARCHAR(255) NOT NULL );
INSERT INTO usuarios (nome, login, senha) VALUES
('João Silva', 'joao.silva', 'senha123'),
('Maria Oliveira', 'maria.oliveira', 'senha456'),
('Pedro Santos', 'pedro.santos', 'senha789');

CREATE TABLE IF NOT EXISTS filmes ( idFilme INT AUTO_INCREMENT PRIMARY KEY, titulo VARCHAR(200) NOT NULL, diretor VARCHAR(100) NOT NULL, anoLancamento INT NOT NULL, genero VARCHAR(50) NOT NULL, nota DECIMAL(2, 1) CHECK (nota >= 0 AND nota <= 10), comentario TEXT, codigoUsuario INT, FOREIGN KEY (codigoUsuario) REFERENCES usuarios(idUsuario) );

INSERT INTO usuarios (nome, login, senha) VALUES ('João Silva', 'joao.silva', 'senha123'), ('Maria Oliveira', 'maria.oliveira', 'senha456'), ('Pedro Santos', 'pedro.santos', 'senha789');




-- Inserção de filmes para o usuário João Silva (idUsuario = 1)
INSERT INTO filmes (titulo, diretor, anoLancamento, genero, nota, comentario, codigoUsuario) VALUES
('A Aventura Começa', 'Carlos Mendes', 2020, 'Ação', 8.5, 'Filme emocionante!', 1),
('O Mistério do Lago', 'Ana Paula', 2021, 'Mistério', 7.0, 'Muito intrigante.', 1);

-- Inserção de filmes para a usuária Maria Oliveira (idUsuario = 2)
INSERT INTO filmes (titulo, diretor, anoLancamento, genero, nota, comentario, codigoUsuario) VALUES
('Noites de Verão', 'Fernando Costa', 2019, 'Romance', 9.0, 'Uma história linda!', 2),
('O Último Guerreiro', 'Juliana Lima', 2022, 'Ação', 8.0, 'Ação do começo ao fim.', 2);

-- Inserção de filmes para o usuário Pedro Santos (idUsuario = 3)
INSERT INTO filmes (titulo, diretor, anoLancamento, genero, nota, comentario, codigoUsuario) VALUES
('Comédia da Vida', 'Ricardo Almeida', 2021, 'Comédia', 7.5, 'Divertido e leve.', 3),
('A Jornada', 'Sofia Martins', 2023, 'Drama', 8.8, 'Muito tocante.', 3);
