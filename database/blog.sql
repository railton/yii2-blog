
CREATE SEQUENCE comentario_situacao_seq;

CREATE TABLE comentario_situacao (
                cosi_codigo INTEGER NOT NULL DEFAULT nextval('comentario_situacao_seq'),
                cosi_nome VARCHAR(60) NOT NULL,
                CONSTRAINT comentario_situacao_pk PRIMARY KEY (cosi_codigo)
);


ALTER SEQUENCE comentario_situacao_seq OWNED BY comentario_situacao.cosi_codigo;

CREATE SEQUENCE noticia_situacao_seq;

CREATE TABLE noticia_situacao (
                nosi_codigo INTEGER NOT NULL DEFAULT nextval('noticia_situacao_seq'),
                nosi_nome VARCHAR(60) NOT NULL,
                CONSTRAINT noticia_situacao_pk PRIMARY KEY (nosi_codigo)
);


ALTER SEQUENCE noticia_situacao_seq OWNED BY noticia_situacao.nosi_codigo;

CREATE SEQUENCE categoria_seq;

CREATE TABLE categoria (
                cate_codigo INTEGER NOT NULL DEFAULT nextval('categoria_seq'),
                cate_nome VARCHAR(30) NOT NULL,
                CONSTRAINT categoria_pk PRIMARY KEY (cate_codigo)
);


ALTER SEQUENCE categoria_seq OWNED BY categoria.cate_codigo;

CREATE SEQUENCE usuario_seq;

CREATE TABLE usuario (
                usua_codigo INTEGER NOT NULL DEFAULT nextval('usuario_seq'),
                usua_nome VARCHAR(60) NOT NULL,
                usua_email VARCHAR(60) NOT NULL,
                usua_senha VARCHAR(60) NOT NULL,
                usua_habilitado BOOLEAN DEFAULT true NOT NULL,
                usua_tipo INTEGER NOT NULL,
                usua_auth_key VARCHAR(32) NOT NULL,
                CONSTRAINT usuario_pk PRIMARY KEY (usua_codigo)
);


ALTER SEQUENCE usuario_seq OWNED BY usuario.usua_codigo;

CREATE SEQUENCE noticia_seq;

CREATE TABLE noticia (
                noti_codigo INTEGER NOT NULL DEFAULT nextval('noticia_seq'),
                noti_titulo VARCHAR(120) NOT NULL,
                noti_texto TEXT NOT NULL,
                noti_data_criacao TIMESTAMP NOT NULL,
                noti_data_alteracao TIMESTAMP NOT NULL,
                noti_data_publicacao TIMESTAMP NOT NULL,
                cate_codigo INTEGER NOT NULL,
                usua_codigo INTEGER NOT NULL,
                nosi_codigo INTEGER NOT NULL,
                noti_imagem BOOLEAN DEFAULT false NOT NULL,
                CONSTRAINT noticia_pk PRIMARY KEY (noti_codigo)
);


ALTER SEQUENCE noticia_seq OWNED BY noticia.noti_codigo;

CREATE SEQUENCE comentario_seq;

CREATE TABLE comentario (
                come_codigo INTEGER NOT NULL DEFAULT nextval('comentario_seq'),
                come_texto VARCHAR(240) NOT NULL,
                come_data_criacao TIMESTAMP NOT NULL,
                noti_codigo INTEGER NOT NULL,
                usua_codigo INTEGER NOT NULL,
                cosi_codigo INTEGER NOT NULL,
                CONSTRAINT comentario_pk PRIMARY KEY (come_codigo)
);


ALTER SEQUENCE comentario_seq OWNED BY comentario.come_codigo;

ALTER TABLE comentario ADD CONSTRAINT comentario_situacao_comentario_fk
FOREIGN KEY (cosi_codigo)
REFERENCES comentario_situacao (cosi_codigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE noticia ADD CONSTRAINT noticia_situacao_noticia_fk
FOREIGN KEY (nosi_codigo)
REFERENCES noticia_situacao (nosi_codigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE noticia ADD CONSTRAINT categoria_noticia_fk
FOREIGN KEY (cate_codigo)
REFERENCES categoria (cate_codigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE noticia ADD CONSTRAINT usuario_noticia_fk
FOREIGN KEY (usua_codigo)
REFERENCES usuario (usua_codigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE comentario ADD CONSTRAINT usuario_comentario_fk
FOREIGN KEY (usua_codigo)
REFERENCES usuario (usua_codigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;

ALTER TABLE comentario ADD CONSTRAINT noticia_comentario_fk
FOREIGN KEY (noti_codigo)
REFERENCES noticia (noti_codigo)
ON DELETE NO ACTION
ON UPDATE NO ACTION
NOT DEFERRABLE;
