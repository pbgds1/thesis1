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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <title>Simple Sidebar - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">Start Bootstrap </div>
      <div class="list-group list-group-flush">
        <a href="index.html" class="list-group-item list-group-item-action bg-light">Home</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Account settings</a>
        <a href="friends.html" class="list-group-item list-group-item-action bg-light">Friends</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Groups</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Activity Log</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Expense</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Logout</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Dropdown
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Something else here</a>
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
                      <td data-target="Firstname"><?php echo $row['Firstname']; ?></td>
                      <td data-target="Lastname"><?php echo $row['Lastname']; ?></td>
                      <td data-target="Email"><?php echo $row['Email']; ?></td>
                      <td><a href="#" data-role="update" data-id="<?php echo $row['id'] ;?>">Settle</a></td>
                    </tr>
               <?php }
             ?>

          </tbody>
        </table>
      </div>
    </div>
    <!-- /#page-content-wrapper -->

  </div>
  <!-- /#wrapper -->
  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label>First Name</label>
              <input type="text" id="Firstname" class="form-control">
            </div>
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" id="Lastname" class="form-control">
            </div>

             <div class="form-group">
              <label>Email</label>
              <input type="text" id="Email" class="form-control">
            </div>
              <input type="hidden" id="userId" class="form-control">


        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <a href="#" id="save" class="btn btn-primary pull-right">Update</a>
        </div>
      </div>

    </div>
  </div>
  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Menu Toggle Script -->




</body>
<script>



  $(document).ready(function(){

    //  append values in input fields
      $(document).on('click','a[data-role=update]',function(){
            var id  = $(this).data('id');
            var Firstname  = $('#'+id).children('td[data-target=Firstname]').text();
            var Lastname  = $('#'+id).children('td[data-target=Lastname]').text();
            var Email  = $('#'+id).children('td[data-target=Email]').text();

            $('#Firstname').val(Firstname);
            $('#Lastname').val(Lastname);
            $('#Email').val(Email);
            $('#userId').val(id);
            $('#myModal').modal('toggle');
      });

      // now create event to get data from fields and update in database

       $('#save').click(function(){
          var id  = $('#userId').val();
         var Firstname =  $('#Firstname').val();
          var Lastname =  $('#Lastname').val();
          var Email =   $('#Email').val();

          $.ajax({
              url      : 'connection.php',
              method   : 'post',
              data     : { id  : id , Firstname : Firstname , Lastname : Lastname , Email : Email },
              success  : function(response){
                            // now update user record in table
                             $('#'+id).children('td[data-target=Firstname]').text(Firstname);
                             $('#'+id).children('td[data-target=Lastname]').text(Lastname);
                             $('#'+id).children('td[data-target=Email]').text(Email);
                             $('#myModal').modal('toggle');
                         }
          });
       });
  });
</script>
</html>
