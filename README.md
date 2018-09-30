# laravel-5.5-case-study
This repository is based on Laravel 5.5, I have covered CRUD operation in this repository, also IoC, Service provider, Facades have been used in this.

## Prerequisite/ What I've used

Ubuntu (18.04) <br/>
Scotch Box 3.5 (Ref: https://box.scotch.io) <br/>
Vagrant 2.1.5 <br/>
Laravel 5.5 <br/>
PHP7.1 <br/>
MySQL <br/>
Composer <br/>
Git <br/>

## Case study

    • Create a route /submit-cv
    • Fields
        ◦ Name (Textfield, mandatory) 
        ◦ Company (Textfield, mandatory)
        ◦ Email  (Textfield, mandatory, email validation)
        ◦ Qualification (Graduate/Post graduate)
        ◦ Hobbies  (Textfield, mandatory) + Give add more button
        ◦ Resume (upload file, allowed extension: doc,docx,pdf, filesize: less than 5MB)
    • If any of these values are left blank – Put server side validation 
    • On successful submission redirect to below route
    • /manage-cv
    • Design

	+-----------------------------------------------------------------------------------------------+
	|  Name   |  Company  |  Email            |  Qualification   |    Hobbies    |    Action        |
	-------------------------------------------------------------------------------------------------
	|   A     |    A      |  a@a.com          |  Graduate        |   A           |    Edit|Delete   |
	|         |           |                   |                  |   B           |                  |  
	|         |           |                   |                  |   C           |                  |  
	|         |           |                   |                  |   If multiple |                  |
	|         |           |                   |                  |   hobbies are |                  |
	|         |           |                   |                  |   added add   |                  |
	|         |           |                   |                  |   in each row.|                  |    
	+-----------------------------------------------------------------------------------------------+

    • If click on edit button create a route /manage-cv/cvid?/edit
    • If click on delete button create a route /manage-cv/cvid?/delete


	Keep following things in mind while designing it:
	    1) Records to be sorted by name asc.
	    2) Use Facade design pattern.
	    3) Use IOC container.
	Bonus point:
	    4) Use vagrant (scotch box) to install the Laravel.
	Learning material
	    1) https://laracasts.com/series/laravel-5-fundamentals


## Steps to be followed for installation (Perform in terminal)
	
	• Install Vagrant

		sudo apt-get install vagrant

	• Install Laravel 5.5 via composer

		cd /var/www/html/
		composer create-project --prefer-dist laravel/laravel job-portal "5.5.*"

	• Install Scotch Box

		git clone https://github.com/scotch-io/scotch-box job-portal
		cd job-portal
		vagrant up  (It will take bit time to install virtual setup in your current directory)

	(Note: Used Scotch Box comes with PHP7.0, but we need PHP7.1 for our project, so follow below steps to install PHP7.1.)

	• Install PHP7.1

		vagrant ssh
		sudo apt-get purge php7.0
		sudo a2dismod php7.0
		sudo apt-get install software-properties-common
		sudo add-apt-repository ppa:ondrej/php
		sudo apt-get update
		sudo apt-get install php7.1 php7.1-*
		sudo a2enmod php7.1
		sudo service apache2 restart


## Steps to be followed for Project start

	(Make sure you are still in Scotch box's ssh window, if not go to directory where you have installed laravel and type `vagrant ssh` you should see """vagrant@scotchbox:~$""" something like this.)
	
	• Config changes

		1) cd /var/www   (You should see your laravel project here.)
		2) Create database in MySQL (Scotch box comes with default database ie. scotchbox, you are free to use this else you can create your own.)
			mysql -u root -proot -e 'create database job_portal'
		3) Database connection changes in .env file.

	• Generate migration file

		1) php artisan make:migration create_candidates_table
		2) file will be generated under /var/www/job-portal/database/
		3) You can copy content of this repository's file
		4) php artisan migrate  (this command will create tables in database)
		5) php artisan make:model Candidate (this command will generate model under /var/www/job-portal/app)
		6) php artisan make:controller CandidatesController (this command will generate controller under /var/www/job-portal/app/Http).
		7) For views create folder under /var/www/job-portal/resources called `candidates`.
		8) Copy all view files from this repository to your view directory. 

	(CRUD operations have been written in CandidatesController.php, Candidate.php and views, but operations cannot be done without help of routes, so for that copy the content of /var/www/job-portal/routes/web.php into your web.php file.)