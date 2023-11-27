<?php

namespace App\Http\Controllers;


use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MainController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    public function index(Request $request)
    {
        $count = $request->session()->get('counter', 0);
        $count++;
        $request->session()->put('counter', $count);
        $cities = City::get();
        $users = User::get();
        return view('main', compact('count', 'cities', 'users'));
    }
    public function sort(Request $request)
    {
        $count = $request->session()->get('counter', 0);
        $count++;
        $request->session()->put('counter', $count);

        // $getAllInfo = City::get();
        // $cities = $getAllInfo->applyFilter($request);
        $cities = (new City())->applyFilter($request);

        return view('main', compact('count', 'cities'));
    }


    public function sortUsers(Request $request)
    {
        $count = $request->session()->get('counter', 0);
        $count++;
        $request->session()->put('counter', $count);
        $cities = City::get();
        $users = (new User())->applyFilterUsers($request);
        return view('user', compact('count', 'users', 'cities'));
    }

    public function search(Request $request)
    {
        $searchQuery = $request->input('searchQuery');

        $users = User::where('name', 'LIKE', "%{$searchQuery}%")
            ->orWhere('surname', 'LIKE', "%{$searchQuery}%")
            ->get();

        return view('search', compact('users', 'searchQuery'));
    }
}
