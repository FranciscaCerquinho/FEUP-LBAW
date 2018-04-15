<?php $__env->startSection('content'); ?>
<div id="error">
    <div id="error_msg">
        <div class ="container">
            <div class ="row justify-content-md-center">
                <div class="col col-lg-1">
                    <h2 class="qOq">404</h2>
                </div>
                <div class="col">
                    <h2 class="pnf">Page not found</h2>
                </div>
            </div>
        </div>
        <p>The page you were looking for couldn't be found</p>
        <hr class="style17" style="color:grey;">
    </div>
    <div id="error_home">
        <button type="submit" onclick="window.location= '<?php echo e(route('auction')); ?>'">Go to home page </button>
    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>