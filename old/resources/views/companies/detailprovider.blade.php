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
                <h2>Detail Provider</h2>
            </div>
            @php
            // $users = DB::table('users')
            // ->orderBy('id', 'DESC')
            // ->where('role', 0)
            // ->get();
            @endphp
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertproviderModal">เพิ่มผู้ประกอบการ</button>
                <a href="{{ route('license_status.home') }}" type="button">จัดการสถานะวันหมดอายุของ License</a>
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
                @foreach($users as $key => $row)
                <tr>
                    <td class="text-center">{{ $row->id }}</td>
                    <td class="text-center">{{ $row->name }}</td>
                    <td class="text-center">{{ $row->email }}</td>

                    <td class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editproviderModal{{ $row->id }}" >Edit</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteproviderModal{{ $row->id }}" >Delete</button>
                            {{-- <a href="{{ url('deleteusers', $row->id) }}" class="btn btn-danger">Delete</a> --}}
                    </td>
                    @include('modal.deleteprovider')
                    @include('modal.editprovider')
                </tr>
                @endforeach
            </table>
            {{-- {!! $users->links('pagination::bootstrap-5') !!} --}}
        </div>


           <!-- Insert Modal -->
      <!-- Insert Modal -->
      <div wire:ignore.self class="modal fade" id="insertproviderModal" tabindex="-1" aria-labelledby="insertproviderModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="insertproviderModalLabel">เพิ่มผู้ประกอบการ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                      wire:click="closeModal"></button>
              </div>
              <form action="{{ url('insert-provider') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  {{-- <input type="hidden" name="is_admin" value="3">
                  <input type="hidden" name="id_market" value=""> --}}
                  <div class="modal-body">
                      <div class="mb-3">
                          <label>name</label>
                          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      </div>
                      <div class="mb-3">
                       <label>email</label>
                       <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                   </div>
                   <div class="mb-3">
                       <label>password</label>
                       <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                   </div>
                   <div class="mb-3">
                       <label>password-confirm</label>
                       <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                   </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" wire:click="closeModal"
                          data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Save</button>
                  </div>
              </form>
          </div>
      </div>
      </div>

   
        
    </div>
</body>
@endsection
</html>