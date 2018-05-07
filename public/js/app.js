$(function() {

  $('#login-form-link').click(function(e) {
      $("#login-form").delay(100).fadeIn(100);
      $("#register-form").fadeOut(100);
      $('#register-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
  });
  $('#register-form-link').click(function(e) {
      $("#register-form").delay(100).fadeIn(100);
      $("#login-form").fadeOut(100);
      $('#login-form-link').removeClass('active');
      $(this).addClass('active');
      e.preventDefault();
  });

});

function encodeForAjax(data) {
  if (data == null) return null;
  return Object.keys(data).map(function(k) {
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
  }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
  let request = new XMLHttpRequest();

  request.open(method, url, true);
  request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
  request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  request.addEventListener('load', handler);
  request.send(encodeForAjax(data));
}

function addEventListeners() {

  let addComment = document.querySelector(".leave_comment .status-upload button");
  if (addComment) {
      addComment.addEventListener('click', sendCommentRequest);
  }

  let addLike = document.querySelector("#item #likeButton");
  if (addLike) {
      addLike.addEventListener('click', sendAuctionLikeRequest);
  }

  let addUnlike = document.querySelector("#item #unlikeButton");
  if (addUnlike) {
      addUnlike.addEventListener('click', sendAuctionUnlikeRequest);
  }

  let addCommentLike = document.querySelectorAll(".comment #commentLike");
  if (addCommentLike) {
      for (var i = 0; i < addCommentLike.length; i++)
          addCommentLike[i].addEventListener('click', sendCommentLikeRequest);
  }

  let addCommentUnlike = document.querySelectorAll(".comment #commentUnlike");
  if (addCommentUnlike) {
      for (var i = 0; i < addCommentUnlike.length; i++)
          addCommentUnlike[i].addEventListener('click', sendCommentUnlikeRequest);
  }

  let makeBid = document.querySelector("#bid_buttons #bid button");
  if (makeBid) {
      makeBid.addEventListener('click', sendBidRequest);
  }

  let buyNow = document.querySelector("#buy_now_button button");
  if (buyNow) {
      buyNow.addEventListener('click', sendBuyNowRequest);
  }

  let reportAuction = document.querySelector("#reportButton #btn");
  if (reportAuction) {
      reportAuction.addEventListener('click', reportAuctionRequest);
  }

  let reportUser = document.querySelectorAll(".comment .popup-reportUser #reportUserButton");
  if (reportUser) {
      for (var i = 0; i < reportUser.length; i++)
          reportUser[i].addEventListener('click', reportUserRequest);
  }

  let banUser = document.querySelectorAll(".banUser");
  if (banUser) {
      for (var i = 0; i < banUser.length; i++)
          banUser[i].addEventListener('click', banUserRequest);
  }

  let banAuction = document.querySelectorAll(".banAuction");
  if (banAuction) {
      for (var i = 0; i < banAuction.length; i++)
          banAuction[i].addEventListener('click', banAuctionRequest);
  }

  let addFormAddAuction = document.querySelector("#add_auction_buttons .addAuction");
  if (addFormAddAuction) {
      addFormAddAuction.addEventListener('click', addFormAddAuctionRequest);
  }
};

function sendCommentRequest() {
  let text = document.querySelector(".leave_comment .status-upload textarea").value;
  let id = this.closest('section#item').getAttribute('data-id');

  if (text != '')
      sendAjaxRequest('post', '/comment/' + id, {
          comment: text
      }, addCommentHandler);
};

function addCommentHandler() {

  if (this.status != 200) window.location = '/';
  let newComment = JSON.parse(this.responseText);

  let comment = document.createElement('div');
  comment.setAttribute('class', 'col-sm-12 comment');
  comment.setAttribute('data-id', newComment.id);
  let date = SplitDateReturn(newComment.date);

  comment.innerHTML = `
  <div class="panel panel-white post panel-shadow">
  <div class="post-heading">
      <div class="pull-left image">
          <img src="${newComment.url}" class="img-circle avatar" alt="user profile image">
      </div>
      <div class="pull-left meta">
          <div class="title h5">
              <a href="#">
                  <b>${newComment.user.firstname} ${newComment.user.lastname}</b>
              </a>
          </div>
          <h6 class="text-muted time"> ${date} ago</h6>
      </div>
  </div>
  <div class="post-description">
      <p>${newComment.comment}</p>
      <div class="stats">
            <a id="commentLike" class="btn stat-item">
                <span  id ="likeCommentHand" class="fa fa-thumbs-up icon"></span>
                <span  id ="likeComment">${newComment.like}</span>
            </a>
            <a id="commentUnlike" class="btn stat-item">
                <span  id ="unlikeCommentHand" class="fa fa-thumbs-down icon"></span>
                <span  id ="unlikeComment">${newComment.dislike}</span>
            </a>
          <a class="btn btn-sm stat-item" style="padding:6px;">
              <i class="fas fa-bullhorn"></i>Report
          </a>
      </div>
  </div>
</div>`;

  let comments = document.querySelector(".comments .row");

  let commentBox = document.querySelector("#addComment");
console.log(comments);
console.log(commentBox);
console.log(comment);
  comments.insertBefore(comment, commentBox);
}


function sendAuctionLikeRequest() {
  let like = document.querySelector("#buttons #likeAuction").textContent;
  like = parseInt(like) + 1;

  let id = this.closest('section#item').getAttribute('data-id');

  if (like != '')
      sendAjaxRequest('post', '/likeAuction/' + id, {
          like: like
      }, addAuctionLikeHandler);
}

function addAuctionLikeHandler() {

  if (this.status != 200) window.location = '/';
  let newLike = JSON.parse(this.responseText);

  console.log(newLike);
  let like = document.querySelector("#item #likeAuction");
  console.log('aqui' + like);
  like.innerHTML = newLike.auction_like;

  let unlike = document.querySelector("#item #unlikeAuction");

  unlike.innerHTML = newLike.auction_dislike;

  document.getElementById('like_hand').style = 'color: #437ab2;';
  like.style = 'color: #437ab2;';


  document.getElementById('unlike_hand').style = 'color: black;';
  unlike.style = 'color: black;';

}


function sendAuctionUnlikeRequest() {
  let unlike = document.querySelector("#buttons #unlikeAuction").textContent;
  unlike = parseInt(unlike) + 1;

  let id = this.closest('section#item').getAttribute('data-id');

  if (unlike != '')
      sendAjaxRequest('post', '/unlikeAuction/' + id, {
          unlike: unlike
      }, addAuctionUnlikeHandler);
}

function addAuctionUnlikeHandler() {

  if (this.status != 200) window.location = '/';
  let newUnlike = JSON.parse(this.responseText);

  let unlike = document.querySelector("#item #unlikeAuction");

  unlike.innerHTML = newUnlike.auction_dislike;


  let like = document.querySelector("#item #likeAuction");

  like.innerHTML = newUnlike.auction_like;


  document.getElementById('unlike_hand').style = 'color: #437ab2;';
  unlike.style = 'color: #437ab2;';


  document.getElementById('like_hand').style = 'color: black;';
  like.style = 'color: black;';
}

function sendCommentLikeRequest() {
  let like = document.querySelector("#commentLike").textContent;
  like = parseInt(like) + 1;

  let id = this.closest('div.comment').getAttribute('data-id');

  if (like != '')
      sendAjaxRequest('post', '/likeComment/' + id, {
          like: like
      }, addCommentLikeHandler);
}

function addCommentLikeHandler() {

  if (this.status != 200) window.location = '/';
  let newLike = JSON.parse(this.responseText);

  let stats = document.querySelector('div.comment[data-id="' + newLike.id + '"]');
  let like = stats.querySelector("#likeComment");

  like.innerHTML = newLike.like;

  let unlike = stats.querySelector("#unlikeComment");

  unlike.innerHTML = newLike.dislike;

  stats.querySelector('#likeCommentHand').style = 'color: #437ab2;';
  like.style = 'color: #437ab2;';


  stats.querySelector('#unlikeCommentHand').style = 'color: black;';
  unlike.style = 'color: black;';

}



function sendCommentUnlikeRequest() {
  let unlike = document.querySelector("#commentUnlike").textContent;
  unlike = parseInt(unlike) + 1;

  let id = this.closest('div.comment').getAttribute('data-id');

  if (unlike != '')
      sendAjaxRequest('post', '/unlikeComment/' + id, {
          unlike: unlike
      }, addCommentUnlikeHandler);
}

function addCommentUnlikeHandler() {
  if (this.status != 200) window.location = '/';
  let newUnlike = JSON.parse(this.responseText);

  let stats = document.querySelector('div.comment[data-id="' + newUnlike.id + '"]');
  let unlike = stats.querySelector("#unlikeComment");

  unlike.innerHTML = newUnlike.dislike;


  let like = stats.querySelector("#likeComment");

  like.innerHTML = newUnlike.like;

  stats.querySelector('#unlikeCommentHand').style = 'color: #437ab2;';
  unlike.style = 'color: #437ab2;';


  stats.querySelector('#likeCommentHand').style = 'color: black;';
  like.style = 'color: black;';
}


function sendBidRequest() {
  let bid = document.querySelector("#bid_buttons #price_button").value;

  let id = this.closest('section#item').getAttribute('data-id');

  if (bid != '')
      sendAjaxRequest('post', '/makeBid/' + id, {
          bid: bid
      }, makeBidHandler);
}

function makeBidHandler() {

  let message = document.createElement('div');
  message.setAttribute('class', 'row');

  if (this.status != 200) {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  Bid lower than the actual price! &nbsp;
</div>`;

      let item_info = document.querySelector("#item_information");

      let info = document.querySelector("#info");

      item_info.insertBefore(message, info);
  }
  let newBid = JSON.parse(this.responseText);

  if (newBid.message != 'You have to login! &nbsp') {

      if (newBid.message != 'Bid lower than the actual price! &nbsp') {
          let bid = document.querySelector("#item_price");
          bid.innerHTML = 'EUR ' + newBid.price;

          message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
<a class="panel-close close" data-dismiss="alert">x</a>
<i class="far fa-check-circle"></i>
Bet made! The auction has been added to your bids, you will receive a warning if you are the winner
</div>`;

          let item_info = document.querySelector("#item_information");

          let info = document.querySelector("#info");

          item_info.insertBefore(message, info);
      } else {
          message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  ${newBid.message}
</div>`;

          let item_info = document.querySelector("#item_information");

          let info = document.querySelector("#info");

          item_info.insertBefore(message, info);
      }
  } else {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  ${newBid.message}
</div>`;

      let item_info = document.querySelector("#item_information");

      let info = document.querySelector("#info");

      item_info.insertBefore(message, info);
  }
}

function sendBuyNowRequest() {

  let id = this.closest('section#item').getAttribute('data-id');

  sendAjaxRequest('post', '/buyNow/' + id, null, buyNowHandler);
}

function buyNowHandler() {

  console.log(this.responseText);

  if (this.status != 200) window.location = '/';
  let buyNow = JSON.parse(this.responseText);


  let message = document.createElement('div');
  message.setAttribute('class', 'row');

  message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
<a class="panel-close close" data-dismiss="alert">x</a>
<i class="far fa-check-circle"></i>
The auction is yours! Congratulations! The owner will contact you.
</div>`;

  let item_info = document.querySelector("#item_information");

  let info = document.querySelector("#info");

  item_info.insertBefore(message, info);
}

function reportAuctionRequest() {

  let reason = document.querySelector("#reportAuctionText").value;
  console.log(reason);
  let id = this.closest('section#item').getAttribute('data-id');

  sendAjaxRequest('post', '/reportAuction/' + id, {
      reason: reason
  }, reportAuctionHandler);
}

function reportAuctionHandler() {
  console.log(this.responseText);
  let message = document.createElement('div');
  message.setAttribute('class', 'row');
  if (this.status != 200) {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  Did not report! Try again! 
  </div>`;
  } else {
      let reportAuction = JSON.parse(this.responseText);

      message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="far fa-check-circle"></i>
  The Auction has been sucessfully reported!
  </div>`;

      document.querySelector('#reportA').style = 'color: rgb(204,68,74);';
      document.querySelector('.reportAuctionButton').style = 'color: rgb(204,68,74);';

  }
  let item_info = document.querySelector(".popup-inner-reportAuction");

  let info = document.querySelector("#auctionForm");

  item_info.insertBefore(message, info);
}

function reportUserRequest() {
  let parent = this.closest(".comment");
  let reason = parent.querySelector(".reportUserText").value;

  console.log(reason);
  
  let id = this.closest('.popup-reportUser').getAttribute('data-id');
  console.log(id);
  let commentID = this.closest('.popup-inner-reportUser').getAttribute('data-id');

  sendAjaxRequest('post', '/reportUser/' + id, {
      reason: reason,
      commentID: commentID
  }, reportUserHandler);
}

function reportUserHandler() {

  if (this.status != 200) {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
<a class="panel-close close" data-dismiss="alert">x</a>
<i class="fas fa-bell"></i>
Did not report! Try again! 
</div>`;
  }

  let reportAuction = JSON.parse(this.responseText);

  let message = document.createElement('div');
  message.setAttribute('class', 'row');

  message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
<a class="panel-close close" data-dismiss="alert">x</a>
<i class="far fa-check-circle"></i>
The User has been sucessfully reported!
</div>`;

  let item_info = document.querySelector('.popup-inner-reportUser[data-id="' + reportAuction.commentID + '"]');

  let info = item_info.querySelector("#userForm");

  item_info.insertBefore(message, info);
}

function banUserRequest() {

  let parent = this.closest("#usersReported");
  let checkBox = parent.querySelector(".banUser");

  let id = this.closest('.usersReported').getAttribute('data-id');

  if (checkBox.checked == true)
      sendAjaxRequest('post', '/banUser/' + id, null, banUserHandler);
  else
      sendAjaxRequest('delete', '/unbanUser/' + id, null, unbanUserHandler);
}

function banUserHandler() {

  let message = document.createElement('div');
  message.setAttribute('class', 'row');

  if (this.status != 200) {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  Did not ban! Try again! 
  </div>`;
  } else {
      let reportAuction = JSON.parse(this.responseText);

      message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
    <a class="panel-close close" data-dismiss="alert">x</a>
    <i class="far fa-check-circle"></i>
    The User has been sucessfully banned!
    </div>`;
  }

  let item_info = document.querySelector(".user_report");
  let info = item_info.querySelector(".style17");
  item_info.insertBefore(message, info);

}

function unbanUserHandler() {
  let message = document.createElement('div');
  message.setAttribute('class', 'row');

  if (this.status != 200) {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  Did not unban! Try again! 
  </div>`;
  } else {
      let reportAuction = JSON.parse(this.responseText);

      message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
    <a class="panel-close close" data-dismiss="alert">x</a>
    <i class="far fa-check-circle"></i>
    The User has been sucessfully unbanned!
    </div>`;
  }

  let item_info = document.querySelector(".user_report");
  let info = item_info.querySelector(".style17");
  item_info.insertBefore(message, info);
}

function banAuctionRequest() {
  let parent = this.closest("#auctionsReported");
  let checkBox = parent.querySelector(".banAuction");

  let id = this.closest('.auctionsReported').getAttribute('data-id');

  if (checkBox.checked == true) {
      console.log("entrei aqui");
      sendAjaxRequest('post', '/banAuction/' + id, null, banAuctionHandler);
  } else {
      console.log("entrei ali");
      sendAjaxRequest('delete', '/unbanAuction/' + id, null, unbanAuctionHandler);
  }

}

function banAuctionHandler() {

  let message = document.createElement('div');
  message.setAttribute('class', 'row');

  if (this.status != 200) {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  Did not ban! Try again! 
  </div>`;
  } else {
      let reportAuction = JSON.parse(this.responseText);

      message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
    <a class="panel-close close" data-dismiss="alert">x</a>
    <i class="far fa-check-circle"></i>
    The Auction has been sucessfully banned!
    </div>`;
  }
  let item_info = document.querySelector(".auctions_report");
  let info = item_info.querySelector(".style17");
  item_info.insertBefore(message, info);
}

function unbanAuctionHandler() {
  let message = document.createElement('div');
  message.setAttribute('class', 'row');

  if (this.status != 200) {
      message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="fas fa-bell"></i>
  Did not unban! Try again! 
  </div>`;
  } else {
      let reportAuction = JSON.parse(this.responseText);

      message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
    <a class="panel-close close" data-dismiss="alert">x</a>
    <i class="far fa-check-circle"></i>
    The Auction has been sucessfully unbanned!
    </div>`;
  }
  let item_info = document.querySelector(".auctions_report");
  let info = item_info.querySelector(".style17");
  item_info.insertBefore(message, info);
}

function addFormAddAuctionRequest() {

  let addAuctionForm = document.querySelector(".add_auction");

  let newForm = document.createElement("form");
  newForm.setAttribute('id', 'taskForm');
  newForm.setAttribute('class', 'form-horizontal');
  newForm.setAttribute('method', 'post');

  newForm.innerHTML = `<div class="form-group row">
<div class="col-lg-4">
    <input for="example-text-input" type="text" class="form-control" name="task[]" placeholder="Auction name" />
</div>
<div class="col-lg-2">
    <select for="example-text-input" class="form-control" id="sel1">
        <option>Electronics</option>
        <option>Fashion</option>
        <option>Home & Garden</option>
        <option>Motors</option>
        <option>Music</option>
        <option>Toys</option>
        <option>Daily Deals</option>
        <option>Sporting</option>
        <option>Others</option>
    </select>
</div>
<div class="col-lg-2">
    <input for="example-text-input" type="text" class="form-control" name="task[]" placeholder="Initial price" />
</div>
<div class="col-lg-2 dateContainer" id="add_auction_calendar">
    <div class="input-group-prepend">
        <span class="input-group-text add-on">
            <i class="fas fa-calendar-alt"></i>
        </span>
        <input class="form-control" type="date" id="example-date-input" style="font-size:15px;">
    </div>
</div>
</div>
<div class="form-group row">
<div class="col-lg-4">
    <textarea for="example-text-input" class="form-control" id="exampleTextarea" rows="3" placeholder="Description"></textarea>
</div>
<div class="col-lg-4">
    <!-- image-preview-filename input [CUT FROM HERE]-->
    <div class="input-group image-preview">
        <input type="text" class="form-control image-preview-filename" disabled="disabled">
        <!-- don't give a name === doesn't send on POST/GET -->
        <span class="input-group-btn">
            <!-- image-preview-clear button -->
            <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                <span class="glyphicon glyphicon-remove"></span> Clear
            </button>
            <!-- image-preview-input -->
            <div class="btn btn-default image-preview-input">
                <div class="input-group-prepend">
                    <span>
                        <i class="fas fa-folder-open"></i>
                    </span>
                    <span class="image-preview-input-title">Add an image</span>
                    <input type="file" accept="image/png, image/jpeg, image/gif" name="input-file-preview" />
                    <!-- rename it -->
                </div>
            </div>
        </span>
    </div>
    <!-- /input-group image-preview [TO HERE]-->
</div>
</div>
<div class="form-group" id="add_auction_buttons">
<button class="btn" style="font-size:16px;background-color:#437ab2; color:white" type="submit">Start auction</button>
<button class="btn minus" style="font-size:16px;background-color:#437ab2; color:white">
<i class="fas fa-minus"></i>
</button>
</div>
</div>
</div>
</div>

`;

  addAuctionForm.appendChild(newForm);
  let minus = newForm.querySelector(".minus");
  minus.addEventListener('click', deleteForm);
}

function deleteForm() {
  let parent = this.closest("#taskForm");

  parent.remove();
}
addEventListeners();