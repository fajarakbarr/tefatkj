/*
Template Name: Admin Template
Author: Wrappixel

File: js
*/
// ==============================================================
// Auto select left navbar
// ==============================================================
$(function () {
  "use strict";
  var url = window.location + "";
  var path = url.replace(
    window.location.protocol + "//" + window.location.host + "/",
    ""
  );
  var element = $("ul#sidebarnav a").filter(function () {
    return this.href === url || this.href === path; // || url.href.indexOf(this.href) === 0;
  });
  element.parentsUntil(".sidebar-nav").each(function (index) {
    if ($(this).is("li") && $(this).children("a").length !== 0) {
      $(this).children("a").addClass("active-sidebar");
      $(this).parent("ul#sidebarnav").length === 0
        ? $(this).addClass("active-sidebar")
        : $(this).addClass("active-sidebar");
    } else if (!$(this).is("ul") && $(this).children("a").length === 0) {
      $(this).addClass("selected");
    } else if ($(this).is("ul")) {
      $(this).addClass("in");
    }
  });

  element.addClass("active-sidebar");
  $("#sidebarnav a").on("click", function (e) {
    if (!$(this).hasClass("active-sidebar")) {
      // hide any open menus and remove all other classes
      $("ul", $(this).parents("ul:first")).removeClass("in");
      $("a", $(this).parents("ul:first")).removeClass("active-sidebar");

      // open our new menu and add the open class
      $(this).next("ul").addClass("in");
      $(this).addClass("active-sidebar");
    } else if ($(this).hasClass("active-sidebar")) {
      $(this).removeClass("active-sidebar");
      $(this).parents("ul:first").removeClass("active-sidebar");
      $(this).next("ul").removeClass("in");
    }
  });
  $("#sidebarnav >li >a.has-arrow").on("click", function (e) {
    e.preventDefault();
  });
});
