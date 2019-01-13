<?php
/**
 * Виджет отзывов
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Widget_Cert extends aWidget
{
	function init()
    {
        $this->load->model('dir');

        $i=0;
        $files = $this->model->dir->getFiles(DIR_IMAGES.'/cert/s');
        //shuffle($files);
        sort($files);
        foreach ($files as $file)
        {
            $i++;
            $this->tpl->assignBlockVars('widget.cert', array(
                'FILE' => substr($file,strrpos($file,'/')+1)
            ));
            if ($i<=3)
            {
                $this->tpl->assignBlockVars('widget.cert.show');
            }
        }
        if ($i>0)
            $this->tpl->assignBlockVars('widget.if_cert');
    }
}