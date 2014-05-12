
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

    <!-- Begin page content -->
    <div class="container">
      <div class="btn-group">
        <select class="form-control" id="users_combo">
          <option value="" disabled="disabled" selected="selected">Select a user to follow</option>
          <?php foreach($users as $usr): ?>
            <?php if($user_id!=($usr->id)): ?>
              <option value= <?php echo $usr->id; ?>><?php echo $usr->username; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
      <button id="follow_user" type="button" class="btn btn-default">
        <span class="glyphicon glyphicon-star"></span>Follow User
      </button>
      <div>
        <br/>
      </div>
      <?php $count=0; ?>
      <?php if(isset($sharer_scripts)): ?>
        <?php foreach($sharer_scripts as $shr_scr): ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col-md-1">              <a class="thumbnail pull-left" href="#">
                  <img class="media-object" src="/linuxcommands/index.php/profile/show_picture/<?php echo $shr_scr->created_user_id; ?>" width="50" height="50">
              </a></div>
                <div class="col-md-8"><h3 class="panel-title"><?php echo $script_users[$count]?> created a script</h3></div>
              </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-2"><?php echo $shr_scr->name?><b>  (<?php echo $shared_script_commands[$count]?>)</b>
                </div>
                <div class="col-md-9"><ul class="linuxCommTags" id="linuxCommTags<?php echo $count?>">
                      <?php foreach($shared_script_commands_exploded[$count] as $shr_scr_comm): ?>
                        <li><?php echo $shr_scr_comm?></li>
                      <?php endforeach; ?>
                    </ul>
                </div>
                <!--taglerin gosterildigi component, her bir scriptin icinde yer alacak, hangi scriptin icinde yer aldigini linux.js'te anlayabilmek
                icin data-id olarak unique idler tutuyoruz linuxCommTags0, linuxCommTags1 gibi -->
                <div class="col-md-1"><a class="run_modified_script" type="button" class="btn btn-default" data-id="linuxCommTags<?php echo $count?>">
                    <span class="glyphicon glyphicon-tasks"></span></a></div>
              </div>
              <div class="row">
                <div class="col-md-9"><input type="text" class="ratingStar" value="<?php echo $followed_script_ratings[$count]?>" data-id="<?php echo $shr_scr->id?>"/></div>
                <div class="col-md-2">              <a data-id="<?php echo $shr_scr->id ?>" id="add_script" type="button" class="btn btn-default btn pull-right add_script">
                Add to my scripts
              </a></div>
              </div>
              <?php $count=$count + 1; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div id="footer">
      <div class="container">
        <p class="text-muted">Linux Commands Project 2014. Bilkent CTIS</p>
      </div>
    </div>

        <!-- Modal -->
    <div class="modal fade" id="runCommandModal" tabindex="-1" role="dialog" aria-labelledby="runCommandModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="runCommandModalLabel">Executed Command Result</h4>
          </div>
          <div class="modal-body">
            <pre><code id="terminal">linux$ </code></pre>
          </div>
        </div>
      </div>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/linuxcommands/public/js/json2.js"></script>
    <script src="/linuxcommands/public/js/jquery.min.js"></script>
    <script src="/linuxcommands/public/js/jquery-ui.min.js"></script>
    <script src="/linuxcommands/public/js/jquery.form.min.js"></script>
    <script src="/linuxcommands/public/js/bootstrap.min.js"></script>
    <script src="/linuxcommands/public/js/highlight.pack.js"></script>
    <script src="/linuxcommands/public/js/jquery.block.ui.js"></script>
    <script src="/linuxcommands/public/js/tag-it.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/select2.min.js"></script>
    <script src="/linuxcommands/public/js/bootstrap-typehead.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/linux.js"></script>
    <script src="/linuxcommands/public/js/star-rating.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/star.js"></script>
  </body>
</html>
