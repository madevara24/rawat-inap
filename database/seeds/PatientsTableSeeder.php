<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diseases = DB::table('diseases')
        ->select('disease_code')
        ->pluck('disease_code');
        $diseasesList = array();
        
        for ($i=0; $i < count($diseases); $i++) { 
            $diseasesList[$i] = $diseases[$i];
        }
        
        for ($i=0; $i < 100; $i++) { 
            $patient = $this->createFakePatient($diseasesList);
            DB::table('patients')->insert([
                'no_rm' => $patient['no_rm'],
                'treatment_type' => $patient['treatment_type'],
                'name' => $patient['name'],
                'birthday' => $patient['birthday'],
                'age_class' => $patient['age_class'],
                'age' => $patient['age'],
                'gender' => $patient['gender'],
                'disease_code' => $patient['disease_code'],
                'domicile' => $patient['domicile'],
                'patient_type' => $patient['patient_type'],
                'entry_date' => $patient['entry_date'],
                'exit_date' => $patient['exit_date'],
                'payment_type' => $patient['payment_type'],
                'release_note' => $patient['release_note'],
            ]);
        }
    }

    private function createFakePatient(array $diseases)
    {
        $faker = Faker::create('App/Patient');
        
        $result['no_rm'] = $faker->ean8();
        $result['gender'] = $faker->randomElement($array = array ('Laki-Laki','Perempuan'));
        $result['birthday'] = $faker->dateTimeBetween($startDate = '-60 years', $endDate = 'now', $timezone = null);
        $result['disease_code'] = $faker->randomElement($array = $diseases);
        $result['domicile'] = $faker->randomElement($array = array ('DW','LW'));
        $result['patient_type'] = $faker->randomElement($array = array ('Lama','Baru'));
        $result['payment_type'] = $faker->randomElement($array = array ('UM','ASK','JAMKESMAS','JAMKESDA','BPJS','KIS','SPM'));
        $result['age'] = date_diff($result['birthday'],date_create())->y;
        $result['entry_date'] = $faker->dateTimeBetween($startDate = '2018-12-01', $endDate = '2018-12-28', $timezone = null);
        $result['exit_date'] = $faker->dateTimeBetween($startDate = $result['entry_date'], $endDate = '2019-01-10', $timezone = null);
        
        if($result['gender'] == 'Laki-Laki' || $result['age'] < 18 || $result['age'] > 40)
            $result['treatment_type'] = 'Umum';
        else
            $result['treatment_type'] = $faker->randomElement($array = array ('Umum','Persalinan'));
        
        if($result['gender'] == 'Laki-Laki')
            $result['name'] = $faker->firstNameMale()." ".$faker->lastName();
        else
            $result['name'] = $faker->firstNameFemale()." ".$faker->lastName();
        
        if(date_diff($result['entry_date'],$result['exit_date'])->m==0 && date_diff($result['entry_date'],$result['exit_date'])->d<3)
            $result['release_note'] = $faker->randomElement($array = array ('Pulang','Dirujuk','Meninggal < 48 jam'));
        else
            $result['release_note'] = $faker->randomElement($array = array ('Pulang','Dirujuk','Meninggal > 48 jam'));
        
        $result['age_class'] = $this->getAgeClass($result['birthday'],$result['exit_date']);

        return $result;
    }

    private function getAgeClass($birthday, $exitDate)
    {
        $diff = date_diff($birthday, $exitDate);
        if ($diff->y == 0) {
            if ($diff->m == 0) {
                if ($diff->d < 8) {
                    return 0;
                } else if ($diff->d < 29) {
                    return 1;
                } else {
                    return 2;
                }

            } else {
                return 2;
            }

        } else if ($diff->y < 4) {
            return 3;
        } else if ($diff->y < 6) {
            return 4;
        } else if ($diff->y < 10) {
            return 5;
        } else if ($diff->y < 12) {
            return 6;
        } else if ($diff->y < 15) {
            return 7;
        } else if ($diff->y < 18) {
            return 8;
        } else if ($diff->y < 20) {
            return 9;
        } else if ($diff->y < 25) {
            return 10;
        } else if ($diff->y < 35) {
            return 11;
        } else if ($diff->y < 45) {
            return 12;
        } else if ($diff->y < 55) {
            return 13;
        } else if ($diff->y < 60) {
            return 14;
        } else if ($diff->y < 65) {
            return 15;
        } else if ($diff->y < 70) {
            return 16;
        } else {
            return 17;
        }

    }
}
