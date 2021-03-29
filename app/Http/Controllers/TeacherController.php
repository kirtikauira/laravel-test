<?php

namespace App\Http\Controllers;
use App\Models\Teacher;
use App\Models\Student;
use App\Lib\Helper;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
            $teachers = Teacher::orderBy('name', 'DESC')->get();
        }
        else{
            $teachers = Teacher::sortable()->Paginate(5);
            $teachers->appends(['sort' => $teachers]);
        }
        
        //return response()->json(['data' => $teachers], 200);
        return view('teachers')->with([
            'teachers'  => $teachers,
            'teacherrel' => Teacher::all(),
            'student' => Student::all()
          ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $teacher = $request->get('tech_id');
         
        if (!$teacher) {
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        } else {
            $html = '';
            $result = Student::where('teacher_id', $teacher)->get();
            foreach ($result as $row) {
                $html .= '<option value="'.$row->id.'">'.$row->name.'</option>';
            }
        }
    
        return response()->json(['html' => $html]);
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
            'tech_image' => 'required|image|mimes:jpeg,png,jpg',
            ];

        $messages = [ 'name.required' => 'Please Enter Your Name.',
                     'tech_image.required' => 'Please upload an image.'
            ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('teachers.index')->withInput()->withErrors($validator);
        }
        
        Teacher::create([
            'name' => $request->input('name'),
            'stu_image' => $request->input('tech_image'),
            ]);
        $request->image->store('storage/techimages', 'public');
        return redirect()->route('teachers.index')->withSuccess('You have successfully added a Student record!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
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
        $teacher = Teacher::findOrFail($id);
        $this->validate($request, [
            'name' => 'required'
        ]);
        $teacher->name = $request->input('name');
        $teacher ->save();
        return redirect()->route('teachers.index')->withSuccess('You have successfully edit a Teacher record!');
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
        $category = Teacher::findOrFail($id);
        $category->delete();
        return redirect()->route('teachers.index')->withSuccess('You have successfully deleted a Teacher!');
    }
}
