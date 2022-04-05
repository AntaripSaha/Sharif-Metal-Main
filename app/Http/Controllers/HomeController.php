<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

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
        
        $username = env("DB_USERNAME");
        $password = env("DB_PASSWORD");
        $db_name = env("DB_DATABASE");
        $name = 'export_'.time().'.sql';
        $upload_path = public_path('database/');
        $full_path = $upload_path.$name;
        
        exec("mysqldump -u$username -p$password $db_name > $full_path");
        
        $headers = array(
          'Content-Type: application/sql',
        );
    
        return Response::download($full_path,$name,$headers);
    }
    // createDbBackup function ends
}
