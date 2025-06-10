@extends('layouts.app')

@section('title', 'Pages for ' . $edition->publication_type . ' - ' . $edition->edition_date)

@section('content')
    <h2 class="section-title">Pages for {{ $edition->publication_type }} ({{ $edition->edition_date }})</h2>

    <!-- @if(session('success'))
        <p class="success-message">{{ session('success') }}</p>
    @endif -->

    <form action="{{ route('pages.store', $edition) }}" method="POST" enctype="multipart/form-data" class="upload-form">
        @csrf
        <label for="images" class="upload-label">Upload Pages (Images)</label>
        <input id="images" type="file" name="images[]" multiple required accept="image/*" class="file-input">
        <button type="submit" class="btn btn-primary">Upload Pages</button>
    </form>

    <div class="pages-preview">
    @foreach($pages as $page)
        <div class="page-item">
            <p class="page-number">Page {{ $page->page_number }}</p>
            <img id="page-image-{{ $page->id }}" src="{{ asset('storage/' . $page->image_path) }}" alt="Page {{ $page->page_number }}" class="page-image">
            <p id="page-description-{{ $page->id }}" class="page-description">
    {{ $page->description ?? 'No description available.' }}
</p>
            <div class="button-group" style="display: flex; gap: 10px;">
                <!-- Delete Button -->
                <form method="POST" action="{{ route('pages.destroy', $page) }}" onsubmit="return confirm('Are you sure you want to delete this page?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>

                <!-- Edit Button -->
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $page->id }}">
                    Edit
                </button>
            </div>
        </div>
       <div class="modal fade" id="editModal{{ $page->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $page->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form class="edit-page-form" data-id="{{ $page->id }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel{{ $page->id }}">Edit Page {{ $page->page_number }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="description{{ $page->id }}" class="form-label">Description</label>
                                    <textarea name="description" id="description{{ $page->id }}" class="form-control" rows="4" required>{{ $page->description }}</textarea>
                                </div>
                                <div class="mb-3">
    <label for="image{{ $page->id }}" class="form-label">Replace Image (optional)</label>
    <input type="file" name="image" id="image{{ $page->id }}" class="form-control" accept="image/*">
</div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    @endforeach
</div>


     <style>
        .section-title {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #2c3e50;
            text-align: center;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(0, 128, 0, 0.2);
        }

        .upload-form {
            max-width: 600px;
            margin: 0 auto 40px auto;
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: #f7f9fc;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        .upload-label {
            font-weight: 600;
            color: #34495e;
            font-size: 1rem;
        }

        .file-input {
            padding: 8px;
            border: 2px solid #2980b9;
            border-radius: 6px;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .file-input:hover {
            border-color: #1c5980;
        }

        .btn {
            font-weight: 600;
            border: none;
            padding: 12px 20px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 1rem;
        }

        .btn-primary {
            background-color: #2980b9;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #1c5980;
        }

        .pages-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            justify-content: center;
        }

        .page-item {
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
            padding: 15px;
            width: 220px;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s ease;
        }
        .page-description {
    width: 100%;
    text-align: center;
    font-size: 0.95rem;
    color: #444;
    margin-bottom: 15px;
    line-height: 1.4;
    height: 42px; /* Fixed height for approx. 2 lines */
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;    /* Limit to 2 lines */
    -webkit-box-orient: vertical;
    word-wrap: break-word;
    white-space: normal;
}

.page-description.text-muted {
        color: #888;
        font-style: italic;
    }
        .page-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.12);
        }

        .page-number {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 12px;
            color: #2c3e50;
        }

        .page-image {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.08);
        }

        .page-actions {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .delete-form {
            flex: 1;
        }

        .btn-danger {
            background-color: #c0392b;
            color: white;
            width: 100%;
            padding: 12px 20px;
            border-radius: 6px;
            font-weight: 600;
        }

        .btn-danger:hover {
            background-color: #8e261d;
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .pages-preview {
                justify-content: center;
            }
            .page-item {
                width: 45%;
            }
        }
        @media (max-width: 480px) {
            .page-item {
                width: 100%;
            }
            .upload-form {
                padding: 15px;
            }
            .page-actions {
                flex-direction: column;
            }
        }
        textarea.form-control {
            resize: vertical;
            min-height: 100px;
            font-size: 1rem;
        }

    </style>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.edit-page-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();

            const pageId = this.dataset.id;
            const modal = document.querySelector(`#editModal${pageId}`);
            const formData = new FormData(this);

            try {
                const response = await fetch(`/pages/${pageId}`, {
                    method: 'POST', // or 'PUT' if your route expects it
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                if (response.ok) {
                    const result = await response.json();

                    // Update description text on page
                    const descEl = document.querySelector(`#page-description-${pageId}`);
                    descEl.textContent = result.description || 'No description available.';

                    // Update image src with cache busting to force reload
                    if (result.image_url) {
                        const imgEl = document.querySelector(`#page-image-${pageId}`);
                        imgEl.src = result.image_url + '?t=' + new Date().getTime();
                    }

                    // Close modal
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();

                    // Optional success feedback
                    alert('Page updated successfully!');
                } else {
                    const errorData = await response.json();
                    alert('Failed to update: ' + (errorData.message || 'Unknown error'));
                }
            } catch (error) {
                console.error('AJAX error:', error);
                alert('An error occurred while updating.');
            }
        });
    });
});
</script>


@endsection
