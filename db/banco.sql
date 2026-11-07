use loja2;

show tables;

create table produto (
id_produto int auto_increment primary key,
nome varchar(255) not null,
descricao varchar(255),
preco decimal(10,2) not null check(preco > 0),
quantidade int not null check(quantidade > 0));

select * from produto;