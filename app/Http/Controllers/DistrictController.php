<?php 
namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Region;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = District::with('region')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('region_name', function ($row) {
                    return $row->region ? $row->region->region_name : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    return '<a href="'.route('districts.edit', $row->id).'" class="btn btn-sm btn-primary">Edit</a>
                            <form action="'.route('districts.destroy', $row->id).'" method="POST" style="display:inline;">
                                '.csrf_field().method_field('DELETE').'
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.districts.index');
    }

    public function create()
    {
        $regions = Region::all();
        return view('admin.districts.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'district_name' => 'required|string|max:255',
            'region_id' => 'nullable|exists:regions,id',
        ]);

        District::create($request->all());
        return redirect()->route('districts.index')->with('success', 'District created successfully.');
    }

    public function edit(District $district)
    {
        $regions = Region::all();
        return view('admin.districts.edit', compact('district', 'regions'));
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'district_name' => 'required|string|max:255',
            'region_id' => 'nullable|exists:regions,id',
        ]);

        $district->update($request->all());
        return redirect()->route('districts.index')->with('success', 'District updated successfully.');
    }

    public function destroy(District $district)
    {
        $district->delete();
        return redirect()->route('districts.index')->with('success', 'District deleted successfully.');
    }
}
