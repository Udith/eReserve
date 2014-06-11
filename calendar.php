<!DOCTYPE html>
<?php
include_once './global.inc.php';

session_start();
$req_level = 0;

include SCRIPTS_DIR . 'access_ctrl.php';

$page_title = "calendar";
$page_name = "Reservation Calendar";
?>


<html>
    <head>
        <?php include ROOT_DIR . 'header.inc.php'; ?>	
    </head>

    <body>	
        <?php include ROOT_DIR . 'navbar.php'; ?>

        <div class="container">

            <div class="row row-offcanvas row-offcanvas-right">

                <div class="col-xs-12 col-sm-9">
                    <p class="pull-right visible-xs">
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
                    </p>

                    <div>
                        <table id="calendar-table" class="table table-hover cell-border" cellspacing="0" width="100%">
                            <thead>
                                <tr class="col-header">
                                    <th>Hall ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Faculty</th>
                                    <th>Capacity</th>
                                    <th>A/C</th>
                                    <th>Computer Lab</th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr class="col-header">
                                    <th></th>
                                    <th></th>
                                    <th class="selFilter"></th>
                                    <th class="selFilter"></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="modal fade" id="calendar-modal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">Reservation Details</h4>
                                </div>
                                <div class="modal-body">
                                    <h4>
                                        <span id="hall-name"></span>&nbsp;
                                        (<span id="hall-id"></span>)
                                    </h4>
                                    <hr/>
                                    <h5>Date</h5>
                                    <div class='col-lg-5 input-group date' id='calendar-datepicker' data-date-format="YYYY-MM-DD">                                        
                                        <input type='button' class="form-control"/>
                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                    <br>
                                    <div>
                                        <table id="reserve-table" class="table table-bordered table-condensed" cellspacing="0" width="100%"></table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <?php if (isset($_SESSION['user']->username)) { ?>
                                        <button type="button" class="btn btn-success" id="request-res-btn">Request Reservation</button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-success disabled">Request Reservation</button>
                                    <?php } ?>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!--/span-->

                <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
                    <?php if (isset($user_level)) { ?>
                        <div class="list-group">
                            <a href="home.php" class="list-group-item"> 
                                <span class="glyphicon glyphicon-home"></span>&nbsp;Home
                            </a>
                            <a href="calendar.php" class="list-group-item active">
                                <span class="glyphicon glyphicon-calendar"></span>&nbsp;Reservation Calendar
                            </a>
                            <a href="request.php" class="list-group-item">
                                <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Request Reservations
                            </a>
                            <a href="cancel.php" class="list-group-item">
                                <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel Reservations
                            </a>
                            <a href="my_history.php" class="list-group-item">
                                <span class="glyphicon glyphicon-time"></span>&nbsp;Reservation History
                            </a>
                        </div>
                        <div class="list-group">

                            <?php if ($user_level >= 2) { ?>
                                <a href="#" class="list-group-item">
                                    <span class="glyphicon glyphicon-list-alt"></span>&nbsp;Reservations for My Halls
                                </a>
                            <?php } ?>
                            <?php if ($user_level >= 3) { ?>
                                <a href="calendar.php" class="list-group-item">
                                    <span class="glyphicon glyphicon-edit"></span>&nbsp;Manage Reservations
                                </a>
                            <?php } ?>
                            <?php if ($user_level >= 3) { ?>
                                <a href="request.php" class="list-group-item">
                                    <span class="glyphicon glyphicon-time"></span>&nbsp;Hall Reservation History
                                </a>
                            <?php } ?>
                            <?php if ($user_level >= 4) { ?>
                                <a href="cancel.php" class="list-group-item">
                                    <span class="glyphicon glyphicon-star"></span>&nbsp;Administrator
                                </a>
                            <?php } ?>

                        </div>
                    <?php } else { ?>
                        <div class="list-group">
                            <a href="home.php" class="list-group-item list-group-item-disabled"> 
                                <span class="glyphicon glyphicon-home"></span>&nbsp;Home
                            </a>
                            <a href="calendar.php" class="list-group-item active">
                                <span class="glyphicon glyphicon-calendar"></span>&nbsp;Reservation Calendar
                            </a>
                            <a href="request.php" class="list-group-item list-group-item-disabled">
                                <span class="glyphicon glyphicon-ok-circle"></span>&nbsp;Request Reservations
                            </a>
                            <a href="cancel.php" class="list-group-item list-group-item-disabled">
                                <span class="glyphicon glyphicon-remove-circle"></span>&nbsp;Cancel Reservations
                            </a>
                            <a href="my_history.php" class="list-group-item list-group-item-disabled">
                                <span class="glyphicon glyphicon-time"></span>&nbsp;Reservation History
                            </a>
                        </div>
                        <div class="list-group">
                            <button type="button" class="btn btn-success btn-lg btn-block" onclick="window.location.href = 'login.php'">Login</button>
                        </div>
                    <?php } ?>
                </div><!--/span-->
            </div><!--/row-->

        </div><!--/.container-->

        <div style="min-height: 50px;">

        </div>
        <footer>
            <?php include ROOT_DIR . 'footer.php'; ?>
        </footer>
        <?php include ROOT_DIR . 'scripts.inc.php'; ?>
        <script src="js/er_calendar.js" type="text/javascript"></script>
    </body>
</html>
