<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Giriş | Sattın Sattın</title>
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
    .social-icon {
      width: 24px;
      height: 24px;
      fill: var(--caramel);
      transition: transform 0.2s ease;
    }
    .social-icon:hover {
      transform: scale(1.1);
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
        </div>

        <!-- Giriş Formu -->
        <div class="card shadow rounded-4">
          <div class="card-body p-4">
            <h2 class="card-title text-center mb-4">Giriş Yap</h2>

            <!-- Hata mesajını burada gösteriyoruz -->
            <?php if (isset($response) && !$response->result): ?>
                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($response->exception) ?>
                </div>
            <?php endif; ?>

            <form method="POST">
              <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <input type="text"
                 class="form-control"
                  id="username"
                   placeholder="Kullanıcı Adınız"
                    name="username"
                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                    >
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password"
                 name="password"
                  class="form-control"
                   id="password"
                    placeholder="••••••••"
                    value="<?= isset($_POST['password']) ? htmlspecialchars($_POST['password']) : '' ?>"
                    >
              </div>

              <button type="submit" class="btn btn-caramel w-100">Giriş Yap</button>
            </form>

            <div class="text-center mt-3">
              <small>Hesabın yok mu? <a href="/auth/register" class="text-caramel fw-semibold">Kayıt Ol</a></small>
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
</body>
</html>
