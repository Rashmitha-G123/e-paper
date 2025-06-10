@extends('layouts.app')

@section('title', 'All Pages from All Editions')

@section('content')
    <h2 class="section-title">All Pages from All Editions</h2>

   <div class="editions-wrapper">
    @foreach ($editions as $edition)
        <div class="edition-card">
            <div class="edition-header clickable" data-url="{{ route('pages.index', $edition->id) }}">
               <div>
                <h3>{{ $edition->publication_name }}</h3><br>
                <p style="font-size: 0.95rem; color: #666;">{{ $edition->publication_type }}</p>
            </div>
                <span class="edition-date">{{ $edition->edition_date }}</span>
            </div>

            <div class="pages-grid">
                @foreach ($edition->pages as $page)
                    <div class="page-card">
                        <p>Page {{ $page->page_number }}</p>
                        <img src="{{ asset('storage/' . $page->image_path) }}" alt="Page {{ $page->page_number }}">
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>


    <style>
        .section-title {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2rem;
            color: #2c3e50;
        }

        .editions-wrapper {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .edition-card {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.06);
        }

        .edition-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .edition-header h3 {
            font-size: 1.5rem;
            color: #2980b9;
        }

        .edition-date {
            background-color: #ecf0f1;
            padding: 5px 10px;
            border-radius: 6px;
            color: #555;
            font-size: 0.9rem;
        }

        .pages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 20px;
        }

        .page-card {
            text-align: center;
            background: #f9f9f9;
            border-radius: 8px;
            padding: 10px;
            transition: transform 0.2s ease;
        }

        .page-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        .page-card img {
            width: 80px; /* or 100px */
            height: auto;
            border-radius: 4px;
            object-fit: cover;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }


        .page-card p {
            margin: 10px 0 5px;
            font-weight: bold;
            color: #34495e;
        }
    </style>
    <script>
    document.querySelectorAll('.edition-header.clickable').forEach(function(element) {
        element.style.cursor = 'pointer'; // show pointer on hover

        element.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            if(url) {
                window.location.href = url;
            }
        });
    });
</script>

@endsection
