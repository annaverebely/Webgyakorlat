<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="login-page auth-page">

<div class="container auth-wrapper d-flex align-items-center justify-content-center">
    <div class="auth-card login-card-simple p-4">

        <div class="form-box">
            <h3 class="form-title text-center mb-3">Bejelentkezés</h3>

            <form id="loginForm">
                <input type="text" id="logUser" class="form-control custom-input mb-3" placeholder="Felhasználónév" required>
                <input type="password" id="logPass" class="form-control custom-input mb-3" placeholder="Jelszó" required>

                <button type="submit" class="btn custom-btn w-100">Belépés</button>
            </form>

            <div id="loginMsg" class="mt-3 text-center"></div>

            <div class="text-center mt-3">
                <a href="index.php#regisztracio" class="custom-link">Regisztráció</a>
            </div>
        </div>

    </div>
</div>

    <script>
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const fd = new FormData();
        fd.append('username', document.getElementById('logUser').value);
        fd.append('password', document.getElementById('logPass').value);

        try {
            const res = await fetch('api/login.php', { method: 'POST', body: fd });
            const data = await res.json();

            if (data.success) {
                window.location.href = 'dashboard.php';
            } else {
                const msgDiv = document.getElementById('loginMsg');
                msgDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        } catch (error) {
            console.error("Hiba:", error);
        }
    });
    </script>
</body>
</html>