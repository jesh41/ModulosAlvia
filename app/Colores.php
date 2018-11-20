<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
//class BaseModel extends Model
//{

   /* public function getDateFormat()
    {
        return 'Y-m-d H:i:s.000';//'Y-m-d H:i:s.000'; // change to 'Y-m-d H:i:s.0000000'
    }*/
//    public function getDateFormat()
//    {
//        return 'Y-m-d H:i:s.000';
//    }


//}


class Colores extends Model
{
protected $table='catcolores';
    //protected $dateFormat = 'Y-m-d H:i:s';
   // protected $dateFormat = 'Ymd H:i:s';

    //protected $dateFormat =  'Y-m-d H:i:s.0000000';
// protected $dateFormat = 'Y-m-d H:i:s';

   //public function getDateFormat()
   //{
     //   return 'Y-m-d H:i:s';
    //}


 // public function fromDateTime($value)
   // {
     //   return Carbon::parse(parent::fromDateTime($value))->format('Y-d-m H:i:s');
   //}



    protected $fillable=[
        'descripcion'
    ];






}
