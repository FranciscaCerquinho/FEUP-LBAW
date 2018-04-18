## Online Auctions

## Main Accesses to the database and transactions (A9)
This artefact shows the main accesses to the database, including the transactions.

For each transaction, the isolation level is explicitly stated and read-only transactions are identified to improve global performance. For each identified access, the SQL code and the reference of web resources (A7) are provided.

### 1. Main Accesses

Main accesses to the database.

#### 1.1. M01: Authentication and Individual Profile

<table>
    <tr>
        <th>SQL101</th>
        <td>Creates a new user in the platform</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r105-register-action"> R105</a>
        </td>
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
        <th>SQL102</th>
        <td>Edits user information</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r108-edit-profile-action"> R108</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
               <pre>
<b>UPDATE</b> users 
<b>SET</b> email = $email, name = $name, photo = $photo, address = $address, contact = $contact, 
country = $country, password =hash($password)
<b>WHERE</b> user_id=$id
        </pre>
        </td>
    </tr>
</table>

#### 1.2. M02: Auctions

<table>
    <tr>
        <th>SQL201</th>
        <td>Search for auctions</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r201-search-auction-page"> R201</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
             <pre>
<b>SELECT</b> auction.name, auction."dateBegin", auction."dateEnd", auction.name, auction.active, 
auction.description, auction.auction_id, auction.photo, auction."actualPrice", owner.id_user, 
users.name, owner.id_auction,users.user_id,auction.description
<b>FROM</b> auction,owner,users
<b>WHERE</b> owner.id_auction=auction.auction_id  <b>AND</b> users.user_id=owner.id_user <b>AND</b> 
(auction.name <b>LIKE</b> %$search% <b>OR</b> auction.description <b>LIKE</b> %$search%) 
<b>AND</b> auction.active=TRUE
  <b>LIMIT</b> 60;
        </pre>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL202</th>
        <td>Search for auctions by category</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r202-search-auction-by-category"> R202</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
<b>SELECT</b> auction.name, auction."dateBegin", auction."dateEnd", auction.name, 
auction."actualPrice", auction.photo, auction.active, auction.auction_id, 
category.id_auction, category.category, owner.id_user, users.name, owner.id_auction,users.user_id
<b>FROM</b> auction,category,owner,users
<b>WHERE</b>  owner.id_auction=auction.auction_id  <b>AND</b> users.user_id=owner.id_user 
<b>AND</b> category.id_auction=auction.auction_id 
<b>AND</b> category.category= $category <b>AND</b> auction.active=TRUE
<b>LIMIT</b> 60;</pre></td></tr>
</table>

<table>
    <tr>
        <th>SQL203</th>
        <td>View Auction</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r203-view-auction"> R203</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
<b>SELECT</></b> auction."dateBegin", auction."dateEnd", auction.name, auction.description, 
auction."buyNow", auction.active, auction."actualPrice", auction.photo, users.name,
users.user_id,owner.id_auction,owner.id_user
<b>FROM</b> auction, users, owner
<b>WHERE</b> auction.auction_id= $auctionID <b>AND</b> auction.auction_id=owner.id_auction 
<b>AND</b> users.user_id=owner.id_user;</pre>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL204</th>
        <td>Add Auction</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r205-add-auction-action"> R205</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
<b>INSERT INTO</b> auction ("dateBegin", "dateEnd", name, description, "buyNow", "actualPrice", 
photo, active)
<b>VALUES</b> ($dateBegin, $dateEnd, $name, $description, $buynow, $actualPrice, $photo, TRUE)</pre></td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL205</th>
        <td>Auction owner</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r206auction-owner-page"> R206</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
     <b>SELECT</b> name,email,photo,address,contact,country,password
        <b>FROM</b> users
        <b>WHERE</b> users.user_id= $userID;</pre>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL206</th>
        <td>Text owner</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r207-text-owner-action"> R207</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
     </pre>
        </td>
    </tr>
</table>

#### 1.3. M03: Comments and Wish List

<table>
    <tr>
        <th>SQL301</th>
        <td>View wish list</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r301-view-wish-list"> R301</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <pre>
<b>SELECT</b> wishList.follow, auction.name, auction."dateBegin", auction."dateEnd", auction.name, 
auction.description, auction."actualPrice", auction.photo, auction."buyNow", auction.active, 
auction.auction_id, wishList.id_user
<b>FROM</b> auction,wishList
<b>WHERE</b> wishList.id_user=$userID AND wishList.id_auction=auction.auction_id 
<b>ORDER BY</b> auction."dateEnd";</pre></td></tr>
</table>

