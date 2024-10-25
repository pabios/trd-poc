<?php

namespace App\ApiResource;


use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Controller\Action\ParieAction;
use App\Entity\Rencontre;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityToDtoStateProvider;
use DateTime;

#[ApiResource(
    shortName: 'rencontres',
    operations: [
        new Get(
        ),
        new GetCollection(),
        new Post(
            formats: ['json'=>['application/json']]
        ),
        new Post(
            uriTemplate: '/parie',
            formats: ['json' => ['application/json']],
            controller: ParieAction::class,
        )
    ],
    paginationItemsPerPage: 10,
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: Rencontre::class),
)]
class RencontreDto extends BaseDto
{
    public ?string $equipe1 = null;

    public ?string $equipe2 = null;

    public ?float $coteVictoire1 = null;

    public ?float $coteVictoire2 = null;

    public ?float $coteEgalite = null;

    public ?DateTime $dateDuMatch = null;
}