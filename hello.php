<?php
require_once './config.php';

if (!defined('API_KEY')) {
    die('No API_KEY set. Please set the API_KEY in config.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php echo APPNAME; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/custom_light.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hello">
        <div class="container ptop60">
            <div class="jumbotron">
                <h1><?php echo APPNAME; ?> <small>the better steam libary</small></h1>
                <p>Welcome to the modern Steam library interface. See all of your games and more.</p>
                <div class="row">
                    <div class="col-md-8">
                        <p style="font-size: 80%;">
                            To get started, just enter your Steam ID or custom URL below.<br> <strong>Please note, your profile must be set to "Public".</strong> <a href="https://support.steampowered.com/kb_article.php?ref=4113-YUDH-6401">Here's how to do that</a> (without flying kittens, even if they are cute.)
                        </p>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <p>
                    <form action="index.php" method="get" id="submitSteamID">
                        <input type="text" id="profile" class="form-control" placeholder="SteamID / Custom URL" required>
                        <input type="submit" class="btn btn-lg btn-primary" value="Start &raquo;">
                    </form>
                </p>
                <p>
                    <a data-toggle="modal" href="#instructions" class="btn btn-primary pull-right">
                        <span class="glyphicon glyphicon-info-sign"></span> Don't know how to find your Steam ID?
                    </a>
                </p>
            </div>
        </div>
        <div class="modal fade" id="instructions">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">How to find your Steam ID</h4>
              </div>
              <div class="modal-body">
                <ol>
                    <li>Login <a href="https://steamcommunity.com/login/home/" target="_blank">here</a>,</li>
                    <li>Click on your name in the top right, like so:</li><br>
                    <img src="http://i.imgur.com/pnb0vMD.png" alt="where to find your profile" title="where to find your profile"></img>
                    <li>In your browser bar you'll see <code>http://steamcommunity.com/id/&lt;xxx&gt;/</code></li>
                    <li><code>&lt;xxx&gt;</code> is your Steam ID!</li>
                </ol>
                <hr>
                Examples:
                <ul>
                    <li><code>http://steamcommunity.com/id/dylmye/</code></li>
                    <li><code>http://steamcommunity.com/id/7656119803934379/</code></li>
                    <li><code>http://steamcommunity.com/profiles/76561197999168004/</code></li>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Ok!</button>
              </div>
            </div>
          </div>
        </div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="//cdn.rawgit.com/js-cookie/js-cookie/master/src/js.cookie.js#2.0.2"></script>
        <script>
        /*
        Add SteamID to cookie called "gwsl_profile"
        */
        $(function() {
          $('#submitSteamID').on('submit', function(e) {
            var profileInput = $('#profile').val();
            Cookies.set("gwsl_profile", profileInput);
            console.log(Cookies.get());
          });
        });
        </script>
    </body>
</html>
