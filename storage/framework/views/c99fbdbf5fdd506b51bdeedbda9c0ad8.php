

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Employee Report')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Manage Employee Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-button'); ?>
    <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()" data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>"
        data-original-title="<?php echo e(__('Download')); ?>">
        <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
    </a>
    
    <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>"
        onclick="exportToExcel()">
        <span class="btn-inner--icon"><i class="ti ti-file-export"></i></span>
    </a>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        
        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                html2canvas: {
                    scale: 4,
                    dpi: 72,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'A2'
                }
            };
            html2pdf().set(opt).from(element).save();
        }

        $(document).ready(function () {
            let table = $('#employeeTable').DataTable({
                dom: '<"top">rt<"bottom"lip>',
                order: [],
                language: {
                    paginate: {
                        previous: "<i class='ti ti-chevron-left'></i>",
                        next: "<i class='ti ti-chevron-right'></i>"
                    },
                   
                },
                drawCallback: function () {
                    $('.dataTables_paginate > .pagination').addClass('pagination-rounded');
                }
            });

            function applyFilters() {
                table.columns(0).search($('#filterName').val());
                table.columns(3).search($('#filterYear').val());
                table.columns(4).search($('#filterMonth').val());
                table.columns(5).search($('#filterDate').val());
                table.draw();
            }

            $('#filterName, #filterYear, #filterMonth, #filterDate').on('change keyup', applyFilters);

            $('#filterReportType').on('change', function () {
                let reportType = $(this).val();
                if (reportType === 'monthly') {
                    table.columns(4).search('').draw();
                } else if (reportType === 'yearly') {
                    table.columns(3).search('').draw();
                } else {
                    table.columns(3).search('');
                    table.columns(4).search('');
                    table.draw();
                }
            });
        });
    </script>

    
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
 <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-report"></i>
                            </div>
                            <div class="ms-3">
                                <input type="hidden" value="<?php echo e(__('Employee Report')); ?>" id="filename">
                                <h5 class="mb-0"><?php echo e(__('Report')); ?></h5>
                                <div>
                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Employee Summary')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-secondary">
                                <i class="ti ti-users"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0"><?php echo e(__('Total Employees')); ?></h5>
                                <p class="text-muted text-sm mb-0"><?php echo e(count($employees2)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col">
            <div class="card">
                <div class="card-body p-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="theme-avtar bg-primary">
                                <i class="ti ti-currency-dollar"></i>
                            </div>
                            <div class="ms-3">
                                <h5 class="mb-0"><?php echo e(__('Total Salary')); ?></h5>
                                <p class="text-muted text-sm mb-0">
                                    $<?php echo e(number_format($employees2->sum('monthly_salary'), 2)); ?> (Monthly)
                                </p>
                                <p class="text-muted text-sm mb-0">
                                    $<?php echo e(number_format($employees2->sum('monthly_salary') * 12, 2)); ?> (Yearly)
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-sm-12">
        <div class="mt-2" id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-end">
                        <div class="col-xl-10">
                            <div class="row">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                    <div class="btn-box">
                                        <label for="filterName" class="form-label"><?php echo e(__('Employee Name')); ?></label>
                                        <select id="filterName" class="form-control select">
                                            <option value=""><?php echo e(__('All')); ?></option>
                                            <?php $__currentLoopData = $employees2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($e->name); ?>"><?php echo e($e->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-12 col-12">
                                    <div class="btn-box">
                                        <label for="filterYear" class="form-label"><?php echo e(__('Year')); ?></label>
                                        <select id="filterYear" class="form-control select">
                                            <option value=""><?php echo e(__('All')); ?></option>
                                            <?php for($i = date('Y'); $i >= 2020; $i--): ?>
                                                <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                </div>
                                
                             
                                
                                
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                    <div class="btn-box">
                                        <label for="filterReportType" class="form-label"><?php echo e(__('Report Type')); ?></label>
                                        <select id="filterReportType" class="form-control select">
                                            <option value=""><?php echo e(__('All')); ?></option>
                                            <option value="monthly"><?php echo e(__('Monthly')); ?></option>
                                            <option value="yearly"><?php echo e(__('Yearly')); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="printableArea">
   

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table id="employeeTable" class="table datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Employee Name')); ?></th>
                                    <th><?php echo e(__('Salary (Monthly)')); ?></th>
                                    <th><?php echo e(__('Salary (Yearly)')); ?></th>
                                  
                                    <th><?php echo e(__('Attendance (Yearly)')); ?></th>
                                    <th><?php echo e(__('Leaves (Yearly)')); ?></th>
                                    <th><?php echo e(__('Holidays (Yearly)')); ?></th>
                                    <th><?php echo e(__('Loan')); ?></th>
                                    <th><?php echo e(__('Allowance')); ?></th>
                                    <th><?php echo e(__('Year')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $employees2; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employ): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($employ->name); ?></td>
                                        <td>$<?php echo e(number_format($employ->monthly_salary, 2)); ?></td>
                                        <td>$<?php echo e(number_format($employ->monthly_salary * 12, 2)); ?></td>
                                       
                                        <td><?php echo e($employ->attendance_yearly); ?> <?php echo e(__('days')); ?></td>
                                        <td><?php echo e($employ->leaves_yearly); ?> <?php echo e(__('days')); ?></td>
                                        <td><?php echo e($employ->holidays_yearly); ?> <?php echo e(__('days')); ?></td>
                                        <td>$<?php echo e(number_format($employ->loan, 2)); ?></td>
                                        <td>$<?php echo e(number_format($employ->allowance, 2)); ?></td>
                                        <td><?php echo e($employ->year ?? date('Y')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\roll-check\resources\views/report/employeeReport.blade.php ENDPATH**/ ?>