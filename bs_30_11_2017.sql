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
-- Name: asignar_proyecto_docente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE asignar_proyecto_docente (
    id_adinacion integer NOT NULL,
    id_evaluador character varying,
    id_proyecto integer,
    estado smallint DEFAULT 0
);


ALTER TABLE asignar_proyecto_docente OWNER TO postgres;

--
-- Name: asignar_proyecto_docente_id_adinacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE asignar_proyecto_docente_id_adinacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE asignar_proyecto_docente_id_adinacion_seq OWNER TO postgres;

--
-- Name: asignar_proyecto_docente_id_adinacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE asignar_proyecto_docente_id_adinacion_seq OWNED BY asignar_proyecto_docente.id_adinacion;


--
-- Name: categoria; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE categoria (
    id_categoria integer NOT NULL,
    descripcion character varying
);


ALTER TABLE categoria OWNER TO postgres;

--
-- Name: categoria_id_categoria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE categoria_id_categoria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categoria_id_categoria_seq OWNER TO postgres;

--
-- Name: categoria_id_categoria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE categoria_id_categoria_seq OWNED BY categoria.id_categoria;


--
-- Name: evaluacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evaluacion (
    presentacion smallint,
    id_evaluador character varying,
    id_proyecto integer NOT NULL,
    id_evaluacion integer NOT NULL,
    tiempo smallint,
    coherencia_met smallint,
    claridad smallint,
    diapositiva smallint,
    video smallint,
    conclusiones smallint
);


ALTER TABLE evaluacion OWNER TO postgres;

--
-- Name: TABLE evaluacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE evaluacion IS 'Las calificaciones, se hacen interactivas y representan un porcentaje';


--
-- Name: evaluacion_id_evaluacion_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE evaluacion_id_evaluacion_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE evaluacion_id_evaluacion_seq OWNER TO postgres;

--
-- Name: evaluacion_id_evaluacion_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE evaluacion_id_evaluacion_seq OWNED BY evaluacion.id_evaluacion;


--
-- Name: evaluadores; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE evaluadores (
    id_evaluador character varying NOT NULL,
    nombre_eva character varying,
    password character varying
);


ALTER TABLE evaluadores OWNER TO postgres;

--
-- Name: ferias; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ferias (
    id_feria integer NOT NULL,
    fecha timestamp with time zone,
    periodo character varying,
    nombre_feria character varying
);


ALTER TABLE ferias OWNER TO postgres;

--
-- Name: COLUMN ferias.periodo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN ferias.periodo IS 'Periodo en el año, I o II ';


--
-- Name: ferias_id_feria_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE ferias_id_feria_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE ferias_id_feria_seq OWNER TO postgres;

--
-- Name: ferias_id_feria_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE ferias_id_feria_seq OWNED BY ferias.id_feria;


--
-- Name: ganadores_feria; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ganadores_feria (
    id_proyecto integer NOT NULL,
    id_puestos integer NOT NULL
);


ALTER TABLE ganadores_feria OWNER TO postgres;

--
-- Name: phpgen_user_perms; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE phpgen_user_perms (
    user_id integer NOT NULL,
    page_name character varying(255) NOT NULL,
    perm_name character varying(6) NOT NULL
);


ALTER TABLE phpgen_user_perms OWNER TO postgres;

--
-- Name: proyectos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE proyectos (
    id_proyecto integer NOT NULL,
    nombre_proyecto character varying,
    descripcion character varying,
    fecha_publicacion timestamp with time zone,
    id_categoria integer,
    url_doc character varying,
    url_video character varying,
    url_anexos character varying,
    id_feria integer NOT NULL,
    id_user integer
);


ALTER TABLE proyectos OWNER TO postgres;

--
-- Name: proyectos_id_proyecto_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE proyectos_id_proyecto_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE proyectos_id_proyecto_seq OWNER TO postgres;

--
-- Name: proyectos_id_proyecto_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE proyectos_id_proyecto_seq OWNED BY proyectos.id_proyecto;


--
-- Name: puestos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE puestos (
    id_puestos integer NOT NULL,
    puesto character varying
);


ALTER TABLE puestos OWNER TO postgres;

--
-- Name: puestos_id_puestos_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE puestos_id_puestos_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE puestos_id_puestos_seq OWNER TO postgres;

--
-- Name: puestos_id_puestos_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE puestos_id_puestos_seq OWNED BY puestos.id_puestos;


--
-- Name: user_student; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE user_student (
    id_user integer NOT NULL,
    user_nombres character varying,
    user_password character varying
);


