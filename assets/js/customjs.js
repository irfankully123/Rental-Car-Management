//  Copyright RCM - RentalCarManager.com 2015, all rights reserved!
var rcmVersion = "3.2";
var rcmMode = "";
var rcmAPIUrl = "https://apis.rentalcarmanager.com/booking/v3.2";
var rcmNeedSignature = true;
var rcmTaxInclusive = false;
var rcmTaxRate = 0.1;
var rcmStateTax = 0.0;
var rcmErr = "";
var rcmMsg = "";
var rcmDebug = "";
var rcmAlert = "";
var rcmToken = "";
var rcmSession = "";
var rcmURL = "";
var rcmKey = "QXVFYXp5Q2FyUmVudGFsczY4OVt1bmRlZmluZWRdfFNpZW5uYUNyZWF0aXZlRGlnaXRhbHx0R1BBTnZLdA==";
var rcmURLObjID = "";
var rcmCampaignCode = "";
var rcmCustomerID = "";
var rcmNewsLetter = 0;
var rcmReservationRef = "";
var rcmReservationNo = "";
var rcmDateFormat = "d/m/Y";
var rcmPaymentSaved = false;
var rcmTransmission = [{ "No Preference": 0, "Auto": 1, "Manual": 2 }];
var rcmLocationInfo = [];
var rcmLocationDetails = [];
var rcmOfficeTimes = [];
var rcmCategoryTypeInfo = [];
var rcmDriverAgesInfo = [];
var rcmLocationFees = [];
var rcmAvailableCarDetails = [];
var rcmAvailableCars = [];
var rcmAvailableCars_p = [];
var rcmMandatoryFees = [];
var rcmMandatoryFees_p = [];
var rcmOptionalFees = [];
var rcmOptionalFees_p = [];
var rcmInsuranceOptions = [];
var rcmInsuranceOptions_p = [];
var rcmKmCharges = [];
var rcmKmCharges_p = [];
var rcmSeasonalRates = [];
var rcmUserData = [];
var rcmRentalSource = [];
var rcmCountries = [];
var rcmAreaOfUse = [];
var rcmWebItems = [];
var rcmCustomerData = [{ "firstname": "", "lastname": "", "email": "", "phone": "", "mobile": "", "dateofbirth": "", "licenseno": "", "licenseissued": "", "licenseexpires": "", "address": "", "city": "", "state": "", "postcode": "", "countryid": "", "fax": "","companycode":""}];
var rcmCustomerDataOK = false;
var rcmSelOptionalFees = [];
var rcmSelTransmission = 0;
var rcmSelInsurance = 0;
var rcmSelExtraKms = 0;
var rcmAgentInfo = [];
var rcmBookingInfo = [];
var rcmCustomerInfo = [];
var rcmCompanyInfo = [];
var rcmRateInfo = [];
var rcmExtraFees = [];
var rcmPaymentInfo = [];
var rcmAgentBookings = [];
var rcmCancelReasons = [];
var rcmCancelInfo = [];
var fnCallBack;
var fnCallBackStep1;
var fnCallBackStep2;
var fnCallBackStep3;
var fnCallBackCancelReasons;
var fnCallCancelDone;
var fnCallBackWebItems;
var fnCallBookingDone;
var fnCallPaymentDone;
var fnLocationChange;
var fnCallBackGetUser;
var fnCallBackGetURL;
var fnCallBackBookingInfo;
var fnCallBackLocationDetails;
var fnCallBackAgentBookings;
var fnCallBackExtraDriver;

var fnAlerts;

