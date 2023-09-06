<?php
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$email=$_POST['emailid'];
$city=$_POST['city'];
$company=$_POST['company'];
$subject=$_POST['subject'];
$message=$_POST['message'];
var_dump($firstname,$lastname);

if(!empty($firstname) || !empty($lastname) || !empty($email) || !empty($city) || !empty($subject) || !empty($message)){
    $host="localhost";
    $dbUsername="root":
    $dbPassword="1234";
    $dbname="digiedge_marketing";

    $conn=new mysqli_connect(hostname:$host,
                            username:$dbUsername,
                            password:$dbPassword,
                            database:$dbname);
    if (mysql_connect_error()){
        die('Connect Error('. mysqli_connect_errno().')'.mysqli_connect_error());
    }else{
        $select="select email from inquiry where Email=? Limit 1";
        $insert="insert into inquiry values(?,?,?,?,?,?,?)";

        $stmt = $conn-> prepare($select);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($email);
        $stmt->store_result();
        $rnum=$stmt->num_rows;
       
        if ($rnum==0){
            $stmt->close();
            $stmt =$conn->prepare($insert);
            $stmt->bind_param("sssssss",$firstname,$lastname,$email,$city,$company,$subject,$message);
            $stmt->execute();
            echo "Your message is recorded";
        }else{
            echo "Someone already registered using this email";
        }
        $stmt->close();
        $conn->close();
    }
}else{
    echo "All field are required";
    die()
}
?>