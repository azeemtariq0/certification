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
        $certificate = null;

        if ($search) {
            $certificate = \App\Models\Certificate::where('company_name', 'LIKE', "%$search%")
                ->orWhere('standard', 'LIKE', "%$search%")
                ->first();
        }

        if (!$certificate) {
            return response()->json([
                'success' => false,
                'message' => 'No certificate matches your search.'
            ]);
        }

        // Return a partial view or JSON data. JSON is cleaner for AJAX.
        return response()->json([
            'success' => true,
            'data' => [
                'company_name' => $certificate->company_name,
                'certificate_no' => $certificate->certificate_no,
                'standard' => $certificate->standard,
                'scope' => $certificate->scope,
                'status' => $certificate->status,
                'issue_date' => date('d M Y', strtotime($certificate->issue_date)),
                'expiry_date' => date('d M Y', strtotime($certificate->expiry_date)),
                'verified_on' => date('d M Y')
            ]
        ]);
    }
}
