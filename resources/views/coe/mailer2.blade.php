<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mail</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
</head>

<body>
      <center>
      
        
        <table width="50%">
        <tr>
          <td colspan="2">
          <div style="width: 350px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 14px;
        line-height: 24px;
        font-family: Arial;
        color: #555;
        border-top: 5px solid #007bff;">
        </div>
          </td>
        </tr>
        <tr>
          <td align="right" width="55%"> Reference #: </td>
          <td align="right"> <a href="http://svrmdbhris02/online-coe/original-signature/print/{{Crypt::encrypt($coe_code)}}">{{$coe_code}}</a> </td>
        </tr>
        <tr>
          <td align="right">Requested at: </td>
          <td align="right">{{$created_at}}</td>
        </tr>
        <tr>
          <td colspan="2"> <br> <hr> </td>
        </tr>
        <tr>
          <td colspan="2" style="font-family: Times News Roman; font-size: 15px;"><center><h1>Certificate of Employment</center></h1></td>
        </tr>
        </table>
        <table width="50%">
        <tr>
          <td width="25%" style="border-bottom: 1px solid #eee;">Requestor </td>
          <td width="75%" style="border-bottom: 1px solid #eee;">{{$name}}</td>
        </tr>
        <tr style="border-bottom: 1px solid #eee;">
          <td style="border-bottom: 1px solid #eee;">Type of Request </td>
          <td style="border-bottom: 1px solid #eee;">{{$type_desc}}</td>
        </tr>
        <tr style="border-bottom: 1px solid #eee;">
          <td style="border-bottom: 1px solid #eee;">Purpose </td>
          <td style="border-bottom: 1px solid #eee;">{{$purpose_desc}}</td>
        </tr>
        <tr style="border-bottom: 1px solid #eee;">
          <td style="border-bottom: 1px solid #eee;">Assigned to </td>
          <td style="border-bottom: 1px solid #eee;">{{$changed_by}}</td>
        </tr>
        <tr style="border-bottom: 1px solid #eee;">
          <td style="border-bottom: 1px solid #eee;">Remarks</td>
          <td style="border-bottom: 1px solid #eee;">{{$remarks}}</td>
        </tr>
      </table>
    </center>
</body>
</html>

