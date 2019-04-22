<?php

require_once('../../../private/initialize.php');

$session->require_login();

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/bicycles/index.php'));
}
$id = $_GET['id'];
if(!$bicycle = Bicycle::find_by_id($id)) {
  redirect_to((url_for('/staff/bicycles/')));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['bicycle'] ?? NULL;

  $bicycle->merge_attributes($args);
  $result = $bicycle->update();

  if($result === true) {
    $session->message('The bicycle was updated successfully.');
    redirect_to(url_for('/staff/bicycles/show.php?id=' . $id));
    exit();
  } else {
    // show errors
  }
}

?>

<?php $page_title = 'Edit Bicycle'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/bicycles/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle edit">
    <h1>Edit Bicycle</h1>

    <?php  echo display_errors($bicycle->errors); ?>

    <form action="<?php echo url_for('/staff/bicycles/edit.php?id=' . h(u($id))); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Edit Bicycle" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>