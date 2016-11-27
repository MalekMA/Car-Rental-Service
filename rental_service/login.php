<?php

session_start();

if(isset($_GET['p'])){
    $p = $_GET["p"];

    if($p == 1){
        echo "<p>Please fill all credentials.</p>";
    }
    if($p == 2){
        echo "<p>Incorrect Email or Password.</p>";
    }
}

echo '
    <html>
    <head>
    <title>Login to Car Rental Service</title>
    </head>
    <body>
    
    <form action="process_login.php" method="post">
    
    <p><b>E-Mail:</b>
        <input type="text" name="email" size="20" vale=""/>
    </p>
    
    <p><b>Password:</b>
        <input type="password" name="password" size="20" vale=""/>
    </p>
    
    <tr>
    <p>
        <td><input type="submit" name="login" value="login"/></td>
        <td><input type="button" name="register" value="register" onclick="location.href=\'register.php\'"</td>
    </p>
    </tr>
    </form>
    </body>
    </html>
    ';


?>