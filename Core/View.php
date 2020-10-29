<?php


namespace Core;


use App\Models\Users;
use Composer\Downloader\FileDownloader;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View
{
    public static function render($file, $args= []){
        extract($args, EXTR_SKIP);
        $file = __DIR__."/../App/Views/$file";
        if(is_readable($file)){
            require  $file;
        }else{
            throw new \Exception("$file not found!");
        }
    }


    public static function renderTemplate(string $template , $args = []){//['tenBien'=>$tenBien]
        static $twig = null;
        if($twig == null){
            $loader = new FilesystemLoader('../App/Views');
            $twig = new Environment($loader);
        }

        $args['user'] = Users::layUserHT();
        echo $twig ->render($template,$args);
    }
}