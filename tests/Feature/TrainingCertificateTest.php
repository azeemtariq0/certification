<?php

namespace Tests\Feature;

use App\Models\Role;
use App\Models\TrainingCertificate;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TrainingCertificateTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_training_verification_page_loads()
    {
        $response = $this->get(route('verify.training'));
        $response->assertStatus(200);
        $response->assertSee('Training &amp; Auditor Certificate Verification', false);
    }

    public function test_training_api_search_finds_record()
    {
        $training = TrainingCertificate::create([
            'certificate_no' => 'S2C/9001-LA/2026/9999',
            'verification_id' => 'S2C-9001-LA-2026-9999',
            'candidate_name' => 'Test Candidate',
            'course_title' => 'ISO 9001:2015 QMS Lead Auditor',
            'course_category' => 'Lead Auditor',
            'standard' => 'ISO 9001:2015',
            'training_provider' => 'S2 Certification Academy',
            'issuing_organization' => 'S2 Certification',
            'completion_date' => '2026-01-01',
            'issue_date' => '2026-01-05',
            'valid_until' => '2029-01-04',
            'status' => 'VALID',
        ]);

        $response = $this->postJson(route('verify.training.search'), [
            'query' => $training->certificate_no
        ]);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);
        $response->assertJsonFragment([
            'certificate_no' => $training->certificate_no,
            'candidate_name' => $training->candidate_name
        ]);
    }

    public function test_training_print_page_loads()
    {
        $training = TrainingCertificate::create([
            'certificate_no' => 'S2C/9001-LA/2026/8888',
            'verification_id' => 'S2C-9001-LA-2026-8888',
            'candidate_name' => 'Jane Doe',
            'course_title' => 'ISO 14001:2015 EMS Lead Auditor',
            'course_category' => 'Lead Auditor',
            'standard' => 'ISO 14001:2015',
            'training_provider' => 'S2 Certification Academy',
            'issuing_organization' => 'S2 Certification',
            'completion_date' => '2026-01-01',
            'issue_date' => '2026-01-05',
            'valid_until' => '2029-01-04',
            'status' => 'VALID',
        ]);

        $response = $this->get(route('verify.training.print', $training->id));
        $response->assertStatus(200);
        $response->assertSee('Jane Doe');
        $response->assertSee('Official Training &amp; Auditor Verification Transcript', false);
    }

    public function test_admin_can_view_training_list()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get(route('admin.training-certificates.index'));
        $response->assertStatus(200);
        $response->assertSee('Training &amp; Auditor Certificates', false);
    }
}
