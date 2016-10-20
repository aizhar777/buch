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