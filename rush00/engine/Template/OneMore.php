<?php

if (!defined('VIEW'))
    die("Hacking attempt");

/**
 * oneMoreTemplate
 *
 * Stand-alone template engine.
 * @author dandelion <web.dandelion@gmail.com>
 * @version 0.4
 * @package oneMoreTemplate
 */
class Template_OneMore extends Object
{
    /**
     * @var array $_tpldata Main data store
     */
    protected   $_tpldata = array('.' => array());

    /**
     * @var string $filename Name of template file
     */
    protected   $filename;

    protected   $store,
                $code;

    const DIR = DIR_TEMPLATES;   // string
    const DIR_CACHE = DIR_CACHE; // string
    const MINIFY = MINIFY;  // bool
    const MINIFY_HTML = MINIFY_HTML;  // bool
    const MINIFY_JS = MINIFY_JS;  // bool
    const MINIFY_CSS = MINIFY_CSS;  // bool

    function __construct() {}

    /**
     * Assignation one main var
     * @param string $var Var
     * @param string $value Value
     */
    function assignVar($var, $value)
    {
        $this->_tpldata['.'][$var] = $value;
        return $this;
    }

    /**
     * Assignation several main vars
     * @param array $vars Pairs var => value
     */
    function assignVars($vars = array())
    {
        $this->_tpldata['.'] = array_merge($this->_tpldata['.'], $vars);
        return $this;
    }

    /**
     * Append block vars
     *
     * Add vars at the end of existed block without creation a new one.
     * @param string $blockname Block name
     * @param array $vars Pairs var => value
     */
    function appendBlockVars($blockname, $vars = array())
    {
        if (strpos($blockname, '.'))
        {
            $data =& $this->get_data_of_block($blockname, 'last');
            $data =& $data[count($data)-1];
            $data['.'] = array_merge($data['.'], $vars);
        }
        else
        {
            if (($len = count($this->_tpldata[$blockname])) > 0)
                $this->_tpldata[$blockname][$len-1]['.'] = array_merge($this->_tpldata[$blockname][$len-1]['.'], $vars);
        }
        return $this;
    }

    /**
     * Assign block vars
     *
     * Create a new block of vars.
     * @param string $blockname Block name
     * @param array $vars Pairs var => value
     */
    function assignBlockVars($blockname, $vars = array())
    {
        if (strpos($blockname, '.'))
        {
        	$data =& $this->get_data_of_block($blockname, 'last');
        	$data[] = array('.' => $vars);
        }
        else
        {
            $this->_tpldata[$blockname][] = array('.' => $vars);
        }
        return $this;
    }

    /**
     * Compile
     *
     * Compile code, put it into store.
     * @return string Compiled code.
     * @return object
     */
    function compile()
    {
    	Timer::start('template');
        /**
         * Get stuff of template file.
         */
        if (null === $this->filename)
            throw new Exception("Template: File don't assigned yet.");

        $code = '';
        if (self::MINIFY && false === strpos(URL_APP,'admin'))
        {
            $cache = new Minify_Cache_File(self::DIR_CACHE.'/templates');
            $cacheKey = md5($this->filename);
            if ($cache->isValid($cacheKey, filemtime($this->filename)))
            {
            	$code = $cache->fetch($cacheKey);
            }
            else
            {
            	$code = $this->handle(file_get_contents($this->filename));
            	if (self::MINIFY_CSS)
                    $code = $this->optimizeCss($code);
                if (self::MINIFY_JS)
                    $code = $this->optimizeJs($code);
                if (self::MINIFY_HTML)
                    $code = $this->optimizeHtml($code);
            	$cache->store($cacheKey, $code);
            }
        }
        else $code = $this->handle(file_get_contents($this->filename));
        /**
         * Send code in rotation. The main part of compiling.
         */
        $code = $this->rotate($code);
        /**
         * Replace main vars & delete not assigned vars.
         */
        while (preg_match('@\{([a-z0-9\-_]+)(?:\|([a-z0-9\-_]+))?\}@i', $code, $vars_m))
        {
            if (isset($this->_tpldata['.'][$vars_m[1]]))
                $code = str_replace($vars_m[0], $this->_tpldata['.'][$vars_m[1]], $code);
            elseif (isset($vars_m[2]) && isset($this->_tpldata['.'][$vars_m[2]]))
                $code = str_replace($vars_m[0], $this->_tpldata['.'][$vars_m[2]], $code);
            else
                $code = str_replace($vars_m[0], '', $code);
        }
        /**
         * Clear code
         */
        if (!self::MINIFY)
        {
	        $code = preg_replace('@^\s+$@im',  '',      $code);
	        $code = preg_replace('@\n{2,}@is', PHP_EOL, $code);
	        $code = preg_replace('@\t@i',      "    ",  $code);
        }
        $code = str_replace('<script:no-cache','<script',$code);
        $code = str_replace('<style:no-cache','<style',$code);

        $this->store = $code;

        Timer::finish('template');
        return $this;
    }

