@extends('front-end.layouts.main')
@section('title', 'จัดการสิทธิ์เข้าใช้งาน')
@section('content')
    <div class="intro-y box p-5">
        <div class="mb-5 text-right">
            <livewire:components.assets.button color="primary" title="เพิ่ม Role" icon="file-text"
                route="users.permission.create" action="" />


        </div>
        <div class="mb-5">
            <div class="grid grid-cols-12 gap-2 ">
                <div class="form-inline col-span-4">
                    <label for="horizontal-form-1" class="form-label ">ค้นหา</label>
                    <input id="horizontal-form-1" type="text" class="form-control"
                        placeholder="พิมพ์รายการที่ต้องการค้นหา">
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table  table-striped  table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="whitespace-nowrap">ลำดับที่</th>
                        <th class="whitespace-nowrap">Role</th>

                        <th class="whitespace-nowrap">Create Date</th>
                        <th class="whitespace-nowrap">Update Date</th>
                        <th class="whitespace-nowrap">Permission</th>

                        <th class="whitespace-nowrap">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                @if ($role->created_at)
                                    {{ $role->created_at->format('d/m/Y') }}
                                    <br> by
                                    @if ($role->create_by)
                                        {{ $role->create_by }}
                                    @else
                                        -
                                    @endif
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if ($role->updated_at)
                                    {{ $role->updated_at->format('d/m/Y') }}
                                    <br> by
                                    @if ($role->update_by)
                                        {{ $role->update_by }}
                                    @else
                                        -
                                    @endif
                                @else
                                    N/A
                                @endif

                            </td>

                            <td>
                                @foreach ($role->menus as $menu)
                                    {{ $menu->title }}<br>
                                @endforeach

                            </td>
                            <td>
                                <a onclick="window.location.href='{{ route('users.permission.edit', ['roleId' => $role->id]) }}'"
                                    class="tooltip btn btn-warning" title="แก้ไขข้อมูล"><i data-lucide="edit"
                                        class="w-4 h-4"></i></a>
                                <button type="button" class="tooltip btn btn-danger delete-role-btn" title="ลบข้อมูล"
                                    data-role-id="{{ $role->id }}" data-role-name="{{ $role->name }}"
                                    data-tw-target="#delete-confirmation-modal" data-tw-toggle="modal">
                                    <i data-lucide="delete" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
            <div class="flex justify-center mt-4">

            </div>

        </div>
        <!-- BEGIN: Delete Confirmation Modal -->
        <div id="delete-confirmation-modal" class="modal" tabindex="-1" aria-labelledby="modal-title" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modal-title">Confirmation</h5>
                        <button type="button" class="btn-close" data-tw-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-slate-500 mt-2" id="role-name-placeholder">
                                Do you want to delete this role?
                            </div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <!-- Replace the button with a form -->
                            <form id="delete-role-form"
                                action="{{ route('users.permission.delete', ['roleId' => $role->id]) }}" method="POST">
                                @csrf
                                <input type="hidden" id="role-id-to-delete" name="user_id">
                                <button type="button" data-tw-dismiss="modal"
                                    class="btn btn-outline-secondary w-24 mr-1">Cancel</button>
                                <button type="submit" class="btn btn-danger w-24">Delete</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Delete Confirmation Modal -->
    </div>

    <!-- jQuery handling -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery('.delete-role-btn').on('click', function() {
                // Get the user ID from the clicked button's data attribute
                var roleIdToDelete = $(this).data('role-id');

                // Set the value of the hidden input field in the form
                jQuery('#role-id-to-delete').val(roleIdToDelete);

                // Replace the placeholder in the form action with the actual user ID
                var formAction = "{{ route('users.permission.delete', ['roleId' => '__ROLE_ID__']) }}";
                formAction = formAction.replace('__ROLE_ID__', roleIdToDelete);
                $('#delete-role-form').attr('action', formAction);

                // Optionally, update the user name placeholder in the modal
                var roleName = $(this).data('role-name');
                $('#role-name-placeholder').text('Do you want to delete user ' + roleName + '?');

                // Show the delete confirmation modal
                $('#delete-confirmation-modal').modal('show');
            });
        });
    </script>

@endsection
