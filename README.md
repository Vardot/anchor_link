# CKEditor Anchor Link

This plugin module adds the better link dialog and anchor related features
to CKEditor 5 in Drupal:

- Dialog to insert links and anchors with some properties.
- Context menu option to edit or remove links and anchors.
- Ability to insert a link with the URL using multiple protocols, including an
  external file if a file manager is integrated.

For a full description of the module, visit the
[project page](https://www.drupal.org/project/anchor_link).

Submit bug reports and feature suggestions, or track changes in the
[issue queue](https://www.drupal.org/project/issues/anchor_link).


## Table of contents

- Requirements
- Installation
- Configuration
- Maintainers


## Requirements

This module requires the CKEditor 5 and Text Editor modules of Drupal core, and
the [vardot/ckeditor5-anchor-drupal](https://github.com/Vardot/ckeditor5-anchor-drupal)
plugin library.

Composer brings the library in as a `drupal-library`. See
`composer.libraries.json`; you should be able to copy and paste most of that
into your own `composer.json`.


## Installation

Install as you would normally install a contributed Drupal module. For further
information, see
[Installing Drupal Modules](https://www.drupal.org/docs/extending-drupal/installing-drupal-modules).


## Configuration

1. Go to Configuration > Content Authoring > Text Formats and Editors.
2. Choose the text format used for content creation where CKEditor 5 will be
   enabled.
3. Locate the CKEditor 5 editor settings within the selected text format.
4. Drag the Anchor Link button into the active toolbar.

An anchor is written as an `id` on the `<a>` element. The `name` attribute is
also read, for content authored before the `id` attribute took over.


## Maintainers

- [Rajab Natshah](https://www.drupal.org/u/rajab-natshah)
- Mohammed Razem - [Mohammed J. Razem](https://www.drupal.org/u/mohammed-j-razem)
- [Dylan Donkersgoed](https://www.drupal.org/u/dylan-donkersgoed)
