

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
            console.log(response);
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
    console.log(theData);
});

// DROPPABLE FILE INPUT BY DROPZONE.JS
// $(".dropzone1").dropzone({ url: "/vendor_admin/products/ajax_upload_image" });
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
        console.log(response);
    },
    complete: function(file) {
        // if (file.previewElement) {
        //     return file.previewElement.classList.add("dz-success"),
        //         $(function(){
        //             setTimeout(function(){
        //                 $('.dz-success').fadeOut('slow');
        //             },2500);
        //         });
        // }
    },
    // accept: function(file, done) {
    //     if (file.name == "justinbieber.jpg") {
    //         done("Naha, you don't.");
    //     }
    //     else { done(); }
    // }
};

