<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('accountNumber'),
            EmailField::new('email'),
            TextField::new("password"),
            ChoiceField::new("roles")->setChoices([
                'AFPA' => 'ROLE_AFPA',
                'PARTNER' => 'ROLE_PARTENAIRE',
                'EMPLOYE' => 'ROLE_EMPLOYE',
            ])->onlyOnForms()->allowMultipleChoices(),
            AssociationField::new('partner'),
        ];
    }
    
}
