<?
class Pagination{

    private $total;
    private $per_page;
    private $pages_count;

    private $uri = '';
    private $page;
    private $current_page;
    
    function __construct($page, $per_page, $total){
        $this->total = $total;
        $this->page = $page;
        $this->per_page = $per_page;

        $this->pages_count = $this->getPagesCount();
        $this->current_page = $this->getCurrentPage();
        $this->uri = $this->getParams();
    }

    public function getPagesCount(){
        return ceil($this->total / $this->per_page);
    }

    public function getCurrentPage(){
        if($this->page < 1 || $this->page > $this->pages_count){
            $this->page = 1;
        }
        
        return $this->page;
    }

    public function getParams(){
        $url = $_SERVER['REQUEST_URI'];
        $url = explode('?', $url);
        $uri = $url[0];
        $uri .= '?';

        if(isset($url[1]) && !empty($url[1])){
            $params = explode('&',$url[1]);
            foreach($params as $value){
                if(!str_contains($value,'page=')){
                    $uri .="$value&";
                }
            }
        }

        return $uri;
    }

    public function getStartId(){
        return ($this->page - 1) * $this->per_page;
    }

    public function getPageList(){
        $output = '<nav aria-label="Page navigation example"><ul class="pagination">';
        
        if($this->pages_count > 1){
            for($i = 1; $i <= $this->pages_count; $i++){
                if(((int)$this->current_page) === $i){
                    $output .= '<li class="page-item active"><a class="page-link" href="'.$this->uri.'page='.$i.'">'.$i.'</a></li>';
                }else{
                    $output .='<li class="page-item"><a class="page-link" href="'.$this->uri.'page='.$i.'">'.$i.'</a></li>';
                }
            }
        }

        $output .= '</ul></nav>';
        return $output;
    }
}