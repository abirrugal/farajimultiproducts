$(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {

        $('body').on('submit', '#add_cart', function(e) {

            var data = $(this).serialize();
            var url = $('#add_cart').data('route');

            $.ajax({
                type: 'Post',

                url: url,
                data: data,
                cache: false,
                success: function(response) {

                    if (response.status === 'success') {
                        alertify.set('notifier', 'position', 'top-right');
                        alertify.success(response.message);
                    }

                },
                async: false,
                error: function(error) {

                }
            })


            $.ajax({
                type: 'Get',
                url: 'http://localhost/ajax_test/public/cart/quantity',
                cache: false,
                success: function(response) {

                    if (response.status === 'success') {


                        $('#total_cart_items').html(response.totalProducts);


                    }


                },
                async: false,

                error: function(error) {

                }
            })

            e.preventDefault();

        })

    });

});







// $(function() {



//     $('#add_cart').on('click', function(e) {


//         var url = 'http://localhost/ajax_test/public/cart/quantity';

//         $.ajax({
//                 type: 'Get',
//                 url: url,

//                 success: function(response) {

//                     if (response.status == 'success') {
//                         $('#total_cart_items').html(response.totalProducts);
//                         // $('#total_cart_items').append();

//                     }

//                 },
//                 error: function(error) {

//                 }
//             })
//             // e.preventDefault();

//     })

// });



// $(document).ready(function() {
//     $.get('http://localhost/ajax_test/public/cart/quantity', function(data) {

//         $('#total_cart_items').html('<i class="fas fa-cart-plus"></i> ' + data.totalProducts);
//     })
// })