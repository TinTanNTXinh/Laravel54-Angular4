# Laravel 5.4 & Angular 4
============================
## Require

### NodeJS >= 6.9.5
### NPM >= 4.1.2
### @angular/cli
### typescript (optional)
### typings (optional)
### rxjs (optional)
### ember-cli (optional)
### grunt-cli (optional)
### gulp (optional)
### webpack (optional)

-----------------------------------
## Official Documentation

### 1. config .env
### 2. create database
### 3. composer install
### 4. cd public/dev: npm install
### 5. cd public/dev/src: typings install (optional)
### 6. cd public/dev: npm run dev
### 7. php artisan serve
### 8. Access: http://localhost:8000
### 9. Build prod: npm run prod (optional)
### 10. Build prod: npm run go (optional) (to run outside on 0.0.0.0:4200)

### cd public/dev: bower install (optional)
-----------------------------------
## Insert Location to DB

### METHOD 1:
### mysql -u root -p
### use vsys;
### source /home/xinhnguyen/Documents/GitHub/TinTanSoft_VSYS/documents/Cities.sql;
### source /home/xinhnguyen/Documents/GitHub/TinTanSoft_VSYS/documents/Districts.sql;
### source /home/xinhnguyen/Documents/GitHub/TinTanSoft_VSYS/documents/Wards.sql;

### METHOD 2:
### mysql -u root -p vsys < documents/Cities.sql
### mysql -u root -p vsys < documents/Districts.sql
### mysql -u root -p vsys < documents/Wards.sql
-----------------------------------
## Tutorial Angular

### Create component:            ng g c components/component-name
### Create component (plain):    ng g c components/component-name -is --spec false
### Create service:              ng g s services/service-name-folder/service-name
### Build to dev:                ng build --bh /home/ -op ../home -w
### Buid to prod:                ng build --bh /home/ -op ../home -prod -e=prod
### Buid to prod (full):         ng build --base-href /home/ --output-path ../home --target=production --environment=prod
### Run outside Angular:         ng serve --host 0.0.0.0
### Run outside Laravel:         php artisan serve --host=0.0.0.0 --port=8000

Contact with me via [Facebook](http://facebook.com/nguyentrucxjnh), [Skype](ntxinh.tintansoft), [Gmail](ntxinh@tintansoft.com).
-----------------------------------
## Developer


-----------------------------------
## License

License belong to TinTanSoft Company.
