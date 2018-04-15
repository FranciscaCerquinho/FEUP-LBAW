<div class="col-lg-3 col-md-4 col-sm-6 mb-4" id="auctions-list">
    <div class="card auctionCard">
    <a href="item.html"  class="text-center" ><img class="card-img-top auctionCardImage" src="/images/<?php echo e($auction->photo); ?>" alt=""></a>
    <div class="card-body auctionCardBody">
        <h4 class="card-title auctionCardTitle">
        <a href="item.html"> <?php echo e($auction->name); ?> </a>
        </h4>
        <h5>EUR <?php echo e($auction->actualprice); ?></h5>
        <h1><?php echo e($auction->dateend); ?></h1>
        <p class="card-text auctionCardText" value= "<?php echo e($auction->id); ?>"></p>
    </div>
    </div>
</div>
