<div>
    <form id="{{ $formId }}" class="add-new-record pt-0" method="{{ $formActionType }}" action="{{ $formAction }}" novalidate>
        @csrf
        <div class="row">
            {{ $form }}
            <div class="col-md-12 col-12 mt-4 {{ $submitBtnGroupClass }}">
                <button type="submit" class="btn btn-primary data-submit me-1">Submit</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </form>
</div>
