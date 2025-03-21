<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Medicine;

class MedicineSeeder extends Seeder
{
    public function run()
    {
        $medicines = [
            // Painkillers
            ['code' => 'M001', 'name' => 'Paracetamol', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M002', 'name' => 'Ibuprofen', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M003', 'name' => 'Aspirin', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M004', 'name' => 'Diclofenac', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M005', 'name' => 'Naproxen', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M006', 'name' => 'Ketoprofen', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M007', 'name' => 'Celecoxib', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M008', 'name' => 'Tramadol', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M009', 'name' => 'Codeine', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M010', 'name' => 'Mefenamic Acid', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M011', 'name' => 'Meloxicam', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M012', 'name' => 'Etoricoxib', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M013', 'name' => 'Dexketoprofen', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M014', 'name' => 'Nimesulide', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M015', 'name' => 'Acetaminophen', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M016', 'name' => 'Ketorolac', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M017', 'name' => 'Piroxicam', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M018', 'name' => 'Indomethacin', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M019', 'name' => 'Metamizole', 'category' => 'Painkiller', 'status' => 'Active'],
            ['code' => 'M020', 'name' => 'Aceclofenac', 'category' => 'Painkiller', 'status' => 'Active'],

            // Antibiotics
            ['code' => 'M021', 'name' => 'Amoxicillin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M022', 'name' => 'Doxycycline', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M023', 'name' => 'Ciprofloxacin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M024', 'name' => 'Azithromycin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M025', 'name' => 'Clarithromycin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M026', 'name' => 'Cephalexin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M027', 'name' => 'Erythromycin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M028', 'name' => 'Trimethoprim', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M029', 'name' => 'Clindamycin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M030', 'name' => 'Ampicillin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M031', 'name' => 'Tetracycline', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M032', 'name' => 'Gentamicin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M033', 'name' => 'Levofloxacin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M034', 'name' => 'Metronidazole', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M035', 'name' => 'Nitrofurantoin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M036', 'name' => 'Linezolid', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M037', 'name' => 'Vancomycin', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M038', 'name' => 'Cefuroxime', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M039', 'name' => 'Penicillin V', 'category' => 'Antibiotic', 'status' => 'Active'],
            ['code' => 'M040', 'name' => 'Moxifloxacin', 'category' => 'Antibiotic', 'status' => 'Active'],

            // Antihistamines
            ['code' => 'M041', 'name' => 'Cetirizine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M042', 'name' => 'Loratadine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M043', 'name' => 'Fexofenadine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M044', 'name' => 'Diphenhydramine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M045', 'name' => 'Chlorpheniramine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M046', 'name' => 'Desloratadine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M047', 'name' => 'Levocetirizine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M048', 'name' => 'Promethazine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M049', 'name' => 'Ketotifen', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M050', 'name' => 'Mizolastine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M051', 'name' => 'Clemastine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M052', 'name' => 'Rupatadine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M053', 'name' => 'Ebastine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M054', 'name' => 'Azelastine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M055', 'name' => 'Mizolastine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M056', 'name' => 'Terfenadine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M057', 'name' => 'Astemizole', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M058', 'name' => 'Cyproheptadine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M059', 'name' => 'Pheniramine', 'category' => 'Antihistamine', 'status' => 'Active'],
            ['code' => 'M060', 'name' => 'Triprolidine', 'category' => 'Antihistamine', 'status' => 'Active'],

            // Cardiovascular
            ['code' => 'M061', 'name' => 'Atorvastatin', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M062', 'name' => 'Losartan', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M063', 'name' => 'Metoprolol', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M064', 'name' => 'Amlodipine', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M065', 'name' => 'Lisinopril', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M066', 'name' => 'Enalapril', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M067', 'name' => 'Simvastatin', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M068', 'name' => 'Ramipril', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M069', 'name' => 'Carvedilol', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M070', 'name' => 'Irbesartan', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M071', 'name' => 'Valsartan', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M072', 'name' => 'Bisoprolol', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M073', 'name' => 'Candesartan', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M074', 'name' => 'Telmisartan', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M075', 'name' => 'Rosuvastatin', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M076', 'name' => 'Propranolol', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M077', 'name' => 'Nifedipine', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M078', 'name' => 'Felodipine', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M079', 'name' => 'Diltiazem', 'category' => 'Cardiovascular', 'status' => 'Active'],
            ['code' => 'M080', 'name' => 'Spironolactone', 'category' => 'Cardiovascular', 'status' => 'Active'],

            // Diabetes
            ['code' => 'M081', 'name' => 'Metformin', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M082', 'name' => 'Glipizide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M083', 'name' => 'Glyburide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M084', 'name' => 'Pioglitazone', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M085', 'name' => 'Sitagliptin', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M086', 'name' => 'Insulin Glargine', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M087', 'name' => 'Acarbose', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M088', 'name' => 'Empagliflozin', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M089', 'name' => 'Liraglutide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M090', 'name' => 'Dapagliflozin', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M091', 'name' => 'Canagliflozin', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M092', 'name' => 'Vildagliptin', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M093', 'name' => 'Saxagliptin', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M094', 'name' => 'Exenatide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M095', 'name' => 'Dulaglutide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M096', 'name' => 'Glimepiride', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M097', 'name' => 'Repaglinide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M098', 'name' => 'Nateglinide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M099', 'name' => 'Gliclazide', 'category' => 'Diabetes', 'status' => 'Active'],
            ['code' => 'M100', 'name' => 'Troglitazone', 'category' => 'Diabetes', 'status' => 'Active'],
        ];

        foreach ($medicines as $medicine) {
            Medicine::updateOrCreate(
                ['code' => $medicine['code']], 
                $medicine
            );
        }
    }
}