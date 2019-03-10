<?php
date_default_timezone_set('Asia/Manila');
$timestamp = date("Y-m-d");

$errors=array();
$modalErrors=array();

class User{
private $table_name = "accounts";
private $conn;

public $accountID;
public $firstName;
public $middleName;
public $lastName;
public $email;
public $username;
public $password_1;
public $password_2;
public $contactNo;
public $image;

public $oldPassword;
public $newPassword_1;
public $newPassword_2;

public $balance;

public $oldBalance;
public $currentBalance;
public $amount;

public $lastID;
public $newTransactionID;
public $fullName;
public $balanceNow;


function __construct($db){
    $this->conn = $db;
}

function readMember(){
    $query = "SELECT * FROM accounts WHERE accessLevel='Member' ORDER by accountStatus ASC";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}

function readUser(){
    $query = "SELECT * FROM accounts WHERE accessLevel LIKE 'Admin' OR accessLevel LIKE 'Attendant'";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    return $stmt;
}

function readProfile(){
    $user = $_SESSION['user']['accountID'];
    $query = "SELECT * FROM accounts INNER JOIN transaction ON accounts.accountID=transaction.accountID WHERE accounts.accountID=? ORDER by transactionID DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$user);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->balance=$row['balanceNow'];
    return $stmt;
}

function readOne(){
    $query = "SELECT * FROM accounts WHERE accountID=?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$this->accountID);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->firstName=$row['firstName'];
    $this->lastName=$row['lastName'];
    $this->middleName=$row['middleName'];
    $this->image=$row['image'];
    $this->email=$row['emailAddress'];
    $this->contactNo=$row['contactNo'];
}

function readLoadMember(){
    //$user = $_SESSION['user']['accountID'];
    $query = "SELECT * FROM accounts INNER JOIN transaction ON accounts.accountID=transaction.accountID WHERE accounts.accountID=? ORDER by transactionID DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1,$this->accountID);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $this->balanceNow=$row['balanceNow'];
    $this->fullName=$row['firstName'].' '.$row['lastName'];
    $this->accountID=$row['accountID'];
    //return $stmt;
}

function register(){
    global $errors,$firstName,$middleName, $lastName, $email, $username, $password_1, $password_2, $contactNo, $db;

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $contactNo = $_POST['contactNo'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $username = $_POST['username'];

    //$imgFile = $_FILES['image']['name'];
    //$tmp_dir = $_FILES['image']['tmp_name'];
    
    $sql = "SELECT * FROM accounts WHERE userName=? or emailAddress=?";

        $check = $this->conn->prepare($sql);
        $check->bindParam(1,$username);
        $check->bindParam(2,$email);
        $check->execute();
        $row = $check->fetch(PDO::FETCH_ASSOC);



    if(empty($firstName)){
        array_push($errors, "First name must not be empty!");
    }
    else if(empty($lastName)){
        array_push($errors, "Last name must not be empty!");
    }
     else if(empty($email)){
        array_push($errors, "Email address must not be empty!");
    }
    else if($row['emailAddress'] == $email){
        array_push($errors, "The Email address you're trying to register already has an existing account!");
    }
     else if(empty($contactNo)){
        array_push($errors, "Contact number must not be empty!");
    }
     else if(empty($username)){
        array_push($errors, "Username must not be empty!");
    }
     else if(empty($password_1)){
        array_push($errors, "Password must not be empty!");
    }
    else if(strlen($password_1) < 8){
        array_push($errors, "Password must be 8 to 20 characters long!");
    }
     else if(empty($password_2)){
        array_push($errors, "Passwords do not match!");
    }
     else if($password_2 !== $password_1){
        array_push($errors, "Passwords do not match!");
    }
    else if($row['userName'] == $username){
        array_push($errors, "Username is already taken");
    }
    

    //else{
    /*$upload_dir = 'images/';
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg','jpg','png','gif');

        $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions)){
            move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else{
            array_push($errors, "Only JPEG, JPG, PNG, GIF formats are allowed!");
        }*/
        
    //}

    if(count($errors) == 0){
        
        $password = md5($password_1);
        $lastName = ucfirst($lastName);
        $firstName = ucfirst($firstName);
        $middleName = ucfirst($middleName);

        if(isset($_POST['accessLevel'])){
            $accessLevel = $_POST['accessLevel'];
            $status = 'active';

            $query = "INSERT INTO accounts SET accessLevel=?, firstName=?, middleName=?, lastName=?, emailAddress=?, userName=?, password=?, contactNo=?, image=?, accountStatus=?";

            $stmt = $this->conn->prepare($query);

            $stmt->bindParam(1,$accessLevel);
            $stmt->bindParam(2,$firstName);
            $stmt->bindParam(3,$middleName);
            $stmt->bindParam(4,$lastName);
            $stmt->bindParam(5,$email);
            $stmt->bindParam(6,$username);
            $stmt->bindParam(7,$password);
            $stmt->bindParam(8,$contactNo);
            $stmt->bindParam(9,$userpic);
            $stmt->bindParam(10,$status);

            $stmt->execute();
            $_SESSION['success']="User creation Successful!!";
            header('location: ../main.php');
            return $stmt;
        }
        else{
            $query = "INSERT INTO accounts SET accessLevel='Member', firstName=?, middleName=?, lastName=?, emailAddress=?, userName=?, password=?, contactNo=?, image=?, accountStatus=?";

            $stmt = $this->conn->prepare($query);
                $status = 'unconfirmed';
            //$stmt->bindParam(1,'Member');
            $stmt->bindParam(1,$firstName);
            $stmt->bindParam(2,$middleName);
            $stmt->bindParam(3,$lastName);
            $stmt->bindParam(4,$email);
            $stmt->bindParam(5,$username);
            $stmt->bindParam(6,$password);
            $stmt->bindParam(7,$contactNo);
            $stmt->bindParam(8,$userpic);
            $stmt->bindParam(9,$status);

            if($stmt->execute()){
              $lastID = $this->conn->lastInsertId();
              $balance="00:00:00";
              
              $sql = "INSERT INTO transaction SET accountID=?,balanceNow=?";
              $st = $this->conn->prepare($sql);
            
                $st->bindParam(1,$lastID);
                $st->bindParam(2,$balance);
                $st->execute();

                $_SESSION['success']="Registration Successful!! Please visit GETS INTERNET Cafe for your account activation.";
                header('location: index.php');  
            }
            else{
                return false;
            }
        }
    }
}//end register

function updateAccount(){
     global $errors, $firstName,$middleName, $lastName, $contactNo;

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];
    $contactNo = $_POST['contactNo'];

    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];


