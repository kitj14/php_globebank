<?php
    include_once('../../../private/initialize.php');
    require_login();
    $page_title = 'Delete Admin';
    include_once('../../../private/shared/staff_header.php');

    if(!isset($_GET['id'])){
        redirect_to(url_for('staff/admins/index.php'));
    }
    $id = $_GET['id'];

    if(is_post_request()){
        $result = delete_admin($id);
        $_SESSION['message'] = 'Admin was deleted successfully!';
        redirect_to(url_for('staff/admins/index.php'));
    }else{
        $admin = find_admin_by_id($id);
    }
?>
<div id="content">
    <a href="<?php echo url_for('staff/admins/index.php');?>">Back to List</a>
    <div class="admin delete">
        <h1>Delete Admin</h1>
        <p>Are you sure you want to delete this admin?</p>
        <p class="item"><?php echo h($admin['username']);?></p>
        <form action="<?php echo url_for('staff/admins/delete.php?id=' . h(u($admin['id'])));?>" method="POST">
            <div id="operations">
                <input type="submit" value="Delete Admin">
            </div>
        </form>
    </div>
</div>

<?php include_once('../../../private/shared/staff_footer.php');?>