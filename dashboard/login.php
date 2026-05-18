<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sellora</title>
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
            <a href="#" class="brand-header">
                <div class="brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="30" height="30">
                        <!-- Six petals styled geometric logo representing Sellora -->
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm3.84 13.84c-.45.45-1.18.45-1.63 0l-2.21-2.21-2.21 2.21c-.45.45-1.18.45-1.63 0-.45-.45-.45-1.18 0-1.63l2.21-2.21-2.21-2.21c-.45-.45-.45-1.18 0-1.63.45-.45 1.18-.45 1.63 0l2.21 2.21 2.21-2.21c.45-.45 1.18-.45 1.63 0 .45.45.45 1.18 0 1.63L13.63 12l2.21 2.21c.45.45.45 1.18 0 1.63z" opacity="0.15"/>
                        <path d="M12 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm5.5 5.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zM12 18.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm5.5-3a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm-11 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z" fill="currentColor"/>
                        <circle cx="12" cy="12" r="3.5" fill="currentColor"/>
                    </svg>
                </div>
                <span class="brand-name">Sellora</span>
            </a>

            <!-- Form Content -->
            <div class="form-content-area">
                <h1 class="form-title">Welcome Back</h1>
                <p class="form-subtitle">Enter your credentials to access your CRM dashboard and manage your team.</p>

                <!-- Action targets process-login API directly, retaining original PHP functionality -->
                <form action="src/api/process-login" method="POST">
                    <div class="input-group-custom">
                        <label for="inp-email" class="input-label-custom">Email Address</label>
                        <input type="email" class="input-control-custom" id="inp-email" name="inp-email" placeholder="sellostore@company.com" required autofocus>
                    </div>

                    <div class="input-group-custom">
                        <label for="inp-password" class="input-label-custom">Password</label>
                        <div class="password-input-wrapper">
                            <input type="password" class="input-control-custom" id="inp-password" name="inp-password" placeholder="Enter your password" required>
                            <button type="button" class="password-toggle-btn" id="password-toggle" aria-label="Toggle password visibility">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn-submit-custom">Sign In</button>
                </form>

                <div class="divider-custom">Or Sign In With</div>

                <div class="social-buttons-container">
                    <button type="button" class="btn-social-custom">
                        <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.06H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.94l2.85-2.22.81-.63z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.06l3.66 2.84c.87-2.6 3.3-4.52 6.16-4.52z" fill="#EA4335"/>
                        </svg>
                        Google
                    </button>
                    <button type="button" class="btn-social-custom">
                        <svg viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M15.97 4.17c.66-.81 1.11-1.93.99-3.06-1 .04-2.24.67-2.96 1.52-.63.73-1.18 1.87-1.03 2.98 1.12.09 2.27-.56 3-1.44z"/>
                        </svg>
                        Apple
                    </button>
                </div>

                <div class="alt-link-container">
                    Don't have an account? <a href="#" class="alt-link-custom">Contact Admin</a>
                </div>
            </div>

            <!-- Footer Links -->
            <div class="form-footer-section">
                <span>Copyright &copy; 2026 Sellora Enterprises LTD.</span>
                <a href="#" class="footer-link-custom">Privacy Policy</a>
            </div>
        </div>

        <!-- Right Column: Visual Showcase Section -->
        <div class="login-marketing-side">
            <div class="marketing-grid-overlay"></div>
            <div class="marketing-shape-overlay"></div>

            <!-- Visual Content Intro -->
            <div class="marketing-text-container">
                <h2 class="marketing-headline">Effortlessly manage your team and operations.</h2>
                <p class="marketing-tagline">Log in to access your CRM dashboard and manage your team.</p>
            </div>

            <!-- Dashboard Mockup Showcase Canvas -->
            <div class="mockup-wrapper">
                <div class="dashboard-canvas">
                    
                    <!-- 1. Background Table Window -->
                    <div class="mock-card card-table-window">
                        <div class="window-header">
                            <span class="window-title">Product Transaction</span>
                            <div class="window-dots">
                                <span class="window-dot"></span>
                                <span class="window-dot"></span>
                                <span class="window-dot"></span>
                            </div>
                        </div>
                        <table class="mock-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Product Name</th>
                                    <th>Order Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#5L8990131-SN</td>
                                    <td>Apple iPad (32GB 3G)</td>
                                    <td>13 Feb, 2025</td>
                                    <td><span class="badge-custom badge-danger">Delivered</span></td>
                                </tr>
                                <tr>
                                    <td>#5L8990130-SN</td>
                                    <td>Apple iPhone 13</td>
                                    <td>13 Feb, 2025</td>
                                    <td><span class="badge-custom badge-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>#5L8990129-TH</td>
                                    <td>Apple MacBook Air M2</td>
                                    <td>13 Feb, 2025</td>
                                    <td><span class="badge-custom badge-success">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>#5L8990128-SN</td>
                                    <td>Apple iMac 2023</td>
                                    <td>13 Feb, 2025</td>
                                    <td><span class="badge-custom badge-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>#5L8990127-TH</td>
                                    <td>Apple AirPods 4</td>
                                    <td>13 Feb, 2025</td>
                                    <td><span class="badge-custom badge-success">Paid</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- 2. Floating Card: Total Sales -->
                    <div class="mock-card card-sales">
                        <div class="card-lbl">Total Sales</div>
                        <div class="card-val">$189,374</div>
                        <div class="card-change">+ 2% from last month</div>
                    </div>

                    <!-- 3. Floating Card: Chat Performance -->
                    <div class="mock-card card-chat">
                        <div class="card-lbl">Chat Performance</div>
                        <div class="card-val">00:01:30</div>
                        <!-- Sparkline graphic SVG -->
                        <svg class="sparkline-svg" viewBox="0 0 100 35">
                            <path d="M 0,30 Q 15,20 30,25 T 60,10 T 90,5 T 100,8" fill="none" stroke="var(--color-primary)" stroke-width="2" stroke-linecap="round"></path>
                            <path d="M 0,30 Q 15,20 30,25 T 60,10 T 90,5 T 100,8 L 100,35 L 0,35 Z" fill="rgba(59, 75, 247, 0.08)"></path>
                            <circle cx="90" cy="5" r="2" fill="var(--color-primary)"></circle>
                        </svg>
                    </div>

                    <!-- 4. Floating Card: Total Profit -->
                    <div class="mock-card card-profit">
                        <div class="card-lbl">Total Profit</div>
                        <div class="card-val">$25,684</div>
                        <span class="card-change">
                            <svg width="10" height="10" viewBox="0 0 12 12" fill="currentColor">
                                <path d="M6 2l-4 4h3v4h2v-4h3z"/>
                            </svg>
                            6%
                        </span>
                    </div>

                    <!-- 5. Floating Card: Sales Categories -->
                    <div class="mock-card card-categories">
                        <div class="card-title">Sales Categories</div>
                        <div class="chart-radial-wrapper">
                            <svg class="radial-chart-svg">
                                <circle class="radial-bg" cx="40" cy="40" r="32"></circle>
                                <circle class="radial-fill" cx="40" cy="40" r="32"></circle>
                            </svg>
                            <div class="radial-center-text">
                                <div class="radial-center-val">6,248</div>
                                <div class="radial-center-lbl">Units</div>
                            </div>
                        </div>
                        <div class="categories-list">
                            <div class="category-row">
                                <div class="category-name-group">
                                    <span class="category-dot cat-dot-blue"></span>
                                    <span>Smartphones</span>
                                </div>
                                <span class="category-val">3,640 Unit</span>
                            </div>
                            <div class="category-row">
                                <div class="category-name-group">
                                    <span class="category-dot cat-dot-purple"></span>
                                    <span>Laptops & PC</span>
                                </div>
                                <span class="category-val">750 Unit</span>
                            </div>
                            <div class="category-row">
                                <div class="category-name-group">
                                    <span class="category-dot cat-dot-gray"></span>
                                    <span>Accessories</span>
                                </div>
                                <span class="category-val">1,849 Unit</span>
                            </div>
                        </div>
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
