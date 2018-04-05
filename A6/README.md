### A6: Integrity constraints. Indexes, triggers, user functions and database populated with data

## 1. Database workload
   ## 1.1 Estimate of tuples

Identifier    | Relational Schema | Order of magnitude  |  Estimated growth
--------------|-------------------|---------------------|---------------------
R01           | users             | hundreds            |  units per day
R02           | admin             | tens                |  units per day
R03           | auction           | thousands           |  dozens per day
R04           | reportUser        | tens                |  units per day
R05           | comment           | hundreds            |  units per day
R06           | bid               | thousands           |  units per day
R07           | wishList          | hundreds            |  dozens per day
R08           | reportAuction     | hundreds            |  units per day
R09           | banAuction        | tens                |  units per day
R10           | banUser           | tens                |  units per day
R11           | owner             | thousands           |  dozens per day
R12           | buyNow            | hundreds            |  units per day

   ## 1.2 Most frequent queries

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT01</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>User’s profile</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
      SELECT name,email,photo,address,contact,country,password
        FROM users
        WHERE users.id= $userID;
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT02</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Item</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
      SELECT auction."dateBegin", auction."dateEnd", auction.name, auction.description, auction."buyNow", auction.active, auction."actualPrice", auction.photo, users.name,users.id,
owner.id_auction,owner.id_user
     FROM auction, users, owner
     WHERE auction.id= $auctionID AND auction.id=owner.id_auction AND users.id=owner.id_user;
        </pre>
    </td>
  </tr>
</table>


<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT03</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>User wishList</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
      SELECT wishList.follow, auction.name, auction."dateBegin", auction."dateEnd", auction.name, auction.description, auction."actualPrice", auction.photo, auction."buyNow", auction.active, auction.id, wishList.id_user
     FROM auction,wishList
     WHERE wishList.id_user=$userID AND wishList.id_auction=auction.id ORDER BY auction."dateEnd";
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT04</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> Auction comments </td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
     SELECT comment.like, comment.dislike, comment.date, comment.comment, comment.id_auction, auction.id, users.id, users.name, comment.id_user
     FROM auction,comment,users
     WHERE auction.id=comment.id_auction AND comment.id_user = users.id;
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT05</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Login user</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
     SELECT id,name
     FROM users
     WHERE users.email=$email AND users.password=hash($password);
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT06</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Auction by category</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
    SELECT auction.name, auction."dateBegin", auction."dateEnd", auction.name, auction."actualPrice", auction.photo, auction.active, auction.id, category.id_auction, category.category, owner.id_user, users.name, owner.id_auction,users.id
  FROM auction,category,owner,users
  WHERE  owner.id_auction=auction.id  AND users.id=owner.id_user AND category.id_auction=auction.id AND category.category= $category;
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT07</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Search</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   SELECT auction.name, auction."dateBegin", auction."dateEnd", auction.name, auction.active, auction.description, auction.id, auction.photo, auction."actualPrice", owner.id_user, users.name, owner.id_auction,users.id,auction.description
  FROM auction,owner,users
  WHERE owner.id_auction=auction.id  AND users.id=owner.id_user AND (auction.name LIKE %$search% OR auction.description LIKE %$search%);
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT08</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>HomePage Auctions</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   SELECT auction.name, auction.id, users.id, auction."dateBegin",auction."dateEnd", auction."actualPrice", auction.photo,owner.id_user, owner.id_auction, users.name
     FROM auction,owner,users
     WHERE owner.id_user != $userID AND auction.id = owner.id_auction AND users.id=owner.id_user ORDER BY auction."dateEnd";
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT08</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>HomePage Auctions</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   SELECT auction.name, auction.id, users.id, auction."dateBegin",auction."dateEnd", auction."actualPrice", auction.photo,owner.id_user, owner.id_auction, users.name
     FROM auction,owner,users
     WHERE owner.id_user != $userID AND auction.id = owner.id_auction AND users.id=owner.id_user ORDER BY auction."dateEnd";
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT09</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Ban users</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>tens per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   SELECT *
     FROM banuser
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT11</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Ban auctions</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>tens per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   SELECT *
     FROM banAuction
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT12</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>User’s reports</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   SELECT *
     FROM reportUser
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>SELECT13</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Auctions reports</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   SELECT *
     FROM reportAuctions
        </pre>
    </td>
  </tr>
</table>

   ## 1.3 Most frequent modifications