    private function handle($code)
    {
    	/**
         * Delete comments <!--# comments #-->
         */
        while (preg_match('@<!--#(.*?)#-->@is', $code, $m))
            $code = str_replace($m[0], '', $code);

        /**
         * Include interior template files.
         */
        while (preg_match('@<!-- INCLUDE (?P<file_path>[^<> ]+) -->@i', $code, $files_m))
            if (file_exists(self::DIR.'/'.$files_m['file_path']))
                $code = str_replace($files_m[0], file_get_contents(self::DIR.'/'.$files_m['file_path']), $code);
            else
                $code = str_replace($files_m[0], '', $code);

        return $code;
    }

    /**
     * Display
     *
     * Print just compiled code.
     * @return object
     */
    function display()
    {
        echo $this->getOutput();
        return $this;
    }

    /**
     * Get output
     *
     * Return just compiled code.
     * @return object
     */
    function getOutput()
    {
        if (null !== $this->store)
            return $this->store;
        else die("Template: File don't compiled yet.");
    }

    /**
     * Return link to block data
     *
     * @param string $blockname Block name
     * @param string $iterator_mode Mode of iterator ($i): current or last
     * @return array
     */
    protected function &get_data_of_block($blockname, $iterator_mode)
    {
        $blocks = explode('.', $blockname);
        $last_block = $blocks[sizeof($blocks)-1];
        $data = &$this->_tpldata;
        foreach ($blocks as $block)
        {
            $data = &$data[$block];
            if ($iterator_mode == 'current')
                $iteration = (isset($data['.'])) ? $data['.'] : 0;
            elseif ($iterator_mode == 'last')
            {
                if ($block == $last_block && !isset($data))
                    $data = array();

                if (isset($data))
                    $iteration = sizeof($data) - 1;
                else
                    die("Template: block \'".$block."\' does not assign.");
            }
            if ($block != $last_block)
                $data = &$data[$iteration];
        }
        return $data;
    }

