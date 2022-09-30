@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <p>Customers</p>
                        {{-- <a href="{{ route('detailcompany') }}">จัดการข้อมูลห้องพัก</a>     <a href="{{ route('paymentcompany') }}">จัดการชำระเงิน</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
