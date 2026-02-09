<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payroll System | Secure Gateway</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-gradient: radial-gradient(circle at top right, #3b0764, #0f172a 40%),
                           radial-gradient(circle at bottom left, #1e3a8a, #0f172a 40%);
            --glass: rgba(255, 255, 255, 0.05);
            --glass-border: rgba(255, 255, 255, 0.1);
            --accent-cyan: #06b6d4;
            --accent-purple: #a855f7;
            --text-bright: #f8fafc;
            --text-dim: #94a3b8;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Mencegah Scroll */
        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-dark);
            background: var(--bg-gradient);
            color: var(--text-bright);
            position: relative;
        }

        /* Tekstur Carbon Fiber Minimalis */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("https://www.transparenttextures.com/patterns/carbon-fibre.png");
            opacity: 0.1;
            z-index: 0;
            pointer-events: none;
        }

        .main-container {
            width: 100%;
            max-width: 1000px;
            padding: 20px;
            z-index: 10;
            /* Memastikan container tidak melebihi layar */
            max-height: 95vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .header {
            text-align: left;
            margin-bottom: 40px;
        }

        .badge {
            display: inline-block;
            padding: 6px 16px;
            background: linear-gradient(90deg, var(--accent-cyan), var(--accent-purple));
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
            box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);
        }

        .header h1 {
            font-size: clamp(2rem, 5vw, 3rem);
            font-weight: 700;
            letter-spacing: -2px;
            margin-bottom: 12px;
            line-height: 1.1;
        }

        .header p {
            font-size: 1rem;
            color: var(--text-dim);
            max-width: 500px;
        }

        .portal-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .card {
            background: var(--glass);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 35px;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            position: relative;
            display: flex;
            flex-direction: column;
            cursor: pointer;
            text-decoration: none; /* Menghilangkan underline link */
            color: inherit;
        }

        /* Hover Effect pada Card */
        .card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.08);
            border-color: var(--accent-cyan);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
        }

        .icon-box {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 25px;
            color: var(--accent-cyan);
            border: 1px solid var(--glass-border);
        }

        .card h2 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .card p {
            color: var(--text-dim);
            font-size: 0.9rem;
            line-height: 1.5;
            margin-bottom: 30px;
        }

        /* Tombol yang diperbaiki fungsinya */
        .btn-action {
            display: flex;
            align-items: center;
            font-weight: 600;
            gap: 10px;
            color: var(--text-bright);
            margin-top: auto;
            pointer-events: none; /* Biar klik jatuh ke parent (card) */
        }

        .card:hover .btn-action {
            color: var(--accent-cyan);
        }

        .btn-action svg {
            transition: transform 0.3s ease;
        }

        .card:hover .btn-action svg {
            transform: translateX(8px);
        }

        @media (max-width: 640px) {
            .main-container { padding-top: 50px; }
            .portal-grid { grid-template-columns: 1fr; }
            .header { text-align: center; }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <header class="header">
            <span class="badge">Security Verified</span>
            <h1>Payroll Gateway</h1>
            <p>Sistem manajemen penggajian terenkripsi. Silakan pilih portal otorisasi Anda.</p>
        </header>

        <main class="portal-grid">
            <a href="/admin/login" class="card">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <h2>Administrator login</h2>
                <p>Otoritas penuh manajemen data, laporan keuangan, dan konfigurasi sistem.</p>
                <div class="btn-action">
                    Masuk Portal Admin
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </div>
            </a>

            <a href="karyawan/login" class="card">
                <div class="icon-box" style="color: var(--accent-purple);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                </div>
                <h2>Employee portal</h2>
                <p>Akses slip gaji mandiri, pengajuan cuti, dan riwayat kehadiran karyawan.</p>
                <div class="btn-action">
                    Masuk Portal Karyawan
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </div>
            </a>
        </main>
    </div>

</body>
</html>
