import { gsap } from 'gsap';

// ============================================
// GSAP化に成功したアコーディオン
// ============================================
function accordionFunc(){
  const contents = document.querySelectorAll('.js-accordion');
  const triggers = document.querySelectorAll('.js-accordion__ttlWrap');
  const items = document.querySelectorAll('.js-accordion__contents');

  if (contents.length === 0 || triggers.length === 0 || items.length === 0) return;

  triggers.forEach((trigger, index) => {
    const item = items[index];

    // 初期状態
    gsap.set(item, {
      height: 0,
      overflow: 'hidden'
    });

    // クリックされた時
    trigger.addEventListener('click', () => {
      const isOpen = item.classList.contains('is-open');

      if (isOpen) {

        // 閉じるアニメーション
        gsap.to(item, {
          height: 0,
          duration: 0.5,
          ease: 'power2.inOut',
        });
        item.classList.remove('is-open');
      } else {

        // 開くアニメーション
        const contentHeight = item.scrollHeight;

        gsap.to(item, {
          height: contentHeight,
          duration: 0.5,
          ease: 'power2.inOut',
        });
        item.classList.add('is-open');
      }

    });
  });
}

export { accordionFunc };
