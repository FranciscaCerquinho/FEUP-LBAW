$(function () {

  $('#login-form-link').click(function (e) {
    $("#login-form").delay(100).fadeIn(100);
    $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });
  $('#register-form-link').click(function (e) {
    $("#register-form").delay(100).fadeIn(100);
    $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
  });

});
function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k){
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

function addEventListeners(){

  let addComment = document.querySelector(".leave_comment .status-upload button");
  if(addComment){
    addComment.addEventListener('click',sendCommentRequest);
  }

  let addLike = document.querySelector("#item #likeButton");
  if(addLike){
    addLike.addEventListener('click',sendAuctionLikeRequest);
  }

  let addUnlike = document.querySelector("#item #unlikeButton");
  if(addUnlike){
    addUnlike.addEventListener('click',sendAuctionUnlikeRequest);
  }

  let addCommentLike = document.querySelectorAll("#comments #commentLike");
  if(addCommentLike){
    for(var i=0; i < addCommentLike.length;i++)
      addCommentLike[i].addEventListener('click',sendCommentLikeRequest);
  }

  let addCommentUnlike = document.querySelectorAll("#comments #commentUnlike");
  if(addCommentUnlike){
    for(var i=0; i < addCommentUnlike.length;i++)
      addCommentUnlike[i].addEventListener('click',sendCommentUnlikeRequest);
  }

  let makeBid = document.querySelector("#bid_buttons #bid button");
  if(makeBid){
    makeBid.addEventListener('click',sendBidRequest);
  }
};

function sendCommentRequest(){
  let text = document.querySelector(".leave_comment .status-upload textarea").value;
  let id = this.closest('section#item').getAttribute('data-id');

  if(text != '')
    sendAjaxRequest('post','/comment/' + id,{comment: text}, addCommentHandler);
};

function addCommentHandler(){
 
  if(this.status!=200) window.location = '/';
  let newComment = JSON.parse(this.responseText);
 
  let comment = document.createElement('div');
  comment.setAttribute('class','row');
  let date =SplitDateReturn(newComment.date);
                  
comment.innerHTML = `
  <div id="comments">
  <div class="container">
      <div class="row">
          <div class="col-sm-8">
              <div class="panel panel-white post panel-shadow">
                  <div class="post-heading">
                      <div class="pull-left image">
                          <img src="${newComment.url}" class="img-circle avatar" alt="user profile image">
                      </div>
                      <div class="pull-left meta">
                          <div class="comment_owner">
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
                          <a href="#" class="btn stat-item">
                              <i class="far fa-thumbs-up"></i>${newComment.like}
                          </a>
                          <a href="#" class="btn stat-item">
                              <i class="far fa-thumbs-down"></i>${newComment.dislike}
                          </a>
                          <a href="#" class="btn btn-sm stat-item" style="padding:6px;">
                              <i class="fas fa-bullhorn"></i>Report
                          </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>`;
  let comments = document.querySelector("#first .row #comments");

  let commentBox = document.querySelector("#addComment");

  comments.insertBefore(comment,commentBox);
}


function sendAuctionLikeRequest(){
    let like = document.querySelector("#buttons #likeAuction").textContent;
    like = parseInt(like) +1;

    let id = this.closest('section#item').getAttribute('data-id');

    if(like != '')
      sendAjaxRequest('post','/likeAuction/' + id,{like: like}, addAuctionLikeHandler);
}

function addAuctionLikeHandler(){
 
  if(this.status!=200) window.location = '/';
  let newLike = JSON.parse(this.responseText);

    console.log(newLike);
  let like = document.querySelector("#item #likeAuction");
  console.log('aqui'+like);
  like.innerHTML= newLike.auction_like;

  let unlike = document.querySelector("#item #unlikeAuction");

  unlike.innerHTML= newLike.auction_dislike;

  document.getElementById('like_hand').style='color: #437ab2;';
  like.style='color: #437ab2;';


  document.getElementById('unlike_hand').style='color: black;';
  unlike.style='color: black;';
  
}


function sendAuctionUnlikeRequest(){
    let unlike = document.querySelector("#buttons #unlikeAuction").textContent;
    unlike = parseInt(unlike)+1;

    let id = this.closest('section#item').getAttribute('data-id');

    if(unlike != '')
      sendAjaxRequest('post','/unlikeAuction/' + id,{unlike: unlike}, addAuctionUnlikeHandler);
}

function addAuctionUnlikeHandler(){
 
    if(this.status!=200) window.location = '/';
    let newUnlike = JSON.parse(this.responseText);
  
    let unlike = document.querySelector("#item #unlikeAuction");

    unlike.innerHTML= newUnlike.auction_dislike;


    let like = document.querySelector("#item #likeAuction");
   
    like.innerHTML= newUnlike.auction_like;
  

    document.getElementById('unlike_hand').style='color: #437ab2;';
    unlike.style='color: #437ab2;';
  
  
    document.getElementById('like_hand').style='color: black;';
    like.style='color: black;';
  }

  function sendCommentLikeRequest(){
    let like = document.querySelector("#commentLike").textContent;
    like = parseInt(like) +1;

    let id = this.closest('div.buttonsComments').getAttribute('data-id');

    if(like != '')
      sendAjaxRequest('post','/likeComment/' + id,{like: like}, addCommentLikeHandler);
}

function addCommentLikeHandler(){
 
  if(this.status!=200) window.location = '/';
  let newLike = JSON.parse(this.responseText);

  let stats = document.querySelector('div.buttonsComments[data-id="'+newLike.id+'"]');
  let like= stats.querySelector("#likeComment");

  like.innerHTML= newLike.like;

  let unlike = stats.querySelector("#unlikeComment");

  unlike.innerHTML= newLike.dislike;

  stats.querySelector('#likeCommentHand').style='color: #437ab2;';
  like.style='color: #437ab2;';


  stats.querySelector('#unlikeCommentHand').style='color: black;';
  unlike.style='color: black;';
  
}



function sendCommentUnlikeRequest(){
    let unlike = document.querySelector("#commentUnlike").textContent;
    unlike = parseInt(unlike)+1;

    let id = this.closest('div.buttonsComments').getAttribute('data-id');

    if(unlike != '')
      sendAjaxRequest('post','/unlikeComment/' + id,{unlike: unlike}, addCommentUnlikeHandler);
}

function addCommentUnlikeHandler(){
    if(this.status!=200) window.location = '/';
    let newUnlike = JSON.parse(this.responseText);

    let stats = document.querySelector('div.buttonsComments[data-id="'+newUnlike.id+'"]');
    let unlike = stats.querySelector("#unlikeComment");

    unlike.innerHTML= newUnlike.dislike;


    let like = stats.querySelector("#likeComment");
   
    like.innerHTML= newUnlike.like;
  
    stats.querySelector('#unlikeCommentHand').style='color: #437ab2;';
    unlike.style='color: #437ab2;';
  
  
    stats.querySelector('#likeCommentHand').style='color: black;';
    like.style='color: black;';
  }
  

  function sendBidRequest(){
    let bid = document.querySelector("#bid_buttons #price_button").value;
  
    let id = this.closest('section#item').getAttribute('data-id');

    if(bid != '')
      sendAjaxRequest('post','/makeBid/' + id,{bid: bid}, makeBidHandler);
}

function makeBidHandler(){
 
  if(this.status!=200) window.location = '/';
  let newBid = JSON.parse(this.responseText);

  let bid = document.querySelector("#item_price");
  bid.innerHTML = 'EUR '+ newBid.price;

  let message = document.createElement('div');
  message.setAttribute('class','row');
                  
  message.innerHTML = `<div class="alert alert-success alert-dismissable" role="alert">
  <a class="panel-close close" data-dismiss="alert">x</a>
  <i class="far fa-check-circle"></i>
  Bet made! The auction has been added to your bids, you will receive a warning if you are the winner
</div>`;
  
let item_info = document.querySelector("#item_information");

let info = document.querySelector("#info");

item_info.insertBefore(message,info);
}

addEventListeners();