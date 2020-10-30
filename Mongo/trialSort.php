<?php

  
  // include library
  require "vendor/autoload.php";

  // creating connection
  $conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

  session_start();

  // creating or selection database
  $db=$conn->questionBank;

  $collection=$db->questions;

  $count = $collection->count(array('qtype' => 'General Knowledge', 'user' => 'User 1'));
  echo $count;

  $agg = $collection->aggregate(array(
    array('$group' => array('_id' => array("user" => '$user', "tags" => '$qtype'), 'toplam' => array('$sum' => 1))), array('$sort' => array('toplam' => -1))));
  foreach ($agg as $a) {
    echo $a["toplam"]." ";
    echo $a["_id"]->{'user'}." ";
  }

  $cnt = $collection->aggregate(array(array('$sortByCount' => '$qtype')));
  foreach ($cnt as $c) {
    echo $c['count'].$c['_id'];
  }

  $sorted = $collection->find(array('user' => 'User 1'), array('sort' => array('date' => 1)));
  $filter = array("user" => 'User 1');
  $sort = array();
  print_r(microtime());
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/mystyles.css">
    <link rel="stylesheet" href="dist/sortable-tables.min.css">

    <title>Question Bank Management</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="dist/sortable-tables.min.js"></script>

    <header>
      <nav id="header-nav" class="navbar navbar-default">
        <div class="container">

          <div id="header-title"><a><img src="https://www.freeiconspng.com/uploads/open-book-icon-20.png" width="60" alt="Vector Open Book Icon" /></a>  Question Bank Management</div>
          <button type="button" class="btn btn-dark" onclick="document.location='User.php'">Logout</button>
        </div>
      </nav>
    </header>
    <br>


    <div class="container">
      <div class="row">
        <div class="col-6">
          <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
            Filter
          </button>
        </div>
        <div class="col-6">
          <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
            Sort
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="collapse" id="collapseExample1">
            <div class="card card-body">
              <div id="myBtnContainer">
                <div class="row">
                  <div class="col-8">
                    <label for="validationDefault03">Date</label>
                    <input type="date" name="date" class="form-control" id="validationDefault03" required><br>
                  </div>
                  <div class="col-4"><br><button class="btn btn-dark active" onclick="filterSelection('all')">Cancel Date</button></div>
                </div>
                <button class="btn btn-dark active" onclick="filterType('all')">All Users</button>
                <button class="btn btn-dark" onclick="filterType('user1')">User 1</button>
                <button class="btn btn-dark" onclick="filterType('user2')">User 2</button>
                <button class="btn btn-dark" onclick="filterType('user3')">User 3</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="collapse" id="collapseExample2">
            <div class="card card-body">
              <div class="row">
                <div class="col-6">
                  <h3>Ascending</h3>
                  <button class="btn btn-dark" onclick="sortDaily('amarks')">Total</button>
                  <button class="btn btn-dark" onclick="sortDaily('dtitle')">Verbal</button><br><br>
                  <button class="btn btn-dark" onclick="sortDaily('atitle')">Quantitative</button>
                  <button class="btn btn-dark" onclick="sortDaily('dtitle')">Logical</button><br><br>
                  <button class="btn btn-dark" onclick="sortDaily('dmarks')">General Knowledge</button>
                  </div>
                <div class="col-6">
                  <h3>Descending</h3>
                  <button class="btn btn-dark" onclick="sortDaily('amarks')">Total</button>
                  <button class="btn btn-dark" onclick="sortDaily('dtitle')">Verbal</button><br><br>
                  <button class="btn btn-dark" onclick="sortDaily('atitle')">Quantitative</button>
                  <button class="btn btn-dark" onclick="sortDaily('dtitle')">Logical</button><br><br>
                  <button class="btn btn-dark" onclick="sortDaily('dmarks')">General Knowledge</button>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>



