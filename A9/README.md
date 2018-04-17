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

#### 1.2. M02: Auctions

<table>
    <tr>
        <th>SQL201</th>
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
    <b>SELECT</b> auction.name, auction."dateBegin", auction."dateEnd", auction.name, auction."actualPrice", 
    auction.photo, auction.active, auction.id, category.id_auction, category.category, 
    owner.id_user, users.name, owner.id_auction,users.id
  <b>FROM</b> auction,category,owner,users
  <b>WHERE</b>  owner.id_auction=auction.id  <b>AND</b> users.id=owner.id_user <b>AND</b> category.id_auction=auction.id 
  <b>AND</b> category.category= $category <b>AND</b> auction.active=TRUE
  <b>LIMIT</b> 60;
        </td>
    </tr>
</table>

#### 1.3. M03: Comments and Wish List

<table>
    <tr>
        <th>SQL301</th>
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

### 2. Transactions

Transactions needed to assure the integrity of the data, with a proper justification.

<table>
    <tr>
        <th>T01</th>
        <td>Get current auctions as well as information about the them</td>
    </tr>
    <tr>
        <td>Isolation level</td>
        <td>SERIALIZABLE READ ONLY</td>
    </tr>
    <td>Justification</td>
        <td>In the middle of the auction, the insertion of new rows in the bid table can occur, which implies that the information retrieved in both selects is different, consequently resulting in a Phantom Read. It's READ ONLY because it only uses Selects.
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

## Members

- Diogo Silva, up201405742@fe.up.pt
- Francisca Cerquinho, up201505791@fe.up.pt
- José Azevedo, up201506448@fe.up.pt
- Pedro Miranda, up201506574@fe.up.pt