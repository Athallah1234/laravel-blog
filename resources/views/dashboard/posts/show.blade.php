@extends('dashboard.layouts.app')

@section('title', $post->title)

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

    .detail-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }

    .thumbnail-lg {
      width: 100%;
      max-height: 300px;
      object-fit: cover;
      border-radius: 0.5rem;
      margin-bottom: 1rem;
    }

    .detail-label {
      font-weight: 600;
      color: #555;
    }

    .badge-tag {
      margin-right: 0.3rem;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>Post Details</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.posts.index') }}">Posts</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
      </ol>
    </nav>

    <!-- Post Detail Card -->
    <div class="detail-card" data-aos="fade-up">
      <img src="{{ asset('storage/'.$post->avatar) }}" alt="{{ $post->slug }}" class="thumbnail-lg">
      <h3 class="mb-3">{{ $post->title }}</h3>

      <div class="row text-start mb-3">
        <div class="col-md-6 mb-2">
          <span class="detail-label">Slug:</span> {{ $post->slug }}
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Category:</span> {{ $post->category->name ?? '-' }}
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Author:</span> {{ $post->user->name ?? '-' }}
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Status:</span>
          @if ($post->status === 'published')
            <span class="badge bg-success">Published</span>
          @else
            <span class="badge bg-danger">Draft</span>
          @endif
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Publish Date:</span> {{ $post->publish_date }}
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Views:</span> {{ $post->views }}
        </div>
        <div class="col-md-12 mb-2">
          <span class="detail-label">Tags:</span>
          @foreach($post->tags as $tag)
            <span class="badge bg-info badge-tag">{{ $tag->name }}</span>
          @endforeach
        </div>
      </div>

      <hr>
      <div class="mb-3">
        <h5>Content:</h5>
        {{ $post->content }}
      </div>

      <div class="mt-4">
        <a href="{{ route('dashboard.posts.edit',$post->id) }}" class="btn btn-primary me-2"><i class="fas fa-edit me-1"></i> Edit Post</a>
        <a href="{{ route('dashboard.posts.index') }}" class="btn btn-primary me-2"> Back</a>
      </div>
    </div>
  </div>
@endsection
