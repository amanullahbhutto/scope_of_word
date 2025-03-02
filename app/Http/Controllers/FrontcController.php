<?php

namespace App\Http\Controllers;



use App\Models\Region;
use App\Models\School;
use App\Models\Tehsil;
use App\Models\District;
use App\Models\CompanyInfo;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\BD;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CompanyInfoImport;
use Illuminate\Support\Facades\DB;

class FrontcController extends Controller
{


    public function district_school(Request $request){

    }

    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        // Import the Excel file using the import class
        Excel::import(new CompanyInfoImport, $request->file('file'));

        // Return success message or redirect
        return back()->with('success', 'Excel file imported successfully.');
    }
    

    public function uploadJson(Request $request)
    {
        $request->validate([
            'json_file' => 'required|file|mimes:json', // Validate JSON file and mime type
        ]);
    
        // Get the file and decode JSON
        $file = $request->file('json_file');
        $content = file_get_contents($file);
        $data = json_decode($content, true);
        $post = $data['IT and ITES Sindh'] ?? null;
    
        if (is_array($post)) {
            try {
                \DB::transaction(function () use ($post) {
                    foreach ($post as $item) {
                        // Validate required fields and sanitize
                        $source_provided_id = isset($item['S.No.']) ? trim($item['S.No.']) : null;
                        $reg_no = isset($item['Reg No.']) ? trim($item['Reg No.']) : null;
                        $name_of_company = isset($item['Company Name']) ? trim($item['Company Name']) : null;
    
                        // Skip invalid records
                        if (!$source_provided_id || !$name_of_company) {
                            \Log::warning('Missing required fields', ['item' => $item, 'source_provided_id' => $source_provided_id, 'name_of_company' => $name_of_company]);
                            continue;
                        }
    
                        // Convert Excel serial date to standard format (handling Excel date format correctly)
                        $date_of_incorporation = isset($item['Date of Incorporation'])
                            ? $this->excelDateToCarbon($item['Date of Incorporation'])
                            : null;
    
                        // Clean the registered address province field (handles any unexpected characters)
                        $registered_address_province = isset($item['Registered Address'])
                            ? preg_replace('/\xA0/', ' ', trim($item['Registered Address']))
                            : null;
    
                        $company_type = isset($item['Company Kind']) ? trim($item['Company Kind']) : null;
                        $email_address = isset($item['Email']) ? trim($item['Email']) : null;
                        $telephone_no = isset($item['Telephone No.']) ? substr(trim($item['Telephone No.']), 0, 20) : null; // Max 20 chars
                        $sector = isset($item['Sector']) ? trim($item['Sector']) : null;
    
                        // Optional fields with default values
                        $service = null; 
                        $product = null;
                        $last_updated_date = now();
                        $source_of_this_information = 'SECP';
                        $no_of_offices = null;
                        $head_office_city = null;
    
                        // Save data to the database with better error handling
                        try {
                            \DB::table('company_info')->insert([
                                'source_provided_id' => $source_provided_id,
                                'reg_no' => $reg_no,
                                'name_of_company' => $name_of_company,
                                'date_of_establishment' => $date_of_incorporation,
                                'registered_address_province' => $registered_address_province,
                                'company_type' => $company_type,
                                'email_address' => $email_address,
                                'telephone_no' => $telephone_no,
                                'sector' => $sector,
                                'service' => $service,
                                'product' => $product,
                                'last_updated_date' => $last_updated_date,
                                'source_of_this_information' => $source_of_this_information,
                                'no_of_offices' => $no_of_offices,
                                'head_office_city' => $head_office_city,
                            ]);
                        } catch (\Exception $e) {
                         echo  'Failed to insert data for company: ' . $name_of_company . '. Error: ' . $e->getMessage();
                            die();
                            \Log::error('Failed to insert data for company: ' . $name_of_company . '. Error: ' . $e->getMessage());
                            continue; // Skip this record and continue with the rest
                        }
                    }
                });
    
                return back()->with('success', 'JSON data imported successfully!');
            } catch (\Exception $e) {
                echo $e->getMessage();
                die();
                \Log::error('Transaction failed: ' . $e->getMessage());
                return back()->with('error', 'Failed to import JSON data. Please try again.');
            }
        }
    
        return back()->with('error', 'Invalid JSON format or structure.');
    }

    public function show($distname)
    {
        $district = District::where('district_name', $distname)->first();

        if (!$district) {
            return redirect()->route('home')->with('error', 'District not found');
        }
            $totalSchools = School::where('district', '=', $district->id)->count();
      
            $totalAdoptedSchools = DB::table('adopted_schools')
            ->join('school_data', 'school_data.school_id', '=', 'adopted_schools.school_id')  
            ->where('school_data.district', '=', $district->id) 
            ->count();
           
            // Get the date for two months ago
            $twoMonthsAgo = Carbon::now()->subMonths(2);
    
            // Count schools adopted in the last two months
            $latestAdoptedSchools = DB::table('adopted_schools')
            ->join('school_data', 'school_data.school_id', '=', 'adopted_schools.school_id')  
            ->where('adopted_schools.created_at', '>=', $twoMonthsAgo) 
            ->where('school_data.district', '=', $district->id)  
            ->count();
            

        $schools = DB::table('school_data')
        ->join('districts', 'districts.id', '=', 'school_data.district')
        ->where('school_data.district', '=', $district->id)
        ->select(
            'school_data.school_id',
            'school_data.school_name',
            'school_data.total_teachers_staff',
            'school_data.total_enrolled',
            'districts.district_name as distname',
            'districts.region_id as region_id',
            'school_data.district as distID'
        )
        ->get()
        ->map(function ($item) {
            $region = Region::find($item->region_id);
            $item->region_name = $region ? $region->region_name : 'Unknown Region'; // Handle null regions
            return $item;
        });
        // echo '<pre>';
        //     print_r($schools);
            
            // die();

        return view('frontend.show', compact('district','schools','totalSchools','totalAdoptedSchools','latestAdoptedSchools'));
    }


    
    
    


    public function index(){
        $regions = Region::all();
        $totalschooldist = DB::table('school_data') 
        ->join('districts', 'districts.id', '=', 'school_data.district')
        ->select(
            DB::raw('SUM(school_data.total_teachers_staff) AS total_teachers_staff'),
            DB::raw('SUM(school_data.total_enrolled) AS totalstudent'),
            DB::raw('COUNT(school_data.school_id) AS totalschools'),
            'districts.district_name as distname',
            'districts.region_id as region_id', // Getting the region_id as well
            'school_data.district as distID'
        )
        ->groupBy('districts.district_name', 'districts.region_id', 'school_data.district')
        ->get()
        ->map(function ($item) {
            // Load the region name for each district
            $item->region_name = Region::find($item->region_id)->region_name;
            return $item;
        });
        $school = School::count();
      
        $totalAdoptedSchools = DB::table('adopted_schools')->count();
       
        // Get the date for two months ago
        $twoMonthsAgo = Carbon::now()->subMonths(2);

        // Count schools adopted in the last two months
        $latestAdoptedSchools = DB::table('adopted_schools')
            ->where('created_at', '>=', $twoMonthsAgo)
            ->count();
            
            // echo '<pre>';
            // print_r($totalschooldist);
            
            // die();
        
        return view('frontend.home', compact('regions','totalschooldist','latestAdoptedSchools','totalAdoptedSchools','school'));
    }
    

    public function leader_house(Request $request)
    {

        return view('frontend.about.index');
    }

    

 public function getData(Request $request)
{
    // Start building the query
    $query = School::orderBy('id', 'asc');
    $district = array();
    $tahsil = array();
    // Apply the region filter if it's passed in the request
    if ($request->has('regions') && !empty($request->regions)) {
        $query->where('region_id', $request->regions);
        $district = District::where('region_id',$request->regions)->get();
    }
    if ($request->has('district') && !empty($request->district)) {
        $query->where('district_id', $request->district);
        $tahsil = Tehsil::where('district_id',$request->district)->get();
    }


    // Paginate the results
    $schools = $query->paginate(10);

    // Transform the results to include order_id
    $schools->getCollection()->transform(function ($item, $index) use ($schools) {
        $item->order_id = ($schools->currentPage() - 1) * $schools->perPage() + $index + 1;
        return $item;
    });
    
    // Return the response
    return response()->json([
        'success' => true,
        'message' => 'Data fetched successfully!',
        'data' => $schools,
        'district' => $district,
    ]);
}


