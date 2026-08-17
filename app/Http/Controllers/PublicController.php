<?php

namespace App\Http\Controllers;

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

    public function verify()
    {
        return view('pages.verify');
    }

    public function certificatePrint(\App\Models\Certificate $certificate)
    {
        return view('pages.certificate-print', compact('certificate'));
    }

    public function apiSearch(Request $request)
    {
        $search = trim((string) $request->input('query', $request->input('search', $request->input('certificate_no', $request->input('company_name', '')))));
        
        // Autocomplete search suggestions (only show when exact match is complete)
        if ($request->boolean('autocomplete')) {
            $suggestions = collect();
            if ($search !== '') {
                $certs = \App\Models\Certificate::where(function ($q) use ($search) {
                    $q->where('company_name', $search)
                      ->orWhere('certificate_no', $search)
                      ->orWhereRaw('LOWER(TRIM(company_name)) = ?', [strtolower($search)])
                      ->orWhereRaw('LOWER(TRIM(certificate_no)) = ?', [strtolower($search)]);
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

        // Standard filter search (exact match only for company name or certificate / challan no)
        if ($search === '') {
            return response()->json([
                'success' => false,
                'message' => 'Please enter an exact Company Name or Certificate / Challan No to search.'
            ]);
        }

        $query = \App\Models\Certificate::query();
        $query->where(function ($q) use ($search) {
            $q->where('company_name', $search)
              ->orWhere('certificate_no', $search)
              ->orWhereRaw('LOWER(TRIM(company_name)) = ?', [strtolower($search)])
              ->orWhereRaw('LOWER(TRIM(certificate_no)) = ?', [strtolower($search)]);
        });

        // Get count aggregates before sidebar filters are applied, so sidebar filter options are relevant to the query
        $allMatching = $query->get();

        if ($allMatching->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No certificate found matching exact Company Name or Certificate / Challan No: "' . $search . '"'
            ]);
        }

        // Group filters based on matching results
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

        // Now apply checked sidebar filters (only when the filter array is non-empty,
        // otherwise an empty whereIn([]) would match zero rows and hide valid results)
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
}
