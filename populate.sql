----------------------------------------
-- Populate Relations 
----------------------------------------

insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (45.234123, 156.789324, 'Fonte Luminosa');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (35.123543, 120.749342, 'Atrium Saldanha');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (12.890234, 12.897932, 'Estação de Comboios');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (14.234234, 127.382310, 'Jardim do Arco');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (3.789033, 67.789873, 'Praia do Restelo');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (22.234123, 190.789324, 'Igreja de São Bento');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (15.183543, 126.649902, 'Supermercado Continente');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (20.890234, 13.867732, 'Restaurante Zaragata');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (31.234234, 130.782310, 'Bar A Xinoca');
insert into local_publico(lp_latitude, lp_longitude, lp_nome)
	values (37.090337, 69.889873, 'Hotel Ribatejo');

insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Pica das 7', 'Rua do Cairo', 12.890234, 12.897932);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Jola a 60 cêntimos', 'Arco do Cego', 14.234234, 127.382310);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Loja de Malas', 'Malópia', 35.123543, 120.749342);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Espetáculo de Luzes', 'Alameda', 45.234123, 156.789324);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Aula de Surf', 'Cabo Verde', 3.789033, 67.789873);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Aula de Código', 'Alameda', 35.123543, 120.749342);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Parede do Manuscrito de São Paulo', 'Rua do Querubim', 37.090337, 69.889873);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Portão Principal', 'Rebelva', 22.234123, 190.789324);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Banca das Flores', 'Amadora', 15.183543, 126.649902);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Balcão 5', 'Manique', 20.890234, 13.867732);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Estátua Ying Yang', 'Bairro Chinês',31.234234, 130.782310);
insert into item(i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values ('Suite Presidencial', 'Praceta das Avelãs', 37.090337, 69.889873);

insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('034, 012', 'cartaz.jpg', 'pt', '2019-11-10 05:43:22', 'Cartaz com erro', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('012, 054', 'poster.png', 'eng', '2019-01-15 12:50:56', 'Mal traduzido', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('004, 006', 'trad.jpg', 'fr', '2019-12-16 14:02:06', 'Mal traduzido', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('010, 078', 'publicidade.jpg', 'pt', '2019-12-18 16:45:25', 'Erro ortográfico', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('003, 059', 'frase.png', 'pt', '2019-12-20 08:25:26', 'Frase sem sentido', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('007, 038', 'foto.jpg', 'pt', '2019-01-01 10:00:00', 'Frase', false);	
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('024, 052', 'menu.jpg', 'pt', '2019-05-15 09:45:22', 'Erro ortográfico', true);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('342, 039', 'livro.png', 'eng', '2019-07-15 12:00:06', 'Erro ortográfico', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('054, 063', 'carta.jpg', 'fr', '2019-05-17 15:03:43', 'Frase sem sentido', true);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('040, 027', 'revista.jpg', 'pt', '2019-11-30 14:35:05', 'Imagem escura', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('005, 002', 'flyer.png', 'es', '2019-02-10 04:35:24', 'Frase sem sentido', false);
insert into anomalia(a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values ('023, 023', 'manuscrito.jpg', 'uk', '2019-02-26 12:30:40', 'Erro ortográfico', true);

insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (2, '031, 048', 'pt');
insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (3, '046, 064', 'pt');
insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (5, '146, 264', 'pt');
insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (9, '445, 753', 'pt');
insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (10, '429, 231', 'pt');
insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (11, '123, 123', 'pt');

insert into duplicado(i_id1, i_id2)
	values (1, 4);
insert into duplicado(i_id1, i_id2)
	values (4, 5);
insert into duplicado(i_id1, i_id2)
	values (2, 6);
insert into duplicado(i_id1, i_id2)
	values (3, 11);


insert into utilizador(u_email, u_password) 
	values ('nikoletta@gmail.com', 'nika');
insert into utilizador(u_email, u_password) 
	values ('vasco@gmail.com', 'vasco');
insert into utilizador(u_email, u_password) 
	values ('bruno@gmail.com', 'bruno');
insert into utilizador(u_email, u_password) 
	values ('rui@gmail.com', 'rui');
insert into utilizador(u_email, u_password)
	values ('zemanel@gmail.com', 'ze');
insert into utilizador(u_email, u_password)
	values ('professor@gmail.com', 'professor');
insert into utilizador(u_email, u_password) 
	values ('rute@gmail.com', 'rute');
insert into utilizador(u_email, u_password)
	values ('stallman@gmail.com', 'gnu');
insert into utilizador(u_email, u_password)
	values ('beatriz@gmail.com', 'beatriz');

insert into utilizador_qualificado(u_email)
	values ('nikoletta@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('vasco@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('bruno@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('rui@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('professor@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('rute@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('stallman@gmail.com');

insert into utilizador_regular(u_email)
	values ('zemanel@gmail.com');
insert into utilizador_regular(u_email)
	values ('beatriz@gmail.com');

insert into incidencia(a_id, i_id, u_email) values (1,  2, 'nikoletta@gmail.com' );
insert into incidencia(a_id, i_id, u_email) values (2,  4, 'zemanel@gmail.com'   );
insert into incidencia(a_id, i_id, u_email) values (3,  5, 'bruno@gmail.com'     );
insert into incidencia(a_id, i_id, u_email) values (4,  3, 'vasco@gmail.com'     );
insert into incidencia(a_id, i_id, u_email) values (5,  1, 'rui@gmail.com'       );
insert into incidencia(a_id, i_id, u_email) values (6,  6, 'vasco@gmail.com'     );
insert into incidencia(a_id, i_id, u_email) values (10,  9, 'professor@gmail.com');
insert into incidencia(a_id, i_id, u_email) values (7,   7, 'professor@gmail.com');
insert into incidencia(a_id, i_id, u_email) values (12,  8, 'professor@gmail.com');
insert into incidencia(a_id, i_id, u_email) values (10, 9 , 'rute@gmail.com'     );
insert into incidencia(a_id, i_id, u_email) values (11, 10, 'stallman@gmail.com' );
insert into incidencia(a_id, i_id, u_email) values (8,  11, 'nikoletta@gmail.com');

insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (1, '2016-01-09 06:59:34', 'Falta um s'            , 'bruno@gmail.com'     );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (1, '2017-02-18 02:40:01', 'Alterar para amarelo'  , 'nikoletta@gmail.com' );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (1, '2018-03-27 10:07:56', 'Retirar reticências'   , 'vasco@gmail.com'     );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (1, '2019-04-31 15:34:14', 'Rodar 90'              , 'rui@gmail.com'       );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (2, '2019-05-01 20:23:12', 'Aumentar ampliação'    , 'bruno@gmail.com'     );

insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (1, '2013-11-19 06:59:34', 'Alterar a data'         , 'professor@gmail.com' );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (2, '2013-12-07 10:07:56', 'Retirar a frase'        , 'professor@gmail.com' );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (2, '2016-08-08 02:40:01', 'Tirar um "s"'           , 'nikoletta@gmail.com' );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (3, '2013-12-07 10:07:56', 'Escurecer'              , 'professor@gmail.com' );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (2, '2013-07-21 15:34:14', 'Acrescentar uma vírgula', 'rui@gmail.com'       );
insert into proposta_correcao(pc_nro, pc_data_hora, pc_texto, u_email) values (1, '2001-06-10 20:23:12', 'Corrigir "ç"'           , 'rute@gmail.com'      );

insert into correcao(u_email, pc_nro, a_id) values ('bruno@gmail.com'    , 1, 5);
insert into correcao(u_email, pc_nro, a_id) values ('nikoletta@gmail.com', 1, 2);
insert into correcao(u_email, pc_nro, a_id) values ('vasco@gmail.com'    , 1, 4);
insert into correcao(u_email, pc_nro, a_id) values ('rui@gmail.com'      , 1, 1);
insert into correcao(u_email, pc_nro, a_id) values ('bruno@gmail.com'    , 2, 3);

insert into correcao(u_email, pc_nro, a_id) values ('professor@gmail.com', 1, 12);
insert into correcao(u_email, pc_nro, a_id) values ('professor@gmail.com', 2, 11);
insert into correcao(u_email, pc_nro, a_id) values ('professor@gmail.com', 3, 10);
insert into correcao(u_email, pc_nro, a_id) values ('nikoletta@gmail.com', 2, 7);
insert into correcao(u_email, pc_nro, a_id) values ('rui@gmail.com'      , 2, 9);
insert into correcao(u_email, pc_nro, a_id) values ('rute@gmail.com'     , 1, 8);

