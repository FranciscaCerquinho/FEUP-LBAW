## A5: Relational schema, validation and schema refinement

### 5. Relational Schema

Identifier    | Relational Schema
--------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------
R01           | users(id **UK**, name **NN**, email UK **NN**, photo, address, contact, country,password **NN**, typeUser **NN**)
R02           | admin(id **UK**, id_user → user)
R03           | auction(id **UK**, dateEnd **NN**, dateBegin **NN**, name NN **UK**, description, actualPrice **NN**, photo **NN**, buyNow **NN**, active **NN**, id_user → user)
R04           | reportUser(id, reason **NN**,id_user → userReporting, id_user → userReported)
R05           | comment(id **UK**, like, dislike, date **NN**, comment **NN**, id_user → user, id_auction → auction)
R06           | bid(id,status **NN**, price, bidDate **NN**, id_user → user, id_auction → auction)
R07           | wishList(date **NN**, follow **NN**, id_user → user, id_auction → auction)
R08           | reportAuction(reason **NN**, id_user → user, id_auction → auction)
R09           | banAuction(isBanned **NN**, id_user → user, id_auction → auction, dateBegin **NN**)
R10           | banUser(id **UK**, isBanned **NN**, id_user → user, id_admin→ admin,dateBegin **NN**, dateEnd)
R11           | owner(id_user → user, id_auction → auction)
R12           | buyNow(id_user → user, id_auction → auction)

### 6.Domains

Identifier    | Relational Schema
--------------|-----------------------------------------------------------------------------------------------------------------
Today         | DATE DEFAULT CURRENT_DATE
Category      | ENUM(‘Electronics’,’Fashion’, ‘Home & Garden’, ‘Motors’, ‘Music’, ‘Toys’, ‘Daily Deals’, ‘Sporting’, ‘Others’)
Type          | ENUM(‘RegularUser’, ‘Administrator)

### Functional Dependencies and schema validation

<table>
  <tr>
    <td colspan="2">
      <b>Table R01 </b> (users)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id, email}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0101</th>
    <td>{id} → {email, name, photo, address, country, contact, password, type}</td>
  </tr>
  <tr>
    <th>FD0102</th>
    <td>{email} → {id, name, photo, address, country, contact, password, type}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R02 </b> (admin)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0201</th>
    <td>{id} → {id_user}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R03 </b> (auction)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0301</th>
    <td>{id} → {dateEnd, dateBegin, name, description, actualPrice, photo, buyNow, active, id_user}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R04 </b> (reportUser)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0401</th>
    <td>{id} → {reason,id_user,id_admin}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R05 </b> (comment)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0501</th>
    <td>{id} → {like, dislike, date, comment, id_user, id_auction}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R06 </b> (bid)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0601</th>
    <td>{id} → {status, price, bidDate, id_user, id_auction}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R07 </b> (wishList)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id_user, id_auction}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0701</th>
    <td>{id_user,id_auction} → {date, follow}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>


<table>
  <tr>
    <td colspan="2">
      <b>Table R08 </b> (reportAuction)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id_user, id_auction}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0801</th>
    <td>{id_user,id_auction} → {reason}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R09 </b> (banAuction)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id_user, id_auction}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD0901</th>
    <td>{id_user,id_auction} → {isBanned,dateBegin}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R10 </b> (banUser)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
    <th>FD01001</th>
    <td>{id} → {isBanned, dateEnd, dateBegin,id_user,id_admin}</td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R11 </b> (owner)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id_user, id_auction}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
     <td colspan="2">
      (none)
    </td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>

<table>
  <tr>
    <td colspan="2">
      <b>Table R12 </b> (buyNow)
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Keys:</b> {id_user, id_auction}
    </td>
  </tr>
    <tr>
    <td colspan="2">
      <b>Functional Dependencies</b>
    </td>
  </tr>
    <tr>
     <td colspan="2">
      (none)
    </td>
  </tr>
  <tr>
    <th> NORMAL FORM </th>
    <td>BCNF</td>
  </tr>
</table>
