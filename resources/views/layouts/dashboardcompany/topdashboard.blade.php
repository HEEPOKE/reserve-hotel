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
        <div class="info-box bg-gradient-warning">
            <span class="info-box-icon"><i class="fa fa-key" aria-hidden="true"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">การจองในวันนี้</span>
                <span class="info-box-number h5">
                    @if ($Ccountreserve == '0')
                        {{ 'ยังไม่มีการจอง' }}
                    @else
                        {{ $Ccountreserve . ' ' . 'ครั้ง' }}
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-success">
            <span class="info-box-icon"><i class="fa fa-check-circle" aria-hidden="true"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">การเช็คอินในวันนี้</span>
                <span class="info-box-number h5">
                    @if ($Ccountcheckin == '0')
                        {{ 'ยังไม่มีการเช็คอิน' }}
                    @else
                        {{ $Ccountcheckin . ' ' . 'ครั้ง' }}
                    @endif
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-6 col-12">
        <div class="info-box bg-gradient-danger">
            <span class="info-box-icon"><i class="fa fa-sign-out" aria-hidden="true"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">การเช็คเอ้าท์ในวันนี้</span>
                <span class="info-box-number h5">
                    @if ($Ccountcheckout == '0')
                        {{ 'ยังไม่มีการเช็คเอ้าท์' }}
                    @else
                        {{ $Ccountcheckout . ' ' . 'ครั้ง' }}
                    @endif
                </span>
            </div>
        </div>
    </div>
</div>
