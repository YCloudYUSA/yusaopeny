<?php
/**
 * Website Services Robo commands. 
 * Here we are able to create an any version of Website Services for CI builds.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks {
  /**
   * Create Website Services project https://github.com/ymcatwincities/openy-project without installation.
   *
   * @param string $path
   *   Installation path that will be used to create "openy-project" folder.
   */
  function OpenyCreateProject($path) {
    $this->taskComposerCreateProject()
      ->source('ycloudyusa/yusaopeny-project:dev-y_fonts_y_lb_3')
      ->target($path . '/yusaopeny-project')
      ->ansi(TRUE)
      ->dev()
      ->noInstall(TRUE)
      ->noInteraction()
      ->run();
  }

  /**
   * Add fork as repository to composer.json.
   *
   * @param string $path
   *   Installation path where repository should be added.
   *
   * @param string $repository
   *   Local path of the repository.
   */
  function OpenyAddFork($path, $repository) {
    $this->taskComposerConfig()
      ->dir($path . '/yusaopeny-project')
      ->repository(99, $repository, 'path')
      ->ansi(TRUE)
      ->run();
  }


  /**
   * Set target branch of the fork.
   *
   * @param string $path
   *   Installation path where "openy-project" is placed.
   *
   * @param string $branch
   *   Branch name.
   */
  function OpenySetBranch($path, $branch) {
    $this->taskComposerRequire()
      ->dir($path . '/yusaopeny-project')
      ->dependency('ycloudyusa/yusaopeny', $branch)
      ->dev()
      ->ansi(TRUE)
      ->noInteraction()
      ->option('--with-all-dependencies')
      ->run();
  }

  /**
   * Installs Website Services from fork as dependency.
   *
   * @param string $path
   *   Installation path where "openy-project" is placed.
   */
  function OpenyInstall($path) {
    $this->taskComposerInstall()
      ->dir($path . '/yusaopeny-project')
      ->noInteraction()
      ->dev()
      ->ansi(TRUE)
      ->run();
  }

  /**
   * Creates symlink to mirror build folder into web accessible dir.
   *
   * @param string $docroot_path
   *   Path where website folder should be created.
   *
   * @param string $build_path
   *   Path where source code for build is placed.
   */
  function OpenyBuildFolder($docroot_path, $build_path) {
    $this->taskFilesystemStack()
      ->symlink($docroot_path, $build_path)
      ->chgrp('www-data', 'jenkins', TRUE)
      ->run();
  }
}
