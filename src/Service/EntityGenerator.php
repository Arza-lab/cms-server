<?php

namespace App\Service;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\AbstractEntity;
use Nette\PhpGenerator\PhpFile;
use Doctrine\ORM\Mapping;

class EntityGenerator
{
    public const ENTITY_NAME_PATTERN = '%sEntity';

    public const API_PLATFORM_ANNOTATION_PATTERN = 'ApiResource';

    public const DOCTRINE_ORM_ANNOTATION_PATTERN = 'ORM\Entity(repositoryClass: %sRepository::class)';

    public const DOCTRINE_ATTRIBUTE_ANNOTATION_PATTERN = 'ORM\Column(type: \'%s\', length: %d)';

    public function generate(string $entityName): string
    {
        $entityName = str_replace(' ', '', ucwords(str_replace('_', ' ', $entityName)));
        $entityName = sprintf(self::ENTITY_NAME_PATTERN, $entityName);

        return $entityName;
    }

    public function create(string $entityName, string $tableName, array $columns): PhpFile
    {
        $entity = new PhpFile();
        $class = $entity->addClass($entityName);

        //use
        $entity->addUse(ApiResource::class);
        $entity->addUse(Mapping::class, 'ORM');

        //extends AbstractEntity
        $class->setExtends(AbstractEntity::class);

        $class->addAttribute(self::API_PLATFORM_ANNOTATION_PATTERN);
        $class->addProperty('name')->setProtected()->addAttribute('ORM\Column', ['type' => 'string', 'length' => 255]);

        return $entity;
    }

    public function update(string $entityName, string $tableName, array $columns)
    {
        //Todo: implement
    }

    public function delete(string $entityName, string $tableName)
    {
        //Todo: implement
    }


}