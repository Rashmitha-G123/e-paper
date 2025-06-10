<?php

namespace App\Http\Controllers;

use App\Models\Edition;
use App\Models\Page;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Filter parameters
        $publicationType = $request->get('publication_type', '');
        $selectedDate = $request->get('date', '');

        // Base query
        $query = Edition::query();
        
        // Apply filters
        if ($request->filled('publication_name')) { // Use $request if you have it injected, otherwise get it from $_GET or equivalent
    $searchTerm = $request->input('publication_name'); // Get the search term
    $query->where('publication_name', 'like', '%' . $searchTerm . '%');
}
        if ($publicationType) {
            $query->where('publication_type', $publicationType);
        }
        if ($selectedDate) {
            $query->whereDate('edition_date', $selectedDate);
        }

        // Get all available dates for filter dropdown
        $allDates = Edition::selectRaw('DATE(edition_date) as date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->pluck('date');

        // Paginated editions
        $editions = $query->orderBy('edition_date', 'desc')->paginate(100);

        // Get specific edition if requested
        $viewEdition = null;
        if ($request->has('view_edition')) {
            $viewEdition = Edition::with('pages')->find($request->get('view_edition'));
        }

        // Dashboard statistics
        $totalEditions = Edition::count();
        $totalNewspapers = Edition::where('publication_type', 'Newspaper')->count();
        $totalMagazines = Edition::where('publication_type', 'Magazine')->count();
        $latestEdition = Edition::orderBy('edition_date', 'desc')->first();

        // Chart data (last 7 days)
        $chartData = $this->getChartData();

        return view('home', array_merge(
            compact(
                'editions', 
                'allDates', 
                'publicationType', 
                'selectedDate', 
                'viewEdition',
                'totalEditions',
                'totalNewspapers',
                'totalMagazines',
                'latestEdition'
            ),
            $chartData
        ));
    }

    // In HomeController.php
public function showEdition($id)
{
    $edition = Edition::with('pages')->findOrFail($id);
    return view('edition_viewer', compact('edition')); // Make sure this line is correct
}

    protected function getChartData()
    {
        $endDate = Carbon::now();
        $startDate = Carbon::now()->subDays(6);

        // Initialize arrays for all dates in the range
        $dates = [];
        $currentDate = clone $startDate;
        
        while ($currentDate <= $endDate) {
            $dates[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Get newspaper counts
        $newspaperCounts = Edition::where('publication_type', 'Newspaper')
            ->whereDate('edition_date', '>=', $startDate)
            ->whereDate('edition_date', '<=', $endDate)
            ->selectRaw('DATE(edition_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Get magazine counts
        $magazineCounts = Edition::where('publication_type', 'Magazine')
            ->whereDate('edition_date', '>=', $startDate)
            ->whereDate('edition_date', '<=', $endDate)
            ->selectRaw('DATE(edition_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date')
            ->toArray();

        // Fill in zeros for dates with no publications
        $filledNewspaperCounts = [];
        $filledMagazineCounts = [];
        $chartLabels = [];
        $chartDates = [];

        foreach ($dates as $date) {
            $chartLabels[] = Carbon::parse($date)->format('D');
            $chartDates[] = Carbon::parse($date)->format('M j');
            
            $filledNewspaperCounts[] = $newspaperCounts[$date] ?? 0;
            $filledMagazineCounts[] = $magazineCounts[$date] ?? 0;
        }

        return [
            'chartLabels' => $chartLabels,
            'chartDates' => $chartDates,
            'newspaperCounts' => $filledNewspaperCounts,
            'magazineCounts' => $filledMagazineCounts
        ];
    }
}