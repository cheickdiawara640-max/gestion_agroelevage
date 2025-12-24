<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diawara Tech - Gestion Agro-Élevage</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }
        .app-card {
            border: none;
            border-radius: 15px;
            transition: transform 0.2s;
        }
        .app-card:active {
            transform: scale(0.95);
        }
        .header-bg {
            background: linear-gradient(135deg, #198754, #145c32);
            color: white;
            padding: 30px 20px;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="header-bg shadow-sm">
        <h2 class="fw-bold mb-0">Diawara Tech 🌾</h2>
        <p class="small opacity-75">Gestion d'Élevage & Agriculture</p>
    </div>

    <div class="container">
        <div class="row mb-4">
            <div class="col-12 text-center text-md-start">
                <h5 class="fw-semibold">Tableau de bord</h5>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-6">
                <div class="card app-card shadow-sm text-center p-3 h-100">
                    <div class="display-6 mb-2">🐄</div>
                    <h6 class="fw-bold">Bétails</h6>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>
            
            <div class="col-6">
                <div class="card app-card shadow-sm text-center p-3 h-100">
                    <div class="display-6 mb-2">🌽</div>
                    <h6 class="fw-bold">Cultures</h6>
                    <a href="#" class="stretched-link"></a>
                </div>
            </div>

            <div class="col-12">
                <div class="card app-card shadow-sm p-4 d-flex flex-row align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="fs-2 me-3">📦</span>
                        <div>
                            <h6 class="mb-0 fw-bold">Stock & Alimentation</h6>
                            <small class="text-muted">Gérer l'inventaire</small>
                        </div>
                    </div>
                    <span class="badge bg-success rounded-pill">12 Alertes</span>
                </div>
            </div>
        </div>

        <div class="mt-5 pt-3">
            <button class="btn btn-success w-100 py-3 rounded-pill shadow fw-bold">
                + Enregistrer une donnée
            </button>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>