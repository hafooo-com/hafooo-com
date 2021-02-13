
$("#btn-dict").on("click", function(){
    var data = $(this).closest("form").serialize();
    $.ajax({
        type: "post",
        url: "/admin/dictionary/ajax_add_phrase",
        data: (data),
        success: function(response){
            $("#dict-reponse").val(response);
            console.log(response);
        }
    })
    return false;
})