$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Select2 start
    $(".select2_single").select2({
        placeholder: "Select a state",
        allowClear: true
    });
    $(".select2").select2();
/*
    $(".select2_group").select2({
        placeholder: "With Max Selection limit"
    });*/

    $(".select2_multiple").select2({
        placeholder: "With Max Selection limit 4",
        allowClear: true
    });

    $( '#add-product-modal' ).on("change","#select_products",application.productTradeOptions);
    // Select2 end

    $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    $('input.settings_switch').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue'
    });

    application.init();
});