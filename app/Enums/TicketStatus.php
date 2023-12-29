<?php
/**
 * @author Eguana Team
 * @copyright Copyright (c) 2019 Eguana {http://eguanacommerce.com}
 * Created by PhpStorm
 * User: Talish Nazir
 * Date: 2023-12-28
 * Time: 5:12 PM
 */
declare(strict_types=1);

namespace App\Enums;

/**
 * Class for TicketStatus
 */
enum TicketStatus:string
{
    CASE OPEN = 'open';
    CASE RESOLVED = 'resolved';
    CASE REJECTED = 'rejected';
}
