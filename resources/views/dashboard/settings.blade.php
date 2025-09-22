@extends('dashboard.layouts.app')

@section('title', 'Settings')

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

    .settings-card {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 2rem;
      box-shadow: 0 10px 20px rgba(0,0,0,0.08);
      margin-bottom: 2rem;
    }

    .form-switch-label {
      font-weight: 500;
    }
  </style>
@endpush

@section('content')
  <!-- Main Content -->
  <div class="col-md-10 p-4">
    <!-- Top Navbar -->
    <div class="top-navbar d-flex justify-content-between align-items-center mb-4">
      <h2>Settings</h2>
      <div>
        <i class="fas fa-bell me-3"></i>
        <i class="fas fa-user-circle fa-lg"></i>
      </div>
    </div>

    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Settings</li>
      </ol>
    </nav>

    <!-- Settings Card -->
    <div class="settings-card" data-aos="fade-up">
      <ul class="nav nav-tabs mb-3" id="settingsTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general" type="button" role="tab">General</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="downloads-tab" data-bs-toggle="tab" data-bs-target="#downloads" type="button" role="tab">Downloads</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab">Security</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="notifications-tab" data-bs-toggle="tab" data-bs-target="#notifications" type="button" role="tab">Notifications</button>
        </li>
      </ul>

      <div class="tab-content" id="settingsTabContent">

        <!-- General Settings -->
        <div class="tab-pane fade show active" id="general" role="tabpanel">
          <form id="generalSettingsForm">
            <div class="mb-3">
              <label for="siteTitle" class="form-label">Site Title</label>
              <input type="text" class="form-control" id="siteTitle" value="ModernBlog">
            </div>
            <div class="mb-3">
              <label for="siteEmail" class="form-label">Site Email</label>
              <input type="email" class="form-control" id="siteEmail" value="admin@modernblog.com">
            </div>
            <div class="mb-3">
              <label class="form-label">Maintenance Mode</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="maintenanceMode">
                <label class="form-check-label form-switch-label" for="maintenanceMode">Active</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>

        <!-- Downloads Settings -->
        <div class="tab-pane fade" id="downloads" role="tabpanel">
          <form id="downloadsSettingsForm">
            <div class="mb-3">
              <label class="form-label">Enable Downloads</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="enableDownloads" checked>
                <label class="form-check-label form-switch-label" for="enableDownloads">Active</label>
              </div>
            </div>
            <div class="mb-3">
              <label for="maxFileSize" class="form-label">Max File Size (MB)</label>
              <input type="number" class="form-control" id="maxFileSize" value="50">
            </div>
            <div class="mb-3">
              <label for="allowedTypes" class="form-label">Allowed File Types</label>
              <input type="text" class="form-control" id="allowedTypes" value="pdf,zip,rar,docx">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>

        <!-- Security Settings -->
        <div class="tab-pane fade" id="security" role="tabpanel">
          <form id="securitySettingsForm">
            <div class="mb-3">
              <label class="form-label">Enable 2FA (Authenticator)</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="enable2FA">
                <label class="form-check-label form-switch-label" for="enable2FA">Active</label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Force Strong Passwords</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="strongPasswords" checked>
                <label class="form-check-label form-switch-label" for="strongPasswords">Active</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>

        <!-- Notifications Settings -->
        <div class="tab-pane fade" id="notifications" role="tabpanel">
          <form id="notificationsSettingsForm">
            <div class="mb-3">
              <label class="form-label">Email Notifications</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="emailNotification" checked>
                <label class="form-check-label form-switch-label" for="emailNotification">Enabled</label>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">SMS Notifications</label>
              <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="smsNotification">
                <label class="form-check-label form-switch-label" for="smsNotification">Enabled</label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </form>
        </div>

      </div>
    </div>

  </div>
@endsection
