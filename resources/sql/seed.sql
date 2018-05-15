DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS admin CASCADE;
DROP TABLE IF EXISTS bid CASCADE;
DROP TABLE IF EXISTS auction CASCADE;
DROP TABLE IF EXISTS comment CASCADE;
DROP TABLE IF EXISTS reportUser CASCADE;
DROP TABLE IF EXISTS reportAuction CASCADE;
DROP TABLE IF EXISTS banUser CASCADE;
DROP TABLE IF EXISTS banAuction CASCADE;
DROP TABLE IF EXISTS "owner" CASCADE;
DROP TABLE IF EXISTS wishList CASCADE;
DROP TABLE IF EXISTS category CASCADE;
DROP TABLE IF EXISTS buyNow CASCADE;
DROP TABLE IF EXISTS cards CASCADE;
DROP TABLE IF EXISTS items CASCADE;
DROP TABLE IF EXISTS userAuctionLike CASCADE;
DROP TABLE IF EXISTS userCommentLike CASCADE;

DROP FUNCTION IF EXISTS "CheckAuctionDate"() CASCADE;
DROP TRIGGER IF EXISTS "CheckAuctionDate" ON bid CASCADE;
DROP FUNCTION IF EXISTS "CheckUserBid"() CASCADE;
DROP FUNCTION IF EXISTS "CheckUserBuyNow"() CASCADE;
DROP TRIGGER IF EXISTS "CheckUserBid" ON bid CASCADE;
DROP TRIGGER IF EXISTS "CheckUserBuyNow" ON buyNow CASCADE;
DROP FUNCTION IF EXISTS "CheckReportedUserNotAdmin"() CASCADE;
DROP TRIGGER IF EXISTS "ReportedUserNotAdmin" ON reportuser CASCADE;
DROP FUNCTION IF EXISTS "CheckReportingNotAuctionOwner"() CASCADE;
DROP TRIGGER IF EXISTS "ReportingNotOwner" ON reportAuction CASCADE;

CREATE TABLE users(
  user_id SERIAL NOT NULL,
  email text NOT NULL UNIQUE,
  password text NOT NULL,
  firstName text NOT NULL,
  lastName text NOT NULL,
  photo text,
  address text,
  country text,
  contact NUMERIC,
  remember_token text
);

CREATE TABLE admin(
  id SERIAL NOT NULL,
  id_user INTEGER NOT NULL
);

CREATE TABLE bid(
  id SERIAL NOT NULL,
  status BOOLEAN NOT NULL,
  price FLOAT,
  date  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  bid_id_auction INTEGER NOT NULL,
  bid_id_user INTEGER NOT NULL
);

CREATE TABLE auction (
  auction_id SERIAL NOT NULL,
  dateBegin  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  dateEnd  TIMESTAMP WITH TIME zone NOT NULL,
  name text NOT NULL,
  description text,
  actualPrice double precision NOT NULL,
  auctionPhoto text NOT NULL,
  buynow double precision NOT NULL,
  active boolean NOT NULL,
  auction_like INTEGER,
  auction_dislike INTEGER
);

CREATE TABLE userAuctionLike(
    islike boolean NOT NULL,
    id_user INTEGER NOT NULL,
    id_auction INTEGER NOT NULL
);

CREATE TABLE comment(
  id SERIAL NOT NULL,
  "like" INTEGER,
  dislike INTEGER,
  date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  comment text NOT NULL,
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);

