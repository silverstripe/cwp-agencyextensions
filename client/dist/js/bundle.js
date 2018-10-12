/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports) {

module.exports = Injector;

/***/ }),
/* 1 */
/***/ (function(module, exports) {

module.exports = React;

/***/ }),
/* 2 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_boot_registerComponents__ = __webpack_require__(4);




window.document.addEventListener('DOMContentLoaded', function () {
  __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_0_boot_registerComponents__["a" /* default */])();
});

/***/ }),
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery__ = __webpack_require__(8);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_jquery___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_jquery__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_react__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_react___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_react__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_react_dom__ = __webpack_require__(7);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_react_dom___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_react_dom__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_lib_Injector__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3_lib_Injector___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3_lib_Injector__);





__WEBPACK_IMPORTED_MODULE_0_jquery___default.a.entwine('ss', function ($) {
  $('.js-injector-boot .color-picker-field').entwine({
    onmatch: function onmatch() {
      var ColorPickerComponent = __webpack_require__.i(__WEBPACK_IMPORTED_MODULE_3_lib_Injector__["loadComponent"])('ColorPickerField');
      var schemaData = this.data('schema');

      var props = {
        colors: schemaData.source
      };

      __WEBPACK_IMPORTED_MODULE_2_react_dom___default.a.render(__WEBPACK_IMPORTED_MODULE_1_react___default.a.createElement(ColorPickerComponent, props), this[0]);
    },
    onunmatch: function onunmatch() {
      __WEBPACK_IMPORTED_MODULE_2_react_dom___default.a.unmountComponentAtNode(this[0]);
    }
  });
});

/***/ }),
/* 4 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lib_Injector__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_lib_Injector___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_lib_Injector__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_components_ColorPickerField_ColorPickerField__ = __webpack_require__(6);



/* harmony default export */ __webpack_exports__["a"] = (function () {
  __WEBPACK_IMPORTED_MODULE_0_lib_Injector___default.a.component.registerMany({
    ColorPickerField: __WEBPACK_IMPORTED_MODULE_1_components_ColorPickerField_ColorPickerField__["a" /* default */]
  });
});

/***/ }),
/* 5 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(3);
__webpack_require__(2);

/***/ }),
/* 6 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_react__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0_react___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0_react__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_lib_Injector__ = __webpack_require__(0);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1_lib_Injector___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1_lib_Injector__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_i18n__ = __webpack_require__(9);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2_i18n___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2_i18n__);
var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }





var ColorPickerField = function (_Component) {
  _inherits(ColorPickerField, _Component);

  function ColorPickerField(props) {
    _classCallCheck(this, ColorPickerField);

    return _possibleConstructorReturn(this, (ColorPickerField.__proto__ || Object.getPrototypeOf(ColorPickerField)).call(this, props));
  }

  _createClass(ColorPickerField, [{
    key: 'render',
    value: function render() {
      var _props = this.props,
          PopoverOptionSetComponent = _props.PopoverOptionSetComponent,
          colors = _props.colors;


      var buttons = colors.map(function (_ref) {
        var Title = _ref.Title,
            Color = _ref.Color,
            CSSClass = _ref.CSSClass;
        return {
          key: CSSClass,
          text: Title,
          className: 'hex-' + Color
        };
      });

      console.log(buttons);

      return __WEBPACK_IMPORTED_MODULE_0_react___default.a.createElement(PopoverOptionSetComponent, {
        buttons: buttons,
        onButtonClick: this.handleButtonClick,
        searchPlaceholder: __WEBPACK_IMPORTED_MODULE_2_i18n___default.a._t('AddElementPopover.SEARCH_BLOCKS', 'Search blocks'),
        extraClass: popoverClassNames,
        container: container,
        isOpen: isOpen,
        placement: placement,
        target: target,
        toggle: this.handleToggle
      });
    }
  }]);

  return ColorPickerField;
}(__WEBPACK_IMPORTED_MODULE_0_react__["Component"]);

/* harmony default export */ __webpack_exports__["a"] = (__webpack_require__.i(__WEBPACK_IMPORTED_MODULE_1_lib_Injector__["inject"])(['PopoverOptionSet'], function (PopoverOptionSetComponent) {
  return { PopoverOptionSetComponent: PopoverOptionSetComponent };
}, function () {
  return 'ColorPickerField';
})(ColorPickerField));

/***/ }),
/* 7 */
/***/ (function(module, exports) {

module.exports = ReactDom;

/***/ }),
/* 8 */
/***/ (function(module, exports) {

module.exports = jQuery;

/***/ }),
/* 9 */
/***/ (function(module, exports) {

module.exports = i18n;

/***/ })
/******/ ]);
//# sourceMappingURL=bundle.js.map