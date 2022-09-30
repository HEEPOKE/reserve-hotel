@extends('adminlte::page')
@section('content')
    @php

        $num = 1;
        $company_id = Auth::user()->company_id;

        $findid = DB::table('typerooms')
            ->select('id')
            ->where('company_id', $company_id)
            ->first();

        $id = $findid->id ?? '0';

        $type = DB::table('typerooms')
            ->select('type_room')
            ->where('company_id', $company_id)
            ->where('id', $id)
            ->first();

        $check = $type->type_room ?? NULL;

        if ($check == NULL) {
            $counttype = 0;
        } else {
            $Arraytype = explode(',', $check);
            $Stringtype = implode(',', $Arraytype);
            $counttype = count($Arraytype);
        }

    @endphp

    @include('layouts.company_typeroom.type_table')
    @include('layouts.company_typeroom.addtype_modal')

    @if ($message = Session::get('delete'))
        <script>
            Swal.fire({
                title: 'ลบประเภทห้องพักสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @elseif ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: 'เพิ่มข้อมูลประเภทห้องพักสำเร็จ!',
                text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                icon: 'success'
            });
        </script>
    @endif
@endsection
