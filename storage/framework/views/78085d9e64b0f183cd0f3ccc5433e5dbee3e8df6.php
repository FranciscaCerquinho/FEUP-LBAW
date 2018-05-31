<?php $date= new DateTime($reported_users->date);
$date_string = $date->format('Y-m-d');?>
<div class="row usersReported" id="usersReported" data-id="<?php echo e($reported_users->id_userreported); ?>">
    <div class="col-md-2 col-sm-3">
        <span style="color:#0c59cf"><?php echo e($reported_users->firstname); ?> <?php echo e($reported_users->lastname); ?></span>
    </div>
    <div class="col-md-2 col-sm-3">
        <span style="color:#0c59cf"><?php echo e($reporting_users->firstname); ?> <?php echo e($reporting_users->lastname); ?></span>
    </div>
    <div class="col-md-4 col-sm-3">
        <span span style="color:#0c59cf"><?php echo e($reported_users->reason); ?></span>
    </div>
    <div class="col-md-2 col-sm-3">
        <span style="color:#0c59cf"><?php echo e($date_string); ?> </span>
    </div>
    <div class="col-md-1 col-sm-3">
        <input class="banUser" type="checkbox"  <?php if($ban==1): ?>checked <?php endif; ?>> Ban </input>
    </div>
</div>