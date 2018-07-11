# CliTypo
Typography functions for PHP CLI


## Instalation

Add CliTypo to your project composer

1: Add repository in composer.json

```json
"repositories": [
   {
     "type": "vcs",
        "url" : "https://bitbucket.org/adriangrabowski/grabower_clitypo.git"
    }
],
```

2: Add dependency in require list

```json
"grabower/clitypo": "dev-master"
```

3: Run composer

```cmd
$ composer update
```


## Usage

CliTypo methods ware grouped. You can use:
* Alerts
* Components
* Text
* Formater


Create instance of CliTypo and use groups:

```php
$cliTypo = new \Grabower\CliTypo\CliTypo();
$cliTypo->text()->write("It works");
```

or use namespace
```php
use Grabower\CliTypo\CliTypo;

$cliTypo = new CliTypo();
$cliTypo->text()->write("It works");
```


### Alerts

Alert is customized text with font color and background color.

##### Success

```php
$cliTypo->alert()->success("This is success message");
```
<span style="color:white; background: darkgreen; font-weight: bold">This is success message</span>

##### Warning

```php
$cliTypo->alert()->warning("This is warning message");
```
<span style="color:white; background: orange; font-weight: bold">This is warning message</span>

##### Info

```php
$cliTypo->alert()->info("This is info message");
```
<span style="color:white; background: blue; font-weight: bold">This is info message</span>

##### Error

```php
$cliTypo->alert()->error("This is error message");
```
<span style="color:white; background: red; font-weight: bold">This is error message</span>

### Components

#### Progress bar

Show progress bar by percentage

Example:
```php
$cliTypo->component()->progress(10);
```
Output:

▓▓▓▓░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░ 10%

#### Table

Show array data in table format

Example:
```php
$cliTypo->component()->table(
    array(
        array("ID", "Firstname", "Lastname", "Age"),
        array("1", "Jon", "Doe", "34"),
        array("2", "Sarah", "Conor", "26"),
        array("3", "Jack", "Sparrow", "40"),
    )
);
```
or
```php
$cliTypo->component()->table(
    array(
        array("1", "Jon", "Doe", "34"),
        array("2", "Sarah", "Conor", "26"),
        array("3", "Jack", "Sparrow", "40"),
    ),
    array("ID", "Firstname", "Lastname", "Age")
);
```

Output:
```
|------------|------------|------------|------------|
| ID         | Firstname  | Lastname   | Age        |
|------------|------------|------------|------------|
| 1          | Jon        | Doe        | 34         |
|------------|------------|------------|------------|
| 2          | Sarah      | Conor      | 26         |
|------------|------------|------------|------------|
| 3          | Jack       | Sparrow    | 40         |
|------------|------------|------------|------------|
```

#### Indicator

Show indicator of progress

Example:
```php
$cliTypo->component()->indicator(2, 10);
```

Output:
```cmd
(2 / 10)
```

#### Decision

Wait to user response with decision. Method will return true of false.

Example:
```php
$remove = $cliTypo->component()->decision("Are you sure to remove world?");
```

Output:
```cmd
Are you sure to remove world? [ Y, n ]:
```


#### Password

Wait to user password. Method will return string with input password.

Example:
```php
$password = $cliTypo->component()->password("Enter password to run nuclear attack");
```

Output:
```cmd
Enter password to run nuclear attack:
```

#### Read

Wait to user input data. Method will return string with input data.

Example:
```php
$name = $cliTypo->component()->read("What is your name");
```

Output:
```cmd
What is your name:
```

#### Elements

Show array with element in readable format.

Example:
```php
$cliTypo->component()->elements(array(
    "Apples" => "$1.50",
    "Sugar" => "$4.20",
    "Coke" => "$10"
));
```

Output:
```cmd
Apples .............. $1.50
Sugar ............... $4.20
Coke ................ $10

```

You can change type and size of padding:
```php
$cliTypo->component()->elements(array(
    "Apples" => "$1.50",
    "Sugar" => "$4.20",
    "Coke" => "$10"
),40, "-");
```

Output:
```cmd
Apples ---------------------------------- $1.50
Sugar ----------------------------------- $4.20
Coke ------------------------------------ $10
```

#### Wait

Delay executing process, with seconds.

Example:
```php
$cliTypo->component()->wait(2);
```

Waiting two seconds

Example:
```php
$cliTypo->component()->wait(2, true);
```

Waiting three seconds with countdown:

```cmd
3... 2... 1...
```

### Text

#### Write

Show text

Example:
```php
$cliTypo->text()->write("CliTypo is great package");
```

Output:
```cmd
CliTypo is great package
```


#### Write back caret

Show text

Example:
```php
$cliTypo->text()->write_back_caret("CliTypo is great package 1");
$cliTypo->text()->write_back_caret("CliTypo is great package 2");
$cliTypo->text()->write_back_caret("CliTypo is great package 3");
```

Output:
```cmd
CliTypo is great package 3
```

#### Empty line

Show empty line

Example:
```php
$cliTypo->text()->empty_line();
```

Output:
```cmd

```

#### Color

Show colorized text with background. Background can be null.

Example:
```php
$cliTypo->text()->color("Red text on yellow background", "red", "yellow");
$cliTypo->text()->color("Red text", "red");
```

Output:

<span style="color:red; background: yellow; font-weight: bold">Red text on yellow background</span>

<span style="color:red; font-weight: bold">Red text</span>

### Format

Format methods returns formatted content of string. You must use methods from Text methods to show content.
Formatted content can be used in texts, components and alerts methods.

#### Border

Show text with border

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->bordered("Bordered text")
);
```

Output:
```cmd
***************************
*      Bordered text      *
***************************

```

You can change character of background:

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->bordered("Bordered text", "#")
);
```

Output:
```cmd
###########################
#      Bordered text      #
###########################

```


#### With time

Show text with current time

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->with_time("Action with time")
);
```

Output:
```cmd
[16:58:57] Action with time
```

You can set time format

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->with_time("Action with time", "H:i")
);
```

Output:
```cmd
[16:59] Action with time
```

#### With date

Show text with current date

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->with_date("Action with date")
);
```

Output:
```cmd
[11.07.2018] Action with date
```

You can set time format

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->with_date("Action with date", "d/m/y")
);
```

Output:
```cmd
[11/07/18] Action with date
```

#### Flank

Show text with attention

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->flank("ATTENTION")
);

$cliTypo->text()->write(
    $cliTypo->format()->flank("ATTENTION", "#")
);
$cliTypo->text()->write(
    $cliTypo->format()->flank("ATTENTION", "#", 5)
);
```

Output:
```cmd
! ATTENTION !
# ATTENTION #
##### ATTENTION #####
```

#### Dump

Show information about variable

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->dump(array("1", 0, array("a"), new StdClass()))
);
```

Output:
```cmd
array(4) {
  [0]=>
  string(1) "1"
  [1]=>
  int(0)
  [2]=>
  array(1) {
    [0]=>
    string(1) "a"
  }
  [3]=>
  object(stdClass)#13 (0) {
  }
}

```

#### Json

Show formatted json string

Example:
```php
$cliTypo->text()->write(
    $cliTypo->format()->json(json_encode(array("1", 0, array("a"), new StdClass())))
);
```

Output:
```cmd
[
 "1",
  0,
  [
   "a"
  ],
  {
  }
]

```