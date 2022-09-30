@extends('layouts.app')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>ข้อมูลการเข้าพักเเบบรายปี</title>
    @include('layouts.head')
</head>
@section('content')
    <body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
        <div class="wrapper">
            @include('layouts.header')
            @include('layouts.sidebarcompany')


        </div>
        @include('layouts.script')
    </body>
@endsection

</html>
