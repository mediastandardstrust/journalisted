BEGIN;
ALTER TABLE journo_weblink ADD COLUMN rank integer NOT NULL DEFAULT 100;
COMMIT;
