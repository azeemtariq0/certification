<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Training Verification - {{ $training->certificate_no }} - S2 Certification</title>
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%23418b2c'/%3E%3Ctext x='32' y='45' font-family='Arial,sans-serif' font-size='34' font-weight='bold' fill='white' text-anchor='middle'%3ES2%3C/text%3E%3C/svg%3E">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --green: #418b2c;
            --blue: #2d56a1;
            --navy: #14213d;
            --slate: #475569;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Open Sans', sans-serif;
            background: #e9eef5;
            color: #1a2233;
            padding: 30px 16px;
        }
        h1,h2,h3,h4,h5 { font-family: 'Plus Jakarta Sans', sans-serif; }

        /* Toolbar on screen */
        .toolbar {
            max-width: 840px; margin: 0 auto 20px; display: flex; gap: 12px; justify-content: space-between; align-items: center; flex-wrap: wrap;
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

        /* Certificate sheet */
        .sheet {
            width: 840px; max-width: 100%; min-height: 1040px; margin: 0 auto; background: #fff;
            border-radius: 8px; box-shadow: 0 20px 50px rgba(20,33,61,0.15);
            position: relative; overflow: hidden;
        }
        .sheet-inner {
            padding: 42px 54px; border: 2px solid #eef2f8; min-height: 1040px;
            display: flex; flex-direction: column;
        }
        .sheet::before {
            content: ''; position: absolute; inset: 12px; border: 2px solid rgba(45,86,161,0.18); border-radius: 4px; pointer-events: none;
        }
        .sheet-inner > * { position: relative; z-index: 1; }

        /* Header */
        .cert-head {
            text-align: center; border-bottom: 3px solid var(--navy); padding-bottom: 16px; margin-bottom: 20px;
        }
        .cert-head img { height: 52px; margin-bottom: 8px; }
        .cert-head .org { font-size: 1.5rem; font-weight: 800; color: var(--navy); letter-spacing: -0.01em; }
        .cert-head .org span { color: var(--green); }
        .cert-head .tag { font-size: 0.8rem; color: #64748b; margin-top: 2px; }

        .cert-title {
            text-align: center; font-size: 1.25rem; font-weight: 800; color: var(--blue);
            text-transform: uppercase; letter-spacing: 0.06em; margin-bottom: 4px;
        }
        .cert-sub { text-align: center; color: #64748b; font-size: 0.86rem; margin-bottom: 16px; }

        /* Status Chip */
        .status-chip {
            display: inline-flex; align-items: center; gap: 8px; margin: 0 auto 16px; padding: 7px 22px; border-radius: 50px;
            font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 800; font-size: 0.9rem; text-transform: uppercase;
        }
        .status-valid { background: #eafaf1; color: var(--green); border: 1.5px solid #b6e6c4; }
        .status-expired { background: #fef3c7; color: #b45309; border: 1.5px solid #fde68a; }
        .status-invalid { background: #fee2e2; color: #b91c1c; border: 1.5px solid #fca5a5; }
        .status-wrap { text-align: center; }

        /* Candidate & Details Section */
        .candidate-box {
            background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 18px 24px; margin-bottom: 16px;
        }
        .candidate-box .c-name { font-size: 1.35rem; font-weight: 800; color: var(--navy); }
        .candidate-box .c-course { font-size: 1.05rem; font-weight: 700; color: var(--blue); margin-top: 4px; }

        .detail-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 0 40px; }
        .detail-row { padding: 9px 0; border-bottom: 1px solid #eef2f8; }
        .detail-row.full { grid-column: 1 / -1; }
        .detail-row .lbl { font-size: 0.68rem; text-transform: uppercase; letter-spacing: 0.08em; color: #94a3b8; font-weight: 700; margin-bottom: 2px; }
        .detail-row .val { font-size: 0.95rem; font-weight: 700; color: #1a2233; font-family: 'Plus Jakarta Sans', sans-serif; }
        .detail-row .val.mono { font-family: monospace; color: var(--blue); font-size: 1rem; }

        /* Statement Box */
        .statement-card {
            background: #ffffff; border-left: 4px solid var(--green); border-top: 1px solid #e2e8f0;
            border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0;
            border-radius: 8px; padding: 14px 18px; margin-top: 18px; font-size: 0.82rem; color: #334155; line-height: 1.5;
        }

        /* Footer */
        .cert-foot {
            display: flex; justify-content: space-between; align-items: flex-end; margin-top: auto; padding-top: 24px; gap: 20px;
        }
        .qr-section {
            display: flex; align-items: center; gap: 14px;
        }
        .qr-section img {
            width: 86px; height: 86px; border: 1px solid #cbd5e1; border-radius: 6px; padding: 4px;
        }
        .qr-text { font-size: 0.72rem; color: #64748b; line-height: 1.3; }

        .verify-stamp {
            width: 90px; height: 90px; border-radius: 50%; border: 2px dashed var(--green); color: var(--green);
            display: flex; flex-direction: column; align-items: center; justify-content: center; text-align: center; flex-shrink: 0;
        }
        .verify-stamp i { font-size: 1.4rem; }
        .verify-stamp .s-txt { font-size: 0.54rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; margin-top: 3px; }

        .sign-block { text-align: center; }
        .sign-line { width: 170px; border-top: 1.5px solid #1a2233; margin-bottom: 4px; }
        .sign-block .role { font-size: 0.76rem; color: #64748b; font-weight: 600; }

        .foot-note {
            text-align: center; font-size: 0.72rem; color: #94a3b8; margin-top: 14px; padding-top: 10px; border-top: 1px solid #eef2f8;
        }

        /* Print Media Styles */
        @media print {
            body { background: #fff; padding: 0; margin: 0; }
            .toolbar { display: none; }
            .sheet { width: 100%; box-shadow: none; border-radius: 0; min-height: auto; }
            .sheet-inner { border: none; padding: 25px 30px; }
            .sheet::before { inset: 0; border: 1.5px solid rgba(45,86,161,0.25); }
        }
    </style>
</head>
<body>

    <!-- Toolbar -->
    <div class="toolbar">
        <a href="{{ route('verify.training', ['q' => $training->certificate_no]) }}" class="back-link">
            <i class="fas fa-arrow-left me-1"></i> Back to Verification Portal
        </a>
        <div class="btns">
            <button onclick="window.print()" class="btn btn-green">
                <i class="fas fa-print"></i> Print Official Verification Sheet
            </button>
            <a href="{{ route('home') }}" class="btn btn-light">
                <i class="fas fa-house"></i> Home
            </a>
        </div>
    </div>

    <!-- Printable Sheet -->
    <div class="sheet" id="printSheet">
        <div class="sheet-inner">
            <!-- Header -->
            <div class="cert-head">
                <img src="{{ asset('images/logo.png') }}" alt="S2 Certification">
                <div class="org">S2 CERTIFICATION <span>ACADEMY</span></div>
                <div class="tag">International Training &amp; Personnel Certification Registry</div>
            </div>

            <div class="cert-title">Official Training &amp; Auditor Verification Transcript</div>
            <div class="cert-sub">Electronic Record from the S2 Certification Official Database</div>

            <!-- Status Banner -->
            @php
                $status = strtoupper($training->status);
                $statusClass = match($status) {
                    'VALID' => 'status-valid',
                    'EXPIRED' => 'status-expired',
                    default => 'status-invalid'
                };
            @endphp
            <div class="status-wrap">
                <div class="status-chip {{ $statusClass }}">
                    <i class="fas fa-check-circle"></i>
                    STATUS: {{ $status }}
                </div>
            </div>

            <!-- Candidate Box -->
            <div class="candidate-box">
                <div class="c-name">{{ $training->candidate_name }}</div>
                <div class="c-course">{{ $training->course_title }}</div>
                @if($training->candidate_id)
                    <div style="font-size: 0.8rem; color: #64748b; margin-top: 2px;">Candidate ID: <strong>{{ $training->candidate_id }}</strong></div>
                @endif
            </div>

            <!-- Details Grid -->
            <div class="detail-grid">
                <div class="detail-row">
                    <div class="lbl">Certificate Number</div>
                    <div class="val mono">{{ $training->certificate_no }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Verification ID (QR ID)</div>
                    <div class="val mono">{{ $training->verification_id }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">ISO Standard / Scheme</div>
                    <div class="val">{{ $training->standard }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Course Category</div>
                    <div class="val">{{ $training->course_category }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Training Completion Date</div>
                    <div class="val">{{ $training->completion_date->format('d F Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Certificate Issue Date</div>
                    <div class="val">{{ $training->issue_date->format('d F Y') }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Valid Until / Expiry</div>
                    <div class="val">
                        {{ $training->valid_until ? $training->valid_until->format('d F Y') : 'Lifetime Validity' }}
                    </div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Training Duration</div>
                    <div class="val">{{ $training->training_duration ?: 'Standard Training' }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Issuing Organization</div>
                    <div class="val" style="color: var(--green);">{{ $training->issuing_organization }}</div>
                </div>
                <div class="detail-row">
                    <div class="lbl">Training Provider</div>
                    <div class="val">{{ $training->training_provider }}</div>
                </div>
                @if($training->remarks)
                <div class="detail-row full">
                    <div class="lbl">Remarks / Examination Score</div>
                    <div class="val" style="font-weight: 500; font-size: 0.88rem;">{{ $training->remarks }}</div>
                </div>
                @endif
            </div>

            <!-- Statement Box (Section 16) -->
            <div class="statement-card">
                <strong><i class="fas fa-shield-halved me-1" style="color: var(--green);"></i> Professional Verification Statement:</strong><br>
                "This certificate has been issued by S2 Certification and may be verified through this official online verification portal. The information displayed on this page represents the certificate record available in the S2 Certification verification system."
            </div>

            <!-- Footer with QR & Stamp -->
            <div class="cert-foot">
                @php
                    $qrUrl = url('/verify/training/' . $training->verification_id);
                    $qrImgUrl = 'https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=' . urlencode($qrUrl);
                @endphp
                <div class="qr-section">
                    <img src="{{ $qrImgUrl }}" alt="QR Verification">
                    <div class="qr-text">
                        <strong style="color: var(--navy); font-size: 0.78rem;">Scan to Verify</strong><br>
                        Electronic validation token<br>
                        <span style="font-family: monospace; font-size: 0.7rem;">{{ $training->verification_id }}</span>
                    </div>
                </div>

                <div class="verify-stamp">
                    <i class="fas fa-circle-check"></i>
                    <div class="s-txt">S2 VERIFIED<br>OFFICIAL</div>
                </div>

                <div class="sign-block">
                    <div class="sign-line"></div>
                    <div class="role">Authorized Registrar<br><strong>S2 Certification</strong></div>
                </div>
            </div>

            <!-- Footnote -->
            <div class="foot-note">
                Verified on {{ date('d M Y, h:i A') }} • S2 Certification Official Verification Portal • <a href="https://www.s2cert.com">www.s2cert.com</a> • info@s2cert.com
            </div>
        </div>
    </div>

</body>
</html>
