<?php
/**
 * Mail Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Mail extends Model
{
    protected $table = 'mailboxes';
    protected $cacheTag = 'mail';
    
    const TOKEN = YANDEX_MAIL_TOKEN;
    
    private $api;
    
    function init()
    {
        $this->api = self::TOKEN ? new Yandex_Mail_UserApi(self::TOKEN) : null;
    }
    
    function isConnected()
    {
        return $this->api;
    }
    
    function getDomain()
    {
        if (!$this->api)
            return null;
        $cacheKey = $this->cacheTag."_domain";
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $response = $this->api->getUsersList();
            $data = $response->domains->domain[0];
            $data = $data->asXml();
            $this->cache->set($data, $cacheKey, array($this->cacheTag), 60*60);
        }
        $data = simplexml_load_string($data);
        return $data;
    }

    function get(&$total=null, $page=1, $count=100)
    {
        $cacheKey = $this->cacheTag."_users_page_{$page}_count_{$count}";
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $response = $this->api->getUsersList($page,$count);
            $data['items'] = $response ? $response->xpath('/page/domains/domain/emails/email') : array();
            foreach ($data['items'] as $d)
            {
                //$d->addChild('user',$this->getById((string)$d->name));
            }
            $data['total'] = $response->xpath('/page/domains/domain/emails/total');
            //$this->cache->set($data, $cacheKey, array($this->cacheTag), 60*60);
        }
        else $total = $data['total'];
        return $data['items'];
    }
    
    function getById($login)
    {
        if (is_null($login)) return new Entity();
        $cacheKey = $this->table.'_'.$this->cacheTag.'_id_'.$login;
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->api->getUserInfo($login)->domain->user;
            $data = $data->asXml();
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        $data = simplexml_load_string($data);
        return new Entity($data);
    }

    function add($login,$password)
    {
        $response = $this->api->createUser($login,$password);
        $this->cache->clean(array($this->cacheTag));
        return $response;
    }

    function edit($login,$password,$first_name = null, $last_name = null, $sex = null)
    {
        $response = $this->api->editUserDetails($login,$password,$first_name,$last_name,$sex);
        $this->cache->clean(array($this->cacheTag));
        return $response;
    }

    function delete($login)
    {
        $response = $this->api->deleteUser($login);
        $this->cache->clean(array($this->cacheTag));
        return $response;
    }
}