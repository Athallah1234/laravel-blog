@extends('layouts.app')

@section('title', 'Edit Profile')

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
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0,0,0,0.1);
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

    .form-label {
      font-weight: 500;
      color: #495057;
    }
  </style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('profile') }}">Profile</a></li>
      <li class="breadcrumb-item active" aria-current="page">Edit Profile</li>
    </ol>
  </nav>
</div>

<!-- Page Header -->
<div class="container mb-4">
  <h1 class="mb-2">Edit Profile</h1>
</div>

<!-- Profile Edit Form -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8" data-aos="fade-up">
      <div class="card shadow-sm p-4">
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <!-- Avatar -->
          <div class="mb-3 text-center">
            <img src="{{ asset('storage/'.$user->avatar ?? 'default-avatar.png') }}" 
                 alt="{{ $user->name }}" class="rounded-circle" width="120" height="120">
            <div class="mt-2">
              <label for="avatar" class="form-label">Change Avatar</label>
              <input type="file" class="form-control" id="avatar" name="avatar">
            </div>
          </div>

          <!-- Name -->
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" 
                   value="{{ old('name', $user->name) }}" required>
          </div>

          <!-- Email -->
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" 
                   value="{{ old('email', $user->email) }}" required>
          </div>

          <!-- Bio -->
          <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea class="form-control" id="bio" name="bio" rows="4">{{ old('bio', $user->bio) }}</textarea>
          </div>

          <!-- Social Media -->
          <h6 class="mt-4 mb-2">Social Media Links</h6>

          <div class="mb-3">
            <label for="twitter" class="form-label">Twitter</label>
            <input type="url" class="form-control" id="twitter" name="twitter" 
                   value="{{ old('twitter', $user->twitter) }}" placeholder="https://twitter.com/username">
          </div>

          <div class="mb-3">
            <label for="instagram" class="form-label">Instagram</label>
            <input type="url" class="form-control" id="instagram" name="instagram" 
                   value="{{ old('instagram', $user->instagram) }}" placeholder="https://instagram.com/username">
          </div>

          <div class="mb-3">
            <label for="github" class="form-label">GitHub</label>
            <input type="url" class="form-control" id="github" name="github" 
                   value="{{ old('github', $user->github) }}" placeholder="https://github.com/username">
          </div>

          <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn</label>
            <input type="url" class="form-control" id="linkedin" name="linkedin" 
                   value="{{ old('linkedin', $user->linkedin) }}" placeholder="https://linkedin.com/in/username">
          </div>

          <!-- Submit -->
          <div class="text-end">
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endsection
