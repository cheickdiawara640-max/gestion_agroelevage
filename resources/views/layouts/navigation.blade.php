<div class="sidebar d-flex flex-column p-3">
    <h4 class="text-center mb-4">🌱 DTAE 🐄</h4>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-1">
            <a href="{{ route('dashboard') }}" class="nav-link text-white">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a class="navbar-brand fw-bold" href="#">
   
        </li>

       @if(auth()->check() && auth()->user()->is_admin)
        <hr class="text-white">
        <li class="nav-item mb-1">
            <a href="{{ route('users.index') }}" class="nav-link text-warning fw-bold">
                <i class="bi bi-people-fill me-2"></i> 👥 Gérer l'équipe
            </a>
        </li>
        <hr class="text-white">
        @endif

        <li class="nav-item mb-1">
            <a href="{{ route('animaux.index') }}" class="nav-link text-white">🐄 Animaux</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('parcelles.index') }}" class="nav-link text-white">🟩 Parcelles</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('cultures.index') }}" class="nav-link text-white">🌾 Cultures</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('recoltes.index') }}" class="nav-link text-white">🧺 Récoltes</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('alimentations.index') }}" class="nav-link text-white">🍽️ Alimentations</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('santes.index') }}" class="nav-link text-white">💊 Santé</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('budgets.index') }}" class="nav-link text-white">💰 Budgets</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('besoins.index') }}" class="nav-link text-white">📦 Besoins</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('personnels.index') }}" class="nav-link text-white">👤 Personnels</a>
        </li>
         <li class="nav-item mb-1">
            <a href="{{ route('traitements.index') }}" class="nav-link text-white">🧪 Traitement</a>
        </li>
        <li class="nav-item mb-1">
            <a href="{{ route('ventes.index') }}" class="nav-link text-white">💲 Ventes</a> 
        </li>
    </ul>

    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-2"></i>
            <strong>{{ auth()->check() ? auth()->user()->name : 'Invité' }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            @if(auth()->check())
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="dropdown-item w-100 text-start text-danger">
                        <i class="bi bi-box-arrow-right me-2"></i> Déconnexion
                    </button>
                </form>
            </li>
            @else
            <li><a class="dropdown-item" href="{{ route('login') }}">Connexion</a></li>
            @endif
        </ul>
    </div>
</div>