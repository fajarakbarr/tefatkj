<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login TESLA</title>
    <link rel="shortcut icon" type="image/png" href="/assets/images/backgrounds/logo_tkj.png" />
    <link rel="stylesheet" href="/assets/css/styles.min.css" />
    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #000;
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            overflow: hidden;
        }

        /* Background Shapes */
        .background-shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            z-index: -1;
            animation: float 12s infinite ease-in-out alternate;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: #00d2ff;
            background: linear-gradient(to right, #00d2ff, #3a7bd5);
            top: -100px;
            left: -100px;
            opacity: 0.4;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: #0f2027;
            background: linear-gradient(to right, #203a43, #2c5364);
            bottom: -50px;
            right: -50px;
            opacity: 0.6;
            animation-delay: -6s;
        }

        /* Main Card - Glassmorphism with Dark Tint */
        .login-container {
            width: 420px;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 45px 40px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5),
                inset 0 0 20px rgba(255, 255, 255, 0.02);
            color: #fff;
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .login-container:hover {
            transform: translateY(-2px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6),
                inset 0 0 20px rgba(255, 255, 255, 0.05);
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .icon-user {
            width: 150px;
            /* background: linear-gradient(135deg, #00d2ff, #3a7bd5); */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            /* font-size: 28px; */
            /* box-shadow: 0 5px 8px rgba(0, 210, 255, 0.3); */
        }

        .login-header h2 {
            font-size: 1.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
            color: rgba(255, 255, 255);
        }

        .login-header p {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
            font-weight: 300;
        }

        /* Input Fields */
        .input-group {
            position: relative;
            margin-bottom: 22px;
        }

        .input-group i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            transition: 0.3s;
            font-size: 0.9rem;
        }

        .input-group input {
            width: 100%;
            padding: 14px 20px 14px 48px;
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            outline: none;
            color: #fff;
            font-size: 0.95rem;
            transition: 0.3s;
            letter-spacing: 0.5px;
        }

        .input-group input::placeholder {
            color: rgba(255, 255, 255, 0.3);
        }

        .input-group input:focus {
            background: rgba(0, 0, 0, 0.5);
            border-color: #00d2ff;
            box-shadow: 0 0 15px rgba(0, 210, 255, 0.15);
        }

        .input-group input:focus+i {
            color: #00d2ff;
        }

        /* Button */
        .btn-login {
            width: 100px;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #00d2ff, #3a7bd5);
            color: #000;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .btn-kembali {
            width: 100px;
            padding: 10px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(90deg, #6f7272, #131313);
            color: #fff;
            font-size: 1rem;
            font-weight: 600;
            letter-spacing: 1px;
            cursor: pointer;
            transition: 0.3s;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: 0.5s;
        }

        .btn-login:hover {
            background: linear-gradient(90deg, #3a7bd5, #00d2ff);
            transform: scale(1.02);
            box-shadow: 0 5px 20px rgba(0, 210, 255, 0.4);
        }

        .btn-login:hover::before {
            left: 100%;
        }


        /* Footer Links */
        .footer-link {
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .footer-link a {
            color: #00d2ff;
            text-decoration: none;
            font-weight: 500;
            margin-left: 5px;
            transition: 0.5s;
        }

        .footer-link a:hover {
            /* text-decoration: underline; */
            color: white;
        }

        /* Animations */
        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(30px, 50px) rotate(10deg);
            }
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 35px 25px;
            }

            .options {
                flex-direction: column;
                gap: 10px;
                align-items: flex-start;
            }

            .shape-1 {
                display: none;
            }

            .shape-2 {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- Background Effects -->
    <div class="background-shape shape-1"></div>
    <div class="background-shape shape-2"></div>

    <div class="login-container">
        <div class="login-header">
            <div>
                <!-- <i class="fas fa-user"></i> -->
                <img src="/assets/images/backgrounds/hero.webp" class="icon-user" alt="">
            </div>
            <h2>Selamat Datang</h2>
            <p>Silakan masuk ke akun Anda</p>
            <?php if (session()->get('gagal') == true) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><?= session()->get('gagal') ?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
        </div>
        <form action="/auth/login" method="post">
            <?= csrf_field() ?>
            <div class="input-group">
                <input type="text" placeholder="Kode User" required name="kode_pengguna" autocomplete="off">
                <i class="fas fa-user"></i>
            </div>

            <div class="input-group">
                <input type="password" placeholder="Password" required name="password_pengguna" autocomplete="off">
                <i class="fas fa-lock"></i>
            </div>

            <div style="display: flex; justify-content: space-evenly;">
                <button type="submit" class="btn-login">MASUK</button>
                <a href="/" class="btn-kembali">KEMBALI</a>
            </div>

            <div class="footer-link">
                <a href="https://www.instagram.com/fajarakbarrr_/?hl=en">Website TEFA-TKJ - F.J.R</a>
            </div>
        </form>
    </div>

    <script src="/assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>