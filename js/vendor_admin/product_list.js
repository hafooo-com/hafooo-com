
$(function () {
    $("#products-list").DataTable({
        "responsive": true,
        "autoWidth": false,
    });
});


$(".product-stock-amount-refresh").on("click", function(){
    var pageID = $(this).data("pageid");
    var stockAmount = $("#product-stock-amount-" + pageID).val();
    var icon = $(this).find("i");
    console.log(stockAmount);
    $.ajax({
        type: "post",
        url: "/vendor_admin/products/ajax_product_update_stock_amount",
        data: ({"stockAmount": stockAmount, "pageID": pageID}),
        beforeSend: function(){
            if(!$.isNumeric(stockAmount) || stockAmount < 0) {
                icon.removeClass("fa-sync-alt").addClass("fa-exclamation-circle");
                setTimeout(function(){
                        icon.removeClass("fa-exclamation-circle").addClass("fa-sync-alt");
                    }, 3000
                );
                return false;
            }
            icon.addClass("fa-spin");
        },
        success: function(response){
            setTimeout(function(){
                    icon.removeClass("fa-spin").addClass("fa-check");
                    setTimeout(function(){
                            icon.removeClass("fa-check").addClass("fa-sync-alt");
                        }, 3000
                    );
                }, 500
            );
        },
        error:  function(){}
    });
})


$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
});
$("input[data-bootstrap-switch]").on('switchChange.bootstrapSwitch', function(event, state) {
    var pageID = $(this).data("pageid");
    var pageState = state == true ? 'ACTIVE' : 'INACTIVE';
    $.ajax({
        type: "post",
        url: "/vendor_admin/products/ajax_product_toggle_state",
        data: ({"state": pageState, "pageID": pageID}),
        beforeSend: function(){},
        success: function(response){},
        error:  function(){}
    });
});