ALTER TABLE user_student OWNER TO postgres;

--
-- Name: id_adinacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignar_proyecto_docente ALTER COLUMN id_adinacion SET DEFAULT nextval('asignar_proyecto_docente_id_adinacion_seq'::regclass);


--
-- Name: id_categoria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categoria ALTER COLUMN id_categoria SET DEFAULT nextval('categoria_id_categoria_seq'::regclass);


--
-- Name: id_evaluacion; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion ALTER COLUMN id_evaluacion SET DEFAULT nextval('evaluacion_id_evaluacion_seq'::regclass);


--
-- Name: id_feria; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ferias ALTER COLUMN id_feria SET DEFAULT nextval('ferias_id_feria_seq'::regclass);


--
-- Name: id_proyecto; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos ALTER COLUMN id_proyecto SET DEFAULT nextval('proyectos_id_proyecto_seq'::regclass);


--
-- Name: id_puestos; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY puestos ALTER COLUMN id_puestos SET DEFAULT nextval('puestos_id_puestos_seq'::regclass);


--
-- Data for Name: asignar_proyecto_docente; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO asignar_proyecto_docente (id_adinacion, id_evaluador, id_proyecto, estado) VALUES (5, '1064117392', 3, 1);
INSERT INTO asignar_proyecto_docente (id_adinacion, id_evaluador, id_proyecto, estado) VALUES (6, '1064117392', 1, 1);
INSERT INTO asignar_proyecto_docente (id_adinacion, id_evaluador, id_proyecto, estado) VALUES (7, '1064117392', 2, 1);


--
-- Name: asignar_proyecto_docente_id_adinacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('asignar_proyecto_docente_id_adinacion_seq', 7, true);


--
-- Data for Name: categoria; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO categoria (id_categoria, descripcion) VALUES (1, 'COMUNICACIONES');
INSERT INTO categoria (id_categoria, descripcion) VALUES (2, 'SISTEMAS ');


--
-- Name: categoria_id_categoria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('categoria_id_categoria_seq', 2, true);


--
-- Data for Name: evaluacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO evaluacion (presentacion, id_evaluador, id_proyecto, id_evaluacion, tiempo, coherencia_met, claridad, diapositiva, video, conclusiones) VALUES (5, '1064117392', 3, 7, 4, 4, 5, 4, 5, 5);
INSERT INTO evaluacion (presentacion, id_evaluador, id_proyecto, id_evaluacion, tiempo, coherencia_met, claridad, diapositiva, video, conclusiones) VALUES (0, '1064117392', 1, 8, 0, 5, 4, 0, 0, 3);
INSERT INTO evaluacion (presentacion, id_evaluador, id_proyecto, id_evaluacion, tiempo, coherencia_met, claridad, diapositiva, video, conclusiones) VALUES (4, '1064117392', 2, 9, 3, 3, 0, 4, 3, 4);


--
-- Name: evaluacion_id_evaluacion_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('evaluacion_id_evaluacion_seq', 9, true);


--
-- Data for Name: evaluadores; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO evaluadores (id_evaluador, nombre_eva, password) VALUES ('1064117392', 'Javier Mendoza', '2290a7385ed77cc5592dc2153229f082');
INSERT INTO evaluadores (id_evaluador, nombre_eva, password) VALUES ('1', 'ELVIS GALVIS', '2290a7385ed77cc5592dc2153229f082');
INSERT INTO evaluadores (id_evaluador, nombre_eva, password) VALUES ('2', 'CARLOS FELIPE', '2290a7385ed77cc5592dc2153229f082');
INSERT INTO evaluadores (id_evaluador, nombre_eva, password) VALUES ('3', 'JUAN CARLOS', '2290a7385ed77cc5592dc2153229f082');


--
-- Data for Name: ferias; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO ferias (id_feria, fecha, periodo, nombre_feria) VALUES (1, '2017-11-27 00:00:00-05', 'II', 'FEPROINTEL');


--
-- Name: ferias_id_feria_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('ferias_id_feria_seq', 1, true);


--
-- Data for Name: ganadores_feria; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- Data for Name: phpgen_user_perms; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO phpgen_user_perms (user_id, page_name, perm_name) VALUES (1064, '', 'ADMIN');
INSERT INTO phpgen_user_perms (user_id, page_name, perm_name) VALUES (0, '', 'SELECT');
INSERT INTO phpgen_user_perms (user_id, page_name, perm_name) VALUES (1, '', 'ADMIN');


