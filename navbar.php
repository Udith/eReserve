<div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"></a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">                
                <li class="salutation"><?php echo $page_name; ?></li>
            </ul>
            <ul class="nav navbar-nav log-name-block">       
                <li>
                    <?php 
                        if(isset($_SESSION['username'])){
                            echo '<span id="log-name">'.$_SESSION["first"].' '.$_SESSION["last"].'</span>';
                            echo '<button type="button" class="btn btn-danger" id="logout-btn">logout</button>';
                        }
                    ?>
                <li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</div><!-- /.navbar -->