<table>
    <tr>
        <th>SQL302</th>
        <td>Add to wish list</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r302-add-to-wish-list"> R302</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
    <b>INSERT INTO</b> wishList(date,follow,id_user,id_auction)
       <b>VALUES</b> ($date,$follow, $id_user, $id_auction);</pre>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL303</th>
        <td>Remove from wish list</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r303-remove-from-wish-list"> R303</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
    <b>DELETE FROM</b> WishList
     <b>WHERE</b> id_auction = $id_auction <b>AND</b> id_user = $id_user;</pre>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL304</th>
        <td>View Comments on a auction</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r304-view-comments-on-a-item"> R304</a>
        </td>
    </tr>
    <tr>
        <td colspan="2"><pre>
<b>SELECT</b> comment.like, comment.dislike, comment.date, comment.comment,
comment.id_auction, auction.id, users.user_id, users.name, comment.id_user
<b>FROM</b> auction,comment,users
<b>WHERE</b> auction.auction_id=comment.id_auction 
<b>AND</b> comment.id_user = users.user_id;</pre></td></tr>
</table>

<table>
    <tr>
        <th>SQL305</th>
        <td>Add comment on a auction</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r305-add-comments-on-a-auction"> R305</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
    <b>INSERT INTO</b> comment(like,dislike,date,comment,id_user,id_auction)
  <b>VALUES</b> (0,0,$date,$comment,$id_user,$id_auction);</pre>
        </td>
    </tr>
</table>

#### 1.4. M04: Bids

<table>
    <tr>
        <th>SQL401</th>
        <td>Bid Auction</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r402-bid-auction"> R402</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
    <b>INSERT INTO</b> bid(status,price,date,id_auction,id_user)
  <b>VALUES</b> (1,$price,$date,$id_auction,$id_user);</pre>
        </td>
    </tr>
</table>
 
<table>
    <tr>
        <th>SQL402</th>
        <td>End Bid</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r403-end-bid"> R403</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
    <b>UPDATE</b> auction
        <b>SET</b> active = FALSE
            <b>WHERE</b> auction.auction_id = $id;</pre></td>
    </tr>
</table>


#### 1.5. M05: User Administration and Static pages



<table>
    <tr>
        <th>SQL501</th>
        <td>Suspend user</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r502-suspend-user"> R502</a>
        </td>
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
        <th>SQL502</th>
        <td>Reinstate user</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r503-reinstate-user"> R503</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
    <b>UPDATE</b> banUser
     <b>SET</b> "isBanned" = $isBanned
     <b>WHERE</b> id = $id;</pre>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL503</th>
        <td>Suspend auction</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r504-suspend-auction"> R504</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
  <b>INSERT INTO</b> banAuction("isBanned", id_user, "dateBegin", id_auction)
       <b>VALUES</b> ($isBanned, $id_user, $dateBegin, $id_auction);</pre>
        </td>
    </tr>
</table>

<table>
    <tr>
        <th>SQL504</th>
        <td>Reinstante auction</td>
    </tr>
    <tr>
        <td>Web Resource</td>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r505-reinstate-auction"> R505</a>
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
   <b>UPDATE</b> banAuction
     <b>SET</b> "isBanned" = $isBanned
     <b>WHERE</b> id_user = $user_id <b>AND</b> id_auction = $id_auction;</pre>
        </td>
    </tr>
</table>

### 2. Transactions

Transactions needed to assure the integrity of the data, with a proper justification.

<table>
    <tr>
        <th>T01</th>
        <td>Make a bid</td>
    </tr>
    <tr>
        <td>Isolation level</td>
        <td>REPEATABLE READ</td>
    </tr>
    <td>Justification</td>
        <td>In the middle of the auction, the insertion of new rows in the bid table can occur, which implies that the information must be updated. It's REPEATABLE READ because if another bid is insert in a concurrent auction,the data could be inconsistent.
        </td>
    </tr>
    <tr>
        <td colspan="2">
              <pre>
  <b>INSERT INTO</b> bid(status,price,date,id_auction,id_user)
    <b>VALUES</b> (1,$price,$date,$id_auction,$id_user);
    </pre>
    <pre>
    <b>UPDATE</b> auction
     <b>SET</b> "actualPrice" = $price
        <b>WHERE</b> auction_id = $id_auction;
  </pre>
        </td>
    </tr>
</table>

## Members

- Diogo Silva, up201405742@fe.up.pt
- Francisca Cerquinho, up201505791@fe.up.pt
- José Azevedo, up201506448@fe.up.pt
- Pedro Miranda, up201506574@fe.up.pt
