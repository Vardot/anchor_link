<?php

namespace Drupal\anchor_link\Plugin\CKEditorPlugin;

use Drupal\editor\Entity\Editor;
use Drupal\ckeditor\CKEditorPluginBase;

/**
 * Defines the "link" plugin.
 *
 * @CKEditorPlugin(
 *   id = "link",
 *   label = @Translation("CKEditor Web link"),
 *   module = "anchor_link"
 * )
 */
class AnchorLink extends CKEditorPluginBase {

  /**
  * Implements \Drupal\ckeditor\Plugin\CKEditorPluginInterface::getFile().
  */
  function getFile() {
    $path = 'libraries/ckeditor/plugins/link';
    // Support for "Libaraies API" module.
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('ckeditor_anchor_link');
    }

    return $path . '/plugin.js';
  }

  /**
   * {@inheritdoc}
   */
  public function getDependencies(Editor $editor) {
    return [
      'fakeobjects',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getLibraries(Editor $editor) {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function isInternal() {
    return FALSE;
  }

  /**
   * Implements \Drupal\ckeditor\Plugin\CKEditorPluginButtonsInterface::getButtons().
   */
  function getButtons() {
    $path = 'libraries/ckeditor/plugins/link';
    // Support for "Libaraies API" module.
    if (\Drupal::moduleHandler()->moduleExists('libraries')) {
      $path = libraries_get_path('ckeditor_anchor_link');
    }

    return [
      'Link' => [
        'label' => t('Link'),
        'image' => $path . '/icons/link.png',
      ],
      'Unlink' => [
        'label' => t('Unlink'),
        'image' => $path . '/icons/unlink.png',
      ],
      'Anchor' => [
        'label' => t('Anchor'),
        'image' => $path . '/icons/anchor.png',
      ]
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }
}
