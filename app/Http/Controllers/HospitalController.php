<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use DataTables;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/content/pages/hospital/index');
    }

    public function gethospital()
    {
        $query = "SELECT * FROM hospital";
        $data = DB::select($query);


        return Datatables::of($data)->addIndexColumn()->make(true);

        // return $data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required'
        ]);
        $rules = [
            'name' => 'required|string|min:0|max:250',
        ];

        $validator = Validator::make($request->all(), $rules);

        // เชค Validate ข้อมูลที่ส่งมา
        if (!$validator->fails()) {

            $name = $request->name;
            $address = $request->address;
            $province = $request->province;
            $district = $request->district;
            $sub_district = $request->sub_district;
            $zip_code = $request->zip_code;
            $telephone = $request->telephone;

            if (empty($request->modalType)) {
                //เพิ่มข้อมูล
                $query = "INSERT INTO hospital (name, address, province, district, sub_district, zip_code, telephone) VALUES ('$name', '$address', $province ,$district, $sub_district, $zip_code, $telephone)";
                $insert = DB::insert($query);
                return "200";
            } else {
                $query = "UPDATE hospital SET name = '$name', address = '$address', province = '$province', district = '$district', sub_district = '$sub_district', zip_code = '$zip_code', telephone = '$telephone'   WHERE id = '$request->modalType'";
                $update = DB::update($query);
                return "200";
            }
        } else {
            return "error";
        }
    }


    public function getDataById(Request $request)
    {
        $id = $request->id;
        $query = "SELECT * FROM hospital WHERE id = '$id'";
        $data = DB::select($query);
        return $data[0];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //เชคถ้าลบหลายรายการ
        if (isset($request->arr_del)) {
            foreach ($request->arr_del as $key => $value) {
                // dd($value);
                DB::delete("DELETE FROM hospital WHERE id = $value ");
            }
            return "200";
        } else {
            DB::delete("DELETE FROM hospital WHERE id = $request->id");
            return "200";
        }
        return "error";
    }
}
