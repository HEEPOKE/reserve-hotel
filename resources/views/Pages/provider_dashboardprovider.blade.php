@extends('adminlte::page')
@section('content')
    @php
        date_default_timezone_set('Asia/Bangkok');

        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $yearTH = date('Y') + 543;

        $num = 1;

        $countuser_company = count($user_company) ?? '0';
        $countrenew = count($renew_contract) ?? '0';
        $counttry = count($tryuse) ?? '0';

    @endphp
    @include('layouts.dashboardprovider.header')
    @include('layouts.dashboardprovider.topdashboard')
    @include('layouts.dashboardprovider.middashboard')
    @include('layouts.dashboardprovider.bottomdashboard')

@endsection
