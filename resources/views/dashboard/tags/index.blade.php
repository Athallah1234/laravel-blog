@extends('dashboard.layouts.app')

@section('title', 'Tags')

@push('css')
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      min-height: 100vh;
    }

    .sidebar {
      background: #007bff;
      min-height: 100vh;
      color: #fff;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      padding: 0.75rem 1rem;
      display: block;
      border-radius: 0.5rem;
      margin-bottom: 0.3rem;
      transition: 0.3s;
    }
    .sidebar a:hover, .sidebar a.active {
      background: rgba(255,255,255,0.2);
    }

    .top-navbar {
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 0.5rem 1rem;
    }

    .table-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>Tags</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Tags</li>
      </ol>
    </nav>

    <!-- Table Card -->
    <div class="table-card" data-aos="fade-up">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>List of Tags</h5>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex gap-2">
          <input type="text" class="form-control w-50" placeholder="Search tags...">

          <!-- Tombol Create Tag -->
          <a href="{{ route('dashboard.tags.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Create Tag
          </a>
        </div>
      </div>

      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Slug</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($tags as $tag)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $tag->name }}</td>
              <td>{{ $tag->slug }}</td>
              <td>
                <a href="{{ route('dashboard.tags.edit',$tag->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                <form action="{{ route('dashboard.tags.destroy',$tag->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Delete this tag?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Pagination -->
      {{ $tags->links() }}
    </div>
  </div>
@endsection
