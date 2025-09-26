@extends('layouts.app')

@section('title', $monthName . ' ' . $year)

@push('css')
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
    }
    .navbar-brand {
      font-weight: 700;
      letter-spacing: 1px;
      font-size: 1.6rem;
    }
    .breadcrumb-item + .breadcrumb-item::before {
      content: ">";
    }
    .card {
      border: none;
      border-radius: 1.5rem;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    .btn-primary {
      background: linear-gradient(135deg,#007bff,#00c6ff);
      border: none;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg,#00c6ff,#007bff);
    }
    footer {
      background: #f8f9fa;
      color: #495057;
      padding: 4rem 0 2rem;
    }
    footer a {
      color: #6c757d;
      text-decoration: none;
      transition: 0.3s;
    }
    footer a:hover {
      color: #007bff;
    }
    .archive-month {
      background: rgba(255,255,255,0.8);
      backdrop-filter: blur(8px);
      padding: 0.5rem 1rem;
      border-radius: 1rem;
      margin-bottom: 1rem;
      font-weight: 600;
      color: #007bff;
    }
  </style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('archives.index') }}">Archive</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $monthName }} {{ $year }}</li>
    </ol>
  </nav>
</div>

<!-- Archive Header -->
<div class="container mb-4">
  <h1 class="mb-2">Archive: {{ $monthName }} {{ $year }}</h1>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <!-- Archive Detail List -->
    <div class="col-lg-8">

      <div class="archive-month">September 2025</div>
      <div class="row g-4">
        <!-- Post 1 -->
        @forelse($posts as $post)
          <div class="col-md-6" data-aos="fade-up">
            <div class="card shadow-sm">
              <img src="{{ asset('storage/'.$post->avatar) }}" class="card-img-top" alt="Post Image">
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text text-muted">{{ \Carbon\Carbon::parse($post->publish_date)->format('M d, Y') }}</p>
                <a href="{{ route('post.show', $post->slug) }}" class="btn btn-primary btn-sm">Read More</a>
              </div>
            </div>
          </div>
        @empty
          <p>No posts found for this archive.</p>
        @endforelse
      </div>

      <!-- Pagination -->
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection