# Ftp File
Class: [FtpFile](/src/Remote/FtpFile.php)

## Difference to Base File
### Ftp File creation
```php
use Ambimax\File\Remote\FtpFile;
use Ambimax\File\FileMode;

$ftoFile = new FtpFile(
    hostname: 'example.com',
    username: 'user',
    password: 'password123',
    filePath: 'foo/bar/baz.txt',
    mode: FileMode::R,
    overwrite: true // optional, default = false
);
```

### Rename/Move
The implementation of rename and move of FtpFile do not reopen the file.
