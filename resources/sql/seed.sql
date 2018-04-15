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
  id SERIAL NOT NULL,
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
  id_auction INTEGER NOT NULL,
  id_user INTEGER NOT NULL
);

CREATE TABLE auction (
  id SERIAL NOT NULL,
  dateBegin  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  dateEnd  TIMESTAMP WITH TIME zone NOT NULL,
  name text NOT NULL,
  description text,
  actualPrice double precision NOT NULL,
  photo text NOT NULL,
  buynow double precision NOT NULL,
  active boolean NOT NULL
);

CREATE TABLE comment(
  id SERIAL NOT NULL,
  "like" INTEGER,
  dislike INTEGER,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  comment text NOT NULL,
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);

CREATE TABLE reportUser(
  id SERIAL NOT NULL,
  reason text NOT NULL,
  id_userReporting INTEGER NOT NULL,
  id_userReported INTEGER NOT NULL
);

CREATE TABLE reportAuction(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL,
  reason text NOT NULL
);

CREATE TABLE banUser(
  id SERIAL NOT NULL,
  id_user INTEGER NOT NULL,
  id_admin  INTEGER NOT NULL,
  isBanned BOOLEAN NOT NULL,
  dateBegin  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  dateEnd  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE banAuction(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL,
  isBanned BOOLEAN NOT NULL,
  dateBegin  TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL
);

CREATE TABLE "owner"(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);

CREATE TABLE wishList(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  follow BOOLEAN NOT NULL
);

CREATE TABLE category(
    id_auction INTEGER NOT NULL,
    CATEGORY text NOT NULL,
    CONSTRAINT TYPE CHECK ((CATEGORY = ANY (ARRAY['Electronics'::text, 'Fashion'::text, 'Home & Garden'::text, 'Motors'::text, 'Music'::text, 'Toys'::text, 'Daily Deals'::text, 'Sporting'::text, 'Others'::text]))));

CREATE TABLE buyNow(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);


-- Primary Keys and Uniques

ALTER TABLE ONLY users
  ADD CONSTRAINT user_pkey PRIMARY KEY (id);

ALTER TABLE ONLY admin
  ADD CONSTRAINT admin_pkey PRIMARY KEY (id,id_user);

ALTER TABLE ONLY auction
  ADD CONSTRAINT auction_pkey PRIMARY KEY (id);

ALTER TABLE ONLY bid
  ADD CONSTRAINT bid_pkey PRIMARY KEY (id);

ALTER TABLE ONLY comment
  ADD CONSTRAINT comment_pkey PRIMARY KEY (id);

ALTER TABLE ONLY reportUser
  ADD CONSTRAINT reportUser_pkey PRIMARY KEY (id);

ALTER TABLE ONLY reportAuction
  ADD CONSTRAINT reportAuction_pkey PRIMARY KEY (id_user,id_auction);

ALTER TABLE ONLY banUser
  ADD CONSTRAINT banUser_pkey PRIMARY KEY (id_user);

ALTER TABLE ONLY banAuction
  ADD CONSTRAINT banAuction_pkey PRIMARY KEY (id_user,id_auction);
ALTER TABLE ONLY owner
  ADD CONSTRAINT owner_pkey PRIMARY KEY (id_user, id_auction);

ALTER TABLE ONLY wishList
  ADD CONSTRAINT wishList_pkey PRIMARY KEY (id_user, id_auction);

ALTER TABLE ONLY buyNow
  ADD CONSTRAINT buynow_pkey PRIMARY KEY (id_user, id_auction);


-- Foreign Keys

ALTER TABLE ONLY admin
    ADD CONSTRAINT admin_id_auction_fkey FOREIGN KEY (id_user) REFERENCES users(id);

ALTER TABLE ONLY banauction
    ADD CONSTRAINT banauction_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY banauction
    ADD CONSTRAINT banauction_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);


ALTER TABLE ONLY banuser
    ADD CONSTRAINT banuser_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY bid
    ADD CONSTRAINT bid_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);

ALTER TABLE ONLY category
    ADD CONSTRAINT category_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY comment
    ADD CONSTRAINT comment_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY owner
    ADD CONSTRAINT owner_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);

ALTER TABLE ONLY reportauction
    ADD CONSTRAINT reportauction_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY reportauction
    ADD CONSTRAINT reportauction_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);

ALTER TABLE ONLY reportuser
    ADD CONSTRAINT reportinguser_id_user_fkey FOREIGN KEY (id_userReporting) REFERENCES users(id);

