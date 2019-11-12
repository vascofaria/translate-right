----------------------------------------
-- Populate Relations 
----------------------------------------

insert into local_publico() values ();

insert into item() values ();

insert into anomalia() values ();

insert into anomalia_traducao() values ();

insert into duplicado() values ();

insert into utilizador() values ();

insert into utilizador_qualificado() values ();

insert into utilizador_regular() values ();

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

insert into utilizador values ('bruno@gmail.com',	 'bruno');
insert into utilizador values ('vasco@gmail.com',	 'vasco');
insert into utilizador values ('rui@gmail.com',		 'rui');
insert into utilizador values ('nikoleta@gmail.com', 'nikoleta');

insert into proposta_correcao values ('1', '2019', 'feito pelo bruno', 	  'bruno@gmail.com');
insert into proposta_correcao values ('2', '2013', 'feita pela nikoleta', 'nikoleta@gmail.com');
insert into proposta_correcao values ('3', '2019', 'feito pelo bruno',    'bruno@gmail.com');
insert into proposta_correcao values ('4', '2020', 'feito pelo vasco',    'vasco@gmail.com');
insert into proposta_correcao values ('5', '2019', 'feito pelo bruno',    'bruno@gmail.com');

insert into anomalia values ('1', 'anomalia - zona1', 'anomalia - imagem1', 'pt', 'anomalia - descricao1', 'ts1');
insert into anomalia values ('2', 'anomalia - zona2', 'anomalia - imagem2', 'anomalia - lingua2', 'anomalia - descricao2', 'ts2');
insert into anomalia values ('3', 'anomalia - zona3', 'anomalia - imagem3', 'pt', 'anomalia - descricao3', 'ts3');
insert into anomalia values ('4', 'anomalia - zona4', 'anomalia - imagem4', 'anomalia - lingua4', 'anomalia - descricao4', 'ts4');
insert into anomalia values ('5', 'anomalia - zona5', 'anomalia - imagem5', 'anomalia - lingua5', 'anomalia - descricao5', 'ts5');

insert into item values ('1', 'item - descricao1', 'item - localizacao1', 'item - coordenadas1');
insert into item values ('2', 'item - descricao2', 'item - localizacao2', 'item - coordenadas2');
insert into item values ('3', 'item - descricao3', 'item - localizacao3', 'item - coordenadas3');
insert into item values ('4', 'item - descricao4', 'item - localizacao4', 'item - coordenadas4');
insert into item values ('5', 'item - descricao5', 'item - localizacao5', 'item - coordenadas5');
insert into item values ('6', 'item - descricao6', 'item - localizacao6', 'item - coordenadas6');
