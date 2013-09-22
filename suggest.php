<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';
?>
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/site_template.dwt" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>eReserve</title>
        <link href="styles/mainstyle.css" rel="stylesheet" type="text/css" />
        <!-- InstanceBeginEditable name="Attachments" -->
        <link href="styles/navMenu.css" rel="stylesheet" type="text/css" />
        <link href="styles/suggestStyle.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-1.10.2.min.js" ></script>
        <script src="js/common.js" ></script>        
        <script src="js/suggest.js" ></script>
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

            <div class="titleBar">
                <!-- InstanceBeginEditable name="PageTitle" -->Suggest a Room<!-- InstanceEndEditable -->		
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
                        <a href="cancel.php"><li>Cancel Reservation</li></a>
                        <a href="my_history.php"><li>Reservation History</li></a>
                    </ul>
                </div>
                <!-- InstanceEndEditable -->
            </div>


            <div class="content">
                <!-- InstanceBeginEditable name="Content" -->
                <div id="needs">
                    <h2>Enter Your Requirements</h2>
                    <hr/>
                    <form id="needForm">
                        <table>
                            <tr>
                                <td width="150">Date</td>
                                <td width="409">
                                    <label>Y</label>
                                    <select id="year" name="year" class="dropList" ></select>
                                    &emsp;
                                    <label>M</label>
                                    <select id="month" name="month" class="dropList"></select>
                                    &emsp;
                                    <label>D</label>
                                    <select id="date" name="date" class="dropList"></select>
                                </td>
                            </tr>
                            <tr>
                                <td>Time Slot</td>
                                <td>
                                    <label>From</label>
                                    <select id="fromT" name="fromT" class="dropList" ></select>
                                    &emsp;
                                    <label>To</label>
                                    <select id="toT" name="toT" class="dropList"></select>
                                </td>
                            </tr>
                            <tr>
                                <td>Faculty</td>
                                <td>
                                    <select id="fac" name="fac" class="dropList" >                     
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Department</td>
                                <td>
                                    <select id="dep" name="dep" class="dropList"></select>
                                </td>
                            </tr>
                            <tr>
                                <td>Seating Capacity </td>
                                <td><b>greater than </b><input name="capacity" type="number" class="textBox" id="capacity" min="1" max="5"/>  
                                    <span id='capacity_error' class='error'></span>
                                </td>
                            </tr>
                            <tr>
                                <td>Airconditioned</td>
                                <td>
                                    <input name="airCon" type="checkbox" id="airCon" />
                                    <label for="airCon">Yes </label>                                        
                                </td>
                            </tr>
                            <tr>
                                <td>Computer Lab</td>
                                <td><input name="comLab" type="checkbox" id="comLab" />
                                    <label for="comLab">Yes </label>

                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button id="sugBtn" name="sugBtn" class="blueBtn" type="button">View Suggestions</button>

                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
                <div id="sugRooms">
                    <table id="sugTable" class="dataTable" cellspacing="0"></table>
                </div>
                <div class="overlay" id="overlay">
                    <div id="reserveBox">
                        <div id="ovrHeader"> 
                            <button id="closeOvr" name="closeOvr" type="button" class="redBtn"><b>X</b></button>
                            <h2>Request Reservation</h2>
                        </div>
                        <hr/>                    
                        <table >
                            <tr>
                                <td width="120"><strong>Room ID</strong></td>
                                <td style="color: #112a7c" width="400"><span id="oID"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Room Name</strong></td>
                                <td style="color: #112a7c"><span id="oName"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Date</strong></td>
                                <td style="color: #112a7c"><span id="oDate"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Time Slot</strong></td>
                                <td style="color: #112a7c"><span id="oTime"></span></td>
                            </tr>
                            <tr>
                                <td><strong>Purpose</strong></td>
                                <td>
                                    <textarea cols="40" rows="3" id="oPurpose"></textarea><br/>
                                    <span id="emptyPurpose" style="color:#F00; font-size: 14px;"></span>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Equipments</strong></td>
                                <td>
                                    <textarea cols="40" rows="3" id="oItems"></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td style="text-align:right;">
                                    <button id="requestBtn" name="requestBtn" class="greenBtn" type="button">REQUEST</button>
                                    <br/>
                                    <span id="reqResult" style="text-align:right; font-size: 18px;"></span>
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
