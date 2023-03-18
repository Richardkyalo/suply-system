<?php
if(isset($_SERVER['HTTP_REFERER'])){
 
    $pdo=pdo_connect();
    $email=stripslashes( htmlspecialchars($_POST["email"]));
    $password=stripslashes( htmlspecialchars($_POST["password"]));
    $confirmpassword =stripslashes( htmlspecialchars($_POST["confirmpassword"]));

    $responce=[
        "success" => true,
        "error" => [
            "email" => "",
            "password" => "",
            "confirmpassword" => "",
            "checkpassword" => ""]
    ];
    if(empty($email)||empty($password)||empty($confirmpassword)){
        if(empty( $email)){
                $responce["success"]=false;
                $responce["error"]["email"]="email is required";
                $_SESSION["error"]["email"]=$responce["error"]["email"];
                session_start();
            header("location:router.php?page=signup");

                
        }
        elseif(empty($password0)){
            $responce["success"]=false;
            $responce["error"]["password"]="password is required";
            $_SESSION["error"]=$responce["error"]["password"];
            header("location:router.php?page=signup");
        }elseif(empty($confirmpassword)){
            $responce["success"]=false;
            $responce["error"]["confirmpassword"]="this field is required";
            $_SESSION["error"]=$responce["error"]["confirmpassword"];
            header("location:router.php?page=signup");
            header("location:router.php?page=signup");
        }

}
else{
    if($responce["success"]){
        $userEmailExistsQuery = $pdo->query("SELECT * FROM user WHERE email='{$email}'");
        $userEmailExists = $userEmailExistsQuery->fetch(PDO::FETCH_ASSOC);
        if(!empty($userEmailExists)){
            $response["success"] = false;
            $response["error"]["email"] = "An account this email already exists,proceed to login";
            $_SESSION["error"]=$responce["error"]["email"];
            header("location:router.php?page=signup");                
        }
        else{
            if(!($password==$confirmpassword)){
                $response["success"] = false;
                $response["error"]["checkpassword"] = "passwords should match";
                $_SESSION["error"]=$responce["error"]["checkpassword"];
                header("location:router.php?page=signup");
            }
            if(strlen($password) < 8){
                $response["success"] = false;
                $response["error"]["checkpassword"] = "Your password should be atleast 8 characters and less than 15";
                $_SESSION["error"]=$responce["error"]["checkpassword"];
                header("location:router.php?page=signup");
            }
            else{
                try{
                   
                $hashedPassword = password_hash($password,PASSWORD_DEFAULT);
                $user_id=$emai;
                $stmt = $pdo->prepare("INSERT INTO user( `user_ID`, `email`, `password`) VALUES ('{$user_id}','{$emai}','{$hashedPassword}')");
                $stmt->execute();
                if($stmt){header("location:router.php?page=login");}
                }
                catch(PDOException $exception){
                    $responce["success"]=false;
                }
                if($responce["success"]){

                }
            }

        }
    }
    else{
        echo(json_encode($response));
    }
}
}
?>