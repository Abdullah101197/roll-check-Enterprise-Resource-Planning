<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Training')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Training List')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-button'); ?>
    <a href="<?php echo e(route('training.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip"
        data-bs-original-title="<?php echo e(__('Export')); ?>">
        <i class="ti ti-file-export"></i>
    </a>



    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Training')): ?>
        <a href="#" data-url="<?php echo e(route('training.create')); ?>" data-ajax-popup="true" data-size="lg"
            data-title="<?php echo e(__('Create New Training')); ?>" data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
            data-bs-original-title="<?php echo e(__('Create')); ?>">
            <i class="ti ti-plus"></i>
        </a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">
                
                <div class="table-responsive">
                    <table class="table" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Branch')); ?></th>
                                <th><?php echo e(__('Training Type')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <th><?php echo e(__('Employee')); ?></th>
                                <th><?php echo e(__('Trainer')); ?></th>
                                <th><?php echo e(__('Training Duration')); ?></th>
                                <th><?php echo e(__('Cost')); ?></th>
                                <?php if(Gate::check('Edit Training') || Gate::check('Delete Training') || Gate::check('Show Training')): ?>
                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                           

                            <?php $__currentLoopData = $trainings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $training): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(!empty($training->branches) ? $training->branches->name : ''); ?></td>
                                    <td><?php echo e(!empty($training->types) ? $training->types->name : ''); ?> <br></td>
                                    <td>
                                        <?php if($training->status == 0): ?>
                                            <span class="badge bg-warning p-2 px-3 rounded mt-1 status-badge6"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php elseif($training->status == 1): ?>
                                            <span class="badge bg-primary p-2 px-3 rounded mt-1 status-badge6"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php elseif($training->status == 2): ?>
                                            <span class="badge bg-success p-2 px-3 rounded mt-1 status-badge6"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php elseif($training->status == 3): ?>
                                            <span class="badge bg-danger p-2 px-3 rounded mt-1 status-badge6"><?php echo e(__($status[$training->status])); ?></span>
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e(!empty($training->employees) ? $training->employees->name : ''); ?> </td>
                                    <td><?php echo e(!empty($training->trainers) ? $training->trainers->firstname : ''); ?></td>
                                    <td><?php echo e(\Auth::user()->dateFormat($training->start_date) . ' to ' . \Auth::user()->dateFormat($training->end_date)); ?>

                                    </td>
                                    <td><?php echo e(\Auth::user()->priceFormat($training->training_cost)); ?></td>
                                    <td class="Action">
                                        <?php if(Gate::check('Edit Training') || Gate::check('Delete Training') || Gate::check('Show Training')): ?>
                                            <span>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Show Training')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('training.show', \Illuminate\Support\Facades\Crypt::encrypt($training->id))); ?>" class="mx-3 btn btn-sm  align-items-center" data-size="lg"
                                                            data-url=""
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="<?php echo e(__('Show Trainer')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Show')); ?>">
                                                            <i class="ti ti-eye text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>


                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Training')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center" data-size="lg"
                                                            data-url="<?php echo e(route('training.edit', $training->id)); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="" data-title="<?php echo e(__('Edit Training')); ?>"
                                                            data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Delete Training')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['training.destroy', $training->id], 'id' => 'delete-form-' . $training->id]); ?>

                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="" data-bs-original-title="Delete"
                                                            aria-label="Delete"><i
                                                                class="ti ti-trash text-white text-white"></i></a>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                            </span>
                                        <?php endif; ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\roll-check\resources\views/training/index.blade.php ENDPATH**/ ?>