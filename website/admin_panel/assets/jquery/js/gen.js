// JavaScript Document

	//	Got tired of looking at the repeated blocks of JS validation code in which 
	//	only the names of the forms and the controls differed, and are repeated in
	//	several include files for each module or set of ASPs.
	//	
	//	This is a generic approach to achieving almost the same, with considerably
	//	less repetitive effort, bulk, and less maintenance headache.  It includes 
	//	the feature that validations for an INPUT should be set as custom attributes
	//	in the HTML itself, so the programmer can change them in the ASP file instead
	//	of having to dig out an include file and laboriously hack it, testing that
	//	the changes haven"t broken anything else...
	//	
	//	The validation depends on:
	//		a) This entire SCRIPT element being included in the generated output
	//			to the browser, preferably within the HEAD element of the document,
	//			as a script src="/genvalidation.js" type="text/javascript" tag. (I haven"t
	//			put in the angle brackets here).
	//		b)	The submit button of the form calling this function from its
	//			onClick event handler, passing "this.form" as its only parameter.
	//		c)	The inputs requiring validation having their VALIDATION attribute
	//			coded with the necessary keywords & values.. e.g.:
	//				INPUT TYPE=text NAME=txtTest1 VALUE="" VALIDATION="required;"
	//				INPUT TYPE=text NAME=txtTest2 VALUE="" VALIDATION="required;numeric"
	//				INPUT TYPE=text NAME=txtXYZDate VALUE="" 
	//					VALIDATION="required$Please enter XYZ date;date$Please enter a valid XYZ date"
	//	
	//			Obviously, if no validation is required for an INPUT, either don"t include
	//			the VALIDATION attribute for that INPUT, or give it a zero-length string.
	//			The accepted combinations of keywords (must be semi-colon-separated, like above)
	//			are listed below.  Also, rather obvious, but I"d better mention it anyway - don"t
	//			include contradictory validations like alphabetic and numeric (or alphabetic and
	//			date) for the same INPUT.  I don"t know if my code will stand up to it, but the
	//			greater likelihood is that you will drive the users of your page up the wall. :^\
	//
	//			Like in the VALIDATION attribute of txtXYZDate in the example above, optional 
	//			error/prompt messages can be embedded within the keyword clause, separated by a 
	//			dollar sign.  If such a message is provided, then it will be shown to the user on 
	//			that control failing validation.  Otherwise, a default message based on the type 
	//			of validation requested, and the name of the control, will be shown.  Better your
	//			own messages than mine... :-)
	//
	//		Accepted VALIDATION keywords (may be combined as long as they are not contradictory):
	//			*	required			(entry in that field is compulsory)
	//			*	optional			(rather obvious, but used if you want to enforce a data TYPE 
	//									 check for an optional field - a date field could be optional,
	//									 but once user enters something in it, it HAS to be a valid date...)
	//			*	numeric			(do I need to explain this?)
	//			*	alphabetic		( --do-- )
	//			*	date				(will default to British format - if you want any other format,
	//									 I regret you will have to write your own function and hack the 
	//									"date" case in the main switch statement to call yours).
	//	
	//		The following are additional keywords that can be combined with one of the above
	//		primary keywords to enhance the validation done.  The additional keywords are
	//		specific to the type of primary validation done.
	//
	//	For alphabetic fields:
	//		* maxlength(numOfChars)												//obvious??
	//		* minlength(numOfChars)
	//		Combine the first two for a length-range or fixed-length string validation.
	//
	//	For date fields:
	//		* abovesysdate			date should be greater than system date
	//		* belowsysdate			simple?
	//
	//	***Pending***:
	//		* abovedate(mindate)	date should be greater than literal given.
	//		* belowdate(maxdate)	
	//		Comparison with value of another INPUT in the same form:
	//		* datebelowfield(NameOfOtherInputInSameForm) 
	//		* dateabovefield(NameOfOtherInputInSameForm) 
	//			Combine any two of above six to get an effective range check, either between two literal dates
	//			or one literal and the other the system date. When comparing against another control (INPUT),
	//			that control must already contain a valid date, and it will be validated before comparing.
	//		Within some number of days from the given date literal:
	//		* datediff(NameOfOtherInputInSameForm, MaxNoOfDays)	
	//			MaxNoOfDays could be +ve or -ve. 
	//			If +ve then interpreted as "upto x no. of days AFTER date value in specified control",
	//			if -ve then interpreted as "upto x no. of days BEFORE date value in specified control".
	//		Within some number of days from system date:
	//		* sysdatediff(MaxNoOfDays)	
	//			MaxNoOfDays could be +ve or -ve. 
	//			If +ve then interpreted as "upto x no. of days AFTER system date",
	//			if -ve then interpreted as "upto x no. of days BEFORE system date".
	//
	//	For numeric fields:
	//		Ceiling/floor comparisons against given numeric literals:
	//		* belowvalue(maxvalue)
	//		* abovevalue(minvalue)
	//		Ceiling/floor comparisons against value of another INPUT in the same form:
	//		* valuebelowfield(NameOfOtherInputInSameForm)
	//		* valueabovefield(NameOfOtherInputInSameForm)
	//			Combine any two of the above four to get a range check, either between two literal values
	//			or one literal and the other the value of another control (INPUT).  The other control
	//			must already contain a valid number, and it will be validated before comparing.
	// For any fields:
	//	*** cascaded (dependent) checks: to be done only if a "parent" control is supplied with a value
	// (like a checkbox which is checked by user, or a field which has non-empty value) 
	//
	//	Also, need to decide a way to specify required choice of one of a series of option (radio) btns-
	// perhaps could wrap them in a DIV and put the attrib in the DIV element??
	// Hmmm, an "either-of" validation, where at least one, or both, of a pair of inputs ( or more?)
	//	must have a value; if one is entered then the user isn"t bugged about the other.  Subsequent
	//	validations as far as date/numeric/alpha etc. are considered can be embedded for each input.
	//
	//	SELECTs can only have the required keyword (one non-blank option must be selected). Any other
	//	keyword put in the VALIDATION attribute for a SELECT will be ignored.

	var bTrace = false;	//Toggle for trace alerts.
	var eventSource;		//For tracking source of the submission of the form - Save/Delete button?
	
	function ValidateForm(frmToValidate)
	{

		var bValid;
		var elem, i, sValidation, sElemType;
		
		bValid = true;	//Default return value; changed if a validation is failed.
		
		//To prevent validation occurring if Back or Delete buttons are pressed.
		//the eventSource var is defined before beginning of this function and 
		//set by function StoreEventSource at bottom of this page.
		if (eventSource != null && eventSource != undefined)
		{
			bTrace && alert(eventSource);
			if(eventSource.indexOf("Delete") > -1 || eventSource.indexOf("Back") > -1 )
			{
				return bValid;
			}
		}
		
		//	Loop over all the elements in the passed form,
		//	checking for those which have a VALIDATION attribute
		//	which is NOT zero-length.
		for (i = 0; i < frmToValidate.elements.length; i++)
		{
			elem = frmToValidate.elements[i];
			sElemType = elem.getAttribute("type");
			if (sElemType == null || sElemType == undefined)
			{	//This is the !@#$%& Mozilla Gecko engine - returns getAttribute("type") values for hidden, submit,
				// reset, button, but not for input/select-one/textarea. !@#$%& !@#$%&...
				sElemType = elem.type;
			}
			bTrace && alert(elem.name + " - " + sElemType + ": " + elem.getAttribute("VALIDATION"));
			
			if("[select] [select-one] [text] [textarea] [radio] [password]".indexOf("[" + sElemType.toLowerCase() + "]" ) > -1)
			{
				sValidation = elem.getAttribute("VALIDATION");
				if ((sValidation == null || sValidation == undefined) || sValidation.length == 0)
				{
					continue;
				}
				bValid = ValidateElement(elem, sValidation, frmToValidate);
				if (false == Boolean(bValid))
				{
					return bValid;	//Found an error? Don"t do any more checks, get out!
				}
			}
		}
		//If tracing a non-cooperating validation, ask for confirmation to allow the
		//page to be submitted, if no failed validations have been found.
		return (!bTrace ? bValid : (bValid && confirm("No more validations - continue?")) );
	}
	
	function ValidateElement(elemToChk, sValidation, frmToValidate)
	{
		var arrValidations, i, bElementValid
		
		bElementValid = true;	//Yup, still optimistic! ;-)
		
		//found that my new conditional check "when" gets destroyed if subjected
		// to the normal processing below, so am handling it as an "outsider special case".
		if (sValidation.slice(0,4) == "when")
		{
			//alert("say when -- " + sValidation);
			bElementValid = DoConditionalCheck(elemToChk, sValidation, frmToValidate);
			return bElementValid;
		}
		
		//	Break up the value of the attribute based on the semi-colon separator, 
		// then invoke various functions to perform the requested validation.
		arrValidations = sValidation.split(";");
		for (i = 0; i < arrValidations.length; i++)
		{
			// If an optional message is embedded in this clause, separate it out from the keyword.
			var sErrMsg = "";
			var arrClause = arrValidations[i].split("$");
			var sKeyWord = arrClause[0];
			
			if (arrClause.length >= 1)
			{
				sErrMsg = arrClause[1];
			}
			
			//added a grammar check to catch misspelt keywords.
			if (! IsValidKeyword(sKeyWord) )
			{
				return false;
			}
			
			switch (sKeyWord)
			{
				case "optional" : 
					bElementValid = true;
					break;
				case "required" : 
					switch (Coalesce(elemToChk.getAttribute("type"), elemToChk.type))
					{
						case "select-one" :
							bElementValid = CheckOptionSelected(elemToChk, sErrMsg);
							break;
						case "radio" :
							bElementValid = CheckOneOfRadiosChecked(elemToChk, sErrMsg, frmToValidate);
							break;
						default :
							bElementValid = DoRequiredCheck(elemToChk, sErrMsg);
							break;
					}
					break;
				case "numeric" :
					bElementValid = DoNumericCheck(elemToChk, sErrMsg);
					break;
				case "alphabetic" :
					bElementValid = DoAlphaCheck(elemToChk, sErrMsg);
					break;
				case "date" :
					bElementValid = DoBritDateCheck(elemToChk, sErrMsg);
					break;
				default : 
					// The "advanced" checks are put into a sub-function to keep this area cleaner :-)
					bElementValid = DoOtherChecks(sKeyWord, elemToChk, sErrMsg, frmToValidate)
			}
			if ( bElementValid == false)
			{
				return bElementValid;	//Found an error? Don"t do any more checks, get out!
			}
		}
		return bElementValid;
	}
	/*email check created by vasu on 10th july. this function will check whether the email 
	entered by the user is valid or not. it will just check for the ####@####.### format.
	later will try to add by verifying the server for the domain name*/
	/*function DoEmailCheck(elemToChk,sErrMsg)
	{
			alert(elemToChk.value);
		emailCheck(elemT0Chk,sErrMsg);
		
		var i,x=0, info
			info=elemToChk.value

			for(i=0;i<info.length;i++)
			{
				if(info.charAt(i)=="@")	{			
					x=i;
					break;
				}
				else
					send=false;
			}

			if(x>1)
			{
				for(i=x;i<info.length;i++)
				{
					if(info.charAt(i)=="."){
						send=true;
						break;
						}
					else
						send=false;
				}
			}
			else
			{
					send=false;
			}
		if (i+1==info.length)
			send=false;
			
		if(send==true)
		{
			return true;
		}
		else
		{
			var sDefErrMsg="Please enter a valid data for " + SanitizedControlName(elemToChk);
			return BugUser(elemToChk, sDefErrMsg, sErrMsg);
		} 
	}*/
	function DoEmailCheck(elemToChk,sErrMsg) {
emailStr=elemToChk.value;
/* The following variable tells the rest of the function whether or not
to verify that the address ends in a two-letter country or well-known
TLD.  1 means check it, 0 means don"t. */

var checkTLD=1;

/* The following is the list of known TLDs that an e-mail address must end with. */

var knownDomsPat=/^(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum)$/i;

/* The following pattern is used to check if the entered e-mail address
fits the user@domain format.  It also is used to separate the username
from the domain. */

var emailPat=/^(.+)@(.+)$/;

/* The following string represents the pattern for matching all special
characters.  We don"t want to allow special characters in the address. 
These characters include ( ) < > @ , ; : \ " . [ ] */

var specialChars="\\(\\)><@,;:\\\\\\\"\\.\\[\\]";

/* The following string represents the range of characters allowed in a 
username or domainname.  It really states which chars aren"t allowed.*/

var validChars="\[^\\s" + specialChars + "\]";

/* The following pattern applies if the "user" is a quoted string (in
which case, there are no rules about which characters are allowed
and which aren"t; anything goes).  E.g. "jiminy cricket"@disney.com
is a legal e-mail address. */

var quotedUser="(\"[^\"]*\")";

/* The following pattern applies for domains that are IP addresses,
rather than symbolic names.  E.g. joe@[123.124.233.4] is a legal
e-mail address. NOTE: The square brackets are required. */

var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/;

/* The following string represents an atom (basically a series of non-special characters.) */

var atom=validChars + "+";

/* The following string represents one word in the typical username.
For example, in john.doe@somewhere.com, john and doe are words.
Basically, a word is either an atom or quoted string. */

var word="(" + atom + "|" + quotedUser + ")";

// The following pattern describes the structure of the user

var userPat=new RegExp("^" + word + "(\\." + word + ")*$");

/* The following pattern describes the structure of a normal symbolic
domain, as opposed to ipDomainPat, shown above. */

var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");

/* Finally, let"s start trying to figure out if the supplied address is valid. */

/* Begin with the coarse pattern to simply break up user@domain into
different pieces that are easy to analyze. */

var matchArray=emailStr.match(emailPat);

if (matchArray==null) {

/* Too many/few @"s or something; basically, this address doesn"t
even fit the general mould of a valid e-mail address. */

//alert("Email address seems incorrect (check @ and ."s)");
var sDefErrMsg="Please enter a valid data for " + SanitizedControlName(elemToChk);
return BugUser(elemToChk, sDefErrMsg, sErrMsg);
return false;
}
var user=matchArray[1];
var domain=matchArray[2];

// Start by checking that only basic ASCII characters are in the strings (0-127).

for (i=0; i<user.length; i++) {
if (user.charCodeAt(i)>127) {
alert("Ths username contains invalid characters.");
return false;
   }
}
for (i=0; i<domain.length; i++) {
if (domain.charCodeAt(i)>127) {
alert("Ths domain name contains invalid characters.");
return false;
   }
}

// See if "user" is valid 

if (user.match(userPat)==null) {

// user is not valid

alert("The username doesnt seem to be valid.");
return false;
}

/* if the e-mail address is at an IP address (as opposed to a symbolic
host name) make sure the IP address is valid. */

var IPArray=domain.match(ipDomainPat);
if (IPArray!=null) {

// this is an IP address

for (var i=1;i<=4;i++) {
if (IPArray[i]>255) {
alert("Destination IP address is invalid!");
return false;
   }
}
return true;
}

// Domain is symbolic name.  Check if it"s valid.
 
var atomPat=new RegExp("^" + atom + "$");
var domArr=domain.split(".");
var len=domArr.length;
for (i=0;i<len;i++) {
if (domArr[i].search(atomPat)==-1) {
alert("The domain name does not seem to be valid.");
return false;
   }
}

/* domain name seems valid, but now make sure that it ends in a
known top-level domain (like com, edu, gov) or a two-letter word,
representing country (uk, nl), and that there"s a hostname preceding 
the domain or country. */

if (checkTLD && domArr[domArr.length-1].length!=2 && 
domArr[domArr.length-1].search(knownDomsPat)==-1) {
alert("The address must end in a well-known domain or two letter " + "country.");
return false;
}

// Make sure there"s a host name preceding the domain.

if (len<2) {
alert("This address is missing a hostname!");
return false;
}

// If we"ve gotten this far, everything"s valid!
return true;
}


	//end of email check
	function DoRequiredCheck(elemToChk, sErrMsg)
	{
		var bZeroLength = false;
		
		if (elemToChk.value.length == 0)
		{
			bZeroLength = true;
		}
		else
		{
			//Strip off spaces and CRLFs from the input value
			var sValWithoutWhiteSpace = elemToChk.value.replace(/\s*/g,"");
			if(sValWithoutWhiteSpace.length == 0)
			{
				bZeroLength = true;
			}
		}

		if (bZeroLength == true)
		{
			var sDefErrMsg = "Please provide a value for " + SanitizedControlName(elemToChk);
			return BugUser(elemToChk, sDefErrMsg, sErrMsg);
		}
		else
		{
			return true;
		}
	}

	function DoNumericCheck(elemToChk, sErrMsg)
	{
		// Before doing a numeric check, we should obviously 
		// invoke a Required check on it; however, there is 
		// the option to make a field optional, only if user
		// HAS entered something in it, then that MUST be a
		// numeric value. So we can"t force a Required check!
		
		if (elemToChk.value.length > 0)
		{
			if ( isNaN(elemToChk.value))
			{
				var sDefErrMsg = SanitizedControlName(elemToChk) + " only allows numeric values!" ;
				return BugUser(elemToChk, sDefErrMsg, sErrMsg);
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;	//This could be an optional check, remember? It shouldn"t
								//fail just "cos the field"s empty...
		}
	}
	
	function DoAlphaCheck(elemToChk, sErrMsg)
	{
		//Required check not enforced - see DoNumericCheck comment.
		if (elemToChk.value.length > 0)
		{
			// If a search for characters NOT in the set between
			// (upper-case) A and (lower-case) z returns a match,
			// then the string is not entirely alphabetic - it 
			// contains non-alphabetic characters.
			
			if (elemToChk.value.search(/([^A-z])/) != -1)
			{
				var sDefErrMsg = SanitizedControlName(elemToChk) + 
				" only allows alphabetic values (A to Z) and (a to z) " ;
				return BugUser(elemToChk, sDefErrMsg, sErrMsg);
			}
			else
			{
				return true;
			}
		}
		else
		{
			return true;	//Could be an optional check, shouldn"t fail "cos the field"s empty...
		}
	}
	
	function DoBritDateCheck(elemToChk, sErrMsg)
	{
		// Like the name says, this function only passes valid dates 
		// in British format, and flunks everything else.
		// Strictly dd/mm/yyyy format.
		// The "actual" checking is split out into another function
		// since this one is centred around validating an element of
		// a form and is not able to validate a date string.  This way,
		//	date strings that are part of the VALIDATION attributes 
		//	abovedate(nn) and belowdate(nn), also the date difference
		//	checking functions that accept a literal value, can use that
		// function to check that they are dealing with a valid British
		//	date format.
		// Required check not enforced - see DoNumericCheck comment.
		if (elemToChk.value.length == 0)
		{
			return true;	//Could be an optional check, shouldn"t fail "cos the field"s empty...
		}
		else
		{
			var sDateString = elemToChk.value;
			if (! IsValidBritishDateString(sDateString) )
			{
				var sDefErrMsg = SanitizedControlName(elemToChk) + 
				" only allows valid dates in British format (dd/mm/yyyy) " ;
				return BugUser(elemToChk, sDefErrMsg, sErrMsg);
			}
			else
			{
				return true;
			}
		}
	}	// end function DoBritDateCheck
	
	function DoOtherChecks(sKeyWord, elemToChk, sErrMsg, frmToValidate)
	{
		
		// - extract the actual keyword for switch compare.
		// - knock off the keyword & brackets for function-like 
		//		keywords; what"s left will be the parameters.. 
		//		which we then split & use
		
		//If there"s no bracket, only element zero will be
		//populated, but we"ll only check for higher subscripts
		//for some particular types of check - see below.
		var sKeywordPieces = sKeyWord.split("(")
		//maxlength(numOfChars)
		//minlength(numOfChars)
		//abovesysdate
		//belowsysdate
		//abovedate(mindate)
		//belowdate(maxdate)
		//datebelowfield(NameOfOtherInputInSameForm) 
		//dateabovefield(NameOfOtherInputInSameForm)
		//datediff(NameOfOtherInputInSameForm, MaxNoOfDays)
		//sysdatediff(MaxNoOfDays)
		//belowvalue(maxvalue)
		//abovevalue(minvalue)
		//valuebelowfield(NameOfOtherInputInSameForm)
		//valueabovefield(NameOfOtherInputInSameForm)
		//when(<condn>,check1$msg1;check2$msg2...)
		//email
		
		switch (sKeywordPieces[0])
		{
			case "maxlength" :
				return DoLengthCheck(sKeywordPieces, elemToChk, sErrMsg, "<=");
			case "minlength" :
				return DoLengthCheck(sKeywordPieces, elemToChk, sErrMsg, ">=");
			case "abovesysdate" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					if ( DoBritDateCheck(elemToChk, sErrMsg) )
					{
						return DoDateEvalComp(elemToChk, sErrMsg, JSDateFromBritish(elemToChk.value), ">", new Date());
					}
					else
					{
						return false;
					}
				}
			case "belowsysdate" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					if ( DoBritDateCheck(elemToChk, sErrMsg) )
					{
						return DoDateEvalComp(elemToChk, sErrMsg, JSDateFromBritish(elemToChk.value), "<", new Date());
					}
					else
					{
						return false;
					}
				}
			case "belowdate" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Check the input date first to make sure it"s a valid one.
					if ( DoBritDateCheck(elemToChk, sErrMsg) )
					{
						//Get the date literal from the split-ted KeyWord array, knocking 
						//	off the closing bracket.
						var sDateLiteral = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
						//Check that the literal is also a valid British format date string.
						if (! IsValidBritishDateString(sDateLiteral) )
						{
							return false;
						}
						return DoDateEvalComp(elemToChk, sErrMsg, 
									JSDateFromBritish(elemToChk.value), "<", JSDateFromBritish(sDateLiteral) );
					}
					else
					{
						return false;
					}
				}
			case "abovedate" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Check the input date first to make sure it"s a valid one.
					if ( DoBritDateCheck(elemToChk, sErrMsg) )
					{
						//Get the date literal from the split-ted KeyWord array, knocking 
						//	off the closing bracket.
						var sDateLiteral = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
						//Check that the literal is also a valid British format date string.
						if (! IsValidBritishDateString(sDateLiteral) )
						{
							return false;
						}
						return DoDateEvalComp(elemToChk, sErrMsg, 
									JSDateFromBritish(elemToChk.value), ">", JSDateFromBritish(sDateLiteral) );
					}
					else
					{
						return false;
					}
				}
			case "datediff" :
			case "sysdatediff" :
			case "belowvalue" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Check the input value first to make sure it"s a valid number.
					if ( DoNumericCheck(elemToChk, sErrMsg) )
					{
						//Get the numeric literal from the split-ted KeyWord array, knocking 
						//	off the closing bracket.
						var sNumLiteral = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
						//Check that the literal is also a valid no.
						if ( isNaN(sNumLiteral) )
						{
							return false;
						}
						else
						{
							return DoNumericEvalComp(elemToChk, sErrMsg, 
									Number(elemToChk.value), "<", Number(sNumLiteral) );
						}
					}
					else
					{
						return false;
					}
				}
			case "abovevalue" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Check the input value first to make sure it"s a valid number.
					if ( DoNumericCheck(elemToChk, sErrMsg) )
					{
						//Get the numeric literal from the split-ted KeyWord array, knocking 
						//	off the closing bracket.
						var sNumLiteral = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
						//Check that the literal is also a valid no.
						if ( isNaN(sNumLiteral) )
						{
							return false;
						}
						else
						{
							return DoNumericEvalComp(elemToChk, sErrMsg, 
										Number(elemToChk.value), ">", Number(sNumLiteral) );
						}
					}
					else
					{
						return false;
					}
				}
				
				
			case "abovetxt" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					var sOtherInputName = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
						//Get a reference to the other input using eval and the known JS/DOM shortcut
						//	of providing a property of the form object for every member control, by its
						//	own name.
						var OtherInput = eval("frmToValidate." + sOtherInputName);
					 //Check the input value first to make sure it"s a valid number.
					//Get the numeric literal from the split-ted KeyWord array, knocking 
						
									if( elemToChk.value != OtherInput.value ){
											
											alert(sErrMsg);
											return false ;
										}
									else
									{
									    return true;	
									}
										
				}

			case "valuebelowfield" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Check the input value first to make sure it"s a valid number.
					if ( DoNumericCheck(elemToChk, sErrMsg) )
					{
						//Get the name of the other field from the split-ted KeyWord array,
						//	knocking off the closing bracket.
						var sOtherInputName = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
						//Get a reference to the other input using eval and the known JS/DOM shortcut
						//	of providing a property of the form object for every member control, by its
						//	own name.
						var OtherInput = eval("frmToValidate." + sOtherInputName)
						
						//Check that the other field also contains a valid no.
						var sErrorMsg = SanitizedControlName(OtherInput) + " must contain a valid number!";
						if (! DoNumericCheck(OtherInput, sErrorMsg) )
						{
							return false;
						}
						else
						{
							return DoNumericEvalComp(elemToChk, sErrMsg, 
										Number(elemToChk.value), "<", Number(OtherInput.value) );
						}
					}
					else
					{
						return false;
					}
				}
			case "valueabovefield" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Check the input value first to make sure it"s a valid number.
					if ( DoNumericCheck(elemToChk, sErrMsg) )
					{
						//Get the name of the other field from the split-ted KeyWord array,
						//	knocking off the closing bracket.
						var sOtherInputName = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
						//Get a reference to the other input using eval and the known JS/DOM shortcut
						//	of providing a property of the form object for every member control, by its
						//	own name.
						var OtherInput = eval("frmToValidate." + sOtherInputName)
						
						//Check that the other field also contains a valid no.
						var sErrorMsg = SanitizedControlName(OtherInput) + " must contain a valid number!";
						if (! DoNumericCheck(OtherInput, sErrorMsg) )
						{
							return false;
						}
						else
						{
							return DoNumericEvalComp(elemToChk, sErrMsg, 
										Number(elemToChk.value), ">", Number(OtherInput.value) );
						}
					}
					else
					{
						return false;
					}
				}
			case "datebelowfield" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Get name of other field from split-ted KeyWord array, removing closing bracket.
					var sOtherInputName = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
					//Get reference to other input 
					var OtherInput = eval("frmToValidate." + sOtherInputName)
					//Check the other control"s value; if "parent" control is empty, return true.
					if (OtherInput.value.replace(/\s*/g,"").length == 0)
					{
						return true;
					}
					//If not empty, proceed to check the value in other control.
					if ( DoBritDateCheck(OtherInput, "") )
					{
						return DoDateEvalComp(elemToChk, sErrMsg, 
									JSDateFromBritish(elemToChk.value), "<", JSDateFromBritish(OtherInput.value) );
					}
					else
					{
						return false;
					}
				}
			case "dateabovefield" :
				//Check must be optional and return true if the control is empty (nothing other than whitespace).
				if (elemToChk.value.replace(/\s*/g,"").length == 0)
				{
					return true;
				}
				else
				{
					//Get name of other field from split-ted KeyWord array, removing closing bracket.
					var sOtherInputName = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
					//Get reference to other input 
					var OtherInput = eval("frmToValidate." + sOtherInputName)
					//Check the other control"s value; if "parent" control is empty, return true.
					if(OtherInput.value.replace(/\s*/g,"").length == 0)
					{
						return true;
					}
					//If not empty, proceed to check the value in other control.
					if ( DoBritDateCheck(OtherInput, "") )
					{
						return DoDateEvalComp(elemToChk, sErrMsg, 
									JSDateFromBritish(elemToChk.value), ">", JSDateFromBritish(OtherInput.value) );
					}
					else
					{
						return false;
					}
				}
				//added to suit the email validation
				case "email" :
					//return false;
					return DoEmailCheck(elemToChk,sErrMsg);
					break;
		}
	}

	function DoConditionalCheck(elemToChk, sValidation, frmToValidate)
	{
		//Cascaded check.
		//Sample VALIDATION string passed in sValidation:
		//		"when(<condn>#check1$msg1;check2$msg2...)"
		//We already know that the keyword is "when", so let"s discard that, and the brackets, 
		//	then get hold of the condition and the actual validation to be performed.
		
		//Strip the ending bracket
		var sTemp = sValidation.slice(0, sValidation.length - 2);
		//Strip the "when" keyword and leading bracket.
		var sTemp = sValidation.replace(/when\(/gi, "");
		
		var sKeywordPieces = sTemp.split("#");
		//Extract check condition from split-ted KeyWord array.
		var sCondn = sKeywordPieces[0];
		//Extract actual validation from split-ted KeyWord array.
		var sActualValidation = sKeywordPieces[1];
		
		//if any control-name prefixes like txt/txa/cmb/opt/sel/hdn/cmd are present in
		// the check condition, it"s likely they are meant to refer to the controls in
		// the form, so we will provide them with a default object for JS to query, using
		// the with() statement and passing the form object.  The eval statement uses
		// variables accessible in the current scope, so we are safe passing frmToValidate.
		/*
		if (sActualValidation.search(/txt/) != -1 ||
			 sActualValidation.search(/txa/) != -1 ||
			 sActualValidation.search(/cmb/) != -1 ||
			 sActualValidation.search(/opt/) != -1 ||
			 sActualValidation.search(/sel/) != -1 ||
			 sActualValidation.search(/hdn/) != -1 ||
			 sActualValidation.search(/cmd/) != -1
			)
		{
			//Provide string to be evalled with default object
			sCondn = "with (frmToValidate) {" + sCondn + "}"
		}
		*/
		sCondn = "(" + sCondn + ");";

		var bCondnTrue = eval(sCondn);
		//alert(sCondn + " - " + bCondnTrue.toString());
		if (bCondnTrue == true)
		{
			//Perform the "actual" validation.
			//alert(sActualValidation);
			return ValidateElement(elemToChk, sActualValidation, frmToValidate);
		}
		else
		{
			return true;	// validation to be enforced only when condition true, otherwise input deemed valid.
		}
	}
	
	function DoLengthCheck(sKeywordPieces, elemToChk, sErrMsg, sCheckType)
	{
		if ( DoRequiredCheck(elemToChk,sErrMsg) )
		{
			//Get the length parameter from the split-ted KeyWord array, knocking 
			//	off the closing bracket.
			var nReqdLength = sKeywordPieces[1].slice(0, sKeywordPieces[1].indexOf(")"));
			var sToEval = "(" + String(elemToChk.value.length) + sCheckType + nReqdLength + ")"

			var bPasses = eval(sToEval);
			if (bPasses == true)
			{
				return true;
			}
			else
			{
				var sDefErrMsg = SanitizedControlName(elemToChk) + 
				" accepts a " 
				+ (sCheckType == "<=" ? "maximum" : "minimum") + 
				" length of " + nReqdLength + " characters.";
				return BugUser(elemToChk, sDefErrMsg, sErrMsg);
			}
		}
		else
		{
			return false;
		}
	}
	
	function DoDateEvalComp(elemToChk, sErrMsg, dtDate1, sOperator, dtDate2)
	{
		var sToEval = 
		"(" + dtDate1.valueOf() + sOperator +  dtDate2.valueOf() + " ) " 

		//alert(sToEval);
		var bPasses = eval(sToEval);
		if (bPasses == true)
		{
			return true;
		}
		else
		{
			var sDefErrMsg = SanitizedControlName(elemToChk) + 
			" must have a date that is " 
			+ (sOperator == "<" ? "before " : "after ") + 
			dtDate2.getDate() + "/" + (dtDate2.getMonth() + 1 )+ "/" + dtDate2.getFullYear();

			return BugUser(elemToChk, sDefErrMsg, sErrMsg);
		}
	}

	function CheckOneOfRadiosChecked(elemToChk, sErrMsg, frmToValidate)
	{
		//Unable to find a way to get a ref to only the array of radio buttons which
		//	I want to check, so am using the brute force method to avoid wasting more
		//	time on this.
		
		var bChecked = false;
		var sRadioButtonArrayName = elemToChk.name;

		//locate any one control in the whole form with the same name and type, which is checked.
		//Short-circuit evaluation of JS ensures that the .checked property access will not occur
		// for non-radio button controls since the first half of the && expression will fail.
		for (var i = 0; i < frmToValidate.elements.length; i++)
		{
			if (	(frmToValidate.elements[i].name == sRadioButtonArrayName &&
					 Coalesce(frmToValidate.elements[i].getAttribute("type"), frmToValidate.elements[i].type) == "radio"
					) &&
					frmToValidate.elements[i].checked
				)
			{
				bChecked = true;
				break;		//Found a checked radio button - get out of here - expensive loop!
			}
		}    
	   
	   //After the whole loop is over, if bChecked is STILL false, then none of the 
	   //	radio buttons in the array were checked =:~(
		if (! bChecked)
	   {
			var sDefErrMsg = SanitizedControlName(elemToChk) + 
			" only allows valid dates in British format (dd/mm/yyyy) " ;
			return BugUser(elemToChk, sDefErrMsg, sErrMsg);
		}
		else
		{
			return true;
		}
	}

	// -- -- --  -- -- --  -- -- --  -- -- --  -- -- -- 
	// Common functions follow.
	function IsValidBritishDateString(sDateToCheck)
	{
		//----------------------------------------------------------
		// IsLeapYear is a Nested function since it won"t be used 
		//	anywhere else in this script. (As of first writing, that is).
	 	function IsLeapYear(nYear)
		{
			if (nYear % 400==0 )
			{
				return true;
			}
			else 
			{
				if (nYear % 100 != 0 && nYear % 4 == 0 )
				{
					return true;
				}
				else
				{
					return false;
				}
			}
		}
		//----------------------------------------------------------
		
		//slice syntax :-
		//slice(beginslice[, endSlice])
		//		beginSlice: zero-based index at which to begin extraction. 
		//		endSlice: zero-based index at which to end extraction. If omitted, extract to end of string. 
		//					 slice extracts up to, but not including endSlice.
		// d	d		/		m	m		/		y	y	y	y	
		// 0	1		2		3	4		5		6	7	8	9 
		var sDayPart = sDateToCheck.slice(0,2)
		var sMonthPart = sDateToCheck.slice(3,5)
		var sYearPart = sDateToCheck.slice(6)

		// Series of checks, each of which could return an error.
		// If none of them do, we finally return a true value.

		if (sDayPart == null || sMonthPart == null || sYearPart == null)
		{
			return false;
		}
		
		// The date parts have to all be numeric, no?
		if (isNaN(sDayPart) || isNaN(sDayPart) || isNaN(sDayPart))
		{
			return false;
		}
		var nDay = Number(sDayPart);
		var nMonth = Number(sMonthPart);
		var nYear = Number(sYearPart);
		
		// Part range checks. Year earlier than 1970 not allowed by JS1.2 & lower.
		//Year check commented as it was not checking for the year < 1970.
		if ( 	(nDay < 1 || nDay > 31)		||
				(nMonth < 1 || nMonth > 12)	/*||
				(nYear < 1970)*/
			)
		{
			return false;
		}
		
		// Check for correct No. of Days for different months 
		if ( (nMonth == 4 || nMonth == 6 || nMonth == 9 || nMonth == 11) && nDay > 30)
		{
			return false;
		}
		
		// Check for four-digit year
		if (nYear / 1000 < 1 || nYear / 10000 >= 1 || sYearPart.length != 4)	        
		{
			return false;
		}
		// February : Day shouldn"t be over 28 unless Leap Year.
		if (nMonth == 2)
		{
			if ( (IsLeapYear(nYear) && nDay > 29) || ( ! IsLeapYear(nYear) && nDay > 28) )
			{
				return false;
			}
		}
		// If not bombed out yet, date string is valid.
		return true;
	}

	function BugUser(elementToFocus, sDefErrMsg, sCustomErrMsg)
	{
		var sDispErrMsg = Coalesce(sCustomErrMsg, sDefErrMsg);
		alert(sDispErrMsg);
		MakeActiveControl(elementToFocus);
		return false;
	}
	
	function Coalesce(operand1, operand2)
	{
		//Using short-circuit evaluation features to first check if operand1 is null or 
		// undefined; if not, then check if it actually contains any valid non-whitespace stuff.
		if ((operand1 == null || operand1 == undefined) || 
			 (String(operand1).length == 0 || String(operand1).replace(/\s*/g,"").length == 0)
			)
		{
			if ((operand2 == null || operand2 == undefined) || 
				 (String(operand2).length == 0 || String(operand2).replace(/\s*/g,"").length == 0)
				)
			{
				return "";
			}
			else
			{
				return String(operand2);
			}
		}
		else
		{
			return String(operand1);
		}
	}
	
	function SanitizedControlName(elemToChk)
	{
		var sBaseName = elemToChk.name;
		var sReturnName = "";
		
		// See JavaScript manual for RegExp before attempting
		// to change the regular expressions in the replaces.
		
		// Strip off the (usually) 3-letter prefix like txt, txa
		// which is all lowercase.
		sReturnName = sBaseName.replace(/^[a-z]{3}/,"");
		
		// For the rest, insert a space before uppercase letters, 
		// and return the resultant string.
		sReturnName = sReturnName.replace(/([A-Z])/g," $1");

		return sReturnName;
	}
	
	// Focus the passed control, if text within it can 
	// be selected, select it..
	function MakeActiveControl(elemToChk)
	{
		elemToChk.focus();

		var sElemType = elemToChk.getAttribute("TYPE");
		if (sElemType == null || sElemType == undefined)
		{
			sElemType = elemToChk.type;
		}
		
		// Dunno if case-sensitivity applies for the attribute name,
		// but at least I"ll make a feeble attempt to overcome that.
		if (sElemType.length == 0)
		{
			sElemType = elemToChk.getAttribute("type");
		}
		
		// Convert the value to lower-case for easier comparison.
		sElemType = sElemType.toLowerCase();
		if (sElemType == "text" || sElemType == "textarea" || sElemType == "password")
		{
			elemToChk.select();
		}
	}
	function JSDateFromBritish(sBritishFormatDate)
	{
		var arrDate = sBritishFormatDate.split("/");
		arrDate[1] = Number(arrDate[1]) - 1;	// JS dates" months are zero-based, DAMN the idiots who thought of it!
		return new Date(arrDate[2], arrDate[1], arrDate[0]);
	}

	function CheckOptionSelected(elemToChk, sErrMsg)
	{
		if ( (elemToChk.selectedIndex < 0) || 
				elemToChk.options[elemToChk.selectedIndex].value == "" ||
				elemToChk.options[elemToChk.selectedIndex].value == "-1"
			)
		{
			var sDefErrMsg = "Please select an option in " + SanitizedControlName(elemToChk);
			return BugUser(elemToChk, sDefErrMsg, sErrMsg);
		}
		else
		{
			return true;
		}
	}

	function DoNumericEvalComp(elemToChk, sErrMsg, nNum1, sOperator, nNum2)
	{
		var sToEval = 
		"(" + nNum1 + sOperator + nNum2 + " ) " 

		//alert(sToEval);
		var bPasses = eval(sToEval);
		if (bPasses == true)
		{
			return true;
		}
		else
		{
			var sDefErrMsg = SanitizedControlName(elemToChk) + 
			" must have a value that is " 
			+ (sOperator == "<" ? "less than " : "greater than ") + nNum2;

			return BugUser(elemToChk, sDefErrMsg, sErrMsg);
		}
	}

	function IsValidKeyword(sKeyWord)
	{
		var sWordToCheck;
		//Since this func is called before the switch to determine if it is a complex keyword (with a bracket)
		//I am checking and splitting in this function itself.
		
		var sValidKeywords = "[required] [numeric] [optional] [date] [alphabetic] [abovesysdate]";
		sValidKeywords += 	"[belowsysdate] [maxlength]  [minlength] [abovedate] [belowdate] [datebelowfield]";
		sValidKeywords += 	"[belowvalue] [abovevalue]  [abovetxt] [valuebelowfield] [valueabovefield] [when] [email]";
		
		bTrace && alert(sValidKeywords);
		
		if (sKeyWord.indexOf("(")> -1)
		{
			var sTemp = sKeyWord.split("(")
			sWordToCheck = sTemp[0];
		}
		else
		{
			sWordToCheck = sKeyWord;
		}

		bTrace && alert(sWordToCheck);
		//alert(sWordToCheck);
		if ( sValidKeywords.indexOf("[" + sWordToCheck + "]") > -1 )
		{
			return true;
		}
		else
		{
			alert("GenValidation script :- " + sWordToCheck +" is not a valid keyword!");
			return false;
		}
	}
	//----------------------------------------------------------------------------

	//Installed as mousedown event handler for the window; receives notification
	//when user presses mouse button anywhere in page; stores the name of the
	//source element in a page-level var "eventSource", which is referred to by
	//the main ValidateForm function, to check if user is submitting form with the
	//Delete or Back button, in which case no validation should be done.
	function StoreEventSource(evnt) 
	{
		if (navigator.userAgent.indexOf("MSIE") > -1)
		{
			eventSource = event.srcElement.name;
			return true;
		}
		else
		{
			eventSource = evnt.target.name;
			return true;
		}
	}

	var bNS_GECKO = false;
	var bMSIE = false ;
	if (navigator.userAgent.indexOf("MSIE") != -1)
	{
		bMSIE = true;
	}
	else if(navigator.userAgent.indexOf("Gecko") > -1)
	{
		//for netscape 6 or above (anant infotech)
		bNS_GECKO = true;
		window.captureEvents(Event.SUBMIT);
		window.onSubmit="return ValidateForm(document.forms[1]);";
	}

	window.onmousedown = StoreEventSource;	// Function def & comments few lines above.
//EOF