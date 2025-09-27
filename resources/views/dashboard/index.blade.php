@extends('dashboard.layouts.app')

@section('title', 'Dashboard')

@push('css')
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      min-height: 100vh;
    }

    .sidebar {
      background: #007bff;
      min-height: 100vh;
      color: #fff;
    }
    .sidebar a {
      color: #fff;
      text-decoration: none;
      padding: 0.75rem 1rem;
      display: block;
      border-radius: 0.5rem;
      margin-bottom: 0.3rem;
      transition: 0.3s;
    }
    .sidebar a:hover, .sidebar a.active {
      background: rgba(255,255,255,0.2);
    }

    .top-navbar {
      background: #fff;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      padding: 0.5rem 1rem;
    }

    .card-stats {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card-stats:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 30px rgba(0,0,0,0.12);
    }

    .table-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 1rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }

    h2 {
      color: #007bff;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>Dashboard</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
      <div class="col-md-3" data-aos="fade-up">
        <div class="card-stats text-center">
          <h5>Users</h5>
          <h3>{{ $userCount }}</h3>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up">
        <div class="card-stats text-center">
          <h5>Posts</h5>
          <h3>{{ $postCount }}</h3>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up">
        <div class="card-stats text-center">
          <h5>Categories</h5>
          <h3>{{ $categoryCount }}</h3>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up">
        <div class="card-stats text-center">
          <h5>Tags</h5>
          <h3>{{ $tagCount }}</h3>
        </div>
      </div>
    </div>

    <!-- Charts Section -->
    <div class="row mb-4">
      <div class="col-md-6" data-aos="fade-up">
        <div class="card-stats p-4">
          <h5>Posts Activity</h5>
          <canvas id="postsChart"></canvas>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-up">
        <div class="card-stats p-4">
          <h5>New Users</h5>
          <canvas id="usersChart"></canvas>
        </div>
      </div>
    </div>

    <!-- Recent Posts & Latest Users Section -->
    <div class="row">
      <!-- Recent Posts -->
      <div class="col-md-8" data-aos="fade-up">
        <div class="table-card">
          <h5>Recent Posts</h5>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Views</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentPosts as $post)
                <tr>
                  <td>{{ $post->title }}</td>
                  <td>{{ $post->user->name ?? 'Unknown' }}</td>
                  <td>{{ $post->category->name ?? '-' }}</td>
                  <td>{{ $post->views ?? 0 }}</td>
                  <td>
                    @if($post->status === 'published')
                      <span class="badge bg-success">Published</span>
                    @else
                      <span class="badge bg-warning">Draft</span>
                    @endif
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Latest Users -->
      <div class="col-md-4" data-aos="fade-up">
        <div class="table-card">
          <h5>Latest Users</h5>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Name</th>
                <th>Joined</th>
              </tr>
            </thead>
            <tbody>
              @foreach($latestUsers as $user)
                <tr>
                  <td>{{ $user->name }}</td>
                  <td>{{ $user->created_at->diffForHumans() }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('js')
<script>
  const postsChart = new Chart(document.getElementById('postsChart'), {
    type: 'line',
    data: {
      labels: @json($months),
      datasets: [{
        label: 'Posts',
        data: @json($postsData),
        borderColor: '#007bff',
        backgroundColor: 'rgba(0,123,255,0.2)',
        fill: true,
        tension: 0.3
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });

  const usersChart = new Chart(document.getElementById('usersChart'), {
    type: 'bar',
    data: {
      labels: @json($months),
      datasets: [{
        label: 'Users',
        data: @json($usersData),
        backgroundColor: '#28a745'
      }]
    },
    options: { responsive: true, plugins: { legend: { display: false } } }
  });
</script>
@endpush