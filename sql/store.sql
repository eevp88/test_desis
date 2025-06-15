-- Table: public.currency
-- DROP TABLE IF EXISTS public.storehuoses;
CREATE TABLE IF NOT EXISTS public.storehouses (id SERIAL PRIMARY KEY, name text NOT NULL);

ALTER TABLE IF EXISTS public.storehouses OWNER TO postgres;

COMMENT ON TABLE public.storehouses IS 'tabla de  las bodegas';

INSERT INTO
    public.storehouses (name)
VALUES
    ('Sur'),
    ('Norte'),
    ('Centro'),
    ('Centro Sur'),
    ('Centro Norte');
