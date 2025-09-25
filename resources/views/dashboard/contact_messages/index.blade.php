@extends('dashboard.layouts.app')

@section('title', 'Contacts')

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

    .badge-status {
      font-size: 0.8rem;
      padding: 0.35em 0.6em;
      border-radius: 0.5rem;
    }
  </style>
@endpush

@section('content')
<div class="col-md-10 p-4">
  <!-- Top Navbar -->
  <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
    <h2>Contacts</h2>
    <div>
      <i class="fas fa-bell me-3"></i>
      <i class="fas fa-user-circle fa-lg"></i>
    </div>
  </div>

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Contacts</li>
    </ol>
  </nav>

  <!-- Table Card -->
  <div class="table-card" data-aos="fade-up">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5>List of Contact Messages</h5>
      <input type="text" class="form-control w-25" placeholder="Search messages...">
    </div>

    <table class="table table-hover align-middle">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Subject</th>
          <th>Message</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($messages as $msg)
          <tr @if(!$msg->is_read) style="background:#f8f9fa;" @endif>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $msg->name }}</td>
            <td>{{ $msg->email }}</td>
            <td>{{ $msg->subject }}</td>
            <td>{{ Str::limit($msg->message, 50) }}</td>
            <td>{{ $msg->created_at->format('d M Y H:i') }}</td>
            <td>
              <a href="{{ route('dashboard.contact-messages.show', $msg->id) }}" class="btn btn-sm btn-info">
                <i class="fas fa-eye"></i>
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <!-- Pagination -->
    {{ $messages->links() }}
  </div>
</div>
@endsection