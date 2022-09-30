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
                <h2>รายละเอียดผู้ประกอบการ</h2>
            </div>
            @php
            // $users = DB::table('users')
            // ->join('companies', 'companies.id', '=', 'users.company_id')
            // // ->orderBy('users.id', 'DESC')
            // ->where('users.role', 0)
            // ->get();

            // $product = DB::table('product')
            //         ->join('users', 'users.id', '=', 'product.id_market')
            //         ->where((['users.id' => Auth::user()->id])) 
            //   		->get(['product.*']);
            @endphp
            <div>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#insertlicenseModal">เพิ่มสถานะผู้ประกอบการ</button>
             
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
                    <th class="text-center">ชื่อบริษัท</th>
                    <th class="text-center">สถานะ</th>
                    <th class="text-center">วันหมดอายุ</th>
              
                    <th class="text-center" width="280px">Action</th>
                </tr>
                @foreach($users as $key => $row)
                <tr>
                    <td class="text-center">{{ $row->id }}</td>
                    <td class="text-center">{{ $row->name }}</td>
                    <td class="text-center">{{ $row->email }}</td>
                    <td class="text-center">{{ $row->company_name }}</td>
                    <td class="text-center">{{ $row->license_status }}</td>
                    <td class="text-center">{{ $row->license_expire }}</td>

                    <td class="text-center">
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editlicenseModal{{ $row->id }}" >Edit</button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deletelicenseModal{{ $row->id }}" >Delete</button>
                            {{-- <a href="{{ url('deleteusers', $row->id) }}" class="btn btn-danger">Delete</a> --}}
                    </td>
                    {{-- @include('modal.deletelicense')
                    @include('modal.editlicense') --}}
                </tr>
                @endforeach
            </table>
            {{-- {!! $users->links('pagination::bootstrap-5') !!} --}}
        </div>


           <!-- Insert Modal -->
      <!-- Insert Modal -->
      <div wire:ignore.self class="modal fade" id="insertlicenseModal" tabindex="-1" aria-labelledby="insertlicenseModalLabel"
      aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="insertlicenseModalLabel">เพิ่มสถานะผู้ประกอบการ</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                      wire:click="closeModal"></button>
              </div>
              <form action="{{ url('insert-license') }}" method="POST" enctype="multipart/form-data">
                  @csrf 
                  @php
                  $users2 = DB::table('users')
                  ->where('role', 0)
                  ->where('company_id', NULL)
                  ->get();

                  $companies = DB::table('companies')
                  ->orderBy('id', 'ASC')
                  ->get();
                  @endphp

                   <div class="modal-body">
                  
                       
                       <div class="mb-3">
                        <label>อีเมลผู้ประกอบการ</label>
                        <select name="email">
                            @foreach($users2 as $row2)
                            <option value="{{$row2->email}}">{{$row2->email}}</option>
                            @endforeach
                            {{-- <form action="{{ url('update-license', $row2->id) }}" method="POST" enctype="multipart/form-data"> --}}
                            <input type="hidden" name="company_id" value="1">
                               
                          </select>
                       </div>
                  
                    <div class="mt-3">
                        <label>Company name</label>
                        <input type="text" name="company_name" class="form-control" required >
                        @error('company_name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
                    <div class="mt-3">
                        <label>Tel.</label>
                        <input type="number" name="tel" class="form-control" required >
                        @error('tel') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
                    <div class="mt-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control"  >
                        @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
                    <div class="mt-3">
                        <label>Location</label>
                        <input type="int" name="location" class="form-control"  >
                        @error('location') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
                    <div class="mt-3">
                        <label>สถานะการใช้งาน</label>
                        <select name="license_status">
                            <option value="ทดลองใช้งาน">ทดลองใช้งาน</option>
                            <option value="ผู้ใช้งานที่ชำระเงินแล้ว">ผู้ใช้งานที่ชำระเงินแล้ว(รายเดือน)</option>
                            <option value="ผู้ใช้งานที่ชำระเงินแล้ว(รายปี)">ผู้ใช้งานที่ชำระเงินแล้ว(รายปี)</option>
                          </select>
                    </div> 
                    <div class="mt-3">
                        <label>วันหมดอายุ</label>
                        <input type="number" name="license_expire" class="form-control" required >
                        @error('license_expire') <span class="text-danger">{{ $message }}</span> @enderror
                    </div> 
              
                     
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" wire:click="closeModal"
                          data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-success">Save</button>
                  </div>
              </form>
            {{-- </form>  --}}
          </div>
      </div>
      </div>

     
        
    </div>
</body>
@endsection
</html>