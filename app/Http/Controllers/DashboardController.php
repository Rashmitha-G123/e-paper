<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edition;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // --- Dashboard Statistics (no changes needed here) ---
        $totalEditions = Edition::count();
        $totalNewspapers = Edition::where('publication_type', 'Newspaper')->count();
        $totalMagazines = Edition::where('publication_type', 'Magazine')->count();
        $latestEdition = Edition::orderBy('edition_date', 'desc')->first();

        // --- CHART DATA: Modified to base on the last 7 distinct upload dates ---

        // 1. Get the last 7 distinct edition dates that have uploads, ordered chronologically
        // We fetch the latest 7 distinct dates in descending order and then reverse them.
        $last7UploadDates = Edition::selectRaw('DATE(edition_date) as date')
            ->distinct()
            ->orderBy('date', 'desc')
            ->take(7) // Get the most recent 7 unique dates
            ->pluck('date')
            ->reverse() // Reverse to get them in chronological order (oldest to newest)
            ->values(); // Reset array keys after reversing

        // If there are less than 7 upload dates, the chart will display only what's available.
        // You could add logic here to pad with earlier calendar dates if you always need 7 bars,
        // but typically for "last X distinct events", you show only the events that happened.

        // Determine the date range for querying the data.
        // This helps optimize queries, especially if you have millions of records.
        $minDate = $last7UploadDates->first();
        $maxDate = $last7UploadDates->last();

        // 2. Fetch counts for Newspapers for these specific dates
        $newspaperDataRaw = Edition::where('publication_type', 'Newspaper')
            ->whereIn(DB::raw('DATE(edition_date)'), $last7UploadDates) // Only include these specific dates
            ->selectRaw('DATE(edition_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date'); // e.g., ['2025-06-04' => 10, '2025-06-07' => 5]

        // 3. Fetch counts for Magazines for these specific dates
        $magazineDataRaw = Edition::where('publication_type', 'Magazine')
            ->whereIn(DB::raw('DATE(edition_date)'), $last7UploadDates) // Only include these specific dates
            ->selectRaw('DATE(edition_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->pluck('count', 'date'); // e.g., ['2025-06-05' => 3, '2025-06-07' => 8]

        // 4. Prepare arrays for chart labels and data, ensuring all 7 relevant dates are covered
        $chartLabels = [];       // Day name (e.g., Mon, Tue)
        $chartDates = [];        // Full date for tooltips (e.g., Jun 5)
        $newspaperCounts = [];   // Counts for newspapers on these dates
        $magazineCounts = [];    // Counts for magazines on these dates

        foreach ($last7UploadDates as $date) {
            $carbonDate = Carbon::parse($date);
            $chartLabels[] = $carbonDate->format('D');     // e.g., 'Mon'
            $chartDates[] = $carbonDate->format('M j');    // e.g., 'Jun 5'

            // Get count for this specific date, or 0 if no entry exists for this publication type
            $newspaperCounts[] = $newspaperDataRaw[$date] ?? 0;
            $magazineCounts[] = $magazineDataRaw[$date] ?? 0;
        }

        // --- Return data to the 'dashboard' view ---
        return view('dashboard', compact(
            'totalEditions',
            'totalNewspapers',
            'totalMagazines',
            'latestEdition',
            'chartLabels',
            'newspaperCounts',
            'magazineCounts',
            'chartDates'
        ));
    }
}