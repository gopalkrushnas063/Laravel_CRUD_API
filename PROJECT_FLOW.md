## Step 1: Install Laravel

Make sure you have Laravel installed on your system. If not, you can install it using Composer by running the following command:

`composer global require laravel/installer`


## Step 2: Create a new Laravel project

Open your terminal or command prompt, navigate to the desired directory, and run the following command:

`laravel new employee-api`

This will create a new Laravel project named "employee-api".

## Step 3: Set up the database

Configure your database connection in the .env file located at the root of your Laravel project.

Set the `DB_CONNECTION`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` variables according to your database setup.

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_api
DB_USERNAME=root
DB_PASSWORD=root
```

## Step 4: Generate Employee model and migration

Run the following command to generate the Employee model and migration:

`php artisan make:model Employee --migration`

This will create a new model file Employee.php in the app/Models directory and a migration file in the database/migrations directory.

## Step 5: Define the employee table structure

Open the generated migration file (database/migrations/<timestamp>_create_employees_table.php) and define the table structure.
For example, you can add the following fields to the up method:

```
Schema::create('employees', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->string('phone');
    $table->timestamps();
});
```

## Step 6: Run the migration

Execute the migration command to create the employee table in your database:

`php artisan migrate`

## Step 7: Create routes

Open the routes/api.php file and define the routes for the CRUD operations:


```
use App\Http\Controllers\EmployeeController;

Route::get('employees', [EmployeeController::class, 'index']);
Route::post('employees', [EmployeeController::class, 'store']);
Route::get('employees/{id}', [EmployeeController::class, 'show']);
Route::put('employees/{id}', [EmployeeController::class, 'update']);
Route::delete('employees/{id}', [EmployeeController::class, 'destroy']);
```

## Step 8: Generate EmployeeController

Run the following command to generate the EmployeeController:

`php artisan make:controller EmployeeController --api`

This will create a new controller file EmployeeController.php in the app/Http/Controllers directory.

## Step 9: Implement the CRUD operations in the controller

Open the app/Http/Controllers/EmployeeController.php file and implement the CRUD operations.
Here's an example implementation for the controller methods:

```
<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function store(Request $request)
    {
        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return response()->json($employee);
    }

    public function update(Request $request, $id)
    {
        $employee = Employee::find($id);
        $employee->update($request->all());
        return response()->json($employee);
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return response()->json(null, 204);
    }
}
```


## Step 10: Test the API

You can now test your API using tools like Postman or cURL.
For example, you can send a POST request to http://localhost:8000/api/employees with a JSON payload containing the employee data to create a new employee.
That's it! You've created a Laravel REST API for employee CRUD operations. You can further customize and enhance the API based on your requirements.


## Open the app\Models\Employee.php file and make sure it includes the name field in the $fillable property, like this:


```
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];

    // Rest of the model code...
}
```

# Here are the URLs you can use for testing the Laravel REST API for employee CRUD operations in Postman:

## GET All Employees:
`GET http://localhost:8000/api/employees`
```
{
  "name": "Harshdeep",
  "email": "harshdeep@example.com",
  "phone": "6345678954"
}
```

## POST Create an Employee:
`POST http://localhost:8000/api/employees`


## GET Retrieve a Single Employee:
`GET http://localhost:8000/api/employees/{id}`


## PUT Update an Employee:
`PUT http://localhost:8000/api/employees/{id}`


## DELETE Delete an Employee:
`DELETE http://localhost:8000/api/employees/{id}`


Note: Replace {id} in the URLs with the actual ID of the employee you want to retrieve, update, or delete.

You can use these URLs in Postman to test the respective CRUD operations on your Laravel REST API for employees.


### Run `php artisan serve`