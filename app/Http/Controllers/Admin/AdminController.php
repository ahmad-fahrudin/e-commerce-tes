<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Product;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Jenssegers\Agent\Facades\Agent;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function viewLogin()
    {
        return view('admin.login');
    }
    public function checkLogin(Request $request)
    {
        $remember_me = $request->has('remember_me') ? true : false;
        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            toast('Berhasil Login', 'success')->timerProgressBar();
            return redirect()->route('dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);
    }

    public function dashboard()
    {
        $productsCount = Product::select()->count();
        $ordersCount = Order::select()->count();
        $adminsCount = Admin::select()->count();
        $user = User::select()->count();


        //Get system information
        // Mendapatkan jenis browser yang digunakan oleh pengguna
        $browser = Agent::browser();

        // Mendapatkan versi browser yang digunakan oleh pengguna
        $browserVersion = Agent::version($browser);

        // Mendapatkan platform (sistem operasi) yang digunakan oleh pengguna
        $platform = Agent::platform();

        return view('admin.index', compact('user', 'productsCount', 'ordersCount', 'adminsCount', 'browser', 'browserVersion', 'platform'));
    }

    public function adminLogout()
    {
        auth()->guard('admin')->logout();
        // Menggunakan guard admin untuk logout
        toast('Berhasil Logout!', 'success')->timerProgressBar();
        return redirect()->route('view.login');
    }
}
