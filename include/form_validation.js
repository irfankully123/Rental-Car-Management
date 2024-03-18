//
//	Copyright AJ Hulsebos 2006-2015, all rights reserved!
//  Allowed to use at own risk within any web-applications/web-site as is.
//	-----------------------------------------------------------------------------------------------------------------------
var email_pat = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*([,;]\s*\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*)*$/i;
var alpha_pat = /[^A-Za-z\s]/;
var alphaword_pat=/[^A-Za-z]/;
var numeric_pat=/[^0-9,\.-]/;
var alphanum_pat=/[^a-z0-9,\.\s\-]/i;
var alphanumword_pat=/[^a-z0-9,\.\-]/i;
var hexnum_pat = /[^0-9a-fA-F]/;
var time_pat = /^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/;
var date_pat = /^([0-3][0-9]\/)+[0-9]{4}$/;

function formValidator(frmname) {
	this.frmObj=document.forms[frmname];
	this.winObj=window;

	this.winObj.old_onload=null;
	if (this.winObj.onload) {
		this.winObj.old_onload=this.winObj.onload;
		this.winObj.onload=null;
	}
	
	this.winObj.onload=_frm_onload_handler;
	
	if	(!this.frmObj) {
		alert("Form object does not exist:"+frmname);
		return;
	}
	if (this.frmObj.onsubmit) {
		this.frmObj.old_onsubmit = this.frmObj.onsubmit;
		this.frmObj.onsubmit=null;
	} else {
		this.frmObj.old_onsubmit=null;
	}
	this.frmObj.onsubmit=_frm_submit_handler;
	this.addValidation = _add_validation;
	this.clearAllValidations = _clr_all_validations;
	this.Validate = _Validate;
}

function _frm_onload_handler(){
	initQueryVariable();
	if (this.old_onload) this.old_onload();
}

function _frm_submit_handler(frmObj) {
	var objFocus;
	var tstForm=true;
	var msgArr = new Array();
	for(var cnt=0;cnt < this.elements.length;cnt++) {
		if(this.elements[cnt].validate && !this.elements[cnt].validate.isValid()) {
			this.elements[cnt].style.borderColor = "red";
			if (!objFocus) objFocus=this.elements[cnt];
			msgArr[msgArr.length]=this.elements[cnt].validate.caption + ", " + this.elements[cnt].validate.msg; 

			tstForm=false;
		} else {
			frmObj.elements[cnt].style.borderColor = "";
		}
	}
	if (!tstForm) {
		var errMsg="";
		for (var cnt = 0; cnt < msgArr.length; cnt++) {
			errMsg+=(cnt+1)+" - "+msgArr[cnt]+"\n";
		}
		var objMsg=document.getElementById("choosetext");
		alert(objMsg.value+"\n\n"+errMsg);
		objFocus.focus();
	}
	return tstForm;
}

function _Validate(frmObj) {
	var objFocus;
	var tstForm = true;
	var msgArr = new Array();
	for (var cnt = 0; cnt < frmObj.elements.length; cnt++) {
		if (frmObj.elements[cnt].validate && !frmObj.elements[cnt].validate.isValid()) {
			frmObj.elements[cnt].style.borderColor = "red";
			if (!objFocus) objFocus = frmObj.elements[cnt];
			msgArr[msgArr.length] = frmObj.elements[cnt].validate.caption + ", " + frmObj.elements[cnt].validate.msg;

			tstForm = false;
		} else {
			frmObj.elements[cnt].style.borderColor = "";
		}
	}
	if (!tstForm) {
		var errMsg = "";
		for (var cnt = 0; cnt < msgArr.length; cnt++) {
			errMsg += (cnt + 1) + " - " + msgArr[cnt] + "\n";
		}
		var objMsg = document.getElementById("choosetext");
		alert(objMsg.value + "\n\n" + errMsg);
		objFocus.focus();
	}
	return tstForm;
}

