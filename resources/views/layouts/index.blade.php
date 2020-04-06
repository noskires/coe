@extends('layouts.master')

@section('content')

@if(Auth::user()->hasRole('admin|fulfiller'))

<script type="text/ng-template" id="admin.view">
@include('admin.admin')
</script> 

<script type="text/ng-template" id="role.view">
@include('role.role')
</script> 

<script type="text/ng-template" id="permission.view">
@include('permission.permission')
</script> 

<script type="text/ng-template" id="selfservice.view">
@include('user.selfservice')
</script> 

<script type="text/ng-template" id="originalsignature.view">
@include('user.originalsignature')
</script> 


<!-- old -->

<script type="text/ng-template" id="fulfiller_assigned_to_me.view">
@include('fulfiller.fulfiller_assigned_to_me')
</script>

<script type="text/ng-template" id="fulfiller_all_request.view">
@include('fulfiller.fulfiller_all_request')
</script>

<script type="text/ng-template" id="walkin.view">
@include('walkin.walkin')
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

@else

<script type="text/ng-template" id="selfservice.view">
@include('user.selfservice_user')
</script> 

<script type="text/ng-template" id="originalsignature.view">
@include('user.originalsignature_user')
</script> 

@endif

@endsection
