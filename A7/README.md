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
    <th>Response body</th>
    <td colspan=2>JSON106</td>
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

### Module M02: Auctions

Endpoints of Module Auctions
These are the endpoints available in the Auctions Module.

* R201: Search Auction Page /search/{id}
* R202: Search Auction By Category /search_category/{id}
* R203: View Auction /item/{id}
* R204: Add Auction Form /add_auction
* R205: Add Auction Action /add_auction
* R206: Auction Owner Page /owner/{id}
* R207: Text Owner Form /owner/{id}
* R208: Text Owner Action /owner/{id}

**R201: Search Auction Page**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2>/search/{id}
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2 >Page when searching for an auction through navbar</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>GET</td>
  </tr>
   <tr>
    <th rowspan=6>Parameters</th>
    <td>?query: string</td>
    <td>String field to search for in auctions</td>
  </tr>
  <tr>
    <td>
      	?item: string
    </td>
    <td>
      Auction name
    </td>
  </tr>
    <tr>
    <td>
      ?ActualPrice: float
    </td>
    <td>
      Auction actual price
    </td>
  </tr>
       <tr>
    <td>
      ?time: integer
    </td>
    <td>
      Remaining time to the end
      of the auction
    </td>
  </tr>
       <tr>
    <td>
      ?owner:string
    </td>
    <td>
      Owner name
    </td>
  </tr>
           <tr>
    <td>
    ?available: boolean
    </td>
    <td>
      Boolean with the available auction lable
    </td>
  </tr>
    <tr>
    <th>Response Body</th>
    <td colspan=2>JSON201</td>
  </tr>
      <tr>
    <th>AJAX Calls</th>
    <td colspan=2>R202</td>
  </tr>
      <tr>
    <th>Permissons</th>
    <td colspan=2>PUB</td>
  </tr>
</table>

**R202: Search Auction By Category**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2>/search_category/{id}
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2 >Page when searching for an auction by category 
    through navbar</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>GET</td>
  </tr>
   <tr>
    <th rowspan=6>Parameters</th>
    <td>?query: string</td>
    <td>String field to search for in auctions</td>
  </tr>
  <tr>
    <td>
      	?item: string
    </td>
    <td>
      Auction name
    </td>
  </tr>
    <tr>
    <td>
      ?ActualPrice: float
    </td>
    <td>
      Auction actual price
    </td>
  </tr>
       <tr>
    <td>
      ?time: integer
    </td>
    <td>
      Remaining time to the end
      of the auction
    </td>
  </tr>
       <tr>
    <td>
      ?owner:string
    </td>
    <td>
      Owner name
    </td>
  </tr>
           <tr>
    <td>
    ?available: boolean
    </td>
    <td>
      Boolean with the available auction lable
    </td>
  </tr>
    <tr>
    <th>Response body</th>
    <td colspan=2>JSON202</td>
  </tr>
      <tr>
    <th>Permissons</th>
    <td colspan=2>PUB</td>
  </tr>
</table>

**R203: View Auction**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2> /item/{id}
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2 >Show the auction page</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>GET</td>
  </tr>
   <tr>
    <th rowspan=1>Parameters</th>
    <td>+id: integer</td>
    <td>Auction primary key.</td>
  </tr>
  <tr>
    <th>Permissons</th>
    <td colspan=2>PUB</td>
  </tr>
</table>

**R204: Add Auction Form**

 <table>
  <tr>
    <th>URL</th>
    <td> /add_auction</td>
  </tr>
  <tr>
    <th>Description</th>
    <td >Page with a form to post a new auction.</td>
  </tr>
  <tr>
    <th>Method</th>
    <td>GET</td>
  </tr>
    <tr>
  <th>UI</th>
  <td>U107</td>
  </tr>
   <tr>
    <th>SUBMIT</th>
    <td>R205</td>
  </tr>
  <tr>
    <th>Permissons</th>
    <td>USR</td>
  </tr>
</table>

