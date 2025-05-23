<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #6c757d;
            --light: #f8f9fa;
            --dark: #212529;
            --border-radius: 0.5rem;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
            min-height: 100vh;
            display: flex;
            align-items: center;
        }

        .login-card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-header {
            background-color: var(--primary);
            color: white;
            text-align: center;
            padding: 1.5rem;
            border-bottom: none;
        }

        .card-header h3 {
            font-weight: 600;
            margin: 0;
        }

        .card-body {
            padding: 2rem;
        }

        .form-control {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #e0e0e0;
            font-family: 'Poppins', sans-serif;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
        }

        .input-group-text {
            background-color: white;
            border-right: none;
        }

        .form-floating>.form-control:not(:placeholder-shown)~label {
            transform: scale(0.85) translateY(-1.5rem) translateX(0.15rem);
            color: var(--secondary);
        }

        .btn-login {
            background-color: var(--primary);
            border: none;
            padding: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        . .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #e0e0e0;
        }

        .divider-text {
            padding: 0 1rem;
            color: var(--secondary);
            font-size: 0.85rem;
            text-transform: uppercase;
        }

        .btn-login:hover {
            background-color: blue;
            color: white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card login-card">
                    <div class="card-header">
                        <h3>Login Administrator</h3>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" autocomplete="off" id="login">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="username" placeholder="Username" required>
                                <label for="username">Username</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" placeholder="Password"
                                    required>
                                <label for="password">Password</label>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                </div>
                                <a href="#" class="text-decoration-none">Forgot password?</a>
                            </div>
                            <button class="btn btn-login w-100 text-white mb-3" type="submit"">
                                <i class=" fas fa-sign-in-alt me-2"></i>Login
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('login').addEventListener('submit', function (log) {
            log.preventDefault();
            username = document.getElementById('username').value.trim();
            password = document.getElementById('password').value.trim();
            if (username === "admin" && password === "admin1234") {
                console.log('login berhasil');
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil',
                    text: 'Selamat datang di dashboard admin',
                    confirmButtonText: 'OK',
                    didClose: () => {
                        window.location.href = 'dashboard.php';
                    }
                });

            }
            else {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: 'Username atau Password salah',
                    confirmButtonText: 'OK'
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>