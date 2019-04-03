<?php

namespace App\Twig;

use Symfony\Component\Asset\Packages;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    private $container;
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('json_decode', [$this, 'json_decode']),
            new TwigFilter('filter', [$this,'filter']),
            new TwigFilter('str_repeat', [$this,'str_repeat'])
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('file_exists', [$this, 'file_exists']),
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


    /**
     * @param $path
     * @return bool
     */
    public function file_exists($path)
    {
        $path = $this->container->getParameter("kernel.project_dir")."/public".$path;
        return is_file($path);
    }


    public function str_repeat(string $string, int $times)
    {
        if(!$string) return "";
        return str_repeat($string,$times);
    }
}
