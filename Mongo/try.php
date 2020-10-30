<?php
  // include library
  require "vendor/autoload.php";

  // creating connection
  $conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

  // creating or selection database
  $db=$conn->questionBank;

  $collection=$db->questions;

  $docs = $collection->find();

  $sort1 = array('sort' => array('marks' => 1));
  $sort2 = array('sort' => array('marks' => -1));
  $sort3 = array('sort' => array('qtitle' => 1));
  $sort4 = array('sort' => array('qtitle' => -1));
  $sort = array();
  $filter = array();
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
      <div class="row">
        <button type="button" class="btn btn-dark btn-lg btn-block" onclick="document.location='data.php'">Daily Data Entries</button>
      </div>
    </div>
    <br>

    <div class="container">
      <div class="row">
        <div class="col-5">
          <button class="btn btn-primary btn-block" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
            Filter
          </button>
        </div>
        <div class="col-2">
          <button type="button" class="btn btn-success btn-block" onclick="document.location='Add.html'">ADD QUESTION</button>
        </div>
        <div class="col-5">
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
                <form action='' method="post"><button class="btn btn-dark active" name="all">Show all</button></form><br>
                <div class="row"><div class="col">
                <form action='' method="post"><button class="btn btn-dark" name="Quantitative">Quantitative</button></form><br></div>
                <div class="col">
                <form action='' method="post"><button class="btn btn-dark" name="Logical">Logical</button></form><br></div></div>
                <div class="row"><div class="col">
                <form action='' method="post"><button class="btn btn-dark" name="General Knowledge">General Knowledge</button></form><br></div>
                <div class="col">
                <form action='' method="post"><button class="btn btn-dark" name="Verbal">Verbal</button></form></div></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="collapse" id="collapseExample2">
            <div class="card card-body">
              <div id="myBtnContainer">
                <div class="row"><div class="col">
                <form action='' method="post"><button class="btn btn-dark" name='amarks'>Marks : Ascending</button></form><br></div>
                <div class="col">
                <form action='' method="post"><button class="btn btn-dark" name='atitle'>Question Title : Ascending</button></form><br></div></div>
                <div class="row"><div class="col">
                <form action='' method="post"><button class="btn btn-dark" name='dmarks'>Marks : Descending</button></form><br></div>
                <div class="col">
                <form action='' method="post"><button class="btn btn-dark" name='dtitle'>Question Title : Descending</button></form></div></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>

    

<script type="text/javascript">
function confirmSubmit()
{
var agree=confirm("Are you sure you wish to delete this question?");
if (agree)
 return true ;
else
 return false ;
}
</script>


<?php
if(isset($_POST['Quantitative'])){
  $filter = array('qtype' => 'Quantitative');
}
elseif (isset($_POST['General Knowledge'])) {
  $filter = array('qtype' => 'General Knowledge');
}
elseif (isset($_POST['Logical'])) {
  $filter = array('qtype' => 'Logical');
}
elseif(isset($_POST['Verbal'])){
  $filter = array('qtype' => 'Verbal');
}
if(isset($_POST['amarks'])){
  $sort = $sort1;
}
elseif (isset($_POST['dmarks'])) {
  $sort = $sort2;
}
elseif (isset($_POST['atitle'])) {
  $sort = $sort3;
}
elseif(isset($_POST['dtitle'])){
  $sort = $sort4;
}


?>

<div class="container">
  <form action="UpdateAndDelete.php" method="post">

<?php



$x = 1;

  $docs = $collection->find($filter, $sort);
  foreach($docs as $d) {
    echo '<div name="'.$d["qtype"].'"><div style="border-style: solid; border-radius: 25px; border-width: 2px; border-color: black; font-weight: bold; background: #ADA996; background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);" class="container">
              <div class="row">
                &nbsp Question Type: '.$d['qtype'].'
              </div>
              <div class="row">
                &nbsp Question Title: '.$d['qtitle'].'
              </div>
              <div class="row">
                <div class="col-8">Q'.$x.') '.$d['question'].'</div>
                <div class="col-2">'.$d['marks'].' Marks</div>
                <div class="col-2">'.$d['user'].'</div>
              </div>
              <div class="row">
                <div class="col-3">a) '.$d['option1'].'</div>
                <div class="col-3">b) '.$d['option2'].'</div>
              </div>
              <div class="row">
                <div class="col-3">c) '.$d['option3'].'</div>
                <div class="col-3">d) '.$d['option4'].'</div>
              </div>
              <div class="row">
                &nbsp Correct Answer: '.$d['answer'].'
              </div>
              <br>
              <div class="row">
                <div class="col-3">
                  <button type="submit" name="question" value="'.$d["question"].'" class="btn btn-warning">Update Question</button>
                </div>
                <div class="col-3">
                  <button class="btn btn-danger" name="question" value="delete'.$d["question"].'" type="submit"  onClick="return confirmSubmit()">Delete Question</button>
                </div>
              </div>
              <br>
            </div><br></div>';
   $x = $x + 1;
 }
?>

  </form>
</div>


  </body>
</html>