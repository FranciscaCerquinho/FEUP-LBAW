## A6: Integrity constraints. Indexes, triggers, user functions and database populated with data

### 1. Database workload
   ### 1.1 Estimate of tuples

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

   ### 1.2 Most frequent queries

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
      <b>SELECT</b> name,email,photo,address,contact,country,password
        <b>FROM</b> users
        <b>WHERE</b> users.id= $userID;
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
      <b>SELECT</></b> auction."dateBegin", auction."dateEnd", auction.name, auction.description, auction."buyNow", 
      auction.active, auction."actualPrice", auction.photo, users.name,users.id,
    owner.id_auction,owner.id_user
     <b>FROM</b> auction, users, owner
     <b>WHERE</b> auction.id= $auctionID <b>AND</b> auction.id=owner.id_auction <b>AND</b> users.id=owner.id_user;
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
       <b>SELECT</b> wishList.follow, auction.name, auction."dateBegin", auction."dateEnd", auction.name, 
       auction.description, auction."actualPrice", auction.photo, auction."buyNow", auction.active, 
       auction.id, wishList.id_user
     <b>FROM</b> auction,wishList
     <b>WHERE</b> wishList.id_user=$userID AND wishList.id_auction=auction.id <b>ORDER BY</b> auction."dateEnd";
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
     <b>SELECT</b> comment.like, comment.dislike, comment.date, comment.comment, comment.id_auction, 
     auction.id, users.id, users.name, comment.id_user
     <b>FROM</b> auction,comment,users
     <b>WHERE</b> auction.id=comment.id_auction <b>AND</b> comment.id_user = users.id;
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
     <b>SELECT</b> id,name
     <b>FROM</b> users
     <b>WHERE</b> users.email=$email <b>AND</b> users.password=hash($password);
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
    <b>SELECT</b> auction.name, auction."dateBegin", auction."dateEnd", auction.name, auction."actualPrice", 
    auction.photo, auction.active, auction.id, category.id_auction, category.category, 
    owner.id_user, users.name, owner.id_auction,users.id
  <b>FROM</b> auction,category,owner,users
  <b>WHERE</b>  owner.id_auction=auction.id  <b>AND</b> users.id=owner.id_user <b>AND</b> category.id_auction=auction.id 
  <b>AND</b> category.category= $category <b>AND</b> auction.active=TRUE
  <b>LIMIT</b> 60;
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
   <b>SELECT</b> auction.name, auction."dateBegin", auction."dateEnd", auction.name, auction.active, 
   auction.description, auction.id, auction.photo, auction."actualPrice", owner.id_user, users.name, 
   owner.id_auction,users.id,auction.description
  <b>FROM</b> auction,owner,users
  <b>WHERE</b> owner.id_auction=auction.id  <b>AND</b> users.id=owner.id_user <b>AND</b> 
  (auction.name <b>LIKE</b> %$search% <b>OR</b> auction.description <b>LIKE</b> %$search%) <b>AND</b> auction.active=TRUE
  <b>LIMIT</b> 60;
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
   <b>SELECT</b> auction.name, auction.id, auction.active,users.id, auction."dateBegin",auction."dateEnd", 
   auction."actualPrice", auction.photo,owner.id_user, owner.id_auction, users.name
     <b>FROM</b> auction,owner,users
     <b>WHERE</b> owner.id_user != $userID <b>AND</b> auction.id = owner.id_auction <b>AND</b> users.id=owner.id_user 
     <b>AND</b> auction.active=TRUE
     <b>ORDER BY</b> auction."dateEnd"
     <b>LIMIT</b> 60;
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
   <b>SELECT</b> *
     <b>FROM</b> banuser
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
   <b>SELECT</b> *
     <b>FROM</b> banAuction
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
   <b>SELECT</b> *
     <b>FROM</b> reportUser
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
   <b>SELECT</b> *
     <b>FROM</b> reportAuctions
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
   <b>UPDATE</b> users 
     <b>SET</b> email = $email, name = $name, photo = $photo, address = $address, contact = $contact, country = $country, 
     password =hash($password)
     <b>WHERE</b> id=$id
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
   <b>UPDATE</b> auction 
     <b>SET</b> "actualPrice" =$actualPrice
     <b>WHERE</b> id=$id
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
    <b>UPDATE</b> auction 
    <b>SET</b> active = FALSE
    <b>WHERE</b> auction.id = $id;
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
 <b>UPDATE</b> banUser
     <b>SET</b> "isBanned" = $isBanned
     <b>WHERE</b> id = $id
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
 <b>UPDATE</b> banAuction
     <b>SET</b> "isBanned" = $isBanned
     <b>WHERE</b> id_user = $user_id <b>AND</b> id_auction = $id_auction
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
 <b>DELETE FROM</b> WishList
     <b>WHERE</b> id_auction = $id_auction <b>AND</b> id_user = $id_user
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
  <b>INSERT INTO</b> users(name,email,address,contact,country,photo,password)
       <b>VALUES</b> ($name,$email,$address, $contact, $country, $photo, $password)
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
 <b>INSERT INTO</b> auction ("dateBegin", "dateEnd", name, description, "buyNow", "actualPrice", photo, active)
         <b>VALUES</b> ($dateBegin, $dateEnd, $name, $description, $buynow, $actualPrice, $photo, TRUE);
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
  <b>INSERT INTO</b> wishList(date,follow,id_user,id_auction)
       <b>VALUES</b> ($date,$follow, $id_user, $id_auction);
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
   <b>INSERT INTO</b> reportUser(reason,"id_userReporting","id_userReported")
       <b>VALUES</b> ($reason,$userReporting,$userReported);
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
   <b>INSERT INTO</b> reportAuction(reason, id_user, id_auction)
       <b>VALUES</b> ($reason, $id_user, $id_auction);
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
    <b>INSERT INTO</b> banUser("isBanned", id_user, "dateBegin", dateEnd)
       <b>VALUES</b> ($isBanned, $id_user, $dateBegin, $dateEnd);
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
 <b>INSERT INTO</> banAuction("isBanned", id_user, "dateBegin", id_auction)
       <b>VALUES</b> ($isBanned, $id_user, $dateBegin, $id_auction);
        </pre>
    </td>
  </tr>