**R205: Add Auction Action**

 <table>
  <tr>
    <th>URL</th>
    <td colspan=2>/add_auction
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2 >Web resource that creates a new auction based on the 
    input received. Redirects to the new auction page on success and back 
    to new auction form on failure.</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>POST</td>
  </tr>
   <tr>
    <th rowspan=7>Request Body</th>
    <td>+name: string</td>
    <td>Name of the Auction</td>
  </tr>
  <tr>
    <td>
      +category: string	
    </td>
    <td>
      Auction category
    </td>
  </tr>
    <tr>
    <td>
      +des:string
    </td>
    <td>
      Description of the Auction
    </td>
  </tr>
       <tr>
    <td>
      +inicialPrice:float
    </td>
    <td>
      Initial price of the Auction
    </td>
  </tr>
       <tr>
    <td>
      +EndDate: string
    </td>
    <td>
      End of Auction date
    </td>
  </tr>
           <tr>
    <td>
    +photo:string
    </td>
    <td>
      Auction photo
    </td>
  </tr>
        <tr>
    <td>
    ?ownerName:name
    </td>
    <td>
      Auction owner name
    </td>
  </tr>
    <tr>
    <th rowspan=2>Redirects</th>
    <td>R203</td>
    <td>SUCESS</td>
  </tr>
   <tr>
    <td>R204</td>
    <td>ERROR</td>
  </tr>
      <tr>
    <th>Permissons</th>
    <td colspan=2>USR,OWN</td>
  </tr>
</table>

**R206:Auction Owner Page**

<table>
  <tr>
    <th>URL</th>
    <td colspan=2>/owner/{id}
    </td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2 >Web redirects to auction owner page when you click on the owner in auction page</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>GET</td>
  </tr>
   <tr>
    <th rowspan=6>Parameters</th>
    <td>?query: string</td>
    <td>String field to search for auction owner</td>
  </tr>
  <tr>
    <td>
      	?First Name: string
    </td>
    <td>
      Owner First Name
    </td>
  </tr>
    <tr>
    <td>
      ?Last Name: string
    </td>
    <td>
      Owner Last Name
    </td>
  </tr>
       <tr>
    <td>
      ?City,Country: string
    </td>
    <td>
      City and Country of the owner
    </td>
  </tr>
       <tr>
    <td>
      ?email:string
    </td>
    <td>
      Owner email
    </td>
  </tr>
     <tr>
    <td>
      ?contact:integer
    </td>
    <td>
      Owner contact
    </td>
  </tr>
    <tr>
    <th>UI</th>
    <td colspan=2>UI10</td>
  </tr>
      <tr>
    <th>Permissons</th>
    <td colspan=2>PUB</td>
  </tr>
</table>

**R207: Text Owner Form**

 <table>
  <tr>
    <th>URL</th>
    <td> /owner/{id}</td>
  </tr>
  <tr>
    <th>Description</th>
    <td >Page with a form to post a new message for the auction owner.</td>
  </tr>
  <tr>
    <th>Method</th>
    <td>GET</td>
  </tr>
    <tr>
  <th>UI</th>
  <td>UI10</td>
  </tr>
   <tr>
    <th>SUBMIT</th>
    <td>R208</td>
  </tr>
  <tr>
    <th>Permissons</th>
    <td>USR</td>
  </tr>
</table>

**R207: Text Owner Action**

 <table>
  <tr>
    <th>URL</th>
    <td colspan=2> /owner/{id}</td>
  </tr>
  <tr>
    <th>Description</th>
    <td colspan=2>Web resource that creates a new email for the auction owner
    based on the input received. The user receives an alert in case of success or failure</td>
  </tr>
  <tr>
    <th>Method</th>
    <td colspan=2>POST</td>
  </tr>
    <tr>
    <th rowspan=4>Request body</th>
    <td>+name:string</td>
    <td>User name</td>
  </tr>
  <tr>
    <td>+email:string</td>
    <td>User email</td>
  </tr>
    <tr>
    <td>+subject:string</td>
    <td>Email subject</td>
  </tr>
    <tr>
    <td>+message:string</td>
    <td>Email message</td>
  </tr>
  <tr>
    <th>Permissons</th>
    <td colspan=2>USR</td>
  </tr>
</table>

### Module M03: Wish list and Comments