public function getjsonfile(Request $request){
    $jsonContent = file_get_contents(public_path('data/excel-to-json_SECP.json'));
    $data = json_decode($jsonContent, true);
  
    try {
        \DB::transaction(function () use ($data) {
           
            foreach ($data['IT and ITES Sindh'] as $item) {
               
                // Validate required fields and sanitize
                $source_provided_id = isset($item['S.No.']) ? trim($item['S.No.']) : null;
                $reg_no = isset($item['Reg No.']) ? trim($item['Reg No.']) : null;
                $name_of_company = isset($item['Company Name']) ? trim($item['Company Name']) : null;

                // Skip invalid records
                if (!$source_provided_id || !$name_of_company) {
                    \Log::warning('Missing required fields', ['item' => $item, 'source_provided_id' => $source_provided_id, 'name_of_company' => $name_of_company]);
                    continue;
                }

                $date_of_incorporation = isset($item['Date of Incorporation']) && is_numeric($item['Date of Incorporation'])
                ? $this->excelDateToCarbon($item['Date of Incorporation'])
                : null;


                // Clean the registered address province field (handles any unexpected characters)
                $registered_address_province = isset($item['Registered Address'])
                    ? preg_replace('/\xA0/', ' ', trim($item['Registered Address']))
                    : null;

                $company_type = isset($item['Company Kind']) ? trim($item['Company Kind']) : null;
                $email_address = isset($item['Email']) ? trim($item['Email']) : null;
                $telephone_no = isset($item['Telephone No.']) ? substr(trim($item['Telephone No.']), 0, 20) : null; // Max 20 chars
                $sector = isset($item['Sector']) ? trim($item['Sector']) : null;

                // Optional fields with default values
                $service = null; 
                $product = null;
                $last_updated_date = now();
                $source_of_this_information = 'SECP';
                $no_of_offices = null;
                $head_office_city = null;

                // Save data to the database with better error handling
                try {
                    \DB::table('company_info')->insert([
                        'source_provided_id' => $source_provided_id,
                        'reg_no' => $reg_no,
                        'name_of_company' => $name_of_company,
                        'date_of_establishment' => $date_of_incorporation,
                        'registered_address_province' => $registered_address_province,
                        'company_type' => $company_type,
                        'email_address' => $email_address,
                        'telephone_no' => $telephone_no,
                        'sector' => $sector,
                        'service' => $service,
                        'product' => $product,
                        'last_updated_date' => $last_updated_date,
                        'source_of_this_information' => $source_of_this_information,
                        'no_of_offices' => $no_of_offices,
                        'head_office_city' => $head_office_city,
                    ]);
                } catch (\Exception $e) {
                 echo  'Failed to insert data for company: ' . $name_of_company . '. Error: ' . $e->getMessage();
                    die();
                    \Log::error('Failed to insert data for company: ' . $name_of_company . '. Error: ' . $e->getMessage());
                    continue; // Skip this record and continue with the rest
                }
            }
        });

        // return back()->with('success', 'JSON data imported successfully!');
    } catch (\Exception $e) {
        echo $e->getMessage();
        die();
       
    }

    die('fsdfs');
}
    
public function excelDateToCarbon($excelDate)
{
    if (is_numeric($excelDate)) {
        // Excel serial date starts from 1900-01-01
        $unixTimestamp = ($excelDate - 25569) * 86400;
        return Carbon::createFromTimestamp($unixTimestamp);
    }
    
    return null; // Return null if it's not a valid numeric Excel date
}


    public function school_details($id, Request $request){
        
        $schoolDetails = School::where('school_id',$id)->first();
        $teachers = Teacher::where('school_id',$id)->get();
        $pictures = array();
        return view('frontend.school_deails',compact('schoolDetails','teachers','pictures'));
    }

    public function addoped(Request $request){
        $regin = Region::all();
        return view('frontend.request_form',compact('regin'));
    }


    public function getDistricts(Request $request)
{
    $regionId = $request->get('region_id');
    $districts = District::where('region_id', $regionId)->get();

    return response()->json(['districts' => $districts]);
}
public function getTehsils(Request $request)
{
    $districtId = $request->get('district_id');
    $tehsils = Tehsil::where('district_id', $districtId)->get();
    return response()->json(['tehsils' => $tehsils]);
}

    public function success(Request $request){
        return view('success');

    }
    
}