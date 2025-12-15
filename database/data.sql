
USE adiasoft2025;

INSERT INTO roles (nombre, descripcion) VALUES
('Administrador', 'Acceso total al sistema'),
('Vendedor', 'Gestiona ventas y clientes'),
('Almacenero', 'Gestiona inventario y productos'),
('Supervisor', 'Supervisa actividades del sistema'),
('Tecnico', 'Brinda soporte técnico interno'),
('Invitado', 'Acceso limitado de solo lectura');

INSERT INTO usuarios (username, password_hash, documento, nombres, apellidos, email, telefono) VALUES
('admin', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74839201', 'Carlos Alberto', 'Gómez Salazar', 'carlos.gomez@adiasoft.com', '986541230'),
('mgutierrez', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72649182', 'María Fernanda', 'Gutiérrez Pinto', 'maria.gp@adiasoft.com', '987321540'),
('jramirez', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '70328410', 'José Luis', 'Ramírez Huamán', 'jose.rh@adiasoft.com', '965412387'),
('lquiroz', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74562381', 'Lucía Alejandra', 'Quiroz Medina', 'lucia.quiroz@adiasoft.com', '951234766'),
('dvaldivia', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '78123455', 'Diego Armando', 'Valdivia Soto', 'diego.valdivia@adiasoft.com', '941256870'),
('rhuamani', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '71324985', 'Rodrigo Manuel', 'Huamani Aedo', 'rodrigo.huamani@adiasoft.com', '954123687'),
('jlopez', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '73241578', 'Javier', 'López Rivera', 'javier.lopez@adiasoft.com', '987564210'),
('sofia.m', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72564391', 'Sofía', 'Martínez Ramos', 'sofia.mr@adiasoft.com', '912345678'),
('karen.p', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74891236', 'Karen', 'Paredes Flores', 'karen.pf@adiasoft.com', '965478321'),
('marco.t', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '71928364', 'Marco Antonio', 'Tito Aguilar', 'marco.tito@adiasoft.com', '998761234'),
('fserrano', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '71823490', 'Fernando', 'Serrano Paz', 'fernando.serrano@adiasoft.com', '922341780'),
('brenda.q', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '70234918', 'Brenda', 'Quispe Lazo', 'brenda.quispe@adiasoft.com', '987654310'),
('ricardo.m', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '73829164', 'Ricardo', 'Mamani Choque', 'ricardo.mc@adiasoft.com', '988123456'),
('alejandra.h', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '79234120', 'Alejandra', 'Huamán Torres', 'ale.huaman@adiasoft.com', '952347810'),
('camila.v', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '78123094', 'Camila', 'Vargas Cárdenas', 'camila.v@adiasoft.com', '986543218'),
('andres.r', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '75643091', 'Andrés', 'Ríos Medina', 'andres.rios@adiasoft.com', '945612308'),
('jessica.p', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '70491382', 'Jéssica', 'Puma Huanca', 'jessica.p@adiasoft.com', '934568721'),
('juanr', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72659012', 'Juan', 'Rojas Núñez', 'juan.rojas@adiasoft.com', '987650432'),
('melissa.s', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '78541236', 'Melissa', 'Silva Torres', 'melissa.silva@adiasoft.com', '912458760'),
('alvaro.c', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '71589324', 'Álvaro', 'Cárdenas Flores', 'alvaro.cf@adiasoft.com', '923456781'),
('pablo.r', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74851230', 'Pablo', 'Rivas Lozano', 'pablo.rivas@adiasoft.com', '987001234'),
('susana.h', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '73658920', 'Susana', 'Huarcaya Álvarez', 'susana.h@adiasoft.com', '923780451'),
('oscar.d', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72834910', 'Óscar', 'Durán Pérez', 'oscar.duran@adiasoft.com', '951780234'),
('valeria.p', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '71204598', 'Valeria', 'Puma Salas', 'valeria.ps@adiasoft.com', '941258763'),
('fabiola.m', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '78931254', 'Fabiola', 'Mendoza Chura', 'fabiola.mc@adiasoft.com', '987651230'),
('renato.s', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72560193', 'Renato', 'Salas Mejía', 'renato.salas@adiasoft.com', '987412365'),
('dayana.l', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '78451263', 'Dayana', 'López Ponce', 'dayana.lp@adiasoft.com', '954123760'),
('german.v', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74123658', 'Germán', 'Vilca Chambi', 'german.vc@adiasoft.com', '963214587'),
('roxana.t', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72345109', 'Roxana', 'Torres Valdez', 'roxana.tv@adiasoft.com', '912367894'),
('cesar.m', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74892015', 'César', 'Mamani Lima', 'cesar.ml@adiasoft.com', '983457210'),
('edwin.f', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '78231094', 'Edwin', 'Farfán Ccama', 'edwin.fc@adiasoft.com', '998761230'),
('romina.z', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '71928301', 'Romina', 'Zegarra León', 'romina.zl@adiasoft.com', '987000213'),
('martin.c', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '70456823', 'Martín', 'Castillo Torres', 'martin.ct@adiasoft.com', '989345120'),
('paola.a', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74812930', 'Paola', 'Acuña Díaz', 'paola.ad@adiasoft.com', '954780123'),
('victor.p', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '74981236', 'Víctor', 'Ponce Huarca', 'victor.ph@adiasoft.com', '998345120'),
('rosario.m', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72769014', 'Rosario', 'Mamani Choque', 'rosario.mc@adiasoft.com', '932450981'),
('carlos.v', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '75823910', 'Carlos', 'Vera Huerta', 'carlos.vera@adiasoft.com', '963210548'),
('manuel.d', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '78456302', 'Manuel', 'Dávalos Cuno', 'manuel.dc@adiasoft.com', '987412300'),
('leslie.r', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '72349810', 'Leslie', 'Ramos Flores', 'leslie.rf@adiasoft.com', '954678321'),
('alexis.h', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '79123468', 'Alexis', 'Huillca Peña', 'alexis.hp@adiasoft.com', '981236547');

INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES
(1, 1), (2, 2), (3, 2), (4, 2), (5, 2), (6, 2), (7, 2), (8, 2), (9, 2), (10, 2),
(11, 2), (12, 2), (13, 2), (14, 2), (15, 2),
(16, 3), (17, 3), (18, 3), (19, 3), (20, 3),
(21, 3), (22, 3), (23, 3), (24, 3), (25, 3),
(26, 4), (27, 4), (28, 4), (29, 4), (30, 4),
(31, 4), (32, 4), (33, 4), (34, 4), (35, 4),
(36, 5), (37, 5), (38, 5), (39, 5), (40, 5);

INSERT INTO categorias (nombre, descripcion) VALUES
('Laptops', 'Equipos portátiles para trabajo y estudio'),
('Computadoras de Escritorio', 'PC armadas y preensambladas'),
('Monitores', 'Pantallas LED y LCD'),
('Teclados', 'Teclados mecánicos y de membrana'),
('Mouses', 'Ratones inalámbricos y cableados'),
('Almacenamiento', 'Discos duros, SSD y memorias USB'),
('Componentes', 'Procesadores, RAM, placas madre, tarjetas de video'),
('Impresoras', 'Impresoras láser e inkjet'),
('Redes', 'Routers, switches, tarjetas de red'),
('Audio', 'Audífonos, parlantes, micrófonos'),
('Accesorios', 'Pads, cables, soportes, mochilas'),
('Sillas Gamer', 'Sillas ergonómicas para gaming');

INSERT INTO productos (id_categoria, nombre, descripcion, precio, estado) VALUES
(1, 'Laptop HP 250 G8', 'Intel i5, 8GB RAM, 256GB SSD', 1999.90, 1),
(1, 'Laptop Lenovo IdeaPad 3', 'Ryzen 5, 8GB RAM, 512GB SSD', 2299.90, 1),
(1, 'Laptop ASUS VivoBook', 'Intel i7, 16GB RAM, 512GB SSD', 3499.00, 1),
(1, 'Laptop Acer Aspire 5', 'Intel i3, 8GB RAM, 256GB SSD', 1599.00, 1),
(2, 'PC Gamer Ryzen 5 5600G', '16GB RAM, 512GB SSD', 2899.90, 1),
(2, 'PC Intel Core i5 10400F', '16GB RAM, GTX 1650', 3299.00, 1),
(2, 'PC Oficina Dell Optiplex', '8GB RAM, 256GB SSD', 1599.00, 1),
(2, 'PC Gamer Core i7 10700F', 'RTX 3060, 16GB RAM', 5599.00, 1),
(3, 'Monitor Samsung 24"', 'IPS, 75Hz, Full HD', 599.00, 1),
(3, 'Monitor LG 27"', 'IPS, 144Hz, QHD', 1199.00, 1),
(3, 'Monitor AOC 22"', 'LED, Full HD', 399.00, 1),
(3, 'Monitor HP 24F', 'IPS, Full HD', 699.00, 1),
(4, 'Teclado Logitech K120', 'Teclado básico USB', 29.90, 1),
(4, 'Teclado Redragon Kumara', 'Mecánico RGB', 159.00, 1),
(4, 'Teclado Razer BlackWidow', 'Mecánico gamer', 399.00, 1),
(4, 'Teclado Genius Smart', 'Membrana silencioso', 39.90, 1),
(5, 'Mouse Logitech M170', 'Inalámbrico', 39.90, 1),
(5, 'Mouse Redragon Griffin', 'RGB gamer', 89.00, 1),
(5, 'Mouse Razer Viper Mini', 'Gamer ultraligero', 149.00, 1),
(5, 'Mouse HP X200', 'Inalámbrico', 49.90, 1),
(6, 'SSD Kingston 240GB', 'A400 2.5"', 129.00, 1),
(6, 'SSD Samsung EVO 500GB', 'NVMe M.2', 299.00, 1),
(6, 'HDD Seagate 1TB', '3.5" SATA', 179.00, 1),
(6, 'USB Kingston 64GB', 'DT Exodia', 29.00, 1),
(7, 'Memoria RAM 8GB DDR4', 'Crucial 2666MHz', 89.00, 1),
(7, 'Memoria RAM 16GB DDR4', 'Corsair 3200MHz', 159.00, 1),
(7, 'Procesador Ryzen 5 5600X', '12 hilos, 4.4GHz', 899.00, 1),
(7, 'Tarjeta Madre ASUS B450', 'AM4', 459.00, 1),
(8, 'Impresora Epson L3250', 'EcoTank inalámbrica', 899.00, 1),
(8, 'Impresora HP LaserJet 107w', 'Láser monocromática', 599.00, 1),
(8, 'Impresora Canon G3110', 'Multifuncional', 699.00, 1),
(8, 'Impresora Brother HL-L2320D', 'Dúplex automático', 650.00, 1),
(9, 'Router TP-Link Archer C6', '1200Mbps', 139.00, 1),
(9, 'Switch TP-Link 8 Puertos', 'Gigabit', 99.00, 1),
(9, 'Adaptador WiFi USB', '300Mbps', 35.00, 1),
(9, 'Router Huawei AX3', 'WiFi 6', 199.00, 1),
(10, 'Audífonos Logitech H111', 'Alámbricos', 39.00, 1),
(10, 'Micrófono Fifine K669', 'USB', 179.00, 1),
(10, 'Parlantes Logitech Z200', '10W', 129.00, 1),
(10, 'Audífonos HyperX Cloud II', 'Gamer', 399.00, 1),
(11, 'Mouse Pad Grande RGB', 'XL', 59.00, 1),
(11, 'Cable HDMI 2.0 2m', 'Alta velocidad', 25.00, 1),
(11, 'Soporte para Laptop', 'Metálico plegable', 49.00, 1),
(11, 'Mochila Targus', 'Para laptop de 15.6"', 99.00, 1),
(12, 'Silla Gamer DXRacer', 'Ergonómica premium', 999.00, 1),
(12, 'Silla Gamer Redragon', 'Respaldo alto', 699.00, 1),
(12, 'Silla Ergonómica Mesh', 'Apoyo lumbar', 359.00, 1),
(12, 'Silla Gamer HyperX', 'Con cojines', 849.00, 1);

INSERT INTO inventario (id_producto, stock_actual) VALUES
(1, 5),
(2, 5),
(3, 3),
(4, 5),
(5, 3),
(6, 2),
(7, 5),
(8, 2),
(9, 10),
(10, 5),
(11, 8),
(12, 6),
(13, 10),
(14, 5),
(15, 2),
(16, 10),
(17, 10),
(18, 5),
(19, 3),
(20, 8),
(21, 10),
(22, 8),
(23, 6),
(24, 20),
(25, 10),
(26, 5),
(27, 2),
(28, 2),
(29, 3),
(30, 3),
(31, 3),
(32, 3),
(33, 10),
(34, 8),
(35, 10),
(36, 5),
(37, 20),
(38, 5),
(39, 10),
(40, 3),
(41, 10),
(42, 20),
(43, 15),
(44, 5),
(45, 2),
(46, 3),
(47, 5),
(48, 2);

INSERT INTO proveedores (nombre, ruc, telefono, email, direccion) VALUES
('Deltron S.A.', '20100070970', '014235678', 'contacto@deltron.com.pe', 'Av. Venezuela 1580, Lima'),
('Memory Kings', '20538765941', '014567890', 'ventas@memorykings.com.pe', 'Av. Wilson 1234, Lima'),
('Infotec Perú', '20457812390', '014678345', 'info@infotec.com.pe', 'Av. Universitaria 345, Lima'),
('Yamoshi Computers', '20657823451', '014789321', 'ventas@yamoshi.com.pe', 'Av. Ejército 502, Arequipa'),
('Impacto Tecnología', '20567483920', '014678912', 'ventas@impacto.pe', 'Av. Garcilaso 140, Cusco'),
('Tecnosys Perú', '20123456789', '012345678', 'contacto@tecnosys.pe', 'Av. Grau 456, Lima'),
('Compuvision', '20678934512', '017895621', 'ventas@compuvision.pe', 'Jr. Puno 140, Lima'),
('PC Link', '20598734120', '017856439', 'info@pclink.pe', 'Av. Arequipa 410, Lima'),
('TecnoWorld', '20634567812', '017563412', 'contacto@tecnoworld.pe', 'Av. Mariscal 450, Trujillo'),
('Computronic', '20576543821', '016754321', 'ventas@computronic.pe', 'Av. La Marina 1300, Lima'),
('TechMaster', '20599867231', '016732167', 'contacto@techmaster.pe', 'Av. Salaverry 540, Lima'),
('CompuMarket', '20687432210', '016542317', 'ventas@compumarket.pe', 'Av. Los Incas 245, Cusco'),
('DigitalStore', '20561347821', '016321765', 'info@digitalstore.pe', 'Av. América Sur 980, Trujillo'),
('Infosec Perú', '20612354987', '016789543', 'contacto@infosec.pe', 'Av. Ejército 430, Arequipa'),
('TechImport', '20698712345', '016701234', 'ventas@techimport.pe', 'Av. Javier Prado 760, Lima'),
('PC Perú', '20677123412', '016789310', 'ventas@pcperu.pe', 'Av. La Cultura 300, Cusco'),
('HardTech', '20612398467', '016732589', 'ventas@hardtech.pe', 'Calle Mercaderes 100, Arequipa'),
('MegaTech', '20589321045', '016712349', 'info@megatech.pe', 'Av. Angamos 120, Lima'),
('ElectroPerú', '20700321459', '016789650', 'ventas@electroperu.pe', 'Av. Arequipa 650, Lima'),
('TecnoRed', '20560781234', '016789001', 'info@tecnored.pe', 'Av. Brasil 321, Lima'),
('RedSys', '20655123477', '015678923', 'contacto@redsys.pe', 'Av. Salaverry 900, Lima'),
('SysTech', '20567123984', '015678203', 'info@systech.pe', 'Av. América Norte 421, Trujillo'),
('PeruPC', '20681234981', '015612387', 'ventas@perupc.pe', 'Av. Dolores 410, Arequipa'),
('MicroDigital', '20567123411', '015632178', 'info@microdigital.pe', 'Av. Grau 1200, Lima'),
('HyperTech', '20677234987', '015684210', 'ventas@hypertech.pe', 'Av. Aviación 450, Lima'),
('CompuStar', '20589237466', '015617849', 'info@compustar.pe', 'Av. Pardo 300, Cusco'),
('CompuShop', '20689127845', '015789342', 'ventas@compushop.pe', 'Av. Independencia 890, Lima'),
('DigitalPro', '20700123458', '015789120', 'contacto@digitalpro.pe', 'Av. Miraflores 123, Arequipa'),
('TechGlobal', '20567892341', '015678439', 'info@techglobal.pe', 'Av. Los Próceres 801, Lima'),
('InfoTech', '20567891245', '015789634', 'ventas@infotech.pe', 'Av. La Marina 500, Lima'),
('TecnoPlus', '20656789123', '015789226', 'info@tecnoplus.pe', 'Av. España 320, Trujillo'),
('ByteCenter', '20589912345', '015786432', 'ventas@bytecenter.pe', 'Av. Kennedy 540, Arequipa'),
('CompuMega', '20651234987', '015786941', 'info@compumega.pe', 'Av. Angamos 403, Lima'),
('GigaStore', '20699872145', '015764839', 'ventas@gigastore.pe', 'Av. Brasil 201, Lima'),
('Digital Perú', '20567834129', '015786420', 'contacto@digitalperu.pe', 'Av. Miraflores 750, Trujillo'),
('PowerTech', '20634598231', '015678901', 'ventas@powertech.pe', 'Av. Kennedy 630, Arequipa'),
('MasterPC', '20700672145', '015623874', 'info@masterpc.pe', 'Av. Alfonso Ugarte 500, Lima'),
('Infotech Solutions', '20567891022', '015678221', 'ventas@infotechsolutions.pe', 'Av. Tacna 120, Lima'),
('SoftHardware', '20678912045', '015612309', 'info@softhardware.pe', 'Av. Perú 340, Lima'),
('TecnoVision', '20567129847', '015678145', 'ventas@tecnovision.pe', 'Av. Dolores 500, Arequipa'),
('PeruDigital', '20678123901', '015789554', 'contacto@perudigital.pe', 'Av. Mansiche 432, Trujillo'),
('TecnoByte', '20689127345', '015789211', 'info@tecnobyte.pe', 'Av. Pardo 251, Cusco'),
('MegaStore', '20700123981', '015789010', 'ventas@megastore.pe', 'Av. Universitaria 327, Lima'),
('DigitalMax', '20655532110', '015789221', 'ventas@digitalmax.pe', 'Av. España 900, Trujillo'),
('PC Global', '20578932104', '015789991', 'contacto@pcglobal.pe', 'Av. Lima 780, Arequipa'),
('TecHardware', '20655567812', '015789662', 'ventas@techardware.pe', 'Av. Las Begonias 401, Lima'),
('Electronix', '20578912455', '015789777', 'info@electronix.pe', 'Av. Miraflores 901, Trujillo'),
('MegaDigital', '20667823149', '015753109', 'ventas@megadigital.pe', 'Av. Ejército 511, Arequipa'),
('TecnoWare', '20578934511', '015789500', 'info@tecnoware.pe', 'Av. Angamos 310, Lima');

INSERT INTO compras (id_proveedor, id_usuario, total) VALUES
(1, 1, 0.00),
(2, 3, 0.00),
(3, 5, 0.00),
(4, 2, 0.00),
(5, 4, 0.00),
(6, 7, 0.00),
(7, 10, 0.00),
(8, 8, 0.00),
(9, 6, 0.00),
(10, 9, 0.00),
(11, 3, 0.00),
(12, 4, 0.00),
(13, 2, 0.00),
(14, 6, 0.00),
(15, 1, 0.00),
(16, 5, 0.00),
(17, 9, 0.00),
(18, 7, 0.00),
(19, 10, 0.00),
(20, 3, 0.00),
(21, 1, 0.00),
(22, 4, 0.00),
(23, 8, 0.00),
(24, 6, 0.00),
(25, 7, 0.00);

INSERT INTO detalle_compra (id_compra, id_producto, cantidad, precio, subtotal) VALUES
(1, 3, 3, 3499.00, 10497.00),
(1, 14, 5, 159.00, 795.00),
(2, 1, 4, 1999.90, 7999.60),
(2, 9, 6, 599.00, 3594.00),
(3, 7, 5, 1599.00, 7995.00),
(3, 23, 6, 130.00, 780.00),
(4, 10, 4, 1199.00, 4796.00),
(4, 17, 8, 89.00, 712.00),
(5, 5, 3, 2899.90, 8699.70),
(5, 26, 10, 179.00, 1790.00),
(6, 2, 3, 2299.90, 6899.70),
(6, 11, 8, 399.00, 3192.00),
(7, 8, 4, 5599.00, 22396.00),
(7, 13, 10, 29.90, 299.00),
(8, 4, 6, 1599.00, 9594.00),
(8, 29, 8, 209.00, 1672.00),
(9, 15, 7, 89.00, 623.00),
(9, 21, 10, 25.00, 250.00),
(9, 33, 10, 129.00, 1290.00),
(10, 6, 4, 3299.00, 13196.00),
(10, 24, 20, 29.00, 580.00),
(11, 12, 6, 699.00, 4194.00),
(11, 41, 10, 35.00, 350.00),
(12, 3, 3, 3499.00, 10497.00),
(12, 44, 8, 39.00, 312.00),
(13, 5, 4, 2899.90, 11599.60),
(13, 18, 6, 30.00, 180.00),
(14, 22, 10, 30.00, 300.00),
(14, 37, 8, 59.00, 472.00),
(15, 2, 4, 2299.90, 9199.60),
(15, 13, 10, 29.90, 299.00),
(16, 7, 6, 1599.00, 9594.00),
(16, 30, 10, 250.00, 2500.00),
(17, 8, 3, 5599.00, 16797.00),
(17, 18, 10, 30.00, 300.00),
(18, 15, 10, 89.00, 890.00),
(18, 23, 5, 130.00, 650.00),
(18, 45, 10, 35.00, 350.00),
(19, 10, 5, 1199.00, 5995.00),
(19, 26, 10, 179.00, 1790.00),
(20, 6, 3, 3299.00, 9897.00),
(20, 16, 5, 39.90, 199.50),
(21, 1, 4, 1999.90, 7999.60),
(21, 14, 8, 159.00, 1272.00),
(22, 3, 4, 3499.00, 13996.00),
(22, 24, 15, 29.00, 435.00),
(23, 12, 4, 699.00, 2796.00),
(23, 11, 6, 399.00, 2394.00),
(23, 29, 5, 209.00, 1045.00),
(24, 5, 4, 2899.90, 11599.60),
(24, 17, 10, 89.00, 890.00),
(25, 4, 5, 1599.00, 7995.00),
(25, 30, 10, 250.00, 2500.00);

UPDATE compras c
SET total = (
   SELECT SUM(subtotal)
   FROM detalle_compra dc
   WHERE dc.id_compra = c.id_compra
);

INSERT INTO clientes (documento, nombres, apellidos, telefono, email, direccion) VALUES
('72856341', 'Juan', 'Ramírez López', '987654321', 'juan.ramirez@gmail.com', 'Av. Los Álamos 123'),
('73561289', 'María', 'Vargas Torres', '986532147', 'maria.vargas@gmail.com', 'Jr. San Martín 456'),
('74891235', 'Carlos', 'Pérez Huamán', '985413267', 'carlos.perez@gmail.com', 'Av. La Marina 890'),
('75981234', 'Ana', 'García Soto', '984512736', 'ana.garcia@hotmail.com', 'Av. Los Incas 320'),
('71234567', 'Pedro', 'Flores Salinas', '983217654', 'pedro.flores@gmail.com', 'Calle Grau 123'),
('75678912', 'Lucía', 'Rojas Medina', '981234567', 'lucia.rojas@gmail.com', 'Av. Arequipa 410'),
('74321987', 'Miguel', 'Cervantes Ugarte', '982145673', 'miguel.cervantes@gmail.com', 'Av. Miraflores 245'),
('73459812', 'Rosa', 'Huamán Flores', '984123567', 'rosa.huaman@gmail.com', 'Calle Tacna 321'),
('74561238', 'Luis', 'Chávez Gutiérrez', '981237456', 'luis.chavez@gmail.com', 'Av. Venezuela 876'),
('73124576', 'Elena', 'Castillo Pineda', '983145762', 'elena.castillo@gmail.com', 'Av. Lima 215'),
('71249856', 'Jorge', 'Valdivia Ramos', '981234975', 'jorge.valdivia@gmail.com', 'Calle Puno 456'),
('72841653', 'Paola', 'Sánchez Torres', '984316572', 'paola.sanchez@gmail.com', 'Av. Ejército 540'),
('73615482', 'Ricardo', 'Gutiérrez Silva', '982541673', 'ricardo.gutierrez@gmail.com', 'Av. Salaverry 890'),
('74981265', 'Diana', 'Meza Cuadros', '981267543', 'diana.meza@gmail.com', 'Av. Arequipa 620'),
('75346128', 'Héctor', 'Quispe Ramos', '982134567', 'hector.quispe@gmail.com', 'Av. Kennedy 300'),
('74231689', 'Gabriela', 'Núñez Vega', '981356748', 'gabriela.nunez@gmail.com', 'Calle Misti 102'),
('71459823', 'Sergio', 'Torres Yupanqui', '983246518', 'sergio.torres@gmail.com', 'Av. La Salle 410'),
('73156829', 'Andrea', 'Contreras Poma', '984561237', 'andrea.contreras@gmail.com', 'Jr. Libertad 450'),
('74619845', 'Rodrigo', 'Prieto Salas', '985412367', 'rodrigo.prieto@gmail.com', 'Calle Pizarro 701'),
('75236419', 'Natalia', 'Cáceres Luna', '986531247', 'natalia.caceres@gmail.com', 'Av. Los Quechuas 980'),
('71984562', 'Oscar', 'Montoya Ruiz', '986421357', 'oscar.montoya@gmail.com', 'Av. La Cultura 420'),
('73695481', 'Liliana', 'Huertas Ramos', '985316427', 'liliana.huertas@gmail.com', 'Av. Lima 760'),
('74123586', 'Kevin', 'Soto Medina', '985416237', 'kevin.soto@gmail.com', 'Av. Dolores 620'),
('72364159', 'Daniela', 'Mamani Quispe', '986234157', 'daniela.mamani@gmail.com', 'Calle Cusco 340'),
('75416293', 'Adrián', 'Palacios Rojas', '982364157', 'adrian.palacios@gmail.com', 'Av. Kennedy 540'),
('71698234', 'Lorena', 'Vásquez Flores', '983245671', 'lorena.vasquez@gmail.com', 'Av. Ejército 907'),
('73981245', 'Diego', 'Medina Silva', '981364527', 'diego.medina@gmail.com', 'Av. Miraflores 120'),
('74816253', 'Ivana', 'Cruz Huarca', '982635174', 'ivana.cruz@gmail.com', 'Jr. Pizarro 215'),
('72731984', 'Joel', 'Ríos Palomino', '983246715', 'joel.rios@gmail.com', 'Av. La Paz 314'),
('75123986', 'Melisa', 'Guzmán Ramos', '984613275', 'melisa.guzman@gmail.com', 'Av. Salaverry 540'),
('74215986', 'Gerson', 'Chumpitaz León', '981246735', 'gerson.chumpitaz@gmail.com', 'Av. Lima 387'),
('71856429', 'Araceli', 'Torres Pinedo', '982754316', 'araceli.torres@gmail.com', 'Calle Pocollay 230'),
('73648921', 'Tania', 'Mendoza Salas', '982134675', 'tania.mendoza@gmail.com', 'Av. Arequipa 900'),
('71456928', 'Ramiro', 'Vargas Núñez', '985271634', 'ramiro.vargas@gmail.com', 'Av. Ejército 234'),
('75231648', 'Valeria', 'Fernández Huerta', '982613457', 'valeria.fernandez@gmail.com', 'Calle Piérola 650'),
('72136458', 'Marco', 'Ticona Ramos', '981364215', 'marco.ticona@gmail.com', 'Av. Grau 890'),
('74921683', 'Fiorella', 'Tello Valdivia', '984216357', 'fiorella.tello@gmail.com', 'Av. Perú 650'),
('73549821', 'Alonso', 'Silva Rojas', '983215467', 'alonso.silva@gmail.com', 'Av. Miraflores 800'),
('74316958', 'Carmen', 'Jiménez Cayo', '981246357', 'carmen.jimenez@gmail.com', 'Calle Atlántida 210'),
('72815649', 'Henry', 'Apaza Flores', '982516437', 'henry.apaza@gmail.com', 'Av. Lima 940'),
('74859326', 'Camila', 'Torres Quispe', '981263457', 'camila.torres@gmail.com', 'Av. San Juan 560'),
('73124598', 'Jhon', 'Quispe Huanca', '981346572', 'jhon.quispe@gmail.com', 'Av. Arequipa 130'),
('71458963', 'Ariana', 'Loayza Cárdenas', '982146375', 'ariana.loayza@gmail.com', 'Calle Bolívar 547'),
('73921586', 'Gino', 'Velarde Pinto', '983167254', 'gino.velarde@gmail.com', 'Calle Cajamarca 620'),
('74591682', 'Karla', 'Espinoza Torres', '984125673', 'karla.espinoza@gmail.com', 'Av. Lima 1050'),
('75246913', 'Mauricio', 'Ochoa Soto', '981257634', 'mauricio.ochoa@gmail.com', 'Av. Miraflores 740'),
('71654382', 'Tatiana', 'Reyes Arias', '982516374', 'tatiana.reyes@gmail.com', 'Av. Dolores 870'),
('74312569', 'Alex', 'Gamarra Rojas', '981453267', 'alex.gamarra@gmail.com', 'Av. Grau 410'),
('73294851', 'Nicol', 'Quispe Medina', '982764153', 'nicol.quispe@gmail.com', 'Av. La Cultura 760'),
('74192653', 'Samantha', 'Muñoz López', '984126753', 'samantha.munoz@gmail.com', 'Calle Pizarro 890');

INSERT INTO metodo_pago (nombre, descripcion) VALUES
('Efectivo', 'Pago en efectivo'),
('Tarjeta', 'Pago con tarjeta débito/crédito'),
('Yape', 'Pago mediante Yape'),
('Plin', 'Pago mediante Plin');

INSERT INTO ventas (id_cliente, id_usuario, total) VALUES
(1, 1, 0), (2, 3, 0), (3, 5, 0), (4, 2, 0), (5, 4, 0),
(6, 7, 0), (7, 10, 0), (8, 8, 0), (9, 6, 0), (10, 9, 0),
(11, 3, 0), (12, 4, 0), (13, 2, 0), (14, 6, 0), (15, 1, 0),
(16, 5, 0), (17, 9, 0), (18, 7, 0), (19, 10, 0), (20, 3, 0),
(21, 1, 0), (22, 4, 0), (23, 8, 0), (24, 6, 0), (25, 7, 0),
(1, 2, 0), (2, 5, 0), (3, 7, 0), (4, 9, 0), (5, 10, 0),
(6, 4, 0), (7, 1, 0), (8, 3, 0), (9, 8, 0), (10, 6, 0),
(11, 9, 0), (12, 1, 0), (13, 4, 0), (14, 3, 0), (15, 5, 0),
(16, 8, 0), (17, 6, 0), (18, 10, 0), (19, 2, 0), (20, 7, 0),
(21, 3, 0), (22, 5, 0), (23, 9, 0), (24, 4, 0), (25, 8, 0);

INSERT INTO detalle_venta (id_venta, id_producto, cantidad, precio, subtotal) VALUES
(1, 1, 5, 0, 0), (1, 21, 6, 0, 0),
(2, 9, 4, 0, 0), (2, 22, 7, 0, 0),
(3, 13, 5, 0, 0), (3, 17, 4, 0, 0),
(4, 25, 8, 0, 0), (4, 29, 6, 0, 0),
(5, 5, 4, 0, 0), (5, 26, 7, 0, 0),

(6, 11, 4, 0, 0), (6, 9, 4, 0, 0),
(7, 45, 7, 0, 0), (7, 24, 6, 0, 0),
(8, 33, 6, 0, 0), (8, 2, 5, 0, 0),
(9, 17, 4, 0, 0), (9, 14, 4, 0, 0),
(10, 6, 5, 0, 0), (10, 21, 7, 0, 0),

(11, 1, 4, 0, 0), (11, 23, 8, 0, 0),
(12, 3, 5, 0, 0), (12, 14, 5, 0, 0),
(13, 9, 4, 0, 0), (13, 27, 6, 0, 0),
(14, 11, 4, 0, 0), (14, 18, 6, 0, 0),
(15, 2, 6, 0, 0), (15, 37, 7, 0, 0),

(16, 12, 4, 0, 0), (16, 26, 6, 0, 0),
(17, 7, 5, 0, 0), (17, 15, 6, 0, 0),
(18, 8, 4, 0, 0), (18, 24, 7, 0, 0),
(19, 10, 4, 0, 0), (19, 21, 7, 0, 0),
(20, 3, 4, 0, 0), (20, 40, 8, 0, 0),

(21, 1, 6, 0, 0), (21, 14, 5, 0, 0),
(22, 7, 5, 0, 0), (22, 20, 6, 0, 0),
(23, 9, 4, 0, 0), (23, 23, 7, 0, 0),
(24, 12, 5, 0, 0), (24, 13, 4, 0, 0),
(25, 2, 4, 0, 0), (25, 35, 5, 0, 0),

(26, 4, 7, 0, 0), (26, 14, 4, 0, 0),
(27, 5, 6, 0, 0), (27, 23, 5, 0, 0),
(28, 10, 5, 0, 0), (28, 37, 5, 0, 0),
(29, 6, 6, 0, 0), (29, 39, 8, 0, 0),
(30, 7, 4, 0, 0), (30, 21, 7, 0, 0),

(31, 3, 5, 0, 0), (31, 13, 4, 0, 0),
(32, 11, 4, 0, 0), (32, 24, 6, 0, 0),
(33, 8, 7, 0, 0), (33, 19, 7, 0, 0),
(34, 1, 6, 0, 0), (34, 13, 4, 0, 0),
(35, 12, 5, 0, 0), (35, 41, 7, 0, 0),

(36, 15, 6, 0, 0), (36, 25, 8, 0, 0),
(37, 18, 5, 0, 0), (37, 29, 7, 0, 0),
(38, 2, 4, 0, 0), (38, 38, 6, 0, 0),
(39, 7, 7, 0, 0), (39, 16, 6, 0, 0),
(40, 9, 4, 0, 0), (40, 13, 4, 0, 0),

(41, 1, 7, 0, 0), (41, 42, 7, 0, 0),
(42, 10, 6, 0, 0), (42, 37, 7, 0, 0),
(43, 3, 5, 0, 0), (43, 21, 6, 0, 0),
(44, 4, 4, 0, 0), (44, 23, 5, 0, 0),
(45, 7, 6, 0, 0), (45, 44, 8, 0, 0),

(46, 5, 6, 0, 0), (46, 13, 4, 0, 0),
(47, 2, 5, 0, 0), (47, 43, 6, 0, 0),
(48, 8, 6, 0, 0), (48, 13, 4, 0, 0),
(49, 11, 6, 0, 0), (49, 25, 8, 0, 0),
(50, 3, 7, 0, 0), (50, 14, 5, 0, 0);

UPDATE detalle_venta dv
JOIN productos p ON dv.id_producto = p.id_producto
SET dv.precio = p.precio,
    dv.subtotal = ROUND(p.precio * dv.cantidad, 2)
WHERE dv.id_venta BETWEEN 1 AND 50;

UPDATE ventas v
JOIN (
    SELECT id_venta, ROUND(SUM(subtotal),2) AS total_real
    FROM detalle_venta
    WHERE id_venta BETWEEN 1 AND 50
    GROUP BY id_venta
) d ON v.id_venta = d.id_venta
SET v.total = d.total_real
WHERE v.id_venta BETWEEN 1 AND 50;

INSERT INTO pago_venta (id_venta, id_metodo_pago, monto)
SELECT 
    v.id_venta,
    FLOOR(1 + RAND() * 4) AS id_metodo_pago,
    v.total AS monto
FROM ventas v;


INSERT INTO movimiento_inventario (id_producto, id_usuario, cantidad, tipo, fecha, referencia)
SELECT 
    dc.id_producto,
    1 AS id_usuario,
    dc.cantidad,
    'entrada' AS tipo,
    NOW(),
    CONCAT('Compra #', dc.id_compra)
FROM detalle_compra dc;

UPDATE inventario i
JOIN (
    SELECT id_producto, SUM(cantidad) AS total_ingresado
    FROM detalle_compra
    GROUP BY id_producto
) dc ON i.id_producto = dc.id_producto
SET i.stock_actual = i.stock_actual + dc.total_ingresado;


INSERT INTO movimiento_inventario (id_producto, id_usuario, cantidad, tipo, fecha, referencia)
SELECT dv.id_producto, 1 AS id_usuario, dv.cantidad, 'salida', NOW(), CONCAT('Venta #', dv.id_venta)
FROM detalle_venta dv
WHERE dv.id_venta BETWEEN 1 AND 50;

UPDATE inventario i
JOIN (
    SELECT id_producto, COALESCE(SUM(cantidad),0) AS total_vendido
    FROM detalle_venta
    WHERE id_venta BETWEEN 1 AND 50
    GROUP BY id_producto
) dv ON i.id_producto = dv.id_producto
SET i.stock_actual = GREATEST(0, i.stock_actual - dv.total_vendido);


UPDATE ventas v
JOIN (
    SELECT id_venta, SUM(subtotal) AS total
    FROM detalle_venta
    GROUP BY id_venta
) d ON v.id_venta = d.id_venta
SET v.total = d.total;

INSERT INTO log_sistema (tabla, operacion, descripcion) VALUES
('usuarios', 'INSERT', 'Registro de nuevo usuario administrador'),
('roles', 'INSERT', 'Creación de roles del sistema'),
('usuarios_roles', 'INSERT', 'Asignación de roles iniciales'),
('clientes', 'INSERT', 'Registro de cliente Juan Ramírez'),
('productos', 'INSERT', 'Carga inicial de productos tecnológicos'),
('categorias', 'INSERT', 'Registro de categorías tecnológicas'),
('proveedores', 'INSERT', 'Ingreso de proveedores principales'),
('compras', 'INSERT', 'Compra inicial de mercadería'),
('detalle_compra', 'INSERT', 'Registro de productos en la compra 001'),
('inventario', 'UPDATE', 'Actualización de stock tras compra inicial'),

('ventas', 'INSERT', 'Venta registrada al cliente María Vargas'),
('detalle_venta', 'INSERT', 'Producto vendido en la venta 001'),
('pago_venta', 'INSERT', 'Pago registrado con método Yape'),
('movimiento_inventario', 'INSERT', 'Salida de inventario por venta'),
('inventario', 'UPDATE', 'Reducción de stock por venta'),
('log_sistema', 'INSERT', 'Registro de evento automático'),
('clientes', 'UPDATE', 'Actualización de datos de cliente'),
('usuarios', 'UPDATE', 'Modificación de datos de usuario'),
('productos', 'UPDATE', 'Modificación de precios'),
('compras', 'UPDATE', 'Corrección del total'),

('detalle_compra', 'UPDATE', 'Ajuste en cantidades adquiridas'),
('inventario', 'UPDATE', 'Ajuste por diferencia de stock'),
('movimiento_inventario', 'INSERT', 'Ajuste de inventario negativo'),
('ventas', 'UPDATE', 'Actualización de venta por error en detalle'),
('detalle_venta', 'UPDATE', 'Corrección de unidades vendidas'),
('pago_venta', 'UPDATE', 'Actualización del método de pago'),
('usuarios_roles', 'INSERT', 'Asignación de nuevo rol'),
('roles', 'UPDATE', 'Corrección de descripción de rol'),
('clientes', 'DELETE', 'Eliminación de cliente duplicado'),
('productos', 'DELETE', 'Eliminación de producto discontinuado'),

('inventario', 'UPDATE', 'Ajuste por conteo físico'),
('compras', 'INSERT', 'Nueva compra registrada'),
('detalle_compra', 'INSERT', 'Productos añadidos en compra nueva'),
('ventas', 'INSERT', 'Nueva venta registrada'),
('detalle_venta', 'INSERT', 'Detalle añadido en venta'),
('pago_venta', 'INSERT', 'Pago registrado mediante Plin'),
('movimiento_inventario', 'INSERT', 'Entrada de inventario por proveedor'),
('usuarios', 'INSERT', 'Nuevo usuario vendedor registrado'),
('clientes', 'INSERT', 'Ingreso de nuevo cliente'),
('productos', 'INSERT', 'Producto agregado al catálogo'),

('roles', 'INSERT', 'Nuevo rol creado'),
('usuarios_roles', 'DELETE', 'Rol eliminado por el administrador'),
('usuarios', 'UPDATE', 'Cambio de contraseña realizado'),
('movimiento_inventario', 'UPDATE', 'Corrección en cantidad de ajuste'),
('detalle_compra', 'DELETE', 'Eliminación de ítem duplicado'),
('detalle_venta', 'DELETE', 'Eliminación de ítem erróneo'),
('inventario', 'INSERT', 'Nuevo producto añadido con stock inicial'),
('log_sistema', 'INSERT', 'Registro general del sistema'),
('usuarios', 'LOGIN', 'Inicio de sesión exitoso del usuario admin'),
('usuarios', 'LOGIN', 'Inicio de sesión fallido por contraseña incorrecta');

-- esto es para la configuración y insertar los tres campos
INSERT INTO configuracion (moneda, simbolo, igv, incluye_igv)
VALUES ('PEN', 'S/.', 18.00, 1);

UPDATE ventas
SET 
    subtotal = ROUND(total / 1.18, 2),
    igv = ROUND(total - (total / 1.18), 2);

UPDATE compras
SET 
    subtotal = ROUND(total / 1.18, 2),
    igv = ROUND(total - (total / 1.18), 2);

-- 1. Inicializar la variable con la FECHA Y HORA DE INICIO SOLICITADA
SET @start_date_compras = '2025-10-08';
SET @row_number = 0; -- Inicializar contador para asegurar la secuencia

-- 2. Actualizar la tabla compras con fechas calculadas (1.033 días por registro)
UPDATE compras
SET fecha_compra = (
    SELECT DATE_ADD(@start_date_compras, INTERVAL (@row_number := @row_number + 1) * 2.5 DAY)
)
ORDER BY id_compra ASC;


-- 1. Inicializar la variable con la FECHA Y HORA DE INICIO SOLICITADA
SET @start_date_ventas = '2025-11-10';
SET @row_number = 0; -- Inicializar contador para asegurar la secuencia

-- 2. Actualizar la tabla ventas con fechas calculadas (0.62 días por registro)
UPDATE ventas
SET fecha_venta = (
    SELECT DATE_ADD(@start_date_ventas, INTERVAL (@row_number := @row_number + 1) * 0.62 DAY)
)
ORDER BY id_venta ASC;

INSERT INTO usuarios (username, password_hash, documento, nombres, apellidos, email, telefono) VALUES
('loquita_apestosa', '$2y$10$evjFQNaSkknWQpBwVHP6zeqhnY0KdkNTMhm9FoJmaKxR1PL1s4Ebq', '70707070', 'Nely', 'Mayta', 'nely@admin.com', '999888777');
INSERT INTO usuarios_roles (id_usuario, id_rol) VALUES (41, 1);
