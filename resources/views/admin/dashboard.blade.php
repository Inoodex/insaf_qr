@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard Overview')
@section('page_subtitle', 'System summary, metrics, and recent verification activities')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<!-- Welcome Banner -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-body p-4 text-white" style="background: linear-gradient(135deg, #6366f1 0%, #1e293b 100%);">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="fw-bold mb-1 text-white">Welcome back, {{ Auth::user()->name ?? 'Administrator' }}!</h3>
                        <p class="text-white text-opacity-75 mb-0 small">Manage your account certificates, statements, and live QR code verification endpoints from one unified workspace.</p>
                    </div>
                    <div class="col-md-4 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('admin.verifications.index') }}" class="btn btn-light btn-sm fw-bold px-4 shadow-xs">
                            <i class="bi bi-plus-circle-fill text-primary me-1"></i> New Verification
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Metric Card -->
<div class="row g-3 mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm card-hover">
            <div class="card-body p-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <span class="badge bg-primary-subtle text-primary fw-bold text-uppercase" style="font-size: 0.75rem;">Total Verified Records</span>
                        <h5 class="fw-bold mt-2 mb-0">Total Student / Account Verifications</h5>
                    </div>
                    <div class="rounded-3 p-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="width: 52px; height: 52px;">
                        <i class="bi bi-qr-code-scan fs-4"></i>
                    </div>
                </div>
                <div class="d-flex align-items-baseline justify-content-between">
                    <h2 class="fw-bold mb-0 display-6">{{ number_format($totalVerifications) }}</h2>
                    <a href="{{ route('admin.verifications.index') }}" class="btn btn-sm btn-outline-primary fw-semibold px-3">
                        Manage & Generate &rarr;
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Verifications Table -->
<div class="row">
    <div class="col-12">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between">
                <h6 class="card-title fw-bold mb-0">
                    <i class="bi bi-clock-history me-2 text-primary"></i>Recent Verification Activities
                </h6>
                <div class="card-tools ms-auto">
                    <a href="{{ route('admin.verifications.index') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 small">
                        <thead>
                            <tr>
                                <th class="ps-4">Account / Student Name</th>
                                <th>Certificate Balance</th>
                                <th>Statement Balances</th>
                                <th>Generation Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentVerifications as $v)
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold text-body">{{ $v->account_name }}</div>
                                    <span class="font-monospace text-muted">{{ $v->account_no }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle font-monospace">
                                        {{ $v->currency }} {{ $v->formatted_certificate_balance }}
                                    </span>
                                </td>
                                <td>
                                    <div class="small">Open: <strong class="text-secondary font-monospace">{{ $v->currency }} {{ $v->formatted_opening_balance }}</strong></div>
                                    <div class="small">Close: <strong class="text-success font-monospace">{{ $v->currency }} {{ $v->formatted_closing_balance }}</strong></div>
                                </td>
                                <td>{{ $v->formatted_generation_date }}</td>
                                <td class="text-end pe-4">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <a href="{{ route('admin.verifications.index', ['edit' => $v->id]) }}" class="btn btn-sm btn-outline-primary px-2" title="Edit Verification">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>
                                        <div class="dropup d-inline-block">
                                            <button class="btn btn-sm btn-light border px-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="More Actions">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border py-2" style="font-size: 0.85rem; min-width: 220px; z-index: 9999;">                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ $v->certificate_verification_url }}" target="_blank">
                                                        <i class="bi bi-box-arrow-up-right text-info me-2 fs-6"></i>
                                                        <span>View Certificate</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item d-flex align-items-center py-2" href="{{ $v->statement_verification_url }}" target="_blank">
                                                        <i class="bi bi-box-arrow-up-right text-info me-2 fs-6"></i>
                                                        <span>View Statement</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No verifications generated yet.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
