<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestAreas;
use App\CustomClasses\Getters\TestAreasGetter;


class TestAreasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return TestAreas::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'area_code' => 'required',
            'area_name' => 'required',
            'geom' => 'required'
        ]);
        return TestAreas::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return TestAreas::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testAreas = TestAreas::find($id);
        $testAreas->update($request->all());
        return $testAreas;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return TestAreas::destroy($id);
    }

    /**
     * search for area.
     *
     * @param  str $area_name
     * @return \Illuminate\Http\Response
     */
    public function search($area_name)
    {
        return TestAreas::where('area_name', 'ilike', '%'.$area_name.'%')->get();
    }

    /**
     * return the areas with polygons
     *
     * @return \Illuminate\Http\Response
     */
    public function polygons()
    {
        return TestAreasGetter::polygons();            
    }
}
