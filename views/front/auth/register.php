<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kayıt Ol | Sattın Sattın</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    :root {
      --caramel: #8b5e3c;
      --caramel-dark: #6b3c1f;
      --caramel-light: #fef9f4;
    }
    body {
      background: linear-gradient(to bottom right, var(--caramel-light), #d6b89c);
      min-height: 100vh;
    }
    .btn-caramel {
      background-color: var(--caramel);
      color: white;
    }
    .btn-caramel:hover {
      background-color: var(--caramel-dark);
    }
    .text-caramel {
      color: var(--caramel);
    }
    .form-control:focus {
      border-color: var(--caramel);
      box-shadow: 0 0 0 0.2rem rgba(139, 94, 60, 0.25);
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center">

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-6">

        <!-- Başlık -->
        <div class="text-center mb-4 bg-caramel text-white p-3 rounded-4 shadow" style="background-color: var(--caramel);">
          <h1 class="fw-bold">Sattın Sattın</h1>
          <div class="form-text text-muted"></div>
        </div>
        <!-- Kayıt Formu -->
        <div class="card shadow rounded-4">
          <div class="card-body p-4">
            <h2 class="card-title text-center mb-4">Kayıt Ol</h2>

            <form method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Kullanıcı Adınız">
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">E-posta</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="ornek@mail.com">
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="••••••••">
                <div class="form-text text-muted">Şifreniz en az 8 karakter ve en az bir rakam içermelidir.</div>
              </div>

              <button type="submit" class="btn btn-caramel w-100">Kayıt Ol</button>
            </form>

            <div class="text-center mt-3">
              <small>Zaten hesabın var mı? <a href="/auth/login" class="text-caramel fw-semibold">Giriş Yap</a></small>
            </div>
          </div>
        </div>

        <!-- Sosyal Medya -->
        <div class="text-center mt-4 d-flex justify-content-center gap-4">
        <a href="https://instagram.com" class="me-3" target="_blank">
            <img src="https://cdn-icons-png.flaticon.com/24/174/174855.png" alt="Instagram">
          </a>

          <a href="https://twitter.com" target="_blank" aria-label="Twitter">
            <img src="https://cdn-icons-png.flaticon.com/24/733/733579.png" alt="Twitter">
          </a>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Şifre kontrolü (client-side)
    document.querySelector("form").addEventListener("submit", function (e) {
      const passwordInput = document.getElementById("password");
      const password = passwordInput.value;
      const existingError = document.getElementById("password-error");
      if (existingError) existingError.remove();

      if (password.length < 8 || !/\d/.test(password)) {
        e.preventDefault();
        const div = document.createElement("div");
        div.className = "text-danger mt-2";
        div.id = "password-error";
        div.innerText = "Şifre en az 8 karakter olmalı ve en az bir rakam içermelidir.";
        passwordInput.parentNode.appendChild(div);
      }
    });
  </script>
</body>
</html>
