<div class="card poChart mt-3">
    <div class="card-header bgtable">
        <h3 class="card-title text-white"><strong>รายชื่อผู้ใช้งานที่ต่ออายุรายปี</strong></h3>
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
                    <th class="text-center">ลำดับ</th>
                    <th class="text-center">ชื่อบริษัท</th>
                    <th class="text-center">เบอร์โทร</th>
                    <th class="text-center">อีเมล</th>
                    <th class="text-center">วันใช้งานคงเหลือ</th>
                    <th class="text-center">สถานะการหมดอายุ</th>
                    <th class="text-center">สถานะการใช้งาน</th>
                    <th class="text-center">การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $key => $row)
                    <tr>
                        <td style="display:none;">{{ date('Y', strtotime($row->created_at)) }}</td>
                        <td class="text-center">{{ $key+ $companies->firstItem() }}</td>
                        <td class="text-center">{{ $row->company_name }}</td>
                        <td class="text-center">{{ $row->tel }}</td>
                        <td class="text-center">{{ $row->email }}</td>
                        @php
                            $date5 = date_create(date('Y-m-d'));
                            $date3 = new DateTime($row->license_expire);
                            $date3->modify('+365 day');
                            $diff = date_diff($date5, $date3);
                        @endphp
                        <td class="text-center">{{ $diff->format('%a วัน') }}</td>
                        @if ($diff < '1')
                            <td class="text-center">หมดอายุการใช้งาน</td>
                        @else
                            <td class="text-center">{{ $row->license_status }}</td>
                        @endif
                        @if ($diff < '1')
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
                        @endif
                        <td class="text-center">
                            <button type="button" class="btn btn-info" data-toggle="modal"
                                data-target="#viewstatusModal{{ $row->id }}"><i class="fas fa-eye"></i></button>
                        </td>
                    </tr>
            </tbody>

            <div wire:ignore.self class="modal fade" id="viewstatusModal{{ $row->id }}" tabindex="-1"
                aria-labelledby="viewstatusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header card-header bg-primary border-primary">
                            <h5 class="modal-title" id="viewstatusModalLabel">ดูรายละเอียดผู้ประกอบการ</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="">
                                <label>ที่อยู่</label>
                                <textarea rows="4" type="text" class="form-control" readonly>{{ $row->address ?? '' }}</textarea>
                            </div>
                            <div class="mt-3">
                                <label>สถานที่ตั้ง</label>
                                <div class="form-group row">
                                    <div class="col-10">
                                        <input class="form-control" type="text" value="{{ $row->location ?? '' }}"
                                            readonly>
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
            @endforeach
        </table>
        {!! $companies->links('pagination::bootstrap-4') !!}
    </div>
