<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::query()
            ->search(request('search'))
            ->WithLastLoginAt()
            ->WithLastLoginIpAdress()
            ->orderBy(Company::select('name')
                ->whereColumn('id', 'users.company_id')
                ->orderBy('name')
                ->take(1))
            ->simplePaginate();
        return view('users', ['users' => $users]);
    }

    public function logins()
    {

        $users = User::query()
            ->WithLastLoginAt()
            ->WithLastLoginIpAdress()
            ->orderBy('name')
            ->paginate();

        return view('users', ['users' => $users]);
    }
}
