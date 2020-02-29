<!DOCTYPE html>

<style type="text/css">
body {
    font-size:14px;
    color: #000000;
}

.tbl_details tr td{
      padding:1px;
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
  top: 45%;
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
<div id="watermark">
    <!-- <img src="{{URL::to('assets/images/Logo PLDT.jpg')}}" style="margin-top:170px;margin-left:710px;height:1000px;"/> -->
</div>

<img src="assets/images/PLDT Logo.png" style="margin-top:10px;margin-left:20px;height:60px;"/>

@endif
<br>
<br>
<br>
<table width=90% border=0 align="center"> 
    <tr>
      <td align="center">
        <h3>CERTIFICATE OF EMPLOYMENT AND COMPENSATION</h3>
      </td> 
    </tr> 
</table>
<br>
<br>
<table width=90% border=0 align="center"> 
    <tr>
      <td align="right"> {{ date('F j, Y', strtotime($coe->created_at)) }}</td>
    </tr> 
    <tr>
      <td align="right"> {{$coe->coe_code}} </td>
    </tr>
</table>
<br>
<br>
<table width=90% border=0 align="center"> 
    <tr>
      <td style="text-align:justify;text-indent: 50px;"> This is to certify that {{strtoupper($coe->name2)}} is a {{$coe->employee_group_type01}} employee of PLDT Inc.
            since {{date('F j, Y', strtotime($coe->date_hired)) }} and
            presently holds the position of {{$coe->position}}. 
      </td>
      <!-- <td style="text-align:justify;text-indent: 50px;"> This is to certify that {{strtoupper($coe->name2)}} is a {{$coe->employee_group_type01}} employee of this company (PLDT Inc.)
            with office address of Ramon Cojuangco Building, Makati Ave, Corner Dela Rosa Street, Makati City, Philippines since {{date('F j, Y', strtotime($coe->date_hired)) }} and
            presently holds the position of {{$coe->position}}. 
      </td> -->
    </tr>
</table>

<br> 

<table width=90% border=0 align="center"> 
    <tr>
      <td align="left" style="text-indent: 50px;">{{ucfirst($coe->gender_type03)}} present basic monthly salary is P {{number_format($coe->salary, 2)}}.
      </td>
    </tr>
</table>
<br>
<table width=90% border=0 align="center">
    <tr>
      <td align="left" style="text-indent: 50px;">Further, {{$coe->gender_type01}} received the following bonuses, premiums and allowances during the twelve-month
        period: 
      </td>
    </tr>
</table>
<br>
<br>
<table width=60% border=0 align="center" class="tbl_details"> 
    <tr>
      <td width="70%"> Mid-Year Bonus </td>
      <td align="right"> {{number_format($coe->mid_year_bon, 2)}} </td>
    </tr>
    <tr>
      <td> Christmas Bonus/13th Month Pay </td>
      <td align="right"> {{number_format($coe->christmas_bon, 2)}} </td>
    </tr>
    <tr>
      <td> Longevity Pay</td>
      <td align="right"> {{number_format($coe->longevity_bon, 2)}}  </td>
    </tr> 
    <tr>
      <td> Unused Sick Leave Pay </td>
      <td align="right"> {{number_format($coe->uslp, 2)}} </td>
    </tr>
    <tr>
      <td> Other Earnings </td>
      <td align="right"> {{number_format($coe->allowances, 2)}} </td>
    </tr>
    <tr>
      <td> Other Bonuses </td>
      <td align="right" class="singleUnderline"> {{number_format($coe->other_bon, 2)}}</b> </td>
    </tr>
    <tr>
      <td> Total Other Income </td>
      <td align="right" class="doubleUnderline"> P {{number_format($coe->total_bon, 2)}} </b> </td>
    </tr>
</table>
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