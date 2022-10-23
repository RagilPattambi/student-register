<?php

namespace App\Http\Controllers;

use App\Models\StudentDetails;
use Illuminate\Http\Request;
use Response;

class StudentDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $search = isset($_GET['search']) ? $_GET['search'] : '' ;

        if(isset($search) && !empty($search)){
            $data = StudentDetails::where('name', 'LIKE', "%{$search}%")->orWhere('age', 'LIKE', "%{$search}%")->orWhere('reporting_teacher',$search)->get();
        }else{
            $data = StudentDetails::all();
        }
        $result = [
            'data' => $data
        ];
        
        return view('studentlist',compact('result'));
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
        $this->validate(request(),[
            'name' => 'required|min:3',
            'age' => 'required',
            'gender' => 'required',
            'reporting_teacher' => 'required|min:3'
        ]);

        $data = StudentDetails::create(request(['name','age','gender','reporting_teacher']));
        if($data){
            return response()->json(['msg'=>'success']);
        }else{
            return response()->json(['msg'=>'failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return \Illuminate\Http\Response
     */
    public function show(StudentDetails $studentDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentDetails $studentDetails,Request $request)
    {
        $editdata = StudentDetails::where('id',$request['id'])->get();
        if($editdata){
            echo $editdata;
        }else{
            echo "failed";
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentDetails $studentDetails)
    {
        if($request['edit_id']){
            $data = StudentDetails::find($request['edit_id']);
            $data->name = isset($request['edit_name']) ? trim($request['edit_name']) : '';
            $data->age = isset($request['edit_age']) ? trim($request['edit_age']) : '';
            $data->gender = isset($request['edit_gender']) ? trim($request['edit_gender']) : '';
            $data->reporting_teacher = isset($request['edit_reporting_teacher']) ? trim($request['edit_reporting_teacher']) : '';
            $result = $data->update();
        }
        if($result){
            return response()->json(['msg'=>'success']);
        }else{
            return response()->json(['msg'=>'failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StudentDetails  $studentDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentDetails $studentDetails,$id)
    {
        $data = StudentDetails::findOrFail($id);
        $data->delete();
        return response()->json(['msg'=>'success']);
    }
}
