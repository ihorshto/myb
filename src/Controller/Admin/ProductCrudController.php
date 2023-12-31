<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {

 

        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('name'),
            TextField::new('subtitle'),
        //    SlugField::new('slug')->setTargetFieldName('name'),
            AssociationField::new('category'),
            ImageField::new('illustration')
                ->setBasePath('uploads/images/')
                ->setUploadDir($this->getParameter('FOLDER_UPLOAD_IMAGE'))
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
            TextEditorField::new('description'),
            MoneyField::new('price')->setCurrency('EUR')
        ];
    }
}
