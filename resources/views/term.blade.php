@extends('layouts.app')

@section('title', 'Terms & Conditions')

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

    h2, h3 {
      color: #007bff;
      margin-top: 1.5rem;
    }
    p {
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
      <li class="breadcrumb-item active" aria-current="page">Terms & Conditions</li>
    </ol>
  </nav>
</div>

<!-- Terms Header -->
<div class="container mb-4">
  <h1 class="mb-2">Terms & Conditions</h1>
  <p class="text-muted">Halaman ini menjelaskan ketentuan penggunaan ModernBlog, hak dan kewajiban pengguna, serta batasan tanggung jawab.</p>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <div class="col-lg-16">
      <div class="glass-card" data-aos="fade-up">
        <h2>1. Acceptance of Terms</h2>
        <p>Dengan mengakses ModernBlog, Anda menyetujui untuk mematuhi semua ketentuan dan syarat yang tercantum di halaman ini.</p>

        <h2>2. Use of the Website</h2>
        <p>Pengguna diperbolehkan mengakses konten untuk keperluan pribadi dan non-komersial. Dilarang menggunakan konten untuk tujuan ilegal atau merugikan pihak lain.</p>

        <h2>3. User Responsibilities</h2>
        <p>Pengguna bertanggung jawab untuk menjaga keamanan akun mereka, tidak menyebarkan spam, malware, atau konten ilegal.</p>

        <h2>4. Intellectual Property</h2>
        <p>Seluruh konten ModernBlog, termasuk teks, gambar, dan desain, merupakan hak cipta milik ModernBlog. Reproduksi tanpa izin dilarang.</p>

        <h2>5. Limitation of Liability</h2>
        <p>ModernBlog tidak bertanggung jawab atas kerugian langsung maupun tidak langsung akibat penggunaan website ini. Informasi diberikan "as is".</p>

        <h2>6. Third-Party Links</h2>
        <p>Website ini dapat mengandung tautan ke situs pihak ketiga. ModernBlog tidak bertanggung jawab atas konten atau kebijakan privasi situs tersebut.</p>

        <h2>7. Termination</h2>
        <p>ModernBlog berhak menghentikan akses pengguna yang melanggar ketentuan ini tanpa pemberitahuan sebelumnya.</p>

        <h2>8. Governing Law</h2>
        <p>Ketentuan ini tunduk pada hukum yang berlaku di Indonesia.</p>

        <h2>Contact Us</h2>
        <p>Jika ada pertanyaan terkait Terms & Conditions ini, silakan hubungi kami melalui <a href="mailto:contact@modernblog.com">contact@modernblog.com</a>.</p>
      </div>
    </div>
  </div>
</div>
@endsection