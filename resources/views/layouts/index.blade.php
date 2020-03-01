@extends('layouts.master')

@section('content')

<script type="text/ng-template" id="selfservice.view">
@include('user.selfservice')
</script> 

<script type="text/ng-template" id="originalsignature.view">
@include('user.originalsignature')
</script> 


 

<!-- old -->

<script type="text/ng-template" id="fulfiller.view">
@include('coe.fulfiller')
</script> 

<script type="text/ng-template" id="walkin.view">
@include('coe.walkin')
</script> 

<script type="text/ng-template" id="coe.view">
@include('coe.coe')
</script> 

<script type="text/ng-template" id="coe.details.view">
@include('coe.coe_details')
</script> 

<script type="text/ng-template" id="coe.details_admin.view">
@include('coe.coe_details_admin')
</script> 

<script type="text/ng-template" id="purpose.view">
@include('purpose.purpose')
</script>

<script type="text/ng-template" id="type.view">
@include('type.type')
</script>

<script type="text/ng-template" id="audit.view">
@include('audit.audit')
</script>

@endsection
