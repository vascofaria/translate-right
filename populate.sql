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
	values (3.789033, 67.789873, 'Praia');

insert into item(i_id, i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values (1, 'Pica das 7', 'Rua do Cairo', 12.890234, 12.897932);
insert into item(i_id, i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values (2, 'Jola a 60 centimos', 'Arco do Cego', 14.234234, 127.382310);
insert into item(i_id, i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values (3, 'Loja de Malas', 'Malópia', 35.123543, 120.749342);
insert into item(i_id, i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values (4, 'Espetáculo de Luzes', 'Alameda', 45.234123, 156.789324);
insert into item(i_id, i_descricao, i_localizacao, lp_latitude, lp_longitude)
	values (5, 'Aula de Surf', 'Cabo Verde', 3.789033, 67.789873);

insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (1, '34, 12', '$$%%&&$', 'pt', '2019-11-10 05:43:22', 'Cartaz com erro', false);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (2, '12, 54', '&&%#', 'eng', '2019-11-15 12:50:56', 'Mal traduzido', false);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (3, '4, 6', '##$#$', 'fr', '2019-12-16 14:02:06', 'Mal traduzido', false);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (4, '10, 78', '$$#$', 'pt', '2019-12-18 16:45:25', 'Erro ortográfico', false);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (5, '3, 59', '#$$#$', 'pt', '2019-12-20 08:25:26', 'Frase sem sentido', false);

insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (2, '31, 48', 'pt');
insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (3, '46, 64', 'pt');

insert into duplicado(i_id1, i_id2)
	values (1, 4);
insert into duplicado(i_id1, i_id2)
	values (4, 5);

insert into utilizador(u_email, u_password) 
	values ('nikoleta@gmail.com', 'nika');
insert into utilizador(u_email, u_password) 
	values ('vasco@gmail.com', 'vasco');
insert into utilizador(u_email, u_password) 
	values ('bruno@gmail.com', 'bruno');
insert into utilizador(u_email, u_password) 
	values ('rui@gmail.com', 'rui');
insert into utilizador(u_email, u_password)
	values ('zemanel@gmail.com', 'ze');

insert into utilizador_qualificado(u_email)
	values ('nikoleta@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('vasco@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('bruno@gmail.com');
insert into utilizador_qualificado(u_email)
	values ('rui@gmail.com');

insert into utilizador_regular(u_email)
	values ('zemanel@gmail.com');

insert into incidencia(a_id,i_id,u_email) values (1,2,'nikoleta@gmail.com');
insert into incidencia(a_id,i_id,u_email) values (2,4,'vasco@gmail.com'   );
insert into incidencia(a_id,i_id,u_email) values (3,5,'bruno@gmail.com'   );
insert into incidencia(a_id,i_id,u_email) values (4,3,'vasco@gmail.com'   );
insert into incidencia(a_id,i_id,u_email) values (5,1,'rui@gmail.com'     );

insert into proposta_correcao(pc_nro, pc_data_hora,pc_texto,u_email) values (1,'2016-01-09 06:59:34', 'Chegar para a direita', 'bruno@gmail.com'   );
insert into proposta_correcao(pc_nro, pc_data_hora,pc_texto,u_email) values (2,'2017-02-18 02:40:01', 'Alterar para amarelo' , 'nikoleta@gmail.com');
insert into proposta_correcao(pc_nro, pc_data_hora,pc_texto,u_email) values (3,'2018-03-27 10:07:56', 'Mais comprido'        , 'vasco@gmail.com'   );
insert into proposta_correcao(pc_nro, pc_data_hora,pc_texto,u_email) values (4,'2019-04-31 15:34:14', 'Rodar 90'             , 'rui@gmail.com'     );
insert into proposta_correcao(pc_nro, pc_data_hora,pc_texto,u_email) values (5,'2020-05-01 20:23:12', 'Aumentar ampliação'   , 'bruno@gmail.com'   );

insert into correcao(u_email,pc_nro,a_id) values ('bruno@gmail.com'    ,1,5);
insert into correcao(u_email,pc_nro,a_id) values ('nikoleta@gmail.com' ,2,2);
insert into correcao(u_email,pc_nro,a_id) values ('vasco@gmail.com'    ,3,4);
insert into correcao(u_email,pc_nro,a_id) values ('rui@gmail.com'      ,4,1);
insert into correcao(u_email,pc_nro,a_id) values ('bruno@gmail.com'    ,5,3); 
