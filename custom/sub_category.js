$(document).ready(function() {
            
    var SubDepartmentJSON,sub_category_id,mode;
    $.when(getSubCategory()).done(function(){
            dispMainCategory(SubDepartmentJSON);                
    });

    function getSubCategory()
    {
        return $.ajax({
            url: base_URL+'Amuthasurabi/getSubCategory',
            type:'POST',
            success:function(data){
                //console.log(data);
                SubDepartmentJSON = $.parseJSON(data);
                
            },      
            error: function() {
                console.log("Error"); 
                //alert('something bad happened'); 
            }
        }) ;
    }


    function dispMainCategory(JSON)
    {   
        //$('#success_alert').show(1000);
        //console.log(dataJSON);
         var i =1;
        $('#Main_Category').dataTable( {
            "aaSorting":[],
            "aaData": JSON,
            responsive: true,
            "aoColumns": [
                {
                    "mDataProp": function(data, type, full, meta) {
                            return i++;
                    }
                },
                {
                    "mDataProp": function(data, type, full, meta) {
                            return ''+data.mc_name+' ( '+data.main_category_id+' )';
                    }
                }, 
                { "mDataProp": "sub_category_name"},     
                {
                    "mDataProp": function(data, type, full, meta) {
                        if (data.active_flag == 1)
                            return '<a id="' + meta.row + '" class="btn Btnhidden" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-check-circle-o" aria-hidden="true"></i>&nbsp;  visible</a>&nbsp;&nbsp;';
                        else
                            return '<a id="' + meta.row + '" class="btn BtnRestore" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa  fa-times-circle-o " aria-hidden="true"></i>&nbsp;  Hidden</a>&nbsp;&nbsp;';;

                    }
                },
                {
                    "mDataProp": function(data, type, full, meta) {
                        
                            return '<a id="' + meta.row + '" class="btn BtnEdit" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp;&nbsp;' +
                                '<a id="' + meta.row + '" class="btn BtnDelete" style="padding:0px;" role="button" data-toggle="tooltip" data-placement="top" title="Click to delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>';
                    }
                },          
            ]               
        });
    }
    
    $('#New_Category').click(function(){
        mode="new";
        // $('#largeModal').modal('show');
        $('#largeModal').modal({
              backdrop: 'static',
             keyboard: false  // to prevent closing with Esc button (if you want this too)
        })      

    });
    
    $(document).on('click','.BtnEdit',function(){
        mode="update";
        var r_index = $(this).attr('id');
        sub_category_id = SubDepartmentJSON[r_index].sub_category_id;
        $('#largeModal').modal('show');
        $('#sub_category_name').val(SubDepartmentJSON[r_index].sub_category_name);

        
        var $select1 = $(document.getElementById('main_category_id'));
        var selectize1 = $select1[0].selectize;
        selectize1.setValue(SubDepartmentJSON[r_index].main_category_id);

        // $('#main_category_id').val(SubDepartmentJSON[r_index].main_category_id);        
        if(SubDepartmentJSON[r_index].Scategory==1)
        {
            $('#hide').attr('checked', false);
            $('#show').attr('checked', true);
            $('.no').show();
        }
        else if(SubDepartmentJSON[r_index].Scategory==0)
        {
            $('#hide').attr('checked', true);
            $('#show').attr('checked', false);
            $('.no').hide();
        }

        var $select = $(document.getElementById("md_code"));
        var selectize = $select[0].selectize;
        selectize.setValue(SubDepartmentJSON[r_index].md_code);

    });
    
    $(document).on('click','.BtnDelete',function(){
        mode="delete";
        var r_index = $(this).attr('id');
        sub_category_id = SubDepartmentJSON[r_index].sub_category_id;
        
        $.confirm({
                icon: 'icon-close',
                title: 'Info',
                content: 'Are you Sure Do you want to Delete this Data',
                type: 'blue',
                    buttons: {
                        Yes: function() {                   
                                request = $.ajax({
                                    type: "POST",
                                    url: base_URL+'Amuthasurabi/deleteSubCategory',
                                    data: {"sub_category_id":sub_category_id},
                                }); 
                                request.done(function (response){
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
                                    }
                                    else
                                    {
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
        sub_category_id = SubDepartmentJSON[r_index].sub_category_id;
        var flag = 0;

        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Deactivate this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                    RestoreSubCategoryData(sub_category_id,flag);
                },
                No: function() {},
            }
        });

    });


    $(document).on('click', '.BtnRestore', function() {
        mode = "restore";
        var r_index = $(this).attr('id');
        sub_category_id = SubDepartmentJSON[r_index].sub_category_id;
        var flag = 1;

        $.confirm({
            icon: 'icon-close',
            title: 'Info',
            content: 'Are you Sure Do you want to Activate this Data',
            type: 'blue',
            buttons: {
                Yes: function() {
                    RestoreSubCategoryData(sub_category_id,flag);
                },
                No: function() {},
            }
        });

    });


    function RestoreSubCategoryData(sub_category_id,flag)
    {
        var sub_category_id = sub_category_id;
        var flag = flag;

        request = $.ajax({
                type: "POST",
                url: base_URL+'Amuthasurabi/RestoreSubCategoryData',
                data: {"sub_category_id":sub_category_id,"flag":flag},
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

    
    $('#Sub_Department_Button').click(function(){
        $('.error').hide();
        //console.log($('#url').val()); 
        if($('#main_category_id').val()=="")
        {
            $('.main_category_id').html("* Please Fill Main Category");
            $('.main_category_id').show();
        }
        else if($('#sub_category_name').val()=="")
        {
            $('.sub_category_name').html("* Please Fill Sub Category");
            $('.sub_category_name').show();
        }
        else
        {
            if(mode=="new")
            {
                saveMainCategory();
            }
            else
            {
                updateMainCategory();
            }           
            
        }       
    });
    
    $('#largeModal').on('show.bs.modal', function () {
        $(".no").hide();
        $('#hide').attr('checked', false);
        $('#show').attr('checked', false);
        $(this).find('form').trigger('reset');
         var $select = $('#main_category_id').selectize();
         var control = $select[0].selectize;
         control.clear();
    }); 
    
    function saveMainCategory()
    {       
        var form = $('#Sub_Department_Form')[0];
        var data = new FormData(form);
        request = $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_URL+'Amuthasurabi/insertSubCategory',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
        }); 
        request.done(function (response){
            var js = $.parseJSON(response);
            //console.log(js);
            var status = js.result;
            console.log(status);
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
                //alert(12);
            }
            else
            {
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
            // $('.alert-success').show().delay(5000).fadeOut('slow');              
            // refreshDetails();        
        });     
    }
    
    function refreshDetails()
    {
        $.when(getSubCategory()).done(function(){
            var table = $('#Main_Category').DataTable();
            table.destroy();    
            dispMainCategory(SubDepartmentJSON);                
        });     
    }
    
    function updateMainCategory()
    {
        var form = $('#Sub_Department_Form')[0];
        var data = new FormData(form);
        data.append("sub_category_id",sub_category_id);
        request = $.ajax({
                type: "POST",
                enctype: 'multipart/form-data',
                url: base_URL+'Amuthasurabi/updateSubCategory',
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                timeout: 600000,
        }); 
        request.done(function (response){
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
            }
            else
            {
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
              $(document)
              .ajaxStart(function () {
                $(".loading").show();
              })
              .ajaxStop(function () {
                $(".loading").hide();
              });

});