    if(empty($firstName)){
        array_push($errors, "First name is required!");
    }
    else if(empty($lastName)){
        array_push($errors, "Last name is required!");
    }
    else if(empty($contactNo)){
        array_push($errors, "Please enter a mobile number!");
    }
    if($imgFile){
        $upload_dir = 'images/';
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION));
        $valid_extensions = array('jpeg','jpg','png','gif');

        $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions)){
            unlink($upload_dir.$_SESSION['user']['image']);
            move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else{
            array_push($errors, "Only JPEG, JPG, PNG, GIF formats are allowed!");
        }
        
    }
    else{
        $userpic = $_SESSION['user']['image'];
    }

    if(count($errors) == 0){

        //$password = md5($password_1);
            $lastName = ucfirst($lastName);
            $firstName = ucfirst($firstName);
            $middleName = ucfirst($middleName);

            
            if(isset($_SESSION['user']['accountID'])){
                $accountID = $_SESSION['user']['accountID'];

                    $query = "UPDATE accounts SET firstName=?, middleName=?, lastName=?, contactNo=?, image=? WHERE accountID=".$accountID;
                     $stmt = $this->conn->prepare($query);

                     $stmt->bindParam(1,$firstName);
                     $stmt->bindParam(2,$middleName);
                     $stmt->bindParam(3,$lastName);
                     $stmt->bindParam(4,$contactNo);
                     $stmt->bindParam(5,$userpic);
                     //$stmt->bindParam(6,$newPassword);
                     
                     $stmt->execute();

                if($_SESSION['user']['accessLevel'] == 'Admin'){
                $_SESSION['success']="Update Successful!!";
                header('location: main.php');
                }
                else if($_SESSION['user']['accessLevel'] == 'Member'){
                $_SESSION['success']="Update Successful!";
                header('location: memberHome.php');
                }
                else{
                $_SESSION['success']="Update Successful!";
                header('location: main.php');
                }
             
            }
            //return $stmt;

            $_SESSION['user']['firstName']=$firstName;
            $_SESSION['user']['middleName']=$middleName;
            $_SESSION['user']['lastName']=$lastName;
            $_SESSION['user']['contactNo']=$contactNo;
            $_SESSION['user']['image']=$userpic;

        
    }//end error=0
}//end update

