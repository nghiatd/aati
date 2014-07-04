
 ﻿/*
  2 Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
  3 For licensing, see LICENSE.html or http://ckeditor.com/license
  4 */
 /**
  7  * @fileOverview Defines the {@link CKEDITOR.editor} class, which represents an
  8  *		editor instance.
  9  */
 
 (function()
 {
 	// The counter for automatic instance names.
 	var nameCounter = 0;
 
 	var getNewName = function()
 	{
 		var name = 'editor' + ( ++nameCounter );
 		return ( CKEDITOR.instances && CKEDITOR.instances[ name ] ) ? getNewName() : name;
 	};
 
 	// ##### START: Config Privates
 
 	// These function loads custom configuration files and cache the
 	// CKEDITOR.editorConfig functions defined on them, so there is no need to
 	// download them more than once for several instances.
 	var loadConfigLoaded = {};
 	var loadConfig = function( editor )
 	{
 		var customConfig = editor.config.customConfig;
 
 		// Check if there is a custom config to load.
 		if ( !customConfig )
 			return false;
 
 		customConfig = CKEDITOR.getUrl( customConfig );
 
 		var loadedConfig = loadConfigLoaded[ customConfig ] || ( loadConfigLoaded[ customConfig ] = {} );
 
 		// If the custom config has already been downloaded, reuse it.
 		if ( loadedConfig.fn )
 		{
 			// Call the cached CKEDITOR.editorConfig defined in the custom
 			// config file for the editor instance depending on it.
 			loadedConfig.fn.call( editor, editor.config );
 
 			// If there is no other customConfig in the chain, fire the
 			// "configLoaded" event.
 			if ( CKEDITOR.getUrl( editor.config.customConfig ) == customConfig || !loadConfig( editor ) )
 				editor.fireOnce( 'customConfigLoaded' );
 		}
 		else
 		{
 			// Load the custom configuration file.
 			CKEDITOR.scriptLoader.load( customConfig, function()
 				{
 					// If the CKEDITOR.editorConfig function has been properly
 					// defined in the custom configuration file, cache it.
 					if ( CKEDITOR.editorConfig )
 						loadedConfig.fn = CKEDITOR.editorConfig;
 					else
 						loadedConfig.fn = function(){};
 
 					// Call the load config again. This time the custom
 					// config is already cached and so it will get loaded.
 					loadConfig( editor );
 				});
 		}
 
 		return true;
 	};
 
 	var initConfig = function( editor, instanceConfig )
 	{
 		// Setup the lister for the "customConfigLoaded" event.
 		editor.on( 'customConfigLoaded', function()
 			{
 				if ( instanceConfig )
 				{
 					// Register the events that may have been set at the instance
 					// configuration object.
 					if ( instanceConfig.on )
 					{
 						for ( var eventName in instanceConfig.on )
 						{
 							editor.on( eventName, instanceConfig.on[ eventName ] );
 						}
 					}
 
 					// Overwrite the settings from the in-page config.
 					CKEDITOR.tools.extend( editor.config, instanceConfig, true );
 
 					delete editor.config.on;
 				}
 
 				onConfigLoaded( editor );
 			});
 
 		// The instance config may override the customConfig setting to avoid
 		// loading the default ~/config.js file.
 		if ( instanceConfig && instanceConfig.customConfig != undefined )
 			editor.config.customConfig = instanceConfig.customConfig;
 
 		// Load configs from the custom configuration files.
 		if ( !loadConfig( editor ) )
 			editor.fireOnce( 'customConfigLoaded' );
 	};
 
 	// ##### END: Config Privates
 
 	var onConfigLoaded = function( editor )
 	{
 		// Set config related properties.
 
 		var skin = editor.config.skin.split( ',' ),
 			skinName = skin[ 0 ],
 			skinPath = CKEDITOR.getUrl( skin[ 1 ] || (
 				'_source/' +	// @Packager.RemoveLine
 				'skins/' + skinName + '/' ) );
 		/**
122 		 * The name of the skin used by this editor instance. The skin name can
123 		 * be set through the <code>{@link CKEDITOR.config.skin}</code> setting.
124 		 * @name CKEDITOR.editor.prototype.skinName
125 		 * @type String
126 		 * @example
127 		 * alert( editor.skinName );  // E.g. "kama"
128 		 */
 		editor.skinName = skinName;
 		/**
132 		 * The full URL of the skin directory.
133 		 * @name CKEDITOR.editor.prototype.skinPath
134 		 * @type String
135 		 * @example
136 		 * alert( editor.skinPath );  // E.g. "http://example.com/ckeditor/skins/kama/"
137 		 */
 		editor.skinPath = skinPath;
 		/**
141 		 * The CSS class name used for skin identification purposes.
142 		 * @name CKEDITOR.editor.prototype.skinClass
143 		 * @type String
144 		 * @example
145 		 * alert( editor.skinClass );  // E.g. "cke_skin_kama"
146 		 */
 		editor.skinClass = 'cke_skin_' + skinName;
 		/**
150 		 * The <a href="http://en.wikipedia.org/wiki/Tabbing_navigation">tabbing
151 		 * navigation</a> order that has been calculated for this editor
152 		 * instance. This can be set by the <code>{@link CKEDITOR.config.tabIndex}</code>
153 		 * setting or taken from the <code>tabindex</code> attribute of the
154 		 * <code>{@link #element}</code> associated with the editor.
155 		 * @name CKEDITOR.editor.prototype.tabIndex
156 		 * @type Number
157 		 * @default 0 (zero)
158 		 * @example
159 		 * alert( editor.tabIndex );  // E.g. "0"
160 		 */
 		editor.tabIndex = editor.config.tabIndex || editor.element.getAttribute( 'tabindex' ) || 0;
 		/**
164 		 * Indicates the read-only state of this editor. This is a read-only property.
165 		 * @name CKEDITOR.editor.prototype.readOnly
166 		 * @type Boolean
167 		 * @since 3.6
168 		 * @see CKEDITOR.editor#setReadOnly
169 		 */
 		editor.readOnly = !!( editor.config.readOnly || editor.element.getAttribute( 'disabled' ) );
 
 		// Fire the "configLoaded" event.
 		editor.fireOnce( 'configLoaded' );
 
 		// Load language file.
 		loadSkin( editor );
 	};
 
 	var loadLang = function( editor )
 	{
 		CKEDITOR.lang.load( editor.config.language, editor.config.defaultLanguage, function( languageCode, lang )
 			{
 				/**
184 				 * The code for the language resources that have been loaded
185 				 * for the user interface elements of this editor instance.
186 				 * @name CKEDITOR.editor.prototype.langCode
187 				 * @type String
188 				 * @example
189 				 * alert( editor.langCode );  // E.g. "en"
190 				 */
 				editor.langCode = languageCode;
 
 				/**
194 				 * An object that contains all language strings used by the editor
195 				 * interface.
196 				 * @name CKEDITOR.editor.prototype.lang
197 				 * @type CKEDITOR.lang
198 				 * @example
199 				 * alert( editor.lang.bold );  // E.g. "Negrito" (if the language is set to Portuguese)
200 				 */
 				// As we'll be adding plugin specific entries that could come
 				// from different language code files, we need a copy of lang,
 				// not a direct reference to it.
 				editor.lang = CKEDITOR.tools.prototypedCopy( lang );
 
 				// We're not able to support RTL in Firefox 2 at this time.
 				if ( CKEDITOR.env.gecko && CKEDITOR.env.version < 10900 && editor.lang.dir == 'rtl' )
 					editor.lang.dir = 'ltr';
 
 				editor.fire( 'langLoaded' );
 
 				var config = editor.config;
 				config.contentsLangDirection == 'ui' && ( config.contentsLangDirection = editor.lang.dir );
 
 				loadPlugins( editor );
 			});
 	};
 
 	var loadPlugins = function( editor )
 	{
 		var config			= editor.config,
 			plugins			= config.plugins,
 			extraPlugins	= config.extraPlugins,
 			removePlugins	= config.removePlugins;
 
 		if ( extraPlugins )
 		{
 			// Remove them first to avoid duplications.
 			var removeRegex = new RegExp( '(?:^|,)(?:' + extraPlugins.replace( /\s*,\s*/g, '|' ) + ')(?=,|$)' , 'g' );
 			plugins = plugins.replace( removeRegex, '' );
 
 			plugins += ',' + extraPlugins;
 		}
 
 		if ( removePlugins )
 		{
 			removeRegex = new RegExp( '(?:^|,)(?:' + removePlugins.replace( /\s*,\s*/g, '|' ) + ')(?=,|$)' , 'g' );
 			plugins = plugins.replace( removeRegex, '' );
 		}
 
 		// Load the Adobe AIR plugin conditionally.
 		CKEDITOR.env.air && ( plugins += ',adobeair' );
 
 		// Load all plugins defined in the "plugins" setting.
 		CKEDITOR.plugins.load( plugins.split( ',' ), function( plugins )
 			{
 				// The list of plugins.
 				var pluginsArray = [];
 
 				// The language code to get loaded for each plugin. Null
 				// entries will be appended for plugins with no language files.
 				var languageCodes = [];
 
 				// The list of URLs to language files.
				var languageFiles = [];

 				/**
258 				 * An object that contains references to all plugins used by this
259 				 * editor instance.
260 				 * @name CKEDITOR.editor.prototype.plugins
261 				 * @type Object
262 				 * @example
263 				 * alert( editor.plugins.dialog.path );  // E.g. "http://example.com/ckeditor/plugins/dialog/"
264 				 */
 				editor.plugins = plugins;
 
 				// Loop through all plugins, to build the list of language
 				// files to get loaded.
 				for ( var pluginName in plugins )
 				{
 					var plugin = plugins[ pluginName ],
 						pluginLangs = plugin.lang,
 						pluginPath = CKEDITOR.plugins.getPath( pluginName ),
 						lang = null;
 
 					// Set the plugin path in the plugin.
 					plugin.path = pluginPath;

 					// If the plugin has "lang".
 					if ( pluginLangs )
 					{
 						// Resolve the plugin language. If the current language
						// is not available, get the first one (default one).
 						lang = ( CKEDITOR.tools.indexOf( pluginLangs, editor.langCode ) >= 0 ? editor.langCode : pluginLangs[ 0 ] );
 
 						if ( !plugin.langEntries || !plugin.langEntries[ lang ] )
 						{
							// Put the language file URL into the list of files to
 							// get downloaded.
 							languageFiles.push( CKEDITOR.getUrl( pluginPath + 'lang/' + lang + '.js' ) );
 						}
 						else
 						{
 							CKEDITOR.tools.extend( editor.lang, plugin.langEntries[ lang ] );
 							lang = null;
 						}
 					}
 
 					// Save the language code, so we know later which
 					// language has been resolved to this plugin.
 					languageCodes.push( lang );
 
 					pluginsArray.push( plugin );
 				}
 
 				// Load all plugin specific language files in a row.
 				CKEDITOR.scriptLoader.load( languageFiles, function()
 					{
 						// Initialize all plugins that have the "beforeInit" and "init" methods defined.
 						var methods = [ 'beforeInit', 'init', 'afterInit' ];
 						for ( var m = 0 ; m < methods.length ; m++ )
 						{
 							for ( var i = 0 ; i < pluginsArray.length ; i++ )
 							{
 								var plugin = pluginsArray[ i ];
 
 								// Uses the first loop to update the language entries also.
 								if ( m === 0 && languageCodes[ i ] && plugin.lang )
									CKEDITOR.tools.extend( editor.lang, plugin.langEntries[ languageCodes[ i ] ] );
 
 								// Call the plugin method (beforeInit and init).
 								if ( plugin[ methods[ m ] ] )
 									plugin[ methods[ m ] ]( editor );
 							}
 						}
 
 						// Load the editor skin.
 						editor.fire( 'pluginsLoaded' );
 						loadTheme( editor );
 					});
			});
 	};
 
 	var loadSkin = function( editor )
 	{
 		CKEDITOR.skins.load( editor, 'editor', function()
 			{
 				loadLang( editor );
 			});
 	};
 
 	var loadTheme = function( editor )
 	{
 		var theme = editor.config.theme;
 		CKEDITOR.themes.load( theme, function()
 			{
 				/**
348 				 * The theme used by this editor instance.
349 				 * @name CKEDITOR.editor.prototype.theme
350 				 * @type CKEDITOR.theme
351 				 * @example
352 				 * alert( editor.theme );  // E.g. "http://example.com/ckeditor/themes/default/"
353 				 */
 				var editorTheme = editor.theme = CKEDITOR.themes.get( theme );
 				editorTheme.path = CKEDITOR.themes.getPath( theme );
 				editorTheme.build( editor );
 
 				if ( editor.config.autoUpdateElement )
 					attachToForm( editor );
 			});
 	};
 
 	var attachToForm = function( editor )
 	{
		var element = editor.element;
 
 		// If are replacing a textarea, we must
 		if ( editor.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE && element.is( 'textarea' ) )
 		{
 			var form = element.$.form && new CKEDITOR.dom.element( element.$.form );
 			if ( form )
 			{
 				function onSubmit()
 				{
 					editor.updateElement();
 				}
 				form.on( 'submit',onSubmit );
 
 				// Setup the submit function because it doesn't fire the
 				// "submit" event.
 				if ( !form.$.submit.nodeName && !form.$.submit.length )
 				{
 					form.$.submit = CKEDITOR.tools.override( form.$.submit, function( originalSubmit )
						{
 							return function()
 								{
 									editor.updateElement();
 
 									// For IE, the DOM submit function is not a
 									// function, so we need thid check.
 									if ( originalSubmit.apply )
 										originalSubmit.apply( this, arguments );
 									else
 										originalSubmit();
 								};
 						});
 				}
 
 				// Remove 'submit' events registered on form element before destroying.(#3988)
 				editor.on( 'destroy', function()
 				{
 					form.removeListener( 'submit', onSubmit );
 				} );
 			}
		}
 	};
 
 	function updateCommands()
 	{
 		var command,
 			commands = this._.commands,
 			mode = this.mode;
 
 		if ( !mode )
 			return;
 
 		for ( var name in commands )
 		{
 			command = commands[ name ];
 			command[ command.startDisabled ? 'disable' :
 					 this.readOnly && !command.readOnly ? 'disable' : command.modes[ mode ] ? 'enable' : 'disable' ]();
 		}
 	}
 
	/**
426 	 * Initializes the editor instance. This function is called by the editor
427 	 * contructor (<code>editor_basic.js</code>).
428 	 * @private
429 	 */
 	CKEDITOR.editor.prototype._init = function()
 		{
 			// Get the properties that have been saved in the editor_base
 			// implementation.
 			var element			= CKEDITOR.dom.element.get( this._.element ),
				instanceConfig	= this._.instanceConfig;
 			delete this._.element;
 			delete this._.instanceConfig;
 
			this._.commands = {};
			this._.styles = [];
 			/**
443 			 * The DOM element that was replaced by this editor instance. This
444 			 * element stores the editor data on load and post.
445 			 * @name CKEDITOR.editor.prototype.element
446 			 * @type CKEDITOR.dom.element
447 			 * @example
448 			 * var editor = CKEDITOR.instances.editor1;
449 			 * alert( <strong>editor.element</strong>.getName() );  // E.g. "textarea"
450 			 */
 			this.element = element;
 			/**
454 			 * The editor instance name. It may be the replaced element ID, name, or
455 			 * a default name using the progressive counter (<code>editor1</code>,
456 			 * <code>editor2</code>, ...).
457 			 * @name CKEDITOR.editor.prototype.name
458 			 * @type String
459 			 * @example
460 			 * var editor = CKEDITOR.instances.editor1;
461 			 * alert( <strong>editor.name</strong> );  // "editor1"
462 			 */
 			this.name = ( element && ( this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
							&& ( element.getId() || element.getNameAtt() ) )
						|| getNewName();

 			if ( this.name in CKEDITOR.instances )
 				throw '[CKEDITOR.editor] The instance "' + this.name + '" already exists.';
 			/**
471 			 * A unique random string assigned to each editor instance on the page.
472 			 * @name CKEDITOR.editor.prototype.id
473 			 * @type String
474 			 */
 			this.id = CKEDITOR.tools.getNextId();
 			/**
478 			 * The configurations for this editor instance. It inherits all
479 			 * settings defined in <code>(@link CKEDITOR.config}</code>, combined with settings
480 			 * loaded from custom configuration files and those defined inline in
481 			 * the page when creating the editor.
482 			 * @name CKEDITOR.editor.prototype.config
483 			 * @type Object
484 			 * @example
485 			 * var editor = CKEDITOR.instances.editor1;
486 			 * alert( <strong>editor.config.theme</strong> );  // E.g. "default"
487 			 */
 			this.config = CKEDITOR.tools.prototypedCopy( CKEDITOR.config );
 
 			/**
491 			 * The namespace containing UI features related to this editor instance.
492 			 * @name CKEDITOR.editor.prototype.ui
493 			 * @type CKEDITOR.ui
494 			 * @example
495 			 */
 			this.ui = new CKEDITOR.ui( this );
 
 			/**
499 			 * Controls the focus state of this editor instance. This property
500 			 * is rarely used for normal API operations. It is mainly
501 			 * intended for developers adding UI elements to the editor interface.
502 			 * @name CKEDITOR.editor.prototype.focusManager
503 			 * @type CKEDITOR.focusManager
504 			 * @example
505 			 */
 			this.focusManager = new CKEDITOR.focusManager( this );
 
 			CKEDITOR.fire( 'instanceCreated', null, this );
 
 			this.on( 'mode', updateCommands, null, null, 1 );
 			this.on( 'readOnly', updateCommands, null, null, 1 );
 
 			initConfig( this, instanceConfig );
 		};
 })();
 
 CKEDITOR.tools.extend( CKEDITOR.editor.prototype,
 	/** @lends CKEDITOR.editor.prototype */
 	{
 		/**
521 		 * Adds a command definition to the editor instance. Commands added with
522 		 * this function can be executed later with the <code>{@link #execCommand}</code> method.
523 		 * @param {String} commandName The indentifier name of the command.
524 		 * @param {CKEDITOR.commandDefinition} commandDefinition The command definition.
525 		 * @example
526 		 * editorInstance.addCommand( 'sample',
527 		 * {
528 		 *     exec : function( editor )
529 		 *     {
530 		 *         alert( 'Executing a command for the editor name "' + editor.name + '"!' );
531 		 *     }
532 		 * });
533 		 */
 		addCommand : function( commandName, commandDefinition )
 		{
 			return this._.commands[ commandName ] = new CKEDITOR.command( this, commandDefinition );
 		},
 		/**
540 		 * Adds a piece of CSS code to the editor which will be applied to the WYSIWYG editing document.
541 		 * This CSS would not be added to the output, and is there mainly for editor-specific editing requirements.
542 		 * Note: This function should be called before the editor is loaded to take effect.
543 		 * @param css {String} CSS text.
544 		 * @example
545 		 * editorInstance.addCss( 'body { background-color: grey; }' );
546 		 */
 		addCss : function( css )
 		{
 			this._.styles.push( css );
 		},
 		/**
553 		 * Destroys the editor instance, releasing all resources used by it.
554 		 * If the editor replaced an element, the element will be recovered.
555 		 * @param {Boolean} [noUpdate] If the instance is replacing a DOM
556 		 *		element, this parameter indicates whether or not to update the
557 		 *		element with the instance contents.
558 		 * @example
559 		 * alert( CKEDITOR.instances.editor1 );  //  E.g "object"
560 		 * <strong>CKEDITOR.instances.editor1.destroy()</strong>;
561 		 * alert( CKEDITOR.instances.editor1 );  // "undefined"
562 		 */
 		destroy : function( noUpdate )
 		{
 			if ( !noUpdate )
 				this.updateElement();
 
 			this.fire( 'destroy' );
 			this.theme && this.theme.destroy( this );
 
			CKEDITOR.remove( this );
 			CKEDITOR.fire( 'instanceDestroyed', null, this );
 		},
 
 		/**
576 		 * Executes a command associated with the editor.
577 		 * @param {String} commandName The indentifier name of the command.
578 		 * @param {Object} [data] Data to be passed to the command.
579 		 * @returns {Boolean} <code>true</code> if the command was executed
580 		 *		successfully, otherwise <code>false</code>.
581 		 * @see CKEDITOR.editor.addCommand
582 		 * @example
583 		 * editorInstance.execCommand( 'bold' );
584 		 */
 		execCommand : function( commandName, data )
		{
			var command = this.getCommand( commandName );
 
			var eventData =
 			{
 				name: commandName,
 				commandData: data,
 				command: command
 			};
 
 			if ( command && command.state != CKEDITOR.TRISTATE_DISABLED )
 			{
 				if ( this.fire( 'beforeCommandExec', eventData ) !== true )
 				{
 					eventData.returnValue = command.exec( eventData.commandData );
 
 					// Fire the 'afterCommandExec' immediately if command is synchronous.
 					if ( !command.async && this.fire( 'afterCommandExec', eventData ) !== true )
 						return eventData.returnValue;
 				}
			}
 
 			// throw 'Unknown command name "' + commandName + '"';
 			return false;
 		},
 		/**
613 		 * Gets one of the registered commands. Note that after registering a
614 		 * command definition with <code>{@link #addCommand}</code>, it is
615 		 * transformed internally into an instance of
616 		 * <code>{@link CKEDITOR.command}</code>, which will then be returned
617 		 * by this function.
618 		 * @param {String} commandName The name of the command to be returned.
619 		 * This is the same name that is used to register the command with
620 		 * 		<code>addCommand</code>.
621 		 * @returns {CKEDITOR.command} The command object identified by the
622 		 * provided name.
623 		 */
 		getCommand : function( commandName )
 		{
 			return this._.commands[ commandName ];
 		},
 		/**
630 		 * Gets the editor data. The data will be in raw format. It is the same
631 		 * data that is posted by the editor.
632 		 * @type String
633 		 * @returns (String) The editor data.
634 		 * @example
635 		 * if ( CKEDITOR.instances.editor1.<strong>getData()</strong> == '' )
636 		 *     alert( 'There is no data available' );
637 		 */
 		getData : function()
 		{
 			this.fire( 'beforeGetData' );
			var eventData = this._.data;

 			if ( typeof eventData != 'string' )
 			{
 				var element = this.element;
 				if ( element && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
 					eventData = element.is( 'textarea' ) ? element.getValue() : element.getHtml();
 				else
					eventData = '';
 			}
 
 			eventData = { dataValue : eventData };
 
 			// Fire "getData" so data manipulation may happen.
 			this.fire( 'getData', eventData );
 
 			return eventData.dataValue;
 		},
 
 		/**
662 		 * Gets the "raw data" currently available in the editor. This is a
663 		 * fast method which returns the data as is, without processing, so it is
664 		 * not recommended to use it on resulting pages. Instead it can be used
665 		 * combined with the <code>{@link #loadSnapshot}</code> method in order
666 		 * to be able to automatically save the editor data from time to time
667 		 * while the user is using the editor, to avoid data loss, without risking
668 		 * performance issues.
669 		 * @see CKEDITOR.editor.getData
670 		 * @example
671 		 * alert( editor.getSnapshot() );
672 		 */
 		getSnapshot : function()
 		{
 			var data = this.fire( 'getSnapshot' );
 
 			if ( typeof data != 'string' )
 			{
 				var element = this.element;
 				if ( element && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
 					data = element.is( 'textarea' ) ? element.getValue() : element.getHtml();
 			}
 
 			return data;
		},
 
 		/**
688 		 * Loads "raw data" into the editor. The data is loaded with processing
689 		 * straight to the editing area. It should not be used as a way to load
690 		 * any kind of data, but instead in combination with
691 		 * <code>{@link #getSnapshot}</code> produced data.
692 		 * @see CKEDITOR.editor.setData
693 		 * @example
694 		 * var data = editor.getSnapshot();
695 		 * editor.<strong>loadSnapshot( data )</strong>;
696 		 */
 		loadSnapshot : function( snapshot )
 		{
 			this.fire( 'loadSnapshot', snapshot );
 		},
 
 		/**
703 		 * Sets the editor data. The data must be provided in the raw format (HTML).<br />
704 		 * <br />
705 		 * Note that this method is asynchronous. The <code>callback</code> parameter must
706 		 * be used if interaction with the editor is needed after setting the data.
707 		 * @param {String} data HTML code to replace the curent content in the
708 		 *		editor.
709 		 * @param {Function} callback Function to be called after the <code>setData</code>
710 		 *		is completed.
711 		 *@param {Boolean} internal Whether to suppress any event firing when copying data
712 		 *		internally inside the editor.
713 		 * @example
714 		 * CKEDITOR.instances.editor1.<strong>setData</strong>( '<p>This is the editor data.</p>' );
715 		 * @example
716 		 * CKEDITOR.instances.editor1.<strong>setData</strong>( '<p>Some other editor data.</p>', function()
717 		 *     {
718 		 *         this.checkDirty();  // true
719 		 *     });
720 		 */
 		setData : function( data , callback, internal )
 		{
 			if( callback )
 			{
 				this.on( 'dataReady', function( evt )
 				{
 					evt.removeListener();
 					callback.call( evt.editor );
 				} );
 			}
 
 			// Fire "setData" so data manipulation may happen.
 			var eventData = { dataValue : data };
 			!internal && this.fire( 'setData', eventData );
 
 			this._.data = eventData.dataValue;
 
 			!internal && this.fire( 'afterSetData', eventData );
 		},
 		/**
742 		 * Puts or restores the editor into read-only state. When in read-only,
743 		 * the user is not able to change the editor contents, but can still use
744 		 * some editor features. This function sets the <code>{@link CKEDITOR.config.readOnly}</code>
745 		 * property of the editor, firing the <code>{@link CKEDITOR.editor#readOnly}</code> event.<br><br>
746 		 * <strong>Note:</strong> the current editing area will be reloaded.
747 		 * @param {Boolean} [isReadOnly] Indicates that the editor must go
748 		 *		read-only (<code>true</code>, default) or be restored and made editable
749 		 * 		(<code>false</code>).
750 		 * @since 3.6
751 		 */
 		setReadOnly : function( isReadOnly )
 		{
 			isReadOnly = ( isReadOnly == undefined ) || isReadOnly;
 
 			if ( this.readOnly != isReadOnly )
 			{
 				this.readOnly = isReadOnly;
 
 				// Fire the readOnly event so the editor features can update
 				// their state accordingly.
 				this.fire( 'readOnly' );
 			}
		},
 
 		/**
767 		 * Inserts HTML code into the currently selected position in the editor in WYSIWYG mode.
768 		 * @param {String} data HTML code to be inserted into the editor.
769 		 * @example
770 		 * CKEDITOR.instances.editor1.<strong>insertHtml( '<p>This is a new paragraph.</p>' )</strong>;
771 		 */
 		insertHtml : function( data )
 		{
 			this.fire( 'insertHtml', data );
		},

 		/**
778 		 * Insert text content into the currently selected position in the
779 		 * editor in WYSIWYG mode. The styles of the selected element will be applied to the inserted text.
780 		 * Spaces around the text will be leaving untouched.
781 		 * <strong>Note:</strong> two subsequent line-breaks will introduce one paragraph. This depends on <code>{@link CKEDITOR.config.enterMode}</code>;
782 		 * A single line-break will be instead translated into one <br />.
783 		 * @since 3.5
784 		 * @param {String} text Text to be inserted into the editor.
785 		 * @example
786 		 * CKEDITOR.instances.editor1.<strong>insertText( ' line1 \n\n line2' )</strong>;
787 		 */
 		insertText : function( text )
 		{
 			this.fire( 'insertText', text );
 		},
 		/**
794 		 * Inserts an element into the currently selected position in the
795 		 * editor in WYSIWYG mode.
796 		 * @param {CKEDITOR.dom.element} element The element to be inserted
797 		 *		into the editor.
798 		 * @example
799 		 * var element = CKEDITOR.dom.element.createFromHtml( '<img src="hello.png" border="0" title="Hello" />' );
800 		 * CKEDITOR.instances.editor1.<strong>insertElement( element )</strong>;
801 		 */
 		insertElement : function( element )
 		{
 			this.fire( 'insertElement', element );
 		},
 
 		/**
808 		 * Checks whether the current editor contents contain changes when
809 		 * compared to the contents loaded into the editor at startup, or to
810 		 * the contents available in the editor when <code>{@link #resetDirty}</code>
811 		 * was called.
812 		 * @returns {Boolean} "true" is the contents contain changes.
813 		 * @example
814 		 * function beforeUnload( e )
815 		 * {
816 		 *     if ( CKEDITOR.instances.editor1.<strong>checkDirty()</strong> )
817 		 * 	        return e.returnValue = "You will lose the changes made in the editor.";
818 		 * }
819 		 *
820 		 * if ( window.addEventListener )
821 		 *     window.addEventListener( 'beforeunload', beforeUnload, false );
822 		 * else
823 		 *     window.attachEvent( 'onbeforeunload', beforeUnload );
824 		 */
 		checkDirty : function()
 		{
 			return ( this.mayBeDirty && this._.previousValue !== this.getSnapshot() );
 		},
 
 		/**
831 		 * Resets the "dirty state" of the editor so subsequent calls to
832 		 * <code>{@link #checkDirty}</code> will return <code>false</code> if the user will not
833 		 * have made further changes to the contents.
834 		 * @example
835 		 * alert( editor.checkDirty() );  // E.g. "true"
836 		 * editor.<strong>resetDirty()</strong>;
837 		 * alert( editor.checkDirty() );  // "false"
838 		 */
 		resetDirty : function()
		{
 			if ( this.mayBeDirty )
 				this._.previousValue = this.getSnapshot();
 		},
 
 		/**
846 		 * Updates the <code><textarea></code> element that was replaced by the editor with
847 		 * the current data available in the editor.
848 		 * @see CKEDITOR.editor.element
849 		 * @example
850 		 * CKEDITOR.instances.editor1.updateElement();
851 		 * alert( document.getElementById( 'editor1' ).value );  // The current editor data.
852 		 */
 		updateElement : function()
 		{
 			var element = this.element;
 			if ( element && this.elementMode == CKEDITOR.ELEMENT_MODE_REPLACE )
 			{
 				var data = this.getData();
 
 				if ( this.config.htmlEncodeOutput )
 					data = CKEDITOR.tools.htmlEncode( data );
 
 				if ( element.is( 'textarea' ) )
 					element.setValue( data );
 				else
 					element.setHtml( data );
 			}
 		}
 	});
 
 CKEDITOR.on( 'loaded', function()
	{
 		// Run the full initialization for pending editors.
 		var pending = CKEDITOR.editor._pending;
		if ( pending )
 		{
 			delete CKEDITOR.editor._pending;
 
 			for ( var i = 0 ; i < pending.length ; i++ )
				pending[ i ]._init();
 		}
 	});
 /**
885  * Whether to escape HTML when the editor updates the original input element.
886  * @name CKEDITOR.config.htmlEncodeOutput
887  * @since 3.1
888  * @type Boolean
889  * @default false
890  * @example
891  * config.htmlEncodeOutput = true;
892  */
 /**
895  * If <code>true</code>, makes the editor start in read-only state. Otherwise, it will check
896  * if the linked <code><textarea></code> element has the <code>disabled</code> attribute.
897  * @name CKEDITOR.config.readOnly
898  * @see CKEDITOR.editor#setReadOnly
899  * @type Boolean
900  * @default false
901  * @since 3.6
902  * @example
903  * config.readOnly = true;
904  */
 /**
907  * Fired when a CKEDITOR instance is created, but still before initializing it.
908  * To interact with a fully initialized instance, use the
909  * <code>{@link CKEDITOR#instanceReady}</code> event instead.
910  * @name CKEDITOR#instanceCreated
911  * @event
912  * @param {CKEDITOR.editor} editor The editor instance that has been created.
913  */
 /**
916  * Fired when a CKEDITOR instance is destroyed.
917  * @name CKEDITOR#instanceDestroyed
918  * @event
919  * @param {CKEDITOR.editor} editor The editor instance that has been destroyed.
920  */
 /**
923  * Fired when the language is loaded into the editor instance.
924  * @name CKEDITOR.editor#langLoaded
925  * @event
926  * @since 3.6.1
927  * @param {CKEDITOR.editor} editor This editor instance.
928  */
 /**
931  * Fired when all plugins are loaded and initialized into the editor instance.
932  * @name CKEDITOR.editor#pluginsLoaded
933  * @event
934  * @param {CKEDITOR.editor} editor This editor instance.
935  */
 /**
938  * Fired before the command execution when <code>{@link #execCommand}</code> is called.
939  * @name CKEDITOR.editor#beforeCommandExec
940  * @event
941  * @param {CKEDITOR.editor} editor This editor instance.
942  * @param {String} data.name The command name.
943  * @param {Object} data.commandData The data to be sent to the command. This
944  *		can be manipulated by the event listener.
945  * @param {CKEDITOR.command} data.command The command itself.
946  */
 /**
949  * Fired after the command execution when <code>{@link #execCommand}</code> is called.
950  * @name CKEDITOR.editor#afterCommandExec
951  * @event
952  * @param {CKEDITOR.editor} editor This editor instance.
953  * @param {String} data.name The command name.
954  * @param {Object} data.commandData The data sent to the command.
955  * @param {CKEDITOR.command} data.command The command itself.
956  * @param {Object} data.returnValue The value returned by the command execution.
957  */
 /**
960  * Fired when the custom configuration file is loaded, before the final
961  * configurations initialization.<br />
962  * <br />
963  * Custom configuration files can be loaded thorugh the
964  * <code>{@link CKEDITOR.config.customConfig}</code> setting. Several files can be loaded
965  * by changing this setting.
966  * @name CKEDITOR.editor#customConfigLoaded
967  * @event
968  * @param {CKEDITOR.editor} editor This editor instance.
969  */
 /**
972  * Fired once the editor configuration is ready (loaded and processed).
973  * @name CKEDITOR.editor#configLoaded
974  * @event
975  * @param {CKEDITOR.editor} editor This editor instance.
976  */
 /**
979  * Fired when this editor instance is destroyed. The editor at this
980  * point is not usable and this event should be used to perform the clean-up
981  * in any plugin.
982  * @name CKEDITOR.editor#destroy
983  * @event
984  */
 /**
987  * Internal event to get the current data.
988  * @name CKEDITOR.editor#beforeGetData
989  * @event
990  */
 /**
993  * Internal event to perform the <code>#getSnapshot</code> call.
994  * @name CKEDITOR.editor#getSnapshot
995  * @event
996  */
 /**
999  * Internal event to perform the <code>#loadSnapshot</code> call.
1000  * @name CKEDITOR.editor#loadSnapshot
1001  * @event
1002  */
 /**
1005  * Event fired before the <code>#getData</code> call returns allowing additional manipulation.
1006  * @name CKEDITOR.editor#getData
1007  * @event
1008  * @param {CKEDITOR.editor} editor This editor instance.
1009  * @param {String} data.dataValue The data that will be returned.
1010  */
 /**
1013  * Event fired before the <code>#setData</code> call is executed allowing additional manipulation.
1014  * @name CKEDITOR.editor#setData
1015  * @event
1016  * @param {CKEDITOR.editor} editor This editor instance.
1017  * @param {String} data.dataValue The data that will be used.
1018  */
/**
1021  * Event fired at the end of the <code>#setData</code> call execution. Usually it is better to use the
1022  * <code>{@link CKEDITOR.editor.prototype.dataReady}</code> event.
1023  * @name CKEDITOR.editor#afterSetData
1024  * @event
1025  * @param {CKEDITOR.editor} editor This editor instance.
1026  * @param {String} data.dataValue The data that has been set.
1027  */
 /**
1030  * Internal event to perform the <code>#insertHtml</code> call
1031  * @name CKEDITOR.editor#insertHtml
1032  * @event
1033  * @param {CKEDITOR.editor} editor This editor instance.
1034  * @param {String} data The HTML to insert.
1035  */
 /**
1038  * Internal event to perform the <code>#insertText</code> call
1039  * @name CKEDITOR.editor#insertText
1040  * @event
1041  * @param {CKEDITOR.editor} editor This editor instance.
1042  * @param {String} text The text to insert.
1043  */
 /**
1046  * Internal event to perform the <code>#insertElement</code> call
1047  * @name CKEDITOR.editor#insertElement
1048  * @event
1049  * @param {CKEDITOR.editor} editor This editor instance.
1050  * @param {Object} element The element to insert.
1051  */
 /**
1054  * Event fired after the <code>{@link CKEDITOR.editor#readOnly}</code> property changes.
1055  * @name CKEDITOR.editor#readOnly
1056  * @event
1057  * @since 3.6
1058  * @param {CKEDITOR.editor} editor This editor instance.
1059  */
