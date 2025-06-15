-- Table: public.branchs
-- DROP TABLE IF EXISTS public.branchs;
CREATE TABLE IF NOT EXISTS public.branchs (
    id SERIAL PRIMARY KEY,
    name text NOT NULL,
    id_storehouse numeric
);

ALTER TABLE IF EXISTS public.branchs OWNER to postgres;

COMMENT ON TABLE public.branchs IS 'tabla de sucursales';

INSERT INTO
    public.branchs (name, id_storehouse)
VALUES
    ('Santiago', 3),
    ('Valdivia', 4),
    ('Arica', 2),
    ('Concepción', 4),
    ('Temuco', 4),
    ('Antofagasta', 2),
    ('Iquique', 2),
    ('Puerto Montt', 4),
    ('La Serena', 5),
    ('Rancagua', 3),
    ('Talca', 3),
    ('Curicó', 3),
    ('Los Ángeles', 4),
    ('Osorno', 4),
    ('Copiapó', 5),
    ('Punta Arenas', 1),
    ('Coyhaique', 1);
