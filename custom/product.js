$(document).ready(function() {
    var subdepartmentid = '';
    var maincategoryid = '';
    var subcategoryid = ''; 
    var priceDiv = $('#priceDiv').html();
    var ProductJSON, prod_id, mode,mode_price;
    $.when(getProduct()).done(function() {
        localStorage.clear();
        dispProduct(ProductJSON);
    }); 

    function getProduct() {
        $(".loading").show();
        return $.ajax({
            url: base_URL + 'Amuthasurabi/getProduct',
            type: 'POST',
            success: function(data) { 
                $(".loading").hide();
                ProductJSON = $.parseJSON(data); 
            },
            error: function() {
                console.log("Error");  
            }
        });
    }

    $(document).on('click', '.BtnEdit', function() {
        $('#sc_id').html(''); 
        mode = "update";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        $('#largeModal').modal('show');

        $('#mc_id').val(ProductJSON[r_index].mc_id);
        $('#sc_id').val(ProductJSON[r_index].sc_id); 
        subdepartmentid = ProductJSON[r_index].sc_id; 
        //alert(maincategoryid);
        //alert(subcategoryid);
        changemaindept(ProductJSON[r_index].mc_id,ProductJSON[r_index].sc_id); 
        var data = {
            "mc_id": $("#mc_id").val()
        };
        // callAjaxDropdown(data, "1", ProductJSON[r_index].sc_code);
        $('#prod_code').val(ProductJSON[r_index].prod_code);
        //quill.setContents(ProductJSON[r_index].productDetail);
        $('#prod_name').val(ProductJSON[r_index].prod_name);
        $('#prod_price').val(ProductJSON[r_index].prod_price);
        $('#prod_quantity').val(ProductJSON[r_index].prod_quantity);
        $('#unit_id').val(ProductJSON[r_index].unit_id);

        $('#prod_info').val(ProductJSON[r_index].prod_info);
        CKEDITOR.instances['editor1'].setData(ProductJSON[r_index].prod_info);


        // $('#nutrition_info').val(ProductJSON[r_index].nutrition_info);
        $('#prod_storageuses').val(ProductJSON[r_index].prod_storageuses);
            var $select = $("#diet_type_id").selectize();
            var selectize = $select[0].selectize;
            var yourDefaultIds = ProductJSON[r_index].diet_type_id; 
            selectize.setValue(yourDefaultIds);

    }); 

    function changemaindept(mc_id,sc_id){
        return $.ajax({
            url: base_URL + 'Amuthasurabi/getCustomSubCategoryData',
            type: 'POST',
            data: {
                "mc_id": mc_id
            },
            success: function(data) {
                $(".loading").hide();
                SubDepatmentJSON = $.parseJSON(data);
               $('#sc_id').html('');
               $('#sc_id').append("<option value=''>Select the Sub Department</option>");
                for (var i = 0; i < SubDepatmentJSON.length; i++) {
                    $('#sc_id').append("<option data-attrb-display_name='"+SubDepatmentJSON[i].sub_category_name+"' value='" + SubDepatmentJSON[i].sub_category_id + "'>" + SubDepatmentJSON[i].sub_category_name + " ( " + SubDepatmentJSON[i].sub_category_id + " )</option>");
                    //  $('#state_id').append("<option value='"+JSON[i].state_id+"'>"+JSON[i].name+"</option>");
                }
                $("#sc_id").val(sc_id);
            },
            error: function() {
                console.log("Error");
            }
        });
    }


    $(document).on('change', '#mc_id', function() {
        var mc_id = $('#mc_id').val();
        $('#sc_id').val('');
        $('#sc_id').html('');
        $('#sc_id').append("<option value=''>Select the Sub Category</option>"); 
        return $.ajax({
            url: base_URL + 'Amuthasurabi/getCustomSubCategory',
            type: 'POST',
            data: {
                "main_category_id": mc_id
            },
            success: function(data) {
                SubDepatmentJSON = $.parseJSON(data); 
                for (var i = 0; i < SubDepatmentJSON.length; i++) {
                    $('#sc_id').append("<option value='" + SubDepatmentJSON[i].sub_category_id + "'>" + SubDepatmentJSON[i].sub_category_name + " ( " + SubDepatmentJSON[i].sub_category_id + " )</option>");
                    //  $('#state_id').append("<option value='"+JSON[i].state_id+"'>"+JSON[i].name+"</option>");
                }
            },
            error: function() {
                console.log("Error"); 
            }
        });
    }); 


    function dispProduct(JSON) { 
        $('#Product').dataTable({
            "aaSorting": [],
            "aaData": JSON,
            responsive: true,
            scrollX: true,
            scrollCollapse: true,
            stateSave: true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('offersDataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('offersDataTables'));
            },
            paging: true,
            "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]], 

            "aoColumns": [{
                "mDataProp": "mc_name"
            }, {
                "mDataProp": "sub_category_name"
            }, {
                "mDataProp": "prod_name"
            }, {
                "mDataProp": function(data, type, full, meta) {
                    if (data.prod_imgurl !== null) 
                        return "<div class='pro-im'>" +
                        "<img src='" +base_URL+ data.prod_imgurl + "' alt='user' width=100>" +
                        "<div class='pro-img-overlay'>" +
                        "<ul class='pro-img-overlay-1'>" +
                        "<li class='el-item'>" +
                        "<a class='btn default btn-outline image-popup-vertical-fit el-link' target='blank' href='"+base_URL + data.prod_imgurl + "'>" +
                        "<i class='fa fa-eye'></i></a>" +
                        "</li>" +
                        "</ul></div></div>";
                    else
                        return '';
                }
            }, {
                "mDataProp": function(data, type, full, meta) {
                    return '<a id="' + meta.row + '" class="addImage"><i class="fa fa-plus" aria-hidden="true"></i></a>' +
                        '<a id="' + meta.row + '" class="btn BtnImageEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;';

                }
            },  
            {
                "mDataProp": function(data, type, full, meta) {
                    if (data.out_of_stack == 1)
                        return '<a id="' + meta.row + '" class="btn btninstock" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;  Instock</a>&nbsp;&nbsp;';
                    else
                        return '<a id="' + meta.row + '" class="btn btnoutofstock" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa  fa-times-circle-o " aria-hidden="true"></i>&nbsp;  Out of stock</a>&nbsp;&nbsp;';;

                }
            },

            {
                "mDataProp": function(data, type, full, meta) {
                    if (data.product_flag == 1)
                        return '<a id="' + meta.row + '" class="btn Btnhidden" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;  visible</a>&nbsp;&nbsp;';
                    else
                        return '<a id="' + meta.row + '" class="btn BtnRestore" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa  fa-times-circle-o " aria-hidden="true"></i>&nbsp;  Hidden</a>&nbsp;&nbsp;';;

                }
            }, 

            {
                "mDataProp": function(data, type, full, meta) {
                    if (data.best_offer == 1)
                        return '<a id="' + meta.row + '" class="btn activeBestOffer btn-info" style="padding:0px;color:#fff;padding:0px 10px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;  Yes</a>&nbsp;&nbsp;';
                    else
                        return '<a id="' + meta.row + '" class="btn deactiveBestOffer btn-secondary" style="padding:0px;color:#fff;padding:0px 10px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa  fa-times-circle-o " aria-hidden="true"></i>&nbsp;  No</a>&nbsp;&nbsp;';;

                }
            }, 
            {
                "mDataProp": function(data, type, full, meta) {
                    if (data.top_saver == 1)
                        return '<a id="' + meta.row + '" class="btn activeTopSaver btn-info" style="padding:0px;color:#fff;padding:0px 10px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;  Yes</a>&nbsp;&nbsp;';
                    else
                        return '<a id="' + meta.row + '" class="btn deavtiveTopSaver btn-secondary" style="padding:0px;color:#fff;padding:0px 10px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa  fa-times-circle-o " aria-hidden="true"></i>&nbsp;  No</a>&nbsp;&nbsp;';;

                }
            }, 
            {
                "mDataProp": function(data, type, full, meta) {

                        return '<a id="' + meta.row + '" class="btn BtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;';
                            // '<a id="' + meta.row + '" class="btn BtnDelete" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';

                }
            }, ],
        });
        $(".loading").hide();
    }

    //active deactive top saver
    $(document).on('click', '.activeTopSaver', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 0;
        RestoreTopSaver(prod_id,flag);
    });


    $(document).on('click', '.deavtiveTopSaver', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 1;
        RestoreTopSaver(prod_id,flag);
    });


    function RestoreTopSaver(prod_id,flag)
    {
        var prod_id = prod_id;
        var flag = flag;
        request = $.ajax({
                type: "POST",
                url: base_URL+'Amuthasurabi/RestoreTopSaver',
                data: {"prod_id":prod_id,"flag":flag},
        }); 
        request.done(function(response) {
            var js = $.parseJSON(response);
            var status = js.result
            if (status == "success") {
                refreshDetails();
            } else {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Error',
                    content: 'Sorry Something went worng please try again',
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            }
        });
    }

    //actve deactive best offer

    $(document).on('click', '.activeBestOffer', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 0;
        RestoreBestOffer(prod_id,flag);
    });


    $(document).on('click', '.deactiveBestOffer', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 1;
        RestoreBestOffer(prod_id,flag);
    });


    function RestoreBestOffer(prod_id,flag)
    {
        var prod_id = prod_id;
        var flag = flag;
        request = $.ajax({
                type: "POST",
                url: base_URL+'Amuthasurabi/RestoreBestOffer',
                data: {"prod_id":prod_id,"flag":flag},
        }); 
        request.done(function(response) {
            var js = $.parseJSON(response);
            var status = js.result
            if (status == "success") {
                refreshDetails();
            } else {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Error',
                    content: 'Sorry Something went worng please try again',
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            }
        });
    }

    /*Add Thumbnail images for product start*/

    $(document).on('click', '.addImage', function() {
        mode = "insert"
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        $('#addImageForm').modal('show');
        $('#hidden_id').val(prod_id);
    });

    $(document).on('click', '.BtnImageEdit', function() {
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        $('#imageEditForm').modal('show');
        $('#hidden_id1').val(prod_id);

        request = $.ajax({
            type: "POST",
            url: base_URL + 'Amuthasurabi/getProductImages',
            data: {
                "prod_id": prod_id
            },
        });
        request.done(function(response) {
            var result = $.parseJSON(response); 

            $('#user_uploaded_image1').html('');
            if (result[0].product_image_url == "") {
                $('#user_uploaded_image1').append("No image Uploaded yet");
            } else {
                var images = result[0].product_image_url;
                var image_id = result[0].product_image_id;
                var imageName = images.split(",");
                var imageId = image_id.split(",");
                for (var i = 0; i < imageName.length && imageId.length; i++) {
                    // console.log(imageName[i]);
                    $('#user_uploaded_image1').append('<div class="image-display" id="image-display' + imageId[i] + '"><div><img src="' +base_URL+ imageName[i] + '" class="user-update-image" alt="user profile" width="100px" style="padding-top: 15px;"></div><div class="image-delete-icon" style="cursor:pointer;"><i class="fa fa-trash image-delete" id="' + imageId[i] + '"></i></div></div>');
                }
            }
        });
    });

    /*====== Start Delete image ======*/

    $(document).on('click', '.image-delete', function() {
        //mode = "delete";
        var productImageId = $(this).attr('id');
        $.confirm({
            title: 'Delete',
            content: 'Are you sure you want to delete this image ?',
            type: 'blue',
            buttons: {
                ok: function() {
                    request = $.ajax({
                        type: "POST",
                        url: base_URL + 'Amuthasurabi/deleteThumbnaiImage',
                        data: {
                            "product_image_id": productImageId
                        },
                        success: function(data) {
                            //                            $("#image-display").load(" #image-display > *");
                            $('#image-display' + productImageId).remove();
                            $.confirm({
                                icon: 'icon-close',
                                title: 'Info',
                                content: 'Deleted Succesfully',
                                type: 'green',
                                buttons: {
                                    Ok: function() {
                                        $('#imageEditForm').modal('hide');
                                    },
                                }
                            });
                        },
                        error: function() {
                            console.log("Error");
                        }
                    });
                },
                cancel: function() {

                }
            }
        });

    });
    /*====== End Delete image ======*/


    $('#upload_image').click(function() {
        if (mode == "insert") {
            insertThumbnaiImage();
        }
    });

    function insertThumbnaiImage() {
        var form = $('#product_image_form')[0];
        var data = new FormData(form);
        return $.ajax({
            url: base_URL + 'Amuthasurabi/InsertProductThumbnailImage',
            method: "POST",
            data: data,
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                var js = $.parseJSON(data);
                var status = js.result
                if (status == "success") {
                    $.confirm({
                        icon: 'icon-close',
                        title: 'Info',
                        content: 'Inserted Sucessfully',
                        type: 'green',
                        buttons: {
                            Ok: function() {},
                        }
                    });
                    $('#addImageForm').modal('hide');
                    refreshDetails();
                } else if (status == "imgerror") {

                    $.confirm({
                        icon: 'icon-close',
                        title: 'Info',
                        content: 'Please Do check your image size and upload <br> max size of img 2000000',
                        type: 'red',
                        buttons: {
                            Ok: function() {},
                        }
                    });
                } else {
                    $.confirm({
                        icon: 'icon-close',
                        title: 'Error',
                        content: 'Sorry Something went worng please try again',
                        type: 'red',
                        buttons: {
                            Ok: function() {},
                        }
                    });
                }
            },
            error: function() {
                console.log("Error");
            }
        });
    }

    $('#addImageForm').on('show.bs.modal', function() {
        $(this).find('form').trigger('reset');
    });

    /*Add Thumbnail images for product end*/

    $('#New_Category').click(function() {
        $('#sc_id').val('');
        $('#mc_code').val('');
        $('#sc_code').val('');
        subdepartmentid = '';
        maincategoryid = '';
        subcategoryid = '';
        mode = "new";
        $('#largeModal').modal({
              backdrop: 'static',
             keyboard: false 
        }) 
    });

    $(document).on('click', '.BtnDelete', function() {
        mode = "delete";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Delete this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                    request = $.ajax({
                        type: "POST",
                        url: base_URL + 'YallaBasketCon/DeleteProductsData',
                        data: {
                            "prod_id": prod_id
                        },
                    });
                    request.done(function(response) {
                        var js = $.parseJSON(response);
                        var status = js.result
                        if (status == "success") {
                            $.confirm({
                                icon: 'icon-close',
                                title: 'Info',
                                content: 'Deleted Succesfully',
                                type: 'green',
                                buttons: {
                                    Ok: function() {},
                                }
                            });
                            refreshDetails();
                        } else {
                            $.confirm({
                                icon: 'icon-close',
                                title: 'Info',
                                content: 'Are you Sure Do you want to Delete this Data',
                                type: 'blue',
                                buttons: {
                                    No: function() {},
                                }
                            });
                        }

                    });
                },
                No: function() {},
            }
        });
    });


    $('#largeModal').on('show.bs.modal', function() {
        clearDropdown();
        $('.error').hide();
        $('#sc_id').val('');
        $('#mc_code').val('');
        $('#sc_code').val('');
        subdepartmentid = '';
        maincategoryid = '';
        subcategoryid = '';
        $(this).find('form').trigger('reset');
        $('.error').hide();
        $('iframe').contents().find('body').empty();
    });

    $('#priceModel').on('show.bs.modal', function() {
        $(this).find('form').trigger('reset');
        $('.selling_price_div').html('');
        $('.market_div').html('');
    });

    $('#Product_Button').click(function() {
        $('.error').hide();
        //console.log($('#mcName').val());
        if ($('#mc_id').val() == "") {
            $('.mc_id').html("* Please Select Category Name");
            $('.mc_id').show();
        } else if ($('#sc_id').val() == "") {
            $('.sc_id').html("* Please Select Sub Category Name");
            $('.sc_id').show();
        } else if ($('#prod_name').val() == "") {
            $('.prod_name').html("* Please Fill Product Name");
            $('.prod_name').show();
        } else if ($('#prod_price').val() == "") {
            $('.prod_price').html("* Please Fill Produt Code");
            $('.prod_price').show();
        } else if ($('#prod_imgurl').val() == "" && mode == "new") {
            $('.prod_imgurl').html("* Please Fill Product image");
            $('.prod_imgurl').show();
        }  else if($('#unit_id').val() == "" || $('#unit_id').val() == null || $('#unit_id').val() == " ") {
            $('.unit_id').html("* Please Select Unit ");
            $('.unit_id').show();
        } else if ($('#prod_quantity').val() == "") {
            $('.prod_quantity').html("* Please Fill Product quantity");
            $('.prod_quantity').show();
        } 
        else if ($('#editor1').val() == "") {
            $('.prod_info').html("* Please Fill product info");
            $('.prod_info').show();
        }  
        else {
            if (mode == "new") {
                saveProduct();
            } else {
                updateProduct();
            }

        }
    });


    function saveProduct() {
        var form = $('#Product_Form')[0];
        var data = new FormData(form);
        console.log(data)
        data.append("prod_info",CKEDITOR.instances['editor1'].getData());
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/insertProductsData',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
        });
        request.done(function(response) {
            var js = $.parseJSON(response); 
            var status = js.result 
            if (status == "success") {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Info',
                    content: 'Inserted Sucessfully',
                    type: 'green',
                    buttons: {
                        Ok: function() {},
                    }
                });
                $('#largeModal').modal('hide');
                refreshDetails();
            } else if (status == "imgerror") {

                $.confirm({
                    icon: 'icon-close',
                    title: 'Info',
                    content: 'Please Do check your image size and upload <br> max size of img 2048',
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            } 

            else {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Info',
                    content: js.msg,
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            }
        });
    }

    function refreshDetails() {
        $.when(getProduct()).done(function() {
            var table = $('#Product').DataTable();
            table.destroy();
            dispProduct(ProductJSON);
        });
    }

    function updateProduct() {
        var form = $('#Product_Form')[0];
        var data = new FormData(form); 
        var unit_id = $('#unit_id').val();
        data.append("prod_info",CKEDITOR.instances['editor1'].getData());
        data.append("prod_id", prod_id); 
        data.append("unit_id", unit_id);
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/updateProductsData',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            timeout: 600000,
        });
        request.done(function(response) {
            var js = $.parseJSON(response);
            var status = js.result
            if (status == "success") {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Info',
                    content: 'Updated Sucessfully',
                    type: 'green',
                    buttons: {
                        Ok: function() {},
                    }
                });
                $('#largeModal').modal('hide');
                refreshDetails();
            } 
            else if (status == "imgerror") {

                $.confirm({
                    icon: 'icon-close',
                    title: 'Info',
                    content: 'Please Do check your image size and upload <br> max size of img 2048',
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            } else {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Info',
                    content: 'Sorry Something went worng',
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            }
        });
    }


    // $('#mc_code').change(function() {
    //     var data = {
    //         "mc_code": $("#mc_code").val()
    //     };
    //     callAjaxDropdown(data, "0", "1");
    // });

    // function callAjaxDropdown(data, fl, val) {
    //     request = $.ajax({
    //         type: "POST",
    //         url: base_URL + 'YallaBasketCon/getSubMenuDetails',
    //         data: data,
    //     });
    //     request.done(function(response) {
    //         var result = $.parseJSON(response);
    //         displayDropdown(result, fl, val);
    //     });
    // }

    function displayDropdown(data, fl, val) {
        clearDropdown();
        for (var i = 0; i < data.length; i++) {
            $('#sc_code').append('<option value="' + data[i].sc_code + '">' + data[i].scName + '</option>');
        }
        if (fl == 1) {
            $('#sc_code').val(val);
        }
    }

    function clearDropdown() {
        $('#sc_code').html('');
        $('#sc_code').append('<option value="">Please Select Sub Category</option>');
        $('#mc_code').html('');
        $('#mc_code').append('<option value="">Please Select Main Category</option>');
        $('#sc_id').html('');
        $('#sc_id').append('<option value="">Please Select Sub Department</option>');
    }


    $(document).on('click', '.BtnEditPrice', function() {
        mode_price="update";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var prod_code  = ProductJSON[r_index].prod_code;
        request = $.ajax({
            type: "POST",
            url: base_URL + 'YallaBasketCon/getPriceDataForId',
            data: {
                "prod_id": prod_id, "prod_code":prod_code
            },
        });
        request.done(function(response) {
            var js = $.parseJSON(response);
            if (js.length > 0) {
                
                $('#priceModel').modal('show');
                $('#prod_id_price').val(ProductJSON[r_index].prod_id);
                $('#prod_code_price').val( ProductJSON[r_index].prod_code);
                $('#unit_id_price').val( js[0].unit_id);
                $('#selling_price_price').val( js[0].selling_price);
                $('#market_price_price').val( js[0].market_price);
                $('#avaliable_quantity_price').val( js[0].avaliable_quantity);
                $('#prod_price_id').val( js[0].prod_price_id);
            } 
        });

    });

    $(document).on('click', '.BtnUpdatePrice', function() {
        mode_price="insert";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        $('#priceModel').modal('show');
        $('#prod_id_price').val(ProductJSON[r_index].prod_id);
        $('#prod_code_price').val( ProductJSON[r_index].prod_code);

    });




    $('#Product_Price_Button').click(function() {
        $('.error').hide();
        var valid = 0;

        if ($('#unit_id_price').val() == "") {
            $('.unit_id_price').html("* Please Select Unit");
            $('.unit_id_price').show();
        } 

        else if ($('#avaliable_quantity_price').val() == "") {
            $('.avaliable_quantity_price').html("* Enter Avaliable Quantity");
            $('.avaliable_quantity_price').show();
        }

        else if ($('#selling_price_price').val() == "") {
            $('.selling_price_price').html("* Enter Selling Price");
            $('.selling_price_price').show();
        }

        else if ($('#market_price_price').val() == "") {
            $('.market_price_price').html("* Enter Market Price");
            $('.market_price_price').show();
        }
        else {
            if(mode_price=='insert')
            {
                var form = $('#Product_Price_Form')[0];
                var data = new FormData(form);
                request = $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: base_URL + 'YallaBasketCon/insertProductPriceData',
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                });
                request.done(function(response) {
                    var js = $.parseJSON(response);
                    var status = js.result
                    if (status == "success") 
                    {
                        $.confirm({
                            icon: 'icon-close',
                            title: 'Info',
                            content: 'Updated Succesfully',
                            type: 'green',
                            buttons: {
                                Ok: function() {},
                            }
                        });
                        $('#priceModel').modal('hide');
                        refreshDetails();
                    } else {
                        $.confirm({
                            icon: 'icon-close',
                            title: 'Error',
                            content: 'Sorry Something went worng please try again',
                            type: 'red',
                            buttons: {
                                Ok: function() {},
                            }
                        });
                    }                   
                });
            }
            else  if(mode_price=='update')
            {
                var form = $('#Product_Price_Form')[0];
                var data = new FormData(form);
                request = $.ajax({
                    type: "POST",
                    enctype: 'multipart/form-data',
                    url: base_URL + 'YallaBasketCon/updateProductPriceData',
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    timeout: 600000,
                });
                request.done(function(response) {
                    var js = $.parseJSON(response);
                    var status = js.result
                    if (status == "success") 
                    {
                        $.confirm({
                            icon: 'icon-close',
                            title: 'Info',
                            content: 'Updated Succesfully',
                            type: 'green',
                            buttons: {
                                Ok: function() {},
                            }
                        });
                        $('#priceModel').modal('hide');
                        refreshDetails();
                    } else {
                        $.confirm({
                            icon: 'icon-close',
                            title: 'Error',
                            content: 'Sorry Something went worng please try again',
                            type: 'red',
                            buttons: {
                                Ok: function() {},
                            }
                        });
                    }                   
                });
            }   


        }
    });




    $(document).on('click', '.Btnhidden', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 0;
        RestoreSMainCategoryData(prod_id,flag);
    });


    $(document).on('click', '.BtnRestore', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 1;
        RestoreSMainCategoryData(prod_id,flag);
    });


    function RestoreSMainCategoryData(prod_id,flag)
    {
        var prod_id = prod_id;
        var flag = flag;
        request = $.ajax({
                type: "POST",
                url: base_URL+'Amuthasurabi/RestoreProductData',
                data: {"prod_id":prod_id,"flag":flag},
        }); 
        request.done(function(response) {
            var js = $.parseJSON(response);
            var status = js.result
            if (status == "success") {
                refreshDetails();
            } else {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Error',
                    content: 'Sorry Something went worng please try again',
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            }
        });
    }


    $('#uoload_excel').click(function() {

        $('#ExcelUpload').modal({
              backdrop: 'static',
             keyboard: false ,
             show:true
        })
        // $('#excelmodel').modal('show');

    });


    $('#submit_product_excelupload').click(function() {
        $('.error').hide();

        if ($('#product_excel_upload').val() == "") 
        {
            $('.product_excel_upload').html("* Please Select the file to upload");
            $('.product_excel_upload').show();
        } 

        else 
        {
            var form = $('#import_excel_form')[0];
            var data = new FormData(form);
            request = $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_URL + 'YallaBasketCon/bulkupload_products',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
            });
            request.done(function(response) {
                var js = $.parseJSON(response);
                var status = js.result
                var msg = js.msg
                if (status == "success") 
                {
                    $.confirm({
                        icon: 'icon-close',
                        title: 'Info',
                        content: ''+msg+'',
                        type: 'green',
                        buttons: {
                            Ok: function() {},
                        }
                    });
                     $('#ExcelUpload').modal('hide');
                    refreshDetails();
                } 
                else {
                    $.confirm({
                        icon: 'icon-close',
                        title: 'Error',
                        content: ''+msg+'',
                        type: 'red',
                        buttons: {
                            Ok: function() {},
                        }
                    });
                }                   
            }); 

        }
    });


    $(document)
    .ajaxStart(function() {
        $(".loading").show();
    })
    .ajaxStop(function() {
        $(".loading").hide();
    });

    $(document).on('click', '.btninstock', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 0;
        movestockproduct(prod_id,flag);
    });


    $(document).on('click', '.btnoutofstock', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        prod_id = ProductJSON[r_index].prod_id;
        var flag = 1;
        movestockproduct(prod_id,flag);
    });


    function movestockproduct(prod_id,flag)
    {
        var prod_id = prod_id;
        var flag = flag;
        request = $.ajax({
                type: "POST",
                url: base_URL+'Amuthasurabi/RestoreProductStockData',
                data: {"prod_id":prod_id,"flag":flag},
        }); 
        request.done(function(response) {
            var js = $.parseJSON(response);
            var status = js.result
            if (status == "success") {
                refreshDetails();
            } else {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Error',
                    content: 'Sorry Something went worng please try again',
                    type: 'red',
                    buttons: {
                        Ok: function() {},
                    }
                });
            }
        });
    }



});