<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <div class="container-shadow"></div>
    <div class="container">
      <div class="wrap">
        <div class="headings">
          <a id="sign-in" href="#" class="active"><span>Log In</span></a>
          <a id="sign-up" href="#"><span>Sign Up</span></a>
        </div>
        <div id="sign-in-form">
          <!-- <form onsubmit="goToAfterSucessfulLogIn(event);"> -->
          <form method="post" action="form.php">
            <label for="schoolID">School ID *</label>
            <input type="text" name="schoolID" required/>
            <label for="password">Password *</label>
            <input id="password" type="password" name="password" required/>
            <input type="submit" class="button" name="submit" value="Sign in" />
          </form>
  
        </div>
        <div id="sign-up-form">
          <form method="post" action="form.php">
            <label for="schoolID">School ID *</label>
            <input type="text" name="schoolID" required/>
            <label for="username">Full Name *</label>
            <input type="text" name="username" required/>
            <label for="password">Password *</label>
            <input id="password" type="password" name="password" required/>
            <label for="typeOfUser">Are you a student</label>
            <input id="typeOfUser" type="checkbox" name="typeOfUser"/>
            <input type="submit" class="button" name="submit" value="Create Account"/>
          </form>
        </div>
      </div>
    </div>
  </body>
  <script src="form.js"></script>
</html>