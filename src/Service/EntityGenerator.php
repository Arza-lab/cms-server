<?php

namespace App\Service;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Model\AbstractEntity;
use Nette\PhpGenerator\Literal;
use Nette\PhpGenerator\PhpFile;
use Doctrine\ORM\Mapping;
use Nette\PhpGenerator\Printer;

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

    public function create(string $entityName, string $tableName, array $columns)
    {
        $repositoryClass = sprintf('%sRepository::class', $entityName);

        $entity = new PhpFile();
        //$entity->setStrictTypes();

        $nameSpace = $entity->addNamespace('App\Entity');
        $class = $nameSpace->addClass($entityName);


        //use
        $nameSpace->addUse(ApiResource::class);
        $nameSpace->addUse(Mapping::class, 'ORM');
        $nameSpace->addUse('App\Repository\\'.$entityName.'Repository');


        //extends AbstractEntity
        $class->setExtends('\App\Model\AbstractEntity');

        $class->addAttribute(self::API_PLATFORM_ANNOTATION_PATTERN);
        //$class->addAttribute(sprintf(self::DOCTRINE_ORM_ANNOTATION_PATTERN, $entityName));
        $class->addAttribute('Orm\Entity', ['repositoryClass' => new Literal($repositoryClass)]);
        $class->addProperty('name')->setProtected()->addAttribute('ORM\Column', ['type' => 'string', 'length' => 255]);

        $printer = new Printer; // or PsrPrinter
        $printer->setTypeResolving(false);
        $entity =  $printer->printFile($entity);

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