
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Marketplace'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> NFT Marketplace <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>Marketplace <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

    <?php if(!$gyms->isEmpty()): ?>
        <div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">
            <?php $__currentLoopData = $gyms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gym): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col">
                    <div class="card explore-box card-animate">
                        <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                            <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
                        </div>
                        <div class="explore-place-bid-img">
                            <img src="<?php echo e(URL::asset('assets/images/gyms/'.$gym->gym_img.'.'.$gym->ext )); ?>" alt="" class="card-img-top explore-img" />
                            <div class="bg-overlay"></div>
                            <div class="place-bid-btn">
                                <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> View</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-1"><a href="apps-nft-item-details"><?php echo e($gym->gym_name); ?></a></h5>
                            <p class="text-muted mb-0">Main</p>
                        </div>
                        <div class="card-footer border-top border-top-dashed">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 fs-14">
                                    <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Tottale Membres: 
                                </div>
                                <h5 class="flex-shrink-0 fs-14 text-primary mb-0">3500</h5>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php else: ?>
        <div class="row row-cols-lg-3 row-cols-md-2 row-cols-1">
            <div class="col-lg-12">
                <div class="card overflow-hidden shadow-none">
                    <div class="card-body bg-soft-success text-success fw-semibold d-flex">
                        <marquee class="fs-14">
                            No Gym yet
                        </marquee>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\projects\mastergym\resources\views/dashboard/gyms.blade.php ENDPATH**/ ?>