</table>

### 2. Proposed Indexes
   ### 2.1  Performance indexes

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
    <b>CREATE INDEX</b>email_user <b>ON</b> "users" <b>USING</b> hash (email);
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
    <b>CREATE INDEX</b> auctions <b>ON</b> auction <b>USING</b> hash (id);
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
    <b>CREATE INDEX</b> wishList_auction <b>ON</b> wishList <b>USING</b> hash (id_auction);
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
    <b>CREATE INDEX</b> auction_comments <b>ON</b> comment <b>USING</b> hash (id_auction);
        </pre>
    </td>
  </tr>
</table>

   ### 2.2  Full-text search indexes

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
       <pre><b>CREATE INDEX</b> search_auctions <b>ON</b> auction <b>USING</b> to_tsvector(‘pg_catalog.portuguese’, GiST(id_auction));
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
       <pre><b>CREATE INDEX</b> auction_category <b>ON</b> auction <b>USING</b> to_tsvector(‘pg_catalog.portuguese’, GiST(category));
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
       <pre><b>CREATE FUNCTION</b> "CheckAuctionDate"() <b>RETURNS</b> trigger
    <b>LANGUAGE</b> plpgsql
    <b>AS</b> $$
<b>DECLARE</b>
    auctionDateEnd date;
<b>BEGIN</b>
    <b>SELECT</b> auction."dateEnd" <b>INTO</b> auctionDateEnd <b>FROM</b> auction <b>WHERE</b> auction.id = NEW.id_auction;
    <b>IF</b> auctionDateEnd < NEW.date <b>THEN</b>
        <b>RAISE EXCEPTION</b> 'Cannot bid on closed auction!';
    <b>END IF</b>;
    <b>RETURN NEW;
END;</b>
$$;

