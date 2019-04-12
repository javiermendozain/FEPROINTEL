--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: calificaciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE calificaciones (
    id_cliente character varying NOT NULL,
    calificacion smallint,
    id_plan_viaje bigint NOT NULL
);


ALTER TABLE calificaciones OWNER TO postgres;

--
-- Name: chat; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE chat (
    id integer NOT NULL,
    nombre character varying(255),
    mensaje character varying(255),
    fecha timestamp without time zone
);


ALTER TABLE chat OWNER TO postgres;

--
-- Name: chat_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE chat_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE chat_id_seq OWNER TO postgres;

--
-- Name: chat_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE chat_id_seq OWNED BY chat.id;


--
-- Name: ciudad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ciudad (
    idciudad character varying(10) NOT NULL,
    nombre_ciudad character varying(100),
    id_departament character varying(5) NOT NULL
);


ALTER TABLE ciudad OWNER TO postgres;

--
-- Name: cliente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE cliente (
    id_cliente character varying NOT NULL,
    nombre character varying(100),
    apellido character varying(100),
    tel_movil character varying(50),
    password character varying(500),
    e_mail character varying(100)
);


ALTER TABLE cliente OWNER TO postgres;

--
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE departamento (
    id_departament character varying(5) NOT NULL,
    nombre_departamento character varying(100)
);


ALTER TABLE departamento OWNER TO postgres;

--
-- Name: grupo_cliente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE grupo_cliente (
    id_cliente character varying NOT NULL,
    id_grupo bigint NOT NULL,
    id_grupo_cliente bigint NOT NULL
);


ALTER TABLE grupo_cliente OWNER TO postgres;

--
-- Name: grupo_cliente_id_grupo_cliente_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE grupo_cliente_id_grupo_cliente_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo_cliente_id_grupo_cliente_seq OWNER TO postgres;

--
-- Name: grupo_cliente_id_grupo_cliente_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE grupo_cliente_id_grupo_cliente_seq OWNED BY grupo_cliente.id_grupo_cliente;


--
-- Name: grupo_viaje; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE grupo_viaje (
    id_grupo bigint NOT NULL,
    nombre_grupo character varying(100),
    idciudad character varying(10)
);


ALTER TABLE grupo_viaje OWNER TO postgres;

--
-- Name: grupo_viaje_id_grupo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE grupo_viaje_id_grupo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE grupo_viaje_id_grupo_seq OWNER TO postgres;

--
-- Name: grupo_viaje_id_grupo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE grupo_viaje_id_grupo_seq OWNED BY grupo_viaje.id_grupo;


--
-- Name: historial_viaje; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE historial_viaje (
    id_plan_viaje bigint NOT NULL,
    fecha date,
    hora_salida time without time zone,
    id_sitio bigint NOT NULL,
    id_cliente character varying NOT NULL,
    modo_viaje smallint,
    estado integer,
    cupos smallint,
    id_sitio_destino bigint
);


ALTER TABLE historial_viaje OWNER TO postgres;

--
-- Name: historial_viaje_id_plan_viaje_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE historial_viaje_id_plan_viaje_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE historial_viaje_id_plan_viaje_seq OWNER TO postgres;

--
-- Name: historial_viaje_id_plan_viaje_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE historial_viaje_id_plan_viaje_seq OWNED BY historial_viaje.id_plan_viaje;


--
-- Name: plan_viaje; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plan_viaje (
    id_plan_viaje bigint NOT NULL,
    fecha date,
    hora_salida time without time zone,
    id_sitio bigint,
    id_cliente character varying,
    modo_viaje smallint,
    estado smallint,
    cupos smallint,
    id_sitio_destino bigint,
    tipo_plan smallint,
    dia_semana smallint,
    costo double precision
);


ALTER TABLE plan_viaje OWNER TO postgres;

--
-- Name: COLUMN plan_viaje.id_sitio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN plan_viaje.id_sitio IS 'Crear otro como este, campo, uno origen y otro destino';


--
-- Name: COLUMN plan_viaje.modo_viaje; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN plan_viaje.modo_viaje IS '0=Vehiculo Propio
1=Pasajero';


--
-- Name: COLUMN plan_viaje.estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN plan_viaje.estado IS 'Ya sali
No fui
Esperando la Hora';


--
-- Name: COLUMN plan_viaje.cupos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN plan_viaje.cupos IS 'Cupos apartar ó cupos disponibles';


--
-- Name: COLUMN plan_viaje.tipo_plan; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN plan_viaje.tipo_plan IS 'frecuente  o solo una vez';


--
-- Name: COLUMN plan_viaje.dia_semana; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN plan_viaje.dia_semana IS 'Para planes frecuentes!';


--
-- Name: plan_viaje_id_plan_viaje_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE plan_viaje_id_plan_viaje_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE plan_viaje_id_plan_viaje_seq OWNER TO postgres;

--
-- Name: plan_viaje_id_plan_viaje_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE plan_viaje_id_plan_viaje_seq OWNED BY plan_viaje.id_plan_viaje;


--
-- Name: sitios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sitios (
    id_sitio bigint NOT NULL,
    nombre_sitio character varying,
    id_grupo bigint NOT NULL
);


ALTER TABLE sitios OWNER TO postgres;

--
-- Name: sitios_id_sitio_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sitios_id_sitio_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE sitios_id_sitio_seq OWNER TO postgres;

--
-- Name: sitios_id_sitio_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE sitios_id_sitio_seq OWNED BY sitios.id_sitio;


--
-- Name: viaje_grupal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE viaje_grupal (
    id_cliente character varying NOT NULL,
    id_plan_viaje bigint NOT NULL
);


ALTER TABLE viaje_grupal OWNER TO postgres;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY chat ALTER COLUMN id SET DEFAULT nextval('chat_id_seq'::regclass);


--
-- Name: id_grupo_cliente; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_cliente ALTER COLUMN id_grupo_cliente SET DEFAULT nextval('grupo_cliente_id_grupo_cliente_seq'::regclass);


--
-- Name: id_grupo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_viaje ALTER COLUMN id_grupo SET DEFAULT nextval('grupo_viaje_id_grupo_seq'::regclass);


--
-- Name: id_plan_viaje; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY historial_viaje ALTER COLUMN id_plan_viaje SET DEFAULT nextval('historial_viaje_id_plan_viaje_seq'::regclass);


--
-- Name: id_plan_viaje; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY plan_viaje ALTER COLUMN id_plan_viaje SET DEFAULT nextval('plan_viaje_id_plan_viaje_seq'::regclass);


--
-- Name: id_sitio; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sitios ALTER COLUMN id_sitio SET DEFAULT nextval('sitios_id_sitio_seq'::regclass);


