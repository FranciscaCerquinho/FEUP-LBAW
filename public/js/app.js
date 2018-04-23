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

function addEventListeners(){

  let addComment = document.querySelector(".leave_comment .status-upload button");
  if(addComment){
    addComment.addEventListener('click',sendCommentRequest);
  }
};

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

function sendCommentRequest(){
  let text = document.querySelector(".leave_comment .status-upload textarea").value;
  let id = this.closest('section#item').getAttribute('data-id');
  console.log(text);
  if(text != '')
    sendAjaxRequest('post','/comment/' + id,{comment: text}, addCommentHandler);
};

function addCommentHandler(){
  console.log(this.responseText);
  if(this.status!=200) window.location = '/';
  let newComment = JSON.parse(this.responseText);
  console.log("newComment",newComment);
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

addEventListeners();