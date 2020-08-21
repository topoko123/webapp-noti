<!DOCTYPE html>
<?php  
    session_start();
    include('server.php');
    if (!isset($_SESSION['rusmail'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['rusmail']);
        header('location: login.php');
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home page</title>
</head>
<body>
    <div class="header">
        <h2>Home Page</h2>
    </div>

    <div class="content">
        <!-- log in user infomation -->
        <?php if (isset($_SESSION['rusmail'])) : ?>
            <p>welcom <strong><?php echo $_SESSION['rusmail']; ?></strong></p>
            <p><a href="index.php?Logout='1'">Logout</a></p>
        <?php endif ?>
    </div>
</body>
</html>