var rcm_email_pat = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*([,;]\s*\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*)*$/i;
var rcm_hasnonumbers = /[^\d]/;
var rcm_number = /^[0-9]+$/;
var rcm_text = /[^\w\s\-\+!?@.,\/\#\(\)\u0080-\uA000]/gi;
var rcm_alphanum_pat = /[^\w\s\-\+,\.\u0080-\uA000]/i;

String.prototype.startsWith = function (prefix) {
	return this.indexOf(prefix) === 0;
};

String.prototype.endsWith = function (suffix) {
	return this.match(suffix + "$") == suffix;
};
String.prototype.chkDateFormat = function () {
	var retval = this;
	// Make sure we get next date format d/m/Y before we call API
	if (retval!="" && rcmDateFormat == "m/d/Y") {
		var arr = retval.split("/");
		retval = arr[1] + "/" + arr[0] + "/" + arr[2];
	}
	retval=retval.replace(/\//g, "_");
	return retval;
};
function rcmAPI() {
	// Main Methods
	this.GetStep1 = _rcm_getStep1;
	this.GetStep2 = _rcm_getStep2;
	this.GetStep3 = _rcm_getStep3;
	this.MakeBooking = _rcm_MakeBooking;
	this.MakePayment = _rcm_MakePayment;
	this.ConfirmPayment = _rcm_ConfirmPayment;
	this.GetUser = _rcm_GetUser;
	this.GetURL = _rcm_GetURL;
	this.GetCancelReasons = _rcm_GetCancelReasons;
	this.CancelBooking = _rcm_CancelBooking;
	this.GetWebItems = _rcm_GetWebItems;
	this.GetBookingInfo = _rcm_GetBookingInfo;
	this.EditBooking = _rcm_EditBooking;
	this.GetLocationDetails = _rcm_GetLocationDetails;
	this.GetAgentBookings = _rcm_GetAgentBookings;
	this.ExtraDriver = _rcm_ExtraDriver;
	this.ajaxCall = ajaxCall;

	// Setup Function Calls
	this.OnReady = _rcm_OnReady;
	this.OnReadyStep1 = _rcm_OnReadyStep1;
	this.OnReadyStep2 = _rcm_OnReadyStep2;
	this.OnReadyStep3 = _rcm_OnReadyStep3;
	this.OnReadyCancelReasons = _rcm_OnReadyCancelReasons;
	this.OnCancelDone = _rcm_OnCancelDone;
	this.OnReadyWebItems = _rcm_OnReadyWebItems;
	this.OnBookingDone = _rcm_OnBookingDone;
	this.OnPaymentDone = _rcm_OnPaymentDone;
	this.OnReadyGetUser = _rcm_OnReadyGetUser;
	this.OnLocationChange = _rcm_OnLocationChange;
	this.OnReadyGetURL = _rcm_OnReadyGetURL;
	this.OnReadyGetBookingInfo = _rcm_OnReadyGetBookingInfo;
	this.OnReadyGetLocationDetails = _rcm_OnReadyGetLocationDetails;
	this.OnReadyGetAgentBookings = _rcm_OnReadyGetAgentBookings;
	this.OnReadyExtraDriver = _rcm_OnReadyExtraDriver;
	this.OnAlerts = _rcm_OnAlerts;

	// Methods to load Lists 
	this.LoadPickupList = _rcm_LoadPickupList;
	this.LoadDropOffList = _rcm_LoadDropOffList;
	this.LoadLocationsList = _rcm_LoadLocationsList;
	this.LoadAgeList = _rcm_LoadAgeList;
	this.LoadRentalSource = _rcm_LoadRentalSource;
	this.LoadAreaOfUse = _rcm_LoadAreaOfUse;
	this.LoadCategoryType = _rcm_LoadCategoryType;
	this.LoadCountries = _rcm_LoadCountries;

	// Methods to get a value
	this.GetNoticePeriod = _rcm_GetNoticePeriod;
	this.CheckLocationAvailable = _rcm_CheckLocationAvailable;
	this.CheckCustomerDataOK = _rcm_CheckCustomerDataOK;
	this.CheckPaymentSaved = _rcm_CheckPaymentSaved;

	this.GetAge = _rcm_GetAge;
	this.GetCountry = _rcm_GetCountry;
	this.GetCategoryType = _rcm_GetCategoryType;
	this.GetAgeID = _rcm_GetAgeID;
	this.TaxInclusive = _rcm_TaxInclusive;
	this.ReservationRef = _rcm_ReservationRef;
	this.ReservationNo = _rcm_ReservationNo;

	this.MinTimePickup = _rcm_MinTimePickup;
	this.MinTimeDropOff = _rcm_MinTimeDropOff;
	this.MaxTimePickup = _rcm_MaxTimePickup;
	this.MaxTimeDropOff = _rcm_MaxTimeDropOff;
	this.MinBookingDay = _rcm_MinBookingDay;
	this.OfficeOpen = _rcm_OfficeOpen;
	this.OfficeClose = _rcm_OfficeClose;

	// Methods for Data management
	this.SetMode = _rcm_setMode;
	this.APIUrl = _rcm_APIUrl;
	this.AddToOptionalItems = _rcm_AddToOptionalItems;
	this.ClearOptionalItems = _rcm_ClearOptionalItems;
	this.GetOptionalItems = _rcm_GetOptionalItems;
	this.InitOptionalItems = _rcm_InitOptionalItems;
	this.InitCustomerData = _rcm_InitCustomerData;
	this.SetCustomerData = _rcm_SetCustomerData;
	this.GetCustomerData = _rcm_GetCustomerData;
	this.ClearCustomerData = _rcm_ClearCustomerData;
	this.SetTransmission = _rcm_SetTransmission;
	this.SetInsurance = _rcm_SetInsurance;
	this.SetExtraKms = _rcm_SetExtraKms;
	this.SetNewsletter = _rcm_SetNewsletter;

	//Methods to set Customer field data
	this.SetFirstName = _rcm_SetFirstName;
	this.SetLastName = _rcm_SetLastName;
	this.SetEmail = _rcm_SetEmail;
	this.SetPhone = _rcm_SetPhone;
	this.SetMobile = _rcm_SetMobile;
	this.SetDOB = _rcm_SetDOB;
	this.SetLicenseNo = _rcm_SetLicenseNo;
	this.SetLicenseIssuedIn = _rcm_SetLicenseIssuedIn;
	this.SetLicenseExpires = _rcm_SetLicenseExpires;
	this.SetAddress = _rcm_SetAddress;
	this.SetCity = _rcm_SetCity;
	this.SetState = _rcm_SetState;
	this.SetPostcode = _rcm_SetPostcode;
	this.SetCountry = _rcm_SetCountry;
	this.SetFax = _rcm_SetFax;
	this.SetFoundus = _rcm_SetFoundus;
	this.SetRemarks = _rcm_SetRemarks;
	this.SetNoTraveling = _rcm_SetNoTraveling;
	this.SetFlightNo = _rcm_SetFlightNo;
	this.SetFlightNoOut = _rcm_SetFlightNoOut;
	this.SetSetCollectionPoint = _rcm_SetCollectionPoint;
	this.SetReturnPoint = _rcm_SetReturnPoint;
	this.SetAreaOfUse = _rcm_SetAreaOfUse;
	this.SetDateFormat = _rcm_SetDateFormat;

	//Methods to get Customer field data
	this.GetFirstName = _rcm_GetFirstName;
	this.GetLastName = _rcm_GetLastName;
	this.GetEmail = _rcm_GetEmail;
	this.GetPhone = _rcm_GetPhone;
	this.GetMobile = _rcm_GetMobile;
	this.GetDOB = _rcm_GetDOB;
	this.GetLicenseNo = _rcm_GetLicenseNo;
	this.GetLicenseIssuedIn = _rcm_GetLicenseIssuedIn;
	this.GetLicenseExpires = _rcm_GetLicenseExpires;
	this.GetAddress = _rcm_GetAddress;
	this.GetCity = _rcm_GetCity;
	this.GetState = _rcm_GetState;
	this.GetPostcode = _rcm_GetPostcode;
	this.GetCountryID = _rcm_GetCountryID;
	this.GetFax = _rcm_GetFax;
	this.GetFoundusID = _rcm_GetFoundusID;
	this.GetRemarks = _rcm_GetRemarks;
	this.GetNoTraveling = _rcm_GetNoTraveling;
	this.GetFlightNo = _rcm_GetFlightNo;
	this.GetFlightNoOut = _rcm_GetFlightNoOut;
	this.GetCollectionPoint = _rcm_GetCollectionPoint;
	this.GetReturnPoint = _rcm_GetReturnPoint;
	this.GetAreaOfUse = _rcm_GetAreaOfUse;
	this.GetDateFormat = _rcm_GetDateFormat;
	this.GetInsurance = _rcm_GetInsurance;
	this.GetExtraKms = _rcm_GetExtraKms;

	this.GetTax = _rcm_GetTax;
	this.GetStateTax = _rcm_GetStateTax;
	this.GetSession = _rcm_GetSession;

	// Methods for system info
	this.DebugInfo = _rcm_DisplDebug;
	this.Msg = _rcm_DisplMsg;
	this.Error = _rcm_DisplError;
	this.Version = _rcm_DisplVersion;
	this.DisplayTable = _rcm_DisplayTable;

	// Method to reset cache
	this.ResetCache = _rcm_ResetCache;

	function _rcm_setMode(modeval) {rcmMode = modeval;}
	function _rcm_DisplDebug() { return rcmDebug; }
	function _rcm_DisplMsg() {return rcmMsg;}
	function _rcm_DisplError() {return rcmErr;}
	function _rcm_DisplVersion() {return rcmVersion;}
	function _rcm_TaxInclusive() { return rcmTaxInclusive; }

	function _rcm_APIUrl(pUrl) {		
			rcmAPIUrl = pUrl;
	}
	// API AJAX Calls
	function ajaxCall(jsonStr, callback) {
		if (rcmNeedSignature) {
			signRequest(jsonStr, callback);
		} else {
			var refURL = "";
			if (rcmKey != "")
				refURL = rcmKey;
			else
				refURL = rcmBase64.encode(window.location.host.replace('www.', ''));

			var apiURL = rcmAPIUrl + "?apikey=" + refURL;

			if (rcmIsJsonString(jsonStr)) {
				$.ajax({
					url: apiURL,
					crossDomain: true,
					dataType: "json",
					type: "post",
					data: jsonStr,
					success: function (data, textStatus, jqXHR) {
						//data - response from server
						if (data != "") {
							if (typeof callback == "function") {
								callback(data);
							}
						}
					},
					error: function (jqXHR, textStatus, errorThrown) {
						console.log("Error ajaxCall()");
						console.log(jqXHR);
						console.log(textStatus);
						console.log(errorThrown);
						alert(errorThrown);
					}
				});
			} else alert('invalid JSON string:' + jsonStr);
		}
	}
	function ajaxCallSigned(jsonStr, signStr, callback) {
		var refURL = "";
		if (rcmKey != "")
			refURL = rcmKey;
		else
			refURL = rcmBase64.encode(window.location.host.replace('www.', ''));

		var apiURL = rcmAPIUrl + "?apikey=" + refURL;

		if (rcmIsJsonString(jsonStr)) {
			var apiData = {
				request: jsonStr,
				signature: signStr,
			};
			$.ajax({
				url: apiURL,
				crossDomain: true,
				dataType: "json",
				type: "post",
				data: apiData,
				success: function (data, textStatus, jqXHR) {
					//data - response from server
					if (data != "") {
						if (typeof callback == "function") {
							callback(data);
						}
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log("Error ajaxCallSigned()");
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);
					alert(errorThrown);
				}
			});
		} else alert('invalid JSON string:' + jsonStr);
	}

	function signRequest(jsonStr, callback) {
		//you need to assign your own signature script you want to use in the page you use this script if it is not signRequest.ashx
		if (signScript == "") signScript = "signRequest.ashx";

		if (rcmIsJsonString(jsonStr)) {
			$.ajax({
				url: signScript,
				dataType: "json",
				type: "post",
				data: jsonStr,
				success: function (data, textStatus, jqXHR) {
					//data - response from server
					if (data != "") {
						ajaxCallSigned(jsonStr, data.signature, callback);
					}
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.log("Error signRequest()");
					console.log(jqXHR);
					console.log(textStatus);
					console.log(errorThrown);
					alert(errorThrown);
				}
			});
		} else alert('invalid JSON string:' + jsonStr);
	}
	// END API AJAX Calls

	function _rcm_ResetCache() {
		var jsonStr = '{"method":"resetcache"}';
		ajaxCall(jsonStr);
	}
	function _rcm_getStep1() {
		var jsonStr = '{"method":"step1"}';
		ajaxCall(jsonStr, rcmStep1Ready);
	}
	function _rcm_getStep2(CatTID, PLocID, PDate, PTime, DLocID, DDate, DTime, Age, CampaignCode, Details, AgentCode, Name, Email, Phone, PackageID) {
		var jsonStr = '{"method":"step2"}';

		if (CatTID != undefined && CatTID != '') {
			if (PLocID === undefined || PLocID == '') PLocID = 0;
			if (DLocID === undefined || DLocID == '') DLocID = 0;
			if (Age === undefined || Age == '') Age = 0;
			if (PackageID === undefined || PackageID == '') PackageID = 0;

			jsonStr = JSON.stringify({
				"method": "step2",
				"vehiclecategorytypeid": CatTID,
				"pickuplocationid": PLocID,
				"pickupdate": PDate,
				"pickuptime": PTime,
				"dropofflocationid": DLocID,
				"dropoffdate": DDate,
				"dropofftime": DTime,
				"ageid": Age,
				"campaigncode": CampaignCode,
				"agentcode": AgentCode,
				"name": Name,
				"email": Email,
				"phone": Phone,
				"packageid": PackageID
			});
		}
		ajaxCall(jsonStr, rcmStep2Ready);
	}
	function _rcm_getStep3(CatTID, PLocID, PDate, PTime, DLocID, DDate, DTime, Age, CarSizeID, CampaignCode, Details, AgentCode, PackageID, RelocationSpecialID) {
		if (PLocID === undefined || PLocID == '') PLocID = 0;
		if (DLocID === undefined || DLocID == '') DLocID = 0;
		if (PackageID === undefined || PackageID == '') PackageID = 0;
		if (RelocationSpecialID === undefined || RelocationSpecialID == '') RelocationSpecialID = 0;
		if (Details != 1) Details = 0;
		if (Age === undefined || Age == '') Age = 0;

		var jsonStr = JSON.stringify({
			"method": "step3"
			,"vehiclecategorytypeid": CatTID
			,"pickuplocationid": PLocID
			,"pickupdate": PDate
			,"pickuptime": PTime
			,"dropofflocationid": DLocID
			,"dropoffdate": DDate
			,"dropofftime": DTime
			,"ageid": Age
			,"vehiclecategoryid": CarSizeID
			,"campaigncode": CampaignCode
			,"agentcode": AgentCode
			,"packageid": PackageID
			,"relocationspecialid": RelocationSpecialID
		});
		ajaxCall(jsonStr, rcmStep3Ready);
	}
	function _rcm_MakeBooking(param) {
		if (rcmCustomerDataOK == true) {
			var jsonStr = JSON.stringify({
				"method": "booking"
				,"vehiclecategorytypeid": param.vehiclecategorytypeid
				,"pickuplocationid": param.pickuplocationid
				,"pickupdate": param.pickupdate
				,"pickuptime": param.pickuptime
				, "dropofflocationid": param.dropofflocationid
				,"dropoffdate": param.dropoffdate
				,"dropofftime": param.dropofftime
				,"ageid": param.ageid
				,"vehiclecategoryid": param.vehiclecategoryid
				,"bookingtype": param.bookingtype
				,"insuranceid": rcmSelInsurance
				,"extrakmsid": rcmSelExtraKms
				,"transmission": rcmSelTransmission
				,"emailoption": param.emailoption
				,"referralid": param.referralid
				,"foundusid": param.foundusid
				,"remark": param.remark
				,"numbertravelling": param.numbertravelling
				,"flightin": param.flightin
				,"flightout": param.flightout
				,"arrivalpoint": param.arrivalpoint
				,"departurepoint": param.departurepoint
				,"areaofuseid": param.areaofuseid
				,"campaigncode": param.campaigncode
				,"agentcode": param.agentcode
				,"agentname": param.agentname
				,"agentemail": param.agentemail
				,"agentrefno": param.agentrefno
				,"newsletter": param.newsletter
				,"refno": param.refno
				,"customer": rcmCustomerData
				,"optionalfees": rcmSelOptionalFees
				,"packageid": param.packageid
				,"relocationspecialid": param.relocationspecialid
			});
			console.log("JSON",jsonStr)
			ajaxCall(jsonStr, rcmBookingReady);
		} else {
			alert("Invalid Customer Data/characters: \n\nMake sure Customer data past to API is in valid format using only alpha numeric characters!\n" + rcmAlert);
		}
	}
	function _rcm_GetWebItems() {
		var jsonStr = '{"method":"webitems"}';
		ajaxCall(jsonStr, rcmWebItemsReady);
	}
  function _rcm_MakePayment(pRefNo, pData, pEmailOption) {
    if (pEmailOption == undefined || pEmailOption == "") { pEmailOption = "1" }
		var outData = rcmBase64.encode(pData);
		var jsonStr = JSON.stringify({
			"method": "payment"
			, "reservationref": pRefNo
      , "data": outData
      , "emailoption": pEmailOption
		});
		ajaxCall(jsonStr, rcmPaymentReady);
	}
  function _rcm_ConfirmPayment(pRefNo, pAmount, pSuccess, pPaymentType, pPaymentDate, pTokenSupplierID, pTransactionBillingID, pDpsTxnRef, pCardHolderName, pPaymentSource, pCardNumber, pCardExpiry, pTransType, pMerchantFeeID, pPaymentScenario, pEmailOption) {
    if (pEmailOption == undefined || pEmailOption == "") { pEmailOption = "1" }
		var jsonStr = JSON.stringify({
			"method":"confirmpayment"
			,"reservationref":pRefNo
			,"amount":pAmount
			,"success":pSuccess
			,"paytype":pPaymentType
			,"paydate":pPaymentDate
			,"supplierid": pTokenSupplierID
			,"transactid": pTransactionBillingID // Optional
			,"dpstxnref": pDpsTxnRef // Optional
			,"cardholder": pCardHolderName // Optional
			,"paysource":pPaymentSource // Optional
			,"cardnumber":pCardNumber // Optional
			,"cardexpiry":pCardExpiry // Optional
			,"transtype":pTransType // Optional
			,"merchfeeid":pMerchantFeeID // Optional
      , "payscenario": pPaymentScenario // Optional
      , "emailoption": pEmailOption //Optional
		});
		ajaxCall(jsonStr, rcmPaymentReady);
	}
	function _rcm_GetBookingInfo(pRefNo) {
		var jsonStr = JSON.stringify({
			"method": "bookinginfo"
			, "reservationref": pRefNo
		});
		signRequest(jsonStr, rcmBookingInfoReady);
	}
	function _rcm_EditBooking(param) {
	  if (rcmCustomerDataOK == true) {
	  	var jsonStr = JSON.stringify({
	  		"method": "editbookingdeprecated"
				,"reservationref": param.reservationref
				,"pickuplocationid": param.pickuplocationid
				,"bookingtype": param.bookingtype
				,"insuranceid": rcmSelInsurance
				,"extrakmsid": rcmSelExtraKms
				,"transmission": param.transmission
				,"emailoption": param.emailoption
				,"referralid": param.referralid
				,"campaigncode": param.campaigncode
				,"foundusid": param.foundusid
				,"remark": param.remark
				,"numbertravelling": param.numbertravelling
				,"flightin": param.flightin
				,"flightout": param.flightout
				,"arrivalpoint": param.arrivalpoint
				,"departurepoint": param.departurepoint
				,"areaofuseid": param.areaofuseid
				,"newsletter": param.newsletter
				,"agentcode": param.agentcode
				,"agentname": param.agentname
				,"agentemail": param.agentemail
				,"agentrefno": param.agentrefno
				,"customer": rcmCustomerData
				,"optionalfees": rcmSelOptionalFees
	  	});
	  	//console.log("JSON",jsonStr);
	  	ajaxCall(jsonStr, rcmBookingReady);
	  } else {
	    alert("Invalid Customer Data/characters: \n\nMake sure Customer data past to API is in valid format using only alpha numeric characters!\n" + rcmAlert);
	  }
	}
	function _rcm_GetCancelReasons() {
		var jsonStr = '{"method":"cancelreasons"}';
		ajaxCall(jsonStr, rcmCancelReasonsReady);
	}
	function _rcm_CancelBooking(BookRef, CancelReasonID) {
		var jsonStr = JSON.stringify({
			"method": "cancelbooking"
			, "reservationref": BookRef
			, "reasonid": CancelReasonID
		});
		ajaxCall(jsonStr, rcmCancelReady);
	}
	function _rcm_GetLocationDetails(id) {
		var jsonStr = JSON.stringify({
			"method": "locationdetails"
			, "id": id
		});
		ajaxCall(jsonStr, rcmLocationDetailsReady);
	}
	function _rcm_GetAgentBookings(res, PDate, DDate,stat) {
		var jsonStr = "";

		if (parseFloat(res)>0)
			jsonStr = JSON.stringify({
				"method" : "agentbookings"
				,"reservationno" : res
			});	
		else
			jsonStr = JSON.stringify({
				"method" : "agentbookings"
				,"startdate" : PDate
				,"enddate" : DDate
				,"bookingstatus" : stat
			});
		ajaxCall(jsonStr, rcmAgentBookingsReady);
	}
	function _rcm_ExtraDriver(ref, custid) {
		var jsonStr = JSON.stringify({
			"method": "extradriver"
			, "reservationref": ref
			, "custid": custid
			,"customer": rcmCustomerData
		});
		ajaxCall(jsonStr, rcmExtraDriverReady);
	}
	function _rcm_AddToOptionalItems(id, qty) {
		rcmSelOptionalFees.push({ "id": id, "qty": qty });
	}
	function _rcm_ClearOptionalItems() {
		rcmSelOptionalFees = [];
	}
	function _rcm_GetOptionalItems() {
		return JSON.stringify(rcmSelOptionalFees);
	}
	function _rcm_InitOptionalItems(value) {
		if (rcmIsJsonString(value) == true)
			rcmSelOptionalFees = JSON.parse(value);
	}
	function _rcm_InitCustomerData(value) {
		if (rcmIsJsonString(value) == true)
			rcmCustomerData = JSON.parse(value);
	}
	function _rcm_SetCustomerData(param) { //fname, lname, email, phone, mobile, dob, licno, licis, licex, address, city, state, postcode, country, fax, ccd) {
		// Validate data first and display alert only when function for alert is specified
		var tst = _rcm_ValidateCustomerData(
			param.firstname
			, param.lastname
			, param.email
			, param.phone
			, param.mobile
			, param.dateofbirth
			, param.licenseno
			, param.licenseissued
			, param.licenseexpires
			, param.address
			, param.city
			, param.state
			, param.postcode
			, param.countryid
			, param.fax
			, param.ccd
		);
	  rcmCustomerDataOK = true;
		if (rcmCustomerDataOK == true) {
			rcmCustomerData = [];
			rcmCustomerData.push({
				"firstname": rcmStrOut(param.firstname),
				"lastname": rcmStrOut(param.lastname),
				"email": rcmStrOut(param.email),
				"phone": rcmStrOut(param.phone),
				"mobile": rcmStrOut(param.mobile),
				"dateofbirth": rcmStrOut(param.dateofbirth),
				"licenseno": rcmStrOut(param.licenseno),
				"licenseissued": rcmStrOut(param.licenseissued),
				"licenseexpires": rcmStrOut(param.licenseexpires),
				"address": rcmStrOut(param.address),
				"city": rcmStrOut(param.city),
				"state": rcmStrOut(param.state),
				"postcode": rcmStrOut(param.postcode),
				"countryid": rcmStrOut(param.countryid),
				"fax": rcmStrOut(param.fax),
				"companycode": param.ccd == undefined ? '' : rcmStrOut(param.ccd)
			});
		}
	}
	function _rcm_ValidateCustomerData(fname, lname, email, phone, mobile, dob, licno, licis, licex, address, city, state, postcode, country, fax, ccd) {
		rcmAlert = "";
		if (!fname == "" && rcm_alphanum_pat.test(fname) == true) rcmAlert += "\nAPI-SetFirstName: Invalid Characters";
		if (!lname == "" && rcm_alphanum_pat.test(lname) == true) rcmAlert += "\nAPI-SetLastName: Invalid Characters";
		if (rcm_email_pat.test(email) == false) rcmAlert += "\nAPI-SetEmail: Invalid Email";
		if (!phone=="" && rcm_alphanum_pat.test(phone) == true) rcmAlert += "\nAPI-SetPhone: Invalid Phone number";
		if (!mobile == "" && rcm_alphanum_pat.test(mobile) == true) rcmAlert += "\nAPI-SetMobile: Invalid Mobile Phone number";
		if (!dob == "" && rcmValidatedate(dob) == false) rcmAlert += "\nAPI-SetDob: Invalid Date of Birth";
		if (!licno == "" && rcm_text.test(licno) == true) rcmAlert += "\nAPI-SetLicenseNo: Invalid License Value";
		if (!licis == "" && rcm_text.test(licis) == false) rcmAlert += "\nAPI-SetLicenseIssuedIn: Invalid License Issued Value";
		if (!licex == "" && rcmValidatedate(licex) == false) rcmAlert += "\nAPI-SetLicenseExpires: Invalid Date format";
		if (!address == "" && rcm_text.test(address) == true) rcmAlert += "\nAPI-SetAddress: Invalid Characters";
		if (!city == "" && rcm_alphanum_pat.test(city) == true) rcmAlert += "\nAPI-SetCity: Invalid Characters";
		if (!state == "" && rcm_alphanum_pat.test(state) == true) rcmAlert += "\nAPI-SetState: Invalid Characters";
		if (!postcode == "" && rcm_alphanum_pat.test(postcode) == true) rcmAlert += "\nAPI-SetPostcode: Invalid Postal Code";
		if (!country == "" && rcm_number.test(country) == false) rcmAlert += "\nAPI-SetCountry: Invalid ID needs to be a number";
		if (!fax == "" && rcm_alphanum_pat.test(fax) == true) rcmAlert += "\nAPI-SetFax: Invalid Fax number";
		if (!ccd == "" && rcm_text.test(ccd) == true) rcmAlert += "\nAPI-SetCCD: Invalid Characters";

		if (rcmAlert!="" && typeof fnAlerts == "function") fnAlerts();
		
		return (rcmAlert == "" ? true : false);
	}
	function _rcm_ClearCustomerData() {
		rcmCustomerData = [{ "firstname": "", "lastname": "", "email": "", "phone": "", "mobile": "", "dateofbirth": "", "licenseno": "", "licenseissued": "", "licenseexpires": "", "address": "", "city": "", "state": "", "postcode": "", "countryid": "", "fax": "", "foundusid": "", "remark": "", "numbertravelling": "", "flightin": "", "flightout": "", "arrivalpoint": "", "departurepoint": "", "areaofuseid": "", "companycode": "" }];
	}
	function _rcm_GetCustomerData() {
		return JSON.stringify(rcmCustomerData);
	}
	function _rcm_SetTransmission(setValue) {
		var tstVal = rcm_number.test(setValue) && setValue != "" || setValue == 0;
		if (tstVal == true) {
			rcmSelTransmission = setValue;
		} else alert("API-SetTransmission: Invalid Number ID:" + setValue);
	}
	function _rcm_SetNewsletter(setValue) {
	  if (setValue == 0 || setValue == 1) {
	    rcmNewsLetter = setValue;
	  } else alert("API-SetNewsletter: Invalid Value (valid values: 0/1):" + setValue);
	}
	function _rcm_SetInsurance(setValue) {
		var tstVal = rcm_number.test(setValue) && setValue != "" || setValue == 0;
		if (tstVal == true) {
			rcmSelInsurance = setValue;
		} else alert("API-SetInsurance: Invalid Number ID:" + setValue);
	}
	function _rcm_SetExtraKms(setValue) {
		var tstVal = rcm_number.test(setValue) && setValue != "" || setValue == 0;
		if (tstVal == true) {
			rcmSelExtraKms = setValue;
		} else alert("API-SetExtraKms: Invalid Number ID:" + setValue);
	}
	function _rcm_SetFirstName(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["firstname"] = setValue;
		} else {
			rcmAlert += "\nAPI-SetFirstName: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetLastName(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["lastname"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLastName: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetEmail(setValue) {
		var tstVal = rcm_email_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["email"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetEmail: Invalid Email";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetPhone(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["phone"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetPhone: Invalid Phone number";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetMobile(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["mobile"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetMobile: Invalid Mobile Phone number";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetDOB(setValue) {
		var tstVal = rcmValidatedate(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["dateofbirth"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetDob: Invalid Date of Birth";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetLicenseNo(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["licenseno"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLicenseNo: Invalid License Value";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetLicenseIssuedIn(setValue) {
	  var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["licenseissued"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLicenseIssuedIn: Invalid License Issued Value";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetLicenseExpires(setValue) {
		var tstVal = rcmValidatedate(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["licenseexpires"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetLicenseExpires: Invalid Date format";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetAddress(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["address"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetAddress: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetCity(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["city"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetCity: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetState(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["state"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetState: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetPostcode(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["postcode"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetPostcode: Invalid Postal Code";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetCountry(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["countryid"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetCountry: Invalid ID needs to be a number";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetFax(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["fax"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFax: Invalid Fax number";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetFoundus(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["foundusid"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFoundus: Invalid ID needs to be a number";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetRemarks(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["remark"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetRemarks: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetNoTraveling(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["numbertravelling"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetNoTraveling: Invalid value needs to be a number";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetFlightNo(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["flightin"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFlightNo: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetFlightNoOut(setValue) {
		var tstVal = !rcm_alphanum_pat.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["flightout"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetFlightNoOut: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetCollectionPoint(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["arrivalpoint"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetCollectionPoint: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		} 
	}
	function _rcm_SetReturnPoint(setValue) {
		var tstVal = !rcm_text.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["departurepoint"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetReturnPoint: Invalid Characters";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetAreaOfUse(setValue) {
		var tstVal = rcm_number.test(setValue);
		if (tstVal == true) {
			rcmCustomerData[0]["areaofuseid"] = setValue;
		} else {
			rcmAlert = "\nAPI-SetAreaOfUse: Invalid ID needs to be a number";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_SetDateFormat(setValue) {
		if (setValue == 'd/m/Y' || setValue == 'm/d/Y') {
			rcmDateFormat = setValue;
		} else {
			rcmAlert = "\nAPI-SetDateFormat: Invalid date format (allowed: d/m/Y or m/d/Y)";
			if (typeof fnAlerts == "function") fnAlerts();
		}
	}
	function _rcm_GetFirstName() { return rcmCustomerData[0]["firstname"]; }
	function _rcm_GetLastName() { return rcmCustomerData[0]["lastname"]; }
	function _rcm_GetEmail() { return rcmCustomerData[0]["email"]; }
	function _rcm_GetPhone() { return rcmCustomerData[0]["phone"]; }
	function _rcm_GetMobile() { return rcmCustomerData[0]["mobile"]; }
	function _rcm_GetDOB() { return rcmCustomerData[0]["dateofbirth"]; }
	function _rcm_GetLicenseNo() { return rcmCustomerData[0]["licenseno"]; }
	function _rcm_GetLicenseIssuedIn() { return rcmCustomerData[0]["licenseissued"]; }
	function _rcm_GetLicenseExpires() { return rcmCustomerData[0]["licenseexpires"]; }
	function _rcm_GetAddress() { return rcmCustomerData[0]["address"]; }
	function _rcm_GetCity() { return rcmCustomerData[0]["city"]; }
	function _rcm_GetState() { return rcmCustomerData[0]["state"]; }
	function _rcm_GetPostcode() { return rcmCustomerData[0]["postcode"]; }
	function _rcm_GetCountryID() { return rcmCustomerData[0]["countryid"]; }
	function _rcm_GetFax() { return rcmCustomerData[0]["fax"]; }
	function _rcm_GetFoundusID() { return rcmCustomerData[0]["foundusid"]; }
	function _rcm_GetRemarks() { return rcmCustomerData[0]["remark"]; }
	function _rcm_GetNoTraveling() { return rcmCustomerData[0]["numbertravelling"]; }
	function _rcm_GetFlightNo() { return rcmCustomerData[0]["flightin"]; }
	function _rcm_GetFlightNoOut() { return rcmCustomerData[0]["flightout"]; }
	function _rcm_GetCollectionPoint() { return rcmCustomerData[0]["arrivalpoint"]; }
	function _rcm_GetReturnPoint() { return rcmCustomerData[0]["departurepoint"]; }
	function _rcm_GetAreaOfUse() { return rcmCustomerData[0]["areaofuseid"]; }
	function _rcm_GetTax() { return rcmTaxRate; }
	function _rcm_GetStateTax() { return rcmStateTax; }
	function _rcm_GetSession() { return rcmSession; }
	function _rcm_GetDateFormat() { return rcmDateFormat; }
	function _rcm_GetInsurance() { return rcmSelInsurance; }
	function _rcm_GetExtraKms() { return rcmSelExtraKms; }

	function _rcm_GetUser(dob, email) {
	  //deprecated 14-08-2018
	  rcmGetUserReady("");
	}
	function _rcm_GetURL(refno, objID) {
		rcmURLObjID = objID;
		//var Data = refno + "|" + new Date().getTime();
		//Data = rcmBase64.encode(Data);

		var jsonStr = '{"method":"geturl","reservationref":"' + refno + '"}';
		ajaxCall(jsonStr, rcmGetURLReady);
	}
	function _rcm_LoadLocationsList(objPickUp, objDropOff, objAge, valPickupID, valDropOffID, IntroPickUp, IntroDropOff) {
		var valAge = "9999";
		var selPickUp = objPickUp.value;
		var selDropOff = objDropOff.value;
		var OldPickUpIndex = objPickUp.selectedIndex;
		var OldDropOffIndex = objDropOff.selectedIndex;

		if (objAge.selectedIndex >= 0 && rcm_number.test(objAge.options[objAge.selectedIndex].text)) valAge = objAge.options[objAge.selectedIndex].text;

		ClearList(objPickUp);
		ClearList(objDropOff);
		if (IntroPickUp !== undefined && IntroPickUp !== "") {
			objPickUp.options[objPickUp.options.length] = new Option(IntroPickUp, "");
			objPickUp.options[objPickUp.options.length - 1].disabled = true;
		}
		if (IntroDropOff !== undefined && IntroDropOff !== "") {
			objDropOff.options[objDropOff.options.length] = new Option(IntroDropOff, "");
			objDropOff.options[objDropOff.options.length - 1].disabled = true;
		}
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["ispickupavailable"] == true && rcmLocationInfo[i]["minimumage"] <= valAge) {
				objPickUp.options[objPickUp.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valPickupID && rcmLocationInfo[i]["isdefault"] == true) || (rcmLocationInfo[i]["id"]) == valPickupID) objPickUp.options[objPickUp.options.length - 1].selected = true;
			}
			if (rcmLocationInfo[i]["isdropoffavailable"] == true && rcmLocationInfo[i]["minimumage"] <= valAge) {
				objDropOff.options[objDropOff.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valDropOffID && rcmLocationInfo[i]["isdefault"] == true) || (rcmLocationInfo[i]["id"]) == valDropOffID) objDropOff.options[objDropOff.options.length - 1].selected = true;
			}
		}
		if (rcm_number.test(selPickUp) && OldPickUpIndex >= 0) objPickUp.value = selPickUp;
		if (rcm_number.test(selDropOff) && OldDropOffIndex >= 0) objDropOff.value = selDropOff;
		if (typeof fnLocationChange == "function" && (OldPickUpIndex >= 0 || OldDropOffIndex >= 0)) {
			fnLocationChange();
		}
	}
	function _rcm_LoadPickupList(obj, valPickupID, IntroItem) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0) selObj = obj.value;

		ClearList(obj);
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["ispickupavailable"] == true) {
				obj.options[obj.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valPickupID && rcmLocationInfo[i]["isdefault"] == true) || (rcmLocationInfo[i]["id"]) == valPickupID) obj.options[obj.options.length - 1].selected = true;
			}
		}
		//Remember last selection
		if (rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
	}
	function _rcm_LoadDropOffList(obj, valDropOffID, IntroItem) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0) selObj = obj.value;

		ClearList(obj);
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["isdropoffavailable"] == true) {
				obj.options[obj.options.length] = new Option(rcmLocationInfo[i]["location"], rcmLocationInfo[i]["id"]);
				if ((!valDropOffID && rcmLocationInfo[i]["isdefault"] == true) || (rcmLocationInfo[i]["id"]) == valDropOffID) obj.options[obj.options.length - 1].selected = true;
			}
		}
		//Remember last selection
		if (rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
	}
	function _rcm_LoadAgeList(obj, valAge, IntroItem, selDefault) {
		var selObj;
		var bFoundDefault = false;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0) selObj = obj.value;

		ClearList(obj);
		if (selDefault === undefined) selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmDriverAgesInfo) {
			obj.options[obj.options.length] = new Option(rcmDriverAgesInfo[i]["driverage"], rcmDriverAgesInfo[i]["id"]);
			if (selDefault == true && rcmDriverAgesInfo[i]["isdefault"] == true) {
				bFoundDefault = true;
				obj.options[obj.options.length - 1].selected = true;
			}
		}
		// In case we do not have default select last item in list
		if (bFoundDefault == false) obj.options[obj.options.length - 1].selected = true;

		//Remember last selection
		if (valAge > 0) obj.value = valAge;
		else if (rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
	}
	function _rcm_LoadRentalSource(obj, valRentalSource, IntroItem, selDefault) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0) selObj = obj.value;

		ClearList(obj);
		if (selDefault === undefined) selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmRentalSource) {
			obj.options[obj.options.length] = new Option(rcmRentalSource[i]["rentalsource"], rcmRentalSource[i]["id"]);
			if (selDefault == true && rcmRentalSource[i]["isdefault"] == true) obj.options[obj.options.length - 1].selected = true;
		}
		//Remember last selection
		if (valRentalSource > 0) obj.value = valRentalSource;
		else if (rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
	}
	function _rcm_LoadAreaOfUse(obj, valAreaOfUse, LocID, IntroItem, selDefault) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0) selObj = obj.value;

		ClearList(obj);
		if (selDefault === undefined) selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmAreaOfUse) {
			if (rcmAreaOfUse[i]["locationid"] == 0 || rcmAreaOfUse[i]["locationid"] == LocID) {
				obj.options[obj.options.length] = new Option(rcmAreaOfUse[i]["areaofuse"], rcmAreaOfUse[i]["id"]);
				if (selDefault == true && rcmAreaOfUse[i]["isdefault"] == true) obj.options[obj.options.length - 1].selected = true;
			}
		}
		//Remember last selection
		if (valAreaOfUse > 0) obj.value = valAreaOfUse;
		else if (rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
	}
	function _rcm_LoadCountries(obj, valCountries, IntroItem, selDefault) {
		var selObj;
		var OldIndex = obj.selectedIndex;
		if (OldIndex >= 0) selObj = obj.value;

		ClearList(obj);
		if (selDefault === undefined) selDefault = true;
		if (IntroItem !== undefined && IntroItem !== "") {
			obj.options[obj.options.length] = new Option(IntroItem, "");
			obj.options[obj.options.length - 1].disabled = true;
		}
		for (i in rcmCountries) {
			obj.options[obj.options.length] = new Option(rcmCountries[i]["country"], rcmCountries[i]["id"]);
			if (selDefault == true && rcmCountries[i]["isdefault"] == true) obj.options[obj.options.length - 1].selected = true;
        }
		//Remember last selection
		if (valCountries > 0) obj.value = valCountries;
		else if (rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
	}
	function _rcm_LoadCategoryType(obj, valObj, IntroItem, selAll, txtAll) {
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
		  if (txtAll === undefined || txtAll==="") txtAll = "All";
		  obj.options[obj.options.length] = new Option(txtAll, "0");
		  if (valObj=='0') obj.options[obj.options.length - 1].selected = true;
		}

		for (i in rcmCategoryTypeInfo) {
			obj.options[obj.options.length] = new Option(rcmCategoryTypeInfo[i]["vehiclecategorytype"], rcmCategoryTypeInfo[i]["id"]);
			if (rcmCategoryTypeInfo[i]["id"] == valObj) obj.options[obj.options.length - 1].selected = true;
		}
		//Remember last selection in case valObj is not assigned
		if (!valObj && rcm_number.test(selObj) && OldIndex >= 0) obj.value = selObj;
	}
	function _rcm_DisplayTable(obj, arr) {
	  var out = "<table class='tblDisplay'><tr>";
		for (var name in arr[0]) { out = out + "<td>" + [name] + "</td>"; }
		out = out + "</tr>";
		for (var i = 0; i < arr.length; ++i) {
			out = out + "<tr>";
			for (var name in arr[i]) { out = out + "<td nowrap>" + arr[i][name] + "</td>"; }
			out = out + "</tr>";
		}
		out = out + "</table>";
		obj.innerHTML = out;
	}
	function _rcm_GetNoticePeriod(LocID) {
		var retval = 0;
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["id"] == LocID) {
			  retval = parseFloat(rcmLocationInfo[i]["noticerequired_numberofdays"]);
			}
		}
		return retval;
	}
	function _rcm_GetAge(AgeID) {
		var retval = 0;
		for (i in rcmDriverAgesInfo) {
			if (rcmDriverAgesInfo[i]["id"] == AgeID) {
				retval = rcmDriverAgesInfo[i]["driverage"];
			}
		}
		return retval;
	}
	function _rcm_GetAgeID(Age) {
	  var retval = 0;
	  for (i in rcmDriverAgesInfo) {
	    if (rcmDriverAgesInfo[i]["driverage"] === Age) {
	      retval = rcmDriverAgesInfo[i]["id"];
	    }
	  }
	  return retval;
	}
	function _rcm_GetCountry(CountryID) {
		var retval = "";
		for (i in rcmCountries) {
			if (rcmCountries[i]["id"] == CountryID) {
				retval = rcmCountries[i]["country"];
			}
		}
		return retval;
	}
	function _rcm_GetCategoryType(CategoryTypeID) {
		var retval = "";
		for (i in rcmCategoryTypeInfo) {
			if (rcmCategoryTypeInfo[i]["id"] == CategoryTypeID) {
				retval = rcmCategoryTypeInfo[i]["vehiclecategorytype"];
			}
		}
		return retval;
	}
	function _rcm_ReservationRef() { return rcmReservationRef; }
	function _rcm_ReservationNo() { return rcmReservationNo; }
	function _rcm_CheckLocationAvailable() {
		var retval = "";
		for (i in rcmLocationFees) {
			if (rcmLocationFees[i]["isavailable"] == false) {
			  retval = retval + " " + rcmLocationFees[i]["availablemessage"];
			}
		}
		return retval;
	}
	function _rcm_CheckCustomerDataOK() { return rcmCustomerDataOK; }
	function _rcm_CheckPaymentSaved() { return rcmPaymentSaved; }
	function _rcm_OfficeOpen(LocID, dw) {
	  var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locationid"] == LocID) {
				if (rcmOfficeTimes[i]["dayofweek"] == dw) {
					retval = rcmOfficeTimes[i]["openingtime"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["isdropoffavailable"] == true || rcmLocationInfo[i]["ispickupavailable"] == true) {
					if (rcmLocationInfo[i]["id"] == LocID) {
						retval = rcmLocationInfo[i]["officeopeningtime"];
					}
				}
			}
		}
		if (retval == "99:99") retval = "00:00";
		return retval;
	}
	function _rcm_OfficeClose(LocID, dw) {
	  var retval = "99:99";
		for (i in rcmOfficeTimes) {
			if (rcmOfficeTimes[i]["locationid"] == LocID) {
				if (rcmOfficeTimes[i]["dayofweek"] == dw) {
					retval = rcmOfficeTimes[i]["closingtime"];
				}
			}
		}
		if (retval == "99:99") {
			for (i in rcmLocationInfo) {
				if (rcmLocationInfo[i]["isdropoffavailable"] == true || rcmLocationInfo[i]["ispickupavailable"] == true) {
					if (rcmLocationInfo[i]["id"] == LocID) {
						retval = rcmLocationInfo[i]["officeclosingtime"];
					}
				}
			}
		}
        if (retval == "99:99") retval = "24:00";
        return retval;
    }
    function _rcm_MinTimePickup(LocID, dw, pickupDate = null) {
        var defaultTime = "99:99";
        var retval = defaultTime;

        for (var i in rcmOfficeTimes) {
            if (rcmOfficeTimes.hasOwnProperty(i) && rcmOfficeTimes[i]["locationid"] == LocID) {
                if (rcmOfficeTimes[i]["dayofweek"] == dw) {
                    if (pickupDate instanceof Date) {
                        var startDate = new Date(Date.parse(rcmOfficeTimes[i]["startdate"]));
                        var endDate = new Date(Date.parse(rcmOfficeTimes[i]["enddate"]));

                        if (startDate <= pickupDate && pickupDate <= endDate) {
                            retval = rcmOfficeTimes[i]["startpickup"];
                            break;
                        }
                    } else {
                        retval = rcmOfficeTimes[i]["startpickup"];
                    }
                }
            }
        }
        if (retval == defaultTime) {
            for (var i in rcmLocationInfo) {
                if (rcmLocationInfo.hasOwnProperty(i) && rcmLocationInfo[i]["ispickupavailable"] == true) {
                    if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbookingaccepted"] == false) {
                        retval = rcmLocationInfo[i]["officeopeningtime"];
                    }
                }
            }
        }
        if (retval == defaultTime) retval = "00:00";
        return retval;
    }
    function _rcm_MinTimeDropOff(LocID, dw, dropoffDate = null) {
        var defaultTime = "99:99";
        var retval = defaultTime;

        for (var i in rcmOfficeTimes) {
            if (rcmOfficeTimes.hasOwnProperty(i) && rcmOfficeTimes[i]["locationid"] == LocID) {
                if (rcmOfficeTimes[i]["dayofweek"] == dw) {
                    if (dropoffDate instanceof Date) {
                        var startDate = new Date(Date.parse(rcmOfficeTimes[i]["startdate"]));
                        var endDate = new Date(Date.parse(rcmOfficeTimes[i]["enddate"]));

                        if (startDate <= dropoffDate && dropoffDate <= endDate) {
                            retval = rcmOfficeTimes[i]["startdropoff"];
                            break;
                        }
                    } else {
                        retval = rcmOfficeTimes[i]["startdropoff"];
                    }
                }
            }
        }
        if (retval == defaultTime) {
            for (var i in rcmLocationInfo) {
                if (rcmLocationInfo.hasOwnProperty(i) && rcmLocationInfo[i]["isdropoffavailable"] == true) {
                    if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbookingaccepted"] == false && rcmLocationInfo[i]["unattendeddropoffaccepted"] == false) {
                        retval = rcmLocationInfo[i]["officeopeningtime"];
                    }
                }
            }
        }
        if (retval == defaultTime) retval = "00:00";
        return retval;
    }
    function _rcm_MaxTimePickup(LocID, dw, pickupDate = null) {
        var defaultTime = "99:99";
        var retval = defaultTime;

        for (var i in rcmOfficeTimes) {
            if (rcmOfficeTimes.hasOwnProperty(i) && rcmOfficeTimes[i]["locationid"] == LocID) {
                if (rcmOfficeTimes[i]["dayofweek"] == dw) {
                    if (rcmOfficeTimes[i]["endpickup"] != "00:00") {
                        if (pickupDate instanceof Date) {
                            var startDate = new Date(Date.parse(rcmOfficeTimes[i]["startdate"]));
                            var endDate = new Date(Date.parse(rcmOfficeTimes[i]["enddate"]));

                            if (startDate <= pickupDate && pickupDate <= endDate) {
                                retval = rcmOfficeTimes[i]["endpickup"];
                                break;
                            }
                        } else {
                            retval = rcmOfficeTimes[i]["endpickup"];
                        }
                    }
                }
            }
        }
        if (retval == defaultTime) {
            for (var i in rcmLocationInfo) {
                if (rcmLocationInfo.hasOwnProperty(i) && rcmLocationInfo[i]["ispickupavailable"] == true) {
                    if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbookingaccepted"] == false) {
                        if (rcmLocationInfo[i]["officeclosingtime"] != "00:00") {
                            retval = rcmLocationInfo[i]["officeclosingtime"];
                        }
                    }
                }
            }
        }
        if (retval == defaultTime) retval = "24:00";
        return retval;
    }
    function _rcm_MaxTimeDropOff(LocID, dw, dropoffDate = null) {
        var defaultTime = "99:99";
        var retval = defaultTime;

        for (var i in rcmOfficeTimes) {
            if (rcmOfficeTimes.hasOwnProperty(i) && rcmOfficeTimes[i]["locationid"] == LocID) {
                if (rcmOfficeTimes[i]["dayofweek"] == dw) {
                    if (rcmOfficeTimes[i]["enddropoff"] != "00:00") {
                        if (dropoffDate instanceof Date) {
                            var startDate = new Date(Date.parse(rcmOfficeTimes[i]["startdate"]));
                            var endDate = new Date(Date.parse(rcmOfficeTimes[i]["enddate"]));

                            if (startDate <= dropoffDate && dropoffDate <= endDate) {
                                retval = rcmOfficeTimes[i]["enddropoff"];
                                break;
                            }
                        } else {
                            retval = rcmOfficeTimes[i]["enddropoff"];
                        }                        
                    }
                }
            }
        }
        if (retval == defaultTime) {
            for (var i in rcmLocationInfo) {
                if (rcmLocationInfo.hasOwnProperty(i) && rcmLocationInfo[i]["isdropoffavailable"] == true) {
                    if (rcmLocationInfo[i]["id"] == LocID && rcmLocationInfo[i]["afterhourbookingaccepted"] == false && rcmLocationInfo[i]["unattendeddropoffaccepted"] == false) {
                        if (rcmLocationInfo[i]["officeclosingtime"] != "00:00") retval = rcmLocationInfo[i]["officeclosingtime"];
                    }
                }
            }
        }
        if (retval == defaultTime) retval = "24:00";
        return retval;
    }
    function _rcm_MinBookingDay(LocID) {
		var retval = 0;
		for (i in rcmLocationInfo) {
			if (rcmLocationInfo[i]["id"] == LocID) {
				retval = rcmLocationInfo[i]["minimumbookingday"];
			}
		}
		return retval;
	}
	// Assigned Function Calls
	function _rcm_OnReady(fnCall) {
		if (typeof fnCall == "function" && fnCallBack == null) {
			fnCallBack = fnCall;
		}
	}
	function _rcm_OnReadyStep1(fnCall) {
		if (typeof fnCall == "function" && fnCallBackStep1 == null) {
			fnCallBackStep1 = fnCall;
		}
	}
	function _rcm_OnReadyStep2(fnCall) {
		if (typeof fnCall == "function" && fnCallBackStep2 == null) {
			fnCallBackStep2 = fnCall;
		}
	}
	function _rcm_OnReadyStep3(fnCall) {
		if (typeof fnCall == "function" && fnCallBackStep3 == null) {
			fnCallBackStep3 = fnCall;
		}
	}
	function _rcm_OnReadyCancelReasons(fnCall) {
	  if (typeof fnCall == "function" && fnCallBackCancelReasons == null) {
	    fnCallBackCancelReasons = fnCall;
	  }
	}
	function _rcm_OnCancelDone(fnCall) {
	  if (typeof fnCall == "function" && fnCallCancelDone == null) {
	    fnCallCancelDone = fnCall;
	  }
	}
	function _rcm_OnReadyWebItems(fnCall) {
	  if (typeof fnCall == "function" && fnCallBackWebItems == null) {
	    fnCallBackWebItems = fnCall;
	  }
	}
	function _rcm_OnBookingDone(fnCall) {
		if (typeof fnCall == "function" && fnCallBookingDone == null) {
			fnCallBookingDone = fnCall;
		}
	}
	function _rcm_OnPaymentDone(fnCall) {
		if (typeof fnCall == "function" && fnCallPaymentDone == null) {
			fnCallPaymentDone = fnCall;
		}
	}
	function _rcm_OnReadyGetUser(fnCall) {
		if (typeof fnCall == "function" && fnCallBackGetUser == null) {
			fnCallBackGetUser = fnCall;
		}
	}
	function _rcm_OnReadyGetURL(fnCall) {
		if (typeof fnCall == "function" && fnCallBackGetURL == null) {
			fnCallBackGetURL = fnCall;
		}
	}
	function _rcm_OnReadyGetBookingInfo(fnCall) {
	  if (typeof fnCall == "function" && fnCallBackBookingInfo == null) {
	    fnCallBackBookingInfo = fnCall;
	  }
  }
	function _rcm_OnLocationChange(fnCall) {
		if (typeof fnCall == "function" && fnLocationChange == null) {
			fnLocationChange = fnCall;
		}
	}
	function _rcm_OnReadyGetLocationDetails(fnCall) {
	  if (typeof fnCall == "function" && fnCallBackLocationDetails == null) {
	    fnCallBackLocationDetails = fnCall;
	  }
	}
	function _rcm_OnReadyGetAgentBookings(fnCall) {
	  if (typeof fnCall == "function" && fnCallBackAgentBookings == null) {
	    fnCallBackAgentBookings = fnCall;
	  }
	}
	function _rcm_OnReadyExtraDriver(fnCall) {
		if (typeof fnCall == "function" && fnCallBackExtraDriver == null) {
			fnCallBackExtraDriver = fnCall;
		}
	}
 	function _rcm_OnAlerts(fnCall) {
		if (typeof fnCall == "function" && fnAlerts == null) {
			fnAlerts = fnCall;
		}
	}
	//General Function
	function ClearList(obj) {
		while (obj.options.length > 0) {
			obj.remove(0);
		}
	}
}
function rcmStep1Ready(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				// Init values before assigning results
				rcmLocationInfo = [];
				rcmOfficeTimes = [];
				rcmCategoryTypeInfo = [];
				rcmDriverAgesInfo = [];
				rcmHolidays = [];

				var results = data["results"];
				if (results["locations"]) rcmLocationInfo = results["locations"];
				if (results["officetimes"]) rcmOfficeTimes = results["officetimes"];
				if (results["categorytypes"]) rcmCategoryTypeInfo = results["categorytypes"];
				if (results["driverages"]) rcmDriverAgesInfo = results["driverages"];
				if (results["holidays"]) rcmHolidays = results["holidays"];

				if (typeof fnCallBackStep1 == "function") {
					fnCallBackStep1();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmStep1Ready error, invalid jason", e);
		}
	}
}
function rcmStep2Ready(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				// Init values before assigning results
				rcmLocationInfo = [];
				rcmOfficeTimes = [];
				rcmCategoryTypeInfo = [];
				rcmDriverAgesInfo = [];
				rcmHolidays = [];
				rcmLocationFees = [];
				rcmAvailableCarDetails = [];
				rcmAvailableCars = [];
				rcmAvailableCars_p = [];
				rcmMandatoryFees = [];
				rcmMandatoryFees_p = [];
				rcmOptionalFees = [];
				rcmOptionalFees_p = [];
				rcmInsuranceOptions = [];
				rcmInsuranceOptions_p = [];
				rcmKmCharges = [];
				rcmKmCharges_p = [];
				rcmSeasonalRates = [];

				var results = data["results"];
				if (results["locations"]) rcmLocationInfo = results["locations"];
				if (results["officetimes"]) rcmOfficeTimes = results["officetimes"];
				if (results["categorytypes"]) rcmCategoryTypeInfo = results["categorytypes"];
				if (results["driverages"]) rcmDriverAgesInfo = results["driverages"];
				if (results["holidays"]) rcmHolidays = results["holidays"];
				if (results["locationfees"]) rcmLocationFees = results["locationfees"];
				if (results["availablecardetails"]) rcmAvailableCarDetails = results["availablecardetails"];
				if (results["availablecars"]) rcmAvailableCars = results["availablecars"];
				if (results["availablecars_p"]) rcmAvailableCars_p = results["availablecars_p"];
				if (results["mandatoryfees"]) rcmMandatoryFees = results["mandatoryfees"];
				if (results["mandatoryfees_p"]) rcmMandatoryFees_p = results["mandatoryfees_p"];
				if (results["optionalfees"]) rcmOptionalFees = results["optionalfees"];
				if (results["optionalfees_p"]) rcmOptionalFees_p = results["optionalfees_p"];
				if (results["insuranceoptions"]) rcmInsuranceOptions = results["insuranceoptions"];
				if (results["insuranceoptions_p"]) rcmInsuranceOptions_p = results["insuranceoptions_p"];
				if (results["kmcharges"]) rcmKmCharges = results["kmcharges"];
				if (results["kmcharges_p"]) rcmKmCharges_p = results["kmcharges_p"];
				if (results["seasonalrates"]) rcmSeasonalRates = results["seasonalrates"];

				rcmTaxInclusive = results.taxinclusive;
				if (results.taxrate >= 0) rcmTaxRate = results.taxrate;
				if (results.statetax >= 0) rcmStateTax = results.statetax;

				if (typeof fnCallBackStep2 == "function") {
					fnCallBackStep2();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmStep2Ready error, invalid jason", e);
		}
	} 
}
function rcmStep3Ready(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				// Init values before assigning results
				rcmDriverAgesInfo = [];
				rcmLocationFees = [];
				rcmAvailableCarDetails = [];
				rcmAvailableCars = [];
				rcmMandatoryFees = [];
				rcmOptionalFees = [];
				rcmInsuranceOptions = [];
				rcmKmCharges = [];
				rcmRentalSource = [];
				rcmCountries = [];
				rcmAreaOfUse = [];
				rcmSeasonalRates =[];

				var results = data["results"];
				if (results["driverages"]) rcmDriverAgesInfo = results["driverages"];
				if (results["locationfees"]) rcmLocationFees = results["locationfees"];
				if (results["availablecardetails"]) rcmAvailableCarDetails = results["availablecardetails"];
				if (results["availablecars"]) rcmAvailableCars = results["availablecars"];
				if (results["mandatoryfees"]) rcmMandatoryFees = results["mandatoryfees"];
				if (results["optionalfees"]) rcmOptionalFees = results["optionalfees"];
				if (results["insuranceoptions"]) rcmInsuranceOptions = results["insuranceoptions"];
				if (results["kmcharges"]) rcmKmCharges = results["kmcharges"];
				if (results["rentalsource"]) rcmRentalSource = results["rentalsource"];
				if (results["countries"]) rcmCountries = results["countries"];
				if (results["areaofuse"]) rcmAreaOfUse = results["areaofuse"];
				if (results["seasonalrates"]) rcmSeasonalRates = results["seasonalrates"];

				rcmTaxInclusive = results.taxinclusive;
				if (results.taxrate >= 0) rcmTaxRate = results.taxrate;
				if (results.statetax >= 0) rcmStateTax = results.statetax;

				if (typeof fnCallBackStep3 == "function") {
					fnCallBackStep3();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmStep3Ready error, invalid json", e);
		}
	}
}
function rcmBookingReady(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				var results = data["results"];
				rcmReservationRef = results.reservationref;
				rcmReservationNo = results.reservationno;
				rcmCustomerID = results.customerid;

				if (typeof fnCallBookingDone == "function") {
					fnCallBookingDone();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmBookingReady error, invalid json ", e);
		}
	}
}
function rcmCancelReasonsReady(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				rcmCancelReasons = data["results"];

				if (typeof fnCallBackCancelReasons == "function") {
					fnCallBackCancelReasons();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmBookingReady error, invalid json ", e);
		}
	}
}
function rcmCancelReady(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				rcmCancelInfo = data["results"];

				if (typeof fnCallCancelDone == "function") {
					fnCallCancelDone();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmBookingReady error, invalid json ", e);
		}
	}
}
function rcmWebItemsReady(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				rcmWebItems = data["results"];

				if (typeof fnCallBackWebItems == "function") {
					fnCallBackWebItems();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmStep1Ready error, invalid jason", e);
		}
	}
}
function rcmPaymentReady(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				rcmPaymentSaved = data["results"].paymentsaved;

				if (typeof fnCallPaymentDone == "function") {
					fnCallPaymentDone();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("rcmStep1Ready error, invalid jason", e);
		}
	}
}

