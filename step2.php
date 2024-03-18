<?php
if (!isset($_SESSION))
  session_start();

if (!isset($_SESSION['vehiclecategorytypeid']))
  $_SESSION["vehiclecategorytypeid"] = "";
if (!isset($_SESSION['PickupLocationID']))
  $_SESSION["PickupLocationID"] = "";
if (!isset($_SESSION['DropOffLocationID']))
  $_SESSION["DropOffLocationID"] = "";
if (!isset($_SESSION['PickupDate']))
  $_SESSION["PickupDate"] = "";
if (!isset($_SESSION['PickupTime']))
  $_SESSION["PickupTime"] = "";
if (!isset($_SESSION['ReturnDate']))
  $_SESSION["ReturnDate"] = "";
if (!isset($_SESSION['ReturnTime']))
  $_SESSION["ReturnTime"] = "";
if (!isset($_SESSION['Age']))
  $_SESSION["Age"] = "";
if (!isset($_SESSION['PromoCode']))
  $_SESSION["PromoCode"] = "";
if (!isset($_SESSION['refid']))
  $_SESSION["refid"] = "";
if (isset($_POST["form-Category-Type"]))
  $_SESSION["vehiclecategorytypeid"] = $_POST["form-Category-Type"];
if (isset($_POST["form-Pickup-Location"]))
  $_SESSION["PickupLocationID"] = $_POST["form-Pickup-Location"];
if (isset($_POST["form-Dropoff-Location"]))
  $_SESSION["DropOffLocationID"] = $_POST["form-Dropoff-Location"];
if (isset($_POST["form-Pickup-Date"]))
  $_SESSION["PickupDate"] = $_POST["form-Pickup-Date"];
if (isset($_POST["form-Pickup-Time"]))
  $_SESSION["PickupTime"] = $_POST["form-Pickup-Time"];
if (isset($_POST["form-Dropoff-Date"]))
  $_SESSION["ReturnDate"] = $_POST["form-Dropoff-Date"];
if (isset($_POST["form-Dropoff-Time"]))
  $_SESSION["ReturnTime"] = $_POST["form-Dropoff-Time"];
if (isset($_POST["form-Minimum-Age"]))
  $_SESSION["Age"] = $_POST["form-Minimum-Age"];
if (isset($_POST["form-Promo-Code"]))
  $_SESSION["PromoCode"] = $_POST["form-Promo-Code"];
if (isset($_POST["refid"]))
  $_SESSION["refid"] = $_POST["refid"];
if (isset($_GET["CTypeID"]))
  $_SESSION["vehiclecategorytypeid"] = $_GET["CTypeID"];
if (isset($_GET["PID"]))
  $_SESSION["PickupLocationID"] = $_GET["PID"];
if (isset($_GET["DID"]))
  $_SESSION["DropOffLocationID"] = $_GET["DID"];
if (isset($_GET["PDate"]))
  $_SESSION["PickupDate"] = $_GET["PDate"];
if (isset($_GET["PTime"]))
  $_SESSION["PickupTime"] = $_GET["PTime"];
if (isset($_GET["DDat"]))
  $_SESSION["ReturnDate"] = $_GET["DDat"];
if (isset($_GET["DTime"]))
  $_SESSION["ReturnTime"] = $_GET["DTime"];
if (isset($_GET["AgeID"]))
  $_SESSION["Age"] = $_GET["AgeID"];
if (isset($_GET["Promo"]))
  $_SESSION["PromoCode"] = $_GET["Promo"];
