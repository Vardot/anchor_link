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
   * {@inheritdoc}
   */
  public function getFile() {
    return $this->getLibraryUrl() . '/plugin.js';
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
    $libraryUrl = $this->getLibraryUrl();

    return [
      'Link' => [
        'label' => $this->t('Link'),
        'image' => $libraryUrl . '/icons/link.png',
      ],
      'Unlink' => [
        'label' => $this->t('Unlink'),
        'image' => $libraryUrl . '/icons/unlink.png',
      ],
      'Anchor' => [
        'label' => $this->t('Anchor'),
        'image' => $libraryUrl . '/icons/anchor.png',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getConfig(Editor $editor) {
    return [];
  }

  /**
   * Get the CKEditor Link library path.
   */
  protected function getLibraryPath() {

    $librarayPath = DRUPAL_ROOT . '/libraries/link';

    // Is the library found in the root libraries path.
    $libraryFound = file_exists($librarayPath . '/plugin.js');

    // If library is not found, then look in the current profile libraries path.
    if (!$libraryFound) {
      $profilePath = drupal_get_path('profile', \Drupal::installProfile());
      $profilePath .= '/libraries/link';

      // Is the library found in the current profile libraries path.
      if (file_exists(DRUPAL_ROOT . '/' . $profilePath . '/plugin.js')) {
        $libraryFound = TRUE;
        $librarayPath = DRUPAL_ROOT . '/' . $profilePath;
      }
      else {
        $libraryFound = FALSE;
      }

    }

    if ($libraryFound) {
      return $librarayPath;
    }
    else {
      return 'libraries/link';
    }
  }

  /**
   * Get the CKEditor Link library URL.
   */
  protected function getLibraryUrl() {

    $originUrl = \Drupal::request()->getSchemeAndHttpHost() . \Drupal::request()->getBaseUrl();

    $librarayPath = DRUPAL_ROOT . '/libraries/link';
    $librarayUrl = $originUrl . '/libraries/link';

    // Is the library found in the root libraries path.
    $libraryFound = file_exists($librarayPath . '/plugin.js');

    // If library is not found, then look in the current profile libraries path.
    if (!$libraryFound) {
      $profilePath = drupal_get_path('profile', \Drupal::installProfile());
      $profilePath .= '/libraries/link';

      // Is the library found in the current profile libraries path.
      if (file_exists(DRUPAL_ROOT . '/' . $profilePath . '/plugin.js')) {
        $libraryFound = TRUE;
        $librarayUrl = $originUrl . '/' . $profilePath;
      }

    }

    if ($libraryFound) {
      return $librarayUrl;
    }
    else {
      return $originUrl . '/libraries/link';
    }
  }

}
