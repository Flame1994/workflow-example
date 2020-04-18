## Laravel Workflow Example
[![Software License][ico-license]](LICENSE)

### Description
This is an example project of how to use the [rhaarhoff/workflow](https://github.com/Flame1994/workflow) package. You can read
more about how the package works over there. Here I will explain how we used the package to create
a functioning project.

### Installation

Simply clone the project

```bash
git clone https://github.com/Flame1994/workflow-example.git
```

Copy the `.env.example` and make sure to enter a valid database, name and password.

```bash
cp .env.example .env
```

Make sure to run the key generator

```bash
php artisan key:generate
```

Run composer install and dump autoload
```bash
composer install && composer dump-autoload
```

Run migration and seeders
```bash
php artisan migrate --seed
```

Run the workflow generator
```bash
php artisan workflow:generate
```

You should now have a working project. You can use `postman` to query the api endpoints. Simply import 
the following link into your postman and setup your own environment:
```
https://www.getpostman.com/collections/f9b1cbcc3e4ab53f1f64
```

### How it Works
This project consists of Companies, each having multiple clients. For each of them there are CRUDL endpoints as seen in the `routes/api.php` file.

Every endpoint links to a function within a `Controller`. This is where it gets interesting. Instead of the normal way
Laravel is being used, by either doing logic within the Controller, a Service, or a Repository, this package helps us split the functionality into more readible
chunks of code by using `Workflows`.

The workflows can be found in the `app/Workflows` folder. Each workflow folder has a `Code`, `Definition` and `Generated`
folder.

The `Definition` folder contains all the definition files that specify how the workflow should function. Read more on this on the packages github page.

The `Generated` folder contains all the `Base` classes of the workflows. These are auto generated when running the following command: 
```bash
php artisan workflow:generate
```
When running the command above, a `Workflows/Common/Workflow.php` file will be generated as well. This class is the parent class
of all Workflows. If you have a decent understanding of the workflows you can even edit this to your liking.

**Note: There is no need to add the base classes and Workflow.php to the repository if you can setup some devops to auto run the command to generate them**

The `Code` folder contains all the workflow classes where the business logic is being written.

You can see that every `companies` endpoint links to a function within the `CompanyController`. From there, every function starts its own
Workflow. For example, the `CompanyController@create` function starts the `WorkflowCompanyCreate` workflow and passes all required parameters as 
specified in its definition file.

Using this structure we can easily see how the business logic flow of each endpoint is being used. The Controller is only being used to take input and give output.
The Workflows are being used to actually do the business logic. There are a lot of better ways to handle and parse the input & ouput. I just wanted to show a
very basic version of what the workflows can do. I did not put much effort into the input, output and exception throwing.

Let's take a look at a workflow. Visit the `Workflows/Company/Code/WorkflowCompanyCreate.php` class.

You will see that there is an `execute` function. This is used when calling the workflow from another place in your project. You can see that
we call this function from the `CompanyController@create` function, like this:
```php
$company = WorkflowCompanyCreate::execute(
    $request->get('name'),
    $request->get('email'),
    $request->get('founded')
);
```
Which passes all the required parameters in order to create the company.

You can also see that every function within this workflow is defined in the corresponding definition file `Workflows/Company/Definition/CompanyCreate.json`. Make sure you understand how
the definition files work before using this, since they are the backbone of everything.

If you make changes to a definition file, make sure to run the generate command:
```bash
php artisan workflow:generate
```
since it will update the base classes. In turn, you will need to update the classes extending the base classes that were updated.

### License

The Laravel Workflow generator is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square