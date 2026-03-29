<?php
// 1. Biztonsági ellenőrzés - CSAK bejelentkezett felhasználó láthatja
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Eszközleltár - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-dark bg-dark mb-4">
        <div class="container">
            <span class="navbar-brand">Leltár Rendszer</span>
            <span class="text-white">Üdv, <?php echo $_SESSION['username']; ?>! | <a href="logout.php" class="btn btn-outline-danger btn-sm">Kilépés</a></span>
        </div>
    </nav>

    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body">

<div class="card shadow-sm mb-4">
    <div class="card-body">
        <h4 class="card-title">Új eszköz hozzáadása</h4>
       <form id="addItemForm" class="row g-2">
    <input type="hidden" id="itemId"> <div class="col-md-4">
        <input type="text" id="itemName" class="form-control" placeholder="Eszköz neve" required>
    </div>
    <div class="col-md-3">
        <input type="text" id="itemCategory" class="form-control" placeholder="Kategória" required>
    </div>
    <div class="col-md-2">
        <input type="number" id="itemQuantity" class="form-control" placeholder="Darab" required>
    </div>
    <div class="col-md-3">
        <button type="submit" id="submitBtn" class="btn btn-primary w-100">Hozzáadás</button>
    </div>
</form>
        <div id="addMessage" class="mt-2"></div>
    </div>
</div>

                <h2 class="card-title">Aktuális Eszközök</h2>
                
                <table class="table table-hover mt-3">
                    <thead class="table-dark">
                        <tr>
                            <th>Név</th>
                            <th>Kategória</th>
                            <th>Mennyiség</th>
                            <th>Állapot</th>
                            <th>Műveletek</th>
                        </tr>
                    </thead>
                    <tbody id="inventoryTable">
                        <tr><td colspan="4" class="text-center">Betöltés...</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

   <script>
async function loadInventory() {
    try {
        const response = await fetch('api/get_items.php');
        const items = await response.json();
        
        const tbody = document.getElementById('inventoryTable');
        tbody.innerHTML = ''; 

        if(items.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5" class="text-center">Nincs még eszköz a leltárban.</td></tr>';
            return;
        }

        items.forEach(item => {
            tbody.innerHTML += `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.category}</td>
                    <td>${item.quantity} db</td>
                    <td><span class="badge bg-success">${item.status}</span></td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick='editItem(${JSON.stringify(item)})'>Módosítás</button>
                        <button class="btn btn-danger btn-sm" onclick="deleteItem(${item.id})">Törlés</button>
                    </td>
                </tr>`;
        });
    } catch (error) {
        console.error("Hiba az adatok lekérésekor:", error);
    }
}

// EGYSÉGESÍTETT BEKÜLDÉS (Hozzáadás ÉS Módosítás egyben)
document.getElementById('addItemForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const idValue = document.getElementById('itemId').value;
    const fd = new FormData();
    fd.append('name', document.getElementById('itemName').value);
    fd.append('category', document.getElementById('itemCategory').value);
    fd.append('quantity', document.getElementById('itemQuantity').value);

    // Eldöntjük, melyik API-t hívjuk
    let apiUrl = 'api/add_item.php';
    if (idValue && idValue !== "") {
        fd.append('id', idValue);
        apiUrl = 'api/update_item.php';
    }

    try {
        const res = await fetch(apiUrl, { method: 'POST', body: fd });
        const result = await res.json();

        if (result.success) {
            // Form alaphelyzetbe állítása
            this.reset();
            document.getElementById('itemId').value = "";
            document.getElementById('submitBtn').innerText = "Hozzáadás";
            document.getElementById('submitBtn').className = "btn btn-primary w-100";
            
            loadInventory(); // Táblázat frissítése
        } else {
            alert("Hiba: " + result.message);
        }
    } catch (err) {
        console.error("Szerver hiba:", err);
    }
});

async function deleteItem(id) {
    if (!confirm("Biztosan törölni szeretnéd ezt az eszközt?")) return;
    const fd = new FormData();
    fd.append('id', id);
    try {
        const res = await fetch('api/delete_item.php', { method: 'POST', body: fd });
        const result = await res.json();
        if (result.success) loadInventory();
    } catch (error) {
        console.error("Hiba a törlés során:", error);
    }
}

function editItem(item) {
    document.getElementById('itemId').value = item.id;
    document.getElementById('itemName').value = item.name;
    document.getElementById('itemCategory').value = item.category;
    document.getElementById('itemQuantity').value = item.quantity;
    
    document.getElementById('submitBtn').innerText = "Mentés";
    document.getElementById('submitBtn').className = "btn btn-success w-100";
    
    // Felugrunk az oldal tetejére, hogy lássuk az űrlapot
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

window.onload = loadInventory;
</script>
</body>
</html>