<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $pageName = 'Thống kê';
        $userCount = User::where('role_id', config('base.role_id.customer'))->count();
        $categoryCount = Category::count();
        $productCount = ProductPrice::where('quantity', '>', 0)->count();
        $orderCount = Order::count();
        $orderTotalSum = Order::where('orders.status', config('base.order_status.delivered'))
            ->where('orders.is_paid', config('base.is_paid.yes'))
            ->sum('total');
        $currentYear = date("Y");
        $year = $request->year ? $request->year : $currentYear;
        $threeYears = [];

        for ($i = 0; $i < 3; $i++) {
            $threeYears[] = $currentYear - $i;
        }

        $stores = [];
        if (config('base.env.multi_store')) {
            $stores = Store::orderByDesc('id')->get();
        }

        $compact = [
            'pageName',
            'request',
            'userCount',
            'categoryCount',
            'productCount',
            'orderCount',
            'orderTotalSum',
            'threeYears',
            'stores'
        ];

        return view('admin.dashboard', compact($compact));
    }

    public function getChart(Request $request)
    {
        $year = $request->year ?? date("Y");
        // $chart = [];
        // for ($i = 1; $i <= 12; $i++) {
        //     $chart[$i] = [
        //         'month' => $i,
        //         'quantity' => 0,
        //         'total' => 0
        //     ];
        // }

        $orderDetailsSub = DB::table('order_details')->select(DB::raw('order_id, sum(quantity) as quantity, sum(total) as total'))->groupBy('order_id');
        if (isset($request->store_id) && $request->store_id != 0) {
            $orderDetailsSub = $orderDetailsSub->where('store_id', $request->store_id);
        }

        $successOrder = DB::table('orders')
            ->joinSub($orderDetailsSub, 'order_details', function ($join) {
                $join->on('orders.id', '=', 'order_details.order_id');
            })
            ->select(DB::raw('month(orders.created_at) as month, year(orders.created_at) as year, sum(order_details.quantity) as quantity, sum(orders.total) as total'))
            ->where('orders.status', config('base.order_status.delivered'))
            ->where('orders.is_paid', config('base.is_paid.yes'));

        if (isset($request->start_at) && isset($request->finish_at)) {
            $successOrder = $successOrder->whereBetween('created_at', [
                $request->start_at,
                $request->finish_at
            ]);
        } else {
            $successOrder = $successOrder->whereRaw('year(orders.created_at) = ' . $year);
        }

        $successOrder = $successOrder->groupBy([
            'month',
            'year'
        ])->orderBy('month')
            ->get();

        // foreach ($successOrder as $item) {
        //     if (isset($chart[$item->month])) {
        //         $chart[$item->month]['quantity'] = $item->quantity;
        //         $chart[$item->month]['total'] = $item->total;
        //     }
        // }

        return response()->json($successOrder);
    }
}