function rcmGetUserReady(data) {
	if (data != "") {
		try {
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				// Init values before assigning results
				rcmUserData = data["results"];

				if (typeof fnCallBackGetUser == "function") {
					fnCallBackGetUser();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("error invalid jason", e);
		}
	}
}
function rcmGetURLReady(data) {
	if (data != "") {
		try {
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				// Init values before assigning results
				rcmURL = data["results"].url;
				var surl = rcmBase64.decode(rcmURL);
				if (document.getElementById(rcmURLObjID)) {
					document.getElementById(rcmURLObjID).src = surl;
				}
				if (typeof fnCallBackGetURL == "function") {
					fnCallBackGetURL();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("error invalid jason", e);
		}
	}
}
function rcmBookingInfoReady(data) {
	if (data != "") {
		try {
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;
				rcmBookingInfo = [];
				rcmCustomerInfo = [];
				rcmCompanyInfo = [];
				rcmRateInfo = [];
				rcmExtraFees = [];
				rcmPaymentInfo = [];
				rcmExtraDrivers = [];

				var results = data["results"];
				if (results["bookinginfo"]) rcmBookingInfo = results["bookinginfo"];
				if (results["customerinfo"]) rcmCustomerInfo = results["customerinfo"];
				if (results["companyinfo"]) rcmCompanyInfo = results["availablecardetails"];
				if (results["rateinfo"]) rcmRateInfo = results["rateinfo"];
				if (results["extrafees"]) rcmExtraFees = results["extrafees"];
				if (results["paymentinfo"]) rcmPaymentInfo = results["paymentinfo"];
				if (results["extradrivers"]) rcmExtraDrivers = results["extradrivers"];

				if (typeof fnCallBackBookingInfo == "function") {
					fnCallBackBookingInfo();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("error invalid jason", e);
		}
	}
}
function rcmLocationDetailsReady(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				rcmLocationDetails = data["results"];

				if (typeof fnCallBackLocationDetails == "function") {
					fnCallBackLocationDetails();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("error invalid jason", e);
		}
	}
}
function rcmAgentBookingsReady(data) {
	if (data != "") {
		try {
			var json = data;
			if (data["results"]) {
				rcmErr = data.status;
				rcmMsg = data.error;

				rcmAgentBookings = data["results"];

				if (typeof fnCallBackAgentBookings == "function") {
					fnCallBackAgentBookings();
				} else if (typeof fnCallBack == "function") {
					fnCallBack();
				}
			}
		} catch (e) {
			console.log("error invalid jason", e);
		}
	}
}
function SetDebugInfo(pErr, pMsg, pDbg) {
	rcmErr = pErr;
	rcmMsg = pMsg;
	rcmDebug = pDbg;
	if (typeof fnCallBack == "function") {
		fnCallBack();
	}
}
var rcmBase64 = {
	_keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
	encode: function (input) {
		var output = "";
		var chr1, chr2, chr3, enc1, enc2, enc3, enc4;
		var i = 0;
		input = rcmBase64._utf8_encode(input);

		while (i < input.length) {
			chr1 = input.charCodeAt(i++);
			chr2 = input.charCodeAt(i++);
			chr3 = input.charCodeAt(i++);
			enc1 = chr1 >> 2;
			enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
			enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
			enc4 = chr3 & 63;
			if (isNaN(chr2)) {
				enc3 = enc4 = 64;
			} else if (isNaN(chr3)) {
				enc4 = 64;
			}
			output = output +
			this._keyStr.charAt(enc1) + this._keyStr.charAt(enc2) +
			this._keyStr.charAt(enc3) + this._keyStr.charAt(enc4);
		}
		return output;
	},
	decode: function (input) {
		var output = "";
		var chr1, chr2, chr3;
		var enc1, enc2, enc3, enc4;
		var i = 0;
		input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

		while (i < input.length) {
			enc1 = this._keyStr.indexOf(input.charAt(i++));
			enc2 = this._keyStr.indexOf(input.charAt(i++));
			enc3 = this._keyStr.indexOf(input.charAt(i++));
			enc4 = this._keyStr.indexOf(input.charAt(i++));
			chr1 = (enc1 << 2) | (enc2 >> 4);
			chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
			chr3 = ((enc3 & 3) << 6) | enc4;
			output = output + String.fromCharCode(chr1);
			if (enc3 != 64) {
				output = output + String.fromCharCode(chr2);
			}
			if (enc4 != 64) {
				output = output + String.fromCharCode(chr3);
			}
		}
		output = rcmBase64._utf8_decode(output);
		return output;
	},
	_utf8_encode: function (string) {
		string = string.replace(/\r\n/g, "\n");
		var utftext = "";

		for (var n = 0; n < string.length; n++) {
			var c = string.charCodeAt(n);

			if (c < 128) {
				utftext += String.fromCharCode(c);
			}
			else if ((c > 127) && (c < 2048)) {
				utftext += String.fromCharCode((c >> 6) | 192);
				utftext += String.fromCharCode((c & 63) | 128);
			}
			else {
				utftext += String.fromCharCode((c >> 12) | 224);
				utftext += String.fromCharCode(((c >> 6) & 63) | 128);
				utftext += String.fromCharCode((c & 63) | 128);
			}
		}
		return utftext;
	},
	_utf8_decode: function (utftext) {
		var string = "";
		var i = 0;
		var c = c1 = c2 = 0;

		while (i < utftext.length) {
			c = utftext.charCodeAt(i);

			if (c < 128) {
				string += String.fromCharCode(c);
				i++;
			}
			else if ((c > 191) && (c < 224)) {
				c2 = utftext.charCodeAt(i + 1);
				string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
				i += 2;
			}
			else {
				c2 = utftext.charCodeAt(i + 1);
				c3 = utftext.charCodeAt(i + 2);
				string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
				i += 3;
			}
		}
		return string;
	}
};
function rcmGetdate(offset) {
	if (!offset) offset = 0;
	var dd = new Date();
	if (offset > 0) dd.setDate(dd.getDate() + offset);
	var yyyy = dd.getFullYear().toString();
	var mm = (dd.getMonth() + 1).toString();
	var dd = dd.getDate().toString();
	return '' + (dd[1] ? dd : "0" + dd[0]) + '/' + (mm[1] ? mm : "0" + mm[0]) + '/' + yyyy;
}
function rcmGetDW(ds, format) {
	var dd = Date.parseDate(ds, format);
	return dd.getDay() + 1;
}
function rcmStrToDate(ds, format) {
	var dd = Date.parseDate(ds, format);
	return dd;
}
function rcmDayDiff(objname1, objname2, format) {
	var dd1 = rcmStrToDate(document.getElementById(objname1).value, format);
	var dd2 = rcmStrToDate(document.getElementById(objname2).value, format);
	var retval = (dd1 - dd2) / (1000 * 60 * 60 * 24);
	return retval;
}
function rcmIsJsonString(str) {
	try {
		JSON.parse(str);
	} catch (e) {
		return false;
	}
	return true;
}
function rcmStrOut(strval,slen) {
	var retval = strval;
	if (strval!==undefined) {
		retval = retval.replace(rcm_text, '').replace(/,/g, ".").replace(/(?:\r\n|\r|\n)/g, ' ').replace(/\t/g, ' ');

		if (slen !== undefined) {
			if (rcm_number.test(retval) == false) {
				if (retval.length > slen) retval = retval.substring(0, slen);
			}
		}
	}
	return retval;
}
function rcmValidatedate(chkdate) {
  
  /* KDuncan 23/03/2016 old function replaced because errors */
  var retval = false;
  if (chkdate.length != 10) {
    retval = false;
  } else {
    //1. check for d/m/y
    var parts = chkdate.split('/');
    if (parts.length != 3) {
      //2. check for d-m-y
      parts = chkdate.split('-');
    }
    if (parts.length == 3) {
      //special rule for month - make sure it's not > 12
      var month = Number(parts[1]);
      if (month > 12) {
        retval = false;
      } else {
        // new Date(year, month , day)
        // Note: months are 0-based so subtract 1
        var tstDate = new Date(parts[2], (month - 1), parts[0]);
        if (tstDate.toString() == "NaN" || tstDate.toString() == "Invalid Date" || tstDate.toString() == "0") {
          retval = false;
        } else {
          retval = true;
        }
      }
    } else {
      retval = false;
    }
  }
	return retval;
}
function rcmGetOptStr() {
	var retVal = "";
	for (j in rcmSelOptionalFees) {
		if (retVal == "")
			retVal = rcmSelOptionalFees[j]["id"] + ":" + rcmSelOptionalFees[j]["qty"];
		else
			retVal = retVal + "," + rcmSelOptionalFees[j]["id"] + ":" + rcmSelOptionalFees[j]["qty"];
	}
	return retVal;
}