

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};

function deleteTableRow(id){
    console.log(id);
}

$(function() {
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "100000",
        "timeOut": "500000",
        "extendedTimeOut": "100000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    var toasterType = getUrlParameter('toast-type');
    var toasterMessage = getUrlParameter('toast-message');

    if(toasterMessage.length > 0 && toasterType.length > 0){
        if( toasterType == "success" ) toastr.success( toasterMessage );
        if( toasterType == "error" ) toastr.error( toasterMessage );
        if( toasterType == "info" ) toastr.info( toasterMessage );
        if( toasterType == "warning" ) toastr.warning( toasterMessage );
    }
});

// DELETE CONFIRM
$(document).on("click", ".delete-button", function(){
    var theButton = $(this);
    var myConfirm = $('#delete-confirm-modal');
    var confirmTitle = theButton.data("warning-title");
    var confirmText = theButton.data("warning-text");
    var action = theButton.data("action-url");
    var callbackSuccess = theButton.data("callback-success");
    var callbackParams = JSON.parse( atob( theButton.data("callback-params") ) );

    myConfirm.find("#delete-confirm-title").html(confirmTitle);
    myConfirm.find("#delete-confirm-text").html(confirmText);
    myConfirm.modal();

    $("#delete-confirm-button-continue").on("click", function (){
        myConfirm.modal('hide');
        if(theButton.data("use-ajax") == true){
            $.ajax({
                type: "post",
                url: action,
                data: (callbackParams),
                beforeSend: function(){
                    // $("body").cb[0](cb[1]);
                },
                success: function(response){
                    console.log(response);
                    var fn = window[callbackSuccess];
                    fn(callbackParams);
                },
                error:  function(){}
            });
        }
        else{

        }
    });

    // console.log(callback);
    // console.log(param);


});


//  TOASTER ALERT

$(".showToaster").on("click", function(){
    showToaster($(this).data("toasterType"), $(this).data("toasterMessage"));
});
// !TOASTER ALERT

// INPUT LENGTH COUNTER
$(window).on("load", function () {
    $(".inputLengthCounter").click();
});
$(".inputLengthCounter").on("keyup click", function(){
    var inp = $(this);
    var textLength = inp.val().length;
    var counter = inp.siblings(".lengthCounter").find("span");
    var minLength = counter.data("important-min-length") * 1;
    var maxLength = counter.data("important-max-length") * 1;
    // console.log(minLength);
    // console.log(maxLength);
    if(textLength < 10){
        counter.removeClass("bg-success, bg-warning").addClass("bg-danger");
    }
    else if(textLength > minLength && textLength < maxLength){
        counter.removeClass("bg-danger, bg-warning").addClass("bg-success");
    }
    else{
        counter.removeClass("bg-success, bg-danger").addClass("bg-warning");
    }
    counter.text(textLength);
})



