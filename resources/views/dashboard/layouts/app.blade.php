<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title') | Admin Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
  <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css"/>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  @stack('css')
</head>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Sidebar -->
    <div class="col-md-2 sidebar p-3">
      <h3 class="text-center mb-4">Admin</h3>
      <a href="{{ route('dashboard') }}" class="{{ Route::is('dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
      </a>
      <a href="{{ route('dashboard.users.index') }}" class="{{ Route::is('dashboard.users.*') ? 'active' : '' }}">
        <i class="fas fa-users me-2"></i>Users
      </a>
      <a href="{{ route('dashboard.posts.index') }}" class="{{ Route::is('dashboard.posts.*') ? 'active' : '' }}">
        <i class="fas fa-file-alt me-2"></i>Posts
      </a>
      <a href="{{ route('dashboard.categories.index') }}" class="{{ Route::is('dashboard.categories.*') ? 'active' : '' }}">
        <i class="fas fa-folder me-2"></i>Categories
      </a>
      <a href="{{ route('dashboard.tags.index') }}" class="{{ Route::is('dashboard.tags.*') ? 'active' : '' }}">
        <i class="fas fa-tags me-2"></i>Tags
      </a>
      <a href="{{ route('dashboard.ebooks.index') }}" class="{{ Route::is('dashboard.ebooks.*') ? 'active' : '' }}">
        <i class="fas fa-download me-2"></i>Ebooks / Downloads
      </a>
      <a href="{{ route('dashboard.contact-messages.index') }}" class="{{ Route::is('dashboard.contact-messages.*') ? 'active' : '' }}">
        <i class="fas fa-envelope me-2"></i>Contacts
      </a>
      <a href="{{ route('dashboard.logs') }}" class="{{ Route::is('dashboard.logs') ? 'active' : '' }}">
        <i class="fas fa-history me-2"></i>Logs
      </a>
      <a href="{{ route('dashboard.settings') }}" class="{{ Route::is('dashboard.settings') ? 'active' : '' }}">
        <i class="fas fa-cog me-2"></i>Settings
      </a>
      <form action="{{ route('logout') }}" method="POST" class="mt-3">
        @csrf
        <button type="submit" class="btn btn-danger w-100 text-start">
          <i class="fas fa-sign-out-alt me-2"></i> Logout
        </button>
      </form>
    </div>

    @yield('content')

  </div>
</div>

@stack('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init({ duration: 800, once: true });
</script>

</body>
</html>
