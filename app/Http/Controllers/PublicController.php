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

    public function apiSearch(Request $request)
    {
        $search = $request->input('query');
        
        // Autocomplete search suggestions
        if ($request->boolean('autocomplete')) {
            $suggestions = collect();
            if ($search) {
                $certs = \App\Models\Certificate::where('company_name', 'LIKE', "%$search%")
                    ->orWhere('certificate_no', 'LIKE', "%$search%")
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

        // Standard filter search
        $query = \App\Models\Certificate::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('company_name', 'LIKE', "%$search%")
                  ->orWhere('standard', 'LIKE', "%$search%")
                  ->orWhere('certificate_no', 'LIKE', "%$search%");
            });
        }

        // Get count aggregates before sidebar filters are applied, so sidebar filter options are relevant to the query
        $allMatching = $query->get();

        if ($allMatching->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'No certificate matches your search.'
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

        // Now apply checked sidebar filters
        if ($request->has('countries') && is_array($request->input('countries'))) {
            $query->whereIn('country', $request->input('countries'));
        }
        if ($request->has('cities') && is_array($request->input('cities'))) {
            $query->whereIn('city', $request->input('cities'));
        }
        if ($request->has('standards') && is_array($request->input('standards'))) {
            $query->whereIn('standard', $request->input('standards'));
        }
        if ($request->has('statuses') && is_array($request->input('statuses'))) {
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
