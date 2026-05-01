(function () {
  'use strict';

  var filterBox    = document.getElementById('kkk-filter-box');
  var list         = document.getElementById('kkk-episode-list');
  var searchInput  = document.getElementById('kkk-search-input');
  var resultLabel  = document.getElementById('kkk-filter-result');

  if (!filterBox || !list || !searchInput) return;

  var checkboxes = filterBox.querySelectorAll('.kkk-cat-checkbox__input');
  var allItems   = Array.prototype.slice.call(list.querySelectorAll('.kkk-list-item'));

  /* 初期値を data 属性から読み込む */
  var initialCat    = filterBox.getAttribute('data-initial-cat') || '';
  var initialSearch = filterBox.getAttribute('data-initial-search') || '';

  if (initialCat) {
    checkboxes.forEach(function (cb) {
      if (cb.value === initialCat) cb.checked = true;
    });
  }
  if (initialSearch) {
    searchInput.value = initialSearch;
  }

  function getCheckedCats() {
    var checked = [];
    checkboxes.forEach(function (cb) {
      if (cb.checked) checked.push(cb.value);
    });
    return checked;
  }

  function applyFilter() {
    var query      = searchInput.value.trim().toLowerCase();
    var checkedCats = getCheckedCats();
    var visible    = 0;

    allItems.forEach(function (item) {
      var itemCats = (item.getAttribute('data-categories') || '').split(' ');
      var itemText = (item.getAttribute('data-text') || '').toLowerCase();

      var catMatch = checkedCats.length === 0 || checkedCats.some(function (c) {
        return itemCats.indexOf(c) !== -1;
      });
      var textMatch = !query || itemText.indexOf(query) !== -1;

      var show = catMatch && textMatch;
      if (show) {
        item.removeAttribute('hidden');
        visible++;
      } else {
        item.setAttribute('hidden', '');
      }
    });

    if (resultLabel) {
      resultLabel.textContent = visible + ' 件表示中';
    }
  }

  /* イベント登録 */
  var debounceTimer;
  searchInput.addEventListener('input', function () {
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(applyFilter, 200);
  });

  checkboxes.forEach(function (cb) {
    cb.addEventListener('change', applyFilter);
  });

  /* 初期フィルター適用 */
  if (initialCat || initialSearch) {
    applyFilter();
  }
})();
