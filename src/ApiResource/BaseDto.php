<?php

namespace App\ApiResource;

use ApiPlatform\Metadata\ApiProperty;

class  BaseDto
{
    #[ApiProperty(readable: false,writable: false,identifier: true)]
    public  $id = null;
    #[ApiProperty(readable: true,writable: false)]
    public ?bool $isActif = true;
}