* R301: View Wish list /users/{id}/wishlist
* R302: Add to Wish list /users/{id_user}/wishlist/auctions/{id_auction}
* R303: Remove from Wish list /users/{id_user}/wishlist/auctions/{id_auction}
* R304: View Comments on a item /auction/{id_auction}/comments
* R305: Add Comments on a item /auction/{id_auction}/comments

**R301: View Wish list**

<table>
<tr>
<th>URL</th>
<td colspan=2>/users/{id}/wishlist</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>Show user's wishList page.</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>GET</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id:integer</td>
<td>User id</td>
</tr>
<tr>
<th>Response Body</th>
<td colspan=2>JSON301</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR,OWN</td>
</tr>
</table>

**R302: Add to Wish list**

<table>
<tr>
<th>URL</th>
<td colspan=2>/users/{id_user}/wishlist/auctions/{id_auction}</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>Add a auction to the user's wishList page.</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>POST</td>
</tr>
<tr>
<th rowspan=2>Parameters</th>
<td>+id_user:integer</td>
<td>User id</td>
</tr>
<tr>
<td>+id_auction:integer</td>
<td>Auction id</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The auction was successfully added to the user's wishlist.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No auction with the specified primary key exists.</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR</td>
</tr>
</table>

**R303: Remove from Wish list**

<table>
<tr>
<th>URL</th>
<td colspan=2>/users/{id_user}/wishlist/auctions/{id_auction}</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>Show user's wishList page.</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>DELETE</td>
</tr>
<tr>
<th rowspan=2>Parameters</th>
<td>+id_user:integer</td>
<td>User id</td>
</tr>
<tr>
<td>+id_auction:integer</td>
<td>Auction id</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The auction was successfully deleted from the user's wishlist.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No auction with the specified primary key exists.</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR</td>
</tr>
</table>

**R304: View Comments on a item**

<table>
<tr>
<th>URL</th>
<td colspan=2>/auction/{id_auction}/comments</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>Show comments on a item.</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>GET</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id_auction:integer</td>
<td>Auction id</td>
</tr>
<tr>
<th>Response Body</th>
<td colspan=2>JSON304</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR,OWN</td>
</tr>
</table>

**R305: Add Comments on a auction**

<table>
<tr>
<th>URL</th>
<td colspan=2>/auction/{id_auction}/comments</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>Add a comment to one auction.</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>POST</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id_auction:integer</td>
<td>Auction id</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The Comment was successfully added to the auction.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No auction with the specified primary key exists.</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR,OWN</td>
</tr>
</table>


### Module M04: Bids

* R401: My bids /users/{id}/bids
* R402: Bid Auction /users/{id}/bids
* R403: End Bid /users/{id}/bids/{id}/end

**R401: My bids**

<table>
<tr>
<th>URL</th>
<td colspan=2>/users/{id}/bids</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>Get all my bid auctions.</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>GET</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id:integer</td>
<td>User id</td>
</tr>
<tr>
<th>UI</th>
<td colspan=2>UIXX</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR</td>
</tr>
</table>

**R402: Bid Auction**

<table>
<tr>
<th>URL</th>
<td colspan=2>/users/{id}/bids</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>Bid an auction</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>POST</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id:integer</td>
<td>User id</td>
</tr>
<tr>
<th rowspan=1>Request body</th>
<td>+bid:float</td>
<td>Bid value</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The auction was successfully bid.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No auction with the specified primary key exists.</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR</td>
</tr>
</table>

**R403: End Bid**

<table>
<tr>
<th>URL</th>
<td colspan=2>/users/{id}/bids/{id}/end</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>This web resource ends a auction bid.</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>PUT</td>
</tr>
<tr>
<th rowspan=2>Parameters</th>
<td>+user_id:integer</td>
<td>User id</td>
</tr>
<tr>
<td>+auction_id:integer</td>
<td>Auction id</td>
</tr>
<tr>
<th rowspan=1>Request body</th>
<td>+bid:float</td>
<td>Bid value</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The auction was successfully close.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No auction with the specified primary key exists.</td>
</tr>
<th>Permissons</th>
<td colspan=2>USR</td>
</tr>
</table>

### Module M05: User Administration and Static pages

