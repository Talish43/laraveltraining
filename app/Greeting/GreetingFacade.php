<?php
/**
 * @author Eguana Team
 * @copyright Copyright (c) 2019 Eguana {http://eguanacommerce.com}
 * Created by PhpStorm
 * User: Talish Nazir
 * Date: 2023-12-29
 * Time: 9:58 AM
 */
declare(strict_types=1);

namespace App\Greeting;
use Illuminate\Support\Facades\Facade;

/**
 * Class for GreetingFacade
 */
class GreetingFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'greeting';
    }
}
