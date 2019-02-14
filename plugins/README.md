# CakePHP Wizard Plugin - PORT TO CakePHP v3.x - IN PROGRESS!

The Wizard plugin for CakePHP automates several aspects of multi-page forms including data persistence, form preparation and unique data processing, wizard resetting (manual and automatic), user navigation, and plot-branching navigation while maintaining flexibility with custom validation and completion callbacks.

This is is a fork of [ProLoser/CakePHP-Wizard](https://github.com/ProLoser/CakePHP-Wizard) to make the code compatible with CakePHP v3.x.

## Installation

* Clone/Copy the files in this directory into `app/plugins/wizard`
* Include the wizard component in the `initialize()` method of your controller:

`    public function initialize() {
        parent::initialize();

        $this->loadComponent( 'Wizard' );
    }`

## Documentation

Detailed documentation, including usage examples, can be found in the [GitHub wiki](http://github.com/jaredhoyt/cakephp-wizard/wiki).
