@extends('layouts.app')

{{-- @section('title', $pageConfigs['title']) --}}

@section('page-style')
    {{-- Page Style --}}
@endsection

@section('content')

    <section id="basic-datatable">

        {{-- BEGIN: Add Form --}}
        <x-modals.modal title="{{ $pageConfigs['title'] }}" modalName="add-modal" modalWidth="modal-lg">
            @slot('modalBody')
                <x-forms.form formId="add-form" formActionType="POST" formAction="{{ route('tasks.assign.store') }}">
                    @slot('form')
                        <x-forms.select-input label="User" name="user_id" id="user_id" class="user_id select2" :options="$users"
                            optionKey="id" key="name" placeholder="Select User" width="col-md-6" />
                        <x-forms.select-input label="Task" name="task_id" id="task_id" class="task_id select2" :options="$tasks"
                            optionKey="id" key="title" placeholder="Select Task" width="col-md-6" />

                        <hr class="mt-3 preview-input">
                        <h6 class="fw-bold preview-input">Task Assignment Details</h5>
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 user-preview-input"
                                id="user_name" label="User Name" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 user-preview-input"
                                id="user_email" label="User Email" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 task-preview-input"
                                id="task_title" label="Task Title" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 task-preview-input"
                                id="task_due_date" label="Task Due Date" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 task-preview-input"
                                id="task_description" label="Task Description" />
                        @endslot
                </x-forms.form>
            @endslot
        </x-modals.modal>
        {{-- End: Add Form --}}

        {{-- BEGIN: View Description --}}
        <x-modals.modal title="Task Description" modalName="view-modal" modalWidth="modal-lg">
            @slot('modalBody')
            @endslot
        </x-modals.modal>
        {{-- END: View Description --}}

        {{-- BEGIN: Manage Status --}}
        <x-modals.modal title="Manage Status" modalName="status-modal" modalWidth="modal-md">
            @slot('modalBody')
                <x-forms.form formId="add-form" formActionType="POST" formAction="{{ route('tasks.assign.update-status') }}">
                    @slot('form')
                    <x-forms.input label="Id" type="hidden" name="id" id="ef_status_id" class="ef_status_id"
                            placeholder="Enter id" width="col-md-12" />
                        <x-forms.select-input label="Status" name="status" id="status" class="status select2" :options="$statusList"
                            optionKey="name" key="name" placeholder="Select Status" width="col-md-12" />
                        @endslot
                </x-forms.form>
            @endslot
        </x-modals.modal>
        {{-- END: Manage Status --}}

        {{-- BEGIN: Edit Form --}}
        <x-modals.modal title="Edit Assigned Tasks" modalName="edit-modal" modalWidth="modal-lg">
            @slot('modalBody')
                <x-forms.form formId="edit-form" formActionType="POST" formAction="{{ route('tasks.assign.store') }}">
                    @slot('form')
                        <x-forms.input label="Id" type="hidden" name="id" id="ef_id" class="ef_id"
                            placeholder="Enter id" width="col-md-12" />
                        <x-forms.select-input label="User" name="user_id" id="ef_user_id" class="ef_user_id select2"
                            :options="$users" optionKey="id" key="name" placeholder="Select User" width="col-md-6" />
                        <x-forms.select-input label="Task" name="task_id" id="ef_task_id" class="ef_task_id select2"
                            :options="$tasks" optionKey="id" key="title" placeholder="Select Task" width="col-md-6" />

                        <hr class="mt-3 ef-preview-input">
                        <h6 class="fw-bold ef-preview-input">Task Assignment Details</h5>
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 ef-user-preview-input"
                                id="ef_user_name" label="User Name" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 ef-user-preview-input"
                                id="ef_user_email" label="User Email" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 ef-task-preview-input"
                                id="ef_task_title" label="Task Title" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 ef-task-preview-input"
                                id="ef_task_due_date" label="Task Due Date" />
                            <x-forms.read-only-static-text width="col-md-3 bg-light-primary rounded m-1 pt-2 ef-task-preview-input"
                                id="ef_task_description" label="Task Description" />
                        @endslot
                </x-forms.form>
            @endslot
        </x-modals.modal>
        {{-- End: Edit Form --}}



        <div class="container pt-5 cm-container">

            @if ($errors->any())
                <div class="alert alert-danger">
                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                </div>
            @endif

            
            {{-- Data Table --}}
            <x-cards.card>
                @slot('cardBody')
                
                    {{-- BEGIN: Add Button --}}
                    <button data-bs-toggle="modal" data-bs-target="#add-modal" data-id="2"
                        class="btn btn-sm btn-primary addRecord">Assign Task to User</button>
                    {{-- End: Add Button --}}

                    {!! $dataTable->table() !!}
                @endslot
            </x-cards.card>
            {{-- End Data Table --}}
        </div>


    </section>


@endsection


