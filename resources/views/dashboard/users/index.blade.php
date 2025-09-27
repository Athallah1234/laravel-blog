@extends('dashboard.layouts.app')

@section('title', 'Users')

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

    .table-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }

    .avatar-sm {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
    }

    .badge-status {
      font-size: 0.8rem;
      padding: 0.35em 0.6em;
      border-radius: 0.5rem;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>Users</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Users</li>
      </ol>
    </nav>

    <!-- Table Card -->
    <div class="table-card" data-aos="fade-up">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5>List of Users</h5>

        @if(session('success'))
          <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="d-flex gap-2">
          <form action="{{ route('dashboard.users.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" 
                  class="form-control" placeholder="Search users...">
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-search"></i>
            </button>
          </form>

          <!-- Tombol Create User -->
          <a href="{{ route('dashboard.users.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-1"></i> Create User
          </a>
        </div>
      </div>

      <table class="table table-hover align-middle">
        <thead>
          <tr>
            <th>#</th>
            <th>Avatar</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                @if($user->avatar)
                  <img src="{{ asset('storage/'.$user->avatar) }}" width="50" alt="{{ $user->name }}">
                @endif
              </td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ ucfirst($user->role) }}</td>
              <td>
                @if ($user->status == 'active')
                  <span class="badge bg-success badge-status">Active</span>
                @else
                  <span class="badge bg-danger badge-status">Inactive</span>
                @endif
              </td>
              <td>
                <a href="{{ route('dashboard.users.edit',$user->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                <a href="{{ route('dashboard.users.show',$user->id) }}" class="btn btn-sm btn-warning"><i class="fas fa-key"></i></a>
                <form action="{{ route('dashboard.users.destroy',$user->id) }}" method="POST" style="display:inline;">
                  @csrf
                  @method('DELETE')
                  <button type="submit" onclick="return confirm('Delete this user?')" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Pagination -->
      {{ $users->links() }}
    </div>
  </div>
@endsection