if (isset($_GET["refid"]))
  $_SESSION["refid"] = $_GET["refid"];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <script src="include/jquery.js"></script>
  <!-- <link type="text/css" href="assets/css/Extra.css" rel="stylesheet" /> -->
  <link rel="stylesheet" type="text/css" href="include/jquery.datetimepicker.css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <script type="text/javascript" language="javascript">
    //paste this code under head tag or in a seperate js file.
    // Wait for window load
    $(window).load(function () {
      // Animate loader off screen
      $(".se-pre-con").fadeOut("slow");
    });
  </script>

  <script src="include/jquery.datetimepicker.js"></script>
  <script src="include/form_validation.js"></script>
  <script src="assets/js/customjs.js" type="text/javascript"></script>
  <script type="text/javascript">
    var minDays;
    var frmvalidator;
    var getDetails = 0;
    var signScript = "signRequest.php";
    var oAPI = new rcmAPI();
    var isAfterHours = false;
    var officeOpen = "";
    var officeClose = "";

    $(document).ready(function () {
      oAPI.OnReadyStep2(DisplStep2);
      oAPI.OnLocationChange(LocUpdForm);
      oAPI.GetStep2(
        document.getElementById("vehiclecategorytypeid").value,
        document.getElementById("PickupLocationID").value,
        document.getElementById("PickupDate").value,
        document.getElementById("PickupTime").value,
        document.getElementById("DropOffLocationID").value,
        document.getElementById("ReturnDate").value,
        document.getElementById("ReturnTime").value,
        document.getElementById("Age").value,
        document.getElementById("PromoCode").value,
        getDetails
      );

      $(".clickme").click(function () {
        $("#displInfo").slideToggle("200", function () {
          // Animation complete.
        });
      });
    })

    function DisplStep2() {
      $(".se-pre-con").fadeOut("slow");
      //if need block some category type on the dropdown list, change the code below to 1st line using your own LoadCategoryType,
      //LoadCategoryType(document.getElementById("cmbCatType"), document.getElementById("vehiclecategorytypeid").value, "", true, "All");
      oAPI.LoadCategoryType(document.getElementById("cmbCatType"), document.getElementById("vehiclecategorytypeid").value, "", true, "All");
      oAPI.LoadAgeList(document.getElementById("cmbAge"), document.getElementById("Age").value);
      oAPI.LoadLocationsList(document.getElementById("cmbPickup"), document.getElementById("cmbDropOff"), document.getElementById("cmbAge"), document.getElementById("PickupLocationID").value, document.getElementById("DropOffLocationID").value, "Select Location..", "Select Location..");

      var out = "";
      var subtotal = 0.0;
      var total = 0.0;
      var ratetotal = 0.0;
      var LocID = document.getElementById("cmbPickup").value;
      var SizeID = 0;
      var CatTypeID = 0;
      var oldCatTypeID = 0;
      var CatType = "";
      var LocAvailable = true;
      var LocAvailableMsg = oAPI.CheckLocationAvailable();

      //check if selected time is afterhours
      if (document.getElementById("PickupDate").value) {
        PickUpDW = rcmGetDW(document.getElementById("PickupDate").value, "d/m/Y");
        isAfterHours = chkAfterHours(document.getElementById("PickupTime").value, document.getElementById("PickupLocationID").value, PickUpDW);
      }

      if (LocAvailableMsg != '') LocAvailable = false;
      document.getElementById("displmsg").innerHTML = LocAvailableMsg;
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

      out = "";
      for (var i = 0; i < rcmAvailableCars.length; ++i) {
        CarAvailable = true;
        var CurrencySymbol = "";
        var CurrencyName = "";
        if (rcmLocationFees[0]["currencysymbol"] != null) CurrencySymbol = rcmLocationFees[0]["currencysymbol"];
        if (rcmLocationFees[0]["currencyname"] != null) CurrencyName = rcmLocationFees[0]["currencyname"];

        if (rcmAvailableCars[i]["available"] == 0) CarAvailable = false;
        SizeID = rcmAvailableCars[i]["vehiclecategoryid"];
        CatTypeID = rcmAvailableCars[i]["vehiclecategorytypeid"];
        subtotal = parseFloat(rcmAvailableCars[i]["totalrateafterdiscount"]).toFixed(2);
        ratetotal = subtotal;
        numofdays = parseInt(rcmAvailableCars[i]["numberofdays"], 10);


        out = out + "<div class='col-4'>";
        out = out + "<div class='card rounded-lg'>";

        out = out + "<div class='col-sm-12 card-body text-center'>";
        out = out + "<div class='col-sm-12 text-center'>";
        out = out + "<div class='row'><div class='col-sm-12 text-center'><img src='https:" + rcmAvailableCars[i]["imageurl"] + "' class='' alt='' width='300' height='200'/></div></div>";
        out = out + "<div class='row'><div class='col-sm-12 text-center'>";
        out = out + "<i class='fa fa-child fa-2'></i>x" + rcmAvailableCars[i]["numberofadults"];
        out = out + "&nbsp;&nbsp;<i class='fa fa-child'></i>x" + rcmAvailableCars[i]["numberofchildren"];
        out = out + "&nbsp;&nbsp;<i class='fa fa-briefcase fa-2'></i>x" + rcmAvailableCars[i]["numberoflargecases"];
        out = out + "&nbsp;&nbsp;<i class='fa fa-briefcase'></i>x" + rcmAvailableCars[i]["numberofsmallcases"];
        out = out + "</div></div>";
        out = out + "</div>"; //col-sm-3

        out = out + "<div class='col-sm-12'>";

        out = out + "<h3 class='text-center mt-2'>" + rcmAvailableCars[i]["categoryfriendlydescription"] + "</h3>";

        out = out + "<p class='RemovePadding_p'><span class=''>" + rcmAvailableCars[i]["vehicledescription1"] + "</span></p>";
        out = out + "<p class='RemovePadding_p'><span class=''>" + rcmAvailableCars[i]["vehicledescription2"] + "</span></p>";
        out = out + "<p class='RemovePadding_p'><span class=''>" + rcmAvailableCars[i]["vehicledescription3"] + "</span></p>";
        if (rcmAvailableCars[i]["vehicledescriptionurl"] != '')
          out = out + "<p class='RemovePadding_p'><span class=''><a href='" + rcmAvailableCars[i]["vehicledescriptionurl"] + "' target='_blank'>Click for more info...</a></span>" + "</p>";

        //TODO KATE YOU WERE HERE 
        if (rcmAvailableCars[i]["numberofdays"] > 0) {
          out = out + "<p class='RemovePadding_p'><span class=''><b>" + rcmAvailableCars[i]["numberofdays"] + "</span> Rental Days | Daily Rate " + CurrencySymbol + "" + parseFloat(rcmAvailableCars[i]["discounteddailyrate"]).toFixed(2) + "</b></p>";
        } else {
          out = out + "<p class='RemovePadding_p'>" + " " + rcmAvailableCars[i]["numberofhours"] + " hours Rate " + CurrencySymbol + "" + parseFloat(rcmAvailableCars[i]["totalrateafterdiscount"]).toFixed(2) + "</p>";
        }
        if (rcmAvailableCars[i]["totaldiscountamount"] > 0) {
          ratetypedesc = ""
          if (rcmAvailableCars[i]["numberofdays"] > 0) ratetypedesc = "per day"

          if (rcmAvailableCars[i]["discounttype"] == "p") {
            out = out + "<p class='RemovePadding_p red'><span class=''>" + CurrencySymbol + "" + parseFloat(rcmAvailableCars[i]["avgrate"]).toFixed(2) + "</span> " + ratetypedesc + " less " + parseFloat(rcmAvailableCars[i]["discountrate"]).toFixed(2) + "% discount</p>";
          }
          else if (rcmAvailableCars[i]["discounttype"] == "d") {
            out = out + "<p class='RemovePadding_p red'><span class=''>" + CurrencySymbol + "" + parseFloat(rcmAvailableCars[i]["avgrate"]).toFixed(2) + "</span> " + ratetypedesc + " less " + CurrencySymbol + "" + parseFloat(rcmAvailableCars[i]["discountrate"]).toFixed(2) + " per day discount</p>";
          }
          else if (rcmAvailableCars[i]["discounttype"] == "f") {
            out = out + "<p class='RemovePadding_p red'><span class=''>" + CurrencySymbol + "" + parseFloat(rcmAvailableCars[i]["avgrate"]).toFixed(2) + "</span> less " + CurrencySymbol + "" + parseFloat(rcmAvailableCars[i]["discountrate"]).toFixed(2) + " discount</p>";
          }
        }
        // FreeDays
        if (rcmAvailableCars[i]["freedays"] > 0) {
          out = out + "<p class='RemovePadding_p'><span class='glyphicon glyphicon-plus-sign'></span><span class=''> You qualify for " + rcmAvailableCars[i]["freedays"] + " Free day(s) special</span>" + "</p>";
          //subtotal = subtotal - parseFloat(rcmAvailableCars[i]["avgrate"]) * parseFloat(rcmAvailableCars[i]["freedays"]);
          subtotal = subtotal - parseFloat(rcmAvailableCars[i]["freedaysamount"]);
        }
        //END RATES

        total = parseFloat(subtotal);
        // Mandatory Extra Fees
        for (j in rcmMandatoryFees) {
          if ((rcmMandatoryFees[j]["vehiclecategoryid"] == SizeID || rcmMandatoryFees[j]["vehiclecategoryid"] == "0")) {
            if (rcmMandatoryFees[j]["type"] == "Daily") {
              out = out + "<p class='RemovePadding_p'><span class='glyphicon glyphicon-plus-sign'></span>&nbsp;" + rcmMandatoryFees[j]["name"] + " @ " + CurrencySymbol + "" + parseFloat(rcmMandatoryFees[j]["fees"]).toFixed(2) + " Per Day: " + CurrencySymbol + "" + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]).toFixed(2) + "</p>";
              total = parseFloat(total) + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]);
              subtotal = parseFloat(subtotal) + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]);
            } else {
              out = out + "<p class='RemovePadding_p'><span class='glyphicon glyphicon-plus-sign'></span>&nbsp; " + CurrencySymbol + "" + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]).toFixed(2) + " FOR " + rcmMandatoryFees[j]["name"] + "</p>";
              total = parseFloat(total) + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]);
              subtotal = parseFloat(subtotal) + parseFloat(rcmMandatoryFees[j]["totalfeeamount"]);
            }
          }
        }

        if (LocAvailable == true && CarAvailable == true) {
          if (rcmAvailableCars[i]["available"] == 1) {
            out = out + "<p class='RemovePadding_p'><b>" + rcmAvailableCars[i]["availablemessage"] + "</b></p>";
          }
          if (rcmAvailableCars[i]["available"] == 2) {
            out = out + "<p class='RemovePadding_p'><span class='text-danger'><b>" + rcmAvailableCars[i]["availablemessage"] + "</b></span></p>";
          }
        } else if (CarAvailable == false) {
          out = out + "<p class='RemovePadding_p'><span class='text-danger'><b>" + rcmAvailableCars[i]["availablemessage"] + "</b></span>" + "</p>";
        }
        out = out + "</div>"; // Web-desc Div


        out = out + "<div class='col-sm-12'>";
        if (LocAvailable == true && CarAvailable == true) {
          out = out + "<div class='row'><div class='col-sm-12 col-md-7' id='totalCostFinal'><span class='results-price'> TOTAL &nbsp;  " + CurrencyName + " " + CurrencySymbol + "" + parseFloat(total).toFixed(2) + "</span></div>";
          out = out + "<div class='col-sm-12 col-md-5' Id='dvbooknow'><button class='btn btn-dark' onclick='booknow(" + rcmAvailableCars[i]["carrateid"] + "," + rcmAvailableCars[i]["vehiclecategoryid"] + ")'><span class='glyphicon glyphicon-ok'></span>&nbsp;Select</button></div></div>";
        }
        out = out + "</div>";
        out = out + "</div>";
        out = out + "</div>"; //col-sm-12 where background
        out = out + "</div>"; // New row class inside loop
      }


      var rowContainer = document.getElementById("cards-row"); 
      if (rowContainer) {
        rowContainer.innerHTML = out; 
      }

      document.getElementById("availablecars").innerHTML = out;
      $('#txtPickupTime').datetimepicker({
        datepicker: false,
        mask: true,
        format: 'H:i',
        closeOnDateSelect: true,
        step: 30,
        onChangeDateTime: function (ct, $i) {
          $i.datetimepicker('hide');
        }
      });
      if (document.getElementById("txtPickupTime").value == '__:__') $('#txtPickupTime').val("10:00");
      $('#txtReturnTime').datetimepicker({
        datepicker: false,
        mask: true,
        format: 'H:i',
        closeOnDateSelect: true,
        step: 30,
        onChangeDateTime: function (ct, $i) {
          $i.datetimepicker('hide');
        }
      });
      if (document.getElementById("txtReturnTime").value == '__:__') $('#txtReturnTime').val("10:00");

      var pickUpID = document.getElementById("cmbPickup").value;
      var startPickup = Math.ceil(oAPI.GetNoticePeriod(pickUpID));
      var startDropOff = eval(startPickup + '+' + oAPI.MinBookingDay(pickUpID));

      // Set Offset to init pickup and drop-off but make sure offset does not result in a sunday
      var PickUpOffset = (rcmGetDW(rcmGetdate(startPickup + 1), "d/m/Y") == 1) ? 2 : 1;
      var DropOffOffset = (rcmGetDW(rcmGetdate(startDropOff + 7), "d/m/Y") == 1) ? 8 : 7;

      $('#txtPickup').datetimepicker({
        timepicker: false,
        mask: true,
        format: 'd/m/Y',
        formatDate: 'd/m/Y',
        scrollInput: false,
        closeOnDateSelect: true,
        minDate: rcmGetdate(startPickup),
        onChangeDateTime: function (dp, $input) {
          $('#txtReturn').val(geFutureDate($input.val(), 7));
        }
      });
      if (document.getElementById("txtPickup").value == '__/__/____' && '<?php echo $_SESSION["PickupDate"]; ?>' == '') $('#txtPickup').val(rcmGetdate(startPickup + PickUpOffset));
      $('#txtReturn').datetimepicker({
        timepicker: false,
        mask: true,
        format: 'd/m/Y',
        formatDate: 'd/m/Y',
        scrollInput: false,
        closeOnDateSelect: true,
        minDate: rcmGetdate(startDropOff)
      });
      if (document.getElementById("txtReturn").value == '__/__/____' && '<?php echo $_SESSION["ReturnDate"]; ?>' == '') $('#txtReturn').val(rcmGetdate(startDropOff + DropOffOffset));
      var PickUpDW = 0;
      var DropOffDW = 0;
      // Get Day of the week using function rcmGetDW(<datestring>,<format>)
      if (document.getElementById("txtPickup").value != '' && document.getElementById("txtPickup").value != '__/__/____') {
        PickUpDW = rcmGetDW(document.getElementById("txtPickup").value, "d/m/Y");
      }
      if (document.getElementById("txtReturn").value != '' && document.getElementById("txtReturn").value != '__/__/____') {
        DropOffDW = rcmGetDW(document.getElementById("txtReturn").value, "d/m/Y");
      }
      $('#txtPickupTime').datetimepicker({
        minTime: oAPI.MinTimePickup(pickUpID, PickUpDW),
        maxTime: oAPI.MaxTimePickup(pickUpID, PickUpDW)
      });
      $('#txtReturnTime').datetimepicker({
        minTime: oAPI.MinTimeDropOff(document.getElementById("cmbDropOff").value, DropOffDW),
        maxTime: oAPI.MaxTimeDropOff(document.getElementById("cmbDropOff").value, DropOffDW)
      });
      window.location.href = "#results";
    }
    // End function DisplStep2

    function getLocations() {
      oAPI.LoadLocationsList(document.getElementById("cmbPickup"), document.getElementById("cmbDropOff"), document.getElementById("cmbAge"));
    }
    function LocUpdForm() {
      var pickUpID = document.getElementById("cmbPickup").value;

      var startPickup = Math.ceil(oAPI.GetNoticePeriod(pickUpID));
      var startDropOff = eval(startPickup + '+' + oAPI.MinBookingDay(pickUpID));
      var PickUpDW = 0;
      var DropOffDW = 0;
      // Get Day of the week using function rcmGetDW(<datestring>,<format>)
      if (document.getElementById("txtPickup").value != '' && document.getElementById("txtPickup").value != '__/__/____') {
        PickUpDW = rcmGetDW(document.getElementById("txtPickup").value, "d/m/Y");
      }
      if (document.getElementById("txtReturn").value != '' && document.getElementById("txtReturn").value != '__/__/____') {
        DropOffDW = rcmGetDW(document.getElementById("txtReturn").value, "d/m/Y");
      }

      $('#txtPickup').datetimepicker({
        minDate: rcmGetdate(startPickup)
      });
      $('#txtReturn').datetimepicker({
        minDate: rcmGetdate(startDropOff)
      });
      $('#txtPickupTime').datetimepicker({
        minTime: oAPI.MinTimePickup(pickUpID, PickUpDW),
        maxTime: oAPI.MaxTimePickup(pickUpID, PickUpDW)
      });
      $('#txtReturnTime').datetimepicker({
        minTime: oAPI.MinTimeDropOff(document.getElementById("cmbDropOff").value, DropOffDW),
        maxTime: oAPI.MaxTimeDropOff(document.getElementById("cmbDropOff").value, DropOffDW)
      });
    }
    function DoRefresh() {
      $('#Imhere').removeClass('Addborder');
      // Save New Values
      var test = true;
      var testmsg = "";
      var pickUpID = document.getElementById("cmbPickup").value;

      var startPickup = oAPI.GetNoticePeriod(pickUpID);
      minDays = oAPI.MinBookingDay(pickUpID);
      var startDropOff = eval(startPickup + '+' + minDays);
      var chkPickup = rcmGetdate(startPickup);
      var chkDropOff = rcmGetdate(startDropOff);
      var chkDiff = rcmDayDiff("txtReturn", "txtPickup", "d/m/Y");
      if (chkDiff == 0 && document.getElementById("txtReturnTime").value <= document.getElementById("txtPickupTime").value) {
        test = false;
        testmsg = testmsg + "Drop off time smaller or the same as Pickup time, need to select a valid time period for rentals!\n";
      }
      if (rcmStrToDate(document.getElementById("txtPickup").value, "d/m/Y") < rcmStrToDate(chkPickup, "d/m/Y")) {
        test = false;
        testmsg = testmsg + "\nEarliest date for rental is: " + chkPickup;
        document.getElementById("txtPickup").style.borderColor = "red";
      }
      if (rcmDayDiff("txtReturn", "txtPickup", "d/m/Y") < 0) {
        test = false;
        testmsg = "Return Date can not be smaller then Pickup Date";
        document.getElementById("txtPickup").style.borderColor = "red";
        document.getElementById("txtReturn").style.borderColor = "red";
      }
      if (document.getElementById("cmbCatType").value == "") {
        test = false;
        testmsg = testmsg + "Please select a Valid Category Type!\n";
        document.getElementById("cmbCatType").style.borderColor = "red";
      }
      if (document.getElementById("cmbAge").value == "") {
        test = false;
        testmsg = testmsg + "Please select a Valid Youngest Driver Age!\n";
        document.getElementById("cmbAge").style.borderColor = "red";
      }
      if (test == true) {
        //$('div').attr('style', '');
        $("form").each(function () {
          $(this).find(':input').css('borderColor', ''); //<-- Should return all input elements in that specific form.
        });
        document.getElementById("vehiclecategorytypeid").value = document.getElementById("cmbCatType").value;
        document.getElementById("PickupLocationID").value = document.getElementById("cmbPickup").value;
        document.getElementById("PickupDate").value = document.getElementById("txtPickup").value;
        document.getElementById("PickupTime").value = document.getElementById("txtPickupTime").value;
        document.getElementById("DropOffLocationID").value = document.getElementById("cmbDropOff").value;
        document.getElementById("ReturnDate").value = document.getElementById("txtReturn").value;
        document.getElementById("ReturnTime").value = document.getElementById("txtReturnTime").value;
        document.getElementById("Age").value = document.getElementById("cmbAge").value;

        oAPI.GetStep2(
          document.getElementById("vehiclecategorytypeid").value,
          document.getElementById("PickupLocationID").value,
          document.getElementById("PickupDate").value,
          document.getElementById("PickupTime").value,
          document.getElementById("DropOffLocationID").value,
          document.getElementById("ReturnDate").value,
          document.getElementById("ReturnTime").value,
          document.getElementById("Age").value,
          document.getElementById("PromoCode").value,
          getDetails
        );
      } else {
        // $('#fat-btn').removeClass('has-spinner');
        // BootstrapDialog.show({
        //   type: BootstrapDialog.TYPE_DANGER,
        //   title: 'Oops you are missing something: ',
        //   buttons: [{
        //     label: 'Close',
        //     cssClass: 'btn-danger',
        //     action: function (dialogItself) {
        //       dialogItself.close();
        //     }
        //   }],
        //   draggable: true,
        //   message: testmsg
        // });
        var myModal = new bootstrap.Modal(document.getElementById('myModal'));
        myModal.show();
      };
    }
    function booknow(rateid, sizeid) {
      // Save New Values
      document.getElementById("RateID").value = rateid;
      document.getElementById("vehiclecategoryid").value = sizeid;
      document.getElementById("vehiclecategorytypeid").value = document.getElementById("cmbCatType").value;
      document.getElementById("PickupLocationID").value = document.getElementById("cmbPickup").value;
      document.getElementById("PickupDate").value = document.getElementById("txtPickup").value;
      document.getElementById("PickupTime").value = document.getElementById("txtPickupTime").value;
      document.getElementById("ReturnDate").value = document.getElementById("txtReturn").value;
      document.getElementById("ReturnTime").value = document.getElementById("txtReturnTime").value;
      document.getElementById("Age").value = document.getElementById("cmbAge").value;
      document.getElementById("frmStep2").submit();
    }
    function showInfo(mode) {
      if (mode == 0)
        document.getElementById("displInfo").style.display = "none";
      else
        document.getElementById("displInfo").style.display = "";
    }
    function geFutureDate(date_input, no_of_days) {
      //debugger;
      var parts = date_input.split('/');
      //please put attention to the month (parts[0]), Javascript counts months from 0:
      // January - 0, February - 1, etc
      //YYYY-MM-DD
      var mydate = new Date(parts[2], parts[1] - 1, parts[0]);
      var from_date = mydate;
      var time_after_7_days = new Date(from_date).setDate(from_date.getDate() + no_of_days);
      return convertDate(new Date(time_after_7_days));
    }
    function convertDate(inputFormat) {
      function pad(s) { return (s < 10) ? '0' + s : s; }
      var d = new Date(inputFormat);
      return [pad(d.getDate()), pad(d.getMonth() + 1), d.getFullYear()].join('/');
    }

    function chkAfterHours(pickupTime, LocID, dw) {
      var retval = false;

      for (i in rcmOfficeTimes) {
        if (rcmOfficeTimes[i]["locid"] == LocID) {
          if (rcmOfficeTimes[i]["wd"] == dw) {
            officeOpen = rcmOfficeTimes[i]["openingtime"];
            officeClose = rcmOfficeTimes[i]["closingtime"];
          }
        }
      }
      if (retval == false) {
        for (i in rcmLocationInfo) {
          if (rcmLocationInfo[i]["pickupavailable"] == true) {
            if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbooking"] == "False") {
              officeOpen = rcmLocationInfo[i]["officeopeningtime"];
              officeClose = rcmLocationInfo[i]["officeclosingtime"];
            }
          }
        }
      }
      if (officeOpen != "" && officeClose != "") {
        var dtOpen = Date.parse("01/01/2011 " + officeOpen);
        var dtClose = Date.parse("01/01/2011 " + officeClose);
        var dtChk = Date.parse("01/01/2011 " + pickupTime);
        if (dtChk < dtOpen || dtChk > dtClose) retval = true;
      }
      return retval;
    }
    function LoadCategoryType(obj, valObj, IntroItem, selAll, txtAll) {
      var selObj;
      var OldIndex = obj.selectedIndex;
      if (OldIndex >= 0) selObj = obj.value;
      if (txtAll === undefined) txtAll = "*";

      ClearList(obj);
      if (IntroItem !== undefined && IntroItem !== "") {
        obj.options[obj.options.length] = new Option(IntroItem, "");
        obj.options[obj.options.length - 1].disabled = true;
      }
      if (selAll !== undefined && selAll == true) {
        if (txtAll === undefined || txtAll === "") txtAll = "All";
        obj.options[obj.options.length] = new Option(txtAll, "0");
        if (valObj == '0') obj.options[obj.options.length - 1].selected = true;
      }
      obj.options[obj.options.length] = new Option('Special rentals', "25,26");
      if (valObj == "25,26") obj.options[obj.options.length - 1].selected = true;

      for (i in rcmCategoryTypeInfo) {
        obj.options[obj.options.length] = new Option(rcmCategoryTypeInfo[i]["categorytype"], rcmCategoryTypeInfo[i]["id"]);
        if (rcmCategoryTypeInfo[i]["id"] == valObj) obj.options[obj.options.length - 1].selected = true;
      }
      //Remember last selection in case valObj is not assigned
      if (!valObj && rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
    }
    //General Function
    function ClearList(obj) {
      while (obj.options.length > 0) {
        obj.remove(0);
      }
    }
  </script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Step 2</title>
  <!-- CSS -->
  <!-- <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css"> -->
  <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="assets/css/form-elements.css">
  <link rel="stylesheet" href="assets/css/style.css"> -->

  <style>
    .car-bg {
      background: url(https://previews.123rf.com/images/klyaksun/klyaksun2008/klyaksun200800184/153717360-car-rental-banner-service-for-rent-vehicle-lease-auto-vector-landing-page-of-dealership-with.jpg);
      background-repeat: no-repeat;
      background-size: 100% 120%;
    }
  </style>
</head>

<body>
  <div class="se-pre-con"></div>

  <div class="top-content">

    <div class="inner-bg">
      <div class="bg-dark car-bg" style="padding: 70px 300px">
        <!-- <div class="row">
          <div class="col-sm-12">
            <div id="progress-bar">
              <div id="progress-bar-steps">
                <div class="progress-bar-step done" id="Imhere">
                  <a href="index.php">
                  <div class="step_number">1</div>
                  <div class="step_name">Step 1</div></a>
                </div>
                <div class="progress-bar-step current">
                  <div class="step_number">2</div>
                  <div class="step_name">Step 2</div>
                </div>
                <div class="progress-bar-step">
                  <div class="step_number">3</div>
                  <div class="step_name">Step 3</div>
                </div>
                <div class="progress-bar-step">
                  <div class="step_number">4</div>
                  <div class="step_name">Step 4</div>
                </div>
                <div class="progress-bar-step last">
                  <div class="step_number">5</div>
                  <div class="step_name">Step 5</div>
                </div>
              </div>
              <div class="clear"></div>
            </div>
          </div>
        </div> -->
        <div class="row">
          <div class="col-sm-12 form-box">
            <p class="bg-error" id='1displmsg'></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 card p-4">
            <div class="form-bottom">
              <form id="frmStep2" role="form" name="frmStep2" action="step3.php" method="post">
                <div class="row">
                  <div class="col-sm-2 mb-3">
                    <label class="col-sm-12 margin0" for="form-Pickup-Date">Pickup: </label>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <select id="cmbPickup" name="form-Pickup-Location" class="col-sm-12 form-control"
                      onchange="LocUpdForm()"></select>
                  </div>
                  <div class="col-sm-2 mb-3">
                    <label class="col-sm-12 margin0" for="form-Pickup-Date">Date & Time: </label>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <input type="text" name="form-Pickup-Date" value='<?php echo $_SESSION["PickupDate"]; ?>'
                      placeholder="Pickup-Date..." class="form-control col-sm-12" id="txtPickup" autocomplete="off"
                      onchange="LocUpdForm()">
                  </div>
                  <div class="col-sm-2 mb-3">
                    <input type="text" name="form-Pickup-Time" value='<?php echo $_SESSION["PickupTime"]; ?>'
                      placeholder="Pickup-Time..." class="form-control col-sm-12" id="txtPickupTime" autocomplete="off">
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-2 mb-3">
                    <label class="col-sm-12 margin0" for="form-Dropoff-Location">Return: </label>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <select id="cmbDropOff" name="form-Dropoff-Location" class="col-sm-12 form-control"
                      onchange="LocUpdForm()"></select>
                  </div>
                  <div class="col-sm-2 mb-3">
                    <label class="col-sm-12 margin0" for="form-Dropoff-Date">Date & Time: </label>
                  </div>
                  <div class="col-sm-3 mb-3">
                    <input type="text" name="form-Dropoff-Date" value='<?php echo $_SESSION["ReturnDate"]; ?>'
                      placeholder="Dropoff-Date..." class="form-control col-sm-12" id="txtReturn" autocomplete="off"
                      onchange="LocUpdForm()">
                  </div>
                  <div class="col-sm-2 mb-3">
                    <input type="text" name="form-Dropoff-Time" value='<?php echo $_SESSION["ReturnTime"]; ?>'
                      placeholder="Dropoff-Time..." class="form-control col-sm-12" id="txtReturnTime"
                      autocomplete="off">
                  </div>
                </div>

                <div class="row">
                  <div class="col-sm-2 margin0">
                    <label class="col-sm-12 margin0" for="form-Category-Type">Vehicle Type: </label>
                  </div>
                  <div class="col-sm-3 margin0">
                    <select id="cmbCatType" name="form-Category-Type" class="col-sm-12 form-control">
                      <!--<option value="" disabled selected>Select your Pickup Location</option>-->
                    </select>
                  </div>
                  <div class="col-sm-2 margin0">
                    <label class="col-sm-12 margin0" for="form-Minimum-Age">Driver Age (min): </label>
                  </div>
                  <div class="col-sm-3 margin0">
                    <select id="cmbAge" name="form-Minimum-Age" class="col-sm-12 form-control"
                      onchange="getLocations()">
                    </select>
                  </div>
                  <div class="col-sm-2 margin0">
                  </div>
                  <div class="col-sm-2 margin0">
                  </div>
                  <div class="col-sm-12 text-end">
                    <button type="button" class="btn btn-dark btn-xs" onclick="DoRefresh()">Continue</button>
                  </div>
                </div>
                <input type="hidden" name='vehiclecategorytypeid' id='vehiclecategorytypeid'
                  value='<?php echo $_SESSION["vehiclecategorytypeid"]; ?>'>
                <input type='hidden' name='PickupLocationID' id='PickupLocationID'
                  value='<?php echo $_SESSION["PickupLocationID"]; ?>'>
                <input type='hidden' name='DropOffLocationID' id='DropOffLocationID'
                  value='<?php echo $_SESSION["DropOffLocationID"]; ?>'>
                <input type='hidden' name='PickupDate' id='PickupDate' value='<?php echo $_SESSION["PickupDate"]; ?>'>
                <input type='hidden' name='PickupTime' id='PickupTime' value='<?php echo $_SESSION["PickupTime"]; ?>'>
                <input type='hidden' name='ReturnDate' id='ReturnDate' value='<?php echo $_SESSION["ReturnDate"]; ?>'>
                <input type='hidden' name='ReturnTime' id='ReturnTime' value='<?php echo $_SESSION["ReturnTime"]; ?>'>
                <input type='hidden' name='Age' id='Age' value='<?php echo $_SESSION["Age"]; ?>'>
                <input type='hidden' name='PromoCode' id='PromoCode' value='<?php echo $_SESSION["PromoCode"]; ?>'>
                <input type='hidden' name='RateID' id='RateID' value=''>
                <input type='hidden' name='vehiclecategoryid' id='vehiclecategoryid' value=''>
                <input type='hidden' name='refid' id='refid' value='<?php echo $_SESSION["refid"]; ?>'>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class='container form-box'>
        <div class="row">
          <div class="col-sm-12 form-box">
            <p class="bg-error" id='displmsg'></p>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 form-box">
            <a name="results"></a>
            <div id="availablecars" class='row gy-4'></div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">&nbsp;</div>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-danger" id="exampleModalLabel">Oops, you are missing something:</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p id="modal-message">Please Fill Form Correctly</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Javascript -->
  <!-- <script src="assets/bootstrap/js/bootstrap.min.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/scripts.js"></script>
  <link href="assets/bootstrap-dialog/css/bootstrap-dialog.min.css" rel="stylesheet" type="text/css" />
  <script src="assets/bootstrap-dialog/js/bootstrap-dialog.min.js"></script>

</body>

</html>