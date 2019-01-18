<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use DB;
use Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

        $user = User::with('roles:id,name')->get();
        $rolesc = Role::pluck('name','id')->toarray();

//        $user = User::with('roles')->get();

       //$user=User::all('id','name','email');
        //$user=User::with('roles')->select('id','name','email');
        //$rolesc=Role::all();
        //$rolesc = Role::all();
        //return $user;
       // return ['user' => $user];
       //
        return [$user,$rolesc];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$request->ajax()) return redirect('/');
    //    $roles = Role::pluck('name','name')->all();
      //  return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',///,
          //  'password' => 'required|same:confirm-password',
        'roles' => 'required'

        ]);


        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $user->assignRole($request->input('rol'));


       // return redirect()->route('users.index')->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::find($id);

        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        return view('users.edit',compact('user','roles','userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
       // $this->validate($request, [
       //     'name' => 'required',
      //      'email' => 'required,',
       //    // 'password' => 'same:confirm-password',
       //     'roles' => 'required'
      //  ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = array_except($input,array('password'));
        }

        $user = User::find($input['id']);
        $user->name=$input['name'];
        $user->save();

        DB::table('model_has_roles')->where('model_id',$input['id'])->delete();
        //$user->removeRole('writer');
        $user->assignRole($request->input('roles'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     //   if (!$request->ajax()) return redirect('/');
      //  User::find($id)->delete();
       // return redirect()->route('users.index')->with('success','User deleted successfully');
    }


    public function desactivar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->activo = '0';
        $user->save();
    }

    public function activar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        $user = User::findOrFail($request->id);
        $user->activo = '1';
        $user->save();
    }

}
