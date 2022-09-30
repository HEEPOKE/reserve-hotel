@extends('adminlte::page')
@section('content')
    @php
        $num = 1;

        date_default_timezone_set('Asia/Bangkok');

        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $yearTH = date('Y') + 543;

        $Ccountreserve = count($reserve) ?? '0';
        $Ccountcheckin = count($checkcheckin) ?? '0';
        $Ccountcheckout = count($checkcheckout) ?? '0';

    @endphp
    @include('layouts.dashboardcompany.header')
    @include('layouts.dashboardcompany.topdashboard')
    @include('layouts.dashboardcompany.middashboard')
    @include('layouts.dashboardcompany.bottomdashboard')
@endsection
