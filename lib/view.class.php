<?php
class View{
    protected $data;
    protected $path;
    public function __construct($data=array(),$path=null){
        if(!$path){
            $path=self::getDefaultViewPath();
        }
        if(!file_exists($path)){
            throw new Exception("VIEW $path");
        }

        $this->path=$path;
        $this->data=$data;
    }
    protected static function getDefaultViewPath(){
        $router=App::getRouter();
        if(!$router){
            return false;
        }
        $controller_dir=$router->getController();
        $template_name=$router->getMethodPrefix().$router->getAction().'.php';
        return VIEW_PATH.DS.$controller_dir.DS.$template_name;

    }
    public function render(){
        $data=$this->data;

        ob_start();
        include ($this->path);
        $content= ob_get_clean();
        return $content;
    }
}
?>