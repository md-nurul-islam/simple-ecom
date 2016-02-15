jQuery(document).ready(function ($) {

    var cart = {};
    var user_id = 0;
    var max_cart_limit = 0.00;

    if ($('#cart_limit').length > 0) {
        max_cart_limit = parseFloat($('#cart_limit').val());
    }

    if ($('#user_id').length > 0) {
        user_id = $('#user_id').val();
    }

    var cart_from_cookie = readCartCookie();

    if (Object.keys(cart).length == 0) {
        $('.shopping-item .cart-amunt').text('BDT ' + 0.00);
        $('.shopping-item .product-count').text(0);
    }

    if (cart_from_cookie != null && Object.keys(cart_from_cookie).length > 0) {

        var num_items = Object.keys(cart_from_cookie).length;
        var total_amount = 0.00;
        var alert_html = '';

        Object.keys(cart_from_cookie).forEach(function (key, index) {
            var row_total = cart_from_cookie[key]['qty'] * cart_from_cookie[key]['sale_price'];
            total_amount += row_total;
        });

        $('.shopping-item .cart-amunt').text('BDT ' + total_amount.toFixed(2));
        $('.shopping-item .product-count').text(num_items);
    }

    if ($('.cart_item').length > 0) {
        var grand_total = 0.00, row_total = 0.00;
        $('.cart_item').each(function () {
            row_total = calculate_rowtotal($(this));
            grand_total += row_total;
        });

        if (max_cart_limit > 0 && grand_total > max_cart_limit) {
            alert_html = '<div class="alert alert-danger"><strong>Your cart limit exceeded by: BDT ' + (grand_total - max_cart_limit) + '</strong></div>';
        }
        $('.product-content-right').prepend(alert_html);

        $('.cart_totals .cart-subtotal .amount').text('BDT ' + grand_total.toFixed(2));
        $('.cart_totals .order-total .amount').text('BDT ' + grand_total.toFixed(2));
    }

    function calculate_grand_total() {
        var grand_total = 0.00, row_total = 0.00, num_items = 0, alert_html = '';

        $('.cart_item').each(function () {
            var item = {};
            var item_id = parseInt($(this).find('.product-quantity .product_id').val());
            var sale_price_text = $(this).find('.product-price .amount').text().trim();
            var sale_price = parseFloat(sale_price_text.split(' ')[1]);
            var qty = parseInt($(this).find('.product-quantity .qty').val());

            row_total = calculate_rowtotal($(this));

            cart[item_id] = item_id;
            item['id'] = item_id;
            item['sale_price'] = sale_price;
            item['qty'] = qty;

            cart[item_id] = item;

            num_items += qty;
            grand_total += row_total;
        });
        createCartCookie();
        
        if(grand_total == 0) {
            deleteCartCookie();
        }
        
        if (max_cart_limit > 0 && grand_total > max_cart_limit) {
            alert_html = '<div class="alert alert-danger"><strong>Your cart limit exceeded by: BDT ' + (grand_total - max_cart_limit) + '</strong></div>';
        }
        if($('.alert-danger').length > 0) {
            $('.alert-danger').remove();
        }
        
        $('.product-content-right').prepend(alert_html);

        $('.cart_totals .cart-subtotal .amount').text('BDT ' + grand_total.toFixed(2));
        $('.cart_totals .order-total .amount').text('BDT ' + grand_total.toFixed(2));
        $('.shopping-item .cart-amunt').text('BDT ' + grand_total.toFixed(2));
        $('.shopping-item .product-count').text(num_items);
    }

    function calculate_subtotal() {
        var total_amount = 0.00;

        cart_from_cookie = readCartCookie();

        if (cart_from_cookie != null && Object.keys(cart_from_cookie).length > 0) {
            Object.keys(cart_from_cookie).forEach(function (key, index) {
                var row_total = cart_from_cookie[key]['qty'] * cart_from_cookie[key]['sale_price'];
                total_amount += row_total;
            });
        }

        return total_amount;
    }

    function calculate_rowtotal(row) {
        var row_total = 0.00;
        var unit_price = parseFloat(row.find('.product-price .amount').text().trim().split(' ')[1]);
        var num_unit = parseInt(row.find('.product-quantity .qty').val().trim());
        row_total = unit_price * num_unit;
        row.find('.product-subtotal .amount').text('BDT ' + row_total.toFixed(2));
        return row_total;
    }

    function createCartCookie() {

        cart_from_cookie = readCartCookie();

        if (cart_from_cookie != null && Object.keys(cart_from_cookie).length > 0) {
            Object.keys(cart_from_cookie).forEach(function (key, index) {
                var item = {};
                var item_id = cart_from_cookie[key]['id'];
                cart[item_id] = item_id;
                item['id'] = item_id;
                item['sale_price'] = cart_from_cookie[key]['sale_price'];
                item['qty'] = cart_from_cookie[key]['qty'];

                cart[item_id] = item;
                var row_total = cart_from_cookie[key]['qty'] * cart_from_cookie[key]['sale_price'];
                total_amount += row_total;
            });
        }

        docCookies.setItem('cart_' + user_id, JSON.stringify(cart));
    }

    function readCartCookie() {
        var cart_cookie = JSON.parse(docCookies.getItem('cart_' + user_id));
        if (cart_cookie == null) {
            cart_cookie = JSON.parse(docCookies.getItem('cart_0'));
        }
        return cart_cookie;
    }
    
    function deleteCartCookie() {
        docCookies.removeItem('cart_' + user_id);
        docCookies.removeItem('cart_0');
    }

    $(document).on('click', '.add-to-cart-link', function (e) {
        e.preventDefault();

        var item = {};
        var item_id = $(this).attr('data-id');
        var sale_price_text = $(this).closest('.single-product').find('.product-carousel-price ins').text().trim();
        var sale_price = parseFloat(sale_price_text.split(' ')[1]);

        cart[item_id] = item_id;
        item['id'] = item_id;
        item['sale_price'] = sale_price;
        item['qty'] = 1;

        cart[item_id] = item;

        var num_items = Object.keys(cart).length;
        createCartCookie();

        var setCart = setTimeout(function () {
            $('.shopping-item .cart-amunt').text('BDT ' + calculate_subtotal().toFixed(2));
            $('.shopping-item .product-count').text(num_items);
            clearTimeout(setCart);
        }, 50);
        return false;
    });

    $(document).on('click', '.add_to_cart_button', function (e) {
        e.preventDefault();

        var item_id = $(this).attr('data-id');
        var sale_price_text = $(this).closest('.product-inner').find('.product-inner-price').find('ins').text().trim();
        var sale_price = parseFloat(sale_price_text.split(' ')[1]);
        var qty = parseInt($('.product-inner .qty').val().trim());

        cart_from_cookie = readCartCookie();

        if (cart_from_cookie != null && Object.keys(cart_from_cookie).length > 0) {
            if (cart_from_cookie[item_id] !== undefined) {
                cart_from_cookie[item_id]['id'] = item_id;
                cart_from_cookie[item_id]['sale_price'] = sale_price;
                cart_from_cookie[item_id]['qty'] = qty;

                cart_from_cookie[item_id] = cart_from_cookie[item_id];
            } else {
                var item = {};
                item['id'] = item_id;
                item['sale_price'] = sale_price;
                item['qty'] = qty;

                cart_from_cookie[item_id] = item;
            }
        }

        cart = cart_from_cookie;

        var num_items = Object.keys(cart).length;
        docCookies.setItem('cart_' + user_id, JSON.stringify(cart));

        var setCart = setTimeout(function () {

            var total_amount = 0.00;

            Object.keys(cart).forEach(function (key, index) {
                var row_total = cart[key]['qty'] * cart[key]['sale_price'];
                total_amount += row_total;
            });

            $('.shopping-item .cart-amunt').text('BDT ' + total_amount.toFixed(2));
            $('.shopping-item .product-count').text(num_items);

            clearTimeout(setCart);
        }, 50);
        return false;
    });

    $(document).on('click', '.product-quantity .minus', function () {
        var old_val = parseInt($(this).siblings('.qty').val());
        var new_val = old_val - 1;
        $(this).siblings('.qty').val(new_val);
        calculate_rowtotal($(this).closest('.cart_item'));
        calculate_grand_total();
    });

    $(document).on('click', '.product-quantity .plus', function () {
        var old_val = parseInt($(this).siblings('.qty').val());
        var new_val = old_val + 1;
        $(this).siblings('.qty').val(new_val);
        calculate_rowtotal($(this).closest('.cart_item'));
        calculate_grand_total();
    });

    $(document).on('change', '.product-quantity input[type="number"]', function () {
        calculate_rowtotal($(this).closest('.cart_item'));
        calculate_grand_total();
    });

    $(document).on('click', '.remove', function () {
        $(this).closest('.cart_item').remove();
        calculate_grand_total();
    });



});