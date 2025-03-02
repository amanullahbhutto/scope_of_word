<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Region;
use App\Models\District;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SchoolController extends Controller
{
    public function index(Request $request)
    {

        if ($request->ajax()) {
          
            $data = School::with(['region', 'district'])
            ->select('id', 'school_name', 'region_id', 'district_id')  // Select only necessary columns
            ->whereNull('deleted_at');

            return DataTables::of($data)
            ->addColumn('region_name', function ($row) {
                return $row->region ? $row->region->region_name : 'N/A';
            })
            ->addColumn('district_name', function ($row) {
                return $row->district ? $row->district->district_name : 'N/A';
            })
            ->addColumn('action', function ($row) {
                return '
                    <a href="' . route('schools.edit', $row->id) . '" class="btn btn-sm btn-primary">Edit</a>
                    <form action="' . route('schools.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('admin.schools.index');
    }

    public function create()
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.schools.create', compact('regions', 'districts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'region' => 'nullable|exists:regions,id',
            'district' => 'nullable|exists:districts,id',
        ]);

        School::create($request->all());
        return redirect()->route('schools.index')->with('success', 'School created successfully.');
    }

    public function edit(School $school)
    {
        $regions = Region::all();
        $districts = District::all();
        return view('admin.schools.edit', compact('school', 'regions', 'districts'));
    }

    public function update(Request $request, School $school)
    {
        $request->validate([
            'school_name' => 'required|string|max:255',
            'region' => 'nullable|exists:regions,id',
            'district' => 'nullable|exists:districts,id',
        ]);

        $school->update($request->all());
        return redirect()->route('schools.index')->with('success', 'School updated successfully.');
    }

    public function destroy(School $school)
    {
        $school->delete();
        return redirect()->route('schools.index')->with('success', 'School deleted successfully.');
    }
}
