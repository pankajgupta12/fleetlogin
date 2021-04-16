<?php
// the message
die;
$msg = "First line of text\nSecond line of text";

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email
mail("pankajgupta7000@gmail.com","My subject test ",$msg);
?>