function _add_validation(fldName,fldCaption,fldRequired,flddataType,fldCondition,fldMsg,fldValidation) {
	if (!this.frmObj) {
		alert("No form object");
		return;
	}
	var itemobj = this.frmObj[fldName];
	if (!itemobj) {
		alert("Item object["+fldName+"] is missing or not within this form["+this.frmObj.name+"]");
		return;
	}
	// Case radio or checkbox
	if (!itemobj.type && itemobj.length) {
		if (itemobj[0].type=="radio" || itemobj[0].type=="checkbox")
			itemobj[0].validate = new fieldObj(itemobj,fldCaption,fldRequired,flddataType,fldCondition,fldMsg,fldValidation);
	} else {
		itemobj.validate = new fieldObj(itemobj,fldCaption,fldRequired,flddataType,fldCondition,fldMsg,fldValidation);
	}
}

function _clr_all_validations() {
	for(var cnt=0;cnt<this.formobj.elements.length;cnt++) {
		this.formobj.elements[cnt].validate=null;
	}
}

function fieldObj(itemobj,fldCaption,fldRequired,dataType,fldCond,displMsg,fldValidation){
	this.itemObj=itemobj;
	this.caption=fldCaption;
	this.dataType=dataType;
	this.condition=fldCond;
	this.msg=displMsg;
	this.isRequired=fldRequired;
	this.ReqValidation=fldValidation;
	this.isValid=ChkIfValid;
}

function ChkIfValid() {
	var test=false;
	if (!this.itemObj.type && this.itemObj.length) {
		if (this.itemObj[0].type=="radio" || this.itemObj[0].type=="checkbox") {
			var fndvalue="";
			for(var cnt=0;cnt<this.itemObj.length;cnt++) {
				if (this.itemObj[cnt].checked) fndvalue+=this.itemObj[cnt].value+",";
			}
			if (fndvalue.charAt(fndvalue.length-1)==",") fndvalue=fndvalue.substr(0,fndvalue.length-1);
				test = ValidateItem(this.itemObj[0].name, this.itemObj[0].type, fndvalue, this.isRequired, this.dataType, this.condition, this.msg);
		} else test=true;
	} else {	
		if (this.itemObj.type=="radio" || this.itemObj.type=="checkbox")
			test = ValidateItem(this.itemObj.name, this.itemObj.type, this.itemObj.checked, this.isRequired, "boolean", this.condition, this.msg);
		else
			test = ValidateItem(this.itemObj.name, this.itemObj.type, this.itemObj.value, this.isRequired, this.dataType, this.condition, this.msg, this.ReqValidation);
	}
	return test;
}

function ValidateItem(name,type,value,isrequired,dataType,fldCond,displMsg,ReqValidation) {
	// no need to test rest if one of the folowing 2 conditions is met
	var retVal = false;
	if (fldCond) {
		if (eval(fldCond)) {
			try {
				if (isrequired == true && value.length == 0) return false;
				if (isrequired == false && value.length == 0) return true;
			} catch (e) { }
			retVal = dataChk(value, dataType, ReqValidation);
		} else retVal = true;
	} else {
		try {
			if (isrequired == true && value.length == 0) return false;
			if (isrequired == false && value.length == 0) return true;
		} catch (e) { }
		retVal = dataChk(value, dataType, ReqValidation);
	}
	return retVal;
}

function dataChk(value,dataType,ReqValidation) {
	var tstvalue = value;
	var retVal=false;
	switch (dataType.toLowerCase()) {
		case "alpha":
			retVal=!alpha_pat.test(tstvalue); 
			break;
		case "alphaword": // test for single word
			retVal=!alphaword_pat.test(tstvalue); 
			break;
		case "alphanumeric":
		case "alphanum":
		case "text":
		case "alphanumword":
			if (tstvalue!="") {
				retVal=true;
			}
			break;
		case "email":
			retVal=email_pat.test(tstvalue);
			break;
		case "date":
			retVal = validatedate(tstvalue);
			break;
		case "dd/mm/yyyy":
		case "dd-mm-yyyy":
		case "mm/dd/yyyy":
		case "mm-dd-yyyy":
			retVal = validatedateformat(tstvalue, dataType.toLowerCase());
			break;
		case "time":
			retVal = time_pat.test(tstvalue);
			break;
		case "boolean":
			var chk = eval(tstvalue);
			retVal=chk; 
			break;
		case "hexnum":
			retVal=!hexnum_pat.test(tstvalue);
			break;
		case "number":
		case "numeric":
			retVal=!numeric_pat.test(tstvalue);
			break;
		case "regexp":
			var re = new RegExp(ReqValidation, "gi");
			retVal=re.test(tstvalue);
			break;
	}
	return retVal;
}

