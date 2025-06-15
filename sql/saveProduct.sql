-- FUNCTION: public.saveProduct(text, text, numeric, numeric, numeric, text[], text, numeric)

-- DROP FUNCTION IF EXISTS public."saveProduct"(text, text, numeric, numeric, numeric, text[], text, numeric);

CREATE OR REPLACE FUNCTION public."saveProduct"(
	productcode text,
	productname text,
	idstore numeric,
	idbranch numeric,
	idcurrency numeric,
	material text[],
	description text,
	productprice numeric)
    RETURNS TABLE(status text, message text, iderror numeric) 
    LANGUAGE 'plpgsql'
    COST 100
    VOLATILE PARALLEL UNSAFE
    ROWS 1000

AS $BODY$
DECLARE
    sMsg text;
BEGIN
    BEGIN
        INSERT INTO products(
            code, name, id_store, id_branchs, id_currency, material, description, price)
        VALUES (
            productCode, productName, idStore, idBranch, idCurrency, material, description, productPrice
        );

        status := 'success';
        message := 'Producto agregado correctamente';
        idError := 0;

    EXCEPTION
        WHEN unique_violation THEN
            status := 'danger';
            message := 'El código del producto ya está registrado.';
            idError := 1;

        WHEN OTHERS THEN
            GET STACKED DIAGNOSTICS sMsg = MESSAGE_TEXT;
            status := 'danger';
            message := 'Error al insertar en base de datos: ' || sMsg;
            idError := 2;
    END;

    RETURN NEXT;
END;
$BODY$;

ALTER FUNCTION public."saveProduct"(text, text, numeric, numeric, numeric, text[], text, numeric)
    OWNER TO postgres;
