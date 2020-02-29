@extends('layout.master')

@section('content')

    <script type="text/ng-template" id="selfservice.view">
    @include('user.selfservice')
    </script> 

    <script type="text/ng-template" id="originalsignature.view">
    @include('user.originalsignature')
    </script> 

@endsection
