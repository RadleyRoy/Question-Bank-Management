<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/mystyles.css">

    <title>Select User</title>
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
        </div>
      </nav>
    </header>
    <br>
    <div class="container">
      <form action='saveUser.php' method="post">
        <div style="text-align: center;">Select your User</div>
        <br>
        <div class="row">
          <button type="submit" name="user" value="User 1" onclick="document.location='Question Bank.php'" class="btn btn-primary btn-lg btn-block">User 1</button>
        </div>
        <br>
        <div class="row">
          <button type="submit" name="user" value="User 2" onclick="document.location='Question Bank.php'" class="btn btn-primary btn-lg btn-block">User 2</button>
        </div>
        <br>
        <div class="row">
          <button type="submit" name="user" value="User 3" onclick="document.location='Question Bank.php'" class="btn btn-primary btn-lg btn-block">User 3</button>
        </div>
      </form>
    </div>
    
  </body>
</html>