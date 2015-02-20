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
