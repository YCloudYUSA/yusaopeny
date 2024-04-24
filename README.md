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
  An open-source platform for YMCAs, by YMCAs, built on <a href="https://drupal.org">Drupal</a>.
</p>

<p align="center">
  <a href="https://packagist.org/packages/ycloudyusa/yusaopeny-project"><img src="https://img.shields.io/packagist/v/ycloudyusa/yusaopeny-project.svg?style=flat-square"></a>
  <a href="https://packagist.org/packages/ycloudyusa/yusaopeny-project"><img src="https://img.shields.io/packagist/dm/ycloudyusa/yusaopeny-project.svg?style=flat-square"></a>
</p>

***

The [Y USA Website Services Project](https://ycloud.y.org/open-y-association-websites) is a composer-based installer for the [Y USA Website Services distribution](https://github.com/YCloudYUSA/yusaopeny).


## Requirements

#### Composer    
If you do not have [Composer](http://getcomposer.org/), you may install it by following the [official instructions](https://getcomposer.org/download/). For usage, see [the documentation](https://getcomposer.org/doc/).

## Installation

### Clean install

If you are using internal tooling or only want the required code with no development environment, follow these steps.

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

This command will build a project based on the [**Drupal 9/10 development branch**](https://github.com/ycloudyusa/yusaopeny/commits/main) release.

See [a how-to video](https://youtu.be/jRlinjpTl0c) for the whole process of this command usage.

### Development environment

To get an environment that was configured especially for development with the distribution, remove `--no-dev` from the composer command.

So it should look like this:

```
composer create-project ycloudyusa/yusaopeny-project:dev-main-development MY_PROJECT --no-interaction
cd MY_PROJECT
```

See [a how-to video](https://youtu.be/jRlinjpTl0c) for the whole process of this command usage.

#### Docksal
[Docksal](http://docksal.io) is a tool for defining and managing development environments.

- [How to develop](https://github.com/ymcatwincities/openy-docksal#how-to-develop)
  
Read more details on [Docksal](https://github.com/ymcatwincities/openy-docksal) repo.

### Drupal install

The distribution has a full user interface for step-by-step installation. Simply visit your site after building your dev environment to be taken through the installation process.

For developers who want a kick-start, you can pass many configuration options in the install process through to [drush site:install](https://www.drush.org/12.x/commands/site_install/).

For example, a "complete" install with the "Carnation" theme might look like:

```shell
drush -vy si openy openy_configure_profile.preset=complete openy_theme_select.theme=openy_carnation openy_terms_of_use.agree_openy_terms=1 install_configure_form.enable_update_status_emails=NULL --account-name=admin --site-name='YMCA Website Services sandbox'
```

## Use Fork for the development

All development happens in the [Website Services Drupal 9/10 installation profile](https://github.com/ycloudyusa/yusaopeny). To start development:

1. Create a fork of [Website Services installation profile](https://github.com/YCloudYUSA/yusaopeny)
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
5. Add and commit changes in `docroot/profiles/contrib/openy`. Now it should be pointed to your fork.

## Directory structure

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

## Documentation

Documentation about Website Services is available at [docs](https://github.com/YCloudYUSA/yusaopeny_docs). For details please visit [https://ycloud.y.org/open-y-association-websites](https://ycloud.y.org/open-y-association-websites).

## License

Y USA OpenY Project is licensed under the [GPL-3.0](https://www.gnu.org/licenses/gpl-3.0-standalone.en.html). See the [License file](https://github.com/YCloudYUSA/yusaopeny-project/blob/9.2.x/LICENSE) for details.
