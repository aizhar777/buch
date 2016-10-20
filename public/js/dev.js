$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    showOrHideParentCategory();

    $('#category_subcategory').click(function() {
        $("#wrapper_category_parent").toggle(this.checked);
    });

    function showOrHideParentCategory() {
        if($('#category_subcategory').prop('checked')) {
            $('#wrapper_category_parent').show();
        } else {
            $('#wrapper_category_parent').hide();
        }
    }
});