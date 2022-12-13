# Tools
## Composer Scripts
You can run each tool with `composer <tool_name>` inside the plugin root directory.  
**To run these tools you need to have the composer dependencies. [check here](development.md#Setup)**

### cs-check
check the code style of your plugin with the Symfony Ruleset of php-cs-fixer

### cs-fix
same as cs-check, but fixes the code style automatically

### unit
run the unit tests of your plugin

### unit-coverage
runs the unit tests of your plugin and generates a code coverage report 

### stan
inspect the source code of your plugin with [PHPStan](https://phpstan.org/) on level 7

### check
combines cs-check, unit-coverage and stan