function login(){
    global $username, $password, $errors;

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)){
        array_push($errors, "Please enter username!");
    }
    else if(empty($password)){
        array_push($errors, "Please enter password!");
    }

    if(count($errors) == 0){
        $password = md5($password);

        $query = "SELECT * FROM accounts WHERE userName=? AND password=? LIMIT 1";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $password);
 
        $stmt->execute();


        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == true){
            $_SESSION['user'] = $user;
            if($_SESSION['user']['accountStatus'] == 'active'){
                if($_SESSION['user']['accessLevel'] == 'Admin'){
                    $_SESSION['loginMsg']="Welcome ".$_SESSION['user']['firstName']." ".$_SESSION['user']['lastName']."!";
                    header('location: main.php');

                } 
                else if($_SESSION['user']['accessLevel'] == 'Attendant'){
                    $_SESSION['loginMsg']="Welcome ".$_SESSION['user']['firstName']." ".$_SESSION['user']['lastName']."!";
                    header('location: main.php');
                }
                else{
                    $_SESSION['loginMsg']="Welcome ".$_SESSION['user']['firstName']." ".$_SESSION['user']['lastName']."!";
                    header('location: memberHome.php');
                }
            }
            else if($_SESSION['user']['accountStatus'] == 'deactivated'){
                if($_SESSION['user']['accessLevel']=='Member'){
                     array_push($errors, "Your account has been deactivated! Please visit GETS Internet Cafe to reactivate your account.");
                }
                else{
                    array_push($errors, "Your account has been deactivated and is no longer affiliated with GETS ICafe!. Contact the Administrator if you have concerns regarding this matter.");
                }
               
            }
            else{
                array_push($errors, "Please activate your account first! Visit GETS Internet Cafe for your account activation. Thank you!");
            }
        }
        else{
            array_push($errors, "Username or Password is incorrect!");
        }
    }
}//end login

