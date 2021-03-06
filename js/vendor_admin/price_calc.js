

//  COMPUTE PRICE
$(".product-price-button-recalc").on("click", function(){
    var theButton = $(this);
    var icon = $(this).find("i");
    var currency = $(this).data("currency-code");
    $.ajax({
        type: "post",
        url: "/vendor_admin/products/ajax_compute_price",
        data: ({"preferredCurrency": vendorPreferredCurrency, "currency": currency, "pageID": pageID}),
        beforeSend: function(){
            // if(!$.isNumeric(price)) {
            //     icon.removeClass("fa-calculator").addClass("fa-exclamation-circle");
                setTimeout(function(){
                        icon.removeClass("fa-exclamation-circle").addClass("fa-calculator");
                    }, 3000
                );
                // return false;
            // }
            icon.removeClass("fa-calculator").addClass("fa-spinner fa-spin");
        },
        success: function(response){
            console.log(response);
            setTimeout(function(){
                icon.removeClass("fa-spinner fa-spin").addClass("fa-check");
                $("#product-price-input-" + currency).val(response);
                $("#product-price-button-save-" + currency).find("i").addClass("faa-shake animated");

                    setTimeout(function(){
                            icon.removeClass("fa-check").addClass("fa-calculator");
                        }, 3000
                    );
                }, 500
            );
        },
        error:  function(){
            setTimeout(function(){
                    icon.removeClass("fa-spinner fa-spin").addClass("fa-exclamation-circle");
                    setTimeout(function(){
                            icon.removeClass("fa-check").addClass("fa-calculator");
                        }, 3000
                    );
                }, 500
            );
        }
    })
});


//  SAVE PRICE
$(".product-price-button-save").on("click", function(){
    var theButton = $(this);
    var icon = $(this).find("i");
    var currency = $(this).data("currency-code");
    var price = $("#product-price-input-" + currency).val().replace(",", ".");
    $("#product-price-input-" + currency).val(price);


    $.ajax({
        type: "post",
        url: "/vendor_admin/products/ajax_update_price",
        data: ({"price": price, "currency": currency, "pageID": pageID}),
        beforeSend: function(){
            if(!$.isNumeric(price)) {
                icon.removeClass("fa-save").addClass("fa-exclamation-circle");
                setTimeout(function(){
                        icon.removeClass("fa-exclamation-circle").addClass("fa-save");
                    }, 3000
                );
                return false;
            }
            icon.removeClass("fa-save").addClass("fa-spinner fa-spin");
        },
        success: function(response){
            console.log(response);
            setTimeout(function(){
                var result = JSON.parse(response);
                    icon.removeClass("fa-spinner fa-spin faa-shake animated").addClass("fa-check");
                    showToaster(result.toasterMessage, result.toasterType);
                    setTimeout(function(){
                            icon.removeClass("fa-check").addClass("fa-save");
                        }, 3000
                    );
                }, 500
            );
        },
        error:  function(){
            setTimeout(function(){
                    icon.removeClass("fa-spinner fa-spin").addClass("fa-exclamation-circle");
                    setTimeout(function(){
                            icon.removeClass("fa-check").addClass("fa-save");
                        }, 3000
                    );
                }, 500
            );
        }
    })
    return false;
});

