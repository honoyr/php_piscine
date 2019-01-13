<?php
/**
 * Product Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Product extends Model_Default
{
    protected $table = 'products';
    protected $cacheTag = 'product';

    public $album;

    function init()
    {
    	$this->category = new Model_Product_Category;
        $this->structure = new Model_Product_Structure;
    }    
    
    function getById($id)
    {
        $cacheKey = $this->cacheTag."_product_by_id_{$id}";
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->selectRow(
                "SELECT * FROM ?_{$this->table}
                WHERE `id`=?",$id
            );
            if (!empty($data))
                $data['category'] = $this->category->getByProductId($id);
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function get(&$total=null, $start=0, $count=100000, $disabled = false)
    {
        $cacheKey = $this->cacheTag."_start_{$start}_count_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT * FROM ?_{$this->table}
                { WHERE `disabled`=? }
                ORDER BY `position` DESC LIMIT ?d,?d",
                !$disabled ? 0 : DBSIMPLE_SKIP,
                $start, $count
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }
    
    function getByIds($ids)
    {
        $cacheKey = $this->cacheTag."_ids_".join('|',$ids);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT * FROM ?_{$this->table}
                WHERE id IN (?a)
                ORDER BY `position` DESC",
                $ids
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }

    function getByCategory($category_id, &$total=null, $start=0, $count=100000, $disabled = false)
    {
        $cacheKey = $this->cacheTag."_by_category_{$category_id}_start_{$start}_count_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT DISTINCT p.* FROM ?_{$this->table} p
                JOIN ?_{$this->structure->getTable()} s ON s.`product_id`=p.`id`
                WHERE s.`category_id`=?d { AND p.`disabled`=? }
                ORDER BY p.`position` DESC,p.`timestamp` DESC LIMIT ?d,?d",
                $category_id, !$disabled ? 0 : DBSIMPLE_SKIP, $start, $count
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }

    function getMain(&$total=null, $start=0, $count=100000, $disabled = false)
    {
        $cacheKey = $this->cacheTag."_main_start_{$start}_count_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT * FROM ?_{$this->table}
                WHERE `main`=1 { AND `disabled`=? }
                ORDER BY `position_main` DESC LIMIT ?d,?d",
                !$disabled ? 0 : DBSIMPLE_SKIP,
                $start, $count
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }

    function search($query, &$total=null, $start=0, $count=100000)
    {
        $cacheKey = $this->cacheTag."_search_{$query}_start_{$start}_count_{$count}";
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT * FROM ?_{$this->table}
                WHERE (`name` LIKE ? OR `description` LIKE ?) AND `disabled`=0
                LIMIT ?d,?d",
                '%'.$query.'%', '%'.$query.'%', $start, $count
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }

    static function checkIfKeyExists($key)
    {
        if ($key=='item')
            return false;
        if (isset($_POST['my_key']) && $_POST['my_key']==$key)
            return true;
        return !Db::factory()->selectCell("SELECT COUNT(`id`) FROM ?_product_categories WHERE `key`=?",$key);
    }

    function getCount($category_id)
    {
        $cacheKey = $this->cacheTag."_count_$category_id";
        if (false === ($count = $this->cache->get($cacheKey)))
        {
        	$subcat_ids = array($category_id);
        	$subcats = $this->model->product->category->getSub($category_id);
        	foreach ($subcats as $subcat)
        	    $subcat_ids[] = $subcat->id;
            $count = $this->db->selectCell(
                "SELECT COUNT(DISTINCT p.`id`) FROM ?_{$this->table} p
                JOIN ?_{$this->structure->getTable()} s ON s.`product_id`=p.`id`
                WHERE s.`category_id` IN(?a) AND p.`disabled`=0",
                $subcat_ids
            );
            $this->cache->set($count, $cacheKey, array($this->cacheTag));
        }
        return $count;
    }
}

class Model_Product_Category extends Model_Default
{
    protected $table = 'product_categories';
    protected $cacheTag = 'product';

    function init()
    {

    }
    
    function get(&$total=null,$start=0,$count=1000,$disabled=false)
    {
        $cacheKey = $this->cacheTag."_cats_limit_{$start}_{$count}_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data['items'] = (array)$this->db->selectPage($total,
                "SELECT * FROM ?_{$this->table}
                { WHERE `disabled`=? }
                ORDER BY `position` DESC
                LIMIT ?d,?d",
                !$disabled ? 0 : DBSIMPLE_SKIP,
                $start, $count
            );
            $data['total'] = $total;
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        else $total = $data['total'];
        return new Entity($data['items']);
    }

    function getSub($parent_id = null, $disabled = false)
    {
        $cacheKey = $this->cacheTag."_cats_sub_".$parent_id."_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                WHERE `parent_id`<>0 {AND `parent_id`=?d} { AND `disabled`=? }
                ORDER BY `position` DESC",
                ($parent_id)?$parent_id:DBSIMPLE_SKIP,
                !$disabled ? 0 : DBSIMPLE_SKIP
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function getMain($disabled = false)
    {
        $cacheKey = $this->cacheTag."_cats_main_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->select(
                "SELECT * FROM ?_{$this->table}
                WHERE `parent_id`=0 { AND `disabled`=? }
                ORDER BY `position` DESC",
                !$disabled ? 0 : DBSIMPLE_SKIP
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function getTree($disabled = false)
    {
        $cacheKey = $this->cacheTag."_cats_tree_disabled_".((int)$disabled);
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = array();
            $items = $this->getMain($disabled);
            foreach ($items as $item)
            {
                $subdata = array();
                $subitems = $this->getSub($item->id,$disabled);
                foreach ($subitems as $subitem)
                {
                    if (!$subitem->disabled)
                    {
                        $subsubdata = array();
                        $subsubitems = $this->getSub($subitem->id,$disabled);
                        foreach ($subsubitems as $subsubitem)
                        {
                            if (!$subsubitem->disabled)
                            {
                                $subsubdata[] = $subsubitem->asArray();
                            }
                        }
                        if ($subsubdata)
                            $subitem->children = $subsubdata;
                        $subdata[] = $subitem->asArray();
                    }
                }
                if ($subdata)
                    $item->children = $subdata;
                $data[] = $item->asArray();
            }
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function getByKey($key)
    {
        $cacheKey = $this->cacheTag."_cats_by_key_{$key}";
        if (false === ($data = $this->cache->get($cacheKey)))
        {
            $data = $this->db->selectRow(
                "SELECT * FROM ?_{$this->table}
                WHERE `key`=? LIMIT 1", $key
            );
            $this->cache->set($data, $cacheKey, array($this->cacheTag));
        }
        return new Entity($data);
    }

    function getByProductId($id)
    {
        $data = $this->db->select(
            "SELECT c.* FROM ?_product_structure s
            JOIN ?_{$this->table} c ON c.id=s.category_id
            WHERE s.product_id=?d
            ORDER BY c.`position` DESC", $id
        );
        return new Entity($data);
    }
}
class Model_Product_Structure extends Model_Default
{
    protected $table = 'product_structure';
    protected $cacheTag = 'product';

    function deleteByProductId($id)
    {
        $this->db->query("DELETE FROM ?_{$this->table} WHERE `product_id`=?", $id);
        $this->cache->clean(array($this->cacheTag));
        return $this;
    }
}