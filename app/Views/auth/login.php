<?php helper('url'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login TESLAR</title>
    <link rel="shortcut icon" type="image/png" href="/assets/images/backgrounds/logo_tkj.png" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --page-bg: #eaf2ff;
            --page-accent: #d9e9ff;
            --hero-start: #0d3f99;
            --hero-end: #1f6feb;
            --surface: rgba(255, 255, 255, 0.94);
            --surface-strong: #ffffff;
            --text: #10214a;
            --muted: #64759c;
            --line: rgba(24, 79, 183, 0.14);
            --primary: #1f6feb;
            --primary-dark: #184fb7;
            --danger-bg: rgba(217, 48, 37, 0.08);
            --danger-line: rgba(217, 48, 37, 0.16);
            --danger-text: #bf2c21;
            --shadow: 0 28px 70px rgba(12, 48, 120, 0.16);
            --radius-lg: 30px;
            --radius-md: 20px;
            --radius-sm: 14px;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            padding: 24px;
            display: grid;
            place-items: center;
            font-family: "Poppins", "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--text);
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.95), transparent 30%),
                linear-gradient(135deg, #0d3f99 0%, #1f6feb 34%, var(--page-accent) 34.1%, var(--page-bg) 100%);
        }

        .shell {
            width: min(1040px, 100%);
            display: grid;
            grid-template-columns: minmax(0, 1.1fr) minmax(360px, 0.9fr);
            gap: 24px;
            align-items: stretch;
        }

        .hero,
        .panel {
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
        }

        .hero {
            position: relative;
            overflow: hidden;
            padding: 42px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: linear-gradient(145deg, rgba(9, 37, 94, 0.98), rgba(31, 111, 235, 0.92));
            border: 1px solid rgba(179, 212, 255, 0.3);
            color: #f8fbff;
        }

        .hero::before,
        .hero::after {
            content: "";
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
        }

        .hero::before {
            width: 220px;
            height: 220px;
            top: -80px;
            right: -70px;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.22), transparent 70%);
        }

        .hero::after {
            width: 240px;
            height: 240px;
            left: -90px;
            bottom: -110px;
            background: radial-gradient(circle, rgba(112, 191, 255, 0.26), transparent 70%);
        }

        .hero-top,
        .hero-bottom {
            position: relative;
            z-index: 1;
        }

        .hero-logo {
            width: clamp(110px, 18vw, 150px);
            display: block;
            margin-bottom: 22px;
            filter: drop-shadow(0 10px 24px rgba(0, 0, 0, 0.2));
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.14);
            color: #dcecff;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .hero h1 {
            margin: 18px 0 14px;
            max-width: 520px;
            font-size: clamp(2.1rem, 4vw, 3.25rem);
            line-height: 1.06;
        }

        .hero p {
            margin: 0;
            max-width: 520px;
            color: rgba(238, 246, 255, 0.88);
            line-height: 1.8;
            font-size: 1rem;
        }

        .hero-points {
            display: grid;
            gap: 12px;
            margin-top: 32px;
        }

        .hero-points span {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: rgba(244, 249, 255, 0.9);
            font-size: 0.95rem;
        }

        .hero-points i {
            width: 28px;
            height: 28px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.14);
        }

        .panel {
            padding: 34px;
            background: var(--surface);
            border: 1px solid rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
        }

        .panel h2 {
            margin: 0;
            font-size: 1.85rem;
        }

        .panel-subtitle {
            margin: 10px 0 24px;
            color: var(--muted);
            line-height: 1.75;
        }

        .alert-login {
            margin-bottom: 18px;
            padding: 14px 16px;
            border-radius: var(--radius-sm);
            background: var(--danger-bg);
            border: 1px solid var(--danger-line);
            color: var(--danger-text);
            font-size: 0.95rem;
            font-weight: 600;
        }

        .field {
            margin-bottom: 18px;
        }

        .field label {
            display: block;
            margin-bottom: 9px;
            font-weight: 700;
            color: var(--text);
        }

        .input-wrap {
            position: relative;
        }

        .input-wrap i {
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: #7c8cae;
            font-size: 0.95rem;
            pointer-events: none;
            z-index: 2;
        }

        .input-wrap input {
            width: 100%;
            padding: 15px 18px 15px 48px;
            border: 1px solid var(--line);
            border-radius: 16px;
            background: var(--surface-strong);
            color: var(--text);
            font-size: 1rem;
            outline: none;
            position: relative;
            z-index: 1;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .input-wrap input::placeholder {
            color: #92a0bb;
        }

        .input-wrap input:focus {
            border-color: rgba(31, 111, 235, 0.48);
            box-shadow: 0 0 0 4px rgba(31, 111, 235, 0.12);
            transform: translateY(-1px);
        }

        .form-hint {
            margin: 0 0 22px;
            color: var(--muted);
            font-size: 0.92rem;
        }

        .actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-top: 6px;
        }

        .button,
        .button-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            min-height: 52px;
            padding: 14px 20px;
            border-radius: 999px;
            font-size: 0.98rem;
            font-weight: 700;
            text-decoration: none;
            transition: transform 0.2s ease, box-shadow 0.2s ease, background 0.2s ease;
        }

        .button {
            border: 0;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: #fff;
            cursor: pointer;
            box-shadow: 0 14px 30px rgba(24, 79, 183, 0.24);
        }

        .button:hover {
            transform: translateY(-1px);
            box-shadow: 0 18px 34px rgba(24, 79, 183, 0.28);
        }

        .button-secondary {
            border: 1px solid rgba(31, 111, 235, 0.16);
            background: #ffffff;
            color: var(--primary-dark);
            box-shadow: 0 10px 22px rgba(17, 56, 132, 0.08);
        }

        .button-secondary:hover {
            transform: translateY(-1px);
            background: #f7faff;
        }

        .footer-link {
            margin-top: 22px;
            text-align: center;
            font-size: 0.92rem;
            color: var(--muted);
        }

        .footer-link a {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 700;
        }

        .footer-link a:hover {
            text-decoration: underline;
        }

        @media (max-width: 920px) {
            .shell {
                grid-template-columns: 1fr;
            }

            .hero,
            .panel {
                padding: 28px;
            }
        }

        @media (max-width: 560px) {
            body {
                padding: 16px;
            }

            .hero,
            .panel {
                padding: 22px;
                border-radius: 24px;
            }

            .hero-logo {
                margin-bottom: 18px;
            }

            .actions {
                grid-template-columns: 1fr;
            }

            .panel h2 {
                font-size: 1.6rem;
            }
        }
    </style>
