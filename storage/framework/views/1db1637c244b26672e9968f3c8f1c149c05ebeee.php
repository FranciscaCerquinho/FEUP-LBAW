<div class="col-lg-4 col-md-6 mb-4 auction-search-card">
    <div class="card h-100 auctionCard searchCard">
        <a href="<?php echo e(route('item', ['id'=>$auction->auction_id])); ?>">
            <img class="card-img-top searchResultImage" src="/images/<?php echo e($auction->auctionphoto); ?>" alt="auctionPhoto">
        </a>
        <div class="card-body searchResultBody">
            <h5 class="card-title searchResultTitle">
                <a href="<?php echo e(route('item', ['id'=>$auction->auction_id])); ?>"><?php echo e($auction->name); ?></a>
            </h5>
            <h4 class="auctionPrice">EUR <?php echo e($auction->actualprice); ?></h5>
            <h6 class="auctionTimeLeft"> <script>SplitDate("<?php echo e($auction->dateend); ?>",1);</script> left</h1>
            <p class="card-text searchResultText owner-name">
            <?php echo e($auction->firstname); ?> <?php echo e($auction->lastname); ?>

            </p>
        </div>
    </div>
</div>