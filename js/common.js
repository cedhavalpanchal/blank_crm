/*
 @Description: Comman JS Functions
 @Author: Mit Makwana
 @Date: 29-3-2016
 */
(function($) {
    "user strict";
    var csf = function() {
        var c = this;
        $(document).ready(function() {
            c._initialize();
        });
    };
    var c = csf.prototype;
    c._initialize = function() {
        $(document).on('click', '.close-message', function() {
            $('#div_msg').hide('slow');
        });
        setTimeout(function() {
            $('#div_msg').hide('slow');
        }, 5000);
        $('.decimal_number').keypress(function(event) {
            if ((event.which != 46 || $(this).val().indexOf('.') != -1) && ((event.which < 48 || event.which > 57) && (event.which != 0 && event.which != 8))) {
                event.preventDefault();
            }
            var text = $(this).val();
            if ((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 4) && (event.which != 0 && event.which != 8) && ($(this)[0].selectionStart >= text.length - 5)) {
                event.preventDefault();
            }
        });
    };
    //Loader to be show
    c._showLoader = function() {
        $('#common_div').block({
            message: 'Loading...'
        });
    };
    //Loader to be hide
    c._hideLoader = function() {
        $.unblockUI();
    };
    window.csfApp = window.csfApp || {};
    window.csfApp.csf = new csf();
})(jQuery);