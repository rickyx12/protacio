

    <?php

    //Start session
    session_start();
    //Check whether the session variable SESS_MEMBER_ID is present or not
    if(!isset($_SESSION['employeeID']) || (trim($_SESSION['employeeID']) == '')) {
    header("location: /LOGINPAGE/module.php");
    exit();
    }
    ?>
