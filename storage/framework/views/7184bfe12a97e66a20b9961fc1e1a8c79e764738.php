<div class="col-lg-6 col-md-6 mb-4">
    <div class="card h-100 auctionCard searchCard">
        <a href="<?php echo e(route('item', ['id'=>$auction->auction_id])); ?>">
            <img class="card-img-top searchResultImage" src="/images/<?php echo e($auction->auctionphoto); ?>" alt="auctionPhoto">
        </a>
        <?php if(isset($auction->price)): ?>
              <div class="sale-box">
                  <span class="on_sale title_shop"><?php echo e($auction->price); ?> €</span>
              </div>
          <?php endif; ?>
        <div class="card-body searchResultBody">
            <h5 class="card-title searchResultTitle">
                <a href="<?php echo e(route('item', ['id'=>$auction->auction_id])); ?>"><?php echo e($auction->name); ?></a>
            </h5>
            <h4 class="auctionPrice">EUR <?php echo e($auction->actualprice); ?></h5>
            <h6 class="auctionTimeLeft"> <script>SplitDate("<?php echo e($auction->dateend); ?>",1);</script> left</h1>
            <p class="card-text searchResultText">
            <?php echo e($auction->firstname); ?> <?php echo e($auction->lastname); ?>

            </p>
        </div>
    </div>
</div>