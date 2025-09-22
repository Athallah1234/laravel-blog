@extends('dashboard.layouts.app')

@section('title', 'Create Ebooks/Downloads')

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
      <h2>Create Ebook / Download</h2>
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
        <li class="breadcrumb-item active" aria-current="page">Create</li>
      </ol>
    </nav>

    <!-- Create Ebook Form -->
    <div class="form-card" data-aos="fade-up">
      <h2 class="mb-4">New Ebook / Download</h2>
      @if(session('success'))
        <p style="color:green;">{{ session('success') }}</p>
      @endif
      @if ($errors->any())
        <div style="color:red;">
          <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
      @endif
      <form action="{{ route('dashboard.ebooks.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" required>
        </div>
        <div class="mb-3">
          <label for="type" class="form-label">Type</label>
          <select class="form-select" id="type" name="type" required>
            <option value="ebook">Ebook</option>
            <option value="source code">Source Code</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="category_id" class="form-label">Category</label>
          <select name="category_id" id="category_id" class="form-control" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $cat)
              <option value="{{ $cat->id }}">
                {{ $cat->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="tags[]" class="form-label">Tags</label>
          <select name="tags[]" class="form-control" multiple>
            @foreach($tags as $tag)
              <option value="{{ $tag->id }}">
                {{ $tag->name }}
              </option>
            @endforeach
          </select>
        </div>
        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter description"></textarea>
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select class="form-select" id="status" name="status" required>
            <option value="draft">Draft</option>
            <option value="published">Published</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="datetime-local" class="form-label">Publish Date</label>
          <input type="date" class="form-control" id="publish_date" name="publish_date" required>
        </div>
        <div class="mb-3">
          <label for="file_upload" class="form-label">File Upload</label>
          <input type="file" class="form-control" id="file_upload" name="file_upload" required>
        </div>
        <div class="mb-3">
          <label for="thumbnail" class="form-label">Thumbnail Image</label>
          <input type="file" class="form-control" id="thumbnail" name="thumbnail">
        </div>
        <button type="submit" class="btn btn-primary w-100">Create Ebook/Download</button>
      </form>
    </div>
  </div>
@endsection
