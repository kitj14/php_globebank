<?php require_once('../../../private/initialize.php'); require_login();?>

<?php $page_title = 'Admins';?>
<?php include_once('../../../private/shared/staff_header.php');?>
<?php
    $result = find_all_admins();
?>
<div id="content">
    <div class="pages listing">
        <h1>Admins</h1>
    </div>
    <div class="actions">
        <a href="<?php echo url_for('staff/admins/new.php');?>">Create New Admin</a>
    </div>
    <table class="list">
        <tr>
            <th>ID</th>
            <th>first_name</th>
            <th>last_name</th>
            <th>email</th>
            <th>username</th>
            <th>hashed_password</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php while($admin = mysqli_fetch_assoc($result)) {?>
        <tr>
            <td><?php echo h($admin['id']);?></td>
            <td><?php echo h($admin['first_name']);?></td>
            <td><?php echo h($admin['last_name']);?></td>
            <td><?php echo h($admin['email']);?></td>
            <td><?php echo h($admin['username']);?></td>
            <td><?php echo h($admin['hashed_password']);?></td>
            <td><a class="action" href=<?php echo url_for("/staff/admins/show.php?id=" . h(u($admin['id'])));?>>View</a></td>
            <td><a class="action" href=<?php echo url_for("/staff/admins/edit.php?id=" . h(u($admin['id'])));?>>Edit</a></td>
            <td><a class="action" href=<?php echo url_for("/staff/admins/delete.php?id=" . h(u($admin['id'])));?>>Delete</a></td>
        </tr>
        <?php } mysqli_free_result($result);?>
    </table>
</div>
<?php include_once('../../../private/shared/staff_footer.php');?>