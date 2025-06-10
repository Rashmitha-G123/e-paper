<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Edition Viewer')</title> {{-- Changed title for viewer page --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        /* Your existing styles relevant to the viewer */
        .edition-viewer {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .page-navigation {
            position: sticky;
            top: 20px;
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
            height: 70px;
            width: auto;
            margin-right: 12px;
            animation: float 3s ease-in-out infinite;
            object-fit: contain;
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
        .page-description {
        line-height: 1.6; /* Improve readability */
        color: #333; /* Darker text for better contrast */
    }
    .page-description-container {
        font-family: 'Georgia', serif; /* Classic newspaper font */
        line-height: 1.6;
        color: #333;
    }

    .article-text {
        font-size: 0.95rem;
        /* text-indent: 1.5em; /* Optional: Indent first line of paragraphs */
        margin-bottom: 1em; /* Space between paragraphs */
    }

    /* Optional: Add a subtle border or line between columns for newspaper feel on larger screens */
    @media (min-width: 768px) {
        .page-description-container .col-md-6:first-child {
            border-right: 1px solid #eee; /* Light divider */
            padding-right: 20px; /* Space from divider */
        }
        .page-description-container .col-md-6:last-child {
            padding-left: 20px; /* Space from divider */
        }
    }
        @media (max-width: 768px) {
            .page-navigation {
                position: static;
                margin-bottom: 20px;
            }
            .edition-cover { /* This style is not directly used in viewer, but good to keep if you have a general stylesheet */
                height: 200px;
            }
        }
        @media (max-width: 768px) {
            .navbar-brand img {
                height: 30px;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #34495e;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}"> {{-- Link back to home --}}
                <img src="/images/logo (2).png" alt="E-Paper Portal Logo" width="100" height="100" class="d-inline-block align-top me-2">
                E-Paper Portal
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    {{-- Your existing nav items --}}
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}"><i class="bi bi-speedometer2"></i> Dashboard</a> {{-- Changed to Home --}}
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}"><i class="bi bi-person-circle"></i> Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container py-4">
        {{-- The entire viewer block goes here --}}
        {{-- IMPORTANT: Use $edition instead of $viewEdition as per HomeController's compact() --}}
        @if(!empty($edition)) {{-- Check if $edition variable exists and is not empty --}}
            <div class="viewer-container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="edition-title">
                        {{ $edition->publication_name }} - {{-- Changed from $viewEdition to $edition --}}
                        {{ \Carbon\Carbon::parse($edition->edition_date)->format('F j, Y') }}
                    </h2>
                    <div class="viewer-controls">
                        <button class="btn btn-sm btn-outline-secondary" id="zoomOut" aria-label="Zoom Out">
                            <i class="bi bi-zoom-out"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary mx-2" id="zoomReset" aria-label="Reset Zoom">
                            <i class="bi bi-zoom-in"></i> 100%
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" id="zoomIn" aria-label="Zoom In">
                            <i class="bi bi-zoom-in"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-primary ms-3" id="fullscreen" aria-label="Fullscreen">
                            <i class="bi bi-fullscreen"></i> Fullscreen
                        </button>
                    </div>
                </div>

                @if($edition->pages->count() > 0)
                    <div id="editionViewer">
    @foreach($edition->pages as $index => $page)
        <div class="page mb-4 text-center" data-index="{{ $index }}" 
            style="{{ $index === 0 ? '' : 'display:none' }}">
            <img src="{{ asset('storage/' . $page->image_path) }}" 
                alt="Page {{ $index + 1 }} of {{ $edition->publication_name }}" 
                class="page-image"
                style="transform: scale(1); transform-origin: top left;"
                loading="lazy">
            <div class="mt-2 text-muted">Page {{ $index + 1 }}</div>
            
           {{-- START: Added section for page description in news/magazine format --}}
@if(!empty($page->description))
    <div class="page-description-container mt-4 mb-5 mx-auto p-4 border rounded shadow-sm" style="max-width: 900px; background-color: #ffffff;">
        <h4 class="text-center mb-4 text-primary fw-bold">Article Summary / Highlights</h4>
        <div class="row">
            <div class="col-md-6">
                <p class="text-dark article-text" style="white-space: pre-wrap; text-align: justify;">
                    {{ Str::limit($page->description, strlen($page->description) / 2) }}
                </p>
            </div>
            <div class="col-md-6">
                <p class="text-dark article-text" style="white-space: pre-wrap; text-align: justify;">
                    {{ substr($page->description, strlen($page->description) / 2) }}
                </p>
            </div>
        </div>
        <hr class="my-4">
        <p class="text-muted text-center small">For full details, refer to the page image above.</p>
    </div>
@endif
{{-- END: Added section for page description in news/magazine format --}}
        </div>
    @endforeach
</div>

                    <nav aria-label="Edition pages navigation" class="mt-4">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <button id="firstPage" class="page-link" aria-label="First page">
                                    <i class="bi bi-chevron-double-left"></i>
                                </button>
                            </li>
                            <li class="page-item">
                                <button id="prevPage" class="page-link" aria-label="Previous page">
                                    <i class="bi bi-chevron-left"></i>
                                </button>
                            </li>

                            @foreach($edition->pages as $index => $page)
                                <li class="page-item">
                                    <button class="page-link pageNumBtn {{ $index === 0 ? 'active' : '' }}" 
                                            data-index="{{ $index }}"
                                            aria-label="Go to page {{ $index + 1 }}">
                                        {{ $index + 1 }}
                                    </button>
                                </li>
                            @endforeach

                            <li class="page-item">
                                <button id="nextPage" class="page-link" aria-label="Next page">
                                    <i class="bi bi-chevron-right"></i>
                                </button>
                            </li>
                            <li class="page-item">
                                <button id="lastPage" class="page-link" aria-label="Last page">
                                    <i class="bi bi-chevron-double-right"></i>
                                </button>
                            </li>
                        </ul>
                    </nav>
                @else
                    <div class="alert alert-warning text-center">
                        This edition contains no pages.
                    </div>
                @endif
            </div>
        @else
            <div class="alert alert-danger text-center">
                Edition not found or invalid ID.
            </div>
        @endif
    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> {{-- Only if needed for viewer page --}}
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewer = document.getElementById('editionViewer');
            if (!viewer) return;
            
            let currentIndex = 0;
            let currentZoom = 1;
            const pages = document.querySelectorAll('#editionViewer .page');
            const pageImages = document.querySelectorAll('.page-image');
            const totalPages = pages.length;
            const pageNumBtns = document.querySelectorAll('.pageNumBtn');

            function showPage(index) {
                if(index < 0 || index >= totalPages) return;
                
                pages.forEach((page, i) => {
                    page.style.display = i === index ? '' : 'none';
                });
                
                // Update active pagination button
                pageNumBtns.forEach(btn => {
                    btn.classList.remove('active');
                    if(parseInt(btn.dataset.index) === index) {
                        btn.classList.add('active');
                    }
                });
                
                currentIndex = index;
            }

            // Navigation controls
            document.getElementById('firstPage')?.addEventListener('click', () => showPage(0));
            document.getElementById('prevPage')?.addEventListener('click', () => showPage(currentIndex - 1));
            document.getElementById('nextPage')?.addEventListener('click', () => showPage(currentIndex + 1));
            document.getElementById('lastPage')?.addEventListener('click', () => showPage(totalPages - 1));

            // Page number buttons
            pageNumBtns.forEach(button => {
                button.addEventListener('click', (e) => {
                    const idx = parseInt(e.target.dataset.index);
                    showPage(idx);
                });
            });

            // Zoom controls
            document.getElementById('zoomIn')?.addEventListener('click', () => {
                currentZoom += 0.1;
                updateZoom();
            });

            document.getElementById('zoomOut')?.addEventListener('click', () => {
                if(currentZoom > 0.5) {
                    currentZoom -= 0.1;
                    updateZoom();
                }
            });

            document.getElementById('zoomReset')?.addEventListener('click', () => {
                currentZoom = 1;
                updateZoom();
            });

            function updateZoom() {
                pageImages.forEach(img => {
                    img.style.transform = `scale(${currentZoom})`;
                });
                const zoomResetBtn = document.getElementById('zoomReset');
                if (zoomResetBtn) {
                    zoomResetBtn.innerHTML = `<i class="bi bi-zoom-in"></i> ${Math.round(currentZoom * 100)}%`;
                }
            }

            // Fullscreen control
            document.getElementById('fullscreen')?.addEventListener('click', () => {
                const currentPage = pages[currentIndex];
                if (!currentPage) return;
                
                if(currentPage.requestFullscreen) {
                    currentPage.requestFullscreen();
                } else if(currentPage.webkitRequestFullscreen) {
                    currentPage.webkitRequestFullscreen();
                } else if(currentPage.msRequestFullscreen) {
                    currentPage.msRequestFullscreen();
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if(e.key === 'ArrowLeft') {
                    showPage(currentIndex - 1);
                } else if(e.key === 'ArrowRight') {
                    showPage(currentIndex + 1);
                }
            });

            // Initialize the viewer to show the first page if pages exist
            if (pages.length > 0) {
                showPage(0); 
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>