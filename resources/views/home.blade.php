@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@if (auth()->user()->role != 1)

<h1 class="text-danger"><strong> SITE UNDER CONSTRUCTION</strong></h1>
    
@else


<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    .card-header {
        background-color: #6f42c1;
        color: #fff;
        padding: 10px;
        border-bottom: 0;
        border-radius: 10px 10px 0 0;
    }
    .card-body {
        padding: 20px;
    }
    .summary-card {
        padding: 15px;
        border-radius: 10px;
        color: white;
        text-align: center;
    }
    .summary-card h2 {
        font-size: 2.5rem;
    }
</style>
<div class="row">
    <!-- Summary Cards -->
    <div class="col-md-3">
        <div class="summary-card bg-primary">
            <h2>101.1K</h2>
            <p>Downloads</p>
            <small>+3% from last month</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="summary-card bg-warning">
            <h2>12.2K</h2>
            <p>Purchases</p>
            <small>+3% from last month</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="summary-card bg-danger">
            <h2>5.3K</h2>
            <p>Customers</p>
            <small>+3% from last month</small>
        </div>
    </div>
    <div class="col-md-3">
        <div class="summary-card bg-success">
            <h2>7</h2>
            <p>Channels</p>
            <small>+3% from last month</small>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Revenue Breakdown Chart -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Revenue Breakdown
            </div>
            <div class="card-body">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>
    </div>
    <!-- Pie Chart -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Segments
            </div>
            <div class="card-body">
                <canvas id="segmentChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- <div class="row mt-4">
    <!-- Privacy Suggestions -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Privacy Suggestions</h5>
                <p>Take our privacy checkup to choose which settings are right for you.</p>
                <a href="#" class="btn btn-primary">Review suggestions (4)</a>
            </div>
        </div>
    </div>
    <!-- Account Storage -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5>Account Storage</h5>
                <p>Your account storage is shared across all devices.</p>
                <p>10 GB of 30 GB used</p>
                <a href="#" class="btn btn-secondary">Manage storage</a>
            </div>
        </div>
    </div>
</div> --}}

<div class="row mt-4">
    <!-- Orders Table -->
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Orders
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Ext.</th>
                            <th>City</th>
                            <th>Start Date</th>
                            <th>Completion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add table rows here -->
                    </tbody>
                </table>
                <nav>
                    <ul class="pagination justify-content-end">
                        <!-- Pagination items -->
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<script>
    // Revenue Chart
    const hydrantNames = @json($hydrants->pluck('name'));
    const ordersCounts = @json($hydrants->pluck('todayOrdersCount'));
    const revenueCtx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(revenueCtx, {
        type: 'bar',
        data: {
            labels: hydrantNames,
            datasets: [{
                label: 'Orders Count',
                data: ordersCounts,
                backgroundColor: 'rgba(99, 102, 241, 0.7)',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Segment Chart (Pie)
    const segmentCtx = document.getElementById('segmentChart').getContext('2d');
    const segmentChart = new Chart(segmentCtx, {
        type: 'pie',
        data: {
            labels: ['Alpha', 'Beta', 'Gamma', 'Delta'],
            datasets: [{
                data: [40, 25, 20, 15],
                backgroundColor: ['#3b82f6', '#f97316', '#ef4444', '#10b981']
            }]
        },
        options: {
            responsive: true
        }
    });
</script>    
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
