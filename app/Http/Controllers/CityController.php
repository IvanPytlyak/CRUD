<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CityController extends Controller
{



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $cityName = $request->input('inputCity');
        $index = $request->input('inputIndex');

        City::create(['index' => $index, 'name' => $cityName]);
        return redirect()->route('main');
    }

    /**
     * Display the specified resource.
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(City $city, Request $request)
    {
        $id = $city->id;
        $cityToUpdate = City::find($id);

        $inputCity = $request->input('city');
        $inputIndex = $request->input('index');

        $cityToUpdate->update([
            'name' => $inputCity,
            'index' => $inputIndex,
        ]);

        return redirect()->route('main');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $city = City::find($id);
        if ($city) {
            $city->delete();
        }
        return redirect()->route('main');
    }
}
