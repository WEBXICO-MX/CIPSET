/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     10/06/2016 13:25:57                          */
/*==============================================================*/


drop index INDEX_1 on CALENDARIOS_CAPACITACIONES;

drop index INDEX_2 on CALENDARIOS_CAPACITACIONES;

drop table if exists CALENDARIOS_CAPACITACIONES;

drop index INDEX_1 on CAPACITACIONES;

drop index INDEX_2 on CAPACITACIONES;

drop index INDEX_3 on CAPACITACIONES;

drop table if exists CAPACITACIONES;

drop index INDEX_1 on CATEGORIAS_CAPACITACIONES;

drop table if exists CATEGORIAS_CAPACITACIONES;

drop index INDEX_1 on EMPRESAS;

drop index INDEX_2 on EMPRESAS;

drop table if exists EMPRESAS;

drop index INDEX_1 on ESTATUS;

drop table if exists ESTATUS;

drop index INDEX_1 on MEDIOS_COMUNICACION;

drop index INDEX_2 on MEDIOS_COMUNICACION;

drop index INDEX_3 on MEDIOS_COMUNICACION;

drop table if exists MEDIOS_COMUNICACION;

drop index INDEX_1 on PERSONAS;

drop table if exists PERSONAS;

drop index INDEX_1 on REGISTROS_CAPACITACIONES;

drop index INDEX_2 on REGISTROS_CAPACITACIONES;

drop index INDEX_3 on REGISTROS_CAPACITACIONES;

drop index INDEX_4 on REGISTROS_CAPACITACIONES;

drop index INDEX_5 on REGISTROS_CAPACITACIONES;

drop table if exists REGISTROS_CAPACITACIONES;

drop index INDEX_1 on SECTORES_PRODUCTIVOS;

drop table if exists SECTORES_PRODUCTIVOS;

drop index INDEX_1 on TIPOS_CAPACITACIONES;

drop table if exists TIPOS_CAPACITACIONES;

drop index INDEX_1 on TIPOS_MEDIOS_COMUNICACION;

drop table if exists TIPOS_MEDIOS_COMUNICACION;

drop index INDEX_1 on USUARIOS;

drop index INDEX_2 on USUARIOS;

drop table if exists USUARIOS;

