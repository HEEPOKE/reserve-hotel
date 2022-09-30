<?php

namespace App\Http\Controllers\Auth;

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Banks;
use App\Models\Rooms;
use App\Models\Reserve;
use App\Models\Companies;
use App\Models\Customers;
use Illuminate\Http\Request;
use App\Models\Checkin_checkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Provider_payment_methods;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function testchart()
    {
        return view('pages.testchart');
    }

    public function dashboardprovider()
    {
        $user_company = User::orderBy('id', 'ASC')
            ->select('id')
            ->where('role', '=', '0', 'AND', '3')
            ->paginate();

        $renew_contract = Companies::orderBy('id', 'ASC')
            ->select('id')
            ->where('renew_contract', '=', '1')
            ->paginate();

        $tryuse = Companies::orderBy('id', 'ASC')
            ->select('id')
            ->where('license_expire', '=', 'ทดลองใช้งาน')
            ->paginate();

        $list_company = Companies::orderBy('id', 'desc')
            ->paginate(5);

        $usersChart = User::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->orderBy('month_name', 'ASC')
            ->pluck('count', 'month_name');

        $labels = $usersChart->keys();
        $data = $usersChart->values();

        return view('pages.provider_dashboardprovider', compact('user_company', 'list_company', 'renew_contract', 'tryuse', 'labels', 'data'));
    }

    public function dashboardcompany()
    {

        date_default_timezone_set('Asia/Bangkok');

        $reserve = Reserve::orderBy('id', 'ASC')
            ->select('id')
            ->whereDay('created_at', '=', date('d'))
            ->paginate();

        $checkcheckin = Checkin_checkout::orderBy('checkin_checkouts.id', 'ASC')
            ->join('reserves', 'reserves.id', '=', 'checkin_checkouts.reserve_id')
            ->where('checkin_checkouts.stay_status', '=', '1')
            ->whereDay('checkin_checkouts.created_at', '=', date('d'))
            ->select('checkin_checkouts.stay_status')
            ->paginate();

        $checkcheckout = Checkin_checkout::orderBy('checkin_checkouts.id', 'ASC')
            ->join('reserves', 'reserves.id', '=', 'checkin_checkouts.reserve_id')
            ->where('checkin_checkouts.stay_status', '=', '2')
            ->whereDay('checkin_checkouts.created_at', '=', date('d'))
            ->select('checkin_checkouts.stay_status')
            ->paginate();

        $detailreserve = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->paginate(5);

        $wait_checkin = Checkin_checkout::orderBy('customers.id', 'desc')
            ->join('reserves', 'reserves.id', '=', 'checkin_checkouts.reserve_id')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->select(
                'customers.id',
                'customers.first_name',
                'customers.tel',
            )
            ->where('checkin_checkouts.stay_status', '=', '0')
            ->paginate(10);

        $checkin = Checkin_checkout::orderBy('customers.id', 'desc')
            ->join('reserves', 'reserves.id', '=', 'checkin_checkouts.reserve_id')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->select(
                'customers.id',
                'customers.first_name',
                'customers.tel',
            )
            ->where('checkin_checkouts.stay_status', '=', '1')
            ->paginate(10);

        $checkout = Checkin_checkout::orderBy('customers.id', 'desc')
            ->join('reserves', 'reserves.id', '=', 'checkin_checkouts.reserve_id')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->select(
                'customers.id',
                'customers.first_name',
                'customers.tel',
            )
            ->where('checkin_checkouts.stay_status', '=', '2')
            ->paginate(10);

        $reserveChart = Reserve::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw("Month(created_at)"))
            ->orderBy('month_name', 'ASC')
            ->pluck('count', 'month_name');

        $labels = $reserveChart->keys();
        $data = $reserveChart->values();
        // $chart = json_encode($reserveChart);

        return view('pages.company_dashboardcompany', compact(
            'reserve',
            'checkcheckin',
            'checkcheckout',
            'wait_checkin',
            'checkin',
            'checkout',
            'detailreserve',
            'labels',
            'data',
        ));
    }

    public function detailprovider()
    {

        // $users = Companies::orderBy('users.company_id')
        // ->join('users', 'users.company_id', '=', 'companies.id')
        // ->where('users.role', '0')
        // ->paginate(10);

        $users = User::orderBy('users.id', 'asc')->where('users.role', '0')
            ->join('companies', 'companies.id', '=', 'users.id')
            ->paginate(10);

        $companies = Companies::orderBy('id', 'ASC')
            ->paginate();

        return view('pages.provider_detailprovider', compact('users', 'companies'));
        // return response()->json($data);
    }

    public function listban()
    {

        $users = User::orderBy('users.id', 'asc')->where('users.role', '5')
            ->join('companies', 'companies.id', '=', 'users.id')
            ->paginate(10);

        $companies = Companies::orderBy('id', 'ASC')
            ->paginate();

        return view('pages.provider_listban', compact('users', 'companies'));
        // return response()->json($data);
    }

    public function paymentprovider()
    {

        $Provider_payment_methods = Provider_payment_methods::orderBy('banks.id', 'asc')
            ->join('banks', 'banks.id', '=', 'Provider_payment_methods.bank_id')
            // ->join('companies', 'companies.company_id', '=', 'Provider_payment_methods.company_id')

            ->paginate(10);

        $banks = Banks::orderBy('id', 'ASC')
            ->paginate();

        $users2 = User::orderBy('users.id', 'ASC')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->where('role', 0)
            ->paginate();

        return view('pages.provider_paymentprovider', compact('Provider_payment_methods', 'users2', 'banks'));
        // return response()->json($data);
    }

    public function paymentcompany()
    {
        $Provider_payment_methods = Provider_payment_methods::orderBy('banks.id', 'asc')
            ->join('banks', 'banks.id', '=', 'Provider_payment_methods.bank_id')
            ->where('Provider_payment_methods.company_id', auth()->user()->company_id)
            ->paginate(10);

        $banks = Banks::orderBy('id', 'ASC')
            ->paginate();

        $provider_payment_methods2 = Provider_payment_methods::orderBy('id', 'ASC')
            ->paginate();

        $users2 = User::orderBy('users.id', 'ASC')
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->where('role', 0)
            ->paginate();

        $Provider_payment_methods3 = Provider_payment_methods::orderBy('Provider_payment_methods.id', 'asc')
            ->join('banks', 'banks.id', '=', 'Provider_payment_methods.bank_id')
            ->join('companies', 'companies.id', '=', 'Provider_payment_methods.company_id')
            ->paginate();

        return view('pages.company_paymentcompany', compact('Provider_payment_methods', 'banks', 'provider_payment_methods2', 'users2', 'Provider_payment_methods3'));
        //  return response()->json($data);
    }

    public function detailcompany()
    {
        //
        $users = User::orderBy('users.id', 'asc')->where('users.role', '0')
            ->where('users.company_id', auth()->user()->company_id)
            ->join('companies', 'companies.id', '=', 'users.id')
            ->paginate(10);

        $employee = User::orderBy('users.id', 'asc')->where('users.role', '3')
            ->where('users.company_id', auth()->user()->company_id)
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->paginate(10);

        $users2 = User::orderBy('users.id', 'asc')->where('users.role', '0')
            ->where('users.id', auth()->user()->id)
            ->join('companies', 'companies.id', '=', 'users.id')
            ->paginate(10);

        $companies = Companies::orderBy('id', 'ASC')
            ->paginate();
        return view('pages.company_detailcompany', compact('users', 'companies', 'users2', 'employee'));
        //  return response()->json($data);
    }

    public function detailemployee()
    {
        //
        $users = User::orderBy('users.id', 'asc')->where('users.role', '3')
        ->join('companies', 'companies.id', '=', 'users.id')
            ->where('users.company_id', auth()->user()->company_id)
            ->paginate(10);

        $employee = User::orderBy('users.id', 'asc')->where('users.role', '3')
            ->where('users.company_id', auth()->user()->company_id)
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->paginate(10);

        $users2 = User::orderBy('users.id', 'asc')->where('users.role', '0')
            ->where('users.id', auth()->user()->id)
            ->join('companies', 'companies.id', '=', 'users.company_id')
            ->paginate(10);

        $companies = Companies::orderBy('id', 'ASC')
            ->paginate();
        return view('pages.company_detailemployee', compact('users', 'companies', 'users2', 'employee'));
        //  return response()->json($data);
    }

    public function manageuser()
    {
        $customers = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '0')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->paginate(10);

        // dd($customers);

        $fromdate = "2016-10-01";
        $toDate = "2016-10-31";

        $customersfilter = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            // ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '0')
            // ->where('reserves.company_id', auth()->user()->company_id)
            // ->whereDate('reserves.start_in_room', '<=', $fromdate)
            // ->whereDate('reserves.end_in_room', '>=', $toDate)
            ->paginate(5);


        $customers4 = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '1')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->paginate(10);

        $customers2 = Customers::selectRaw('rooms.room_type as type_report')
            ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
            ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '0')
            ->where('rooms.company_id', auth()->user()->company_id)
            ->groupBy('type_report')
            ->orderBy('type_report', 'ASC')
            ->paginate();

        $customers2b = Customers::selectRaw('rooms.room_type as type_report')
            ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
            ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '1')
            ->where('rooms.company_id', auth()->user()->company_id)
            ->groupBy('type_report')
            ->orderBy('type_report', 'ASC')
            ->paginate();

        $customers3 = Reserve::selectRaw('checkin_checkouts.stay_status as check_report')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '0')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->groupBy('check_report')
            ->orderBy('check_report', 'ASC')
            ->paginate();

        $customers3b = Reserve::selectRaw('checkin_checkouts.stay_status as check_report')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '1')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->groupBy('check_report')
            ->orderBy('check_report', 'ASC')
            ->paginate();

        return view('pages.company_manageuser', compact('customers', 'customers2', 'customers2b', 'customers3', 'customers4', 'customersfilter', 'customers3b'));
        //  return response()->json($data);
    }

    public function manageuserdate()
    {
        $customers = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '0')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->paginate(5);

        // dd($customers);

        $fromdate = "2016-10-01";
        $toDate = "2016-10-31";

        $customersfilter = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '0')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->whereDate('reserves.start_in_room', '<=', $fromdate)
            ->whereDate('reserves.end_in_room', '>=', $toDate)
            // ->where('reserves.start_in_room')
            ->paginate(5);


        $customers4 = Reserve::orderBy('reserves.id', 'desc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.walk_in_customers', '1')
            ->where('reserves.company_id', auth()->user()->company_id)
            ->paginate(5);

        $customers2 = Customers::selectRaw('rooms.room_type as type_report')
            ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
            ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('rooms.company_id', auth()->user()->company_id)
            ->groupBy('type_report')
            ->orderBy('type_report', 'ASC')
            ->paginate();

        $customers3 = Customers::selectRaw('checkin_checkouts.stay_status as check_report')
            ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
            ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('rooms.company_id', auth()->user()->company_id)
            ->where('checkin_checkouts.walk_in_customers', '0')
            ->groupBy('check_report')
            ->orderBy('check_report', 'ASC')
            ->paginate();

        return view('pages.company_manageuser', compact('customers', 'customers2', 'customers3', 'customers4', 'customersfilter'));
        //  return response()->json($data);
    }

    public function company_reportcustomer_day()
    {

        return view('pages.company_reportcustomer_day');
    }

    public function company_reportcustomer_MY(Request $request)
    {
        if ($request->year) {
            $year = Carbon::parse($request->year)->format('Y');
        } else {
            $year = Carbon::now()->format('Y');
        }
        $data_reserves = Reserve::orderBy('reserves.id', 'asc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('checkin_checkouts', 'checkin_checkouts.id', '=', 'reserves.id')
            ->paginate(100);

        $data_month = Reserve::selectRaw('year(start_in_room) as year_report,
        month(start_in_room) as month_report,
        count(*) as count_report')
            ->whereRaw('year(start_in_room) = ' . $year)
            ->groupBY('year_report', 'month_report')
            ->orderBy('month_report', 'ASC')
            ->get();
        // $months = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];
        $months = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
        $data = array();
        $report = array();
        foreach ($months as $key => $month) {
            foreach ($data_month as $key => $value) {
                if ($value->month_report == $month) {
                    $data = [
                        $customer_count = [
                            "year" => $value->year_report,
                            "month" => $month,
                            //  "month" => $value->month_report,
                            "customer_count"  => $value->count_report
                        ]
                    ];
                    // echo $month;
                } else {
                    $data = [
                        $customer_count = [
                            "year" => $value->year_report,
                            "month" => $month,
                            // "month" => 0,
                            "customer_count"  => 0
                        ]
                    ];
                }
            }
            array_push($report, $data);
        }
        return view('pages.company_reportcustomer_M&Y');
    }

    public function reportreserves()
    {
        $room_company = Rooms::orderBy('id', 'asc')
            ->where('rooms.company_id', auth()->user()->company_id)
            ->paginate();

        $customers_reserve = Reserve::orderBy('customers.id', 'asc')
            ->join('customers', 'customers.id', '=', 'reserves.customer_id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'reserves.id')
            ->select(
                'rooms.id',
                'rooms.room_name',
                'reserves.start_in_room',
                'reserves.end_in_room',
                'checkin_checkouts.stay_status',
                'customers.first_name'
            )
            ->where('reserves.company_id', auth()->user()->company_id)
            ->paginate();

        return view('pages.company_reportreserves', compact('room_company', 'customers_reserve'));
    }

    public function manageusercheckin()
    {
        $customers = Customers::orderBy('checkin_checkouts.id', 'asc')
            ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
            ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.stay_status', '1')
            ->paginate(10);
        return view('pages.company_manageusercheckin', compact('customers'));
        //  return response()->json($data);
    }

    public function manageusercheckout()
    {
        $customers = Customers::orderBy('checkin_checkouts.id', 'asc')
            ->join('checkin_checkouts', 'checkin_checkouts.reserve_id', '=', 'customers.id')
            ->join('reserves', 'reserves.customer_id', '=', 'customers.id')
            ->join('rooms', 'rooms.id', '=', 'reserves.room_id')
            ->where('checkin_checkouts.stay_status', '2')
            ->paginate(10);
        return view('pages.company_manageusercheckout', compact('customers'));
        //  return response()->json($data);
    }

    public function userscard()
    {
        return view('pages.company_userscard');
    }

    public function dashboardban()
    {
        return view('pages.company_dashboardban');
    }

    public function dashboardexpire()
    {
        return view('pages.company_dashboardexpire');
    }
}
