@extends('layouts.app')

@section('content')
<div id="dashboardContainer" class="container-fluid py-4">
    <h3 class="mb-4 fw-bold text-center text-uppercase" style="letter-spacing: 2px;">🌱 DIAWARA TECH AGRO-ÉLEVAGE 🐄</h3>

    {{-- 1. ALERTES --}}
    @if(count($alertes) > 0)
    <div class="row mb-4">
        <div class="col-12 text-center">
            @foreach($alertes as $alerte)
                <span class="badge bg-white text-dark border shadow-sm p-2 mb-1">{{ $alerte['icon'] }} {{ $alerte['message'] }}</span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- 2. INDICATEURS DE PERFORMANCE (Naissances, Récoltes, Bénéfices) --}}
    <h5 class="fw-bold mb-3 text-uppercase" style="color: #2c3e50;"><i class="bi bi-speedometer2 me-2"></i> Performances & Vitalité</h5>
    <div class="row g-3 mb-4 text-center">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted small fw-bold">VITALITÉ (MOIS)</h6>
                    <div class="d-flex justify-content-center gap-4 mt-2">
                        <span class="text-success fw-bold fs-4">👶 {{ $naissances }}</span>
                        <span class="text-danger fw-bold fs-4">💀 {{ $deces }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body">
                    <h6 class="text-muted small fw-bold">RÉCOLTES TOTALES</h6>
                    <h3 class="fw-bold text-dark mb-0">🌾 {{ number_format($totalRecolte, 1) }} kg</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded-4 bg-success text-white">
                <div class="card-body">
                    <h6 class="small fw-bold opacity-75">BÉNÉFICE NET</h6>
                    <h3 class="fw-bold mb-0 mt-1">{{ number_format($beneficeNet, 0, ',', ' ') }} F CFA</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- 3. PÔLE ÉLEVAGE --}}
    <h5 class="fw-bold mb-3 text-uppercase" style="color: #2D3748;"><i class="bi bi-gender-ambiguous me-2"></i> Pôle Élevage</h5>
    <div class="row g-3 mb-4">
        @foreach($cards['elevage'] as $card)
            <div class="col-md-3">
                <div class="card shadow-sm border-0 h-100 text-center text-white" style="background-color: {{ $card['color'] }}; border-radius:1rem;">
                    <div class="card-body p-3">
                        <div class="fs-2 mb-1">{{ $card['icon'] }}</div>
                        <h6 class="small text-uppercase fw-bold opacity-75">{{ $card['title'] }}</h6>
                        <h3 class="fw-bold mb-0">{{ $card['count'] }}</h3>
                        <a href="{{ route($card['route']) }}" class="btn btn-link btn-sm text-white text-decoration-none mt-1 small">Gérer →</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 4. PÔLE AGRICULTURE --}}
    <h5 class="fw-bold mb-3 text-uppercase" style="color: #2D3748;"><i class="bi bi-tree me-2"></i> Pôle Agriculture</h5>
    <div class="row g-3 mb-4 text-center">
        @foreach($cards['agriculture'] as $card)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 text-white" style="background-color: {{ $card['color'] }}; border-radius:1rem;">
                    <div class="card-body p-3">
                        <div class="fs-2 mb-1">{{ $card['icon'] }}</div>
                        <h6 class="small text-uppercase fw-bold opacity-75">{{ $card['title'] }}</h6>
                        <h3 class="fw-bold mb-0">{{ $card['count'] }}</h3>
                        <a href="{{ route($card['route']) }}" class="btn btn-link btn-sm text-white text-decoration-none mt-1 small">Gérer →</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- 5. GRAPHIQUE, STOCKS & AGENDA --}}
    <div class="row g-4">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-4 p-3 mb-4 bg-white">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold mb-0">Répartition des Ressources</h5>
                    <span class="badge bg-primary rounded-pill">Optimisation: {{ $optimisationScore }}%</span>
                </div>
                <div style="height:350px;"><canvas id="chartGlobal"></canvas></div>
            </div>
            
            <div class="card shadow-sm border-0 rounded-4 p-3 bg-white">
                <h6 class="text-muted small fw-bold text-uppercase mb-3">📦 Alertes Stocks Critique</h6>
                @forelse(array_slice($stocksCritiques, 0, 4) as $stock)
                    <div class="d-flex justify-content-between border-bottom py-2 small">
                        <span>{{ $stock->nom }}</span>
                        <span class="text-danger fw-bold">{{ $stock->quantite }} restant</span>
                    </div>
                @empty
                    <p class="text-success small mb-0"><i class="bi bi-check-circle me-1"></i> Stocks opérationnels.</p>
                @endforelse
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow border-0 rounded-4 h-100 overflow-hidden bg-white">
                <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center border-0">
                    <h6 class="fw-bold mb-0">PLANIFICATION</h6>
                    <button class="btn btn-primary btn-sm rounded-circle" data-bs-toggle="modal" data-bs-target="#addTaskModal"><i class="bi bi-plus"></i></button>
                </div>
                <div class="card-body bg-light" style="max-height: 500px; overflow-y: auto;">
                    @forelse($tasks as $task)
                        <div class="p-3 mb-2 bg-white rounded shadow-sm border-start border-4 @if($task->priorite == 'haute') border-danger @else border-primary @endif">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-0 fw-bold small text-dark">{{ $task->titre }}</p>
                                    <small class="text-muted"><i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($task->date_echeance)->format('d/m/Y') }}</small>
                                </div>
                                <form action="{{ route('tasks.complete', $task->id) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="btn btn-sm btn-outline-success rounded-circle"><i class="bi bi-check"></i></button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-muted py-5 small">Aucune tâche active.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL --}}
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content border-0 shadow rounded-4" action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <div class="modal-header bg-primary text-white border-0">
                <h6 class="modal-title fw-bold">Nouveaux travaux</h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><label class="form-label small fw-bold">Intitulé</label><input type="text" name="titre" class="form-control" required></div>
                <div class="mb-3"><label class="form-label small fw-bold">Date</label><input type="date" name="date_echeance" class="form-control" value="{{ date('Y-m-d') }}" required></div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">Priorité</label>
                    <select name="priorite" class="form-select">
                        <option value="moyenne">Moyenne</option>
                        <option value="haute">Haute</option>
                        <option value="basse">Basse</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="submit" class="btn btn-primary w-100 rounded-3">Enregistrer</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('chartGlobal').getContext('2d');
    const graphData = @json($graphData);
    const totalCount = graphData.reduce((sum, item) => sum + item.count, 0);

    new Chart(ctx, {
        type: 'pie',
        plugins: [ChartDataLabels],
        data: {
            labels: graphData.map(d => d.label),
            datasets: [{
                data: graphData.map(d => d.count),
                backgroundColor: graphData.map(d => d.color),
                borderColor: '#fff',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 10 } } },
                datalabels: {
                    color: '#fff',
                    font: { weight: 'bold', size: 10 },
                    formatter: (val) => totalCount > 0 ? ((val*100)/totalCount).toFixed(1)+'%' : ''
                }
            }
        }
    });
});
</script>
@endpush
