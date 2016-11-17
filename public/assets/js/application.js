window.application = {
    "urlEditSettings": '/settings/edit/',
    "idEditSettings": '#id_settings_',
    "image_path": "/upload/images/",
    "user_image_class": ".cur_pr_img",
    "get_products_form":"/products/get/form"
};

application.message = function (title, message, type) {
    new PNotify({
        title: title,
        text: message,
        type: type,
        styling: 'bootstrap3'
    });
};

application.updateSettings = function (slug) {
    var self = this;
    var value = '';
    var input = $(self.idEditSettings + slug+' input');
    input.attr("disabled", true);
    if(input.attr('type') == 'checkbox'){
        if(!input.prop('checked')){
            value = 1;
            $(self.idEditSettings + slug + ' span.check_label').html('ON');
        }else{
            $(self.idEditSettings + slug + ' span.check_label').html('OFF');
            value = 0;
        }
    } else if(input.attr('type') == 'text') {
        value = input.val();
    }else {
        return self.message("Oh No!", "Input value error", "error")
    }

    $.ajax({
        url: self.urlEditSettings + slug,
        dataType : "json",
        method: "PUT",
        data: {
            "value": value
        }
    }).done(function (data) {
        self.message(data.title, data.message, data.status);
        input.removeAttr("disabled");
    }).fail(function() {
        self.message("Oh No!", "Something terrible happened.", "error");
    });
};

application.productTradeOptions = function() {
    var self = this;
    var blockOptions = $('#options_block');
    var st = '<h4>Products:</h4>';
    var html = '';
    $( "#select_products option:selected" ).each(function() {
        var options = $( this );
        html += application.getInputForTradeOptions(options.text(), options.val(),options.attr('data-balance'),options.attr('data-service'));
    });
    blockOptions.html(st+html);
};

application.getInputForTradeOptions = function(title, id, max, is_service) {

    var maximum = '';
    if(is_service == '0'){
        maximum = 'max="' + max + '"';
    }
    return '<div class="form-group"><label>'
        + title
        + '</label><input type="number" min="1" '
        + maximum +' name="product_options['
        + id
        + ']" placeholder="Количество.." value="1" class="form-control"></div>';
};

application.getTradeProducts = function () {
    var wrp = $('#trade_products_wrapper'),
        wrp_box = $('#trade_box'),
        link = $('#show_trade_products');
    wrp_box.append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    $.get(link.attr('href'), function(data) {
        wrp.html(data);
        console.log('products loaded');
        link.html('Update products');
        wrp_box.find('.overlay').remove();
    });
};

application.init = function () {
    this.listeners();
};

application.getSelf = function () {
    return this;
};

application.listeners = function () {
    var self = this;
    var modal = $('#add-product-modal');
    $('.set_default_image').on( "click", self.setProfileImage);

    $('input.settings_switch').on("ifClicked", function (event) {
        var settings = $(this);
        self.updateSettings(settings.attr('data-slug'));
    });

    modal.on('show.bs.modal', self.addProductModal);
    modal.on('products.loaded', function () {
        $(this).find('.select2_multiple').select2({
            placeholder: "With Max Selection limit 4",
            allowClear: true
        });
        self.productTradeOptions();
    });
};

application.setProfileImage = function (event) {
    event.preventDefault();
    var link = $(this);
    var app = application.getSelf();
    $.ajax({
        url: link.attr('href'),
        method: "PUT",
        data: {
            "image": link.attr('data-image-id')
        }
    }).done(function(data) {
        var response = JSON.parse(data);
        if(response.status == "success"){
            application.message('Image Updated',response.message, response.status);
            $(app.user_image_class).attr("src", app.image_path + response.data.src);
        }else{
            application.message('Image Not Updated',response.message, response.status);
        }
    });
};

application.addProductModal = function (event) {
    var button = $(event.relatedTarget); // Кнопка, которая запускается модальное окно
    var recipient = button.data('trade'); // Извлечение информации из атрибутов: data-*
    var modal = $(this);
    modal.find('.modal-body').html('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    var self = application.getSelf();
    $.ajax({
        url: self.get_products_form + '/' + recipient,
        method: "GET"
    }).done(function(data) {
        modal.find('.modal-content input[name=trade]').val(recipient);
        modal.find('.modal-body').html(data);
        $("#add-product-modal").trigger( "products.loaded");
    });
};

application.addProductFormSend = function (asJson) {
    var form = $("#add_products_push");
    var url = form.attr('action');
    var form_data = form.serialize();
    if(asJson){
        form_data += "&json=1";
    }else{
        form_data += "&json=0";
    }
    console.log(form_data);
    $.ajax({
        method: 'PUT',
        url: url,
        data: form_data
    }).done(function (data) {
        if(asJson) {
            application.message("Add products",data.message, data.status);
        }else{
            $('#trade_products_wrapper').html(data);
        }
    });
    $('div.modal').modal('hide');
};