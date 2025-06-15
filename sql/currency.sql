-- Table: public.currency
-- DROP TABLE IF EXISTS public.currency;
CREATE TABLE IF NOT EXISTS public.currency (id SERIAL PRIMARY KEY, name text NOT NULL);

ALTER TABLE IF EXISTS public.currency OWNER to postgres;

COMMENT ON TABLE public.currency IS 'tabla de monedas ';

INSERT INTO
    public.currency (name)
VALUES
    ('USD'),
    ('EUR'),
    ('CLP (Peso Chileno)'),
    ('MXN (Peso Mexicano)'),
    ('PEN (Sol Peruna)'),
    ('COP (Peso Colombiano)');
