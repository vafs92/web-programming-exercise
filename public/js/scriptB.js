$(function () {
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");

        Swal.fire({
            title: 'Anda yakin?',
            text: 'Anda tidak akan dapat mengembalikan data',
            icon: 'warning',
            showConfirmButton: true,
            showCancelButton: true,
            confirmButtonColor: '#008000',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Menggunakan AJAX untuk mengirim permintaan penghapusan
                $.ajax({
                    type: "POST",
                    url: link,
                    dataType: "json",
                    success: function (response) {
                        Swal.fire({
                            title: response.message,
                            icon: (response.status === 'success') ? 'success' : 'error'
                        }).then(() => {
                            // Redirect setelah menampilkan SweetAlert2
                            location.reload();
                        });
                    }
                });
            }
        });
    })
});
    // $(document).on('click', '#editt', function (e) {
    //     e.preventDefault();
    
    //     var form = $('#editForm'); // Select the form by its ID
    //     var link = form.attr('action');
    
    //     Swal.fire({
    //         title: 'Anda yakin?',
    //         text: 'Anda tidak akan dapat mengembalikan data',
    //         icon: 'warning',
    //         showConfirmButton: true,
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Yes, change it!'
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             // Menggunakan AJAX untuk mengirim permintaan penghapusan
    //             $.ajax({
    //                 type: "POST",
    //                 url: link,
    //                 data: form.serialize(), // Serialize form data
    //                 dataType: "json",
    //                 success: function (response) {
    //                     Swal.fire({
    //                         title: response.message,
    //                         icon: (response.status === 'success') ? 'success' : 'error'
    //                     }).then(() => {
    //                         // Redirect setelah menampilkan SweetAlert2
    //                         if (response.status === 'success') {
    //                             location.reload();
    //                         }
    //                     });
    //                 }
    //             });
    //         }
    //     });
    // });
    
    




// $(function () {
//     $(document).on('click', '#editt', function (e) {
//         e.preventDefault();
//         var link = $(this).attr("href");

//         Swal.fire({
//             title: 'Anda yakin?',
//             text: 'Anda tidak akan dapat mengembalikan data',
//             icon: 'warning',
//             showConfirmButton: true,
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Yes, delete it!'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 // Menggunakan AJAX untuk mengirim permintaan penghapusan
//                 $.ajax({
//                     type: "POST",
//                     url: link,
//                     dataType: "json",
//                     success: function (response) {
//                         Swal.fire({
//                             title: response.message,
//                             icon: (response.status === 'success') ? 'success' : 'error'
//                         }).then(() => {
//                             // Redirect setelah menampilkan SweetAlert2
//                             location.reload();
//                         });
//                     }
//                 });
//             }
//         });
//     })
// });
