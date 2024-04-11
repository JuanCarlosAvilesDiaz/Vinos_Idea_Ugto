<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN VINOS UG</title>
    <link rel="stylesheet" href="login2.css">
    <link rel="shortcut icon" href="main/images/LogoUgto.png" type="image/x-icon">
    <link rel="icon" href="main/images/LogoUgto.png" type="image/x-icon">
</head>
  <body>
  <?php
            require ('templates/header.php');
  ?>
    <div class="login-wrap">
      <div class="login-html">
        <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Sign In</label>
        <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
        <div class="login-form">
          <div class="sign-in-htm">
            <form method="post" action="login.php">
            <div class="group">
              <label for="user" class="label">UserName</label>
              <input id="user" type="text" class="input" required name="Email">
            </div>
            <div class="group">
              <label for="pass" class="label">Password</label>
              <input id="pass" type="password" class="input" data-type="password" required name="pass">
            </div>
            <div class="group">
              <input id="check" type="checkbox" class="check" checked>
              <label for="check"><span class="icon"></span> Keep me Signed in</label>
            </div>
            <div class="group">
              <a>
                <button type="submit" class="transparent-button"> Submit
                  <span></span>
                  <span></span>
                  <span></span>
                  <span></span>
                </button> 
              </a>
            </div>
          </form>
            <div class="hr"></div>
            <div class="foot-lnk">
              <a>WELCOME TO ANÁLISIS UG</a>
            </div>
          </div>
          <div class="sign-up-htm">
            <h2>Comunícate con el área de soporte.</h2>
          </div>
          <!--<div class="sign-up-htm">
            <div class="group">
              <label for="user" class="label">Username</label>
              <input id="user" type="text" class="input">
            </div>
            <div class="group">
              <label for="pass" class="label">Password</label>
              <input id="pass" type="password" class="input" data-type="password">
            </div>
            <div class="group">
              <label for="pass" class="label">Repeat Password</label>
              <input id="pass" type="password" class="input" data-type="password">
            </div>
            <div class="group">
              <label for="pass" class="label">Email Address</label>
              <input id="pass" type="text" class="input">
            </div>
            <div class="group">
              <input type="submit" class="button" value="Sign Up">
            </div>
            <div class="hr"></div>
            <div class="foot-lnk">
              <label for="tab-1">Already Member?</a>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </body>  
</HTML>