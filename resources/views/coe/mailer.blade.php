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
    
  </style>
</head>

<body>

    <div class="content-wrap">
        Your one time passcode : <b>{{$otp}}</b>
    </div>

</body>
</html>

