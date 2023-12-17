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
                <x-forms.form formId="add-form" formActionType="POST" formAction="{{ route('users.store') }}">
                    @slot('form')
                        <x-forms.input label="Name" type="text" name="name" id="name" class="name"
                            placeholder="Enter Name" width="col-md-6" />
                        <x-forms.input label="Email" type="email" name="email" id="email" class="email"
                            placeholder="Enter Email" width="col-md-6" />
                        <x-forms.input label="Password" type="text" name="password" id="password" class="password"
                            placeholder="Enter Password" width="col-md-6" />
                    @endslot
                </x-forms.form>
            @endslot
        </x-modals.modal>
        {{-- End: Add Form --}}

        {{-- BEGIN: Edit Form --}}
        <x-modals.modal title="Edit {{ $pageConfigs['title'] }}" modalName="edit-modal" modalWidth="modal-lg">
            @slot('modalBody')
                <x-forms.form formId="edit-form" formActionType="POST" formAction="{{ route('users.update') }}">
                    @slot('form')
                        <x-forms.input label="Id" type="hidden" name="id" id="ef_id" class="ef_id"
                            placeholder="Enter id" width="col-md-12" />
                        <x-forms.input label="Name" type="text" name="name" id="ef_name" class="ef_name"
                            placeholder="Enter Name" width="col-md-6" />
                        <x-forms.input label="Email" type="email" name="email" id="ef_email" class="ef_email"
                            placeholder="Enter Email" width="col-md-6" />
                        <x-forms.input label="Password" type="text" name="password" id="password" class="password"
                            placeholder="Enter Only if you want to Update Password" width="col-md-6" />
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
                        class="btn btn-sm btn-primary addRecord">Add User</button>
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
                    url: "{{ route('users.edit') }}",
                    data: {
                        'id': id
                    },
                    success: function(data) {
                        $("#ef_id").val(data.id);
                        $("#ef_name").val(data.name);
                        $("#ef_mobile").val(data.mobile);
                        $("#ef_email").val(data.email);
                        $("#ef_password").val(data.password);
                    }
                });
            });
            /************** Edit Record ****************/

            /************** Delete Record ****************/
            $('body').on('click', '.deleteRecord', function() {
                let id = $(this).data('id');
                confirmModal('delete', 'deleted', id, null, "{{ Route('users.delete') }}")
            });
            /************** Delete Record ****************/

            /************** Restore Record ****************/
            $('body').on('click', '.restoreRecord', function() {
                let id = $(this).data('id');
                confirmModal('restore', 'restored', id, null, "{{ Route('users.restore') }}")
            });
            /************** Restore Record ****************/


        });
    </script>
@endsection
