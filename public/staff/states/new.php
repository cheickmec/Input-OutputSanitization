<?php
require_once('../../../private/initialize.php');

//Set default values for all variables
$errors = array();
$state = array(
  'name' => '',
  'code' => '',
  'country_id' => ''
);

if(is_post_request()) {

  if(isset($_POST['name'])) { $state['name'] = $_POST['name']; }
  if(isset($_POST['code'])) { $state['code'] = $_POST['code']; }

  $result = insert_state($state);
  if($result === true) {
    $new_id = db_insert_id($db);
    //echo("Error description: " . mysqli_error($db));
    redirect_to('show.php?id=' . $new_id);
  } else {
    $errors = $result;
  }
}
?>
<?php $page_title = 'Staff: New State'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div id="main-content">
  <a href="index.php">Back to States List</a><br />

  <h1>New State</h1>

  <form action="new.php" method="post">
    Name:<br />
    <input type="text" name="name" value="<?php echo strip_tags($state['name']); ?>" /><br />
    Code:<br />
    <input type="text" name="code" value="<?php echo strip_tags($state['code']); ?>" /><br />
    <br />
    <input type="submit" name="submit" value="Create"  />
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
