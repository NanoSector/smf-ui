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
