<?php

namespace App\Http\Controllers;

use App\Models\ManagementTeam;
use Illuminate\Http\Request;

class ManagementTeamController extends Controller
{
    public function index()
    {
        $teamMembers = ManagementTeam::all();
        return view('admin.management_team.index', compact('teamMembers'));
    }

    public function create()
    {
        return view('admin.management_team.create');
    }

    public function show($id)
    {
        $member = ManagementTeam::findOrFail($id);
        return view('admin.management_team.show', compact('member'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:management_teams,email',
        ]);

        ManagementTeam::create($request->all());

        return redirect()->route('management-teams.index')->with('success', 'Team member added successfully.');
    }

    public function edit(ManagementTeam $managementTeam)
    {
        return view('admin.management_team.edit', compact('managementTeam'));
    }

    public function update(Request $request, ManagementTeam $managementTeam)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|unique:management_teams,email,' . $managementTeam->id,
        ]);

        $managementTeam->update($request->all());

        return redirect()->route('management-teams.index')->with('success', 'Team member updated successfully.');
    }

    public function destroy(ManagementTeam $managementTeam)
    {
        $managementTeam->delete();

        return redirect()->route('management-teams.index')->with('success', 'Team member deleted successfully.');
    }
}
