// ============================================
// モジュール読み込み
// ============================================
import { viewport } from './libs/switchViewport';
import { inViewAnm, lenisPageScroll } from './libs/Scroll';
import { drawer, fixedHeader } from './libs/Header';
// import { accordionFunc } from './libs/Accordion';
import { addAutoFunc, numKeyFunc } from './libs/Form';
// import { articleTable, ScrollHintFunc } from './libs/ScrollHint';
import { splide } from './libs/Slider';
// import { tabFunc } from './libs/Tab';

// 実行
// ==========================
window.addEventListener('DOMContentLoaded', () => {
  viewport();
  fixedHeader();
  drawer();
  addAutoFunc();
  numKeyFunc();
  lenisPageScroll();
  // accordionFunc();
  // articleTable();
  // ScrollHintFunc();
  // tabFunc();
});

window.addEventListener('load', () => {
  document.body.classList.add('is-loaded');
  splide();
  inViewAnm();
});
