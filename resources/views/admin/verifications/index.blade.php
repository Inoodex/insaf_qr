@extends('layouts.admin')

@section('title', 'Account Verifications')
@section('page_title', 'Account & Student Verifications')
@section('page_subtitle', 'Generate and manage unified Certificate and Statement QR codes in one place')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Verifications</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        
        <!-- Generator & Dual QR Card -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-bold mb-0 {{ $editVerification ? 'text-warning-emphasis' : 'text-primary' }}">
                    <i class="bi {{ $editVerification ? 'bi-pencil-square' : 'bi-qr-code-scan' }} me-2"></i>
                    {{ $editVerification ? 'Edit Verification (' . $editVerification->account_name . ')' : 'Account Certificate & Statement Details' }}
                </h5>
                @if($activeVerification || $editVerification)
                <div class="card-tools ms-auto">
                    <a href="{{ route('admin.verifications.index') }}" class="btn btn-sm btn-outline-primary">
                        <i class="bi bi-plus-lg me-1"></i>New Verification
                    </a>
                </div>
                @endif
            </div>
            <div class="card-body p-4">
                <div class="row g-4 align-items-start">
                    
                    <!-- Left: Combined Form Inputs (7 cols) -->
                    <div class="col-lg-7">
                        <form action="{{ $editVerification ? route('admin.verifications.update', $editVerification->id) : route('admin.verifications.store') }}" method="POST" id="unifiedForm">
                            @csrf
                            @if($editVerification)
                                @method('PUT')
                            @endif

                            <input type="hidden" id="activeCertUrl" value="{{ isset($editVerification) ? $editVerification->certificate_verification_url : (isset($activeVerification) ? $activeVerification->certificate_verification_url : '') }}">
                            <input type="hidden" id="activeStmtUrl" value="{{ isset($editVerification) ? $editVerification->statement_verification_url : (isset($activeVerification) ? $activeVerification->statement_verification_url : '') }}">

                            <!-- Common Account Details -->
                            <div class="p-3 bg-body-secondary bg-opacity-50 rounded-3 mb-3 border">
                                <h6 class="fw-bold mb-3 text-body d-flex align-items-center">
                                    <i class="bi bi-person-badge-fill me-2 text-primary"></i>1. Account & Student Information
                                </h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase">Account No <span class="text-danger">* (Unique)</span></label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-text"><i class="bi bi-credit-card"></i></span>
                                            <input type="text" name="account_no" id="inputAccountNo" class="form-control font-monospace fw-bold @error('account_no') is-invalid @enderror" value="{{ old('account_no', $editVerification->account_no ?? ($activeVerification->account_no ?? '')) }}" required>
                                            @error('account_no')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-muted text-uppercase">Account Name <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                                            <input type="text" name="account_name" id="inputAccountName" class="form-control fw-bold" value="{{ old('account_name', $editVerification->account_name ?? ($activeVerification->account_name ?? '')) }}" required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-muted text-uppercase">Report Generation Date <span class="text-danger">*</span></label>
                                        <div class="input-group input-group-md">
                                            <span class="input-group-text"><i class="bi bi-calendar-event"></i></span>
                                            <input type="date" name="report_generation_date" id="inputGenDate" class="form-control fw-bold" value="{{ old('report_generation_date', isset($editVerification) ? $editVerification->report_generation_date->format('Y-m-d') : (isset($activeVerification) ? $activeVerification->report_generation_date->format('Y-m-d') : date('Y-m-d'))) }}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Two Distinct Verification Sections -->
                            <div class="row g-3">
                                
                                <!-- Section 1: Certificate -->
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 border h-100" style="background-color: rgba(79, 70, 229, 0.03); border-color: rgba(79, 70, 229, 0.2) !important;">
                                        <h6 class="fw-bold mb-3 text-primary d-flex align-items-center">
                                            <i class="bi bi-patch-check-fill me-2"></i>2. Certificate Section
                                        </h6>
                                        <div>
                                            <label class="form-label fw-bold small text-muted text-uppercase">Report Date Balance <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-md">
                                                <span class="input-group-text fw-bold text-primary">BDT</span>
                                                <input type="text" name="certificate_balance" id="inputCertBal" class="form-control font-monospace fw-bold" value="{{ old('certificate_balance', $editVerification ? $editVerification->formatted_certificate_balance : ($activeVerification ? $activeVerification->formatted_certificate_balance : '')) }}" required>
                                            </div>
                                            <small class="text-muted mt-1 d-block">Shown on Certificate verification</small>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section 2: Statement -->
                                <div class="col-md-6">
                                    <div class="p-3 rounded-3 border h-100" style="background-color: rgba(16, 185, 129, 0.03); border-color: rgba(16, 185, 129, 0.2) !important;">
                                        <h6 class="fw-bold mb-3 text-success d-flex align-items-center">
                                            <i class="bi bi-file-earmark-text-fill me-2"></i>3. Statement Section
                                        </h6>
                                        <div class="mb-2">
                                            <label class="form-label fw-bold small text-muted text-uppercase">Opening Balance <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-md">
                                                <span class="input-group-text fw-bold text-success">BDT</span>
                                                <input type="text" name="opening_balance" id="inputOpenBal" class="form-control font-monospace fw-bold" value="{{ old('opening_balance', $editVerification ? $editVerification->formatted_opening_balance : ($activeVerification ? $activeVerification->formatted_opening_balance : '')) }}" required>
                                            </div>
                                        </div>
                                        <div>
                                            <label class="form-label fw-bold small text-muted text-uppercase">Closing Balance <span class="text-danger">*</span></label>
                                            <div class="input-group input-group-md">
                                                <span class="input-group-text fw-bold text-success">BDT</span>
                                                <input type="text" name="closing_balance" id="inputCloseBal" class="form-control font-monospace fw-bold" value="{{ old('closing_balance', $editVerification ? $editVerification->formatted_closing_balance : ($activeVerification ? $activeVerification->formatted_closing_balance : '')) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- Submit Action Buttons -->
                            <div class="d-flex flex-wrap gap-2 mt-4">
                                @if($editVerification)
                                    <button type="submit" class="btn btn-primary btn-md fw-bold px-4 shadow-sm" id="btnSubmitForm">
                                        <i class="bi bi-check-lg me-1"></i> Update & Refresh Both QRs
                                    </button>
                                    <a href="{{ route('admin.verifications.index') }}" class="btn btn-outline-secondary btn-md fw-bold px-3">
                                        Cancel
                                    </a>
                                @else
                                    <button type="submit" class="btn btn-primary btn-md fw-bold px-4 shadow-sm" id="btnSubmitForm">
                                        <i class="bi bi-qr-code me-1"></i> Save & Generate Both QRs
                                    </button>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Right: Dual Live QR Preview (5 cols) -->
                    <div class="col-lg-5 border-start ps-lg-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="small fw-bold text-uppercase text-muted">Live Generated QR Codes</span>
                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">2 QR Codes</span>
                        </div>

                        <!-- Nav tabs for QR preview -->
                        <ul class="nav nav-pills nav-fill mb-3" id="qrTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active py-2 fw-semibold small" id="cert-tab" data-bs-toggle="tab" data-bs-target="#certQrTabPane" type="button" role="tab">
                                    <i class="bi bi-patch-check-fill me-1 text-primary"></i>Certificate QR
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link py-2 fw-semibold small" id="stmt-tab" data-bs-toggle="tab" data-bs-target="#stmtQrTabPane" type="button" role="tab">
                                    <i class="bi bi-file-earmark-text-fill me-1 text-success"></i>Statement QR
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content" id="qrTabsContent">
                            
                            <!-- Tab 1: Certificate QR -->
                            <div class="tab-pane fade show active text-center" id="certQrTabPane" role="tabpanel">
                                <div class="qr-preview-box shadow-xs mb-3 mx-auto d-flex flex-column align-items-center justify-content-center p-3" style="max-width: 260px; min-height: 240px;">
                                    <div id="certQrHolder" class="w-100 d-flex flex-column align-items-center justify-content-center"></div>
                                </div>
                                <div id="certPayloadBox" class="text-start p-3 bg-body-secondary rounded-3 border mb-3 {{ ($activeVerification || $editVerification) ? '' : 'd-none' }}">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-muted text-uppercase">Certificate Link:</span>
                                        <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none" onclick="copyPayload('cert')">
                                            <i class="bi bi-clipboard me-1"></i>Copy
                                        </button>
                                    </div>
                                    <pre class="mb-0 small text-body font-monospace" id="certPayloadText" style="white-space: pre-wrap; font-size: 0.78rem; line-height: 1.35; word-break: break-all;"></pre>
                                </div>
                                <button type="button" class="btn btn-outline-primary btn-sm fw-bold w-100" id="btnDownloadCertQr" onclick="downloadCurrentCertQR()" {{ ($activeVerification || $editVerification) ? '' : 'disabled' }}>
                                    <i class="bi bi-download me-1"></i> Save Certificate QR
                                </button>
                            </div>

                            <!-- Tab 2: Statement QR -->
                            <div class="tab-pane fade text-center" id="stmtQrTabPane" role="tabpanel">
                                <div class="qr-preview-box shadow-xs mb-3 mx-auto d-flex flex-column align-items-center justify-content-center p-3" style="max-width: 260px; min-height: 240px;">
                                    <div id="stmtQrHolder" class="w-100 d-flex flex-column align-items-center justify-content-center"></div>
                                </div>
                                <div id="stmtPayloadBox" class="text-start p-3 bg-body-secondary rounded-3 border mb-3 {{ ($activeVerification || $editVerification) ? '' : 'd-none' }}">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <span class="small fw-bold text-muted text-uppercase">Statement Link:</span>
                                        <button type="button" class="btn btn-link btn-sm p-0 text-decoration-none" onclick="copyPayload('stmt')">
                                            <i class="bi bi-clipboard me-1"></i>Copy
                                        </button>
                                    </div>
                                    <pre class="mb-0 small text-body font-monospace" id="stmtPayloadText" style="white-space: pre-wrap; font-size: 0.78rem; line-height: 1.35; word-break: break-all;"></pre>
                                </div>
                                <button type="button" class="btn btn-outline-success btn-sm fw-bold w-100" id="btnDownloadStmtQr" onclick="downloadCurrentStmtQR()" {{ ($activeVerification || $editVerification) ? '' : 'disabled' }}>
                                    <i class="bi bi-download me-1"></i> Save Statement QR
                                </button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- Single Unified History Table Card -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-transparent border-bottom py-3 px-4 d-flex align-items-center justify-content-between flex-nowrap">
                <div class="d-flex align-items-center gap-2 text-nowrap me-3">
                    <h6 class="card-title fw-bold mb-0">
                        Saved Records (<span id="verifCountDisplay">{{ count($verifications) }}</span>)
                    </h6>
                    <span class="text-muted small d-none d-lg-inline">&bull; Click row to preview both QRs</span>
                </div>
                <div class="card-tools ms-auto d-flex flex-nowrap align-items-center gap-2">
                    <div class="input-group input-group-sm" style="width: 180px; flex-shrink: 0;">
                        <span class="input-group-text bg-body-secondary"><i class="bi bi-calendar-event text-muted"></i></span>
                        <input type="date" id="filterDate" class="form-control" title="Filter by Generation Date" onchange="filterVerifTable()">
                    </div>
                    <div class="input-group input-group-sm" style="width: 260px; flex-shrink: 0;">
                        <span class="input-group-text bg-body-secondary border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" id="searchVerifInput" class="form-control border-start-0 ps-2" placeholder="Search account no, name..." onkeyup="filterVerifTable()">
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary px-2 flex-shrink-0" id="resetFilterBtn" onclick="resetVerifFilters()" title="Reset Filters" style="display: none;">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0 small">
                        <thead>
                            <tr>
                                <th class="ps-4">Account / Student Name</th>
                                <th>Certificate Bal.</th>
                                <th>Statement Balances</th>
                                <th>Gen. Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="verifTableBody">
                            @forelse($verifications as $v)
                            <tr style="cursor: pointer;" 
                                class="verif-row {{ (($editVerification && $editVerification->id === $v->id) || ($activeVerification && $activeVerification->id === $v->id)) ? 'table-primary' : '' }}" 
                                data-date="{{ $v->report_generation_date->format('Y-m-d') }}" 
                                onclick="loadRow('{{ $v->account_no }}', '{{ addslashes($v->account_name) }}', '{{ $v->formatted_certificate_balance }}', '{{ $v->formatted_opening_balance }}', '{{ $v->formatted_closing_balance }}', '{{ $v->formatted_generation_date }}', '{{ $v->report_generation_date->format('Y-m-d') }}', '{{ $v->certificate_verification_url }}', '{{ $v->statement_verification_url }}')">
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
                                <td class="text-end pe-4" onclick="event.stopPropagation()">
                                    <div class="d-inline-flex align-items-center gap-1">
                                        <!-- Quick 1-Click Edit Button -->
                                        <a href="{{ route('admin.verifications.index', ['edit' => $v->id]) }}" class="btn btn-sm btn-outline-primary px-2" title="Edit Record">
                                            <i class="bi bi-pencil-square me-1"></i>Edit
                                        </a>

                                        <!-- More Actions Dropup Menu -->
                                        <div class="dropup d-inline-block">
                                            <button class="btn btn-sm btn-light border px-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" title="More Actions">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border py-2" style="font-size: 0.85rem; min-width: 220px; z-index: 9999;">
                                                <li>
                                                    <button type="button" class="dropdown-item d-flex align-items-center py-2" onclick="downloadRowQR('cert', '{{ $v->certificate_verification_url }}', '{{ $v->account_no }}')">
                                                        <i class="bi bi-patch-check-fill text-primary me-2 fs-6"></i>
                                                        <span>Download Certificate QR</span>
                                                    </button>
                                                </li>
                                                <li>
                                                    <button type="button" class="dropdown-item d-flex align-items-center py-2" onclick="downloadRowQR('stmt', '{{ $v->statement_verification_url }}', '{{ $v->account_no }}')">
                                                        <i class="bi bi-file-earmark-text-fill text-success me-2 fs-6"></i>
                                                        <span>Download Statement QR</span>
                                                    </button>
                                                </li>

                                                <li><hr class="dropdown-divider my-1"></li>
                                                <li>
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

                                                <li><hr class="dropdown-divider my-1"></li>
                                                <li>
                                                    <form action="{{ route('admin.verifications.destroy', $v->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete verification for {{ addslashes($v->account_name) }} ({{ $v->account_no }})?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item d-flex align-items-center py-2 text-danger">
                                                            <i class="bi bi-trash3-fill me-2 fs-6"></i>
                                                            <span>Delete Record</span>
                                                        </button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No student/account records saved yet. Fill in the form above and click Save.</td>
                            </tr>
                            @endforelse
                            <tr id="noMatchRow" style="display: none;">
                                <td colspan="5" class="text-center py-4 text-muted">
                                    <i class="bi bi-search me-2"></i>No matching verification records found.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    let certQrCodeInstance = null;
    let stmtQrCodeInstance = null;

    function formatBalanceInput(e) {
        let val = e.target.value.replace(/,/g, '').trim();
        if (val !== '' && !isNaN(val)) {
            let num = parseFloat(val);
            e.target.value = num.toFixed(2);
        }
    }

    ['inputCertBal', 'inputOpenBal', 'inputCloseBal'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('blur', formatBalanceInput);
    });

    let currentCertUrl = document.getElementById('activeCertUrl')?.value || '';
    let currentStmtUrl = document.getElementById('activeStmtUrl')?.value || '';
    let tempCertUuid = '{{ \App\Models\AccountVerification::generateSecureRefToken() }}';
    let tempStmtUuid = '{{ \App\Models\AccountVerification::generateSecureRefToken() }}';

    function getFormattedDate(dateStr) {
        if (!dateStr) return '';
        const d = new Date(dateStr + 'T00:00:00');
        if (isNaN(d.getTime())) return dateStr;
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        return `${String(d.getDate()).padStart(2, '0')} ${months[d.getMonth()]} ${d.getFullYear()}`;
    }

    function getPayloads() {
        const accNo = document.getElementById('inputAccountNo').value.trim();
        const accName = document.getElementById('inputAccountName').value.trim();
        const genDate = document.getElementById('inputGenDate').value.trim();
        const certBal = document.getElementById('inputCertBal').value.trim();
        const openBal = document.getElementById('inputOpenBal').value.trim();
        const closeBal = document.getElementById('inputCloseBal').value.trim();

        const baseUrl = window.location.origin;

        const certPayload = (accNo && accName && certBal && genDate)
            ? (currentCertUrl || `${baseUrl}/ini/certificates-statements/verification-info-display?ref=${tempCertUuid}`)
            : '';

        const stmtPayload = (accNo && accName && openBal && closeBal && genDate)
            ? (currentStmtUrl || `${baseUrl}/ini/certificates-statements/verification-info-display?ref=${tempStmtUuid}`)
            : '';

        return { certPayload, stmtPayload };
    }

    function getConsistentTypeNumber(payload) {
        const len = (payload || '').length;
        if (len > 320) return 0; // Auto-scale if text exceeds capacity
        return 11; // Locked to Version 11 (61x61) for URLs
    }

    function renderQR(type, payload) {
        const holderId = type === 'cert' ? 'certQrHolder' : 'stmtQrHolder';
        const payloadBoxId = type === 'cert' ? 'certPayloadBox' : 'stmtPayloadBox';
        const payloadTextId = type === 'cert' ? 'certPayloadText' : 'stmtPayloadText';
        const downloadBtnId = type === 'cert' ? 'btnDownloadCertQr' : 'btnDownloadStmtQr';

        const holder = document.getElementById(holderId);
        const payloadBox = document.getElementById(payloadBoxId);
        const payloadText = document.getElementById(payloadTextId);
        const downloadBtn = document.getElementById(downloadBtnId);

        if (!holder) return;
        holder.innerHTML = '';

        if (!payload) {
            holder.innerHTML = `<div class="text-muted small py-4"><i class="bi bi-qr-code fs-1 d-block text-secondary mb-2 opacity-50"></i>Fill form to preview ${type === 'cert' ? 'Certificate' : 'Statement'} QR</div>`;
            if (payloadBox) payloadBox.classList.add('d-none');
            if (downloadBtn) downloadBtn.disabled = true;
            return;
        }

        if (payloadBox) payloadBox.classList.remove('d-none');
        if (payloadText) payloadText.textContent = payload;
        if (downloadBtn) downloadBtn.disabled = false;

        const canvasPad = document.createElement('div');
        canvasPad.style.background = '#ffffff';
        canvasPad.style.padding = '8px';
        canvasPad.style.borderRadius = '8px';
        holder.appendChild(canvasPad);

        const typeNum = getConsistentTypeNumber(payload);

        if (typeof QRCodeStyling !== 'undefined') {
            try {
                const qr = new QRCodeStyling({
                    width: 200,
                    height: 200,
                    type: "canvas",
                    data: payload,
                    margin: 8,
                    qrOptions: { 
                        typeNumber: typeNum,
                        mode: 'Byte',
                        errorCorrectionLevel: 'M' 
                    },
                    dotsOptions: { color: "#0f172a", type: "square" },
                    backgroundOptions: { color: "#ffffff" },
                    cornersSquareOptions: { type: "square", color: "#0f172a" },
                    cornersDotOptions: { type: "square", color: "#0f172a" }
                });
                qr.append(canvasPad);
                if (type === 'cert') certQrCodeInstance = qr;
                else stmtQrCodeInstance = qr;
                return;
            } catch (err) {
                console.warn('QRCodeStyling error, using fallback:', err);
            }
        }

        if (typeof QRCode !== 'undefined') {
            new QRCode(canvasPad, {
                text: payload,
                width: 200,
                height: 200,
                colorDark: "#0f172a",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.M
            });
            const fallbackInstance = {
                download: function({ name, extension }) {
                    const canvas = canvasPad.querySelector('canvas');
                    const img = canvasPad.querySelector('img');
                    const link = document.createElement('a');
                    link.download = `${name}.${extension}`;
                    link.href = canvas ? canvas.toDataURL() : (img ? img.src : '');
                    link.click();
                }
            };
            if (type === 'cert') certQrCodeInstance = fallbackInstance;
            else stmtQrCodeInstance = fallbackInstance;
        }
    }

    function renderBothQRs() {
        const { certPayload, stmtPayload } = getPayloads();
        renderQR('cert', certPayload);
        renderQR('stmt', stmtPayload);
    }

    // Dynamic typing preview
    ['inputAccountNo', 'inputAccountName', 'inputGenDate', 'inputCertBal', 'inputOpenBal', 'inputCloseBal'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', renderBothQRs);
    });

    function downloadCurrentCertQR() {
        const accNo = document.getElementById('inputAccountNo').value.trim() || 'Record';
        const { certPayload } = getPayloads();
        if (certPayload) {
            downloadRowQR('cert', certPayload, accNo);
        }
    }

    function downloadCurrentStmtQR() {
        const accNo = document.getElementById('inputAccountNo').value.trim() || 'Record';
        const { stmtPayload } = getPayloads();
        if (stmtPayload) {
            downloadRowQR('stmt', stmtPayload, accNo);
        }
    }

    function copyPayload(type) {
        const { certPayload, stmtPayload } = getPayloads();
        const payload = type === 'cert' ? certPayload : stmtPayload;
        if (!payload) return;

        navigator.clipboard.writeText(payload).then(() => {
            if (typeof showToast === 'function') {
                showToast(`${type === 'cert' ? 'Certificate' : 'Statement'} link copied to clipboard!`, 'success');
            }
        });
    }

    function downloadRowQR(type, qrUrl, accNo) {
        const fileName = `${type === 'cert' ? 'Certificate' : 'Statement'}_QR_${accNo}_${Date.now()}`;
        const typeNum = getConsistentTypeNumber(qrUrl);

        if (typeof QRCodeStyling !== 'undefined') {
            const tempQr = new QRCodeStyling({
                width: 600,
                height: 600,
                type: "canvas",
                data: qrUrl,
                margin: 20,
                qrOptions: { 
                    typeNumber: typeNum,
                    mode: 'Byte',
                    errorCorrectionLevel: 'M' 
                },
                dotsOptions: { color: "#0f172a", type: "square" },
                backgroundOptions: { color: "#ffffff" },
                cornersSquareOptions: { type: "square", color: "#0f172a" },
                cornersDotOptions: { type: "square", color: "#0f172a" }
            });
            tempQr.download({ name: fileName, extension: 'png' });
            return;
        }

        const tempDiv = document.createElement('div');
        document.body.appendChild(tempDiv);
        new QRCode(tempDiv, { text: qrUrl, width: 600, height: 600, colorDark: "#0f172a", colorLight: "#ffffff" });
        setTimeout(() => {
            const canvas = tempDiv.querySelector('canvas');
            if (canvas) {
                const link = document.createElement('a');
                link.download = `${fileName}.png`;
                link.href = canvas.toDataURL('image/png');
                link.click();
            }
            document.body.removeChild(tempDiv);
        }, 100);
    }

    function loadRow(accNo, accName, certBal, openBal, closeBal, formattedDate, ymdDate, certUrl, stmtUrl) {
        document.getElementById('inputAccountNo').value = accNo;
        document.getElementById('inputAccountName').value = accName;
        document.getElementById('inputCertBal').value = certBal;
        document.getElementById('inputOpenBal').value = openBal;
        document.getElementById('inputCloseBal').value = closeBal;
        document.getElementById('inputGenDate').value = ymdDate || formattedDate;

        currentCertUrl = certUrl;
        currentStmtUrl = stmtUrl;

        renderQR('cert', certUrl);
        renderQR('stmt', stmtUrl);

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function filterVerifTable() {
        const textInput = document.getElementById('searchVerifInput');
        const textFilter = textInput ? textInput.value.toLowerCase().trim() : '';

        const dateInput = document.getElementById('filterDate');
        const dateFilter = dateInput ? dateInput.value.trim() : '';

        const resetBtn = document.getElementById('resetFilterBtn');
        if (resetBtn) {
            resetBtn.style.display = (textFilter.length > 0 || dateFilter.length > 0) ? 'inline-block' : 'none';
        }

        const rows = document.querySelectorAll('#verifTableBody tr.verif-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            const rowDate = row.getAttribute('data-date') || '';

            const matchesText = textFilter === '' || text.includes(textFilter);
            const matchesDate = dateFilter === '' || rowDate === dateFilter;

            if (matchesText && matchesDate) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noMatchRow = document.getElementById('noMatchRow');
        if (noMatchRow) {
            noMatchRow.style.display = (visibleCount === 0 && rows.length > 0) ? '' : 'none';
        }

        const countDisplay = document.getElementById('verifCountDisplay');
        if (countDisplay) {
            countDisplay.textContent = visibleCount;
        }
    }

    function resetVerifFilters() {
        const textInput = document.getElementById('searchVerifInput');
        const dateInput = document.getElementById('filterDate');
        if (textInput) textInput.value = '';
        if (dateInput) dateInput.value = '';
        filterVerifTable();
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if($activeVerification)
            renderBothQRs();
        @else
            renderBothQRs();
        @endif
    });
</script>
@endpush
