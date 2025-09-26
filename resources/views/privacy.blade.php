@extends('layouts.app')

@section('title', 'Privacy Policy')

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
      <li class="breadcrumb-item active" aria-current="page">Privacy Policy</li>
    </ol>
  </nav>
</div>

<!-- Privacy Header -->
<div class="container mb-4">
  <h1 class="mb-2">Privacy Policy</h1>
  <p class="text-muted">Kami menghargai privasi Anda. Halaman ini menjelaskan bagaimana ModernBlog mengumpulkan, menggunakan, dan melindungi informasi Anda.</p>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <div class="col-lg-16">
      <div class="glass-card" data-aos="fade-up">
        <h2>1. Information We Collect</h2>
        <p>Kami dapat mengumpulkan informasi berikut saat Anda mengunjungi blog ini: nama, alamat email, komentar, dan data penggunaan anonim seperti halaman yang dikunjungi.</p>

        <h2>2. How We Use Your Information</h2>
        <p>Informasi yang dikumpulkan digunakan untuk meningkatkan pengalaman pengguna, merespons pertanyaan, dan mengirimkan newsletter bila Anda berlangganan.</p>

        <h2>3. Cookies</h2>
        <p>Blog ini menggunakan cookies untuk menganalisis trafik dan meningkatkan fungsionalitas. Anda dapat menonaktifkan cookies melalui pengaturan browser.</p>

        <h2>4. Data Sharing</h2>
        <p>Kami tidak menjual atau membagikan data pribadi Anda kepada pihak ketiga, kecuali jika diwajibkan oleh hukum.</p>

        <h2>5. Third-Party Services</h2>
        <p>Kami menggunakan layanan pihak ketiga seperti Google Analytics untuk memahami perilaku pengunjung. Layanan ini memiliki kebijakan privasi masing-masing.</p>

        <h2>6. Security</h2>
        <p>Kami mengambil langkah-langkah teknis untuk melindungi data Anda, termasuk enkripsi dan pemantauan keamanan secara rutin.</p>

        <h2>7. Your Rights</h2>
        <p>Anda dapat meminta salinan data pribadi Anda atau meminta penghapusan data kapan saja melalui kontak kami.</p>

        <h2>8. Changes to This Policy</h2>
        <p>Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan akan diumumkan di halaman ini.</p>

        <h2>Contact Us</h2>
        <p>Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami melalui <a href="mailto:contact@modernblog.com">contact@modernblog.com</a>.</p>
      </div>
    </div>
  </div>
</div>
@endsection