# ProjetWeb
The goal of this project is to create a fullstack website that allows users to put their houses online for renting, make a reservation (to rent a house) and see the houses that are already posted on the website (users can search by filters depending on their needs).
# Contributors
Yasmine Thabet

Manef Ben Mansour

Ahmed Rezgui

Rabeb Naassaoui

Aziz Ben Dhiab
# Setup
In the root directory of the project, run :
composer install 

if the installation failed due to fzaninotto faker version that requires a lower php version, you should run :

composer require fzaninotto/faker:1.8.0 --ignore-platform-reqs

When the installation is complete you should run :

composer require symfonycasts/verify-email-bundle

Database creation (Don't forget to start apache/mysql before running these, otherwise no connection will be established) :
If you have an existing database, change the connection URL in the .env file, if you don't, run :

symfony console doctrine:database:create

php bin/console doctrine:migrations:migrate

These 2 commands should create a database with all the required fields.
To add values in the database, run :

symfony console doctrine:fixtures:load --group=Userfixtures --append

symfony console doctrine:fixtures:load --group=LogementFixtures --append

symfony console doctrine:fixtures:load --group=ImagesLogementFixtures --append

symfony console doctrine:fixtures:load --group=CommentaireFixtures --append

symfony console doctrine:fixtures:load --group=ReservationFixtures --append

You should now have a working version of our website. 

Run symfony serve to see it 

