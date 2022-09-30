<div class="card poChart mt-3">
    <div class="card-header bgtable">
        <h3 class="card-title text-white"><strong>รายชื่อลูกค้าที่ทำการจองเเบบรายวัน</strong></h3>
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
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">ชื่อลูกค้า</th>
                    <th class="text-center">เบอร์โทร</th>
                    <th class="text-center">อีเมล</th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-info" data-toggle="modal"
                            data-target="#viewstatusModal">ดูรายละเอียด</button>
                    </td>
                </tr>
            </tbody>
            <div wire:ignore.self class="modal fade" id="viewstatusModal" tabindex="-1"
                aria-labelledby="viewstatusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewstatusModalLabel">ดูรายละเอียดผู้ประกอบการ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <label>ที่อยู่</label>
                                <textarea rows="4" type="text" name="address" class="form-control" readonly>{{ $row->address ?? '' }}</textarea>
                            </div>
                            <div class="mt-3">
                                <label>สถานที่ตั้ง</label>
                                <div class="form-group row">
                                    <div class="col-10">
                                        <input class="form-control" name="location" type="text"
                                            value="{{ $row->location ?? '' }}" readonly>
                                    </div>
                                    <div class="col-xs-2">
                                        <button class="btn btn-primary mt-2" type="button"
                                            onclick="window.location.href='{{ $row->location ?? '#' }}'">คลิกลิ้ง</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal"
                                data-dismiss="modal">ยกเลิก</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </table>
    </div>
</div>
