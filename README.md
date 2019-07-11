#Projet Sens Interdits

##Objectif :
Créer un nouveau site pour le festival Sens Interdits, avec une interface administrateur “user friendly”.

##Outils utilisés :
- PHP7
- Framework Symfony 4
- Composer
- Yarn

##Installation:
- composer install
- yarn install
- php bin/console ckeditor:install
- php bin/console assets:install public
- yarn build
- php bin/console doctrine:database:drop --force
- php bin/console doctrine:database:CREATE
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load

##Bundles utilisés :
- mailchimp 
- [Swiftmailer](https://github.com/swiftmailer/swiftmailer)
- [Vich](https://github.com/dustin10/VichUploaderBundle)
- [CKEditor](https://github.com/ckeditor/ckeditor5)
- [Fuse](https://github.com/loilo/Fuse)
- [KNP Paginator](https://packagist.org/packages/knplabs/knp-paginator-bundle)

##Liste des fonctions opérationnelles :
###Côté Administration :
- création d’un formulaire général pour spectacles / actualités / Pages statiques / Hors scène / tournée
- Accès à la partie administrateur (sans que cela apparaisse côté utilisateur)
    - via -> /admin 
    - (actuellement identifiant = demo et MDP = demo)
- formulaire de grilles de tarifs (apparition sous forme de modal)
- formulaire des éditions 
- formulaire de gestion des archives 
- formulaire de création et modification des partenaires
- formulaire de création et modification de thème 
- gestion des fichiers uploadés 
- lien vers billeterie Mapado 
- mise en avant d’un spectacle / actualité / news
- partie internationalisation (A finaliser)

##Côté utilisateur :
- possibilité de visualiser un spectacle ou une date avec les spectacles correspondants.
- visualisation des thèmes en lien avec le spectacle visualisé 
- achat des places via lien Mapado 
- module de recherche
- inscription à la newsletter
- formulaire de contact

Nous avons généré sur l’ensemble des pages dites statiques des fixtures destinées à être remplacées par de vraies informations.

##Points d’amélioration :
finaliser la page accueil hors festival 
terminer l’internationalisation
filtres d’administration des contenus non fonctionnel 
