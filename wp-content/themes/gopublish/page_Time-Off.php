<?php
/*
Template Name: Time-Off Request
*/
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Time off Request</title>
</head>
<body>
<DIV align=center>
<CENTER></CENTER></DIV>
<P align=center><FONT size=4 face=Arial><B>EPG Media, LLC</B></FONT></P>
<P align=center><FONT size=4 face=Arial><B>SCHEDULED AND UNSCHEDULED<BR>TIME OFF REQUEST FORM</B></FONT></P>
<DIV align=center>
<CENTER>
<TABLE width=620 border=1>
<TBODY>
<TR>
<TD width="100%"><!-- ************************* Beginning of form ******************************* -->
<FORM onsubmit="return validate()" method=post name=Myform action=http://www.epgmediallc.com/time-off-confirmation/>
<TABLE cellSpacing=3 width="100%" border=0>
<TBODY>
<TR>
<TD width="100%"><FONT size=2 face=Arial><B>EMPLOYEE NAME:</B></FONT> <INPUT maxLength=21 name=employee>&nbsp; <B><FONT size=2 face=Arial>DATE SUBMITTED:</FONT></B> <!-- ************************* Enter Date Stamp Here *************************** --><INPUT maxLength=8 size=9 value=04/22/13 name=date_submitted>
<SCRIPT language=Javascript>var today = new Date()
var month = today.getMonth()
var day = today.getDate()
var year = today.getFullYear()
var s = "/"
var monthname;
   if (month == 0) monthname = "01";
   if (month == 1) monthname = "02";
   if (month == 2) monthname = "03";
   if (month == 3) monthname = "04";
   if (month == 4) monthname = "05";
   if (month == 5) monthname = "06";
   if (month == 6) monthname = "07";
   if (month == 7) monthname = "08";
   if (month == 8) monthname = "09";
   if (month == 9) monthname = "10";
   if (month == 10) monthname = "11";
   if (month == 11) monthname = "12";
var dayname;
   if (day == 01) day = "01";
   if (day == 02) day = "02";
   if (day == 03) day = "03";
   if (day == 04) day = "04";
   if (day == 05) day = "05";
   if (day == 06) day = "06";
   if (day == 07) day = "07";
   if (day == 08) day = "08";
   if (day == 09) day = "09";
   
var yearname;
   if (year == 2000) yearname = "00";
   if (year == 2001) yearname = "01";
   if (year == 2002) yearname = "02";
   if (year == 2003) yearname = "03";
   if (year == 2004) yearname = "04";
   if (year == 2005) yearname = "05";
   if (year == 2006) yearname = "06";
   if (year == 2007) yearname = "07";
   if (year == 2008) yearname = "08";
   if (year == 2009) yearname = "09";
   if (year == 2013) yearname = "13";if (year == 2010) yearname = "10";
document.Myform.date_submitted.value = monthname + s + day + s + yearname;

function validate(){
if (!checktextbox(document.Myform.employee,"Please enter your First and Last name!"))
   return false;
 if (!checkdate(document.Myform.date_submitted))
   return false;
 if(!check_paytype())
   return false;
 if(!checktextbox(document.Myform.requesting,"Please enter Time Off requested!"))
   return false;   
 if (!checkdate(document.Myform.datefrom))
   return false; 
 if (!checkdate(document.Myform.dateto))
   return false;   
 if(!checktextbox(document.Myform.reason,"Please enter Comment!"))
   return false;
 if(!checktextbox(document.Myform.email,"Please enter Your E-mail address!"))
   return false;
 if(document.Myform.supervisor.value == "none"){
  alert("Please select your Supervisor");
  document.Myform.supervisor.focus();
  return false;
  }
}
// ************ check for empty Textboxes ********** 
function checktextbox(textbox,message){
 if (textbox.value == ""){
  alert(message);
  textbox.focus();
  return false;
  }
  else
  return true;
}
// *********** check for valid Date entries **********  
function checkdate(date){
 var valid_date = 0;
 if (date.value.length !=8)
  valid_date = -1;
 if (date.value.charAt(2) != "/" || date.value.charAt(5) != "/")
  valid_date = -1;
 if (valid_date == -1){
  alert("Please enter date in this format 09/15/00");
  date.focus(); 
  return false;
  }
 else
 return true;
}
// ************** is Pay Type selected *************** 
function check_paytype(){
 var paytype = -1
 for (i=0; i<document.Myform.pay_type.length; i++){
  if (document.Myform.pay_type[i].checked)
   paytype = i;
          }
  if (paytype == -1){
   alert("You must select paid, unpaid or sick");
   return false;
          }
  else      
  return true;
}
// ************** is Day or Hour selected ************ 
function check_dayhour(){
 var dayhour = -1
 for (c=0; c<document.Myform.days_or_hours.length; c++){
  if (document.Myform.days_or_hours[c].checked)
         dayhour = c;
         }
       if (dayhour == -1){
         alert("You must select day or hour!");
    return false;
         }
       else
  return true;
}
</SCRIPT>
 <FONT color=#ff0000 size=1>(ex: 11/17/13)</FONT><BR><FONT size=1 face=Arial>PLEASE FILL OUT ALL AREAS THAT APPLY TO YOUR REQUEST, ANY INCOMPLETE FORMS WILL BE SENT BACK . YOUR COOPERATION IS APPRECIATED</FONT></TD></TR>
