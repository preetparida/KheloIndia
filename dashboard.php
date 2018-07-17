 <?php
ini_set("display_errors", "1");
error_reporting(E_ALL);

require_once ("methods/init.php");
require_once ("methods/session.php");

if(!$_SESSION['ID'] && !$_SESSION['ROLE']){header("location:login.php");}
$retailer = new Retailer();

$result = $retailer->retrive();
while($row = $result->fetch_object())
{
   $username = $row->USER_NAME;
   $password = $row->PASSWORD;
   $userID = $row->ID;
}

?>
<!DOCTYPE html>
<html>

    <head>
        <title></title>
        <link rel="stylesheet" href="css/reset.css" type="text/css">
        <link rel="stylesheet" href="css/main.css" type="text/css">
        <link rel="stylesheet" href="css/orientation_utils.css" type="text/css">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, minimal-ui" />
	<meta name="msapplication-tap-highlight" content="no"/>

		
        <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="js/createjs-2015.11.26.min.js"></script>
        <script type="text/javascript" src="js/howler.min.js"></script>
        <script type="text/javascript" src="js/screenfull.js"></script>
		<script type="text/javascript" src="js2/settings.js"></script>
        <script type="text/javascript" src="js2/ctl_utils.js"></script>		
        <script type="text/javascript" src="js/sprite_lib.js"></script>
		<script type="text/javascript" src="js/CPreloader.js"></script>
        <script type="text/javascript" src="js2/CMain.js"></script>
        <script type="text/javascript" src="js2/CMenu.js"></script>
		<script type="text/javascript" src="js2/CGfxButton.js"></script>
		<script type="text/javascript" src="js2/CToggle.js"></script>
		<script type="text/javascript" src="js2/CInterface.js"></script>
        
    </head>
    <body ondragstart="return false;" ondrop="return false;" >
	<div style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%"></div>
	
          <script>
            $(document).ready(function(){
				
                     var oMain = new CMain({
                                            money: 1000,         //STARING CREDIT FOR THE USER
                                            min_bet: 1,       //MINIMUM BET
                                            max_bet: 1000,      //MAXIMUM BET
                                            time_bet: 90000,        //TIME TO WAIT FOR A BET IN MILLISECONDS. SET 0 IF YOU DON'T WANT BET LIMIT
                                            time_winner: 1500,  //TIME FOR WINNER SHOWING IN MILLISECONDS    
                                            win_occurrence: 30, //Win occurrence percentage (100 = always win). 
                                                                //SET THIS VALUE TO -1 IF YOU WANT WIN OCCURRENCE STRICTLY RELATED TO PLAYER BET ( SEE DOCUMENTATION)
                                            casino_cash:1000,   //The starting casino cash that is recharged by the money lost by the user
                                            fullscreen:true, //SET THIS TO FALSE IF YOU DON'T WANT TO SHOW FULLSCREEN BUTTON
                                            check_orientation:true,     //SET TO FALSE IF YOU DON'T WANT TO SHOW ORIENTATION ALERT 
                                            show_credits:true,                     //ENABLE/DISABLE CREDITS BUTTON IN THE MAIN SCREEN
                                            num_hand_before_ads:10                 //NUMBER OF HANDS PLAYED BEFORE AD SHOWN
                                            //
                                            //// THIS FUNCTIONALITY IS ACTIVATED ONLY WITH CTL ARCADE PLUGIN.///////////////////////////
                                            /////////////////// YOU CAN GET IT AT: /////////////////////////////////////////////////////////
                                            // http://codecanyon.net/item/ctl-arcade-wordpress-plugin/13856421 ///////////
                                });

                    
                     if(isIOS()){
                         setTimeout(function(){sizeHandler();},200);
                     }else{
                         sizeHandler();
                     }
           });
        </script>
        <canvas id="canvas" class='ani_hack' width="1280" height="768"> </canvas>
        <div data-orientation="landscape" class="orientation-msg-container"><p class="orientation-msg-text">Please rotate your device</p></div>
        <div id="block_game" style="position: fixed; background-color: transparent; top: 0px; left: 0px; width: 100%; height: 100%; display:none"></div>
    </body>
</html>