<?php
    session_start();
    require_once('connection.php');

    if(isset($_POST['login']))
    {
        if(empty($_POST['UserName']) || empty($_POST['password']) )
        {
            header("location: logindesign.php?empty");
            exit();
        }
        else
        {
            $UserName = mysqli_real_escape_string($conn,$_POST['UserName']);
            $Email=mysqli_real_escape_string($conn,$_POST['Email']);
            $Password = mysqli_real_escape_string($conn,$_POST['password']);

            $Query = " select * from users where UserName='".$UserName."' or Email='".$Email."'";
            $result = mysqli_query($conn,$Query);

            if($row=mysqli_fetch_assoc($result))
            {
                // $HashPass = password_verify($Password,$row['Password']);

                if($Password==false)
                {
                    header("location: logindesign.php?P_Invalid");
                    exit();
                }
                elseif($Password==true)
                {
                    $_SESSION['U_D']=$row['ID'];
                    $_SESSION['FName']=$row['FName'];
                    $_SESSION['LName']=$row['LName'];
                    $_SESSION['Email']=$row['Email'];
                    $_SESSION['phonNo']=$row['phonNo'];
                    $_SESSION['UserName']=$row['UserName'];
                    $_SESSION['Password']=$row['Password'];

                    header("location: users/usercoffee.php?Well");
                    exit();

                }

            }
            else
            {
                header("location: logindesign.php?U_Invalid");
                exit();
            }
            
        }


    }
    else
    {
        header("location: logindesign.php");
        exit();
    }

?>