<TR>
<TD width="100%">
<P align=center><B><FONT size=3 face=Arial>TIME OFF REQUEST FORM</FONT></B> </P></TD></TR>
<TR>
<TD width="100%">
<P><FONT face=Arial>Each employee must submit this request form to his/her manager at least five (5) working days prior to the "planned" day(s) off. Requested time off is subject to manager's approval, and priority is given on a <B><I><U>"First Come First Serve Basis"</U></I></B>.</FONT></P></TD></TR>
<CENTER>
<TR>
<TD width="100%"></TD></TR>
<TR>
<TD width="100%">
<P align=center></P></TD></TR>
<TR>
<TD width="100%"></TD></TR>
<TR>
<TD width="100%">
<P align=center><B><FONT size=3 face=Arial>SCHEDULED AND UNSCHEDULED</FONT></B> </P></TD></TR>
<TR>
<TD width="100%">
<P><FONT face=Arial>If you have <B><I><U>not yet accrued</U></I></B> or have used all of your <B>PAID TIME OFF</B>, you may request <B>UNPAID TIME OFF</B>. This is subject to management approval.</FONT></P></TD></TR>
<CENTER>
<TR>
<TD width="100%"><FONT size=3 face=Arial><U><B>INDICATE:</B></U></FONT></TD></TR>
<TR>
<TD width="100%"><FONT face=Arial>Please indicate if this time is <INPUT type=radio value=vacation name=pay_type> <B>vacation</B> <INPUT type=radio value=float name=pay_type> <B>Floating Holiday</B> <INPUT type=radio value=unpaid name=pay_type><B>unpaid </B>or <INPUT type=radio value=sick name=pay_type> <B>sick</B> time off.</FONT></TD></TR>
<TR>
<TD width="100%"><FONT face=Arial>Number of <INPUT CHECKED type=radio value=days name=days_or_hours>Day(s) or <INPUT type=radio value=hours name=days_or_hours>Hour(s) requested in the box: <INPUT maxLength=3 size=3 name=requesting></FONT></TD></TR>
<TR>
<TD width="100%"><FONT face=Arial>Date(s) Requested (Please indicate month, day and year)<BR>From: <INPUT maxLength=8 size=9 name=datefrom> To: <INPUT maxLength=8 size=9 name=dateto> </FONT><FONT color=#ff0000 size=1>(ex: 11/17/13)</FONT></TD></TR>
<TR>
<TD width="100%">
<P><FONT face=Arial>Reason for request</FONT><FONT face=Arial><BR><TEXTAREA rows=6 cols=50 name=reason></TEXTAREA></P></FONT></TD></TR>
<TR>
<TD width="100%"><FONT size=2 face=Arial><B>Your E-mail Account: </B></FONT><INPUT maxLength=35 size=30 name=email AUTOCOMPLETE="OFF">&nbsp; <B><FONT size=2 face=Arial>Send To:</FONT> </B><SELECT size=1 name=supervisor> <OPTION selected value=none>Select Supervisor</OPTION> <OPTION value=m.ch.adams@gmail.com>Mark Adams</OPTION> <OPTION value=amy.collins@boatingindustry.com>Amy Collins</OPTION> <OPTION value=dmcmahon@powersportsbusiness.com>Dave McMahon</OPTION> <OPTION value=jeff.patterson@goodsam.com>Jeff Patterson</OPTION> <OPTION value=jprusak@snowgoer.com>John Prusak</OPTION> <OPTION value=troorda@goodsamfamily.com>Terry Roorda</OPTION> <OPTION value=angela.schmieg@goodsam.com>Angela Schmieg</OPTION> <OPTION value=jonathan.sweet@boatingindustry.com>Jonathon Sweet</OPTION> <OPTION value=mtuttle@ridermagazine.com>Mark Tuttle</OPTION> <OPTION value=mtomei@specialtyim.com>Mary Jo Tomei</OPTION> <OPTION value=bwohlman@ridermagazine.com>Bernadette Wohlman</OPTION></SELECT></TD></TR>
<TR>
<TD><FONT color=red size=1 face=arial>(Please make sure you type in your email address correctly.)</FONT><BR>&nbsp;</TD></TR>
<TR>
<TD width="100%"><INPUT type=submit value="Submit your request"> <INPUT type=reset value="Clear form"> </TD></TR></TBODY></TABLE></FORM></CENTER></CENTER></TD></TR></TBODY></TABLE></CENTER></DIV>

</body>
</html>