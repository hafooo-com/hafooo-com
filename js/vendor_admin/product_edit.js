

// UPDATE TRANSLATION
$(".submitButton").on("click", function(){
    var theButton = $(this);
    var theIcon = theButton.find("i");
    var theForm = theButton.closest("form");
    var theUrl = theForm.attr("action");
    var theData = theForm.serialize();
    $.ajax({
        type: "post",
        url: theUrl,
        data: theData,
        beforeSend: function(){
            theIcon.removeClass("fa-save").addClass("fa-spinner fa-spin");
        },
        success: function(response){
            setTimeout(function(){
                theIcon.removeClass("fa-spinner fa-spin").addClass("fa-check");
                    setTimeout(function(){
                        theIcon.removeClass("fa-check").addClass("fa-save");
                    }, 5000);
            }, 500);
            // console.log(response);
        },
        error:  function(){
            setTimeout(function(){
                theIcon.removeClass("fa-spinner fa-spin").addClass("fa-exclamation-triangle");
                setTimeout(function(){
                    theIcon.removeClass("fa-exclamation-triangle").addClass("fa-save");
                }, 5000);
            }, 500);
        }
    });
});
// !UPDATE TRANSLATION

$("#product-edit-upload-image-input").on("change", function(){
    $("#progress-bar-upload-image-input").animate(
        {width: "100%"},
        3000,
        function(){
            $(this).closest("form").submit();
        }
    );
});

// DROPPABLE FILE INPUT BY DROPZONE.JS
/*
Dropzone.options.uploadImageForm = {
    paramName: "upload_product_images_input", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    resizeWidth: 1280,
    resizeHeight: 1280,
    createImageThumbnails: true,
    thumbnailWidth: 300,
    // sending: function(file, xhr, formData){
    //     console.log(2233);
    // },
    success: function(file, response){
        var result = JSON.parse(response);
        var params = '{' +
            '"listItem": "productImage_' + result.productMediaID + '",' +
            '"productMediaID": "' + result.productMediaID + '",' +
            '"imgName": "' + result.imgName + '",' +
            '"pageID": "' + result.pageID + '"' +
            '}';
        params = btoa(params);

        var lisstItemhtml =  '<li class="productImageContainer list-group-item" draggable="true" id="productImage_' + result.productMediaID + '">';
        lisstItemhtml = lisstItemhtml + '<div class="productImageWrapper">';
        lisstItemhtml = lisstItemhtml + '<img src="' + result.imagesPath + result.imgName + '" class="mx-auto d-block">';
        lisstItemhtml = lisstItemhtml + '</div><span class="productImageInfo"><p><strong>Image file name:</strong> ' + result.imgName ;
        lisstItemhtml = lisstItemhtml + '<p><strong><button class="btn btn-danger btn-sm py-0 delete-button delete-product-image-button"';
        lisstItemhtml = lisstItemhtml + ' data-warning-title="' + VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TITLE + '"';
        lisstItemhtml = lisstItemhtml + ' data-warning-text="' + VENDOR_ADMIN_PRODUCT_EDIT_IMAGES_DELETE_IMAGE_CONFIRM_TEXT + '"';
        lisstItemhtml = lisstItemhtml + ' data-callback-params="' + params + '"';
        lisstItemhtml = lisstItemhtml + ' data-callback-success="deleteProductImage" data-use-ajax="true"';
        lisstItemhtml = lisstItemhtml + ' data-action-url="/vendor_admin/products/ajax_delete_product_image">';
        lisstItemhtml = lisstItemhtml + ' <i class="fa fa-trash-alt"></i>&nbsp;  Remove image</button></strong></p></span></li>';

        $(".productImagesSortable").append( lisstItemhtml );


    },
    complete: function(response) {
    },
};
 */
// !DROPPABLE FILE INPUT BY DROPZONE.JS


$('.productImagesSortable').sortable({
    placeholderClass: 'productImageContainerPlaceholder',
});

$(".productImagesSortable").on("drag", function(){

});

$(".productImagesSortable").on("drop", function(){
    var theData = new Array();
    var items = $(".productImagesSortable").children( ".productImageContainer" );
    items.each(function(){
        theData.push( $(this).attr("id").replace("productImage_", "") );
    });

    $.ajax({
        type: "post",
        url: '/vendor_admin/products/ajax_sort_product_images',
        data: ({"data": theData}),
        beforeSend: function(){},
        success: function(response){},
        error:  function(){}
    });
});


//  DELETE IMAGE
function deleteProductImage(params){
    $(document).find("#" + params.listItem).slideUp(300);
}
//  !DELETE IMAGE

bsCustomFileInput.init();
























