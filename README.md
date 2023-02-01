
# Overtime Calculation System - REST-API

There are 2 methods of calculating overtime used.

- Salary / 173 {(salary / 173) * overtime_duration_total)
- Fixed (10000 * overtime_duration_total)

If the first method is used, then all overtime wages from existing employees will be calculated using that method. Likewise if the chosen method is the second.

Especially for employees on a probationary period, overtime pay is calculated when the overtime duration is more than 1 hour. When more than 1 hour, what is counted is the duration after that 1 hour. However, it will not be counted if the duration after 1 hour has not reached 1 hour, this rule applies to multiples. Overtime duration for employees in this probationary period is calculated on each overtime performed, not from the accumulated overtime per month.

An example of the results of calculating employee overtime during a probationary period is as follows.
- 2 hours overtime, then get 1 hour overtime pay
- 2.5 hours overtime, then get 1 hour overtime pay
- 1.5 hours overtime, so you don't get overtime pay
- 3.9 hours of overtime, then you get 2 hours of overtime pay

## API Reference

#### Change Settings data.

```http
  PATCH /settings
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `key` | `string` | **Can only be filled '`overtime_method`'** |
| `value` | `string` | **Can only be filled by the value of `references`.`id` with criteria `code` = `overtime_method`** |

#### Creating Employee Data

```http
  POST /employees
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `name`      | `string` `unique` | **Required**. Name of Employee |
| `status_id` | `integer` | **According to the one in `references`.`id` with criteria `code` = `employee_status`** |
| `salary` | `integer` `min:2000000` `max:10000000` | **Required**. Salary of Employee |

#### Display all Employees data with pagination format (default 10)

```http
  GET /employees_per_page
```

#### Display Employees data with pagination format (page 1)

```http
  GET /employees_page
```

#### Display all Employees data with pagination format (Order By Name ASC)

```http
  GET /employees_order_by_name_asc
```

#### Display all Employees data with pagination format (Order By Name DESC)

```http
  GET /employees_order_by_name_desc
```

#### Display all Employees data with pagination format (Order By Salary ASC)

```http
  GET /employees_order_by_salary_asc
```

#### Display all Employees data with pagination format (Order By Salary DESC)

```http
  GET /employees_order_by_salary_desc
```

#### Creating Overtime Data

```http
  POST /overtimes
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `employee_id` | `integer` | **According to the one in `employees`.`id`** |
| `date` | `date` `unique` | **Required** Date of employee doing overtime|
| `time_started` | `time` `date_format:H:i` `before:time_ended` | **Required**. Start time employees do overtime |
| `time_ended` | `time` `date_format:H:i` `after:time_started` | **Required**. Ended time employees do overtime |


#### Displays Overtimes data based on the specified time range

```http
  GET /overtimes
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `date_started` | `date` `before:date_ended` | **Required**. Start time range |
| `date_ended` | `date` `after:date_started` | **Required**. Ended time range |


#### Displays the calculation results of the Overtimes that exist for each Employee, based on the specified month

```http
  GET /overtime-pays/calculate
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `month` | `date` `date_format:Y-m` | **Required**. Spesific Month |


## Tech Stack

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

**Server:** Laravel 8

**Database:** MySQL

**PHP Requitment:** 7.4

### Installing

Before installing make sure it is installed `composer` and `php`. 


```php
$ composer install

cmd : copy .env.example .env

php artisan key:generate

setting database file -> .env 

// Setup Database
$ php artisan migrate
```
