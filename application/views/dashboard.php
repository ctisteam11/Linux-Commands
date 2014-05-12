
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
    <link href="/linuxcommands/public/css/select2.css" rel="stylesheet" type="text/css">
    <link href="/linuxcommands/public/css/tag.it.custom.css" rel="stylesheet" type="text/css">

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
            <li class="active"><a href="/linuxcommands/index.php/user/dashboard">Home</a></li>
          </ul>
           <ul class="nav navbar-nav">
            <li><a href="/linuxcommands/index.php/linux/newcommand">New Command</a></li>
          </ul>
           <ul class="nav navbar-nav">
            <li><a href="/linuxcommands/index.php/script/load_scripts">Scripts</a></li>
          </ul>
          <ul class="nav navbar-nav">
            <li><a href="/linuxcommands/index.php/social/load_shares/<?php echo $user_id; ?>">Socialize</a></li>
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

    <!-- Begin page content -->
    <div class="container">
      </br>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">          
          <div class="panel panel-primary">
            <div class="panel-heading">Follower Scripts</div>
            <div class="panel-body">
              <?php $count=0; ?>
              <?php if(isset($sharer_scripts)): ?>
                <?php foreach($sharer_scripts as $shr_scr): ?>
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <h3 class="panel-title"><?php echo $script_users[$count]?> created a script</h3>
                    </div>
                    <div class="panel-body">
                      <span>
                        <?php echo $shr_scr->name?><b>  (<?php echo $shared_script_commands[$count]?>)</b>
                      </span>
                      </a>
                      <?php $count=$count + 1; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>                
        <div class="col-md-5">
          <div class="panel panel-success">
            <div class="panel-heading">Top Scripts</div>
            <div class="panel-body">
              <?php $count=0; ?>
              <?php if(isset($popularScripts)): ?>
                <?php foreach($popularScripts as $script): ?>
                  <div class="panel panel-success">
                    <div class="panel-heading">
                      <h3 class="panel-title"><?php echo $script['user_name']?> created a script with <?php echo $script['rating'] ?> Points</h3>
                    </div>
                    <div class="panel-body">
                      <span>
                        <?php echo $script['script_name'] ?><b>  (<?php echo $script['command'] ?>)</b>
                      </span>
                      </a>
                      <?php $count=$count + 1; ?>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <div class="col-md-1"></div>
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
    <script src="/linuxcommands/public/js/jquery.form.min.js"></script>
    <script src="/linuxcommands/public/js/jquery.noty.packaged.min.js"></script>
    <script src="/linuxcommands/public/js/jquery.block.ui.js"></script>
    <script src="/linuxcommands/public/js/bootstrap.min.js"></script>
    <script src="/linuxcommands/public/js/highlight.pack.js"></script>
    <script src="/linuxcommands/public/js/file.upload.js"></script>
    <script src="/linuxcommands/public/js/tag-it.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/bootstrap-typehead.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/select2.min.js"></script>
  </body>
</html>
