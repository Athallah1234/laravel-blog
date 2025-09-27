@extends('dashboard.layouts.app')

@section('title', 'Logs')

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

    .logs-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }

    .table-hover tbody tr:hover {
      background-color: rgba(0,123,255,0.1);
    }

    .log-error {
      background-color: rgba(255,0,0,0.1);
      font-weight: 600;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>System Logs</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Logs</li>
      </ol>
    </nav>

    <!-- Logs Card -->
    <div class="logs-card" data-aos="fade-up">
      <!-- Filter & Search -->
      <form action="{{ route('dashboard.logs') }}" method="GET" class="row mb-3 g-2">
        <div class="col-md-6">
          <input type="text" name="search" value="{{ request('search') }}" 
                class="form-control" placeholder="Search logs...">
        </div>
        <div class="col-md-4">
          <select name="filter" class="form-select">
            <option value="">Filter by Action</option>
            <option value="login" {{ request('filter') == 'login' ? 'selected' : '' }}>Login</option>
            <option value="logout" {{ request('filter') == 'logout' ? 'selected' : '' }}>Logout</option>
            <option value="create" {{ request('filter') == 'create' ? 'selected' : '' }}>Create</option>
            <option value="update" {{ request('filter') == 'update' ? 'selected' : '' }}>Update</option>
            <option value="delete" {{ request('filter') == 'delete' ? 'selected' : '' }}>Delete</option>
            <option value="error" {{ request('filter') == 'error' ? 'selected' : '' }}>Error</option>
          </select>
        </div>
        <div class="col-md-2">
          <button type="submit" class="btn btn-primary w-100">
            <i class="fas fa-search"></i> Search
          </button>
        </div>
      </form>

      <!-- Logs Table -->
      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>User</th>
              <th>Action</th>
              <th>IP Address</th>
              <th>Device / Browser</th>
              <th>Date & Time</th>
            </tr>
          </thead>
          <tbody>
            @foreach($logs as $log)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $log->user->name ?? '-' }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ $log->ip_address }}</td>
                <td>{{ $log->device_browser }}</td>
                <td>{{ $log->logged_at }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <!-- Pagination -->
      {{ $logs->links() }}
    </div>
  </div>
@endsection
