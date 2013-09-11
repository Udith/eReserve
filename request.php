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
        <link href="styles/requestStyle.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.10.2.min.js" ></script>
        <script src="js/common.js" ></script>
        <script src="js/request.js" ></script>
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
			<!-- InstanceBeginEditable name="PageTitle" -->Request Reservations<!-- InstanceEndEditable -->		
    			<div id="logName">
                <!-- InstanceBeginEditable name="UserType" -->
    			    <?php                  
                    $db = new Database();
                    $dbCon = $db->getConnection();

                    $chc = new CheckCookie($dbCon);                    
                    $result = $chc->checkCook("user");
                    
                    if(is_null($result)){
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
                        <a href="cancel.php"><li>Cancel Reservation</li></a>
                        <a href="my_history.php"><li>Reservation History</li></a>
                    </ul>
                </div>
				<!-- InstanceEndEditable -->
  			</div>
  			
  	
  			<div class="content">
				<!-- InstanceBeginEditable name="Content" -->
				<div id="avail">
                    <h2>Check Availability</h2>
                    <hr/>
                    <form id="availForm">
                        <table>
                            <tr>
                                <td>Room ID</td>
                                <td>
                                    <input id="roomID" name="roomID" type="text" class="textBox"/>
                                </td>
                            </tr>
                            <tr>
                                <td>Date</td>
                                <td>
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
                                <td></td>
                                <td>
                                    <button id="availCheck" name="availCheck" class="blueBtn" type="button">Check Availability</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <div id="availFeed">
                        <span id="rName">efergergrbrtbrtnnnnnnnnnnnnnnnnnnnn</span><br/>
                        <span id="availability">Room is Available</span><br/>
                        <button id="resRoom" name="resRoom" class="greenBtn" type="button">Request Room</button>
                        <button id="canRoom" name="cancelRoom" class="redBtn" type="button">Cancel</button>
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
