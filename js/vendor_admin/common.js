
function deleteTableRow(id){
    console.log(id);
}
// DELETE CONFIRM
$(".delete-button").on("click", function(){
    var theButton = $(this);
    var myConfirm = $('#delete-confirm-modal');
    var confirmText = theButton.data("warning-text");
    var action = theButton.data("action-url");
    var cb = theButton.data("callback").split("|");
    var callback = cb[0];
    var param = (typeof cb[1] === 'undefined') ? '' : cb[1];

    // myConfirm.find("#delete-confirm-text").html(confirmText);
    // myConfirm.modal();

    // console.log(callback);
    console.log(param);

    if(1==1){
        if(theButton.data("use-ajax") == true){
            $.ajax({
                type: "post",
                url: action,
                data: ({}),
                beforeSend: function(){
                    // $("body").cb[0](cb[1]);
                    eval(callback + "(" + param + ")");
                },
                success: function(response){
                    console.log(response);
                },
                error:  function(){}
            });
        }
        else{

        }
    }
});



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



