<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Web CRM Travel</title>
    <!-- Bootstrap 5 CSS link for basic compatibility across dashboard pages -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <!-- Custom modern styling for the redesign -->
    <link rel="stylesheet" href="src/css/login.css">
</head>
<body>
    <div class="login-wrapper">
        <!-- Left Column: Form Section -->
        <div class="login-form-side">
            <!-- Brand Header -->
            <a href="../index.php" class="brand-header">
                <div class="brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="30" height="30">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.84 13.84c-.45.45-1.18.45-1.63 0l-2.21-2.21-2.21 2.21c-.45.45-1.18.45-1.63 0-.45-.45-.45-1.18 0-1.63l2.21-2.21-2.21-2.21c-.45-.45-.45-1.18 0-1.63.45-.45 1.18-.45 1.63 0l2.21 2.21 2.21-2.21c.45-.45 1.18-.45 1.63 0 .45.45.45 1.18 0 1.63L13.63 12l2.21 2.21c.45.45.45 1.18 0 1.63z" opacity="0.15"/>
                        <path d="M12 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm5.5 5.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM12 18.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm5.5-3a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" fill="currentColor"/>
                        <circle cx="12" cy="12" r="3.5" fill="currentColor"/>
                    </svg>
                </div>
                <span class="brand-name">Web CRM Travel</span>
            </a>

            <!-- Form Content -->
            <div class="form-content-area">
                <h1 class="form-title">Selamat Datang Kembali</h1>
                <p class="form-subtitle">Masuk untuk mengelola paket wisata, pemesanan, dan data pelanggan di dasbor admin.</p>

                <!-- Action targets process-login API directly, retaining original PHP functionality -->
                <form action="src/api/process-login.php" method="POST">
                    <div class="input-group-custom">
                        <label for="inp-email" class="input-label-custom">Email Admin</label>
                        <input type="email" class="input-control-custom" id="inp-email" name="inp-email" placeholder="admin@gmail.com" required autofocus>
                    </div>

                    <div class="input-group-custom">
                        <label for="inp-password" class="input-label-custom">Kata Sandi</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="input-control-custom" id="inp-password" name="inp-password" placeholder="Masukkan kata sandi" required>
                            <button type="button" class="password-toggle-btn" id="password-toggle" aria-label="Tampilkan atau sembunyikan kata sandi">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit-custom">Masuk</button>
                </form>

            </div>

            <!-- Footer Links -->
            <div class="form-footer-section">
                <span>Copyright &copy; 2026 Web CRM Travel.</span>
                <a href="../profil.php" class="footer-link-custom">Profil Perusahaan</a>
            </div>
        </div>

        <!-- Right Column: Visual Showcase Section -->
        <div class="login-marketing-side">
            <div class="marketing-grid-overlay"></div>
            <div class="marketing-shape-overlay"></div>

            <!-- Visual Content Intro -->
            <div class="marketing-text-container">
                <h2 class="marketing-headline">Kelola pemesanan dan paket wisata lebih cepat.</h2>
                <p class="marketing-tagline">Pantau keberangkatan, pelanggan, dan pembayaran dalam satu dasbor.</p>
            </div>

            <!-- Dashboard Mockup Showcase Canvas -->
            <div class="mockup-wrapper">
                <div class="dashboard-canvas">
                    
                    <!-- 1. Background Table Window -->
                    <div class="mock-card card-table-window">
                        <div class="window-header">
                            <span class="window-title">Ringkasan Booking</span>
                            <div class="window-dots">
                                <span class="window-dot"></span>
                                <span class="window-dot"></span>
                                <span class="window-dot"></span>
                            </div>
                        </div>
                        <table class="mock-table">
                            <thead>
                                <tr>
                                    <th>ID Booking</th>
                                    <th>Paket Wisata</th>
                                    <th>Keberangkatan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#BK-2026-091</td>
                                    <td>Eksplor Bali 4D3N</td>
                                    <td>13 Feb, 2026</td>
                                    <td><span class="badge-custom badge-success">Lunas</span></td>
                                </tr>
                                <tr>
                                    <td>#BK-2026-090</td>
                                    <td>Yogyakarta Heritage Tour</td>
                                    <td>17 Feb, 2026</td>
                                    <td><span class="badge-custom badge-warning">Menunggu</span></td>
                                </tr>
                                <tr>
                                    <td>#BK-2026-089</td>
                                    <td>Labuan Bajo Adventure</td>
                                    <td>22 Feb, 2026</td>
                                    <td><span class="badge-custom badge-info">DP Masuk</span></td>
                                </tr>
                                <tr>
                                    <td>#BK-2026-088</td>
                                    <td>Bandung Outbound Team</td>
                                    <td>02 Mar, 2026</td>
                                    <td><span class="badge-custom badge-warning">Menunggu</span></td>
                                </tr>
                                <tr>
                                    <td>#BK-2026-087</td>
                                    <td>Malang Batu Explorer</td>
                                    <td>05 Mar, 2026</td>
                                    <td><span class="badge-custom badge-success">Lunas</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap 5 Bundle with Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <!-- Password visibility toggle script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('inp-password');
            const passwordToggle = document.getElementById('password-toggle');
            
            if (passwordToggle && passwordInput) {
                passwordToggle.addEventListener('click', function() {
                    const isPassword = passwordInput.getAttribute('type') === 'password';
                    passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                    
                    if (isPassword) {
                        // Eye slashed icon SVG when showing password
                        passwordToggle.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="eye-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.893 7.893L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                            </svg>
                        `;
                    } else {
                        // Regular eye icon SVG when hiding password
                        passwordToggle.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" class="eye-icon">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        `;
                    }
                });
            }
        });
    </script>
</body>
</html>
