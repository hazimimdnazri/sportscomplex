# EduCity Sports Complex

### Application Information
Application environments and information are as follow:

| Name  | Info  |
| ------------- | ------------- |
| PHP  | ^7.2.30   |
| DBMS  | MariaDB 10.4.13  |
| Composer  | v1.10.9  |
| Laravel  | v5.8.35  |

### Installation
Edit the **.htaccess** inside public folder if you are using **Apache** and enabled rewrite_mod. Consider using the original Laravel **.htaccess** if your are using **NGINX**.

### Different PHP
Please change the composer.json content with the version that suit your environment.

After every changes in the **.env** file, please run the following command.

```sh
$ php artisan cache:clear
$ php artisan view:clear
$ php artisan config:clear
$ php artisan config:cache
```

### TODO List
