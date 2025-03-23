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
            ['code' => 'M001', 'name' => 'Paracetamol', 'category' => 'Painkiller'],
            ['code' => 'M002', 'name' => 'Ibuprofen', 'category' => 'Painkiller'],
            ['code' => 'M003', 'name' => 'Aspirin', 'category' => 'Painkiller'],
            ['code' => 'M004', 'name' => 'Diclofenac', 'category' => 'Painkiller'],
            ['code' => 'M005', 'name' => 'Naproxen', 'category' => 'Painkiller'],
            ['code' => 'M006', 'name' => 'Ketoprofen', 'category' => 'Painkiller'],
            ['code' => 'M007', 'name' => 'Celecoxib', 'category' => 'Painkiller'],
            ['code' => 'M008', 'name' => 'Tramadol', 'category' => 'Painkiller'],
            ['code' => 'M009', 'name' => 'Codeine', 'category' => 'Painkiller'],
            ['code' => 'M010', 'name' => 'Mefenamic Acid', 'category' => 'Painkiller'],
            ['code' => 'M011', 'name' => 'Meloxicam', 'category' => 'Painkiller'],
            ['code' => 'M012', 'name' => 'Etoricoxib', 'category' => 'Painkiller'],
            ['code' => 'M013', 'name' => 'Dexketoprofen', 'category' => 'Painkiller'],
            ['code' => 'M014', 'name' => 'Nimesulide', 'category' => 'Painkiller'],
            ['code' => 'M015', 'name' => 'Acetaminophen', 'category' => 'Painkiller'],
            ['code' => 'M016', 'name' => 'Ketorolac', 'category' => 'Painkiller'],
            ['code' => 'M017', 'name' => 'Piroxicam', 'category' => 'Painkiller'],
            ['code' => 'M018', 'name' => 'Indomethacin', 'category' => 'Painkiller'],
            ['code' => 'M019', 'name' => 'Metamizole', 'category' => 'Painkiller'],
            ['code' => 'M020', 'name' => 'Aceclofenac', 'category' => 'Painkiller'],

            // Antibiotics
            ['code' => 'M021', 'name' => 'Amoxicillin', 'category' => 'Antibiotic'],
            ['code' => 'M022', 'name' => 'Doxycycline', 'category' => 'Antibiotic'],
            ['code' => 'M023', 'name' => 'Ciprofloxacin', 'category' => 'Antibiotic'],
            ['code' => 'M024', 'name' => 'Azithromycin', 'category' => 'Antibiotic'],
            ['code' => 'M025', 'name' => 'Clarithromycin', 'category' => 'Antibiotic'],
            ['code' => 'M026', 'name' => 'Cephalexin', 'category' => 'Antibiotic'],
            ['code' => 'M027', 'name' => 'Erythromycin', 'category' => 'Antibiotic'],
            ['code' => 'M028', 'name' => 'Trimethoprim', 'category' => 'Antibiotic'],
            ['code' => 'M029', 'name' => 'Clindamycin', 'category' => 'Antibiotic'],
            ['code' => 'M030', 'name' => 'Ampicillin', 'category' => 'Antibiotic'],
            ['code' => 'M031', 'name' => 'Tetracycline', 'category' => 'Antibiotic'],
            ['code' => 'M032', 'name' => 'Gentamicin', 'category' => 'Antibiotic'],
            ['code' => 'M033', 'name' => 'Levofloxacin', 'category' => 'Antibiotic'],
            ['code' => 'M034', 'name' => 'Metronidazole', 'category' => 'Antibiotic'],
            ['code' => 'M035', 'name' => 'Nitrofurantoin', 'category' => 'Antibiotic'],
            ['code' => 'M036', 'name' => 'Linezolid', 'category' => 'Antibiotic'],
            ['code' => 'M037', 'name' => 'Vancomycin', 'category' => 'Antibiotic'],
            ['code' => 'M038', 'name' => 'Cefuroxime', 'category' => 'Antibiotic'],
            ['code' => 'M039', 'name' => 'Penicillin V', 'category' => 'Antibiotic'],
            ['code' => 'M040', 'name' => 'Moxifloxacin', 'category' => 'Antibiotic'],

            // Antihistamines
            ['code' => 'M041', 'name' => 'Cetirizine', 'category' => 'Antihistamine'],
            ['code' => 'M042', 'name' => 'Loratadine', 'category' => 'Antihistamine'],
            ['code' => 'M043', 'name' => 'Fexofenadine', 'category' => 'Antihistamine'],
            ['code' => 'M044', 'name' => 'Diphenhydramine', 'category' => 'Antihistamine'],
            ['code' => 'M045', 'name' => 'Chlorpheniramine', 'category' => 'Antihistamine'],
            ['code' => 'M046', 'name' => 'Desloratadine', 'category' => 'Antihistamine'],
            ['code' => 'M047', 'name' => 'Levocetirizine', 'category' => 'Antihistamine'],
            ['code' => 'M048', 'name' => 'Promethazine', 'category' => 'Antihistamine'],
            ['code' => 'M049', 'name' => 'Ketotifen', 'category' => 'Antihistamine'],
            ['code' => 'M050', 'name' => 'Mizolastine', 'category' => 'Antihistamine'],
            ['code' => 'M051', 'name' => 'Clemastine', 'category' => 'Antihistamine'],
            ['code' => 'M052', 'name' => 'Rupatadine', 'category' => 'Antihistamine'],
            ['code' => 'M053', 'name' => 'Ebastine', 'category' => 'Antihistamine'],
            ['code' => 'M054', 'name' => 'Azelastine', 'category' => 'Antihistamine'],
            ['code' => 'M055', 'name' => 'Mizolastine', 'category' => 'Antihistamine'],
            ['code' => 'M056', 'name' => 'Terfenadine', 'category' => 'Antihistamine'],
            ['code' => 'M057', 'name' => 'Astemizole', 'category' => 'Antihistamine'],
            ['code' => 'M058', 'name' => 'Cyproheptadine', 'category' => 'Antihistamine'],
            ['code' => 'M059', 'name' => 'Pheniramine', 'category' => 'Antihistamine'],
            ['code' => 'M060', 'name' => 'Triprolidine', 'category' => 'Antihistamine'],

            // Cardiovascular
            ['code' => 'M061', 'name' => 'Atorvastatin', 'category' => 'Cardiovascular'],
            ['code' => 'M062', 'name' => 'Losartan', 'category' => 'Cardiovascular'],
            ['code' => 'M063', 'name' => 'Metoprolol', 'category' => 'Cardiovascular'],
            ['code' => 'M064', 'name' => 'Amlodipine', 'category' => 'Cardiovascular'],
            ['code' => 'M065', 'name' => 'Lisinopril', 'category' => 'Cardiovascular'],
            ['code' => 'M066', 'name' => 'Enalapril', 'category' => 'Cardiovascular'],
            ['code' => 'M067', 'name' => 'Simvastatin', 'category' => 'Cardiovascular'],
            ['code' => 'M068', 'name' => 'Ramipril', 'category' => 'Cardiovascular'],
            ['code' => 'M069', 'name' => 'Carvedilol', 'category' => 'Cardiovascular'],
            ['code' => 'M070', 'name' => 'Irbesartan', 'category' => 'Cardiovascular'],
            ['code' => 'M071', 'name' => 'Valsartan', 'category' => 'Cardiovascular'],
            ['code' => 'M072', 'name' => 'Bisoprolol', 'category' => 'Cardiovascular'],
            ['code' => 'M073', 'name' => 'Candesartan', 'category' => 'Cardiovascular'],
            ['code' => 'M074', 'name' => 'Telmisartan', 'category' => 'Cardiovascular'],
            ['code' => 'M075', 'name' => 'Rosuvastatin', 'category' => 'Cardiovascular'],
            ['code' => 'M076', 'name' => 'Propranolol', 'category' => 'Cardiovascular'],
            ['code' => 'M077', 'name' => 'Nifedipine', 'category' => 'Cardiovascular'],
            ['code' => 'M078', 'name' => 'Felodipine', 'category' => 'Cardiovascular'],
            ['code' => 'M079', 'name' => 'Diltiazem', 'category' => 'Cardiovascular'],
            ['code' => 'M080', 'name' => 'Spironolactone', 'category' => 'Cardiovascular'],

            // Diabetes
            ['code' => 'M081', 'name' => 'Metformin', 'category' => 'Diabetes'],
            ['code' => 'M082', 'name' => 'Glipizide', 'category' => 'Diabetes'],
            ['code' => 'M083', 'name' => 'Glyburide', 'category' => 'Diabetes'],
            ['code' => 'M084', 'name' => 'Pioglitazone', 'category' => 'Diabetes'],
            ['code' => 'M085', 'name' => 'Sitagliptin', 'category' => 'Diabetes'],
            ['code' => 'M086', 'name' => 'Insulin Glargine', 'category' => 'Diabetes'],
            ['code' => 'M087', 'name' => 'Acarbose', 'category' => 'Diabetes'],
            ['code' => 'M088', 'name' => 'Empagliflozin', 'category' => 'Diabetes'],
            ['code' => 'M089', 'name' => 'Liraglutide', 'category' => 'Diabetes'],
            ['code' => 'M090', 'name' => 'Dapagliflozin', 'category' => 'Diabetes'],
            ['code' => 'M091', 'name' => 'Canagliflozin', 'category' => 'Diabetes'],
            ['code' => 'M092', 'name' => 'Vildagliptin', 'category' => 'Diabetes'],
            ['code' => 'M093', 'name' => 'Saxagliptin', 'category' => 'Diabetes'],
            ['code' => 'M094', 'name' => 'Exenatide', 'category' => 'Diabetes'],
            ['code' => 'M095', 'name' => 'Dulaglutide', 'category' => 'Diabetes'],
            ['code' => 'M096', 'name' => 'Glimepiride', 'category' => 'Diabetes'],
            ['code' => 'M097', 'name' => 'Repaglinide', 'category' => 'Diabetes'],
            ['code' => 'M098', 'name' => 'Nateglinide', 'category' => 'Diabetes'],
            ['code' => 'M099', 'name' => 'Gliclazide', 'category' => 'Diabetes'],
            ['code' => 'M100', 'name' => 'Troglitazone', 'category' => 'Diabetes'],
        ];

        foreach ($medicines as $medicine) {
            // Add a random supplier_id between 1 and 10
            $medicine['supplier_id'] = rand(1, 10);

            Medicine::updateOrCreate(
                ['code' => $medicine['code']], 
                $medicine
            );
        }
    }
}