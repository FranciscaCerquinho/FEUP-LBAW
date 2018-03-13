---Tables
CREATE TABLE user(
  id SERIAL NOT NULL,
  email text NOT NULL UNIQUE,
  password text NOT NULL,
  name text,
  photo text,
  adress text,
  country text,
  contact NUMERIC(14,17),
  type text NOT NULL
);

CREATE TABLE bid(
  id SERIAL NOT NULL,
  status BOOLEAN,
  price FLOAT
);

CREATE TABLE auction(
  id SERIAL NOT NULL,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  name text NOT NULL,
  description text,
  buyNow FLOAT NOT NULL,
  active NOT NULL
);

CREATE TABLE comment(
  id SERIAL NOT NULL,
  "like" INTEGER,
  dislike INTEGER,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  comment text NOT NULL
);

CREATE TABLE reportUser(
  id SERIAL NOT NULL,
  reason text NOT NULL
);

CREATE TABLE reportAuction(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);

CREATE TABLE banUser(
  id_admin INTEGER NOT NULL,
  id_user INTEGER NOT NULL
);

CREATE TABLE banAuction(
  id_admin INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);

CREATE TABLE owner(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL
);

CREATE TABLE wishList(
  id_user INTEGER NOT NULL,
  id_auction INTEGER NOT NULL,
  "date" TIMESTAMP WITH TIME zone DEFAULT now() NOT NULL,
  follow BOOLEAN
);

CREATE TABLE category (
    id_auction INTEGER NOT NULL,
    CATEGORY text NOT NULL,
    CONSTRAINT TYPE CHECK ((CATEGORY = ANY (ARRAY['Electronics'::text, 'Fashion'::text, 'Home & Garden'::text, 'Motors'::text, 'Music'::text, 'Toys'::text,
      'Toys'::text, 'Daily Deals'::text, 'Sporting'::text, 'Others'::text])))
);
