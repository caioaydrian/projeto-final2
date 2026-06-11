USE projeto2;

INSERT INTO clientes (nome, telefone, dt_nasc) VALUES
('Ana Souza', '(44) 99871-1122', '1998-05-10'),
('Bruna Lima', '(44) 99755-8899', '1995-08-21'),
('Camila Ferreira', '(44) 99123-4567', '2001-11-03'),
('Daniela Alves', '(44) 98877-6655', '1992-01-15'),
('Eduarda Martins', '(44) 99911-2233', '1999-07-30'),
('Fernanda Rocha', '(44) 99666-7788', '1997-04-18'),
('Gabriela Mendes', '(44) 99222-3344', '2000-12-05'),
('Helena Costa', '(44) 99345-6677', '1994-09-14');

INSERT INTO servico (nome, valor, duracao_estimada) VALUES
('Depilação Virilha', 45.00, '00:30:00'),
('Depilação Buço', 20.00, '00:15:00'),
('Depilação Axila', 30.00, '00:20:00'),
('Depilação Sobrancelha', 25.00, '00:20:00'),

('Esmaltação Pé', 35.00, '00:40:00'),
('Esmaltação Mão', 30.00, '00:35:00'),
('Esmaltação Pé e Mão', 60.00, '01:10:00'),

('Corte de Cabelo', 50.00, '00:50:00'),
('Pintura de Cabelo', 120.00, '02:00:00'),
('Escova', 45.00, '00:45:00');

INSERT INTO agendamento (id_clientes, data, horario, status) VALUES
(1, '2026-06-15', '09:00:00', 'Concluído'),
(2, '2026-06-15', '10:00:00', 'Concluído'),
(3, '2026-06-15', '11:30:00', 'Cancelado'),
(4, '2026-06-16', '13:00:00', 'Agendado'),
(5, '2026-06-16', '14:30:00', 'Concluído'),
(6, '2026-06-17', '09:30:00', 'Agendado'),
(7, '2026-06-17', '15:00:00', 'Concluído'),
(8, '2026-06-18', '16:00:00', 'Agendado');

INSERT INTO servico_agendamento (id_servico, id_agendamento) VALUES

(4, 1),
(6, 1),

(8, 2),

(2, 3),

(9, 4),
(10, 4),

(7, 5),

(1, 6),
(4, 6),

(8, 7),
(10, 7),

(3, 8),
(5, 8);