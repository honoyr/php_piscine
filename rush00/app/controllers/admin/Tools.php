<?php
/**
 * Tools
 *
 * @author dandelion <web.dandelion@gmail.com>
 * @package App_Admin_Tools
 */
class App_Admin_Tools extends Controller
{
	protected $alphabet = array(
	   'ru' => array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',
                     'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я',
                     ' ','+'),
	   'en' => array('a','b','v','g','d','e','yo','zh','z','i','jj','k','l','m','n','o','p','r','s','t','u','f','kh','c','ch','sh','shh','"','y','\'','eh','yu','ya',
                     'A','B','V','G','D','E','Yo','Zh','Z','I','Jj','K','L','M','N','O','P','R','C','T','U','F','Kh','C','Ch','Sh','Shh','"','Y','\'','Eh','Yu','Ya',
                     '-','-')
	);

    function indexAction(array $params)
    {
	    return $this->setPage404();
    }

    function makeKeyAction(array $params)
    {
    	if (!$this->byAjax())
    	    die();

    	$query = @$_POST['query'];
        $result = str_replace($this->alphabet['ru'], $this->alphabet['en'], $query);
        $result = preg_replace('@[^0-9a-z\-_]@i','',$result);
        $result = strtolower($result);
        die($result);
    }
}