CREATE TABLE userCommentLike(
    islike boolean NOT NULL,
    id_user INTEGER NOT NULL,
    id_comment INTEGER NOT NULL
);
CREATE TABLE reportUser(
  id SERIAL NOT NULL,
  reason text NOT NULL,
  id_userReporting INTEGER NOT NULL,
  id_userReported INTEGER NOT NULL,
  date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE reportAuction(
  id SERIAL NOT NULL,
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL,
  reason text NOT NULL,
  date TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE banUser(
  id SERIAL NOT NULL,
  id_user INTEGER NOT NULL,
  id_admin  INTEGER NOT NULL,
  date  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE banAuction(
  id SERIAL NOT NULL,
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL,
  date  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE "owner"(
  id SERIAL NOT NULL,
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);

CREATE TABLE wishList(
  id SERIAL NOT NULL,
  user_id INTEGER NOT NULL,
  auction_id INTEGER NOT NULL,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE category(
    id SERIAL NOT NULL,
    id_auction INTEGER NOT NULL,
    CATEGORY text NOT NULL,
    CONSTRAINT TYPE CHECK ((CATEGORY = ANY (ARRAY['Electronics'::text, 'Fashion'::text, 'Home & Garden'::text, 'Motors'::text, 'Music'::text, 'Toys'::text, 'Daily Deals'::text, 'Sporting'::text, 'Others'::text]))));

CREATE TABLE buyNow(
  id SERIAL NOT NULL,
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);


-- Primary Keys and Uniques

ALTER TABLE ONLY users
  ADD CONSTRAINT user_pkey PRIMARY KEY (user_id);

ALTER TABLE ONLY admin
  ADD CONSTRAINT admin_pkey PRIMARY KEY (id,id_user);

ALTER TABLE ONLY auction
  ADD CONSTRAINT auction_pkey PRIMARY KEY (auction_id);

ALTER TABLE ONLY userAuctionLike
  ADD CONSTRAINT userAuctionLike_pkey PRIMARY KEY (id_user, id_auction);

ALTER TABLE ONLY bid
  ADD CONSTRAINT bid_pkey PRIMARY KEY (id);

ALTER TABLE ONLY comment
  ADD CONSTRAINT comment_pkey PRIMARY KEY (id);

ALTER TABLE ONLY userCommentLike
  ADD CONSTRAINT userCommentLike_pkey PRIMARY KEY (id_user, id_comment);

ALTER TABLE ONLY reportUser
  ADD CONSTRAINT reportUser_pkey PRIMARY KEY (id);

ALTER TABLE ONLY reportAuction
  ADD CONSTRAINT reportAuction_pkey PRIMARY KEY (id);

ALTER TABLE ONLY banUser
  ADD CONSTRAINT banUser_pkey PRIMARY KEY (id);

ALTER TABLE ONLY banAuction
  ADD CONSTRAINT banAuction_pkey PRIMARY KEY (id);

ALTER TABLE ONLY owner
  ADD CONSTRAINT owner_pkey PRIMARY KEY (id_user, id_auction);

ALTER TABLE ONLY wishList
  ADD CONSTRAINT wishList_pkey PRIMARY KEY (id);

ALTER TABLE ONLY buyNow
  ADD CONSTRAINT buynow_pkey PRIMARY KEY (id);


-- Foreign Keys

ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_id_auction_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY banauction
    ADD CONSTRAINT banauction_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY banauction
    ADD CONSTRAINT banauction_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY userAuctionLike
    ADD CONSTRAINT userAuctionLike_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY userAuctionLike
    ADD CONSTRAINT userAuctionLike_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY banuser
    ADD CONSTRAINT banuser_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_id_auction_fkey FOREIGN KEY (bid_id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_id_user_fkey FOREIGN KEY (bid_id_user) REFERENCES users(user_id);

ALTER TABLE ONLY category
    ADD CONSTRAINT category_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY userCommentLike
    ADD CONSTRAINT userCommentLike_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY userCommentLike
    ADD CONSTRAINT userCommentLike_id_comment_fkey FOREIGN KEY (id_comment) REFERENCES comment(id);

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY reportauction
    ADD CONSTRAINT reportauction_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY reportauction
    ADD CONSTRAINT reportauction_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

ALTER TABLE ONLY reportuser
    ADD CONSTRAINT reportinguser_id_user_fkey FOREIGN KEY (id_userReporting) REFERENCES users(user_id);

ALTER TABLE ONLY reportuser
    ADD CONSTRAINT reporteduser_id_user_fkey FOREIGN KEY (id_userReported) REFERENCES users(user_id);

ALTER TABLE ONLY wishlist
    ADD CONSTRAINT wishlist_id_auction_fkey FOREIGN KEY (auction_id) REFERENCES auction(auction_id);

ALTER TABLE ONLY wishlist
    ADD CONSTRAINT wishlist_id_user_fkey FOREIGN KEY (user_id) REFERENCES users(user_id);

ALTER TABLE ONLY buynow
    ADD CONSTRAINT buynow_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(auction_id);

ALTER TABLE ONLY buynow
    ADD CONSTRAINT buynow_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(user_id);

-- INDEXES
CREATE INDEX email_user ON "users" USING hash (email);
CREATE INDEX auctions ON auction USING hash (auction_id);
CREATE INDEX wishList_auction ON wishList USING hash (auction_id);
CREATE INDEX auction_comments ON comment USING hash (id_auction);

-- TRIGGERS and UDFs
CREATE FUNCTION "CheckAuctionDate"() RETURNS trigger
   LANGUAGE plpgsql
   AS $$
DECLARE
   auctionDateEnd date;
BEGIN
   SELECT auction.dateEnd INTO auctionDateEnd FROM auction WHERE auction.auction_id = NEW.bid_id_auction;
   IF auctionDateEnd < NEW.date THEN
       RAISE EXCEPTION 'Cannot bid on closed auction!';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER "CheckAuctionDate"
   BEFORE INSERT ON bid
   FOR EACH ROW
       EXECUTE PROCEDURE "CheckAuctionDate"();

CREATE FUNCTION "CheckUserBid"() RETURNS trigger
   LANGUAGE plpgsql
   AS $$
DECLARE
   sellerId integer;
BEGIN
   SELECT owner.id_user INTO sellerId FROM owner WHERE owner.id_auction = NEW.bid_id_auction;

   IF NEW.bid_id_user = sellerId THEN
       RAISE EXCEPTION 'Cannot have the same buyer as its seller!';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER "CheckUserBid"
   BEFORE INSERT ON bid
   FOR EACH ROW
       EXECUTE PROCEDURE "CheckUserBid"();

CREATE FUNCTION "CheckUserBuyNow"() RETURNS trigger
   LANGUAGE plpgsql
   AS $$
DECLARE
   sellerId INTEGER;
BEGIN
   SELECT owner.id_user INTO sellerId FROM owner WHERE owner.id_auction = NEW.id_auction;
   IF NEW.id_user = sellerId THEN
       RAISE EXCEPTION 'Cannot have the same buyer as its seller!';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER "CheckUserBuyNow"
   BEFORE INSERT ON buyNow
   FOR EACH ROW
       EXECUTE PROCEDURE "CheckUserBuyNow"();


CREATE FUNCTION "CheckReportedUserNotAdmin"() RETURNS trigger
   LANGUAGE plpgsql
   AS $$
DECLARE
   adminCount integer;
BEGIN
   SELECT count(*) INTO adminCount FROM admin WHERE admin.id_user = NEW.id_userReported;
   IF adminCount > 0 THEN
       RAISE EXCEPTION 'Cannot report an admin!';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER "ReportedUserNotAdmin"
   BEFORE INSERT ON reportuser
   FOR EACH ROW
       EXECUTE PROCEDURE "CheckReportedUserNotAdmin"();

CREATE FUNCTION "CheckReportingNotAuctionOwner"() RETURNS trigger
   LANGUAGE plpgsql
   AS $$
DECLARE
   idOwner integer;
BEGIN
   SELECT owner.id_user INTO idOwner FROM auction, owner WHERE auction.auction_id = owner.id_auction AND auction.auction_id = NEW.id_auction;
   IF idOwner = NEW.id_user THEN
       RAISE EXCEPTION 'Cannot report own auction!';
   END IF;
   RETURN NEW;
END;
$$;

CREATE TRIGGER "ReportingNotOwner"
BEFORE INSERT ON reportAuction
FOR EACH ROW
EXECUTE PROCEDURE "CheckReportingNotAuctionOwner"();



INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('João', 'Silva','joaosilva@hotmail.com','perfil_blue.png','Avenida dos Aliados 700',16954062003699,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Teresa', 'Sá','tsa@gmail.com','perfil_blue.png','Rua de Fez 308',16761061088899,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Henrique', 'Trigueiros','htrigueiros@hotmail.com','perfil_blue.png','Rua António Cardoso 28',16101242675199,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Dinis', 'Lopes','dinis.lopes@sapo.pt','perfil_blue.png','Avenida da Boavista 108',16080251457399,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Teresa', 'Ramos','ttramos@gmail.com','perfil_blue.png','Rua de Sintra 798',16736041004499,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Eduardo', 'Azevedo','eduardo_azevedo@hotmail.com','perfil_blue.png','Rua da Quinta 24',16400826496996,'Porto,Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Francisca', 'Santos','fsantos@hotmail.com','perfil_blue.png','Rua da Estrada 29',16040421975299,'Porto, Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Phillip', 'Mathis','phillipMathis@gmail.com','perfil_blue.png','4576 Mauris Ave',16361003936599,'Virgin Islands, British','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Joana', 'Torrinha','jtorrinha@hotmail.com','perfil_blue.png','Rua de Fez 46',16961122182999,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Joel', 'David','joel_david@hotmail.com','perfil_blue.png','Ap #284-6045 Tortor, St.',16010122315299,'Trinidad and Tobago','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Sophia', 'Clark','shopia22@gmail.com','perfil_blue.png','P.O. Box 550, 6334 Elit, Av.',16235031958499,'Mali','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Madeson', 'Velasquez','madeson87@hotmail.com','perfil_blue.png','P.O. Box 948, 2265 Sem Avenue',16790628317299,'Spain','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Eagan', 'Hampton','eagan_hampton@gmail.com','perfil_blue.png','Ap #961-7290 Amet, Street',16520402529799,'Uzbekistan','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Joshua', 'Camacho','joshua65@hotmail.com','perfil_blue.png','P.O. Box 657, 8909 Taciti St.',16650030671099,'Dominican Republic','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Halla', 'Langley','halla_langley@gmail.com','perfil_blue.png','2051 Fusce Road',16570512533899,'Chile','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Burton', 'Stuart','burton_stuart@hotmail.com','perfil_blue.png','356 Nostra, Av.',16510540764799,'United Kingdom (Great Britain)','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Yoshio', 'Chan','yoshionchan21@gmail.com','perfil_blue.png','7528 Amet St.',16520222583799,'Kuwait','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Carson', 'Hansen','carson_hansen@hotmail.com','perfil_blue.png','P.O. Box 238, 9874 Varius St.',16210660785099,'Bahamas','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Tyler', 'Callahan','id.nunc@augueeu.ca','perfil_blue.png','Ap #450-1601 Varius Avenue',16570751541099,'Jordan','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Roanna', 'Walton','est@eget.net','perfil_blue.png','423-8125 Felis, Avenue',16430501642699,'Antarctica','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Tallulah', 'Le','tallulah@gmail.com','perfil_blue.png','724-8471 Ullamcorper, Rd.',16361030768299,'Argentina','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Rajah', 'Santana','non.nisi@anteipsum.org','perfil_blue.png','P.O. Box 654, 8869 Velit Av.',16900408827499,'Cambodia','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Elizabeth', 'Doyle','felis@gmail.com','perfil_blue.png','Ap #824-1976 Arcu Av.',16011213032299,'Bahamas','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Ingrid', 'Shelton','ingrid_shelton@gmail.com','perfil_blue.png','738-1932 Tortor Rd.',16463070322799,'Latvia','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Colleen', 'Hoover','collen.hoover@gmail.com','perfil_blue.png','1135 Metus. St.',16031030131599,'Grenada','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Amber', 'Alvarado','amber_alvarado@gmail.com','perfil_blue.png','Ap #357-8402 Faucibus Road',16154123077799,'Mali','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Remedios', 'Hopper','remedios_hopeer@gmail.com','perfil_blue.png','767-1240 Donec Street',16170511950199,'El Salvador','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Kitra', 'Jennings','kitra@gmail.com','perfil_blue.png','Ap #192-5474 Pretium Street',16240531568799,'Georgia','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Julie', 'Ross','julie.ross@gmail.com','perfil_blue.png','Ap #755-9925 Purus Avenue',16490591007299,'Zimbabwe','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Fernando', 'Cassola','fcassola@fe.up.pt','perfil_blue.png','Rua da Batalha',00351937563986,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Francisca', 'Cerquinho','up201505791@fe.up.pt','perfil_blue.png','Rua da Batalha',00351937563986,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Diogo', 'Silva','up201405742@fe.up.pt','perfil_blue.png','Rua da Batalha',00351937563986,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('José', 'Azevedo','up201506448@fe.up.pt','perfil_blue.png','Rua da Batalha',00351937563986,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password,remember_token) VALUES ('Pedro', 'Miranda','pedro21fcp@gmail.com','perfil_blue.png','Rua Nova da Gandra',00351961835740,'Portugal','$2y$10$IqWEImbQM5N4nIEMzWH4f.AJUYrmN7n2SkOgTDQCsB7.lj0.XMOPC','a7Exqf7pDTL7JSQ8hGGeQzzfLHbuedsXhdbgzVuCL3iewX9aQhpQ0sdveM0b');

INSERT INTO admin (id_user) VALUES (30);
INSERT INTO admin (id_user) VALUES (31);
INSERT INTO admin (id_user) VALUES (32);
INSERT INTO admin (id_user) VALUES (33);

INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-13 00:00:00','2018-06-11 10:51:25','PS4 Controllers','Two Sony PS4 controllers that were only used once.',50.99,'play.jpg',70,'1',12,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-26 00:00:00','2018-06-11 10:17:00','Phone','The new one! Two good to be true! Buy now!',280.00,'phone.jpg',350.50,'1',10,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-20 00:00:00','2018-06-02 00:00:00','MacbookPro','The new MacbookPro, 13 polg.',1000.99,'macbook.jpg',1500.10,'1',8,2);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-14 00:00:00','2018-06-01 00:00:00','Iphone7','The new iphone 7 with 64GB.',700.50,'iphone.jpg',750.60,'1',15,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-13 00:00:00','2018-06-02 00:00:00','New Album David Bowie','The new album from david bowie. Good conditions',20.90,'music.jpg',25.50,'1',12,3);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-05 00:00:00','2018-06-01 00:00:00','Vinyl Mike Evans','The album from Mike Evans.',25.90,'music2.jpg',27.00,'1',14,3);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-08 00:00:00','2018-06-03 00:00:00','Vinyl','The new Vynil! Buy now.',30.22,'music3.jpg',36.84,'1',13,2);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-20 00:00:00','2018-06-08 00:00:00','Camera Nikon D7500','The new Nikon camera!',468.41,'camera.jpg',500.62,'1',2,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-04 00:00:00','2018-06-02 00:00:00','New Camera','The new one.Buy now!',26.00,'camera2.jpg',30.66,'1',6,2);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-01 00:00:00','2018-06-02 00:00:00','Tennis Nike','The new Tennis from nike!',96.00,'sport.jpg',100.00,'1',2,3);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-15 00:00:00','2018-06-01 00:00:00','QUAY AUSTRALIA Sunglasses','The new blue sunglasses!',90.92,'sunglasses.jpg',92.40,'1',16,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-03 00:00:00','2018-06-02 00:00:00','Prada Cameo Saffiano','The new fashion!',500.49,'prada.jpg',520.05,'1',5,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-10 00:00:00','2018-06-03 00:00:00','Vases','Very good price',15.51,'garden.jpg',12.50,'1',12,3);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-04 00:00:00','2018-06-03 00:00:00','Toy for boys','Very nice',20.59,'toy.jpg',25.13,'1',12,4);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-24 00:00:00','2018-06-01 00:00:00','Toy for little boys','Very cool',19.58,'toy2.jpeg',22.81,'1',12,2);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-14 00:00:00','2018-06-02 00:00:00','Kitchen design','Very cool',8.31,'garden2.jpeg',10.81,'1',12,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-01 00:00:00','2018-06-01 00:00:00','Water pump motors','The new one in the market!',60.00,'motor.jpg',100.07,'1',9,4);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-07 00:00:00','2018-06-03 00:00:00','Servo motors','Best worldwide servo motors',65.63,'motor2.jpg',120.53,'1',7,5);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-20 00:00:00','2018-06-03 00:00:00','Lit motors','New in the marker',35523.53,'motor3.jpg',55000.86,'1',17,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-06 00:00:00','2018-06-01 00:00:00','Baldor electric motors','Best conditions',32.62,'motor4.jpg',65.31,'1',13,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-08 00:00:00','2018-06-03 00:00:00','Mac Burguer','Delicious and tasty',3.47,'hamburguer.jpg',5.13,'1',13,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-01 00:00:00','2018-06-01 00:00:00','Best Perfume','The best perfume',80.58,'perfum.jpg',100.12,'1',18,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-06 00:00:00','2018-06-03 00:00:00','Bike 320','Fury Pro Mountain bike',260.57,'bike.jpeg',500.66,'1',8,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-14 00:00:00','2018-06-03 00:00:00','Raquet','The new one!',80.65,'tenis.jpg',100.30,'1',4,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-12 00:00:00','2018-06-02 00:00:00','Weights for the gym','Good conditions, with the best price.',15.69,'gym.jpeg',30.06,'1',6,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-10 00:00:00','2018-06-02 00:00:00','Books English collection','Really good',65.46,'book.jpg',80.53,'1',0,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-20 00:00:00','2018-06-01 00:00:00','Ipad Pro 12.9-inch','The new one in good conditions',600.61,'ipad.jpg',1000.23,'1',7,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-05 00:00:00','2018-06-03 00:00:00','Huawei 69GB','In good condition with one year warranty',260.53,'huawei.jpg',380.14,'1',15,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-24 00:00:00','2018-06-01 00:00:00','Mackbook Pro - grey','It was only used 2 months, like new',1200.07,'mackbook2.jpg',2000.97,'1',6,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-03 00:00:00','2018-06-02 00:00:00','Bathroom furniture','In good condition, we ride in your house',1800.14,'bathroom.jpg',2300.42,'1',3,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-31 00:00:00','2018-06-01 00:00:00','Office','New office! Relaxed and clean environment',2100.10,'office.jpg',3100.67,'1',8,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-20 00:00:00','2018-06-02 00:00:00','Dog Elipsy','Dog with two years old',600.74,'dog.jpg',803.01,'1',9,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-31 00:00:00','2018-06-02 00:00:00','ONE Zen Silver Watch','ONE Zen Silver Watch. Choose your color',90.16,'one.jpg',180.91,'1',7,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-10 00:00:00','2018-06-03 00:00:00','Soft toys','Disney Soft toys',54.38,'toys.jpg',70.69,'1',12,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-15 00:00:00','2018-06-01 00:00:00','Skate','The new one in the market',80.50,'skate.jpg',140.60,'1',12,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-09 00:00:00','2018-06-01 00:00:00','Car','VW Polo 2018',1500.79,'car.jpg',2000.75,'1',12,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-11 00:00:00','2018-06-01 00:00:00','Hammett','arcu. Aliquam ultrices iaculis odio. Nam',19.89,'ligulaonecluctusaliquetodiotiam',27.86,'0',12,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-05 00:00:00','2018-06-03 00:00:00','Chase','lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit',11.00,'nonlobortisquispedeuspendissedui.',16.36,'0',2,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-16 00:00:00','2018-06-01 00:00:00','Rudyard','elit elit fermentum risus, at',13.27,'adipiscinglobortisrisusnmipede,',18.50,'0',12,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-19 00:00:00','2018-06-03 00:00:00','Jacqueline','Phasellus ornare. Fusce mollis. Duis sit amet diam',6.40,'dolorsitametconsectetueradipiscingelit.',10.77,'0',12,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-12 00:00:00','2018-06-03 00:00:00','Beau','pede et risus. Quisque libero lacus, varius et,',17.18,'urnattinciduntvehicularisusulla',19.85,'0',9,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-19 00:00:00','2018-06-03 00:00:00','Myles','vel sapien imperdiet ornare. In faucibus.',22.12,'aultriciesadipiscingenimmitempor',25.24,'0',2,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-18 00:00:00','2018-06-03 00:00:00','Gwendolyn','sed dictum eleifend, nunc',7.23,'onecelementumloremutaliquamiaculis,',12.57,'0',6,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-01 00:00:00','2018-06-02 00:00:00','Kiara','Nullam enim. Sed nulla ante, iaculis nec, eleifend',8.51,'blanditconguencelerisquescelerisquedui.',13.10,'0',1,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-23 00:00:00','2018-06-03 00:00:00','Zeus','Duis volutpat nunc sit amet metus. Aliquam erat',15.87,'volutpatNulladignissimMaecenasornareegestas',25.65,'0',0,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-11 00:00:00','2018-06-02 00:00:00','Kevyn','lobortis risus. In mi pede, nonummy ut,',19.01,'justoraesentluctusurabituregestasnunc',22.80,'0',12,0);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-29 00:00:00','2018-06-01 00:00:00','Brody','Proin. In mi pede,',15.61,'variuseteuismodetcommodoat',18.62,'0',12,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-13 00:00:00','2018-06-03 00:00:00','Shellie','Donec egestas. Duis ac arcu. Nunc mauris. Morbi non',1.45,'onecluctusaliquetodiotiamligula',7.84,'0',12,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-29 00:00:00','2018-06-02 00:00:00','Yuri','Nam ac nulla. In tincidunt congue turpis.',3.65,'velitegetlaoreetposuereenimnisl',9.42,'0',12,1);
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,auctionPhoto,buyNow,active,auction_like,auction_dislike) VALUES ('2018-03-02 00:00:00','2018-06-01 00:00:00','Keaton','magnis',1.78,'gravidanuncsedpedeumsociis',6.61,'0',12,1);


INSERT INTO bid (status,price,date,bid_id_auction,bid_id_user) VALUES ('0',0.80,DEFAULT,7,12);
INSERT INTO bid (status,price,date,bid_id_auction,bid_id_user) VALUES ('0',3.85,DEFAULT,16,26);
INSERT INTO bid (status,price,date,bid_id_auction,bid_id_user) VALUES ('0',1.59,DEFAULT,13,21);
INSERT INTO bid (status,price,date,bid_id_auction,bid_id_user) VALUES ('0',14.06,DEFAULT,32,24);
INSERT INTO bid (status,price,date,bid_id_auction,bid_id_user) VALUES ('0',5.86,DEFAULT,14,1);
INSERT INTO bid (status,price,date,bid_id_auction,bid_id_user) VALUES ('0',18.51,DEFAULT,8,17);

INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (4,3,'2018-03-26 00:46:15','in, hendrerit consectetuer, cursus et, magna. Praesent',19,1);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (14,3,'2018-03-28 02:28:40','Proin nisl sem, consequat nec,',30,4);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (12,6,'2018-03-24 21:32:12','Sed id risus quis diam luctus lobortis. Class',4,13);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (12,2,'2018-03-31 16:50:57','magna. Sed eu eros. Nam consequat',4,34);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (10,4,'2018-04-01 16:57:16','libero. Proin sed turpis nec mauris blandit mattis. Cras eget nisi',8,47);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (6,5,'2018-03-30 17:36:06','Mauris blandit enim consequat purus. Maecenas libero est,',14,42);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (6,5,'2018-04-01 04:19:56','dictum cursus. Nunc mauris elit, dictum eu, eleifend nec,',5,4);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (13,3,'2018-03-28 23:48:02','magna. Cras convallis convallis dolor. Quisque tincidunt pede',13,16);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (10,6,'2018-03-22 16:56:52','eu, ultrices sit amet, risus. Donec nibh',16,37);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (6,4,'2018-03-30 19:48:28','feugiat metus sit amet ante. Vivamus non lorem',16,3);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,2,'2018-03-22 00:39:35','ac mattis velit justo nec ante. Maecenas mi',1,32);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (14,3,'2018-03-25 07:38:37','magna. Nam ligula elit, pretium et, rutrum',6,41);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,2,'2018-03-24 12:15:12','nec urna et arcu imperdiet ullamcorper. Duis at',7,21);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,4,'2018-03-31 08:03:59','In condimentum. Donec at arcu. Vestibulum',14,46);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (9,4,'2018-03-31 13:18:39','et, euismod et, commodo at, libero. Morbi accumsan laoreet ipsum.',29,27);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (8,2,'2018-03-22 16:46:37','consectetuer rhoncus. Nullam velit dui,',4,19);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,1,'2018-04-01 05:41:24','eu tellus eu augue porttitor',1,13);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (13,5,'2018-03-23 17:05:54','dui, in sodales elit erat vitae risus. Duis a mi fringilla',20,26);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (2,3,'2018-03-23 14:41:11','hendrerit. Donec porttitor tellus non magna.',28,21);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (14,1,'2018-04-02 11:58:13','a, arcu. Sed et libero. Proin mi. Aliquam gravida mauris ut mi.',12,25);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,2,'2018-04-01 03:58:43','Proin non massa non ante bibendum ullamcorper.',25,34);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (4,5,'2018-04-02 15:32:54','Etiam ligula tortor, dictum eu, placerat',12,39);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (7,1,'2018-03-25 01:17:53','Suspendisse eleifend. Cras sed leo. Cras vehicula aliquet libero. Integer',4,26);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (9,4,'2018-03-31 15:27:08','urna convallis erat, eget tincidunt dui augue eu tellus.',17,6);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (2,6,'2018-03-30 02:59:07','neque et nunc. Quisque ornare tortor at',24,11);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (3,2,'2018-03-28 13:45:40','nonummy ac, feugiat non, lobortis quis,',18,5);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (6,1,'2018-03-28 10:45:59','nostra, per inceptos hymenaeos. Mauris ut quam',5,30);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (6,2,'2018-03-24 17:55:23','Fusce aliquet magna a neque.',5,9);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (4,4,'2018-03-30 13:33:12','Etiam vestibulum massa rutrum magna. Cras convallis convallis',3,18);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,5,'2018-03-30 00:28:24','felis eget varius ultrices, mauris ipsum porta elit, a',14,11);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (10,6,'2018-03-24 03:22:09','auctor non, feugiat nec, diam. Duis mi enim, condimentum eget,',2,18);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,6,'2018-03-31 00:10:39','Sed neque. Sed eget lacus. Mauris',2,28);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (9,2,'2018-03-22 10:48:08','Sed id risus quis diam luctus lobortis. Class aptent taciti sociosqu',19,6);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (6,6,'2018-03-25 08:14:37','nec, eleifend non, dapibus rutrum, justo.',11,6);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (13,4,'2018-03-22 00:12:41','semper tellus id nunc interdum feugiat. Sed nec metus facilisis',27,9);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (11,1,'2018-03-30 18:04:47','semper rutrum. Fusce dolor quam, elementum at, egestas a, scelerisque sed,',18,16);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (15,6,'2018-03-22 11:01:39','Fusce diam nunc, ullamcorper eu, euismod ac, fermentum vel,',23,50);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (2,1,'2018-03-25 05:04:54','Nunc pulvinar arcu et pede. Nunc sed orci',22,33);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (4,2,'2018-03-28 07:58:37','a, auctor non, feugiat nec, diam. Duis',21,48);
INSERT INTO comment ("like",dislike,"date",comment,id_user,id_auction) VALUES (9,1,'2018-03-27 02:29:06','placerat. Cras dictum ultricies ligula. Nullam enim. Sed nulla ante,',2,29);

INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('mattis. Integer eu lacus. Quisque',11,12,'2018-03-20 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('turpis vitae purus gravida sagittis.',9,24,'2018-03-21 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('pede. Cras vulputate velit eu',7,9,'2018-03-22 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('auctor velit. Aliquam nisl. Nulla',30,29,'2018-03-21 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('Nunc lectus pede, ultrices a,',5,16,'2018-03-06 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('mollis nec, cursus a, enim.',4,10,'2018-03-30 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('Etiam imperdiet dictum magna. Ut',20,26,'2018-04-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('vitae nibh. Donec est mauris,',24,17,'2018-01-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('convallis erat, eget tincidunt dui',8,6,'2018-03-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('fermentum vel, mauris. Integer sem',22,15,'2018-03-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('Quisque porttitor eros nec tellus.',5,21,'2018-03-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('consequat dolor vitae dolor. Donec',13,23,'2018-03-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('dictum augue malesuada malesuada. Integer',19,3,'2018-03-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('nibh. Aliquam ornare, libero at',14,5,'2018-03-26 00:46:15');
INSERT INTO reportUser (reason,id_userReporting,id_userReported,date) VALUES ('feugiat non, lobortis quis, pede.',21,24,'2018-03-26 00:46:15');

INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (2,26,'ornare. Fusce mollis. Duis sit','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (12,24,'leo, in lobortis tellus justo','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (13,37,'ac mi eleifend egestas. Sed','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (26,29,'accumsan neque et nunc. Quisque','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (5,43,'Integer in magna. Phasellus dolor','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (30,27,'lacinia. Sed congue, elit sed','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (11,2,'tellus eu augue porttitor interdum.','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (5,35,'tincidunt, nunc ac mattis ornare,','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (7,29,'lectus. Nullam suscipit, est ac','2018-03-20 00:46:15');
INSERT INTO reportAuction (id_user,id_auction,reason,date) VALUES (7,36,'mi eleifend egestas. Sed pharetra,','2018-03-20 00:46:15');

INSERT INTO owner (id_user,id_auction) VALUES (1,1);
INSERT INTO owner (id_user,id_auction) VALUES (17,2);
INSERT INTO owner (id_user,id_auction) VALUES (10,3);
INSERT INTO owner (id_user,id_auction) VALUES (20,4);
INSERT INTO owner (id_user,id_auction) VALUES (14,5);
INSERT INTO owner (id_user,id_auction) VALUES (8,6);
INSERT INTO owner (id_user,id_auction) VALUES (22,7);
INSERT INTO owner (id_user,id_auction) VALUES (3,8);
INSERT INTO owner (id_user,id_auction) VALUES (1,9);
INSERT INTO owner (id_user,id_auction) VALUES (6,10);
INSERT INTO owner (id_user,id_auction) VALUES (24,11);
INSERT INTO owner (id_user,id_auction) VALUES (16,12);
INSERT INTO owner (id_user,id_auction) VALUES (17,13);
INSERT INTO owner (id_user,id_auction) VALUES (14,14);
INSERT INTO owner (id_user,id_auction) VALUES (4,15);
INSERT INTO owner (id_user,id_auction) VALUES (15,16);
INSERT INTO owner (id_user,id_auction) VALUES (5,17);
INSERT INTO owner (id_user,id_auction) VALUES (21,18);
INSERT INTO owner (id_user,id_auction) VALUES (16,19);
INSERT INTO owner (id_user,id_auction) VALUES (24,20);
INSERT INTO owner (id_user,id_auction) VALUES (28,21);
INSERT INTO owner (id_user,id_auction) VALUES (22,22);
INSERT INTO owner (id_user,id_auction) VALUES (30,23);
INSERT INTO owner (id_user,id_auction) VALUES (6,24);
INSERT INTO owner (id_user,id_auction) VALUES (29,25);
INSERT INTO owner (id_user,id_auction) VALUES (13,26);
INSERT INTO owner (id_user,id_auction) VALUES (18,27);
INSERT INTO owner (id_user,id_auction) VALUES (28,28);
INSERT INTO owner (id_user,id_auction) VALUES (25,29);
INSERT INTO owner (id_user,id_auction) VALUES (27,30);
INSERT INTO owner (id_user,id_auction) VALUES (15,31);
INSERT INTO owner (id_user,id_auction) VALUES (23,32);
INSERT INTO owner (id_user,id_auction) VALUES (10,33);
INSERT INTO owner (id_user,id_auction) VALUES (7,34);
INSERT INTO owner (id_user,id_auction) VALUES (26,35);
INSERT INTO owner (id_user,id_auction) VALUES (11,36);
INSERT INTO owner (id_user,id_auction) VALUES (7,37);
INSERT INTO owner (id_user,id_auction) VALUES (22,38);
INSERT INTO owner (id_user,id_auction) VALUES (19,39);
INSERT INTO owner (id_user,id_auction) VALUES (11,40);
INSERT INTO owner (id_user,id_auction) VALUES (3,41);
INSERT INTO owner (id_user,id_auction) VALUES (5,42);
INSERT INTO owner (id_user,id_auction) VALUES (28,43);
INSERT INTO owner (id_user,id_auction) VALUES (22,44);
INSERT INTO owner (id_user,id_auction) VALUES (6,45);
INSERT INTO owner (id_user,id_auction) VALUES (4,46);
INSERT INTO owner (id_user,id_auction) VALUES (27,47);
INSERT INTO owner (id_user,id_auction) VALUES (2,48);
INSERT INTO owner (id_user,id_auction) VALUES (4,49);
INSERT INTO owner (id_user,id_auction) VALUES (10,50);

INSERT INTO banUser (id_user,id_admin,date) VALUES (12,2,'2018-04-19 01:43:11');
INSERT INTO banUser (id_user,id_admin,date) VALUES (24,1,'2018-04-13 11:43:42');
INSERT INTO banUser (id_user,id_admin,date) VALUES (9,1,'2018-04-14 07:45:18');
INSERT INTO banUser (id_user,id_admin,date) VALUES (29,2,'2018-04-13 14:19:08');
INSERT INTO banUser (id_user,id_admin,date) VALUES (16,4,'2018-04-20 09:14:28');
INSERT INTO banUser (id_user,id_admin,date) VALUES (6,2,'2018-04-15 13:05:22');
INSERT INTO banUser (id_user,id_admin,date) VALUES (26,2,'2018-04-14 20:00:00');
INSERT INTO banUser (id_user,id_admin,date) VALUES (15,1,'2018-04-14 21:24:49');
INSERT INTO banUser (id_user,id_admin,date) VALUES (21,2,'2018-04-12 17:53:11');
INSERT INTO banUser (id_user,id_admin,date) VALUES (5,3,'2018-04-12 07:38:01');

INSERT INTO banAuction (id_user,id_auction,date) VALUES (2,26,'2018-04-07 12:30:37');
INSERT INTO banAuction (id_user,id_auction,date) VALUES (12,24,'2018-04-07 23:54:50');
INSERT INTO banAuction (id_user,id_auction,date) VALUES (13,37,'2018-04-08 17:25:38');
INSERT INTO banAuction (id_user,id_auction,date) VALUES (26,29,'2018-04-08 06:36:13');
INSERT INTO banAuction (id_user,id_auction,date) VALUES (5,43,'2018-04-05 11:43:16');
INSERT INTO banAuction (id_user,id_auction,date) VALUES (30,27,'2018-04-09 10:33:17');
INSERT INTO banAuction (id_user,id_auction,date) VALUES (11,2,'2018-04-05 22:49:11');

INSERT INTO wishList (user_id,auction_id,date) VALUES (1,14,'2018-04-03 23:43:54');
INSERT INTO wishList (user_id,auction_id,date) VALUES (2,18,'2018-04-02 16:41:23');
INSERT INTO wishList (user_id,auction_id,date) VALUES (34,20,'2018-04-02 11:22:29');
INSERT INTO wishList (user_id,auction_id,date) VALUES (34,15,'2018-04-02 17:35:58');
INSERT INTO wishList (user_id,auction_id,date) VALUES (13,1,'2018-04-01 10:49:53');
INSERT INTO wishList (user_id,auction_id,date) VALUES (8,9,'2018-04-01 11:17:49');



INSERT INTO category (id_auction,Category) VALUES (1,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (2,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (3,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (4,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (5,'Music');
INSERT INTO category (id_auction,Category) VALUES (6,'Music');
INSERT INTO category (id_auction,Category) VALUES (7,'Music');
INSERT INTO category (id_auction,Category) VALUES (8,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (9,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (10,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (11,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (12,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (13,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (14,'Toys');
INSERT INTO category (id_auction,Category) VALUES (15,'Toys');
INSERT INTO category (id_auction,Category) VALUES (16,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (17,'Motors');
INSERT INTO category (id_auction,Category) VALUES (18,'Motors');
INSERT INTO category (id_auction,Category) VALUES (19,'Motors');
INSERT INTO category (id_auction,Category) VALUES (20,'Motors');
INSERT INTO category (id_auction,Category) VALUES (21,'Daily Deals');
INSERT INTO category (id_auction,Category) VALUES (22,'Daily Deals');
INSERT INTO category (id_auction,Category) VALUES (23,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (24,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (25,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (26,'Others');
INSERT INTO category (id_auction,Category) VALUES (27,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (28,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (29,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (30,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (31,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (32,'Others');
INSERT INTO category (id_auction,Category) VALUES (33,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (34,'Toys');
INSERT INTO category (id_auction,Category) VALUES (35,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (36,'Others');
INSERT INTO category (id_auction,Category) VALUES (37,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (38,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (39,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (40,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (41,'Others');
INSERT INTO category (id_auction,Category) VALUES (42,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (43,'Toys');
INSERT INTO category (id_auction,Category) VALUES (44,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (45,'Others');
INSERT INTO category (id_auction,Category) VALUES (46,'Motors');
INSERT INTO category (id_auction,Category) VALUES (47,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (48,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (49,'Music');
INSERT INTO category (id_auction,Category) VALUES (50,'Others');

INSERT INTO buyNow (id_user,id_auction) VALUES (17,26);
INSERT INTO buyNow (id_user,id_auction) VALUES (2,30);
INSERT INTO buyNow (id_user,id_auction) VALUES (30,43);
INSERT INTO buyNow (id_user,id_auction) VALUES (1,31);
INSERT INTO buyNow (id_user,id_auction) VALUES (12,46);
