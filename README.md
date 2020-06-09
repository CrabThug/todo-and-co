ToDoList
========

[![Maintainability](https://api.codeclimate.com/v1/badges/654ca99a95400781902d/maintainability)](https://codeclimate.com/github/CrabThug/todo-and-co/maintainability)

Base du projet #8 : Améliorez un projet existant

https://openclassrooms.com/projects/ameliorer-un-projet-existant-1


###### INSTALLATION

`git clone`

modifier le fichier .env (passer en dev si fixtures)
* bdd
* environnement ( prod | dev )

recuperer les dependences

`composer install --no-dev --optimize-autoloader --classmap-authoritative`

creer la base de donnée

`bin/console d:d:c`

creer les tables

`bin/console d:s:u -f`

(optionnel) installer les fixtures

`bin/console d:f:l -n`

identifiant : admin

mot de passe : password

#

lancer l'application !

`symfony server:start`