<table>
    <tr>
    <th>Query reference</th>
    <td>UPDATE01</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> Update Users Information</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>tens per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   UPDATE users 
     SET email = $email, name = $name, photo = $photo, address = $address, contact = $contact, country = $country, password =hash($password)
     WHERE id=$id
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>UPDATE02</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Update auction price</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   UPDATE auction 
     SET "actualPrice" =$actualPrice
     WHERE id=$id
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>UPDATE03</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Update auction status</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
 UPDATE auction 
     SET active = FALSE
     WHERE auction.id = $id;
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>UPDATE04</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Update ban users</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
 UPDATE banUser
     SET "isBanned" = $isBanned
     WHERE id = $id
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>UPDATE05</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Update ban auction</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
 UPDATE banAuction
     SET "isBanned" = $isBanned
     WHERE id_user = $user_id AND id_auction = $id_auction
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>DELETE01</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td>Delete item from WishList</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
 DELETE FROM WishList
     WHERE id_auction = $id_auction AND id_user = $id_user
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>INSERT01</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> New user register</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
  INSERT INTO users(name,email,address,contact,country,photo,password)
       VALUES ($name,$email,$address, $contact, $country, $photo, $password)
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>INSERT02</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> New Auction</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>thousands per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
 INSERT INTO auction ("dateBegin", "dateEnd", name, description, "buyNow", "actualPrice", photo, active)
         VALUES ($dateBegin, $dateEnd, $name, $description, $buynow, $actualPrice, $photo, TRUE);
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>INSERT03</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> New Wish list</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
  INSERT INTO wishList(date,follow,id_user,id_auction)
       VALUES ($date,$follow, $id_user, $id_auction);
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>INSERT04</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> New Report User</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   INSERT INTO reportUser(reason,"id_userReporting","id_userReported")
       VALUES ($reason,$userReporting,$userReported);
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>INSERT05</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> New Report Auction</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>hundreds per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
   INSERT INTO reportAuction(reason, id_user, id_auction)
       VALUES ($reason, $id_user, $id_auction);
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>INSERT06</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> New Ban User</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>tens per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
    INSERT INTO banUser("isBanned", id_user, "dateBegin", dateEnd)
       VALUES ($isBanned, $id_user, $dateBegin, $dateEnd);
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Query reference</th>
    <td>INSERT07</td>
  </tr>
  <tr>
    <th>Query description</th>
    <td> New Ban Auction</td>
  </tr>
  <tr>
    <th> Query frequency</th>
    <td>tens per day</td>
  </tr>
    <tr>
    <td colspan="2">
       <pre>
 INSERT INTO banAuction("isBanned", id_user, "dateBegin", id_auction)
       VALUES ($isBanned, $id_user, $dateBegin, $id_auction);
        </pre>
    </td>
  </tr>
</table>

## 2. Proposed Indexes
   ## 2.1  Performance indexes

<table>
  <tr>
    <th> Index reference</th>
    <td>IDX01</td>
  </tr>
    <tr>
    <th>Related queries</th>
    <td>SELECT01</td>
  </tr>
    <tr>
    <th>Index relation</th>
    <td>users</td>
  </tr>
    <tr>
    <th>Index attribute</th>
    <td>email</td>
  </tr>
    <tr>
    <th>Index type</th>
    <td>Hash</td>
  </tr>
    <tr>
    <th>Cardinality</th>
    <td>High</td>
  </tr>
    <tr>
    <th>Clustering</th>
    <td>No</td>
  </tr>
    <tr>
    <th>Justification</th>
    <td>Query SELECT01 has to be fast as it is executed many times; doesn't need range query support; cardinality is high because email is an unique key; it's not a good candidate for clustering.</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>
    CREATE INDEX email_user ON "users" USING hash (email);
        </pre>
    </td>
  </tr>
</table>

<table>
  <tr>
    <th> Index reference</th>
    <td>IDX02</td>
  </tr>
    <tr>
    <th>Related queries</th>
    <td>SELECT02</td>
  </tr>
    <tr>
    <th>Index relation</th>
    <td>auction</td>
  </tr>
    <tr>
    <th>Index attribute</th>
    <td>id</td>
  </tr>
    <tr>
    <th>Index type</th>
    <td>Hash</td>
  </tr>
    <tr>
    <th>Cardinality</th>
    <td>Medium</td>
  </tr>
    <tr>
    <th>Clustering</th>
    <td>Yes</td>
  </tr>
    <tr>
    <th>Justification</th>
    <td>Query SELECT02 used to search the id auctions, has to be fast because it's executed many times; doesn't need range query support; cardinality is medium so it's a good candidate for clustering.</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>
    CREATE INDEX auctions ON auction USING hash (id);
        </pre>
    </td>
  </tr>
</table>

<table>
  <tr>
    <th> Index reference</th>
    <td>IDX03</td>
  </tr>
    <tr>
    <th>Related queries</th>
    <td>SELECT03</td>
  </tr>
    <tr>
    <th>Index relation</th>
    <td>wishList</td>
  </tr>
    <tr>
    <th>Index attribute</th>
    <td>id_user</td>
  </tr>
    <tr>
    <th>Index type</th>
    <td>Hash</td>
  </tr>
    <tr>
    <th>Cardinality</th>
    <td>Medium</td>
  </tr>
    <tr>
    <th>Clustering</th>
    <td>Yes</td>
  </tr>
    <tr>
    <th>Justification</th>
    <td>Query SELECT03 used to search the wish list of an user, has to be fast because it's executed many times; doesn't need range query support; cardinality is medium so it's a good candidate for clustering.</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>
    CREATE INDEX wishList_auction ON wishList USING hash (id_auction);
        </pre>
    </td>
  </tr>
</table>

