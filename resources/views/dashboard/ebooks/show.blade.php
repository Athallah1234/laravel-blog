@extends('dashboard.layouts.app')

@section('title', $ebook->title)

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

    .detail-label {
      font-weight: 600;
      color: #555;
    }

    .thumbnail-img {
      max-width: 200px;
      border-radius: 0.5rem;
      margin-bottom: 1rem;
    }
  </style>
@endpush

@section('content')
<!-- Main Content -->
    <div class="col-md-10 p-4">
      <!-- Top Navbar -->
      <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
        <h2>Ebook / Download Details</h2>
        <div>
          <i class="fas fa-bell me-3"></i>
          <i class="fas fa-user-circle fa-lg"></i>
        </div>
      </div>

      <!-- Breadcrumb -->
      <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item"><a href="{{ route('dashboard.ebooks.index') }}">Ebooks / Downloads</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $ebook->title }}</li>
        </ol>
      </nav>

      <!-- Ebook Detail Card -->
      <div class="detail-card" data-aos="fade-up">
        <h3 class="mb-3">{{ $ebook->title }}</h3>

        <img src="{{ asset('storage/'.$ebook->thumbnail) }}" alt="{{ $ebook->title }}" class="thumbnail-img">

        <div class="row text-start mb-3">
          <div class="col-md-6 mb-2"><span class="detail-label">Slug:</span> {{ $ebook->slug }}</div>
          <div class="col-md-6 mb-2"><span class="detail-label">Type:</span> {{ ucfirst($ebook->type) }}</div>
          <div class="col-md-6 mb-2"><span class="detail-label">Status:</span> {{ ucfirst($ebook->status) }}</div>
          <div class="col-md-6 mb-2"><span class="detail-label">Publish Date:</span> {{ $ebook->publish_date }}</div>
          <div class="col-md-6 mb-2"><span class="detail-label">Views:</span> {{ $ebook->views }}</div>
          <div class="col-md-6 mb-2"><span class="detail-label">File:</span> <a href="{{ asset('storage/'.$ebook->file_upload) }}" target="_blank">Download PDF</a></div>
          <div class="col-12 mb-2"><span class="detail-label">Description:</span> {!! ($ebook->description) !!}</div>
        </div>

        <div class="mt-4">
          <a href="{{ route('dashboard.ebooks.edit',$ebook->id) }}" class="btn btn-primary me-2"><i class="fas fa-edit me-1"></i> Edit Ebook</a>
          <a href="{{ route('dashboard.ebooks.index') }}" class="btn btn-primary me-2"> Back</a>
        </div>
      </div>

    </div>
@endsection
