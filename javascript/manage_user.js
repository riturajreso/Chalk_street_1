$(document).ready(function()
{
	var offset = 0;
	var busy = false;
	var count = 0;
	var temp = 0;
	var total_count_flag = 1;
	$('#userListTBody').html('');  
	$('#current_record_count ').text('0');      
	displayRecords(offset);

$('#backid').on("click", function(){      
 window.location.href = "home_page.php";
}); 

$(window).bind('scroll', function() {   
var v= $('#page-wrapper').offset().top + $('#page-wrapper').outerHeight() - window.innerHeight;
var intvalue = Math.floor( v );
if($(window).scrollTop() >= intvalue -10 && temp == 0 && !busy) {
 temp = 1;
 busy = true;             
 offset = 20 + offset; 
 displayRecords(offset);
}
});

$("#show_inactive").change(function () {
  total_count_flag   = 1;
  $('#current_record_count ').text('0');
  offset = 0;        
  $('#userListTBody').html('');
   displayRecords(offset); 
});

function displayRecords(offset)
{
	var flag = ($("#show_inactive").prop("checked") == true) ? 0 : 1;
	$('#loadingDiv').remove(); 
	$('#loader_message').html(''); 
	$('#loader_message').html('<div id="loadingDiv"><center><img src="../images/loader.gif" height="30px" width="30px"><p>Loading Please wait.</p></center></div>');          

	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'getUserList', offset:offset,flag :flag , total_count_flag : total_count_flag},
	url: "../class/user_class.php",
	}).done(function(data){
	$('#loadingDiv').remove();      
	html = '';
	busy = false;
	data = JSON.parse(data);
	if(data.chalkStreet.user_info!=null)
	{
		count = data.chalkStreet.user_info.length;
		if(total_count_flag == 1){
			$('#total_records_count').text(data.chalkStreet.usersCountList);
		}
		var current_count_text = $('#current_record_count ').text();
		var updated_current_count = parseInt(current_count_text) + count;
		$('#current_record_count').text(updated_current_count);
		if(data.chalkStreet.user_info.length > 0)
		{                            
			No = 0;                     
			for(var i=0; i < count ; i++)
			{
			var admin_flag = data.chalkStreet.user_info[i].admin_flag
			if(data.chalkStreet.user_info[i].user_isactive == '1')
			{
			if($('#show_inactive').is(':disabled'))
			{
				$("#show_inactive").prop('disabled',false);
			}
			}	
			color = '';
			title = 'Deactivate';                     
			if(data.chalkStreet.user_info[i].user_isactive == '0')
			{
			color = "red";
			title = 'Activate';
			if($('#show_inactive').is(':disabled'))
				{
			    $("#show_inactive").prop('disabled',false);
				}
			}

			html += '<tr>';
			html += '<td>';
			html += ++No+offset;
			html += '</td>';
			              
			html += '<td>';
			html += data.chalkStreet.user_info[i].user_fname;
			html += '</td>';
			          
			html += '<td>';
			html += data.chalkStreet.user_info[i].user_lname;
			html += '</td>';

			html += '<td class="userName">';
			html += data.chalkStreet.user_info[i].user_email;
			html += '</td>';

			html += '</tr>';

			}
			$('#userListTBody').append(html);
			$('[data-toggle="tooltip"]').tooltip();
			}
		else
		{
			loading_flag=1;
			$('#loadingDiv').remove();
			if( $('#userListTBody').is(':empty') ) 
			{
				$("#contents").hide();
				$('#loader_message').html('<p style="margin-left:20px;color:red ;text-align: center;">No records found.</p>');
			if($('#show_inactive').is(':disabled'))
			{
				$("#show_inactive").prop('disabled',false);
			}
			}
			else
			{
				$('#loader_message').html('<p style="margin-left:20px;color:red ; text-align: center;">No more records.</p>');
			}
		}
	}
	else
	{
		$('#total_records_count').text(0);
		if( $('#userListTBody').is(':empty') ) 
		{
			$("#contents").hide();
			$('#loader_message').html('<p style="margin-left:20px;color:red ;text-align: center;">No records found.</p>');
		if($('#show_inactive').is(':disabled'))
		{
			$("#show_inactive").prop('disabled',false);
		}
		}
		else
		{
			$('#loader_message').html('<p style="margin-left:20px;color:red ; text-align: center;">No more records.</p>');
		}
	} 
	      
	}).fail(function(){

	});
}


