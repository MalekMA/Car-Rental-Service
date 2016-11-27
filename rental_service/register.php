<?php

session_start();

if(isset($_GET['p'])){
    $p = $_GET["p"];

    if($p == 1){
        echo "<p>Please fill all credentials.</p>";
    }
    if($p == 2){
        echo "<p>Account already exists!</p>";
    }
}


echo '
    <html>
    <head>
        <title>Register New Account
    </title>
    </head>
    
    <body>
        <form action="process_register.php" method="post">
        
        <b>Register new account</b>
        
        <p>Email:
            <input type="text" name="Email" size="30" value="" />
        </p>
        
        <p>Password:
            <input type="password" name="Password" size="30"  value="" />
        </p>
        
        <p>First Name:
            <input type="text" name="FName" size="30" maxlength="20" value="" />
        </p>
        
        <p>Last Name:
            <input type="text" name="LName" size="30" maxlength="20"  value="" />
        </p>
        
        <p>Address:
            <input type="text" name="Address" size="30"  maxlength="50" value="" />
        </p>
        
        <p>Sex (M/F):
            <input type="text" name="Sex" size="1" maxlength="1" value="" />
        </p>
        
        <p>Date of Birth:
            <input type="date" name="Date_of_birth"/>
         </p>
         
        <p>License Class (G/G2):
            <input type="text" name="License_class" size="2" maxlength="2"  value="" />
        </p>
        
        <p>License Number:
            <input type="text" name="License_number" size="15" maxlength="15" value="" />
        </p>
        
        <p>License Issue Date:
            <input type="date" name="License_issue"/>
         </p>
         
         <p>License Expiry Date:
            <input type="date" name="License_expiry"/>
         </p>
         
         <p>
            <input type="submit" name="register" value="Register"/>
         </p>
        </form>
    </body>
    </html>
     ';

?>