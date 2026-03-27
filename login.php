<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-center">
    <div class="container mt-5" style="max-width: 400px;">
        <h3>Bejelentkezés</h3>
        <form id="loginForm" class="card p-4 shadow-sm">
            <input type="text" id="logUser" class="form-control mb-2" placeholder="Felhasználónév" required>
            <input type="password" id="logPass" class="form-control mb-2" placeholder="Jelszó" required>
            <button type="submit" class="btn btn-success w-100">Belépés</button>
            <div id="loginMsg" class="mt-2"></div>
        </form>
    </div>

    <script>
    document.getElementById('loginForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const fd = new FormData();
        fd.append('username', document.getElementById('logUser').value);
        fd.append('password', document.getElementById('logPass').value);

        const res = await fetch('api/login.php', { method: 'POST', body: fd });
        const data = await res.json();

        if (data.success) {
            window.location.href = 'dashboard.php';
        } else {
            document.getElementById('loginMsg').innerHTML = `<p class="text-danger">${data.message}</p>`;
        }
    });
    </script>
</body>
</html>