ALTER TABLE ONLY reportuser
    ADD CONSTRAINT reporteduser_id_user_fkey FOREIGN KEY (id_userReported) REFERENCES users(id);

ALTER TABLE ONLY wishlist
    ADD CONSTRAINT wishlist_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY wishlist
    ADD CONSTRAINT wishlist_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);

ALTER TABLE ONLY buynow
    ADD CONSTRAINT buynow_id_auction_fkey FOREIGN KEY (id_auction) REFERENCES auction(id);

ALTER TABLE ONLY buynow
    ADD CONSTRAINT buynow_id_user_fkey FOREIGN KEY (id_user) REFERENCES users(id);

-- INDEXES
CREATE INDEX email_user ON "users" USING hash (email);
CREATE INDEX auctions ON auction USING hash (id);
CREATE INDEX wishList_auction ON wishList USING hash (id_auction);
CREATE INDEX auction_comments ON comment USING hash (id_auction);

-- TRIGGERS and UDFs
CREATE FUNCTION "CheckAuctionDate"() RETURNS trigger
   LANGUAGE plpgsql
   AS $$
DECLARE
   auctionDateEnd date;
BEGIN
   SELECT auction.dateEnd INTO auctionDateEnd FROM auction WHERE auction.id = NEW.id_auction;
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
   SELECT owner.id_user INTO sellerId FROM owner WHERE owner.id_auction = NEW.id_auction;

   IF NEW.id_user = sellerId THEN
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
   SELECT owner.id_user INTO idOwner FROM auction, owner WHERE auction.id = owner.id_auction AND auction.id = NEW.id_auction;
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



INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Melvin', 'Flowers','pede.Suspendisse.dui@magna.ca','neccursusaenimSuspendissealiquet','Ap #593-1560 Rhoncus. Avenue',16670680424499,'Samoa','DD99828558BF504D5A1DB0E646554811');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Cadman', 'Albert','id@Integersemelit.com','neccursusaenimSuspendissealiquet','P.O. Box 854, 9268 Vehicula Road',16954062003699,'Bangladesh','DHDH7439FJDHD3749DNDBF48484HFHF8');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Sacha', 'Stephens','tincidunt.nibh.Phasellus@euligula.edu','neccursusaenimSuspendissealiquet','1784 Metus Rd.',16761061088899,'Reunion','DJ464837DJDJD474747DHDD74747DDFD');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Ferris', 'Meyer','ornare.placerat.orci@luctuslobortisClass.co.uk','neccursusaenimSuspendissealiquet','3854 Phasellus Rd.',16101242675199,'Vanuatu','DHF6D6D88888D8643934HHH434G4G848');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('John', 'Rich','justo.faucibus@porttitorscelerisque.net','neccursusaenimSuspendissealiquet','644-9260 Nisl. Avenue',16080251457399,'Papua New Guinea','GF7575JG8867458FHGJ68685943FJ494');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Kiayada', 'Glass','pharetra.felis.eget@leoVivamusnibh.com','neccursusaenimSuspendissealiquet','9694 Facilisis. Avenue',16736041004499,'Oman','FGF53884839FNVJF848484HFFHF8484');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Orson', 'Andrews','mi.enim@musDonec.net','neccursusaenimSuspendissealiquet','344-4356 In St.',16400826496996,'Niue','FGF5DSF4FGHD74645848484HFFHF8484');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Elmo', 'Simpson','ipsum.dolor.sit@arcu.ca','neccursusaenimSuspendissealiquet','Ap #973-5666 Donec St.',16040421975299,'Christmas Island','FDRTR547735FNVJF848484HFFHF8484');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Phillip', 'Mathis','orci@maurissagittisplacerat.net','neccursusaenimSuspendissealiquet','4576 Mauris Ave',16361003936599,'Virgin Islands, British','FJKGDHSJ8734HJFSU77437RUJDDG4');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Fulton', 'Fuentes','fringilla.euismod.enim@nibhPhasellusnulla.com','neccursusaenimSuspendissealiquet','P.O. Box 171, 8947 Quis, St.',16961122182999,'Madagascar','SDGSDHFKSGFH784W64345MNGJDBN744');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Joel', 'David','ipsum.Donec.sollicitudin@Sed.edu','neccursusaenimSuspendissealiquet','Ap #284-6045 Tortor, St.',16010122315299,'Trinidad and Tobago','DJHFJKSHF8473473283SDFNBHSFDGHV332');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Sophia', 'Clark','mauris.id.sapien@vulputatemaurissagittis.ca','neccursusaenimSuspendissealiquet','P.O. Box 550, 6334 Elit, Av.',16235031958499,'Mali','SNDGHSM46732ERYHDJSBN473435');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Madeson', 'Velasquez','velit.Aliquam.nisl@id.com','neccursusaenimSuspendissealiquet','P.O. Box 948, 2265 Sem Avenue',16790628317299,'Spain','GHJ456783267839634758GHFDJDF');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Eagan', 'Hampton','Donec@ipsumportaelit.net','neccursusaenimSuspendissealiquet','Ap #961-7290 Amet, Street',16520402529799,'Uzbekistan','GHJK452367485964537FGSDH');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Joshua', 'Camacho','euismod.et.commodo@Donectempor.com','neccursusaenimSuspendissealiquet','P.O. Box 657, 8909 Taciti St.',16650030671099,'Dominican Republic','3HF567485DSFGHFJ467DHS46YTGFD');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Halla', 'Langley','odio.Nam.interdum@augue.org','neccursusaenimSuspendissealiquet','2051 Fusce Road',16570512533899,'Chile','SGHJ647586GFHJG64758987FG');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Burton', 'Stuart','mollis@idantedictum.ca','neccursusaenimSuspendissealiquet','356 Nostra, Av.',16510540764799,'United Kingdom (Great Britain)','DF456789TFGHJYT345678DFGHJKT6U');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Yoshio', 'Chan','tincidunt.tempus.risus@laciniavitae.com','neccursusaenimSuspendissealiquet','7528 Amet St.',16520222583799,'Kuwait','DFG3456789OIHG45TGHU6545TGHJU');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Carson', 'Hansen','hendrerit.id@ultriciesligulaNullam.com','neccursusaenimSuspendissealiquet','P.O. Box 238, 9874 Varius St.',16210660785099,'Bahamas','DFGR45TYGBNJUYT567IOIUHGFDCVSDFGH');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Tyler', 'Callahan','id.nunc@augueeu.ca','neccursusaenimSuspendissealiquet','Ap #450-1601 Varius Avenue',16570751541099,'Jordan','DFGHR456YGHBNJKIUYT567UJKOI5FR');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Roanna', 'Walton','est@eget.net','neccursusaenimSuspendissealiquet','423-8125 Felis, Avenue',16430501642699,'Antarctica','EFVBHR45678IJNMKO6543WSDFGHJKO09');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Tallulah', 'Le','mattis.ornare@Namligula.co.uk','neccursusaenimSuspendissealiquet','724-8471 Ullamcorper, Rd.',16361030768299,'Argentina','DFGEW23456789UHGFRTYU9873FGT6J');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Rajah', 'Santana','non.nisi@anteipsum.org','neccursusaenimSuspendissealiquet','P.O. Box 654, 8869 Velit Av.',16900408827499,'Cambodia','ASDCVB87627865433EFJI9654987654R');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Elizabeth', 'Doyle','felis@dolorelitpellentesque.com','neccursusaenimSuspendissealiquet','Ap #824-1976 Arcu Av.',16011213032299,'Bahamas','XCVBFE2345T5JNGT323456YGF4873RG7YH');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Ingrid', 'Shelton','vulputate.eu.odio@mattisvelitjusto.org','neccursusaenimSuspendissealiquet','738-1932 Tortor Rd.',16463070322799,'Latvia','CDV234560987653CBR7E8INCB74839FYTYRE');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Colleen', 'Hoover','vestibulum.massa@fringilla.edu','neccursusaenimSuspendissealiquet','1135 Metus. St.',16031030131599,'Grenada','BVCVBDS1234567YHJI8765RFVBH567UHBNJHGT');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Amber', 'Alvarado','imperdiet.erat.nonummy@magnaPhasellusdolor.net','neccursusaenimSuspendissealiquet','Ap #357-8402 Faucibus Road',16154123077799,'Mali','CFDSW23R87654EFVGFRTGBNJYTHJYTF');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Remedios', 'Hopper','vestibulum.Mauris.magna@laoreet.co.uk','neccursusaenimSuspendissealiquet','767-1240 Donec Street',16170511950199,'El Salvador','C23456TGDERGHUYT5TGHR45TGYTR5TYTT');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Kitra', 'Jennings','eu@neceuismod.edu','neccursusaenimSuspendissealiquet','Ap #192-5474 Pretium Street',16240531568799,'Georgia','CVFDE23456765GHGFRTGHJUYGFRTGHT');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Julie', 'Ross','tempus@tempor.com','neccursusaenimSuspendissealiquet','Ap #755-9925 Purus Avenue',16490591007299,'Zimbabwe','CVBN35465748BGVCBN84254VCCSFGBR4');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Pedro', 'Miranda','pedro21fcp@gmail.com','neccursusaenimSuspendissealiquet','Rua Nova da Gandra',00351961835740,'Portugal','D658403C209155E3DC13E77D957C9350');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Francisca', 'Cerquinho','up201505791@fe.up.pt','neccursusaenimSuspendissealiquet','Rua da Batalha',00351937563986,'Portugal','D5CEE94F46088F62192C74894B5EE74F');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('Diogo', 'Silva','up201405742@fe.up.pt','neccursusaenimSuspendissealiquet','Rua da Batalha',00351937563986,'Portugal','D5CEE94F46088F62192C74894B5EE74F');
INSERT INTO users (firstName,lastName,email,photo,address,contact,country,password) VALUES ('José', 'Azevedo','up201506448@fe.up.pt','neccursusaenimSuspendissealiquet','Rua da Batalha',00351937563986,'Portugal','D5CEE94F46088F62192C74894B5EE74F');

