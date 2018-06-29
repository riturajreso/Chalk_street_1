<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>ChalkStreet - Admin</title>
  <link rel="icon" type="images/png" href="/..images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">
 
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/admin.css"> 
  
</head>
<body>

 <header id="home" style="border-bottom: 1px solid #f4efef;">      
 <div class="header">
<div class="upper container">
  <div class="logo">
     	<h1>ChalkStreet</h1>
     	<span>Learn Anytime, Anywhere</span>
  </div>  
</div>
        <div class="clearfix"></div>
  </div>
	    
</header>
<div class="container dash">
	<h2>Welcome Admin</h2>
</div>
	<div class="content container">
		<div class="col-md-12 container">
		<div class="link_box col-md-4">
			<a href="../user/user_main.php">
				<div class="box_img">
					<img src="../images/categ.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Show Article</div>
			</a>
		</div>	
		<div class="link_box col-md-4">
			<a href="user.php">
				<div class="box_img">
					<img src="../images/categ4.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Manage Users</div>
			</a>
		</div>
		<div class="link_box col-md-4">
			<a href="article.php">
				<div class="box_img">
					<img src="../images/categ7.gif" height="100px" width="150px">
				</div>
				<div class="box_text">Manage Artilce</div>
			</a>
		</div>
	</div>
	
	</div>
<script src="../js/jquery-3.3.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

</body>
</html>