Endpoints of User Administration and Static pages
These are the endpoints available in the User Administration and Static pages Module.

* R501: Get users /adminstration/users
* R502: Suspend user /adminstration/users/{id}/suspend
* R503: Reinstate users /adminstration/users/{id}/reinstate
* R504: Suspend auction /adminstration/auctions/{id}/suspend
* R505: Reinstate auction /adminstration/auctions/{id}/reinstate
* R506: About /about
* R507: Contact US /contact_us
* R508: FAQ /faq
* R509: 404 Error /404

**R501: Get users**

<table>
<tr>
<th>URL</th>
<td>/administration/users</td>
</tr>
<tr>
<th>Description</th>
<td>Get all registed users</td>
</tr>
<tr>
<th>Method</th>
<td>GET</td>
</tr>
<tr>
<th>UI</th>
<td>UI12</td>
</tr>
<tr>
<th>Permissons</th>
<td>ADM</td>
</tr>
</table>

**R502: Suspend user**

<table>
<tr>
<th>URL</th>
<td colspan=2>/adminstration/users/{id}/suspend</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>This web resource suspends an user</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>PUT</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id:integer</td>
<td>User id</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The user was successfully suspended.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No user with the specified primary key exists.</td>
</tr>
<tr>
<th>Permissons</th>
<td colspan=2>ADM</td>
</tr>
</table>

**R503: Reinstate user**

<table>
<tr>
<th>URL</th>
<td colspan=2>/adminstration/users/{id}/reinstate</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>This web resource reinstates an user</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>PUT</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id:integer</td>
<td>User id</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The user was successfully reinstated.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No user with the specified primary key exists.</td>
</tr>
<tr>
<th>Permissons</th>
<td colspan=2>ADM</td>
</tr>
</table>

**R504: Suspend auction**

<table>
<tr>
<th>URL</th>
<td colspan=2>/adminstration/auctions/{id}/suspend</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>This web resource suspends an auction</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>PUT</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id:integer</td>
<td>Auction id</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The auction was successfully suspended.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No user with the specified primary key exists.</td>
</tr>
<tr>
<th>Permissons</th>
<td colspan=2>ADM</td>
</tr>
</table>

**R505: Reinstate auction**

<table>
<tr>
<th>URL</th>
<td colspan=2>/adminstration/auctions/{id}/reinstate</td>
</tr>
<tr>
<th>Description</th>
<td colspan=2>This web resource reinstates an auction</td>
</tr>
<tr>
<th>Method</th>
<td colspan=2>PUT</td>
</tr>
<tr>
<th rowspan=1>Parameters</th>
<td>+id:integer</td>
<td>Auction id</td>
</tr>
<tr>
<th rowspan=3>Returns</th>
<td>200 OK</td>
<td>The auction was successfully reinstated.</td>
</tr>
<tr>
<td>400 Bad Request</td>
<td>Error. Error message is specified via a HTTP header.</td>
</tr>
<tr>
<td>404 Not Found</td>
<td>Error. No user with the specified primary key exists.</td>
</tr>
<tr>
<th>Permissons</th>
<td colspan=2>ADM</td>
</tr>
</table>

**R506: About**

<table>
<tr>
<th>URL</th>
<td>/about</td>
</tr>
<tr>
<th>Description</th>
<td>Get about page</td>
</tr>
<tr>
<th>Method</th>
<td>GET</td>
</tr>
<tr>
<th>UI</th>
<td>UI02</td>
</tr>
<tr>
<th>Permissions</th>
<td>PUB</td>
</tr>
</table>

**R507: Contact Us**

<table>
<tr>
<th>URL</th>
<td>/contact_us</td>
</tr>
<tr>
<th>Description</th>
<td>Get contact page</td>
</tr>
<tr>
<th>Method</th>
<td>GET</td>
</tr>
<tr>
<th>UI</th>
<td>UI04</td>
</tr>
<tr>
<th>Permissions</th>
<td>PUB</td>
</tr>
</table>

**R508: FAQ**

