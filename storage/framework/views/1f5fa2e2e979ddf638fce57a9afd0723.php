<?php $__env->startSection('page-title'); ?>
  <?php echo e(__("Manage Income Type")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__("Home")); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__("Income Type")); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Income Type')): ?>
        <a href="#" data-url="<?php echo e(route('incometype.create')); ?>" data-ajax-popup="true"
            data-title="<?php echo e(__('Create New Income Type')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">

        <div class="col-3">
            <?php echo $__env->make('layouts.hrm_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
        <div class="col-9">
        <div class="card">
        <div class="card-header card-body table-border-style">
            
            <div class="table-responsive">
                <table class="table" id="pc-dt-simple">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Income Type')); ?></th>
                            <th width="200px"><?php echo e(__('Action')); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $incometypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $incometype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($incometype->name); ?></td>
                                <td class="Action">
                                    <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Income Type')): ?>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" class="mx-3 btn btn-sm  align-items-center"
                                                    data-url="<?php echo e(URL::to('incometype/' . $incometype->id . '/edit')); ?>"
                                                    data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip" title=""
                                                    data-title="<?php echo e(__('Edit Income Type')); ?>"
                                                    data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Income Type')): ?>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['incometype.destroy', $incometype->id], 'id' => 'delete-form-' . $incometype->id]); ?>

                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                    data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                    aria-label="Delete"><i
                                                        class="ti ti-trash text-white text-white"></i></a>
                                                </form>
                                            </div>
                                        <?php endif; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\roll-check\resources\views/incometype/index.blade.php ENDPATH**/ ?>