<?php

  
  // include library
  require "vendor/autoload.php";

  // creating connection
  $conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

  session_start();

  // creating or selection database
  $db=$conn->questionBank;

  $collection=$db->questions;

  $sorted = $collection->find(array('user' => 'User 1'), array('sort' => array('date' => 1)));
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

    <title>Question Bank Management</title>
  </head>
  <body>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

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
      <h2>User 1</h2>
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th style="text-align: center;" scope="col">Dates</th>
            <th style="text-align: center;" scope="col">Quantitative</th>
            <th style="text-align: center;" scope="col">General Knowledge</th>
            <th style="text-align: center;" scope="col">Logical</th>
            <th style="text-align: center;" scope="col">Verbal</th>
            <th style="text-align: center;" scope="col">Total</th>
          </tr>
        </thead>

<?php

  $sorted = $collection->find(array('user' => 'User 1'), array('sort' => array('date' => 1)));
  $acount = 0;
  $bcount = 0;
  $ccount = 0;
  $dcount = 0;
  $count = 0;
  $prev_date = 0;
  $flag = 0;
  foreach ($sorted as $s){
    
    if($flag==0){
      $flag = 1;
      $count = 1;
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = 1;
          break;
        case 'General Knowledge':
        $bcount = 1;
          break;
        case 'Logical':
        $ccount = 1;
          break;
        case 'Verbal':
        $dcount = 1;
          break;
      }
      $prev_date = $s["date"];
    }
    elseif($prev_date == $s["date"]) {
      $count = $count + 1;
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = $acount + 1;
          break;
        case 'General Knowledge':
        $bcount = $bcount + 1;
          break;
        case 'Logical':
        $ccount = $ccount + 1;
          break;
        case 'Verbal':
        $dcount = $dcount + 1;
          break;
      }
     $flag = 1;
    }
    else{

  echo '<tbody>
          <tr>
            <th style="text-align: center;" scope="row">'.$prev_date.'</th>
            <td style="text-align: center;">'.$acount.'</td>
            <td style="text-align: center;">'.$bcount.'</td>
            <td style="text-align: center;">'.$ccount.'</td>
            <td style="text-align: center;">'.$dcount.'</td>
            <td style="text-align: center;">'.$count.'</td>
          </tr>
        </tbody>';
        $prev_date = $s["date"];
        $acount = 0;
        $bcount = 0;
        $ccount = 0;
        $dcount = 0;
        $count = 1; 
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = 1;
          break;
        case 'General Knowledge':
        $bcount = 1;
          break;
        case 'Logical':
        $ccount = 1;
          break;
        case 'Verbal':
        $dcount = 1;
          break;
      }
        $flag = 1;
      }

}
  echo '<tbody>
          <tr>
            <th style="text-align: center;" scope="row">'.$prev_date.'</th>
            <td style="text-align: center;">'.$acount.'</td>
            <td style="text-align: center;">'.$bcount.'</td>
            <td style="text-align: center;">'.$ccount.'</td>
            <td style="text-align: center;">'.$dcount.'</td>
            <td style="text-align: center;">'.$count.'</td>
          </tr>
        </tbody>';

?>



      </table>
    </div>

    <div class="container">
      <h2>User 2</h2>
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th style="text-align: center;" scope="col">Dates</th>
            <th style="text-align: center;" scope="col">Quantitative</th>
            <th style="text-align: center;" scope="col">General Knowledge</th>
            <th style="text-align: center;" scope="col">Logical</th>
            <th style="text-align: center;" scope="col">Verbal</th>
            <th style="text-align: center;" scope="col">Total</th>
          </tr>
        </thead>

