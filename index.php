<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eszközleltár rendszer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body class="auth-page login-page">

<nav class="navbar navbar-expand-lg landing-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold text-white" href="index.php">IrodaTÁR</a>
        <div class="ms-auto d-flex gap-2">
            <a href="rolunk.php" class="btn btn-outline-light btn-sm px-4">Rólunk</a>
            <a href="#kapcsolat.php" class="btn btn-light btn-sm px-4">Kapcsolat</a>
        </div>
    </div>
</nav>

<section class="hero-landing">
    <div class="container">
        <div class="row align-items-center min-vh-100 py-5">

            <div class="col-lg-6 text-white mb-5 mb-lg-0">
                <span class="brand-badge mb-3">Eszköznyilvántartó rendszer</span>
                <h1 class="hero-title mt-3">Leltár rendszer egyszerűen és átláthatóan</h1>
                <p class="hero-text mt-4">
                    Ez a webalkalmazás lehetővé teszi eszközök nyilvántartását, új elemek felvételét, módosítását és törlését egy biztonságos, felhasználói belépéshez kötött rendszerben.
                    
                </p>

                <div class="row g-3 mt-4">
                    <div class="col-md-6">
                        <div class="info-mini-card">
                            <h5>Felhasználókezelés</h5>
                            <p>Regisztráció és bejelentkezés biztonságos jelszókezeléssel.</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-mini-card">
                            <h5>Eszközkezelés</h5>
                            <p>Új eszközök felvétele, módosítása, törlése és listázása.</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6" id="regisztracio">
                <div class="auth-card overflow-hidden">
                    <div class="row g-0">
                        <div class="col-12 bg-white p-4 p-md-5">
                            <div class="form-box w-100">
                                <h3 class="form-title mb-3 text-center">Regisztráció</h3>
                                <p class="text-muted text-center mb-4">
                                    Hozz létre egy fiókot az eszközleltár rendszer használatához.
                                </p>

                                <form id="regForm">
                                    <input type="text" id="regUser" class="form-control custom-input mb-3" placeholder="Felhasználónév" required>
                                    <input type="password" id="regPass" class="form-control custom-input mb-3" placeholder="Jelszó" required>

                                    <button type="submit" class="btn custom-btn w-100 mt-2">Regisztráció</button>
                                </form>

                                <div id="regMessage" class="mt-3 text-center"></div>

                                <div class="mt-4 text-center border-top pt-3">
                                    <p class="small text-muted mb-0">
                                        Már van fiókod? <a href="login.php" class="custom-link">Jelentkezz be!</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="feature-section py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">A rendszer fő funkciói</h2>
            <p class="section-text">
                Az alkalmazás célja egy egyszerű eszköznyilvántartó rendszer bemutatása.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <h4>Regisztráció/Bejelentkezés</h4>
                    <p>Leltáradataihoz csak az illetékes felhasználók férhetnek hozzá.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <h4>Eszköznyilvántartó alalkalmazás</h4>
                    <p>Az adminisztrációs felületen új eszközök vehetők fel, módosíthatók és törölhetők.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card h-100">
                    <h4>Aloldalak</h4>
                    <p>A főoldal felső menüsoráról elnavigál egy bemutatkozó, illetve egy kapcsolatfelvételi aloldalra.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="landing-footer">
    <div class="container text-center">
        <p class="mb-0">Készítette: Tok Balázs OAJWPH & Verebély Annamária JA67IY</p>
    </div>
</footer>

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