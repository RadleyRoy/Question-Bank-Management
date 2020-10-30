<?php

  
  // include library
  require "vendor/autoload.php";

  // creating connection
  $conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

  session_start();

  // creating or selection database
  $db=$conn->questionBank;

  $collection=$db->questions;

?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/af-2.3.5/b-1.6.4/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.0/sl-1.3.1/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/mystyles.css">
    <title>Daily Data Entries</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="dist/sortable-tables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/dt-1.10.22/af-2.3.5/b-1.6.4/cr-1.5.2/fc-3.3.1/fh-3.1.7/kt-2.5.3/r-2.2.6/rg-1.1.2/rr-1.2.7/sc-2.0.3/sb-1.0.0/sp-1.2.0/sl-1.3.1/datatables.min.js"></script>

    <header>
      <nav id="header-nav" class="navbar navbar-default">
        <div class="container">

          <div id="header-title"><a><img src="https://www.freeiconspng.com/uploads/open-book-icon-20.png" width="60" alt="Vector Open Book Icon" /></a>  Question Bank Management</div>
          <button type="button" class="btn btn-dark" onclick="document.location='User.php'">Logout</button>
        </div>
      </nav>
    </header>
    <br>



<script type="text/javascript">
  $(document).ready(function() {
    $('#myTable').DataTable( {
        initComplete: function () {
            this.api().columns([0]).every( function () {
                var column = this;
                var select = $('<select><option value="">Show All</option></select>')
                    .appendTo( '#filter-date' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
            this.api().columns([1]).every( function () {
                var column = this;
                var select = $('<select><option value="">Show All</option></select>')
                    .appendTo( '#filter-user' )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );
} );
</script>





<div class="container">
  <div class="row">
    <div class="col-3">
      <h4>Filter By Date</h4>
      <div id="filter-date"></div>
    </div>
    <div class="col-3">
      <h4>Filter By User</h4>
      <div id="filter-user"></div>
    </div>
  </div>
  <br>
      <table id="myTable" class="table table-bordered table-dark display">
        <thead>
          <tr>
            <th style="text-align: center;" scope="col">Dates</th>
            <th style="text-align: center;" scope="col">User</th>
            <th style="text-align: center;" scope="col">Quantitative</th>
            <th style="text-align: center;" scope="col">General Knowledge</th>
            <th style="text-align: center;" scope="col">Logical</th>
            <th style="text-align: center;" scope="col">Verbal</th>
            <th style="text-align: center;" scope="col">Total</th>
          </tr>
        </thead>
        <tbody>

<?php

  $sorted = $collection->distinct("date");
  foreach ($sorted as $s){

    $sum1 = $collection->count(array('date' => $s, 'user' => 'User 1'));
    $sum2 = $collection->count(array('date' => $s, 'user' => 'User 2'));
    $sum3 = $collection->count(array('date' => $s, 'user' => 'User 3'));
    if ($sum1>0) {
      echo '
          <tr name="user1">
            <td style="text-align: center;" scope="row">'.$s.'</td>
            <td style="text-align: center;">User 1</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 1", "qtype" => "Quantitative")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 1", "qtype" => "General Knowledge")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 1", "qtype" => "Logical")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 1", "qtype" => "Verbal")).'</td>
            <td style="text-align: center;">'.$sum1.'</td>
          </tr>';
    }


    if ($sum2>0) {
      echo '
          <tr name="user2">
            <td style="text-align: center;" scope="row">'.$s.'</td>
            <td style="text-align: center;">User 2</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 2", "qtype" => "Quantitative")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 2", "qtype" => "General Knowledge")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 2", "qtype" => "Logical")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 2", "qtype" => "Verbal")).'</td>
            <td style="text-align: center;">'.$sum2.'</td>
          </tr>
        ';
    }


    if ($sum3>0) {
      echo '<tr name="user3">
            <td style="text-align: center;" scope="row">'.$s.'</td>
            <td style="text-align: center;">User 3</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 3", "qtype" => "Quantitative")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 3", "qtype" => "General Knowledge")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 3", "qtype" => "Logical")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s, "user" => "User 3", "qtype" => "Verbal")).'</td>
            <td style="text-align: center;">'.$sum3.'</td>
          </tr>
        ';
    }


}
 

?>


        </tbody>
      </table>
    </div>
    <br>




    <div class="container">
      <button type="button" class="btn btn-primary" onclick="document.location='Question Bank.php'">Back</button>
    </div>


  </body>
</html>