INSERT INTO admin (id_user) VALUES (31);
INSERT INTO admin (id_user) VALUES (32);
INSERT INTO admin (id_user) VALUES (33);
INSERT INTO admin (id_user) VALUES (34);

INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-13 00:00:00','2018-05-02 00:00:00','PS4 Controllers','Two Sony PS4 controllers that were only used once.',50.99,'play.jpg',70,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-26 00:00:00','2018-05-03 00:00:00','Phone','The new one! Two good to be true! Buy now!',280.00,'phone.jpg',350.50,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-20 00:00:00','2018-05-02 00:00:00','MacbookPro','The new MacbookPro, 13 polg.',1000.99,'macbook.jpg',1500.10,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-14 00:00:00','2018-05-01 00:00:00','Iphone7','The new iphone 7 with 64GB.',700.50,'iphone.jpg',750.60,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-13 00:00:00','2018-05-02 00:00:00','New Album David Bowie','The new album from david bowie. Good conditions',20.90,'music.jpg',25.50,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-05 00:00:00','2018-05-01 00:00:00','Vinyl Mike Evans','The album from Mike Evans.',25.90,'music2.jpg',27.00,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-08 00:00:00','2018-05-03 00:00:00','Vinyl','The new Vynil! Buy now.',30.22,'music3.jpg',36.84,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-20 00:00:00','2018-05-03 00:00:00','Camera Nikon D7500','The new Nikon camera!',468.41,'camera.jpg',500.62,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-04 00:00:00','2018-05-02 00:00:00','New Camera','The new one.Buy now!',26.00,'camera2.jpg',30.66,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-01 00:00:00','2018-05-02 00:00:00','Tennis Nike','The new Tennis from nike!',96.00,'sport.jpg',100.00,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-15 00:00:00','2018-05-01 00:00:00','QUAY AUSTRALIA Sunglasses','The new blue sunglasses!',90.92,'sunglasses.jpg',92.40,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-03 00:00:00','2018-05-02 00:00:00','Prada Cameo Saffiano','The new fashion!',500.49,'prada.jpg',520.05,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-10 00:00:00','2018-05-03 00:00:00','Vases','Very good price',15.51,'garden.jpg',12.50,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-04 00:00:00','2018-05-03 00:00:00','Toy for boys','Very nice',20.59,'toy.jpg',25.13,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-24 00:00:00','2018-05-01 00:00:00','Toy for little boys','Very cool',19.58,'toy2.jpeg',22.81,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-14 00:00:00','2018-05-02 00:00:00','Kitchen design','Very cool',8.31,'garden2.jpeg',10.81,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-01 00:00:00','2018-06-01 00:00:00','Gisela','urna. Vivamus molestie dapibus ligula. Aliquam',17.00,'natoquepenatibusetmagnisdisparturient',23.07,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-07 00:00:00','2018-06-03 00:00:00','Dorian','Proin nisl sem, consequat nec, mollis vitae, posuere at,',11.63,'etlaciniavitaesodalesatvelit',18.53,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-20 00:00:00','2018-06-03 00:00:00','Ivory','nulla magna, malesuada vel, convallis in, cursus et, eros.',10.53,'tiamgravidamolestiearcuedeu',18.86,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-06 00:00:00','2018-06-01 00:00:00','Aline','ligula elit, pretium',2.62,'doloregestasrhoncusroinnislsem,',7.31,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-08 00:00:00','2018-06-03 00:00:00','Mary','venenatis vel, faucibus  libero. Donec consectetuer mauris id sapien.',9.47,'imperdietullamcorperuiatlacusuisque',17.13,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-01 00:00:00','2018-06-01 00:00:00','Maryam','augue id ante dictum cursus. Nunc mauris elit,',13.58,'onecatarcuestibulumanteipsum',18.12,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-06 00:00:00','2018-06-03 00:00:00','Nadine','tempus eu, ligula. Aenean euismod mauris eu',18.57,'eunullaatsemolestiesodales.',24.66,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-14 00:00:00','2018-06-03 00:00:00','Jackson','penatibus',14.65,'sapiengravidanonsollicitudinamalesuada',18.30,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-12 00:00:00','2018-06-02 00:00:00','Ima','Aliquam tincidunt, nunc',16.69,'etlacinia vitaesodalesatvelit',22.06,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-10 00:00:00','2018-06-02 00:00:00','Quin','tellus. Suspendisse sed dolor. Fusce mi lorem,',10.46,'liquamrutrumloremacrisusMorbi',13.53,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-20 00:00:00','2018-06-01 00:00:00','Kane','mi. Duis risus odio, auctor vitae,',4.61,'faucibusorciluctusetultricesposuere',9.23,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-05 00:00:00','2018-06-03 00:00:00','Hope','Proin sed',7.53,'diamroindolorullasempertellus',10.14,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-24 00:00:00','2018-06-01 00:00:00','Abbot','ultricies sem',14.07,'enimmitemporloremegetmollis',17.97,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-03 00:00:00','2018-06-02 00:00:00','McKenzie','ante dictum',9.14,'arcuetpedeuncsedorci',14.42,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-31 00:00:00','2018-06-01 00:00:00','Dolan','dolor. Fusce feugiat. Lorem ipsum dolor',1.10,'augueidantedictumcursusunc',5.67,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-20 00:00:00','2018-06-02 00:00:00','Robert','Etiam vestibulum massa rutrum magna. Cras',18.74,'egetipsumuspendisseagittisllamvitae',23.01,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-31 00:00:00','2018-06-02 00:00:00','Dominic','Donec est mauris, rhoncus  mollis nec, cursus a,',21.16,'augueacipsumhasellusitaemauris',25.91,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-10 00:00:00','2018-06-03 00:00:00','Kendall','elit elit fermentum risus,',14.38,'Suspendisseeddoloruscemiorem,',18.69,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-15 00:00:00','2018-06-01 00:00:00','Travis','Etiam vestibulum',19.50,'necmaurisblanditmattisraseget',24.60,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-09 00:00:00','2018-06-01 00:00:00','Winifred','et',1.79,'adipiscingelittiamlaoreetliberoet',5.75,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-11 00:00:00','2018-06-01 00:00:00','Hammett','arcu. Aliquam ultrices iaculis odio. Nam',19.89,'ligulaonecluctusaliquetodiotiam',27.86,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-05 00:00:00','2018-06-03 00:00:00','Chase','lorem fringilla ornare placerat, orci lacus vestibulum lorem, sit',11.00,'nonlobortisquispedeuspendissedui.',16.36,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-16 00:00:00','2018-06-01 00:00:00','Rudyard','elit elit fermentum risus, at',13.27,'adipiscinglobortisrisusnmipede,',18.50,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-19 00:00:00','2018-06-03 00:00:00','Jacqueline','Phasellus ornare. Fusce mollis. Duis sit amet diam',6.40,'dolorsitametconsectetueradipiscingelit.',10.77,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-12 00:00:00','2018-06-03 00:00:00','Beau','pede et risus. Quisque libero lacus, varius et,',17.18,'urnattinciduntvehicularisusulla',19.85,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-19 00:00:00','2018-06-03 00:00:00','Myles','vel sapien imperdiet ornare. In faucibus.',22.12,'aultriciesadipiscingenimmitempor',25.24,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-18 00:00:00','2018-06-03 00:00:00','Gwendolyn','sed dictum eleifend, nunc',7.23,'onecelementumloremutaliquamiaculis,',12.57,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-01 00:00:00','2018-06-02 00:00:00','Kiara','Nullam enim. Sed nulla ante, iaculis nec, eleifend',8.51,'blanditconguencelerisquescelerisquedui.',13.10,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-23 00:00:00','2018-06-03 00:00:00','Zeus','Duis volutpat nunc sit amet metus. Aliquam erat',15.87,'volutpatNulladignissimMaecenasornareegestas',25.65,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-11 00:00:00','2018-06-02 00:00:00','Kevyn','lobortis risus. In mi pede, nonummy ut,',19.01,'justoraesentluctusurabituregestasnunc',22.80,'0');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-29 00:00:00','2018-06-01 00:00:00','Brody','Proin. In mi pede,',15.61,'variuseteuismodetcommodoat',18.62,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-13 00:00:00','2018-06-03 00:00:00','Shellie','Donec egestas. Duis ac arcu. Nunc mauris. Morbi non',1.45,'onecluctusaliquetodiotiamligula',7.84,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-29 00:00:00','2018-06-02 00:00:00','Yuri','Nam ac nulla. In tincidunt congue turpis.',3.65,'velitegetlaoreetposuereenimnisl',9.42,'1');
INSERT INTO auction (dateBegin,dateEnd,name,description,actualPrice,photo,buyNow,active) VALUES ('2018-03-02 00:00:00','2018-06-01 00:00:00','Keaton','magnis',1.78,'gravidanuncsedpedeumsociis',6.61,'0');


INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',0.80,DEFAULT,7,12);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',3.85,DEFAULT,16,26);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',1.59,DEFAULT,13,21);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',14.06,DEFAULT,32,24);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',5.86,DEFAULT,14,1);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',18.51,DEFAULT,8,17);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',6.27,DEFAULT,38,29);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',8.26,DEFAULT,23,24);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',8.46,DEFAULT,29,18);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',1.17,DEFAULT,48,12);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',3.22,DEFAULT,7,16);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',17.36,DEFAULT,35,24);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',14.38,DEFAULT,34,5);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',5.45,DEFAULT,21,29);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',12.86,DEFAULT,25,24);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',11.43,DEFAULT,2,15);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',14.65,DEFAULT,24,7);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',6.86,DEFAULT,32,26);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',16.48,DEFAULT,42,19);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',17.18,DEFAULT,41,4);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',1.79,DEFAULT,36,20);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',8.23,DEFAULT,1,29);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',12.29,DEFAULT,4,8);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',19.49,DEFAULT,12,19);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',18.43,DEFAULT,15,14);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',16.96,DEFAULT,2,30);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',6.40,DEFAULT,40,15);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',0.65,DEFAULT,36,19);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',13.58,DEFAULT,22,3);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',2.10,DEFAULT,40,9);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',8.51,DEFAULT,44,5);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',0.88,DEFAULT,6,9);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',11.01,DEFAULT,18,12);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',1.23,DEFAULT,13,14);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',2.67,DEFAULT,11,8);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',18.74,DEFAULT,32,3);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('0',2.30,DEFAULT,7,2);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',11.00,DEFAULT,38,9);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',16.69,DEFAULT,25,11);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',9.47,DEFAULT,21,3);
INSERT INTO bid (status,price,date,id_auction,id_user) VALUES ('1',8.31,DEFAULT,16,15);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',13.27,DEFAULT,39,20);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',12.81,DEFAULT,1,14);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',10.52,DEFAULT,29,11);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',2.44,DEFAULT,7,4);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',19.50,DEFAULT,35,21);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',25.41,DEFAULT,8,18);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',22.12,DEFAULT,42,13);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',4.51,DEFAULT,13,11);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',8.75,DEFAULT,10,29);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',10.87,DEFAULT,33,26);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',21.16,DEFAULT,33,27);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',12.44,DEFAULT,3,11);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',15.62,DEFAULT,23,4);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',11.63,DEFAULT,18,5);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',1.78,DEFAULT,13,13);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',7.53,DEFAULT,28,29);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',8.30,DEFAULT,32,21);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',10.57,DEFAULT,25,7);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',19.52,DEFAULT,4,8);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',18.25,DEFAULT,37,19);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',10.31,DEFAULT,24,6);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',1.56,DEFAULT,7,17);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',19.04,DEFAULT,42,16);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',11.59,DEFAULT,14,30);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',1.34,DEFAULT,9,28);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',18.57,DEFAULT,23,24);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',0.80,DEFAULT,20,17);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',1.69,DEFAULT,20,10);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',15.87,DEFAULT,45,22);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',9.69,DEFAULT,24,2);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',3.08,DEFAULT,49,30);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',1.78,DEFAULT,50,2);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',5.80,DEFAULT,5,7);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',14.07,DEFAULT,29,6);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',10.53,DEFAULT,19,19);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',16.92,DEFAULT,11,30);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',14.34,DEFAULT,10,23);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',19.89,DEFAULT,37,29);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',6.17,DEFAULT,5,5);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',19.58,DEFAULT,15,23);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',3.34,DEFAULT,32,26);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',4.61,DEFAULT,27,12);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',1.45,DEFAULT,48,23);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',9.02,DEFAULT,45,13);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',9.39,DEFAULT,18,20);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',1.56,DEFAULT,50,7);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',1.94,DEFAULT,49,21);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',16.29,DEFAULT,17,30);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',7.95,DEFAULT,45,9);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',17.00,DEFAULT,17,1);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',10.81,DEFAULT,41,22);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',15.61,DEFAULT,47,16);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',18.31,DEFAULT,33,24);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',3.65,DEFAULT,49,28);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',1.22,DEFAULT,6,21);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',2.62,DEFAULT,20,22);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',0.52,DEFAULT,36,4);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('0',1.19,DEFAULT,20,13);
INSERT INTO bid (status,price,date,id_auction,id_user)  VALUES ('1',17.85,DEFAULT,1,19);

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

INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('mattis. Integer eu lacus. Quisque',11,12);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('turpis vitae purus gravida sagittis.',9,24);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('pede. Cras vulputate velit eu',7,9);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('auctor velit. Aliquam nisl. Nulla',30,29);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('Nunc lectus pede, ultrices a,',5,16);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('mollis nec, cursus a, enim.',4,10);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('Etiam imperdiet dictum magna. Ut',20,26);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('vitae nibh. Donec est mauris,',24,17);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('convallis erat, eget tincidunt dui',8,6);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('fermentum vel, mauris. Integer sem',22,15);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('Quisque porttitor eros nec tellus.',5,21);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('consequat dolor vitae dolor. Donec',13,23);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('dictum augue malesuada malesuada. Integer',19,3);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('nibh. Aliquam ornare, libero at',14,5);
INSERT INTO reportUser (reason,id_userReporting,id_userReported) VALUES ('feugiat non, lobortis quis, pede.',21,24);

INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (2,26,'ornare. Fusce mollis. Duis sit');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (12,24,'leo, in lobortis tellus justo');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (13,37,'ac mi eleifend egestas. Sed');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (26,29,'accumsan neque et nunc. Quisque');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (5,43,'Integer in magna. Phasellus dolor');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (30,27,'lacinia. Sed congue, elit sed');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (11,2,'tellus eu augue porttitor interdum.');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (5,35,'tincidunt, nunc ac mattis ornare,');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (7,29,'lectus. Nullam suscipit, est ac');
INSERT INTO reportAuction (id_user,id_auction,reason) VALUES (7,36,'mi eleifend egestas. Sed pharetra,');

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

INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (12,2,'0','2018-04-08 15:57:21','2018-04-19 01:43:11');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (24,1,'1','2018-04-05 22:52:02','2018-04-13 11:43:42');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (9,1,'1','2018-04-08 03:06:47','2018-04-14 07:45:18');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (29,2,'1','2018-04-05 12:55:51','2018-04-13 14:19:08');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (16,4,'0','2018-04-06 20:56:35','2018-04-20 09:14:28');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (6,2,'1','2018-04-06 15:32:07','2018-04-15 13:05:22');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (26,2,'1','2018-04-07 14:54:50','2018-04-14 20:00:00');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (15,1,'1','2018-04-08 00:27:59','2018-04-14 21:24:49');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (21,2,'0','2018-04-08 20:40:54','2018-04-12 17:53:11');
INSERT INTO banUser (id_user,id_admin,isBanned,dateBegin,dateEnd) VALUES (5,3,'1','2018-04-10 12:25:58','2018-04-12 07:38:01');

INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (2,26,'0','2018-04-07 12:30:37');
INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (12,24,'1','2018-04-07 23:54:50');
INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (13,37,'0','2018-04-08 17:25:38');
INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (26,29,'1','2018-04-08 06:36:13');
INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (5,43,'1','2018-04-05 11:43:16');
INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (30,27,'1','2018-04-09 10:33:17');
INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (11,2,'0','2018-04-05 22:49:11');
INSERT INTO banAuction (id_user,id_auction,isBanned,dateBegin) VALUES (5,35,'0','2018-04-07 02:59:54');

INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (29,1,'2018-04-03 23:43:54','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (12,48,'2018-04-02 16:41:23','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (22,20,'2018-04-02 11:22:29','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (29,15,'2018-04-02 14:29:08','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (17,35,'2018-04-02 17:35:58','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (13,19,'2018-04-01 10:49:53','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (8,9,'2018-04-01 11:17:49','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (20,19,'2018-04-05 15:46:02','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (26,3,'2018-04-05 07:26:10','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (15,29,'2018-04-02 12:40:30','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (8,37,'2018-04-05 10:17:28','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (10,40,'2018-04-03 21:50:36','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (26,23,'2018-04-04 02:18:45','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (14,40,'2018-04-05 10:14:02','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (25,35,'2018-04-01 22:04:56','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (19,50,'2018-04-03 17:26:02','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (2,13,'2018-04-03 20:09:09','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (26,50,'2018-04-01 06:12:26','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (6,13,'2018-04-03 14:07:56','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (5,21,'2018-04-03 06:40:31','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (9,43,'2018-04-04 18:16:36','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (8,6,'2018-04-01 01:05:29','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (4,5,'2018-04-03 19:14:45','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (16,19,'2018-04-01 05:49:35','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (30,29,'2018-04-05 09:54:17','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (11,23,'2018-04-04 20:09:04','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (17,29,'2018-04-04 17:30:05','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (30,8,'2018-04-02 04:18:23','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (4,12,'2018-04-04 11:05:49','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (26,46,'2018-04-05 15:14:34','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (13,26,'2018-04-01 14:46:19','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (9,21,'2018-04-04 08:30:03','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (7,31,'2018-04-04 05:26:27','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (2,29,'2018-04-01 18:38:10','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (27,44,'2018-04-03 14:30:58','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (17,49,'2018-04-02 15:41:37','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (4,26,'2018-04-01 18:22:40','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (7,19,'2018-04-02 05:43:08','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (5,7,'2018-04-04 04:54:59','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (20,33,'2018-04-02 16:53:54','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (17,37,'2018-04-03 15:54:49','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (8,14,'2018-04-05 09:55:52','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (13,11,'2018-04-03 09:49:36','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (11,44,'2018-04-04 05:28:51','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (11,30,'2018-04-01 10:13:33','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (25,17,'2018-04-03 17:00:54','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (19,16,'2018-04-02 20:19:14','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (20,18,'2018-04-01 14:15:51','1');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (14,36,'2018-04-03 07:43:27','0');
INSERT INTO wishList (id_user,id_auction,date,follow) VALUES (13,2,'2018-04-04 10:06:58','0');


INSERT INTO category (id_auction,Category) VALUES (1,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (2,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (3,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (4,'Motors');
INSERT INTO category (id_auction,Category) VALUES (5,'Music');
INSERT INTO category (id_auction,Category) VALUES (6,'Toys');
INSERT INTO category (id_auction,Category) VALUES (7,'Daily Deals');
INSERT INTO category (id_auction,Category) VALUES (8,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (9,'Others');
INSERT INTO category (id_auction,Category) VALUES (10,'Motors');
INSERT INTO category (id_auction,Category) VALUES (11,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (12,'Others');
INSERT INTO category (id_auction,Category) VALUES (13,'Daily Deals');
INSERT INTO category (id_auction,Category) VALUES (14,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (15,'Toys');
INSERT INTO category (id_auction,Category) VALUES (16,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (17,'Music');
INSERT INTO category (id_auction,Category) VALUES (18,'Others');
INSERT INTO category (id_auction,Category) VALUES (19,'Motors');
INSERT INTO category (id_auction,Category) VALUES (20,'Toys');
INSERT INTO category (id_auction,Category) VALUES (21,'Music');
INSERT INTO category (id_auction,Category) VALUES (22,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (23,'Daily Deals');
INSERT INTO category (id_auction,Category) VALUES (24,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (25,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (26,'Music');
INSERT INTO category (id_auction,Category) VALUES (27,'Motors');
INSERT INTO category (id_auction,Category) VALUES (28,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (29,'Toys');
INSERT INTO category (id_auction,Category) VALUES (30,'Motors');
INSERT INTO category (id_auction,Category) VALUES (31,'Daily Deals');
INSERT INTO category (id_auction,Category) VALUES (32,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (33,'Home & Garden');
INSERT INTO category (id_auction,Category) VALUES (34,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (35,'Others');
INSERT INTO category (id_auction,Category) VALUES (36,'Music');
INSERT INTO category (id_auction,Category) VALUES (37,'Sporting');
INSERT INTO category (id_auction,Category) VALUES (38,'Motors');
INSERT INTO category (id_auction,Category) VALUES (39,'Electronics');
INSERT INTO category (id_auction,Category) VALUES (40,'Toys');
INSERT INTO category (id_auction,Category) VALUES (41,'Toys');
INSERT INTO category (id_auction,Category) VALUES (42,'Fashion');
INSERT INTO category (id_auction,Category) VALUES (43,'Daily Deals');
INSERT INTO category (id_auction,Category) VALUES (44,'Home & Garden');
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
