<?php
    include_once('../../../private/initialize.php');
    $page_title = 'Edit Admin';
    include_once('../../../private/shared/staff_header.php');

    if(!isset($_GET['id'])){
        redirect_to(url_for('staff/admins/index.php'));
    }
    $id = $_GET['id'];

    if(is_post_request()){
        $admin = [];
        $admin['id'] = $id;
        $admin['first_name'] = isset($_POST['first_name']) ? $_POST['first_name'] : '';
        $admin['last_name'] = isset($_POST['last_name']) ? $_POST['last_name'] : '';
        $admin['email'] = isset($_POST['email']) ? $_POST['email'] : '';
        $admin['username'] = isset($_POST['username']) ? $_POST['username'] : '';
        $admin['password'] = isset($_POST['passoword']) ? $_POST['passoword'] : '';
        $admin['confirm_password'] = isset($_POST['confirm_passoword']) ? $_POST['confirm_passoword'] : '';
    
        $result = update_admin($admin);
        if($result === true){
            $_SESSION['message'] = 'Admin was edited successfully!';
            redirect_to(url_for('staff/admins/show.php?id=' . $id));
        }else{
            $errors = $result;
        }
    }else{
        $admin = find_admin_by_id($id);
    }
?>
<div id="content">
    <a href="<?php echo url_for('staff/admins/index.php');?>">Back to List</a>
    <div class="admin edit">
        <h1>Edit Admin</h1>
        <?php echo display_errors($errors); ?>

        <form action="<?php echo url_for('staff/admins/edit.php?id=' . h(u($admin['id'])));?>" method="POST">
            <dl>
                <dt>First Name</dt>
                <dd><input type="text" name="first_name" id="" value="<?php echo h($admin['first_name']);?>"></dd>
            </dl>
            <dl>
                <dt>Last Name</dt>
                <dd><input type="text" name="last_name" id="" value="<?php echo h($admin['last_name']);?>"></dd>
            </dl>
            <dl>
                <dt>email</dt>
                <dd><input type="text" name="email" id="" value="<?php echo h($admin['email']);?>"></dd>
            </dl>
            <dl>
                <dt>Username</dt>
                <dd><input type="text" name="username" id="" value="<?php echo h($admin['username']);?>"></dd>
            </dl>
            <dl>
                <dt>Password</dt>
                <dd><input type="text" name="password" id="" value="<?php echo h($admin['hashed_password']);?>"></dd>
            </dl>
            <dl>
                <dt>Confirm Password</dt>
                <dd><input type="password" name="confirm_password"></dd>
            </dl>
            <p>
                Password should be at least 12 characters and include at least one uppercase letter, lowercase letter, number and symbol.
            </p>
            <div id="operations">
                <input type="submit" value="Edit Admin" />
            </div>
        </form>
    </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
