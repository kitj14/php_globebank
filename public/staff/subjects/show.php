<?php require_once('../../../private/initialize.php'); require_login();?>

<?php
    $page_title = 'Show Page';
    $id = isset($_GET['id']) ? $_GET['id'] : '1';

    $subject = find_subject_by_id($id);
?>

<?php include_once(SHARED_PATH . '/staff_header.php');?>


<div id="content">
    <a href="<?php echo url_for('staff/subjects/index.php'); ?>">Back to list</a></br>
    
    <h1>Subject: <?php echo h($subject['menu_name']); ?></h1>
    <div class="actions">
        <a href="<?php echo url_for('/index.php?subject_id=' . h(u($subject['id'])) . '&preview=true');?>" class="action" target="_blank">Preview</a>
    </div>
    <div class="attributes">
        <dl>
            <dt>Menu Name</dt>
            <dd><?php echo h($subject['menu_name']); ?></dd>
        </dl>
        <dl>
            <dt>Position</dt>
            <dd><?php echo h($subject['position']); ?></dd>
        </dl>
        <dl>
            <dt>Visible</dt>
            <dd><?php echo $subject['visible'] == '1' ? 'true' : 'false'; ?></dd>
        </dl>
    </div>

    <hr>

    <div class="pages listing">
    <h1>Pages</h1>
        <div class="actions">
            <a class="action" href="<?php echo url_for('staff/pages/new.php?subject_id=' . h(u($subject['id'])));?>">Create New Page</a>
        </div>
        <table class="list">
        <tr>
        <th>ID</th>
        <th>Subject Name</th>
        <th>Position</th>
        <th>Visible</th>
            <th>Name</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        <th>&nbsp;</th>
        </tr>
        <?php 
        // sql query to pages table
        $sql = "SELECT * FROM pages WHERE subject_id='" . $subject['id'] . "' ";
        $sql .= "ORDER BY subject_id ASC, position ASC;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);        
        ?>
        <?php while($page = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo h($page['id']); ?></td>
            <td>
                <?php 
                // sql query to subjects table
                $sql2 = "SELECT * FROM subjects WHERE id='" . db_escape($db, $page['subject_id']) . "'";
                $result2 = mysqli_query($db, $sql2);
                $subject = mysqli_fetch_assoc($result2);
                $subject_name = $subject['menu_name']; // assign menu_name from subjects table to a variable            
                echo h($subject_name); // output menu_name from subjects table          
                ?>
            </td>
            <td><?php echo h($page['position']); ?></td>
            <td><?php echo h($page['visible']) == 1 ? 'true' : 'false'; ?></td>
                <td><?php echo h($page['menu_name']); ?></td>
            <td><a class="action" href=<?php echo url_for("/staff/pages/show.php?id=" . h(u($page['id'])));?>>View</a></td>
            <td><a class="action" href=<?php echo url_for("/staff/pages/edit.php?id=" . h(u($page['id'])));?>>Edit</a></td>
            <td><a class="action" href=<?php echo url_for("/staff/pages/delete.php?id=" . h(u($page['id'])));?>>Delete</a></td>
        </tr>
        <?php } ?>
        </table>
    <?php mysqli_free_result($result); mysqli_free_result($result2); ?>
    </div>


</div>



<?php include_once(SHARED_PATH . '/staff_footer.php');?>

