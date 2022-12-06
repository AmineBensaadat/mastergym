<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Apex_Radialbar_Chart'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Apexcharts <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Apex Radialbar Charts <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Simple Radialbar Chart</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="basic_radialbar" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Multiple Radialbar</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="multiple_radialbar" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Circle Chart - Custom Angle</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="circle_radialbar" data-colors='["--vz-primary", "--vz-info", "--vz-danger", "--vz-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Gradient Circle Chart</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="gradient_radialbar" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Stroked Circle Chart</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="stroked_radialbar" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Radialbars with Image</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="radialbar_with_img" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->

<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Semi Circular Chart</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="semi_radialbar" data-colors='["--vz-primary"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/pages/apexcharts-radialbar.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\velzon_Laravel\default\resources\views/charts-apex-radialbar.blade.php ENDPATH**/ ?>