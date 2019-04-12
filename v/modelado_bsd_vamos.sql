-- =============================================================================
-- Diagram Name: modelado_bsd_vamos
-- Created on: 19/09/2016 12:02:04 a. m.
-- Diagram Version: 
-- =============================================================================


CREATE TABLE "cliente" (
	"id_cliente" varchar NOT NULL,
	"nombre" varchar(100),
	"apellido" varchar(100),
	"tel_movil" varchar(50),
	"password" varchar(500),
	"e_mail" varchar(100),
	PRIMARY KEY("id_cliente")
);

CREATE TABLE "plan_viaje" (
	"id_plan_viaje" BIGSERIAL NOT NULL,
	"fecha" date,
	"hora_salida" time,
	"id_sitio" int8 NOT NULL,
	"id_cliente" varchar NOT NULL,
	"modo_viaje" int2,
	"estado" int4,
	"cupos" int2,
	PRIMARY KEY("id_plan_viaje")
);

COMMENT ON COLUMN "plan_viaje"."id_sitio" IS 'Crear otro como este, campo, uno origen y otro destino';

COMMENT ON COLUMN "plan_viaje"."modo_viaje" IS '0=Vehiculo Propio
1=Pasajero';

COMMENT ON COLUMN "plan_viaje"."estado" IS 'Ya sali
No fui
Esperando la Hora';

COMMENT ON COLUMN "plan_viaje"."cupos" IS 'Cupos apartar ó cupos disponibles';

CREATE TABLE "grupo_viaje" (
	"id_grupo" BIGSERIAL NOT NULL,
	"nombre_grupo" varchar(100),
	"idciudad" varchar(10) NOT NULL,
	PRIMARY KEY("id_grupo")
);

CREATE TABLE "ciudad" (
	"idciudad" varchar(10) NOT NULL,
	"nombre_ciudad" varchar(100),
	"id_departament" varchar(5) NOT NULL,
	PRIMARY KEY("idciudad")
);

CREATE TABLE "departamento" (
	"id_departament" varchar(5) NOT NULL,
	"nombre_departamento" varchar(100),
	PRIMARY KEY("id_departament")
);

CREATE TABLE "grupo_cliente" (
	"id_cliente" varchar NOT NULL,
	"id_grupo" int8 NOT NULL,
	"id_grupo_cliente" BIGSERIAL NOT NULL,
	PRIMARY KEY("id_grupo_cliente")
);

CREATE TABLE "sitios" (
	"id_sitio" BIGSERIAL NOT NULL,
	"nombre_sitio" varchar,
	"id_grupo" int8 NOT NULL,
	PRIMARY KEY("id_sitio")
);

CREATE TABLE "viaje_grupal" (
	"id_cliente" varchar NOT NULL,
	"id_plan_viaje" int8 NOT NULL
);

CREATE TABLE "calificaciones" (
	"id_cliente" varchar NOT NULL,
	"calificacion" int2,
	"id_plan_viaje" int8 NOT NULL
);


ALTER TABLE "plan_viaje" ADD CONSTRAINT "plan_viaje__sitios" FOREIGN KEY ("id_sitio")
	REFERENCES "sitios"("id_sitio")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "plan_viaje" ADD CONSTRAINT "plan_viaje___sitios" FOREIGN KEY ("id_sitio")
	REFERENCES "sitios"("id_sitio")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "plan_viaje" ADD CONSTRAINT "plan_viaje___cliente" FOREIGN KEY ("id_cliente")
	REFERENCES "cliente"("id_cliente")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "grupo_viaje" ADD CONSTRAINT "grupo_viaje_ciudad" FOREIGN KEY ("idciudad")
	REFERENCES "ciudad"("idciudad")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "ciudad" ADD CONSTRAINT "ciudad_departamento" FOREIGN KEY ("id_departament")
	REFERENCES "departamento"("id_departament")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "grupo_cliente" ADD CONSTRAINT "cliente_grupocliente" FOREIGN KEY ("id_cliente")
	REFERENCES "cliente"("id_cliente")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "grupo_cliente" ADD CONSTRAINT "grupo_cliente__grupo_viaje" FOREIGN KEY ("id_grupo")
	REFERENCES "grupo_viaje"("id_grupo")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "sitios" ADD CONSTRAINT "sitios__grupo_viaje" FOREIGN KEY ("id_grupo")
	REFERENCES "grupo_viaje"("id_grupo")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "viaje_grupal" ADD CONSTRAINT "viaje_grupal___cliente" FOREIGN KEY ("id_cliente")
	REFERENCES "cliente"("id_cliente")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "viaje_grupal" ADD CONSTRAINT "viaje_grupal__plan_viaje" FOREIGN KEY ("id_plan_viaje")
	REFERENCES "plan_viaje"("id_plan_viaje")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "calificaciones" ADD CONSTRAINT "calificacines__cliente" FOREIGN KEY ("id_cliente")
	REFERENCES "cliente"("id_cliente")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;

ALTER TABLE "calificaciones" ADD CONSTRAINT "calificaciones__plan_viaje" FOREIGN KEY ("id_plan_viaje")
	REFERENCES "plan_viaje"("id_plan_viaje")
	MATCH SIMPLE
	ON DELETE NO ACTION
	ON UPDATE NO ACTION
	NOT DEFERRABLE;


