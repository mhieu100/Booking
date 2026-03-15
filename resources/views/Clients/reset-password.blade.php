<!DOCTYPE html>

<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password | Go Viet</title>

<link rel="stylesheet" href="{{ asset('clients/assets/css/CSS-login/fonts/material-icon/css/material-design-iconic-font.min.css') }}">

<style>

body{
margin:0;
font-family:'Outfit',sans-serif;
background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)),
url('{{ asset("clients/assets/images/banner/banner.jpg") }}') no-repeat center center fixed;
background-size:cover;
}

/* wrapper */
.reset-wrapper{
min-height:80vh;
display:flex;
align-items:center;
justify-content:center;
padding-top:120px;
padding-bottom:80px;
}

/* box */
.container{
background:#fff;
border-radius:15px;
box-shadow:0 15px 40px rgba(0,0,0,.4);
width:420px;
padding:40px;
text-align:center;
animation:fadeIn .5s ease;
}

h2{
margin-bottom:25px;
}

/* form */
.form-group{
position:relative;
margin-bottom:20px;
}

.form-group input{
width:100%;
padding:12px 12px 12px 40px;
border:1px solid #ddd;
border-radius:6px;
outline:none;
font-size:14px;
}

.form-group i{
position:absolute;
left:10px;
top:50%;
transform:translateY(-50%);
color:#666;
}

/* button */
button{
width:100%;
padding:12px;
border:none;
background:#0d6efd;
color:white;
font-size:15px;
border-radius:6px;
cursor:pointer;
transition:.3s;
}

button:hover{
background:#084298;
}

/* alerts */
.alert{
margin-bottom:20px;
padding:10px;
border-radius:6px;
font-size:14px;
}

.alert-error{
background:#f8d7da;
color:#721c24;
}

.alert-success{
background:#d4edda;
color:#155724;
}

.text-danger{
color:#dc3545;
font-size:13px;
display:block;
margin-top:5px;
}

/* link */
.back-login{
margin-top:15px;
display:block;
font-size:14px;
color:#0d6efd;
text-decoration:none;
}

/* animation */
@keyframes fadeIn{
from{opacity:0;transform:translateY(-20px)}
to{opacity:1;transform:translateY(0)}
}

</style>

</head>

<body>

@include('Clients.blocks.header')

<div class="reset-wrapper">

<div class="container">

<h2>Đặt lại mật khẩu</h2>

@if(session('success'))

<div class="alert alert-success">
{{ session('success') }}
</div>
@endif

@if($errors->any())

<div class="alert alert-error">
@foreach ($errors->all() as $error)
<div>{{ $error }}</div>
@endforeach
</div>
@endif

<form method="POST" action="{{ route('password.update') }}">
@csrf

<input type="hidden" name="token" value="{{ $token }}">

<div class="form-group">
<i class="zmdi zmdi-lock"></i>
<input type="password" name="password" placeholder="Mật khẩu mới">
@error('password')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

<div class="form-group">
<i class="zmdi zmdi-lock-outline"></i>
<input type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu">
</div>

<button type="submit">
Đổi mật khẩu
</button>

</form>

<a href="/login" class="back-login">
← Quay lại đăng nhập
</a>

</div>

</div>


</body>
</html>
