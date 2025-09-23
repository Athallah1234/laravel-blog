@extends('layouts.app')

@section('title', 'All Tags')

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

    /* Tag Cloud */
    .tag-cloud a {
      display: inline-block;
      background: rgba(255,255,255,0.85);
      color: #495057;
      padding: 0.45rem 0.9rem;
      margin: 0.3rem;
      border-radius: 1rem;
      text-decoration: none;
      font-size: 0.9rem;
      transition: 0.3s;
      backdrop-filter: blur(10px);
    }
    .tag-cloud a:hover {
      background: #007bff;
      color: #fff;
      transform: translateY(-2px);
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
      <li class="breadcrumb-item active" aria-current="page">Tags</li>
    </ol>
  </nav>
</div>

<!-- Tag Header -->
<div class="container mb-4">
  <h1 class="mb-2">All Tags</h1>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <!-- Articles Section -->
    <div class="col-lg-16">
      <!-- Tag Cloud -->
      <div class="mb-4" data-aos="fade-up">
        <div class="tag-cloud">
          @foreach($tags as $tag)
            <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }} ({{ $tag->posts_count }} Articles)</a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection