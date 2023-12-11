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

                $uniqeName = self::generateRandomString(5);
                $className = "style-class-{$uniqeName}-" . count($styles);

                $styles[$className] = $styleValue;

                $element->setAttribute('class', $className);

                $element->removeAttribute("style");

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


    private static function generateRandomString($length = 10) 
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    
}