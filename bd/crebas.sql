/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     04/08/2017 11:44:38                          */
/*==============================================================*/


drop index index_1 on calendarios_capacitaciones;

drop index index_2 on calendarios_capacitaciones;

drop table if exists calendarios_capacitaciones;

drop index index_1 on capacitaciones;

drop index index_2 on capacitaciones;

drop index index_3 on capacitaciones;

drop table if exists capacitaciones;

drop index index_1 on categorias_capacitaciones;

drop table if exists categorias_capacitaciones;

drop index index_1 on empresas;

drop index index_2 on empresas;

drop table if exists empresas;

drop index index_1 on especialidades;

drop table if exists especialidades;

drop index index_1 on estatus;

drop table if exists estatus;

drop index index_1 on instructores;

drop table if exists instructores;

drop index index_1 on instructores_capacitaciones;

drop table if exists instructores_capacitaciones;

drop index index_1 on medios_comunicacion;

drop index index_2 on medios_comunicacion;

drop index index_3 on medios_comunicacion;

drop table if exists medios_comunicacion;

drop index index_1 on personas;

drop table if exists personas;

drop index index_1 on registros_capacitaciones;

drop index index_2 on registros_capacitaciones;

drop index index_3 on registros_capacitaciones;

drop index index_4 on registros_capacitaciones;

drop index index_5 on registros_capacitaciones;

drop table if exists registros_capacitaciones;

drop index index_1 on sectores_productivos;

drop table if exists sectores_productivos;

drop index index_1 on tipos_capacitaciones;

drop table if exists tipos_capacitaciones;

drop index index_1 on tipos_medios_comunicacion;

drop table if exists tipos_medios_comunicacion;

drop index index_1 on usuarios;

drop index index_2 on usuarios;

drop table if exists usuarios;

