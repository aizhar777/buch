window.application = {
    "urlEditSettings": '/settings/edit/',
    "idEditSettings": '#id_settings_'
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
        if(input.prop('checked')){
            value = 1;
            $(self.idEditSettings + slug+' span.check_label').html('ON');
        }else{
            $(self.idEditSettings + slug+' span.check_label').html('OFF');
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
    console.log('changed!');
    var blockOptions = $('#options_block');
    var st = '<h4>Products:</h4>';
    var html = '';
    $( "#select_products option:selected" ).each(function() {
        var options = $( this );
        html += window.application.getInputForTradeOptions(options.text(), options.val(),options.attr('data-balance'));
        //console.log($( this ));
    });
    console.log('START:-'+html+'-:END');
    blockOptions.html(st+html);
};

application.getInputForTradeOptions = function(title, id, max) {
    return '<div class="form-group"><label class="control-label col-md-3 col-sm-3 col-xs-12">'
        + title
        + '</label><div class="col-md-9 col-sm-9 col-xs-12"><input type="number" min="1" max="'
        + max +'" name="product_options['
        + id
        + ']" placeholder="Количество.." value="1" class="form-control"></div></div>';
};

application.getTradeProducts = function () {
    var wrp = $('#trade_products_wrapper'),
        link = $('#show_trade_products');
    link.html('<i class="fa fa-refresh fa-spin fa-fw"></i> loading..');
    $.get(link.attr('href'), function(data) {
        wrp.html(data);
        console.log('products loaded');
    });
};