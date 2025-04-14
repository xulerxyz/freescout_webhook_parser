<?php

namespace Nigel\FreescoutWebhookParser\Helpers;

class HtmlCleaner
{
    public function clean(string $html): string
    {
        // Remove HTML tags but preserve line breaks
        $text = strip_tags($html, '<br>');
        
        // Convert <br> tags to newlines
        $text = str_replace(['<br>', '<br/>', '<br />'], "\n", $text);
        
        // Remove multiple spaces
        $text = preg_replace('/\s+/', ' ', $text);
        
        // Trim whitespace
        $text = trim($text);
        
        return $text;
    }
} 