<!DOCTYPE html>

<style type="text/css">
  body {
    font-size:14px;
  }
  .tbl_details tr td{
      padding:7px;
  }
  #watermark {
    position: fixed;
 
    width: 100%;
    text-align: center;
    opacity: .3; 
    transform-origin: 50% 50%;
    z-index: -1000;
  }

  footer {
    position: fixed; 
    bottom: -20px; 
    font-size: 10px;
    color:red;
    left: 0px; 
    right: 0px;
    height: 50px; 
    text-align: right;
    line-height: 35px;
    font-family: Helvetica;
  }

  .footer2 {
    position: fixed; 
    bottom: -25px; 
    font-size: 10px; 
    left: 0px; 
    right: 0px;
    height: 50px; 
    text-align: left;  
  } 

  .singleUnderline {
    border-bottom: 1px solid; 
  }

  .doubleUnderline {
    border-bottom: double 3px; 
  }

#watermark2 {
    position: fixed;
    top: 35%;
    font-size:50px;
    width: 100%;
    text-align: center;
    opacity: .6;
    transform: rotate(30deg);
    transform-origin: 50% 50%;
    z-index: -1000;
  }
  
</style>

<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>ONLINE COE</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

</head>
<body>
<div>
 
<div id="watermark2">
  SAMPLE ONLY! <br>
  DO NOT PRINT!
</div> 
@if($coe->is_with_logo!=0)
<img src="assets/images/PLDT Logo.png" style="margin-top:10px;margin-left:20px;height:60px;"/>
@endif 
<br>
<br>
<br>
<br>
<br>
<table width=90% border=0 align="center"> 
    <tr>
      <td align="right"> {{ date('F j, Y', strtotime($coe->created_at)) }}</td>
    </tr>
    <tr>
      <td align="right"> {{$coe->coe_code}} </td>
    </tr>
    <tr>
      <td align="left"> <b> TO WHOM IT MAY CONCERN: </b> </td>
    </tr>
  </table>
  <br>
  <br>
  <table width=90% border=0 align="center"> 
    <tr>
      <td align="left" style="text-indent: 50px;"> This is to certify that the following data are true and correct as indicated in the records of
      this company (PLDT Inc.) with office address of Ramon Cojuangco Building, Makati Ave, Corner Dela Rosa Street, Makati City, Philippines : 
      </td>
    </tr>
</table>

 
<br>
<br>
<br>
<br>
<table width=90% border=0 align="center" class="tbl_details"> 
    <tr>
      <td width="40%"> <b>ID NUMBER:</b> </td>
      <td style="border-bottom:1px solid #000000;"> <b>{{$coe->employee_code}}</b> </td>
    </tr>
    <tr>
      <td> <b>NAME OF EMPLOYEE:</b> </td>
      <td style="border-bottom:1px solid #000000;"> <b>{{$coe->name2}}</b> </td>
    </tr>
    <tr>
      <td> <b>DATE EMPLOYED:</b> </td>
      <td style="border-bottom:1px solid #000000;"> <b>{{date('F j, Y', strtotime($coe->date_hired)) }} up to present</b> </td>
    </tr> 
    <tr>
      <td> <b>DESIGNATION:</b> </td>
      <td style="border-bottom:1px solid #000000;"> <b>{{$coe->position}}</b> </td>
    </tr>
    <tr>
      <td> <b>PRESENT ORGANIZATION:</b> </td>
      <td style="border-bottom:1px solid #000000;"> <b>{{$coe->organization}}</b> </td>
    </tr>
    <tr>
      <td> <b>BASIC MONTHLY SALARY:</b> </td>
      <td style="border-bottom:1px solid #000000;"> 
        @if($coe->salary>0)
        <b>P {{number_format($coe->salary, 2)}}</b> 
        @else
        <b>Confidential</b>
        @endif
      </td>
    </tr>
</table>
<br>
<br>
<br>
<br>
<table width=90% border=0 align="center"> 
    <tr>
      <td align="left" style="text-indent: 50px;">This certification is issued upon employee's request for {{$coe->purpose_desc}} purposes.
      </td>
    </tr>
</table>
<br>
<br>
<br>
<br>
@if($coe->is_with_signature!=0)
<table width=90% border=0 align="center">
    <tr>
      <td width="65%"> </td>
      <td align="center"> 
        Renelia L. Villanueva <br>
        Head <br>
        HRIS & Automation
      </td>
    </tr>  
</table>
@endif
<br>
<br>
<table width=90% border=0 align="center" class="footer2"> 
  @if($coe->is_with_signature==0)
  <tr>
    <td style="font-size:10px;font-weight:strong;"> 
      *** THIS IS ELECTRONICALLY GENERATED. SIGNATURE NOT REQUIRED. ***
    </td>
  </tr>
  @endif
  <tr>
    <td style="font-size:10px;"> 
      *** Must be an original computer printout without erasures to be valid. *** <br>
      *** For verification pls. contact: (632) 584-0255/0261/0264 every Tuesdays and Thursdays 8:00-12:00 nn and 1:00-5:00 pm only; or
      email us at HRISAdvisory@pldt.com.ph.***  
    </td>
  </tr>  
</table>

</div>
@if($coe->is_with_logo!=0)
<footer>
    <div>PLDT General Office P.O. Box 2148 Makati City, Philippines</div><div style="margin-top:-20px;">PLD1</div>
</footer>
@endif  
</body>
</html>