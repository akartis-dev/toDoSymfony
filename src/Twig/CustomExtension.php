<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class CustomExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('customDate', [$this, 'formatDate']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('function_name', [$this, 'doSomething']),
        ];
    }

    public function formatDate(\DateTime $value)
    {
    	return $value->format('d M Y');
    }
}
