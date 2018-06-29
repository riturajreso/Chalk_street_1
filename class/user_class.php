<?php
	include '../include/db.php';
  error_reporting(E_ERROR | E_PARSE);
    ini_set("display_errors", 1);
    ini_set('memory_limit', '-1');
	session_start();

	if(isset($_POST['function2call']) && !empty($_POST['function2call'])) 
	{
    	$function2call = $_POST['function2call'];
    	switch($function2call) 
    	{
        case 'getUserList' : getUserList($conn);break;
        case 'createUser' : createUser($conn);break;
    	}
  }

function getUserList($conn)
{
  $flag = $_POST['flag'];
  $offset = $_POST['offset'];
  $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";
  $sql ="
        SELECT
          user_id,
          user_email,
          if(`user_fname` is null ,'N/A',`user_fname`) AS `user_fname`,
          if(`user_lname` is null ,'N/A',`user_lname`) AS `user_lname`,  
          user_isactive,
          user_type AS admin_flag
        FROM
          cS_users
        WHERE 
          user_isactive = '$flag'".$limit;

  $result = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
  $rowcount =  count($result);
  echo json_encode(array('chalkStreet' => array('user_info' => $result,'usersCountList'=>$rowcount)));

}

function createUser($conn)
{
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $emailId = $_POST['emailId'];
  $pwd = $_POST['pwd'];
  $u_password_md5 = md5($pwd);
  $admin_flag = $_POST['admin_flag'];


   $check_exist = "SELECT
                      user_email
                     FROM
                      cS_users
                    WHERE
                    user_email = '$emailId'";
    $result = $conn->query($check_exist)->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);              
    if($count>0)
    {
      $result_insert = 0;
      echo json_encode(array('chalkStreet' => array('success' => 0)));
    }
    else
    {
      $sql_insert = "INSERT INTO 
                  cS_users
                  SET
                  user_fname = '$fname',
                  user_lname = '$lname', 
                  user_email = '$emailId', 
                  user_pwd = '$u_password_md5', 
                  user_isactive = '1', 
                  user_type = '$admin_flag'";
      $result_insert = $conn->query($sql_insert);   
      $addId = $conn->lastInsertId();
      echo json_encode(array('chalkStreet' => array('success' => 0,'inserted'=> $addId)));        
    }

   
}


?>	