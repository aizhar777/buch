$(document).ready(function(){

    showOrHideParentCategory();

    $('#category_subcategory').click(function() {
        $("#wrapper_category_parent").toggle(this.checked);
    });

    function showOrHideParentCategory() {
        if(document.getElementById('category_subcategory').checked) {
            $('#wrapper_category_parent').show();
        } else {
            $('#wrapper_category_parent').hide();
        }
    }
});