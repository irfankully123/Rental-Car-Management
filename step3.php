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
   if (!isset($_SESSION['totValue'])) $_SESSION["totValue"] = "";
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
   if (!isset($_SESSION['txtState'])) $_SESSION["txtState"] = "";
   if (!isset($_SESSION['txtFlightNo'])) $_SESSION["txtFlightNo"] = "";
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
   if (isset($_POST["statusid"]))  $_SESSION["statusid"] = $_POST["statusid"];
   if (isset($_POST["RateID"]))  $_SESSION["RateID"] = $_POST["RateID"];
   if (isset($_POST["vehiclecategoryid"]))  $_SESSION["vehiclecategoryid"] = $_POST["vehiclecategoryid"];
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
  <title>Step 3
  </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> 
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

<script src="include/form_validation.js" type="text/javascript"></script>
<script src="include/jquery.datetimepicker.js" type="text/javascript"></script>
<script src="include/jquery.date-dropdowns.js" type="text/javascript"></script>
<script src="assets/js/customjs.js" type="text/javascript"></script>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/form-elements.css" type="text/css">
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<script type="text/javascript">
     var frmvalidator;
     var getDetails = 0; // Default should be 0 only in case we want to have all car details set to 1
     var subtotal = 0.0;
     var basetotal = 0.0;
     var ratetotal = 0.0;
     var freedays = 0.0;
     var stamptotal = 0.0;
     var LocID = 0;
     var Age = 0;
     var SizeID = 0;
     var signScript = "signRequest.php";
     var oAPI = new rcmAPI();

     $(document).ready(function () {
      document.getElementById("dvbtn").style.display = "none";

      document.getElementById("btnBooking").style.display = "none";
      document.getElementById("btnQuote").style.display = "none";

      if (document.getElementById("valquote").value == 0) {
         document.getElementById("displquote").style.display = "none";
      } else {
         document.getElementById("displquote").style.display = "";
         if (document.getElementById("valbooking").value == 0)
            document.getElementById("btnQuote").style.display = "";
      }

      if (document.getElementById("valbooking").value == 0) {
         document.getElementById("displbook").style.display = "none";
      } else {
         document.getElementById("dvbtn").style.display = "";

         document.getElementById("displbook").style.display = "";
         document.getElementById("btnBooking").style.display = "";
         document.getElementById("btnQuote").style.display = "none";
      }

      oAPI.OnReadyStep3(DisplStep3);
      oAPI.OnReadyGetUser(SetupCustomer);
      oAPI.GetStep3(
                document.getElementById("vehiclecategorytypeid").value,
                document.getElementById("PickupLocationID").value,
                document.getElementById("PickupDate").value,
                document.getElementById("PickupTime").value,
                document.getElementById("DropOffLocationID").value,
                document.getElementById("ReturnDate").value,
                document.getElementById("ReturnTime").value,
                document.getElementById("Age").value,
                document.getElementById("vehiclecategoryid").value,
                document.getElementById("PromoCode").value,
                getDetails
         )

       var d = new Date();
       var n = d.getFullYear();

       $("#dob").dateDropdowns({
         submitFieldName: 'dob',
         submitFormat: "dd/mm/yyyy",
         daySuffixes: false,
         monthFormat: "short",
         maxYear: n - 5,
         minYear: n - 90
       });
       $("#expire").dateDropdowns({
         submitFieldName: 'expire',
         submitFormat: "dd/mm/yyyy",
         daySuffixes: false,
         monthFormat: "short",
         maxYear: n + 50,
         minYear: d.getFullYear(),
         yearReverse: true
       });
     })

     function DisplStep3() {
       var out = "";
       var qtyItem = "";
       var LocAvailable = true;
       var UseStateTax = oAPI.GetStateTax() > 0;
       var UseTax = oAPI.GetTax() > 0;
       var LocAvailableMsg = oAPI.CheckLocationAvailable();
      var CurrencySymbol = "";
      var CurrencyName = "";
      if (rcmLocationFees[0]["currencysymbol"] != null) CurrencySymbol = rcmLocationFees[0]["currencysymbol"];
      if (rcmLocationFees[0]["currencyname"] != null) CurrencyName = rcmLocationFees[0]["currencyname"];
       if (LocAvailableMsg != '') LocAvailable = false;
       LocID = document.getElementById("PickupLocationID").value;
       Age = oAPI.GetAge(document.getElementById("Age").value);

       document.getElementById("displmsg").innerHTML = LocAvailableMsg;

       oAPI.LoadRentalSource(document.getElementById("foundus"), document.getElementById("foundus").value, "How did you find us...", false);
       oAPI.LoadAreaOfUse(document.getElementById("areaofuse"), document.getElementById("areaofuse").value, LocID, "Select area of usage", false);
       oAPI.LoadCountries(document.getElementById("issuedin"), document.getElementById("issuedin").value, "Select a country", false);
       oAPI.LoadCountries(document.getElementById("country"), document.getElementById("country").value, "Select a country", false);

       if (LocAvailable == false) {
         BootstrapDialog.show({
           type: BootstrapDialog.TYPE_DANGER,
           title: 'Oops you are missing something: ',
           buttons: [{
             label: 'Close',
             cssClass: 'btn-danger',
             action: function (dialogItself) {
               dialogItself.close();
             }
           }],
           draggable: true,
           message: LocAvailableMsg
         });
       }

         CarAvailable = true;
      if (rcmAvailableCars[0]["available"] == '0') CarAvailable = false;
      SizeID = rcmAvailableCars[0]["vehiclecategoryid"];
      subtotal = parseFloat(rcmAvailableCars[0]["totalrateafterdiscount"]).toFixed(2);
         ratetotal = subtotal;
      numofdays = rcmAvailableCars[0]["numberofdays"];
         out = out + "<div class='row' style='background-color:#FFFFFF;border-radius:5px;'>"
         out = out + "<div class='col-sm-4 text-center  vehicleThumbnail'>"
      out = out + "<div class='row'><div class='col-sm-12'><img class='img-responsive' src='https:" + rcmAvailableCars[0]["imageurl"] + "' alt='' class='car-img' /></div></div>";
      out = out + "<div class='row'><div class='col-sm-12'><i class='fa fa-child fa-2'></i>x" + rcmAvailableCars[0]["numberofadults"];
      out = out + "&nbsp;&nbsp;<i class='fa fa-child'></i>x" + rcmAvailableCars[0]["numberofchildren"];
      out = out + "&nbsp;&nbsp;<i class='fa fa-briefcase fa-2'></i>x" + rcmAvailableCars[0]["numberoflargecases"];
      out = out + "&nbsp;&nbsp;<i class='fa fa-briefcase'></i>x" + rcmAvailableCars[0]["numberofsmallcases"] + "</div></div>";
         out = out + "</div>";
         out = out + "<div class='col-sm-7' style='margin-top: 35px;'>"

      out = out + "<div class='row'><div class='col-xs-4 text-right' id='divPickup'><strong>Vehicle : </strong></div><div class='col-xs-8 text-left'>" + rcmAvailableCars[0]["categoryfriendlydescription"] + "</div></div>";
         out = out + "<div class='row'><div class='col-xs-4 text-right' id='divPickup'><strong>Pickup Location : </strong></div><div class='col-xs-8 text-left'>" + rcmLocationFees[0]["location"] + "</div></div>";
      out = out + "<div class='row'><div class='col-xs-4 text-right' id='divReturn'><strong>Pickup Date & Time : </strong></div><div class='col-xs-8 text-left'>" + rcmLocationFees[0]["dayofweekname"] + " " + rcmLocationFees[0]["locdate"] + " " + rcmLocationFees[0]["loctime"] + "</div></div>";
         out = out + "<div class='row'><div class='col-xs-4 text-right' id='divPickup'><strong>Return Location : </strong></div><div class='col-xs-8 text-left'>" + rcmLocationFees[1]["location"] + "</div></div>";
      out = out + "<div class='row'><div class='col-xs-4 text-right' id='divPickup'><strong>Return Date & Time : </strong></div><div class='col-xs-8 text-left'>" + rcmLocationFees[1]["dayofweekname"] + " " + rcmLocationFees[1]["locdate"] + " " + rcmLocationFees[1]["loctime"] + "</div></div>";
         out = out + "<div class='row'><div class='col-xs-4 text-right' id='divDriver'><strong>Youngest Driver : </strong></div><div class='col-xs-8 text-left'>" + Age + " Years</div></div>";

         out = out + "</div>";
         out = out + "</div>";
         out = out + "<div class='row'><div class=col-sm-12'>&nbsp;</div></div>";

         out = out + "<div class='row'>"
         out = out + "<div class='col-sm-4' style='background-color:#FFFFFF;border-radius:5px;'>";

         // FreeDays
      if (rcmAvailableCars[0]["freedays"] > 0) {
       	freedays = parseFloat(rcmAvailableCars[0]["freedaysamount"]);
       	subtotal = subtotal - freedays;
         }

			// TODO Replace rcmAvailableCars with rcmSeasonalRates in section below
      for (var i = 0; i < rcmSeasonalRates.length; ++i) {
      	if (rcmSeasonalRates[i]["numberofdays"] > 0) {
           out = out + "<div class='row'><div class='col-sm-12'><h4>Daily rate:</h4></div></div>";
         } else {
           out = out + "<div class='row'><div class='col-sm-12'><h4>Hourly rate:</h4></div></div>";
         }
         out = out + "<div class='row'>";
				if (rcmSeasonalRates[i]["numberofdays"] > 0) {
					out = out + "<div class='col-xs-8 text-left'>" + rcmSeasonalRates[i]["numberofdays"] + " days @" + CurrencySymbol + "" + parseFloat(rcmSeasonalRates[i]["dailyrateafterdiscount"]).toFixed(2) + "</div><div class='col-xs-4 text-right'><label id='baserate'>" + CurrencySymbol + parseFloat(rcmAvailableCars[0]["totalrateafterdiscount"]).toFixed(2) + "</label></div>";
         } else {
					out = out + "<div class='col-xs-8 text-left'>" + rcmSeasonalRates[i]["numberofhours"] + " hours" + "</div><div class='col-xs-4 text-right'><label id='baserate'>" + parseFloat(rcmSeasonalRates[i]["ratesubtotal"]).toFixed(2) + "</label></div>";
         }
         out = out + "</div>";

				if (rcmSeasonalRates[i]["discountrate"] > 0) {
					ratetypedesc = ""
					if (rcmSeasonalRates[i]["numberofdays"] > 0) ratetypedesc = "per day"
					if (rcmSeasonalRates[i]["discounttype"] == "p") {
						out = out + "<div class='row'><div class='col-xs-12 text-left red'>" + CurrencySymbol + "" + parseFloat(rcmSeasonalRates[i]["dailyratebeforediscount"]).toFixed(2) + "  " + ratetypedesc + " less " + parseFloat(rcmSeasonalRates[i]["discountrate"]).toFixed(2) + "% discount</div></div>";
           }
					else if (rcmSeasonalRates[i]["discounttype"] == "d") {
						out = out + "<div class='row'><div class='col-xs-12 text-left red'>" + CurrencySymbol + "" + parseFloat(rcmSeasonalRates[i]["dailyratebeforediscount"]).toFixed(2) + "  " + ratetypedesc + " less " + CurrencySymbol + "" + parseFloat(rcmSeasonalRates[i]["discountrate"]).toFixed(2) + "  " + ratetypedesc + " discount</div></div>";
					}
					else if (rcmSeasonalRates[i]["discounttype"] == "f") {
						out = out + "<div class='row'><div class='col-xs-12 text-left red'>" + CurrencySymbol + "" + parseFloat(rcmSeasonalRates[i]["dailyratebeforediscount"]).toFixed(2) + " less " + CurrencySymbol + "" + parseFloat(rcmSeasonalRates[i]["discountrate"]).toFixed(2) + " discount</div></div>";
					}
        }
      }
			// END TODO Replace rcmAvailableCars with rcmSeasonalRates in section below
			if (rcmAvailableCars[0]["totaldiscountamount"] > 0) {
				out = out + "<div class='row'><div class='col-xs-12 text-left'><span class='red' style='font-size:12px;'>Total Discounts " + CurrencySymbol + " " + parseFloat(rcmAvailableCars[0]["totaldiscountamount"]).toFixed(2) + " already included in rental rate.</span></div></div>";
        }

         // Mandatory Extra Fees
         basetotal = parseFloat(subtotal);
         out = out + "<div class='row'><div class='col-sm-12'><h4>Extra Fees:</h4></div></div>";
       
      for (j in rcmMandatoryFees) {
             if (rcmMandatoryFees[j]["type"] == "Daily") {
       		out = out + "<div class='row'><div class='col-xs-8 text-left'><span class='glyphicon glyphicon-plus-sign'></span>&nbsp;" + rcmMandatoryFees[j]["name"] + " @ " + CurrencySymbol + "" + parseFloat(rcmMandatoryFees[j]["fees"]).toFixed(2) + " Per Day</div><div class='col-xs-4 text-right'><label id='MandatoryFees" + rcmMandatoryFees[j]["id"] + "'>" + CurrencySymbol + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]).toFixed(2) + "</label></div></div>";
             } else {
       		out = out + "<div class='row'><div class='col-xs-8 text-left'><span class='glyphicon glyphicon-plus-sign'></span>&nbsp;" + rcmMandatoryFees[j]["name"] + "</div><div class='col-xs-4 text-right'><label id='MandatoryFees" + rcmMandatoryFees[j]["id"] + "'>" + CurrencySymbol + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]).toFixed(2) + "</label></div></div>";
           }
         }

         // Total Optional Extras 
         out = out + "<div class='row'><div class='col-xs-8 text-left'><span class='glyphicon glyphicon-plus-sign'></span>&nbsp;Total Optional Extras</div><div class='col-xs-4 text-right'>" + CurrencySymbol + "<label id='TotOptionalExtras'>0.00</label></div></div>";

      if (rcmAvailableCars[0]["freedays"] > 0) {
       	out = out + "<div class='row'><div class='col-xs-8 text-left'><span class='red'>You qualify for " + rcmAvailableCars[0]["freedays"] + " Free day(s) special</span></div><div class='col-xs-4 text-right'>-<label id='freedays'>" + CurrencySymbol + parseFloat(rcmAvailableCars[0]["freedaysamount"]).toFixed(2) + "</label></div></div>";
         }

         if (rcmTaxInclusive == false) {
           if (UseStateTax == true) out = out + "<div class='row'><div class='col-sm-12 text-right'><small>Sales Tax: " + CurrencySymbol + "<label id='displState'>##.##</label></small></div></div>";
       	if (UseTax == true) out = out + "<div class='row'><div class='col-sm-12 text-right'><small>GST: <label id='displGST'>##.##</label></small></div></div>";
       	out = out + "<div class='row'><div class='col-xs-6 text-left'><h4>Total: </h4></div><div class='col-xs-6 text-right'><h4>" + CurrencyName + "" + CurrencySymbol + "<label id='displTot'>###.##</label></h4></div></div>";
         } else {
       	out = out + "<div class='row'><div class='col-xs-6 text-left'><h4>Total: </h4></div><div class='col-xs-6 text-right'><h4>" + CurrencyName + "" + CurrencySymbol + "<label id='displTot'>###.##</label></h4></div></div>";
           if (UseStateTax == true) out = out + "<div class='row'><div class='col-sm-12 text-right'><span>(Inc. Sales Tax: " + CurrencySymbol + "<label id='displState'>##.##</label>)</span></div></div>";
       	if (UseTax == true) out = out + "<div class='row'><div class='col-sm-12 text-right'><span>(Inc. GST: " + CurrencySymbol + "<label id='displGST'>##.##</label>)</span></div></div>";
         }

         out = out + "</div>";
        
         // Optional Extras
         out = out + "<div class='col-sm-8 dashboard-panel-8  pull-right' style='background-color:#FFFFFF;border-radius:5px;'>";
         out = out + "<div class='row'><div class='col-sm-12'><h4>Optional Extras:</h4></div></div>";

         for (j in rcmOptionalFees) {
             qtyItem = "";
       	if (rcmOptionalFees[j]["qtyapply"] == true) {
               qtyItem = " <strong><span class='glyphicon glyphicon-remove'></span></strong> <input type='text' class='' size='2' maxlength='2' name='qtyOptionalExtras" + rcmOptionalFees[j]["id"] + "' id='qtyOptionalExtras" + rcmOptionalFees[j]["id"] + "' value='1' class='qtyitem' onchange='calcTotal()'  style='width:45px;    text-align: center;'  placeholder='01' required maxlength='2'/> ";
             }
             if (rcmOptionalFees[j]["type"] == "Daily") {
              if (rcmOptionalFees[j].numberofdays * rcmOptionalFees[j].fees > rcmOptionalFees[j].maximumprice && rcmOptionalFees[j].maximumprice > 0) {
                out = out + "<div class='row'><div class='col-xs-7 text-left'><input type='checkbox' class='squaredFour' name='OptionalExtras' id='OptionalExtras" + rcmOptionalFees[j]["id"] + "' value='" + rcmOptionalFees[j]["id"] + "' onchange='calcTotal()'> &nbsp;<label for='OptionalExtras" + rcmOptionalFees[j]["id"] + "' class='lblclick'>" + rcmOptionalFees[j]["name"] + "</label></div><div class='col-xs-2 text-left'>" + qtyItem + "</div><div class='col-xs-3 text-right'>" + CurrencySymbol + "<label id='OptionalFees" + rcmOptionalFees[j]["id"] + "' class='off'>" + rcmOptionalFees[j].maximumprice.toFixed(2) + "</label></div></div>";
              } else {
                out = out + "<div class='row'><div class='col-xs-7 text-left'><input type='checkbox' class='squaredFour' name='OptionalExtras' id='OptionalExtras" + rcmOptionalFees[j]["id"] + "' value='" + rcmOptionalFees[j]["id"] + "' onchange='calcTotal()'> &nbsp;<label for='OptionalExtras" + rcmOptionalFees[j]["id"] + "' class='lblclick'>" + rcmOptionalFees[j]["name"] + " @ " + CurrencySymbol + "" + parseFloat(rcmOptionalFees[j]["fees"]).toFixed(2) + " Per Day. </label></div><div class='col-xs-2 text-left'>" + qtyItem + "</div><div class='col-xs-3 text-right'>" + CurrencySymbol + "<label id='OptionalFees" + rcmOptionalFees[j]["id"] + "' class='off'>" + (rcmOptionalFees[j]["numberofdays"] * parseFloat(rcmOptionalFees[j]["fees"])).toFixed(2) + "</label></div></div>";
              }       		
             } else if (rcmOptionalFees[j]["type"] == "Percentage") {
              if (subtotal * parseFloat(rcmOptionalFees[j]["fees"]) / 100 > rcmOptionalFees[j].maximumprice && rcmOptionalFees[j].maximumprice > 0) {
                out = out + "<div class='row'><div class='col-xs-7 text-left'><input type='checkbox' class='squaredFour' name='OptionalExtras' id='OptionalExtras" + rcmOptionalFees[j]["id"] + "' value='" + rcmOptionalFees[j]["id"] + "' onchange='calcTotal()'> &nbsp;<label for='OptionalExtras" + rcmOptionalFees[j]["id"] + "' class='lblclick'>" + rcmOptionalFees[j]["name"] + "</div><div class='col-xs-2 text-left'>" + qtyItem + "</label></div><div class='col-sm-3 text-right'>" + CurrencySymbol + "<label id='OptionalFees" + rcmOptionalFees[j]["id"] + "' class='off'>" + rcmOptionalFees[j].maximumprice.toFixed(2) + "</label></div></div>";
              } else {
                out = out + "<div class='row'><div class='col-xs-7 text-left'><input type='checkbox' class='squaredFour' name='OptionalExtras' id='OptionalExtras" + rcmOptionalFees[j]["id"] + "' value='" + rcmOptionalFees[j]["id"] + "' onchange='calcTotal()'> &nbsp;<label for='OptionalExtras" + rcmOptionalFees[j]["id"] + "' class='lblclick'>" + rcmOptionalFees[j]["name"] + "</div><div class='col-xs-2 text-left'>" + qtyItem + "</label></div><div class='col-sm-3 text-right'>" + CurrencySymbol + "<label id='OptionalFees" + rcmOptionalFees[j]["id"] + "' class='off'>" + (subtotal * parseFloat(rcmOptionalFees[j]["fees"]) / 100).toFixed(2) + "</label></div></div>";
              }       		
             } else {
       		out = out + "<div class='row'><div class='col-xs-7 text-left'><input type='checkbox' class='squaredFour' name='OptionalExtras' id='OptionalExtras" + rcmOptionalFees[j]["id"] + "' value='" + rcmOptionalFees[j]["id"] + "' onchange='calcTotal()'> &nbsp;<label for='OptionalExtras" + rcmOptionalFees[j]["id"] + "' class='lblclick'>" + rcmOptionalFees[j]["name"] + "</div><div class='col-xs-2 text-left'>" + qtyItem + "</label></div><div class='col-sm-3 text-right'>" + CurrencySymbol + "<label id='OptionalFees" + rcmOptionalFees[j]["id"] + "' class='off'>" + parseFloat(rcmOptionalFees[j]["fees"]).toFixed(2) + "</label></div></div>";
           }
       	if (rcmOptionalFees[j]["feedescription"] != '')
       		out = out + "<div class='row'><div class='col-xs-6 text-left' style='padding-left:35px;'>" + rcmOptionalFees[j]["feedescription"] + "</div></div>";
         }

         //Insurance
         var InsuranceOut = "";
         var InsuranceCnt = 0;
         var chkStr;
         var OnOff;
         for (j in rcmInsuranceOptions) {
            InsuranceCnt++;
            chkStr = "";
            OnOff = "off";
       	if (rcmInsuranceOptions[j]["isdefault"] == true) {
              chkStr = " checked";
              OnOff = "on";
            }
            if (rcmInsuranceOptions[j]["type"] == "Daily") {
       		InsuranceOut = InsuranceOut + "<div class='row'><div class='col-xs-9 text-left'><label><input type='radio' name='Insurance' id='Insurance" + rcmInsuranceOptions[j]["id"] + "' value='" + rcmInsuranceOptions[j]["id"] + "' onchange='calcTotal()'" + chkStr + "> &nbsp;" + rcmInsuranceOptions[j]["name"] + " @ " + CurrencySymbol + "" + parseFloat(rcmInsuranceOptions[j]["fees"]).toFixed(2) + " Per Day</label></div><div class='col-xs-3 text-right'>" + CurrencySymbol + "<label id='InsuranceOptions" + rcmInsuranceOptions[j]["id"] + "' class='" + OnOff + "'>" + (rcmInsuranceOptions[j]["numberofdays"] * parseFloat(rcmInsuranceOptions[j]["fees"])).toFixed(2) + "</label></div></div>";
            } else if (rcmInsuranceOptions[j]["type"] == "Percentage") {
       		InsuranceOut = InsuranceOut + "<div class='row'><div class='col-xs-9 text-left'><label><input type='radio' name='Insurance' id='Insurance" + rcmInsuranceOptions[j]["id"] + "' value='" + rcmInsuranceOptions[j]["id"] + "' onchange='calcTotal()'" + chkStr + "> &nbsp;" + rcmInsuranceOptions[j]["name"] + "</label></div><div class='col-xs-3 text-right'>" + CurrencySymbol + "<label id='InsuranceOptions" + rcmInsuranceOptions[j]["id"] + "' class='" + OnOff + "'>" + (subtotal * parseFloat(rcmInsuranceOptions[j]["fees"]) / 100).toFixed(2) + "</label></div></div>";
            } else {
       		InsuranceOut = InsuranceOut + "<div class='row'><div class='col-xs-9 text-left'><label><input type='radio' name='Insurance' id='Insurance" + rcmInsuranceOptions[j]["id"] + "' value='" + rcmInsuranceOptions[j]["id"] + "' onchange='calcTotal()'" + chkStr + "> &nbsp;" + rcmInsuranceOptions[j]["name"] + "</label></div><div class='col-xs-3 text-right'>" + CurrencySymbol + "<label id='InsuranceOptions" + rcmInsuranceOptions[j]["id"] + "' class='" + OnOff + "'>" + parseFloat(rcmInsuranceOptions[j]["fees"]).toFixed(2) + "</label></div></div>";
            }
       	InsuranceOut = InsuranceOut + "<div class='row'><div class='col-xs-6 text-left'>" + rcmInsuranceOptions[j]["feedescription"] + "</div></div>";
       	InsuranceOut = InsuranceOut + "<div class='row'><div class='col-xs-6 text-left'>" + rcmInsuranceOptions[j]["feedescription1"] + "</div></div>";
         }
         if (InsuranceOut.length > 0) {
           out = out + "<div class='row'><div class='col-sm-12 text-left'><h5>Insurance Options:</h5></div></div>";
           out = out + InsuranceOut;
         }

         //ExtraKm
         var ExtraKmOut = "";
         var ExtraKmOutCnt = 0;
         var MileageDesc = "Kms";
         for (j in rcmKmCharges) {
       	MileageDesc = rcmKmCharges[j]["mileagedesc"]

             ExtraKmOutCnt++;
             chkStr = "";
             OnOff = "off";
           
       	if (rcmKmCharges[j]["isdefault"] == true) {
               //chkDefault = true;
               chkStr = " checked";
               OnOff = "on";
             }
       	if (parseFloat(rcmKmCharges[j]["dailyrate"]) > 0) {
       		ExtraKmOut = ExtraKmOut + "<div class='row'><div class='col-sm-10 text-left'><label><input type='radio' name='ExtraKmOut' id='ExtraKmOut" + rcmKmCharges[j]["id"] + "' value='" + rcmKmCharges[j]["id"] + "' onchange='calcTotal()'" + chkStr + "> &nbsp;" + rcmKmCharges[j]["description"] + "</label></div>";
       		ExtraKmOut = ExtraKmOut + "<div class='col-xs-2 text-right'><label id='KmCharges" + rcmKmCharges[j]["id"] + "' class='" + OnOff + "'>" + CurrencySymbol + parseFloat(rcmKmCharges[j]["totalamount"]).toFixed(2) + "</label></div>";
       	} else {
       		ExtraKmOut = ExtraKmOut + "<div class='row'><div class='col-sm-12 text-left'><label><input type='radio' name='ExtraKmOut' id='ExtraKmOut" + rcmKmCharges[j]["id"] + "' value='" + rcmKmCharges[j]["id"] + "' onchange='calcTotal()'" + chkStr + "> &nbsp;" + rcmKmCharges[j]["description"] + "</label></div>";
           }
				ExtraKmOut = ExtraKmOut + "</div>";
         }
         if (ExtraKmOutCnt > 0) {
           out = out + "<div class='table2'>";
       	out = out + "<div class='row'><div class='col-sm-12 text-left'><h4>" + MileageDesc + " Inclusions and Charges</h4></div></div>";
           out = out + ExtraKmOut;
         }
         out = out + "</div>";//Optional Extras

         out = out + "</div>";//class ROW


       document.getElementById("carsdetails").innerHTML = out;

       frmvalidator = new formValidator('frmStep3');
       // conditional validation based on document.getElementById('valquote').value==1
       frmvalidator.addValidation('firstname', 'First Name', true, 'text', "document.getElementById('valquote').value==1", 'Please enter first name for quote');
       frmvalidator.addValidation('lastname', 'Last Name', true, 'text', "document.getElementById('valquote').value==1", 'Please enter last name for quote');
       frmvalidator.addValidation('email', 'Email', true, 'email', "document.getElementById('valquote').value==1", 'Please enter valid email for quote');

       // conditional validation based on document.getElementById('valbooking').value==1
       frmvalidator.addValidation('phone', 'Phone', true, 'number', "document.getElementById('valbooking').value==1", 'Please enter a valid Phone number');
       frmvalidator.addValidation('dob', 'DOB', false, 'dd/mm/yyyy', "document.getElementById('valbooking').value==1", 'Please enter a valid date for DOB');
       frmvalidator.addValidation('expire', 'Expire Date', false, 'dd/mm/yyyy', "document.getElementById('valbooking').value==1", 'Please enter a valid date for License Expire Date');
       frmvalidator.addValidation('notraveling', 'No. of Travellers', true, 'number', "document.getElementById('valbooking').value==1", 'Please enter valid No. of Travellers');
       //frmvalidator.addValidation('address', 'Address', true, 'text', "document.getElementById('valbooking').value==1", 'Please enter your address');
       //frmvalidator.addValidation('areaofuse', 'Area of use', true, 'number', "document.getElementById('valbooking').value==1", 'Please select area of use');

       if (rcmLocationFees[0]["flightnoreqd"] == true) {
         frmvalidator.addValidation('txtFlightNo', 'Flight Number', true, 'text', "document.getElementById('valbooking').value==1", 'Please enter a valid Flight Number.');
       };
       //

       if (InsuranceOut.length > 0) {
        frmvalidator.addValidation('Insurance', 'Insurance', true, 'number', null, 'Please select an Insurance');
       }
       
       // frmvalidator.addValidation('chkbxTerms', 'Terms & Conditions', true, 'bool', "document.getElementById('valbooking').value==1", 'Please accept the Rentals terms and conditions of hire.');
       calcTotal();

     }
     function ShowAlert() {
       alert(rcmAlert);
     }
     function SetupCustomer() {
      if (rcmUserData.length > 0) {
      	var expdate = rcmUserData[0]["licenseexpires"]+'';
      	if (expdate.endsWith("2100")) expdate = "";
        expdate = expdate.replace(/([\s])*([\d^\d])*:([\d^\d])*:([\d^\d])*([\s])*(am|pm)*/gi, "");
        document.getElementById("firstname").value = rcmUserData[0]["firstname"];
        document.getElementById("lastname").value = rcmUserData[0]["lastname"];
        document.getElementById("address").value = rcmUserData[0]["address"];
        document.getElementById("postcode").value = rcmUserData[0]["postcode"];
        document.getElementById("city").value = rcmUserData[0]["city"];
        document.getElementById("txtState").value = rcmUserData[0]["state"];
        document.getElementById("email").value = rcmUserData[0]["email"];
        document.getElementById("phone").value = rcmUserData[0]["phone"];
        document.getElementById("dob").value = rcmUserData[0]["dateofbirth"];
        document.getElementById("license").value = rcmUserData[0]["licenseno"];
        document.getElementById("expire").value = expdate

        $("#country").val(rcmUserData[0]["countryid"]);
        $("select#issuedin option").each(function () { this.selected = (this.text == rcmUserData[0]["licenseissued"]); });
        $("#dob").dateDropdowns('refresh');
        $("#expire").dateDropdowns('refresh');

      } else {
         BootstrapDialog.show({
           type: BootstrapDialog.TYPE_WARNING,
           title: 'Sorry: ',
           buttons: [{
             label: 'Close',
             cssClass: 'btn-danger',
             action: function (dialogItself) {
               dialogItself.close();
             }
           }],
           draggable: true,
           message: "No records found!"
         });
       }
     }
     function booknow() {
       document.getElementById("dvbtn").style.display = "";

       document.getElementById("displquote").style.display = "";
       document.getElementById("displbook").style.display = "";
       document.getElementById("btnBooking").style.display = "";
       document.getElementById("btnQuote").style.display = "none";
       document.getElementById("dvForBooking").style.display = "";
       document.getElementById("dvFlightNoRequired").style.display = "none";
       if (rcmLocationFees[0]["flightnoreqd"] == true) {
         document.getElementById("dvFlightNoRequired").style.display = "";
       };
       window.location.href = "#quotebooking";
     }
     function emailquote() {
       document.getElementById("dvbtn").style.display = "";
       document.getElementById("dvForBooking").style.display = "none"; 
       document.getElementById("displbook").style.display = "none";
       document.getElementById("displquote").style.display = "";
       document.getElementById("btnBooking").style.display = "none";
       document.getElementById("btnQuote").style.display = "";
       window.location.href = "#quotebooking";
       // Save New Values
     }
     function submitQuote() {
       document.getElementById("valoldcustomer").value = 0;
       document.getElementById("valquote").value = 1;
       document.getElementById("valbooking").value = 0;
       doSubmit(1);
     }
     function submitBooking() {
       document.getElementById("valoldcustomer").value = 0;
       document.getElementById("valquote").value = 1;
       document.getElementById("valbooking").value = 1;
      if(rcmValidatedate(document.getElementById("dob").value)) {
				var selectedAge = _calculateAge(rcmStrToDate(document.getElementById("dob").value, "d/m/Y"), rcmStrToDate(document.getElementById("PickupDate").value, "d/m/Y"));
				var minAge = parseInt(rcmAvailableCars[0]["minimumage"], 10);
				var maxAge = parseInt(rcmAvailableCars[0]["maximumage"], 10);
				if (selectedAge >= minAge && selectedAge <= maxAge)
        doSubmit(2);
				else
       		alert("You selected age (" + selectedAge + ") is outside the required age range (" + minAge + " - " + maxAge + " years)");
      } else doSubmit(2);
    }
    function _calculateAge(birthday, compdate) { // birthday is a date
    var ageDifMs = compdate.getTime() - birthday.getTime();
    var ageDate = new Date(ageDifMs); // miliseconds from epoch
    return Math.abs(ageDate.getUTCFullYear() - 1970);
     }
     function doSubmit(BookingType) {
       // First validate form entries
       if (frmvalidator.Validate(document.getElementById("frmStep3"))) {
        //Hide buttons so user can't press it twice
         document.getElementById("dvbtn").style.display = "none";
         document.getElementById("BookingType").value = BookingType;

         oAPI.OnBookingDone(GoToStep4);
         // Before making API call 'MakeBooking' make sure that next items are set within the API
         // - Optional Items, 
         //  - Customer Data, 
         // - Insurance, 
         // - Extra KM 
         // -  and Transmission Type (Default set to 0 --> No Preference)
         //
        oAPI.SetCustomerData({
        	"firstname": document.getElementById("firstname").value
					, "lastname": document.getElementById("lastname").value
					, "email": document.getElementById("email").value
					, "phone": document.getElementById("phone").value
					, "mobile": undefined
					, "dateofbirth": document.getElementById("dob").value
					, "licenseno": document.getElementById("license").value
					, "licenseissued": document.getElementById("issuedin").value
					, "licenseexpires": document.getElementById("expire").value
					, "address": document.getElementById("address").value
					, "city": document.getElementById("city").value
					, "state": document.getElementById("txtState").value
					, "postcode": document.getElementById("postcode").value
					, "countryid": document.getElementById("country").value
					, "fax": undefined
        });

        oAPI.MakeBooking({
        	"vehiclecategorytypeid": document.getElementById("vehiclecategorytypeid").value
        	,"pickuplocationid": document.getElementById("PickupLocationID").value
					,"pickupdate": document.getElementById("PickupDate").value
					,"pickuptime": document.getElementById("PickupTime").value
					,"dropofflocationid": document.getElementById("DropOffLocationID").value
					,"dropoffdate": document.getElementById("ReturnDate").value
					,"dropofftime": document.getElementById("ReturnTime").value
					,"ageid": document.getElementById("Age").value
					,"vehiclecategoryid": document.getElementById("vehiclecategoryid").value
					,"bookingtype": BookingType //1=quote, 2=booking
					,"referralid": document.getElementById("refid").value
					,"foundusid": document.getElementById("foundus").value
					,"remark": document.getElementById("Comments").value
					,"numbertravelling": document.getElementById("notraveling").value
					,"flightin": document.getElementById("txtFlightNo").value
					,"flightout": undefined
					,"arrivalpoint": document.getElementById("txtCollectionPoint").value
					,"departurepoint": undefined
					,"areaofuseid": document.getElementById("areaofuse").value
					,"emailoption": 1 //0=no email, 1=default behaviour, 2=always send
					,"newsletter": 0
					,"transmission": document.getElementById("ddlTransmission").value
					,"campaigncode": undefined
					,"agentcode": undefined
					,"agentname": undefined
					,"agentemail": undefined
					,"agentrefno": undefined
        });
        if (oAPI.CheckCustomerDataOK() != true) {
          //display booking/quote button again 
          document.getElementById("dvbtn").style.display = "";
         }
         // Get data in JSON format to pass it to next form step 4
         document.getElementById("selOptions").value = oAPI.GetOptionalItems();
         document.getElementById("CustomerData").value = oAPI.GetCustomerData();
       }
     }
     function GoToStep4() {
       document.getElementById("ReservationRef").value = oAPI.ReservationRef();
       document.getElementById("ReservationNo").value = oAPI.ReservationNo();

			if (parseFloat(document.getElementById("ReservationNo").value) > 0) {
       // In case of quote directly go to confirmation page --> step 5
       if (document.getElementById("BookingType").value == 1) document.getElementById("frmStep3").action = "step5.php";
       document.getElementById("frmStep3").submit();
			} else {
      	//Booking unsuccessfull -> display booking/quote button again 
      	document.getElementById("dvbtn").style.display = "";
      	alert("Booking unsuccessfull please contact company with this message: " + rcmMsg);
			}
     }

     function calcTotal() {
       var chkid = "";
       var qtyid = "";
       var calcTotOptExt = 0.0;
       var qtyItems = 1;

       // reset value for Insurance
       oAPI.SetInsurance(0);
       for (j in rcmInsuranceOptions) {
         chkid = "Insurance" + rcmInsuranceOptions[j]["id"];
				if (document.getElementById("InsuranceOptions" + rcmInsuranceOptions[j]["id"]))
					document.getElementById("InsuranceOptions" + rcmInsuranceOptions[j]["id"]).className = "off";
         if (document.getElementById("Insurance0") && document.getElementById("Insurance0").checked)
            document.getElementById("InsuranceOptions0").className = "on";
         else if (document.getElementById("Insurance0"))
            document.getElementById("InsuranceOptions0").className = "off";

         if (document.getElementById(chkid) && document.getElementById(chkid).checked) {
            document.getElementById("InsuranceOptions" + rcmInsuranceOptions[j]["id"]).className = "on";
            oAPI.SetInsurance(rcmInsuranceOptions[j]["id"]);
         }
       }

       // reset value for ExtraKms
       oAPI.SetExtraKms(0);
       for (j in rcmKmCharges) {
         chkid = "ExtraKmOut" + rcmKmCharges[j]["id"];
         //KmCharges, kms Daily rate are based on NoofRate days, if 1.4 days charged, total kms daily rate will be 1.4x$10
				if (document.getElementById("KmCharges" + rcmKmCharges[j]["id"]))
					document.getElementById("KmCharges" + rcmKmCharges[j]["id"]).className = "off";
         if (document.getElementById("ExtraKmOut0") && document.getElementById("ExtraKmOut0").checked)
            document.getElementById("KmCharges0").className = "on";
         else if (document.getElementById("ExtraKmOut0"))
            document.getElementById("KmCharges0").className = "off";
         if (document.getElementById(chkid) && document.getElementById(chkid).checked) {
            oAPI.SetExtraKms(rcmKmCharges[j]["id"]);
            }
       }

       oAPI.ClearOptionalItems();
       for (j in rcmOptionalFees) {
         qtyItems = 1;
         chkid = "OptionalExtras" + rcmOptionalFees[j]["id"];
         qtyid = "qtyOptionalExtras" + rcmOptionalFees[j]["id"];
				if (document.getElementById(qtyid)) qtyItems = parseInt(document.getElementById(qtyid).value, 10);
         if (document.getElementById("OptionalFees" + rcmOptionalFees[j]["id"])) {
           document.getElementById("OptionalFees" + rcmOptionalFees[j]["id"]).className = "off";
         }
         if (document.getElementById(chkid) && document.getElementById(chkid).checked) {
					oAPI.AddToOptionalItems(parseInt(rcmOptionalFees[j]["id"], 10), qtyItems);
           document.getElementById("OptionalFees" + rcmOptionalFees[j]["id"]).className = "on";
         }
       }

			rcmMandatory = [];
       for (j in rcmMandatoryFees) {
				rcmMandatory.push({ "id": rcmMandatoryFees[j].id, "qty": rcmMandatoryFees[j].qty });
             }

			if (document.getElementById("displTot")) {
				// make sure we pass on mandatory fees
				if (rcmMandatory.length == 0) rcmMandatory = [{ "id": 0, "qty": 0 }];
				var jsonStr = JSON.stringify({
					"method": "calctotal"
					, "pickuplocationid": document.getElementById("PickupLocationID").value
					, "pickupdate": document.getElementById("PickupDate").value
					, "vehiclecategoryid": SizeID
					, "numberofdays": numofdays
					, "totalrateafterdiscount": ratetotal
					, "freedaysamount": 0
					, "insuranceid": rcmSelInsurance
					, "extrakmsid": rcmSelExtraKms
					, "mandatoryfees": rcmMandatory
					, "optionalfees": rcmSelOptionalFees
				});
				oAPI.ajaxCall(jsonStr, displayTotals);
           }
           }
		function displayTotals(data) {
			if (data) {
				var json = data;
				if (json.status == "OK") {
					calcTotOptExt = 0.0;
					if (json.results) {
						var totals = json.results.totals;
						for (t in totals) {
							switch (totals[t].type) {
								case "total":
									document.getElementById("displTot").innerHTML = parseFloat(totals[t].total).toFixed(2);
									document.getElementById("totValue").value = totals[t].total;
									break;
								case "optional":
									document.getElementById("OptionalFees" + totals[t].id).innerHTML = parseFloat(totals[t].total).toFixed(2);
								case "insurance":
								case "kmsrate":
									calcTotOptExt += parseFloat(totals[t].total);
									break;
								case "country tax":
									if (document.getElementById("displGST"))
										document.getElementById("displGST").innerHTML = parseFloat(totals[t].total).toFixed(2);
									break;
								case "state tax":
									if (document.getElementById("displState"))
										document.getElementById("displState").innerHTML = parseFloat(totals[t].total).toFixed(2);
									else if (document.getElementById("displGST"))
										document.getElementById("displGST").innerHTML = parseFloat(totals[t].total).toFixed(2);
									break;
         }
       }
						document.getElementById("TotOptionalExtras").innerHTML = parseFloat(calcTotOptExt).toFixed(2);
					}
         } else {
					$("#divMsg").text("Calc Total: " + json.error).show();
         }
       }
     }

   </script>
