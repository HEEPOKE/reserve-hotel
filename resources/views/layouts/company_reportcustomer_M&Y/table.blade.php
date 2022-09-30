<div class="card poChart mt-3">
    <div class="card-header bgtable">
        <h3 class="card-title text-white"><strong>รายงานผู้สมัครใช้งานใหม่เเบบรายเดือนเเละรายปี</strong></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered mt-3 dtr-inline" id="listyear">
            <thead>
                <tr>
                    <th style="display:none;"></th>
                    <th style="display:none;"></th>
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">ชื่อลูกค้า</th>
                    <th class="text-center">เลขที่ห้องที่ต้องการจอง</th>
                    <th class="text-center">จำนวนผู้เข้าพักผู้ใหญ่</th>
                    <th class="text-center">จำนวนผู้เข้าพักเด็ก</th>
                    <th class="text-center">จำนวนห้องที่จอง</th>
                    <th class="text-center">สถานะการชำระเงิน</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="display:none;"></td>
                    <td style="display:none;"></td>
                    <td class="text-center">{{ $num++ }}</td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"> คน</td>
                    <td class="text-center"> คน</td>
                    <td class="text-center"></td>
                    {{-- @if ($reservesall->payment_slip == '')
                            <td class="text-center">
                                <div class="sonar-wrapper">
                                    <div class="sonar-emitter2">
                                        <div class="sonar-wave2"></div>
                                    </div>
                                </div>
                            </td>
                        @else
                            <td class="text-center">
                                <div class="sonar-wrapper">
                                    <div class="sonar-emitter">
                                        <div class="sonar-wave"></div>
                                    </div>
                                </div>
                            </td>
                        @endif --}}
                    <td class="text-center">
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#viewreportModal">ดูรายละเอียด</button>
                    </td>
                </tr>
            </tbody>
            <!-- view Modal -->
            <div wire:ignore.self class="modal fade" id="viewreportModal" tabindex="-1"
                aria-labelledby="viewreportModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewreportModalLabel">ดูรายละเอียดลูกค้าเข้าพัก</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <label>เช็คอิน</label>
                                <input type="text" name="start_in_room" class="form-control" readonly>
                                @error('start_in_room')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <label>เช็คเอ้า</label>
                                <input type="text" name="end_in_room" class="form-control" readonly>
                                @error('end_in_room')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                data-dismiss="modal">Close</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </table>
        <div class="float-end mt-2 mr-3">
            {{-- {!! $reserves->links('pagination::bootstrap-4') !!} --}}
        </div>
    </div>
</div>
