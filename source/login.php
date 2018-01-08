<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>Login</title>
</head>

<body bgcolor="#f9f0d1">

<form action="connect.php" method="post">
<center>
<h1> Annot: Login </h1>

<font color="#ff0000">
<?php
$message = $_GET['msg'];
print($message);
?>
</font>

<table cellspacing="20" cellpading="1" border="4">
<tr><td>User</td>
    <td><input type="text" size="20" name="user" value="annot"></td>
</tr>
<tr><td>Password</td>
    <td><input type="password" size="20" name="password" value=""></td>
</tr>
</table>
<input type="submit" value="Submit">
<input type="reset" value="Reset">
</center>
</form>

</body>

</html>