</head>
<body>
  <div class="se-pre-con"></div>

  <div class="top-content">
    <div class="inner-bg">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <div id="progress-bar">
              <div id="progress-bar-steps">
                <div class="progress-bar-step done">
                  <a href="index.php">
                  <div class="step_number">1</div>
                  <div class="step_name">Request</div></a>
                </div>
                <div class="progress-bar-step done">
                  <a href="step2.php">
                  <div class="step_number">2</div>
                  <div class="step_name">Select</div></a>
                </div>
                <div class="progress-bar-step current">
                  <div class="step_number">3</div>
                  <div class="step_name">Extras</div>
                </div>
                <div class="progress-bar-step">
                  <div class="step_number">4</div>
                  <div class="step_name">Payment</div>
                </div>
                <div class="progress-bar-step last">
                  <div class="step_number">5</div>
                  <div class="step_name">Summary</div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div>
        <form id="frmStep3" name="frmStep3" action="step4.php" method="post">
        <div class="row"><div class="col-sm-12 form-box"><p class="bg-error" id='displmsg'></p></div></div>
        <div class="row">
          <div class="col-sm-12 form-box">
            <div id="carsdetails" class='col-sm-12 form-bottom'></div>
          </div>
        </div>
        <div class="row" style="padding-top:3px;">
          <div class="col-sm-12 form-box">
            <div class="col-sm-12" style="background-color: white;border-radius:5px; padding-top:5px; padding-bottom:5px;">
              <div class="row">
                <div class='col-sm-12  text-center'>
                  <a class='btn btn-link-small' role="button" onclick='javascript:emailquote();'>Email Quote</a>&nbsp;&nbsp;<a class='btn btn-link-small' onclick='booknow()' id="txtBooking">Make a Booking</a>
                </div>
            </div>
          </div>
        </div>
        </div>
        <div class="row" style="padding-top: 10px;">
          <div class="col-sm-12 form-box">
            <div id="displquote" class="form-bottom" style="display: none;border-radius: 5px; padding: 10px 25px 10px 25px;">
              <div class='row'  style='background-color: white;border-radius:5px;'>
                <div class='col-sm-12' style="margin-top:10px;margin-bottom:15px;">
                  <a name="quotebooking" class="h4">Customer Details&nbsp;(All fields required)</a>
                </div>
              </div>
              <div class='row' style='background-color: white;border-radius:0px; padding-bottom:15px;'>
                    <div class="col-sm-12">
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="col-sm-6">
                            <label class="control-label">
                              First Name :</label></div>
                          <div class="col-sm-6">
                            <input type="text" placeholder="First Name..." class="form-firstname form-control input-mini"
                              name="firstname" id="firstname" maxlength="20" value='<?php echo $_SESSION["firstname"]; ?>' />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="col-sm-6">
                            <label class="control-label">
                              Last Name :</label></div>
                          <div class="col-sm-6">
                            <input type="text" placeholder="Last Name..." class="form-lastname form-control input-mini"
                              name="lastname" id="lastname" maxlength="20" value='<?php echo $_SESSION["lastname"]; ?>' />
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-6">
                          <div class="col-sm-6">
                            <label class="control-label">
                              Email :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                          <div class="col-sm-6">
                            <input type="text" placeholder="Enter Your Email..." class="form-email form-control input-mini"
                              name="email" id="email" maxlength="50" value='<?php echo $_SESSION["email"]; ?>' />
                          </div>
                        </div>
                        <div class="col-sm-6">
                          <div class="col-sm-6">
                            <label class="control-label">
                              Phone :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label></div>
                          <div class="col-sm-6">
                            <input type="text" placeholder="Enter Your Phone..." class="form-phone form-control input-mini"
                              name="phone" id="phone" maxlength="15" value='<?php echo $_SESSION["phone"]; ?>' /></div>
                        </div>

                      </div>
                      <div class="row" id="dvForBooking">
                        <div class="col-sm-6">
                          <div class="col-sm-6">
                        <label class="control-label">Travellers No. :</label>
                          </div>
                          <div class="col-sm-6">
                            <select name="notraveling" id="notraveling" class="form-notraveling form-control input-mini">
                              <option value="" selected disabled>No. of People Travelling:..</option>
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6+</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-sm-6" id="dvFlightNoRequired">
                          <div class="col-sm-6">
                        <label class="control-label">Flight No. :</label>
                          </div>
                          <div class="col-sm-6">
                            <input type="text" placeholder="Flight No..." class="form-phone form-control input-mini"
                              name="txtFlightNo" id="txtFlightNo" maxlength="15" value='<?php echo $_SESSION["txtFlightNo"]; ?>' /></div>
                        </div>
                      </div>
                    </div>
              </div>
            </div>
          </div>
        </div>
        <div class='row' style="padding-top:10px;">
          <div class="col-sm-12  form-box">
            <div id="displbook" class="form-bottom" style="display: none;border-radius:5px;padding: 10px 25px 10px 25px;">
                <div class='row'  style='background-color: white;border-radius:5px;'>
                  <div class='col-sm-12' style="margin-top:10px;margin-bottom:15px;"><h4>Optional Details </h4></div>
                </div>
                <div class='row'  style='background-color: white;border-radius:0px; padding-bottom:15px;'>
                  <div class='col-sm-12'>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">DOB (dd/mm/yyyy) :</label></div>
                        <div class="col-sm-6"><span class="caldispl"><input type="hidden" id="dob" value=""></span></div>
                      </div>
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">License No :</label></div>
                        <div class="col-sm-6"><input type="text" placeholder="License No..." class="form-license form-control" name="license" id="license" maxlength="15" value='<?php echo $_SESSION["license"]; ?>' /></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">License Issue Country :</label></div>
                        <div class="col-sm-6">
                          <select name="issuedin"  class="form-issuedin form-control"  id="issuedin">
                            <option value="" disabled selected>License Issue Country</option>
                          </select>
                        </div>  
                      </div>
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">License Expiry :</label></div>
                        <div class="col-sm-6">
                                       <!--<input type="text" placeholder="License Expiry (dd/mm/yyyy)" class="form-expire form-control col-sm-6" name="expire" id="expire" size="10" value='<?php echo $_SESSION["expire"]; ?>' />-->
                                       <span class="caldispl"><input type="hidden" id="expire" value=""></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">Address :</label></div>
                        <div class="col-sm-6"><input type="text" placeholder="Address..." class="form-address form-control col-sm-6" name="address" id="address" maxlength="50" value='<?php echo $_SESSION["address"]; ?>' /></div>
                      </div>
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">City :</label></div>
                        <div class="col-sm-6"><input type="text" placeholder="City..." class="form-city form-control col-sm-6" name="city" id="city" size="20" maxlength="20" value='<?php echo $_SESSION["city"]; ?>' /></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">State :</label></div>
                        <div class="col-sm-6"><input type="text" placeholder="State..." class="form-state form-control col-sm-6" name="txtState" id="txtState" maxlength="15" value='<?php echo $_SESSION["txtState"]; ?>' /></div>
                      </div>
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">Postcode/ZIP :</label></div>
                        <div class="col-sm-6"><input type="text" placeholder="Postcode/ZIP..." class="form-postcode form-control col-sm-6" name="postcode" id="postcode" maxlength="10" value='<?php echo $_SESSION["postcode"]; ?>' /></div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">Country :</label></div>
                        <div class="col-sm-6"><select name="country" id="country" class="form-country form-control col-sm-6">
                            <option value="" disabled selected>Country of Residence</option>
                          </select></div>
                        </div>
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">Found Us Where? :</label></div>
                        <div class="col-sm-6"><select class="form-country form-control col-sm-6" name="foundus" id="foundus"></select></div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">Area of Use? :</label></div>
                          <div class="col-sm-6"><select name="areaofuse" id="areaofuse"  class="form-country form-control col-sm-6"></select></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        <div class="col-sm-6"><label class="control-label">Transmission :</label></div>
                        <div class="col-sm-6">
                          <select name="ddlTransmission"  class="form-transmission form-control"  id="ddlTransmission">
                            <option value="0" selected>No Preference</option>
                            <option value="1" >Auto</option>
                            <option value="2" >Manual</option>
                          </select>
                        </div>  
                      </div>
                      <div class="col-sm-6">
                        <div class="col-sm-6">
                        <label class="control-label">Collection Point :</label>
                        </div>
                        <div class="col-sm-6">
                        <input type="text" placeholder="Collection Point..."  class="form-Collection-Point form-control input-mini" name="txtCollectionPoint" id="txtCollectionPoint" maxlength="50" value='' /></div>
                        </div>


                    </div>
                    <div class="row">
                                            <div class="col-sm-6">
                          <div class="col-sm-6"><label class="control-label">Comments :</label></div>
                          <div class="col-sm-6">
                            <textarea placeholder="Comments..." class="form-Comments form-control input-mini" style="height:100px;line-height:normal" name="Comments" id="Comments" maxlength="75"></textarea></div>
                          </div>

                    </div>
                   <!--  <div class="row">
                      <div class="col-sm-12">
                        <p class="text-danger">
                            <input id="chkbxTerms" type="checkbox" value="True" />
                           I understand that a debit of 20% (or the full hire if less than $100.00) will be made to the above credit card number in order to reserve my vehicle.
                            &nbsp;I understand and accept the <a href='#' target="_blank" style="font-weight:bold; ">Terms &amp; Conditions</a>.
                         </p>
                      </div>
                    </div>   -->
                  </div>
                </div>
            </div>
          </div>
        </div>
        <div class="row" id="dvbtn" style="padding-top:3px;">
          <div class="col-sm-12 form-box">
            <div class="col-sm-12" style="background-color: white;border-radius:5px; padding-top:5px; padding-bottom:5px;">
              <div class="row">
                <div class='col-sm-12  text-center'>
                  <a class='btn btn-link-small' onclick='submitBooking()' id="btnBooking">Book Now</a>&nbsp;
                  <a class='btn btn-link-small' onclick='submitQuote()' id="btnQuote">Get a Quote</a>
                </div>
            </div>
          </div>
        </div>
        </div>        
        <input type='hidden' name='vehiclecategorytypeid' id='vehiclecategorytypeid' value='<?php echo $_SESSION["vehiclecategorytypeid"]; ?>'>
        <input type='hidden' name='PickupLocationID' id='PickupLocationID' value='<?php echo $_SESSION["PickupLocationID"]; ?>'>
        <input type='hidden' name='DropOffLocationID' id='DropOffLocationID' value='<?php echo $_SESSION["DropOffLocationID"]; ?>'>
        <input type='hidden' name='PickupDate' id='PickupDate' value='<?php echo $_SESSION["PickupDate"]; ?>'>
        <input type='hidden' name='PickupTime' id='PickupTime' value='<?php echo $_SESSION["PickupTime"]; ?>'>
        <input type='hidden' name='ReturnDate' id='ReturnDate' value='<?php echo $_SESSION["ReturnDate"]; ?>'>
        <input type='hidden' name='ReturnTime' id='ReturnTime' value='<?php echo $_SESSION["ReturnTime"]; ?>'>
        <input type='hidden' name='Age' id='Age' value='<?php echo $_SESSION["Age"]; ?>'>
        <input type='hidden' name='PromoCode' id='PromoCode' value='<?php echo $_SESSION["PromoCode"]; ?>'>
        <input type='hidden' name='RateID' id='RateID' value='<?php echo $_SESSION["RateID"]; ?>'>
        <input type='hidden' name='vehiclecategoryid' id='vehiclecategoryid' value='<?php echo $_SESSION["vehiclecategoryid"]; ?>'>
        <input type='hidden' name='choosetext' id='choosetext' value='Check the following entries:'>
        <input type='hidden' name='valoldcustomer' id='valoldcustomer' value='<?php echo $_SESSION["valoldcustomer"]; ?>'>
        <input type='hidden' name='valquote' id='valquote' value='<?php echo $_SESSION["valquote"]; ?>'>
        <input type='hidden' name='valbooking' id='valbooking' value='<?php echo $_SESSION["valbooking"]; ?>'>
        <input type='hidden' name='selOptions' id='selOptions' value='<?php echo $_SESSION["selOptions"]; ?>'>
        <input type='hidden' name='CustomerData' id='CustomerData' value='<?php echo $_SESSION["CustomerData"]; ?>'>
        <input type='hidden' name='ReservationRef' id='ReservationRef' value='<?php echo $_SESSION["ReservationRef"]; ?>'>
        <input type='hidden' name='ReservationNo' id='ReservationNo' value='<?php echo $_SESSION["ReservationNo"]; ?>'>
        <input type='hidden' name='BookingType' id='BookingType' value='<?php echo $_SESSION["BookingType"]; ?>'>
        <input type='hidden' name='refid' id='refid' value='<?php echo $_SESSION["refid"]; ?>'>
        <input type='hidden' name='statusid' id='statusid' value='<?php echo $_SESSION["statusid"]; ?>'>
        <input type='hidden' name='totValue' id='totValue' value='<?php echo $_SESSION["totValue"]; ?>'>
        </form>
        <div class='row'>
          <div class="col-sm-12">

          </div>
        </div>

      </div>
    </div>

  </div>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <link href="assets/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
  <script src="assets/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>
</body>
</html>
