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
