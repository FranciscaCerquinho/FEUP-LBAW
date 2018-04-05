## A7: Web Resources Documentation

###  1.Overview

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

###  2.Modules

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
    <td>/login</td>
  </tr>
   <tr>
    <th>Description</th>
    <td>This web resource logs the user into the system. Redirects to the user profile page on success and the login form on 
    failure.</td>
  </tr>
    <tr>
    <th>Method</th>
    <td>POST</td>
  </tr>
<tr>
    <th>Request Body</th>
    <tr><td>+email: string</td><td>Username</td></tr>
    <tr><td>+password: string</td><td>Password</td></tr>
  </tr>
<tr>
    <th>Redirects</th>
    <tr><td></td><td></td></tr>
    <tr><td>R101</td><td>Error</td></tr>
  </tr>
</table>