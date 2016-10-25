$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    showOrHideParentCategory();
    showOrHideResponsible();
    showOrHideResponsibleSub();

    $('#category_subcategory').click(function() {
        $("#wrapper_category_parent").toggle(this.checked);
    });


    $('#is_responsible').click(function() {
        $("#stock_responsible_wrap").toggle(this.checked);
    });


    $('#is_responsible_subdivision').click(function() {
        $("#subdivision_responsible_wrap").toggle(this.checked);
    });


    function showOrHideParentCategory() {
        if($('#category_subcategory').prop('checked')) {
            $('#wrapper_category_parent').show();
        } else {
            $('#wrapper_category_parent').hide();
        }
    }

    function showOrHideResponsible() {
        if($('#is_responsible').prop('checked')) {
            $('#stock_responsible_wrap').show();
        } else {
            $('#stock_responsible_wrap').hide();
        }
    }

    function showOrHideResponsibleSub() {
        if($('#is_responsible_subdivision').prop('checked')) {
            $('#subdivision_responsible_wrap').show();
        } else {
            $('#subdivision_responsible_wrap').hide();
        }
    }

    // Select2 start
    $(".select2_single").select2({
        placeholder: "Select a state",
        allowClear: true
    });
/*
    $(".select2_group").select2({
        placeholder: "With Max Selection limit"
    });*/
    $(".select2_multiple").select2({
        placeholder: "With Max Selection limit 4",
        allowClear: true
    });

    $( '#select_products' ).change(application.productTradeOptions);
    // Select2 end
});