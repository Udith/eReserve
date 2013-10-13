<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include './scripts/CheckCookie.php';
include './scripts/MyDB.php';

$chc = new CheckCookie();

session_start();
if (!isset($_SESSION['username'])) {
    $db = new Database();
    $dbCon = $db->getConnection();
    $result = $chc->checkCook($dbCon, "staff");

    if ($result != "guest") {
        $_SESSION['username'] = $result[0];
        $_SESSION['first'] = $result[1];
        $_SESSION['last'] = $result[2];
        $_SESSION['type'] = $result[3];
    }
} else {
    if ($_SESSION['type'] != "staff") {
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
        <link href="styles/staffStyle.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery-1.10.2.min.js" ></script>
        <script src="js/common.js" ></script>
        <script src="js/staff.js"></script>
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
  
  			<div class="titleBar staffTitle">
			<!-- InstanceBeginEditable name="PageTitle" -->Staff<!-- InstanceEndEditable -->		
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
             	<!-- InstanceBeginEditable name="SideBar" --><!-- InstanceEndEditable -->
  			</div>
  			
  	
  			<div class="content">
				<!-- InstanceBeginEditable name="Content" -->
				<div id="rooms">
                    <h2>Pending Reservations for Today</h2>
                    <hr/>
                    <table id="roomsTable" class="dataTable" cellspacing="0"></table>
                    
                </div>
                <div class="overlay" id="overlay">
                	<div id="rate">
                    	<div id="ovrHeader"> 
                            <button id="closeOvr" name="closeOvr" type="button" class="redBtn"><b>X</b></button>
                            <h2>Rate Reservation</h2>
                        </div>                        
                        <hr/>
                        <span id="reservation" style="display:none;"></span>
                        <table >
                            <tr>
                                <td width="140px">
                                	<label style="font-weight:bold;">
                                        <input type="radio" name="rating" value="2" id="rating1" checked="checked"/>
                                        Excellent</label>
                                    </label>
                                </td>
                                <td width="140px">
                                	<label style="font-weight:bold;">
                                        <input type="radio" name="rating" value="1" id="rating2" />
                                        Good</label>
                                    </label>
                                </td>
                                <td width="140px">
                                	<label style="font-weight:bold;">
                                        <input type="radio" name="rating" value="-1" id="rating3" />
                                        Bad</label>
                                    </label>
                                </td>
                                <td width="140px">
                                	<label style="font-weight:bold;">
                                        <input type="radio" name="rating" value="-2" id="rating4" />
                                        Worse</label>
                                    </label>
                                </td>
                            </tr>
                            <tr id="compRow">
                                <td style="font-weight:bold;text-align:right;">Complaints</td>
                                <td colspan="3">
                                	<textarea id="complaint" style="width:400px;max-width:400px;min-width:400px;"></textarea>
                                </td>
                            </tr>
                            <tr>   
                            	<td colspan="3"></td>                             
                                <td style="text-align:right;">
                                    <button id="rateBtn" name="rateBtn" class="greenBtn" type="button">DONE</button>
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
