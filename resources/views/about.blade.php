@extends('layouts.app')

@section('title', 'About')

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

    /* Profile Card */
    .profile-card {
      background: rgba(255,255,255,0.9);
      backdrop-filter: blur(12px);
      border-radius: 1.5rem;
      padding: 2rem;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
      text-align: center;
      margin-top: -4rem;
    }
    .profile-card img {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
      border: 5px solid #fff;
      margin-bottom: 1rem;
    }
    .profile-card h3 {
      font-weight: 600;
    }
    .profile-card p {
      color: #6c757d;
    }

    /* Skills Logo */
    .skills-logos {
      display: flex;
      flex-wrap: wrap;
      gap: 2rem;
      align-items: center;
      justify-content: center;
      margin-top: 2rem;
    }
    .skills-logos .skill-item {
      text-align: center;
      width: 100px;
    }
    .skills-logos img {
      width: 64px;
      height: 64px;
      object-fit: contain;
      margin-bottom: .5rem;
      transition: transform 0.3s;
    }
    .skills-logos img:hover {
      transform: scale(1.1);
    }
    .skills-logos p {
      margin: 0;
      font-size: 0.9rem;
      font-weight: 500;
      color: #495057;
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
  </style>
@endpush

@section('content')
<!-- Breadcrumb -->
<div class="container mt-4">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item active" aria-current="page">About</li>
    </ol>
  </nav>
</div>

<!-- About Header -->
<div class="container mb-4">
  <h1 class="mb-2">About Me</h1>
  <p class="text-muted">Kenali lebih dekat penulis blog ModernBlog, visi & misi, serta perjalanan kami berbagi konten berkualitas.</p>
</div>

<div class="container">
  <div class="profile-card shadow-sm my-4">
    <img src="https://source.unsplash.com/300x300/?portrait" alt="Profile Picture">
    <h3>John Doe</h3>
    <p>Blogger | Web Developer | Tech Enthusiast</p>
    <p class="mt-3">Hi, I'm John Doe. I love building modern websites, writing tutorials, and sharing knowledge about web development, design trends, and technology insights.</p>
  </div>

  <!-- Projects -->
  <div class="my-5">
    <h4 class="mb-4">Projects</h4>
    <div class="row">
      @forelse($repos as $repo)
        <div class="col-md-4 mb-4">
          <div class="card shadow-sm h-100">
            <div class="card-body d-flex flex-column">
              <h5 class="card-title">
                <a href="{{ $repo['html_url'] }}" target="_blank" class="text-decoration-none">
                  {{ $repo['name'] }}
                </a>
              </h5>
              <p class="card-text text-muted small flex-grow-1">
                {{ $repo['description'] ?? 'No description available.' }}
              </p>
              <div class="d-flex justify-content-between align-items-center">
                <span class="badge bg-primary">
                  ⭐ {{ $repo['stargazers_count'] }}
                </span>
                <span class="badge bg-secondary">
                  {{ $repo['language'] ?? 'N/A' }}
                </span>
              </div>
            </div>
          </div>
        </div>
      @empty
        <p class="text-muted">Belum ada project yang ditampilkan.</p>
      @endforelse
    </div>
  </div>

  <!-- Skills -->
  <div class="my-5">
    <h4 class="mb-4">Skills</h4>
    <div class="skills-logos">
      <div class="skill-item">
        <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg" alt="HTML5">
        <p>HTML5</p>
      </div>
      <div class="skill-item">
        <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg" alt="CSS3">
        <p>CSS3</p>
      </div>
      <div class="skill-item">
        <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/javascript/javascript-original.svg" alt="JavaScript">
        <p>JavaScript</p>
      </div>
      <div class="skill-item">
        <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-plain.svg" alt="Bootstrap">
        <p>Bootstrap</p>
      </div>
      <div class="skill-item">
        <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/laravel-line.svg" alt="Laravel">
        <p>Laravel</p>
      </div>
      <div class="skill-item">
        <img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/python/python-original.svg" alt="Python">
        <p>Python</p>
      </div>
    </div>
  </div>
</div>
@endsection
