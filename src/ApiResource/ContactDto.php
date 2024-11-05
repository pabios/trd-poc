<?php

namespace App\ApiResource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Entity\Cagnotte;
use App\Entity\Contact;
use App\State\EntityClassDtoStateProcessor;
use App\State\EntityToDtoStateProvider;

#[ApiResource(
    shortName: 'contact',
    operations: [
        new Get(),
        new GetCollection(),
        new Post(
            formats: ['json'=>['application/json']]
        ),
        new Delete()
    ],
    paginationItemsPerPage: 10,
    provider: EntityToDtoStateProvider::class,
    processor: EntityClassDtoStateProcessor::class,
    stateOptions: new Options(entityClass: Contact::class),
)]
class ContactDto extends BaseDto
{
    public ?string $name = null;

    public ?string $email = null;
    public ?string $phone = null;

}
