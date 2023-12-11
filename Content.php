<?php

namespace common\helpers;

use DOMDocument;

class Content
{

    public static function inlineStyleToClasses($value , $nonce)
    {
        $dom = new DOMDocument();
        if(!$value)
        {
            return;
        }
        $dom->loadHTML($value);



        $elements = $dom->getElementsByTagName('*');

        $styles = [];

        foreach ($elements as $key => $element) 
        {
            if ($element->hasAttribute('style')) 
            {
                $styleValue = $element->getAttribute('style');

                $className = 'style-class-' . count($styles);

                $styles[$className] = $styleValue;

                $element->setAttribute('class', $className);

            }
        }



        $styleElement = $dom->createElement('style');
        $styleElement->setAttribute('nonce',$nonce);
        
        $styleCodes = "";
        foreach ($styles as $className => $style) {
            $styleCodes .= '.' . $className . ' { ' . $style . ' }' . PHP_EOL;
        }
        $styleElement->nodeValue = $styleCodes;
        $dom->appendChild($styleElement);
        
        
        $modifiedHtml = $dom->saveHTML();

        $result = $modifiedHtml . PHP_EOL ;
        
        return $result;


    }
    
}