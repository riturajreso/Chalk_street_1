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
        case 'getarticleList' : getarticleList($conn);break;
        case 'getarticleDetails' : getarticleDetails($conn);break;
        case 'createArticle' : createArticle($conn);break;
        case 'editarticle' : editarticle($conn);break;
        case 'getarticleLog' : getarticleLog($conn);break;
        case 'getarticleComment' : getarticleComment($conn);break;
        case 'updateLike' : updateLike($conn);break;
        case 'addComment' : addComment($conn);break;
    	}
  }

function getarticleList($conn)
{
  $offset = $_POST['offset'];
  $limit = " LIMIT ".PAGINATION_COUNT." OFFSET $offset";
  
  $sql ="  SELECT
          article_id,
          article_headline,
          article_body,
          article_images,
          article_date,
          article_publisher,
          article_author
        FROM
          cS_artilce
        ".$limit;
  $conn->exec('SET NAMES utf8'); 
  $result = $conn->query($sql)->fetchAll();
  $rowcount =  count($result);
  echo json_encode(array('chalkStreet' => array('article_info' => $result,'articleCountList'=>$rowcount)));

}

function getarticleDetails($conn)
{
  $article_id = $_POST['article_id'];
  $sql ="  SELECT
          article_id,
          article_headline,
          article_body,
          article_images,
          article_date,
          article_publisher,
          article_author
        FROM
          cS_artilce
        WHERE  article_id = '$article_id'"; 
  $conn->exec('SET NAMES utf8'); 
  $result = $conn->query($sql)->fetchAll();      
  echo json_encode(array('chalkStreet' => array('article_info' => $result)));
}

function createArticle($conn)
{
    $article_title = $_POST['article_title'];
    $article_auth = $_POST['article_auth'];
    $article_pub = $_POST['article_pub'];
    $article_pub_date = $_POST['article_pub_date'];

    $target_dir = "../images/article_img/";
    $target_file = $target_dir . basename($_FILES["profilePic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(move_uploaded_file($_FILES["profilePic"]["tmp_name"], $target_file)) 
    {
      $uploaded = 1;
    } 
    else 
    {
      $uploaded = 0;
      $target_file = "Error";  
    }
    $current_user = $_SESSION['userID'];
    $sql_insert = "INSERT INTO 
                  cS_artilce
                  SET
                  article_headline = '$article_title',
                  article_body = '', 
                  article_images  = '$target_file', 
                  article_date = '$article_pub_date', 
                  article_publisher  = '$article_pub',
                  article_author  = '$article_auth'";
    $result_insert = $conn->query($sql_insert);
    $addId = $conn->lastInsertId();
    $sql_insert1 = "INSERT INTO 
                  cS_article_map
                  SET
                  article_id  = '$addId',
                  user_id = '$current_user', 
                  added_tym  = now()";  

    $result_insert = $conn->query($sql_insert1); 

    echo json_encode(array('earticle' => array('inserted' => 1)));
}

function editarticle($conn)
{
    $article_title = addslashes($_POST['e_title']);
    $article_auth = $_POST['e_authName'];
    $article_pub = $_POST['e_pubName'];
    $article_pub_date = $_POST['earticle_pub_date'];
    $article_id = $_POST['earticle_id'];

    $sql_update = "UPDATE 
                  cS_artilce
                  SET
                  article_headline = '$article_title',
                  article_body = '', 
                  article_date = '$article_pub_date', 
                  article_publisher  = '$article_pub',
                  article_author  = '$article_auth'
                  WHERE article_id = '$article_id'";
    
    $result_insert = $conn->query($sql_update); 

    echo json_encode(array('chalkStreet' => array('updated' => 1)));
}

function getarticleLog($conn)
{
  $article_id = $_POST['article_id'];
  $sql ="  SELECT
          article_headline,
          added_tym,
          concat(user_fname,' ', user_lname) as userName
        FROM
          cS_article_map AS m
        LEFT JOIN
          cS_artilce AS a ON a.article_id = m.article_id  
        LEFT JOIN
          cS_users  AS u ON u.user_id = m.article_id              
        WHERE  m.article_id = '$article_id'";

  $conn->exec('SET NAMES utf8'); 
  $result = $conn->query($sql)->fetchAll();      
  echo json_encode(array('chalkStreet' => array('article_info' => $result)));      
}

function getarticleComment($conn)
{
  $article_id = $_POST['article_id'];
  $current_user = $_SESSION['userID'];
  $sql_com = "
              SELECT 
              comment, 
              concat(user_fname,' ', user_lname) as userName
              FROM 
              cS_comments AS c
              LEFT JOIN
              cS_users  AS u ON u.user_id = c.user_id
              WHERE article_id = '$article_id'";

  $result = $conn->query($sql_com)->fetchAll();      
  echo json_encode(array('chalkStreet' => array('comment_info' => $result)));                    
}

function updateLike($conn)
{
  $article_id = $_POST['article_id'];
  $current_user = $_SESSION['userID'];
  
  $check_like = "
              SELECT 
                article_id,
                user_id
              FROM 
              cS_likes AS c
              WHERE c.article_id = '$article_id' AND c.user_id = '$current_user'";            
  $result = $conn->query($check_like)->fetchAll();

  if(count($result)>0)
  {
    $del_like = "DELETE FROM `cS_likes` WHERE `article_id` = $article_id AND `user_id` = $current_user";
    $result = $conn->query($del_like);
    echo json_encode(array('chalkStreet' => array('update' => 1))); 
  } 
  else
  {
    $insert_like = "
              INSERT INTO 
              cS_likes
              SET
                article_id= '$article_id',
                user_id = '$current_user'";        
    $result = $conn->query($insert_like);
    echo json_encode(array('chalkStreet' => array('update' => 1))); 
  }
     
}

function addComment($conn)
{
  $article_id = $_POST['article_id'];
  $current_user = $_SESSION['userID'];
  $comment = $_POST['comment'];

  $insert_comm = "
              INSERT INTO 
              cS_comments
              SET
                comment = '$comment',
                article_id= '$article_id',
                user_id = '$current_user'"; 
                      
    $result = $conn->query($insert_comm);
    echo json_encode(array('chalkStreet' => array('update' => 1))); 
}

?>	