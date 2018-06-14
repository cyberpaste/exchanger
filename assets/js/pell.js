
var icons = {
	'image':'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDU4IDU4IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA1OCA1ODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxwYXRoIGQ9Ik01Nyw2SDFDMC40NDgsNiwwLDYuNDQ3LDAsN3Y0NGMwLDAuNTUzLDAuNDQ4LDEsMSwxaDU2YzAuNTUyLDAsMS0wLjQ0NywxLTFWN0M1OCw2LjQ0Nyw1Ny41NTIsNiw1Nyw2eiBNNTYsNTBIMlY4aDU0VjUweiIvPjxwYXRoIGQ9Ik0xNiwyOC4xMzhjMy4wNzEsMCw1LjU2OS0yLjQ5OCw1LjU2OS01LjU2OEMyMS41NjksMTkuNDk4LDE5LjA3MSwxNywxNiwxN3MtNS41NjksMi40OTgtNS41NjksNS41NjlDMTAuNDMxLDI1LjY0LDEyLjkyOSwyOC4xMzgsMTYsMjguMTM4eiBNMTYsMTljMS45NjgsMCwzLjU2OSwxLjYwMiwzLjU2OSwzLjU2OVMxNy45NjgsMjYuMTM4LDE2LDI2LjEzOHMtMy41NjktMS42MDEtMy41NjktMy41NjhTMTQuMDMyLDE5LDE2LDE5eiIvPjxwYXRoIGQ9Ik03LDQ2YzAuMjM0LDAsMC40Ny0wLjA4MiwwLjY2LTAuMjQ5bDE2LjMxMy0xNC4zNjJsMTAuMzAyLDEwLjMwMWMwLjM5MSwwLjM5MSwxLjAyMywwLjM5MSwxLjQxNCwwczAuMzkxLTEuMDIzLDAtMS40MTRsLTQuODA3LTQuODA3bDkuMTgxLTEwLjA1NGwxMS4yNjEsMTAuMzIzYzAuNDA3LDAuMzczLDEuMDQsMC4zNDUsMS40MTMtMC4wNjJjMC4zNzMtMC40MDcsMC4zNDYtMS4wNC0wLjA2Mi0xLjQxM2wtMTItMTFjLTAuMTk2LTAuMTc5LTAuNDU3LTAuMjY4LTAuNzItMC4yNjJjLTAuMjY1LDAuMDEyLTAuNTE1LDAuMTI5LTAuNjk0LDAuMzI1bC05Ljc5NCwxMC43MjdsLTQuNzQzLTQuNzQzYy0wLjM3NC0wLjM3My0wLjk3Mi0wLjM5Mi0xLjM2OC0wLjA0NEw2LjMzOSw0NC4yNDljLTAuNDE1LDAuMzY1LTAuNDU1LDAuOTk3LTAuMDksMS40MTJDNi40NDcsNDUuODg2LDYuNzIzLDQ2LDcsNDZ6Ii8+PC9nPjwvc3ZnPg==',
	'link':'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ4Mi44IDQ4Mi44IiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA0ODIuOCA0ODIuODsiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxnPjxwYXRoIGQ9Ik0yNTUuMiwyMDkuM2MtNS4zLDUuMy01LjMsMTMuOCwwLDE5LjFjMjEuOSwyMS45LDIxLjksNTcuNSwwLDc5LjRsLTExNSwxMTVjLTIxLjksMjEuOS01Ny41LDIxLjktNzkuNCwwbC0xNy4zLTE3LjNjLTIxLjktMjEuOS0yMS45LTU3LjUsMC03OS40bDExNS0xMTVjNS4zLTUuMyw1LjMtMTMuOCwwLTE5LjFzLTEzLjgtNS4zLTE5LjEsMGwtMTE1LDExNUM4LjcsMzIyLjcsMCwzNDMuNiwwLDM2NS44YzAsMjIuMiw4LjYsNDMuMSwyNC40LDU4LjhsMTcuMywxNy4zYzE2LjIsMTYuMiwzNy41LDI0LjMsNTguOCwyNC4zczQyLjYtOC4xLDU4LjgtMjQuM2wxMTUtMTE1YzMyLjQtMzIuNCwzMi40LTg1LjIsMC0xMTcuNkMyNjkuMSwyMDQsMjYwLjUsMjA0LDI1NS4yLDIwOS4zeiIvPjxwYXRoIGQ9Ik00NTguNSw1OC4ybC0xNy4zLTE3LjNjLTMyLjQtMzIuNC04NS4yLTMyLjQtMTE3LjYsMGwtMTE1LDExNWMtMzIuNCwzMi40LTMyLjQsODUuMiwwLDExNy42YzUuMyw1LjMsMTMuOCw1LjMsMTkuMSwwczUuMy0xMy44LDAtMTkuMWMtMjEuOS0yMS45LTIxLjktNTcuNSwwLTc5LjRsMTE1LTExNWMyMS45LTIxLjksNTcuNS0yMS45LDc5LjQsMGwxNy4zLDE3LjNjMjEuOSwyMS45LDIxLjksNTcuNSwwLDc5LjRsLTExNSwxMTVjLTUuMyw1LjMtNS4zLDEzLjgsMCwxOS4xYzIuNiwyLjYsNi4xLDQsOS41LDRzNi45LTEuMyw5LjUtNGwxMTUtMTE1YzE1LjctMTUuNywyNC40LTM2LjYsMjQuNC01OC44QzQ4Mi44LDk0LjgsNDc0LjIsNzMuOSw0NTguNSw1OC4yeiIvPjwvZz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PC9zdmc+',
    'unorderedlist':'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDYwLjEyMyA2MC4xMjMiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYwLjEyMyA2MC4xMjM7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48cGF0aCBkPSJNNTcuMTI0LDUxLjg5M0gxNi45MmMtMS42NTcsMC0zLTEuMzQzLTMtM3MxLjM0My0zLDMtM2g0MC4yMDNjMS42NTcsMCwzLDEuMzQzLDMsM1M1OC43ODEsNTEuODkzLDU3LjEyNCw1MS44OTN6Ii8+PHBhdGggZD0iTTU3LjEyNCwzMy4wNjJIMTYuOTJjLTEuNjU3LDAtMy0xLjM0My0zLTNzMS4zNDMtMywzLTNoNDAuMjAzYzEuNjU3LDAsMywxLjM0MywzLDNDNjAuMTI0LDMxLjcxOSw1OC43ODEsMzMuMDYyLDU3LjEyNCwzMy4wNjJ6Ii8+PHBhdGggZD0iTTU3LjEyNCwxNC4yMzFIMTYuOTJjLTEuNjU3LDAtMy0xLjM0My0zLTNzMS4zNDMtMywzLTNoNDAuMjAzYzEuNjU3LDAsMywxLjM0MywzLDNTNTguNzgxLDE0LjIzMSw1Ny4xMjQsMTQuMjMxeiIvPjxjaXJjbGUgY3g9IjQuMDI5IiBjeT0iMTEuNDYzIiByPSI0LjAyOSIvPjxjaXJjbGUgY3g9IjQuMDI5IiBjeT0iMzAuMDYyIiByPSI0LjAyOSIvPjxjaXJjbGUgY3g9IjQuMDI5IiBjeT0iNDguNjYxIiByPSI0LjAyOSIvPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48L3N2Zz4=',
    'orderedlist':'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTEuOTk0IDUxMS45OTQiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMS45OTQgNTExLjk5NDsiIHhtbDpzcGFjZT0icHJlc2VydmUiPjxnPjxnPjxwYXRoIGQ9Ik0zNS41MzcsMjkyLjE3MWwtMC4yMjUtMC44NjNsMTQuNjEzLTE1Ljg1N2M5LjQ5NS0xMC4zMzMsMTYuMDA2LTE4LjIyNywxOS41NDQtMjMuNDY5YzMuNTMzLTUuMjQxLDUuMzAxLTExLjMyNiw1LjMwMS0xOC4xNDhjMC0xMC4xMzUtMy4zMjYtMTguMTQ2LTkuOTc0LTIzLjk4NGMtNi42NS01LjgzMS0xNS45MDktOC43NjEtMjcuNzc1LTguNzYxYy0xMS4xNzQsMC0yMC4xNDksMy40NjctMjYuOTIzLDEwLjQxMmMtNi43NzQsNi45NDUtMTAuMDM4LDE1LjMwNi05Ljc4OSwyNS4yOTRsMC4xNSwwLjMzOWgyNC40NzN2MC4wMDJjMC00LjQwMywxLjA3Ni04LjkwOSwzLjIyNy0xMi4wOTdjMi4xNTEtMy4xOSw1LjEwNS00LjczMSw4Ljg2My00LjczMWM0LjIwMiwwLDcuMzU1LDEuMjYxLDkuNDU3LDMuNzMxYzIuMSwyLjQ3NCwzLjE1Miw1LjgwMSwzLjE1Miw5Ljk1NWMwLDIuOTE3LTEuMDM5LDYuMzYtMy4xMTUsMTAuMzEzYy0yLjA3NiwzLjk1Ni01LjcxOSw4LjQ1OC0xMC4xMjIsMTMuNTAxTDEuMjgsMjk0LjMwNHYxNS40NzhoNzQuODQ3di0xNy42MTFIMzUuNTM3eiIvPjwvZz48L2c+PGc+PGc+PHBvbHlnb24gcG9pbnRzPSI1MS45MTEsMTI3LjA2OCA1MS45MTEsMzcuNzE5IDEuMjgsNDUuMjgzIDEuMjgsNjMuMjI4IDI1LjQ5NSw2My4yMjggMjUuNDk1LDEyNy4wNjggMS4yOCwxMjcuMDY4IDEuMjgsMTQ2Ljg4IDc2LjEyNiwxNDYuODggNzYuMTI2LDEyNy4wNjggIi8+PC9nPjwvZz48Zz48Zz48cGF0aCBkPSJNNzMuMDY2LDQyNy4wMzJjLTMuMjY1LTQuMzMtNy43ODktNy41NDItMTMuNTc0LTkuNjY4YzUuMDkyLTIuMzI1LDkuMTYtNS41NSwxMi4yLTkuNjc3YzMuMDQyLTQuMTI4LDQuNTYxLTguNjQzLDQuNTYxLTEzLjUzNGMwLTkuODQtMy41MTEtMTcuNDQyLTEwLjUzMS0yMi44MDZjLTcuMDItNS4zNjctMTYuMzg5LTguMDQ2LTI4LjEwOS04LjA0NmMtMTAuMDg3LDAtMTguNjY1LDIuNjctMjUuNzM2LDguMDExYy03LjA3MSw1LjM0MS0xMC40NTksMTIuNjk1LTEwLjE2MSwyMS4yOThsMC4xNSwwLjgzaDI0LjMyN2MwLTQuNDAzLDEuMjMzLTUuNzc0LDMuNzA3LTcuNjU0YzIuNDcyLTEuODgsNS4zNDEtMy4wMDksOC42MDMtMy4wMDljNC4xNTQsMCw3LjMxNywxLjA2NSw5LjQ5NSwzLjM5YzIuMTc1LDIuMzI1LDMuMjYyLDUuMTQyLDMuMjYyLDguNTU1YzAsNC4zMDEtMS4yMTEsNy44NjgtMy42MzIsMTAuMjkxYy0yLjQyNCwyLjQyNC01Ljg4NCwzLjgzNy0xMC4zODQsMy44MzdIMjUuNDk1djE3LjYxMWgxMS43NDljNC45OTUsMCw4Ljg2MywxLjQ3NSwxMS42MDgsMy44NzJjMi43NDUsMi4zOTksNC4xMTcsNi4zNTgsNC4xMTcsMTEuNTk3YzAsMy43Ni0xLjMxMiw2Ljk0My0zLjkyOSw5LjQxNWMtMi42MjIsMi40NzItNi4xMzMsMy43NC0xMC41MzQsMy43NGMtMy44NTcsMC03LjEzLTEuNjYyLTkuODI3LTQuMDA5Yy0yLjY5Ny0yLjM0Ny00LjA0Mi00LjgwMy00LjA0Mi05LjIwNkgwLjE1OWwtMC4xNDcsMC45NTFjLTAuMjQ3LDEwLjA4NywzLjQyMywxOC4wNDIsMTEuMDEzLDIzLjM1N2M3LjU5LDUuMzE0LDE2LjQ1Myw4LjA5OSwyNi41ODgsOC4wOTljMTEuNzY5LDAsMjEuNDM1LTIuNzY1LDI5LjAwMS04LjQyN2M3LjU2Ni01LjY2LDExLjM0Ni0xMy40MDYsMTEuMzQ2LTIzLjI5NUM3Ny45Niw0MzYuNTIyLDc2LjMzMSw0MzEuMzYsNzMuMDY2LDQyNy4wMzJ6Ii8+PC9nPjwvZz48Zz48Zz48cmVjdCB4PSIxNDguNzY3IiB5PSIzNjIuNjA2IiB3aWR0aD0iMzYzLjIyNyIgaGVpZ2h0PSI3Mi42NDUiLz48L2c+PC9nPjxnPjxnPjxyZWN0IHg9IjE0OC43NjciIHk9IjIxOS41MTciIHdpZHRoPSIzNjMuMjI3IiBoZWlnaHQ9IjcyLjY0NSIvPjwvZz48L2c+PGc+PGc+PHJlY3QgeD0iMTQ4Ljc2NyIgeT0iNzIuMDM0IiB3aWR0aD0iMzYzLjIyNyIgaGVpZ2h0PSI3Mi42NDUiLz48L2c+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjwvc3ZnPg==',
    'quote':'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjxzdmcgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDQ2LjE5NSA0Ni4xOTUiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDQ2LjE5NSA0Ni4xOTU7IiB4bWw6c3BhY2U9InByZXNlcnZlIj48Zz48cGF0aCBzdHlsZT0iZmlsbDojMDEwMDAyOyIgZD0iTTM1Ljc2NSw4LjI2NGMtNS44OTgsMC0xMC41NTUsNC43ODItMTAuNTU1LDEwLjY4czQuODQ0LDEwLjY4LDEwLjc0MiwxMC42OGMwLjA1OSwwLDAuMTQ4LTAuMDA4LDAuMjA3LTAuMDA5Yy0yLjMzMiwxLjg1Ny01LjI2MSwyLjk3Ni04LjQ2NywyLjk3NmMtMS40NzUsMC0yLjY2MiwxLjE5Ni0yLjY2MiwyLjY3czAuOTQ5LDIuNjcsMi40MjQsMi42N2MxMC40NjktMC4wMDEsMTguNzQxLTguNTE4LDE4Ljc0MS0xOC45ODdjMC0wLjAwMiwwLTAuMDA0LDAtMC4wMDdDNDYuMTk1LDEzLjA0Miw0MS42NjEsOC4yNjQsMzUuNzY1LDguMjY0eiIvPjxwYXRoIHN0eWxlPSJmaWxsOiMwMTAwMDI7IiBkPSJNMTAuNzUsOC4yNjRjLTUuODk4LDAtMTAuNTYzLDQuNzgyLTEwLjU2MywxMC42OHM0Ljg0LDEwLjY4LDEwLjczOSwxMC42OGMwLjA1OSwwLDAuMTQ2LTAuMDA4LDAuMjA1LTAuMDA5Yy0yLjMzMiwxLjg1Ny01LjI2MiwyLjk3Ni04LjQ2OCwyLjk3NkMxLjE4OCwzMi41OTEsMCwzMy43ODcsMCwzNS4yNjFzMC45NjQsMi42NywyLjQzOSwyLjY3YzEwLjQ2OS0wLjAwMSwxOC43NTYtOC41MTgsMTguNzU2LTE4Ljk4N2MwLTAuMDAyLDAtMC4wMDQsMC0wLjAwN0MyMS4xOTUsMTMuMDQyLDE2LjY0Niw4LjI2NCwxMC43NSw4LjI2NHoiLz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PC9zdmc+',
	
	
};

