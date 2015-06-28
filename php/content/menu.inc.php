        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse">
                    <a data-toggle="modal" class="navbar-brand" href="#profile"><?php echo $player['personaname']?></a>
                    <ul class="nav navbar-nav">
                        <li id="filters"><a href="#" id="reset_filter" data-filter="*">Default</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sort by<b class="caret"></b></a>
                            <ul class="dropdown-menu" id="sort-by">
                                <li><a href="#name">Game Name, A-Z</a></li>
                                <li><a href="#playedtime">Time Spent, Most - Least</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filter <b class="caret"></b></a>
                            <ul class="dropdown-menu" id="filters">
                                <li><a href="#" data-filter=".ptf00">Not yet played</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="#" data-filter=".w2p">Played in the last 2 weeks</a></li>
                                <li><a href="#" data-filter=".w2np">Not played in the last 2 weeks</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="#" data-filter=".ptf02">Played for 0 - 2 hours</a></li>
                                <li><a href="#" data-filter=".ptf25">Played for 2 - 5 hours</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" placeholder="Search" tabindex="1">
                            </div>
                        </form>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Theme <b class="caret"></b></a>
                          <ul class="dropdown-menu" id="themes">
                            <li><a href="#" data-theme="light">Light (Default)</a></li>
                            <li><a href="#" data-theme="dark">Dark</a></li>
                          </ul>
                        </li><!-- /.dropdown -->
                        <li><a href="hello.php" id="logout">Logout</a></li>

                </div><!--/.nav-collapse -->
            </div>
        </div>
