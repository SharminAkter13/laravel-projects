@extends('master')

@section('page')
<div class="header pb-8 pt-8 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
          <div class="row">
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Job Views</h5>
                      <span class="h2 font-weight-bold mb-0">{{ number_format($totalJobViews) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                        <i class="fas fa-chart-bar"></i>
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    {{-- This card now shows all-time or 30-day traffic for simplicity. Percent change logic can be added later. --}}
                    <span class="text-nowrap">Across all your job postings</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">New Applications</h5>
                      <span class="h2 font-weight-bold mb-0">{{ number_format($newApplicationsCount) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                        <i class="fas fa-file-alt"></i> {{-- Changed from chart-pie to file-alt for applications --}}
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    <span class="text-{{ $applicationChangeType == 'up' ? 'success' : 'danger' }} mr-2">
                        <i class="fas fa-arrow-{{ $applicationChangeType }}"></i> {{ $applicationChange ?? 'default_value' }}
                    </span>
                    <span class="text-nowrap">Since last week</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Jobs Posted</h5>
                      <span class="h2 font-weight-bold mb-0">{{ number_format($totalJobsPosted) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                        <i class="fas fa-briefcase"></i> {{-- Changed from users to briefcase for jobs --}}
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    {{-- Percent change logic is complex, keeping text simple for now --}}
                    <span class="text-nowrap">Total active and closed jobs</span>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6">
              <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                  <div class="row">
                    <div class="col">
                      <h5 class="card-title text-uppercase text-muted mb-0">Total Candidates Applied</h5>
                      <span class="h2 font-weight-bold mb-0">{{ number_format($totalCandidatesApplied) }}</span>
                    </div>
                    <div class="col-auto">
                      <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                        <i class="fas fa-users"></i> {{-- Changed from percent to users --}}
                      </div>
                    </div>
                  </div>
                  <p class="mt-3 mb-0 text-muted text-sm">
                    {{-- Percent change logic is complex, keeping text simple for now --}}
                    <span class="text-nowrap">Unique candidates across all jobs</span>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <div class="row">
        <div class="col-xl-8 mb-5 mb-xl-0">
          <div class="card bg-gradient-default shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                  <h2 class="text-white mb-0">Applications Overview</h2>
                </div>
                <div class="col">
                  <ul class="nav nav-pills justify-content-end">
                    {{-- Monthly Data Tab --}}
                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":{!! $monthlyAppData !!}}]}}'>
                      <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                        <span class="d-none d-md-block">Month</span>
                        <span class="d-md-none">M</span>
                      </a>
                    </li>
                    {{-- Weekly Data Tab --}}
                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales" data-update='{"data":{"datasets":[{"data":{!! $weeklyAppData !!}}]}}'>
                      <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                        <span class="d-none d-md-block">Week</span>
                        <span class="d-md-none">W</span>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="chart-sales" class="chart-canvas"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4">
          <div class="card shadow">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">Status Breakdown</h6>
                  <h2 class="mb-0">Total Applications</h2>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0"> {{-- Increased width to 12 columns --}}
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Job Postings Summary</h3>
                </div>
                <div class="col text-right">
                  <a href="{{ url('/employer/jobs') }}" class="btn btn-sm btn-primary">See all jobs</a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Job Title</th>
                    <th scope="col">Total Applications</th>
                    <th scope="col">Unique Views</th>
                    <th scope="col">Total Views</th>
                    <th scope="col">Application Rate</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($jobPerformance as $job)
                  @php
                      $applicationRate = $job->total_views_count > 0 
                          ? round(($job->applications_count / $job->total_views_count) * 100, 2) 
                          : 0;
                      // Simple logic to show a green/red rate
                      $rateColor = $applicationRate >= 10 ? 'success' : 'warning';
                  @endphp
                  <tr>
                    <th scope="row">
                      {{ $job->title }}
                    </th>
                    <td>
                      {{ number_format($job->applications_count) }}
                    </td>
                    <td>
                      {{ number_format($job->unique_views_count) }}
                    </td>
                    <td>
                      {{ number_format($job->total_views_count) }}
                    </td>
                    <td>
                      <i class="fas fa-chart-line text-{{ $rateColor }} mr-3"></i> {{ $applicationRate }}%
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center">No job postings found.</td>
                  </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        
        {{-- Removed the static Social Traffic table to use the full width for Job Summary --}}
      </div>

    @push('js')
    {{-- Assuming you are using Chart.js with the Argon Dashboard implementation --}}
    <script>
      // Function to initialize the Pie/Doughnut Chart for Application Status
      function initApplicationStatusChart() {
        var $chart = $('#chart-orders');
        var dataAttr = $chart.closest('[data-chart-data]').data('chart-data');
        
        if (dataAttr) {
            new Chart($chart, {
                type: 'doughnut', // Ideal for status breakdown
                data: {
                    labels: dataAttr.labels,
                    datasets: [{
                        data: dataAttr.data,
                        backgroundColor: [
                            '#f5365c', // danger (e.g., Rejected)
                            '#ffd600', // yellow (e.g., Pending)
                            '#2dce89', // success (e.g., Hired)
                            '#11cdef'  // info (e.g., Interviewing)
                        ]
                    }]
                },
                options: {
                    // Custom options for your chart
                    legend: {
                        position: 'bottom',
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItem, data) {
                                var dataset = data.datasets[tooltipItem.datasetIndex];
                                var total = dataset.data.reduce(function(a, b) { return a + b; }, 0);
                                var currentValue = dataset.data[tooltipItem.index];
                                var percentage = Math.floor(((currentValue/total) * 100)+0.5);
                                return data.labels[tooltipItem.index] + ': ' + percentage + '% (' + currentValue + ')';
                            }
                        }
                    }
                }
            });
        }
      }
      
      // Call the function on document ready
      $(document).ready(function() {
          initApplicationStatusChart();
      });
    </script>
    @endpush
@endsection