--
-- Data for Name: proyectos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO proyectos (id_proyecto, nombre_proyecto, descripcion, fecha_publicacion, id_categoria, url_doc, url_video, url_anexos, id_feria, id_user) VALUES (2, 'T''USTA', '<p><span style="color: rgb(84, 84, 84); font-family: arial, sans-serif; font-size: small; background-color: rgb(255, 255, 255);">Una&nbsp;</span><span style="font-weight: bold; color: rgb(106, 106, 106); font-family: arial, sans-serif; font-size: small; background-color: rgb(255, 255, 255);">feria</span><span style="color: rgb(84, 84, 84); font-family: arial, sans-serif; font-size: small; background-color: rgb(255, 255, 255);">&nbsp;es un evento social, económico y cultural establecido, temporal o ambulante, periódico o anual que se lleva a cabo en una sede y que llega a abarcar generalmente un tema o propósito común.&nbsp;</span></p>', '2017-11-27 00:00:00-05', 2, NULL, 'https://youtu.be/c6gc804HY9I', NULL, 1, 1);
INSERT INTO proyectos (id_proyecto, nombre_proyecto, descripcion, fecha_publicacion, id_categoria, url_doc, url_video, url_anexos, id_feria, id_user) VALUES (1, 'Bluechat', '<p><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">Una&nbsp;</span><strong>feria</strong><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">&nbsp;es un evento social, económico y cultural —establecido, temporal o ambulante, periódico o anual— que se lleva a cabo en una sede y que llega a abarcar generalmente un tema o propósito común. Puede tener por objetivo primordial la promoción de la&nbsp;</span><a href="https://es.wikipedia.org/wiki/Cultura" title="Cultura" style="text-decoration-line: none; color: rgb(11, 0, 128); background: none rgb(255, 255, 255); font-family: sans-serif;">cultura</a><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">, alguna causa o estilo de vida, generalmente en una forma divertida y variada; más comúnmente el objetivo es la estimulación comercial, pues tiene la finalidad de lucro o de generar ganancias para las localidades anfitrionas, personas u organizaciones patrocinadoras, y participantes hospitalarios, a cambio de un tiempo grato que incluye diversión y&nbsp;</span><a href="https://es.wikipedia.org/wiki/Entretenimiento" title="Entretenimiento" style="text-decoration-line: none; color: rgb(11, 0, 128); background: none rgb(255, 255, 255); font-family: sans-serif;">entretenimiento</a><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">, participación en&nbsp;</span><a href="https://es.wikipedia.org/wiki/Juego" title="Juego" style="text-decoration-line: none; color: rgb(11, 0, 128); background: none rgb(255, 255, 255); font-family: sans-serif;">juegos</a><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">&nbsp;de azar y de destreza, alimentos, manjares y&nbsp;</span><a href="https://es.wikipedia.org/wiki/Golosina" title="Golosina" style="text-decoration-line: none; color: rgb(11, 0, 128); background: none rgb(255, 255, 255); font-family: sans-serif;">golosinas</a><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">, objetos, o&nbsp;</span><a href="https://es.wikipedia.org/wiki/Juguete" title="Juguete" style="text-decoration-line: none; color: rgb(11, 0, 128); background: none rgb(255, 255, 255); font-family: sans-serif;">juguetes</a><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">, etc., para los participantes visitantes y negociantes, ya sean estos menores o mayores de edad, dependiendo del evento, consignas, características, costumbres locales y leyes que rigen el lugar.</span></p>

', '2017-11-16 00:00:00-05', 1, NULL, 'http://www.youtube.com', NULL, 1, 1064);
INSERT INTO proyectos (id_proyecto, nombre_proyecto, descripcion, fecha_publicacion, id_categoria, url_doc, url_video, url_anexos, id_feria, id_user) VALUES (3, 'Power Line Communications', '<p><em><strong>Power Line Communications</strong></em><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">, también conocido por sus siglas&nbsp;</span><strong>PLC</strong><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">, es un término inglés que puede traducirse por&nbsp;</span><em><strong>comunicaciones mediante línea de potencia</strong></em><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">&nbsp;y que se refiere a diferentes tecnologías que utilizan las líneas de transmisión&nbsp;</span><a href="https://es.wikipedia.org/wiki/Energ%C3%ADa_el%C3%A9ctrica" title="Energía eléctrica" style="text-decoration-line: none; color: rgb(11, 0, 128); background: none rgb(255, 255, 255); font-family: sans-serif;">energía eléctrica</a><span style="color: rgb(34, 34, 34); font-family: sans-serif; background-color: rgb(255, 255, 255);">&nbsp;convencionales para transmitir señales con propósitos de comunicación.</span></p>', '2017-11-27 00:00:00-05', 1, 'documentos/10822.docx', 'https://www.youtube.com', NULL, 1, 1);


--
-- Name: proyectos_id_proyecto_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('proyectos_id_proyecto_seq', 3, true);


--
-- Data for Name: puestos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO puestos (id_puestos, puesto) VALUES (1, 'Primer Puesto');
INSERT INTO puestos (id_puestos, puesto) VALUES (2, 'Tercer Puesto');
INSERT INTO puestos (id_puestos, puesto) VALUES (3, 'Empate ');
INSERT INTO puestos (id_puestos, puesto) VALUES (4, 'Cuarto Puesto');
INSERT INTO puestos (id_puestos, puesto) VALUES (5, 'Segundo Puesto');


--
-- Name: puestos_id_puestos_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('puestos_id_puestos_seq', 5, true);


--
-- Data for Name: user_student; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO user_student (id_user, user_nombres, user_password) VALUES (1064, 'Javier', '2290a7385ed77cc5592dc2153229f082');
INSERT INTO user_student (id_user, user_nombres, user_password) VALUES (1, 'Jhossep', '2290a7385ed77cc5592dc2153229f082');


--
-- Name: categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY categoria
    ADD CONSTRAINT categoria_pkey PRIMARY KEY (id_categoria);


--
-- Name: evaluadores_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evaluadores
    ADD CONSTRAINT evaluadores_pkey PRIMARY KEY (id_evaluador);


--
-- Name: ferias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ferias
    ADD CONSTRAINT ferias_pkey PRIMARY KEY (id_feria);


--
-- Name: phpgen_user_perms_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY phpgen_user_perms
    ADD CONSTRAINT phpgen_user_perms_pkey PRIMARY KEY (user_id, page_name, perm_name);


--
-- Name: pk_asgina; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY asignar_proyecto_docente
    ADD CONSTRAINT pk_asgina PRIMARY KEY (id_adinacion);


--
-- Name: pk_evaluacion; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY evaluacion
    ADD CONSTRAINT pk_evaluacion PRIMARY KEY (id_evaluacion);


--
-- Name: proyectos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT proyectos_pkey PRIMARY KEY (id_proyecto);


--
-- Name: puestos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY puestos
    ADD CONSTRAINT puestos_pkey PRIMARY KEY (id_puestos);


--
-- Name: user_student_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY user_student
    ADD CONSTRAINT user_student_pkey PRIMARY KEY (id_user);


--
-- Name: categoria_proyectos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ganadores_feria
    ADD CONSTRAINT categoria_proyectos FOREIGN KEY (id_proyecto) REFERENCES proyectos(id_proyecto);


--
-- Name: evaluacion_to_proyectos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion
    ADD CONSTRAINT evaluacion_to_proyectos FOREIGN KEY (id_proyecto) REFERENCES proyectos(id_proyecto);


--
-- Name: fk_evaluador; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignar_proyecto_docente
    ADD CONSTRAINT fk_evaluador FOREIGN KEY (id_evaluador) REFERENCES evaluadores(id_evaluador);


--
-- Name: fk_proyecto; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY asignar_proyecto_docente
    ADD CONSTRAINT fk_proyecto FOREIGN KEY (id_proyecto) REFERENCES proyectos(id_proyecto);


--
-- Name: ganadores_feria__puestos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ganadores_feria
    ADD CONSTRAINT ganadores_feria__puestos FOREIGN KEY (id_puestos) REFERENCES puestos(id_puestos);


--
-- Name: proyectos__categoria; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT proyectos__categoria FOREIGN KEY (id_categoria) REFERENCES categoria(id_categoria);


--
-- Name: proyectos_ferias; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT proyectos_ferias FOREIGN KEY (id_feria) REFERENCES ferias(id_feria);


--
-- Name: proyectos_to_user_student; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY proyectos
    ADD CONSTRAINT proyectos_to_user_student FOREIGN KEY (id_user) REFERENCES user_student(id_user);


--
-- Name: votacion_to_evaluadores; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY evaluacion
    ADD CONSTRAINT votacion_to_evaluadores FOREIGN KEY (id_evaluador) REFERENCES evaluadores(id_evaluador);


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

