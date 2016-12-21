#MediaPleyber#


##Description##

*MediaPleyber* is a short project designed as a project evaluation for my AFPA trainee.
It is based on a **fictionnal** contract with Pleyber-Christ city (French Britanny) to refresh its library website.

*MediaPleyber* inclues a reservation/loan system giving **_registered user_** to reserver a document which need to be validated by a **_manager_**.
Once validated, media is count as borrowed until **_user_** bring it back and a **_manager_** valid the return.

A reservation can be canceled directly by the **_user_** who made it or by a **_manager_** prior to loan. Please note that **_managers_** can also reserve and loan documents.


Three types of media are currently supported : CDs, books and comics.

*MediaPleyber* also proposes to **_users_**

##Code##

*MediaPleyber* has been designed using PHP framework [Symfony](https://symfony.com/ "Symfony Official Website") on Ubuntu 16.04 and Windows 10.
[DoctrineFixturesBundle](https://symfony.com/doc/master/bundles/DoctrineFixturesBundle/index.html#main) has been used to load test users (i.e. two **_registered users_** and a **_manager_**) and events.

##Installation##

- Clone this project
- get dependencies : composer install
- Create a database and import tables from file "mediapleyber.sql"
- Change database parameters in parameters.yml
