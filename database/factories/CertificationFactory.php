<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Certification>
 */
class CertificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->randomElement([
            "Project Management Professional (PMP)",
            "Certified ScrumMaster (CSM)",
            "Cisco Certified Network Associate (CCNA)",
            "Microsoft Certified: Azure Administrator Associate",
            "Certified Information Systems Security Professional (CISSP)",
            "Amazon Web Services (AWS) Certified Solutions Architect",
            "Certified Ethical Hacker (CEH)",
            "Certified Data Scientist (CDS)",
            "Certified Information Systems Auditor (CISA)",
            "Certified Information Security Manager (CISM)",
            "Certified Six Sigma Black Belt (CSSBB)",
            "CompTIA Security+",
            "Certified Kubernetes Administrator (CKA)",
            "Certified Information Privacy Professional (CIPP)",
            "Certified Professional in Healthcare Information and Management Systems (CPHIMS)",
            "Certified Business Analysis Professional (CBAP)",
            "Salesforce Certified Administrator",
            "Google Certified Professional Data Engineer",
            "Certified Supply Chain Professional (CSCP)",
            "Certified Financial Analyst (CFA)",
            "Certified Human Resources Professional (CHRP)",
            "Certified Medical Assistant (CMA)",
            "Certified Pharmacy Technician (CPhT)",
            "Certified Veterinary Technician (CVT)",
            "Certified Welding Inspector (CWI)"
        ]);
        return [
            'name' => $name,
            'issuing_organization' => fake()->company(),
            'issue_date' => fake()->dateTimeBetween('-5 years'),
        ];
    }
}
