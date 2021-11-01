
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
            <div class="login-brand">
              <h4 class="">SIS Gamanusa</h4>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Registrasi Siswa</h4></div>

              <div class="card-body">
                <form method="POST" action="{{route('siswa.auth.register.post')}}" class="needs-validation">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">Nama Lengkap</label>
                                <input id="username" type="text" class="form-control" name="fullname" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                Please fill in your fullname
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                Please fill in your email
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Nomor Telepon</label>
                                <input id="phone" type="text" class="form-control" name="phone" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                Please fill in your phone
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Tempat Lahir</label>
                                <input id="email" type="text" class="form-control" name="place" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                Please fill in your place of birth
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Tanggal Lahir</label>
                                <input id="phone" type="date" class="form-control" name="date" tabindex="1" required autofocus>
                                <div class="invalid-feedback">
                                Please fill in your date of birth
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Jenis Kelamin</label>
                                <select name="gender" class="form-control" id="">
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <div class="invalid-feedback">
                                Please fill in your gender
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="email">Alamat</label>
                                <textarea name="address" id="" cols="30" rows="10" class="form-control"></textarea>
                                <div class="invalid-feedback">
                                Please fill in your date of address
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                            Daftar
                        </button>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  @include('glob_partials.js_asset')

</body>
</html>
