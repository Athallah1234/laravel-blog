@extends('dashboard.layouts.app')

@section('title', 'Posts')

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

    .avatar-sm {
      width: 60px;
      height: 60px;
      border-radius: 0.75rem;
      object-fit: cover;
    }

    .badge-status {
      font-size: 0.8rem;
      padding: 0.35em 0.6em;
      border-radius: 0.5rem;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>Posts</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Posts</li>
      </ol>
    </nav>

    <!-- Table Card -->
    <div class="table-card" data-aos="fade-up">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>List of Posts</h5>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex gap-2">
          <form action="{{ route('dashboard.posts.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                  class="form-control" placeholder="Search posts...">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button>
          </form>

          <!-- Tombol Create Post -->
          <a href="{{ route('dashboard.posts.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Create Post
          </a>
        </div>
      </div>

      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Category</th>
            <th>Tags</th>
            <th>Author</th>
            <th>Status</th>
            <th>Publish Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $post->title }}</td>
              <td>{{ $post->slug }}</td>
              <td>{{ $post->category->name ?? '-' }}</td>
              <td>
                @if($post->tags && $post->tags->count())
                  @foreach($post->tags as $tag)
                    <span class="badge bg-info text-dark">{{ $tag->name }}</span>
                  @endforeach
                @else
                  <span class="text-muted">-</span>
                @endif
              </td>
              <td>{{ $post->user->name }}</td>
              <td>
                @if ($post->status == 'published')
                  <span class="badge bg-success badge-status">Published</span>
                @else
                  <span class="badge bg-secondary badge-status">Draft</span>
                @endif
              </td>
              <td>{{ $post->publish_date ? \Carbon\Carbon::parse($post->publish_date)->format('d M Y') : '-' }}</td>
              <td>
                <a href="{{ route('dashboard.posts.edit',$post->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                <a href="{{ route('dashboard.posts.show',$post->id) }}" class="btn btn-sm btn-info"><i class="fas fa-eye"></i></a>
                <form action="{{ route('dashboard.posts.destroy',$post->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Delete this post?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Pagination -->
      {{ $posts->links() }}
    </div>
  </div>
@endsection