function makeIcon(pic){
	return '<img src="'+ pic +'">';
}

(function (global, factory) {
	typeof exports === 'object' && typeof module !== 'undefined' ? factory(exports) :
	typeof define === 'function' && define.amd ? define(['exports'], factory) :
	(factory((global.pell = {})));
}(this, (function (exports) { 'use strict';

var _extends = Object.assign || function (target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i]; for (var key in source) { if (Object.prototype.hasOwnProperty.call(source, key)) { target[key] = source[key]; } } } return target; };

var defaultParagraphSeparatorString = 'defaultParagraphSeparator';
var formatBlock = 'formatBlock';
var addEventListener = function addEventListener(parent, type, listener) {
  return parent.addEventListener(type, listener);
};
var appendChild = function appendChild(parent, child) {
  return parent.appendChild(child);
};
var createElement = function createElement(tag) {
  return document.createElement(tag);
};
var queryCommandState = function queryCommandState(command) {
  return document.queryCommandState(command);
};
var queryCommandValue = function queryCommandValue(command) {
  return document.queryCommandValue(command);
};

var exec = function exec(command) {
  var value = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
  return document.execCommand(command, false, value);
};

var defaultActions = {
  bold: {
    icon: '<b>B</b>',
    title: 'Жирный',
    state: function state() {
      return queryCommandState('bold');
    },
    result: function result() {
      return exec('bold');
    }
  },
  italic: {
    icon: '<i>I</i>',
    title: 'Курсив',
    state: function state() {
      return queryCommandState('italic');
    },
    result: function result() {
      return exec('italic');
    }
  },
  underline: {
    icon: '<u>U</u>',
    title: 'Подчеркнуть',
    state: function state() {
      return queryCommandState('underline');
    },
    result: function result() {
      return exec('underline');
    }
  },
  strikethrough: {
    icon: '<strike>S</strike>',
    title: 'Зачеркнуть',
    state: function state() {
      return queryCommandState('strikeThrough');
    },
    result: function result() {
      return exec('strikeThrough');
    }
  },
  heading1: {
    icon: '<b>H<sub>1</sub></b>',
    title: 'Заголовок 1',
    result: function result() {
      return exec(formatBlock, '<h1>');
    }
  },
  heading2: {
    icon: '<b>H<sub>2</sub></b>',
    title: 'Заголовок 2',
    result: function result() {
      return exec(formatBlock, '<h2>');
    }
  },
  heading3: {
    icon: '<b>H<sub>3</sub></b>',
    title: 'Заголовок 3',
    result: function result() {
      return exec(formatBlock, '<h3>');
    }
  },
  paragraph: {
    icon: '&#182;',
    title: 'Параграф',
    result: function result() {
      return exec(formatBlock, '<p>');
    }
  },
  quote: {
    icon: makeIcon(icons.quote),
    title: 'Кавычки',
    result: function result() {
      return exec(formatBlock, '<blockquote>');
    }
  },
  olist: {
    icon: makeIcon(icons.orderedlist),
    title: 'Нумерованный список',
    result: function result() {
      return exec('insertOrderedList');
    }
  },
  ulist: {
    icon: makeIcon(icons.unorderedlist),
    title: 'Ненумерованный список',
    result: function result() {
      return exec('insertUnorderedList');
    }
  },
  code: {
    icon: '&lt;/&gt;',
    title: 'Код',
    result: function result() {
      return exec(formatBlock, '<pre>');
    }
  },
  line: {
    icon: '&#8213;',
    title: 'Горизонтальная линия',
    result: function result() {
      return exec('insertHorizontalRule');
    }
  },
  link: {
    icon: makeIcon(icons.link),
    title: 'Ссылка',
    result: function result() {
      var url = window.prompt('Введите URL');
      if (url) exec('createLink', url);
    }
  },
  image: {
    icon: makeIcon(icons.image),
    title: 'Картинка',
    result: function result() {
      var url = window.prompt('Введите URL');
      if (url) exec('insertImage', url);
    }
  }
};

var defaultClasses = {
  actionbar: 'pell-actionbar',
  button: 'pell-button',
  content: 'pell-content',
  selected: 'pell-button-selected'
};

var init = function init(settings) {
  var actions = settings.actions ? settings.actions.map(function (action) {
    if (typeof action === 'string') return defaultActions[action];else if (defaultActions[action.name]) return _extends({}, defaultActions[action.name], action);
    return action;
  }) : Object.keys(defaultActions).map(function (action) {
    return defaultActions[action];
  });

  var classes = _extends({}, defaultClasses, settings.classes);

  var defaultParagraphSeparator = settings[defaultParagraphSeparatorString] || 'div';

  var actionbar = createElement('div');
  actionbar.className = classes.actionbar;
  appendChild(settings.element, actionbar);

  var content = settings.element.content = createElement('div');
  content.contentEditable = true;
  content.className = classes.content;
  content.oninput = function (_ref) {
    var firstChild = _ref.target.firstChild;

    if (firstChild && firstChild.nodeType === 3) exec(formatBlock, '<' + defaultParagraphSeparator + '>');else if (content.innerHTML === '<br>') content.innerHTML = '';
    settings.onChange(content.innerHTML);
  };
  content.onkeydown = function (event) {
    if (event.key === 'Tab') {
      event.preventDefault();
    } else if (event.key === 'Enter' && queryCommandValue(formatBlock) === 'blockquote') {
      setTimeout(function () {
        return exec(formatBlock, '<' + defaultParagraphSeparator + '>');
      }, 0);
    }
  };
  appendChild(settings.element, content);

  actions.forEach(function (action) {
    var button = createElement('button');
    button.className = classes.button;
    button.innerHTML = action.icon;
    button.title = action.title;
    button.setAttribute('type', 'button');
    button.onclick = function () {
      return action.result() && content.focus();
    };

    if (action.state) {
      var handler = function handler() {
        return button.classList[action.state() ? 'add' : 'remove'](classes.selected);
      };
      addEventListener(content, 'keyup', handler);
      addEventListener(content, 'mouseup', handler);
      addEventListener(button, 'click', handler);
    }

    appendChild(actionbar, button);
  });

  if (settings.styleWithCSS) exec('styleWithCSS');
  exec(defaultParagraphSeparatorString, defaultParagraphSeparator);

  return settings.element;
};

var pell = { exec: exec, init: init };

exports.exec = exec;
exports.init = init;
exports['default'] = pell;

Object.defineProperty(exports, '__esModule', { value: true });

})));
