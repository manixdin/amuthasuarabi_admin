$(document).ready(function() {

    var UserListJSON, id, mode, user_id;
    $.when(getUserList()).done(function() {
        dispUserList(UserListJSON);
    });

    function getUserList() {
        return $.ajax({
            url: base_URL + 'Amuthasurabi/getCustomerList',
            type: 'POST',
            success: function(data) { 
                UserListJSON = $.parseJSON(data);

            },
            error: function() {
                console.log("Error"); 
            }
        });
    }


    function dispUserList(JSON) { 
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
                    "mDataProp": "username"
                },
                {
                    "mDataProp": "email"
                },
                {
                    "mDataProp": "mobile_no"
                },
                {
                    "mDataProp": "nationality"
                }, {
                    "mDataProp": function(data, type, full, meta) {
                        if (data.flag == 1)
                            return '<a id="' + meta.row + '" class="btn Btnhidden" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;  visible</a>&nbsp;&nbsp;';
                        else
                            return '<a id="' + meta.row + '" class="btn BtnRestore" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa  fa-times-circle-o " aria-hidden="true"></i>&nbsp;  Hidden</a>&nbsp;&nbsp;';

                    }
                },
            ]
        });
    }

    $('#New_Category').click(function() {
        mode = "new";
        $('#largeModal').modal('show');
    }); 

    $(document).on('click', '.Btnhidden', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        user_id = UserListJSON[r_index].user_id;
        var flag = 0;
        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Deactivate this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                	RestoreUserListData(user_id,flag);
                },
                No: function() {},
            }
        });

    });


    $(document).on('click', '.BtnRestore', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        user_id = UserListJSON[r_index].user_id;
        var flag = 1;

        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Activate this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                	RestoreUserListData(user_id,flag);
                },
                No: function() {},
            }
        });

    });


    function RestoreUserListData(user_id,flag)
    {
    	var user_id = user_id;
    	var flag = flag;
        request = $.ajax({
            type: "POST",
            url: base_URL + 'Amuthasurabi/RestoreUserListData',
            data: {
                "user_id": user_id,"flag":flag
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
        } else {
            if (mode == "new") {
                saveUserList();
            } else {
                updateUserList();
            }

        }
    });

    function saveUserList() {
        var mc_name= $('#mc_name').val();               
        $.ajax({            
            url: base_URL + 'Amuthasurabi/insertUserList',
            type: "post",
            data: {mc_name:mc_name},
            success: function(response)
            { 
                var js = $.parseJSON(response);
                var status = js.result;
                if (status == "success") {
                    $.confirm({
                        icon: 'icon-close',
                        title: 'Info',
                        content: 'Insert Sucessfully',
                        type: 'green',
                        buttons: {
                            Ok: function() {},
                        }
                    });
                    $('#largeModal').modal('hide');
                    refreshDetails();
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
            },
            error: function (xhr, ajaxOptions, thrownError) {
               // some alert
            }
        });
    }

    function refreshDetails() {
        $.when(getUserList()).done(function() {
            var table = $('#Main_Category').DataTable();
            table.destroy();
            dispUserList(UserListJSON);
        });
    }

    function updateUserList() {
        var mc_name= $('#mc_name').val();              
        $.ajax({            
            url: base_URL + 'Amuthasurabi/updateUserList',
            type: "post",
            data: {mc_name:mc_name, id:id},
            success: function(response)
            { 
                var js = $.parseJSON(response);
                var status = js.result;
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
            },
            error: function (xhr, ajaxOptions, thrownError) {
               // some alert
            }
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

});