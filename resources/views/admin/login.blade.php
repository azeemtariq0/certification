<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - S2 Certification</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(rgba(26, 32, 44, 0.6), rgba(26, 32, 44, 0.6)), url('{{ asset('images/login_bg.png') }}');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Open Sans', sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 40px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .logo {
            font-size: 2rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 30px;
            color: #1a202c;
        }
        .logo span {
            color: #418b2c;
        }
        .btn-red {
            background-color: #418b2c;
            color: #fff;
            width: 100%;
            padding: 12px;
            font-weight: 700;
            border: none;
            border-radius: 6px;
            margin-top: 20px;
        }
        .btn-red:hover {
            background-color: #2d56a1;
            color: #fff;
        }
        .form-control:focus {
            border-color: #418b2c;
            box-shadow: 0 0 0 0.25rem rgba(65, 139, 44, 0.1);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="logo text-center">
            <img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 80px;">
        </div>
        
        @if($errors->any())
            <div class="alert alert-danger px-3 py-2 small">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-bold">Email Address</label>
                <input type="email" name="email" class="form-control" placeholder="admin@example.com" required value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label class="form-label small fw-bold">Password</label>
                <input type="password" name="password" class="form-control" placeholder="••••••••" required>
            </div>
            <button type="submit" class="btn btn-red">Login to Panel</button>
        </form>
        
        <div class="text-center mt-4">
            <a href="{{ route('home') }}" class="text-muted small text-decoration-none"><i class="fas fa-arrow-left me-1"></i> Back to Website</a>
        </div>
    </div>

</body>
</html>