    /**
     * Rotation
     *
     * The funniest function of this class.
     * This is a recursive function that go through blocks until the last one. On its way assigned vars are replaced.
     * Different block's directives handle here.
     * The nesting of blocks is not so important.
     * @param string $code Code in process of compiling
     * @return string Almost compiled code
     */
    protected function rotate($code)
    {
        while (preg_match('@<!-- BEGIN (?P<blockname>[^ ]+)(?P<directives>[^<>]*)? -->@i', $code, $m))
        {
            if (preg_match('@'.preg_quote($m[0]).'(?P<inside_block>.*?)<!-- END '.preg_quote($m['blockname']).' -->@is', $code, $block_m))
            {
                if (isset($m['directives']))
                {
                    /**
                     * Directives:
                     *
                     * [FROM #expr0]
                     * [FROM #expr0 TILL #exprN]
                     */
                    if (stripos($m['directives'], '[FROM'))
                    {
                        if (preg_match('@\[FROM (?P<from>[\+\*\/\-0-9N]+)(?: TILL (?P<till>[\+\*\/\-0-9N]+))?\]@i', $m['directives'], $d_from_m))
                        {
                            $i_start_expr = $d_from_m['from'];
                            $i_finish_expr = (isset($d_from_m['till'])) ? $d_from_m['till'] : NULL;
                        }
                    }

                    /**
                     * [MOD #div #mod]
                     */
                    if (stripos($m['directives'], '[MOD'))
                    {
                        if (preg_match('@\[MOD (?P<div>[0-9]+) (?P<mod>[0-9]+)\]@i', $m['directives'], $d_mod_m))
                        {
                            $i_interval = $d_mod_m['div'];
                            $i_start = $d_mod_m['mod'];
                        }
                    }

                    /**
                     * [SEPARATOR]
                     */
                    if (stripos($m['directives'], '[SEPARATOR'))
                    {
                        if (preg_match('@\[SEPARATOR=(?P<spr>[^\]]+)\]@i', $m['directives'], $d_spr_m))
                        {
                            $insert_separator = true;
                            $separator = $d_spr_m['spr'];
                        }
                    }

                    /**
                     * [NESTED]
                     */
                    if (stripos($m['directives'], '[NESTED]'))
                    {
                        $make_nest = true;
                        while (preg_match('@\{([a-z0-9\-_]+)\[NESTED\]\}@i', $block_m['inside_block'], $nested_m))
                            $block_m['inside_block'] = str_replace($nested_m[0], '{'.$m['blockname'].'.'.$nested_m[1].'}', $block_m['inside_block']);
                    }

                    /**
                     * [REVERSE]
                     */
                    if (stripos($m['directives'], '[REVERSE]'))
                        $reverse_block = true;
                }

                $data =& $this->get_data_of_block($m['blockname'], 'current');

                if (isset($data))
                {
                    $code_temp = '';
                    if (!isset($i_interval)) $i_interval = 1;
                    if (!isset($i_start)) $i_start = 0;

                    $data['.'] = $i_start;
                    $i_finish_check = sizeof($data)-2;

                    /**
                     * Actions of [REVERSE] directive
                     */
                    if (isset($reverse_block) && $reverse_block)
                    {
                        $data = array_reverse($data);
                        unset($reverse_block);
                    }

                    /**
                     * Actions of [FROM #expr0 TILL #exprN] directive
                     */
                    if (isset($i_start_expr))
                    {
                        $i_start_expr = str_replace('N',$i_finish_check,$i_start_expr);
                        eval('$i_start = '.$i_start_expr.';');
                        unset($i_start_expr);
                    }
                    if (isset($i_finish_expr))
                    {
                        $i_finish_expr = str_replace('N',$i_finish_check,$i_finish_expr);
                        eval('$i_finish = '.$i_finish_expr.';');
                        unset($i_finish_expr);
                    }

                    /**
                     * Check interval
                     */
                    if (!isset($i_finish) || $i_finish > $i_finish_check)
                        $i_finish = $i_finish_check;
                    if ($i_start < 0) $i_start = 0;
                    $data['.'] = $i_start;

                    /**
                     * Block iteration
                     */
                    for ($i = $i_start; $i <= $i_finish; $i+= $i_interval)
                    {
                        $code_inside_block = $block_m['inside_block'];
                        $current_block =& $this->get_data_of_block($m['blockname'], 'current');
                        $block_iteration = (isset($current_block['.'])) ? $current_block['.'] : 0;
                        $current_block =& $current_block[$block_iteration];

                        /**
                         * Replace vars of current block.
                         */
                        while (preg_match('@\{'.preg_quote($m['blockname']).'\.([a-z0-9\-_]+)(?:\|([a-z0-9\-_]+))?\}@i', $code_inside_block, $blockvars_m))
                        {
                            if (isset($current_block['.'][$blockvars_m[1]]))
                                $code_inside_block = str_replace($blockvars_m[0], $current_block['.'][$blockvars_m[1]], $code_inside_block);
                            elseif (isset($blockvars_m[2]) && isset($current_block['.'][$blockvars_m[2]]))
                                $code_inside_block = str_replace($blockvars_m[0], $current_block['.'][$blockvars_m[2]], $code_inside_block);
                            else
                                $code_inside_block = str_replace($blockvars_m[0], '', $code_inside_block);
                        }

                        /**
                         * Actions of [SEPARATOR] directive
                         */
                        if (isset($insert_separator) && $insert_separator && $i<=($i_finish-$i_interval))
                            $code_inside_block.= $separator;
                        else
                            $insert_separator = false;

                        /**
                         * Actions of [NESTED] directive
                         */
                        if (isset($make_nest) && $make_nest)
                        {
                            $nest_block_keys = array_keys($current_block);
                            $nest_block_insert = '';
                            foreach ($nest_block_keys as $nest_block_key)
                            {
                                if ($nest_block_key != '.')
                                {
                                    $nest_block = preg_replace('@<!-- (BEGIN|END) '.preg_quote($m['blockname']).'@', '\\0.'.$nest_block_key, $block_m[0]);
                                    $nest_block_insert.= $nest_block;
                                }
                            }
                            $code_inside_block = str_replace('{[NEST]}', $nest_block_insert, $code_inside_block);
                        }

                        /**
                         * Next rotate...
                         */
                        $code_temp.= $this->rotate($code_inside_block);
                        $data['.'] += $i_interval;
                    }
                    $code = str_replace($block_m[0], $code_temp, $code);
                }
                else $code = str_replace($block_m[0], '', $code);
            }
            else $code = str_replace($m[0], '', $code);
            unset($i_interval,$i_start,$i_finish);
        }
        return $code;
    }

