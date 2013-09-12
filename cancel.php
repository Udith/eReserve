<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include 'scripts/CheckCookie.php';
include 'scripts/MyDB.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/site_template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>eReserve</title>
        <link href="styles/mainstyle.css" rel="stylesheet" type="text/css" />
        <!-- InstanceBeginEditable name="Attachments" -->
        <link href="styles/navMenu.css" rel="stylesheet" type="text/css" />
        <link href="styles/cancelStyle.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.10.2.min.js" ></script>
        <script src="js/common.js" ></script>
        <script src="js/cancel.js" ></script>
        <!-- InstanceEndEditable -->
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon"/>	
    </head>

    <body>	
        <div class="container">

            <div class="header">
                <div class="logo" id="logo">
                    <a href="home.php">
                        <img src="images/logo.png" alt="eReserve Logo" name="ereserve_logo" id="ereserve_logo" />
                    </a>      
                </div>    
                <div class="siteName">
                    <span id="mainTitle">Room Reservation System</span>
                    <br />
                    <span id="subTitle">University of Moratuwa</span>
                </div>
            </div>

            <div class="titleBar">
                <!-- InstanceBeginEditable name="PageTitle" -->Cancel Reservations<!-- InstanceEndEditable -->		
                <div id="logName">
                    <!-- InstanceBeginEditable name="UserType" -->
                    <?php
                    $db = new Database();
                    $dbCon = $db->getConnection();

                    $chc = new CheckCookie($dbCon);
                    $result = $chc->checkCook("user");

                    if (is_null($result)) {
                        
                    } else {

                        $usrname = $result[0];
                        $first_name = $result[1];
                        $last_name = $result[2];
                        $type = $result[3];
                        echo ' 
                            	<a href="scripts/Logout.php">
                    				<input type="submit" name="logout" id="logout" value="logout" class="redBtn"/>
                				</a>
                            ';

                        echo $first_name . " " . $last_name;
                    }
                    ?>
                    <!-- InstanceEndEditable -->
                </div>    
            </div>

            <div class="sidebar"> 
                <!-- InstanceBeginEditable name="SideBar" -->
                <div id="navigation">
                    <ul>
                        <a href="home.php"><li>Home</li></a>
                        <a href="calendar.php"><li>Reservation Calendar</li></a>
                        <a href="request.php"><li>Request Reservations</li></a>
                        <a href="my_history.php"><li>Reservation History</li></a>
                    </ul>
                </div>
                <!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <div id="reservations">
                    <h2>Reservations</h2>
                    <hr/>
                    <table id="reserveTable"></table>                
                </div>

                <div id="requests">
                    <h2>Requests</h2>
                    <hr/>
                    <table id="requestTable"></table>
                </div>

                <div class="overlay" id="overlay">
                    <div id="confirm">
                        <input id="opID" type="hidden" value="0"/>
                        <input id="opType" type="hidden" value="0"/>
                        <div id="ovrHeader">                         
                            <h2>Confirm</h2>
                        </div>
                        <hr/>                    
                        <div id="confirmBody">
                            Do you really want to Cancel this Reservation/Request?
                            <br/>
                            <button id="yBtn" name="yBtn" class="greenBtn" type="button">						                     		Yes
                            </button>
                            <button id="nBtn" name="nBtn" class="redBtn" type="button" >
                                No
                            </button>
                        </div>
                    </div>
                </div>                
            </div>

            <!-- InstanceEndEditable --> 	

        </div> 

        </div>
        <!--
        <div class="footer">    
                <marquee onmouseover="this.stop()" onmouseout="this.start()" scrollamount="8" direction="left">
                        Copyrights Reserved &nbsp;&nbsp;&nbsp;&nbsp; &copy;2013 Udith Arosha Gunaratna
        </marquee>
        </div>
        -->
    </body>
    <!-- InstanceEnd --></html>
