<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Permissions
        $p1 = \App\Models\Permission::create(['name' => 'Manage Certificates', 'slug' => 'manage-certificates']);
        $p2 = \App\Models\Permission::create(['name' => 'Manage Users', 'slug' => 'manage-users']);
        $p3 = \App\Models\Permission::create(['name' => 'Manage Roles', 'slug' => 'manage-roles']);

        // Roles
        $adminRole = \App\Models\Role::create(['name' => 'Administrator', 'slug' => 'admin']);
        $managerRole = \App\Models\Role::create(['name' => 'Manager', 'slug' => 'manager']);

        $adminRole->permissions()->attach([$p1->id, $p2->id, $p3->id]);
        $managerRole->permissions()->attach([$p1->id]);

        // Admin User
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
            'role_id' => $adminRole->id,
        ]);

        // Sample Certificates
        $certificates = [
            [
                'company_name' => 'ABC Industries Pvt Ltd',
                'certificate_no' => 'S2-ISO-24011',
                'standard' => 'ISO 9001:2015',
                'scope' => 'Manufacturing of Plastic Packaging Products',
                'issue_date' => '2025-01-10',
                'expiry_date' => '2028-01-09',
                'status' => 'Active',
                'country' => 'Pakistan',
                'city' => 'Karachi',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'PNAC',
            ],
            [
                'company_name' => 'Gulf Logistics Group',
                'certificate_no' => 'S2-ISO-24012',
                'standard' => 'ISO 9001:2015',
                'scope' => 'Warehousing, Cold Chain Storage, and Freight Forwarding Services',
                'issue_date' => '2024-06-15',
                'expiry_date' => '2027-06-14',
                'status' => 'Active',
                'country' => 'United Arab Emirates',
                'city' => 'Dubai',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'IAS',
            ],
            [
                'company_name' => 'Riyadh Trading Corporation',
                'certificate_no' => 'S2-ISO-24013',
                'standard' => 'ISO 14001:2015',
                'scope' => 'Import, Warehousing, and Distribution of Industrial Electrical Components',
                'issue_date' => '2025-02-20',
                'expiry_date' => '2028-02-19',
                'status' => 'Active',
                'country' => 'Saudi Arabia',
                'city' => 'Riyadh',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'IAS',
            ],
            [
                'company_name' => 'Al-Maha Food Industries',
                'certificate_no' => 'S2-ISO-24014',
                'standard' => 'ISO 22000:2018',
                'scope' => 'Processing, Packaging, and Distribution of Pasteurized Milk and Dairy Products',
                'issue_date' => '2023-09-01',
                'expiry_date' => '2026-08-31',
                'status' => 'Suspended',
                'country' => 'Oman',
                'city' => 'Muscat',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'DAC',
            ],
            [
                'company_name' => 'Apex Software Solutions',
                'certificate_no' => 'S2-ISO-24015',
                'standard' => 'ISO 27001:2022',
                'scope' => 'Information Security Management for Custom Software Development and SaaS Operations',
                'issue_date' => '2024-11-10',
                'expiry_date' => '2027-11-09',
                'status' => 'Active',
                'country' => 'Pakistan',
                'city' => 'Lahore',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'PNAC',
            ],
            [
                'company_name' => 'British Engineering Services',
                'certificate_no' => 'S2-ISO-24016',
                'standard' => 'ISO 45001:2018',
                'scope' => 'Design, Fabrication, and On-site Installation of Heavy Industrial Piping Systems',
                'issue_date' => '2023-12-05',
                'expiry_date' => '2026-12-04',
                'status' => 'Expired',
                'country' => 'United Kingdom',
                'city' => 'London',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'UKAS',
            ],
            [
                'company_name' => 'Saudi Petrochemical Corp',
                'certificate_no' => 'S2-ISO-24017',
                'standard' => 'ISO 14001:2015',
                'scope' => 'Refining, Granulation, and Export of Industrial Grade Polyethylene Resins',
                'issue_date' => '2025-03-01',
                'expiry_date' => '2028-02-29',
                'status' => 'Active',
                'country' => 'Saudi Arabia',
                'city' => 'Riyadh',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'IAS',
            ],
            [
                'company_name' => 'Emirates Tech Hub',
                'certificate_no' => 'S2-ISO-24018',
                'standard' => 'ISO 27001:2022',
                'scope' => 'Provision of Public Cloud Infrastructure, Managed Firewall, and Cyber Security Center (SOC)',
                'issue_date' => '2025-04-12',
                'expiry_date' => '2028-04-11',
                'status' => 'Active',
                'country' => 'United Arab Emirates',
                'city' => 'Dubai',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'IAS',
            ],
            [
                'company_name' => 'Indus Textile Mills',
                'certificate_no' => 'S2-ISO-24019',
                'standard' => 'ISO 9001:2015',
                'scope' => 'Spinning, Weaving, and Dyeing of Cotton Fabrics and Finished Apparels for Export',
                'issue_date' => '2024-01-20',
                'expiry_date' => '2027-01-19',
                'status' => 'Active',
                'country' => 'Pakistan',
                'city' => 'Karachi',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'PNAC',
            ],
            [
                'company_name' => 'United Foods Corp',
                'certificate_no' => 'S2-ISO-24020',
                'standard' => 'ISO 22000:2018',
                'scope' => 'Storage, Packaging, and Wholesale Distribution of Frozen Meat and Canned Foods',
                'issue_date' => '2024-05-18',
                'expiry_date' => '2027-05-17',
                'status' => 'Active',
                'country' => 'United States',
                'city' => 'New York',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'ANAB',
            ],
            [
                'company_name' => 'Lahore Pharmaceuticals Ltd',
                'certificate_no' => 'S2-ISO-24021',
                'standard' => 'ISO 9001:2015',
                'scope' => 'Manufacture of Sterile Liquid Injections, Syrups, and Hard Gelatin Capsules',
                'issue_date' => '2024-08-11',
                'expiry_date' => '2027-08-10',
                'status' => 'Active',
                'country' => 'Pakistan',
                'city' => 'Lahore',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'PNAC',
            ],
            [
                'company_name' => 'Muscat Electrical Services',
                'certificate_no' => 'S2-ISO-24022',
                'standard' => 'ISO 45001:2018',
                'scope' => 'Testing, Commissioning, and Routine Maintenance of High Voltage Power Transformers',
                'issue_date' => '2025-05-22',
                'expiry_date' => '2028-05-21',
                'status' => 'Active',
                'country' => 'Oman',
                'city' => 'Muscat',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'DAC',
            ],
            [
                'company_name' => 'Jeddah Construction Co',
                'certificate_no' => 'S2-ISO-24023',
                'standard' => 'ISO 9001:2015',
                'scope' => 'Design, Construction, and Management of Commercial and Residential Civil Infrastructure Projects',
                'issue_date' => '2023-04-15',
                'expiry_date' => '2026-04-14',
                'status' => 'Withdrawn',
                'country' => 'Saudi Arabia',
                'city' => 'Riyadh',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'IAS',
            ],
            [
                'company_name' => 'Gulf General Insurances',
                'certificate_no' => 'S2-ISO-24024',
                'standard' => 'ISO 27001:2022',
                'scope' => 'Information Security for Life, Health, and Property Insurance Underwriting Operations',
                'issue_date' => '2024-07-25',
                'expiry_date' => '2027-07-24',
                'status' => 'Active',
                'country' => 'United Arab Emirates',
                'city' => 'Dubai',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'IAS',
            ],
            [
                'company_name' => 'Islamabad Agri-Tech',
                'certificate_no' => 'S2-ISO-24025',
                'standard' => 'ISO 14001:2015',
                'scope' => 'Research, Development, and Bulk Manufacturing of Eco-Friendly Organic Fertilizers',
                'issue_date' => '2025-02-15',
                'expiry_date' => '2028-02-14',
                'status' => 'Active',
                'country' => 'Pakistan',
                'city' => 'Islamabad',
                'certification_body' => 'S2 Certification',
                'accreditation_body' => 'PNAC',
            ]
        ];

        foreach ($certificates as $cert) {
            \App\Models\Certificate::create($cert);
        }

        $this->call(TrainingCertificateSeeder::class);
    }
}
