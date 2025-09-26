@extends('layouts.app')

@section('title', 'Archives')

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
    .archive-card {
      border: none;
      border-radius: 1rem;
      padding: 1.5rem;
      margin-bottom: 1rem;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .archive-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    .archive-card a {
      font-weight: 600;
      text-decoration: none;
      color: #007bff;
    }
    .archive-card a:hover {
      text-decoration: underline;
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
      <li class="breadcrumb-item active" aria-current="page">Archives List</li>
    </ol>
  </nav>
</div>

<!-- Page Header -->
<div class="container mb-4">
  <h1 class="mb-2">Archives</h1>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <!-- Archive List -->
    <div class="col-lg-16">
      @foreach($archives as $archive)
        <div class="archive-card" data-aos="fade-up">
          <h5><a href="{{ route('archive.show', [$archive->year, $archive->month]) }}">{{ \Carbon\Carbon::create()->month($archive->month)->format('F') }} {{ $archive->year }}</a></h5>
          <p class="text-muted">{{ $archive->post_count }} Articles</p>
        </div>
      @endforeach
    </div>
  </div>
</div>
@endsection