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
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Today's Orders
                    </div>
                    <div class="card-body">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>
            </div>
            <!-- Pie Chart -->
            {{-- <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Total Orders
                    </div>
                    <div class="card-body">
                        <canvas id="chartjs-doughnut"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Total Orders
                    </div>
                    <div class="card-body">
                        <canvas id="segmentChart"></canvas>
                    </div>
                </div>
            </div> --}}
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
                        Today's Daily Orders Report
                    </div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Hydrant</th>
                                    <th>Commercial</th>
                                    <th>GPS ONLINE</th>
                                    <th>DC Quota</th>
                                    <th>GPS BILLING</th>
                                    <th>GPS CARE OFF</th>
                                    <th>PAK RANGER</th>
                                    <th>Total Orders</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($results as $row)
                                    <tr>
                                        <td>{{ $row->HYDRANT }}</td>
                                        <td>{{ $row->commercial }}</td>
                                        <td>{{ $row->GPS_ONLINE }}</td>
                                        <td>{{ $row->DC }}</td>
                                        <td>{{ $row->GPS_BILLING }}</td>
                                        <td>{{ $row->GPS_CARE_OFF }}</td>
                                        <td>{{ $row->PAK_RANGER }}</td>
                                        <td>{{ $row->total_orders }}</td>
                                    </tr>
                                @endforeach
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
            const todayOrdersCounts = @json($hydrants->pluck('todayOrdersCount'));
            const ordersCounts = @json($hydrants->pluck('ordersCount'));
            const revenueCtx = document.getElementById('revenueChart').getContext('2d');
            const revenueChart = new Chart(revenueCtx, {
                type: 'bar',
                data: {
                    labels: hydrantNames,
                    datasets: [{
                        label: 'Today Orders Count',
                        data: todayOrdersCounts,
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

            // const doghnutCTX = document.getElementById("chartjs-doughnut").getContext('2d')
            // const doghnutChart = new Chart(doghnutCTX, {
            //     type: "doughnut",
            //     data: {
            //         labels: hydrantNames,
            //         datasets: [{
            //             data: ordersCounts,
            //             backgroundColor: backgroundColors,
            //             borderColor: "transparent"
            //         }]
            //     },
            //     options: {
            //         maintainAspectRatio: false,
            //         cutoutPercentage: 65,
            //     }
            // });
        </script>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@endsection
