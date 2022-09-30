<div class="card poChart mt-3">
    <div class="card-header bgtable">
        <h3 class="card-title text-white"><strong>รายงานลูกค้าที่ทำการจองเเบบรายวัน</strong></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool text-white" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="date" class="col-form-label col-sm-2">จากวันที่</label>
            <div class="col-sm-3">
                <input type="date" class="form-control input-sm" id="from" name="from" required>
            </div>
            <label for="date" class="col-form-label col-sm-2">ถึงวันที่</label>
            <div class="col-sm-3">
                <input type="date" class="form-control input-sum" id="to" name="to" required>
            </div>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-outline-secondary" name="search" title="Search">
                    <i class="fas fa-search"></i></button>
            </div>
        </div>
        <canvas id="myChart" class="chartreport"></canvas>
    </div>
</div>
