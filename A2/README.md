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

Identifier    | Name                        |  Description                                                                     
--------------|-----------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
 BR01         | Ownership                   | Only a user from the same site that the creator of the item (Owner)
can finish the auction
 BR02         | Registered customers        | Only registered customers can buy products
 BR03         | Available auctions          | I can only buy products available in auctions that haven’t finished
 BRO4         | Auction time                | The system must be prepared to end the auction by the stipulated date, even if there are no buyers.When a Bid is made in a auction with a time left under than 30 seconds,the time of auction restarts at 30 seconds.
 BR05         | Ban user                    | The system will ban a user that use offensive messages or comments in auctions and excessive reports.
 BR06         | Ban auction                 | The system will ban an auction because is offensive or illegal
 
 Table 7: Business rules
 
 ### Technical requirements
 
 Identifier    | Name                        |  Description                                                                   
 --------------|-----------------------------|------------------------------------------------------------------------------------------------------------
  TR01         | Availability                | The system must be available 99 percent of the time in each 24-hour
period
  TR02         | Accessibility               | The system must ensure that everyone can access the pages, regardless of whether they have any handicap or not, or the Web browser they use
  TR03         | Usability                   | The system should be simple and easy to use
  TR04         | Performance                 | The system should have response times shorter than 2s to ensure
the user's attention
  TR05         | Web application             | The system should be implemented as a Web application with dynamic pages (HTML5, JavaScript, CSS3 and PHP)
  TR06         | Portability                 | The server-side system should work across multiple platforms (Linux, Mac OS, etc.)
  TR07         | Database                    | The PostgreSQL 9.4 database management system must be used
  TR08         | Security                    | The system shall protect information from unauthorised access through the use of an authentication and verification system
  TR09         | Robustness                  | The system must be prepared to handle and continue operating when runtime errors occur
  TR10         | Scalability                 | The system must be prepared to deal with the growth in the number of users and their actions
  TR11         | Ethics                      | The system must respect the ethical principles in software development (for example, the password must be stored encrypted to ensure that only the owner knows it)
  
  Table 8: Technical requirements
  
  ### Restrictions
 
 Identifier    | Name                        |  Description                                                                   
 --------------|-----------------------------|------------------------------------------------------------------------------- 
 C01           | Deadline                    |  Project delivery until deadline
 
 Table 9: Restrictions
 

 
 
