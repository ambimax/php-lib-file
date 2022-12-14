# UPGRADE FROM 1.0 to 2.0
## Php 
Increased minimal PHP version to 8.2

## FileEnum
* You will need to replace all occurrences of `File:MODE_*` Consts with the corresponding `Ambimax\File\FileMode` Enum Cases

* With the change from Const to Enum the naming of `MODE_READ, MODE_READ_PLUS, MODE_WRITE, MODE_WRITE_PLUS` has been changed to just `R, R_PLUS, W, W_PLUS` to be consistent with the other modes