/* SE DEBE REGISTRAR ANTES LOS ROLES (admin, usuario) 
    LUEGO UN USUARIO CON EL ROL (admin)*/

-- =============================================
-- TABLA usuario (2 registros)
-- =============================================

/* contraseña de admin: 123456789M
   contraseña de alejandro: 123456789 */
INSERT INTO usuario (id_usu, nom_usu, cla_usu, fky_rol, est_usu) VALUES
(1, 'admin', '$2y$10$OAY4hVe71R.g/MSXBwJMu.Zvh4sUGWTFuK7rDwMZkAjdwziu0yNrq', 1, 'a'),
(2, 'alejandro', '$2y$10$W1LcxLv4mR3f0OKSDf6sKO5SbmslFl4cPTaujQxL6xr6is/Wg7Dy2', 2, 'a');



-- =============================================
-- TABLA patente (11 registros)
-- =============================================
INSERT INTO patente (fec_pat, num_pat, nom_pat, rep_pat, rif_pat, ubi_pat, rub_pat, fky_usu, est_pat) VALUES
('2021-01-05', 1001, 'Panadería Estrella', 'Carlos Mendoza', 'J-10000001-1', 'Av. Bolívar #45', 'Panadería', 1, 'A'),
('2021-02-10', 1002, 'Farmacia Vida Sana', 'Laura Pérez', 'J-10000002-2', 'Calle 10 #12-30', 'Farmacia', 1, 'E'),
('2021-03-15', 1003, 'Supermercado Oasis', 'Roberto Rivas', 'J-10000003-3', 'Urb. El Paraíso', 'Supermercado', 1, 'A'),
('2021-04-20', 1004, 'Taller Mecánico Rápido', 'Jorge Silva', 'J-10000004-4', 'Carrera 5 #78-90', 'Automotriz', 1, 'I'),
('2021-05-25', 1005, 'Café Literario', 'Ana Torres', 'J-10000005-5', 'Plaza Central Local 3', 'Cafetería', 1, 'A'),
('2021-06-30', 1006, 'Óptica Visión Clara', 'Pedro León', 'J-10000006-6', 'Av. Universidad #200', 'Salud', 1, 'A'),
('2021-07-05', 1007, 'Librería Saber', 'Marta Rojas', 'J-10000007-7', 'Calle 8 #15-25', 'Educación', 1, 'I'),
('2021-08-12', 1008, 'Tienda El Ahorro', 'Luisa Fernández', 'J-10000008-8', 'Sector Mercado Municipal', 'Tienda', 1, 'E'),
('2021-09-18', 1009, 'Veterinaria Patitas', 'Diego Herrera', 'J-10000009-9', 'Urb. Los Pinos', 'Veterinaria', 1, 'A'),
('2021-10-22', 1010, 'Ferretería Hercules', 'Andrés Castro', 'J-10000010-0', 'Carrera 3 #44-55', 'Ferretería', 1, 'A'),
('2023-12-15', 1011, 'Gimnasio Energía Total', 'Natalia Guzmán', 'J-10000100-0', 'Av. Deportiva #150', 'Deportes', 1, 'I');

-- =============================================
-- TABLA licencia (11 registros - 1 por patente)
-- =============================================
INSERT INTO licencia (fky_pat, fec_ven, est_lic) VALUES
(1, '2024-06-05', 'V'),
(2, '2023-11-10', 'C'),
(3, '2024-09-15', 'V'),
(4, '2022-12-20', 'C'),
(5, '2024-10-25', 'V'),
(6, '2025-01-30', 'V'),
(7, '2023-05-05', 'C'),
(8, '2024-02-12', 'P'),
(9, '2025-03-18', 'V'),
(10, '2024-07-22', 'V'),
(11, '2024-10-15', 'R');

-- =============================================
-- TABLA solvencia (11 registros - 1 por patente)
-- =============================================
INSERT INTO solvencia (fky_pat, fec_ven, est_sol) VALUES
(1, '2024-05-05', 'V'),
(2, '2023-09-10', 'C'),
(3, '2024-08-15', 'V'),
(4, '2022-10-20', 'C'),
(5, '2024-09-25', 'V'),
(6, '2024-12-30', 'V'),
(7, '2023-03-05', 'C'),
(8, '2024-01-12', 'R'),
(9, '2025-02-18', 'V'),
(10, '2024-06-22', 'V'),
(11, '2024-09-15', 'R');