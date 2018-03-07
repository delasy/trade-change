var drawerEl = document.querySelector('.mdc-temporary-drawer');
var MDCTemporaryDrawer = mdc.drawer.MDCTemporaryDrawer;
var drawer = new MDCTemporaryDrawer(drawerEl);
document.querySelector('.admin-menu-toggle').addEventListener('click', function () { drawer.open = true; });
drawerEl.addEventListener('MDCTemporaryDrawer:open', function () {});
drawerEl.addEventListener('MDCTemporaryDrawer:close', function () {});
