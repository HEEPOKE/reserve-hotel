@extends('layouts.app')
@section('content')

<h1>Dashboard provider</h1>
<a href="{{ route('license_status.home') }}" type="button">จัดการสถานะวันหมดอายุของ License</a>
<a href="{{ route('paymentprovider.home') }}" type="button">ระบบชำระเงิน</a>
@endsection

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 text-center mt-3">
                <h2>Detail Procvider</h2>
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
            {{-- @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
            @endif --}}
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

      {{-- <!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteproviderModal{{ $row->id }}" tabindex="-1" aria-labelledby="deleteproviderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteproviderModalLabel">Deleteuser : {{ $row->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form action="{{ url('deleteprovider', $row->id) }}" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <input type="hidden" name="id" value="{{ $row->id }}">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this data ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Yes! Delete</button>
                </div>
            </form>
        </div>
    </div>
    </div> --}}

    </div>
</body>
@endsection
</html>