function displayAlert(alert_title, alert_body){
  /*
    function to display alert message
  */
  $('#alertTitle').html(alert_title);
  $('#alertBody').html(alert_body);
  $('#alertModal').modal('show');

}

/* Function For User First Name Validation */
function userFirstNameValidation(input_field,err_field,mandatory){  
  var valid = 1;

  var myRegEx = /[|\\<>/]/gi;
  var isValid = !(myRegEx.test($(input_field).val()));
  var first_name = $(input_field).val();
  
  if(first_name == '' && mandatory ==1){
    valid = 0;
    $(err_field).text("Please enter the first name.").show();
  }else if((first_name != '') && (isValid == false)){
    valid = 0;
    $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;)").show();
  }

 return valid; 

}

/* Function For User Last Name Validation */
function userLastNameValidation(input_field,err_field,mandatory){  
  var valid = 1;

  var myRegEx = /[|\\<>/]/gi;
  var isValid = !(myRegEx.test($(input_field).val()));
  var last_name = $(input_field).val();
  
  if(last_name == '' && mandatory ==1){
    valid = 0;
    $(err_field).html("Please enter the last name.").show();
  }else if((last_name != '') && (isValid == false)){
    valid = 0;
    $(err_field).html("Please do not use special characters (< , > , | , &#47; and &#92;)").show();
  }

 return valid; 

}

/* Function For User Email Validation */
function userEmailValidation(input_field,err_field,mandatory){  
  var valid = 1;

  var myRegEx = /^([a-zA-Z0-9\.\-\_\'])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;  
  var isValid = !(myRegEx.test($(input_field).val()));
  email_id = $(input_field).val(); 
  if(email_id != undefined){

    if(email_id == '' && mandatory ==1){
      valid = 0;
      $(err_field).html("Please enter the email address.").show();
    }else if((email_id != '') && (isValid == true)){
      
      valid = 0;
      $(err_field).html("Please enter the valid email address.").show();
    }
  
  }

  return valid; 

}

/* Function for Password validation */
function passwordValidation(input_field,err_field,mandatory){

  var val = 1;
  var yourInput = $(input_field).val(); 
  if( yourInput == '' && mandatory == 1){
    val = 0;
    $(err_field).html(Lang['pwd_emp_field']).show();
  }else{
    
    var re = /[|\\<>/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      val = 0;
      $(err_field).html(Lang['pwd_chk_field']).show();
    }

  }
  return val;
}

function createUserValidation()
{
	var valid = 1;
    $('.error-display').text('').hide();
    if(userFirstNameValidation('#upFirstName','.eFirstNameErr',1) == 0){
      valid = 0;
    }

    if(userLastNameValidation('#upLastName','.eLastNameErr',1) == 0){
      valid = 0;
    }

    if(userEmailValidation('#emailId','.emailErr',1) == 0){
      valid = 0;
    }

    if(userEmailValidation('#emailId','.emailErr',1) == 0){
      valid = 0;
    }

    if(passwordValidation('#pwd','#pwdErr',1) == 0){
      valid = 0;
    }

    return valid;
}

$('body').on("click","#createUser",function(e){
	$("#create_user_pop").modal('show');
});

$('body').on("click","#create_User",function(e){
	var valid = createUserValidation();
	if(valid==1)
	{
		$.ajax({
		type: 'POST',//method type
		cache: false,//do not allow requested page to be cache
		data: {
			ajaxcall : true,
			function2call: 'createUser',
			fname:$("#upFirstName").val().trim(),
            lname:$("#upLastName").val().trim(),
            emailId:$("#emailId").val().trim(),
            pwd:$("#pwd").val().trim(),
            admin_flag:($("#internalUserFlag").is(":checked") == false) ? 0 : 1
        },
		url: "../class/user_class.php",
		}).done(function(data){
		data = JSON.parse(data);
		if(data.valid== 0)
		{
			displayAlert("Alert Message", "User already exists.");
		}
		else
		{
			displayAlert("Alert Message", "User successfully created.");
			$("#create_user_pop").modal('hide');	
		}
		}).fail(function(){

		});
	}
});

$('body').on('click','#confirm_ok',function(){
	offset = 0;
	$('#userListTBody').html('');
	$('#current_record_count ').text('0');
	displayRecords(offset);
});

});