</head>

<body>
    <main class="shell">
        <section class="hero">
            <div class="hero-top">
                <img src="/assets/images/backgrounds/hero.webp" class="hero-logo" alt="Logo TESLAR">
                <div class="eyebrow">Portal Admin</div>
                <h1>Silakan masuk ke akun Anda</h1>
                <p>Kelola data PKWU dengan lebih rapi melalui halaman admin yang aman, cepat, dan mudah digunakan.</p>
            </div>

            <div class="hero-bottom hero-points">
                <span><i class="fa-solid fa-shield-halved"></i> Akses login untuk pengguna terdaftar</span>
                <span><i class="fa-solid fa-layer-group"></i> Dashboard terpusat untuk pengelolaan data</span>
                <span><i class="fa-solid fa-users"></i> Mendukung aktivitas admin, guru, dan siswa</span>
            </div>
        </section>

        <section class="panel">
            <h2>Selamat Datang</h2>
            <p class="panel-subtitle">Masukkan kode user dan password Anda untuk melanjutkan ke dashboard aplikasi.</p>

            <?php if (session()->get('gagal') == true) : ?>
                <div class="alert-login" role="alert">
                    <?= session()->get('gagal') ?>
                </div>
            <?php endif; ?>

            <form action="/auth/login" method="post">
                <?= csrf_field() ?>

                <div class="field">
                    <label for="kode_pengguna">Kode User</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" id="kode_pengguna" name="kode_pengguna" placeholder="Masukkan kode user" required autocomplete="off">
                    </div>
                </div>

                <div class="field">
                    <label for="password_pengguna">Password</label>
                    <div class="input-wrap">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" id="password_pengguna" name="password_pengguna" placeholder="Masukkan password" required autocomplete="off">
                    </div>
                </div>

                <p class="form-hint">Pastikan data login yang dimasukkan sesuai dengan akun yang terdaftar.</p>

                <div class="actions">
                    <button type="submit" class="button">Masuk</button>
                    <a href="/" class="button-secondary">Kembali</a>
                </div>

                <div class="footer-link">
                    <a href="https://www.instagram.com/fajarakbarrr_/?hl=en">Website TEFA-TKJ - F.J.R</a>
                </div>
            </form>
        </section>
    </main>
</body>

</html>
