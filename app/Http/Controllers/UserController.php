<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $count = $request->session()->get('counter', 0);
        $count++;
        $request->session()->put('counter', $count);
        $users = User::get();
        $cities = City::get();
        return view('user', compact('count', 'users', 'cities')); // тут  user - блейд файл
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->input('inputName');
        $surname = $request->input('inputSurname');
        $cityId = $request->input('citySelect');
        $city = City::where('id', $cityId)->first();

        $path = null;
        // dd($request->hasFile('image'));
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imgName = time() . '_' . $image->getClientOriginalName();

            // Сохраняем изображение в storage/app/users
            $path = $image->storeAs('public/users', $imgName);
        }
        // dd($path);
        User::create(['name' => $name, 'surname' => $surname, 'city_id' => $cityId, 'name_of_city' => $city->name, 'img' => $path]);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        // $users = User::get();
        $cities = City::get();
        return view('update_user', compact('user', 'cities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $path = null;

        // dd($request->hasFile('image_edit'), $user->id); //


        if ($request->hasFile('image_edit')) { //
            Storage::delete($user->img);
            $path = $request->file('image_edit')->store('public/users');  //
            $user->img = $path;
        }

        $nameToUpdate = $request->input('name_edit');
        $surnameToUpdate = $request->input('surname_edit');
        $cityToUpdate = $request->input('city_edit');

        $cityFilter = City::where('name', $cityToUpdate)->first();
        $cityIndexToUpdate = $cityFilter->index;


        $user->update([
            'name' => $nameToUpdate,
            'surname' => $surnameToUpdate,
            'name_of_city' => $cityToUpdate,
            'city_id' => $cityIndexToUpdate,
            'img' => $path ?? $user->img
        ]);

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            Storage::delete($user->img);
        }
        return redirect()->route('users.index');
    }
}
