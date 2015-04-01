<?php

/*
	SMFUI - Object-oriented UI framework for SMF

	Copyright (c) 2015 Rick Kerkhof

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all
	copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
	SOFTWARE.
*/

namespace SMFUI;

class Autoloader
{
	/**
	 * Load the class specified.
	 * @param string $class The class name.
	 * @return bool
	 */
	public static function load($class)
	{
		global $sourcedir, $settings;

		// Get the class name and path.
		$name = this::getClassName($class);
		$path = this::getClassPath($class);

		$paths = array(
			$sourcedir . '/' . $path . $name,
			$settings['actual_theme_dir'] . '/' . $path . $name,
		);
		
		return this::tryLoadFiles($paths);
	}
	
	/**
	 * Get the class path.
	 * @param string $class
	 * @return string
	 */
	public static function getClassPath($class)
	{
		$class = explode('\\', $class);
		$classpath = $class;
		array_pop($classpath);

		// Assemble path
		return implode('/', $classpath) . '/';
	}
	
	/**
	 * Get the class name.
	 * @param stirng $class
	 * @return string
	 */
	public static function getClassName($class)
	{
		$pieces = explode('\\', $class);
		return end($pieces);
	}
	
	/**
	 * Try and load files.
	 * @param array $paths The paths to the files to try.
	 * @return boolean True on success, false on failure.
	 */
	public static function tryLoadFiles($paths)
	{
		foreach ($paths as $path)
		{
			if (!file_exists($path))
				continue;

			require $path;
			return true;
		}

		return false;
	}
}
