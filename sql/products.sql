-- Table: public.products
-- DROP TABLE IF EXISTS public.products;

CREATE TABLE IF NOT EXISTS public.products (
    code TEXT PRIMARY KEY,
    name TEXT NOT NULL,
    id_store INTEGER NOT NULL,
    id_branchs INTEGER NOT NULL,
    id_currency INTEGER NOT NULL,
    material TEXT[] NOT NULL,
    description TEXT NOT NULL,
    price NUMERIC(10,2) NOT NULL
);

ALTER TABLE IF EXISTS public.products
    OWNER to postgres;
COMMENT ON TABLE public.products
    IS 'tabla de productos';
