<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Market;
use App\Models\Order;
use App\Models\ServiceOrder;
use App\Models\ServiceProvider;
use App\Models\User;
use App\Models\Admin;

class HomeController extends Controller
{
    public function index(){
        $data = [];
        $data['users'] = User::count();
        $data['markets'] = Market::count();
        $data['service_providers'] = ServiceProvider::count();
        $data['banners'] = Banner::count();
        $data['orders'] = Order::count();
        $data['service_orders'] = ServiceOrder::count();
        $currentYear = date('Y');
        $currentYearCounts = $this->ordersByYear($currentYear);
        $data['orders_chart'] = $currentYearCounts;
        $previousYearCounts = $this->serviceOrdersByYear($currentYear);
        $data['service_order_chart'] = $previousYearCounts;
        $thisYearOrders = $this->getThisYearOrders($currentYear);
        $data['order_count'] = $thisYearOrders->where('status','completed')->count();
        $thisYearOrders = $this->getThisYearServiceOrders($currentYear);
        $data['service_orders_count'] = $thisYearOrders->whereIn('status',['canceled'])->count();
        return view('admin.pages.home.home',compact('data'));
    }
    public function change_lang($lang){
        session(['lang' => $lang]);
        app()->setLocale($lang);
        return redirect()->route('home');
    }
    public function getThisYearOrders($currentYear){
        $thisYearOrders = Order::whereYear('created_at', $currentYear);
        return $thisYearOrders;
    }
    public function getThisYearServiceOrders($currentYear){
        $thisYearOrders = ServiceOrder::whereYear('created_at', $currentYear);
        return $thisYearOrders;
    }
    public function ordersByYear($year)
    {
        // Initialize an array to store the counts for each month
        $orderCounts = [];

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // Get the count of orders for the current month and year
            $orderCount = Order::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            // Store the count in the array
            $orderCounts[] = $orderCount;
        }

        return $orderCounts;
    }
    public function serviceOrdersByYear($year)
    {
        // Initialize an array to store the counts for each month
        $orderCounts = [];

        // Loop through each month of the year
        for ($month = 1; $month <= 12; $month++) {
            // Get the count of orders for the current month and year
            $orderCount = ServiceOrder::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            // Store the count in the array
            $orderCounts[] = $orderCount;
        }

        return $orderCounts;
    }
}
