--User Trigger--
DROP SEQUENCE seq_user_id;
CREATE SEQUENCE seq_user_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER user_id_trigger;
CREATE OR REPLACE TRIGGER user_id_trigger
BEFORE INSERT ON Users
FOR EACH ROW
BEGIN
    IF :NEW.user_id IS NULL THEN
        SELECT seq_user_id.NEXTVAL INTO :NEW.user_id FROM SYS.DUAL;
    END IF;
END;
/
--Shop Trigger--
DROP SEQUENCE seq_shop_id;
CREATE SEQUENCE seq_shop_id START WITH 100 INCREMENT BY 1;

DROP TRIGGER shop_id_trigger;
CREATE OR REPLACE TRIGGER shop_id_trigger
BEFORE INSERT ON Shop
FOR EACH ROW
BEGIN
    IF :NEW.shop_id IS NULL THEN
        SELECT seq_shop_id.NEXTVAL INTO :NEW.shop_id FROM SYS.DUAL;
    END IF;
END;
/
--Product Trigger--
DROP SEQUENCE seq_product_id;
CREATE SEQUENCE seq_product_id START WITH 1000 INCREMENT BY 1;

DROP TRIGGER product_id_trigger;
CREATE OR REPLACE TRIGGER product_id_trigger
BEFORE INSERT ON Product
FOR EACH ROW
BEGIN
    IF :NEW.product_id IS NULL THEN
        SELECT seq_product_id.NEXTVAL INTO :NEW.product_id FROM SYS.DUAL;
    END IF;
END;
/
--Image Trigger--
DROP SEQUENCE seq_image_id;
CREATE SEQUENCE seq_image_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER image_id_trigger;
CREATE OR REPLACE TRIGGER image_id_trigger
BEFORE INSERT ON Image
FOR EACH ROW
BEGIN
    IF :NEW.image_id IS NULL THEN
        SELECT seq_image_id.NEXTVAL INTO :NEW.image_id FROM SYS.DUAL;
    END IF;
END;
/
--Review Trigger--
DROP SEQUENCE seq_review_id;
CREATE SEQUENCE seq_review_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER review_id_trigger;
CREATE OR REPLACE TRIGGER review_id_trigger
BEFORE INSERT ON Review
FOR EACH ROW
BEGIN
    IF :NEW.review_id IS NULL THEN
        SELECT seq_review_id.NEXTVAL INTO :NEW.review_id FROM SYS.DUAL;
    END IF;
END;
/
--Cart Trigger--
DROP SEQUENCE seq_cart_id;
CREATE SEQUENCE seq_cart_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER cart_id_trigger;
CREATE OR REPLACE TRIGGER cart_id_trigger
BEFORE INSERT ON Cart
FOR EACH ROW
BEGIN
    IF :NEW.cart_id IS NULL THEN
        SELECT seq_cart_id.NEXTVAL INTO :NEW.cart_id FROM SYS.DUAL;
    END IF;
END;
/
--Cart_Product Trigger--
DROP SEQUENCE seq_cart_product_id;
CREATE SEQUENCE seq_cart_product_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER cart_product_id_trigger;
CREATE OR REPLACE TRIGGER cart_product_id_trigger
BEFORE INSERT ON Cart_Product
FOR EACH ROW
BEGIN
    IF :NEW.cart_Product_id IS NULL THEN
        SELECT seq_cart_product_id.NEXTVAL INTO :NEW.cart_product_id FROM SYS.DUAL;
    END IF;
END;
/
--Slot Trigger--
DROP SEQUENCE seq_slot_id;
CREATE SEQUENCE seq_slot_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER slot_id_trigger;
CREATE OR REPLACE TRIGGER slot_id_trigger
BEFORE INSERT ON Slot
FOR EACH ROW
BEGIN
    IF :NEW.slot_id IS NULL THEN
        SELECT seq_slot_id.NEXTVAL INTO :NEW.slot_id FROM SYS.DUAL;
    END IF;
END;
/
--Orders Trigger--
DROP SEQUENCE seq_order_id;
CREATE SEQUENCE seq_order_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER order_id_trigger;
CREATE OR REPLACE TRIGGER order_id_trigger
BEFORE INSERT ON Orders
FOR EACH ROW
BEGIN
    IF :NEW.order_id IS NULL THEN
        SELECT seq_order_id.NEXTVAL INTO :NEW.order_id FROM SYS.DUAL;
    END IF;
END;
/
--Order_Product Trigger--
DROP SEQUENCE seq_order_product_id;
CREATE SEQUENCE seq_order_product_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER order_product_id_trigger;
CREATE OR REPLACE TRIGGER order_product_id_trigger
BEFORE INSERT ON Order_Product
FOR EACH ROW
BEGIN
    IF :NEW.order_product_id IS NULL THEN
        SELECT seq_order_product_id.NEXTVAL INTO :NEW.order_product_id FROM SYS.DUAL;
    END IF;
END;
/
--Payment Trigger--
DROP SEQUENCE seq_payment_id;
CREATE SEQUENCE seq_payment_id START WITH 1 INCREMENT BY 1;

DROP TRIGGER payment_id_trigger;
CREATE OR REPLACE TRIGGER payment_id_trigger
BEFORE INSERT ON Payment
FOR EACH ROW
BEGIN
    IF :NEW.payment_id IS NULL THEN
        SELECT seq_payment_id.NEXTVAL INTO :NEW.payment_id FROM SYS.DUAL;
    END IF;
END;
/