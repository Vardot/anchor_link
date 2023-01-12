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
  public function getFile() {
    $anchor_link_path = \Drupal::service('extension.list.module')->getPath('anchor_link');
    return $anchor_link_path . '/js/plugins/link/plugin.js';
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
   * {@inheritdoc}
   */
  public function getButtons() {

    $anchor_link_path = \Drupal::service('extension.list.module')->getPath('anchor_link');

    return [
      'LinkToAnchor' => [
        'label' => $this->t('Link to anchor'),
        'image' => $anchor_link_path . '/js/plugins/link/icons/link.png',
      ],
      'UnlinkAnchor' => [
        'label' => $this->t('Unlink Anchor'),
        'image' => $anchor_link_path . '/js/plugins/link/icons/unlink.png',
      ],
      'Anchor' => [
        'label' => $this->t('Anchor'),
        'image' => $anchor_link_path . '/js/plugins/link/icons/anchor.png',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

}
