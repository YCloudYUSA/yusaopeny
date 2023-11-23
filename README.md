<p align="center">
  <a href="https://ycloud.y.org/open-y-association-websites">
    <img alt="react-router" src="https://www.ymcanorth.org/themes/custom/ymca/img/ymca-logo.svg" width="144">
  </a>
</p>

<h3 align="center">
  YMCA’s Website Service
</h3>
<p align="center">
  https://ycloud.y.org/open-y-association-websites
</p>
<p align="center">
  An open source platform for YMCAs, by YMCAs built on <a href="https://drupal.org">Drupal</a>.
</p>

<p align="center">
  <a href="https://packagist.org/packages/ycloudyusa/yusaopeny-project"><img src="https://img.shields.io/packagist/v/ycloudyusa/yusaopeny-project.svg?style=flat-square"></a>
  <a href="https://packagist.org/packages/ycloudyusa/yusaopeny-project"><img src="https://img.shields.io/packagist/dm/ycloudyusa/yusaopeny-project.svg?style=flat-square"></a>
</p>

***

The [Y USA Website Services Project](https://ycloud.y.org/open-y-association-websites) is a composer based installer for the [Y USA Website Services distribution](https://github.com/YCloudYUSA/yusaopeny).


## Requirements

#### Composer    
If you do not have [Composer](http://getcomposer.org/), you may install it by following the [official instructions](https://getcomposer.org/download/). For usage, see [the documentation](https://getcomposer.org/doc/).

## Installation

#### Latest STABLE version
```
composer create-project ycloudyusa/yusaopeny-project MY_PROJECT --no-interaction
cd MY_PROJECT
```



#### Latest DEVELOPMENT version (Drupal 10+ 2.x)
```
composer create-project ycloudyusa/yusaopeny-project:dev-main-development MY_PROJECT --no-interaction --no-dev
cd MY_PROJECT
```

This command will build project based on the [**Drupal 9/10 development branch**](https://github.com/ycloudyusa/yusaopeny/commits/main) release.

See https://youtu.be/jRlinjpTl0c how to video for the whole process of this command usage.


## Development environment

You should use composer command without `--no-dev` if you would like to get environment that was configured especially for OpenY. This means you'd remove Vagrant/Docksal from the code tree.
So it should look like this:

```
composer create-project ycloudyusa/yusaopeny-project:dev-main-development MY_PROJECT --no-interaction
cd MY_PROJECT
```

See https://youtu.be/jRlinjpTl0c how to video for the whole process of this command usage.
=======


### CIBox VM
[CIBox VM](http://cibox.tools) allows you to make a contribution into OpenY in a few minutes. Just follow steps and then you'll know how to do it.

- [Pre Requirements](https://github.com/ymcatwincities/openy-cibox-vm#pre-requirements)
- [Installation](https://github.com/ymcatwincities/openy-cibox-vm#usage)
- [Local build](https://github.com/ymcatwincities/openy-cibox-vm#reinstall-options)
  
Read more details on [CIBox VM](https://github.com/ymcatwincities/openy-cibox-vm) repo.

### Docksal
[Docksal](http://docksal.io) is a tool for defining and managing development environments.

- [How to develop](https://github.com/ymcatwincities/openy-docksal#how-to-develop)
- [How to run behat tests](https://github.com/ymcatwincities/openy-docksal#how-to-run-behat-tests)
  
Read more details on [Docksal](https://github.com/ymcatwincities/openy-docksal) repo.

# Use Fork for the development

All development happens in the [Website Services Drupal 9/10 installation profile](https://github.com/ycloudyusa/yusaopeny). In order to start development:

1. Create fork of [Website Services installation profile](https://github.com/YCloudYUSA/yusaopeny)
2. Add your repository to `composer.json`
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/GITHUB_USERNAME/yusaopeny"
    }
]
```

3. Change a version for `ycloudyusa/yusaopeny` to `dev-main` or any other branch. E.g.:
- branch name "bugfix" - version name `dev-bugfix`
- branch name "feature/workflow" - version name `dev-feature/workflow`

```
"require": {
    "ycloudyusa/yusaopeny": "dev-main",
}
```
```
"require": {
    "ycloudyusa/yusaopeny": "dev-feature/workflow",
}
```

4. Run `composer update` to update packages
5. Add and commits changes in `docroot/profiles/contrib/openy`. Now it should be pointed to your fork.

# Directory structure
| Directory | Purpose |
|-----------|---------|
| [**Y USA Website Services**](https://github.com/ycloudyusa/yusaopeny) ||
| `docroot/` | Contains Drupal core |
| `docroot/profiles/contrib/openy/` | Contains Website Services distribution |
| `vendor/` | Contains Y USA Website Services distribution |
| `composer.json` | Contains Y USA Website Services distribution |
| [**CIBox VM**](https://github.com/ymcatwincities/openy-cibox-vm) + [**CIBox Build**](https://github.com/ymcatwincities/openy-cibox-build)  ||
| `cibox/` | Contains CIBox libraries |
| `docroot/devops/` | DevOps scripts for the installation process |
| `provisioning/` | Vagrant configuration |
| `docroot/*.sh` | Bash scripts to trigger reinstall scripts
| `docroot/*.yml` | YAML playbooks for the installation process |
| `Vagrantfile` | Vagrant index file |
| [**Docksal**](https://github.com/ymcatwincities/openy-docksal) ||
| `.docksal/` | Docksal configuration |
| `build.sh` | Build script for Docksal environment |

# Documentation
Documentation about Website Services is available at [docs](https://github.com/YCloudYUSA/yusaopeny_docs). For details please visit [https://ycloud.y.org/open-y-association-websites](https://ycloud.y.org/open-y-association-websites).
# License
Y USA OpenY Project is licensed under the [GPL-3.0](https://www.gnu.org/licenses/gpl-3.0-standalone.en.html). See the [License file](https://github.com/YCloudYUSA/yusaopeny-project/blob/9.2.x/LICENSE) for details.
