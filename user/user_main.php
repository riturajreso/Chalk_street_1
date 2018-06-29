<?php
  session_start();
  $current_user = $_SESSION['userID'];
  if(!isset($_SESSION['login_user']))
  {
    header("location: ../index.php");
  }
  
	include '../include/db.php';  
    $sql = "SELECT 
    		B.article_id, 
    		B.article_headline, 
    		B.article_body, 
    		B.article_images, 
    		if( CA.like_id IS NULL , '', CA.like_id ) AS like_id
		    FROM cS_artilce AS B
        LEFT JOIN cS_likes AS CA
        ON
        B.article_id = CA.article_id AND CA.user_id  = '$current_user'";


    $result = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION['article'] = $result;

?>
<!DOCTYPE html>
<html>
<head>
  <title>ChalkStreet - Article</title>
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/register.css">
</head>
<body id="body_log">
<div class="container">
  <div class="header-top">
    <div class="upper-header container">
      <div class="logo">
          <a href="../index.php">
            <h1>ChalkStreet</h1>
            <span>Learn Anytime, Anywhere</span>
          </a>
      </div>
    <div class="pull-right menu">
    <div class="right-nav">
 		<div class="dropdown">
 			<i class = "fa fa-user dropdown-toggle" style = "font-size : 40px" data-toggle="dropdown"></i>
   				<ul class="dropdown-menu">
   				 <li><a href="../user/logout.php" class="login_user">Logout</i></a></li>
				</ul>
		</div> 
    </div>
  </div>  
    </div>
  <div class="clearfix"></div>
  </div>
</div>
<div id="page-wrapper" class="full-width container">
    <div class="right-panel">
    	<div class="title">
    	<span style="color: black">
    		All Article
    	</span>
    	<!-- <span style="color: black;margin-right: 150px; " class="pull-right">
    		Sort by 
    	</span>	 -->
    	</div>
      	<div class="content-main">
<?php
if(count($_SESSION['article'])>0)
{ 
  for ($i = 0; $i < count($_SESSION['article']); $i++) 
	{ 
    if($_SESSION['article'][$i]['like_id']!='')
    {
      $like_class = "icon-red";
      $like_title = "Like";
    }
    else
    {
      $like_class = ""; 
      $like_title = "Like";
    }

    echo '<div class="admin-box col-sm-4" id="">';
    echo '<div class="panel panel-back noti-box">';
    echo '<div class="image-logo"><a href =""><img src="'.$_SESSION['article'][$i]['article_images'].'">';
    echo '<div class ="overlay image-title"><h3><b>'.$_SESSION['article'][$i]['article_headline'].'</b></h3></div>'; 
    echo '</a>';
    echo '</div>';
    echo '<button class="like" title ="'.$like_title.'" data-placement="top" data-toggle="tooltip" data-original-title="" id="'.$_SESSION['article'][$i]['article_id'].'"><i class="fa fa fa-thumbs-up '.$like_class.'"></i></button>';
    echo '<button class="com" title ="Comment" data-placement="top" data-toggle="tooltip" data-original-title="" id="'.$_SESSION['article'][$i]['article_id'].'"><i class="fa fa-comment"></i></a></button>';
    echo '</div>';
    echo '</div>';
	}
}
else
{
  echo '<p class="red" style="margin-left:10px">There is no Article available.</p>';      
}

?>
      </div>
    </div>
  </div>
<!-- alert modal starts here -->
<div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabela" data-backdrop="static">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="alertTitle">Comments</h4>
        </div>  
        <div class="modal-body">
          <div id="alertBody"></div>
        </br>
          <div>
            <textarea rows="4" cols="50" id="comment_box">

            </textarea
          </div>
        </div>
        <div class="modal-footer text-center">
          <input type="hidden" name="article_id" id="article_id">
          <button type="button" id = "confirm_ok" class="btn btn-sm btn-navyblue" data-placement="top" data-toggle="tooltip" data-original-title ="">OK</button>
        </div>
      </div>
    </div>
  </div>

<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>
<script type="text/javascript">
$('body').on("click",".com", function()
{
  var article_id = $(this).attr('id');
  $("#article_id").val(article_id);
  $.ajax({
      url: "../class/article_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'getarticleComment',article_id:article_id}
    }).done(function(data)
    {
    data = JSON.parse(data);
    comment_info = data.chalkStreet.comment_info;
    len = data.chalkStreet.comment_info.length;
    var html = '';
    if(len>0)
    {
      for(var i=0;i<len;i++)
      {
      html+= '<b>Comment :-  </b>'+comment_info[i].comment+'<i> by </i>'+comment_info[i].userName+'</br>';
      }  
    }
    else
    {
      html+= '<b>No Comment</b>';
    }
    $('#alertBody').html(html);
  });
  $('#alertModal').modal('show');
});

$('body').on("click",".like", function()
{
  var article_id = $(this).attr('id');
  $.ajax({
      url: "../class/article_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'updateLike',article_id:article_id}
    }).done(function(data)
    {
    data = JSON.parse(data);
    if(data.chalkStreet.update==1)
    {
      location.reload(); 
    }
  });
  
});

$('body').on("click","#confirm_ok", function()
{
  var article_id = $('#article_id').val();
  var comment = $('#comment_box').val();
  $.ajax({
      url: "../class/article_class.php",
      type: 'POST',//method type
      dataType:'text',
      cache: false,//do not allow requested page to be cached
      data: {ajaxcall : true,function2call: 'addComment',article_id:article_id,comment:comment}
    }).done(function(data)
    {
    data = JSON.parse(data);
    if(data.chalkStreet.update==1)
    {
      location.reload(); 
    }
  });
  
});  
</script>
</body>
</html>