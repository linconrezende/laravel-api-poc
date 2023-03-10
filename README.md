## TO-DO:
```diff
+ API using Laravel
- Dockerise everything including database
(it doesn't make sense to do that because it will work with any database you choose, instead,
I provided a example of docker contianer to run Laravel 9)
+ Persist everything on PostgreSQL or MySQL
(.env defined - Everything is compatible with SQLite, MySQL and PostgreSQL)
+ Create routes as defined bellow:
- POST v1/auth/token 
insted I created (both return a bearer token to be used later on):
+ POST api/v1/register
+ POST api/v1/login

- GET v1/livros (?titulo=&titulo_do_indice=)
Insted I created
+ GET v1/books (?title=&index_title=) with pagination

! POST v1/livros/{livroId}/importar-indices-xml
! Create a job to import xml
Not implemented yet

Routes and result body must be as described
! (they are not, because I decided to do everything in english and use pagination)
- Unit tests
- Factory
+ Publish on GitHub

- POST v1/livros
Insted I created
+ POST v1/books
```
body example: 
```json
{
    "title": "Book title 226",
    "page": 1,
    "indices": [
        {
            "title": "Indice 1",
            "page": 2,
            "sub_indices": [
                {
                    "title": "Indice 1.1",
                    "page": 3,
                    "sub_indices": [
                        {
                            "title": "Indice 1.1.1",
                            "page": 4
                        },
                        {
                            "title": "Indice 1.1.2",
                            "page": 5
                        },
                        {
                            "title": "Indice 1.1.3",
                            "page": 6,
                            "sub_indices": [
                                {
                                    "title": "Indice 1.1.3.1",
                                    "page": 7
                                },
                                {
                                    "title": "Indice 1.1.3.2",
                                    "page": 5
                                },
                                {
                                    "title": "Indice 1.1.3.3",
                                    "page": 9,
                                    "sub_indices": [
                                        {
                                            "title": "Indice 1.1.3.3.1",
                                            "page": 7,
                                            "sub_indices": [
                                                {
                                                    "title": "Indice 1.1.3.3.1.1",
                                                    "page": 7,
                                                    "sub_indices": [
                                                        {
                                                            "title": "Indice 1.1.3.3.1.1.1",
                                                            "page": 7
                                                        }
                                                    ]
                                                }
                                            ]
                                        }
                                    ]
                                }
                            ]
                        }
                    ]
                }
            ]
        }
    ]
}
```


------------

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
