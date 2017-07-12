<?php

namespace boxue\Markdown;

use League\HTMLToMarkdown\HtmlConverter;
use Parsedown;
use Mews\Purifier\Facades\Purifier;

class Markdown
{
    protected $htmlParser;
    protected $markdownParser;

    public function __construct()
    {
        $this->htmlParser = new HtmlConverter(['header_style' => 'atx']);
        $this->markdownParser = new Parsedown();

    }

    public function convertHtmlToMarkdown($html)
    {
        return $this->htmlParser->convert($html);
    }

    public function convertMarkdownToHtml($markdown)
    {
        $convertHtml = $this->markdownParser->text($markdown);
        $convertHtml = Purifier::clean($convertHtml, 'user_topic_body');

        return $convertHtml;

    }
}