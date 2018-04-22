## Online Auctions
## Vertical prototype (A8)
    
The Vertical Prototype includes the implementation of two or more user stories (the simplest) and 
aims to validate the architecture presented, also serving to gain familiarity with the technologies used 
in the project. It should be based on the LBAW skeleton and include work on all layers of the 
architecture of the solution to implement: user interface, business logic and data access.

### 1. Implemented Features
### 1.1. Implemented User Stories

The user stories that were implemented in the prototype are described in the following table.

<table>
    <tr>
        <th>User Story reference</th>
        <th>Name</th>
        <th>Priority</th>
        <th>Description</th>
    </tr>
    <tr>
        <td>US01</th>
        <td>Sign in</td>
        <td>high</td>
        <td>As a Visitor, I want to authenticate into the system, so that I can access privileged information</td>
    </tr>
      <tr>
        <td>US02</th>
        <td>Sign up</td>
        <td>high</td>
        <td>As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system</td>
    </tr>
     <tr>
        <td>US05</th>
        <td>Home Page</td>
        <td>high</td>
        <td>As an User, I want to access home page, so that I can see a brief website's presentation</td>
    </tr>
        <tr>
        <td>US06</th>
        <td>About Page</td>
        <td>high</td>
        <td>As an User, I want to access the about page, so that I can see a complete website's description</td>
    </tr>
    </tr>
        <tr>
        <td>US07</th>
        <td>FAQ Page</td>
        <td>high</td>
        <td>As an User, I want to access the FAQ page, so that I can see Frequently Asked Questions</td>
    </tr>
          <tr>
        <td>US08</th>
        <td>Contact Us Page</td>
        <td>high</td>
        <td>As an User, I want to access contact page, so that I can see the contacts</td>
    </tr>
             <tr>
        <td>US25</th>
        <td>Profile Page</td>
        <td>high</td>
        <td>As a Customer, I want to change my information</td>
    </tr>
   
</table>

### 1.2. Implemented Web Resources
    
The web resources that were implemented in the prototype are described in the next section.

#### Module M01: Authentication and Individual Profile

<table>
    <tr>
        <th>Web Resource Reference</th>
        <th>URL</th>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r101-login-form">R101: Login Form</a></td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/login">/login</a>
        </td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r102-login-action">R102: Login Action</a></td>
        <td>POST /login</td>
    </tr>
      <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r103-logout-action">R103: Logout Action</a></td>
        <td>POST /logout</td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r104-register-form">R104: Register Form</a></td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/login">/login</a>
        </td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r105-register-action">R105: Register Action</a></td>
        <td>POST /register</td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r106-view-profile">R106: View Profile</a></td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/editProfile">/editProfile</a>
        </td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r108-edit-profile-form">R107: Edit Profile Form</a></td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/editProfile">/editProfile</a>
        </td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r108-edit-profile-action">R108: Edit Profile Action</a></td>
        <td>POST /users/{id}/edit</td>
    </tr>
</table>

#### Module M02: Auctions


<table>
    <tr>
        <th>Web Resource Reference</th>
        <th>URL</th>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r209-homepage">R209: Home Page</a></td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/auctions">/auctions</a>
        </td>
    </tr>
</table>

#### Module M05: User Administration and Static pages

<table>
    <tr>
        <th>Web Resource Reference</th>
        <th>URL</th>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r506-about">R506: About</a></td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/about">/about</a>
        </td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r507-contact-us">R507: Contact US</a></td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/contact_us">/contact_us</a>
        </td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r508-faq">R508: FAQ</a></td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/faq">/faq</a>
        </td>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r509-404-error">R509: 404 Error</a></td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/error">/error</a>
        </td>
    </tr>
</table>

### 2. Prototype

The prototype is available at http://lbaw1756.lbaw-prod.fe.up.pt/

Credentials:

* regular user: fcassola@fe.up.pt
* user password: 123456

The code is avalable at 
https://github.com/FranciscaCerquinho/LBAW-56/tree/proto

### 2. Revision History

We did distinction between users: visitor, regular user and administrator.
Futhermore we apply control messages when creating an account or editing a user's information.
#### Module M02: Auctions

<table>
    <tr>
        <th>Web Resource Reference</th>
        <th>URL</th>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r203-view-auction">R203: View Auction</a></td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/auction/11">/auction/{id}</a>
        </td>
    </tr>
        <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r206auction-owner-page">R206: Auction Owner Page</a></td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/owner/11">/owner/{id}</a>
        </td>
    </tr>
</table>

#### Module M03: Wish list and Comments

<table>
    <tr>
        <th>Web Resource Reference</th>
        <th>URL</th>
    </tr>
    <tr>
        <td><a href="https://github.com/FranciscaCerquinho/LBAW-56/tree/artefacts/A7#r304-view-comments-on-a-item">R304: View Comments on a item</a></td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/auction/11">/auction/{id}</a>
        </td>
    </tr>
</table>



## Members

- Diogo Silva, up201405742@fe.up.pt
- Francisca Cerquinho, up201505791@fe.up.pt
- José Azevedo, up201506448@fe.up.pt
- Pedro Miranda, up201506574@fe.up.pt
