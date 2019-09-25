<?php
 include 'update.php';
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
<div id="page-content-wrapper">

    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>


      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Friends">
        Add a friend
      </button>
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

  <!-- Modal settle-->
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

  <!-- Modal add a friend -->

  <div id="Friends" class="modal fade" role="dialog">
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
        <button type="submit" onclick="saveData()" class="btn btn-primary">Save</button>
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
  function saveData(){
    var Firstname = $('Firstname').val();
    var Lastname = $('Lastname').val();
    var Email = $('Email').val();
    $.ajax({
        type: "POST",
        url:  "server.php?p=add",
        data: {Firstname: Firstname, Lastname: Lastname, Email: Email},
        success: function(msg) {
                        $('#Friends').modal('toggle');
        }
      });
    }




</script>
</html>
