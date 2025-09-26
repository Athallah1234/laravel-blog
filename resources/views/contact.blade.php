@extends('layouts.app')

@section('title', 'Contact')

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

    /* Glass Card */
    .glass-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      border-radius: 1.5rem;
      padding: 2rem;
      margin-bottom: 2rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .glass-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
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

    /* Footer */
    footer {
      background: #f8f9fa;
      color: #495057;
      padding: 4rem 0 2rem;
    }
    footer a {
      color: #6c757d;
      text-decoration: none;
      transition: 0.3s;
    }
    footer a:hover {
      color: #007bff;
    }

    /* Contact Info */
    .contact-info i {
      font-size: 1.2rem;
      color: #007bff;
      margin-right: 0.5rem;
    }

    /* Form Inputs */
    .form-control:focus {
      box-shadow: none;
      border-color: #007bff;
    }
  </style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">Contact</li>
    </ol>
  </nav>
</div>

<!-- Contact Header -->
<div class="container mb-4">
  <h1 class="mb-2">Contact Us</h1>
  <p class="text-muted">Kami senang mendengar dari Anda! Silakan isi form di bawah ini atau hubungi kami melalui informasi kontak.</p>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <div class="col-lg-16">
      <!-- Contact Form -->
      <div class="glass-card" data-aos="fade-up">
        <h3 class="mb-4">Send a Message</h3>
        @if(session('success'))
          <p style="color:green;">{{ session('success') }}</p>
        @endif
        @if ($errors->any())
          <div style="color:red;">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
          </div>
        @endif
        <form action="{{ route('contact.send') }}" method="POST">
          @csrf
          <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
          </div>
          <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input type="text" class="form-control" id="subject" name="subject" placeholder="Subject">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="6" placeholder="Your Message"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
      </div>

      <!-- Contact Info -->
      <div class="glass-card mt-4" data-aos="fade-up" data-aos-delay="100">
        <h3 class="mb-4">Contact Info</h3>
        <p class="contact-info"><i class="fas fa-map-marker-alt"></i>Jl. Contoh Alamat No.123, Jakarta, Indonesia</p>
        <p class="contact-info"><i class="fas fa-envelope"></i>contact@modernblog.com</p>
        <p class="contact-info"><i class="fas fa-phone"></i>+62 812 3456 7890</p>
        <p class="contact-info">
          <i class="fab fa-facebook"></i>
          <i class="fab fa-twitter"></i>
          <i class="fab fa-instagram"></i>
          <i class="fab fa-linkedin"></i>
        </p>
      </div>
    </div>
  </div>
</div>
@endsection