Symfony Test Blog
========================

Prerequisities
--------------
- installed PHP
- installed composer

Instalation
--------------
Run these commands:
- git clone https://github.com/zarubatomas/symfony-blog.git
- composer install (and configure database in app/config/parameters.yml)
- bin/console doctrine:database:create
- bin/console doctrine:migrations:migrate
- bin/console doctrine:fixtures:load
- make writeable /var folder


Informations
--------------
- blog posts list is available on homepage
- admin is available on /admin login: admin@admin.cz password: test1234

Possible improvements
--------------
- count views for same articles only after session expires
- use Widget for printing posts