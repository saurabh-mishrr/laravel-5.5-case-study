# laravel-5.5-case-study
This repository is based on Laravel 5.5, I have covered CRUD operation in this repository, also IoC, Service provider, Facades have been used in this.

## Prerequisite

Scotch Box 3.5 (Ref: https://box.scotch.io)
Vagrant 2.1.5
Laravel 5.5
PHP7.1
MySQL

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


Note: Used Scotch Box comes with PHP7.0, but we need PHP7.1 for our project, so follow below steps to install PHP7.1.

