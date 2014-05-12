
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Linux Commands - User Login</title>

    <!-- Bootstrap core CSS -->
    <link href="/linuxcommands/public/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/linuxcommands/public/css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">

      <form class="form-signin" role="form" method="POST" action="/linuxcommands/index.php/user/login">
        <?php if(isset($error)): ?>
          <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <h2 class="form-signin-heading">Please sign in</h2>
        <input name="username" type="text" class="form-control" placeholder="Username" required autofocus>
        <input name="password" type="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-m btn-primary btn-block" type="submit">Sign in</button> <a href="#" class="btn btn-m btn-success btn-block" role="button" id="new_user">Sign up</a>
      </form>

    </div> <!-- /container -->

    <div class="modal fade" id="signUpModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Sign up for a new user</h4>
          </div>
          <div class="modal-body">
            <form method="post" class="form-horizontal" role="form" action="/linuxcommands/index.php/user/create_user">
              <div class="form-group">
                <label for="newName" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="newName" id="newName" placeholder="Enter your name">
                </div>
              </div>
              <div class="form-group">
                <label for="newSurname" class="col-sm-2 control-label">Surname</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="newSurname" id="newSurname" placeholder="Enter your surname">
                </div>
              </div>
              <div class="form-group">
                <label for="newUsername" class="col-sm-2 control-label">Username</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="newUsername" id="newUsername" placeholder="Enter your username">
                </div>
              </div>
              <div class="form-group">
                <label for="newPassword" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="newPassword" id="newPassword" placeholder="Enter your password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-2 pull-right">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <div class="col-sm-2 pull-right">
                  <button type="submit" class="btn btn-default">Sign up</button>
                </div>
              </div>
            </form>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
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
    <script src="/linuxcommands/public/js/linux.js"></script>
  </body>
</html>
