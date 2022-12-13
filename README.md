# Ambimax PhpLibrary File 
This Library is a abstraction for interactions with files

## Remotes
Remote are extensions of the base File Class which are used to  other systems.

### Implementet Protocols:
- Sftp [SftpFile.php](src/Remote/SftpFile.php)

## Quick Start
### Installation
```shell
composer require ambimax/php-lib-file
```

## Basic Usage

### Create File Object
Creating of a File Object goes mostly analogous to [fopen](https://www.php.net/manual/de/function.fopen.php)

__1. Argument:__   
fopen compatible filename

__2. Argument:__   
Any of the File::MODE_* consts
This consts are the available options of the [fopen](https://www.php.net/manual/de/function.fopen.php) `mode`parameter.

```php
use \Ambimax\File\File;

//                fopenCompatibleFilename   Any File::MODE_*
$file = new File(     '/tmp/filename'     , File::MODE_READ  );
```

## Remotes
For additional informations on how use this with files that are not in the local filesystem check the [Remotes Documentation](docs/remotes/README.md).

## Helper scripts

You can find out more about them [here](docs/tools.md).

## Addtitional Documentation

Add a list of links to additional documentation in `./docs`.

* [Changelog](./CHANGELOG.md)
* [Tools](./tools.md)
* [Plugin Template](plugin-template.md)


## Author(s)
- Fabian Köhnen, [ambimax® GmbH](https://www.ambimax.de)