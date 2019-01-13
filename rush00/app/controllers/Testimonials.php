<?php
/**
 * @author dandelion <web.dandelion@gmail.com>
 */
class App_Testimonials extends Controller
{
    function indexAction(array $params)
    {
        $items = $this->model->testimonial->get();
        foreach ($items as $item)
        {
            $this->tpl->assignBlockVars('tst', array(
                'NAME' => $item->name,
                'MESSAGE'  => nl2br($item->message),
                'CITY'  => $item->city,
                'DUTIES'  => $item->duties,
                'WEBSITE'  => $item->website,
            ));
            if ($item->picture)
            {
                $this->tpl->assignBlockVars('tst.picture', array(
                    'SRC' => $item->picture
                ));
            }
            if ($item->website)
                $this->tpl->assignBlockVars('tst.website');
        }
    }
}