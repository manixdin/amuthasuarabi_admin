$(document).ready(function() {

    var CityJSON, id, mode, city_id;
    $.when(getCity()).done(function() {
        dispCity(CityJSON);
    });

    function getCity() {
        return $.ajax({
            url: base_URL + 'Amuthasurabi/getCity',
            type: 'POST',
            success: function(data) { 
                CityJSON = $.parseJSON(data);

            },
            error: function() {
                console.log("Error"); 
            }
        });
    }


    function dispCity(JSON) { 
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
                    "mDataProp": "state_name"
                },
                {
                    "mDataProp": "city_name"
                },
                {  "mDataProp": function(data, type, full, meta) {
                        
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
        id = CityJSON[r_index].city_id;
        $('#largeModal').modal('show');
        $('#state_id').val(CityJSON[r_index].state_id); 
        $('#city_name').val(CityJSON[r_index].city_name); 
    });

    $(document).on('click', '.BtnDelete', function() {
        mode = "delete";
        var r_index = $(this).attr('id');
        city_id = CityJSON[r_index].city_id;
        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Delete this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                    request = $.ajax({
                        type: "POST",
                        url: base_URL + 'Amuthasurabi/deleteCity',
                        data: {
                            "city_id": city_id
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

    

    $('#Main_Department_Button').click(function() {
        $('.error').hide();
        //console.log($('#url').val()); 
        if ($('#state_id').val() == "") {
            $('.state_id').html("* Please Select State Name");
            $('.state_idstate_id').show();
        } 
        else if ($('#city_name').val() == "") {
            $('.state_id').html("* Please Fill City Name");
            $('.state_idstate_id').show();
        }  
        else { 
            if (mode == "new") {
                saveCity();
            } 
            else {
                updateCity();
            }
        }
    });


    function refreshDetails() {
        $.when(getCity()).done(function() {
            var table = $('#Main_Category').DataTable();
            table.destroy();
            dispCity(CityJSON);
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



    $('#City_button').click(function() {
        $('.error').hide();
        if ($('#city_name').val() == "") {
            $('.city_name').html("* Please Fill City Name");
            $('.city_name').show();
        }
        else {
            if (mode == "new") {
                saveCity();
            } else {
                updateCity();
            }

        }
    });


    function saveCity() {
        var form = $('#City_form')[0];
        var data = new FormData(form);
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/insertCity',
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

    function updateCity() {
        var form = $('#City_form')[0];
        var data = new FormData(form); 
        data.append("id", id);
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/updateCity',
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