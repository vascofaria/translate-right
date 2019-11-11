----------------------------------------
-- Populate Relations 
----------------------------------------

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
