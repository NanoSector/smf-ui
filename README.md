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

// Include all files we need... (Don't need SSI in real SMF!!)
require_once("SSI.php");
require_once("Sources/SMFUI/Base.php");
SMFUI\Base::init();

template_header();

/*
 * Simple widgets.
 */

// Create a new Catbar with the text "A new catbar!" in its header. It can be directly echo'ed to the page.
$catbar = new Widgets\Catbar();
$catbar->insertChild(new Widgets\TextWidget('A new catbar!'));
echo $catbar;

// Create a new Titlebar with the text "Testing!" in its header and also directly echo it.
$titlebar = new Widgets\Titlebar();
$titlebar->insertChild(new Widgets\TextWidget('Testing!'));
echo $titlebar;

/*
 * Nested widgets
 */

// Create a Catbar...
// The catbar will contain the icon.
$catbar = new Widgets\Catbar();
$catbarText = new Widgets\TextWidget('A catbar!');
$catbar->insertChild($catbarText);

// We would like an icon, before the content.
$icon = new Widgets\Icon('help');
$catbar->insertChildBefore($icon, $catbarText);

// And put it in a roundframe!
$roundframe = new Widgets\Roundframe();
$roundframeText = new Widgets\TextWidget('This roundframe will contain the Catbar, which will contain the Icon!');
$roundframe->insertChild($roundframeText);
$roundframe->insertChildBefore($catbar, $roundframeText);

// And output the roundframe.
echo $roundframe;

/*
 * Widgets with additional attributes
 */

// Some widgets can quickly apply things like additional classes.
// In this case, the class 'centertext' will be applied.
$roundframe = new Widgets\Roundframe();
$roundframe->setAdditionalClasses('centertext');
$roundframe->insertChild(new Widgets\TextWidget('A test roundframe with centertext!'));
echo $roundframe;

// If a widget has no parameter for quickly applying attributes, most widgets support manipulating their attributes by calling methods.
// Here, we set the additional class 'floatright' will be applied on a new Catbar.
$catbar = new Widgets\Catbar();
$catbar->setAdditionalClasses('floatright');
$catbar->insertChild(new Widgets\TextWidget('A floatright catbar!'));

// Here, we set the optional Alt attribute on the icon.
$icon = new Icon('help');
$icon->setAlt('This alternative text will be displayed when the icon is not available!');

// We can also get the Alt attribute we just set again.
$alt = $icon->getAlt();

template_footer();
```
Result:
![Sample output](https://raw.githubusercontent.com/Yoshi2889/smf-ui/master/sample_result.png)
