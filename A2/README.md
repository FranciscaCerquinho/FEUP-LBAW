### A2: Actors and User stories

### Actors

Identifier    | Description                                                                                                                                                           | Examples
--------------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------------|-----------
User          | Generic user that has access to public information, such as collection's items                                                                                        |   n/a                            
Visitor       | Unauthenticated user that can register itself (sign-up) or sign-in in the system                                                                                      |   n/a     
Customer      | Authenticated user who is interested in buying something that is on sale at  auction. In addition the customer can haggle the price and comment the purchased product | pmiranda
Owner         | Authenticated user that belongs to the same location as the creator of an item and can change the existing information or lend and record the return of items         | fcerquinho
Administrator | Authenticated user that is responsible for the management of users and for some specific supervisory and moderation functions                                         | admin
API           | External API that can be used to register or authenticate into the system.                                                                                            | Google

Table 1: Actor’s description

### User Stories

### Visitor

Identifier    | Name                        | Priority     |  Description                                                                     
--------------|-----------------------------|--------------|--------------------------------------------------------------------------------------------------------------------------
US01          | Sign-in                     | high         |  As a Visitor, I want to authenticate into the system, so that I can access privileged information    
US02          | Sign-up                     | high         |  As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system
US03          | Sign-up using external API  | low          |  As a Visitor, I want to register a new account linked to my Google account, so that I can access privileged information
US04          | Sign-in using external API  | low          |  As a Visitor, I want to sign-in through my Google account, so that I can authenticate myself into the system

Table 2: Visitor’s user stories

### Customer

Identifier    | Name                        | Priority     |  Description                                                                     
--------------|-----------------------------|--------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
US21          | Wish list add               | high         |  As a Customer, I want to add an item to my wish list, so that I can complete the purchase.
US22          | Wish list remove            | high         |  As a Customer, I want to remove an item from my wish list, so that I can forget the item.
US23          | Comment                     | high         |  As a Customer, I want to register a commentary, so that I can manifest my opinion
US24          | Rate                        | high         |  As a Customer, I want to register a "Like", so that I classify an auction.
US25          | Profile                     | high         |  As a Customer, I want to change my information
US25.1        | Change Name                 | high         |  As a Customer, I want to be able to change my name.
US25.2        | Change Email                | hight        |  As a Customer, I want to be able to change my email.
US25.3        | Change Address              | hight        |  As a Customer, I want to be able to change my address.
US25.4        | Change Photo                | hight        |  As a Customer, I want to be able to change my photo.
US26          | Report                      | hight        |  As a Customer, I want to report any auction,user or comment that I think it’s offensive,so that an Administrator can review it.
US27          | Make a Bid                  | hight        |  As a Customer,I want to be able to make bids in auctions to win the item.
US28          | Buy Now                     | hight        |  As a Customer,I want to be able to Buy a item for a predetermined(by the Owner) price,ending the auction immediately.
US29          | Private Message             | hight        |  As a Customer,I want to be able to communicate with the owner of the product I just buyed to arrange a meeting or ask some questions about the product before buying it.

Table 4: Customer’s user stories

### Owner

Identifier    | Name                        | Priority     |  Description                                                                     
--------------|-----------------------------|--------------|---------------------------------------------------------------------------------------------------
 US31         | Update item                 | hight        |  As Owner, I want to change the information of an item, so that it is up-to-date 
 US32         | Sell item                   | hight        |  As Owner, I want to register the item that I want to sell
 US33         | Remove item                 | hight        |  As Owner, I want to record the unavailability of an item, so that I update the status

Table 5: Owner’s user stories


 ### Administrator

Identifier    | Name                        | Priority     |  Description                                                                     
--------------|-----------------------------|--------------|--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 US41         | Remove comments             | hight        |  As an Admin, I want to remove a comment, so that I remove inappropriate comments
 US42         | Ban User                    | hight        |  As an Admin, I want to record the inactivity of a system user, so that he can't longer access restricted contents of the site. When the user do something that isn’t correct the user receive a warning message.
 US43         | Unban User                  | hight        |  As an Admin, I want to unban an user because I think he deserve that
 US44         | Ban auction                 | hight        |  As an Admin, I want to remove an auction, so that I can remove inappropriate auctions.
 US45         | Unban auction               | hight        |  As an Admin, I want to unban an auction
 
 Table 6: Admin’s user stories
 
### Annex: Supplementary requirements

  This annex contains business rules, technical requirements and other non-functional
requirements on the project.

### Business rules


 
 
 
