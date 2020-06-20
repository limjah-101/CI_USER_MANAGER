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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <!-- fontawesome -->
    <script src="https://kit.fontawesome.com/28ee19a815.js" crossorigin="anonymous"></script>


    <title>User Manager</title>
</head>
<body>
    <section class="container my-5">
        <h1 class="mb-5" style="color: #42CAFD">Manage Users</h1>            
        <div class="mb-3">
            <i 
                style="font-size: 30px; color: #42CAFD; cursor: pointer"
                class="fas fa-plus-circle" 
                onclick="addUser()"
                data-toggle="tooltip"
                title="Add User"
                ></i>
        </div>    
            <table class="table table-bordered mt-5 display" id="table_id">
                <thead style="color: #42CAFD">
                    <th>ID</th>
                    <th>NAME</th>
                    <th>EMAIL</th>
                    <th>ACTION</th>
                </thead>
                <tbody>
                    <?php foreach($users as $user){ ?>
                    <tr style="color: #7E8287">
                        <td><?php echo $user->id ?></td>
                        <td><?php echo $user->name ?></td>
                        <td><?php echo $user->email ?></td>
                        <td>    
                            <div class="d-flex justify-content-center align-items-center">

                                <div 
                                    style="font-size: 20px; color: #5DD9C1; cursor: pointer"
                                    onclick="editUser(<?php echo $user->id ?>)"
                                    id="editBtn" 
                                    class="mr-3"
                                    ><i class="fas fa-pen-square" data-toggle="tooltip"
                                    title="Edit User"></i></div>
                                <div 
                                    style="font-size: 15px; color: #B084CC; cursor: pointer"
                                    onclick="deleteUser(<?php echo $user->id ?>)"
                                    id="deleteBtn" 
                                    ><i class="fas fa-trash-alt" data-toggle="tooltip"
                                    title="Delete User"></i></div>
                            </div>
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
                                class="btn btn-outline-info">SAVE</button>                                                        
                        </div>
                    </div>
                </div>
            </div><!--End Modal-->
    </section>
    
    <script src="assets/JS/app.js"></script>
</body>
</html>