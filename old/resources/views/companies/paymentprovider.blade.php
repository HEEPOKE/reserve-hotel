@extends('layouts.app')


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
@section('content')
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 text-center mt-3">
                <h2>ระบบชำระเงิน</h2>
            </div>
         
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertproviderModal">เพิ่มช่องทางการชำระเงิน</button>
               
            </div>
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif
            <table class="table table-bordered mt-3">
                <tr>
                    <th class="text-center">No.</th>
                    <th class="text-center">Name</th>
                    <th class="text-center">Email</th>
              
                    <th class="text-center" width="280px">Action</th>
                </tr>
                {{-- @foreach($users as $key => $row) --}}
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>

                    <td class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editproviderModal" >Edit</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteproviderModal" >Delete</button>
                            {{-- <a href="{{ url('deleteusers', $row->id) }}" class="btn btn-danger">Delete</a> --}}
                    </td>
                    {{-- @include('modal.deleteprovider')
                    @include('modal.editprovider') --}}
                </tr>
                {{-- @endforeach --}}
            </table>
            {{-- {!! $users->links('pagination::bootstrap-5') !!} --}}
        </div>


        

    </div>
</body>
@endsection
</html>