<?php require_once('../../../private/initialize.php'); require_login();?>

<?php 
    $page_title = 'Show Page'; 
    $id = isset($_GET['id']) ? $_GET['id'] : '1';
    // sql query to pages table
    $sql = "SELECT * FROM pages WHERE id='" . db_escape($db, $id) . "'";
    $result = mysqli_query($db, $sql);
    $page = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    // sql query to subjects table 
    $sql2 = "SELECT * FROM subjects WHERE id='" . db_escape($db, $page['subject_id']) . "'";
    $result2 = mysqli_query($db, $sql2);
    $subject = mysqli_fetch_assoc($result2);
    $subject_name = $subject['menu_name']; // assign retrieved menu_name from subjects table to a variable
    mysqli_free_result($result2);
?>

<?php include_once(SHARED_PATH . '/staff_header.php');?>


    <div id="content">
        <a href="<?php echo url_for('staff/pages/index.php'); ?>">Back to list</a></br>
        <h1>Page: <?php echo h($page['menu_name']); ?></h1>
        <div class="actions">
            <a href="<?php echo url_for('/index.php?id=' . h(u($page['id'])) . '&preview=true');?>" class="action" target="_blank">Preview</a>
        </div>
        <div class="attribute">
            <h3>Menu Name:</h3>
            <blockquote><p><?php echo h($page['menu_name']);?></p></blockquote>
            <h3>Subject Name:</h3>
            <blockquote><p><?php echo h($subject_name);?></p></blockquote> 
            <h3>Position:</h3>
            <blockquote><p><?php echo $page['position'];?></p></blockquote>
            <h3>Visible:</h3>
            <blockquote><p><?php if($page['visible'] == 1) { echo "True"; }else{ echo "False";} ?></p></blockquote>
            <h3>Content:</h3>
            <blockquote><p><?php echo h($page['content']);?></p></blockquote>
        </div>
    </div>

<?php include_once(SHARED_PATH . '/staff_footer.php');?>


