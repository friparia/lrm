# Laravel Routes Management

[中文版README](https://github.com/friparia/lrm/blob/master/README.chs.md)

![preview](https://github.com/friparia/lrm/blob/master/rt.jpg)

## Installation

First, add a line in the section of `require` in `composer.json` file:

    "friparia/lrm": "dev-master"

Then, add a line of service provider in `app/config/app.php`:
    
    "Friparia\Lrm\LrmServiceProvider",

At last, you should make sure the access of `routes.php`.

Remember you should change the permission to 644 when you are not in the debug mode.

## Usage

Visit the `lrm` in your web browser, like this:

    "www.example.com/public/lrm"

Then you can manage your routes;

## Questions

It is still under developing. So it only support the common function just like `get`, `post`, `put`, `patch`, `delete`. 
And maybe have some bugs in writing callbacks. 
Please let me know in issues!!

## Todo

- [ ] Support `resource()`, `controller()` functions

- [ ] Support filters

- [ ] Support group manages

- [ ] Support editing
