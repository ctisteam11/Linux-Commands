
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
            <li class="active"><a href="#">Home</a></li>
          </ul>
        <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Personal: <?php echo $username; ?> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Profile</a></li>
            <li><a href="#">Custom Commands</a></li>
            <li><a href="#">Custom Scripts</a></li>
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
      <input name="command_txt" type="text" class="form-control" placeholder="Type a Command" data-provide="typeahead"> <br/>
      <ul id="linuxCommandsTags"></ul>
      <pre><code id="terminal">linux$ </code></pre>
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
    <script src="/linuxcommands/public/js/bootstrap.min.js"></script>
    <script src="/linuxcommands/public/js/highlight.pack.js"></script>
    <script src="/linuxcommands/public/js/tag-it.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/bootstrap-typehead.min.js" type="text/javascript"></script>
    <script src="/linuxcommands/public/js/linux.js"></script>
  </body>
</html>
