<?php

	
	// include library
	require "vendor/autoload.php";

	// creating connection
	$conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

	session_start();

	// creating or selection database
	$db=$conn->questionBank;

	$collection=$db->daily ;

  if ($_SESSION['filter'] == false) {
    $filter = array();
  }
  else{
    $filter = $_SESSION['filter'];
  }
	
	$sort = array('sort' => array('date' => -1));

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

          <div id="header-title"  onclick="document.location='Question Bank.php'"><a><img src="https://www.freeiconspng.com/uploads/open-book-icon-20.png" width="60" alt="Vector Open Book Icon" /></a>  Question Bank Management</div>
          <button type="button" class="btn btn-dark" onclick="document.location='User.php'">Logout</button>
        </div>
      </nav>
    </header>
    <br>

<?php
if(isset($_POST['customRadioInline1'])){
  if ($_POST['customRadioInline1'] == 'User 1') {
  	$filter = array('user' => 'User 1');
  	if ($_POST['birthday'] != '') {
  		$filter = array('user' => 'User 1', 'date' => $_POST['birthday']);
  	}
  }
  elseif ($_POST['customRadioInline1'] == 'User 2') {
  	$filter = array('user' => 'User 2');
  	if ($_POST['birthday'] != '') {
  		$filter = array('user' => 'User 2', 'date' => $_POST['birthday']);
  	}
  }
  elseif ($_POST['customRadioInline1'] == 'User 3') {
  	$filter = array('user' => 'User 3');
  	if ($_POST['birthday'] != '') {
  		$filter = array('user' => 'User 3', 'date' => $_POST['birthday']);
  	}
  }
  elseif ($_POST['customRadioInline1'] == 'Original') {
  	$filter = array();
  }
  
}
elseif(isset($_POST['birthday']) and $_POST['birthday'] != '') {
  	$filter = array('date' => $_POST['birthday']);
}
 $_SESSION['filter'] = $filter;


if(isset($_POST['customRadioInline2'])){
  if ($_POST['customRadioInline2'] == 'Quantitative') {
  	$sort = array('sort' => array('Quantitative' => 1));
  }
  elseif ($_POST['customRadioInline2'] == 'General Knowledge') {
  	$sort = array('sort' => array('General Knowledge' => 1));
  }
  elseif ($_POST['customRadioInline2'] == 'Logical') {
  	$sort = array('sort' => array('Logical' => 1));
  }
  elseif ($_POST['customRadioInline2'] == 'Verbal') {
  	$sort = array('sort' => array('Verbal' => 1));
  }
  elseif ($_POST['customRadioInline2'] == 'Total') {
  	$sort = array('sort' => array('Total' => 1));
  }
  elseif ($_POST['customRadioInline2'] == 'Quantitative d') {
  	$sort = array('sort' => array('Quantitative' => -1));
  }
  elseif ($_POST['customRadioInline2'] == 'General Knowledge d') {
  	$sort = array('sort' => array('General Knowledge' => -1));
  }
  elseif ($_POST['customRadioInline2'] == 'Logical d') {
  	$sort = array('sort' => array('Logical' => -1));
  }
  elseif ($_POST['customRadioInline2'] == 'Verbal d') {
  	$sort = array('sort' => array('Verbal' => -1));
  }
  elseif ($_POST['customRadioInline2'] == 'Total d') {
  	$sort = array('sort' => array('Total' => -1));
  }
}



?>
    
	<div class="container">
    <button class="btn btn-primary btn-block btn-lg" type="button" data-toggle="collapse" data-target="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">Filter & Sort</button>
    <div class="collapse" id="collapseExample3">
      <div id="fns" class="card card-body">
        <form action='' method="post">
          <label for="validationDefault09"><b>Filter By User</b></label>
          <div class="form-row">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline4" name="customRadioInline1" value="Original" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline4">Original</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline1" name="customRadioInline1" value="User 1" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline1">User 1</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline2" name="customRadioInline1" value="User 2" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline2">User 2</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline3" name="customRadioInline1" value="User 3" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline3">User 3</label>
            </div>
            <div>
            	<label for="birthday">Date:</label>
              <input type="date" id="customRadioInline15" name="birthday">
            </div>
          </div>
          <br>
          <label for="validationDefault10"><b>Sort By(Ascending):</b></label>
          <div class="form-row">          
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline5" name="customRadioInline2" value="Quantitative" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline5">Quantitative</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline6" name="customRadioInline2" value="General Knowledge" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline6">General Knowledge</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline7" name="customRadioInline2" value="Logical" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline7">Logical</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline8" name="customRadioInline2" value="Verbal" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline8">Verbal</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline9" name="customRadioInline2" value="Total" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline9">Total</label>
            </div>
          </div>
          <br>
          <label for="validationDefault10"><b>Sort By(Descending):</b></label>
          <div class="form-row">          
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline10" name="customRadioInline2" value="Quantitative d" class="custom-control-input" >
              <label class="custom-control-label" for="customRadioInline10">Quantitative</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline11" name="customRadioInline2" value="General Knowledge d" class="custom-control-input" >
              <label class="custom-control-label" for="customRadioInline11">General Knowledge</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline12" name="customRadioInline2" value="Logical d" class="custom-control-input" >
              <label class="custom-control-label" for="customRadioInline12">Logical</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline13" name="customRadioInline2" value="Verbal d" class="custom-control-input" >
              <label class="custom-control-label" for="customRadioInline13">Verbal</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="customRadioInline14" name="customRadioInline2" value="Total d" class="custom-control-input">
              <label class="custom-control-label" for="customRadioInline14">Total</label>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-3">
              <button class="btn btn-primary" type="submit">Apply</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
        <br>








<div class="container">
      <table class="table table-bordered table-dark">
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

  $sorted = $collection->find($filter, $sort);
  foreach ($sorted as $s) {
      echo '
          <tr name="user1">
            <td style="text-align: center;" scope="row">'.$s["date"].'</td>
            <td style="text-align: center;">'.$s["user"].'</td>
            <td style="text-align: center;">'.$s["Quantitative"].'</td>
            <td style="text-align: center;">'.$s["General Knowledge"].'</td>
            <td style="text-align: center;">'.$s["Logical"].'</td>
            <td style="text-align: center;">'.$s["Verbal"].'</td>
            <td style="text-align: center;">'.$s["Total"].'</td>
          </tr>';
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