<table>
<tr>
<th>URL</th>
<td>/faq</td>
</tr>
<tr>
<th>Description</th>
<td>Get faq page</td>
</tr>
<tr>
<th>Method</th>
<td>GET</td>
</tr>
<tr>
<th>UI</th>
<td>UI03</td>
</tr>
<tr>
<th>Permissions</th>
<td>PUB</td>
</tr>
</table>

**R509: 404 Error**

<table>
<tr>
<th>URL</th>
<td>/404</td>
</tr>
<tr>
<th>Description</th>
<td>Get 404 error page</td>
</tr>
<tr>
<th>Method</th>
<td>GET</td>
</tr>
<tr>
<th>UI</th>
<td>UI06</td>
</tr>
<tr>
<th>Permissions</th>
<td>PUB</td>
</tr>
</table>

### JSON/XML Types

The structure of the JSON formatted answers must be documented as illustrated below.

**JSON106: View User: {User}**

```
"user": {
  "id": "1",
  "email": "mteixeira@gmail.com",
  "name": "Mariana Teixeira",
  "photo": "marianaTeixeira.jpg".
  "address": "Rua do Aleixo 143",
  "country": "Portugal",
  "contact": "915463445"
}
```

**JSON201: Search Auction: {auction}[]**

```
{
  "auction": [
    {
      "id": "1",
      "name": "PS4 Controllers",
      "description": "Two Sony PS4 controllers that were only used once.",
      "buyNow": "80",
      "active": "1",
      "dateBegin": "2018-04-03 12:28:40+01",
      "dateEnd": "2018-05-20 12:28:40+01",
      "actualPrice": "60",
      "photo": "resources/PS4Controllers.jpg"
    }
  ]
}
```

**JSON202: Search Auction By Category: {auction}[]**

```
{
  "auction": [
    {
      "id": "1",
      "name": "PS4 Controllers",
      "description": "Two Sony PS4 controllers that were only used once.",
      "buyNow": "80",
      "active": "1",
      "dateBegin": "2018-04-03 12:28:40+01",
      "dateEnd": "2018-05-20 12:28:40+01",
      "actualPrice": "60",
      "photo": "resources/PS4Controllers.jpg"
    },
    {
      "id": "15",
      "name": "Macbook Pro",
      "description": "Only with 2 months of use, and with a 2-year warranty.",
      "buyNow": "1300",
      "active": "1",
      "dateBegin": "2018-05-03 12:28:40+01",
      "dateEnd": "2018-05-20 12:28:40+01",
      "actualPrice": "1100",
      "photo": "resources/macbookPro.jpg"
    }
  ]
}
```

**JSON301: View WishList: {Auction}[]**

```
{
  "auction": [
    {
      "id": "1",
      "name": "Vinyl Mike Evans",
      "description": "Vinyl from 90's with a good price.",
      "buyNow": "100",
      "active": "1",
      "dateBegin": "2018-04-05 12:28:40+01",
      "dateEnd": "2018-04-20 12:28:40+01",
      "actualPrice": "50",
      "photo": "resources/vinylMikeEvans.jpg"
    },
    {
      "id": "2",
      "name": "Tennis Nike",
      "description": "Last fashion! Do not miss this opportunity.",
      "buyNow": "80",
      "active": "1",
      "dateBegin": "2018-04-07 15:18:20+01",
      "dateEnd": "2018-04-15 15:18:20+01",
      "actualPrice": "50",
      "photo": "resources/tennisNike.jpg"
    }
  ]
}
```

**JSON304: View Comments: {Comment}[]**

```
{
  "comment": [
    {
      "id": "2",
      "like": "14",
      "dislike": "3",
      "date": "2018-03-28 02:28:40+01",
      "comment": "Very good price, I want to win.",
      "id_user": "30"
    },
    {
      "id": "7",
      "like": "6",
      "dislike": "5",
      "date": "2018-04-01 04:19:56+01",
      "comment": "I don't want to lose the opportunity to win this auction",
      "id_user": "5"
    }
  ]
}
```

### Members

- Diogo Silva, up201405742@fe.up.pt
- Francisca Cerquinho, up201505791@fe.up.pt
- José Azevedo, up201506448@fe.up.pt
- Pedro Miranda, up201506574@fe.up.pt