<b>CREATE TRIGGER</b> "CheckAuctionDate" 
    <b>BEFORE INSERT ON</b> bid 
    <b>FOR EACH ROW 
        EXECUTE PROCEDURE </b>"CheckAuctionDate"();
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
       <pre><b>CREATE FUNCTION</b> "CheckUser"() <b>RETURNS</b> trigger
    <b>LANGUAGE</b> plpgsql
    <b>AS</b> $$
<b>DECLARE</b>
    sellerId integer;
<b>BEGIN</b>
    <b>SELECT</b> owner.id_user <b>INTO</b> sellerId <b>FROM</b> owner <b>WHERE</b> owner.id_auction = NEW.id_auction;     
    <b>IF</b> NEW.id_user = sellerId <b>THEN</b>
        <b>RAISE EXCEPTION</b> 'Cannot have the same buyer as its seller!';
    <b>END IF;
    RETURN NEW;
END;</b>
$$;

<b>CREATE TRIGGER</b>"CheckUser"
    <b>BEFORE INSERT ON</b> bid
    <b>FOR EACH ROW
        EXECUTE PROCEDURE</b> "CheckUser"();
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
       <pre><b>CREATE FUNCTION</b> "CheckUser"() <b>RETURNS</b> trigger
    <b>LANGUAGE</b> plpgsql
    <b>AS</b> $$
<b>DECLARE</b>
    sellerId <b>INTEGER;
BEGIN
    SELECT</b> owner.id_user <b>INTO</b> sellerId <b>FROM</b> owner <b>WHERE</b> owner.id_auction = NEW.id_auction;
    <b>IF</b> NEW.id_user = sellerId <b>THEN</b>
        <b>RAISE EXCEPTION</b> 'Cannot have the same buyer as its seller!';
    <b>END IF;
    RETURN NEW;
END;</b>
$$;

<b>CREATE TRIGGER</b> "CheckUser" 
    <b>BEFORE INSERT ON</b> buynow
    <b>FOR EACH ROW 
        EXECUTE PROCEDURE</b> "CheckUser"();
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
       <pre><b>CREATE FUNCTION</b> "CheckReportedUserNotAdmin"() <b>RETURNS</b> trigger
    <b>LANGUAGE</b> plpgsql
    <b>AS</b> $$
<b>DECLARE</b>
    adminCount integer;
<b>BEGIN</b>
    <b>SELECT</b> count(*) <b>INTO</b> adminCount <b>FROM</b> admin <b>WHERE</b> admin.id_user = NEW.id_user_reported;
    <b>IF</b> adminCount > 0 <b>THEN</b>
       <b>RAISE EXCEPTION</b> 'Cannot report an admin!';
    <b>END IF;
    RETURN NEW;
END;</b>
$$;

<b>CREATE TRIGGER</b> "ReportedUserNotAdmin"
    <b>BEFORE INSERT ON</b> reportuser
    <b>FOR EACH ROW
        EXECUTE PROCEDURE</b> "CheckReportedUserNotAdmin"();
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
       <pre><b>CREATE FUNCTION</b> "CheckReportingNotAuctionOwner"() <b>RETURNS</b> trigger
    <b>LANGUAGE</b> plpgsql
    <b>AS</b> $$
<b>DECLARE</b>
    idOwner integer;
<b>BEGIN</b>
    <b>SELECT</b> owner.id_user INTO idOwner <b>FROM</b> auction, owner <b>WHERE</b> auction.id = owner.id_auction 
    <b>AND</b> auction.id = NEW.id_auction;
    <b>IF</b> idOwner = NEW.id_user THEN
        <b>RAISE EXCEPTION</b> 'Cannot report own auction!';
    <b>END IF;
    RETURN NEW;
END;</b>
$$;

<b>CREATE TRIGGER</b> "ReportingNotOwner" 
<b>BEFORE INSERT ON</b> reportauction 
<b>FOR EACH ROW
EXECUTE PROCEDURE</b> "CheckReportingNotAuctionOwner"();
        </pre>
    </td>
  </tr>
</table>
