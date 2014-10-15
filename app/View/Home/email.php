<?php
$name = $_POST['name'];
$email = $_POST['email2'];
$message = $_POST['message'];

$subject = "Mensaje de soporte";
$body = "De $name, $email,  \n\n$message";

$to = "sfandinob@gmail.com";

if(@mail($to, $subject, $body))
{
  echo "Mail Sent Successfully";
}else{
  echo "Mail Not Sent";
}

?>