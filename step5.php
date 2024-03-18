<?php
  if(!isset($_SESSION)) session_start(); 

	if (!isset($_SESSION['vehiclecategorytypeid'])) $_SESSION["vehiclecategorytypeid"] = "";
	if (!isset($_SESSION['PickupLocationID'])) $_SESSION["PickupLocationID"] = "";
	if (!isset($_SESSION['DropOffLocationID'])) $_SESSION["DropOffLocationID"] = "";
	if (!isset($_SESSION['PickupDate'])) $_SESSION["PickupDate"] = "";
	if (!isset($_SESSION['PickupTime'])) $_SESSION["PickupTime"] = "";
	if (!isset($_SESSION['ReturnDate'])) $_SESSION["ReturnDate"] = "";
	if (!isset($_SESSION['ReturnTime'])) $_SESSION["ReturnTime"] = "";
	if (!isset($_SESSION['Age'])) $_SESSION["Age"] = "";
	if (!isset($_SESSION['PromoCode'])) $_SESSION["PromoCode"] = "";
	if (!isset($_SESSION['refid'])) $_SESSION["refid"] = "";
	if (!isset($_SESSION['RateID'])) $_SESSION["RateID"] = "";
	if (!isset($_SESSION['vehiclecategoryid'])) $_SESSION["vehiclecategoryid"] = "";

	if (!isset($_SESSION['firstname'])) $_SESSION["firstname"] = "";
	if (!isset($_SESSION['lastname'])) $_SESSION["lastname"] = "";
	if (!isset($_SESSION['email'])) $_SESSION["email"] = "";
	if (!isset($_SESSION['phone'])) $_SESSION["phone"] = "";
	if (!isset($_SESSION['dob'])) $_SESSION["dob"] = "";
	if (!isset($_SESSION['license'])) $_SESSION["license"] = "";
	if (!isset($_SESSION['expire'])) $_SESSION["expire"] = "";
	if (!isset($_SESSION['address'])) $_SESSION["address"] = "";
	if (!isset($_SESSION['city'])) $_SESSION["city"] = "";
	if (!isset($_SESSION['postcode'])) $_SESSION["postcode"] = "";
	if (!isset($_SESSION['valoldcustomer'])) $_SESSION["valoldcustomer"] = "";
	if (!isset($_SESSION['valquote'])) $_SESSION["valquote"] = "";
	if (!isset($_SESSION['valbooking'])) $_SESSION["valbooking"] = "";
	if (!isset($_SESSION['selOptions'])) $_SESSION["selOptions"] = "";
	if (!isset($_SESSION['CustomerData'])) $_SESSION["CustomerData"] = "";
	if (!isset($_SESSION['ReservationRef'])) $_SESSION["ReservationRef"] = "";
	if (!isset($_SESSION['ReservationNo'])) $_SESSION["ReservationNo"] = "";
	if (!isset($_SESSION['BookingType'])) $_SESSION["BookingType"] = "";

	if (isset($_POST["vehiclecategorytypeid"])) $_SESSION["vehiclecategorytypeid"] = $_POST["vehiclecategorytypeid"];
	if (isset($_POST["PickupLocationID"])) $_SESSION["PickupLocationID"] = $_POST["PickupLocationID"];
	if (isset($_POST["DropOffLocationID"])) $_SESSION["DropOffLocationID"] = $_POST["DropOffLocationID"];
	if (isset($_POST["PickupDate"])) $_SESSION["PickupDate"] = $_POST["PickupDate"];
	if (isset($_POST["PickupTime"])) $_SESSION["PickupTime"] = $_POST["PickupTime"];
	if (isset($_POST["ReturnDate"])) $_SESSION["ReturnDate"] = $_POST["ReturnDate"];
	if (isset($_POST["ReturnTime"])) $_SESSION["ReturnTime"] = $_POST["ReturnTime"];
	if (isset($_POST["Age"]))  $_SESSION["Age"] = $_POST["Age"];
	if (isset($_POST["PromoCode"]))  $_SESSION["PromoCode"] = $_POST["PromoCode"];
	if (isset($_POST["refid"]))  $_SESSION["refid"] = $_POST["refid"];
	if (isset($_POST["RateID"]))  $_SESSION["RateID"] = $_POST["RateID"];
	if (isset($_POST["vehiclecategoryid"]))  $_SESSION["vehiclecategoryid"] = $_POST["vehiclecategoryid"];

	if (isset($_POST["firstname"]))  $_SESSION["firstname"] = $_POST["firstname"];
	if (isset($_POST["lastname"]))  $_SESSION["lastname"] = $_POST["lastname"];
	if (isset($_POST["email"]))  $_SESSION["email"] = $_POST["email"];
	if (isset($_POST["phone"]))  $_SESSION["phone"] = $_POST["phone"];
	if (isset($_POST["dob"]))  $_SESSION["dob"] = $_POST["dob"];
	if (isset($_POST["license"]))  $_SESSION["license"] = $_POST["license"];
	if (isset($_POST["expire"]))  $_SESSION["expire"] = $_POST["expire"];
	if (isset($_POST["address"]))  $_SESSION["address"] = $_POST["address"];
	if (isset($_POST["city"]))  $_SESSION["city"] = $_POST["city"];
	if (isset($_POST["postcode"]))  $_SESSION["postcode"] = $_POST["postcode"];
	if (isset($_POST["valoldcustomer"]))  $_SESSION["valoldcustomer"] = $_POST["valoldcustomer"];
	if (isset($_POST["valquote"]))  $_SESSION["valquote"] = $_POST["valquote"];
	if (isset($_POST["valbooking"]))  $_SESSION["valbooking"] = $_POST["valbooking"];
	if (isset($_POST["selOptions"]))  $_SESSION["selOptions"] = $_POST["selOptions"];
	if (isset($_POST["CustomerData"]))  $_SESSION["CustomerData"] = $_POST["CustomerData"];
	if (isset($_POST["ReservationRef"]))  $_SESSION["ReservationRef"] = $_POST["ReservationRef"];
	if (isset($_POST["ReservationNo"]))  $_SESSION["ReservationNo"] = $_POST["ReservationNo"];
	if (isset($_POST["BookingType"]))  $_SESSION["BookingType"] = $_POST["BookingType"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Step 5</title>
  <link type="text/css" href="assets/css/Extra.css" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" href="include/jquery.datetimepicker.css" />
  <script src="include/jquery.js"></script>

  <script type="text/javascript" language="javascript">
    //paste this code under head tag or in a seperate js file.
    // Wait for window load
    $(window).load(function () {
      // Animate loader off screen
      $(".se-pre-con").fadeOut("slow");
    });
  </script>
  <script src="include/form_validation.js"></script>
  <script src="include/jquery.datetimepicker.js"></script>
  <script src="include/jquery.date-dropdowns.js"></script>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="assets/css/form-elements.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <script type="text/javascript">
    var frmvalidator;
    var getDetails = 0;
    var subtotal = 0.0;
    var basetotal = 0.0;
    var stamptotal = 0.0;
    var LocID = 0;
    var Age = 0;
    var SizeID = 0;

    $(document).ready(function () {
      // screen re-sizing
      if (window.matchMedia('(max-width: 767px)').matches) {
        $("#dvEmailtxt").attr('class', '');
        $('#dvEmailLbl').remove();
      }

      /////////////////////////////////////////////

      if (document.getElementById("BookingType").value == "2") {
        document.getElementById("reqtitle").innerHTML = "Booking Request Confirmed";
        document.getElementById("refno").innerHTML = "Booking Reference Number <h1>" + document.getElementById("ReservationNo").value + "</h1>";
      } else {
        document.getElementById("reqtitle").innerHTML = "Quote Request Confirmed";
        document.getElementById("refno").innerHTML = "Quote Reference Number <h1>" + document.getElementById("ReservationNo").value + "</h1>";
      }

      // Prevent user using Back button
      if (window.history && window.history.pushState) {
        window.history.pushState('forward', null, './Step5.php');
        $(window).on('popstate', function () {
          //document.getElementById("btnBack").style.borderColor = "red";
          //alert("Please use 'Select Extra' link instead of browser's back function.");
          BootstrapDialog.show({
            type: BootstrapDialog.TYPE_INFO,
            title: 'Oops you are missing something: ',
            buttons: [{
              label: 'Close',
              cssClass: 'btn-type_info',
              action: function (dialogItself) {
                dialogItself.close();
              }
            }],
            draggable: true,
            message: "Please use 'Select Extra' link instead of browser's back function."
          });
    });
      }
    })

  </script>

</head>
<body>
  <div class="se-pre-con"></div>
  <!-- Top menu -->
  <nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
       
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <!--<div class="collapse navbar-collapse" id="top-navbar-1">
        <ul class="nav navbar-nav navbar-right">
          <li>
            .. navigation content
          </li>
        </ul>
      </div>-->
    </div>
  </nav>
  <!-- Top content -->
  <div class="top-content">

    <div class="inner-bg">
      <div class="container">
        <!-- <div class="row">
          <div class="col-sm-12">
            <div id="progress-bar">
              <div id="progress-bar-steps">
                <div class="progress-bar-step done">
									<a href="restart.php">
                  <div class="step_number">1</div>
                  <div class="step_name">Step 1</div></a>
                </div>
                <div class="progress-bar-step done">
                  <div class="step_number">2</div>
                  <div class="step_name">Step 2</div>
                </div>
                <div class="progress-bar-step done">
                  <div class="step_number">3</div>
                  <div class="step_name">Step 3</div>
                </div>
                <div class="progress-bar-step done">
                  <div class="step_number">4</div>
                  <div class="step_name">Step 4</div>
                </div>
                <div class="progress-bar-step last current">
                  <div class="step_number">5</div>
                  <div class="step_name">Step 3</div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div> -->
      </div>
        <div class="row" style="margin-top:5px;">
          <div class="col-sm-12 form-box  text-center">
            <div class="col-sm-12" style="background-color: white; border-radius: 5px; padding-top: 5px; padding-bottom: 5px;">
              <div class="row">
                <div class="col-sm-12 text-center">
                  <h3 id="reqtitle">Request Confirmed</h3>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 text-center">
                  <img src="./images/check3.png" alt="Completed" width="80" /></div>
              </div>
              <div class="row">
                <div class="col-md-12 text-center">
                  <div id="refno" class="borderred"></div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="row" style="padding-top: 3px;">
          <div class="col-sm-12 form-box">
            <div class="col-sm-12" style="background-color: white; border-radius: 5px; padding-top: 5px; padding-bottom: 5px;">
              <div class="row">
                <div class="form-group col-md-12">
                  <div id="displbook">
                        <div class='row'>
                          <div class='col-sm-12  text-center'>
                            <h3>Request Details</h3>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-xs-5 col-sm-6 text-right">First Name : </div>
                          <div class="col-xs-7 col-sm-6 text-left"><?php echo $_SESSION["firstname"]; ?></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-5 col-sm-6 text-right">Last Name : </div>
                          <div class="col-xs-7 col-sm-6 text-left"><?php echo $_SESSION["lastname"]; ?></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-5 col-sm-6 text-right">Phone : </div>
                          <div class="col-xs-7 col-sm-6 text-left"><?php echo $_SESSION["phone"]; ?></div>
                        </div>
                        <div class="row">
                          <div class="col-xs-5 col-sm-6 text-right" id="dvEmailLbl">Email  : </div>
                          <div class="col-xs-7 col-sm-6 text-left"  id="dvEmailtxt"><?php echo $_SESSION["email"]; ?></div>
                        </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="row"><div class="col-sm-12">&nbsp;</div></div>

        <form id="frmStep5" name="frmStep5" action="step5.php" method="post">
          <span id='displmsg' class='red'></span>
          <input type='hidden' name='vehiclecategorytypeid' id='vehiclecategorytypeid' value='<?php echo $_SESSION["vehiclecategorytypeid"]; ?>'>
          <input type='hidden' name='PickupLocationID' id='PickupLocationID' value='<?php echo $_SESSION["PickupLocationID"]; ?>'>
          <input type='hidden' name='DropOffLocationID' id='DropOffLocationID' value='<?php echo $_SESSION["DropOffLocationID"]; ?>'>
          <input type='hidden' name='PickupDate' id='PickupDate' value='<?php echo $_SESSION["PickupDate"]; ?>'>
          <input type='hidden' name='PickupTime' id='PickupTime' value='<?php echo $_SESSION["PickupTime"]; ?>'>
          <input type='hidden' name='ReturnDate' id='ReturnDate' value='<?php echo $_SESSION["ReturnDate"]; ?>'>
          <input type='hidden' name='ReturnTime' id='ReturnTime' value='<?php echo $_SESSION["ReturnTime"]; ?>'>
          <input type='hidden' name='Age' id='Age' value='<?php echo $_SESSION["Age"]; ?>'>
          <input type='hidden' name='RateID' id='RateID' value='<?php echo $_SESSION["RateID"]; ?>'>
          <input type='hidden' name='vehiclecategoryid' id='vehiclecategoryid' value='<?php echo $_SESSION["vehiclecategoryid"]; ?>'>
          <input type='hidden' name='choosetext' id='choosetext' value='Check the following entries:'>
          <input type='hidden' name='valoldcustomer' id='valoldcustomer' value='<?php echo $_SESSION["valoldcustomer"]; ?>'>
          <input type='hidden' name='valquote' id='valquote' value='<?php echo $_SESSION["valquote"]; ?>'>
          <input type='hidden' name='valbooking' id='valbooking' value='<?php echo $_SESSION["valbooking"]; ?>'>
          <input type='hidden' name='selOptions' id='selOptions' value='<?php echo $_SESSION["selOptions"]; ?>'>
          <input type='hidden' name='CustomerData' id='CustomerData' value='<?php echo $_SESSION["CustomerData"]; ?>'>
          <input type='hidden' name='Insurance' id='Insurance' value='<?php echo $_SESSION["Insurance"]; ?>'>
          <input type='hidden' name='ExtraKmOut' id='ExtraKmOut' value='<?php echo $_SESSION["ExtraKmOut"]; ?>'>
          <input type='hidden' name='ReservationRef' id='ReservationRef' value='<?php echo $_SESSION["ReservationRef"]; ?>'>
          <input type='hidden' name='ReservationNo' id='ReservationNo' value='<?php echo $_SESSION["ReservationNo"]; ?>'>
          <input type='hidden' name='BookingType' id='BookingType' value='<?php echo $_SESSION["BookingType"]; ?>'>
          <input type='hidden' name='refid' id='refid' value='<?php echo $_SESSION["refid"]; ?>'>
          <input type='hidden' name='totValue' id='totValue' value='<?php echo $_SESSION["totValue"]; ?>'>
       </form>
      </div>
    </div>
  </div>
  <!-- Javascript -->
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <link href="assets/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
  <script src="assets/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
</body>
</html>