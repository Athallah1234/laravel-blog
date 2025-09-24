@extends('layouts.app')

@section('title', $post->title)

@push('css')
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f6f8;
    }
    .navbar {
      position: fixed; /* pastikan navbar fixed di atas */
      width: 100%;
      z-index: 1030;
      top: 0;
      transition: top 0.4s ease-in-out;
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

    /* Article Card/Content */
    .article-content img {
      max-width: 100%;
      border-radius: 1rem;
      margin-bottom: 1.5rem;
    }
    .article-content h2, h3, h4 {
      margin-top: 1.5rem;
      margin-bottom: 1rem;
      font-weight: 600;
      scroll-margin-top: 90px; /* biar otomatis berhenti di bawah navbar */
    }
    .article-content blockquote {
      border-left: 4px solid #007bff;
      padding-left: 1rem;
      color: #495057;
      font-style: italic;
      margin: 1.5rem 0;
    }
    .article-content pre {
      background: #e9ecef;
      padding: 1rem;
      border-radius: 1rem;
      overflow-x: auto;
    }
    .article-content code {
      background: #e9ecef;
      padding: 0.2rem 0.4rem;
      border-radius: 0.3rem;
    }

    /* TOC Sidebar */
    .sidebar {
      position: sticky;
      top: 100px; /* agar tidak menabrak navbar */
      max-height: calc(100vh - 120px);
      overflow-y: auto;
      padding-right: 10px;
    }
    .sidebar h5 {
      font-weight: 600;
      margin-bottom: 1rem;
    }
    .sidebar ul li a {
      color: #007bff;
      text-decoration: none;
      transition: 0.3s;
      font-size: 0.95rem;
      cursor: pointer;
    }
    .sidebar ul li a:hover {
      text-decoration: underline;
    }
    .sidebar ul li {
      margin-bottom: 0.5rem;
    }

    /* Scrollbar styling */
    .sidebar::-webkit-scrollbar {
      width: 6px;
    }
    .sidebar::-webkit-scrollbar-thumb {
      background: #007bff;
      border-radius: 10px;
    }
    .sidebar::-webkit-scrollbar-track {
      background: #f1f1f1;
    }

    /* Highlight active TOC link saat scroll */
    .sidebar ul li a.active {
      font-weight: 700;
      color: #0056b3;
      border-left: 3px solid #007bff;
      padding-left: 6px;
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

    /* Tags */
    .tag-cloud a {
      display: inline-block;
      background: #e9ecef;
      color: #495057;
      padding: 0.35rem 0.7rem;
      margin: 0.2rem;
      margin-bottom: 5px;
      border-radius: 1rem;
      text-decoration: none;
      font-size: 0.85rem;
      transition: 0.3s;
    }
    .tag-cloud a:hover {
      background: #007bff;
      color: #fff;
      transform: translateY(-2px);
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

    /* Responsive */
    @media (max-width: 991px) {
      .sidebar {
        position: static; /* agar sticky hilang di mobile */
        max-height: unset;
        overflow: visible;
        margin-top: 2rem;
      }
    }
  </style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="container mt-5 pt-5"><!-- tambah pt-5 agar konten tidak ketutup navbar -->
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
    </ol>
  </nav>
</div>

<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <!-- Article Content -->
    <div class="col-lg-8">
      <article class="article-content" data-aos="fade-up">
        <h1>{{ $post->title }}</h1>
        <p class="text-muted">By <strong>{{ $post->user->name ?? 'Admin' }}</strong> | {{ \Carbon\Carbon::parse($post->publish_date)->format('M d, Y') }} | <a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a></p>
        @if($post->avatar)
          <img src="{{ asset('storage/'.$post->avatar) }}" alt="{{ $post->title }}" width="5000px">
        @endif
        
        {!! $post->content !!}

        <!-- Tags -->
        <div class="mb-4">
          <h5>Tags</h5>
          <div class="tag-cloud">
            @foreach($post->tags as $tag)
              <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>
            @endforeach
          </div>
        </div>

        <!-- Social Share -->
        <div class="mb-5">
          <h5>Share this article</h5>
          <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-primary btn-sm me-2"><i class="fab fa-facebook"></i> Facebook</a>
          <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ $post->title }}" target="_blank" class="btn btn-primary btn-sm me-2"><i class="fab fa-twitter"></i> Twitter</a>
          <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->fullUrl()) }}" target="_blank" class="btn btn-primary btn-sm"><i class="fab fa-linkedin"></i> LinkedIn</a>
        </div>
      </article>
    </div>

    <!-- Sidebar TOC -->
    <div class="col-lg-4">
      <div class="sidebar ps-4 border-start">
        <h5>Table of Contents</h5>
        <ul class="list-unstyled">
          @foreach($toc as $item)
            <li class="ms-{{ $item['tag'] == 'h3' ? 3 : ($item['tag'] == 'h4' ? 4 : 0) }}">
              <a href="#{{ $item['id'] }}">{{ $item['text'] }}</a>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const sections = document.querySelectorAll(".article-content h2, .article-content h3, .article-content h4");
    const navLinks = document.querySelectorAll(".sidebar ul li a");

    // Highlight TOC aktif sesuai scroll
    window.addEventListener("scroll", () => {
      let current = "";
      sections.forEach(section => {
        const sectionTop = section.offsetTop - 130;
        if (pageYOffset >= sectionTop) {
          current = section.getAttribute("id");
        }
      });
      navLinks.forEach(link => {
        link.classList.remove("active");
        if (link.getAttribute("href") === "#" + current) {
          link.classList.add("active");
        }
      });
    });

    // Smooth scroll dengan offset navbar
    navLinks.forEach(link => {
      link.addEventListener("click", function (e) {
        e.preventDefault();
        const targetId = this.getAttribute("href").substring(1);
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
          const navbarHeight = document.querySelector(".navbar").offsetHeight;
          const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 10;
          window.scrollTo({
            top: targetPosition,
            behavior: "smooth"
          });
        }
      });
    });
  });
</script>
@endpush
