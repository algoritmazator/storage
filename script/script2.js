var dialogs = document.querySelectorAll('dialog');
document.querySelectorAll('.show').forEach((button, index) => {
  button.onclick = function() {
    dialogs[index].showModal();
  };
});
document.querySelectorAll('.close').forEach((button, index) => {
  button.onclick = function() {
    dialogs[index].close();
  };
});