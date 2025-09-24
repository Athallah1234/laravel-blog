@extends('layouts.app')

@section('title', 'Profile')

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

    /* Buttons Gradient */
    .btn-primary {
      background: linear-gradient(135deg,#007bff,#00c6ff);
      border: none;
      transition: 0.3s;
    }
    .btn-primary:hover {
      background: linear-gradient(135deg,#00c6ff,#007bff);
    }

    /* Hero Section */
    .hero {
      background: url('https://source.unsplash.com/1600x600/?technology,abstract') no-repeat center center/cover;
      color: #fff;
      padding: 6rem 0;
      text-align: center;
      border-radius: 0 0 2rem 2rem;
    }
    .hero h1 {
      font-weight: 700;
      font-size: 3rem;
    }

    /* Profile Image */
    .profile-img {
      width: 180px;
      height: 180px;
      border-radius: 50%;
      object-fit: cover;
      border: 5px solid #fff;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }

    /* Skills */
    .skill-bar {
      background: #e9ecef;
      border-radius: 1rem;
      overflow: hidden;
      height: 10px;
    }
    .skill-bar-fill {
      height: 100%;
      background: linear-gradient(135deg,#007bff,#00c6ff);
    }

    /* Timeline */
    .timeline {
      position: relative;
      margin: 2rem 0;
      padding-left: 30px;
      border-left: 3px solid #007bff;
    }
    .timeline-item {
      margin-bottom: 2rem;
    }
    .timeline-item h6 {
      font-weight: 600;
      margin-bottom: 0.3rem;
    }
    .timeline-item span {
      font-size: 0.9rem;
      color: #6c757d;
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
<!-- Hero -->
<section class="hero">
  <div class="container">
    <img src="https://source.unsplash.com/200x200/?portrait" alt="Profile Image" class="profile-img mb-3">
    <h1 data-aos="fade-up">John Doe</h1>
    <p data-aos="fade-up" data-aos-delay="100">Web Developer | UI/UX Enthusiast | Tech Blogger</p>
    <a href="#contact" class="btn btn-primary mt-3" data-aos="fade-up" data-aos-delay="200">Hire Me</a>
  </div>
</section>

<!-- Profile Content -->
<div class="container my-5">
  <div class="row g-4">
    <!-- About -->
    <div class="col-lg-8" data-aos="fade-up">
      <div class="card p-4 shadow-sm">
        <h4>About Me</h4>
        <p>Hello! I'm John Doe, a passionate web developer with over 5 years of experience building responsive websites and modern web applications. I love writing clean code, designing intuitive interfaces, and sharing knowledge through blogging.</p>
      </div>

      <!-- Skills -->
      <div class="card p-4 mt-4 shadow-sm">
        <h4>Skills</h4>
        <p class="mb-1">HTML & CSS</p>
        <div class="skill-bar mb-3"><div class="skill-bar-fill" style="width:90%"></div></div>
        <p class="mb-1">JavaScript</p>
        <div class="skill-bar mb-3"><div class="skill-bar-fill" style="width:85%"></div></div>
        <p class="mb-1">PHP & Laravel</p>
        <div class="skill-bar mb-3"><div class="skill-bar-fill" style="width:80%"></div></div>
        <p class="mb-1">React.js</p>
        <div class="skill-bar mb-3"><div class="skill-bar-fill" style="width:75%"></div></div>
      </div>
    </div>

    <!-- Sidebar -->
    <div class="col-lg-4" data-aos="fade-left">
      <!-- Contact Info -->
      <div class="card p-4 shadow-sm mb-4">
        <h5>Contact Info</h5>
        <p><i class="fa fa-envelope me-2"></i> john.doe@email.com</p>
        <p><i class="fa fa-phone me-2"></i> +123 456 789</p>
        <p><i class="fa fa-map-marker-alt me-2"></i> San Francisco, CA</p>
      </div>

      <!-- Social -->
      <div class="card p-4 shadow-sm mb-4">
        <h5>Follow Me</h5>
        <a href="#" class="me-3"><i class="fab fa-facebook fa-lg"></i></a>
        <a href="#" class="me-3"><i class="fab fa-twitter fa-lg"></i></a>
        <a href="#" class="me-3"><i class="fab fa-instagram fa-lg"></i></a>
        <a href="#"><i class="fab fa-linkedin fa-lg"></i></a>
      </div>

      <!-- Download CV -->
      <div class="card p-4 shadow-sm">
        <h5>Download CV</h5>
        <a href="#" class="btn btn-primary btn-sm mt-2 w-100"><i class="fa fa-download me-2"></i>Download</a>
      </div>
    </div>
  </div>
</div>

<!-- Contact Section -->
<section id="contact" class="my-5">
  <div class="container">
    <div class="card p-4 shadow-sm" data-aos="fade-up">
      <h4>Contact Me</h4>
      <p>Feel free to reach out via this form:</p>
      <form>
        <div class="mb-3">
          <input type="text" class="form-control" placeholder="Your Name">
        </div>
        <div class="mb-3">
          <input type="email" class="form-control" placeholder="Your Email">
        </div>
        <div class="mb-3">
          <textarea class="form-control" rows="4" placeholder="Your Message"></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Send Message</button>
      </form>
    </div>
  </div>
</section>
@endsection