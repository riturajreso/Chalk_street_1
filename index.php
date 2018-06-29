<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>ChalkStreet - Login/SignUp</title>
	<link rel="icon" type="images/png" href="images/book.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/register.css">
  <link rel="stylesheet" type="text/css" href="stylesheets/main.css"> 
</head>
<body id="body_log">
<div class="container">
  <div class="header-top">
    <div class="upper-header container"> 
      <div class="logo">
          <a href="index.php">
          	<h1>ChalkStreet</h1>
          	<span>Learn Anytime, Anywhere</span>
          </a>
      </div>  
    </div>
  <div class="clearfix"></div>
  </div>
</div>

<div class="container-fluid register-container">
  <div class="login-box form1">
	<div><p class="register-title">Log In</p></div>
 		<fieldset class="register-input-container">
			<div class="register-input-item">
				<input type="email" name="username_login" id="username_login" class="user-name register-user-input" placeholder="User Email" >
				<div id="login_name_error" class="val_error"></div>
			</div>
			<div class="register-input-item">
				<input type="password" name="password_login" id="password_login" class="user-password register-user-input" placeholder="Choose Password">
				<div id="login_password_error" class="val_error"></div> 
			</div>
    </fieldset>
		<fieldset class="login-button-container">
			<button class="login-button" id="loginOk">Login</button>
		</fieldset>
	<div class="register-link-container">
		<div class="register-login-link">
			<p class="message"><span class="register-info-link">Don't have an account?</span> 
			<a href="#" class="register-link" id="reg_new">Register here!</a></p>
		</div>
	</div>
  </div>  

<div class="register-box form2">
	<div><p class="register-title">Sign Up with Us</p></div>
		<fieldset class="register-input-container">
      <div class="register-input-item">
        <input type="text" name="fname" id="fname" class="user-email register-user-input" placeholder="First Name">
        <div id="fname_error" class="val_error"></div>
      </div>
      <div class="register-input-item">
        <input type="text" name="lname" id="lname" class="user-email register-user-input" placeholder="Last Name">
        <div id="lname_error" class="val_error"></div>
      </div>
			<div class="register-input-item">
				<input type="email" name="username" id="username" class="user-email register-user-input" placeholder="User Email">
				<div id="email_error" class="val_error"></div>
			</div>
			<div class="register-input-item">
				<input type="password" name="password" id="pwd" class="user-password register-user-input" placeholder="Enter Password" id="password">
			</div>
			<div class="register-input-item">
				<input type="password" name="password_confirmation" id="cnfpwd" class="user-password register-user-input" placeholder="Confirm Password" id="password_confirm">
				<div id="password_error" class="val_error"></div>
			</div>
		</fieldset>
		<fieldset class="register-button-container">
			<button class="register-button" id="register">REGISTER</button>
		</fieldset>
	<div class="register-link-container">
		<div class="register-login-link">
			<p class="message"><span class="register-info-link">Already have an account?</span>
			<a href="#" class="register-link">Login!</a></p>
		</div>
	</div>
</div>
</div>

<div class="modal fade welcome-modal" id="newuser_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-sm" role="document" style="width: 30%;">
      <div class="modal-content">
         <div class="modal-body text-center" >
          <h2 class="welcome">Welcome </h2>
          <p class="message-welcome">to ChalkStreet, a <b>Task_1</b> product</p>
            <p id="Cuname"></p>
            <p id="Cpass"></p>
           <button type="button" data-dismiss="modal" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-yellow" id ="welcome_ok" >Continue</button>        
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade welcome-modal" id="erro_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
     <div class="modal-dialog modal-sm" role="document" style="width: 36%;">
      <div class="modal-content">
         <div class="modal-body text-center" >
          <h2 class="welcome">Welcome </h2>
          <p class="message-welcome">to ChalkStreet, a <b>Task_1</b> product</p>
           <p>User Name : <span class="red" id="err_username"></span> already exits, Please try with different User Name or Login with Same</p>
           <button type="button" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-blue" id ="login_again" >Login wih Same</button> 
           <button type="button" aria-label="Close" data-toggle="tooltip" data-original-title="" class="btn btn-lg btn-grey" id ="register_new" >Register New</button>        
        </div>
      </div>
    </div>
  </div>

