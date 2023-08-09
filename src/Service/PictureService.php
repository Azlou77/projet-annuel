<?php

namespace App\Service;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;


class PictureService
{
    /**
     * @var ParameterBagInterface
     * @param ParameterBagInterface $params
     * @return string
     */
    private $params;
    public function getPicture(ParameterBagInterface $params)
    {
        return 'picture';
    }
}
```

?>