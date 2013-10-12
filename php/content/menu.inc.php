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
                    <ul class="nav navbar-nav">
                        <li id="filters"><a href="#" id="reset_filter" data-filter="*">Alles anzeigen</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Sortieren<b class="caret"></b></a>
                            <ul class="dropdown-menu" id="sort-by">
                                <li><a href="#name">Spielname</a></li>
                                <li><a href="#playedtime">Spielzeit</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Filtern <b class="caret"></b></a>
                            <ul class="dropdown-menu" id="filters">
                                <li><a href="#" data-filter=".ptf00">noch nicht gespielte Spiele anzeigen</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="#" data-filter=".w2p">in den letzten 2 Wochen gespielt</a></li>
                                <li><a href="#" data-filter=".w2np">in den letzten 2 Wochen nicht gespielt</a></li>
                                <li role="presentation" class="divider"></li>
                                <li><a href="#" data-filter=".ptf02">Spielzeit von 0 - 2 Stunden</a></li>
                                <li><a href="#" data-filter=".ptf25">Spielzeit von 2 - 5 Stunden</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <p class="navbar-text"><?php echo $player['personaname']?></p>
                        <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="search" placeholder="Suchen..." tabindex="1">
                            </div>
                        </form>
                    </ul>

                </div><!--/.nav-collapse -->
            </div>
        </div>