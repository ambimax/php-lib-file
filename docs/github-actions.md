# Github Actions
## release
- runs on workflow dispatch only. __you will need to trigger the release manually__
- runs the semantic-release tool to create a new tag and release
- __make sure to name your commits according to the [semantic-release rules](https://guide.ambimax.xyz/best-practices/semantic-release/index.html)__

## test
- installs the composer dependencies of the plugin
- runs `composer check`
- **Tip:** you can see the code coverage of your test at step ``run tests`` 
