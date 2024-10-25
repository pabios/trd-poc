<?php

namespace App\Domain\Extension;

use ApiPlatform\Doctrine\Orm\Extension\QueryCollectionExtensionInterface;
use ApiPlatform\Doctrine\Orm\Extension\QueryItemExtensionInterface;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use ApiPlatform\Metadata\Operation;
use App\Entity\Cagnotte;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bundle\SecurityBundle\Security;

class CurrentUserExtension implements QueryCollectionExtensionInterface, QueryItemExtensionInterface
{

    public function __construct(
        private Security $security
    ){}
    public function applyToCollection(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, ?Operation $operation = null, array $context = []): void
    {
        if ($resourceClass !== Cagnotte::class) {
            return;
        }

        $user = $this->security->getUser();

        if (!$user) {
            $queryBuilder->andWhere('1 = 0');
            return;
        }

        $rootAlias = $queryBuilder->getRootAliases()[0];
        $queryBuilder->andWhere(sprintf('%s.user = :current_user', $rootAlias))
            ->setParameter('current_user', $user);
    }

    public function applyToItem(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, array $identifiers, ?Operation $operation = null, array $context = []): void
    {
        // TODO: Implement applyToItem() method.
    }
}