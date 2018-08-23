<?php
/*namespace App\Helpers;
use Config;
use DB;
use App\Helpers\MCrypt;
namespace App\Http\Controllers;

class DatabaseConnection  extends Controller
{
    public static function setConnection()
    {

        $users = DB::connection('mysql')->select(DB::raw(' SELECT * from dbrestaurant where id_resto=2 '));
        $mcrypr = new MCrypt();

        config(['database.connections.onthefly' => [
            'driver' => 'sqlsrv',
            'host' => MCrypt::decrypt($users->DB_HOST),
            'database'  => MCrypt::decrypt($users->DB_DATABASE),
            'username' =>  MCrypt::decrypt($users->DB_USERNAME),
            'password' => MCrypt::decrypt($users->DB_PASSWORD),
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
        ]]);

        return DB::connection('onthefly');
    }
}  */
namespace App\Helpers;
use Config;
use DB;
use Auth;
use App\Http\Controllers\Controller;

class DatabaseConnection  extends Controller
{
    public static function setConnection()
    {$var=Auth::user()->id_magasin;
            $params = DB::connection('mysql')->select("SELECT * from dbrestaurant where id_magasin=$var" );


        config(['database.connections.onthefly' => [
            'driver' => 'sqlsrv',
            'host' => $params[0]->DB_HOST,
            'database'  =>$params[0]->DB_DATABASE,
            'username' =>  $params[0]->DB_USERNAME,
            'password' => $params[0]->DB_PASSWORD,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]]);

        return DB::connection('onthefly');
    }
}  

