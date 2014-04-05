(function ($, undefined) {
    //Util functions
    window.Util = {};

    /**
     * Redirect after some seconds (default: 5 seconds to main page)
     * @param selector - container for seconds
     * @param {object} [passedOptions]
     */
    window.Util.redirect = function (selector, passedOptions) {
        var $redirectSpan = $(selector);

        if ($redirectSpan.length > 0) {
            var options = {},
                oneTick = function () {
                    if (options.seconds > 0) {
                        $redirectSpan.text(options.seconds--);
                    } else {
                        window.location.href = options.target;
                    }
                };

            options.seconds = $redirectSpan.data('seconds') ? $redirectSpan.data('seconds') : 5;
            options.target = $redirectSpan.data('target') ? $redirectSpan.data('target') : '/';

            if (passedOptions) {
                options = $.extend(options, passedOptions);
            }

            oneTick();
            setInterval(oneTick, 1000);
        }
    };

    window.Util.mergeObjects = function (base, second, notReplaceExisting) {
        for (var key in second) {
            if (second.hasOwnProperty(key)) {
                if (notReplaceExisting) {
                    if (base.hasOwnProperty(key)) continue;
                }

                base[key] = second[key];
            }
        }

        return base;
    };


    window.Util.parseQueryParams = function () {
        var params = {};
        var splittedHref = window.location.href.split('?')

        if (splittedHref.length > 1) {
            var paramsSplitted = splittedHref[1].split('&');
            var paramsSplittedLength = paramsSplitted.length;

            for (var i = 0; i < paramsSplittedLength; i++) {
                var param = paramsSplitted[i].split('=');

                if (param.length === 2) {
                    params[param[0]] = param[1];
                }
            }
        }

        return params;
    };

    window.Util.getQueryParamsString = function (params) {
        var resultString = '';
        var delimiter = '?';

        for (var param in params) {
            if (params.hasOwnProperty(param)) {
                resultString += delimiter + param + '=' + params[param];

                if (delimiter === '?') {
                    delimiter = '&';
                }
            }
        }

        return resultString;
    };

    window.Util.addParamsToQuery = function (params) {
        params = window.Util.mergeObjects(window.Util.parseQueryParams(), params);

        window.location.href = window.location.href.split('?')[0] + window.Util.getQueryParamsString(params);
    };

    window.Util.removeParamsFromQuery = function (params) {
        var currentParams = window.Util.parseQueryParams();

        for (var param in params) {
            if (params.hasOwnProperty(param)) {
                if (currentParams.hasOwnProperty(param)) {
                    delete currentParams[param];
                }
            }
        }

        window.location.href = window.location.href.split('?')[0] + window.Util.getQueryParamsString(currentParams);
    };
})(window.jQuery);

$(function () {
    $('#newMSG').on('hide.bs.modal', function () {
        $("#newMSG input[type=text]").val('');
        $("#newMSG textarea").val('');
    });

    $("#download-contacts").click(function (event) {
        $.ajax({
            beforeSend: function (event) {
                $("#empty-contacts .text").hide();
                $("#empty-contacts .downloading").show();
            },
            url       : "/ajax/LoadPhonebook",
            type      : "POST",
            data      : {
                sim_id: $("#currentSimCard").val()
            },
            success   : function (response) {

                $("#empty-contacts .downloading").hide();
                response = JSON.parse(response);
                if (response.success) {
                    $("#empty-contacts .success").show();
                } else if (response.failure) {
                    $("#empty-contacts .error").show();
                }

            }
        });
    });

});

$(document).ready(function () {
    var options = {
        beforeSubmit: showRequest,
        success     : showResponse,
        url         : '/dashboard/SendMessage',
        type        : "GET",
        data        : {
            action: 'sendNew'
        }
    };

    $('#send-new-msg').keypress(function (e) {
        if (e.which == 13)
            if ($(e.target).attr('id') == 'inputTo')
                return false;
    });

    $('#send-new-msg').ajaxForm(options);
});

function showRequest(formData, jqForm, options) {
    var queryString = $.param(formData);

    if (!phone_valid($("[name=send-new-msg-to]").val())) {
        var phoneRight = false;
        $("[name=send-new-msg-to]").closest('.form-group').addClass(' has-error');
    } else {
        var phoneRight = true;
        $("[name=send-new-msg-to]").closest('.form-group').removeClass(' has-error');
    }


    if (!$("[name=send-new-msg-txt]").val()) {
        var textRight = false;
        $("[name=send-new-msg-txt]").closest('.form-group').addClass(' has-error');
    } else {
        var textRight = true;
        $("[name=send-new-msg-txt]").closest('.form-group').removeClass(' has-error');
    }


    if (textRight && phoneRight) {
        $("#send-new-msg .alert-danger").hide();
        return true;
    } else {
        $("#send-new-msg .alert-danger").show();
        return false;
    }
}

function showResponse(responseText, statusText, xhr, $form) {
    var result = responseText.result;
    var errorMessage = responseText.errorMessage;

    if (result) {
        window.location.reload();
    } else {
        $("#send-new-msg .alert-danger").html("<strong>Oh snap!</strong> " + errorMessage);
        $("#send-new-msg .alert-danger").show();
    }
}

function phone_valid(inputtxt) {
    var phoneno = /^\+?([0-9]{1,2})\)?[(]?([0-9]{3})[)]?([0-9]{7})$/;
    if (inputtxt.match(phoneno)) {
        return true;
    } else {
        return false;
    }
}