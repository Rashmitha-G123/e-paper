<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'E-Paper')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .dashboard-card {
            transition: transform 0.3s;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
        }
        .edition-viewer {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .page-navigation {
            position: sticky;
            top: 20px;
        }
        .edition-card {
            height: 100%;
            transition: all 0.3s ease;
        }
        .edition-card:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .edition-cover {
            height: 300px;
            object-fit: cover;
        }
        .page-image {
            max-width: 100%;
            height: auto;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
       .navbar {
    background-color: #1a1a1a;
    padding: 1rem 2rem;
    border-bottom: 1px solid #333;
}

.navbar-brand {
    color: white !important;
    font-size: 1.5rem;
    display: flex;
    align-items: center;
}

.navbar-brand img {
    height: 70px;           /* Suitable for navbar height */
    width: auto;            /* Maintain aspect ratio */
    margin-right: 12px;
    animation: float 3s ease-in-out infinite;
    object-fit: contain;    /* Ensure image doesn't stretch */
}


@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
    100% { transform: translateY(0px); }
}

.nav-link {
    color: rgba(255, 255, 255, 0.8) !important;
    margin: 0 0.75rem;
    padding: 0.5rem 1rem !important;
    position: relative;
    transition: all 0.3s ease;
}

.nav-link i {
    transition: transform 0.3s ease;
}

.nav-link:hover {
    color: white !important;
}

.nav-link:hover i {
    transform: scale(1.2);
}

.nav-link.active {
    color: #3498db !important;
    font-weight: 600;
}

.navbar-toggler {
    border-color: rgba(255,255,255,0.1);
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3e%3cpath stroke='rgba(255, 255, 255, 0.8)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}
        @media (max-width: 768px) {
            .page-navigation {
                position: static;
                margin-bottom: 20px;
            }
            .edition-cover {
                height: 200px;
            }
        }
        @media (max-width: 768px) {
    .navbar-brand img {
        height: 30px; /* Slightly smaller on mobile */
    }
}

    </style>
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #34495e;">
        <div class="container">
            <a class="navbar-brand" href="#">
            <img src="/images/logo (2).png" alt="E-Paper Portal Logo" width="50" height="50" class="d-inline-block align-top me-2">
            E-Paper Portal
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <!-- <a class="nav-link active" href="{{ route('home') }}"><i class="bi bi-newspaper"></i> Editions</a> -->
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-person-circle"></i> Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container py-4">
        <!-- Filter Section -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('home') }}" class="row g-3">
                    <div class="col-md-3">
                        <input type="text" name="publication_name" class="form-control" placeholder="Search by name" value="{{ request('publication_name') }}">
                    </div>
                    <div class="col-md-3">
                        <select name="publication_type" class="form-select">
                            <option value="">All Publications</option>
                            <option value="Newspaper" {{ $publicationType == 'Newspaper' ? 'selected' : '' }}>Newspapers</option>
                            <option value="Magazine" {{ $publicationType == 'Magazine' ? 'selected' : '' }}>Magazines</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select name="date" class="form-select">
                            <option value="">All Dates</option>
                            @foreach ($allDates as $date)
                                <option value="{{ $date }}" {{ $selectedDate == $date ? 'selected' : '' }}>
                                    {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-dark">Filter</button>
                        <a href="{{ route('home') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Editions Grid -->
        @if($editions->count() > 0)
            <div class="row">
                @foreach($editions as $edition)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <div class="card edition-card h-100">
                            <a href="{{ route('edition.show', ['id' => $edition->id]) }}">
    @if($edition->pages->count() > 0)
        <img src="{{ asset('storage/' . $edition->pages[0]->image_path) }}" 
             class="card-img-top edition-cover" 
             alt="{{ $edition->publication_type }} Cover"
             loading="lazy">
    @else
        <div class="edition-cover bg-light d-flex align-items-center justify-content-center">
            <i class="bi bi-newspaper text-muted" style="font-size: 3rem;"></i>
        </div>
    @endif
</a>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title edition-title">{{ $edition->publication_name }}</h5>
                                <p class="card-text edition-info">
                                    {{ $edition->publication_type }} - {{ \Carbon\Carbon::parse($edition->edition_date)->format('F j, Y') }}
                                </p>
                                <div class="mt-auto">
                                    <a href="{{ route('edition.show', ['id' => $edition->id]) }}" 
   class="btn btn-sm btn-outline-dark w-100">
   Read Now
</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $editions->withQueryString()->links() }}
            </div>
        @else
            <div class="alert alert-info text-center">
                No editions found matching your criteria.
            </div>
        @endif

        <!-- Edition Viewer -->
        
    </main>

    <!-- Footer -->
    <footer class="text-white py-4 mt-5" style="background-color: #34495e;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>E-Paper Portal</h5>
                    <p>Your digital newspaper and magazine solution.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">About Us</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Connect</h5>
                    <a href="#" class="text-white me-2" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-2" aria-label="Twitter"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-white me-2" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
                </div>
            </div>
            <hr class="my-4 bg-light">
            <div class="text-center">
                <p class="mb-0">&copy; {{ date('Y') }} E-Paper Portal. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <!-- Viewer Script -->
   
    
    @stack('scripts')
</body>
</html>