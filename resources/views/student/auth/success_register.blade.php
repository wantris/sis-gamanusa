
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Registrasi Siswa</title>

  @include('glob_partials.css_assets')
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-8 offset-lg-3 col-xl-6 offset-xl-3">
            <h1 class="text-center">Pendaftaran Akun Berhasil Silahkan Cek Email untuk Informasi Akun</h1>
            <p class="text-center">Kembali ke Halaman <a href="{{route('siswa.auth.login')}}" class="text-primary">Login</a></p>
          </div>
        </div>
      </div>
    </section>
  </div>

  @include('glob_partials.js_asset')

</body>
</html>
