# EduCity Sports Complex

### Application Information
Application environments and information are as follow:

| Name  | Info  |
| ------------- | ------------- |
| PHP  | v7.4.0   |
| DBMS  | PostgreSQL v12.1  |
| Composer  | v1.9.1  |
| Laravel  | v5.8.35  |

### Installation
Edit the **.htaccess** inside public folder if you are using **Apache** and enabled rewrite_mod. Consider using the original Laravel **.htaccess** if your are using **NGINX**.

After every changes in the **.env** file, please run the following command.

```sh
$ php artisan cache:clear
$ php artisan view:clear
$ php artisan config:clear
$ php artisan config:cache
```

### TODO List

- ~~Validation of each form.~~
- ~~Mark on calendar based on duration.~~
- ~~Application for activities.~~
- ~~Admin Registration.~~
- Editing.
- Application for renting for days.
- Transactions history.
- Transactions reporting.
- Trasactions types (M, AC, AS).
- Transactions graph.
- ~~Price Type (1 = Normal, 2 = Students, 3 = Underage).~~
- ~~QR Code.~~
- Print page after payment submitted.
- List for discounts.
- List for taxes.