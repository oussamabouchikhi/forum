# Forum
Forum website made using Laravel 7

## Tools & Languages
- [tailwindcss](https://github.com/laravel-frontend-presets/tailwindcss) as css lybrary instead of Bootstrap
- [VueJs](https://vuejs.org/v2/guide/) the javascript framework choosed for the frontend
- [Vuex](https://vuex.vuejs.org/) & [Vue Router](https://router.vuejs.org/) for making the project a Single Page Application (SPA)
- [jwt-auth](https://github.com/tymondesigns/jwt-auth) Authentication system
- [VSCode](https://code.visualstudio.com/) as a text editor

## Usage

Create a database named ```forum``` or name it as you like but don't forget to edit it in ```.env``` file ```DB_DATABASE=your_database_name```

```.env``` 
>__notes:__ 
>1. You need first to create github & facebook applications to get  these info
>2. Facebook callback url must be https when you configure your app
```
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_CALLBACK=http://localhost:8000/login/github/callback

FACEBOOK_APP_ID=your_facebook_app_id
FACEBOOK_APP_SECRET=your_facebook_app_secret
FACEBOOK_CALLBACK=http://localhost:8000/login/facebook/callback
```
```config/services.php```
```
'github' => [
    'client_id' => env('GITHUB_CLIENT_ID'),
    'client_secret' => env('GITHUB_CLIENT_SECRET'),
    'redirect' => env('GITHUB_CALLBACK'),
],

'facebook' => [
    'client_id' => env('FACEBOOK_APP_ID'),
    'client_secret' => env('FACEBOOK_APP_SECRET'),
    'redirect' => env('FACEBOOK_CALLBACK'),
]
```

## Contributing
Pull requests are welcome, feel free to ```fork``` this repo.

## License
This project is open sourced unde the [MIT](https://opensource.org/licenses/MIT) license.
