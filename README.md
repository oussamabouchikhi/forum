# Forum
Forum website made using Laravel 7

## Usage
```.env``` 
>__notes:__ 
>1. You need first to create github & facebook applications to get  these info
>2. Facebook callback url must be https
```
GITHUB_CLIENT_ID=your_github_client_id
GITHUB_CLIENT_SECRET=your_github_client_secret
GITHUB_CALLBACK=http://localhost:8000/login/github/callback

FACEBOOK_APP_ID=your_facebook_app_id
FACEBOOK_APP_SECRET=your_facebook_app_secret
FACEBOOK_CALLBACK=https://localhost:8000/login/facebook/callback
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
