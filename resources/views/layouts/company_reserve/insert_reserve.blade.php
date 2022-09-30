<div wire:ignore.self class="modal fade" id="insertreserveModal" tabindex="-1" aria-labelledby="insertreserveModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header card-header bg-success border-success">
                <h5 class="modal-title" id="insertreserveModalLabel">เพิ่มข้อมูลการจอง</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('insert-reserve') }}" method="POST">
                @csrf
                {{-- <input type="hidden" name="identification_card_customers_id" value="1"> --}}
                <input type="hidden" name="payment_status" value="0">
                <input type="hidden" name="company_id" value="{{ Auth::user()->company_id }}">
                <div class="modal-body">
                    <div id="checkchange">
                        <label>เลือกอย่างใดอย่างหนึ่งเพื่อเพิ่มชื่อลูกค้า</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="havedata"
                                onclick="checkHaveData()">
                            <label class="form-check-label" for="exampleRadios1">
                                มีข้อมูลลูกค้าอยู่ในระบบ
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="nodata"
                                onclick="checkNodata()">
                            <label class="form-check-label" for="exampleRadios2">
                                ไม่มีข้อมูลลูกค้าอยู่ในระบบ
                            </label>
                        </div>
                    </div>
                    <div class="mt-2" id="newcustomer">
                        <label>ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" name="customer_name" placeholder="กรอกชื่อ-นามสกุล">
                    </div>
                    <div class="mt-1" id="havecustomer">
                        <label>ชื่อลูกค้า</label>
                        <select class="form-control" name="customer_id" required>
                            <option hidden selected>
                                <-- กรุณาเลือก -->
                            </option>
                            @foreach ($customers as $customers)
                                <option value="{{ $customers->id }}">
                                    {{ $customers->first_name }}
                                    {{ $customers->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>สถานะเข้าพัก</label>
                        <select class="form-control" name="stay_status" required>
                            <option hidden selected>
                                <-- กรุณาเลือก -->
                            </option>
                            <option value="0">รอเช็คอิน</option>
                            <option value="1">เช็คอิน</option>
                            <option value="2">เช็คเอ้าท์</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>ประเภทลูกค้า</label>
                        <select class="form-control" name="walk_in_customers" required>
                            <option hidden selected>
                                <-- กรุณาเลือก -->
                            </option>
                            <option value="1">ลูกค้าวอล์คอิน</option>
                            <option value="0">ลูกค้าจอง</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>ประเภทห้อง</label>
                        <select class="form-control type_room" id="type_room" name="type_room" required>
                            <option value="0" disabled="true" selected="true">
                                <-- กรุณาเลือกประเภทห้อง -->
                            </option>
                            @for ($i = 0; $i < $counttype; $i++)
                                <option value="{{ $Arraytype[$i] }}">{{ $Arraytype[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                    {{ csrf_field() }}
                    <div class="mt-3">
                        <label>เลขที่ห้องที่ต้องการจอง</label>
                        <select class="form-control room_id" name="room_id" id="room_id" required>
                            <option value="0" disabled="true" selected="true">
                                <-- กรุณาเลือกห้อง -->
                            </option>
                            @foreach ($rooms as $roomsallid)
                                <option value="{{ $roomsallid->id }}">
                                    {{ $roomsallid->room_name }}
                                    จำนวนห้อง : {{ $roomsallid->room_quantity }} เหลือ :
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3">
                        <label>จำนวนผู้เข้าพักผู้ใหญ่</label>
                        <input type="number" name="guest_adult" class="form-control" min="1" required>
                        @error('guest_adult')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>จำนวนผู้เข้าพักเด็ก</label>
                        <input type="number" name="guest_child" class="form-control" min="0" required>
                        @error('guest_child')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>จำนวนห้องที่จอง</label>
                        <input type="number" name="reserve_quantity" class="form-control" min="1" required>
                        @error('reserve_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>จำนวนผู้เข้าพักเด็ก</label>
                        <input type="number" name="guest_child" class="form-control" min="0" required>
                        @error('guest_child')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>จำนวนห้องที่จอง</label>
                        <input type="number" name="reserve_quantity" class="form-control" min="1" required>
                        @error('reserve_quantity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>เข้าพัก</label>
                        <input type="date" name="start_in_room" class="form-control" required>
                        @error('start_in_room')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label>เช็คเอ้า</label>
                        <input type="date" name="end_in_room" class="form-control" required>
                        @error('end_in_room')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @if ($message = Session::get('status'))
                    <script>
                        Swal.fire({
                            title: 'เพิ่มข้อมูลการจองสำเร็จ!',
                            text: 'กดปุ่มเพื่อออกจากหน้านี้!',
                            icon: 'success'
                        });
                    </script>
                @else
                @endif
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">บันทึก</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-dismiss="modal">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>
