<!DOCTYPE html>
<html lang="en">
<head>
    <title>Import & Export Excel</title>
</head>
<body>
    <h2>Import & Export Excel in Laravel</h2>

    <!-- Export Button -->
    <!-- <a href="{{ url('exportUsers') }}"> -->
    <a href="{{ route('export.users') }}">
        <button>Export Users</button>
    </a>

    <!-- Import Form -->
    <form action="{{ url('importUsers') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Import Users</button>
    </form>

    @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
    @endif
</body>
</html>
