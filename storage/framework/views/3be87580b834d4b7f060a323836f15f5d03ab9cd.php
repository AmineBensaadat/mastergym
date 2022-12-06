<?php $__env->startSection('title'); ?> <?php echo app('translator')->get('translation.Apex_Boxplot_Chart'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('li_1'); ?> Apexcharts <?php $__env->endSlot(); ?>
<?php $__env->slot('title'); ?> Apex Boxplot Charts <?php $__env->endSlot(); ?>
<?php echo $__env->renderComponent(); ?>
<div class="row">
    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Basic Box Chart</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="basic_box" data-colors='["--vz-primary", "--vz-info"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->

    <div class="col-xl-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Boxplot with Scatter Chart</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="box_plot" data-colors='["--vz-danger", "--vz-info", "--vz-danger", "--vz-primary"]' class="apex-charts" dir="ltr"></div>
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
                <h4 class="card-title mb-0">Horizontal BoxPlot</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div id="box_plot_hori" data-colors='["--vz-light", "--vz-card-bg-custom"]' class="apex-charts" dir="ltr"></div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!-- end col -->
</div>
<!-- end row -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('assets/libs/apexcharts/apexcharts.min.js')); ?>"></script>
<script src="<?php echo e(URL::asset('assets/js/pages/apexcharts-boxplot.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('/assets/js/app.min.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\velzon_laravel\default\resources\views/charts-apex-boxplot.blade.php ENDPATH**/ ?>