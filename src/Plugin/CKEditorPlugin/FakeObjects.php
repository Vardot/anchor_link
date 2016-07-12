<?php

/**
 * @file
 * Definition of \Drupal\anchor_link\Plugin\CKEditorPlugin\FakeObjects.
 */
namespace Drupal\anchor_link\Plugin\CKEditorPlugin;

use Drupal\Core\Plugin\PluginBase;
use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginInterface;

/**
 * Defines the "fakeobjects" plugin.
 *
 * @CKEditorPlugin(
 *   id = "fakeobjects",
 *   label = @Translation("CKEditor Fake Object"),
 *   module = "anchor_link"
 * )
 */
class FakeObjects extends PluginBase implements CKEditorPluginInterface {

  /**
  * Implements \Drupal\ckeditor\Plugin\CKEditorPluginInterface::getFile().
  */
  function getFile() {
    return drupal_get_path('module', 'anchor_link') . '/js/plugins/fakeobjects/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return array();
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return array();
  }
}
