
<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Marketplace'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> NFT Marketplace <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?>Marketplace <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>

<div class="row row-cols-xl-5 row-cols-lg-3 row-cols-md-2 row-cols-1">
    <div class="col">
        <div class="card explore-box card-animate">
            <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
            </div>
            <div class="explore-place-bid-img">
                <img src="<?php echo e(URL::asset('assets/images/nft/img-02.jpg')); ?>" alt="" class="card-img-top explore-img" />
                <div class="bg-overlay"></div>
                <div class="place-bid-btn">
                    <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> Place Bid</a>
                </div>
            </div>
            <div class="card-body">
                <p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> 23.63k </p>
                <h5 class="mb-1"><a href="apps-nft-item-details">The Chirstoper</a></h5>
                <p class="text-muted mb-0">Music</p>
            </div>
            <div class="card-footer border-top border-top-dashed">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 fs-14">
                        <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Highest: <span class="fw-medium">412.30ETH</span>
                    </div>
                    <h5 class="flex-shrink-0 fs-14 text-primary mb-0">394.7 ETH</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card explore-box card-animate">
            <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
            </div>
            <div class="explore-place-bid-img">
                <img src="<?php echo e(URL::asset('assets/images/nft/gif/img-2.gif')); ?>" alt="" class="card-img-top explore-img" />
                <div class="bg-overlay"></div>
                <div class="place-bid-btn">
                    <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> Place Bid</a>
                </div>
            </div>
            <div class="card-body">
                <p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> 94.1k </p>
                <h5 class="mb-1"><a href="apps-nft-item-details">Trendy Fashion Portraits</a></h5>
                <p class="text-muted mb-0">3d Style</p>
            </div>
            <div class="card-footer border-top border-top-dashed">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 fs-14">
                        <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Highest: <span class="fw-medium">674.92 ETH</span>
                    </div>
                    <h5 class="flex-shrink-0 fs-14 text-primary mb-0">563.81 ETH</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card explore-box card-animate">
            <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
            </div>
            <div class="explore-place-bid-img">
                <img src="<?php echo e(URL::asset('assets/images/nft/img-04.jpg')); ?>" alt="" class="card-img-top explore-img" />
                <div class="bg-overlay"></div>
                <div class="place-bid-btn">
                    <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> Place Bid</a>
                </div>
            </div>
            <div class="card-body">
                <p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> 34.12k </p>
                <h5 class="mb-1"><a href="apps-nft-item-details">Smillevers Crypto</a></h5>
                <p class="text-muted mb-0">Crypto Card</p>
            </div>
            <div class="card-footer border-top border-top-dashed">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 fs-14">
                        <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Highest: <span class="fw-medium">41.658 ETH</span>
                    </div>
                    <h5 class="flex-shrink-0 fs-14 text-primary mb-0">34.81 ETH</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card explore-box card-animate">
            <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
            </div>
            <div class="explore-place-bid-img">
                <img src="<?php echo e(URL::asset('assets/images/nft/gif/img-4.gif')); ?>" alt="" class="card-img-top explore-img" />
                <div class="bg-overlay"></div>
                <div class="place-bid-btn">
                    <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> Place Bid</a>
                </div>
            </div>
            <div class="card-body">
                <p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> 15.93k </p>
                <h5 class="mb-1"><a href="apps-nft-item-details">Evolved Reality</a></h5>
                <p class="text-muted mb-0">Video</p>
            </div>
            <div class="card-footer border-top border-top-dashed">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 fs-14">
                        <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Highest: <span class="fw-medium">2.75ETH</span>
                    </div>
                    <h5 class="flex-shrink-0 fs-14 text-primary mb-0">3.167 ETH</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card explore-box card-animate">
            <div class="bookmark-icon position-absolute top-0 end-0 p-2">
                <button type="button" class="btn btn-icon active" data-bs-toggle="button" aria-pressed="true"><i class="mdi mdi-cards-heart fs-16"></i></button>
            </div>
            <div class="explore-place-bid-img">
                <img src="<?php echo e(URL::asset('assets/images/nft/img-01.jpg')); ?>" alt="" class="card-img-top explore-img" />
                <div class="bg-overlay"></div>
                <div class="place-bid-btn">
                    <a href="#!" class="btn btn-success"><i class="ri-auction-fill align-bottom me-1"></i> Place Bid</a>
                </div>
            </div>
            <div class="card-body">
                <p class="fw-medium mb-0 float-end"><i class="mdi mdi-heart text-danger align-middle"></i> 14.85k </p>
                <h5 class="mb-1"><a href="apps-nft-item-details">Abstract Face Painting</a></h5>
                <p class="text-muted mb-0">Collectibles</p>
            </div>
            <div class="card-footer border-top border-top-dashed">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 fs-14">
                        <i class="ri-price-tag-3-fill text-warning align-bottom me-1"></i> Highest: <span class="fw-medium">122.34ETH</span>
                    </div>
                    <h5 class="flex-shrink-0 fs-14 text-primary mb-0">97.8 ETH</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end row-->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\projects\mastergym\resources\views/gyms.blade.php ENDPATH**/ ?>