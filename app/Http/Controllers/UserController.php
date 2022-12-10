<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::paginate(10);
        return view('page.user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate from User Form
        $request->validate([
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'role' => 'required',
            'profile' => 'required|mimes:png,jpg,jpeg'
        ]);

        //  if profile has value

        $file_name = "";
        if (request()->hasFile('profile')) {
            
            $md5Name = md5(time() . rand(100, 999));
            $extensionfile = request()->file('profile')->guessExtension();
            $path = 'assets/profile/';
            $filename = $md5Name . '.' . $extensionfile;
            request()->file('profile')->move($path, $filename, '');
        };


        // Store Data

        $User = new User();
        $User->profile =  $filename;
        $User->email = $request['email'];
        $User->password = Hash::make($request['password']);
        $User->mobile = $request['mobile'];
        $User->name = $request['name'];
        $User->gender = $request['gender'];
        $User->status = isset($request['status']) ? $request['status'] : 'inactive';
        $User->role = $request['role'];
        $User->created_by = Auth()->user()->id;
        $User->updated_by = Auth()->user()->id;
        if ($User->save()) {
            return redirect()->route('user.index');
        } else {
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $user = User::find($user)->first();
        return view('page.user.update',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    { 
        $request->validate([
        'password' => 'required',
        'name' => 'required',
        'gender' => 'required',
        'mobile' => 'required',
        'role' => 'required',
        'profile' => 'mimes:png,jpg,jpeg'
    ]);

// dd($request->all()); 


    //  if profile has value

    $filename = "";
  
    if (request()->hasFile('profile')) {
        $path = 'assets/profile/' . $user->profile;  
            if (File::exists($path)) {
                File::delete($path);
            }
        $md5Name = md5(time() . rand(100, 999));
        $extensionfile = request()->file('profile')->guessExtension();
        $path = 'assets/profile/';
        $filename = $md5Name . '.' . $extensionfile;
        request()->file('profile')->move($path, $filename, '');
    }

    $get_id = User::where('id',$user->id)->first();
    $db_password = $get_id->password;
    $password = $request->password;
    if($db_password === $password){ 
        $password = $request->password;
    }else{
        $password = Hash::make($request->password);
    }
    // tbCorn::find($id)->update([

    User::find($user->id)->update([
        'gender'=>$request->gender,
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$password,
        'mobile'=>$request->mobile,
        'role'=>$request->role,
        'status'=>$request->status,
        'profile'=>$filename?$filename:$user->profile,
    ]);
    return redirect()->route('user.index');

}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
      $user = User::find($user->id)->first();
 
       $path = 'assets/profile/' . $user->profile;  
       if (File::exists($path)) {
           File::delete($path);
       }
      $user->delete();
      return redirect()->route('user.index'); 
    }
}