function forgotPassword(){
    global $forgotUser,$forgotEmail,$newPassword,$password,$errors;

    $forgotUser = $_POST['forgotUser'];
    $forgotEmail = $_POST['forgotEmail'];

    if(empty($forgotUser) && empty($forgotEmail)){
        array_push($errors, "You must enter either Username or Email!");
    }
    else if(!empty($forgotUser) && !empty($forgotEmail)){
        array_push($errors, "You must enter either Username or Email only!");
    }
    else if(count($errors) == 0){
        $query = "SELECT * FROM accounts WHERE userName=? OR emailAddress=?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$forgotUser);
        $stmt->bindParam(2,$forgotEmail);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row == true){
            $password = substr(md5(uniqid(rand(),1)),3,10);
            $newPassword = md5($password);

            $to = $row['emailAddress'];
            $subject = "Password Reset";
            $lheaders= "From: <GETS Internet Cafe>";
            $lheaders.= "Reply-To: noreply@gmail.com";
            $lheaders.= "MIME-Version: 1.0\r\n";
            $lheaders.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            $message = '<html><body>';
            $message .= '<img src="../res/logo.png" width="100px">';
            $message .= '<p>Hi <strong>'.$row['userName'].'</strong>! </p>';
            $message .= '<p>You or someone else have requested to change your password. We have sent you a new password. Please keep this as you may need this at a later stage.</p>';
            $message .= '<p>Your new password is <strong>'.$password.'</strong></p>';
            $message .= '<p>Log-in using this password and change you password to something more rememberable.</p>';
            $message .= '<p>Regards,</p>';
            $message .= '<p><img src="res/hagoromo.png" width="100px"><strong>The Hokage</strong></p>';            

            $sql = "UPDATE accounts SET password=? WHERE accountID=".$row['accountID'];
            $prep = $this->conn->prepare($sql);

            $prep->bindParam(1, $newPassword);
            $prep->execute();

            mail($to, $subject, $message, $lheaders);
            $_SESSION['success']="We have sent a new password to your email!";
            header('location:index.php');            
        }
        else{array_push($errors, "Email or Username does not exist in the database!");
        }
    }

    }//endforgotpassword

    function changePassword(){
        global $oldPassword, $newPassword_1, $newPassword_2, $modalErrors;

        $newPassword_1 = $_POST["newPassword_1"];
        $newPassword_2 = $_POST["newPassword_2"];

        $enc = md5($newPassword_1);
        $oldPassword = md5($_POST['oldPassword']);
        
        if($enc == $oldPassword){
            array_push($modalErrors, "New password cannot be the same as current password!");
        }
        else if($newPassword_1 !== $newPassword_2){
            array_push($modalErrors, "New password does not match!");
        }
        else if(strlen($newPassword_1) < 8){
            array_push($modalErrors, "Password must be 8 to 20 characters long!");
        }
        else{
            $query = "SELECT * FROM accounts WHERE accountID=".$_SESSION['user']['accountID'];

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if($row == true){
                if($oldPassword == $row['password']){
                $newPassword = md5($newPassword_1);

                $sql = "UPDATE accounts SET password=? WHERE accountID=".$_SESSION['user']['accountID'];

                $pw = $this->conn->prepare($sql);
                $pw->bindParam(1,$newPassword);
                $pw->execute();

                $_SESSION['modalMsg']="Password successfully changed!";
                $_SESSION['user']['password'] = $newPassword;
                header("refresh:2; editAccount.php");
                //session_destroy();
                //unset($_SESSION['user']);
                }
                else{
                    array_push($modalErrors, "The current password you entered is incorrect!");
                }
            }
            else{
                    array_push($modalErrors, "It seems that user information does not exist in the database!");
                }
            }
    }//end change password

    function deactivateEmployee(){
        $query = "UPDATE accounts SET accountStatus=? WHERE accountID=".$this->accountID;

        $status = "deactivated";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$status);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function deactivateMember(){
        $balance="00:00:00";
        $query = "UPDATE accounts SET accountStatus=? WHERE accountID=?;
        INSERT INTO transaction SET balanceNow=?,accountID=?";

        $status = "deactivated";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$status);
        $stmt->bindParam(2,$this->accountID);
        $stmt->bindParam(3,$balance);
        $stmt->bindParam(4,$this->accountID);
        //$stmt->bindParam(5,$dateStamp);

        if($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }

    function activateUser(){
        
            $status="active";
            $query = "UPDATE accounts SET accountStatus=? WHERE accountID=?";
            $status = "active";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$status);
            $stmt->bindParam(2,$this->accountID);
            
            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }
        
    function loadMember(){
        global $timestamp;
        $totalPrice;
        $quantity=1;
        $ticketID;
        
        if($this->balance=='12:00:00'){
            $totalPrice=200;
            $ticketID=101;
        }
        else if($this->balance=='06:00:00'){
            $totalPrice=100;
            $ticketID=102;
        }
        else{
            $totalPrice=50;
            $ticketID=103;
        }

        $this->amount= $totalPrice;

        $sql="SELECT * FROM transaction WHERE accountID=? ORDER BY transactionID DESC LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1,$this->accountID);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->oldBalance=$row['balanceNow'];

        $sql= "SELECT * FROM servicesale WHERE serviceID=? AND dateStamp=?";
        $check = $this->conn->prepare($sql);
        $check->bindParam(1,$ticketID);
        $check->bindParam(2,$timestamp);
        $check->execute();

        $count = $check->fetch(PDO::FETCH_ASSOC);
        if($count==true){
            $query = "UPDATE transaction SET balanceNew=AddTime(balanceNow,?),amount=? WHERE accountID=?;
            UPDATE servicesale SET quantity=quantity+?,totalPrice=totalPrice+? WHERE serviceID=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->balance);
            $stmt->bindParam(2,$totalPrice);
            $stmt->bindParam(3,$this->accountID);
            $stmt->bindParam(4,$quantity);
            $stmt->bindParam(5,$totalPrice);
            $stmt->bindParam(6,$ticketID);

            if($stmt->execute()){
                return true;
            }
            else{
                return false;
            }
        }
        else{
            $query = "UPDATE transaction SET balanceNew=AddTime(balanceNow,?),amount=? WHERE accountID=?;
            INSERT INTO servicesale SET serviceID=?,quantity=?,totalPrice=?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1,$this->balance);
            $stmt->bindParam(2,$totalPrice);
            $stmt->bindParam(3,$this->accountID);
            $stmt->bindParam(4,$ticketID);
            $stmt->bindParam(5,$quantity);
            $stmt->bindParam(6,$totalPrice);
            //$stmt->bindParam(7,$timestamp);

            if($stmt->execute()){
                return true;
            }
            else{
            return false;
            }
        }
    }//end load

}//end class


?>