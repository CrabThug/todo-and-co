ToDoList
========

[![Maintainability](https://api.codeclimate.com/v1/badges/654ca99a95400781902d/maintainability)](https://codeclimate.com/github/CrabThug/todo-and-co/maintainability)

Base du projet #8 : Améliorez un projet existant

https://openclassrooms.com/projects/ameliorer-un-projet-existant-1

----

[Audit de Qualité et de Performance](https://github.com/CrabThug/todo-and-co/blob/master/docs/Audit_de_qualit%C3%A9_et_de_performance.pdf)

[Rapport de securité](https://github.com/CrabThug/todo-and-co/blob/master/docs/Rapport_de_securit%C3%A9_symfony_4.4.3.pdf)

[Contributing.md](https://github.com/CrabThug/todo-and-co/blob/master/Contributing.md#contributing)


###### INSTALLATION

`git clone https://github.com/CrabThug/todo-and-co.git`

modifier la base de donnée dans le fichier .env (passer en dev si fixtures)

recuperer les dependences

`composer install --no-dev --optimize-autoloader --classmap-authoritative`

creer la base de donnée

`bin/console d:d:c`

creer les tables

`bin/console d:s:u -f`

#

(optionnel) installer les fixtures

`bin/console d:f:l -n`

identifiant : admin

mot de passe : password

#

lancer l'application !

`symfony server:start`
