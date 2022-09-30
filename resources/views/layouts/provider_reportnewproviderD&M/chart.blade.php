<div class="card poChart mt-3">
    <div class="card-header bgtable">
        <h3 class="card-title text-white"><strong>รายงานผู้สมัครใช้งานใหม่เเบบรายวันเเละรายเดือน</strong></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="dropdown">
            <a class="btn btn-primary dropdown-toggle text-white" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                กรุณาเลือกปี
            </a>
            <ul class="dropdown-menu">
                @if ($choiceyear != '')
                    @foreach ($choiceyear as $choice)
                        <li><a class="dropdown-item text-center"
                                href="{{ url('reportnewproviderD&M', $choice->year) }}">{{ $choice->year }}</a></li>
                    @endforeach
                @elseif ($choiceyear == '')
                    <li><a class="dropdown-item text-center" href="#">{{ 'ยังไม่มีข้อมูล' }}</a>
                    </li>
                @endif
            </ul>
        </div>
        <div id="columnchart_material" class="chart-h mt-2"></div>
    </div>
</div>
