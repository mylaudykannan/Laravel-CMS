## Pull Git Repository
## Run composer install inside project folder
`composer install`
## Configure .env file
## Run migration
`php artisan migrate`
`php artisan migrate --path=app\Modules\Gallery\Database\Migrations`
`php artisan migrate --path=app\Modules\Design\Database\Migrations`
`php artisan migrate --path=app\Modules\Page\Database\Migrations`
`php artisan migrate --path=app\Modules\News\Database\Migrations`
`php artisan migrate --path=app\Modules\Menu\Database\Migrations`
##Publish assets
`php artisan vendor:publish --tag=gallery-assets --force`
`php artisan vendor:publish --tag=menu-assets --force`
##Run AdminAndRoles seeder
`php artisan db:seed --class=AdminAndRoles`
##Run key generate
`php artisan key:generate`
##Register in tinymce 
- https://www.tiny.cloud/
- Get your api key
- open the file resources\views\admin\inc\tinyscript.blade.php and replace library link with your tinymce account library link
`<script src="https://cdn.tiny.cloud/1/ku26yeyqf2gbwbg4gwvouxnov9r9w3eaqgqtbs2fj3gaolmx/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>`
- Add your domain in approved domain. (eg: localhost, website.com)
## *Donate & Help this Channel:*
- UPI: 8438436105@sbi
