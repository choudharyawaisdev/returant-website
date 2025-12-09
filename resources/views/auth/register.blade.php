<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cafe Chinos — Register</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --accent: #b7410e;
            --muted: #f7f4f2;
            --deep: #2b2b2b;
            --card: #ffffff;
        }

        body {
            background: linear-gradient(180deg, #fffaf7, #fff6f0, #fff);
            font-family: Inter, 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .auth-card {
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
            max-width: 1100px;
            width: 100%;
            display: flex;
        }

        /* LEFT: Form */
        .auth-form {
            flex: 0 0 50%;
            background: var(--card);
            padding: 2.4rem 2.2rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--deep);
        }

        .muted {
            color: #6b6b6b;
        }

        .form-control:focus {
            box-shadow: 0 0 0 .15rem rgba(183, 65, 14, .15);
            border-color: var(--accent);
        }

        .input-group-text {
            background: #fff;
            border-left: 0;
            cursor: pointer;
        }

        .btn-accent {
            background: var(--accent);
            border: 0;
            color: #fff;
            padding: .65rem 1rem;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-accent:hover {
            background: #9a3b0d;
        }

        .visual-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.25);
        }

        @media(max-width:768px) {
            .auth-visual {
                display: none;
            }
        }

        @media(max-width:991px) {
            .auth-card {
                flex-direction: column;
            }

            .auth-form {
                width: 100%;
            }

            .auth-visual {
                min-height: 230px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-card">

        <!-- LEFT: Register Form -->
        <div class="auth-form">
            <div class="mb-3">
                <div class="form-title">Create your account</div>
                <small class="muted">Register to continue</small>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label class="small font-weight-600">Full Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="John Doe" required>

                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                 <div class="form-group">
                    <label class="small font-weight-600">Phone Number</label>
                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                        placeholder="Phone Number" required>

                    @error('name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="small font-weight-600">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="name@domain.com" required>

                    @error('email')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label class="small font-weight-600">Password</label>
                    <div class="input-group">
                        <input id="password" type="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" placeholder="Enter password"
                            required>

                        <div class="input-group-append">
                            <span class="input-group-text" id="togglePwd">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    @error('password')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <label class="small font-weight-600">Confirm Password</label>
                    <div class="input-group">
                        <input id="passwordConfirm" type="password" name="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            placeholder="Confirm password" required>

                        <div class="input-group-append">
                            <span class="input-group-text" id="togglePwd2">
                                <i class="fa fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    @error('password_confirmation')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <button class="btn btn-accent btn-block mb-3" type="submit">Register</button>

                <div class="text-center mt-2">
                    <small class="muted">Already have an account? <a href="/login">Login</a></small>
                </div>
            </form>

        </div>

        <!-- RIGHT: Image with no text -->
        <!-- RIGHT: Image -->
        <div class="auth-visual">
          <img src="{{ asset('assets/images/login.jpg') }}" alt="">
        </div>

    </div>

    <script>
        function toggle(id, iconId) {
            const field = document.getElementById(id);
            const icon = document.getElementById(iconId).querySelector('i');
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        document.getElementById('togglePwd').onclick = () => toggle('password', 'togglePwd');
        document.getElementById('togglePwd2').onclick = () => toggle('passwordConfirm', 'togglePwd2');
    </script>
</body>

</html>
