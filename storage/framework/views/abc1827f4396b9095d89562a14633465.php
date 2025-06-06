<div class="modal-body">
    <div class="row">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-10 col-xxl-12 col-md-12">
                <div class="px-0 card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <?php $__currentLoopData = $users_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user_data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $users = \App\Models\User::where('created_by', $id)->get();
                                $get_user = \App\Models\User::where('id', $users_data['user_id'])->first();
                                $logo = \App\Models\Utility::get_file('uploads/avatar/');
                                $profile = \App\Models\Utility::get_file('uploads/avatar/');
                            ?>
                            <div class="tab-pane text-capitalize fade show <?php echo e($loop->index == 0 ? 'active' : ''); ?>"
                                id="pills-<?php echo e(strtolower($get_user->id)); ?>" role="tabpanel"
                                aria-labelledby="pills-<?php echo e(strtolower($get_user->id)); ?>-tab">
                                <div class="row users" data-user-id=<?php echo e($get_user->id); ?>>
                                    <div class="col-12 col-sm-12">
                                        <div class="card">
                                            <div class="card-body p-3">
                                                <div class="row">
                                                    <div class="col-4 text-center">
                                                        <h6><?php echo e('Total User'); ?></h6>
                                                        <p class=" text-sm mb-0">
                                                            <i
                                                                class="ti ti-users text-warning card-icon-text-space fs-5 mx-1"></i><span
                                                                class="total_users fs-5">
                                                                <?php echo e($users_data['total_users']); ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h6><?php echo e('Active User'); ?></h6>
                                                        <p class=" text-sm mb-0">
                                                            <i
                                                                class="ti ti-users text-primary card-icon-text-space fs-5 mx-1"></i><span
                                                                class="active_users fs-5"><?php echo e($users_data['active_users']); ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="col-4 text-center">
                                                        <h6><?php echo e('Disable User'); ?></h6>
                                                        <p class=" text-sm mb-0">
                                                            <i
                                                                class="ti ti-users text-danger card-icon-text-space fs-5 mx-1"></i><span
                                                                class="disable_users fs-5"><?php echo e($users_data['disable_users']); ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-2" id="user_section_<?php echo e($get_user->id); ?>">
                                    <?php if($users_data['total_users'] != 0): ?>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-6 my-2">
                                                <div
                                                    class="d-flex align-items-center justify-content-between list_colume_notifi pb-2">
                                                    <div class="mb-3 mb-sm-0">
                                                        <h6>
                                                            <a href="<?php echo e(!empty($user->avatar) ? $profile . $user->avatar : $logo . 'avatar.png'); ?>"
                                                                target="_blank">
                                                                <img src="<?php echo e(!empty($user->avatar) ? $profile . $user->avatar : $logo . 'avatar.png'); ?>"
                                                                    class="rounded-circle" style="width: 10%">
                                                            </a>
                                                            <label for="user"
                                                                class="form-label"><?php echo e($user->name); ?></label>
                                                        </h6>
                                                    </div>
                                                    <div class="text-end ">
                                                        <div class="form-check form-switch custom-switch-v1 mb-2">
                                                            <input type="checkbox" name="user_disable"
                                                                class="form-check-input input-primary is_disable"
                                                                value="1" data-id='<?php echo e($user->id); ?>'
                                                                data-company="<?php echo e($id); ?>"
                                                                data-name="<?php echo e(__('user')); ?>"
                                                                <?php echo e($user->is_disable == 1 ? 'checked' : ''); ?>

                                                                <?php echo e($get_user->is_disable == 1 ? '' : 'disabled'); ?>>
                                                            <label class="form-check-label" for="user_disable"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="10" class="text-center">
                                                <div class="text-center">
                                                    <i class="fas fa-folder-open text-primary fs-40"></i>
                                                    <h2><?php echo e(__('Opps...')); ?></h2>
                                                    <h6> <?php echo __('User Not Found'); ?> </h6>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).on("click", ".is_disable", function() {
        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');
        var company_id = $(this).attr('data-company');
        var is_disable = ($(this).is(':checked')) ? $(this).val() : 0;

        $.ajax({
            url: '<?php echo e(route('user.unable')); ?>',
            type: 'POST',
            data: {
                "is_disable": is_disable,
                "id": id,
                "name": name,
                "company_id": company_id,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function(data) {
                if (data.success) {
                    $('.active_users').text(data.users_data.active_users);
                    $('.disable_users').text(data.users_data.disable_users);
                    $('.total_users').text(data.users_data.total_users);
                    $.each(data.users_data, function(userData) {
                        var $usersElements = $('.users[data-user-id="' +
                            userData.user_id + '"]');
                        // Update total_users, active_users, and disable_users for each workspace
                        $usersElements.find('.total_users').text(userData.total_users);
                        $usersElements.find('.active_users').text(userData
                            .active_users);
                        $usersElements.find('.disable_users').text(userData
                            .disable_users);
                    });

                    show_toastr('success', data.success, 'success');
                } else {
                    show_toastr('error', data.error, 'error');

                }

            }
        });
    });
</script>
<?php /**PATH C:\laragon\www\roll-check\resources\views/user/companyinfo.blade.php ENDPATH**/ ?>