/*==============================================================*/
/* Table: calendarios_capacitaciones                            */
/*==============================================================*/
create table calendarios_capacitaciones
(
   id                   int not null,
   capacitacion_id      int,
   fecha_inicio         date,
   fecha_fin            date,
   usuario_registro     int,
   usuario_modifico     int,
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_2                                               */
/*==============================================================*/
create index index_2 on calendarios_capacitaciones
(
   capacitacion_id
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on calendarios_capacitaciones
(
   id
);

/*==============================================================*/
/* Table: capacitaciones                                        */
/*==============================================================*/
create table capacitaciones
(
   id                   int not null,
   categoria_capacitacion_id int,
   tipo_capacitacion_id int,
   nombre               varchar(100),
   descripcion          text,
   img                  varchar(50),
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_3                                               */
/*==============================================================*/
create index index_3 on capacitaciones
(
   tipo_capacitacion_id
);

/*==============================================================*/
/* Index: index_2                                               */
/*==============================================================*/
create index index_2 on capacitaciones
(
   categoria_capacitacion_id
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on capacitaciones
(
   id
);

/*==============================================================*/
/* Table: categorias_capacitaciones                             */
/*==============================================================*/
create table categorias_capacitaciones
(
   id                   int not null,
   nombre               varchar(50),
   descripcion          varchar(500),
   img                  varchar(50),
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on categorias_capacitaciones
(
   id
);

/*==============================================================*/
/* Table: empresas                                              */
/*==============================================================*/
create table empresas
(
   id                   int not null,
   sector_productivo_id int,
   nombre               varchar(50),
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_2                                               */
/*==============================================================*/
create index index_2 on empresas
(
   sector_productivo_id
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on empresas
(
   id
);

/*==============================================================*/
/* Table: especialidades                                        */
/*==============================================================*/
create table especialidades
(
   id                   int not null,
   nombre               varchar(50),
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on especialidades
(
   id
);

/*==============================================================*/
/* Table: estatus                                               */
/*==============================================================*/
create table estatus
(
   id                   int not null,
   nombre               varchar(0),
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on estatus
(
   id
);

/*==============================================================*/
/* Table: instructores                                          */
/*==============================================================*/
create table instructores
(
   id                   int not null,
   cve_persona          int,
   cve_especialidad     int,
   ruta_foto            varchar(50),
   experiencia          varchar(500),
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on instructores
(
   id
);

/*==============================================================*/
/* Table: instructores_capacitaciones                           */
/*==============================================================*/
create table instructores_capacitaciones
(
   cve_instructor       int not null,
   cve_capacitacion     int not null,
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (cve_instructor, cve_capacitacion)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on instructores_capacitaciones
(
   cve_instructor,
   cve_capacitacion
);

/*==============================================================*/
/* Table: medios_comunicacion                                   */
/*==============================================================*/
create table medios_comunicacion
(
   id                   int not null,
   persona_id           int,
   tipo_medio_comunicacion_id int,
   valor                varchar(50),
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_3                                               */
/*==============================================================*/
create index index_3 on medios_comunicacion
(
   tipo_medio_comunicacion_id
);

/*==============================================================*/
/* Index: index_2                                               */
/*==============================================================*/
create index index_2 on medios_comunicacion
(
   persona_id
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on medios_comunicacion
(
   id
);

/*==============================================================*/
/* Table: personas                                              */
/*==============================================================*/
create table personas
(
   id                   int not null,
   nombre               varchar(50),
   ap_paterno           varchar(50),
   ap_materno           varchar(50),
   fecha_nacimiento     date,
   sexo                 char,
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on personas
(
   id
);

/*==============================================================*/
/* Table: registros_capacitaciones                              */
/*==============================================================*/
create table registros_capacitaciones
(
   id                   int not null,
   calendario_capacitacion_id int,
   persona_id           int,
   empresa_id           int,
   estatus_id           int,
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_5                                               */
/*==============================================================*/
create index index_5 on registros_capacitaciones
(
   estatus_id
);

/*==============================================================*/
/* Index: index_4                                               */
/*==============================================================*/
create index index_4 on registros_capacitaciones
(
   empresa_id
);

/*==============================================================*/
/* Index: index_3                                               */
/*==============================================================*/
create index index_3 on registros_capacitaciones
(
   persona_id
);

/*==============================================================*/
/* Index: index_2                                               */
/*==============================================================*/
create index index_2 on registros_capacitaciones
(
   calendario_capacitacion_id
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on registros_capacitaciones
(
   id
);

/*==============================================================*/
/* Table: sectores_productivos                                  */
/*==============================================================*/
create table sectores_productivos
(
   id                   int not null,
   nombre               varchar(50),
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on sectores_productivos
(
   id
);

/*==============================================================*/
/* Table: tipos_capacitaciones                                  */
/*==============================================================*/
create table tipos_capacitaciones
(
   id                   int not null,
   nombre               varchar(50),
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on tipos_capacitaciones
(
   id
);

/*==============================================================*/
/* Table: tipos_medios_comunicacion                             */
/*==============================================================*/
create table tipos_medios_comunicacion
(
   id                   int not null,
   nombre               varchar(50),
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on tipos_medios_comunicacion
(
   id
);

/*==============================================================*/
/* Table: usuarios                                              */
/*==============================================================*/
create table usuarios
(
   id                   int not null,
   nombre               varchar(100),
   login                varchar(15),
   password             varchar(15),
   fecha_registro       datetime,
   fecha_modificacion   datetime,
   activo               bit,
   primary key (id)
);

/*==============================================================*/
/* Index: index_2                                               */
/*==============================================================*/
create index index_2 on usuarios
(
   login,
   password
);

/*==============================================================*/
/* Index: index_1                                               */
/*==============================================================*/
create index index_1 on usuarios
(
   id
);

alter table calendarios_capacitaciones add constraint FK_reference_11 foreign key (usuario_registro)
      references usuarios (id) on delete restrict on update restrict;

alter table calendarios_capacitaciones add constraint FK_reference_12 foreign key (usuario_modifico)
      references usuarios (id) on delete restrict on update restrict;

alter table calendarios_capacitaciones add constraint FK_reference_4 foreign key (capacitacion_id)
      references capacitaciones (id) on delete restrict on update restrict;

alter table capacitaciones add constraint FK_reference_2 foreign key (categoria_capacitacion_id)
      references categorias_capacitaciones (id) on delete restrict on update restrict;

alter table capacitaciones add constraint FK_reference_3 foreign key (tipo_capacitacion_id)
      references tipos_capacitaciones (id) on delete restrict on update restrict;

alter table empresas add constraint FK_reference_1 foreign key (sector_productivo_id)
      references sectores_productivos (id) on delete restrict on update restrict;

alter table instructores add constraint FK_reference_13 foreign key (cve_persona)
      references personas (id) on delete restrict on update restrict;

alter table instructores add constraint FK_reference_14 foreign key (cve_especialidad)
      references especialidades (id) on delete restrict on update restrict;

alter table instructores_capacitaciones add constraint FK_reference_15 foreign key (cve_instructor)
      references instructores (id) on delete restrict on update restrict;

alter table instructores_capacitaciones add constraint FK_reference_16 foreign key (cve_capacitacion)
      references capacitaciones (id) on delete restrict on update restrict;

alter table medios_comunicacion add constraint FK_reference_5 foreign key (persona_id)
      references personas (id) on delete restrict on update restrict;

alter table medios_comunicacion add constraint FK_reference_6 foreign key (tipo_medio_comunicacion_id)
      references tipos_medios_comunicacion (id) on delete restrict on update restrict;

alter table registros_capacitaciones add constraint FK_reference_10 foreign key (estatus_id)
      references estatus (id) on delete restrict on update restrict;

alter table registros_capacitaciones add constraint FK_reference_7 foreign key (calendario_capacitacion_id)
      references calendarios_capacitaciones (id) on delete restrict on update restrict;

alter table registros_capacitaciones add constraint FK_reference_8 foreign key (persona_id)
      references personas (id) on delete restrict on update restrict;

alter table registros_capacitaciones add constraint FK_reference_9 foreign key (empresa_id)
      references empresas (id) on delete restrict on update restrict;