--
-- Data for Name: calificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: chat; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO chat (id, nombre, mensaje, fecha) VALUES (4, 'sdsdfsd', 'sdfsd', NULL);
INSERT INTO chat (id, nombre, mensaje, fecha) VALUES (5, 'sdsdfsd', 'sdfsd', NULL);
INSERT INTO chat (id, nombre, mensaje, fecha) VALUES (6, 'sdsdfsd', 'sdfsd', NULL);


--
-- Name: chat_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('chat_id_seq', 6, true);


--
-- Data for Name: ciudad; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('﻿1', 'MEDELLIN', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('2', 'ABEJORRAL', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('3', 'ABRIAQUI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('4', 'ALEJANDRIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('5', 'AMAGA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('6', 'AMALFI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('7', 'ANDES', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('8', 'ANGELOPOLIS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('9', 'ANGOSTURA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('10', 'ANORI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('11', 'SANTAFE DE ANTIOQUIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('12', 'ANZA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('13', 'APARTADO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('14', 'ARBOLETES', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('15', 'ARGELIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('16', 'ARMENIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('17', 'BARBOSA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('18', 'BELMIRA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('19', 'BELLO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('20', 'BETANIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('21', 'BETULIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('22', 'CIUDAD BOLIVAR', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('23', 'BRICEÑO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('24', 'BURITICA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('25', 'CACERES', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('26', 'CAICEDO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('27', 'CALDAS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('28', 'CAMPAMENTO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('29', 'CAÑASGORDAS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('30', 'CARACOLI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('31', 'CARAMANTA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('32', 'CAREPA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('33', 'EL CARMEN DE VIBORAL', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('34', 'CAROLINA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('35', 'CAUCASIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('36', 'CHIGORODO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('37', 'CISNEROS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('38', 'COCORNA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('39', 'CONCEPCION', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('40', 'CONCORDIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('41', 'COPACABANA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('42', 'DABEIBA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('43', 'DON MATIAS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('44', 'EBEJICO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('45', 'EL BAGRE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('46', 'ENTRERRIOS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('47', 'ENVIGADO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('48', 'FREDONIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('49', 'FRONTINO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('50', 'GIRALDO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('51', 'GIRARDOTA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('52', 'GOMEZ PLATA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('53', 'GRANADA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('54', 'GUADALUPE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('55', 'GUARNE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('56', 'GUATAPE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('57', 'HELICONIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('58', 'HISPANIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('59', 'ITAGUI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('60', 'ITUANGO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('61', 'JARDIN', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('62', 'JERICO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('63', 'LA CEJA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('64', 'LA ESTRELLA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('65', 'LA PINTADA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('66', 'LA UNION', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('67', 'LIBORINA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('68', 'MACEO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('69', 'MARINILLA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('70', 'MONTEBELLO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('71', 'MURINDO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('72', 'MUTATA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('73', 'NARIÑO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('74', 'NECOCLI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('75', 'NECHI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('76', 'OLAYA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('77', 'PEÐOL', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('78', 'PEQUE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('79', 'PUEBLORRICO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('80', 'PUERTO BERRIO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('81', 'PUERTO NARE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('82', 'PUERTO TRIUNFO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('83', 'REMEDIOS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('84', 'RETIRO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('85', 'RIONEGRO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('86', 'SABANALARGA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('87', 'SABANETA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('88', 'SALGAR', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('89', 'SAN ANDRES DE CUERQUIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('90', 'SAN CARLOS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('91', 'SAN FRANCISCO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('92', 'SAN JERONIMO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('93', 'SAN JOSE DE LA MONTAÑA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('94', 'SAN JUAN DE URABA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('95', 'SAN LUIS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('96', 'SAN PEDRO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('97', 'SAN PEDRO DE URABA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('98', 'SAN RAFAEL', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('99', 'SAN ROQUE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('100', 'SAN VICENTE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('101', 'SANTA BARBARA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('102', 'SANTA ROSA DE OSOS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('103', 'SANTO DOMINGO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('104', 'EL SANTUARIO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('105', 'SEGOVIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('106', 'SONSON', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('107', 'SOPETRAN', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('108', 'TAMESIS', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('109', 'TARAZA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('110', 'TARSO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('111', 'TITIRIBI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('112', 'TOLEDO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('113', 'TURBO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('114', 'URAMITA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('115', 'URRAO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('116', 'VALDIVIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('117', 'VALPARAISO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('118', 'VEGACHI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('119', 'VENECIA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('120', 'VIGIA DEL FUERTE', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('121', 'YALI', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('122', 'YARUMAL', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('123', 'YOLOMBO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('124', 'YONDO', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('125', 'ZARAGOZA', '05');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('126', 'BARRANQUILLA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('127', 'BARANOA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('128', 'CAMPO DE LA CRUZ', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('129', 'CANDELARIA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('130', 'GALAPA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('131', 'JUAN DE ACOSTA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('132', 'LURUACO', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('133', 'MALAMBO', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('134', 'MANATI', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('135', 'PALMAR DE VARELA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('136', 'PIOJO', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('137', 'POLONUEVO', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('138', 'PONEDERA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('139', 'PUERTO COLOMBIA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('140', 'REPELON', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('141', 'SABANAGRANDE', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('142', 'SABANALARGA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('143', 'SANTA LUCIA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('144', 'SANTO TOMAS', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('145', 'SOLEDAD', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('146', 'SUAN', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('147', 'TUBARA', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('148', 'USIACURI', '08');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('149', 'BOGOTA, D.C.', '11');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('150', 'CARTAGENA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('151', 'ACHI', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('152', 'ALTOS DEL ROSARIO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('153', 'ARENAL', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('154', 'ARJONA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('155', 'ARROYOHONDO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('156', 'BARRANCO DE LOBA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('157', 'CALAMAR', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('158', 'CANTAGALLO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('159', 'CICUCO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('160', 'CORDOBA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('161', 'CLEMENCIA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('162', 'EL CARMEN DE BOLIVAR', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('163', 'EL GUAMO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('164', 'EL PEÑON', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('165', 'HATILLO DE LOBA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('166', 'MAGANGUE', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('167', 'MAHATES', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('168', 'MARGARITA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('169', 'MARIA LA BAJA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('170', 'MONTECRISTO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('171', 'MOMPOS', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('172', 'NOROSI', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('173', 'MORALES', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('174', 'PINILLOS', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('175', 'REGIDOR', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('176', 'RIO VIEJO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('177', 'SAN CRISTOBAL', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('178', 'SAN ESTANISLAO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('179', 'SAN FERNANDO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('180', 'SAN JACINTO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('181', 'SAN JACINTO DEL CAUCA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('182', 'SAN JUAN NEPOMUCENO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('183', 'SAN MARTIN DE LOBA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('184', 'SAN PABLO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('185', 'SANTA CATALINA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('186', 'SANTA ROSA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('187', 'SANTA ROSA DEL SUR', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('188', 'SIMITI', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('189', 'SOPLAVIENTO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('190', 'TALAIGUA NUEVO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('191', 'TIQUISIO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('192', 'TURBACO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('193', 'TURBANA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('194', 'VILLANUEVA', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('195', 'ZAMBRANO', '13');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('196', 'TUNJA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('197', 'ALMEIDA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('198', 'AQUITANIA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('199', 'ARCABUCO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('200', 'BELEN', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('201', 'BERBEO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('202', 'BETEITIVA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('203', 'BOAVITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('204', 'BOYACA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('205', 'BRICEÑO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('206', 'BUENAVISTA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('207', 'BUSBANZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('208', 'CALDAS', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('209', 'CAMPOHERMOSO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('210', 'CERINZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('211', 'CHINAVITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('212', 'CHIQUINQUIRA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('213', 'CHISCAS', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('214', 'CHITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('215', 'CHITARAQUE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('216', 'CHIVATA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('217', 'CIENEGA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('218', 'COMBITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('219', 'COPER', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('220', 'CORRALES', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('221', 'COVARACHIA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('222', 'CUBARA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('223', 'CUCAITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('224', 'CUITIVA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('225', 'CHIQUIZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('226', 'CHIVOR', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('227', 'DUITAMA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('228', 'EL COCUY', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('229', 'EL ESPINO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('230', 'FIRAVITOBA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('231', 'FLORESTA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('232', 'GACHANTIVA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('233', 'GAMEZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('234', 'GARAGOA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('235', 'GUACAMAYAS', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('236', 'GUATEQUE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('237', 'GUAYATA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('238', 'GsICAN', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('239', 'IZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('240', 'JENESANO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('241', 'JERICO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('242', 'LABRANZAGRANDE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('243', 'LA CAPILLA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('244', 'LA VICTORIA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('245', 'LA UVITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('246', 'VILLA DE LEYVA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('247', 'MACANAL', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('248', 'MARIPI', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('249', 'MIRAFLORES', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('250', 'MONGUA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('251', 'MONGUI', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('252', 'MONIQUIRA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('253', 'MOTAVITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('254', 'MUZO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('255', 'NOBSA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('256', 'NUEVO COLON', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('257', 'OICATA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('258', 'OTANCHE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('259', 'PACHAVITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('260', 'PAEZ', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('261', 'PAIPA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('262', 'PAJARITO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('263', 'PANQUEBA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('264', 'PAUNA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('265', 'PAYA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('266', 'PAZ DE RIO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('267', 'PESCA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('268', 'PISBA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('269', 'PUERTO BOYACA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('270', 'QUIPAMA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('271', 'RAMIRIQUI', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('272', 'RAQUIRA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('273', 'RONDON', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('274', 'SABOYA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('275', 'SACHICA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('276', 'SAMACA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('277', 'SAN EDUARDO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('278', 'SAN JOSE DE PARE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('279', 'SAN LUIS DE GACENO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('280', 'SAN MATEO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('281', 'SAN MIGUEL DE SEMA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('282', 'SAN PABLO DE BORBUR', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('283', 'SANTANA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('284', 'SANTA MARIA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('285', 'SANTA ROSA DE VITERBO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('286', 'SANTA SOFIA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('287', 'SATIVANORTE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('288', 'SATIVASUR', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('289', 'SIACHOQUE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('290', 'SOATA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('291', 'SOCOTA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('292', 'SOCHA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('293', 'SOGAMOSO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('294', 'SOMONDOCO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('295', 'SORA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('296', 'SOTAQUIRA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('297', 'SORACA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('298', 'SUSACON', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('299', 'SUTAMARCHAN', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('300', 'SUTATENZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('301', 'TASCO', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('302', 'TENZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('303', 'TIBANA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('304', 'TIBASOSA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('305', 'TINJACA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('306', 'TIPACOQUE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('307', 'TOCA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('308', 'TOGsI', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('309', 'TOPAGA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('310', 'TOTA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('311', 'TUNUNGUA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('312', 'TURMEQUE', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('313', 'TUTA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('314', 'TUTAZA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('315', 'UMBITA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('316', 'VENTAQUEMADA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('317', 'VIRACACHA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('318', 'ZETAQUIRA', '15');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('319', 'MANIZALES', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('320', 'AGUADAS', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('321', 'ANSERMA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('322', 'ARANZAZU', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('323', 'BELALCAZAR', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('324', 'CHINCHINA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('325', 'FILADELFIA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('326', 'LA DORADA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('327', 'LA MERCED', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('328', 'MANZANARES', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('329', 'MARMATO', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('330', 'MARQUETALIA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('331', 'MARULANDA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('332', 'NEIRA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('333', 'NORCASIA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('334', 'PACORA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('335', 'PALESTINA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('336', 'PENSILVANIA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('337', 'RIOSUCIO', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('338', 'RISARALDA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('339', 'SALAMINA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('340', 'SAMANA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('341', 'SAN JOSE', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('342', 'SUPIA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('343', 'VICTORIA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('344', 'VILLAMARIA', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('345', 'VITERBO', '17');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('346', 'FLORENCIA', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('347', 'ALBANIA', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('348', 'BELEN DE LOS ANDAQUIES', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('349', 'CARTAGENA DEL CHAIRA', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('350', 'CURILLO', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('351', 'EL DONCELLO', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('352', 'EL PAUJIL', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('353', 'LA MONTAÑITA', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('354', 'MILAN', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('355', 'MORELIA', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('356', 'PUERTO RICO', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('357', 'SAN JOSE DEL FRAGUA', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('358', 'SAN VICENTE DEL CAGUAN', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('359', 'SOLANO', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('360', 'SOLITA', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('361', 'VALPARAISO', '18');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('362', 'POPAYAN', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('363', 'ALMAGUER', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('364', 'ARGELIA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('365', 'BALBOA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('366', 'BOLIVAR', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('367', 'BUENOS AIRES', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('368', 'CAJIBIO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('369', 'CALDONO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('370', 'CALOTO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('371', 'CORINTO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('372', 'EL TAMBO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('373', 'FLORENCIA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('374', 'GUACHENE', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('375', 'GUAPI', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('376', 'INZA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('377', 'JAMBALO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('378', 'LA SIERRA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('379', 'LA VEGA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('380', 'LOPEZ', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('381', 'MERCADERES', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('382', 'MIRANDA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('383', 'MORALES', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('384', 'PADILLA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('385', 'PAEZ', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('386', 'PATIA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('387', 'PIAMONTE', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('388', 'PIENDAMO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('389', 'PUERTO TEJADA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('390', 'PURACE', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('391', 'ROSAS', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('392', 'SAN SEBASTIAN', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('393', 'SANTANDER DE QUILICHAO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('394', 'SANTA ROSA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('395', 'SILVIA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('396', 'SOTARA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('397', 'SUAREZ', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('398', 'SUCRE', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('399', 'TIMBIO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('400', 'TIMBIQUI', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('401', 'TORIBIO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('402', 'TOTORO', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('403', 'VILLA RICA', '19');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('404', 'VALLEDUPAR', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('405', 'AGUACHICA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('406', 'AGUSTIN CODAZZI', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('407', 'ASTREA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('408', 'BECERRIL', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('409', 'BOSCONIA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('410', 'CHIMICHAGUA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('411', 'CHIRIGUANA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('412', 'CURUMANI', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('413', 'EL COPEY', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('414', 'EL PASO', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('415', 'GAMARRA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('416', 'GONZALEZ', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('417', 'LA GLORIA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('418', 'LA JAGUA DE IBIRICO', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('419', 'MANAURE', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('420', 'PAILITAS', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('421', 'PELAYA', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('422', 'PUEBLO BELLO', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('423', 'RIO DE ORO', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('424', 'LA PAZ', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('425', 'SAN ALBERTO', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('426', 'SAN DIEGO', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('427', 'SAN MARTIN', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('428', 'TAMALAMEQUE', '20');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('429', 'MONTERIA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('430', 'AYAPEL', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('431', 'BUENAVISTA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('432', 'CANALETE', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('433', 'CERETE', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('434', 'CHIMA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('435', 'CHINU', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('436', 'CIENAGA DE ORO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('437', 'COTORRA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('438', 'LA APARTADA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('439', 'LORICA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('440', 'LOS CORDOBAS', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('441', 'MOMIL', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('442', 'MONTELIBANO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('443', 'MOÑITOS', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('444', 'PLANETA RICA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('445', 'PUEBLO NUEVO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('446', 'PUERTO ESCONDIDO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('447', 'PUERTO LIBERTADOR', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('448', 'PURISIMA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('449', 'SAHAGUN', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('450', 'SAN ANDRES SOTAVENTO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('451', 'SAN ANTERO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('452', 'SAN BERNARDO DEL VIENTO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('453', 'SAN CARLOS', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('454', 'SAN PELAYO', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('455', 'TIERRALTA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('456', 'VALENCIA', '23');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('457', 'AGUA DE DIOS', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('458', 'ALBAN', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('459', 'ANAPOIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('460', 'ANOLAIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('461', 'ARBELAEZ', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('462', 'BELTRAN', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('463', 'BITUIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('464', 'BOJACA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('465', 'CABRERA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('466', 'CACHIPAY', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('467', 'CAJICA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('468', 'CAPARRAPI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('469', 'CAQUEZA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('470', 'CARMEN DE CARUPA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('471', 'CHAGUANI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('472', 'CHIA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('473', 'CHIPAQUE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('474', 'CHOACHI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('475', 'CHOCONTA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('476', 'COGUA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('477', 'COTA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('478', 'CUCUNUBA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('479', 'EL COLEGIO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('480', 'EL PEÑON', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('481', 'EL ROSAL', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('482', 'FACATATIVA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('483', 'FOMEQUE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('484', 'FOSCA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('485', 'FUNZA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('486', 'FUQUENE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('487', 'FUSAGASUGA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('488', 'GACHALA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('489', 'GACHANCIPA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('490', 'GACHETA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('491', 'GAMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('492', 'GIRARDOT', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('493', 'GRANADA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('494', 'GUACHETA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('495', 'GUADUAS', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('496', 'GUASCA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('497', 'GUATAQUI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('498', 'GUATAVITA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('499', 'GUAYABAL DE SIQUIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('500', 'GUAYABETAL', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('501', 'GUTIERREZ', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('502', 'JERUSALEN', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('503', 'JUNIN', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('504', 'LA CALERA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('505', 'LA MESA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('506', 'LA PALMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('507', 'LA PEÑA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('508', 'LA VEGA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('509', 'LENGUAZAQUE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('510', 'MACHETA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('511', 'MADRID', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('512', 'MANTA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('513', 'MEDINA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('514', 'MOSQUERA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('515', 'NARIÑO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('516', 'NEMOCON', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('517', 'NILO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('518', 'NIMAIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('519', 'NOCAIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('520', 'VENECIA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('521', 'PACHO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('522', 'PAIME', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('523', 'PANDI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('524', 'PARATEBUENO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('525', 'PASCA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('526', 'PUERTO SALGAR', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('527', 'PULI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('528', 'QUEBRADANEGRA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('529', 'QUETAME', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('530', 'QUIPILE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('531', 'APULO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('532', 'RICAURTE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('533', 'SAN ANTONIO DEL TEQUENDAMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('534', 'SAN BERNARDO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('535', 'SAN CAYETANO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('536', 'SAN FRANCISCO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('537', 'SAN JUAN DE RIO SECO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('538', 'SASAIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('539', 'SESQUILE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('540', 'SIBATE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('541', 'SILVANIA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('542', 'SIMIJACA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('543', 'SOACHA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('544', 'SOPO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('545', 'SUBACHOQUE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('546', 'SUESCA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('547', 'SUPATA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('548', 'SUSA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('549', 'SUTATAUSA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('550', 'TABIO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('551', 'TAUSA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('552', 'TENA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('553', 'TENJO', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('554', 'TIBACUY', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('555', 'TIBIRITA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('556', 'TOCAIMA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('557', 'TOCANCIPA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('558', 'TOPAIPI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('559', 'UBALA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('560', 'UBAQUE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('561', 'VILLA DE SAN DIEGO DE UBATE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('562', 'UNE', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('563', 'UTICA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('564', 'VERGARA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('565', 'VIANI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('566', 'VILLAGOMEZ', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('567', 'VILLAPINZON', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('568', 'VILLETA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('569', 'VIOTA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('570', 'YACOPI', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('571', 'ZIPACON', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('572', 'ZIPAQUIRA', '25');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('573', 'QUIBDO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('574', 'ACANDI', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('575', 'ALTO BAUDO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('576', 'ATRATO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('577', 'BAGADO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('578', 'BAHIA SOLANO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('579', 'BAJO BAUDO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('580', 'BOJAYA', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('581', 'EL CANTON DEL SAN PABLO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('582', 'CARMEN DEL DARIEN', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('583', 'CERTEGUI', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('584', 'CONDOTO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('585', 'EL CARMEN DE ATRATO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('586', 'EL LITORAL DEL SAN JUAN', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('587', 'ISTMINA', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('588', 'JURADO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('589', 'LLORO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('590', 'MEDIO ATRATO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('591', 'MEDIO BAUDO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('592', 'MEDIO SAN JUAN', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('593', 'NOVITA', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('594', 'NUQUI', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('595', 'RIO IRO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('596', 'RIO QUITO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('597', 'RIOSUCIO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('598', 'SAN JOSE DEL PALMAR', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('599', 'SIPI', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('600', 'TADO', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('601', 'UNGUIA', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('602', 'UNION PANAMERICANA', '27');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('603', 'NEIVA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('604', 'ACEVEDO', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('605', 'AGRADO', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('606', 'AIPE', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('607', 'ALGECIRAS', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('608', 'ALTAMIRA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('609', 'BARAYA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('610', 'CAMPOALEGRE', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('611', 'COLOMBIA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('612', 'ELIAS', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('613', 'GARZON', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('614', 'GIGANTE', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('615', 'GUADALUPE', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('616', 'HOBO', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('617', 'IQUIRA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('618', 'ISNOS', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('619', 'LA ARGENTINA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('620', 'LA PLATA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('621', 'NATAGA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('622', 'OPORAPA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('623', 'PAICOL', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('624', 'PALERMO', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('625', 'PALESTINA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('626', 'PITAL', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('627', 'PITALITO', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('628', 'RIVERA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('629', 'SALADOBLANCO', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('630', 'SAN AGUSTIN', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('631', 'SANTA MARIA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('632', 'SUAZA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('633', 'TARQUI', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('634', 'TESALIA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('635', 'TELLO', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('636', 'TERUEL', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('637', 'TIMANA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('638', 'VILLAVIEJA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('639', 'YAGUARA', '41');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('640', 'RIOHACHA', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('641', 'ALBANIA', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('642', 'BARRANCAS', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('643', 'DIBULLA', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('644', 'DISTRACCION', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('645', 'EL MOLINO', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('646', 'FONSECA', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('647', 'HATONUEVO', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('648', 'LA JAGUA DEL PILAR', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('649', 'MAICAO', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('650', 'MANAURE', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('651', 'SAN JUAN DEL CESAR', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('652', 'URIBIA', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('653', 'URUMITA', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('654', 'VILLANUEVA', '44');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('655', 'SANTA MARTA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('656', 'ALGARROBO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('657', 'ARACATACA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('658', 'ARIGUANI', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('659', 'CERRO SAN ANTONIO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('660', 'CHIBOLO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('661', 'CIENAGA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('662', 'CONCORDIA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('663', 'EL BANCO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('664', 'EL PIÑON', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('665', 'EL RETEN', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('666', 'FUNDACION', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('667', 'GUAMAL', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('668', 'NUEVA GRANADA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('669', 'PEDRAZA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('670', 'PIJIÑO DEL CARMEN', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('671', 'PIVIJAY', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('672', 'PLATO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('673', 'PUEBLOVIEJO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('674', 'REMOLINO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('675', 'SABANAS DE SAN ANGEL', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('676', 'SALAMINA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('677', 'SAN SEBASTIAN DE BUENAVISTA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('678', 'SAN ZENON', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('679', 'SANTA ANA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('680', 'SANTA BARBARA DE PINTO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('681', 'SITIONUEVO', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('682', 'TENERIFE', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('683', 'ZAPAYAN', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('684', 'ZONA BANANERA', '47');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('685', 'VILLAVICENCIO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('686', 'ACACIAS', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('687', 'BARRANCA DE UPIA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('688', 'CABUYARO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('689', 'CASTILLA LA NUEVA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('690', 'CUBARRAL', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('691', 'CUMARAL', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('692', 'EL CALVARIO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('693', 'EL CASTILLO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('694', 'EL DORADO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('695', 'FUENTE DE ORO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('696', 'GRANADA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('697', 'GUAMAL', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('698', 'MAPIRIPAN', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('699', 'MESETAS', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('700', 'LA MACARENA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('701', 'URIBE', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('702', 'LEJANIAS', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('703', 'PUERTO CONCORDIA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('704', 'PUERTO GAITAN', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('705', 'PUERTO LOPEZ', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('706', 'PUERTO LLERAS', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('707', 'PUERTO RICO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('708', 'RESTREPO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('709', 'SAN CARLOS DE GUAROA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('710', 'SAN JUAN DE ARAMA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('711', 'SAN JUANITO', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('712', 'SAN MARTIN', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('713', 'VISTAHERMOSA', '50');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('714', 'PASTO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('715', 'ALBAN', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('716', 'ALDANA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('717', 'ANCUYA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('718', 'ARBOLEDA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('719', 'BARBACOAS', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('720', 'BELEN', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('721', 'BUESACO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('722', 'COLON', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('723', 'CONSACA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('724', 'CONTADERO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('725', 'CORDOBA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('726', 'CUASPUD', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('727', 'CUMBAL', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('728', 'CUMBITARA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('729', 'CHACHAGsI', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('730', 'EL CHARCO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('731', 'EL PEÑOL', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('732', 'EL ROSARIO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('733', 'EL TABLON DE GOMEZ', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('734', 'EL TAMBO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('735', 'FUNES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('736', 'GUACHUCAL', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('737', 'GUAITARILLA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('738', 'GUALMATAN', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('739', 'ILES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('740', 'IMUES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('741', 'IPIALES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('742', 'LA CRUZ', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('743', 'LA FLORIDA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('744', 'LA LLANADA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('745', 'LA TOLA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('746', 'LA UNION', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('747', 'LEIVA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('748', 'LINARES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('749', 'LOS ANDES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('750', 'MAGsI', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('751', 'MALLAMA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('752', 'MOSQUERA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('753', 'NARIÑO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('754', 'OLAYA HERRERA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('755', 'OSPINA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('756', 'FRANCISCO PIZARRO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('757', 'POLICARPA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('758', 'POTOSI', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('759', 'PROVIDENCIA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('760', 'PUERRES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('761', 'PUPIALES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('762', 'RICAURTE', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('763', 'ROBERTO PAYAN', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('764', 'SAMANIEGO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('765', 'SANDONA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('766', 'SAN BERNARDO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('767', 'SAN LORENZO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('768', 'SAN PABLO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('769', 'SAN PEDRO DE CARTAGO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('770', 'SANTA BARBARA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('771', 'SANTACRUZ', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('772', 'SAPUYES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('773', 'TAMINANGO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('774', 'TANGUA', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('775', 'SAN ANDRES DE TUMACO', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('776', 'TUQUERRES', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('777', 'YACUANQUER', '52');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('778', 'CUCUTA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('779', 'ABREGO', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('780', 'ARBOLEDAS', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('781', 'BOCHALEMA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('782', 'BUCARASICA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('783', 'CACOTA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('784', 'CACHIRA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('785', 'CHINACOTA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('786', 'CHITAGA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('787', 'CONVENCION', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('788', 'CUCUTILLA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('789', 'DURANIA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('790', 'EL CARMEN', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('791', 'EL TARRA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('792', 'EL ZULIA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('793', 'GRAMALOTE', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('794', 'HACARI', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('795', 'HERRAN', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('796', 'LABATECA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('797', 'LA ESPERANZA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('798', 'LA PLAYA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('799', 'LOS PATIOS', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('800', 'LOURDES', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('801', 'MUTISCUA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('802', 'OCAÑA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('803', 'PAMPLONA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('804', 'PAMPLONITA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('805', 'PUERTO SANTANDER', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('806', 'RAGONVALIA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('807', 'SALAZAR', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('808', 'SAN CALIXTO', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('809', 'SAN CAYETANO', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('810', 'SANTIAGO', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('811', 'SARDINATA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('812', 'SILOS', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('813', 'TEORAMA', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('814', 'TIBU', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('815', 'TOLEDO', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('816', 'VILLA CARO', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('817', 'VILLA DEL ROSARIO', '54');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('818', 'ARMENIA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('819', 'BUENAVISTA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('820', 'CALARCA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('821', 'CIRCASIA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('822', 'CORDOBA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('823', 'FILANDIA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('824', 'GENOVA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('825', 'LA TEBAIDA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('826', 'MONTENEGRO', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('827', 'PIJAO', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('828', 'QUIMBAYA', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('829', 'SALENTO', '63');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('830', 'PEREIRA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('831', 'APIA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('832', 'BALBOA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('833', 'BELEN DE UMBRIA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('834', 'DOSQUEBRADAS', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('835', 'GUATICA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('836', 'LA CELIA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('837', 'LA VIRGINIA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('838', 'MARSELLA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('839', 'MISTRATO', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('840', 'PUEBLO RICO', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('841', 'QUINCHIA', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('842', 'SANTA ROSA DE CABAL', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('843', 'SANTUARIO', '66');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('844', 'BUCARAMANGA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('845', 'AGUADA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('846', 'ALBANIA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('847', 'ARATOCA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('848', 'BARBOSA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('849', 'BARICHARA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('850', 'BARRANCABERMEJA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('851', 'BETULIA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('852', 'BOLIVAR', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('853', 'CABRERA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('854', 'CALIFORNIA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('855', 'CAPITANEJO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('856', 'CARCASI', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('857', 'CEPITA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('858', 'CERRITO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('859', 'CHARALA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('860', 'CHARTA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('861', 'CHIMA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('862', 'CHIPATA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('863', 'CIMITARRA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('864', 'CONCEPCION', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('865', 'CONFINES', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('866', 'CONTRATACION', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('867', 'COROMORO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('868', 'CURITI', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('869', 'EL CARMEN DE CHUCURI', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('870', 'EL GUACAMAYO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('871', 'EL PEÑON', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('872', 'EL PLAYON', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('873', 'ENCINO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('874', 'ENCISO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('875', 'FLORIAN', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('876', 'FLORIDABLANCA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('877', 'GALAN', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('878', 'GAMBITA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('879', 'GIRON', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('880', 'GUACA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('881', 'GUADALUPE', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('882', 'GUAPOTA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('883', 'GUAVATA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('884', 'GsEPSA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('885', 'HATO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('886', 'JESUS MARIA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('887', 'JORDAN', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('888', 'LA BELLEZA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('889', 'LANDAZURI', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('890', 'LA PAZ', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('891', 'LEBRIJA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('892', 'LOS SANTOS', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('893', 'MACARAVITA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('894', 'MALAGA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('895', 'MATANZA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('896', 'MOGOTES', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('897', 'MOLAGAVITA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('898', 'OCAMONTE', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('899', 'OIBA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('900', 'ONZAGA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('901', 'PALMAR', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('902', 'PALMAS DEL SOCORRO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('903', 'PARAMO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('904', 'PIEDECUESTA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('905', 'PINCHOTE', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('906', 'PUENTE NACIONAL', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('907', 'PUERTO PARRA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('908', 'PUERTO WILCHES', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('909', 'RIONEGRO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('910', 'SABANA DE TORRES', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('911', 'SAN ANDRES', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('912', 'SAN BENITO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('913', 'SAN GIL', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('914', 'SAN JOAQUIN', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('915', 'SAN JOSE DE MIRANDA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('916', 'SAN MIGUEL', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('917', 'SAN VICENTE DE CHUCURI', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('918', 'SANTA BARBARA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('919', 'SANTA HELENA DEL OPON', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('920', 'SIMACOTA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('921', 'SOCORRO', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('922', 'SUAITA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('923', 'SUCRE', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('924', 'SURATA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('925', 'TONA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('926', 'VALLE DE SAN JOSE', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('927', 'VELEZ', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('928', 'VETAS', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('929', 'VILLANUEVA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('930', 'ZAPATOCA', '68');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('931', 'SINCELEJO', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('932', 'BUENAVISTA', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('933', 'CAIMITO', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('934', 'COLOSO', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('935', 'COROZAL', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('936', 'COVEÑAS', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('937', 'CHALAN', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('938', 'EL ROBLE', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('939', 'GALERAS', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('940', 'GUARANDA', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('941', 'LA UNION', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('942', 'LOS PALMITOS', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('943', 'MAJAGUAL', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('944', 'MORROA', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('945', 'OVEJAS', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('946', 'PALMITO', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('947', 'SAMPUES', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('948', 'SAN BENITO ABAD', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('949', 'SAN JUAN DE BETULIA', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('950', 'SAN MARCOS', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('951', 'SAN ONOFRE', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('952', 'SAN PEDRO', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('953', 'SAN LUIS DE SINCE', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('954', 'SUCRE', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('955', 'SANTIAGO DE TOLU', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('956', 'TOLU VIEJO', '70');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('957', 'IBAGUE', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('958', 'ALPUJARRA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('959', 'ALVARADO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('960', 'AMBALEMA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('961', 'ANZOATEGUI', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('962', 'ARMERO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('963', 'ATACO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('964', 'CAJAMARCA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('965', 'CARMEN DE APICALA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('966', 'CASABIANCA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('967', 'CHAPARRAL', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('968', 'COELLO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('969', 'COYAIMA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('970', 'CUNDAY', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('971', 'DOLORES', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('972', 'ESPINAL', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('973', 'FALAN', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('974', 'FLANDES', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('975', 'FRESNO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('976', 'GUAMO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('977', 'HERVEO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('978', 'HONDA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('979', 'ICONONZO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('980', 'LERIDA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('981', 'LIBANO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('982', 'MARIQUITA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('983', 'MELGAR', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('984', 'MURILLO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('985', 'NATAGAIMA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('986', 'ORTEGA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('987', 'PALOCABILDO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('988', 'PIEDRAS', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('989', 'PLANADAS', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('990', 'PRADO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('991', 'PURIFICACION', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('992', 'RIOBLANCO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('993', 'RONCESVALLES', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('994', 'ROVIRA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('995', 'SALDAÑA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('996', 'SAN ANTONIO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('997', 'SAN LUIS', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('998', 'SANTA ISABEL', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('999', 'SUAREZ', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1000', 'VALLE DE SAN JUAN', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1001', 'VENADILLO', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1002', 'VILLAHERMOSA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1003', 'VILLARRICA', '73');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1004', 'CALI', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1005', 'ALCALA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1006', 'ANDALUCIA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1007', 'ANSERMANUEVO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1008', 'ARGELIA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1009', 'BOLIVAR', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1010', 'BUENAVENTURA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1011', 'GUADALAJARA DE BUGA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1012', 'BUGALAGRANDE', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1013', 'CAICEDONIA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1014', 'CALIMA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1015', 'CANDELARIA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1016', 'CARTAGO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1017', 'DAGUA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1018', 'EL AGUILA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1019', 'EL CAIRO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1020', 'EL CERRITO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1021', 'EL DOVIO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1022', 'FLORIDA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1023', 'GINEBRA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1024', 'GUACARI', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1025', 'JAMUNDI', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1026', 'LA CUMBRE', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1027', 'LA UNION', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1028', 'LA VICTORIA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1029', 'OBANDO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1030', 'PALMIRA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1031', 'PRADERA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1032', 'RESTREPO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1033', 'RIOFRIO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1034', 'ROLDANILLO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1035', 'SAN PEDRO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1036', 'SEVILLA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1037', 'TORO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1038', 'TRUJILLO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1039', 'TULUA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1040', 'ULLOA', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1041', 'VERSALLES', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1042', 'VIJES', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1043', 'YOTOCO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1044', 'YUMBO', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1045', 'ZARZAL', '76');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1046', 'ARAUCA', '81');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1047', 'ARAUQUITA', '81');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1048', 'CRAVO NORTE', '81');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1049', 'FORTUL', '81');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1050', 'PUERTO RONDON', '81');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1051', 'SARAVENA', '81');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1052', 'TAME', '81');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1053', 'YOPAL', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1054', 'AGUAZUL', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1055', 'CHAMEZA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1056', 'HATO COROZAL', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1057', 'LA SALINA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1058', 'MANI', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1059', 'MONTERREY', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1060', 'NUNCHIA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1061', 'OROCUE', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1062', 'PAZ DE ARIPORO', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1063', 'PORE', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1064', 'RECETOR', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1065', 'SABANALARGA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1066', 'SACAMA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1067', 'SAN LUIS DE PALENQUE', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1068', 'TAMARA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1069', 'TAURAMENA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1070', 'TRINIDAD', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1071', 'VILLANUEVA', '85');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1072', 'MOCOA', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1073', 'COLON', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1074', 'ORITO', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1075', 'PUERTO ASIS', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1076', 'PUERTO CAICEDO', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1077', 'PUERTO GUZMAN', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1078', 'LEGUIZAMO', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1079', 'SIBUNDOY', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1080', 'SAN FRANCISCO', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1081', 'SAN MIGUEL', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1082', 'SANTIAGO', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1083', 'VALLE DEL GUAMUEZ', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1084', 'VILLAGARZON', '86');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1085', 'SAN ANDRES', '88');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1086', 'PROVIDENCIA', '88');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1087', 'LETICIA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1088', 'EL ENCANTO', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1089', 'LA CHORRERA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1090', 'LA PEDRERA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1091', 'LA VICTORIA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1092', 'MIRITI - PARANA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1093', 'PUERTO ALEGRIA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1094', 'PUERTO ARICA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1095', 'PUERTO NARIÑO', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1096', 'PUERTO SANTANDER', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1097', 'TARAPACA', '91');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1098', 'INIRIDA', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1099', 'BARRANCO MINAS', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1100', 'MAPIRIPANA', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1101', 'SAN FELIPE', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1102', 'PUERTO COLOMBIA', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1103', 'LA GUADALUPE', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1104', 'CACAHUAL', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1105', 'PANA PANA', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1106', 'MORICHAL', '94');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1107', 'SAN JOSE DEL GUAVIARE', '95');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1108', 'CALAMAR', '95');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1109', 'EL RETORNO', '95');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1110', 'MIRAFLORES', '95');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1111', 'MITU', '97');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1112', 'CARURU', '97');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1113', 'PACOA', '97');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1114', 'TARAIRA', '97');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1115', 'PAPUNAUA', '97');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1116', 'YAVARATE', '97');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1117', 'PUERTO CARREÑO', '99');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1118', 'LA PRIMAVERA', '99');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1119', 'SANTA ROSALIA', '99');
INSERT INTO ciudad (idciudad, nombre_ciudad, id_departament) VALUES ('1120', 'CUMARIBO', '99');


--
-- Data for Name: cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO cliente (id_cliente, nombre, apellido, tel_movil, password, e_mail) VALUES ('3005020032', 'Javier Eduardo', 'Mendoza', '3005020032', 'ba3973f17a5cfaad261878362f73dfdc', 'javier.ing.teleco@gmail.com');
INSERT INTO cliente (id_cliente, nombre, apellido, tel_movil, password, e_mail) VALUES ('3113200686', 'Angela Tatiana', 'Vergel Pajaro', '3113200686', '3b6561e7bc1bee2e19f6c585593ff08f', 'a_tatiana.95@hotmail.com');


--
-- Data for Name: departamento; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('08', 'ATLANTICO');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('11', 'BOGOTA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('13', 'BOLIVAR');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('15', 'BOYACA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('17', 'CALDAS');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('18', 'CAQUETA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('19', 'CAUCA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('20', 'CESAR');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('23', 'CORDOBA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('25', 'CUNDINAMARCA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('27', 'CHOCO');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('41', 'HUILA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('44', 'LA GUAJIRA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('47', 'MAGDALENA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('50', 'META');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('52', 'NARIÑO');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('54', 'N. DE SANTANDER');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('63', 'QUINDIO');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('66', 'RISARALDA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('68', 'SANTANDER');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('70', 'SUCRE');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('73', 'TOLIMA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('76', 'VALLE DEL CAUCA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('81', 'ARAUCA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('85', 'CASANARE');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('86', 'PUTUMAYO');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('88', 'SAN ANDRES');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('91', 'AMAZONAS');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('94', 'GUAINIA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('95', 'GUAVIARE');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('97', 'VAUPES');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('99', 'VICHADA');
INSERT INTO departamento (id_departament, nombre_departamento) VALUES ('05', 'ANTIOQUIA');


--
-- Data for Name: grupo_cliente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO grupo_cliente (id_cliente, id_grupo, id_grupo_cliente) VALUES ('3005020032', 2, 1);


--
-- Name: grupo_cliente_id_grupo_cliente_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('grupo_cliente_id_grupo_cliente_seq', 1, true);


--
-- Data for Name: grupo_viaje; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO grupo_viaje (id_grupo, nombre_grupo, idciudad) VALUES (2, 'USTA', '844');


--
-- Name: grupo_viaje_id_grupo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('grupo_viaje_id_grupo_seq', 2, true);


--
-- Data for Name: historial_viaje; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: historial_viaje_id_plan_viaje_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('historial_viaje_id_plan_viaje_seq', 1, false);


--
-- Data for Name: plan_viaje; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (5, NULL, '17:37:00', 1, '3005020032', 1, 0, 1, 3, 0, 6, NULL);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (6, '2017-09-20', '15:37:00', 2, '3005020032', 0, 0, 1, 1, 1, NULL, NULL);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (7, NULL, '17:42:00', 1, '3005020032', 0, 0, 4, 2, 0, 1, 2000);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (8, NULL, '22:22:00', 1, '3005020032', 0, 0, 1, 1, 0, 1, 111);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (9, NULL, '04:54:00', 1, '3005020032', 0, 0, 1, 1, 0, 1, 0);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (10, NULL, '04:25:00', 2, '3005020032', 1, 0, 1, 2, 0, 1, 0);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (11, NULL, '04:54:00', 3, '3005020032', 0, 0, 1, 1, 0, 1, 50000);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (12, '2017-09-30', '00:01:00', 2, '3005020032', 0, 0, 1, 1, 1, NULL, 0);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (13, NULL, '00:31:00', 1, '3005020032', 0, 0, 1, 2, 0, 1, 65464);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (14, NULL, '08:00:00', 3, '3005020032', 1, 0, 2, 1, 0, 6, 0);
INSERT INTO plan_viaje (id_plan_viaje, fecha, hora_salida, id_sitio, id_cliente, modo_viaje, estado, cupos, id_sitio_destino, tipo_plan, dia_semana, costo) VALUES (15, '2017-11-16', '06:06:00', 2, '3005020032', 1, 0, 3, 1, 1, NULL, 0);


--
-- Name: plan_viaje_id_plan_viaje_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('plan_viaje_id_plan_viaje_seq', 15, true);


--
-- Data for Name: sitios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO sitios (id_sitio, nombre_sitio, id_grupo) VALUES (1, 'FLORIDABLANCA', 2);
INSERT INTO sitios (id_sitio, nombre_sitio, id_grupo) VALUES (2, 'PIEDECUESTA', 2);
INSERT INTO sitios (id_sitio, nombre_sitio, id_grupo) VALUES (3, 'BUCARAMANGA', 2);


--
-- Name: sitios_id_sitio_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('sitios_id_sitio_seq', 3, true);


--
-- Data for Name: viaje_grupal; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Name: ciudad_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT ciudad_pkey PRIMARY KEY (idciudad);


--
-- Name: cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY cliente
    ADD CONSTRAINT cliente_pkey PRIMARY KEY (id_cliente);


--
-- Name: departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY departamento
    ADD CONSTRAINT departamento_pkey PRIMARY KEY (id_departament);


--
-- Name: grupo_cliente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupo_cliente
    ADD CONSTRAINT grupo_cliente_pkey PRIMARY KEY (id_grupo_cliente);


--
-- Name: grupo_viaje_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY grupo_viaje
    ADD CONSTRAINT grupo_viaje_pkey PRIMARY KEY (id_grupo);


--
-- Name: historial_viaje_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY historial_viaje
    ADD CONSTRAINT historial_viaje_pkey PRIMARY KEY (id_plan_viaje);


--
-- Name: pk_chat; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY chat
    ADD CONSTRAINT pk_chat PRIMARY KEY (id);


--
-- Name: plan_viaje_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY plan_viaje
    ADD CONSTRAINT plan_viaje_pkey PRIMARY KEY (id_plan_viaje);


--
-- Name: sitios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sitios
    ADD CONSTRAINT sitios_pkey PRIMARY KEY (id_sitio);


--
-- Name: calificacines__cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY calificaciones
    ADD CONSTRAINT calificacines__cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente);


--
-- Name: calificaciones__historial_viaje; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY calificaciones
    ADD CONSTRAINT calificaciones__historial_viaje FOREIGN KEY (id_plan_viaje) REFERENCES historial_viaje(id_plan_viaje);


--
-- Name: ciudad_departamento; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ciudad
    ADD CONSTRAINT ciudad_departamento FOREIGN KEY (id_departament) REFERENCES departamento(id_departament);


--
-- Name: cliente_grupocliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_cliente
    ADD CONSTRAINT cliente_grupocliente FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente);


--
-- Name: fk_id_historial_viaje; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY viaje_grupal
    ADD CONSTRAINT fk_id_historial_viaje FOREIGN KEY (id_plan_viaje) REFERENCES historial_viaje(id_plan_viaje);


--
-- Name: grupo_cliente__grupo_viaje; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_cliente
    ADD CONSTRAINT grupo_cliente__grupo_viaje FOREIGN KEY (id_grupo) REFERENCES grupo_viaje(id_grupo);


--
-- Name: grupo_viaje_ciudad; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY grupo_viaje
    ADD CONSTRAINT grupo_viaje_ciudad FOREIGN KEY (idciudad) REFERENCES ciudad(idciudad);


--
-- Name: plan_viaje___cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY plan_viaje
    ADD CONSTRAINT plan_viaje___cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente);


--
-- Name: plan_viaje___sitios; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY plan_viaje
    ADD CONSTRAINT plan_viaje___sitios FOREIGN KEY (id_sitio) REFERENCES sitios(id_sitio);


--
-- Name: plan_viaje__sitios; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY plan_viaje
    ADD CONSTRAINT plan_viaje__sitios FOREIGN KEY (id_sitio) REFERENCES sitios(id_sitio);


--
-- Name: sitios__grupo_viaje; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sitios
    ADD CONSTRAINT sitios__grupo_viaje FOREIGN KEY (id_grupo) REFERENCES grupo_viaje(id_grupo);


--
-- Name: viaje_grupal___cliente; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY viaje_grupal
    ADD CONSTRAINT viaje_grupal___cliente FOREIGN KEY (id_cliente) REFERENCES cliente(id_cliente);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

