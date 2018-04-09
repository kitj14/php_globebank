<?php require_once('../../../private/initialize.php');

if(!isset($_GET['id'])){
    redirect_to(url_for('/staff/pages/index.php'));
}

$id = $_GET['id'];

// sql query to define $page['menu_name'], $page['content'], etc. to be displayed on the form
$sql = "SELECT * FROM pages WHERE id='" . db_escape($db, $id) . "'";
$result = mysqli_query($db, $sql);
$page = mysqli_fetch_assoc($result);
mysqli_free_result($result);

// sql query to define $page_count the total number of rows in pages table
$sql = "SELECT * FROM pages";
$result = mysqli_query($db, $sql);
$page_count = mysqli_num_rows($result);
mysqli_free_result($result);

if(is_post_request()){

    $page = [];
    $page['id'] = $id;
    $page['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : '';
    $page['position'] = isset($_POST['position']) ? $_POST['position'] : '';
    $page['visible'] = isset($_POST['visible']) ? $_POST['visible'] : '';
    $page['subject_id'] = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
    $page['content'] = isset($_POST['content']) ? $_POST['content'] : '';

    $result = update_page($page);
    if($result === true) {
        $_SESSION['message'] = "Page was edited successfully!";
        redirect_to(url_for('/staff/pages/show.php?id=') .$page['id']);
    }else{
        $errors = $result;
    }

}

?>

<?php 
    $page_title = 'Edit Pages';
    include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
    <a href=<?php echo url_for('/staff/pages/index.php'); ?>>Back to List</a><br/>
    <h1>Page edit</h1>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/staff/pages/edit.php?id=' . h(u($id))); ?>" method="POST">
        <h3>Menu Name</h3>
        <input type="text" name="menu_name" value="<?php echo h($page['menu_name']);?>">
        <h3>Subject Name</h3>
            <select name="subject_id">
                <?php            
                    $sql = "SELECT * FROM subjects ORDER BY menu_name";
                    $result = mysqli_query($db, $sql);                    
                    while($subject = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $subject['id']; ?>"
                        <?php if($page['subject_id'] == $subject['id']){ echo " selected"; } ?>
                        ><?php echo $subject['menu_name']; ?></option>
                <?php } mysqli_free_result($result); ?>
            </select>
        <h3>Position</h3>
        <select name="position">
          <?php
            for($i=1; $i <= $page_count; $i++) {
              echo "<option value=\"{$i}\"";
              if($page["position"] == $i) {
                echo " selected";
              }
              echo ">{$i}</option>";
            }
          ?>
        </select>
        <h3>Visible</h3>
        <input type="hidden" name="visible" value="0">
        <input type="checkbox" name="visible" id="" value="1" <?php if($page['visible'] == "1") {echo "checked";} ?>><br/>
        <h3>Content</h3>
        <input type="text" name="content" value="<?php echo h($page['content']);?>"><br/><br/>
        <button type="submit" name="submit">Edit Page</button><br/><br/>
    </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php')?>
    