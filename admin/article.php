<!DOCTYPE html>
<html>
<head>
  <title>ChalkStreet - Article</title>
  <link rel="icon" type="images/png" href="images/article.png">
  <meta charset="utf-8">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width,height=device-height">
 
  <link href="https://fonts.googleapis.com/css?family=Varela+Round&amp;subset=hebrew,latin-ext,vietnamese" rel="stylesheet">

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap-select.min.css">
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/register.css">
  <link rel="stylesheet" type="text/css" href="../stylesheets/main.css">
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
  <div id="page-wrapper" class="full-width">
    <div class="right-panel">         
      <div class="title">
        Manage Article List
        <div class="pull-right">   
              <a href="#" id="backid" class="form-group btn btn-sm btn-default-back" title ="" data-placement="top" data-toggle="tooltip" data-original-title="">
              <span class="glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Back </a>
        </div>
      </div>
      
      <form class="form-horizontal input">
        <div class="content-main">        
          <div class="col-sm-12 col-md-12 col-lg-12">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <div class="checkbox" style="margin-left:10px">
                    <!-- <label><input type ="checkbox" name="show_inactive" id="show_inactive" class="styled"> Show inactive records</label> -->
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="pull-right"> 
                  <span class="total-records">Showing Records <span id="current_record_count">0</span> of <span id="total_records_count">0</span></span>
                 <a id="createarticle" class="btn btn-orange mar-bot-10" title ="" data-placement="left" data-toggle="tooltip" data-original-title = ""><span class="glyphicon glyphicon-plus-sign " aria-hidden="true"></span> Add article</a></div>
              </div>
            </div>
            <div class="table-responsive search-customer">
              <table class="table table-hover table-bordered">                 
                <thead>
                  <tr>
                    <th class="remove_sort" width="5%">No. </th>
                    <th id="b_sort_title" class="sort_article" width="10%">Article Title</th>
                    <th id="b_sort_pubname" class="sort_article" width="10%">Publisher Name</th>
                    <th id="b_sort_quant" class="sort_article" width="10%">Author</th>
                    <th id="b_sort_pubdate" class="sort_article" width="10%">Published Date</th>
                    <th class="remove_sort" width="9%">Action</th>
                  </tr>
                </thead>
                <tbody id="articleListTBody"></tbody>
              </table>
            </div>
          </div>
           <div id="loader_message"></div>
          </div>
        </div>
      </form>
    </div>
<a href="#" class="scrollToTop">Scroll To Top</a> 

<div class="modal fade" id="create_article_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" style="z-index: 1050;">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelc">Add Article</h4>
      </div>
       <form class="form-horizontal input" action="#" name="createarticleForm" id="createarticleForm" method="POST" enctype="multipart/form-data">
      <div class="modal-body overflow-nohidden">
        <div class="content-main overflow-nohidden">  
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Article Title <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="title" id="title">
                <p style="color:red" class="titleErr error-display" id="titleErr"></p>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Publisher Name<span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="pun_name" id="pun_name" >
               <p style="color:red" class="pun_nameErr error-display" id="pun_nameErr"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
               <label>Author Name <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="auth" id="auth" >
                <p style="color:red" class="authErr error-display" id="authErr"></p>
              </div>
               <div class="col-sm-6 col-md-6 col-lg-6">
              <label>Publication Date <span class="red">*</span></label>
               <div id="b_pubDate" class="input-append date date_timepicker fromDate1">
                  <input type="text" placeholder="YYYY-MM-DD" data-format="YYYY-MM-DD" class="date_inp b_pubDate form-control" name="fromDate1" id="fromDate1">
                  <span class="add-on calendar-icon tog_class">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </i>
                  </span>  
                  <p style="color:red" class="pubDateErr1 error-display" id="pubDateErr1"></p>
                </div>  
              </div>           
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-5 col-lg-12">
                <label>Upload Photo</label>
                <div class="clearfix"></div>
                <div id="uplaoadUserFile"> 
                <div class="btn btn-default btn-file "> Choose a file
                  <input type="file" id="profilePic" name="profilePic" class="profilePic"  value="">
                </div>
                  <span id ="profilePic_filename" class ="profilePic_filename"> No file selected. </span>
                   <div style="margin-top: 4px;">
                       <button id="resetprofilePic" class ="btn btn-default resetprofilePic">Reset File
                      </button> 
                    </div>
                  <p style="color:red" class="profilePicErr error-display" id="profilePicErr"></p>
                <div> 
                  <span style="color:#23527C"><i>(Image dimension:300px*300px. Allowed image format: jpg, jpeg, png and gif)</i></span>
                </div>
              </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <div class="pull-right">
          <button class="btn btn-sm green-btn" id="add_article"  type="button" data-toggle="tooltip" data-original-title="">Create</button>
          <button class="btn btn-grey btn-sm page-scroll-set"  data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" id="cancel" data-original-title="">Cancel</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
