<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField; // Use DateTimeField for createdAt and updatedAt
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('name','Nom')->setColumns('col-md-6'),
            TextField::new('details','Détails')->setColumns('col-md-6'),
            TextField::new('description')->setColumns('col-md-6'),
            AssociationField::new('category','Catégorie')->setColumns('col-md-3'),

            //Using a NumberField type field because the attribute "price" is decimal (numeric)
            NumberField::new('price','Prix')->setColumns('col-md-3'),

            $image = ImageField::new('image')
                ->setUploadDir('public/divers/images')
                ->setBasePath('divers/images')
                ->setSortable(false)
                ->setFormTypeOption('required', false)
                ->setColumns('col-md-2'),

            BooleanField::new('available')
            ->setColumns('col-md-2 mt-4')
            ->setLabel('Disponible'),
            
            DateTimeField::new('createdAt','Créé le')->onlyOnIndex(),
            DateTimeField::new('updatedAt','Modifié le')->onlyOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Plats')
            ->setEntityLabelInSingular('Plat') 
            ->setDefaultSort(['createdAt' => 'DESC'])
            ->setPaginatorPageSize(5)
        ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('name')
            ->add('category')
            ->add('available')
        ;

    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        ;
    }
}
