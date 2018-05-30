## Online Auctions

# A10: Product

We developed an online auctions platform, where the visitors can see the auctions and the last bid done. The visitors can also search for auctions and search by category. The users can make bids and if they want to buy the product imediately they can use the button "Buy Now" and buy for the highest price set by the owner. The users can report auctions by clicking on an auction and clicking on "Report" button, under the auction image. They can also report other users simply by clicking on the report button in each user comment or by clicking on Report on the owner's page. The administrator can ban and unban auctions and users.
As a user you can add auctions to the wish list, edit your profile, see the auctions created by you and the bids you've made.  

## 1. Installation

### 1.1 Link to the Github release

[Final Version of Code](https://github.com/FranciscaCerquinho/LBAW-56/tree/A10)

### 1.2 Full Docker command to test


#### Installation:
[Installing the Software Dependencies](https://github.com/lbaw-admin/lbaw-laravel/blob/master/README.md#installing-the-software-dependencies)

[Installing local PHP dependencies](https://github.com/lbaw-admin/lbaw-laravel/blob/master/README.md#installing-local-php-dependencies)

#### How to Run:
[Working with PostgreSQL](https://github.com/lbaw-admin/lbaw-laravel/blob/master/README.md#working-with-postgresql)

[Developing the project](https://github.com/lbaw-admin/lbaw-laravel/blob/master/README.md#developing-the-project)


#### Full Docker Command:
```
docker run -it -p 8000:80
DB_DATABASE=lbaw1756
DB_USERNAME=lbaw1756
DB_PASSWORD=jl92oz82
lbaw1756/lbaw1756
```

## 2. Usage
 
> URL to the product: http://lbaw1756.lbaw-prod.fe.up.pt

### 2.1. Administration Credentials

> Administration URL: http://lbaw1756.lbaw-prod.fe.up.pt/administration
 
| Username             | Password |
| -------------------- | -------- |
| fcassola@fe.up.pt    | 123456   |
| up201505791@fe.up.pt   | 123456   |
| up201405742@fe.up.pt   | 123456   |
| up201506448@fe.up.pt   | 123456   |

### 2.2. User Credentials
 
| Type          | Username              | Password |
| ------------- | ----------------------| -------- |
| user           | pedro21fcp@gmail.com  | 123456   |


 
## 3. Application Help
> Describe where help has been implemented, pointing to working examples.

The online help has been implemented on some pages to assist the user. This functionality is added next to the breadcrumb in this pages:

[Homepage](http://lbaw1756.lbaw-prod.fe.up.pt/auctions)

[Auction Page](http://lbaw1756.lbaw-prod.fe.up.pt/auction/14)

[Profile](http://lbaw1756.lbaw-prod.fe.up.pt/editProfile)

[Add Auction](http://lbaw1756.lbaw-prod.fe.up.pt/addAuction)

[Wish List](http://lbaw1756.lbaw-prod.fe.up.pt/wishList)

[Search by Category](http://lbaw1756.lbaw-prod.fe.up.pt/category/Electronics)

[My Auctions Page](http://lbaw1756.lbaw-prod.fe.up.pt/myAuctions)

[My Bids Page](http://lbaw1756.lbaw-prod.fe.up.pt/myBids)
 
## 4. Input Validation
 
> Describe how input data was validated, and provide examples to scenarios using HTML validation and server-side validation.
 
 
## 5. Check Accessibility and Usability

### 5.1 Accessibility
URL result : https://github.com/FranciscaCerquinho/LBAW-56/blob/artefacts/A10/accessibility.pdf

### 5.2 Usability
URL result : https://github.com/FranciscaCerquinho/LBAW-56/blob/artefacts/A10/usability.pdf
 
 

## 6. HTML & CSS Validation

> HTML: https://validator.w3.org/nu/

The pages have only 2 erros, one of them is because of google login and the other is because of bootstrap's modal.

Result
[Html Validator](https://github.com/FranciscaCerquinho/LBAW-56/blob/artefacts/A10/homePageValidator.pdf)

> CSS: https://jigsaw.w3.org/css-validator/
 
 Result
  [Css Validator](https://github.com/FranciscaCerquinho/LBAW-56/blob/artefacts/A10/cssValidator.pdf)
 
## 7. Revisions to the Project
 
> Describe the revisions made to the project since the requirements specification stage.


* Add user stories about [User](https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A10#820-user)
* Remove user storie [US31](https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A2#owner) 
* Remove user storie [US33](https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A2#owner)
* Added the functionality of like and unlike auctions and comments [US30, US31](https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A10#822-customer)
* Added the functionality of reset the user password [US05](https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A10#821-visitor)

To do that we change the follow db tables:
* comment

We added the follow db tables:
* userAuctionLike
* userCommentLike
* endAuction - This table is used to know the owner that buy the auction and then the owner will contact the customer
 
## 8. Implementation Details
 
### 8.1. Libraries Used
 
We used the library google-api-php-client to register a customer with the information that is associated with is Google account

We used the library sendGrid to reset the user password
 
### 8.2 User Stories
 
> Detail the status of the implementation of each user story.
> Also include the new user stories that were created during the project.
#### 8.2.0 User

| US Identifier | Name    | Priority                       | Team members               | State  |
| ------------- | ------- | ------------------------------ | -------------------------- | ------ |
| US11         | Search | high | Diogo Silva |  100%  |
| US12         | Search By Category| high | Francisca Cerquinho |  100%  |
| US13         | Search By Owner name| high | Diogo Silva |  0%  |
| US14         | Auction page| high | Francisca Cerquinho |  100%  |
| US15         | Home Page| high | Francisca Cerquinho |  100%  |
| US16         | About Us Page| high | Francisca Cerquinho, José Azevedo |  100%  |
| US17         | Contact Us Page| high | Francisca Cerquinho, José Azevedo |  100%  |
| US18         |    FAQ Page| high | Francisca Cerquinho|  100%  |
| US19         |    Online help | high | Francisca Cerquinho|  100%  |
#### 8.2.1 Visitor
 
| US Identifier | Name    | Priority                       | Team members               | State  |
| ------------- | ------- | ------------------------------ | -------------------------- | ------ |
| US01         | Sign-in | high | Francisca Cerquinho  |  100%  |
| US02          | Sign-up | high | Francisca Cerquinho              |   100%  | 
| US03          | 	Sign-up using external API | high |    Francisca Cerquinho              |100%     | 
| US04          | 	Sign-in using external API| high |     Francisca Cerquinho             |  100%   | 
| US05          | Reset password | high |     Francisca Cerquinho             |  100%   | 

#### 8.2.2 Customer
| US Identifier | Name    | Priority                       | Team members               | State  |
| ------------- | ------- | ------------------------------ | -------------------------- | ------ |
| US21         | Wish list add | high |  Pedro Miranda             |   100%  | 
| US22         | Wish list remove | high |  Pedro Miranda             |   100%  | 
| US23         | Comment | high |  Francisca Cerquinho             |   100%  | 
| US24         | Rate | high |  Francisca Cerquinho             |   100%  |
| US25         | Profile | high |  Francisca Cerquinho             |   100%  | 
| US26         | Report Users and Auctions | high |  Francisca Cerquinho             |   100%  | 
| US27         |  Make a bid  | high |  Francisca Cerquinho           |   100%  | 
| US28         | Buy Now  | high |    Francisca Cerquinho           |   100%  |
| US29         | Private Message | high |  Pedro Miranda            |   100%  |
| US30         | Like and Unlike Auctions | high |  Francisca Cerquinho            |   100%  |
| US31         | Like and Unlike Comments | high |  Francisca Cerquinho            |   100%  |

#### 8.2.3 Owner
| US Identifier | Name    | Priority                       | Team members               | State  |
| ------------- | ------- | ------------------------------ | -------------------------- | ------ |
| US32         | Sell item | high |   José Azevedo           |   100%  |

#### 8.2.4 Administrator
| US Identifier | Name    | Priority                       | Team members               | State  |
| ------------- | ------- | ------------------------------ | -------------------------- | ------ |
| US41         | Remove comments | high |  Francisca Cerquinho         |   100%  |
| US42         | Ban User| high |   Francisca Cerquinho           |   100%  |
| US43         | Unban User| high |   Francisca Cerquinho           |   100%  |
| US44         | Ban Auction| high |   Francisca Cerquinho           |   100%  |
| US45         | Unban Auction| high |   Francisca Cerquinho           |   100%  |

## Members

- Diogo Silva, up201405742@fe.up.pt
- Francisca Cerquinho, up201505791@fe.up.pt
- José Azevedo, up201506448@fe.up.pt
- Pedro Miranda, up201506574@fe.up.pt
