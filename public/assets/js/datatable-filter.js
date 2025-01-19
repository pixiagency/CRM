// function objectifyForm(formArray) {
//     //serialize data function
//     var returnArray = {};
//     for (var i = 0; i < formArray.length; i++){
//         returnArray[formArray[i]['name']] = formArray[i]['value'];
//     }
//     return returnArray;
// }
// const table = $(".table-data");

// $('.search_datatable').on('click',function (event) {
//     event.preventDefault();
//     table.on('preXhr.dt',function (e,settings,data) {
//         data.filters = objectifyForm($('.datatables_parameters').serializeArray());
//     });
//     table.DataTable().ajax.reload();
//     return false ;
// });

// $('.reset_form_data').on('click',function (event) {
//     event.preventDefault();
//     table.on('preXhr.dt',function (e,settings,data) {
//         $('.datatables_parameters')[0].reset();
//         data.filters = [];
//     });
//     table.DataTable().ajax.reload();
//     return false ;
// });




/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/assets/js/datatable-filter.js":
/*!*************************************************!*\
  !*** ./resources/assets/js/datatable-filter.js ***!
  \*************************************************/
/***/ (() => {

function objectifyForm(formArray) {
  //serialize data function
  var returnArray = {};

  for (var i = 0; i < formArray.length; i++) {
    returnArray[formArray[i]['name']] = formArray[i]['value'];
  }

  return returnArray;
}

var table = $(".table-data");
$('.search_datatable').on('click', function (event) {
  event.preventDefault();
  table.on('preXhr.dt', function (e, settings, data) {
    data.filters = objectifyForm($('.datatables_parameters').serializeArray());
  });
  table.DataTable().ajax.reload();
  return false;
});
$('.reset_form_data').on('click', function (event) {
  event.preventDefault();
  table.on('preXhr.dt', function (e, settings, data) {
    $('.datatables_parameters')[0].reset();
    data.filters = [];
  });
  table.DataTable().ajax.reload();
  return false;
});

/////////////// test ////////////////////////
// function showAllFormData() {
//   var formData = $('.datatables_parameters').serializeArray();

//   // Create a container to display the values
//   var valuesContainer = $('#formValues');
//   valuesContainer.empty();

//   formData.forEach(function(field) {
//       valuesContainer.append(field.name + ': ' + field.value + '<br>');
//   });
// }

// $('.show_all_values').on('click', function() {
//   showAllFormData();
// });

/***/ }),

/***/ "./resources/assets/css/style-dark.scss":
/*!**********************************************!*\
  !*** ./resources/assets/css/style-dark.scss ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/css/skin-modes.scss":
/*!**********************************************!*\
  !*** ./resources/assets/css/skin-modes.scss ***!
  \**********************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/css/style-transparent.scss":
/*!*****************************************************!*\
  !*** ./resources/assets/css/style-transparent.scss ***!
  \*****************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/scss/style.scss":
/*!******************************************!*\
  !*** ./resources/assets/scss/style.scss ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/assets/css/animate.css":
/*!******************************************!*\
  !*** ./resources/assets/css/animate.css ***!
  \******************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	})();
/******/
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/assets/js/datatable-filter": 0,
/******/ 			"assets/css/style": 0,
/******/ 			"assets/css/animate": 0,
/******/ 			"assets/css/style-transparent": 0,
/******/ 			"assets/css/skin-modes": 0,
/******/ 			"assets/css/style-dark": 0
/******/ 		};
/******/
/******/ 		// no chunk on demand loading
/******/
/******/ 		// no prefetching
/******/
/******/ 		// no preloaded
/******/
/******/ 		// no HMR
/******/
/******/ 		// no HMR manifest
/******/
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/
/******/ 		var chunkLoadingGlobal = self["webpackChunk"] = self["webpackChunk"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/
/************************************************************************/
/******/
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["assets/css/style","assets/css/animate","assets/css/style-transparent","assets/css/skin-modes","assets/css/style-dark"], () => (__webpack_require__("./resources/assets/js/datatable-filter.js")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/style","assets/css/animate","assets/css/style-transparent","assets/css/skin-modes","assets/css/style-dark"], () => (__webpack_require__("./resources/assets/css/style-dark.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/style","assets/css/animate","assets/css/style-transparent","assets/css/skin-modes","assets/css/style-dark"], () => (__webpack_require__("./resources/assets/css/skin-modes.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/style","assets/css/animate","assets/css/style-transparent","assets/css/skin-modes","assets/css/style-dark"], () => (__webpack_require__("./resources/assets/css/style-transparent.scss")))
/******/ 	__webpack_require__.O(undefined, ["assets/css/style","assets/css/animate","assets/css/style-transparent","assets/css/skin-modes","assets/css/style-dark"], () => (__webpack_require__("./resources/assets/scss/style.scss")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["assets/css/style","assets/css/animate","assets/css/style-transparent","assets/css/skin-modes","assets/css/style-dark"], () => (__webpack_require__("./resources/assets/css/animate.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/
/******/ })()
;
