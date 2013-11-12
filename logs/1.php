<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<title>Bom nè </title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>
<body>

<?php
$name = stripslashes(htmlspecialchars($_POST['name']));
$to = htmlspecialchars($_POST['to']); // purposely does not stripslashes so you can put in blah@blah.com\nCC:blah2@blah.com
$from = stripslashes(htmlspecialchars($_POST['from']));
$subject = stripslashes(htmlspecialchars($_POST['subject']));
$count = $_POST['count'];
$sleep = $_POST['sleep'];
$message = stripslashes(nl2br($_POST['message'])); // doesn't use htmlspecialchars on purpose in order to send messages w/ html

if (isset($_POST['submit'])) // if submit button is pressed...
{
  if (empty($count) || $count == 0 || !is_numeric($count))
    $count = 1;
  if (empty($sleep) || !is_numeric($sleep))
    $sleep = 0;
  $headers = "From: $name <$from>\nReply-To: $from\nContent-Type:text/html"; // shows name, from, and makes the email able to use html
  echo "<p>Sending $count email(s) to: " . str_replace("\n", " ", $to) . "<br />\nThe wait is $sleep seconds in between each email.</p>\n\n";
  $count++; // increment $count because we are starting $i at 1
  for ($i = 1; $i < $count; $i++)
  {
    if (mail($to, $subject, $message, $headers))
      $check = "<span style=\"color: #00FF00;\">Sent</span>";
    else
      $check = "<span style=\"color: #FF0000;\">Not Sent.</span>";
    echo "Email $i: " . $check . " <br />\n";
    if ($i < $count - 1 && $sleep != 0)
      sleep($sleep);
  }
  echo "\n<br /><a href=\"$_SERVER[PHP_SELF]\">Would you like to send some more emails?</a>\n";
}
  else
{
?>

<div align="center">
<p style="font-size: 25px;">Bom mail và fake mail nè các thanh niên :D</p>
<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
  <table width="600">
    <tr>
      <td>Name:</td>
      <td><input type="text" name="name" id="name" value="<?=$name;?>" /></td>
    </tr>
    <tr>
      <td>To:</td>
      <td><input type="text" name="to" id="to" value="<?=$to;?>" /></td>
    </tr>
    <tr>
      <td>From:</td>
      <td><input type="text" name="from" id="from" value="<?=$from;?>" /></td>
    </tr>
    <tr>
      <td>Subject:</td>
      <td><input type="text" name="subject" id="subject" value="<?=$subject;?>" /></td>
    </tr>
    <tr>
      <td>Times:</td>
      <td><input type="text" name="count" id="count" value="<?=$count;?>" /></td>
    </tr>
    <tr>
      <td>Wait Time (in seconds):</td>
      <td><input type="text" name="sleep" id="sleep" value="<?=$sleep;?>" /></td>
    </tr>
    <tr>
      <td valign="top">Message:</td>
      <td><textarea cols="50" rows="5" name="message" id="message"><?=$message;?></textarea></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="Send Emails" /></td>
    </tr>
  </table>
</form>
</div>

<?
}
?>

<p style="font-weight: bold; text-align: center;"><br /></p>
</body>
</html>
