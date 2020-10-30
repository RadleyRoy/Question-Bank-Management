<?php
  // include library
  require "vendor/autoload.php";

  // creating connection
  $conn=new MongoDB\Client("mongodb+srv://Radley:user@mycluster.doa2t.mongodb.net/questionBank?retryWrites=true&w=majority");

  session_start();
  // creating or selection database
  $db=$conn->questionBank;

  $collection=$db->questions;

  $docs = $collection->find();

  $_SESSION['filter'] = array();

  $sort1 = array('sort' => array('marks' => 1));
  $sort2 = array('sort' => array('marks' => -1));
  $sort3 = array('sort' => array('qtitle' => 1));
  $sort4 = array('sort' => array('qtitle' => -1));

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

          <div id="header-title" onclick="document.location='Question Bank.php'"><a><img src="https://www.freeiconspng.com/uploads/open-book-icon-20.png" width="60" alt="Vector Open Book Icon" /></a>  Question Bank Management</div>
          <button type="button" class="btn btn-dark" onclick="document.location='User.php'">Logout</button>
        </div>
      </nav>
    </header>
    <br>

    <div class="container">
      <div class="row">
        <button type="button" class="btn btn-dark btn-lg btn-block" onclick="document.location='Trial.php'">Daily Data Entries</button>
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
                <button class="btn btn-dark active" onclick="filterSelection('all')">Show all</button><br><br>
                <button class="btn btn-dark" onclick="filterSelection('Quantitative')">Quantitative</button>
                <button class="btn btn-dark" onclick="filterSelection('Logical')">Logical</button><br><br>
                <button class="btn btn-dark" onclick="filterSelection('General Knowledge')">General Knowledge</button>
                <button class="btn btn-dark" onclick="filterSelection('Verbal')">Verbal</button>
              </div>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="collapse" id="collapseExample2">
            <div class="card card-body">
              <div id="myBtnContainer">
                <button class="btn btn-dark" onclick="sortSelection('amarks')">Marks : Ascending</button>
                <button class="btn btn-dark" onclick="sortSelection('atitle')">Question Title : Ascending</button><br><br>
                <button class="btn btn-dark" onclick="sortSelection('dmarks')">Marks : Descending</button>
                <button class="btn btn-dark" onclick="sortSelection('dtitle')">Question Title : Descending</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>

    <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
   var type1 = document.getElementsByName("sort1");
   var type2 = document.getElementsByName("sort2");
   var type3 = document.getElementsByName("sort3");
   var type4 = document.getElementsByName("sort4");
  var i;
  for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
  for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
  for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
  for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
}, false);
  
</script>

    <script type="text/javascript">
      function filterSelection(c){
        var type1 = document.getElementsByName("Quantitative");
        var type2 = document.getElementsByName("General Knowledge");
        var type3 = document.getElementsByName("Logical");
        var type4 = document.getElementsByName("Verbal");
        var i;
        switch(c){
          case 'all':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'block';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'block';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'block';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'block';
          }
          sortSelection('Hide');
          break;

          case 'Quantitative':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'block';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          sortSelection('Hide');
          break;

          case 'General Knowledge':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'block';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          sortSelection('Hide');
          break;

          case 'Logical':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'block';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          sortSelection('Hide');
          break;

          case 'Verbal':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'block';
          }
          sortSelection('Hide');
          break;

          case 'Hide':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          break;
                  }

      }
    </script>

    <script type="text/javascript">
      function sortSelection(c){
        var type1 = document.getElementsByName("sort1");
        var type2 = document.getElementsByName("sort2");
        var type3 = document.getElementsByName("sort3");
        var type4 = document.getElementsByName("sort4");
        var i;
        switch(c){
          case 'amarks':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'block';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          filterSelection('Hide');
          break;

          case 'dmarks':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'block';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          filterSelection('Hide');
          break;

          case 'atitle':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'block';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          filterSelection('Hide');
          break;

          case 'dtitle':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'block';
          }
          filterSelection('Hide');
          break;

          case 'Hide':
          for (i = 0; i < type1.length; i++){
            type1[i].style.display = 'none';
          }
          for (i = 0; i < type2.length; i++){
            type2[i].style.display = 'none';
          }
          for (i = 0; i < type3.length; i++){
            type3[i].style.display = 'none';
          }
          for (i = 0; i < type4.length; i++){
            type4[i].style.display = 'none';
          }
          break;
                  }

      }
    </script>

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


<div class="container">
  <form action="UpdateAndDelete.php" method="post">

<?php



$x = 1;

  $docs = $collection->find();
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



<?php



$x = 1;

  $docs = $collection->find(array(),$sort1);
  foreach($docs as $d) {
    echo '<div name="sort1"><div style="border-style: solid; border-radius: 25px; border-width: 2px; border-color: black; font-weight: bold; background: #ADA996; background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);"" class="container">
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

<?php



$x = 1;

  $docs = $collection->find(array(),$sort2);
  foreach($docs as $d) {
    echo '<div name="sort2"><div style="border-style: solid; border-radius: 25px; border-width: 2px; border-color: black; font-weight: bold; background: #ADA996; background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);"" class="container">
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

<?php



$x = 1;

  $docs = $collection->find(array(),$sort3);
  foreach($docs as $d) {
    echo '<div name="sort3"><div style="border-style: solid; border-radius: 25px; border-width: 2px; border-color: black; font-weight: bold; background: #ADA996; background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);"" class="container">
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

<?php



$x = 1;

  $docs = $collection->find(array(),$sort4);
  foreach($docs as $d) {
    echo '<div name="sort4"><div style="border-style: solid; border-radius: 25px; border-width: 2px; border-color: black; font-weight: bold; background: #ADA996; background: -webkit-linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996); background: linear-gradient(to right, #EAEAEA, #DBDBDB, #F2F2F2, #ADA996);"" class="container">
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