<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
  $('.message a').click(function() {
    $('.form1').animate({height: "toggle", opacity: "toggle"}, "slow");
     $('.form2').animate({height: "toggle", opacity: "toggle"}, "slow");
  }); 

  $("body").on('click','#loginOk',function(){
    $('.val_error').text('').hide();
    var uName = $("#username_login").val();
    var cPass = $("#password_login").val();
    var valid = 1;
    if(uName.trim()==''||uName.trim()==null)
    {
      $("#login_name_error").html('<span>Please Enter User Name.</span>').show();
      valid = 0;
    }

    if(uName.trim()==''||uName.trim()==null)
    {
      $("#login_password_error").html('<span>Please Enter Password.</span>').show();
      valid = 0;
    }

    if(valid == 1)
    {
      $.ajax({
      type: 'POST',//method type
      cache: false,//do not allow requested page to be cache
      data: {function2call: 'loginCheck', uName : uName, cPass : cPass },
      url: "class/login_register.php",
      }).done(function(data){
      data = JSON.parse(data);
      if(data.chalkStreet.success==1)
      {
        var user_details = data.chalkStreet.user_details;
        if(user_details[0].admin_flag == 1)
        {
          window.location = "admin/home_page.php"; 
        }
        else
        {
          window.location = "user/user_main.php";
        }
      }
      else
      {
        $("#login_password_error").html('<span>Please enter valid credentails.</span>').show();
      }

      }).fail(function(){

      });  
    }
   }); 

  
  $("body").on('click','#register',function(){
    $('.val_error').text('').hide();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var ename = $("#username").val();
    var pwd = $("#pwd").val();
    var cnfpwd = $("#cnfpwd").val();
    var valid = 1;
    if(fname.trim()==''||fname.trim()==null)
    {
      $("#fname_error").html('<span>Please Enter First Name.</span>').show();
      valid = 0;
    }

    if(lname.trim()==''||lname.trim()==null)
    {
      $("#lname_error").html('<span>Please Enter Last Name.</span>').show();
      valid = 0;
    }

    if(ename.trim()==''||ename.trim()==null)
    {
      $("#email_error").html('<span>Please Enter User Email.</span>').show();
      valid = 0;
    }

    if(pwd.trim()==''||pwd.trim()==null)
    {
      $("#password_error").html('<span>Please Enter Password.</span>').show();
      valid = 0;
    }

    if(cnfpwd.trim()==''||cnfpwd.trim()==null)
    {
      $("#password_error").html('<span>Please Enter Confirm Password.</span>').show();
      valid = 0;
    }

    if(pwd.trim()!=cnfpwd.trim())
    {
      $("#password_error").html('<span>Password and Confirm Password should be same.</span>').show();
      valid = 0;
    }

    if(valid==1)
    {
      $.ajax({
          url: "class/login_register.php",
          type: 'POST',//method type
          dataType:'text',
          cache: false,//do not allow requested page to be cached
          data: {function2call: 'registerUser',fname:fname,lname:lname,ename:ename,pwd:pwd,cnfpwd:cnfpwd}
        }).done(function(data)
        {
         data = JSON.parse(data);
         var new_user = data.chalkStreet.success;

          if(new_user == 1)
          {
            $("#Cuname").text(ename);
            $("#Cpass").text(pwd);
            $("#newuser_pop").modal('show');   
          }
          else
          {
            $("#err_username").text(ename);
            $("#erro_pop").modal('show');
          }

          $("#login_again").on("click",function(e)
          {
            window.location = "register.php?action=logout";
          });
          $("#register_new").on("click",function(e)
          {
            window.location = "register.php?val=1";
          });  

          $("#welcome_ok").on("click", function(e){
            if(new_user==1)
            {
             window.location = "index.php";
            }
          });
         
        });
    }
  });

});
</script>
</body>
</html>
