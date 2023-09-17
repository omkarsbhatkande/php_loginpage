<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
 
 $errors=[];

 if($_SERVER["REQUEST_METHOD"]=== "POST"){

 
 
 //santize the input 
 
 
 $name=htmlspecialchars($_POST["name"]);
 $password=htmlspecialchars($_POST["password"]);
 $hashedPassword=password_hash($password,PASSWORD_BCRYPT);
 $email=htmlspecialchars($_POST["email"]);
 $phone=htmlspecialchars($_POST["phone"]);
 
 if (empty($name)) {
     $errors[] = "name is required.";
 } 
 
 if (empty($password)) {
     $errors[] = "password is required.";
 } elseif (strlen($password) < 8) {
     $errors[] = "password must be at least 8 characters long.";
 }
 
 if (empty($email)) {
     $errors[] = "email is required.";
 } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
     $errors[] = "Invalid email format";
 }
 
 if (empty($phone)) {
     $errors[] = "phone is required.";
 } elseif (!preg_match("/^\d{10}$/", $phone)) {
     $errors[] = "phone must be  10 digits long.";
 }
}

 ?>

<?php
if($_SERVER["REQUEST_METHOD"]=== "POST" && empty($errors)){
 echo "<P>data submitted successfully</P>";

 // Create a database connection
$conn = new mysqli("localhost", "root", "", "mybank");

$sql = "insert into  form (name,password,email,phone) VALUES ('$name','$hashedPassword','$email','$phone')";

if ($conn->query($sql) === TRUE) {
    echo "Word saved into the database successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}
else{
?>
 <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

<table align ="center">
    <tr>
        <td><label for="name"> Name: </label> </td>
        <td> <input id="name" name="name" type="text" placeholder="enter your name"><td><span id="Error" style="color:red"></span>
    </tr>

    <tr>
        <td><label for="password"> password: </label> </td>
        <td> <input id="password" name="password" type="text" placeholder="enter your password"><td><span  id="aError" style="color:red"></span>
    </tr>

    <tr>
        <td><label for="email"> Email: </label> </td>
        <td> <input id="email" name="email" type="text" placeholder="enter your Email"><td><span  id="emailer" style="color:red"></span>
    </tr>

    <tr>
        <td><label for="phone"> Phone: </label> </td>
        <td> <input id="phone" name="phone" type="text" placeholder="enter your Phone"><td><span  id="phoneer" style="color:red"></span>
    </tr>

    <tr>
        <td> <input type="reset" value="reset"></td>
        <td>  <input type="submit" value="submit"> </td>
    </tr>

</table>


</form>
<?php


    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } else {}
}

?>



</body>
</html>