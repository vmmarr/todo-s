------------------------------
-- Archivo de base de datos --
------------------------------

DROP TABLE IF EXISTS usuarios CASCADE;

CREATE TABLE usuarios
(
    id          bigserial    PRIMARY KEY
  , username    varchar(255) NOT NULL UNIQUE
  , password  varchar(255) NOT NULL
  -- , authKey varchar(255) 
);

DROP TABLE IF EXISTS etiquetas CASCADE;

CREATE TABLE etiquetas
(
    id          bigserial    PRIMARY KEY
  , etiqueta    varchar(255) UNIQUE
);

DROP TABLE IF EXISTS tareas CASCADE;

CREATE TABLE tareas
(
    id          bigserial    PRIMARY KEY
  , titulo      varchar(255) NOT NULL
  , descripcion varchar(100) NOT NULL
  , usuario_id  bigint       NOT NULL REFERENCES usuarios (id) on update CASCADE on delete CASCADE
  , vencimiento timestamp NOT NULL 
  , esRealizada boolean DEFAULT false
);

DROP TABLE IF EXISTS etiquetaTareas CASCADE;

CREATE TABLE etiquetaTareas
(
    id          bigserial    PRIMARY KEY
  , etiqueta_id   bigint   REFERENCES etiquetas (id) on update CASCADE on delete CASCADE
  , tarea_id   bigint   REFERENCES tareas (id) on update CASCADE on delete CASCADE
);

insert into usuarios (username, password) 
values ('admin', crypt('admin', gen_salt('bf', 10)));

insert into usuarios (username, password) 
values ('user1', crypt('user1', gen_salt('bf', 10)));

insert into usuarios (username, password) 
values ('user2', crypt('user2', gen_salt('bf', 10)));