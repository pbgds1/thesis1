


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




  $page = isset($_GET['p'])?$_GET['p']:"";

  if($page == "add") {

  	$fn = $_POST['Firstname'];
  	$ln = $_POST['Lastname'];
  	$em = $_POST['Email'];
  	$query = $db->prepare("INSERT INTO user VALUES('',?,?,?)");
  	$query->blindParam(1,$fn);
  	$query->blindParam(2,$ln);
  	$query->blindParam(3,$em);
  	if($query->execute()){
  		echo "Success add data";
  	}
  	else {
  		echo "Fail add data";
  	}

    "Firstname="+Firstname+"&Lastname="+Lastname+"&Email="+Email,
