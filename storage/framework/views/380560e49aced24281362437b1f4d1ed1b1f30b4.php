<div class="row product align-items-center itemWishList" data-id="<?php echo e($wishList->wishlist_id); ?>">
  <div class="col-sm-2">
    <a href="<?php echo e(route('item', ['id'=>$wishList->auction_id])); ?>">
        <img src="/images/<?php echo e($wishList->auctionphoto); ?>" alt="auctionPhoto" class="img-fluid z-depth-0">
    </a>
  </div>
  <div class="col-sm-3">
      <h5 class="mt-3">
          <strong><?php echo e($wishList->name); ?></strong>
      </h5>
  </div>
  <div class="col-sm-2">
    <a class="owner_name" href="<?php echo e(route('ownerProfile', ['id'=>$wishList->user_id])); ?>"><?php echo e($wishList->firstname); ?> <?php echo e($wishList->lastname); ?></a>
  </div>
  <div class="col-sm-2">
      <strong>EUR <?php echo e($wishList->actualprice); ?></strong>
  </div>
  <div class="col-sm-2" > <script>SplitDate("<?php echo e($wishList->dateend); ?>",1);</script> left</div>
  <div class="col-sm-1">
      <button type="button" class="btn btn-sm btn-danger remove_from_wishlist" data-toggle="tooltip" data-placement="top" title="Remove item">
        <i class="fas fa-trash-alt"></i>
      </button>
  </div>
</div>
<hr class="style17 wishListHr" style="color:grey;">
