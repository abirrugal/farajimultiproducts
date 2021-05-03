$(function() {



    var count = 1;

    $('.plus_btn_show').click(function() {
        count = count + 1;
        $('.display_quantity_show').text(count);
        $('.quantity_count_show').val(count);
    })
    $('.minus_btn_show').click(function() {
        count = count - 1;
        $('.display_quantity_show').text(count);
        $('.quantity_count_show').val(count);

    })




    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {

        //Add to cart notification and cart icon's increment 

        $('body').on('submit', '#add_cart', function(e) {


            e.preventDefault();

            var data = $(this).closest('.cart_div').find('.product_id_show').val();
            var data1 = $(this).closest('.cart_div').find('.quantity_count_show').val();


            $.ajax({
                type: 'Post',
                url: $('#add_cart').data('route'),
                data: { product_id: data, quantity_show: data1 },
                cache: false,
                success: function(response) {

                    if (response.status === 'success') {
                        // @ts-ignore
                        alertify.set('notifier', 'position', 'top-right');
                        // @ts-ignore
                        alertify.success(response.message);
                        $('#total_cart_itemsrrrr').html(response.data);

                    }

                },
                async: false,
                error: function(error) {

                }
            })

        })

        //Function to increment all the count releted field

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function changeCounts(data, thisClick) {
            var totalPrice = numberWithCommas((data.data.totalPrice).toFixed(2));
            var totalProducts = data.data.totalProducts;

            $('#sm_total_price').text(totalPrice);
            $('#lg-down-subtotal').text(totalPrice);
            $('#md-right-subtotal').text(totalPrice);
            $('#lg-right-subtotal').text(totalPrice);

            $('#sm-right-quantity').text(totalProducts);
            $('#lg-down-quantity').text(totalProducts);
            $('#md-right-quantity').text(totalProducts);
            $('#lg-right-quantity').text(totalProducts);

            $('#total_cart_itemsrrrr').text(totalProducts);

            thisClick.closest('.quantity_div').find('.display_quantity').text(data.data.quantity);

        }

        //Increment product quantity when click + button functionality

        $(document).on('click', '.plus_btn', function(e) {

            e.preventDefault();
            var thisClick = $(this);
            var change_to = $(this).closest('.quantity_div').find('.change_up').val();
            var id = $(this).closest('.quantity_div').find('.pass_key_up').val();
            var url = $('.plus_btn').data('route');

            $.ajax({
                    url: url,
                    method: 'Post',
                    dataType: 'json',
                    data: {

                        id: id,
                        change_to: change_to
                    }
                }).done(function(data) {



                    if (data.status === 'success') {
                        // window.location.reload();

                        changeCounts(data, thisClick);

                    }

                })
                .fail(function(error) {
                    console.log(error);

                })
        });


        //Increment product quantity when click - button functionality

        $(document).on('click', '.minus_btn', function(e) {

            e.preventDefault();
            var thisClick = $(this);
            var change_to = $(this).closest('.quantity_div').find('.change_down').val();
            var id = $(this).closest('.quantity_div').find('.pass_key_down').val();
            var url = $('.minus_btn').data('route');

            $.ajax({
                    url: url,
                    method: 'Post',
                    dataType: 'json',
                    data: {

                        id: id,
                        change_to: change_to
                    }
                }).done(function(data) {

                    if (data.status === 'success') {
                        // window.location.reload();            
                        changeCounts(data, thisClick);

                    }

                })
                .fail(function(error) {
                    console.log(error);

                })
        })


    })




});