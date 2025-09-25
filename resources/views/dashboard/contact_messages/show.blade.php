@extends('dashboard.layouts.app')

@section('title', 'Pesan Dari ' . $message->name )

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

    .card-detail {
      background: rgba(255,255,255,0.9);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
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
    <h2>Contact Detail</h2>
    <div>
      <i class="fas fa-bell me-3"></i>
      <i class="fas fa-user-circle fa-lg"></i>
    </div>
  </div>

  <!-- Breadcrumb -->
  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="#">Contacts</a></li>
      <li class="breadcrumb-item active" aria-current="page">Show</li>
    </ol>
  </nav>

  <!-- Detail Card -->
  <div class="card-detail" data-aos="fade-up">
    <h4 class="mb-3">Message from {{ $message->name }}</h4>
        
    <div class="mb-2"><strong>Name:</strong> {{ $message->name }}</div>
    <div class="mb-2"><strong>Email:</strong> {{ $message->email }}</div>
    <div class="mb-2"><strong>Subject:</strong> {{ $message->subject }}</div>
    <div class="mb-2"><strong>Date:</strong> {{ $message->created_at->format('d M Y H:i') }}</div>
        
    <hr>
    <h6>Message:</h6>
    <p>
      {{ $message->message }}
    </p>

    <div class="mt-4">
      <a href="{{ route('dashboard.contact-messages.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Kembali
      </a>
    </div>
  </div>
</div>
@endsection