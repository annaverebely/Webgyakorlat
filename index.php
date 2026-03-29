<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regisztráció</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 card p-4 shadow-sm">
            <h3 class="text-center mb-4">Regisztráció</h3>
            <form id="regForm">
                <div class="mb-3">
                    <input type="text" id="regUser" class="form-control" placeholder="Felhasználónév" required>
                </div>
                <div class="mb-3">
                    <input type="password" id="regPass" class="form-control" placeholder="Jelszó" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Regisztráció</button>
            </form>
            
            <div id="regMessage" class="mt-3"></div> 

            <p class="mt-3 text-center small">Már van fiókod? <a href="login.php">Jelentkezz be!</a></p>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.getElementById('regForm').addEventListener('submit', async function(e) {
    e.preventDefault(); 

    const formData = new FormData();
    formData.append('username', document.getElementById('regUser').value);
    formData.append('password', document.getElementById('regPass').value);

    try {
        const response = await fetch('api/register.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json();
        const msgDiv = document.getElementById('regMessage');
        
        // Üzenet megjelenítése
        msgDiv.innerText = result.message;
        msgDiv.className = result.success ? "alert alert-success" : "alert alert-danger";

        // HA SIKERES, ÁTDOBJUK A LOGINRA 1.5 MÁSODPERC MÚLVA
        if (result.success) {
            setTimeout(() => {
                window.location.href = 'login.php';
            }, 1500);
        }

    } catch (error) {
        console.error("Hiba történt:", error);
    }
});
</script>
</body>
</html>