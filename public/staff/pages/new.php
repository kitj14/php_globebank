<?php require_once('../../../private/initialize.php');
require_login();

    $sql = "SELECT * FROM pages ORDER BY position ASC";
    $result = mysqli_query($db, $sql);
    $page  = mysqli_fetch_assoc($result);
    $page_count = mysqli_num_rows($result) + 1;
    mysqli_free_result($result);

    $sql = "SELECT * FROM subjects ORDER BY menu_name";
    $result = mysqli_query($db, $sql);
    $id_count = mysqli_num_rows($result);
    mysqli_free_result($result);

    $page['subject_id'] = isset($_GET['subject_id']) ? $_GET['subject_id'] : '1' ;
    $page['position'] = $page_count;
    $page['menu_name'] = '';

if(is_post_request()){

    $page = [];
    $page['menu_name'] = isset($_POST['menu_name']) ? $_POST['menu_name'] : '';
    $page['position'] = isset($_POST['position']) ? $_POST['position'] : '';
    $page['visible'] = isset($_POST['visible']) ? $_POST['visible'] : '';
    $page['subject_id'] = isset($_POST['subject_id']) ? $_POST['subject_id'] : '';
    $page['content'] = isset($_POST['content']) ? $_POST['content'] : '';

    $result = insert_page($page);
    if($result === true) {
        $_SESSION['message'] = "Page was created successfully!";
        $new_id = mysqli_insert_id($db);
        redirect_to(url_for('/staff/pages/show.php?id=' . $new_id));
    }else{
        $errors = $result;
    }
}


?>

<?php 
    $page_title = 'Create Pages';
    include(SHARED_PATH . '/staff_header.php');
?>
<div id="content">
    <a class="back-link" href="<?php echo url_for('/staff/subjects/show.php?id=' . h(u($page['subject_id'])));?>">Back to Subject Page</a>
    <div class="pages new">
        <h1>Create Pages</h1>
        <?php echo display_errors($errors); ?>
        <form action="<?php echo url_for('/staff/pages/new.php');?>" method="POST">
            <h3>Menu name</h3>
            <input type="text" name="menu_name" value = "<?php echo h($page['menu_name']);?>"><br/>
            <h3>Subject Name</h3>
            <select name="subject_id">
                <?php            
                    $sql = "SELECT * FROM subjects ORDER BY menu_name";
                    $result = mysqli_query($db, $sql);                    
                    while($subject = mysqli_fetch_assoc($result)){ ?>
                        <option value="<?php echo $subject['id']; ?>" <?php if($page['subject_id'] == $subject['id']) { echo "selected"; }?>><?php echo $subject['menu_name']; ?></option>
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
            <input type="checkbox" name="visible" value="1"><br/>
            <h3>Content</h3>
            <input type="text" name="content"><br/><br/>
            <button type="submit" name="submit">Create Page</button><br/><br/>
        </form>        
    </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php');