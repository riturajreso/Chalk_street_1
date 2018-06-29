$(document).ready(function()
{
	$('#b_pubDate,#eb_pubDate').datepicker({
        format: "yyyy-mm-dd",
        todayHighlight: true,
        autoclose: true
    });
	var offset = 0;
	var busy = false;
	var count = 0;
	var loading_flag = 0;
	var article_info;
	var total_count_flag = 1;
	var current_effect = 'win8';

	$('#articleListTBody').html('');  
	$('#current_record_count ').text('0');      
	displayRecords(offset);

$('#backid').on("click", function(){      
 window.location.href = "home_page.php";
});

$(window).bind('scroll', function() {   
var v= $('#page-wrapper').offset().top + $('#page-wrapper').outerHeight() - window.innerHeight;
var intvalue = Math.floor( v );
if($(window).scrollTop() >= intvalue -10 && !busy && loading_flag==0) {
 busy = true;             
 offset = 20 + offset; 
 displayRecords(offset);
}
});

$("#show_inactive").change(function () {
  total_count_flag   = 1;
  $('#current_record_count ').text('0');
  offset = 0;        
  $('#articleListTBody').html('');
   displayRecords(offset); 
});

function createarticleValidation()
{
	var valid = 1;
	
	if(($('#title').val()=='') || ($('#title').val()==null))
	{
		valid = 0;
		$('#titleErr').text("Please enter article Title.").show();
	}
	if(($('#pun_name').val()=='') || ($('#pun_name').val()==null))
	{
		valid = 0;
		$('#pun_nameErr').text("Please enter article Publisher Name.").show();
	}

	if(($('#auth').val()=='') || ($('#auth').val()==null))
	{
		valid = 0;
		$('#authErr').text("Please enter article Author Name.").show();
	}
	
	if(($('.b_pubDate').val().trim()=='') || ($('.b_pubDate').val().trim()==null))
	{
		valid = 0;
		$('#pubDateErr1').text("Please enter Published Date.").show();
	}
	var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.gif)$");
	var fileUpload = $("[name=profilePic]")[0];
	if(fileUpload.files[0]=='' || fileUpload.files[0]==undefined)
	{
		valid = 0;
		$("#profilePicErr").text("Please select images for article Cover image.").show();
	}
	else
	{
		if (!regex.test(fileUpload.value.toLowerCase())) 
		{
			$("#profilePicErr").text("Please select a valid Image file.").show();
		}
	}

	return valid;
}

function editarticleValidation()
{
	var valid = 1;
	
	if(($('#e_title').val()=='') || ($('#e_title').val()==null))
	{
		valid = 0;
		$('#e_titleErr').text("Please enter article Title.").show();
	}
	if(($('#e_pubName').val()=='') || ($('#e_pubName').val()==null))
	{
		valid = 0;
		$('#e_pubNameErr').text("Please enter article Publisher.").show();
	}
	if(($('#e_authName').val()=='') || ($('#e_authName').val()==null))
	{
		valid = 0;
		$('#eb_authErr').text("Please enter article Author.").show();
	}
	if(($('.eb_pubDate').val().trim()=='') || ($('.eb_pubDate').val().trim()==null))
	{
		valid = 0;
		$('#epubDateErr1').text("Please enter Published Date.").show();
	}
   
	return valid;
}

function displayRecords(offset)
{
	var flag = ($("#show_inactive").prop("checked") == true) ? 0 : 1;
	$('#loadingDiv').remove(); 
	$('#loader_message').html(''); 
	$('#loader_message').html('<div id="loadingDiv"><center><img src="../images/loader.gif" height="30px" width="30px"><p>Loading Please wait.</p></center></div>');          

	$.ajax({
	type: 'POST',//method type
	cache: false,//do not allow requested page to be cache
	data: {ajaxcall : true,function2call: 'getarticleList', offset:offset,flag :flag , total_count_flag : total_count_flag},
	url: "../class/article_class.php",
	}).done(function(data){
	$('#loadingDiv').remove();      
	html = '';
	busy =false;
	loading_flag = 0;
	data = JSON.parse(data);
	if(data.chalkStreet.article_info!= null)
	{
		count = data.chalkStreet.article_info.length;
		if(total_count_flag == 1){
		$('#total_records_count').text(data.chalkStreet.articleCountList);
		}
		var current_count_text = $('#current_record_count ').text();
		var updated_current_count = parseInt(current_count_text) + count;
		$('#current_record_count').text(updated_current_count);
	 	if(data.chalkStreet.article_info.length > 0)
	 	{                            
	      No = 0;                     
	      for(var i=0; i < count ; i++)
	      {
	      	
	        html += '<tr>';
			html += '<td>';
			html += ++No+offset;
			html += '</td>';
	                          
			html += '<td>';
			html += data.chalkStreet.article_info[i].article_headline;
			html += '</td>';
	                      
			html += '<td>';
			html += data.chalkStreet.article_info[i].article_publisher;
			html += '</td>';

			html += '<td>';
			html += data.chalkStreet.article_info[i].article_author;
			html += '</td>';

			
			html += '<td>';
			html += data.chalkStreet.article_info[i].article_date;
			html += '</td>';

	        html += '<td class="action">';
	        
	        html += '<span data-toggle="tooltip" data-placement="top" title="Edit"><a href="#" class="editarticle icon-green" id="'+data.chalkStreet.article_info[i].article_id+'"><span aria-hidden="true" class="glyphicon glyphicon-pencil"></span></a></span>';               
	        html +='<span data-toggle="tooltip" data-placement="top" title="List Logs"><a href="#" class="link_show_log_article icon-yellow" id="'+data.chalkStreet.article_info[i].article_id+'"><span aria-hidden="true" class="fa fa-history"></span></a></span>';
	        
	        html += '</td>';
	        html += '</tr>';

	      }
	       	$('#articleListTBody').append(html);
	        $('[data-toggle="tooltip"]').tooltip();
	  	}
	  	else
	  	{
			loading_flag=1;

			$('#loadingDiv').remove();
			if( $('#articleListTBody').is(':empty') ) 
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
		if( $('#articleListTBody').is(':empty') ) 
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
		busy =false;
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

$('body').on("click",".link_show_log_article", function()
	{
		var article_id = $(this).attr('id');
		$.ajax({
		    url: "../class/article_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    data: {ajaxcall : true,function2call: 'getarticleLog',article_id:article_id}
		  }).done(function(data)
		  {
		  	data = JSON.parse(data);
		  	chalkStreet =  data.chalkStreet.article_info[0];
		  	$("#added_by").text(chalkStreet.userName);
		  	$("#added_tym").text(chalkStreet.added_tym);
			$('#logAgr').modal('show');
		  });
	});



$('body').on("click","#createarticle", function()
	{
		$('.error-display').hide();
		$('#create_article_pop').modal('show');
	});

$('body').on("click","#add_article", function()
{
	var article_title = $("#title").val();
	var article_pub = $("#pun_name").val();
	var article_auth = $("#auth").val();
	var article_pub_date = $(".b_pubDate").val();
	var fileUpload = $("[name=profilePic]")[0];
	var valid = createarticleValidation();

	if(valid == 1)
	{
		var dataimg = new FormData();
		dataimg.append('function2call', 'createArticle');
		dataimg.append('article_title', article_title);
		dataimg.append('article_auth', article_auth);
		dataimg.append('article_pub', article_pub);
		dataimg.append('article_pub_date', article_pub_date);
		dataimg.append('profilePic', fileUpload.files[0]);
		$.ajax({
		 	url: "../class/article_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    processData: false,
    		contentType: false,
		    data: dataimg,
		  }).done(function(data)
		  {
			data = JSON.parse(data);
			if(data.earticle.inserted == 1)
			{
				$('#create_article_pop').modal('hide');
				displayAlert("Alert Message", "User successfully created.");
				displayRecords(offset);
			}   
		  });
	}
});	  

$('body').on('click','.editarticle',function(){
	var article_id = $(this).attr('id');
	$.ajax({
	    url: "../class/article_class.php",
	    type: 'POST',//method type
	    dataType:'text',
	    cache: false,//do not allow requested page to be cached
	    data: {ajaxcall : true,function2call: 'getarticleDetails',article_id:article_id}
	  }).done(function(data)
	  {
		data = JSON.parse(data);
		article_info = data.chalkStreet.article_info[0];
		$("#e_title").val(article_info['article_headline']);
		$("#e_pubName").val(article_info['article_publisher']);
		$("#e_authName").val(article_info['article_author']);
		$(".eb_pubDate").val(article_info['article_date']);
		
	});
	$('.error-display').hide();
	$("#edit_article_pop").modal('show');
});

$('body').on('click','#edit_article',function(){
	var valid = editarticleValidation();
		
	if(valid==1)
	{
		var e_title = $("#e_title").val();
		var e_pubName = $("#e_pubName").val();
		var e_authName = $("#e_authName").val();
		var earticle_pub_date = $(".eb_pubDate").val();
		
		var dataimg = new FormData();
		dataimg.append('function2call', 'editarticle');
		dataimg.append('earticle_id', article_info['article_id']);
		dataimg.append('e_title', e_title);
		dataimg.append('e_pubName', e_pubName);
		dataimg.append('e_authName', e_authName);
		dataimg.append('earticle_pub_date', earticle_pub_date);
		$.ajax({
		    url: "../class/article_class.php",
		    type: 'POST',//method type
		    dataType:'text',
		    cache: false,//do not allow requested page to be cached
		    processData: false,
    		contentType: false,
		    data: dataimg,
		  }).done(function(data)
		  {
			data = JSON.parse(data);
			if(data.chalkStreet.updated == 1)
			{
				$('#edit_article_pop').modal('hide');
				displayAlert("Alert Message", "article update successfully.");
			}
		  });
	}
		else
		{
			displayAlert("Alert Message", "Nothing Changed.");
		}		
	
});

$('body').on('click','#confirm_ok',function(){
	offset = 0;
	$('#articleListTBody').html('');
	$('#current_record_count ').text('0');
	displayRecords(offset);
});


$('.profilePic').on('change', function(){
  var upload_pic_name =$('.profilePic').val().replace(/C:\\fakepath\\/i, ''); 
  if(upload_pic_name == '')
  {
     $("#profilePic_filename").text("No file selected.");
  }
  else
  {
    $("#profilePic_filename").text(upload_pic_name);
    $('.profilePic').attr('title' ,upload_pic_name);
  }
});

$('.resetprofilePic').on('click', function(e){
    e.preventDefault();
    $("#profilePic_filename").text("No file selected.");
    $('.profilePic').attr('title' ,'No file selected');
    $('#profilePicErr').hide();
    $('.profilePic').val('');
    $('input[type=file]').val('');
});


});
