$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    showOrHideParentCategory();
    showOrHideResponsible();

    $('#category_subcategory').click(function() {
        $("#wrapper_category_parent").toggle(this.checked);
    });


    $('#is_responsible').click(function() {
        $("#stock_responsible_wrap").toggle(this.checked);
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
});