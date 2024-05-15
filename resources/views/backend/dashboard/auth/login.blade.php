<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/font-awesome/css/fontawesome-all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/adminlte.min.css') }}">
    <title>Halaman Login</title>
</head>
<body style="background-color: #eeeeee">
    <main role="main" class="container">
        <div class="row" style="height: 657px;">
            <div class="col-md-5 mx-auto my-auto">
                <div class="card">
                        <h1 class="text-center py-3 text-success">Login</h1>
                    <div class="card-body">
                        <form action="{{ url('admin/login') }}" method="post">
                            @csrf
                            <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="email" placeholder="Email..."
                            class="form-username form-control no-border ft0" id="form-username" value="" pattern=".{2,40}"
                            required title="2 to 40 characters" maxlength="40">

                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" placeholder="Kata Sandi..."
                            class="form-password form-control no-border ft0" id="form-password" pattern=".{2,30}" required
                            title="2 to 30 characters" maxlength="30">
                    </div>
                            {{-- <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" placeholder="Email..." required autofocus>
                              </div>
                              <div class="form-group">
                                  <label for="">Password</label>
                                  <input type="password" class="form-control" placeholder="password..." required>
                              </div> --}}
                              <button type="submit" class="btn btn-success" style="width: 100%">Masuk</button>
                          </form>
                        </div>
                        <center>
                            <span class="card-text">Lupa Password Anda ?</span>
                            <p>Klik <a href="{{ url('password/reset') }}">disini Untuk Reset Password</a></p>
                        </center>
                  </div>
            </div>
        </div>
      </main>
      <script src="{{ asset('ayokulakan/js/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/jQuery/jquery.form.min.js') }}"></script>
</body>
</html>