$(document).ready(function() {

    var MainCategoryJSON, id, mode, main_category_id;
    $.when(getMainCategory()).done(function() {
        dispMainCategory(MainCategoryJSON);
    });

    function getMainCategory() {
        return $.ajax({
            url: base_URL + 'Amuthasurabi/getMainCategory',
            type: 'POST',
            success: function(data) { 
                MainCategoryJSON = $.parseJSON(data);

            },
            error: function() {
                console.log("Error"); 
            }
        });
    }


    function dispMainCategory(JSON) { 
        var i =1;
        $('#Main_Category').dataTable({
            "aaSorting": [],
            "aaData": JSON,
            responsive: true,
            
            "aoColumns": [

					{
                    "mDataProp": function(data, type, full, meta) {
                            return i++;
                    }
                }, 
                {
                    "mDataProp": "mc_name"
                },
                {
                    "mDataProp": function(data, type, full, meta) {
                        if (data.img_url !== null) 
                            return "<div class='pro-im'>" +
                            "<img src='" +base_URL+ data.img_url + "' alt='user' width=100>" +
                            "<div class='pro-img-overlay'>" +
                            "<ul class='pro-img-overlay-1'>" +
                            "<li class='el-item'>" +
                            "<a class='btn default btn-outline image-popup-vertical-fit el-link' target='blank' href='"+base_URL+ data.img_url + "'>" +
                            "<i class='fa fa-eye'></i></a>" +
                            "</li>" +
                            "</ul></div></div>";
                        else
                            return '';
                    }
                },  
                {
                    "mDataProp": function(data, type, full, meta) {
                        if (data.active_flag == 1)
                            return '<a id="' + meta.row + '" class="btn Btnhidden" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;  visible</a>&nbsp;&nbsp;';
                        else
                            return '<a id="' + meta.row + '" class="btn BtnRestore" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa  fa-times-circle-o " aria-hidden="true"></i>&nbsp;  Hidden</a>&nbsp;&nbsp;';

                    }
                }, {
                    "mDataProp": function(data, type, full, meta) {
                        
                            return '<a id="' + meta.row + '" class="btn BtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;' +
                                '<a id="' + meta.row + '" class="btn BtnDelete" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    }
                },
            ]
        });
    }

    $('#New_Category').click(function() {
        mode = "new";
        $('#largeModal').modal('show');
    });

    $(document).on('click', '.BtnEdit', function() {
        mode = "update";
        var r_index = $(this).attr('id');
        id = MainCategoryJSON[r_index].main_category_id;
        $('#largeModal').modal('show');
        $('#mc_name').val(MainCategoryJSON[r_index].mc_name);
        //$('.Scategory').val(MainCategoryJSON[r_index].Scategory);
        if (MainCategoryJSON[r_index].Scategory == 1) {
            $('#hide').attr('checked', false);
            $('#show').attr('checked', true);
            $('.no').show();
        } else if (MainCategoryJSON[r_index].Scategory == 0) {
            $('#hide').attr('checked', true);
            $('#show').attr('checked', false);
            $('.no').hide();
        }

    });

    $(document).on('click', '.BtnDelete', function() {
        mode = "delete";
        var r_index = $(this).attr('id');
        main_category_id = MainCategoryJSON[r_index].main_category_id;
        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Delete this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                    request = $.ajax({
                        type: "POST",
                        url: base_URL + 'Amuthasurabi/deleteMainCategory',
                        data: {
                            "main_category_id": main_category_id
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

    $(document).on('click', '.Btnhidden', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        main_category_id = MainCategoryJSON[r_index].main_category_id;
        var flag = 0;
        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Deactivate this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                	RestoreMainCategoryData(main_category_id,flag);
                },
                No: function() {},
            }
        });

    });


    $(document).on('click', '.BtnRestore', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        main_category_id = MainCategoryJSON[r_index].main_category_id;
        var flag = 1;

        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Activate this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                	RestoreMainCategoryData(main_category_id,flag);
                },
                No: function() {},
            }
        });

    });


    function RestoreMainCategoryData(main_category_id,flag)
    {
    	var main_category_id = main_category_id;
    	var flag = flag;
        request = $.ajax({
            type: "POST",
            url: base_URL + 'Amuthasurabi/RestoreMainCategoryData',
            data: {
                "main_category_id": main_category_id,"flag":flag
            },
        });
        request.done(function(response) {
            var js = $.parseJSON(response);
            var status = js.result
            if (status == "success") {
                $.confirm({
                    icon: 'icon-close',
                    title: 'Info',
                    content: 'Updated Succesfully',
                    type: 'green',
                    buttons: {
                        Ok: function() {},
                    }
                });
                refreshDetails();
            } else {
                $.toast({
                    heading: 'Error',
                    text: 'Sorry Something went worng please try again',
                    showHideTransition: 'fade',
                    icon: 'error'
                });
            }
        });
    }


    $('#Main_Department_Button').click(function() {
        $('.error').hide();
        //console.log($('#url').val()); 
        if ($('#mc_name').val() == "") {
            $('.mc_name').html("* Please Fill Main Category Name");
            $('.mc_name').show();
        } 
        // else if ($('#img_url').val() == "") {
        //     $('.img_url').html("* Please Select Image");
        //     $('.img_url').show();
        // }
         else {

            var form = $('#Main_Department_Form')[0];
            var data = new FormData(form);
            console.log(data);

            // if (mode == "new") {
            //     saveMainCategory();
            // } 
            // else {
            //     updateMainCategory();
            // }

        }
    });


    function refreshDetails() {
        $.when(getMainCategory()).done(function() {
            var table = $('#Main_Category').DataTable();
            table.destroy();
            dispMainCategory(MainCategoryJSON);
        });
    }

    $('#largeModal').on('show.bs.modal', function() {
        $(".no").hide();
        $('#hide').attr('checked', false);
        $('#show').attr('checked', false);
        $(this).find('form').trigger('reset');
    });


    $(document)
        .ajaxStart(function() {
            $(".loading").show();
        })
        .ajaxStop(function() {
            $(".loading").hide();
        });



    $('#Product_Button').click(function() {
        $('.error').hide();
        if ($('#mc_name').val() == "") {
            $('.mc_name').html("* Please Fill Main Category Name");
            $('.mc_name').show();
        } else if ($('#img_url').val() == "" && mode == "new") {
            $('.img_url').html("* Please Fill Main Category image");
            $('.img_url').show();
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
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/insertMainCategory',
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

    function updateProduct() {
        var form = $('#Product_Form')[0];
        var data = new FormData(form); 
        data.append("id", id);
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/updateMainCategory',
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


});