function getQueryVariable(variable) {
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
		if (pair[0] == variable) {
			return pair[1];
		}
	} 
	alert('Query Variable ' + variable + ' not found');
}

// Function to init forms
function initQueryVariable() {
	var query = window.location.search.substring(1);
	var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
		var pair = vars[i].split("=");
		//alert("id:"+pair[0]+"="+pair[1]);
		var obj = document.getElementById(pair[0]);
		if (obj) {
			switch (obj.type) {
				case "select-one":
				case "text":
					obj.value=pair[1];
					break;
				case "textarea":
					obj.value=pair[1];
					break;
				case "checkbox":
					if (obj.value==pair[1]) obj.checked=true;
					break;
				default:
					break;
			}
		}
	} 
}

function validatedate(chkdate) {
	var retval = false;
	var tstDate = new Date(chkdate);

	if (tstDate.toString() == "NaN" || tstDate.toString() == "Invalid Date") {
		//Secondary test
		tstDate = Date.parseDate(chkdate, "d/m/Y");
		if (!tstDate || tstDate.toString() == "NaN" || tstDate.toString() == "Invalid Date") {
			//third test
			tstDate = Date.parseDate(chkdate, "d-m-Y");
			if (!tstDate || tstDate.toString() == "NaN" || tstDate.toString() == "Invalid Date") {
				retval = false;
			} else {
				retval = true;
			}
		} else {
			retval = true;
		}
	} else {
		retval = true;
	}
	return retval;
}

function validatedateformat(chkdate, format) {
	var retval = false;
	var tstfmt;
	var tstDate;
	var yyyy=0;
	var mm=0;
	var dd = 0;

	switch (format) {
		case "dd/mm/yyyy":
		case "mm/dd/yyyy":
			tstfmt = /^([\d]{1,2})\/([\d]{1,2})\/([\d]{4})$/;
			break;
		case "dd-mm-yyyy":
		case "mm-dd-yyyy":
			tstfmt = /^([\d]{1,2})-([\d]{1,2})-([\d]{4})$/;
			break;
	}

	var m = chkdate.match(tstfmt);
	if (m) {
		switch (format) {
			case "dd/mm/yyyy":
			case "dd-mm-yyyy":
				dd = m[1];
				mm = m[2];
				yyyy = m[3];
				break;
			case "mm/dd/yyyy":
			case "mm-dd-yyyy":
				dd = m[2];
				mm = m[1];
				yyyy = m[3];
				break;
		}
		//alert("Day:" + dd + ", Month:" + mm + ", year:" + yyyy);
		tstDate = new Date(yyyy, mm - 1, dd, 0, 0, 0, 0); //Date.parseDate(chkdate, format);
		//alert(tstDate);

		// Create test variables
		var tyyyy = tstDate.getFullYear().toString();
		var tmm = (tstDate.getMonth() + 1).toString();
		var tdd = tstDate.getDate().toString();
		//alert("Day:" + tdd + ", Month:" + tmm + ", year:" + tyyyy);

		if (!(!tstDate || tstDate.toString() == "NaN" || tstDate.toString() == "Invalid Date")) {
			//alert(dd + "==" + tdd + "," + mm + "==" + tmm + "," + yyyy + "==" + tyyyy + ":" + (parseInt(dd) == tdd && parseInt(mm) == tmm && parseInt(yyyy) == tyyyy));
			retval = (parseInt(dd)==tdd && parseInt(mm)==tmm && parseInt(yyyy)==tyyyy);
		}
	}
	return retval;
}
