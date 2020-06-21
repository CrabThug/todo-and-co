# Contributing

afin de contribuer au projet :

1. realiser un fork
2. Cloner localement votre fork

    `git clone https://github.com/VotrePseudo/todo-and-co.git`

3. Installer le projet et ses dépendances a l'aide des [instructions](https://github.com/CrabThug/todo-and-co/blob/master/README.md), en l'environnement **dev**
4. Créer une nouvelle branche

    `git checkout -b dev`
    
5. Push la branch sur votre fork

    `git push origin dev`

6. Ouvrir une pull request sur le répertoire Github du projet

# Qualité

Lancer les tests :

    `php bin/phpunit` ou sous windows `php vendor\bin\phpunit`
    
La destination de coverage est deja definie en var/report

Pour implémenter de nouveaux tests, 
se référer à la documentation officielle de Symfony Si votre test nécessite une base de données de test, 
vous pouvez faire hériter votre classe par DataFixturesTestCase qui chargera automatiquement des fixtures de test TestFixtures dans la base de données qui a été défini dans le fichier .env.test

### Norme PSR

Afin de verifier votre code avant tout commit, pensez a effectué un test de conformiter aux normes:

**psr1 et ps12**

Cela peut soit se faire a l'aide d'un site tel que codeclimate soit a l'aide de plugin tel que : 

**phpcs, phpcbf, php-cs-fixer**

Soyer clair dans vos messages de commit et commenter votre code si cela vous parait nécessaire.
