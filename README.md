# SMFUI
Object-oriented UI framework for SMF (Simple Machines Forum).

## Why SMFUI?
There are a lot of design elements in SMF. Some are easy to write; others are not. But, what they all have in common, they are time consuming and dull to write; you have more important things to do!
Meet SMFUI. The framework that is designed to take away this pain and let you get to the real job; your source code. Because that's where all the magic happens.

## How does SMFUI work?
SMFUI works on a concept based on Widgets. Each Widget is an element you can re-use throughout the project.

A single Widget is made out of two parts:
* Source-side Widget (SSW): A SSW is the controller for the Widget. It allows you to manipulate the Widget by using methods.
* Template-side Widget (TSW): The TSW side of the Widget explains how the Widget should look, where all the data goes, etc. It contains the actual HTML code of the widget.

## Sample code
```php
<?php

// Simplify things a bit. All widgets mentioned in this sample page (Catbar, Titlebar, Roundframe, Icon) reside inside the SMFUI\Widgets namespace.
use SMFUI\Widgets;

/*
 * Simple widgets.
 */

// Create a new Catbar with the text "A new catbar!" in its header.
// The second parameter, true in this case, tells the framework to directly paint it on the screen. This is always the last parameter.
new Catbar('A new catbar!', true);

// Create a new Titlebar with the text "Testing!" in its header. This will also be automagically painted.
new Titlebar('Testing!', true);

/*
 * Nested widgets
 */

// We would like an icon.
$icon = new Icon('help');

// Get the HTML for this icon.
$iconHTML = $icon->getHTML();

// Create a Catbar...
// The catbar will contain the icon (we got its HTML).
$catbar = new Catbar($iconHTML . 'A catbar!');

// Get the HTML from the catbar...
$catHTML = $catbar->getHTML();

// And put it in a roundframe!
new Roundframe($catHTML . 'This roundframe will contain the Catbar, which will contain the Icon!', '', true);

/*
 * Widgets with additional attributes
 */

// Some widgets can quickly apply things like additional classes.
// In this case, the class 'centertext' will be applied.
new Roundframe('A roundframe!', 'centertext', true);

// If a widget has no parameter for quickly applying attributes, most widgets support manipulating their attributes by calling methods.
// Here, we set the additional class 'floatright' will be applied on a new Catbar.
$catbar = new Catbar('A catbar!');
$catbar->setAdditionalClasses('floatright');

// Most widgets can be manipulated by calling methods.
$icon = new Icon('help');

// Here, we set the optional Alt attribute on the icon.
$icon->setAlt('This alternative text will be displayed when the icon is not available!');

// We can also get the Alt we just set again.
$alt = $icon->getAlt();
```
Result:
!(Sample output)[https://raw.githubusercontent.com/Yoshi2889/smf-ui/master/sample_result.png]
