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


$(function () {
    $('#datetimepicker1').datetimepicker({
        format: "DD/MM/YYYY HH:mm"
    })
});

$("#photo").on('change', function(){
    document.getElementById("imageName").value=document.getElementById("photo").value;
})

$(function () {
    $('#datetimepicker1').datetimepicker({
        format: "DD/MM/YYYY HH:mm"
    })
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

var myVar = setInterval(myTimer, 30000);

function myTimer() {
    let timers = document.querySelectorAll("#item .time_left");
    let i = 0;
    for(i = 0; i < timers.length; i++) {
        let id = timers[i].closest("div#item").getAttribute("data-id");
        sendAjaxRequest('post', '/auctionTime/' + id, null, auctionTimeHandler);
    }
}

function auctionTimeHandler(){

    if (this.status != 200) window.location = '/';

    var auction = JSON.parse(this.responseText);
    var date = SplitDateReturn(auction.dateend,1);

    let id = document.querySelector('div#item[data-id="' + auction.auction_id + '"]');

    let timer = id.querySelector(".time_left");

    timer.innerHTML = date + " left";
}

var myVar = setInterval(myTimerHomePage, 30000);

function myTimerHomePage() {
    let timers = document.querySelectorAll(".new_auctions .auctionTimeLeft");
    let i = 0;
    for(i = 0; i < timers.length; i++) {
        let id = timers[i].closest("div.auctions-list").getAttribute("data-id");
        sendAjaxRequest('post', '/auctionTime/' + id, null, auctionsHomePageHandler);
    }
}

function auctionsHomePageHandler(){

    if (this.status != 200) window.location = '/';

    var auction = JSON.parse(this.responseText);
    var date = SplitDateReturn(auction.dateend,1);

    let id = document.querySelector('div.auctions-list[data-id="' + auction.auction_id + '"]');

    let timer = id.querySelector(".auctionTimeLeft");

    let timer_split = timer.innerHTML.split("</script>");
        
    if(timer_split[1] != null){
        let split = timer_split[1].split(" ");
        var int = parseInt(split[0]);
            if(int<=0){
                sendAjaxRequest('post', '/inactiveAuction/' + id, null, inactiveAuctionHandler);
            }
        
        
    }
    timer.innerHTML = date + " left";
}
function inactiveAuctionRequest(){
    let timers = document.querySelectorAll(".new_auctions .auctionTimeLeft");
    let i = 0;
    for(i = 0; i < timers.length; i++) {
        let id = timers[i].closest("div.auctions-list").getAttribute("data-id");

        let idAux = document.querySelector('div.auctions-list[data-id="' + id + '"]');
   
        let timer = idAux.querySelector(".auctionTimeLeft");
       
        let timer_split = timer.innerHTML.split("</script>");

        if(timer_split[1] != null){
            let split = timer_split[1].split(" ");
            var int = parseInt(split[0]);     
                if(int<=0){
                    sendAjaxRequest('post', '/inactiveAuction/' + id, null, inactiveAuctionHandler);
                }
            
            
        }
    }   
}

inactiveAuctionRequest();

function inactiveAuctionHandler(){

    let auction = JSON.parse(this.responseText);

    let id = document.querySelector('div.auctions-list[data-id="' + auction.auction_id + '"]');

    id.remove();

    clearInterval(myVar);
    myVar = setInterval(myTimerHomePage, 1000);
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

  let addCommentLike = document.querySelectorAll(".comment .commentLike");
  if (addCommentLike) {
      for (var i = 0; i < addCommentLike.length; i++)
          addCommentLike[i].addEventListener('click', sendCommentLikeRequest);
  }

  let addCommentUnlike = document.querySelectorAll(".comment .commentUnlike");
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

  let reportAuction = document.querySelector("#reportButton .btn");
  if (reportAuction) {
      reportAuction.addEventListener('click', reportAuctionRequest);
  }

  let reportUser = document.querySelectorAll(".comment .popup-reportUser .reportUserButton");
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

  let searchCategory = document.querySelectorAll("#searchPage .form-check");
  if (searchCategory) {
    for (var i = 0; i < searchCategory.length; i++)
        searchCategory[i].addEventListener('click', searchCategoryRequest);
  }

  let ownerInput = document.querySelector('#owner-input');
  if (ownerInput) {
    ownerInput.addEventListener('input',searchCategoryOwnerFilter);
  }


  let removeFromWishList = document.querySelectorAll(".remove_from_wishlist");
  if (removeFromWishList) {
    for(var n = 0; n < removeFromWishList.length;n++){
      removeFromWishList[n].addEventListener('click', removeFromWishListAction);
    }
  }

  let reportOwner = document.querySelector(".user_infomation .popup-reportUser .reportUserButton");
  if(reportOwner)
    reportOwner.addEventListener('click', reportOwnerRequest);

  let addToWishList = document.querySelector("#addToWishList");
  if(addToWishList)
      addToWishList.addEventListener('click',addToWishListAction);
      
  let endAuction = document.querySelectorAll(".endAuctions .endAuction");
  if(endAuction){
    for (var i = 0; i < endAuction.length; i++)
        endAuction[i].addEventListener('click', endAuctionRequest);
  }

  let deleteComment = document.querySelectorAll(".deleteComment");
  if(deleteComment){
    for (var i = 0; i < deleteComment.length; i++)
        deleteComment[i].addEventListener('click', deleteCommentRequest);
  }

};

function addToWishListAction(){
  let id_auction = this.closest('div#item').getAttribute('data-id');
  sendAjaxRequest('post','/addToWishList/' + id_auction,null,addToWishListHandler);

}

function addToWishListHandler(){

  if (this.status != 200) {
    let modal = document.getElementById('messageModal');
    modal.click();

    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-bell"></i> Unsucess`;
    document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  Failed to add the item to wishlist! Try again!`;
  } else {
      let addToWishList = JSON.parse(this.responseText);

      if(addToWishList.message=='You have to login! &nbsp'){
        let modal = document.getElementById('messageModal');
        modal.click();
    
        let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i>  Sucess`;
     document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
        let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `${addToWishList.message}`;
    
       }
       else{
        let modal = document.getElementById('messageModal');
        modal.click();
    
        let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i> Sucess`;
     document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
        let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `The Item has been had to the wishlist!`;
      
        document.querySelector('#addToWishList').style = 'border: 2px solid #86939E; outline: none;';
       }

  }


}

function removeFromWishListAction(){
    let id = this.closest('.itemWishList').getAttribute('data-id');
    sendAjaxRequest('delete', '/deleteFromWishList/' + id ,null,deleteFromWishListHandler);
};

function deleteFromWishListHandler(){

    if (this.status != 200) window.location = '/';
    let parent = document.querySelector('.itemWishList');
    let hr = document.querySelector(".wishListHr");
    parent.remove();
    hr.remove();

    let total= document.querySelector('#totalWishList');
    let value = total.textContent;
    total.innerHTML = value-1;

};

function sendCommentRequest() {
  let text = document.querySelector(".leave_comment .status-upload textarea").value;
  let id = this.closest('div#item').getAttribute('data-id');

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
  let date = SplitDateReturn(newComment.date,0);

  comment.innerHTML = `<div class="panel panel-white post panel-shadow">
    <div class="post-heading">
        <div class="pull-left image">
                <img src="${newComment.url}" class="img-circle avatar" alt="user profile image">
        </div>
        <div class="pull-left meta">
            <div class="title h5">
                <b>${newComment.user.firstname} ${newComment.user.lastname}</b>
            </div>
            <h6 class="text-muted time"> ${date} ago</h6>
        </div>
    </div> 
    <div class="post-description"> 
        <p>${newComment.comment}</p>
        <div class="stats">
                <a class="btn stat-item commentLike">
                    <span  class="fa fa-thumbs-up icon likeCommentHand"></span>
                    <span  class ="likeComment">${newComment.like}</span>
                </a>
                <a class="btn stat-item commentUnlike">
                    <span class="fa fa-thumbs-down icon unlikeCommentHand"></span>
                    <span  class ="unlikeComment">${newComment.dislike}</span>
                </a>
            <button  data-popup-reportUser-open="popup-1" type="button" class="reportA"><span class="reportUserButton fas fa-bullhorn"></span> Report</button>
            <div class="popup-reportUser" data-popup-reportUser="popup-1" data-id="{{$comment->user_id}}">
                <div class="popup-inner-reportUser" data-id="{{$comment->id}}">
                    <div class="form-group userForm" >
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-comment-alt" aria-hidden="true"></i>
                            </span>
                            <input type="text" class="form-control reportUserText" name="reason" placeholder="Reason" />
                        </div>
                    </div>
                    <div class="row reportUserButton" >
                            <div class="col-6 col-xl-5 col-lg-6 col-sm-6 col-md-8 buttonReport" >
                                <div class="text-center">
                                    <a role="button" target="_blank"  class="btn btn-primary btn-lg btn-block">Report</a>
                                </div>
                            </div>
                        </div>
                    <a class="popup-close-reportUser" data-popup-close-reportUser="popup-1">X</a>
                </div>
            </div>
        </div>
    </div>
    </div>`;

  let comments = document.querySelector(".comments .row");

  let commentBox = document.querySelector("#addComment");

  comments.insertBefore(comment, commentBox);

  let text = document.querySelector(".leave_comment .status-upload textarea");

  text.value= "";

  comment.querySelector(".commentLike").addEventListener('click',sendCommentLikeRequest);
  comment.querySelector(".commentUnlike").addEventListener('click',sendCommentUnlikeRequest);
  //comment.querySelector(".popup-reportUser .reportUserButton").addEventListener('click',reportUserRequest);
}


function sendAuctionLikeRequest() {
  let like = document.querySelector(".cable-choose #likeAuction").textContent;
  like = parseInt(like) + 1;

  let id = this.closest('div#item').getAttribute('data-id');

  if (like != '')
      sendAjaxRequest('post', '/likeAuction/' + id, {
          like: like
      }, addAuctionLikeHandler);
}

function addAuctionLikeHandler() {

  if (this.status != 200) window.location = '/';
  let newLike = JSON.parse(this.responseText);

  if(newLike.message!='You have to login! &nbsp'){

  let like = document.querySelector("#item #likeAuction");

  like.innerHTML = newLike.auction_like;

  let unlike = document.querySelector("#item #unlikeAuction");

  unlike.innerHTML = newLike.auction_dislike;

  document.getElementById('likeButton').style = 'border: 2px solid #86939E; outline: none;';


  document.getElementById('unlikeButton').style = 'border:none';
 
}
}


function sendAuctionUnlikeRequest() {
  let unlike = document.querySelector(".cable-choose #unlikeAuction").textContent;
  unlike = parseInt(unlike) + 1;

  let id = this.closest('div#item').getAttribute('data-id');

  if (unlike != '')
      sendAjaxRequest('post', '/unlikeAuction/' + id, {
          unlike: unlike
      }, addAuctionUnlikeHandler);
}

function addAuctionUnlikeHandler() {

  if (this.status != 200) window.location = '/';
  let newUnlike = JSON.parse(this.responseText);

  if(newUnlike.message!='You have to login! &nbsp'){

  let unlike = document.querySelector("#item #unlikeAuction");

  unlike.innerHTML = newUnlike.auction_dislike;


  let like = document.querySelector("#item #likeAuction");

  like.innerHTML = newUnlike.auction_like;

  document.getElementById('unlikeButton').style = 'border: 2px solid #86939E; outline: none;';
  document.getElementById('likeButton').style = 'border:none';
  }
}

function sendCommentLikeRequest() {
  let like = this.closest(".commentLike").textContent;
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
  let like = stats.querySelector(".likeComment");

  like.innerHTML = newLike.like;

  let unlike = stats.querySelector(".unlikeComment");

  unlike.innerHTML = newLike.dislike;

  stats.querySelector('.likeCommentHand').style = 'color: #437ab2;';
  like.style = 'color: #437ab2;';


  stats.querySelector('.unlikeCommentHand').style = 'color: #5E6977;';
  unlike.style = 'color: black;';

}



function sendCommentUnlikeRequest() {
 
  let unlike = this.closest(".commentUnlike").textContent;
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
  let unlike = stats.querySelector(".unlikeComment");

  unlike.innerHTML = newUnlike.dislike;


  let like = stats.querySelector(".likeComment");

  like.innerHTML = newUnlike.like;

  stats.querySelector('.unlikeCommentHand').style = 'color: #437ab2;';
  unlike.style = 'color: #437ab2;';


  stats.querySelector('.likeCommentHand').style = 'color: #5E6977;';
  like.style = 'color: black;';
}


function sendBidRequest() {
  let bid = document.querySelector("#bid_buttons #price_button").value;

  let id = this.closest('div#item').getAttribute('data-id');

  if (bid != '')
      sendAjaxRequest('post', '/makeBid/' + id, {
          bid: bid
      }, makeBidHandler);
}

function makeBidHandler() {

  if (this.status != 200) window.location = '/';
    

  let newBid = JSON.parse(this.responseText);

  if (newBid.message != 'You have to login! &nbsp') {

      if (newBid.message != 'Bid lower than the actual price! &nbsp') {
          let bid = document.querySelector("#item_price");
          bid.innerHTML = 'EUR ' + newBid.price;

        let modal = document.getElementById('messageModal');
        modal.click();

        let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i> Sucess`;
     document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
        let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML = "Bet made! The auction has been added to your bids, you will receive a warning if you are the winner";

      } else {

        let modal = document.getElementById('messageModal');
        modal.click();

        let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= ` <i class="fas fa-bell"></i> Unsucess`;
        let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `${newBid.message}`;
        document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
      }
  } else {
      
    let modal = document.getElementById('messageModal');
    modal.click();

    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-bell"></i> Unsucess`;
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `${newBid.message}`;
    document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
  }
}

function sendBuyNowRequest() {

  let id = this.closest('div#item').getAttribute('data-id');

  sendAjaxRequest('post', '/buyNow/' + id, null, buyNowHandler);
}

function buyNowHandler() {

    if (this.status != 200)  window.location = '/';

    else if(JSON.parse(this.responseText).message=='You have to login! &nbsp'){
    
        let modal = document.getElementById('messageModal');
        modal.click();


        let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= "You have to login!";
        let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-bell"></i> Unsucess`;
        document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
    }
    else{

    let buyNow = JSON.parse(this.responseText);

    let modal = document.getElementById('messageModal');
    modal.click();

    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i> Sucess`;
    document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= "The auction is yours! Congratulations! The owner will contact you.";

    }
}

function reportAuctionRequest() {

  let reason = document.querySelector("#reportAuctionText").value;

  let id = this.closest('div#item').getAttribute('data-id');

  sendAjaxRequest('post', '/reportAuction/' + id, {
      reason: reason
  }, reportAuctionHandler);
}

function reportAuctionHandler() {

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

      document.querySelector('.buttonReport').style = 'border: 2px solid #86939E; outline: none;';

  }
 
  let item_info = document.querySelector(".popup-inner-reportAuction");

  let info = document.querySelector("#auctionForm");

  item_info.insertBefore(message, info);
}

function reportUserRequest() {
  let parent = this.closest(".comment");
  let reason = parent.querySelector(".reportUserText").value;
  let id = this.closest('.popup-reportUser').getAttribute('data-id');
  let commentID = this.closest('.popup-inner-reportUser').getAttribute('data-id');

  sendAjaxRequest('post', '/reportUser/' + id, {
      reason: reason,
      commentID: commentID
  }, reportUserHandler);
}

function reportUserHandler() {

    let message = document.createElement('div');
    message.setAttribute('class', 'row');

    if (this.status != 200)  window.location = '/';
    else{
        let reportUser = JSON.parse(this.responseText);

        message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
        <a class="panel-close close" data-dismiss="alert">x</a>
        <i class="far fa-check-circle"></i>
        The User has been sucessfully reported!
        </div>`;
    
        let item_info = document.querySelector('.popup-inner-reportUser[data-id="' + reportUser.commentID + '"]');

        let info = item_info.querySelector(".userForm");

        item_info.insertBefore(message, info);
    }
}

function reportOwnerRequest(){

    let reason = document.querySelector(".user_infomation .reportUserText").value;
    let id = this.closest('.popup-reportUser').getAttribute('data-id');

  sendAjaxRequest('post', '/reportOwner/' + id, {
      reason: reason
  }, reportOwnerHandler);
}

function reportOwnerHandler(){
    let message = document.createElement('div');
    message.setAttribute('class', 'row');

    if (this.status != 200) {
        message.innerHTML = `<div class="alert alert-danger alert-dismissable" role="alert">
        <a class="panel-close close" data-dismiss="alert">x</a>
        <i class="fas fa-bell"></i>
        Did not report! Try again!
        </div>`;
    }
    else{
        let reportAuction = JSON.parse(this.responseText);

        message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
        <a class="panel-close close" data-dismiss="alert">x</a>
        <i class="far fa-check-circle"></i>
        The User has been sucessfully reported!
        </div>`;
    }
    let item_info = document.querySelector('.popup-inner-reportUser');

    let info = item_info.querySelector(".userForm");

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

    let modal = document.getElementById('messageModal');
    modal.click();
  if (this.status != 200) {
  
    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-bell"></i> Unsucess`;
    document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  Did not ban. Try again!`;
  } else {
      let reportAuction = JSON.parse(this.responseText);

    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i> Sucess`;
 document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  The User has been sucessfully banned!`;
    
  }

}

function unbanUserHandler() {

    let modal = document.getElementById('messageModal');
    modal.click();

  if (this.status != 200) {
    
    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-bell"></i> Unsucess`;
    document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  Did not unban. Try again!`;
  } else {

    let reportAuction = JSON.parse(this.responseText);
    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i> Sucess`;
 document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  The User has been sucessfully unbanned!`;
  }
}

function banAuctionRequest() {
  let parent = this.closest("#auctionsReported");
  let checkBox = parent.querySelector(".banAuction");

  let id = this.closest('.auctionsReported').getAttribute('data-id');

  if (checkBox.checked == true) {
      sendAjaxRequest('post', '/banAuction/' + id, null, banAuctionHandler);
  } else {
      sendAjaxRequest('delete', '/unbanAuction/' + id, null, unbanAuctionHandler);
  }

}

function banAuctionHandler() {


    let modal = document.getElementById('messageModal');
    modal.click();

  if (this.status != 200) {
    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-bell"></i> Unsucess`;
    document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  Did not ban. Try again!`;
  } else {
      let reportAuction = JSON.parse(this.responseText);

    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i> Sucess`;
 document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  The Auction has been sucessfully banned!`;
  }

}

function unbanAuctionHandler() {

    let modal = document.getElementById('messageModal');
    modal.click();

  if (this.status != 200) {
    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-bell"></i> Unsucess`;
    document.querySelector('#exampleModal .modal-title').style= "color:rgb(203,91,84)";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  Did not unban. Try again!`;
  } else {
    let reportAuction = JSON.parse(this.responseText);

    let modalTitle = document.querySelector('#exampleModal .modal-title').innerHTML= `<i class="fas fa-check-circle"></i> Sucess`;
 document.querySelector('#exampleModal .modal-title').style= "color: rgb(115,181,102);";
    let modalMessage = document.querySelector('#exampleModal .modal-body').innerHTML= `  The Auction has been sucessfully unbanned!`;
  }

}

/*function updateImagePathRequest() {
    
    let aux = this.id;
    let aux2 = "#imageName" + aux.slice(-1);
    let aux3 = "#" + aux;
    
    document.querySelector(aux2).value = document.querySelector(aux3).value;
}*/



function searchCategoryRequest(){

    let categoryChecked=[];

    let inputs= document.querySelectorAll("#category_filter .form-check label input");
    let categories= document.querySelectorAll("#category_filter .form-check label span");

    for(var i=0; i < inputs.length;i++){
        if(inputs[i].checked==true){
            categoryChecked.push(categories[i].textContent);
        }
    }

    sendAjaxRequest('post', '/showCategory', {categoryChecked: categoryChecked}, showCategoryHandler);

}

function searchCategoryOwnerFilter() {
    let auctions = document.querySelectorAll(".auction-search-card");
    let owner = document.querySelector("#owner-input").value.toLowerCase();
    let owners = document.querySelectorAll(".owner-name");
    for (var i=0; i < owners.length;i++){
        if(!owners[i].innerHTML.toLowerCase().includes(owner) && owner != ""){
            auctions[i].style.display = "none";
        }
        else {
            auctions[i].style.display = "block";
        }
    }
}

function showCategoryHandler(){

    if (this.status != 200) window.location = '/';

    var auctions = document.querySelector(".searchResults");
    auctions.remove();

    var auctionsArray =JSON.parse(this.responseText);

    let div = document.createElement("div");
    div.setAttribute('class', 'col-lg-9 col-md-8 searchResults');
	let elems_per_row = 3;
	let num_elems = auctionsArray.length;
	let num_rows = Math.ceil(num_elems / elems_per_row);

	for(var i = 0; i < num_rows; i++) {
        let newDiv = document.createElement("div");
        newDiv.setAttribute('class','row');

        	for(var j = 0; j < elems_per_row && num_elems > 0; j++, num_elems--){

                actual_elem = i*elems_per_row + j;


                let date = SplitDateReturn(auctionsArray[actual_elem].dateend,1);

                let auctionDiv = document.createElement("div");
                auctionDiv.setAttribute('class','col-lg-4 col-md-6 mb-4');

                auctionDiv.innerHTML=`<div class="card h-100 auctionCard searchCard">
                    <a href="/auction/${auctionsArray[actual_elem].auction_id}">
                        <img class="card-img-top searchResultImage" src="/images/${auctionsArray[actual_elem].auctionphoto}" alt="auctionPhoto">
                    </a>
                    <div class="card-body searchResultBody">
                        <h5 class="card-title searchResultTitle">
                            <a href="/auction/${auctionsArray[actual_elem].auction_id}">${auctionsArray[actual_elem].name}</a>
                        </h5>
                        <h4 class="auctionPrice">EUR ${auctionsArray[actual_elem].actualprice}</h5>
                        <h6 class="auctionTimeLeft">  ${date} left</h1>
                        <p class="card-text searchResultText">
                        ${auctionsArray[actual_elem].firstname} ${auctionsArray[actual_elem].lastname}
                        </p>
                    </div>
                </div>`;

                newDiv.appendChild(auctionDiv);
            }
            div.appendChild(newDiv);
    }

    let append = document.querySelector("#searchPage .row");
    append.appendChild(div);
}

function endAuctionRequest(){

    let id = this.closest('.endAuctionAlert').getAttribute('data-id');

    sendAjaxRequest('post', '/endAuction/' + id ,null, endAuctionHandler);
}

function endAuctionHandler(){
   
    if (this.status != 200) window.location = '/';
    
    let endAuction = JSON.parse(this.responseText);
    let alert = document.querySelector('div.endAuctionAlert[data-id="' + endAuction.endauction_id + '"]');

    alert.remove();
}

function deleteCommentRequest(){

    let id = this.closest('div.comment').getAttribute('data-id');

    sendAjaxRequest('post', '/deleteComment/' + id ,null, deleteCommentHandler);
}

function deleteCommentHandler(){
    if (this.status != 200) window.location = '/';

    let parent = document.querySelector('.comment');
    parent.remove();
}

addEventListeners();

function onSignIn(googleUser) {
    var profile = googleUser.getBasicProfile();
    
    var id_token = googleUser.getAuthResponse().id_token;
    sendAjaxRequest('post', '/googleLogin' ,{id: id_token,name: profile.getName(), photo: profile.getImageUrl(), email: profile.getEmail()}, googleRegisterHandler);
}

function googleRegisterHandler(){

    if (this.status != 200) window.location = '/';
    
    gapi.load('auth2',function(){
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function(){
            console.log('User signed out .');
            document.getElementById("topnavLogo").click();
        });
    });
    
}
