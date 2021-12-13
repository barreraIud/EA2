insert into roles(id, name) values (1, 'ADMIN');
insert into roles(id, name) values (2, 'SELLER');

-- password por defecto para todos los usurios: 123456789
INSERT INTO users(id, role_id, seller_id, name, email, password, created_at, updated_at)
VALUES (1, 1, NULL, 'Admin', 'admin@admin.com', '$2y$10$ocpzmNFoHIwNWvY6H3ecue0QoWOOpNxHXZb3qlG6GM/MFXng7KWAi', NULL, NULL);

INSERT INTO categories(id, name) values (1, 'Calzado');
INSERT INTO categories(id, name) values (2, 'Tecnología');
INSERT INTO categories(id, name) values (3, 'Cocina');
INSERT INTO categories(id, name) values (4, 'Celulares');
INSERT INTO categories(id, name) values (5, 'Construcción');
INSERT INTO categories(id, name) values (6, 'Belleza');
INSERT INTO categories(id, name) values (7, 'Deporte');
INSERT INTO categories(id, name) values (8, 'Accesorios');

INSERT INTO brands(id, name) values (1, 'Sony');
INSERT INTO brands(id, name) values (2, 'Apple');
INSERT INTO brands(id, name) values (3, 'HP');
INSERT INTO brands(id, name) values (4, 'Adidas');
INSERT INTO brands(id, name) values (5, 'Nike');
INSERT INTO brands(id, name) values (6, 'Samsung');
INSERT INTO brands(id, name) values (7, 'Trek');

INSERT INTO sellers(id, name) VALUES (1, 'Artículos deportivos');
INSERT INTO sellers(id, name) VALUES (2, 'Tienda de Electrónicos');


INSERT INTO `products` ( `category_id`, `brand_id`, `name`, `description`, `image`, `price`, `inventory`, `seller_id`) VALUES
	( 7, 7, 'Bicicleta para montaña', 'Negra con azul', 'https://m.media-amazon.com/images/I/712UgY14vRS._AC_SX425_.jpg', 200, 50, 1),
	(8, 4, 'Gafas de sol', 'Blancas con negro', 
	'https://scene7.zumiez.com/is/image/zumiez/image/Petals-and-Peacocks-Nevermind-gafas-de-sol-blancas-de-cuadros-_285012.jpg', 200, 50, 2),
	( 4, 2, 'Iphone 7', 'Con cargador', 
	'https://e00-expansion.uecdn.es/assets/multimedia/imagenes/2021/09/14/16316447906591.jpg', 3000, 200, 2),
	(4, 2, 'Iphone 12', 'Color negro, memoria interna 120G', 
	'https://elcomercio.pe/resizer/gojhMucRCkSCp1vJBusNSO9WX6Y=/980x0/smart/filters:format(jpeg):quality(75)/cloudfront-us-east-1.images.arcpublishing.com/elcomercio/4XSAGXXD25HPXNY6YOYSPMHXKE.jpg', 
	1200, 100, 1);