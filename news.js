const ul = document.querySelector('ul');

for (let i = 1; i <= 3; i++) {
  const li = document.createElement('LI');
  ul.textContent = `這是第${i}個 LI 元素`;
  list.appendChild(li);
}