@section('vendor-script')
    {{-- vendor files --}}
@endsection
@section('page-script')
    {{-- Page js files --}}

    <script type="text/javascript">
        $(document).ready(function() {

            $('input[type="search"]').addClass('form-control mb-3');
            $('table').addClass('table table-striped table-hover table-bordered');
            $('.paginate_button').addClass('mr-2 btn-icon btn-icon-only btn btn-outline-danger');

            $(document).on('click', '.viewRecordDescription', function() {
                var recordDescription = $(this).data('description');
                $('#view-modal .modal-body').html(recordDescription);
            });

            setTimeout(() => {
                $('.alert').hide();
            }, 5000);


            /************** Add Form Get User & Task Details ****************/
            $(document).on('change', '#task_id', function() {
                let id = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('tasks.edit') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $('.preview-input').show();
                        $('.task-preview-input').show();
                        $("#task_title").html(data.title);
                        $("#task_description").html(data.description);
                        $("#task_due_date").html(data.due_date);
                    }
                });
            });
            $(document).on('change', '#user_id', function() {
                let id = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('users.edit') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $('.preview-input').show();
                        $('.user-preview-input').show();
                        $("#user_name").html(data.name);
                        $("#user_email").html(data.email);
                    }
                });
            });
            /************** Add Form Get User & Task Details ****************/

            /************** Edit Form Get User & Task Details ****************/
            $(document).on('change', '#ef_task_id', function() {
                let id = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('tasks.edit') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $('.ef_preview-input').show();
                        $('.ef_task-preview-input').show();
                        $("#ef_task_title").html(data.title);
                        $("#ef_task_description").html(data.description);
                        $("#ef_task_due_date").html(data.due_date);
                    }
                });
            });
            $(document).on('change', '#ef_user_id', function() {
                let id = $(this).val();

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('users.edit') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $('.ef_preview-input').show();
                        $('.ef_user-preview-input').show();
                        $("#ef_user_name").html(data.name);
                        $("#ef_user_email").html(data.email);
                    }
                });
            });
            /************** Edit Form Get User & Task Details ****************/

            /************** Edit Record ****************/
            $(document).on('click', '.editRecord', function() {
                let id = $(this).data('id');

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "{{ route('tasks.assign.edit') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $("#ef_id").val(data.id);
                        $("#ef_user_id").val(data.user_id).trigger('change');
                        $("#ef_task_id").val(data.task_id).trigger('change');

                        $('.ef-preview-input').show();
                        $('.ef-user-preview-input').show();
                        $('.ef-task-preview-input').show();

                        $('.ef_preview-input').show();
                        $('.ef_task-preview-input').show();
                        $("#ef_task_title").html(data.task.title);
                        $("#ef_task_description").html(data.task.description);
                        $("#ef_task_due_date").html(data.task.due_date);

                        $('.ef_user-preview-input').show();
                        $("#ef_user_name").html(data.user.name);
                        $("#ef_user_email").html(data.user.email);

                    }
                });
            });
            /************** Edit Record ****************/


            /************** Delete Record ****************/
            $('body').on('click', '.deleteRecord', function() {
                let id = $(this).data('id');
                confirmModal('delete', 'deleted', id, null, "{{ Route('tasks.delete') }}")
            });
            /************** Delete Record ****************/

            /************** Restore Record ****************/
            $('body').on('click', '.restoreRecord', function() {
                let id = $(this).data('id');
                confirmModal('restore', 'restored', id, null, "{{ Route('tasks.restore') }}")
            });
            /************** Restore Record ****************/

            $('.preview-input').hide();
            $('.user-preview-input').hide();
            $('.task-preview-input').hide();

            $('.ef-preview-input').hide();
            $('.ef-user-preview-input').hide();
            $('.ef-task-preview-input').hide();

            $(document).on('click', '.changeRecordStatus', function() {
                let id = $(this).data('id');
                $('#ef_status_id').val(id);

                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     type: "POST",
                //     url: "{{ route('tasks.assign.update-status') }}",
                //     data: {
                //         'id': id
                //     },
                //     success: function(data) {
                //         $("#ef_id").val(data.id);
                //         $("#ef_user_id").val(data.user_id).trigger('change');
                //         $("#ef_task_id").val(data.task_id).trigger('change');

                //         $('.ef-preview-input').show();
                //         $('.ef-user-preview-input').show();
                //         $('.ef-task-preview-input').show();

                //         $('.ef_preview-input').show();
                //         $('.ef_task-preview-input').show();
                //         $("#ef_task_title").html(data.task.title);
                //         $("#ef_task_description").html(data.task.description);
                //         $("#ef_task_due_date").html(data.task.due_date);

                //         $('.ef_user-preview-input').show();
                //         $("#ef_user_name").html(data.user.name);
                //         $("#ef_user_email").html(data.user.email);

                //     }
                // });
            });


        });
    </script>
@endsection
