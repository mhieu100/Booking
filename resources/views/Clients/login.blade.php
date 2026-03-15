<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập / Đăng ký | Go Viet</title>

    <link rel="stylesheet" href="{{ asset('clients/assets/css/CSS-login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" href="{{ asset('clients/assets/css/CSS-login/style.css') }}">

    <style>
        body {
            background: linear-gradient(rgba(0,0,0,.6), rgba(0,0,0,.6)),
                        url('{{ asset("clients/assets/images/banner/banner.jpg") }}') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Outfit', sans-serif;
        }

        .main {
            padding-top: 150px;
            padding-bottom: 50px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,.4);
            overflow: hidden;
            width: 900px;
            max-width: 95%;
        }

        /* Ẩn mặc định các phần không cần thiết */
        #signup-section, #forgot-section {
            display: none;
        }

        .fade-in {
            animation: fadeIn .5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Styling cho thông báo (Alerts) */
        .alert-container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto 20px auto;
        }

        .alert {
            text-align: center;
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
        }

        .alert-success {
            color: #155724;
            background: #d4edda;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            color: #721c24;
            background: #f8d7da;
            border: 1px solid #f5c6cb;
        }

        .social-login {
            text-align: center;
            margin-top: 20px;
        }

        .social-login a {
            display: inline-block;
            padding: 10px 18px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            margin: 5px;
            font-size: 14px;
            transition: opacity 0.3s;
        }

        .social-login a:hover {
            opacity: 0.8;
        }

        .google { background: #db4437; }
        .facebook { background: #4267B2; }
    </style>
</head>

<body>

    @include('Clients.blocks.header')

    <div class="main">
        <div style="width: 100%; display: flex; flex-direction: column; align-items: center;">
            
            <div class="alert-container">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif
            </div>

            <section class="signup fade-in" id="signup-section">
                <div class="container">
                    <div class="signup-content">
                        <div class="signup-form">
                            <h2 class="form-title">Đăng Ký</h2>
                            <form method="POST" action="{{ route('register.post') }}">
                                @csrf
                                <div class="form-group">
                                    <label><i class="zmdi zmdi-account"></i></label>
                                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Tên người dùng" required>
                                </div>
                                <div class="form-group">
                                    <label><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="pass" placeholder="Mật khẩu" required>
                                </div>
                                <div class="form-group">
                                    <label><i class="zmdi zmdi-lock-outline"></i></label>
                                    <input type="password" name="re_pass" placeholder="Nhập lại mật khẩu" required>
                                </div>
                                <div class="form-group form-button">
                                    <button type="submit" class="form-submit">Đăng ký</button>
                                </div>
                            </form>
                        </div>
                        <div class="signup-image">
                            <figure>
                                <img src="{{ asset('clients/assets/images/logos/login.png') }}" alt="Đăng ký">
                            </figure>
                            <a href="#" class="signup-image-link" id="link-to-signin">Đã có tài khoản? Đăng nhập</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="sign-in fade-in" id="signin-section" style="display: block;">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure>
                                <img src="{{ asset('clients/assets/images/logos/login.png') }}" alt="Đăng nhập">
                            </figure>
                            <a href="#" class="signup-image-link" id="link-to-signup">Chưa có tài khoản? Tạo mới</a>
                        </div>
                        <div class="signin-form">
                            <h2 class="form-title">Đăng Nhập</h2>
                            <form method="POST" action="{{ route('login.post') }}">
                                @csrf
                                <div class="form-group">
                                    <label><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                </div>
                                <div class="form-group">
                                    <label><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" placeholder="Mật khẩu" required>
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" name="remember" id="remember-me">
                                    <label for="remember-me" style="position: relative; top: -2px; margin-left: 5px;">Ghi nhớ đăng nhập</label>
                                </div>
                                <div class="form-group" style="text-align: right;">
                                    <a href="#" id="link-to-forgot" style="color: #666; text-decoration: none; font-size: 14px;">Quên mật khẩu?</a>
                                </div>
                                <div class="form-group form-button">
                                    <button type="submit" class="form-submit">Đăng nhập</button>
                                </div>
                            </form>
                            <div class="social-login">
                                <a href="{{ url('/auth/google') }}" class="google"><i class="zmdi zmdi-google"></i> Google</a>
                                <a href="{{ url('/auth/facebook') }}" class="facebook"><i class="zmdi zmdi-facebook"></i> Facebook</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="sign-in fade-in" id="forgot-section">
                <div class="container">
                    <div class="signin-content">
                        <div class="signin-image">
                            <figure>
                                <img src="{{ asset('clients/assets/images/login/signin-image.jpg') }}" alt="Quên mật khẩu">
                            </figure>
                            <a href="#" class="signup-image-link" id="back-login">Quay lại đăng nhập</a>
                        </div>
                        <div class="signin-form">
                            <h2 class="form-title">Quên Mật Khẩu</h2>
                            <p style="margin-bottom: 20px; color: #666;">Vui lòng nhập email của bạn, chúng tôi sẽ gửi liên kết để đặt lại mật khẩu.</p>
                            <form method="POST" action="{{ route('password.send') }}">
                                @csrf
                                <div class="form-group">
                                    <label><i class="zmdi zmdi-email"></i></label>
                                    <input type="email" name="email" placeholder="Nhập email của bạn" required>
                                </div>
                                <div class="form-group form-button">
                                    <button type="submit" class="form-submit">Gửi link reset</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const signup = document.getElementById('signup-section');
            const signin = document.getElementById('signin-section');
            const forgot = document.getElementById('forgot-section');

            // Hàm dùng chung để chuyển đổi giữa các tab
            function switchTab(showElement) {
                signup.style.display = 'none';
                signin.style.display = 'none';
                forgot.style.display = 'none';
                showElement.style.display = 'block';
            }

            // Xử lý giữ form Đăng ký nếu có lỗi validation từ server
            @if ($errors->any() && old('name'))
                switchTab(signup);
            @else
                switchTab(signin); // Mặc định hiển thị Đăng nhập
            @endif

            // Gán sự kiện cho các nút điều hướng
            document.getElementById('link-to-signup').addEventListener('click', function(e) {
                e.preventDefault();
                switchTab(signup);
            });

            document.getElementById('link-to-signin').addEventListener('click', function(e) {
                e.preventDefault();
                switchTab(signin);
            });

            document.getElementById('link-to-forgot').addEventListener('click', function(e) {
                e.preventDefault();
                switchTab(forgot);
            });

            document.getElementById('back-login').addEventListener('click', function(e) {
                e.preventDefault();
                switchTab(signin);
            });
        });
    </script>

</body>
</html>