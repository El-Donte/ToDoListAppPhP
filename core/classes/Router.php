<?
class Router{
    protected $routes = [];
    protected $uri;
    protected $method;

    public function __construct(){
        $this->uri=trim(parse_url($_SERVER['REQUEST_URI'])['path']);
        $this->method =$_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
    }

    protected function add($uri, $controller, $method){
        $this->routes[] =[
            'uri' => $uri,
            'controller'=> $controller,
            'method'=>$method,
        ];
    }

    public function get($uri, $controller){
        $this->add($uri,$controller,'GET');
    }

    public function post($uri, $controller){
        $this->add($uri,$controller,'POST');
    }

    public function delete($uri, $controller){
        $this->add($uri,$controller,'DELETE');
    }

    public function patch($uri, $controller){
        $this->add($uri,$controller,'PATCH');
    }

    public function match(){
        $mathes = false;

        foreach($this->routes as $route){
            if($route['uri'] ===$this->uri
            && strtoupper($route['method']) === strtoupper($this->method))
            {
                
                require_once CONTROLLERS."/{$route['controller']}";
                $mathes = true;
                break;
            }
        }

        if(!$mathes) abort();
    }
}