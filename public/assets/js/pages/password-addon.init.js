/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************************!*\
  !*** ./resources/js/pages/password-addon.init.js ***!
  \***************************************************/
/*
Template Name: Gogym - Admin & Dashboard Template
Author: CapSolutions
Website: https://CapSolutions.com/
Contact: CapSolutions@gmail.com
File: Password addon Js File
*/
// password addon
$( "form .auth-pass-inputgroup" ).click(function() {
  if('password' == $('#password-input').attr('type')){
    $('#password-input').prop('type', 'text');
  }else{
      $('#password-input').prop('type', 'password');
  }

});
/******/ })()
;