<script type="text/javascript">
  function filterType(c){
    var type1 = document.getElementsByName("user1");
    var type2 = document.getElementsByName("user2");
    var type3 = document.getElementsByName("user3");
    var i;
    switch(c){
      case 'all':
      for (i = 0; i < type1.length; i++){
        type1[i].style.display = '';
      }
      for (i = 0; i < type2.length; i++){
        type2[i].style.display = '';
      }
      for (i = 0; i < type3.length; i++){
        type3[i].style.display = '';
      }
      break;
      case 'user1':
      for (i = 0; i < type1.length; i++){
        type1[i].style.display = '';
      }
      for (i = 0; i < type2.length; i++){
        type2[i].style.display = 'none';
      }
      for (i = 0; i < type3.length; i++){
        type3[i].style.display = 'none';
      }
      break;
      case 'user2':
      for (i = 0; i < type1.length; i++){
        type1[i].style.display = 'none';
      }
      for (i = 0; i < type2.length; i++){
        type2[i].style.display = '';
      }
      for (i = 0; i < type3.length; i++){
        type3[i].style.display = 'none';
      }
      break;
      case 'user3':
      for (i = 0; i < type1.length; i++){
        type1[i].style.display = 'none';
      }
      for (i = 0; i < type2.length; i++){
        type2[i].style.display = 'none';
      }
      for (i = 0; i < type3.length; i++){
        type3[i].style.display = '';
      }
      break;
    }
  }
</script>






<div class="container">
      <h2>All</h2>
      <table class="table table-bordered table-dark sortable-table">
        <thead>
          <tr>
            <th style="text-align: center;" scope="col">Dates</th>
            <th style="text-align: center;" scope="col">User</th>
            <th style="text-align: center;" class="numeric-sort" scope="col">Quantitative</th>
            <th style="text-align: center;" class="numeric-sort" scope="col">General Knowledge</th>
            <th style="text-align: center;" class="numeric-sort" scope="col">Logical</th>
            <th style="text-align: center;" class="numeric-sort" scope="col">Verbal</th>
            <th style="text-align: center;" class="numeric-sort" scope="col">Total</th>
          </tr>
        </thead>
        <tbody>

<?php

  $sorted = $collection->find(array(), array('sort' => array('date' => -1)));
  $dates = array();
  foreach ($sorted as $s){

    if ( in_array($s['date'], $dates) ) {
        continue;
    }
    $dates[] = $s['date'];

    $sum1 = $collection->count(array('date' => $s['date'], 'user' => 'User 1'));
    $sum2 = $collection->count(array('date' => $s['date'], 'user' => 'User 2'));
    $sum3 = $collection->count(array('date' => $s['date'], 'user' => 'User 3'));
    $row = 0;
    if ($sum1>0) {
      $row = $row + 1;
      echo '
          <tr name="user1">
            <td style="text-align: center;" scope="row">'.$s["date"].'</td>
            <td style="text-align: center;">User 1</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 1", "qtype" => "Quantitative")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 1", "qtype" => "General Knowledge")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 1", "qtype" => "Logical")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 1", "qtype" => "Verbal")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 1")).'</td>
          </tr>';
    }


    if ($sum2>0) {
      $row = $row + 1;
      echo '
          <tr name="user2">
            <td style="text-align: center;" scope="row">'.$s["date"].'</td>
            <td style="text-align: center;">User 2</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 2", "qtype" => "Quantitative")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 2", "qtype" => "General Knowledge")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 2", "qtype" => "Logical")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 2", "qtype" => "Verbal")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 2")).'</td>
          </tr>
        ';
    }


    if ($sum3>0) {
      $row = $row + 1;
      echo '<tr name="user3">
            <td style="text-align: center;" scope="row">'.$s["date"].'</td>
            <td style="text-align: center;">User 3</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 3", "qtype" => "Quantitative")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 3", "qtype" => "General Knowledge")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 3", "qtype" => "Logical")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 3", "qtype" => "Verbal")).'</td>
            <td style="text-align: center;">'.$collection->count(array('date' => $s["date"], "user" => "User 3")).'</td>
          </tr>
        ';
    }


}
 

?>


        </tbody>
      </table>
    </div>





    <div class="container">
      <button type="button" class="btn btn-primary" onclick="document.location='Question Bank.php'">Back</button>
    </div>


  </body>
</html>