<?php
 
if( !isset($_POST['name']) || !isset($_POST['subject']) || !isset($_POST['email']) || !isset($_POST['message']) ){

  header("location: http://delcab.ie?status=form_was_not_filled");

  exit();

}
 
     
 
$to = "joshreynolds242@gmail.com";
$name = $_POST['name'];
$subject = $_POST['subject'];
$from = $_POST['email'];
$message = $_POST['message'];


$emailMsg = "Name: ".$name."\n\nEmail: ".$from."\n\n".$message."\n\n";

$headers .= 'From: <contactform@delcab.ie>' . "\r\n";

mail($to,$subject,$emailMsg,$headers);

?>

<script type="text/javascript">alert("Thanks for contacting Delcab")</script>

<?php 


header("location: http://delcab.ie?status=email_sent_successfully");

?>



