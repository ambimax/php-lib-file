## [2.1.2](https://github.com/ambimax/php-lib-file/compare/2.1.1...2.1.2) (2023-12-22)


### Bug Fixes

* add new version ([1b924c0](https://github.com/ambimax/php-lib-file/commit/1b924c067840a0890c8624fec6db644f1951d6d6))

# [2.1.0](https://github.com/ambimax/php-lib-file/compare/2.0.0...2.1.0) (2023-03-07)


### Bug Fixes

* prevent erasing the content of a file after renaming it ([949b200](https://github.com/ambimax/php-lib-file/commit/949b200f405ec9651ab964abf4cd5d30f826fd2d))
* rewind() and fseek() do not work for ftp ([0be5126](https://github.com/ambimax/php-lib-file/commit/0be5126bc50432b5a94c82a520f1708239ac411c))


### Features

* added Documentation ([b9b932d](https://github.com/ambimax/php-lib-file/commit/b9b932d7b58f51ba843443941355f2d5a83fac7d))
* added FtpFile.php ([53080a0](https://github.com/ambimax/php-lib-file/commit/53080a0188944dccd5082443f6df0ac76462e17d))

# [2.0.0](https://github.com/ambimax/php-lib-file/compare/1.0.0...2.0.0) (2022-12-14)


### chore

* Trigger major release for previous commits ([aa3e7bf](https://github.com/ambimax/php-lib-file/commit/aa3e7bfb672daa2ea01e26a761d4b55d9f18b8a7))
* Trigger major release for previous commits ([8fd0aeb](https://github.com/ambimax/php-lib-file/commit/8fd0aeb88465dd39b7389b24da1083a7a56ac1e1))


### BREAKING CHANGES

* replaced Filemode consts with Filemode Enum
changed file existence validation in openStream,
removed duplications in SftpFile openStream
* set minimal php version to 8.1

# 1.0.0 (2022-12-13)


### Bug Fixes

* cs-fix ([33cc791](https://github.com/ambimax/php-lib-file/commit/33cc791037a01b07b899ca848f1f6feebc5032e1))
* cs-fix ([60c30da](https://github.com/ambimax/php-lib-file/commit/60c30da392464c638e64810f9dfcacd5671277ed))
* cs-fix ([ff5977b](https://github.com/ambimax/php-lib-file/commit/ff5977b15aea724c06913d27dfe5e03026d061e8))
* cs-fix ([4e349ff](https://github.com/ambimax/php-lib-file/commit/4e349ffab1e0c6f26f86d09d11dd906c1a10a354))
* fixed flag ([019abbc](https://github.com/ambimax/php-lib-file/commit/019abbc78f2b44d568c46b48c8fa380084028084))
* fixed type juggling error ([e0ac105](https://github.com/ambimax/php-lib-file/commit/e0ac105f933238292edec0aa369ef24335edff4f))
* phpstan ([18c6d78](https://github.com/ambimax/php-lib-file/commit/18c6d78658e75bddb52819b7df95eee989acc922))
* simplified FileTest.php ([6805601](https://github.com/ambimax/php-lib-file/commit/680560132e95818f6c2cb914dbac36e34f344d3c))
* updated php version of the test action ([743bdc8](https://github.com/ambimax/php-lib-file/commit/743bdc870d568bfe2e3eb316cb343f51be90c8ff))


### Features

* added additional mode ([942fed4](https://github.com/ambimax/php-lib-file/commit/942fed41024972fd6bd87361743c8f04f3579c2e))
* added File mode consts ([bb4fe16](https://github.com/ambimax/php-lib-file/commit/bb4fe16844ba6de3867a0001d085d15e9056c595))
* added fread, ftell and fseek ([c2669f5](https://github.com/ambimax/php-lib-file/commit/c2669f5ff02cb7f76db99481b0c06630e975193e))
* added fwrite function and allowed getContent to return the whole content ([5670633](https://github.com/ambimax/php-lib-file/commit/5670633c1abedf67c102be4f6f88243dce5ab6d4))
* added get Extension and toString method ([918e225](https://github.com/ambimax/php-lib-file/commit/918e225b088bc415fb9a36543c3de600864907d0))
* added getFilenameWithoutExtension and Tests ([f2bde98](https://github.com/ambimax/php-lib-file/commit/f2bde98073587dac1ddf4613949bc04384feac98))
* added move as alias for rename ([1c21ffe](https://github.com/ambimax/php-lib-file/commit/1c21ffe3e3c2cc2ad1b109cf8bbda519353897e1))
* added possibility to create file when used with write mode ([840a1b2](https://github.com/ambimax/php-lib-file/commit/840a1b24f740d74ae626d39342572b812c5d6257))
* added rename function ([adeb6c1](https://github.com/ambimax/php-lib-file/commit/adeb6c1bd29e3d1517af5249f4d36c3bfd5d4ed1))
* allow rename to use previous filename if newpath ends with / ([1162444](https://github.com/ambimax/php-lib-file/commit/1162444ee5750c015ae5653e709e1a9f82967ad9))
* initialized library ([5fd6568](https://github.com/ambimax/php-lib-file/commit/5fd65685b878b08565f77da16c7195e465b52f09))
* made rename more predictable ([99e639a](https://github.com/ambimax/php-lib-file/commit/99e639a7d27432cc1385607761c40e0ceb700ee9))
* overworked rename method ([6532f5a](https://github.com/ambimax/php-lib-file/commit/6532f5acd426924399de637afd91cbf0c3c84ab1))
