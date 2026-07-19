<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Admin Login | Rhamify Technology</title>

  <link rel="stylesheet" href="{{ asset('backend/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/modules/fontawesome/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">

  <style>
    :root {
      --admin-primary: #f68b1e;
      --admin-primary-dark: #d97812;
      --admin-soft: #fff4e8;
      --admin-text: #111827;
      --admin-muted: #6b7280;
      --admin-border: #eadfd5;
      --admin-surface: #ffffff;
    }

    body {
      background: #f7f8fb;
      color: var(--admin-text);
      font-family: "Poppins", "Nunito", sans-serif;
      min-height: 100vh;
    }

    .admin-login-page {
      align-items: center;
      display: grid;
      justify-items: center;
      min-height: 100vh;
      padding: 24px 14px;
    }

    .admin-login-brand {
      align-items: center;
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 24px;
      text-align: center;
    }

    .admin-login-brand img {
      background: #ffffff;
      border: 1px solid var(--admin-border);
      border-radius: 10px;
      box-shadow: 0 12px 32px rgb(17 24 39 / 7%);
      height: 54px;
      object-fit: contain;
      padding: 8px;
      width: 142px;
    }

    .admin-login-brand span {
      color: var(--admin-muted);
      display: block;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: .08em;
      text-transform: uppercase;
    }

    .admin-login-panel {
      align-items: center;
      display: flex;
      flex-direction: column;
      justify-content: center;
      max-width: 430px;
      width: 100%;
    }

    .admin-login-card {
      background: var(--admin-surface);
      border: 1px solid var(--admin-border);
      border-radius: 10px;
      box-shadow: 0 24px 70px rgb(17 24 39 / 10%);
      max-width: 420px;
      padding: 30px;
      width: 100%;
    }

    .admin-login-card__header {
      margin-bottom: 24px;
    }

    .admin-login-card__header h2 {
      color: var(--admin-text);
      font-size: 26px;
      font-weight: 800;
      line-height: 1.25;
      margin-bottom: 8px;
    }

    .admin-login-card__header p {
      color: var(--admin-muted);
      font-size: 13px;
      line-height: 1.6;
      margin: 0;
    }

    .admin-login-card label {
      color: var(--admin-text);
      font-size: 12px;
      font-weight: 800;
      margin-bottom: 8px;
    }

    .admin-login-field {
      position: relative;
    }

    .admin-login-field i {
      align-items: center;
      color: var(--admin-primary-dark);
      display: flex;
      font-size: 13px;
      height: 100%;
      justify-content: center;
      left: 0;
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      width: 44px;
      z-index: 1;
    }

    .admin-login-field .form-control {
      background: #fffaf5;
      border: 1px solid var(--admin-border);
      border-radius: 8px;
      color: var(--admin-text);
      font-size: 14px;
      height: 48px;
      padding-left: 50px !important;
      padding-right: 14px !important;
    }

    .admin-login-field .form-control:focus {
      background: #ffffff;
      border-color: var(--admin-primary);
      box-shadow: 0 0 0 4px rgb(246 139 30 / 14%);
    }

    .admin-login-card code {
      color: #e11d48;
      display: block;
      font-size: 12px;
      margin-top: 7px;
    }

    .admin-login-options {
      align-items: center;
      display: flex;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 20px;
    }

    .admin-login-options .custom-control-label {
      color: var(--admin-muted);
      font-size: 12px;
      font-weight: 700;
      padding-top: 2px;
    }

    .admin-login-options a {
      color: var(--admin-primary-dark);
      font-size: 12px;
      font-weight: 800;
    }

    .admin-login-submit {
      align-items: center;
      background: var(--admin-primary);
      border: 0;
      border-radius: 8px;
      box-shadow: 0 12px 24px rgb(246 139 30 / 26%);
      color: #ffffff;
      display: inline-flex;
      font-size: 14px;
      font-weight: 800;
      gap: 9px;
      height: 48px;
      justify-content: center;
      width: 100%;
    }

    .admin-login-submit:hover,
    .admin-login-submit:focus {
      background: var(--admin-primary-dark);
      color: #ffffff;
    }

    .admin-login-footer {
      border-top: 1px solid var(--admin-border);
      color: var(--admin-muted);
      font-size: 12px;
      line-height: 1.6;
      margin-top: 22px;
      padding-top: 18px;
      text-align: center;
    }

    .admin-login-footer a {
      color: var(--admin-primary-dark);
      font-weight: 800;
    }

    @media (max-width: 991.98px) {
      .admin-login-page {
        padding: 22px 14px;
      }
    }

    @media (max-width: 575.98px) {
      .admin-login-card {
        padding: 22px 16px;
      }

      .admin-login-options {
        align-items: flex-start;
        flex-direction: column;
      }
    }
  </style>
</head>

<body>
  <main class="admin-login-page">
    <section class="admin-login-panel">
      <div class="admin-login-brand">
        <img src="{{ asset(@$logoSetting->logo ?? 'frontend/images/logo_2.png') }}" alt="Rhamify Technology logo">
        <span>Admin Control Center</span>
      </div>

      <div class="admin-login-card">
        <div class="admin-login-card__header">
          <h2>Welcome Back</h2>
          <p>Enter your administrator credentials to continue to the Rhamify dashboard.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
          @csrf

          <div class="form-group">
            <label for="email">Email Address</label>
            <div class="admin-login-field">
              <i class="far fa-envelope"></i>
              <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="{{ old('email') }}" placeholder="admin@example.com">
            </div>
            @if ($errors->has('email'))
              <code>{{ $errors->first('email') }}</code>
            @endif
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <div class="admin-login-field">
              <i class="fas fa-lock"></i>
              <input id="password" type="password" class="form-control" name="password" tabindex="2" required placeholder="Enter password">
            </div>
            @if ($errors->has('password'))
              <code>{{ $errors->first('password') }}</code>
            @endif
          </div>

          <div class="admin-login-options">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
              <label class="custom-control-label" for="remember-me">Remember me</label>
            </div>
            <a href="{{ route('password.request') }}">Forgot password?</a>
          </div>

          <button type="submit" class="admin-login-submit" tabindex="4">
            <i class="fas fa-sign-in-alt"></i>
            Sign In
          </button>
        </form>

        <div class="admin-login-footer">
          <span>Rhamify Technology admin portal</span><br>
          <a href="{{ url('/') }}">Return to storefront</a>
        </div>
      </div>
    </section>
  </main>

  <script src="{{ asset('backend/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('backend/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/stisla.js') }}"></script>
  <script src="{{ asset('backend/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
</body>

</html>
