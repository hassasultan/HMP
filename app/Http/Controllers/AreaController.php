<?php
namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Hydrants;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::with('hydrant')->paginate(10);
        return view('pages.areas.index', compact('areas'));
    }

    public function create()
    {
        $hydrants = Hydrants::all();
        return view('pages.areas.create', compact('hydrants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hydrant_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'total_km' => 'required|numeric',
            'extra_km' => 'required|numeric',
        ]);

        Area::create($request->all());

        return redirect()->route('areas.index')->with('success', 'Area created successfully.');
    }

    public function show($id)
    {
        //
    }

    public function edit(Area $area)
    {
        $hydrants = Hydrants::all();
        return view('pages.areas.edit', compact('area', 'hydrants'));
    }

    public function update(Request $request, Area $area)
    {
        $request->validate([
            'hydrant_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'total_km' => 'required|numeric',
            'extra_km' => 'required|numeric',
        ]);

        $area->update($request->all());

        return redirect()->route('areas.index')->with('success', 'Area updated successfully.');
    }

    public function destroy(Area $area)
    {
        $area->delete();

        return redirect()->route('areas.index')->with('success', 'Area deleted successfully.');
    }
}
