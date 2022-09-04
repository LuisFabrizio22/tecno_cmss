<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct(){
        $this->middleware('user.status');
        $this->middleware('user.permissions');
        $this->middleware('auth');
        $this->middleware('IsAdmin');
    }
    public  function getHome(){
        return view('admin.settings.settings');
    }
    
    public function postHome(Request $request){
      //  $app_project_path='c:/www/md/localhost_pwa/config';
        if(!file_exists(config_path().'/localhost.php')): 
            fopen(config_path().'/localhost.php', 'w');
        endif;
        $file=fopen(config_path().'/localhost.php', 'w');
    
        fwrite($file, '<?php'.PHP_EOL);
        fwrite($file, 'return ['.PHP_EOL);
        foreach($request->except(['_token']) as $key =>$value):
            if(is_null($value)): 
                $value="null";
            endif;
            fwrite($file, '\''.$key.'\'=>\''.$value.'\','.PHP_EOL);
        endforeach;
        fwrite($file, ']'.PHP_EOL);
        fwrite($file, '?>php'.PHP_EOL);
        fclose($file);
       // copy(config_path().'/localhost.php', $app_project_path.'/localhost.php');

        return  back()->with('message', 'Las configuraciones fueron guardadas con éxito')->with('typealert', 'success');
    }
}
