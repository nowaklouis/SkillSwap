document.querySelectorAll("[data-reply]").forEach((element) => {
  element.addEventListener("click", function () {
    document.querySelector("#messages_main_messageId").value = this.dataset.id;
  });
});
