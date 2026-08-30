<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\TrainingCertificate;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function services()
    {
        return view('pages.services');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    /* =========================================================================
       COMPANY / MANAGEMENT SYSTEM CERTIFICATION VERIFICATION
       ========================================================================= */

    public function verify()
    {
        return view('pages.verify');
    }

    public function certificatePrint(Certificate $certificate)
    {
        return view('pages.certificate-print', compact('certificate'));
    }

    public function apiSearch(Request $request)
    {
        $search = trim((string) $request->input('query', $request->input('search', $request->input('certificate_no', $request->input('company_name', '')))));
        
        // Autocomplete search suggestions
        if ($request->boolean('autocomplete')) {
            $suggestions = collect();
            if ($search !== '') {
                $certs = Certificate::where(function ($q) use ($search) {
                    $q->where('company_name', 'like', "%{$search}%")
                      ->orWhere('certificate_no', 'like', "%{$search}%");
                })
                ->limit(8)
                ->get();
                    
                $suggestions = $certs->map(function ($cert) {
                    return [
                        'company_name' => $cert->company_name,
                        'certificate_no' => $cert->certificate_no,
                        'standard' => $cert->standard,
                    ];
                });
            }
            return response()->json([
                'success' => true,
                'suggestions' => $suggestions
            ]);
        }

        if ($search === '') {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a Company Name or Certificate / Challan No to search.'
            ]);
        }

        $query = Certificate::query();
        $query->where(function ($q) use ($search) {
            $q->where('company_name', $search)
              ->orWhere('certificate_no', $search)
              ->orWhereRaw('LOWER(TRIM(company_name)) = ?', [strtolower($search)])
              ->orWhereRaw('LOWER(TRIM(certificate_no)) = ?', [strtolower($search)])
              ->orWhere('company_name', 'like', "%{$search}%")
              ->orWhere('certificate_no', 'like', "%{$search}%");
        });

        $allMatching = $query->get();

        if ($allMatching->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No certificate found matching Company Name or Certificate No: "' . $search . '"'
            ]);
        }

        $availableCountries = $allMatching->groupBy('country')->map(function ($items, $key) {
            return ['name' => $key ?: 'Unknown', 'count' => $items->count()];
        })->values();

        $availableCities = $allMatching->groupBy('city')->map(function ($items, $key) {
            return ['name' => $key ?: 'Unknown', 'count' => $items->count()];
        })->values();

        $availableStandards = $allMatching->groupBy('standard')->map(function ($items, $key) {
            return ['name' => $key ?: 'Unknown', 'count' => $items->count()];
        })->values();

        $availableStatuses = $allMatching->groupBy('status')->map(function ($items, $key) {
            return ['name' => $key ?: 'Unknown', 'count' => $items->count()];
        })->values();

        if (!empty($request->input('countries')) && is_array($request->input('countries'))) {
            $query->whereIn('country', $request->input('countries'));
        }
        if (!empty($request->input('cities')) && is_array($request->input('cities'))) {
            $query->whereIn('city', $request->input('cities'));
        }
        if (!empty($request->input('standards')) && is_array($request->input('standards'))) {
            $query->whereIn('standard', $request->input('standards'));
        }
        if (!empty($request->input('statuses')) && is_array($request->input('statuses'))) {
            $query->whereIn('status', $request->input('statuses'));
        }

        $filteredResults = $query->get();

        $data = $filteredResults->map(function ($certificate) {
            return [
                'id' => $certificate->id,
                'company_name' => $certificate->company_name,
                'certificate_no' => $certificate->certificate_no,
                'standard' => $certificate->standard,
                'scope' => $certificate->scope,
                'status' => $certificate->status,
                'country' => $certificate->country ?? 'Pakistan',
                'city' => $certificate->city ?? 'Karachi',
                'certification_body' => $certificate->certification_body ?? 'S2 Certification',
                'accreditation_body' => $certificate->accreditation_body ?? 'PNAC',
                'issue_date' => date('d M Y', strtotime($certificate->issue_date)),
                'expiry_date' => date('d M Y', strtotime($certificate->expiry_date)),
                'verified_on' => date('d M Y')
            ];
        });

        return response()->json([
            'success' => true,
            'total' => $allMatching->count(),
            'filtered_total' => $filteredResults->count(),
            'data' => $data,
            'filters' => [
                'countries' => $availableCountries,
                'cities' => $availableCities,
                'standards' => $availableStandards,
                'statuses' => $availableStatuses
            ]
        ]);
    }

    /* =========================================================================
       TRAINING & AUDITOR CERTIFICATION VERIFICATION
       ========================================================================= */

    public function verifyTraining(Request $request)
    {
        $initialQuery = trim((string) $request->input('q', $request->input('code', '')));
        return view('pages.verify-training', compact('initialQuery'));
    }

    public function directVerifyTraining($code)
    {
        $code = trim($code);
        return redirect()->route('verify.training', ['q' => $code]);
    }

    public function trainingPrint(TrainingCertificate $trainingCertificate)
    {
        return view('pages.training-print', ['training' => $trainingCertificate]);
    }

    public function apiSearchTraining(Request $request)
    {
        $search = trim((string) $request->input('query', $request->input('search', $request->input('certificate_no', $request->input('candidate_name', '')))));

        // Autocomplete suggestions
        if ($request->boolean('autocomplete')) {
            $suggestions = collect();
            if ($search !== '') {
                $results = TrainingCertificate::where(function ($q) use ($search) {
                    $q->where('candidate_name', 'like', "%{$search}%")
                      ->orWhere('certificate_no', 'like', "%{$search}%")
                      ->orWhere('verification_id', 'like', "%{$search}%");
                })
                ->limit(8)
                ->get();

                $suggestions = $results->map(function ($item) {
                    return [
                        'candidate_name' => $item->candidate_name,
                        'certificate_no' => $item->certificate_no,
                        'verification_id' => $item->verification_id,
                        'course_title' => $item->course_title,
                        'standard' => $item->standard,
                    ];
                });
            }
            return response()->json([
                'success' => true,
                'suggestions' => $suggestions
            ]);
        }

        if ($search === '') {
            return response()->json([
                'success' => false,
                'message' => 'Please enter a Certificate Number, Verification ID, or Candidate Name to verify.'
            ]);
        }

        $query = TrainingCertificate::query();
        $query->where(function ($q) use ($search) {
            $q->where('certificate_no', $search)
              ->orWhere('verification_id', $search)
              ->orWhere('candidate_name', $search)
              ->orWhere('candidate_id', $search)
              ->orWhere('certificate_no', 'like', "%{$search}%")
              ->orWhere('verification_id', 'like', "%{$search}%")
              ->orWhere('candidate_name', 'like', "%{$search}%");
        });

        $allMatching = $query->get();

        if ($allMatching->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'CERTIFICATE NOT FOUND - The certificate number or verification ID "' . $search . '" could not be verified in our records.'
            ]);
        }

        // Available dynamic filters based on matched results
        $availableCategories = $allMatching->groupBy('course_category')->map(function ($items, $key) {
            return ['name' => $key ?: 'General', 'count' => $items->count()];
        })->values();

        $availableStandards = $allMatching->groupBy('standard')->map(function ($items, $key) {
            return ['name' => $key ?: 'Standard', 'count' => $items->count()];
        })->values();

        $availableStatuses = $allMatching->groupBy('status')->map(function ($items, $key) {
            return ['name' => $key ?: 'Unknown', 'count' => $items->count()];
        })->values();

        // Apply checked sidebar filters if present
        if (!empty($request->input('categories')) && is_array($request->input('categories'))) {
            $query->whereIn('course_category', $request->input('categories'));
        }
        if (!empty($request->input('standards')) && is_array($request->input('standards'))) {
            $query->whereIn('standard', $request->input('standards'));
        }
        if (!empty($request->input('statuses')) && is_array($request->input('statuses'))) {
            $query->whereIn('status', $request->input('statuses'));
        }

        $filteredResults = $query->get();

        $data = $filteredResults->map(function ($item) {
            $status = strtoupper($item->status);
            $statusHeading = match($status) {
                'VALID' => 'CERTIFICATE VERIFIED - STATUS: VALID',
                'EXPIRED' => 'CERTIFICATE STATUS: EXPIRED',
                'CANCELLED' => 'CERTIFICATE STATUS: CANCELLED',
                'SUSPENDED' => 'CERTIFICATE STATUS: SUSPENDED',
                'REVOKED' => 'CERTIFICATE STATUS: REVOKED',
                default => 'CERTIFICATE STATUS: ' . $status,
            };

            $statusBadgeClass = match($status) {
                'VALID' => 'success',
                'EXPIRED' => 'warning',
                'CANCELLED' => 'secondary',
                'SUSPENDED' => 'info',
                'REVOKED' => 'danger',
                default => 'primary',
            };

            $qrUrl = url('/verify/training/' . $item->verification_id);

            return [
                'id' => $item->id,
                'certificate_no' => $item->certificate_no,
                'verification_id' => $item->verification_id,
                'candidate_name' => $item->candidate_name,
                'candidate_id' => $item->candidate_id ?? 'N/A',
                'course_title' => $item->course_title,
                'course_category' => $item->course_category,
                'standard' => $item->standard,
                'training_duration' => $item->training_duration ?? 'Standard Curriculum',
                'training_provider' => $item->training_provider ?? 'S2 Certification Academy',
                'issuing_organization' => $item->issuing_organization ?? 'S2 Certification',
                'completion_date' => $item->completion_date->format('d M Y'),
                'issue_date' => $item->issue_date->format('d M Y'),
                'valid_until' => $item->valid_until ? $item->valid_until->format('d M Y') : 'Lifetime Validity',
                'status' => $status,
                'status_heading' => $statusHeading,
                'status_badge' => $statusBadgeClass,
                'remarks' => $item->remarks,
                'certificate_file_url' => $item->certificate_file ? asset('storage/' . $item->certificate_file) : null,
                'print_url' => route('verify.training.print', $item->id),
                'qr_url' => $qrUrl,
                'qr_image_url' => 'https://api.qrserver.com/v1/create-qr-code/?size=180x180&data=' . urlencode($qrUrl),
                'verified_on' => date('d M Y, h:i A')
            ];
        });

        return response()->json([
            'success' => true,
            'total' => $allMatching->count(),
            'filtered_total' => $filteredResults->count(),
            'data' => $data,
            'filters' => [
                'categories' => $availableCategories,
                'standards' => $availableStandards,
                'statuses' => $availableStatuses
            ]
        ]);
    }
}
