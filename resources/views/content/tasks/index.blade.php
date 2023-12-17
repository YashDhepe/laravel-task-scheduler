@extends('layouts.app')

{{-- @section('title', $pageConfigs['title']) --}}

@section('page-style')
    {{-- vendor css files --}}
@endsection

@section('content')

    <section id="basic-datatable">

        {{-- BEGIN: Add Form --}}
        <x-modals.modal title="Add {{ $pageConfigs['title'] }}" modalName="add-modal" modalWidth="modal-lg">
            @slot('modalBody')
                <x-forms.form formId="add-form" formActionType="POST" formAction="{{ route('tasks.store') }}">
                    @slot('form')
                        <x-forms.input label="Title" type="text" name="title" id="title" class="title"
                            placeholder="Enter Title" width="col-md-6" />
                        <x-forms.input label="Due Date" type="text" name="due_date" id="due_date"
                            class="due_date flatpicker-input" placeholder="Select Due Date" width="col-md-6" />
                        <x-forms.textarea label="Description" type="text" name="description" id="description"
                            class="description" placeholder="Enter Description" width="col-md-12" row="4" col="12"
                            required="" />
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

        {{-- BEGIN: Edit Form --}}
        <x-modals.modal title="Edit {{ $pageConfigs['title'] }}" modalName="edit-modal" modalWidth="modal-lg">
            @slot('modalBody')
                <x-forms.form formId="edit-form" formActionType="POST" formAction="{{ route('tasks.update') }}">
                    @slot('form')
                        <x-forms.input label="Id" type="hidden" name="id" id="ef_id" class="ef_id"
                            placeholder="Enter id" width="col-md-12" />
                        <x-forms.input label="Title" type="text" name="title" id="ef_title" class="ef_title"
                            placeholder="Enter Title" width="col-md-6" />
                        <x-forms.input label="Due Date" type="text" name="due_date" id="ef_due_date"
                            class="ef_due_date flatpicker-input" placeholder="Select Due Date" width="col-md-6" />
                        <x-forms.textarea label="Description" type="text" name="description" id="ef_description"
                            class="ef_description" placeholder="Enter Description" width="col-md-12" row="4" col="12"
                            required="" />
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
                    class="btn btn-sm btn-primary addRecord">Add Task</button>
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

            /************** Edit Record ****************/
            $('body').on('click', '.editRecord', function() {
                let id = $(this).data('id');

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
                        $("#ef_id").val(data.id);
                        $("#ef_title").val(data.title);
                        $("#ef_description").val(data.description);
                        // $("#ef_due_date").val(data.due_date);

                        flatpickr("#ef_due_date", {
                            dateFormat: "Y-m-d",
                            altInput: true,
                            altFormat: "j F, Y",
                            defaultDate: data.due_date
                        });

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


        });
    </script>
@endsection
