<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bejelentkezés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light"> <div class="container mt-5" style="max-width: 400px;">
        <div class="card shadow-sm p-4">
            <h3 class="text-center mb-4">Bejelentkezés</h3>
            
            <form id="loginForm">
                <input type="text" id="logUser" class="form-control mb-2" placeholder="Felhasználónév" required>
                <input type="password" id="logPass" class="form-control mb-2" placeholder="Jelszó" required>
                
                <button type="submit" class="btn btn-success w-100 mt-2">Belépés</button>
            </form>

            <div id="loginMsg" class="mt-3 text-center"></div>

            <div class="mt-4 text-center border-top pt-3">
                <p class="small text-muted mb-0">
                    Nincs még fiókod? <a href="index.php" class="text-primary">Regisztrálj itt!</a>
                </p>
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