<?php

  $sorted = $collection->find(array('user' => 'User 2'), array('sort' => array('date' => 1)));
  $acount = 0;
  $bcount = 0;
  $ccount = 0;
  $dcount = 0;
  $count = 0;
  $prev_date = 0;
  $flag = 0;
  foreach ($sorted as $s){
    
    if($flag==0){
      $flag = 1;
      $count = 1;
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = 1;
          break;
        case 'General Knowledge':
        $bcount = 1;
          break;
        case 'Logical':
        $ccount = 1;
          break;
        case 'Verbal':
        $dcount = 1;
          break;
      }
      $prev_date = $s["date"];
    }
    elseif($prev_date == $s["date"]) {
      $count = $count + 1;
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = $acount + 1;
          break;
        case 'General Knowledge':
        $bcount = $bcount + 1;
          break;
        case 'Logical':
        $ccount = $ccount + 1;
          break;
        case 'Verbal':
        $dcount = $dcount + 1;
          break;
      }
     $flag = 1;
    }
    else{

  echo '<tbody>
          <tr>
            <th style="text-align: center;" scope="row">'.$prev_date.'</th>
            <td style="text-align: center;">'.$acount.'</td>
            <td style="text-align: center;">'.$bcount.'</td>
            <td style="text-align: center;">'.$ccount.'</td>
            <td style="text-align: center;">'.$dcount.'</td>
            <td style="text-align: center;">'.$count.'</td>
          </tr>
        </tbody>';
        $prev_date = $s["date"];
        $acount = 0;
        $bcount = 0;
        $ccount = 0;
        $dcount = 0;
        $count = 1; 
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = 1;
          break;
        case 'General Knowledge':
        $bcount = 1;
          break;
        case 'Logical':
        $ccount = 1;
          break;
        case 'Verbal':
        $dcount = 1;
          break;
      }
        $flag = 1;
      }

}
  echo '<tbody>
          <tr>
            <th style="text-align: center;" scope="row">'.$prev_date.'</th>
            <td style="text-align: center;">'.$acount.'</td>
            <td style="text-align: center;">'.$bcount.'</td>
            <td style="text-align: center;">'.$ccount.'</td>
            <td style="text-align: center;">'.$dcount.'</td>
            <td style="text-align: center;">'.$count.'</td>
          </tr>
        </tbody>';

?>



      </table>
    </div>

    <div class="container">
      <h2>User 3</h2>
      <table class="table table-bordered table-dark">
        <thead>
          <tr>
            <th style="text-align: center;" scope="col">Dates</th>
            <th style="text-align: center;" scope="col">Quantitative</th>
            <th style="text-align: center;" scope="col">General Knowledge</th>
            <th style="text-align: center;" scope="col">Logical</th>
            <th style="text-align: center;" scope="col">Verbal</th>
            <th style="text-align: center;" scope="col">Total</th>
          </tr>
        </thead>

<?php

  $sorted = $collection->find(array('user' => 'User 3'), array('sort' => array('date' => 1)));
  $acount = 0;
  $bcount = 0;
  $ccount = 0;
  $dcount = 0;
  $count = 0;
  $prev_date = 0;
  $flag = 0;
  foreach ($sorted as $s){
    
    if($flag==0){
      $flag = 1;
      $count = 1;
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = 1;
          break;
        case 'General Knowledge':
        $bcount = 1;
          break;
        case 'Logical':
        $ccount = 1;
          break;
        case 'Verbal':
        $dcount = 1;
          break;
      }
      $prev_date = $s["date"];
    }
    elseif($prev_date == $s["date"]) {
      $count = $count + 1;
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = $acount + 1;
          break;
        case 'General Knowledge':
        $bcount = $bcount + 1;
          break;
        case 'Logical':
        $ccount = $ccount + 1;
          break;
        case 'Verbal':
        $dcount = $dcount + 1;
          break;
      }
     $flag = 1;
    }
    else{

  echo '<tbody>
          <tr>
            <th style="text-align: center;" scope="row">'.$prev_date.'</th>
            <td style="text-align: center;">'.$acount.'</td>
            <td style="text-align: center;">'.$bcount.'</td>
            <td style="text-align: center;">'.$ccount.'</td>
            <td style="text-align: center;">'.$dcount.'</td>
            <td style="text-align: center;">'.$count.'</td>
          </tr>
        </tbody>';
        $prev_date = $s["date"];
        $acount = 0;
        $bcount = 0;
        $ccount = 0;
        $dcount = 0;
        $count = 1; 
      switch ($s["qtype"]) {
        case 'Quantitative':
        $acount = 1;
          break;
        case 'General Knowledge':
        $bcount = 1;
          break;
        case 'Logical':
        $ccount = 1;
          break;
        case 'Verbal':
        $dcount = 1;
          break;
      }
        $flag = 1;
      }

}
  echo '<tbody>
          <tr>
            <th style="text-align: center;" scope="row">'.$prev_date.'</th>
            <td style="text-align: center;">'.$acount.'</td>
            <td style="text-align: center;">'.$bcount.'</td>
            <td style="text-align: center;">'.$ccount.'</td>
            <td style="text-align: center;">'.$dcount.'</td>
            <td style="text-align: center;">'.$count.'</td>
          </tr>
        </tbody>';

?>



      </table>
    </div>

    <div class="container">
      <button type="button" class="btn btn-primary" onclick="document.location='Question Bank.php'">Back</button>
    </div>


  </body>
</html>