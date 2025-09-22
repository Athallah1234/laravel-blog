@extends('dashboard.layouts.app')

@section('title', $user->name)

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

    .avatar-lg {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 3px solid #007bff;
      margin-bottom: 1rem;
    }

    .detail-label {
      font-weight: 600;
      color: #555;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>User Details</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('dashboard.users.index') }}">Users</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $user->name }}</li>
      </ol>
    </nav>

    <!-- User Detail Card -->
    <div class="detail-card text-center" data-aos="fade-up">
      <img src="https://i.pravatar.cc/120?img=1" alt="Avatar" class="avatar-lg">
      <h3 class="mb-3">{{ $user->name }}</h3>

      <div class="row text-start justify-content-center">
        <div class="col-md-6 mb-2">
          <span class="detail-label">Email:</span> {{ $user->email }}
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Role:</span> {{ ucfirst($user->role) }}
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Status:</span> <span class="badge bg-success">{{ ucfirst($user->status) }}</span>
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Created At:</span> {{ $user->created_at }}
        </div>
        <div class="col-md-6 mb-2">
          <span class="detail-label">Updated At:</span> {{ $user->updated_at }}
        </div>
      </div>

      <div class="mt-4">
        <a href="{{ route('dashboard.users.edit',$user->id) }}" class="btn btn-primary me-2"><i class="fas fa-edit me-1"></i> Edit User</a>
        <a href="{{ route('dashboard.users.index') }}" class="btn btn-primary me-2"> Back</a>
    </div>
  </div>
@endsection
