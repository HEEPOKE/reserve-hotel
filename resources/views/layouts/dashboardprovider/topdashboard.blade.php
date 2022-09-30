<div class="row">
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-info">
            <span class="info-box-icon"><i class="far fa-calendar-alt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">วันนี้</span>
                <span class="info-box-number h5">
                    {{ $day . ' ' }}
                    @if ($month == '1')
                        ม.ค.
                    @elseif ($month == '2')
                        ก.พ.
                    @elseif ($month == '3')
                        มี.ค.
                    @elseif ($month == '4')
                        เม.ย.
                    @elseif ($month == '5')
                        พ.ค.
                    @elseif ($month == '6')
                        มิ.ย.
                    @elseif ($month == '7')
                        ก.ค.
                    @elseif ($month == '8')
                        ส.ค.
                    @elseif ($month == '9')
                        ก.ย.
                    @elseif ($month == '10')
                        ต.ค.
                    @elseif ($month == '11')
                        พ.ย.
                    @elseif ($month == '12')
                        ธ.ค.
                    @endif
                    {{ $yearTH }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-primary">
            <span class="info-box-icon"><i class="fa fa-users" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">จำนวนผู้ใช้งานในระบบ</span>
                <span class="info-box-number h5">
                    {{ $countuser_company . ' ' . 'คน' }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-success">
            <span class="info-box-icon"><i class="fa fa-flag" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">ผู้ประกอบการที่ต่ออายุ</span>
                <span class="info-box-number h5">
                    @if ($countrenew == '0')
                        {{ 'ไม่มีข้อมูลการต่ออายุ' }}
                    @else
                        {{ $countrenew }}
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="fa fa-repeat" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">จำนวนการทดลองใช้งาน</span>
                <span class="info-box-number h5">
                    @if ($counttry == '0')
                        {{ 'ยังไม่มีข้อมูล' }}
                    @else
                        {{ $counttry }}
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
