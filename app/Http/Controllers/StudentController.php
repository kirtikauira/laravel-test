<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Lib\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(Request $request)
    {
        if($request->input('all'))
        {
            $students = Student::orderBy('name', 'DESC')->get();
        }
        else{
            $students = Student::sortable()->Paginate(5);
            $students->appends(['sort' => $students]);
        }
        
        //return response()->json(['data' => $teachers], 200);
        return view('students')->with([
            'students'  => $students
          ]);
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
        $rules = [
            'name' => 'required|min:6',
            'stu_image' => 'required|image|mimes:jpeg,png,jpg',
            'teacher_id' => 'required',
            ];

        $messages = [ 'name.required' => 'Please Enter Your Name.',
                     'stu_image.required' => 'Please upload an image.',
                     'teacher_id' => 'Please seletct any teacher',
            ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('students.index')->withInput()->withErrors($validator);
        }
        
        Student::create([
            'name' => $request->input('name'),
            'stu_image' => $request->input('stu_image'),
            'teacher_id' => $request->input('teacher_id'),
            ]);
        $request->image->store('storage/stuimages', 'public');
        return redirect()->route('students.index')->withSuccess('You have successfully added a Student record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return response()->json(['data' => $student], 200);
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
        if(!auth("api")->user()) {
            return response()->json(['message' => 'Unauthorize'], 500);
        }
        $student = Student::findOrFail($id);
        $this->validate($request, [
            'name' => 'required'
        ]);
        $student->name = $request->input('name');
        $student->save();
        return redirect()->route('students.index')->withSuccess('You have successfully edit a Student record!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(auth("api")->user()) {
            return response()->json(['message' => 'Unauthorize'], 500);
        }
        $category = Student::findOrFail($id);
        $category->delete();
        return redirect()->route('students.index')->withSuccess('You have successfully deleted a Student!');
    }
}
