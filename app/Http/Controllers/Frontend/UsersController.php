<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function myOrders()
    {
        $orders = Order::select()->where('user_id', Auth::user()->id)->get();

        return view('frontend.users.myorders', compact('orders'));
    }

    public function settings()
    {
        $user = User::find(Auth::user()->id);

        return view('frontend.users.settings', compact('user'));
    }


    public function updateUserSettings(Request $request, $id)
    {
        Request()->validate([
            "email" => "required|max:40",
            "name" => "required|max:40",
        ]);

        $user = User::find($id);

        $user->update($request->all());

        if ($user) {
            toast('Berhasil Update Data!', 'success')->timerProgressBar();
            return Redirect::route("users.settings")->with(['update' => 'User date updated successfully']);
        }
    }
}
