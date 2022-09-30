<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use Illuminate\Support\Facades\DB;

require('FormatController.php');
// เเก้ไขการส่งขอมูลของ Chart ลำบากหน่อยนะ พอดีโลจิคมันยากนิดนึง เเต่เขียนเป็นเเนวทางให้เเล้วไม่น่ายากนะ น้อต จุบุๆ
// บางหน้าทำให้ไม่รีเฟรขหน้าไม่ได้อ่า php ไม่มีsetstate เเบบ js ไม่รู้วิธีทำ
class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function reportrenewproviderMonth()
    {

        $selectyear = Companies::distinct()
            ->select(DB::raw('substr(created_at, 1, 4) + 543 as year'))
            ->where('renew_contract', 1)
            ->where('license_status', 'รายเดือน')
            ->orderBy('created_at', 'desc')
            ->first();

        $id = $selectyear->year ?? '';

        if ($id == '') {

            $id = '';
            $choiceyear = '';
            $companies = Companies::orderBy('created_at', 'desc')
                ->where('renew_contract', 1)
                ->where('license_status', 'รายเดือน')
                ->whereYear('created_at', '')
                ->paginate(10);
            $chart = '';
        } else if ($id != '') {

            $year = $id - 543;

            $choiceyear = Companies::distinct()
                ->select(DB::raw('substr(created_at, 1, 4) + 543 as year'))
                ->where('renew_contract', 1)
                ->where('license_status', 'รายเดือน')
                ->orderBy('created_at', 'desc')
                ->get();

            $companies = Companies::orderBy('created_at', 'desc')
                ->where('renew_contract', 1)
                ->where('license_status', 'รายเดือน')
                ->whereYear('created_at', $year)
                ->paginate(10);

            $data = Companies::whereYear('created_at', $year)
                ->select(
                    DB::raw("MONTH(created_at) as month"),
                    DB::raw('COUNT(created_at) as count')
                )
                ->where('renew_contract', 1)
                ->where('license_status', 'รายเดือน')
                ->groupBy('month')
                ->orderBy('month', 'ASC')
                ->get();

            $chart = [];
            $m = 1;

            for ($i = 0; $i < count($data); $i++) {
                if ($m <= count($data)) {

                    if ($m == count($data)) {
                        $m = $i;
                    }
                    if ($data[$i]["month"] == $data[$m]["month"] && $m != $i) {
                        array_push($chart, array(
                            "countMonth" => $data[$m]["count"],
                            "month" => formatMonth($data[$i]["month"])
                        ));
                        $i++;
                        $m++;
                    } else {
                        array_push($chart, array(
                            "countMonth" => $data[$i]["count"],
                            "month" => formatMonth($data[$i]["month"])
                        ));
                    }
                }

                $m++;
            }
        }

        return view('pages.provider_reportrenewproviderMonth', compact(
            'id',
            'choiceyear',
            'companies',
            'chart'
        ));
    }

    public function RequestproviderMonth($id)
    {

        $year = $id - 543;

        $choiceyear = Companies::distinct()
            ->select(DB::raw('substr(created_at, 1, 4) + 543 as year'))
            ->where('renew_contract', 1)
            ->where('license_status', 'รายเดือน')
            ->orderBy('created_at', 'desc')
            ->get();

        $companies = Companies::orderBy('created_at', 'desc')
            ->where('renew_contract', 1)
            ->where('license_status', 'รายเดือน')
            ->whereYear('created_at', $year)
            ->paginate(10);

        $data = Companies::whereYear('created_at', $year)
            ->select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw('COUNT(created_at) as count')
            )
            ->where('renew_contract', 1)
            ->where('license_status', 'รายเดือน')
            ->groupBy('month')
            ->orderBy('month', 'ASC')
            ->get();

        $chart = [];
        $m = 1;

        for ($i = 0; $i < count($data); $i++) {
            if ($m <= count($data)) {

                if ($m == count($data)) {
                    $m = $i;
                }
                if ($data[$i]["month"] == $data[$m]["month"] && $m != $i) {
                    array_push($chart, array(
                        "countMonth" => $data[$m]["count"],
                        "month" => formatMonth($data[$i]["month"])
                    ));
                    $i++;
                    $m++;
                } else {
                    array_push($chart, array(
                        "countMonth" => $data[$i]["count"],
                        "month" => formatMonth($data[$i]["month"])
                    ));
                }
            }

            $m++;
        }

        return view('pages.provider_reportrenewproviderMonth', compact(
            'id',
            'choiceyear',
            'companies',
            'chart'
        ));
    }

    public function reportnewproviderDM()
    {

        $selectyear = Companies::distinct()
            ->select(DB::raw('substr(created_at, 1, 4) + 543 as year'))
            ->where('renew_contract', 0)
            ->orWhere(function ($query) {
                $query->where('license_status', 'รายเดือน')
                    ->where('license_status',  'ทดลองใช้งาน');
            })
            ->orderBy('created_at', 'desc')
            ->first();

        $id = $selectyear->year ?? '';

        if ($id == '') {

            $id = '';
            $choiceyear = '';
            $companies = Companies::orderBy('created_at', 'desc')
                ->where('renew_contract', 0)
                ->whereYear('created_at', '')
                ->orWhere(function ($query) {
                    $query->where('license_status', 'รายเดือน')
                        ->where('license_status',  'ทดลองใช้งาน');
                })
                ->paginate(10);

            $chart = '';
        } else if ($id != '') {

            $year = $id - 543;

            $choiceyear = Companies::distinct()
                ->select(DB::raw('substr(created_at, 1, 4) + 543 as year'))
                ->where('renew_contract', 0)
                ->orWhere(function ($query) {
                    $query->where('license_status', 'รายเดือน')
                        ->where('license_status',  'ทดลองใช้งาน');
                })
                ->orderBy('created_at', 'desc')
                ->get();

            $companies = Companies::orderBy('created_at', 'desc')
                ->where('renew_contract', 0)
                ->whereYear('created_at', $year)
                ->orWhere(function ($query) {
                    $query->where('license_status', 'รายเดือน')
                        ->where('license_status',  'ทดลองใช้งาน');
                })
                ->paginate(10);

            $day = Companies::orderBy('month', 'ASC')
                ->select(
                    DB::raw("MONTH(created_at) as month"),
                    DB::raw('COUNT(license_status) as counts'),
                    'license_status'
                )
                ->whereYear('created_at', $year)
                ->where('renew_contract', 0)
                ->where('license_status', 'ทดลองใช้งาน')
                ->groupBy('month');

            $month = Companies::select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw('COUNT(license_status) as counts'),
                'license_status'
            )
                ->whereYear('created_at', $year)
                ->where('renew_contract', 0)
                ->where('license_status', 'รายเดือน')
                ->groupBy('month')
                ->union($day)
                ->get();

            $result = $month;

            $sortResult = [];
            for ($sort = 0; $sort < count($result); $sort++) {
                array_push($sortResult, array(
                    "months" => $result[$sort]->month,
                    "counts" => $result[$sort]->counts,
                    "license_status" => $result[$sort]->license_status
                ));
            }
            sort($sortResult);

            $chart = [];
            $m = 1;

            for ($i = 0; $i < count($sortResult); $i++) {
                if ($m <= count($sortResult)) {

                    if ($m == count($sortResult)) {
                        $m = $i;
                    }
                    if ($sortResult[$i]["months"] == $sortResult[$m]["months"] && $m != $i) {
                        array_push($chart, array(
                            "countDay" => $sortResult[$i]["counts"],
                            "countMonth" => $sortResult[$m]["counts"],
                            "month" => formatMonth($sortResult[$i]["months"])
                        ));
                        $i++;
                        $m++;
                    } else {
                        if ($sortResult[$i]["license_status"] == "ทดลองใช้งาน") {
                            array_push($chart, array(
                                "countDay" => $sortResult[$i]["counts"],
                                "countMonth" => 0,
                                "month" => formatMonth($sortResult[$i]["months"])
                            ));
                        } else {
                            array_push($chart, array(
                                "countDay" => 0,
                                "countMonth" => $sortResult[$i]["counts"],
                                "month" => formatMonth($sortResult[$i]["months"])
                            ));
                        }
                    }
                }

                $m++;
            }
        }

        return view('pages.provider_reportnewproviderD&M', compact(
            'id',
            'choiceyear',
            'companies',
            'chart',
        ));
    }

    public function RequestproviderDM($id)
    {
        $year = $id - 543;

        $choiceyear = Companies::distinct()
            ->select(DB::raw('substr(created_at, 1, 4) + 543 as year'))
            ->where('renew_contract', 0)
            ->orWhere(function ($query) {
                $query->where('license_status', 'รายเดือน')
                    ->where('license_status',  'ทดลองใช้งาน');
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $companies = Companies::orderBy('created_at', 'desc')
            ->where('renew_contract', 0)
            ->orWhere(function ($query) {
                $query->where('license_status', 'รายเดือน')
                    ->where('license_status',  'ทดลองใช้งาน');
            })
            ->whereYear('created_at', $year)
            ->paginate(10);

        $day = Companies::orderBy('month', 'ASC')
            ->select(
                DB::raw("MONTH(created_at) as month"),
                DB::raw('COUNT(license_status) as counts'),
                'license_status'
            )
            ->whereYear('created_at', $year)
            ->where('renew_contract', 0)
            ->where('license_status', 'ทดลองใช้งาน')
            ->groupBy('month');

        $month = Companies::select(
            DB::raw("MONTH(created_at) as month"),
            DB::raw('COUNT(license_status) as counts'),
            'license_status'
        )
            ->whereYear('created_at', $year)
            ->where('renew_contract', 0)
            ->where('license_status', 'รายเดือน')
            ->groupBy('month')
            ->union($day)
            ->get();

        $result = $month;

        $sortResult = [];
        for ($sort = 0; $sort < count($result); $sort++) {
            array_push($sortResult, array(
                "months" => $result[$sort]->month,
                "counts" => $result[$sort]->counts,
                "license_status" => $result[$sort]->license_status
            ));
        }
        sort($sortResult);

        $chart = [];
        $m = 1;

        for ($i = 0; $i < count($sortResult); $i++) {
            if ($m <= count($sortResult)) {

                if ($m == count($sortResult)) {
                    $m = $i;
                }
                if ($sortResult[$i]["months"] == $sortResult[$m]["months"] && $m != $i) {
                    array_push($chart, array(
                        "countDay" => $sortResult[$i]["counts"],
                        "countMonth" => $sortResult[$m]["counts"],
                        "month" => formatMonth($sortResult[$i]["months"])
                    ));
                    $i++;
                    $m++;
                } else {
                    if ($sortResult[$i]["license_status"] == "ทดลองใช้งาน") {
                        array_push($chart, array(
                            "countDay" => $sortResult[$i]["counts"],
                            "countMonth" => 0,
                            "month" => formatMonth($sortResult[$i]["months"])
                        ));
                    } else {
                        array_push($chart, array(
                            "countDay" => 0,
                            "countMonth" => $sortResult[$i]["counts"],
                            "month" => formatMonth($sortResult[$i]["months"])
                        ));
                    }
                }
            }

            $m++;
        }

        return view('pages.provider_reportnewproviderD&M', compact(
            'id',
            'choiceyear',
            'companies',
            'chart',
        ));
    }


    public function reportrenewproviderYear()
    {

        $companies = Companies::orderBy('id', 'desc')
            ->where('renew_contract', 1)
            ->where('license_status', 'รายปี')
            ->paginate(10);

        $year = Companies::selectRaw('year(created_at) as year_report,count(*) as count_report')
            ->where('renew_contract', 1)
            ->where('license_status', 'รายปี')
            ->groupBy('year_report')
            ->orderBy('year_report', 'desc')
            ->paginate();

        $datayear_all = Companies::select(DB::raw("COUNT(*) as count"), DB::raw("year(created_at) as year_report"))
            ->where('renew_contract', 1)
            ->where('license_status', 'รายปี')
            ->groupBy('year_report')
            ->orderBy('year_report', 'desc')
            ->pluck('count', 'year_report');

        $labelsyear_alls = $datayear_all->keys();
        $datayear_alls = $datayear_all->values();

        return view('pages.provider_reportrenewproviderYear', compact(
            'companies',
            'companies',
            'year',
            'datayear_all',
            'labelsyear_alls',
            'datayear_alls'
        ));
    }

    public function reportnewproviderYear()
    {

        $companies = Companies::orderBy('id', 'desc')
            ->where('renew_contract', 0)
            ->where('license_status', 'รายปี')
            ->paginate(10);

        $year = Companies::selectRaw('year(created_at) as year_report,count(*) as count_report')
            ->where('renew_contract', 0)
            ->where('license_status', 'รายปี')
            ->groupBy('year_report')
            ->orderBy('year_report', 'desc')
            ->paginate();

        $datayear_all = Companies::select(DB::raw("COUNT(*) as count"), DB::raw("year(created_at) as year_report"))
            ->where('renew_contract', 0)
            ->where('license_status', 'รายปี')
            ->groupBy('year_report')
            ->orderBy('year_report', 'desc')
            ->pluck('count', 'year_report');

        $labelsyear_alls = $datayear_all->keys();
        $datayear_alls = $datayear_all->values();

        return view('pages.provider_reportnewproviderYear', compact(
            'companies',
            'year',
            'datayear_all',
            'labelsyear_alls',
            'datayear_alls'
        ));
    }
}
