$(document).ready(() => {
    // $("#open-sidebar").click(() => {
    //     // add class active on #sidebar
    //     $("#sidebar").addClass("active");

    //     // show sidebar overlay
    //     $("#sidebar-overlay").removeClass("d-none");
    // });

    // $("#sidebar-overlay").click(function () {
    //     // add class active on #sidebar
    //     $("#sidebar").removeClass("active");

    //     // show sidebar overlay
    //     $(this).addClass("d-none");
    // });
    
    // --- INIT --- //
    flatpickr(".flatpicker-input", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "j F, Y",
    });
    // $('.select2').select2({
    //     width:'100%'
    // });
});

function confirmModal(btnText, msgText, id, status = null, to = null) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: !0,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, " + btnText + " it!",
        confirmButtonClass: "btn btn-primary",
        cancelButtonClass: "btn btn-danger ms-1",
        buttonsStyling: !1,
    }).then(function (t) {
        if (t.value) {
            Swal.fire({
                icon: "success",
                title: msgText,
                text: "Your Record has been " + msgText + ".",
                confirmButtonClass: "btn btn-success reloadBtn",
            });

            if (btnText == "delete") {
                action(id, to);
            } else if (btnText == "restore") {
                action(id, to);
            }
        } else if (t.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
                title: "Cancelled",
                text: "Your Record is safe :)",
                icon: "error",
                confirmButtonClass: "btn btn-success",
            });
        }
    });
}

function action(id, to) {
    console.log("entered");
    console.log(to);
    console.log(id);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        type: "POST",
        url: to,
        data: {
            id: id,
        },
        success: function (response) {
            console.log(response);
            setTimeout(() => {
                window.location.reload();
            }, 1000);
            // window.location.reload();
            // load();
            // $(".datatable").DataTable().ajax.reload();
        },
    });
}

$(document).on('click','.reloadBtn', function () {
    window.location.reload();
});
