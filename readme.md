# Book OC Project

An OOP PHP blog CMS. Build with MVC. This project was done as part of a training ([OpenClassrooms](https://openclassrooms.com/)).

**Instructions to follow**:
A writer wants to have his own blog to publish his next novel in stages. Only concern: he does not want to use WordPress, he wants his own home blog!
You will develop in PHP without using a framework to familiarize yourself with the basic concepts of programming. The code will be built on an MVC architecture. You will develop as much as possible in object oriented (at least, the model must be constructed as an object).

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

To install and to run the project you will need this:

```
PHP 7+
MySQL 5.6+
Node.js & npm (are needed because we use Gulp for compliling SCSS files and for using Browsersync)
Grunt (is needed because Bootstrap.v4 use it for compiling SCSS files)
```

When the project is installed and running, use the **admin demo account** by following this steps:
* Go to `your-domain.com/se-connecter`. Type it or use `ctrl + shift + l`.
* Sign-in using `demo@demo.com` as email, and `demo` as password.

*Note: Everywhere in the website, use `ctrl + shift + h` to go to your domain root.*

#### reCAPTCHA

The project use reCAPTCHA from Google to prevent comments spams and abuses. To get it work you will need to create a Google reCAPTCHA API key:
* Go to [reCAPTCHA](https://www.google.com/recaptcha/) website
* On the top right, click `Get reCAPTCHA` button
* Follow the steps to get your API key
* Paste you secret key into `/app/config/apis.json` and you are done.

### Installing

The first step is to download the whole project zip and unizp it in your computer.

Then, make sure you have last npm version and install all dependencies that are listed in package.json, by following this steps:

```
// In your terminal
cd project-folder
npm install
```

Now, you need to **configure a database** :
* Install the database structure using `/app/databases/main.sql`. A demo user is already there.
* Configure your database config file `/app/config/databases.json`. (Please keep `main` key unchanged)

You are done.

#### DO NOT FORGET

Do not forget to gitignore `/app/config/apis.json` and `/app/config/databases.json`. Otherwise you will push all of your secret configs.

## Deployment

To compile SCSS changes of `/web/assets/scss/` execute this:

```
cd project-folder
gulp
```

To compile SCSS changes of bootstrap.v4 execute this:

```
cd project-folder
cd web/vendors/bootstrap
grunt watch
```

## Built With

* [SASS](http://sass-lang.com/) - The most mature, stable, and powerful professional grade CSS extension language in the world.
* [Gulp](https://gulpjs.com/) - A toolkit for automating painful or time-consuming tasks in development workflow.
* [Browsersync](https://browsersync.io/) - A toolkit to get time-saving synchronised browser testing.
* [Bootstrap v4](https://v4-alpha.getbootstrap.com/) - The most popular HTML, CSS, and JS framework

## Contributing

(Not available for now). Please read [CONTRIBUTING.md](#) for details on our code of conduct, and the process for submitting pull requests to us.

## Versioning

We will use [SemVer](http://semver.org/) for versioning.

## Authors

* **Souhail** - *Initial work* - [Souhail_5](https://github.com/Souhail-5)

See also the list of [contributors](https://github.com/Souhail-5/book-oc-project/contributors) who participated in this project.

## License

This project is licensed under the GPL3 License - see the [LICENSE](LICENSE.md) file for details.
