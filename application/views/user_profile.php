<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Linux Commands User Page</title>

    <!-- Bootstrap core CSS -->
    <link href="/linuxcommands/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/linuxcommands/public/css/sticky-footer.css" rel="stylesheet">
    <link href="/linuxcommands/public/css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="/linuxcommands/public/css/tagit.ui-zendesk.css" rel="stylesheet" type="text/css">
    <link href="/linuxcommands/public/css/dark.css" rel="stylesheet" type="text/css">
    <link href="/linuxcommands/public/css/star-rating.min.css" rel="stylesheet" type="text/css">
    <link href="/linuxcommands/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <input type="hidden" id="current_user" name="current_user_id" value=<?php echo $user_id; ?>>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Easy Linux Commands</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/linuxcommands/index.php/user/dashboard">Home</a></li>
          </ul>
           <ul class="nav navbar-nav">
            <li><a href="/linuxcommands/index.php/linux/newcommand">New Command</a></li>
          </ul>
           <ul class="nav navbar-nav">
            <li><a href="/linuxcommands/index.php/script/load_scripts">Scripts</a></li>
          </ul>
          <ul class="nav navbar-nav">
            <li class="active"><a href="/linuxcommands/index.php/social/load_shares/<?php echo $user_id; ?>">Socialize</a></li>
          </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal: <?php echo $username; ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="/linuxcommands/index.php/profile/load_profile">Profile</a></li>
            <li class="divider"></li>
            <li><a href="/linuxcommands/index.php/user/logout">Logout</a></li>
          </ul>
        </li>
      </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="well well-sm">
                    <div class="media">
                        <a class="thumbnail pull-left" href="#">
                            <img class="media-object" src="/linuxcommands/index.php/profile/show_picture/<?php echo $user_id; ?>" width="100" height="100">
                        </a>
                        <div class="media-body">
                            <h2 class="media-heading"><?php echo $uName; ?> <?php echo $sName; ?></h2>
                            <h4 class="media-heading">Username: <?php echo $username; ?></h4>
                            <h4 class="media-heading">Password: <?php echo $password; ?></h4>
                        </div>
                        </br>
                        <div>
                            <a href="#" class="btn btn-primary btn-small uploadFileBtn" role="button" data-toggle="modal" data-target="#uploadPicModal">Upload Picture</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="uploadPicModal" tabindex="-1" role="dialog" aria-labelledby="uploadPicModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="uploadPicModalLabel">Upload Picture</h4>
          </div>
          <div class="modal-body">
            <form method="POST" action="/linuxcommands/index.php/profile/upload_picture" class="form-horizontal uploadPicForm" role="form" enctype="multipart/form-data">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">File:</label>
                <div class="col-sm-10">
                  <input type="file" name="userfile" class="form-control" id="inputEmail3" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-info">Upload</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="text-muted">Linux Commands Project 2014. Bilkent CTIS</p>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/linuxcommands/public/js/json2.js"></script>
    <script src="/linuxcommands/public/js/jquery.min.js"></script>
    <script src="/linuxcommands/public/js/jquery-ui.min.js"></script>
    <script src="/linuxcommands/public/js/jquery.block.ui.js"></script>
    <script src="/linuxcommands/public/js/jquery.form.min.js"></script>
    <script src="/linuxcommands/public/js/bootstrap.min.js"></script>
    <script src="/linuxcommands/public/js/highlight.pack.js"></script>
    <script src="/linuxcommands/public/js/tag-it.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/select2.min.js"></script>
    <script src="/linuxcommands/public/js/bootstrap-typehead.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/linux.js"></script>
    <script src="/linuxcommands/public/js/star-rating.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/star.js"></script>
  </body>
</html>

