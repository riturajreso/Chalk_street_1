<?php
	include '../include/db.php';
    session_start();
   
	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
            case 'loginCheck' : loginCheck($conn);break;
            case 'registerUser' : registerUser($conn);break;
    	}
    }

    function loginCheck($conn)
        {
            $uName = $_POST['uName'];
            $cPass = $_POST['cPass'];
            $u_password_md5 = md5($cPass);
           
            $sql = "SELECT
             user_id AS u_id, 
             user_email AS email,
             user_pwd AS pass,
             user_fname AS fname,
             user_lname AS lname,
             user_type AS admin_flag
            FROM 
              cS_users   
            WHERE 
              user_email = '$uName' AND 
              user_pwd = '$u_password_md5'";
            
            $result = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
            if(count($result)>0)
            {
                $_SESSION['login_user'] = $uName;
                $_SESSION['userID'] = $result[0]['u_id'];
                echo json_encode(array('chalkStreet' => array('success' => 1 ,'user_details'=>$result)));
            }
            else
            {
                echo json_encode(array('chalkStreet' => array('success' => 0 )));
            }
             
        }

        function registerUser($conn)
        {
            $ename = $_POST['ename'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $u_password = $_POST['pwd'];
            $u_password_md5 = md5($u_password);
            $check_exist = "SELECT
                            user_email
                          FROM 
                            cS_users   
                          WHERE
                          user_email = '$ename'";
            $result_exist = $conn->query($check_exist)->fetchAll(PDO::FETCH_ASSOC);
            $count = count($result_exist);

            if($count>0)
            {
                $result = 0;
                echo json_encode(array('chalkStreet' => array('success' => 0 ,'inserted'=>$result)));
            }
            else
            {
            $sql_insert = "INSERT INTO 
                            cS_users 
                        SET 
                        user_email = '$ename', 
                        user_pwd = '$u_password_md5', 
                        user_type = '0',
                        user_lname = '$lname', 
                        user_fname = '$fname'";           

            $result = $conn->query($sql_insert);  
            $_SESSION['login_user'] = $ename;
            $addId = $conn->lastInsertId();
            $_SESSION['userID'] = $addId;

            echo json_encode(array('chalkStreet' => array('success' => 1 ,'inserted'=>$addId)));

            }

            
        }    
?>
