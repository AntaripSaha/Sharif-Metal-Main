<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use App\Database;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    // createDbBackup function start
    public function createDbBackup(){

        $db = new Database;

        $username = env("DB_USERNAME");
        $password = env("DB_PASSWORD");
        $db_name = env("DB_DATABASE");
        $name = 'Backup_'.Carbon::Now()->format('d.m.Y').'.sql';
        $upload_path = public_path('database/');
        $full_path = $upload_path.$name;

        $db->backup =  $full_path;
        $db->save();
        
        exec("mysqldump -u$username -p$password $db_name > $full_path");
        
        $headers = array(
          'Content-Type: application/sql',
        );
    
        return Response::download($full_path,$name,$headers);
      
    }
    // createDbBackup function ends

    public function db_delete($id){

        Database::where('id', $id)->delete();
    }
}
