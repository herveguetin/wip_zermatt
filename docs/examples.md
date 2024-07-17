# Introduction

Here is a cookbook with several examples on how to use Zermatt.

**In order to follow along, we invite you to install the `Zermatt_Examples` module.**

```
composer require maddlen/module-zermatt-examples
bin/magento setup:upgrade
```
The `zermatt-lock.json` file of your themes is automatically updated. See `\Maddlen\Zermatt\Setup\Recurring`.

# Module rewrite

Open these files from the `/vendor/maddlen/module-zermatt-examples/view/frontend/web/zermatt` directory:

- `zermatt.json`
- `modules/welcome.js` 
- `modules/welcome-rewrite.js` 

The `zermatt.json` file declares a module:

```json
{
  "modules": {
    "welcome": "./modules/welcome",
    ...
```
So the Zermatt module named `welcome` points to `./modules/welcome.js` 
which contains the AlpineJS component.

This AlpineJS component has a `message: 'Welcome'` property.

The `zermatt.json` file also declares a rewrite:

```json
...
  "rewrites": {
    "welcome": "./modules/welcome-rewrite"
  }
}
```
So there is a rewrite for the `welcome` which points to `./modules/welcome-rewrite.js` 
which contains a rewritten version of the `message` property: `message: 'Welcome to Zermatt'`.

So any HTML tag that calls the `welcome` module has `Welcome to Zermatt` value for the `message` property.

For example:
```html
<div x-data="Zermatt.Module('welcome')">
    <div x-text="message"></div>
</div>
```

Outputs:
```html
<div>
    <div>Welcome to Zermatt</div>
</div>
```

# Passing backend data to a module

There are 2 ways to pass backend data to a Zermatt moodule.

## Module properties

**To be preferred to keep data scoped to the current template.**

Zermatt gives the ability to pass properties to the AlpineJS component powering a Zermatt module.

Please see the `vendor/maddlen/module-zermatt-examples/view/frontend/templates/welcome.phtml` template.

It has this content:

```html
<?php $customerName = 'John Doe' ?>
<h2>Welcome</h2>
<div x-data="Zermatt.Module('welcome', {customerName: '<?= $customerName ?>'})" x-text="greet()"></div>
```

- The `$customerName` PHP variable is populated.
- The `welcome` Zermatt module is instanciated...
- ... with the value of `$customerName` populating the `customerName` property of the AlpineJS component.
- The `x-text` then outputs the result of the `greet()` method which needs the `customerName` property.

## Zermatt variables

**To be preferred to expose data to all the Zermatt modules and PHTML templates.**

It is possible to call the `zermatt_variable(<key>, <value>)` PHP method in any PHP or phtml file,
It will populate the `Zermatt.Variables` frontend JS object: `Zermatt.Variables.<key> = <value>`.

Example:

We need to have some customer information available in many parts of a page.
We could:

- Create a template Block class with the business logic to get customer data.
- Use its `_toHtml()` method to call `zermatt_variable`.
- Get the customer data in all phtml files with `Zermatt.Variables`.



# Zermatt Components

Transmit data
