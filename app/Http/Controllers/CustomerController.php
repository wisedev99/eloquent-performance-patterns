<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        Auth::login(User::where('name', 'Ted Bossman')->first());
        $customer = Customer::query()
            ->with('salesRep')
            ->visibleTo(Auth::user())
            ->orderBy('name')
            ->paginate();

        return view('costumers', ['customers' => $customer]);
    }
}
