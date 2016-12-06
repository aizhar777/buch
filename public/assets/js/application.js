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
        link.html('Update products');
        wrp_box.find('.overlay').remove();
        console.log('products loaded');
        $('#trade_products_wrapper').trigger('trade.products.loaded');
    });
};

application.init = function () {
    this.listeners();
    this.showOrHideSubs();
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

    $('#is_responsible').on("ifToggled", function (event) {
        //var obj = $(this);
        $("#stock_responsible_wrap").toggle(this.checked);
    });

    $('#category_subcategory').on("ifToggled", function (event) {
        //var obj = $(this);
        $("#wrapper_category_parent").toggle(this.checked);
    });

    $('#is_responsible_subdivision').on("ifToggled", function (event) {
        //var obj = $(this);
        $("#subdivision_responsible_wrap").toggle(this.checked);
    });

    $('#trade_products_wrapper').bind('trade.products.loaded', function(event){
        $(this).find('#products_table').DataTable();
        $(this).find('.trade-produvct-amount').dblclick(self.showAmountProducts);
    });

    $('#upload_images').filer(self.getUploadSettingsObj());
};

application.showOrHideSubs = function () {
    this.showOrHide($('#category_subcategory'), $('#wrapper_category_parent'));
    this.showOrHide($('#is_responsible'), $('#stock_responsible_wrap'));
    this.showOrHide($('#is_responsible_subdivision'), $('#subdivision_responsible_wrap'));
};

application.showOrHide = function (obj, wrp) {
    if(obj.prop('checked')) {
        wrp.show();
    } else {
        wrp.hide();
    }
};

application.showAmountProducts = function () {
    $(this).hide();
    $(this).next().show();
};

application.onSuccessUploadImages = function (data, el) {
    var parent = el.find(".jFiler-jProgressBar").parent();
    var response = JSON.parse(data);
    var elem = {
        success: "<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success "+ response.message +"</div>",
        error: "<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error "+ response.message +"</div>",
        warning: "<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Warning "+ response.message +"</div>"
    };
    if(response.status == "success"){
        el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
            $(elem.success).hide().appendTo(parent).fadeIn("slow");
        });
    }else if (response.status == "warning"){
        el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
            $(elem.warning).hide().appendTo(parent).fadeIn("slow");
        });
    }else {
        el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
            $(elem.error).hide().appendTo(parent).fadeIn("slow");
        });
    }
};

application.onErrorUploadImages = function (el) {
    var parent = el.find(".jFiler-jProgressBar").parent();
    el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
        $("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
    });
};

application.updateAmountProducts = function (obj) {
    var form = $(obj).parent().parent().parent();
    var data = form.serialize();
    $(obj).html("<i class='fa fa-refresh fa-spin fa-fw'></i>");
    form.find('input,button').prop('disabled', true);
    $.ajax({
        url: form.attr('action'),
        method: "PUT",
        data: data
    }).done(function (data) {
        data = JSON.parse(data);
        form.find('input,button').prop('disabled', false);
        $(obj).html("<i class='ion ion-checkmark'></i>");
        form.hide();
        form.prev().html(form.find('input[name=amount]').val()).show();
        application.message(data.title ,data.message, data.status);
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

application.getUploadSettingsObj = function () {
    var form = $('#upload-images-form');
    return {
        limit: 10,
        maxSize: 6,
        extensions: ["jpg", "png", "gif"],
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item: '<li class="jFiler-item">\
                        <div class="jFiler-item-container">\
                            <div class="jFiler-item-inner">\
                                <div class="jFiler-item-thumb">\
                                    <div class="jFiler-item-status"></div>\
                                    <div class="jFiler-item-thumb-overlay">\
										<div class="jFiler-item-info">\
											<div style="display:table-cell;vertical-align: middle;">\
												<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
												<span class="jFiler-item-others">{{fi-size2}}</span>\
											</div>\
										</div>\
									</div>\
                                    {{fi-image}}\
                                </div>\
                                <div class="jFiler-item-assets jFiler-row">\
                                    <ul class="list-inline pull-left">\
                                        <li>{{fi-progressBar}}</li>\
                                    </ul>\
                                    <ul class="list-inline pull-right">\
                                        <li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
                                    </ul>\
                                </div>\
                            </div>\
                        </div>\
                    </li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            removeConfirmation: false,
            _selectors: {
                list: '.jFiler-items-list',
                item: '.jFiler-item',
                progressBar: '.bar',
                remove: '.jFiler-item-trash-action'
            }
        },
        uploadFile: {
            url: form.attr('action'), //URL to which the request is sent {String}
            data: form, //Data to be sent to the server {Object}
            type: 'POST', //The type of request {String}
            enctype: 'multipart/form-data', //Request enctype {String}
            synchron: false, //Upload synchron the files
            beforeSend: null, //A pre-request callback function {Function}
            success: application.onSuccessUploadImages, //A function to be called if the request succeeds {Function}
            error: application.onErrorUploadImages, //A function to be called if the request fails {Function}
            statusCode: null, //An object of numeric HTTP codes {Object}
            onProgress: null, //A function called while uploading file with progress percentage {Function}
            onComplete: function () {
                application.message('Upload Info', 'All images uploaded', 'info')
            }
        }
    };
};