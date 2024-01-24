<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $getEmployee = DB::table('m_employee')->get();
        return view('home.index',compact('getEmployee'));
    }

    public function storeEmployee(Request $request)

    {
        
        try {
            // dd($request->all());

            $validatedData = $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'phone' => 'required|regex:/^[0-9]+$/|min:10',
                'email' => 'email',
                'ktp' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
                'nik' => 'required|string',
            ], [
                'phone.regex' => 'Phone number should only contain digits.',
                'phone.min' => 'Phone number should have at least 10 digits.',
                'ktp.required' => 'The KTP image is required.',
                'ktp.image' => 'The file must be an image.',
                'ktp.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
                'nik.required' => 'NIK is required.',
            ]);

            // handle upload image
            $yearNow                         = date('Y');
            $monthNow                        = date('m');
            $dateNow                         = date('d');
            $filename                        = 'EMPLOYEE'.'-'.$request['nik'].$request['lastname'].'.'.$request['ktp']->getClientOriginalExtension();
            $file_path                       = 'uploads/ktp/employee/'.$yearNow.'/'.$monthNow.'/'.$dateNow.'/';
            $fullpath                        = $file_path.$filename;
            $request['ktp'] -> move($file_path, $filename);

            DB::table('m_employee')->insert([
                'firstname'           => $request->firstname,
                'lastname'            => $request->lastname,
                'birth'               => $request->birth,
                'phone'               => $request->phone,
                'email'               => $request->email,
                'province'            => $request->province,
                'city'                => $request->city,
                'street_address'      => $request->street_address,
                'zip_postal_code'     => $request->ZIP,
                'ktp_path'            => $fullpath,
                'nik'                 => $request->nik,
                'position'            => $request->position,
                'bank'                => $request->bank,
                'bank_account_number' => $request->bank_account_number,
                'createdDtm'          => date('Y-m-d H:i:s')
            ]);

            return response()->json([
                'message' => 'Employee data has been saved!',
                'status'  => 'success',
                'code'    => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to save employee data. Please try again!',
                'status'  => 'error',
                'code'    => 400
            ]);
        }
    }

    public function getEmployee(Request $request)
    {
        $getEmployee = DB::table('m_employee')->where('id',$request->id)->first();

        return response()->json($getEmployee);
    }

    public function editEmployee(Request $request)
    {
        try {
            if ($request->hasFile('ktp')) {
                // handle upload image
                $yearNow     = date('Y');
                $monthNow    = date('m');
                $dateNow     = date('d');
                $filename    = 'EMPLOYEE' . '-' . $request['nik'] . $request['lastname'] . '.' . $request['ktp']->getClientOriginalExtension();
                $file_path   = 'uploads/ktp/employee/' . $yearNow . '/' . $monthNow . '/' . $dateNow . '/';
                $fullpath    = $file_path . $filename;

                $request['ktp']->move($file_path, $filename);

                $editEmployee = DB::table('m_employee')->where('id', $request->id)->update([
                    'firstname'           => $request->firstname,
                    'lastname'            => $request->lastname,
                    'birth'               => $request->birth,
                    'phone'               => $request->phone,
                    'email'               => $request->email,
                    'province'            => $request->province,
                    'city'                => $request->city,
                    'street_address'      => $request->street_address,
                    'zip_postal_code'     => $request->ZIP,
                    'ktp_path'            => $fullpath,
                    'nik'                 => $request->nik,
                    'position'            => $request->position,
                    'bank'                => $request->bank,
                    'bank_account_number' => $request->bank_account_number,
                    'updatedDtm'          => date('Y-m-d H:i:s')
                ]);
            } else {
                $editEmployee = DB::table('m_employee')->where('id', $request->id)->update([
                    'firstname'           => $request->firstname,
                    'lastname'            => $request->lastname,
                    'birth'               => $request->birth,
                    'phone'               => $request->phone,
                    'email'               => $request->email,
                    'province'            => $request->province,
                    'city'                => $request->city,
                    'street_address'      => $request->street_address,
                    'zip_postal_code'     => $request->ZIP,
                    'nik'                 => $request->nik,
                    'position'            => $request->position,
                    'bank'                => $request->bank,
                    'bank_account_number' => $request->bank_account_number,
                    'updatedDtm'          => date('Y-m-d H:i:s')
                ]);
            }
            return response()->json([
                'message' => 'Employee data has been saved!',
                'status'  => 'success',
                'code'    => 200
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Failed to save employee data. Please try again!',
                'status'  => 'error',
                'code'    => 400
            ]);
        }
    }

    public function deleteEmployee(Request $request)
    {
        $filePath = DB::table('m_employee')->where('id', $request->id)->value('ktp_path');

        $deleteEmployee = DB::table('m_employee')->where('id', $request->id)->delete();

        // delete image
        if ($filePath && file_exists($filePath)) {
            unlink($filePath);
        }

        return response()->json([
            'message' => 'Employee data has been deleted!',
            'status'  => 'success',
            'code'    => 200
        ]);
    }
}
