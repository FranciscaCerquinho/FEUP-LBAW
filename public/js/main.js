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

    if(window.location == '/auctions'){
        console.log("aqui");
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
}

inactiveAuctionRequest();

function inactiveAuctionHandler(){

    let auction = JSON.parse(this.responseText);

    let id = document.querySelector('div.auctions-list[data-id="' + auction.auction_id + '"]');

    id.remove();

    clearInterval(myVar);
    myVar = setInterval(myTimerHomePage, 1000);
}