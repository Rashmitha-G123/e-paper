@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h1>Welcome to Dashboard</h1>
    <br>

    <!-- Stat Cards -->
    <div class="stats-cards">
    <div class="card">
        <div class="card-content">
            <h3>Total Editions</h3>
            <span id="totalEditions">{{ $totalEditions }}</span>
        </div>
        <img src="{{ asset('images/editions.png') }}" alt="Editions Icon" />
    </div>

    <div class="card">
        <div class="card-content">
            <h3>Newspapers</h3>
            <span id="totalNewspapers">{{ $totalNewspapers }}</span>
        </div>
        <img src="{{ asset('images/newspaper.png') }}" alt="Newspaper Icon" />
    </div>
</div>
<br>
<div class="stats-cards">
    <div class="card">
        <div class="card-content">
            <h3>Magazines</h3>
            <span id="totalMagazines">{{ $totalMagazines }}</span>
        </div>
        <img src="{{ asset('images/magazine.png') }}" alt="Magazine Icon" />
    </div>

    <div class="card">
        <div class="card-content">
            <h3>Latest Edition</h3>
            <span id="latestEdition">{{ $latestEdition ? $latestEdition->edition_date : '--' }}</span>
        </div>
        <img src="{{ asset('images/latest.png') }}" alt="Latest Icon" />
    </div>
</div>



    <!-- Publication Trend Chart -->
    <div class="chart-container">
    <h2>Publication Trend (Last 7 Days)</h2>
    <canvas id="publicationChart"></canvas>
</div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('publicationChart').getContext('2d');

    const publicationChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [
                {
                    label: 'Newspapers',
                    data: {!! json_encode($newspaperCounts) !!},
                    backgroundColor: '#3498db'
                },
                {
                    label: 'Magazines',
                    data: {!! json_encode($magazineCounts) !!},
                    backgroundColor: '#e67e22'
                }
            ]
        },
        options: {
        responsive: true,
        plugins: {
            legend: {
                display: true,
                position: 'top'
            },
            tooltip: {
                mode: 'index',
                intersect: false,
                callbacks: {
                    title: function(tooltipItems) {
                        // Use the index to get the full date from PHP-passed variable chartDates
                        const index = tooltipItems[0].dataIndex;
                        // Make sure you pass `chartDates` from your controller and Blade
                        return {!! json_encode($chartDates) !!}[index];
                    }
                }
            }
        },
            scales: {
                x: {
                    stacked: true
                },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
<style>
.chart-container {
    background: #fff;
    padding: 2rem;
    margin-top: 3rem;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}

.chart-container h2 {
    margin-bottom: 20px;
    color: #2c3e50;
    font-size: 1.5rem;
    text-align: center;
}

#publicationChart {
    width: 100% !important;
    height: 400px !important;
}

.stats-cards {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 3px 8px rgba(0,0,0,0.1);
    padding: 1.5rem;
    display: flex;
    align-items: center;
    width: 550px;
    gap: 1rem;
    flex-direction: row-reverse; /* This will reverse the order */
}

.card-content {
    flex-grow: 1;
    text-align: right; /* Align text to right */
}

.card-content h3 {
    margin: 0 0 0.5rem 0;
    font-size: 1.8rem;
    color: #333;
}

.card-content span {
    font-size: 1.8rem;
    font-weight: bold;
    color: #555;
}

.card img {
    width: 70px;
    height: 100px;
    object-fit: contain;
}
</style>

@endsection
