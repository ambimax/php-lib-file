# Sftp File
Class: [SftpFile](../../src/Remote/SftpFile.php)

## Differnce to Base File
### Sftp File creation
```php
use Ambimax\File\Remote\SftpFile;

$sftpFile = new SftpFile(
    'SftpHostname', 
    'SftpUsername',
    'SftpPassword',
    //... like the base file class
);
```
