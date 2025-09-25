@extends('dashboard.layouts.app')

@section('title', 'Edit Post')

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

    .thumbnail-preview {
      width: 120px;
      height: 80px;
      object-fit: cover;
      margin-bottom: 1rem;
      border-radius: 0.3rem;
      border: 2px solid #007bff;
    }
  </style>
@endpush

@section('content')
<!-- Main Content -->
    <div class="col-md-10 p-4">
      <!-- Top Navbar -->
      <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
        <h2>Edit Post</h2>
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
          <li class="breadcrumb-item active" aria-current="page">Edit Post</li>
        </ol>
      </nav>

      <!-- Edit Post Form -->
      <div class="form-card" data-aos="fade-up">
        <h2 class="mb-4">Edit Post</h2>
        <form action="{{ route('dashboard.posts.update',$post->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <!-- Thumbnail -->
          @if(isset($post) && $post->avatar)
            <div class="mb-3 text-center">
              <img id="thumbnailPreview" src="{{ asset('storage/'.$post->avatar) }}" alt="{{ $post->titleavatar }}" class="thumbnail-preview">
            </div>
          @endif
          <div class="mb-3">
            <label for="avatar" class="form-label">Thumbnail</label>
            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
          </div>

          <!-- Title -->
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title',$post->title ?? '') }}" required>
          </div>

          <!-- Category & Tags -->
          <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select class="form-select" id="category_id" name="category_id" required>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ old('category_id',$post->category_id ?? '')==$cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="tags" class="form-label">Tags</label>
            <select class="form-select" name="tags[]" id="tags" multiple>
              @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ (isset($post) && $post->tags->contains($tag->id)) || (collect(old('tags'))->contains($tag->id)) ? 'selected':'' }}>{{ $tag->name }}</option>
              @endforeach
            </select>
          </div>

          <!-- Status & Publish Date -->
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
              <option value="draft" {{ old('status',$post->status ?? '')=='draft' ? 'selected':'' }}>Draft</option>
              <option value="published" {{ old('status',$post->status ?? '')=='published' ? 'selected':'' }}>Published</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="publish_date" class="form-label">Publish Date</label>
            <input type="datetime-local" class="form-control" id="publish_date" name="publish_date" value="{{ old('publish_date', isset($post->publish_date) ? \Carbon\Carbon::parse($post->publish_date)->format('Y-m-d\TH:i') : '') }}" required>
          </div>

          <!-- Content -->
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" rows="8" required>{{ old('content',$post->content ?? '') }}</textarea>
          </div>

          <button type="submit" class="btn btn-primary w-100">Edit Post</button>
        </form>
      </div>

    </div>
@endsection

@push('js')
  <!-- CKEditor 4 -->
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
  <script>
    CKEDITOR.replace('content', {
      height: 400,
    });
  </script>
@endpush