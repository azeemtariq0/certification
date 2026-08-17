<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate {{ $certificate->certificate_no }} - S2 Certification</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23418b2c'/%3E%3Ctext x='32' y='45' font-family='Arial,sans-serif' font-size='34' font-weight='bold' fill='white' text-anchor='middle'%3ES2%3C/text%3E%3C/svg%3E">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        :root {
            --green: #418b2c;
            --blue: #2d56a1;
            --navy: #14213d;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Open Sans', sans-serif;
            background: #e9eef5;
            color: #1a2233;
            padding: 30px 16px;
        }
        h1,h2,h3,h4 { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Screen toolbar (hidden in print) */
        .toolbar {
            max-width: 820px; margin: 0 auto 20px; display: flex; gap: 12px; justify-content: space-between; align-items: center; flex-wrap: wrap;
        }
        .toolbar .btns { display: flex; gap: 10px; }
        .btn {
            border: none; cursor: pointer; font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700;
            padding: 11px 22px; border-radius: 50px; font-size: 0.9rem; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            transition: all .2s ease;
        }
        .btn-green { background: var(--green); color: #fff; box-shadow: 0 8px 20px rgba(65,139,44,0.28); }
        .btn-green:hover { background: #35701f; }
        .btn-light { background: #fff; color: var(--navy); border: 1px solid #d5deea; }
        .btn-light:hover { background: #f3f6fb; }
        .back-link { color: var(--navy); text-decoration: none; font-weight: 600; font-size: 0.9rem; }

        /* Certificate sheet — sized to fill a single A4 page (820px wide × A4 ratio) */
        .sheet {
            width: 820px; max-width: 100%; min-height: 1000px; margin: 0 auto; background: #fff;
            border-radius: 8px; box-shadow: 0 20px 50px rgba(20,33,61,0.15);
            position: relative; overflow: hidden;
        }
        .sheet-inner {
            padding: 38px 52px; border: 2px solid #eef2f8; min-height: 1000px;
            display: flex; flex-direction: column;
        }
        .sheet::before {
            content: ''; position: absolute; inset: 12px; border: 2px solid rgba(45,86,161,0.18); border-radius: 4px; pointer-events: none;
        }
        .sheet-inner > * { position: relative; z-index: 1; }

        .cert-head { text-align: center; border-bottom: 3px solid var(--navy); padding-bottom: 16px; margin-bottom: 18px; }
        .cert-head img { height: 50px; margin-bottom: 10px; }
        .cert-head .org { font-size: 1.5rem; font-weight: 800; color: var(--navy); letter-spacing: -0.01em; }
        .cert-head .org span { color: var(--green); }
        .cert-head .tag { font-size: 0.8rem; color: #667085; margin-top: 3px; letter-spacing: 0.03em; }

        .cert-title {
            text-align: center; font-size: 1.2rem; font-weight: 800; color: var(--blue);
            text-transform: uppercase; letter-spacing: 0.08em; margin: 2px 0 3px;
        }
        .cert-sub { text-align: center; color: #667085; font-size: 0.85rem; margin-bottom: 16px; }

        .status-chip {
            display: inline-flex; align-items: center; gap: 8px; margin: 0 auto 14px; padding: 7px 20px; border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; font-size: 0.88rem;
        }
        .status-valid { background: #eafaf1; color: var(--green); border: 1px solid #b6e6c4; }
        .status-invalid { background: #fdecec; color: #c0392b; border: 1px solid #f3c0bb; }
        .status-wrap { text-align: center; }

        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 40px; margin-top: 6px; }
        .detail-row { padding: 9px 0; border-bottom: 1px solid #eef2f8; }
        .detail-row.full { grid-column: 1 / -1; }
        .detail-row .lbl { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; font-weight: 700; margin-bottom: 2px; }
        .detail-row .val { font-size: 0.98rem; font-weight: 700; color: #1a2233; font-family: 'Plus Jakarta Sans', sans-serif; }
        .detail-row .val.mono { font-family: monospace; color: var(--blue); letter-spacing: 0.5px; }
        .detail-row .val.scope { font-weight: 600; font-size: 0.9rem; line-height: 1.4; }

        .cert-foot { display: flex; justify-content: space-between; align-items: flex-end; margin-top: auto; padding-top: 36px; gap: 20px; }
        .verify-stamp {
            width: 96px; height: 96px; border-radius: 50%; border: 2px dashed var(--green); color: var(--green);
            display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; flex-shrink: 0;
        }
        .verify-stamp i { font-size: 1.5rem; }
        .verify-stamp .s-txt { font-size: 0.56rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 3px; line-height: 1.2; }
        .sign-block { text-align: center; }
        .sign-line { width: 190px; border-top: 1.5px solid #1a2233; margin-bottom: 5px; }
        .sign-block .role { font-size: 0.78rem; color: #667085; }
        .foot-note { text-align: center; font-size: 0.72rem; color: #94a3b8; margin-top: 18px; padding-top: 12px; border-top: 1px solid #eef2f8; }
        .foot-note a { color: var(--blue); text-decoration: none; }

        @media (max-width: 640px) {
            .sheet { width: 100%; }
            .sheet-inner { padding: 28px 22px; }
            .detail-grid { grid-template-columns: 1fr; }
            .cert-foot { flex-direction: column; align-items: center; }
        }

        @media print {
            @page { size: A4 portrait; margin: 9mm; }
            html, body { background: #fff; padding: 0; margin: 0; width: 210mm; }
            .toolbar { display: none !important; }
            .sheet {
                width: 100%; max-width: 100%; min-height: 0; box-shadow: none; border-radius: 0;
                page-break-inside: avoid; break-inside: avoid;
            }
            .sheet::before { inset: 6px; }
            /* Fill the printable area (A4 277mm tall @ 10mm margins, minus inner padding) */
            .sheet-inner { padding: 8mm 11mm; min-height: 236mm; }
            * { -webkit-print-color-adjust: exact !important; print-color-adjust: exact !important; }
        }
    </style>
</head>
<body>
    @php $isActive = strtolower($certificate->status) === 'active'; @endphp

    <!-- Toolbar (screen only) -->
    <div class="toolbar">
        <a href="{{ route('verify') }}" class="back-link"><i class="fas fa-arrow-left"></i> Back to Verification</a>
        <div class="btns">
            <button class="btn btn-light" onclick="printCertificate()"><i class="fas fa-print"></i> Print</button>
            <button class="btn btn-green" id="downloadBtn" onclick="downloadPdf()"><i class="fas fa-file-arrow-down"></i> Download PDF</button>
        </div>
    </div>

    <!-- Certificate sheet -->
    <div class="sheet" id="certificateSheet">
        <div class="sheet-inner">
            <div class="cert-head">
                <img src="{{ asset('images/logo.png') }}" alt="S2 Certification">
                <div class="org">S2 <span>Certification</span></div>
                <div class="tag">Global Management System Certification &amp; Inspection Registry</div>
            </div>

            <div class="cert-title">Certificate Verification Record</div>
            <div class="cert-sub">This document confirms the registration details held in the S2 Certification database.</div>

            <div class="status-wrap">
                <span class="status-chip {{ $isActive ? 'status-valid' : 'status-invalid' }}">
                    <i class="fas {{ $isActive ? 'fa-circle-check' : 'fa-circle-exclamation' }}"></i>
                    {{ $isActive ? 'Active / Valid Certificate' : $certificate->status }}
                </span>
            </div>

            <div class="detail-grid">
                <div class="detail-row full">
                    <div class="lbl">Certified Organisation</div>
                    <div class="val">{{ $certificate->company_name }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Certificate No.</div>
                    <div class="val mono">{{ $certificate->certificate_no }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Standard</div>
                    <div class="val">{{ $certificate->standard }}</div>
                </div>
                <div class="detail-row full">
                    <div class="lbl">Scope of Certification</div>
                    <div class="val scope">{{ $certificate->scope }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Issue Date</div>
                    <div class="val">{{ \Carbon\Carbon::parse($certificate->issue_date)->format('d M Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Expiry Date</div>
                    <div class="val">{{ \Carbon\Carbon::parse($certificate->expiry_date)->format('d M Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Location</div>
                    <div class="val">{{ $certificate->city ?? 'Karachi' }}, {{ $certificate->country ?? 'Pakistan' }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Certification Body</div>
                    <div class="val">{{ $certificate->certification_body ?? 'S2 Certification' }}</div>
                </div>
                <!-- <div class="detail-row full">
                    <div class="lbl">Accreditation Body</div>
                    <div class="val">{{ $certificate->accreditation_body ?? 'PNAC (Pakistan National Accreditation Council)' }}</div>
                </div> -->
            </div>

            <div class="cert-foot">
                <div class="verify-stamp">
                    <i class="fas fa-shield-halved"></i>
                    <span class="s-txt">Verified<br>{{ now()->format('d M Y') }}</span>
                </div>
            </div>

            <div class="foot-note">
                This is a computer-generated verification record. Confirm authenticity online at
                <a href="{{ route('verify') }}">{{ str_replace(['https://','http://'], '', route('verify')) }}</a>
            </div>
        </div>
    </div>

    <script>
        const certNo = @json($certificate->certificate_no);

        function printCertificate() {
            window.print();
        }

        // Generate and download a real single-page PDF (no print dialog)
        function downloadPdf() {
            const btn = document.getElementById('downloadBtn');
            const original = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Preparing…';
            btn.style.pointerEvents = 'none';

            const element = document.getElementById('certificateSheet');
            const opt = {
                margin: 8,
                filename: 'S2-Certificate-' + certNo + '.pdf',
                image: { type: 'jpeg', quality: 0.98 },
                html2canvas: { scale: 2, useCORS: true, backgroundColor: '#ffffff', scrollY: 0 },
                jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak: { mode: ['avoid-all'] }
            };

            html2pdf().set(opt).from(element).save().then(function () {
                btn.innerHTML = original;
                btn.style.pointerEvents = 'auto';
            }).catch(function () {
                btn.innerHTML = original;
                btn.style.pointerEvents = 'auto';
                // Fallback to the browser print dialog if PDF generation fails
                window.print();
            });
        }

        // Auto actions based on query string
        const params = new URLSearchParams(window.location.search);
        window.addEventListener('load', function () {
            if (params.get('download') === '1') {
                setTimeout(downloadPdf, 500);
            } else if (params.get('print') === '1') {
                setTimeout(function () { window.print(); }, 400);
            }
        });
    </script>
</body>
</html>
