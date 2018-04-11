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


</div>

<?php include_once(SHARED_PATH . '/staff_footer.php');?>

