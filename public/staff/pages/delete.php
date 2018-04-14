<?php
require_once('../../../private/initialize.php');
require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/pages/index.php'));
}
$id = $_GET['id'];
$sql = "SELECT * FROM pages WHERE id='" . db_escape($db, $id) . "' ";
$result = mysqli_query($db, $sql);
$page = mysqli_fetch_assoc($result);
mysqli_free_result($result);

if(is_post_request()) {

    $old_page = find_page_by_id($id);
    $old_position = $old_page['position'];
    shift_page_positions($old_position, 0, $old_page['subject_id'], $id);

    $sql = "DELETE FROM pages WHERE id='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    if($result) {
      $_SESSION['message'] = "Page was deleted successfully!";
      redirect_to(url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id']))));
    }else{
      echo mysqli_error($db);
      db_disconnect($db);
      exit();
    } 

}

?>

<?php $page_title = 'Delete Page'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a href="<?php echo url_for('staff/subjects/show.php?id=' . h(u($page['subject_id']))); ?>">Back to Subject Page</a></br>

  <div class="subject delete">
    <h1>Delete Subject</h1>
    <p>Are you sure you want to delete this subject?</p>
    <p class="item"><?php echo h($page['menu_name']); ?></p>

    <form action="<?php echo url_for('/staff/pages/delete.php?id=' . h(u($page['id']))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Subject" />
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
