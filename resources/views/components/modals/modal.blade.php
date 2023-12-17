<div>
    <div class="modal modal-slide-in fade" id="{{ $modalName }}">
        <div class="modal-dialog sidebar-sm  {{ $modalWidth }}">
            <div class="add-new-record modal-content pt-0">

                {{-- Modal Heading --}}
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">{{ $title }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button> --}}
                </div>

                {{-- Modal Body --}}
                <div class="modal-body flex-grow-1">
                    {{ $modalBody }}
                </div>
              </div>
        </div>
    </div>
</div>
