<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">AgroÉlevage</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('animals.index') }}">Animaux</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('parcelles.index') }}">Parcelles</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('alimentation.index') }}">Alimentation</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('cultures.index') }}">Cultures</a></li>
      </ul>
    </div>
  </div>
</nav>
