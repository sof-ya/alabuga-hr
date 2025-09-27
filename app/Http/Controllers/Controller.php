<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OAT;

#[OAT\Info(title: 'API', version: '1.0.0')]
abstract class Controller extends BaseController
{
    //
}