<table>
  <tr>
    <th> Index reference</th>
    <td>IDX04</td>
  </tr>
    <tr>
    <th>Related queries</th>
    <td>SELECT04</td>
  </tr>
    <tr>
    <th>Index relation</th>
    <td>comment</td>
  </tr>
    <tr>
    <th>Index attribute</th>
    <td>id_auction</td>
  </tr>
    <tr>
    <th>Index type</th>
    <td>Hash</td>
  </tr>
    <tr>
    <th>Cardinality</th>
    <td>Medium</td>
  </tr>
    <tr>
    <th>Clustering</th>
    <td>Yes</td>
  </tr>
    <tr>
    <th>Justification</th>
    <td>Query SELECT04 used to search the comments of an auction, has to be fast because it's executed many times; doesn't need range query support; cardinality is medium so it's a good candidate for clustering.</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>
    CREATE INDEX auction_comments ON comment USING hash (id_auction);
        </pre>
    </td>
  </tr>
</table>

   ## 2.2  Full-text search indexes

<table>
  <tr>
    <th> Index reference</th>
    <td>IDX05</td>
  </tr>
    <tr>
    <th>Related queries</th>
    <td>SELECT07</td>
  </tr>
    <tr>
    <th>Index relation</th>
    <td>auction</td>
  </tr>
    <tr>
    <th>Index attribute</th>
    <td>name</td>
  </tr>
    <tr>
    <th>Index type</th>
    <td>GiST</td>
    </tr>
    <tr>
    <th>Clustering</th>
    <td>No</td>
  </tr>
    <tr>
    <th>Justification</th>
    <td>To improve the performance of full name searches while searching for auctions and their names; GiST because it's better for dynamic data.</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>CREATE INDEX search_auctions ON auction USING to_tsvector(‘pg_catalog.portuguese’, GiST(id_auction));
        </pre>
    </td>
  </tr>
</table>

<table>
  <tr>
    <th> Index reference</th>
    <td>IDX06</td>
  </tr>
    <tr>
    <th>Related queries</th>
    <td>SELECT06</td>
  </tr>
    <tr>
    <th>Index relation</th>
    <td>auction</td>
  </tr>
    <tr>
    <th>Index attribute</th>
    <td>category</td>
  </tr>
    <tr>
    <th>Index type</th>
    <td>GiST</td>
    </tr>
    <tr>
    <th>Clustering</th>
    <td>No</td>
  </tr>
    <tr>
    <th>Justification</th>
    <td>To improve the performance of full name searches while searching for auctions and their names; GiST because it's better for dynamic data.</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>CREATE INDEX auction_category ON auction USING to_tsvector(‘pg_catalog.portuguese’, GiST(category));
        </pre>
    </td>
  </tr>
</table>

### 3. Triggers

<table>
    <tr>
    <th>Trigger reference</th>
    <td>TRIGGER01</td>
  </tr>
    <tr>
    <th>Trigger description</th>
    <td>A bid can only be made on an auction that has already started and has not finished yet</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>CREATE FUNCTION "CheckAuctionDate"() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    auctionDateEnd date;
BEGIN
    SELECT auction."dateEnd" INTO auctionDateEnd FROM auction WHERE auction.id = NEW.id_auction;
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
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Trigger reference</th>
    <td>TRIGGER02</td>
  </tr>
    <tr>
    <th>Trigger description</th>
    <td>A user can’t bid on an item of its own</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>CREATE FUNCTION "CheckUser"() RETURNS trigger
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

CREATE TRIGGER "CheckUser"
    BEFORE INSERT ON bid
    FOR EACH ROW
        EXECUTE PROCEDURE "CheckUser"();
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Trigger reference</th>
    <td>TRIGGER03</td>
  </tr>
    <tr>
    <th>Trigger description</th>
    <td>A user can’t buy an item of its own</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>CREATE FUNCTION "CheckUser"() RETURNS trigger
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

CREATE TRIGGER "CheckUser" 
    BEFORE INSERT ON buynow
    FOR EACH ROW 
        EXECUTE PROCEDURE "CheckUser"();
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Trigger reference</th>
    <td>TRIGGER04</td>
  </tr>
    <tr>
    <th>Trigger description</th>
    <td>A user can’t report an admin</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>CREATE FUNCTION "CheckReportedUserNotAdmin"() RETURNS trigger
    LANGUAGE plpgsql
    AS $$
DECLARE
    adminCount integer;
BEGIN
    SELECT count(*) INTO adminCount FROM admin WHERE admin.id_user = NEW.id_user_reported;
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
        </pre>
    </td>
  </tr>
</table>

<table>
    <tr>
    <th>Trigger reference</th>
    <td>TRIGGER05</td>
  </tr>
    <tr>
    <th>Trigger description</th>
    <td>A user can’t report an auction of its own</td>
  </tr>
      <tr>
    <td colspan="2">
       <pre>CREATE FUNCTION "CheckReportingNotAuctionOwner"() RETURNS trigger
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
BEFORE INSERT ON reportauction 
FOR EACH ROW
EXECUTE PROCEDURE "CheckReportingNotAuctionOwner"();
        </pre>
    </td>
  </tr>
</table>