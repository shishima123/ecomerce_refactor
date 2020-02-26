$(document).ready(function () {
    //check value input search
    $("#btnSearch").click(function (e) {
        if ($('#txtSearch').val() == '') {
            e.preventDefault();
            alert('Please enter at least one search criterion');
        }
    });

    /* Hide flash message*/
    $('#alertMessage').delay(5000).slideUp(1000);

    //add class active in navbar
    $(".dropdown a").each(function () {
        var link = $(this);
        if (link.attr('href') === location.href) {
            $('#home').removeClass('active');
            link.parents("li").addClass("active");
            return false;
        } else {
            $('#home').addClass('active');
        }
    });

    //check comment rating
    $('#commentRating').click(function (e) {
        if ($('#txtComment').val() == '' || $("input[name='rating']").is(":checked") == false) {
            e.preventDefault();
            alert('Please enter your comment or select star rating');
        }
    });

    //Pagination
    $('.store-pagination li a').click(function (e) {
        e.preventDefault();
        var objClick = $(this);
        objUrl = objClick.attr('href');
        $.ajax({
                url: objUrl,
                type: 'GET',
            })
            .done(function (data) {
                //clear div #areaProduct
                $('#areaProduct').empty();

                //Render and apend data to #areaProduct
                renderProduct(data);

                //animation scroll
                $('html, body').animate({
                    scrollTop: $('#areaProduct').offset().top
                }, 'slow');

                //remove class active
                $('.page-item').removeClass('active');

                //add class active
                if (objClick.parent().hasClass('first')) {
                    objClick.parent().next().addClass('active')
                } else if (objClick.parent().hasClass('last')) {
                    objClick.parent().prev().addClass('active')
                } else {
                    objClick.parents('li').not('.first,.last').addClass('active');
                }
            }).fail(function () {
                alert('Sorry. Some things wrong when load data. Please try again.');
            })
    });


    //set dataAjax for Pagination
    function renderProduct(data) {
        var product = data.data;
        var baseUrl = window.location.origin;

        for (x in product) {
            var strHtml = '';
            strHtml += '<!-- product -->';
            strHtml += '<div class="col-md-4 col-xs-6">';
            strHtml += '<div class="product">'
            strHtml += '<a href="' + baseUrl + '/shop_project/public/product/' + product[x].id + '">';
            strHtml += '<div class="product-img">'
            strHtml += '<img src = "' + baseUrl + '/shop_project/public' + product[x].picture + '" alt = "' + product[x].name + '">';
            strHtml += '<div class="product-label">'
            if (product[x].sale) {
                strHtml += '<span class="sale">-' + product[x].sale + '%</span>'
            }
            if (product[x].new) {
                strHtml += '&nbsp;<span class="new">NEW</span>'
            }
            strHtml += '</div>'
            strHtml += '</div>'
            strHtml += '</a>'
            strHtml += '<div class="product-body">'
            strHtml += '<p class="product-category">' + product[x].category.name + '</p>'
            strHtml += '<h3 class="product-name"><a href="' + baseUrl + '/shop_project/public/product/' + product[x].id + '">' + product[x].name + '</a></h3>'
            strHtml += '<h4 class="product-price">' + (product[x].price - product[x].price * product[x].sale / 100) + '$ </h4>'
            if (product[x].sale) {
                strHtml += '<del class="product-old-price">' + product[x].price + '$</del>'
            } else {
                strHtml += '<br />'
            }
            strHtml += '<div class="product-rating">'
            for (i = 0; i < product[x].rating; i++) {
                if (i == 0) {
                    strHtml += '<i class="fa fa-star"></i>'
                } else {
                    strHtml += '&nbsp;<i class="fa fa-star"></i>'
                }
            }
            strHtml += '</div>'
            strHtml += '<div class="product-btns">'
            strHtml += '<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">addto wishlist</span></button>'
            strHtml += '&nbsp;<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">addto compare</span></button>'
            strHtml += '&nbsp;<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">quickview</span></button>'
            strHtml += '</div>'
            strHtml += '</div>'
            strHtml += '<div class="add-to-cart">'
            strHtml += '<button class="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>'
            strHtml += '</div>'
            strHtml += '</div>'
            strHtml += '</div>'
            strHtml += '<!-- /product -->'
            $(strHtml).appendTo('#areaProduct');
        }
    }

    //get info Cart
    if ($('#cart').length) {
        url = window.location.origin + '/shop_project/public/checkout';
        $.ajax({
                url: url,
                type: 'GET',
            })
            .done(function (data) {
                if (data.products_count !== 0) {
                    $('#totalProduct').text('Your Cart(' + data.products_count + ')')
                    var strHtml = '';
                    var product = data.products;
                    var sum = 0;
                    var count = 0;
                    var baseUrl = window.location.origin + '/shop_project/public/';
                    strHtml += '<div class="cart-list">'
                    for (x in product) {
                        strHtml += '<div class="product-widget" id="productWidget' + product[x].id + '">'
                        strHtml += '<a href="' + baseUrl + 'product/' + product[x].id + '">'
                        strHtml += '<div class="product-img">'
                        strHtml += '<img src = "' + window.location.origin + '/shop_project/public/' + product[x].picture + '"alt = "" >'
                        strHtml += '</div>'
                        strHtml += '</a>'
                        strHtml += '<div class="product-body">'
                        strHtml += '<h3 class="product-name"><a href="' + baseUrl + 'product/' + product[x].id + '">' + product[x].name + '</a></h3>'
                        if (product[x].sale) {
                            strHtml += '<h4 class="product-price"><span class="qty">' + product[x].pivot.qty + 'x</span>' + (product[x].price - product[x].price * product[x].sale / 100) + '$</h4>'
                            strHtml += '</div>'
                            strHtml += '<button class="delete"><i class="fa fa-close delItemHeader" id="' + product[x].id + '"></i></button>'
                            strHtml += '</div>'
                            sum += (product[x].pivot.qty * (product[x].price - product[x].price * product[x].sale / 100));
                        } else {
                            strHtml += '<h4 class="product-price"><span class="qty">' + product[x].pivot.qty + 'x</span>' + product[x].price + '$</h4>'
                            strHtml += '</div>'
                            strHtml += '<button class="delete"><i class="fa fa-close delItemHeader" id="' + product[x].id + '"></i></button>'
                            strHtml += '</div>'
                            sum += (product[x].pivot.qty * product[x].price);

                        }
                        count++;
                    }
                    strHtml += '</div>'
                    strHtml += '<div class="cart-summary">'
                    strHtml += '<small id="itemSelected">' + count + ' Item(s) selected</small>'
                    strHtml += '<h5>SUBTOTAL: <span id="olderTotal">' + sum + '</span>$</h5>'
                    strHtml += '</div>'
                    strHtml += '<div class="cart-btns">'
                    strHtml += '<a href="' + baseUrl + 'checkout">View Cart</a>'
                    strHtml += '<a href="' + baseUrl + 'checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a>'
                    strHtml += '</div>'
                    $(strHtml).appendTo('#cartDetail');
                } else {
                    var strHtml = '';
                    strHtml += '<br>'
                    strHtml += '<h6 class="text-center">YOUR CART IS EMPTY</h6>'
                    strHtml += '<br>'
                    strHtml += '<div class="cart-btns">'
                    strHtml += '<a href="#"disable>View Cart</a>'
                    strHtml += '<a href="#">Checkout <i class="fa fa-arrow-circle-right" disable></i></a>'
                    strHtml += '</div>'
                    $(strHtml).appendTo('#cartDetail');
                }
            }).fail(function () {
                var strHtml = '';
                strHtml += '<br>'
                strHtml += '<h6 class="text-center">YOUR CART IS EMPTY</h6>'
                strHtml += '<br>'
                strHtml += '<div class="cart-btns">'
                strHtml += '<a href="#"disable>View Cart</a>'
                strHtml += '<a href="#">Checkout <i class="fa fa-arrow-circle-right" disable></i></a>'
                strHtml += '</div>'
                $(strHtml).appendTo('#cartDetail');
            });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /* Event Delete item in cart*/
    $('.delItemCart').click(function () {
        var baseUrl = window.location.origin;
        var url = baseUrl + "/shop_project/public/checkout/del-item/" + this.id;
        obj = this.id;
        $.ajax({
            url: url,
            type: 'PUT',
        }).done(function (data) {
            $('#tr' + obj).remove();
            var old_total = $('.order-total').text();
            var new_total = $('.order-total').text(Math.round(old_total - data));
            if (new_total.text() <= 0) {
                $('#olderTotal').text(0);
                $('#theadItemCart').remove();
                var strHtml = '';
                strHtml += '<td colspan="3" style="text-align:center"><h1>No item in Cart</h1></td>'
                $(strHtml).appendTo('#tbodyItemCart')
            }
            $.notify({
                // options
                title: "<strong>Complete:</strong> ",
                message: 'The product has been removed from the cart',
            }, {
                type: 'success',
                z_index: 2002,
                delay: 5000,
            });
        }).fail(function (data) {
            $.notify({
                // options
                title: "<strong>Fail:</strong> ",
                message: 'Server Error. Please try again.',
            }, {
                type: 'danger',
                z_index: 2002,
                delay: 5000,
            });
        });
    });

    /* Event Delete item in cart*/
    $('#cartDetail').on("click", ".delItemHeader", function () {
        var baseUrl = window.location.origin;
        var obj = this.id;
        var url = baseUrl + "/shop_project/public/checkout/del-item/" + obj;
        $.ajax({
            url: url,
            type: 'PUT',
        }).done(function (data) {
            $('#productWidget' + obj).remove();
            var old_sum_money = $('#olderTotal').text();
            var new_sum_money = $('#olderTotal').text(Math.round(old_sum_money - data));
            old_total = $('#totalProduct').text().replace(/[^\d.]/g, '');
            new_total = parseInt(old_total) - 1;
            $('#totalProduct').text('Your Cart(' + new_total + ')');
            $('#itemSelected').text(new_total + ' Item(s) selected');
            if (new_sum_money.text() <= 0) {
                $('#olderTotal').text(0);
                var strHtml = '';
                $('#cartDetail').empty();
                strHtml += '<br>'
                strHtml += '<h6 class="text-center">YOUR CART IS EMPTY</h6>'
                strHtml += '<br>'
                strHtml += '<div class="cart-btns">'
                strHtml += '<a href="#"disable>View Cart</a>'
                strHtml += '<a href="#">Checkout <i class="fa fa-arrow-circle-right" disable></i></a>'
                strHtml += '</div>'
                $(strHtml).appendTo('#cartDetail');
            }

            $.notify({
                // options
                title: "<strong>Complete:</strong> ",
                message: 'The product has been removed from the cart',
            }, {
                type: 'success',
                z_index: 2002,
                delay: 5000,
            });
        }).fail(function (data) {
            $.notify({
                // options
                title: "<strong>Fail:</strong> ",
                message: 'Server Error. Please try again.',
            }, {
                type: 'danger',
                z_index: 2002,
                delay: 5000,
            });
        });
    });

    $('.add-to-cart-btn').click(function (e) {
        e.preventDefault();
        var objClick = $(this);
        objUrl = objClick.parent().attr('href');
        $.ajax({
                url: objUrl,
                type: 'GET',
            })
            .done(function (data) {
                $('#cartDetail').empty();
                $('#totalProduct').text('Your Cart(' + data.products_count + ')')
                var strHtml = '';
                var product = data.products;
                var sum = 0;
                var count = 0;
                var baseUrl = window.location.origin + '/shop_project/public/';
                strHtml += '<div class="cart-list">'
                for (x in product) {
                    strHtml += '<div class="product-widget" id="productWidget' + product[x].id + '">'
                    strHtml += '<a href="' + baseUrl + 'product/' + product[x].id + '">'
                    strHtml += '<div class="product-img">'
                    strHtml += '<img src = "' + window.location.origin + '/shop_project/public/' + product[x].picture + '"alt = "" >'
                    strHtml += '</div>'
                    strHtml += '</a>'
                    strHtml += '<div class="product-body">'
                    strHtml += '<h3 class="product-name"><a href="' + baseUrl + 'product/' + product[x].id + '">' + product[x].name + '</a></h3>'
                    if (product[x].sale) {
                        strHtml += '<h4 class="product-price"><span class="qty">' + product[x].pivot.qty + 'x</span>' + (product[x].price - product[x].price * product[x].sale / 100) + '$</h4>'
                        strHtml += '</div>'
                        strHtml += '<button class="delete"><i class="fa fa-close delItemHeader" id="' + product[x].id + '"></i></button>'
                        strHtml += '</div>'
                        sum += (product[x].pivot.qty * (product[x].price - product[x].price * product[x].sale / 100));
                    } else {
                        strHtml += '<h4 class="product-price"><span class="qty">' + product[x].pivot.qty + 'x</span>' + product[x].price + '$</h4>'
                        strHtml += '</div>'
                        strHtml += '<button class="delete"><i class="fa fa-close delItemHeader" id="' + product[x].id + '"></i></button>'
                        strHtml += '</div>'
                        sum += (product[x].pivot.qty * product[x].price);

                    }
                    count++;
                }
                strHtml += '</div>'
                strHtml += '<div class="cart-summary">'
                strHtml += '<small id="itemSelected">' + count + ' Item(s) selected</small>'
                strHtml += '<h5>SUBTOTAL: <span id="olderTotal">' + sum + '</span>$</h5>'
                strHtml += '</div>'
                strHtml += '<div class="cart-btns">'
                strHtml += '<a href="' + baseUrl + 'checkout">View Cart</a>'
                strHtml += '<a href="' + baseUrl + 'checkout">Checkout <i class="fa fa-arrow-circle-right"></i></a>'
                strHtml += '</div>'
                $(strHtml).appendTo('#cartDetail');
                $.notify({
                    // options
                    title: "<strong>Complete:</strong> ",
                    message: 'The product has been added to cart',
                }, {
                    type: 'success',
                    z_index: 2002,
                    delay: 5000,
                });
            }).fail(function () {
                $.notify({
                    // options
                    title: "<strong>Fail:</strong> ",
                    message: 'Server Error. Please try again.',
                }, {
                    type: 'danger',
                    z_index: 2002,
                    delay: 5000,
                });
            })
    })
});