<?php 
include 'config.php';

$name = $_POST['name'];
$last_name = $_POST['last_name'];
$phone = $_POST['phone'];
$email = $_POST['email'];

// Create

if(isset($_POST['submit'])) {
    $sql = ("INSERT INTO `users`(`name`, `last_name`, `phone`, `email`) VALUES(?,?,?,?)");
	$query = $pdo->prepare($sql);
	$query->execute([$name, $last_name, $phone, $email]);
	$success = '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>You signed up.</strong> You can close this message.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}

//Read

$sql = $pdo->prepare("SELECT * FROM `users`");
$sql->execute();
$result = $sql->fetchAll();

// Update
$edit_name = $_POST['edit_name'];
$edit_last_name = $_POST['edit_last_name'];
$edit_phone = $_POST['edit_phone'];
$edit_email = $_POST['edit_email'];
$get_id = $_GET['id'];
if (isset($_POST['edit-submit'])) {
	$sql = "UPDATE users SET name=?, last_name=?, phone=?, email=? WHERE id=?";
	$querys = $pdo->prepare($sql);
	$querys->execute([$edit_name, $edit_last_name, $edit_phone, $edit_email, $get_id]);
	header('Location: '. $_SERVER['HTTP_REFERER']);
}

// DELETE
if (isset($_POST['delete_submit'])) {
	$sql = "DELETE FROM users WHERE id=?";
	$query = $pdo->prepare($sql);
	$query->execute([$get_id]);
	header('Location: '. $_SERVER['HTTP_REFERER']);
}
?>