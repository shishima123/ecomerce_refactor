$(document).ready(function () {
    /* Show/Hide layout create */
    $('#btnAdd').click(function () {
        $('#btnAdd').toggleClass('btn-primary btn-danger');
        $('#iconBtnAdd').toggleClass('fa-plus fa-minus');
        $('#layoutCreate').toggle(500);
    });

    /* Reset value input form */
    $('#btnReset').click(function () {
        $('input').val('');
    });

    /* Show/Hide password */
    $('#btnShowPw').click(function (e) {
        e.preventDefault();
        var chkAttr = $('#txtPassword').attr('type');
        if (chkAttr === 'password') {
            $('#txtPassword').attr('type', 'text');
            $('#txtPasswordConfirm').attr('type', 'text');
            $('#btnShowPw').text('Hide Password');
        } else {
            $('#txtPassword').attr('type', 'password');
            $('#txtPasswordConfirm').attr('type', 'password');
            $('#btnShowPw').text('Show Password');
        }
    });

    /* Hide flash message*/
    $('#alertMessage').delay(5000).slideUp(1000);

    /* Show/Hide button choose image in admin.user.eidt*/
    $('#tabProfile').click(function () {
        $('#changeImage').slideUp(400);
    });

    /* Show/Hide button change Image in admin.user.edit*/
    $('#tabEdit').click(function () {
        $('#changeImage').slideDown(400);
    });

    /* Change active/unactive Input Sale Off in Create admin.product.index*/
    $('#chkbSaleOff').change(function () {
        $('#txtSaleOff').prop('disabled', !this.checked);
    });

    /* Add more button addImage in admin.product.index*/
    $('#addImage').click(function () {
        $('#insertImage').append('<input class="my-2" type="file" name="picProductDetail[]"/>')
    });

    /* Event Delete sub-picture in admin.product.index*/
    $('.delImg').click(function () {
        var baseUrl = window.location.origin;
        var url = baseUrl + "/shop_project/public/admin/product/delimg/" + this.id;
        console.log(url);
        var idDivImg = this.id;
        $.ajax({
            url: url,
            type: 'PUT',
            data: {
                "_token": $('#token').val()
            },
            success: function (data) {
                if (data == 'true') {
                    $('#img-' + idDivImg).remove();
                }
            },
        });
    });
});