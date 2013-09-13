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
        <link href="styles/calendarStyle.css" rel="stylesheet" type="text/css" />
        <link href="styles/navMenu.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.10.2.min.js" ></script>
        <script src="js/common.js" ></script>
        <script src="js/calendar.js"></script>
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
			<!-- InstanceBeginEditable name="PageTitle" -->Check Reservations<!-- InstanceEndEditable -->		
    			<div id="logName">
                <!-- InstanceBeginEditable name="UserType" -->
                    <?php
                    $db = new Database();
                    $dbCon = $db->getConnection();

                    $chc = new CheckCookie($dbCon);
                    $result = $chc->checkCook("guest");

                    if ($result != "guest") {
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
                        <a href="request.php"><li>Request Reservations</li></a>
                        <a href="cancel.php"><li>Cancel Reservation</li></a>
                        <a href="my_history.php"><li>Reservation History</li></a>
                    </ul>
                </div>
                <!-- InstanceEndEditable -->
  			</div>
  			
  	
  			<div class="content">
				<!-- InstanceBeginEditable name="Content" -->
                <div id="roomSelect">
                    <div id="reg2">                        
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td><span class="subhead">OR</span></td>
                            </tr>
                            <tr>                                    
                                <td><a href="calendar.php"><button id="allBtn" name="allBtn" type="button" class="greenBtn">View All<br/> Rooms</button></a></td>
                            </tr>                            
                        </table>                                                   
                    </div>
                    <div id="reg1">
                        <form id="roomSelector" name="dateSelector" >
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td><span class="subhead">Search for a room</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="roomS" id="roomS" value="1" checked>by Room ID</input>
                                        &emsp;
                                        <input type="radio" name="roomS" id="roomS" value="2" >by Room Name</input>
                                    </td>                                
                                </tr>
                                <tr>
                                    <td><input type="text" name="roomID" id="roomID" class="textBox" /></td>
                                    <td><button id="showBtn" name="showBtn" type="button" class="greenBtn">Search</button></td>
                                </tr>                            
                            </table>
                            <input type="hidden" name="submit1" value="1"/>
                        </form>
                    </div>
                    <div id="reg3">                        
                        <table cellpadding="0" cellspacing="0">
                            <tr>
                                <td><span class="subhead">Filter by</span></td>
                                <td>
                                    <label>Faculty</label>
                                    <select id="fac" name="fac" class="dropList" >                                        
                                    </select>
                                    &emsp;
                                    <label>Department</label>
                                    <select id="dep" name="dep" class="dropList"></select>
                                </td>
                            </tr>                                                        
                        </table>                                                   
                    </div>

                </div>

                <div id="roomSheet">
                    <table id="roomSheetData" cellspacing="0"></table>
                </div>

                <div class="overlay" id="overlay">
                    <div id="ovBox">
                        <div id="dateSelect">
                            <form id="dateSelector" name="dateSelector" >    
                                <label>Year</label>
                                <select id="year" name="year" class="dropList" ></select>
                                &emsp;
                                <label>Month</label>
                                <select id="month" name="month" class="dropList"></select>
                                &emsp;
                                <label>Date</label>
                                <select id="date" name="date" class="dropList"></select>
                                <button id="closeOvr" name="closeOvr" type="button" class="redBtn"><b>X</b></button>
                            </form>
                        </div> 
                        <br/>
                        <b>&emsp;Room ID : </b><span id="ovrID"></span><br/>
                        <b>&emsp;Room Name : </b><span id="ovrName"></span>  
                        <br/>
                        <div id="resData">
                            <table id="resDataSheet"></table>
                        </div>
                        <div id="btnPanel">
                            <button id="reqRes" name="reqRes" type="button" class="greenBtn">Request<br/>Reservation</button>
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
