To install scotch box 
	
	git clone https://github.com/scotch-io/scotch-box job-portal
	cd job-portal
	vagrant up
	vagrant halt

To install Laravel5.5

	cd /var/www/html/
	composer create-project --prefer-dist laravel/laravel job-portal "5.5.*"

Moved all files under job-portal

To work with Laravel5.5 
	Disable php7.0 using sudo a2dismod php7.0
	Installed php7.1

Started working on project
	vagrant up
	vagrant ssh
	made all possible changes in .env file
	1. Create migration file
		php artisan make:migrate create_candidates_table
