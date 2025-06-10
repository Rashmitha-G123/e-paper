<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use Illuminate\Http\Request;
use App\Models\Page;

class EditionController extends Controller
{
    public function index()
    {
        $editions = Edition::orderBy('edition_date', 'desc')->get();
        return view('editions.index', compact('editions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'publication_type' => 'required|in:Newspaper,Magazine',
            'publication_name' => 'required|string|max:255',
            'edition_date' => 'required|date|unique:editions,edition_date',
        ]);

        Edition::create($request->only('publication_type','publication_name', 'edition_date'));
        return redirect()->back()->with('success', 'Edition created successfully!');
    }

    public function update(Request $request, Edition $edition)
    {
        $request->validate([
            'publication_type' => 'required|in:Newspaper,Magazine',
            'publication_name' => 'required|string|max:255',
            'edition_date' => 'required|date|unique:editions,edition_date,' . $edition->id,
        ]);

        $edition->update($request->only('publication_type','publication_name', 'edition_date'));
        return redirect()->back()->with('success', 'Edition updated successfully!');
    }

    public function destroy(Edition $edition)
    {
        $edition->delete();
        return redirect()->back()->with('success', 'Edition deleted successfully!');
    }
}

