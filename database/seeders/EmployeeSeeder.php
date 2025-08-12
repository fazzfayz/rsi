<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Employee;
use Carbon\Carbon;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'employee_id' => 'EMP20250001',
                'name' => 'Ahmad Rizki',
                'position' => 'Software Developer',
                'department' => 'IT',
                'email' => 'ahmad.rizki@company.com',
                'phone' => '081234567890',
                'address' => 'Jl. Sudirman No. 123, Jakarta Pusat',
                'hire_date' => '2023-01-15',
                'salary' => 8500000,
                'status' => 'active',
                'notes' => 'Karyawan teladan dengan performa yang sangat baik'
            ],
            [
                'employee_id' => 'EMP20250002',
                'name' => 'Sarah Amelia',
                'position' => 'Marketing Manager',
                'department' => 'Marketing',
                'email' => 'sarah.amelia@company.com',
                'phone' => '081234567891',
                'address' => 'Jl. Thamrin No. 45, Jakarta Pusat',
                'hire_date' => '2022-08-20',
                'salary' => 12000000,
                'status' => 'active',
                'notes' => 'Memiliki pengalaman 5 tahun di bidang marketing'
            ],
            [
                'employee_id' => 'EMP20250003',
                'name' => 'Budi Santoso',
                'position' => 'HR Specialist',
                'department' => 'HR',
                'email' => 'budi.santoso@company.com',
                'phone' => '081234567892',
                'address' => 'Jl. Gatot Subroto No. 67, Jakarta Selatan',
                'hire_date' => '2023-03-10',
                'salary' => 7500000,
                'status' => 'active',
                'notes' => 'Spesialis dalam recruitment dan employee relations'
            ],
            [
                'employee_id' => 'EMP20250004',
                'name' => 'Diana Putri',
                'position' => 'Finance Analyst',
                'department' => 'Finance',
                'email' => 'diana.putri@company.com',
                'phone' => '081234567893',
                'address' => 'Jl. Kuningan No. 89, Jakarta Selatan',
                'hire_date' => '2022-11-05',
                'salary' => 9000000,
                'status' => 'active',
                'notes' => 'Ahli dalam analisis keuangan dan budgeting'
            ],
            [
                'employee_id' => 'EMP20250005',
                'name' => 'Rudi Hermawan',
                'position' => 'Sales Executive',
                'department' => 'Sales',
                'email' => 'rudi.hermawan@company.com',
                'phone' => '081234567894',
                'address' => 'Jl. Sudirman No. 234, Jakarta Pusat',
                'hire_date' => '2023-06-15',
                'salary' => 6500000,
                'status' => 'active',
                'notes' => 'Target penjualan selalu tercapai setiap bulan'
            ],
            [
                'employee_id' => 'EMP20250006',
                'name' => 'Linda Sari',
                'position' => 'Customer Service',
                'department' => 'Customer Service',
                'email' => 'linda.sari@company.com',
                'phone' => '081234567895',
                'address' => 'Jl. Senayan No. 12, Jakarta Pusat',
                'hire_date' => '2023-09-01',
                'salary' => 5500000,
                'status' => 'active',
                'notes' => 'Sangat ramah dan membantu dalam melayani customer'
            ],
            [
                'employee_id' => 'EMP20250007',
                'name' => 'Eko Prasetyo',
                'position' => 'System Administrator',
                'department' => 'IT',
                'email' => 'eko.prasetyo@company.com',
                'phone' => '081234567896',
                'address' => 'Jl. Rasuna Said No. 78, Jakarta Selatan',
                'hire_date' => '2022-12-01',
                'salary' => 8000000,
                'status' => 'inactive',
                'notes' => 'Sedang cuti sakit'
            ],
            [
                'employee_id' => 'EMP20250008',
                'name' => 'Maya Indah',
                'position' => 'Graphic Designer',
                'department' => 'Marketing',
                'email' => 'maya.indah@company.com',
                'phone' => '081234567897',
                'address' => 'Jl. Kebayoran Baru No. 34, Jakarta Selatan',
                'hire_date' => '2023-02-20',
                'salary' => 7000000,
                'status' => 'active',
                'notes' => 'Kreatif dalam membuat desain yang menarik'
            ],
            [
                'employee_id' => 'EMP20250009',
                'name' => 'Joko Widodo',
                'position' => 'Operations Manager',
                'department' => 'Operations',
                'email' => 'joko.widodo@company.com',
                'phone' => '081234567898',
                'address' => 'Jl. Menteng No. 56, Jakarta Pusat',
                'hire_date' => '2022-05-10',
                'salary' => 15000000,
                'status' => 'active',
                'notes' => 'Memiliki pengalaman 10 tahun di bidang operations'
            ],
            [
                'employee_id' => 'EMP20250010',
                'name' => 'Siti Nurhaliza',
                'position' => 'Legal Officer',
                'department' => 'Legal',
                'email' => 'siti.nurhaliza@company.com',
                'phone' => '081234567899',
                'address' => 'Jl. Menteng Raya No. 90, Jakarta Pusat',
                'hire_date' => '2023-04-15',
                'salary' => 11000000,
                'status' => 'active',
                'notes' => 'Ahli hukum dengan spesialisasi corporate law'
            ]
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
