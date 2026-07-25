<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - S2 Certification</title>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23418b2c'/%3E%3Ctext x='32' y='45' font-family='Arial,sans-serif' font-size='34' font-weight='bold' fill='white' text-anchor='middle'%3ES2%3C/text%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --theme-green: #418b2c;
            --theme-green-dark: #35701f;
            --theme-blue: #2d56a1;
            --dark-blue: #14213d;
            --heading-font: 'Plus Jakarta Sans', sans-serif;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Open Sans', sans-serif;
            min-height: 100vh;
            margin: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: #fff;
        }
        h1,h2,h3,h4,h5,h6 { font-family: var(--heading-font); }

        /* Left brand panel */
        .brand-panel {
            position: relative;
            background:
                linear-gradient(150deg, rgba(20,33,61,0.92) 0%, rgba(45,86,161,0.85) 100%),
                url('{{ asset('images/login_bg.png') }}');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 60px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .brand-panel .b-logo { background:#fff; padding:12px; border-radius:14px; display:inline-block; }
        .brand-panel h2 { font-weight: 800; font-size: 2.2rem; line-height: 1.2; margin-bottom: 16px; }
        .brand-panel p { opacity: 0.85; max-width: 420px; }
        .brand-feature { display:flex; align-items:center; gap:12px; margin-bottom:14px; font-family: var(--heading-font); font-weight:600; }
        .brand-feature i { color: #7ed957; }

        /* Right form panel */
        .form-panel {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
        }
        .login-card { width: 100%; max-width: 400px; }
        .login-card .eyebrow {
            font-family: var(--heading-font); font-weight:700; font-size:0.75rem;
            letter-spacing:0.14em; text-transform:uppercase; color: var(--theme-green);
        }
        .login-card h3 { font-weight: 800; color: var(--dark-blue); margin: 6px 0 6px; }
        .login-card .sub { color:#667085; font-size:0.92rem; margin-bottom: 28px; }

        .input-group-text { background:#f7f9fc; border-color:#e6ebf3; color:#667085; border-radius:10px 0 0 10px; }
        .form-control {
            border-radius: 10px; border:1px solid #e6ebf3; padding: 12px 14px;
        }
        .input-group .form-control { border-radius: 0 10px 10px 0; }
        .form-control:focus {
            border-color: var(--theme-green);
            box-shadow: 0 0 0 0.2rem rgba(65,139,44,0.12);
        }
        .form-label { font-family: var(--heading-font); font-weight:600; font-size:0.85rem; color: var(--dark-blue); }
        .btn-login {
            background: var(--theme-green); color:#fff; width:100%; padding:13px;
            font-family: var(--heading-font); font-weight:700; border:none; border-radius:50px;
            box-shadow: 0 10px 24px rgba(65,139,44,0.28); transition: all .3s ease;
        }
        .btn-login:hover { background: var(--theme-green-dark); transform: translateY(-2px); box-shadow: 0 14px 30px rgba(65,139,44,0.35); }
        .back-link { color:#667085; font-size:0.86rem; text-decoration:none; }
        .back-link:hover { color: var(--theme-green); }
        .alert { border-radius:12px; border:none; }

        @media (max-width: 900px) {
            body { grid-template-columns: 1fr; }
            .brand-panel { display:none; }
        }
    </style>
</head>
<body>

    <!-- Brand panel -->
    <div class="brand-panel">
        <div>
            <div class="b-logo"><img src="{{ asset('images/logo.png') }}" alt="S2 Certification" style="height: 46px;"></div>
        </div>
        <div>
            <h2>Welcome to the<br>S2 Certification Panel</h2>
            <p>Manage certificates, users and roles from one secure, centralised dashboard.</p>
            <div class="mt-4">
                <div class="brand-feature"><i class="fas fa-shield-halved"></i> Secure, role-based access</div>
                <div class="brand-feature"><i class="fas fa-certificate"></i> Full certificate management</div>
                <div class="brand-feature"><i class="fas fa-bolt"></i> Fast and intuitive workflow</div>
            </div>
        </div>
        <div class="small" style="opacity:0.6;">&copy; {{ date('Y') }} S2 Certification. All rights reserved.</div>
    </div>

    <!-- Form panel -->
    <div class="form-panel">
        <div class="login-card">
            <span class="eyebrow">Admin Access</span>
            <h3>Sign in to your account</h3>
            <p class="sub">Enter your credentials to access the admin panel.</p>

            @if($errors->any())
                <div class="alert alert-danger px-3 py-2 small">
                    <i class="fas fa-circle-exclamation me-1"></i> {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control" placeholder="admin@example.com" required value="{{ old('email') }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="••••••••" required>
                        <span class="input-group-text" style="cursor:pointer;border-radius:0 10px 10px 0;" onclick="togglePw()"><i class="fas fa-eye" id="pwIcon"></i></span>
                    </div>
                </div>
                <button type="submit" class="btn-login mt-2">Login to Panel</button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left me-1"></i> Back to Website</a>
            </div>
        </div>
    </div>

    <script>
        function togglePw(){
            const p = document.getElementById('password');
            const i = document.getElementById('pwIcon');
            if(p.type === 'password'){ p.type='text'; i.classList.replace('fa-eye','fa-eye-slash'); }
            else { p.type='password'; i.classList.replace('fa-eye-slash','fa-eye'); }
        }
    </script>
</body>
</html>
