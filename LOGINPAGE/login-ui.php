<? 
  include "homeDatabase.php";
  $module = $_POST['module']; 
  $ro = new synapse();
  //nsa login-ui.js ung mga redirection.
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>LOGIN</title>
    <script src="../COCONUT/js/jquery-2.1.4.min.js"></script>
    <script src="../COCONUT/js/login-ui.js"></script>
    <!--<link rel="stylesheet" href="../bootstrap-3.3.6/css/bootstrap.min.css"></link>-->
    <link rel="stylesheet" href="../COCONUT/myCSS/font-awesome-4.6.3/css/font-awesome.css"></link>
    <link rel="stylesheet" href="../COCONUT/myCSS/login-ui.css"></link>
    <link rel="stylesheet" href="../COCONUT/myCSS/breadcrumb-login.css"></link>
  </head>
  <body>

    <ol id="breadcrumbs">
            <li><a href="module.php"><font color=white>Home</font><span class="arrow"></span></a></li>
            <li><a href="#" class='odd'><font color=yellow><? echo $module ?></font><span class="arrow"></span></a></li>

        <li>&nbsp;&nbsp;</li>
    </ol>
    <?
      $ro->coconutUpperMenuStart();
      $ro->coconutUpperMenuStop();
    ?>

    <div class="signin-form">
      <form class="form">
        <input type="hidden" id="module" value="<? echo $module ?>">
        <input type="hidden" id="from" value="<? echo $module ?>">
        <h2>Protacio Hospital</h2>

        <div class="form-row">
          <label class="fa fa-user" for="username"></label>
          <input id="username" class="input" type="text" placeholder="Enter Username" autocomplete="off" required>
        </div>

        <div class="form-row">
          <label class="fa fa-key" for="password"></label>
          <input id="password" class="input" type="password" placeholder="Enter Password" required>
        </div>

        <i id="error">Sorry, I can't find your account. Pls Try again</i>
        <div class="form-row">
          <span class="virtual-signin">
            <label style="background:#377dd2;" class="fa fa-lock" for="signin">
            <span class="signin-label">Sign In</span>
          </span>
          <input type="button" id="signin">
        </div>

      </form>
    </div>

  </body>
</html>

