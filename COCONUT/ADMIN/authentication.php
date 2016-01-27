

    <?php
    session_start();
    if(!isset($_SESSION['employeeID']) || (trim($_SESSION['employeeID']) == '')) {
    header("location: index.php");
    exit();
    }
    ?>
