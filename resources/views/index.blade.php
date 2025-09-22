@extends('layouts.app')

@section('title', 'Home')

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

    /* Card Modern */
    .card {
      border: none;
      border-radius: 1.5rem;
      overflow: hidden;
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }
    .card-title {
      font-weight: 600;
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

    /* Sidebar Glass Effect */
    .sidebar {
      background: rgba(255, 255, 255, 0.75);
      backdrop-filter: blur(12px);
      border-radius: 1.5rem;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }

    /* Tags */
    .tag-cloud a {
      display: inline-block;
      background: #e9ecef;
      color: #495057;
      padding: 0.35rem 0.7rem;
      margin: 0.2rem;
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

    /* Animations */
    [data-aos] {
      opacity: 0;
      transition-property: opacity, transform;
    }
    [data-aos].aos-animate {
      opacity: 1;
    }

  </style>
@endpush

@section('content')
<!-- Main Content -->
<div class="container my-5">
  <div class="row g-4">
    <!-- Blog Posts -->
    <div class="col-lg-8">
      <div class="row g-4">
        @forelse($posts as $post)
          <!-- Post Card -->
          <div class="col-md-6" data-aos="fade-up">
            <div class="card shadow-sm">
              <img src="{{ asset('storage/'.$post->avatar) }}" class="card-img-top" alt="{{ $post->title }}">
              <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text text-muted">{{ \Carbon\Carbon::parse($post->publish_date)->format('M d, Y') }}</p>
                <p class="card-text">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                <a href="#" class="btn btn-primary btn-sm">Read More</a>
              </div>
            </div>
          </div>
        @empty
          <p class="text-muted">No published posts available.</p>
        @endforelse
      </div>

      <!-- Pagination -->
      <nav aria-label="Page navigation example" class="mt-4">
        <ul class="pagination justify-content-center">
          <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
          <li class="page-item active"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
      </nav>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4">
      <div class="sidebar" data-aos="fade-left">
        <!-- Search -->
        <div class="mb-4">
          <input type="text" class="form-control" placeholder="Search...">
        </div>

        <!-- Categories -->
        <div class="mb-4">
          <h5>Categories</h5>
          <ul class="list-unstyled">
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Programming</a></li>
            <li><a href="#">Tech News</a></li>
            <li><a href="#">Tutorials</a></li>
          </ul>
        </div>

        <!-- Tags -->
        <div class="mb-4">
          <h5>Tags</h5>
          <div class="tag-cloud">
            <a href="#">Bootstrap</a>
            <a href="#">JavaScript</a>
            <a href="#">HTML</a>
            <a href="#">CSS</a>
            <a href="#">WebDev</a>
            <a href="#">Tech</a>
          </div>
        </div>

        <!-- Recent Posts -->
        <div class="mb-4">
          <h5>Recent Posts</h5>
          <ul class="list-unstyled">
            <li><a href="#">Understanding Flexbox in CSS</a></li>
            <li><a href="#">Top 10 VS Code Extensions</a></li>
            <li><a href="#">How to Optimize Images for Web</a></li>
          </ul>
        </div>

        <!-- Newsletter -->
        <div class="mb-4 p-3 rounded-3" style="background: rgba(255,255,255,0.7);backdrop-filter: blur(8px);">
          <h5>Subscribe</h5>
          <p>Get the latest updates directly in your inbox.</p>
          <form>
            <div class="mb-2">
              <input type="email" class="form-control form-control-sm" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100">Subscribe</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
