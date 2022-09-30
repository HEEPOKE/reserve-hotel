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
        <select class="form-control selectyear col-2 text-center" id="selectyear">
            <option selected value="">ทั้งหมด</option>
            {{-- @foreach ($year as $years)
                <option value="{{ $years->count_report }}">{{ $years->year_report }}</option>
            @endforeach --}}
        </select>
        <canvas id="myChart" class="chartreport"></canvas>
    </div>
</div>
