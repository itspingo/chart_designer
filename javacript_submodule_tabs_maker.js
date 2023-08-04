
// code for appending submodule as a child 

(function() {
  const tabsContainer = document.getElementById('tabsContainer');
  const addTabBtn = document.getElementById('addTabBtn');
  var mytarget;
  let tabCounter = 2;

  addTabBtn.addEventListener('click', () => {
    const newTab = tabsContainer.querySelector('li.nav-item').cloneNode(true);
    const newTabLink = newTab.querySelector('a');
    newTabLink.href = `#tab${tabCounter}`;

    newTabLink.textContent = `Tab ${tabCounter}`;

    const activeTab = tabsContainer.querySelector('li.nav-item.active');
    if (activeTab) {
      activeTab.classList.remove('active');
    }

    tabsContainer.querySelector('ul').insertBefore(newTab, addTabBtn.parentNode);

    const tabPane = document.createElement('div');
    tabPane.classList.add('tab-pane', 'fade');
    tabPane.id = `tab${tabCounter}`;
    tabsContainer.parentElement.querySelector('.tab-content').appendChild(tabPane);
   
    new bootstrap.Tab(newTabLink).show();
    tabCounter++;
  });

  document.addEventListener('DOMContentLoaded', () => {
    const myTabs = new bootstrap.Tab(tabsContainer);
    myTabs.show();
    addTabBtn.style.display = 'inline-block';
  });
})();
