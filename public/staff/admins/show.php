<?php 
    include_once('../../../private/initialize.php');
    require_login();
    $page_title = 'Show Admin';
    include_once('../../../private/shared/staff_header.php');
    
    $id = isset($_GET['id']) ? $_GET['id'] : '1';
    $admin = find_admin_by_id($id);
?>

<div id="content">
    <a href="<?php echo url_for('staff/admins/index.php');?>">Back to list</a>
    <h1>Username: <?php echo h($admin['username']);?></h1>
    <div class="attributes">
        <dl>
            <dt>First Name</dt>
            <dd><?php echo h($admin['first_name']);?></dd>
        </dl>
        <dl>
            <dt>Last Name</dt>
            <dd><?php echo h($admin['last_name']);?></dd>
        </dl>
        <dl>
            <dt>Email</dt>
            <dd><?php echo h($admin['email']);?></dd>
        </dl>
        <dl>
            <dt>Password</dt>
            <dd><?php echo h($admin['hashed_password']);?></dd>
        </dl>
    </div>
</div>

<?php include_once('../../../private/shared/staff_footer.php');?>