    /**
     * Set filename
     *
     * Set template's filename
     * @param string $filename Filename
     * @return object
     */
    function setFile($filename)
    {
    	if (file_exists($filename))
            $this->filename = $filename;
        else die ("Template: File ".$filename." don't exist.");
        return $this;
    }

    /**
     * Minify code
     *
     * @param string $code
     * @see Minify_HTML
     */
    private function optimizeHtml($code)
    {
    	$options = array(
    	   'jsMinifier'  => array('Minify_Javascript', 'minify'),
    	   'cssMinifier' => array('Minify_CSS', 'minify')
    	);
    	return Minify_HTML::minify($code, $options);
    }

    /**
     * 1) Mix several constant js-files in one big (only which in head tag) + gziped version
     * 2) Put inline code in the external file + gziped version
     * 3) Adjust code by replacing js in head of html
     *
     * @param string $code
     */
    private function optimizeJs($code)
    {
        /**
         * Get rid of IE special tags
         */
        $codeIeTags = '';
        while (preg_match('@<!\-\-\[(.*?)\]\-\->@is', $code, $ie_m))
        {
            $codeIeTags .= $ie_m[0];
            $code = str_replace($ie_m[0], '', $code);
        }
    	/**
    	 * Get head code
    	 */
    	if (preg_match('@<head>(.*)<\/head>@is', $code, $head_m))
    	{
    	    $head = $head_m[1];
    	    $code = str_replace($head_m[1], '', $code);
    	}
    	else return $code;
    	/**
    	 * Mix internal js files in head
    	 */
    	$mix = $codeMix = $codeNoMix = $mixFileName = '';
    	$mixDir = DIR_SCRIPTS.'/mix/';
    	$mixPaths = array();
        while (preg_match('@<script([^>+])*src=(\"|\')(?P<path>[^\"\']+)(\2)([^>]+)*>(.*?)<\/script>@is', $head, $script_m))
        {
        	if (file_exists(DIR_ROOT.'/'.$script_m['path']))
                $mixPaths[] = $script_m['path'];
        	else
        	    $codeNoMix .= $script_m[0];
            $head = str_replace($script_m[0], '', $head);
        }
        if (!empty($mixPaths))
        {
	        foreach ($mixPaths as $path)
	        {
	        	$mixFileName .= $path.filemtime(DIR_ROOT.'/'.$path);
	        }
	        $mixFileName = md5($mixFileName);
	        $mixFilePath = $mixDir.$mixFileName.EXT_JS;
	        if (!file_exists($mixFilePath))
	        {
		        foreach ($mixPaths as $path)
		        {
		        	$mix .= @file_get_contents(DIR_ROOT.'/'.$path);
		        }
		        $mix = Minify_Javascript::minify($mix);
		        @file_put_contents($mixFilePath, $mix); // normal
		        if (filesize($mixFilePath) > 500)
                    @file_put_contents($mixFilePath.EXT_GZ, gzencode($mix)); // gzipped
	        }
	        $codeMix = '<script src="'.preg_replace('@^'.preg_quote(DIR_ROOT.'/').'(.*)$@i','\\1',$mixFilePath).'" type="text/javascript"></script>';
        }
        /**
         * Put inline code in the external file
         */
        $inlineJs = $codeInlineJs = '';
        $inlineJsDir = DIR_SCRIPTS.'/custom/';
        // Create new block of code (code + cut head) in order to find inline js in head
        $code2 = preg_replace('@<head>(.*)<\/head>@i', '<head>'.$head.'</head>', $code);
        while (preg_match('@<script(?:(?:[^>]*)src=(\"|\')(?P<path>[^\"\']+)(\\1))?(?:[^>]*)>(?P<code>.*?)<\/script>@is', $code2, $script_m))
        {
        	if (0===strpos($script_m[0],'<script:no-cache'))
        	{
        		$code2 = str_replace($script_m[0], '', $code2);
        		continue;
        	}
        	if (!empty($script_m['path']))
        	{
        	    $inlineJs .= @file_get_contents(DIR_ROOT.'/'.$script_m['path']);
        	}
        	else
        	    $inlineJs .= $script_m['code'];
        	$code2 = str_replace($script_m[0], '', $code2);
            $code = str_replace($script_m[0], '', $code);
            $head = str_replace($script_m[0], '', $head);
        }
        if (!empty($inlineJs))
        {
            $inlineJsFileName = md5($inlineJs);
            $inlineJsFilePath = $inlineJsDir.$inlineJsFileName.EXT_JS;
        	$inlineJs = Minify_Javascript::minify($inlineJs);
            @file_put_contents($inlineJsFilePath, $inlineJs); // normal
            if (filesize($inlineJsFilePath) > 500)
                @file_put_contents($inlineJsFilePath.EXT_GZ, gzencode($inlineJs)); // gzipped
            $codeInlineJs = '<script src="'.preg_replace('@^'.preg_quote(DIR_ROOT.'/').'(.*)$@i','\\1',$inlineJsFilePath).'" type="text/javascript"></script>';
        }
        /**
         * Put the head back
         */
        $head .= $codeIeTags.$codeNoMix.$codeMix.$codeInlineJs;
        $code = preg_replace('@<head>(.*)<\/head>@i', '<head>'.$head.'</head>', $code);
        $code = str_replace('<script:no-cache','<script',$code);
        $code = str_replace('<style:no-cache','<style',$code);
        return $code;
    }

