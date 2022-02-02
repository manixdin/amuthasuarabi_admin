$(document).ready(function() {

    var StateJSON, id, mode, state_id;
    $.when(getState()).done(function() {
        dispState(StateJSON);
    });

    function getState() {
        return $.ajax({
            url: base_URL + 'Amuthasurabi/getState',
            type: 'POST',
            success: function(data) { 
                StateJSON = $.parseJSON(data);

            },
            error: function() {
                console.log("Error"); 
            }
        });
    }


    function dispState(JSON) { 
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
                    "mDataProp": "country"
                },
                {
                    "mDataProp": "state_name"
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
        id = StateJSON[r_index].state_id;
        $('#largeModal').modal('show');
        $('#state_name').val(StateJSON[r_index].state_name); 
    });

    $(document).on('click', '.BtnDelete', function() {
        mode = "delete";
        var r_index = $(this).attr('id');
        state_id = StateJSON[r_index].state_id;
        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Delete this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                    request = $.ajax({
                        type: "POST",
                        url: base_URL + 'Amuthasurabi/deleteState',
                        data: {
                            "state_id": state_id
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
        if ($('#mc_name').val() == "") {
            $('.mc_name').html("* Please Fill Main Category Name");
            $('.mc_name').show();
        }  
        else { 
            if (mode == "new") {
                saveState();
            } 
            else {
                updateState();
            }
        }
    });


    function refreshDetails() {
        $.when(getState()).done(function() {
            var table = $('#Main_Category').DataTable();
            table.destroy();
            dispState(StateJSON);
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



    $('#state_button').click(function() {
        $('.error').hide();
        if ($('#state_name').val() == "") {
            $('.state_name').html("* Please Fill State Name");
            $('.state_name').show();
        }
        else {
            if (mode == "new") {
                saveState();
            } else {
                updateState();
            }

        }
    });


    function saveState() {
        var form = $('#state_form')[0];
        var data = new FormData(form);
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/insertState',
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

    function updateState() {
        var form = $('#state_form')[0];
        var data = new FormData(form); 
        data.append("id", id);
        request = $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: base_URL + 'Amuthasurabi/updateState',
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