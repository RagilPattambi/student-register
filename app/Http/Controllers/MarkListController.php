<?php

namespace App\Http\Controllers;

use App\Models\MarkList;
use App\Models\StudentDetails;
use DB;
use Illuminate\Http\Request;

class MarkListController extends Controller
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
            $data = DB::table('student_details')->join('mark_lists', function($join){
                $join->on('mark_lists.student', '=', 'student_details.id');
            })->where('name', 'LIKE', "%{$search}%")->orWhere('term', 'LIKE', "%{$search}%")->get();
        }else{
            $data = DB::table('student_details')->join('mark_lists', function($join){
                $join->on('mark_lists.student', '=', 'student_details.id');
            })->get();
        }
        $student =  StudentDetails::all();
        $result = [
            'data' => $data,
            'student' => $student
        ];
        
        return view('marklist',compact('result'));
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
            'student' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'history' => 'required',
            'term' => 'required',
            'total_marks' => 'required'
        ]);

        $data = MarkList::create(request(['student','maths','science','history','term','total_marks']));
        if($data){
            return response()->json(['msg'=>'success']);
        }else{
            return response()->json(['msg'=>'failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MarkList  $markList
     * @return \Illuminate\Http\Response
     */
    public function show(MarkList $markList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MarkList  $markList
     * @return \Illuminate\Http\Response
     */
    public function edit(MarkList $markList,Request $request)
    {
        $editdata = MarkList::where('mid',$request['id'])->get();
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
     * @param  \App\Models\MarkList  $markList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MarkList $markList)
    {
        if($request['edit_id']){
            $data = MarkList::where('mid', '=',  $request['edit_id'])->first();
            $data->student = isset($request['edit_student']) ? trim($request['edit_student']) : '';
            $data->maths = isset($request['edit_maths']) ? trim($request['edit_maths']) : '';
            $data->science = isset($request['edit_science']) ? trim($request['edit_science']) : '';
            $data->history = isset($request['edit_history']) ? trim($request['edit_history']) : '';
            $data->term = isset($request['edit_term']) ? trim($request['edit_term']) : '';
            $data->total_marks = isset($request['edit_total_marks']) ? trim($request['edit_total_marks']) : '';
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
     * @param  \App\Models\MarkList  $markList
     * @return \Illuminate\Http\Response
     */
    public function destroy(MarkList $markList,$id)
    {
        $data = MarkList::where('mid', '=',  $id)->first();
        $data->delete();
        return response()->json(['msg'=>'success']);
    }
}
