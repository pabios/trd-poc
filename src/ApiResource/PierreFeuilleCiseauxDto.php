<?php

namespace App\ApiResource;


use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use App\Controller\PierreFeuilleCiseauxAction;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
    shortName: 'pierre',
    operations: [
        new Get(
            controller: PierreFeuilleCiseauxAction::class,
            read: false
        )
    ],
    paginationItemsPerPage: 10,
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
)]
class PierreFeuilleCiseauxDto
{}