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

**Module M01: Authentication and Individual Profile**

<table>
    <tr>
        <th>Web Resource Reference</th>
        <th>URL</th>
    </tr>
    <tr>
        <td>R101: Login Form</td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/login">/login</a>
        </td>
    </tr>
    <tr>
        <td>R102: Login Action</td>
        <td>POST /login</td>
    </tr>
      <tr>
        <td>R103: Logout Action</td>
        <td>POST /logout</td>
    </tr>
    <tr>
        <td>R104: Register Form</td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/login">/login</a>
        </td>
    </tr>
    <tr>
        <td>R105: Register Action</td>
        <td>POST /register</td>
    </tr>
    <tr>
        <td>R106: View Profile</td>
        <td>
            <a href="http://lbaw1756.lbaw-prod.fe.up.pt/editProfile">/editProfile</a>
        </td>
    </tr>
    <tr>
        <td>R107: Edit Profile Form</td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/editProfile">/editProfile</a>
        </td>
    </tr>
    <tr>
        <td>R108: Edit Profile Action</td>
        <td>POST /users/{id}/edit</td>
    </tr>
</table>


**Module M05: User Administration and Static pages**

<table>
    <tr>
        <th>Web Resource Reference</th>
        <th>URL</th>
    </tr>
    <tr>
        <td>R506: About</td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/about">/about</a>
        </td>
    </tr>
    <tr>
        <td>R507: Contact US</td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/contact_us">/contact_us</a>
        </td>
    </tr>
    <tr>
        <td>R508: FAQ</td>
        <td>
           <a href="http://lbaw1756.lbaw-prod.fe.up.pt/faq">/faq</a>
        </td>
    </tr>
    <tr>
        <td>R509: 404 Error</td>
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
