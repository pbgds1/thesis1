<?php
 include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Start Bootstrap </div>
      <div class="list-group list-group-flush">
        <a href="index.html" class="list-group-item list-group-item-action bg-light">Home</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Account settings</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Friends</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Groups</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Activity Log</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Expense</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle">Toggle Menu</button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Add a friend
              </button>

              <!-- Add a friend modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">

                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>

                    <div class="modal-body">
                      ...
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-primary">Add</button>
                    </div>
                  </div>
                </div>
              </div>

            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <table class="table">
          <thead>
            <tr>
              <th>Firstname</th>
              <th>Lastname</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $table  = mysqli_query($connection ,'SELECT * FROM user');
                while($row  = mysqli_fetch_array($table)){ ?>
                    <tr id="<?php echo $row['id']; ?>">
                      <td data-target="firstName"><?php echo $row['Firstname']; ?></td>
                      <td data-target="lastName"><?php echo $row['Lastname']; ?></td>
                      <td data-target="email"><?php echo $row['Email']; ?></td>
                      <td><a href="#" data-role="update" data-id="<?php echo $row['id'] ;?>">Update</a></td>
                    </tr>
               <?php }
             ?>
          </tbody>
        </table>


        </div>

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
              </div>
              <div class="modal-body">
                  <div class="form-group">
                    <label>First Name</label>
                    <input type="text" id="firstName" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" id="lastName" class="form-control">
                  </div>

                   <div class="form-group">
                    <label>Email</label>
                    <input type="text" id="email" class="form-control">
                  </div>
                    <input type="hidden" id="userId" class="form-control">


              </div>
              <div class="modal-footer">
                <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>

          </div>
        </div>



    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $(document).ready(function(){

      //  append values in input fields
        $(document).on('click','a[data-role=update]',function(){
              var id  = $(this).data('id');
              var firstName  = $('#'+id).children('td[data-target=firstName]').text();
              var lastName  = $('#'+id).children('td[data-target=lastName]').text();
              var email  = $('#'+id).children('td[data-target=email]').text();

              $('#firstName').val(firstName);
              $('#lastName').val(lastName);
              $('#email').val(email);
              $('#userId').val(id);
              $('#myModal').modal('toggle');
        });

        // now create event to get data from fields and update in database

         $('#save').click(function(){
            var id  = $('#userId').val();
           var firstName =  $('#firstName').val();
            var lastName =  $('#lastName').val();
            var email =   $('#email').val();

            $.ajax({
                url      : 'connection.php',
                method   : 'post',
                data     : {firstName : firstName , lastName: lastName , email : email , id: id},
                success  : function(response){
                              // now update user record in table
                               $('#'+id).children('td[data-target=firstName]').text(firstName);
                               $('#'+id).children('td[data-target=lastName]').text(lastName);
                               $('#'+id).children('td[data-target=email]').text(email);
                               $('#myModal').modal('toggle');

                           }
            });
         });
    });
  </script>







</body>



</html>
