<?php

/**
 * Wiki Model
 *
 * @author dandelion <web.dandelion@gmail.com>
 */
class Model_Wiki extends Model
{
    public $wiki;

    const PARSER = 'Default';
    const RENDER = 'Xhtml';

    function init()
    {
        $wiki =& Text_Wiki::factory(self::PARSER);

        /**
         * Wiki Conf's
         */
        $wiki->setRenderConf('xhtml', 'toc',   'url',        '{URL_THIS}');
        $wiki->setRenderConf('xhtml', 'url',   'target',     '_self');
        $wiki->setRenderConf('xhtml', 'table', 'css_table',  'wikitable');
        //$wiki->setRenderConf('xhtml', 'url',   'images',     false);

        $this->wiki = $wiki;
    }

    function parse($text, $wiki = null)
    {
        if (is_null($wiki))
            $wiki = $this->wiki;
        $text = $wiki->transform($text, self::RENDER);
        $text = stripslashes($text);
        $text = Minify_HTML::minify($text);
        return $text;
    }

    function parseSimple($text)
    {
        $rules = array(
            'List',
            'Newline',
            'Paragraph',
            'Url',
            'Colortext',
            'Strong',
            'Emphasis',
            'Italic',
            'Underline',
            'Tt',
            'Superscript',
            'Subscript',
            'Revise',
            'Tighten'
        );
        $wiki =& Text_Wiki::factory(self::PARSER, $rules);
        $wiki->setRenderConf('xhtml', 'url',   'target',     '_self');
        return $this->parse($text, $wiki);
    }

    function parseArticle($text)
    {
        $rules = array(
            'Prefilter',
            'Delimiter',
            'Code',
            'Html',
            'Raw',
            'Anchor',
            'Heading',
            'Toc',
            'Horiz',
            'Break',
            'Blockquote',
            'List',
            'Table',
            'Image',
            'Center',
            'Newline',
            'Paragraph',
            'Url',
            'Colortext',
            'Strong',
            'Emphasis',
            'Italic',
            'Underline',
            'Tt',
            'Superscript',
            'Subscript',
            'Revise',
            'Tighten'
        );
        $wiki =& Text_Wiki::factory(self::PARSER, $rules);
        $wiki->setRenderConf('xhtml', 'toc',   'url',        '{URL_THIS}');
        $wiki->setRenderConf('xhtml', 'url',   'target',     '_self');
        $wiki->setRenderConf('xhtml', 'table', 'css_table',  'wikitable');
        $wiki->setRenderConf('xhtml', 'image', 'base',       'images/');
        $wiki->enableRule('html');
        return $this->parse($text, $wiki);
    }

    function parseComment($text)
    {
        $rules = array(
            'Prefilter',
            'Delimiter',
            'Blockquote',
            'List',
            'Image',
            'Center',
            'Newline',
            'Paragraph',
            'Url',
            'Colortext',
            'Strong',
            'Emphasis',
            'Italic',
            'Underline',
            'Tt',
            'Superscript',
            'Subscript',
            'Revise',
            'Tighten'
        );
        $wiki =& Text_Wiki::factory(self::PARSER, $rules);
        $wiki->setRenderConf('xhtml', 'url',   'target',     '_self');
        return $this->parse($text, $wiki);
    }
}