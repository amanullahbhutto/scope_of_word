<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RegionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $regions = Region::query();
            return DataTables::of($regions)
                ->addColumn('action', function ($region) {
                    return '
                        <a href="' . route('regions.edit', $region->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <form action="' . route('regions.destroy', $region->id) . '" method="POST" style="display:inline;">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm(\'Are you sure?\')">Delete</button>
                        </form>
                    ';
                })
                ->make(true);
        }

        return view('admin.region.index');
    }

    public function create()
    {
        return view('admin.region.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'region_name' => 'required|string',
            'province_id' => 'nullable|integer',
        ]);

        Region::create($request->only('region_name', 'province_id'));

        return redirect()->route('regions.index')->with('success', 'Region created successfully.');
    }

    public function edit(Region $region)
    {
        return view('admin.region.edit', compact('region'));
    }

    public function update(Request $request, Region $region)
    {
        $request->validate([
            'region_name' => 'required|string',
            'province_id' => 'nullable|integer',
        ]);

        $region->update($request->only('region_name', 'province_id'));

        return redirect()->route('regions.index')->with('success', 'Region updated successfully.');
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return redirect()->route('regions.index')->with('success', 'Region deleted successfully.');
    }
}
