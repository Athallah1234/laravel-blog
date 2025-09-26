@extends('layouts.app')

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
      <li class="breadcrumb-item active" aria-current="page">Disclaimer</li>
    </ol>
  </nav>
</div>

<!-- Disclaimer Header -->
<div class="container mb-4">
  <h1 class="mb-2">Disclaimer</h1>
  <p class="text-muted">Halaman ini menjelaskan penafian dan batasan tanggung jawab atas konten dan informasi yang disediakan oleh ModernBlog.</p>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <div class="col-lg-8">
      <div class="glass-card" data-aos="fade-up">
        <h2>1. General Information</h2>
        <p>Semua informasi yang disediakan di ModernBlog hanya untuk tujuan edukasi dan informasi umum. Kami tidak menjamin keakuratan atau kelengkapan konten.</p>

        <h2>2. No Professional Advice</h2>
        <p>Konten di blog ini tidak menggantikan saran profesional, medis, hukum, atau keuangan. Gunakan informasi dengan pertimbangan pribadi.</p>

        <h2>3. External Links</h2>
        <p>ModernBlog dapat berisi tautan ke situs pihak ketiga. Kami tidak bertanggung jawab atas konten, privasi, atau praktik situs tersebut.</p>

        <h2>4. Limitation of Liability</h2>
        <p>ModernBlog tidak bertanggung jawab atas kerugian atau kerusakan yang timbul dari penggunaan informasi yang disediakan. Penggunaan dilakukan sepenuhnya atas risiko pengguna.</p>

        <h2>5. Endorsement</h2>
        <p>Penyebutan produk, layanan, atau perusahaan tidak merupakan dukungan resmi, kecuali dinyatakan secara eksplisit.</p>

        <h2>6. Changes to Disclaimer</h2>
        <p>Kami dapat memperbarui penafian ini kapan saja. Perubahan akan diterapkan secara otomatis di halaman ini.</p>

        <h2>Contact Us</h2>
        <p>Jika Anda memiliki pertanyaan terkait Disclaimer ini, silakan hubungi kami melalui <a href="mailto:contact@modernblog.com">contact@modernblog.com</a>.</p>
      </div>
    </div>
  </div>
</div>
@endsection