    /**
     * 1) Mix several constant css-files in one big (only which in head tag) + gziped version
     * 2) Put inline code in the external file + gziped version
     * 3) Adjust code by replacing css in head of html
     *
     * @param string $code
     */
    private function optimizeCss($code)
    {
        /**
         * Get head code
         */
        if (preg_match('@<head>(.*)<\/head>@is', $code, $head_m))
        {
            $head = $head_m[1];
            $code = str_replace($head_m[1], '', $code);
        }
        else return $code;
        /**
         * Get rid of IE special tags
         */
        $codeIeTags = '';
        while (preg_match('@<!\-\-\[(.*?)\]\-\->@is', $head, $ie_m))
        {
            $codeIeTags .= $ie_m[0];
            $head = str_replace($ie_m[0], '', $head);
        }
        /**
         * Mix internal css files in head
         */
        $mix = $codeMix = $codeNoMix = $mixFileName = '';
        $mixDir = DIR_STYLES.'/mix/';
        $mixPaths = array();
        while (preg_match('@<link([^>+])*href=(\"|\')(?P<path>[^\"\']+)(\2)([^>]+)*\/>@is', $head, $style_m))
        {
            if (file_exists(DIR_ROOT.'/'.$style_m['path']) && strpos($style_m[0],'rel="stylesheet"'))
                $mixPaths[] = $style_m['path'];
            else
                $codeNoMix .= $style_m[0];
            $head = str_replace($style_m[0], '', $head);
        }
        if (!empty($mixPaths))
        {
            foreach ($mixPaths as $path)
            {
                $mixFileName .= $path.filemtime(DIR_ROOT.'/'.$path);
            }
            $mixFileName = md5($mixFileName);
            $mixFilePath = $mixDir.$mixFileName.EXT_CSS;
            if (!file_exists($mixFilePath))
            {
                foreach ($mixPaths as $path)
                {
                    $mix .= @file_get_contents(DIR_ROOT.'/'.$path);
                }
                $mix = Minify_CSS::minify($mix);
                // Add path levels for images [pervert hack, sorry]
                $mix = preg_replace('@(\(|\"|\')(\.\.\/)+([^\.])@i','\\1../../\\3',$mix);
                @file_put_contents($mixFilePath, $mix); // normal
                if (filesize($mixFilePath) > 500)
                    @file_put_contents($mixFilePath.EXT_GZ, gzencode($mix)); // gzipped
            }
            $codeMix = '<link href="'.preg_replace('@^'.preg_quote(DIR_ROOT.'/').'(.*)$@i','\\1',$mixFilePath).'" rel="stylesheet" type="text/css"/>';
        }
        /**
         * Put inline code in the external file
         */
        $inlineCss = $codeInlineCss = '';
        $inlineCssDir = DIR_STYLES.'/custom/';
        // Create new block of code (code + cut head) in order to find inline css in head
        $code2 = preg_replace('@<head>(.*)<\/head>@i', '<head>'.$head.'</head>', $code);
        while (preg_match('@<style(?:(?:[^>]*)href=(\"|\')(?P<path>[^\"\']+)(\\1))?(?:[^>]*)>(?P<code>.*?)<\/style>@is', $code2, $style_m))
        {
            if (0===strpos($style_m[0],'<style:no-cache'))
            {
                $code2 = str_replace($style_m[0], '', $code2);
                continue;
            }
            if (!empty($style_m['code']))
                $inlineCss .= $style_m['code'];
            $code2 = str_replace($style_m[0], '', $code2);
            $code = str_replace($style_m[0], '', $code);
            $head = str_replace($style_m[0], '', $head);
        }
        while (preg_match('@<link(?:(?:[^>]*)href=(\"|\')(?P<path>[^\"\']+)(\\1))?(?:[^>]*)\/>@is', $code2, $style_m))
        {
            if (!empty($style_m['path']) && strpos($style_m[0],'rel="stylesheet"'))
                $inlineCss .= @file_get_contents(DIR_ROOT.'/'.$style_m['path']);
            $code2 = str_replace($style_m[0], '', $code2);
            $code = str_replace($style_m[0], '', $code);
            //$head = str_replace($style_m[0], '', $head);
        }
        if (!empty($inlineCss))
        {
            $inlineCssFileName = md5($inlineCss);
            $inlineCssFilePath = $inlineCssDir.$inlineCssFileName.EXT_CSS;
            $inlineCss = Minify_CSS::minify($inlineCss);
            // Add path levels for images [again that pervert hack, sorry]
            $inlineCss = preg_replace('@(\(|\"|\')(\.\.\/)+([^\.])@i','\\1../../\\3',$inlineCss);
            @file_put_contents($inlineCssFilePath, $inlineCss); // normal
            if (filesize($inlineCssFilePath) > 500)
                @file_put_contents($inlineCssFilePath.EXT_GZ, gzencode($inlineCss)); // gzipped
            $codeInlineCss = '<link href="'.preg_replace('@^'.preg_quote(DIR_ROOT.'/').'(.*)$@i','\\1',$inlineCssFilePath).'" rel="stylesheet" type="text/css"/>';
        }
        /**
         * Put the head back
         */
        $head .= $codeIeTags.$codeNoMix.$codeMix.$codeInlineCss;
        $code = preg_replace('@<head>(.*)<\/head>@i', '<head>'.$head.'</head>', $code);
        $code = str_replace('<style:no-cache','<style',$code);
        return $code;
    }
}