window.addEventListener('DOMContentLoaded', function () {
  'use strict';

  function debugConsole() {
    console.log('click');
  }

  let headerBtn = document.querySelector('.header__btn-nav'),
      sectionMainContent = document.querySelector('.main-content'),
      navSidebar = document.querySelector('.nav-sidebar');

  headerBtn.addEventListener('click', function () {

    navSidebar.classList.toggle('nav-sidebar--hide');
    sectionMainContent.classList.toggle('main-content--full');

  });

});
/*
$(function () {
  $('.nav-sidebar__btn').on('click', function () {
    let sectionMainContent = $('.main-content'),
        navSidebar = $('.nav-sidebar');
  });

  if (main.hasClass(''))
});*/