</div>

<div class="modal fade" id="edit_article_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabelc">Edit Article</h4>
      </div>
       <form class="form-horizontal input" action="#" name="updateUserForm" id="updateUserForm" method="POST" enctype="multipart/form-data">
      <div class="modal-body overflow-nohidden">
        <div class="content-main overflow-nohidden">  
        <div class="form-group">
          <div class="row">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Article Title <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="e_title" id="e_title">
                <p style="color:red" class="e_titleErr error-display" id="e_titleErr"></p>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Publisher Name <span class="red">*</span></label>
                <input type="text" class="form-control" placeholder="" name="e_pubName" id="e_pubName">
                <p style="color:red" class="e_pubNameErr error-display" id="e_pubNameErr"></p>
              </div>
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="row class">
            <div class="col-sm-12">
              <div class="col-sm-6 col-md-6 col-lg-6">
                <label>Author Name <span class="red">*</span></label>
                  <input type="text" class="form-control" placeholder="" name="e_authName" id="e_authName">
                   <p style="color:red" class="eb_authErr error-display" id="eb_authErr"></p>
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6">
              <label>Publication Date <span class="red">*</span></label>
               <div id="eb_pubDate" class="input-append date date_timepicker fromDate1">
                  <input type="text" placeholder="YYYY-MM-DD" data-format="YYYY-MM-DD" class="date_inp eb_pubDate form-control" name="fromDate" id="fromDate">
                  <span class="add-on calendar-icon tog_class">
                    <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                      <i class="fa fa-calendar" aria-hidden="true"></i>
                    </i>
                  </span>  
                  <p style="color:red" class="epubDateErr1 error-display" id="epubDateErr1"></p>
                </div>  
              </div>
            </div>
          </div>
        </div>       
      </div>
      <div class="modal-footer">
        <div class="pull-right">
          <button class="btn btn-sm green-btn" id="edit_article"  type="button" data-toggle="tooltip" data-original-title="">Save</button>
          <button class="btn btn-grey btn-sm page-scroll-set"  data-dismiss="modal" aria-label="Close" type="button" data-toggle="tooltip" id="cancel" data-original-title="">Cancel</button>
        </div>
      </div>
    </form>
    </div>
  </div>
</div>
</div>


<!-- log modal -->
<div class="modal fade info-modal" id="logAgr" tabindex="-1" role="dialog" aria-labelledby="myModalLabela" data-backdrop="static">
<div class="modal-dialog modal-sm" role="document" style="width: 30%;">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close page-scroll-set" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel">Article Details</h4>
    </div>
    <div class="modal-body select-agre" style=" max-height: 478px;overflow-y: auto;"> 
    <div class="form-group mar-b-0">
        <div id="sandbox-container">
          Added by - <span id='added_by'></span> 
          at <span id='added_tym'></span> 
        </div>
      </div>
    </div>
    <div class="modal-footer text-center">
      <button type="button" data-dismiss="modal" id="logClose" aria-label="Close" class="btn btn-sm btn-grey page-scroll-set" data-toggle="tooltip" data-original-title="">Close</button>
    </div>
  </div>
</div>
</div>

<script type='text/javascript' src="../js/jquery-3.3.1.min.js"></script>
<script type='text/javascript' src="../js/bootstrap.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-select.min.js"></script>
<script type='text/javascript' src="../js/bootstrap-datepicker.js"></script>
<script type='text/javascript' src="../javascript/manage_article.js"></script> 

