<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Mail</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <style type="text/css">
    body{
      font-size:16px;
    }

    label{
      color:black;
    }
    
    .fade.in {
      opacity: 1;
    }

    .modal.in .modal-dialog {
      -webkit-transform: translate(0, 0);
      -o-transform: translate(0, 0);
      transform: translate(0, 0);
    }

    .modal-backdrop.in {
      filter: alpha(opacity=50);
      opacity: .5;
    }

    @media (min-width: 768px) {
      .modal-xlg {
        width: 90%;
        max-width:1500px; 
        margin-top:100px;
        font-size:10px;
      }
    }


    .td1{
      padding:3px;
      border:1px solid #000000;
    }
    
  </style>
</head>

<body>

 
    <div>
      <table width="50%" align="center" cellpadding="0" cellspacing="0" class="td1">
        <!-- <tr> <td style="background-color: red;">  </td> </tr> -->
        <tr>
          <td class="td1" width="30%"> REFERENCE# </td>
          <td class="td1"> <a href="http://svrmdbhris02/online-coe/original-signature/print/{{Crypt::encrypt($coe_code)}}">{{$coe_code}}</a> </td>
        </tr>
        <tr>
          <td class="td1"> REQUESTOR </td>
          <td class="td1"> {{$name}} </td>
        </tr>
        <tr>
          <td class="td1"> TYPE OF REQUEST </td>
          <td class="td1"> {{$type_desc}} </td>
        </tr>
        <tr>
          <td class="td1"> PURPOSE </td>
          <td class="td1"> {{$purpose_desc}} </td>
        </tr>
        <tr>
          <td class="td1"> REQUESTED AT </td>
          <td class="td1"> {{$created_at}} </td>
        </tr>
        <tr>
          <td class="td1"> ASSIGNED TO </td>
          <td class="td1"> {{$changed_by}} </td>
        </tr>
        <tr>
          <td class="td1"> REMARKS </td>
          <td class="td1"> {{$remarks}} </td>
        </tr>
      </table>
    </div>

</body>
</html>

