<!doctype html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Regisztráció</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5" style="max-width: 400px;">
    <div class="card shadow-sm p-4">
        <h3 class="text-center mb-4">Regisztráció</h3>
        
        <form id="regForm">
            <input type="text" id="regUser" class="form-control mb-2" placeholder="Felhasználónév" required>
            <input type="password" id="regPass" class="form-control mb-2" placeholder="Jelszó" required>
            
            <button type="submit" class="btn btn-primary w-100 mt-2">Regisztráció</button>
        </form>
        
        <div id="regMessage" class="mt-3 text-center"></div>

        <div class="mt-4 text-center border-top pt-3">
            <p class="small text-muted mb-0">
                Már van fiókod? <a href="login.php" class="text-primary">Jelentkezz be!</a>
            </p>
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
        
        msgDiv.innerText = result.message;
        msgDiv.className = "alert " + (result.success ? "alert-success" : "alert-danger") + " mt-3";

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