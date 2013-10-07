<?php
require_once './config.php';

if (!defined('API_KEY')) {
    die('No API_KEY set. Please set the API_KEY in config.php');
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?= APPNAME ?></title>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link rel="stylesheet" href="css/custom.css">
        

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="../../assets/js/html5shiv.js"></script>
          <script src="../../assets/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="hello">
        <div class="container ptop60">
            <div class="jumbotron">
                <h1><?= APPNAME ?> <small>the better steam libary</small></h1>
                <p>Willkommen bei der neuen, modernen Steam Bibliothek - direkt in deinem Browser.</p>
                <div class="row">
                    <div class="col-md-8">                        
                        <p style="font-size: 80%;">
                            Um gleich loszulegen kannst du einfach im Feld unten deine Steam ID oder deine Steam Custom URL angeben und schon geht es los. Beachte aber, dass dein Profil in den Privatsphäre-Einstellungen auf "Öffentlich" gestellt werden muss. Du willst dein Profil nicht öffentlich machen? Dann klick bitte <a href="http://bit.ly/17OzYnZ">hier</a>.
                        </p>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
                <p>
                    <form action="index.php" method="get">
                        <input type="text" name="profile" id="profile" class="form-control" placeholder="SteamID / CustomURL" >
                        <input type="submit" class="btn btn-lg btn-primary" value="Start &raquo;">
                    </form>
                </p>
                <p>
                    <a data-toggle="modal" href="#wfisid" class="btn btn-primary pull-right">
                        <span class="glyphicon glyphicon-info-sign"></span> Wie finde ich meine Steam ID?
                    </a>
                </p>
            </div>
        </div>
        <div class="modal fade" id="wfisid">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Wie finde ich meine Steam ID?</h4>
              </div>
              <div class="modal-body">
                <ol>
                    <li>Melde dich <a href="https://steamcommunity.com/login/home/" target="_blank">hier</a> mit deinen Steam Benutzerdaten an</li>
                    <li>Gehe auf &lt;Spielername&gt; &rarr; Profil</li>
                    <li>In deinem Browser siehst du nun in der URL-Leiste <code>http://steamcommunity.com/id/&lt;xxx&gt;/</code></li>
                    <li><code>&lt;xxx&gt;</code> ist deine Steam ID</li>
                </ol>
                <hr>
                Ein paar Beispiele:
                <ul>
                    <li><code>http://steamcommunity.com/id/xunocore/</code></li>
                    <li><code>http://steamcommunity.com/id/7656119803934379/</code></li>
                    <li><code>http://steamcommunity.com/profiles/76561197999168004/</code></li>
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default btn-primary" data-dismiss="modal">Schließen</button>
              </div>
            </div>
          </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>