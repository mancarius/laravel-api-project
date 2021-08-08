<!--
*** Thanks for checking out the Best-README-Template. If you have a suggestion
*** that would make this better, please fork the repo and create a pull request
*** or simply open an issue with the tag "enhancement".
*** Thanks again! Now go create something AMAZING! :D
***
***
***
*** To avoid retyping too much info. Do a search and replace for the following:
*** mancarius, laravel-waste-sorting-api, twitter_handle, email, Waste Sorting API, This application allows you to keep track of the days of the week in which separate collection takes place.
-->



<!-- PROJECT SHIELDS -->
<!--
*** I'm using markdown "reference style" links for readability.
*** Reference links are enclosed in brackets [ ] instead of parentheses ( ).
*** See the bottom of this document for the declaration of the reference variables
*** for contributors-url, forks-url, etc. This is an optional, concise syntax you may use.
*** https://www.markdownguide.org/basic-syntax/#reference-style-links
-->
<img alt="GitHub top language" src="https://img.shields.io/github/languages/top/mancarius/laravel-waste-sorting-api?style=for-the-badge">
<img alt="GitHub code size in bytes" src="https://img.shields.io/github/languages/code-size/mancarius/laravel-waste-sorting-api?style=for-the-badge">

<br><br>

<!-- PROJECT LOGO -->
<br />
<p align="center">
  <h1 align="center">Waste Sorting API</h1>

  <p align="center">
    This application allows you to keep track of the days of the week in which separate collection takes place.
    <br />
    <a href="https://github.com/mancarius/laravel-waste-sorting-api"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/mancarius/laravel-waste-sorting-api/issues">Report Bug</a>
    ·
    <a href="https://github.com/mancarius/laravel-waste-sorting-api/issues">Request Feature</a>
  </p>
</p>



<!-- TABLE OF CONTENTS -->
<details open="open">
  <summary><h2 style="display: inline-block">Table of Contents</h2></summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li>
      <a href="#usage">Usage</a>
      <ul>
        <li><a href="#get-weekly-summary">Get weekly summary</a></li>
        <li><a href="#get-daily-summary">Get daily summary</a></li>
        <li><a href="#get-wasters-summary">Get wastes summary</a></li>
        <li><a href="#add-new-pick-up">Add new pick-up</a></li>
        <li><a href="#edit-pick-up-interval">Edit pick-up interval</a></li>
        <li><a href="#remove-pick-up">Remove pick-up</a></li>
      </ul>
    </li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#contributing">Contributing</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgements">Acknowledgements</a></li>
  </ol>
</details>

<br>
<br>

<!-- ABOUT THE PROJECT -->
## About The Project


