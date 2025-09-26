@extends('layouts.app')

@section('title', 'Profile')

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

    /* Avatar */
    .profile-avatar {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #fff;
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
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

    /* Social Links */
    .follow-me {
      margin-top: 1.5rem;
    }
    .follow-me a {
      display: inline-block;
      margin: 0 8px;
      font-size: 1.2rem;
      color: #495057;
      transition: 0.3s;
    }
    .follow-me a:hover {
      color: #007bff;
      transform: translateY(-2px);
    }
  </style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Profile</li>
    </ol>
  </nav>
</div>

<!-- Profile Header -->
<div class="container mb-4">
  <h1 class="mb-2">Profile</h1>
</div>

<!-- Profile Card -->
<div class="container my-5">
  <div class="row justify-content-center">
    <div class="col-lg-8" data-aos="fade-up">
      <div class="card shadow-sm text-center p-4">
        <!-- Avatar -->
        <img src="{{ asset('storage/'.$user->avatar ?? 'default-avatar.png') }}" 
             alt="{{ $user->name }}" class="profile-avatar mx-auto">

        <div class="card-body mt-3">
          <h3 class="card-title">{{ $user->name }}</h3>
          <p class="text-muted">{{ $user->email }}</p>
          <p class="card-text">
            {{ $user->bio ?? 'Belum ada bio.' }}
          </p>

          <!-- Action Buttons -->
          <a href="{{ route('profile.edit') }}" class="btn btn-primary btn-sm me-2">Edit Profile</a>
          <a href="{{ route('logout') }}" 
             onclick="event.preventDefault();document.getElementById('logout-form').submit();" 
             class="btn btn-outline-secondary btn-sm">Logout</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>

          <!-- Follow Me -->
          <div class="follow-me">
            <h6 class="mt-4 mb-2">Follow Me</h6>
            @if($user->twitter)
              <a href="{{ $user->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
            @endif
            @if($user->instagram)
              <a href="{{ $user->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
            @endif
            @if($user->github)
              <a href="{{ $user->github }}" target="_blank"><i class="fab fa-github"></i></a>
            @endif
            @if($user->linkedin)
              <a href="{{ $user->linkedin }}" target="_blank"><i class="fab fa-linkedin"></i></a>
            @endif
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
