<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">                
                <li class="salutation"><?php echo $page_name; ?></li>
            </ul>
            <ul class="nav navbar-nav log-name-block">       
                <li>
                    <?php
                    if (isset($_SESSION['user']->username)) {
                        ?>
                    <span id="log-name"><? echo $_SESSION["user"]->firstName . ' ' . $_SESSION["user"]->lastName; ?></span>
                        <button type="button" class="btn btn-danger" id="logout-btn" onclick="window.location.href = '<? echo SCRIPTS_DIR . "logout.php"; ?>'">logout</button>
                        <?php
                    }
                    ?>
                <li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</div><!-- /.navbar -->