This is a laravel case study for [Start2Impact](http://start2impact.it). I have build a json REST API that allow to:
* get the weekly summary of collection days
* get the daily summary of the pick-up times
* get the days and times of withdrawal of a single waste
* add, edit and delete a pickup within a day of the week


### Built With

* [Laravel](https://laravel.com)
* [MySql](https://mysql.com)


<!-- GETTING STARTED -->
## Getting Started

To get a local copy up and running follow these simple steps.

### Prerequisites

You need Composer. [See how to install Composer](https://getcomposer.org/doc/00-intro.md)

### Installation

1. Clone the repo
   ```sh
   git clone https://github.com/mancarius/laravel-waste-sorting-api.git
   ```
2. Install Composer packages
   ```sh
   composer install
   ```
3. Create a copy of your `.env` file

4. Create an empty database using any database tools you prefer

5. Configure your `.env` file to allow a connection to the database.
    In the `.env` file, fill in the options _DB_HOST_, _DB_PORT_, _DB_DATABASE_, _DB_USERNAME_ and _DB_PASSWORD_ so that they match the credentials of the database you have just created.

6. Add the tables and contents of your database with migrations
   ```sh
   php artisan migrate:fresh --seed
   ```

<!-- USAGE EXAMPLES -->
## Usage

In order to receive the correct responses from the service, be sure to set the header attribute _Access_ to '_application/json_'.

### Get weekly summary

In order to obtain the list of week days, send an HTTP `GET` request to the following URI:
```sh
<yourdomain>/api/day
```
The request don't need any parameter.

If the request succeeds, the server responds with a 200 OK HTTP status code and the days results:
```typescript
200 OK

{
    "days": [
        {
            "id": Number;
            "name": String;
            "wastes": [
                {
                    "id": Number;
                    "name": String;
                    "description": String;
                    "allowed": Array<String>;
                    "not_allowed": Array<String>;
                    "color": String;
                    "pick_up_time_start": String;
                    "pick_up_time_end": String;
                    "pick_up_id": String;
                },
                ...
            ]
        },
        ...
    ]
}
```

If the requesta fails, the server responds with a 400 Bad Request HTTP status code and a list of messages like:
```typescript
400 Bad Request

{
    "message": Array<String>;
}
```

### Get daily summary

In order to obtain the list of pick-ups for a specific day, send an HTTP `GET` request to the following URI with the name of the day:
```sh
<yourdomain>/api/day/{day}
```
The request don't need any other parameter.

A real request example:
```sh
<yourdomain>/api/day/monday
```

If the request succeeds, the server responds with a 200 OK HTTP status code and the day results:
```typescript
200 OK

{
    "wastes": [
        {
            "id": Number;
            "name": String;
            "description": String;
            "allowed": Array<String>;
            "not_allowed": Array<String>;
            "color": String;
            "pick_up_time_start": String;
            "pick_up_time_end": String;
            "pick_up_id": String;
        },
        ...
    ]
}
```

If the requesta fails, the server responds with a 400 Bad Request HTTP status code and a list of messages like:
```typescript
400 Bad Request

{
    "message": Array<String>;
}
```

### Get wastes summary

In order to obtain the list of pick-ups for a specific day, send an HTTP `GET` request to the following URI with the name of the day:
```sh
<yourdomain>/api/waste/
```
The request don't need any other parameter.


If the request succeeds, the server responds with a 200 OK HTTP status code and the wastes results with the relative pickup days:
```typescript
200 OK

{
    "wastes": [
        {
            "id": Number;
            "name": String;
            "description": String;
            "allowed": Array<String>;
            "not_allowed": Array<String>;
            "color": String;
            "days": [
                {
                    "id": Number,
                    "name": String,
                    "pick_up_time_start": String,
                    "pick_up_time_end": String,
                    "pick_up_id": String
                },
                ...
            ]
        },
        ...
    ]
}
```

If the requesta fails, the server responds with a 400 Bad Request HTTP status code and a list of messages like:
```typescript
400 Bad Request

{
    "message": Array<String>;
}
```

### Add new pick-up

To add a new pick-up in a specific day, send an HTTP `POST` request to the following URI with the following format:
```sh
<yourdomain>/api/pick-up
```
The request has the following required query parameters:
* `day` - the ID of the day to enter the pick-up
* `waste` - the ID of the waste to pick-up
* `timeStart` - the start of the pick-up interval with format `H:i:s`
* `timeEnd` - the end of the pick-up interval with format `H:i:s`


If the request succeeds, the server responds with a 200 OK HTTP status code and the wastes results with the relative pickup days:
```typescript
201 OK

{
    "pick-up": {
        "id": String;
    }
}
```

If the requesta fails, the server responds with a 400 Bad Request HTTP status code and a list of messages like:
```typescript
400 Bad Request

{
    "message": Array<String>;
}
```

### Edit pick-up interval

To change a time interval of a specific pick up, send an HTTP `PATCH` request to the following URI with the following format:
```sh
<yourdomain>/api/pick-up/{id}
```
The request require at least one of the following query parameters:
* `timeStart` - the start of the pick-up interval with format `H:i:s`
* `timeEnd` - the end of the pick-up interval with format `H:i:s`


If the request succeeds, the server responds with a 204 No Content HTTP status code :
```typescript
204 No Content
```

If the requesta fails, the server responds with a 400 Bad Request HTTP status code and a list of messages like:
```typescript
400 Bad Request

{
    "message": Array<String>;
}
```

### Remove pick-up

To remove a pick up from a day, send an HTTP `DELETE` request to the following URI with the following format:
```sh
<yourdomain>/api/pick-up/{id}
```
The request don't need any parameter.

If the request succeeds, the server responds with a 204 No Content HTTP status code :
```typescript
204 No Content
```

If the requesta fails, the server responds with a 400 Bad Request HTTP status code and a list of messages like:
```typescript
400 Bad Request

{
    "message": Array<String>;
}
```
<!-- ROADMAP -->
## Roadmap

See the [open issues](https://github.com/mancarius/laravel-waste-sorting-api/issues) for a list of proposed features (and known issues).



<!-- CONTRIBUTING -->
## Contributing

Contributions are what make the open source community such an amazing place to be learn, inspire, and create. Any contributions you make are **greatly appreciated**.

1. Fork the Project
2. Create your Feature Branch (`git checkout -b feature/AmazingFeature`)
3. Commit your Changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the Branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request



<!-- LICENSE -->
## License

Distributed under the MIT License. See `LICENSE` for more information.



<!-- CONTACT -->
## Contact

Mattia Mancarella - hello@mattiamancarella.com

Project Link: [https://github.com/mancarius/laravel-waste-sorting-api](https://github.com/mancarius/laravel-waste-sorting-api)





<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->
[contributors-shield]: https://img.shields.io/github/contributors/mancarius/repo.svg?style=for-the-badge
[contributors-url]: https://github.com/mancarius/repo/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/mancarius/repo.svg?style=for-the-badge
[forks-url]: https://github.com/mancarius/repo/network/members
[stars-shield]: https://img.shields.io/github/stars/mancarius/repo.svg?style=for-the-badge
[stars-url]: https://github.com/mancarius/repo/stargazers
[issues-shield]: https://img.shields.io/github/issues/mancarius/repo.svg?style=for-the-badge
[issues-url]: https://github.com/mancarius/repo/issues
[license-shield]: https://img.shields.io/github/license/mancarius/repo.svg?style=for-the-badge
[license-url]: https://github.com/mancarius/repo/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/mancarius
