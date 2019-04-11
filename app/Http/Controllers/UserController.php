<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

//use Illuminate\Support\Facades\DB;
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
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar==''){
            $user = User::join('roles','users.idrol','=','roles.id')
                ->select('users.id','users.email','users.name','users.password',
                    'users.activo','users.idrol','roles.nombre as rol')
                ->orderBy('users.id', 'desc')->paginate(3);
        }
        else{
            $user = User::join('roles','users.idrol','=','roles.id')
                ->select('users.id','users.email','users.name','users.password',
                    'users.activo','users.idrol','roles.nombre as rol')
                ->where('users.'.$criterio, 'like', '%'. $buscar . '%')
                ->orderBy('users.id', 'desc')->paginate(3);
        }

        return [
            'pagination'=>[
                'total'        => $user->total(),
                'current_page' => $user->currentPage(),
                'per_page'     => $user->perPage(),
                'last_page'    => $user->lastPage(),
                'from'         => $user->firstItem(),
                'to'           => $user->lastItem(),
                            ],
                  'user'=>$user,

                ];

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!$request->ajax()) return redirect('/');

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
        ]);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->idrol = $request->idrol;
            $user->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        if (!$request->ajax()) return redirect('/');

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

        try{
            DB::beginTransaction();

            //Buscar primero el proveedor a modificar
            $user = User::findOrFail($request->id);
            $user->name=$request->name;
            $user->password = bcrypt( $request->password);
            $user->idrol = $request->idrol;
            $user->save();
            DB::commit();

        } catch (Exception $e){
            DB::rollBack();
        }

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
