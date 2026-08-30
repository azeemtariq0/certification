<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingCertificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrainingCertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = TrainingCertificate::query();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('candidate_name', 'like', "%{$search}%")
                  ->orWhere('certificate_no', 'like', "%{$search}%")
                  ->orWhere('verification_id', 'like', "%{$search}%")
                  ->orWhere('candidate_id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('category')) {
            $query->where('course_category', $request->category);
        }

        if ($request->filled('standard')) {
            $query->where('standard', $request->standard);
        }

        $trainings = $query->latest()->paginate(10)->withQueryString();

        $stats = [
            'total' => TrainingCertificate::count(),
            'valid' => TrainingCertificate::where('status', 'VALID')->count(),
            'expired' => TrainingCertificate::where('status', 'EXPIRED')->count(),
            'other' => TrainingCertificate::whereNotIn('status', ['VALID', 'EXPIRED'])->count(),
        ];

        $categories = [
            'Lead Auditor',
            'Auditor',
            'Internal Auditor',
            'Awareness Training',
            'IMS Lead Auditor',
            'IMS Auditor',
            'Other'
        ];

        $standards = [
            'ISO 9001:2015',
            'ISO 14001:2015',
            'ISO 45001:2018',
            'ISO 27001:2022',
            'ISO 22000:2018',
            'IMS (ISO 9001, 14001, 45001)',
            'Other'
        ];

        return view('admin.training_certificates.index', compact('trainings', 'stats', 'categories', 'standards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Suggest a new certificate number format
        $year = date('Y');
        $count = TrainingCertificate::whereYear('created_at', $year)->count() + 1;
        $suggestedCertNo = sprintf('S2C/9001-LA/%s/%04d', $year, $count);
        $suggestedVerificationId = sprintf('S2C-9001-LA-%s-%04d', $year, $count);

        return view('admin.training_certificates.create', compact('suggestedCertNo', 'suggestedVerificationId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'certificate_no' => 'required|string|max:255|unique:training_certificates,certificate_no',
            'verification_id' => 'required|string|max:255|unique:training_certificates,verification_id',
            'candidate_name' => 'required|string|max:255',
            'candidate_id' => 'nullable|string|max:255',
            'course_title' => 'required|string|max:255',
            'course_category' => 'required|string|max:255',
            'standard' => 'required|string|max:255',
            'training_duration' => 'nullable|string|max:255',
            'training_provider' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'issue_date' => 'required|date',
            'valid_until' => 'nullable|date|after_or_equal:issue_date',
            'status' => 'required|in:VALID,EXPIRED,CANCELLED,SUSPENDED,REVOKED',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'remarks' => 'nullable|string',
        ]);

        if ($request->hasFile('certificate_file')) {
            $file = $request->file('certificate_file');
            $filename = time() . '_' . Str::slug($request->candidate_name) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('training_certificates', $filename, 'public');
            $validated['certificate_file'] = $path;
        }

        $validated['created_by'] = auth()->id();
        $validated['updated_by'] = auth()->id();

        $training = TrainingCertificate::create($validated);

        return redirect()->route('admin.training-certificates.show', $training)
            ->with('success', 'Training & Auditor Certificate successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TrainingCertificate $trainingCertificate)
    {
        return view('admin.training_certificates.show', [
            'training' => $trainingCertificate
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TrainingCertificate $trainingCertificate)
    {
        return view('admin.training_certificates.edit', [
            'training' => $trainingCertificate
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TrainingCertificate $trainingCertificate)
    {
        $validated = $request->validate([
            'certificate_no' => 'required|string|max:255|unique:training_certificates,certificate_no,' . $trainingCertificate->id,
            'verification_id' => 'required|string|max:255|unique:training_certificates,verification_id,' . $trainingCertificate->id,
            'candidate_name' => 'required|string|max:255',
            'candidate_id' => 'nullable|string|max:255',
            'course_title' => 'required|string|max:255',
            'course_category' => 'required|string|max:255',
            'standard' => 'required|string|max:255',
            'training_duration' => 'nullable|string|max:255',
            'training_provider' => 'required|string|max:255',
            'issuing_organization' => 'required|string|max:255',
            'completion_date' => 'required|date',
            'issue_date' => 'required|date',
            'valid_until' => 'nullable|date|after_or_equal:issue_date',
            'status' => 'required|in:VALID,EXPIRED,CANCELLED,SUSPENDED,REVOKED',
            'certificate_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            'remarks' => 'nullable|string',
        ]);

        if ($request->hasFile('certificate_file')) {
            // Delete old file if exists
            if ($trainingCertificate->certificate_file && Storage::disk('public')->exists($trainingCertificate->certificate_file)) {
                Storage::disk('public')->delete($trainingCertificate->certificate_file);
            }
            $file = $request->file('certificate_file');
            $filename = time() . '_' . Str::slug($request->candidate_name) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('training_certificates', $filename, 'public');
            $validated['certificate_file'] = $path;
        }

        $validated['updated_by'] = auth()->id();

        $trainingCertificate->update($validated);

        return redirect()->route('admin.training-certificates.show', $trainingCertificate)
            ->with('success', 'Training & Auditor Certificate successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TrainingCertificate $trainingCertificate)
    {
        if ($trainingCertificate->certificate_file && Storage::disk('public')->exists($trainingCertificate->certificate_file)) {
            Storage::disk('public')->delete($trainingCertificate->certificate_file);
        }

        $trainingCertificate->delete();

        return redirect()->route('admin.training-certificates.index')
            ->with('success', 'Training certificate successfully deleted.');
    }
}
