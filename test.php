<?php
$to = "abushop.vn@gmail.com";
$subject = "Web Test";
$message = "Test of php sendmail capability.";
$from = "abushop.vn@gmail.com";
$headers = "From:" . $from;
if(mail($to,$subject,$message,$headers)){
print"<br>Sent to: $to ... Sender: $from";
}else{
print"<br>Not sent to: $to ... Sender: $from";
}
?>