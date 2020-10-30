<?php

	
	// include library
	require "vendor/autoload.php";

	// creating connection
	$conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

	session_start();

	// creating or selection database
	$db=$conn->questionBank;

	$collection=$db->questions;

  $function = substr($_POST["question"],0,6);

  if ($function == "delete") {
    $dquestion = substr($_POST["question"],6);
    $do = $collection->findOne(array('question'=>$dquestion));
    $dtype = $do["qtype"];
    $duser = $do["user"];
    $ddate = $do["date"];
    $collection->deleteOne(array("question"=>$dquestion));
    $coll=$db->daily;
    $d = $coll->findOne(array("date" => $ddate, "user" => $duser));
    $tot = (int) $d['Total'];
    $tot = $tot - 1;
      if ($tot == 0) {
           $coll->deleteOne(array("user" => $duser, "date" => $ddate));
      }
      elseif ($dtype == "Quantitative") {
        $amt = (int) $d['Quantitative'];
        $amt = $amt - 1;
        $coll->updateOne(['date' => $ddate, 'user' => $duser], ['$set' => ['Quantitative' => $amt, 'Total' => $tot]]);
      } 
      elseif ($dtype == "General Knowledge") {
        $amt = (int) $d['General Knowledge'];
        $amt = $amt - 1;
        $coll->updateOne(['date' => $ddate, 'user' => $duser], ['$set' => ['General Knowledge' => $amt, 'Total' => $tot]]);
      }
      elseif ($dtype == "Logical") {
        $amt = (int) $d['Logical'];
        $amt = $amt - 1;
        $coll->updateOne(['date' => $ddate, 'user' => $duser], ['$set' => ['Logical' => $amt, 'Total' => $tot]]);
      }
      elseif ($dtype == "Verbal") {
        $amt = (int) $d['Verbal'];
        $amt = $amt - 1;
        $coll->updateOne(['date' => $ddate, 'user' => $duser], ['$set' => ['Verbal' => $amt, 'Total' => $tot]]);
      }
      


    header('Location: Question Bank.php');
    exit;
  }
 

		$uquestion = $_POST["question"];
    $d = $collection->findOne(array('question'=>$uquestion));


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

    <title>Update Question</title>
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

          <div id="header-title" onclick="document.location='Question Bank.php'"><a><img src="https://www.freeiconspng.com/uploads/open-book-icon-20.png" width="60" alt="Vector Open Book Icon" /></a>  Question Bank Management</div>
          <button type="button" class="btn btn-dark" onclick="document.location='User.php'">Logout</button>
        </div>
      </nav>
    </header>
    <br>

    <form action='updateFinal.php' method="post">
      <div class="container">     
        <label for="validationDefault09"><b>Question Type</b></label>
        <div class="form-row">
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline1" name="info" value="Quantitative" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline1">Quantitative</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline2" name="info" value="General Knowledge" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline2">General Knowledge</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline3" name="info" value="Logical" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline3">Logical</label>
          </div>
          <div class="custom-control custom-radio custom-control-inline">
            <input type="radio" id="customRadioInline4" name="info" value="Verbal" class="custom-control-input">
            <label class="custom-control-label" for="customRadioInline4">Verbal</label>
          </div>
        </div>
        <input type="hidden" id="custId" name="update" value="uqtype">
        <input type="hidden" id="custId" name="question" value="<?php echo "$uquestion"; ?>">
        <input type="hidden" id="custId" name="date" value="<?php echo $d['date']; ?>">
        <input type="hidden" id="custId" name="user" value="<?php echo $d['user']; ?>">
    </div>
    <br>


      <div class="container">
      		<div class="col-md-6 mb-3">
            <label for="validationDefault01"><b>Question Title</b></label>
            <input type="text" name="uqtitle" class="form-control" id="validationDefault01" value="<?php echo $d['qtitle']; ?>" required>
            </div>
            <input type="hidden" id="custId" name="update" value="uqtitle">
            <input type="hidden" id="custId" name="question" value="<?php echo "$uquestion" ?>">
      </div>
      <br>

      <div class="container">
      		<div class="col-md-3 mb-3">
            <label for="validationDefault02"><b>Marks</b></label>
            <input type="number" min="0" name="umarks" class="form-control" id="validationDefault02" value="<?php echo $d['marks']; ?>" required>
          </div>
          <input type="hidden" id="custId" name="update" value="umarks">
          <input type="hidden" id="custId" name="question" value="<?php echo "$uquestion" ?>">
      </div>
      <br>


      <div class="container">
      		<div class="col-md-6 mb-3">
            <label for="validationDefault04"><b>Question</b></label>
            <input type="text" name="uquestion" class="form-control" id="validationDefault04" value="<?php echo $d['question']; ?>" required>
        	</div>
          <input type="hidden" id="custId" name="update" value="uquestion">
          <input type="hidden" id="custId" name="question" value="<?php echo "$uquestion" ?>">
      </div>
      <br>


      <div class="container">
      		<div class="col-md-6 mb-3">
            <label for="validationDefault05"><b>Options</b></label>
            <input type="text" name="info1" class="form-control" id="validationDefault05" value="<?php echo $d['option1']; ?>" required><br>
            <input type="text" name="info2" class="form-control" id="validationDefault06" value="<?php echo $d['option2']; ?>" required><br>
            <input type="text" name="info3" class="form-control" id="validationDefault07" value="<?php echo $d['option3']; ?>" required><br>
            <input type="text" name="info4" class="form-control" id="validationDefault08" value="<?php echo $d['option4']; ?>" required>
          </div>
          <input type="hidden" id="custId" name="update" value="uoptions">
          <input type="hidden" id="custId" name="question" value="<?php echo "$uquestion" ?>">
      </div>
      <br>


      <div class="container">
      		<label for="validationDefault10"><b>Correct Option</b></label>
	        <div class="form-row">          
	          <div class="custom-control custom-radio custom-control-inline">
	            <input type="radio" id="customRadioInline5" name="uanswer" value="Option 1" class="custom-control-input">
	            <label class="custom-control-label" for="customRadioInline5">Option 1</label>
	          </div>
	          <div class="custom-control custom-radio custom-control-inline">
	            <input type="radio" id="customRadioInline6" name="uanswer" value="Option 2" class="custom-control-input">
	            <label class="custom-control-label" for="customRadioInline6">Option 2</label>
	          </div>
	          <div class="custom-control custom-radio custom-control-inline">
	            <input type="radio" id="customRadioInline7" name="uanswer" value="Option 3" class="custom-control-input">
	            <label class="custom-control-label" for="customRadioInline7">Option 3</label>
	          </div>
	          <div class="custom-control custom-radio custom-control-inline">
	            <input type="radio" id="customRadioInline8" name="uanswer" value="Option 4" class="custom-control-input">
	            <label class="custom-control-label" for="customRadioInline8">Option 4</label>
	          </div>
            <input type="hidden" id="custId" name="update" value="uanswer">
            <input type="hidden" id="custId" name="question" value="<?php echo "$uquestion" ?>">
	        </div>
          <br>
	        <div class="row">
          <div class="col-3">
            <button class="btn btn-primary" type="submit">Update Question</button>
          </div>
          <div class="col-3">
            <button class="btn btn-primary" type="button" onclick="document.location='Question Bank.php'">Back</button>
          </div>
        </div>
      	</div>
      </form>
      

  </body>
</html>