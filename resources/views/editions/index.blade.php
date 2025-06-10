@extends('layouts.app')

@section('title', 'Editions')

@section('content')
    <h1>Editions Page</h1>
    <div class="container">
    <h3>Manage Editions</h3>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    {{-- Create Form --}}
    <form method="POST" action="{{ route('editions.store') }}" class="edition-form">
        @csrf

        <input type="text" name="publication_name" required placeholder="Enter Publication Name">
        <select name="publication_type" required>
            <option value="">Select Type</option>
            <option value="Newspaper">Newspaper</option>
            <option value="Magazine">Magazine</option>
        </select>
        <input type="date" name="edition_date" required>
        <button type="submit">Create Edition</button>
    </form>

    {{-- Table --}}
    <table class="edition-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Edition Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($editions as $edition)
                <tr>
                    <form method="POST" action="{{ route('editions.update', $edition->id) }}">
                        @csrf
                        @method('PUT')
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <select name="publication_type" required>
                                <option value="Newspaper" {{ $edition->publication_type == 'Newspaper' ? 'selected' : '' }}>Newspaper</option>
                                <option value="Magazine" {{ $edition->publication_type == 'Magazine' ? 'selected' : '' }}>Magazine</option>
                            </select>
                        </td>

                         <!-- Publication Name (new input) -->
                        <td>
                            <input type="text" name="publication_name" value="{{ $edition->publication_name }}" required placeholder="Enter name (e.g. The Hindu)">
                        </td>
                        <td>
                            <input type="date" name="edition_date" value="{{ $edition->edition_date }}" required>
                        </td>
                        <td>
                            <button type="submit">Update</button>
                    </form>
                    <form method="POST" action="{{ route('editions.destroy', $edition->id) }}" onsubmit="return confirm('Are you sure you want to delete this edition?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                        </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<style>
.container {
    max-width: 850px;
    margin: 20px auto;
    padding: 25px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.1);
}

h3 {
    margin-bottom: 20px;
    color: #2c3e50;
}

.success {
    background: #e0f9e0;
    color: green;
    padding: 10px;
    border-radius: 6px;
    margin-bottom: 10px;
}

.edition-form {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
}

.edition-form select,
.edition-form input,
.edition-form button {
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

.edition-table {
    width: 100%;
    border-collapse: collapse;
}

.edition-table th,
.edition-table td {
    padding: 10px;
    border: 1px solid #eee;
}

.edition-table select,
.edition-table input {
    width: 100%;
    padding: 5px;
}
</style>
@endsection

