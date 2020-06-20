<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Latest compiled and minified CSS -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    
    <!--data-table-->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/> 
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script> -->

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <title>Users</title>
</head>
<body>
    <section class="container my-5">
        <h1 class="mb-5">Manage Users</h1>
            <button 
                class="btn btn-outline-info mb-5"
                onclick="addUser()"
                >Add User</button>
            <table class="table table-bordered mt-3 display" id="table_id">
                <thead>
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ACTION</th>
                </thead>
                <tbody>
                    <?php foreach($users as $user){ ?>
                    <tr>
                        <td><?php echo $user->id ?></td>
                        <td><?php echo $user->name ?></td>
                        <td><?php echo $user->email ?></td>
                        <td>
                            <button 
                                onclick="editUser(<?php echo $user->id ?>)"
                                id="editBtn" 
                                class="btn btn-sm btn-outline-warning">Edit</button>
                            <button 
                                onclick="deleteUser(<?php echo $user->id ?>)"
                                id="deleteBtn" 
                                class="btn btn-sm btn-outline-danger">Delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>                
            </table>
            <!--Modal-->
            <div class="modal" tabindex="-1" role="dialog" id="modal_form">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">ADD USER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="#" id="form" class="form-horizontal">    
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" name="user_name" id="user_name">
                                    <label  for="email">Email</label>
                                    <input class="form-control" type="email" name="user_email" id="user_email"> 
                                    <input type="hidden" name="user_id" id="user_id">                                   
                                </form>
                            </div>                            
                        </div>
                        <div class="modal-footer">
                            <button 
                                id="addBtn"
                                onclick="save()"
                                type="button" 
                                class="btn btn-primary">ADD</button>
                            <button 
                                type="button" 
                                class="btn btn-secondary" 
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div><!--End Modal-->
    </section>
    <script>
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

        

        
    </script>
</body>
</html>