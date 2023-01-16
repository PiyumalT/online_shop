if (inputs == null) {
    let inputs = document.querySelectorAll("input");
}
for (let i = 0; i < inputs.length; i++) {
    inputs[i].style.borderBottom = "1px solid black";
    inputs[i].addEventListener("click", () => {
        inputs[i].style.borderBottom = "";
    });
}