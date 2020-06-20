$(document).ready(function(){
    //Initialize data-table
    $('#table_id').DataTable();
});


let url;
let formAction;    

function updateUser(){
    if (formAction === 'add'){
        url = "user/create";
    }
    if (formAction === 'update'){
        url = "user/save/";
    }            
} 

// SHOW MODAL
function addUser(){
    formAction = 'add';            
    $("#modal_form").modal("show");
}

// ADD || UPDATE A SINGLE USER
function save(){ 
    if (formAction === 'add'){
        url = "user/create";
    }
    if (formAction === 'update'){
        url = "user/update";
    }                         
    $.ajax({
        url: url,
        type: "POST",
        data: $("#form").serialize(),
        dataType: "JSON",
        success: function( data ){
            $("#modal_form").modal("hide");
            location.reload();
            // console.log(data);
        },
        error: function( jqXHR, textStatus, errorThrown ){
            alert("Opps, something went wrong");
        }                    
    })                            
}   

// DISPLAY USER INFOS IN INPUT
function editUser(id){                  
    console.log(id);  
    formAction = 'update';                     
    $.ajax({
        url: "user/edit/" + id,
        type: 'GET',
        dataType: 'JSON',
        success: function(data){
            $('#user_id').val(data.id);
            $('#user_name').val(data.name);
            $('#user_email').val(data.email);
            $('#modal_form').modal('show');  
            $('.modal-title').html('EDIT USER');                                                         
        }
    })               
}

// DELETE A SINGLE USER
function deleteUser(id){
    console.log(id);
    
    $.ajax({
        url: 'user/delete/' + id,
        type: 'POST',
        dataTypr: 'JSON',
        success: function(data){
            
            
            location.reload();
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert("Opps, something went wrong");
        }

    })
}



