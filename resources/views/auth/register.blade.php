<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register | ModernBlog</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e0f7fa, #ffffff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .register-card {
      background: rgba(255, 255, 255, 0.85);
      backdrop-filter: blur(10px);
      border-radius: 2rem;
      padding: 3rem;
      max-width: 500px;
      width: 100%;
      box-shadow: 0 15px 30px rgba(0,0,0,0.1);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .register-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    h2 {
      color: #007bff;
      margin-bottom: 1.5rem;
      text-align: center;
    }

    .btn-social {
      width: 100%;
      margin-bottom: 0.5rem;
      font-weight: 500;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }
  </style>
</head>
<body>

<!-- Register Form -->
<div class="register-card" data-aos="fade-up">
  <h2>Create New Account</h2>
  @if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
  @endif
  @if ($errors->any())
    <div style="color:red;">
      <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
  @endif
  <form method="POST" action="{{ route('register.post') }}">
    @csrf
    <div class="mb-3">
      <label for="name" class="form-label">Full Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
    </div>
    <div class="mb-3">
      <label for="password_confirmation" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
    </div>
    <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
  </form>

  <!-- Social Register -->
  <a href="{{ route('auth.google') }}" class="btn btn-danger btn-social">
    <i class="fab fa-google"></i> Google
  </a>
  <button class="btn btn-primary btn-social"><i class="fab fa-facebook-f"></i> Register with Facebook</button>

  <p class="text-center mt-3">
    Already have an account? <a href="{{ route('login') }}">Login here</a>
  </p>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({
    duration: 800,
    once: true
  });
</script>
</body>
</html>
