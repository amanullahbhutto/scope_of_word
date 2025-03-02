<?php
namespace App\Imports;

use App\Models\CompanyInfo;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class CompanyInfoImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    
        public function model(array $row)
        {
        //     echo '<pre>';
        //   print_r($row);
        //     die();

            if (isset($row['business_name'])) {
                $data = CompanyInfo::where('name_of_company', $row['business_name'])->first();
                if ($data) {
                    $updatedSource = $data->source_of_this_information
                                     ? $data->source_of_this_information . '/ SRB'
                                     : 'SRB';
                    $data->complete_address = $data->complete_address ?: ($row['address'] ?? null);
                    $data->source_provided_id = $data->source_provided_id ?: ($row['sr'] ?? null);
                  

                    $data->source_of_this_information = $updatedSource;
                    $data->last_updated_date = now(); 
                    $data->save();
                    return $data;
                } else {
                    $data = new CompanyInfo([
                        'name_of_company' => $row['business_name'] ?? null,
                        'complete_address' => $row['address'] ?? null,
                        'source_provided_id' => $row['sr'] ?? null,
                        'last_updated_date' => now(),
                        'source_of_this_information' => 'SRB', 
                        'no_of_offices' => null,
                        'head_office_city' => null,
                    ]);
                    $data->save();

                    return $data; // Return the newly created model
                }
            }

            // if (isset($row['name_of_business_entity'])) {
            //     // Fetch existing company info from the database
            //     $data = CompanyInfo::where('name_of_company', $row['name_of_business_entity'])->first();

            //     if ($data) { // Check if the record exists
            //         // Append '/ ICT' to the existing 'source_of_this_information' if not empty
            //         $updatedSource = $data->source_of_this_information
            //                          ? $data->source_of_this_information . '/ SESSI'
            //                          : 'SESSI';

            //         // Check for null or empty fields and update only those
            //         $data->complete_address = $data->complete_address ?: ($row['address'] ?? null);
            //         $data->source_provided_id = $data->source_provided_id ?: ($row['sr'] ?? null);
            //         $data->company_type = $data->company_type ?: ($row['nature_of_business'] ?? null);
            //         $data->contact_person = $data->contact_person ?: ($row['name_of_owner'] ?? null);
            //         $data->registered_address_city = $data->registered_address_city ?: ($row['city_name'] ?? null);
            //         $data->email_address = $data->email_address ?: ($row['email'] ?? null);
            //         $data->telephone_no = $data->telephone_no ?: ($row['contact_no_of_owner'] ?? null);
            //         $data->sector = $data->sector ?: ($row['sector'] ?? null);

            //         // Always update 'source_of_this_information' and 'last_updated_date'
            //         $data->cell_no = $row['cell_no'] ?? null;
            //         $data->source_of_this_information = $updatedSource;
            //         $data->last_updated_date = now(); // Timestamp for when the record was updated

            //         // Save the updated record
            //         $data->save();

            //         return $data; // Return the updated model
            //     } else {
            //         // If no existing record is found, create a new one
            //         $data = new CompanyInfo([
            //             'name_of_company' => $row['name_of_business_entity'] ?? null,
            //             'complete_address' => $row['address'] ?? null,
            //             'source_provided_id' => $row['sr'] ?? null,
            //             'company_type' => $row['code_desc'] ?? null,
            //             'registered_address_city' => $row['city_name'] ?? null,
            //             'contact_person' => $row['contact_person'] ?? null,
            //             'telephone_no' => $row['telephone'] ?? null,
            //             'email_address' => $row['email'] ?? null,
            //             'cell_no' => $row['cell_no'] ?? null,
            //             'registered_address_province' => $row['prov_name'] ?? null,
            //             'last_updated_date' => now(),
            //             'source_of_this_information' => 'SESSI', // Default source
            //             'no_of_offices' => null,
            //             'head_office_city' => null,
            //         ]);

            //         // Save the newly created record
            //         $data->save();

            //         return $data; // Return the newly created model
            //     }
            // }


        // if (isset($row['name_of_establishment'])) {
        //     $data = CompanyInfo::where('name_of_company', $row['name_of_establishment'])->first();
        
        //     if (!empty($data)) {
        //         // Append '/ ICT' to the existing 'source_of_this_information' if not empty
        //         $updatedSource = $data->source_of_this_information 
        //                         ? $data->source_of_this_information . '/ EOBI' 
        //                         : 'EOBI';
        
        //         // Check for null or empty fields and update only those
        //         if (is_null($data->complete_address) || $data->complete_address == '') {
        //             $data->complete_address = $row['address'] ?? null;
        //         }
        
        //         if (is_null($data->source_provided_id) || $data->source_provided_id == '') {
        //             $data->source_provided_id = $row['s_no'] ?? null;
        //         }
        
        //         if (is_null($data->company_type) || $data->company_type == '') {
        //             $data->company_type = $row['code_desc'] ?? null;
        //         }
        
        //         if (is_null($data->contact_person) || $data->contact_person == '') {
        //             $data->contact_person = $row['contact_person'] ?? null;
        //         }
        
        //         if (is_null($data->registered_address_city) || $data->registered_address_city == '') {
        //             $data->registered_address_city = $row['city_name'] ?? null;
        //         }
        
        //         if (is_null($data->email_address) || $data->email_address == '') {
        //             $data->email_address = $row['email'] ?? null;
        //         }
        
        //         if (is_null($data->telephone_no) || $data->telephone_no == '') {
        //             $data->telephone_no = $row['telephone'] ?? null;
        //         }
        
        //         if (is_null($data->registered_address_province) || $data->registered_address_province == '') {
        //             $data->registered_address_province = $row['prov_name'] ?? null;
        //         }
        
        //         // Always update 'source_of_this_information' and 'last_updated_date'
        //         $data->cell_no = $row['cell_no'] ?? null;
        //         $data->source_of_this_information = $updatedSource;
        //         $data->last_updated_date = now();
        
        //         // Save the updated data
        //         $data->save();
        
        //         return $data; // Return the updated model
        //     } else {
        //         // Create a new record with the additional fields
        //         $data = new CompanyInfo([
        //             'name_of_company' => $row['name_of_establishment'] ?? null,
        //             'complete_address' => $row['address'] ?? null,
        //             'source_provided_id' => $row['s_no'] ?? null,
        //             'company_type' => $row['code_desc'] ?? null,
        //             'registered_address_city' => $row['city_name'] ?? null,
        //             'contact_person' => $row['contact_person'] ?? null,
        //             'telephone_no' => $row['telephone'] ?? null,
        //             'email_address' => $row['email'] ?? null,
        //             'cell_no' => $row['cell_no'] ?? null,
        //             'registered_address_province' => $row['prov_name'] ?? null,
        //             'last_updated_date' => now(),
        //             'source_of_this_information' => 'EOBI',
        //             'no_of_offices' => null,
        //             'head_office_city' => null,
        //         ]);
        
        //         $data->save(); // Save the new instance
        
        //         return $data; // Return the newly created model
        //     }
        // }


            // ICT

            // if (!empty($data)) {
            //      $updatedSource = $data->source_of_this_information 
            //     ? $data->source_of_this_information . '/ ICT' 
            //     : 'ICT';

            //         // Check for null or empty fields and update only those
            //         if (empty($data->complete_address) || $data->complete_address == null) {
            //         $data->complete_address = $row['address'] ?? null;
            //         }

            //         if (empty($data->source_provided_id) || $data->source_provided_id == null) {
            //             $data->source_provided_id = $row['sno'] ?? null;
            //             }

            //         if (empty($data->contact_person) || $data->contact_person == null) {
            //         $data->contact_person = $row['focal_person_name'] ?? null;
            //         }

            //         if (empty($data->registered_address_city) || $data->registered_address_city == null) {
            //         $data->registered_address_city = $row['city'] ?? null;
            //         }

            //         if (empty($data->email_address) || $data->email_address == null) {
            //         $data->email_address = $row['focal_person_email'] ?? null;
            //         }

            //         if (empty($data->telephone_no) || $data->telephone_no == null) {
            //         $data->telephone_no = $row['focal_person_contact'] ?? null;
            //         }

            //         $data->source_of_this_information = $updatedSource;
            //         $data->last_updated_date = now();

            //         // Save the updated data
            //         $data->save();

            //         return $data;
            // } else {
            //     $data = new CompanyInfo([
            //         'name_of_company' => $row['business_name'] ?? null,
            //         'complete_address' => $row['address'] ?? null,
            //         'source_provided_id' => $row['sno'] ?? null,
            //         'registered_address_city' => $row['city'] ?? null,
            //         'contact_person' => $row['focal_person_name'] ?? null,
            //         'telephone_no' => $row['focal_person_contact'] ?? null,
            //         'email_address' => $row['focal_person_email'] ?? null,
            //         'last_updated_date' => now(),
            //         'source_of_this_information' => 'ICT',
            //         'no_of_offices' => null,
            //         'head_office_city' => null,
            //     ]);
            
            //     $data->save(); // Save the new instance
            
            //     return $data; // Return the newly created model
            // }

            // PASHA
            // $data = CompanyInfo::where('name_of_company', $row['company_name'])->first();

            // if (!empty($data)) {
            //      $updatedSource = $data->source_of_this_information 
            //     ? $data->source_of_this_information . '/ PASHA' 
            //     : 'PASHA';

            //         // Check for null or empty fields and update only those
            //         if (empty($data->complete_address) || $data->complete_address == null) {
            //         $data->complete_address = $row['address_line_1'] ?? null;
            //         }

            //         if (empty($data->complete_address_2) || $data->complete_address_2 == null) {
            //         $data->complete_address_2 = $row['address_line_2'] ?? null;
            //         }

            //         if (empty($data->registered_address_city) || $data->registered_address_city == null) {
            //         $data->registered_address_city = $row['city'] ?? null;
            //         }

            //         if (empty($data->reg_no) || $data->reg_no == null) {
            //         $data->reg_no = $row['region'] ?? null;
            //         }

            //         if (empty($data->telephone_no) || $data->telephone_no == null) {
            //         $data->telephone_no = $row['phone'] ?? null;
            //         }

            //         // Always update 'source_of_this_information' and 'last_updated_date'
            //         $data->source_of_this_information = $updatedSource;
            //         $data->last_updated_date = now();

            //         // Save the updated data
            //         $data->save();

            //         return $data;
            // } else {
            //     $data = new CompanyInfo([
            //         'name_of_company' => $row['company_name'] ?? null,
            //         'complete_address' => $row['address_line_1'] ?? null,
            //         'complete_address_2' => $row['address_line_1'] ?? null,
            //         'registered_address_city' => $row['city'] ?? null,
            //         'reg_no' => $row['region'] ?? null,
            //         'telephone_no' => $row['phone'] ?? null,
            //         'last_updated_date' => now(),
            //         'source_of_this_information' => 'PASHA',
            //         'no_of_offices' => null,
            //         'head_office_city' => null,
            //     ]);
            
            //     $data->save(); // Save the new instance
            
            //     return $data; // Return the newly created model
            // }
            
            // die();
        
        // $dateOfIncorporation = $row['date_of_incorporation'] ?? null;

        // if ($dateOfIncorporation) {
        //     // Convert the Excel serial number to a proper date format
        //     $date = Carbon::createFromFormat('Y-m-d', '1900-01-01')
        //                   ->addDays($dateOfIncorporation - 2); // Subtract 2 to account for Excel's base date
        //     $dateOfEstablishment = $date;
        // } else {
        //     $dateOfEstablishment = null;
        // }

        // die($dateOfEstablishment);

            // return new CompanyInfo([
            //     'source_provided_id' => $row['sno'] ?? null,  
            //     'reg_no' => $row['reg_no'] ?? null,            
            //     'name_of_company' => $row['company_name'] ?? null, 
            //     'date_of_establishment' => $dateOfEstablishment, 
            //     'registered_address_province' => $row['registered_address'] ?? null, 
            //     'company_type' => $row['company_kind'] ?? null,  
            //     'authorized_capital' => $row['Authorized Capital'] ?? null, 
            //     'paid_up_capital' => $row['Paid-Up Capital'] ?? null, 
            //     'email_address' => $row['email'] ?? null,         
            //     'telephone_no' => $row['telephone_no'] ?? null,  
            //     'sector' => $row['sector'] ?? null,               
            //     'last_updated_date' => now(),                     
            //     'source_of_this_information' => 'SECP',  
            //     'no_of_offices' => null,                           
            //     'head_office_city' => null,                      
            // ]);
        }
        
}
