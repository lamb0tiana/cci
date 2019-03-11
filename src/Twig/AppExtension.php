<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('json_decode', [$this, 'json_decode']),
            new TwigFilter('filter', [$this,'filter'])
        ];
    }



    public function json_decode($value, $assoc = false)
    {
        return json_decode($value,$assoc);
    }

    public function filter(Array $array, $search_field,$value, $operator,$keep_index = false)
    {
        $filtered = array_filter($array,function($e)use($search_field,$value,$operator)
            {
                if($operator == "eq")
                {
                    return $e[$search_field] == $value;
                }
                else{
                    throw new \Exception("operator required");
                }
            });

        if(!$keep_index)
        {
            return array_values($filtered);
        }
        return $filtered;
    }
}
