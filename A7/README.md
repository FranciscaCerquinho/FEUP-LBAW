## A7: Web Resources Documentation

###  1. Overview

<table>
    <tr>
    <th>M01: Authentication and Individual Profile</th>
    <td>Web resources associated with user authentication and individual profile management, includes the following system 
    features: login/logout, registration, view and edit personal profile information.</td>
  </tr>
  <tr>
    <th>M02: Auctions</th>
    <td>Web resources associated with auctions, includes the following system features: auctions list, search and view auction 
    details and comment auction.</td>
  </tr>
  <tr>
    <th>M03: Wish list</th>
    <td>Web resources associated with wish list, includes the following system features: add/remove auctions 
    to/from wish list.</td>
  </tr>
    <tr>
    <th>M04: Bids</th>
    <td>Web resources associated with bids, includes the following system features: view bids and add bids.</td>
  </tr>
  <tr>
    <th>M05: User and Auction Administration and Static pages</th>
    <td>Web resources associated with user management, specifically: view users, report users and ban users; Web resources 
    associated with auction management: view auctions, report auctions and ban auctions; Web resources with static content are 
    associated with this module: about, contact and FAQ.</td>
  </tr>
</table>

###  2.Permissons

<table>
    <tr>
    <th>PUB</th>
    <td>Public</td>
    <td>Group of users without privileges.</td>
  </tr>
  <tr>
    <th>USR</th>
    <td>User</td>
    <td>Authenticated user.</td>
  </tr>
  <tr>
    <th>OWN</th>
    <td>Owner</td>
    <td>Group of users that can update their profiles and have privileges regarding their auctions.</td>
  </tr>
    <tr>
    <th>ADM</th>
    <td>Administrator</td>
    <td>Group of administrators</td>
  </tr>
</table>

###  3.Modules

### Module M01: Authentication and Individual Profile

Endpoints of Module Authentication and Individual Profile
These are the endpoints available in the Authentication and Individual Profile Module.

* R101: Login Form /login
* R102: Login Action /login
* R103: Logout Action /logout
* R104: Register Form /register
* R105: Register Action /register
* R106: View Profile /profile/{id}
* R107: Edit Profile Form /edit_profile/{id}
* R108: Edit Profile Action /profile/{id}

**R101: Login Form**

<table>
  <tr>
    <th>URL</th>
    <td>/login</td>
  </tr>
   <tr>
    <th>Description</th>
    <td>Page with a form to login to a user account</td>
  </tr>
    <tr>
    <th>Method</th>
    <td>GET</td>
  </tr>
    <tr>
    <th>UI</th>
    <td>UI05</td>
  </tr>
      <tr>
    <th>SUBMIT</th>
    <td>R102</td>
  </tr>
    <tr>
    <th>Permissions</th>
    <td>PUB</td>
  </tr>
</table>

**R102: Login Action**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2>
      /login
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2>
      This web resource logs the user into the system. Redirects to the user profile page on success and the login form on failure.
    </td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>
      POST
    </td>
  </tr>
  <tr>
    <th rowspan=2>Request Body</th>
    <td>
      +email: string
    </td>
    <td>
      Email
    </td>
  </tr>
  <tr>
    <td>
      +password:String
    </td>
    <td>
      Password
    </td>
  </tr>
  <tr>
    <th rowspan=2 >Redirects</th>
    <td>
      R106
    </td>
    <td>
      Success
    </td>
  </tr>
  <tr>
    <td>
      R101
    </td>
    <td>
      Error
    </td>
  </tr>
  <tr>
    <th>Permissions</th>
    <td colspan=2>
      PUB
    </td>
  </tr>
</table>

**R103: Logout Action**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2>
      /logout
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2>
      This web resource logs out the authenticated user or admin.
    </td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>
      POST
    </td>
  </tr>
  <tr>
    <th>Redirects</th>
    <td>
      R101
    </td>
    <td>
      Success
    </td>
  </tr>
  <tr>
    <th>Permissions</th>
    <td colspan=2>USR, ADM</td>
  </tr>
</table>

**R104: Register Form**
<table>
    <tr>
        <th>URL</th>
        <td>/register</td>
    </tr>
     <tr>
        <th>Description</th>
        <td>Page with a form to register a new user account.</td>
    </tr>
     <tr>
        <th>Method</th>
        <td>GET</td>
    </tr>
     <tr>
        <th>UI</th>
        <td>UI05</td>
    </tr>
    <tr>
        <th>SUBMIT</th>
        <td>R105</td>
    </tr>
    <tr>
        <th>Permisson</th>
        <td>PUB</td>
    </tr>
</table>