/*==============================================================*/
/* Table: CALENDARIOS_CAPACITACIONES                            */
/*==============================================================*/
create table CALENDARIOS_CAPACITACIONES
(
   ID                   int not null,
   CAPACITACION_ID      int,
   FECHA_INICIO         date,
   FECHA_FIN            date,
   USUARIO_REGISTRO     int,
   USUARIO_MODIFICO     int,
   FECHA_REGISTRO       datetime,
   FECHA_MODIFICACION   datetime,
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_2                                               */
/*==============================================================*/
create index INDEX_2 on CALENDARIOS_CAPACITACIONES
(
   CAPACITACION_ID
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on CALENDARIOS_CAPACITACIONES
(
   ID
);

/*==============================================================*/
/* Table: CAPACITACIONES                                        */
/*==============================================================*/
create table CAPACITACIONES
(
   ID                   int not null,
   CATEGORIA_CAPACITACION_ID int,
   TIPO_CAPACITACION_ID int,
   NOMBRE               varchar(100),
   DESCRIPCION          text,
   FECHA_REGISTRO       datetime,
   FECHA_MODIFICACION   datetime,
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_3                                               */
/*==============================================================*/
create index INDEX_3 on CAPACITACIONES
(
   TIPO_CAPACITACION_ID
);

/*==============================================================*/
/* Index: INDEX_2                                               */
/*==============================================================*/
create index INDEX_2 on CAPACITACIONES
(
   CATEGORIA_CAPACITACION_ID
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on CAPACITACIONES
(
   ID
);

/*==============================================================*/
/* Table: CATEGORIAS_CAPACITACIONES                             */
/*==============================================================*/
create table CATEGORIAS_CAPACITACIONES
(
   ID                   int not null,
   NOMBRE               varchar(50),
   DESCRIPCION          varchar(500),
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on CATEGORIAS_CAPACITACIONES
(
   ID
);

/*==============================================================*/
/* Table: EMPRESAS                                              */
/*==============================================================*/
create table EMPRESAS
(
   ID                   int not null,
   SECTOR_PRODUCTIVO_ID int,
   NOMBRE               varchar(50),
   FECHA_REGISTRO       datetime,
   FECHA_MODIFICACION   datetime,
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_2                                               */
/*==============================================================*/
create index INDEX_2 on EMPRESAS
(
   SECTOR_PRODUCTIVO_ID
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on EMPRESAS
(
   ID
);

/*==============================================================*/
/* Table: ESTATUS                                               */
/*==============================================================*/
create table ESTATUS
(
   ID                   int not null,
   NOMBRE               varchar(0),
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on ESTATUS
(
   ID
);

/*==============================================================*/
/* Table: MEDIOS_COMUNICACION                                   */
/*==============================================================*/
create table MEDIOS_COMUNICACION
(
   ID                   int not null,
   PERSONA_ID           int,
   TIPO_MEDIO_COMUNICACION_ID int,
   VALOR                varchar(50),
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_3                                               */
/*==============================================================*/
create index INDEX_3 on MEDIOS_COMUNICACION
(
   TIPO_MEDIO_COMUNICACION_ID
);

/*==============================================================*/
/* Index: INDEX_2                                               */
/*==============================================================*/
create index INDEX_2 on MEDIOS_COMUNICACION
(
   PERSONA_ID
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on MEDIOS_COMUNICACION
(
   ID
);

/*==============================================================*/
/* Table: PERSONAS                                              */
/*==============================================================*/
create table PERSONAS
(
   ID                   int not null,
   NOMBRE               varchar(50),
   AP_PATERNO           varchar(50),
   AP_MATERNO           varchar(50),
   FECHA_NACIMIENTO     date,
   SEXO                 char,
   FECHA_REGISTRO       datetime,
   FECHA_MODIFICACION   datetime,
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on PERSONAS
(
   ID
);

/*==============================================================*/
/* Table: REGISTROS_CAPACITACIONES                              */
/*==============================================================*/
create table REGISTROS_CAPACITACIONES
(
   ID                   int not null,
   CALENDARIO_CAPACITACION_ID int,
   PERSONA_ID           int,
   EMPRESA_ID           int,
   ESTATUS_ID           int,
   FECHA_REGISTRO       datetime,
   FECHA_MODIFICACION   datetime,
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_5                                               */
/*==============================================================*/
create index INDEX_5 on REGISTROS_CAPACITACIONES
(
   ESTATUS_ID
);

/*==============================================================*/
/* Index: INDEX_4                                               */
/*==============================================================*/
create index INDEX_4 on REGISTROS_CAPACITACIONES
(
   EMPRESA_ID
);

/*==============================================================*/
/* Index: INDEX_3                                               */
/*==============================================================*/
create index INDEX_3 on REGISTROS_CAPACITACIONES
(
   PERSONA_ID
);

/*==============================================================*/
/* Index: INDEX_2                                               */
/*==============================================================*/
create index INDEX_2 on REGISTROS_CAPACITACIONES
(
   CALENDARIO_CAPACITACION_ID
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on REGISTROS_CAPACITACIONES
(
   ID
);

/*==============================================================*/
/* Table: SECTORES_PRODUCTIVOS                                  */
/*==============================================================*/
create table SECTORES_PRODUCTIVOS
(
   ID                   int not null,
   NOMBRE               varchar(50),
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on SECTORES_PRODUCTIVOS
(
   ID
);

/*==============================================================*/
/* Table: TIPOS_CAPACITACIONES                                  */
/*==============================================================*/
create table TIPOS_CAPACITACIONES
(
   ID                   int not null,
   NOMBRE               varchar(50),
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on TIPOS_CAPACITACIONES
(
   ID
);

/*==============================================================*/
/* Table: TIPOS_MEDIOS_COMUNICACION                             */
/*==============================================================*/
create table TIPOS_MEDIOS_COMUNICACION
(
   ID                   int not null,
   NOMBRE               varchar(50),
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on TIPOS_MEDIOS_COMUNICACION
(
   ID
);

/*==============================================================*/
/* Table: USUARIOS                                              */
/*==============================================================*/
create table USUARIOS
(
   ID                   int not null,
   NOMBRE               varchar(100),
   LOGIN                varchar(15),
   PASSWORD             varchar(15),
   FECHA_REGISTRO       datetime,
   FECHA_MODIFICACION   datetime,
   ACTIVO               bit,
   primary key (ID)
);

/*==============================================================*/
/* Index: INDEX_2                                               */
/*==============================================================*/
create index INDEX_2 on USUARIOS
(
   LOGIN,
   PASSWORD
);

/*==============================================================*/
/* Index: INDEX_1                                               */
/*==============================================================*/
create index INDEX_1 on USUARIOS
(
   ID
);

alter table CALENDARIOS_CAPACITACIONES add constraint FK_REFERENCE_11 foreign key (USUARIO_REGISTRO)
      references USUARIOS (ID) on delete restrict on update restrict;

alter table CALENDARIOS_CAPACITACIONES add constraint FK_REFERENCE_12 foreign key (USUARIO_MODIFICO)
      references USUARIOS (ID) on delete restrict on update restrict;

alter table CALENDARIOS_CAPACITACIONES add constraint FK_REFERENCE_4 foreign key (CAPACITACION_ID)
      references CAPACITACIONES (ID) on delete restrict on update restrict;

alter table CAPACITACIONES add constraint FK_REFERENCE_2 foreign key (CATEGORIA_CAPACITACION_ID)
      references CATEGORIAS_CAPACITACIONES (ID) on delete restrict on update restrict;

alter table CAPACITACIONES add constraint FK_REFERENCE_3 foreign key (TIPO_CAPACITACION_ID)
      references TIPOS_CAPACITACIONES (ID) on delete restrict on update restrict;

alter table EMPRESAS add constraint FK_REFERENCE_1 foreign key (SECTOR_PRODUCTIVO_ID)
      references SECTORES_PRODUCTIVOS (ID) on delete restrict on update restrict;

alter table MEDIOS_COMUNICACION add constraint FK_REFERENCE_5 foreign key (PERSONA_ID)
      references PERSONAS (ID) on delete restrict on update restrict;

alter table MEDIOS_COMUNICACION add constraint FK_REFERENCE_6 foreign key (TIPO_MEDIO_COMUNICACION_ID)
      references TIPOS_MEDIOS_COMUNICACION (ID) on delete restrict on update restrict;

alter table REGISTROS_CAPACITACIONES add constraint FK_REFERENCE_10 foreign key (ESTATUS_ID)
      references ESTATUS (ID) on delete restrict on update restrict;

alter table REGISTROS_CAPACITACIONES add constraint FK_REFERENCE_7 foreign key (CALENDARIO_CAPACITACION_ID)
      references CALENDARIOS_CAPACITACIONES (ID) on delete restrict on update restrict;

alter table REGISTROS_CAPACITACIONES add constraint FK_REFERENCE_8 foreign key (PERSONA_ID)
      references PERSONAS (ID) on delete restrict on update restrict;

alter table REGISTROS_CAPACITACIONES add constraint FK_REFERENCE_9 foreign key (EMPRESA_ID)
      references EMPRESAS (ID) on delete restrict on update restrict;

