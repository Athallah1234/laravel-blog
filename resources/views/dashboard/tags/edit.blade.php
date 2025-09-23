@extends('dashboard.layouts.app')

@section('title', 'Edit Tag')

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

    .form-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 2rem;
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
      <h2>Edit Tag</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.tags.index') }}">Tags</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Tag</li>
      </ol>
    </nav>

    <!-- Edit Tag Form -->
    <div class="form-card" data-aos="fade-up">
      <h2 class="mb-4">Edit Tag</h2>
      @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
      @endif
      @if ($errors->any())
        <div style="color:red;">
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif
      <form action="{{ route('dashboard.tags.update',$tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="tagName" class="form-label">Tag Name</label>
          <input type="text" class="form-control" id="tagName" name="name" value="{{ old('name',$tag->name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Edit Tag</button>
      </form>
    </div>
  </div>
@endsection
