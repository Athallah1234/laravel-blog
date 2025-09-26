@extends('layouts.app')

@section('title', $category->name)

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

    /* Breadcrumb */
    .breadcrumb-item + .breadcrumb-item::before {
      content: ">";
    }

    /* Card Modern */
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

    /* Buttons Gradient */
    .btn-primary {
      background: linear-gradient(135deg,#007bff,#00c6ff);
      border: none;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg,#00c6ff,#007bff);
    }

    /* Tags */
    .tag-cloud a {
      display: inline-block;
      background: #e9ecef;
      color: #495057;
      padding: 0.35rem 0.7rem;
      margin: 0.2rem;
      border-radius: 1rem;
      text-decoration: none;
      font-size: 0.85rem;
      transition: 0.3s;
    }
    .tag-cloud a:hover {
      background: #007bff;
      color: #fff;
      transform: translateY(-2px);
    }

    /* Footer */
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
  </style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
    </ol>
  </nav>
</div>

<!-- Category Header -->
<div class="container mb-4">
  <h1 class="mb-2">{{ $category->name }}</h1>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <!-- Posts List -->
    <div class="col-lg-16">
      <div class="row g-4">
        <!-- Post Card Example -->
        @forelse($posts as $post)
          <div class="col-md-6" data-aos="fade-up">
            <div class="card shadow-sm">
              <img src="{{ asset('storage/'.$post->avatar) }}" class="card-img-top" alt="{{ $post->title }}">
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text text-muted">{{ \Carbon\Carbon::parse($post->publish_date)->format('M d, Y') }}</p>
                <p class="card-text">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                <a href="{{ route('post.show', $post->slug) }}" class="btn btn-primary btn-sm">Read More</a>
              </div>
            </div>
          </div>
        @empty
          <p>No posts found in this category.</p>
        @endforelse
      </div>

      <!-- Pagination -->
      {{ $posts->links() }}
    </div>
  </div>
</div>
@endsection