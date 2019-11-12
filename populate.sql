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
	values (1, '34, 12', '$$%%&&$', 'pt', '2019-11-10 05:43:22', 'Cartaz com erro', 1);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (2, '12, 54', '&&%#', 'eng', '2019-11-15 12:50:56', 'Mal traduzido', 0);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (3, '4, 6', '##$#$', 'fr', '2019-12-16 14:02:06', 'Mal traduzido', 0);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (4, '10, 78', '$$#$', 'pt', '2019-12-18 16:45:25', 'Erro ortográfico', 0);
insert into anomalia(a_id, a_zona, a_imagem, a_lingua, a_ts, a_descricao, a_tem_anomalia_redacao)
	values (5, '3, 59', '#$$#$', 'pt', '2019-12-20 08:25:26', 'Frase sem sentido', 0);

insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (2, '31, 48', 'pt');
insert into anomalia_traducao(a_id, at_zona2, at_lingua2) 
	values (3, '46, 64', 'pt');

insert into duplicado(i_id1, i_id2)
	values (1, 4);
insert into duplicado(i_id1, i_id2)
	values (4, 5);

insert into utilizador(u_email, u_password) 
	values ();
insert into utilizador(u_email, u_password) 
	values ();
insert into utilizador(u_email, u_password) 
	values ();
insert into utilizador(u_email, u_password) 
	values ();

insert into utilizador_qualificado(u_email)
	values ();
insert into utilizador_qualificado(u_email)
	values ();

insert into utilizador_regular(u_email) values ();

insert into incidencia() values ();

insert into proposta_correcao() values ();

insert into correcao() values ();
