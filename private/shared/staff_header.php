<?php 
    if(!isset($page_title)){ $page_title = 'Staff Area';}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GBI - <?php echo h($page_title); ?></title>
    <link rel="stylesheet" href= <?php echo url_for("/stylesheet/staff.css"); ?>>
</head>
<body>
    <header>
        <h1>GBI Staff Area</h1>
    </header>
    <nav>
        <ul>
            <li>User: <?php echo $_SESSION['username'] ?? ''; ?></li>
            <li><a href="<?php echo url_for("/staff/index.php"); ?>">Menu</a></li>
            <li><a href="<?php echo url_for("/staff/logout.php"); ?>">Logout</a></li>
        </ul>
    </nav>
        <blockquote><h2><?php echo $_SESSION['message'] ?? ''; unset($_SESSION['message']); ?></h2></blockquote>