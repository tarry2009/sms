# sms
secretManagmentSystem

## Setup (laravel 5.8)

1.  Firstly, setup wamp, lamp or xampp to your machine and run it
2.  create database `sms` in mysql  
3.  Download [composer](https://getcomposer.org/download/) if they are not already on your machine.
4.  Rename `.env.example` file to .env inside your-project-root/sms and fill the database information (windows wont let you do it, so you have to open `.env.example` into editor and save as `.env` in same directory ).
4.  Open the console and `cd server-path/your-download-project/sms` directory ex `C:\xampp\htdocs\sms`
5.  Run `composer install`
6.  Run `php artisan key:generate` 
7.  Run `php artisan config:clear`
8.  Run `php artisan config:cache`
9.  Run `php artisan migrate` 

## It is mixture of Laravel Forms for Web and APIs

## User Register API:  
```
API_URL: http://localhost/sms/api/register
METHOD: POST
REQUEST_TYPE: JSON
PARAMS: 
{
"username":"test",
"public_key":"hBaoyfbrizHLRG_kr_ZezNdZMvrvfqQasjjutldKZM5yVYQBVO1x3NNrF41O6gFOffquwoNuiV_rka5mo8mt6DKhft2UWuobxqfz9swy7YSe8NLG9JekNzxyK_3mNx5abA9dBZcObbTrBPVYf5ThbrX6cS-2x_S4CePjX4rxMaV9dInpojq0EXOVytay1CVh78cqKAMnOvr5CJdcDQo3cN4CKUQ_cLtIgSJh9gUOH" 
}

SAMPLE_RESPONSE_DATA: 
{
    "data": {
        "username": "test",
        "public_key": "hBaoyfbrizHLRG_kr_ZezNdZMvrvfqQasjjutldKZM5yVYQBVO1x3NNrF41O6gFOffquwoNuiV_rka5mo8mt6DKhft2UWuobxqfz9swy7YSe8NLG9JekNzxyK_3mNx5abA9dBZcObbTrBPVYf5ThbrX6cS-2x_S4CePjX4rxMaV9dInpojq0EXOVytay1CVh78cqKAMnOvr5CJdcDQo3cN4CKUQ_cLtIgSJh9gUOH",
        "access_id": 2,
        "server_key": "4adb0642b8787aa7e212b495662d24348d56544524d77170d083581d5361a9113ca3f928091d6b3832e3ed80e1a9c17336ba604ab7d591e88c6a90800d26c6cb0f8c6641735abb69573e1c8c0cffc4798e78f4e0762089ba"
    },
    "status": 200
}
```

## Get ServerKey:  
```
API_URL: http://localhost/sms/api/getServerKey
METHOD: GET  
SAMPLE_RESPONSE_DATA: 
{
    "data": "4adb0642b8787aa7e212b495662d24348d56544524d77170d083581d5361a9113ca3f928091d6b3832e3ed80e1a9c17336ba604ab7d591e88c6a90800d26c6cb0f8c6641735abb69573e1c8c0cffc4798e78f4e0762089ba",
    "status": 200
}
 ```

## storeSecret API

 ```
 API_URL:  http://localhost/sms/api/storeSecret
METHOD: POST
REQUEST_TYPE: JSON
PARAMS: 
{
"username":"test",
"secretName":"myTestSecret",
"encryptedSecret":"eyJpdiI6ImZucm5pdTlud0VLSG5RcFVZTG1XSGc9PSIsInZhbHVlIjoiTUNRNDZMdTkzOWJ3b2lqa1REaGNWMW9jR0dNSnFZQ0czM0s2VWdLbFNnM0d5dGhhQ1dsNWw0ZzJzWFl3MGNKMiIsIm1hYyI6Ijk4MTVmYzNkYTk0YjBlNTMwZWFiYTNjMWU4M2MzMDY5ZGVmZWE4NWNmMWVmODRhMDljNjBlNTUyMWM4NzVmNTUifQ==",
"server_key":"4adb0642b8787aa7e212b495662d24348d56544524d77170d083581d5361a9113ca3f928091d6b3832e3ed80e1a9c17336ba604ab7d591e88c6a90800d26c6cb0f8c6641735abb69573e1c8c0cffc4798e78f4e0762089ba" 
}

SAMPLE_RESPONSE_DATA: 
{
    "data": "OK",
    "status": 200
}
```


## getSecret API

 ```
 API_URL:  http://localhost/sms/api/getSecret
METHOD: POST
REQUEST_TYPE: JSON
PARAMS: 
{
"username":"test",
"secretName":"myTestSecret", 
"server_key":"4adb0642b8787aa7e212b495662d24348d56544524d77170d083581d5361a9113ca3f928091d6b3832e3ed80e1a9c17336ba604ab7d591e88c6a90800d26c6cb0f8c6641735abb69573e1c8c0cffc4798e78f4e0762089ba" 
}

SAMPLE_RESPONSE_DATA: 
{
    "data": {
        "access_id": 2,
        "secret_name": "myTestSecret",
        "encrypted_secret": "eyJpdiI6ImZucm5pdTlud0VLSG5RcFVZTG1XSGc9PSIsInZhbHVlIjoiTUNRNDZMdTkzOWJ3b2lqa1REaGNWMW9jR0dNSnFZQ0czM0s2VWdLbFNnM0d5dGhhQ1dsNWw0ZzJzWFl3MGNKMiIsIm1hYyI6Ijk4MTVmYzNkYTk0YjBlNTMwZWFiYTNjMWU4M2MzMDY5ZGVmZWE4NWNmMWVmODRhMDljNjBlNTUyMWM4NzVmNTUifQ=="
    },
    "status": 200
}
```



## getEncripted API for encript something

 ```
 API_URL:  http://localhost/sms/api/getSecret
METHOD: POST
REQUEST_TYPE: JSON
PARAMS: 
{ 
"private_key":"myTestSecret",
"secret":"myTestSecret",
"server_key":"4adb0642b8787aa7e212b495662d24348d56544524d77170d083581d5361a9113ca3f928091d6b3832e3ed80e1a9c17336ba604ab7d591e88c6a90800d26c6cb0f8c6641735abb69573e1c8c0cffc4798e78f4e0762089ba" 
}

SAMPLE_RESPONSE_DATA: 
{
    "data": "eyJpdiI6ImZucm5pdTlud0VLSG5RcFVZTG1XSGc9PSIsInZhbHVlIjoiTUNRNDZMdTkzOWJ3b2lqa1REaGNWMW9jR0dNSnFZQ0czM0s2VWdLbFNnM0d5dGhhQ1dsNWw0ZzJzWFl3MGNKMiIsIm1hYyI6Ijk4MTVmYzNkYTk0YjBlNTMwZWFiYTNjMWU4M2MzMDY5ZGVmZWE4NWNmMWVmODRhMDljNjBlNTUyMWM4NzVmNTUifQ==",
    "status": 200
}
```


## getDecrypt API for Decrypt something

 ```
 API_URL:  http://localhost/sms/api/getDecrypt
METHOD: POST
REQUEST_TYPE: JSON
PARAMS: 
{  
"encrypted_secret":"eyJpdiI6ImZucm5pdTlud0VLSG5RcFVZTG1XSGc9PSIsInZhbHVlIjoiTUNRNDZMdTkzOWJ3b2lqa1REaGNWMW9jR0dNSnFZQ0czM0s2VWdLbFNnM0d5dGhhQ1dsNWw0ZzJzWFl3MGNKMiIsIm1hYyI6Ijk4MTVmYzNkYTk0YjBlNTMwZWFiYTNjMWU4M2MzMDY5ZGVmZWE4NWNmMWVmODRhMDljNjBlNTUyMWM4NzVmNTUifQ==",
"server_key":"4adb0642b8787aa7e212b495662d24348d56544524d77170d083581d5361a9113ca3f928091d6b3832e3ed80e1a9c17336ba604ab7d591e88c6a90800d26c6cb0f8c6641735abb69573e1c8c0cffc4798e78f4e0762089ba" 
}

SAMPLE_RESPONSE_DATA: 
{
    "data": "myTestSecret",
    "status": 200
}
```


<p align="center"><img src="https://laravel.com/assets/img/components/logo-laravel.svg"></p>
 
<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1400 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[British Software Development](https://www.britishsoftware.co)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- [UserInsights](https://userinsights.com)
- [Fragrantica](https://www.fragrantica.com)
- [SOFTonSOFA](https://softonsofa.com/)
- [User10](https://user10.com)
- [Soumettre.fr](https://soumettre.fr/)
- [CodeBrisk](https://codebrisk.com)
- [1Forge](https://1forge.com)
- [TECPRESSO](https://tecpresso.co.jp/)
- [Runtime Converter](http://runtimeconverter.com/)
- [WebL'Agence](https://weblagence.com/)
- [Invoice Ninja](https://www.invoiceninja.com)
- [iMi digital](https://www.imi-digital.de/)
- [Earthlink](https://www.earthlink.ro/)
- [Steadfast Collective](https://steadfastcollective.com/)
- [We Are The Robots Inc.](https://watr.mx/)
- [Understand.io](https://www.understand.io/)
- [Abdel Elrafa](https://abdelelrafa.com)
- [Hyper Host](https://hyper.host)

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

