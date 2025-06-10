<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Edition;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
    public function index(Edition $edition)
{
    $pages = $edition->pages()->orderBy('page_number')->get();
    return view('pages.index', compact('edition', 'pages'));
}

public function store(Request $request, Edition $edition)
{
    $request->validate([
        'images.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $lastPage = $edition->pages()->max('page_number') ?? 0;

    foreach ($request->file('images') as $index => $image) {
        $path = $image->store('pages', 'public');

        $edition->pages()->create([
            'image_path' => $path,
            'page_number' => $lastPage + $index + 1,
        ]);
    }

    return redirect()->route('pages.index', $edition)->with('success', 'Pages uploaded.');
}

public function destroy(Page $page)
{
    Storage::disk('public')->delete($page->image_path);
    $page->delete();

    return back()->with('success', 'Page deleted.');
}
public function allPages()
{
    $editions = Edition::with('pages')->latest()->get();
    return view('pages.all', compact('editions'));
}
public function update(Request $request, Page $page)
{
    $request->validate([
        'description' => 'required|string',
        'image' => 'nullable|image|max:2048', // max 2MB
    ]);

    $page->description = $request->description;

    if ($request->hasFile('image')) {
        // Delete old image if needed
        if ($page->image_path && Storage::exists($page->image_path)) {
            Storage::delete($page->image_path);
        }

        $path = $request->file('image')->store('pages', 'public');
        $page->image_path = $path;
    }

    $page->save();

    // Return JSON response with updated data
    return response()->json([
        'id' => $page->id,
        'description' => $page->description,
        'image_url' => $page->image_path ? asset('storage/' . $page->image_path) : null,
    ]);
}


}
