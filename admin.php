<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';

$chc = new CheckCookie();

session_start();
if (!isset($_SESSION['username'])) {
    $db = new Database();
    $dbCon = $db->getConnection();
    $result = $chc->checkCook($dbCon, "radmin");

    if ($result != "guest") {
        $_SESSION['username'] = $result[0];
        $_SESSION['first'] = $result[1];
        $_SESSION['last'] = $result[2];
        $_SESSION['type'] = $result[3];
    }
} else {
    if ($_SESSION['type'] != "radmin") {
        header("Location:" . $chc->redirectPage($_SESSION['type']));
    }
}
$usrname = $_SESSION['username'];
$first_name = $_SESSION['first'];
$last_name = $_SESSION['last'];
$type = $_SESSION['type'];
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/site_template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>eReserve</title>
        <link href="styles/mainstyle.css" rel="stylesheet" type="text/css" />
        <!-- InstanceBeginEditable name="Attachments" -->
        <link href="styles/navMenu.css" rel="stylesheet" type="text/css" />
        <link href="styles/adminStyle.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.10.2.min.js" ></script>
        <script src="js/common.js" ></script>
        <script src="js/admin.js"></script>
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
                    <span id="mainTitle">University Room Reservation System</span>
                    <br />
                    <span id="subTitle">University of Moratuwa</span>
                </div>
            </div>

            <div class="titleBar adminTitle">
                <!-- InstanceBeginEditable name="PageTitle" -->Room Administrator<!-- InstanceEndEditable -->		
                <div id="logName">
                    <!-- InstanceBeginEditable name="UserType" -->
                    <?php
                    if (isset($usrname)) {
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
                        <a href="room_history.php"><li>Room History</li></a>
                        <a href="complaints.php"><li>Complaints</li></a>
                    </ul>
                </div>
                <!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <div id="rooms">
                    <h2>Rooms with Pending Requests</h2>
                    <hr/>
                    <table id="roomsTable" class="dataTable" cellspacing="0"></table>
                    <hr/>
                </div>
                <div id="requests">
                    <div id="save">
                        <button id="saveBtn" name="saveBtn" class="blueBtn" type="button">Save Permanently</button>
                        <br/>
                        <span id="ovrlapWarn">There are overlapping reservations.</span>
                    </div>
                    <span id="roomID"></span><br/>
                    <span id="roomName"></span><br/>
                    <span id="date"></span>
                    <br/>
                    <br/>

                    <table id="reqTable" class="dataTable" cellspacing="0"></table>

                    <table id="timeslots">
                        <tr>
                            <td width="25" style="text-align: right"><b>1 :</b></td>
                            <td width="180">8.00 a.m. - 9.00 a.m.</td>
                            <td width="10"></td>
                            <td width="30" style="text-align: right"><b>8 :</b></td>
                            <td width="165">3.00 p.m. - 4.00 p.m.</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>2 :</b></td>
                            <td>9.00 a.m. - 10.00 a.m.</td>
                            <td width="10"></td>
                            <td style="text-align: right"><b>9 :</b></td>
                            <td>4.00 p.m. - 5.00 p.m.</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>3 :</b></td>
                            <td>10.00 a.m. - 11.00 a.m.</td>
                            <td width="10"></td>
                            <td style="text-align: right"><b>10 :</b></td>
                            <td>5.00 p.m. - 6.00 p.m.</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>4 :</b></td>
                            <td>11.00 p.m. - 12.00 p.m.</td>
                            <td width="10"></td>
                            <td style="text-align: right"><b>11 :</b></td>
                            <td>6.00 p.m. - 7.00 p.m.</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>5 :</b></td>
                            <td>12.00 p.m. - 1.00 p.m.</td>
                            <td width="10"></td>
                            <td style="text-align: right"><b>12 :</b></td>
                            <td>7.00 p.m. - 8.00 p.m.</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>6 :</b></td>
                            <td>1.00 p.m. - 2.00 p.m.</td>
                            <td width="10"></td>
                            <td style="text-align: right"><b>13 :</b></td>
                            <td>8.00 p.m. - 9.00 p.m.</td>
                        </tr>
                        <tr>
                            <td style="text-align: right"><b>7 :</b></td>
                            <td>2.00 p.m. - 3.00 p.m.</td>
                            <td width="10"></td>
                            <td style="text-align: right"><b>14 :</b></td>
                            <td>9.00 p.m. - 10.00 p.m.</td>
                        </tr>
                    </table>

                </div>

                <div class="overlay" id="overlay">
                    <div id="reserveBox">
                        <div id="ovrHeader"> 
                            <button id="closeOvr" name="closeOvr" type="button" class="redBtn"><b>X</b></button>
                        </div>     
                        <span id="row" style="display:none;"></span>
                        <table >
                            <tr>
                                <td width="120"><strong>Request ID</strong></td>
                                <td style="color: #112a7c" width="400"><span id="oID"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Requested by</strong></td>
                                <td style="color: #112a7c"><span id="oName"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td style="color: #112a7c"><span id="oEmail"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Reputation</strong></td>
                                <td style="color: #112a7c"><span id="oRep"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Purpose</strong></td>
                                <td style="color: #112a7c"><span id="oPurpose"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Equipment</strong></td>
                                <td style="color: #112a7c"><span id="oEquip"></span></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td style="text-align:right;">
                                    <button id="acceptBtn" name="acceptBtn" class="greenBtn" type="button">ACCEPT</button>
                                    <button id="rejectBtn" name="rejectBtn" class="redBtn" type="button">REJECT</button>
                                </td>
                            </tr>                            
                        </table>
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