**R105: Register Action**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2>/register
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2 >This web resource inserts the user into the system. Redirects to user profile on success and the register 
        form on failure.</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>POST</td>
  </tr>
     <tr>
    <th rowspan=8>Request Body</th>
    <td>
     +firstName: string
    </td>
    <td>
     First name
    </td>
    </tr>
  <tr>
    <td>
      +lastName: string
    </td>
    <td>
      Last name
    </td>
  </tr>
    <tr>
    <td>
      +email: string
    </td>
    <td>
      Email
    </td>
  </tr>
       <tr>
    <td>
      +contact: string
    </td>
    <td>
      Contact
    </td>
  </tr>
       <tr>
    <td>
      +address: string
    </td>
    <td>
      Adress
    </td>
  </tr>
           <tr>
    <td>
    +cityCountry
    </td>
    <td>
      City,Country
    </td>
  </tr>
             <tr>
    <td>
    +password
    </td>
    <td>
     Password
    </td>
  </tr>
               <tr>
    <td>
    +confirmPassword
    </td>
    <td>
     Password Confirmation
    </td>
  </tr>
    <tr>
    <th rowspan=2>Redirects</th>
    <td></td>
        <td>SUCCESS</td>
  </tr>
      <tr>
    <td>R104</td>
    <td>Error</td>
  </tr>
      <tr>
    <th>Permissons</th>
    <td></td>
        <td>PUB</td>
  </tr>
</table>

**R106: View Profile**
<table>
    <tr>
    <th>URL</th>
    <td colspan=2>/profile/{id}</td>
  </tr>
     <tr>
    <th>Description</th>
    <td colspan=2>Shows the user individual profile page.</td>
  </tr>
      <tr>
    <th>Method</th>
    <td colspan=2>GET</td>
  </tr>
    <tr>
    <th rowspan=1>Parameters</th>
    <td>+id: integer</td>
        <td>user primary key</td>
  </tr>
       <tr>
    <th>UI</th>
    <td colspan=2>UI10</td>
  </tr>
       <tr>
    <th>Permissions</th>
    <td colspan=2>USR</td>
  </tr>
</table>

**R108: Edit Profile Form**
<table>
    <tr>
    <th>URL</th>
    <td colspan=2>/edit_profile/{id}</td>
  </tr>
     <tr>
    <th>Description</th>
    <td colspan=2>Page with form to edit profile info.</td>
  </tr>
      <tr>
    <th>Method</th>
    <td colspan=2>GET</td>
  </tr>
    <tr>
    <th rowspan=1>Parameters</th>
    <td>+id: integer</td>
        <td>user primary key</td>
  </tr>
       <tr>
    <th>UI</th>
    <td colspan=2>UI11</td>
  </tr>
         <tr>
    <th>SUBMIT</th>
    <td colspan=2>R108</td>
  </tr>
       <tr>
    <th>Permissions</th>
    <td colspan=2>OWN</td>
  </tr>
</table>

**R108: Edit Profile Action**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2>/profile/{id}
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2 >Web resource that changes user profile info based on the input received. 
        Redirects to the user profile on success and edit profile on failure.</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>POST</td>
  </tr>
   <tr>
    <th rowspan=1>Parameters</th>
    <td>+id: integer</td>
    <td>user primary key</td>
  </tr>
       <tr>
     <tr>
    <th rowspan=8>Request Body</th>
    <td>
     +firstName: string
    </td>
    <td>
     New First Name
    </td>
    </tr>
  <tr>
    <td>
      +lastName: string
    </td>
    <td>
      New Last name
    </td>
  </tr>
    <tr>
    <td>
      +email: string
    </td>
    <td>
      New Email
    </td>
  </tr>
       <tr>
    <td>
      +contact: string
    </td>
    <td>
      New Contact
    </td>
  </tr>
       <tr>
    <td>
      +address: string
    </td>
    <td>
      New Adress
    </td>
  </tr>
           <tr>
    <td>
    +cityCountry
    </td>
    <td>
      New City,Country
    </td>
  </tr>
             <tr>
    <td>
    +password
    </td>
    <td>
     New Password
    </td>
  </tr>
               <tr>
    <td>
    +confirmPassword
    </td>
    <td>
     New Password Confirmation
    </td>
  </tr>
    <tr>
    <th rowspan=2>Redirects</th>
    <td>R106</td>
        <td>SUCCESS</td>
  </tr>
      <tr>
    <td>R107</td>
    <td>Error</td>
  </tr>
      <tr>
    <th>Permissons</th>
    <td colspan=2>OWN</td>
  </tr>
</table>

### Module M02: Works

Endpoints of Module Works
These are the endpoints available in the Works Module.

* R201: Search Work Page /works
* R202: Search Work API /api/works
* R203: View Work /works/{id}
* R204: Add Work Form /works/create
* R205: Add Work Action /works
* R206: Edit Work Form /works/{id}/edit
* R207: Edit Work Action /works/{id}
* R208: Add Item Form /works/{id}/items/create
* R209: Add Item Action /works/{id}/items
* R210: Delete Work Action /works/{id}
* R211: Delete Item Action /works/{id}/items/{id}
